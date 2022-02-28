<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Application extends SKMS_Controller
{
  public function __construct()
  {
    parent::__construct();

    error_reporting(0);

    $this->load->model('Application_model');
    $this->load->model('Library_model');
    $this->load->model('CSF_model');
		$this->load->library("My_phpmailer");
		$objMail = $this->my_phpmailer->load();
    $this->load->helper('string');
    
  }

  /**
   * Display landing page with apply button
   *
   * @return void
   */
  public function index()
  {
    
    $data['main_title'] = "RDLIP Online Application";
    $data['main_content'] = "rdlip/landing";
    $data['flag'] = 0;
    $data['deadline'] = file_get_contents('./assets/rdlip/uploads/deadline.txt');
    

	  $this->_LoadPage('common/body',$data);
  }

  /**
   * Display existing data of member in the ILC application form
   * 
   * ILC - International and Local Conferences
   *
   * @return void
   */
  public function ilc(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/login');
    }

    if($this->session->userdata('_rdlip_role') == 2){

      $user_id = $this->session->userdata('_rdlip_user_id');
  
      $data['main_title'] = "RDLIP Online Application";
      $data['main_content'] = "rdlip/ilc_application";
      $data['flag'] = 1;
      
      $data['personal'] = $this->Application_model->get_personal($user_id);
      $data['home'] = $this->Application_model->get_home_address($user_id);
      $data['employment'] = $this->Application_model->get_employment($user_id);
      $data['membership'] = $this->Application_model->get_membership($user_id);
  
      $data['verify_ilc'] = $this->Application_model->verify_ilc_application($user_id);
  
      $data['nibra'] = $this->Application_model->get_nibra();
  
      $this->_LoadPage('common/body',$data);
    }else{
			redirect('/rdlip/admin');
    }

  }

  /**
   * Submit ILC application
   * 
   * ILC - International and Local Conferences
   *
   * @return void
   */
  public function submit_rdilc(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/login');
    }

    if($this->input->post('submit')){
      
      $CI =& get_instance();
      $oprs = $CI->load->database('rdlip', TRUE);
  
      $info = 'tblilc_infos';
      $result_info = $oprs->list_fields($info);
      $post_info = array();
  
      foreach ($result_info as $i => $field) {
        $post_info[$field] = $this->input->post($field, TRUE);
      }
  
      $post_info['rd_user_id'] = $this->session->userdata('_rdlip_user_id');
      $post_info['date_created'] = date('Y-m-d H:i:s');
  
      $this->Application_model->save_ilc_infos(array_filter($post_info));
  
      $attach = 'tblilc_attachments';
      $result_attach = $oprs->list_fields($attach);
      $post_attach = array();
      $folder = array('conforme', 'abstract', 'invitation', 'conferenceprogram', 'tcr', 'liqr', 'preiot', 'auth', 'tix', 'other_or', 'dsa');
      $f = 0;
      foreach ($result_attach as $i => $field) {
  
        if($field != 'row_id' && $field != 'rd_user_id' && $field != 'date_created' && $field != 'last_updated')
        {
          // clean and rename files and upload to directory
          $file_string = str_replace(" ", "_", $_FILES[$field]['name']);
          $file_no_ext = preg_replace("/\.[^.	]+$/", "", $file_string);
          $clean_file = preg_replace('/[^A-Za-z0-9\-]/', '_', $file_no_ext);
  
          $filename = $_FILES[$field]['name'];
          $file_ext = pathinfo($filename, PATHINFO_EXTENSION);
          
          if($clean_file == ''){
            $post_attach[$field] = '-';
          }else{
            $post_attach[$field] = date('YmdHis') . '_' . $clean_file . '.' . $file_ext;
          }

          // $directory = './assets/rdlip/uploads/ilc_files/' . $folder[$f] . '/' ; // server
          $directory = $_SERVER['DOCUMENT_ROOT'] . '/skms/assets/rdlip/uploads/ilc_files/' . $folder[$f] . '/' ; // local
  
          $config['upload_path'] = $directory;
          $config['allowed_types'] = 'pdf';
          $config['file_name'] = $post_attach[$field];
      
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
      
          if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
          } else {
            $data = $this->upload->data();
          }
  
          $f++;
        }
      }
  
      $post_attach['rd_user_id'] = $this->session->userdata('_rdlip_user_id');
      $post_attach['date_created'] = date('Y-m-d H:i:s');
  
      $this->Application_model->save_ilc_attachments(array_filter($post_attach));

      $this->send_email($this->session->userdata('_rdlip_user_id'), '1');
  
      redirect('/rdlip/application/ilc');
    }else{
      redirect('/rdlip/application/ilc');
    }
  }

/**
 * Retrieve ILC application data of the logged in member
 * 
 * ILC - Interantional and Local Conferences
 *
 * @return void
 */
  public function get_ilc_info(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('/rdlip/login');
    }

    $user_id = $this->session->userdata('_rdlip_user_id');
    $output = $this->Application_model->get_ilc_info($user_id);
    echo json_encode($output);
  }

  /**
   * Retrieve ILC attachments if the logged in member
   *
   * @return void
   */
  public function get_ilc_attachments(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('/rdlip/login');
    }
    
    $user_id = $this->session->userdata('_rdlip_user_id');
    $output = $this->Application_model->get_ilc_attachments($user_id);
    echo json_encode($output);
  }

  /**
   * Retrieve PUB data of the logged in member
   * 
   * PUB - Pubication Grant
   *
   * @return void
   */
  public function pub_gr(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/login');
    }

    
    if($this->session->userdata('_rdlip_role') == 2){
      $user_id = $this->session->userdata('_rdlip_user_id');

      $data['main_title'] = "RDLIP Online Application";
      $data['main_content'] = "rdlip/pub_gr_application";
      $data['flag'] = 1;
      
      $data['personal'] = $this->Application_model->get_personal($user_id);
      $data['home'] = $this->Application_model->get_home_address($user_id);
      $data['employment'] = $this->Application_model->get_employment($user_id);
      $data['membership'] = $this->Application_model->get_membership($user_id);

      $data['verify_pubgr'] = $this->Application_model->verify_pubgr_application($user_id);

      $data['nibra'] = $this->Application_model->get_nibra();

      $this->_LoadPage('common/body',$data);
    }else{
      redirect('rdlip/admin');
    }
  }

  /**
   * Submit PUB Application
   * 
   * PUB - Publication Grant
   *
   * @return void
   */
  public function submit_rdpubgr(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/login');
    }

    if($this->input->post('submit')){

      $CI =& get_instance();
      $oprs = $CI->load->database('rdlip', TRUE);

      $info = 'tblpub_infos';
      $result_info = $oprs->list_fields($info);
      $post_info = array();

      foreach ($result_info as $i => $field) {
        $post_info[$field] = $this->input->post($field, TRUE);
      }

      $post_info['pub_user_id'] = $this->session->userdata('_rdlip_user_id');
      $post_info['date_created'] = date('Y-m-d H:i:s');

      $this->Application_model->save_pub_infos(array_filter($post_info));

      $attach = 'tblpub_attachments';
      $result_attach = $oprs->list_fields($attach);
      $post_attach = array();
      $folder = array('certification', 'abstract', 'conforme', 'notice', 'pub');
      $f = 0;
      foreach ($result_attach as $i => $field) {

        if($field != 'row_id' && $field != 'att_user_id' && $field != 'date_created' && $field != 'last_updated')
        {
          // clean and rename files and upload to directory
          $file_string = str_replace(" ", "_", $_FILES[$field]['name']);
          $file_no_ext = preg_replace("/\.[^.	]+$/", "", $file_string);
          $clean_file = preg_replace('/[^A-Za-z0-9\-]/', '_', $file_no_ext);

          $filename = $_FILES[$field]['name'];;
          $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

          if($clean_file == ''){
            $post_attach[$field] = '-';
          }else{
            $post_attach[$field] = date('YmdHis') . '_' . $clean_file . '.' . $file_ext;
          }
          

          // $directory = './assets/rdlip/uploads/pub_files/' . $folder[$f] . '/' ; // server


          $directory = $_SERVER['DOCUMENT_ROOT'] . '/skms/assets/rdlip/uploads/pub_files/' . $folder[$f] . '/' ; // local

          $config['upload_path'] = $directory;
          $config['allowed_types'] = 'pdf';
          $config['file_name'] = $post_attach[$field];
      
          $this->load->library('upload', $config);
          $this->upload->initialize($config);
      
          if (!$this->upload->do_upload($field)) {
            $error = $this->upload->display_errors();
          } else {
            $data = $this->upload->data();
          }

          $f++;
        }
      }

      $post_attach['att_user_id'] = $this->session->userdata('_rdlip_user_id');
      $post_attach['date_created'] = date('Y-m-d H:i:s');

      $this->Application_model->save_pub_attachments(array_filter($post_attach));

      $this->send_email($this->session->userdata('_rdlip_user_id'), '2');

      redirect('/rdlip/application/pub_gr');
    }
    else{
      redirect('/rdlip/application/pub_gr');
    }
  }

  /**
   * Retrieve PUB data of the logged in member
   * 
   * PUB - Publication Grant
   *
   * @return void
   */
  public function get_pub_info(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/login');
    }
    
    $user_id = $this->session->userdata('_rdlip_user_id');
    $output = $this->Application_model->get_pub_info($user_id);
    echo json_encode($output);
  }

  /**
   * Retrieve PUB attachments of the logged in member
   * 
   * PUB - Publication Grant
   *
   * @return void
   */
  public function get_pub_attachments(){

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/login');
    }
    
    $user_id = $this->session->userdata('_rdlip_user_id');
    $output = $this->Application_model->get_pub_attachments($user_id);
    echo json_encode($output);
  }

  /**
   * Display admin page
   *
   * @return void
   */
  public function admin(){
    $data['main_title'] = "RDLIP Admin System";
    $data['main_content'] = "rdlip/admin_login";
    $data['flag'] = 0;
	
	  $this->_LoadPage('common/body',$data);
  }

  /**
   * Send email to the member if application submitted successfully
   *
   * @param [int] $id   user id
   * @param [int] $flag   determine if ILC or PUB
   * @return void
   */
  public function send_email($id, $flag){

    $ref = random_string('alnum', 8) . date('ymdhis');
		$fdbk_sess = array(
			'client_id' => $id,
			'fdbk_ref' => $ref,
		);

		$this->session->set_userdata($fdbk_sess);

    $member_info = $this->Application_model->get_member_info($id);

    foreach($member_info as $row){
      $member_email = $row->pp_email;
      $member_full_name = $row->name;
    }

    // print_r($member_info);exit;
    
		if($member_email == '') { $member_email = 'nrcp1933@gmail.com'; }

    $nameuser = 'RDLIP Admin';
    $usergmail = 'nrcp1933@gmail.com';
    $password = '<<NRCP@1933>>';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    // Specify main and backup server
    $mail->SMTPAuth = true;
    $mail->Port = 465;
    // Enable SMTP authentication
    $mail->Username = $usergmail;
    // SMTP username
    $mail->Password = $password;
    // SMTP password
    $mail->SMTPSecure = 'ssl';
    // Enable encryption, 'ssl' also accepted
    $mail->From = $usergmail;
    $mail->FromName = $nameuser;
    $mail->AddAddress($member_email);

    $title = ($flag == 1) ? 'RDLIP Financial Grant for Paper Presentation.' : 'RDLIP Publication Grant.';

    $htmlBody = "<p>
    
    Dear " . $member_full_name . ",

    <br/><br/>

    This is to acknowledge receipt of your application for <strong>" . $title . "</strong>

    <br/><br/>

    You will be notified on the results of evaluation via email or you may check the status of your application at 
    <a href='https://skms.nrcp.dost.gov.ph/rdlip/' target='_blank'>skms.nrcp.dost.gov.ph/rdlip</a>.

    <br/>
    Please leave your comments and feedback here:
		
		<a href='localhost/skms/rdlip/application/customer_service'>DOST-NRCP Satisfaction Feedback Form</a>

    <br/><br/>

    Thank you.

    <br/><br/><br/>

    <em>Note: This is an auto-generated email.</em> 

    </p>";
			
    // email content
    $mail->Subject = "Acknowledgement_NRCP RDLIP Financial Grant Application";
    $mail->Body = $htmlBody;
    $mail->IsHTML(true);
    $mail->smtpConnect([
      'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true,
      ],
    ]);
    if (!$mail->Send()) {
      echo '</br></br>Message could not be sent.</br>';
      echo 'Mailer Error: ' . $mail->ErrorInfo . '</br>';
      exit;
    }
  }

  /**
	 * Display customer service feedback form
	 *
	 * @return void
	 */
	public function customer_service() {

		$id = $this->session->userdata('client_id');
		$ref = $this->session->userdata('fdbk_ref');   

		$check_client_id_exists = $this->CSF_model->check_client_id_exists($id);
		$check_if_fdbk_ref_exist = $this->CSF_model->check_fdbk_ref($ref);
		
		if($check_client_id_exists == 1 && $check_if_fdbk_ref_exist == 0){
			$data['main_title'] = "RDLIP Customer Service Feedback";
			$data['main_content'] = "rdlip/feedback";
			$data['questions'] = $this->Library_model->get_csf_questions();
			$data['affiliations'] = $this->Library_model->get_csf_q_choices(1);
			$data['services'] = $this->Library_model->get_csf_q_choices(2);
			$data['choices'] = $this->Library_model->get_csf_q_choices(3);
			$this->_LoadPage('common/body', $data);
		}else{
			redirect('/rdlip');
		}

	}

  public function submit_feedback() {


		$id = $this->session->userdata('client_id');  
		$ref = $this->session->userdata('fdbk_ref');
		
	
		$svc_fdbk_q_id      = $this->input->post('svc_fdbk_q_id[]', TRUE);       
        $svc_fdbk_q_answer  = $this->input->post('svc_fdbk_q_answer[]', TRUE);  
		
		if($svc_fdbk_q_id == ''){
			redirect('/rdlip');
		}else{
			
			$ids = array_unique($svc_fdbk_q_id);
			$data = array();

			$c=1;
			foreach($ids as $key => $q_id){

				$data= array( 
					'svc_fdbk_q_id'         =>  $q_id,                
					'svc_fdbk_q_answer'     =>  $svc_fdbk_q_answer[$c],
					'svc_fdbk_usr_id'       =>  $id,    
					'date_created'          =>  date('Y-m-d H:i:s'),
					'svc_fdbk_ref'          =>  $ref
					);
				$c++;
				
				$output = $this->CSF_model->save_csf($data);
			}

			$this->success_fdbk();
		}
		
	}
		
	public function success_fdbk(){
			
		$data['main_title'] = "eJournal";
		$data['main_content'] = "rdlip/success";
		$this->_LoadPage('common/body', $data);
	}
  

}

/* End of file Application.php */