<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends SKMS_Controller
{
    
  public function __construct()
  {
    parent::__construct();

    error_reporting(0);

    $this->load->model('Application_model');
    $this->load->model('Login_model');
    $this->load->model('Log_model');
    $this->load->model('User_model');
    $this->load->model('CSF_model');
    $this->load->model('Library_model');
    $this->load->helper('file');
  }

  /**
   * Display admin login page
   *
   * @return void
   */
  public function index()
  {

    if ($this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/admin/dashboard_ilc');
    }
    
    $data['main_title'] = "RDLIP Administrator";
    $data['main_content'] = "rdlip/admin_login";
    $data['flag'] = 0;

	  $this->_LoadPage('common/body',$data);
  }

  /**
   * Display counts and lists of applications
   * 
   * ILC - International and Local Conferences
   *
   * @return void
   */
  public function dashboard_ilc()
  {

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/admin');
    }

    
    if($this->session->userdata('_rdlip_role') == 1){

      $data['deadline'] = file_get_contents('./assets/rdlip/uploads/deadline.txt');
  

      $data['ilc_count'] = $this->Application_model->count_ilc();
      $data['pub_count'] = $this->Application_model->count_pub();
      $data['asso_count'] = $this->Application_model->count_asso_member(1);
      $data['reg_special_count'] = $this->Application_model->count_spc_member(1);
      $data['reg_count'] = $this->Application_model->count_reg_member(1);
      $data['hon_count'] = $this->Application_model->count_hon_member(1);

      $data['ilc_apps'] = $this->Application_model->get_ilc();
      
      $data['main_title'] = "RDLIP Online Application";
      $data['main_content'] = "rdlip/ilc_dashboard";
      $data['flag'] = 0;
      
      $this->_LoadPage('common/body',$data);
    }else{
      redirect('/rdlip/application/ilc');
    }
  }

  /**
   * Display counts and list of application
   * 
   * PUB - Publication Grant
   *
   * @return void
   */
  public function dashboard_pub()
  {

    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/admin');
    }

    if($this->session->userdata('_rdlip_role') == 1){
    
      $data['deadline'] = file_get_contents('./assets/rdlip/uploads/deadline.txt');

      $data['ilc_count'] = $this->Application_model->count_ilc();
      $data['pub_count'] = $this->Application_model->count_pub();
      $data['asso_count'] = $this->Application_model->count_asso_member(2);
      $data['reg_special_count'] = $this->Application_model->count_spc_member(2);
      $data['reg_count'] = $this->Application_model->count_reg_member(2);
      $data['hon_count'] = $this->Application_model->count_hon_member(2);

      $data['pub_apps'] = $this->Application_model->get_pub();
      
      $data['main_title'] = "RDLIP Online Application";
      $data['main_content'] = "rdlip/pub_dashboard";
      $data['flag'] = 0;

      $this->_LoadPage('common/body',$data);
    }else{
      redirect('/rdlip/application/ilc');
    }
  }

  /**
   * Authenticate login credentials
   *
   * @return void
   */
  public function auth(){

    $user = $this->input->post('usr_username');
    $pass = $this->input->post('usr_password');

    if ($this->Login_model->authenticate_admin($user)){

      $result = $this->Login_model->authenticate_admin($user);
      
      foreach ($result as $row) {
        $hash = $row->usr_password;
        $id = $row->row_id;
        $role = $row->usr_role;
      }

      if (password_verify($pass, $hash)) {

        //login successfull

        $sess = array(
          '_rdlip_logged_in' => TRUE,
          '_rdlip_username' => $user,
          '_rdlip_role' => $role,
          '_rdlip_name' => $user,
          '_rdlip_user_id' => $id,
          '_rdlip_role' => '1',
        );

        $this->session->set_userdata($sess);

        // // remember me
        // $year = time() + 31536000;

        // if (isset($_POST['remember'])) {
        //   setcookie('cookie_user', $usr_name, $year);
        //   setcookie('cookie_pass', $usr_password, $year);
        //   setcookie('remember_me', $remember, $year);
        // } else {
        //   $past = time() - 100;
        //   setcookie('remember_me', '', $past);
        //   setcookie('cookie_user', '', $past);
        //   setcookie('cookie_pass', '', $past);
        // }

        $log = array('log_usr_id' => $id, 'log_activity' => "Login successful", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
        $this->Log_model->save_log(array_filter($log));
        redirect('/rdlip/admin/dashboard_ilc');

      } else {
        // incorrect password
        $array_msg = array('icon' => 'fa fa-exclamation-circle', 'msg' => 'Incorrect Password');
        $this->session->set_flashdata('login_msg', $array_msg);
        $log = array('log_usr_id' => $id, 'log_activity' => "Login attempt (Incorrect Password)", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
        $this->Log_model->save_log(array_filter($log));

        redirect('/rdlip/admin');
      }

    }else{
      // invalid user
      $array_msg = array('icon' => 'fa fa-exclamation-circle', 'msg' => 'Invalid User');
      $this->session->set_flashdata('login_msg', $array_msg);
      $log = array('log_usr_id' => $id, 'log_activity' => "Login attempt (Invalid User)", 'log_cat' => $user, 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
      $this->Log_model->save_log(array_filter($log));
      redirect('/rdlip/admin');
    }
  }

  /**
   * Logout
   *
   * @return void
   */
  public function logout(){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Logout", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));
    session_unset();
		redirect('/rdlip/admin');
  }

  /**
   * Retrieve personal profile of a member
   *
   * @param [int] $id   user id
   * @return void
   */
  public function get_member_personal($id){
    $output = $this->Application_model->get_personal($id);
    echo json_encode($output);
  }

  /**
   * Retrieve residence address of a member
   *
   * @param [int] $id   user id
   * @return void
   */
  public function get_member_address($id){
    $output = $this->Application_model->get_home_address($id);
    echo json_encode($output);
  }

  /**
   * Retrieve employment of a member
   *
   * @param [int] $id   user id
   * @return void
   */
  public function get_member_employment($id){
    $output = $this->Application_model->get_employment($id);
    echo json_encode($output);
  }

  /**
   * Retrieve membership profile of a member
   *
   * @param [int] $id   user id
   * @return void
   */
  public function get_member_membership($id){
    $output = $this->Application_model->get_membership($id);
    echo json_encode($output);
  }

  /**
   * Retrieve ILC data
   * 
   * ILC - International and Local Conferences
   *
   * @param [int] $id   Row id
   * @return void
   */
  public function get_ilc_only($id){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "View Application (International and Local Conference)", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));

    $output = $this->Application_model->get_ilc_info($id);
    echo json_encode($output);
  }

  /**
   * Retrieve ILC attachments file names
   * 
   * ILC - International and Local Conferences
   *
   * @param [int] $id   row id
   * @return void
   */
  public function download_ilc($id){

    $output = $this->Application_model->get_ilc_attachments($id);
    echo json_encode($output);
  }
  
  /**
   * Retrieve PUB data
   * 
   * PUB - Publication Grant
   *
   * @param [int] $id   row id
   * @return void
   */
  public function get_pub_only($id){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "View Application (Publication Grant)", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));

    $output = $this->Application_model->get_pub_info($id);
    echo json_encode($output);
  }

  /**
   * Retrieve PUB attachments file names
   *
   * PUB - Publication Grant
   * 
   * @param [type] $id
   * @return void
   */
  public function download_pub($id){

    $output = $this->Application_model->get_pub_attachments($id);
    echo json_encode($output);
  }

/**
 * Retrieve activity logs
 *
 * @return void
 */
  public function activity_logs(){
    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('/rdlip/admin');
    }

    
    if($this->session->userdata('_rdlip_role') == 1){

      $user_id = $this->session->userdata('_rdlip_user_id');

      $data['main_title'] = "RDLIP Administrator";
      $data['main_content'] = "rdlip/logs";
      $data['flag'] = 1;

      $data['ilc_count'] = $this->Application_model->count_ilc();
      $data['pub_count'] = $this->Application_model->count_pub();
      
      $data['logs'] = $this->Log_model->get_logs();
      $this->_LoadPage('common/body',$data);
    }else{
      redirect('/rdlip/application/ilc');
    }
  }

  /**
   * Retrieve all users
   *
   * @return void
   */
  public function users(){
    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/admin');
    }

    
    if($this->session->userdata('_rdlip_role') == 1){

      $user_id = $this->session->userdata('_rdlip_user_id');

      $data['main_title'] = "RDLIP Administrator";
      $data['main_content'] = "rdlip/users";
      $data['flag'] = 1;

      $data['ilc_count'] = $this->Application_model->count_ilc();
      $data['pub_count'] = $this->Application_model->count_pub();
      
      $data['users'] = $this->User_model->get_users();
      $this->_LoadPage('common/body',$data);
    }else{
      redirect('/rdlip/application/ilc');
    }
  }

  /**
   * Add new user
   *
   * @return void
   */
  public function add_user(){

    $data = array(
      'usr_username' => $this->input->post('usr_username', TRUE),
      'usr_password' => password_hash($this->input->post('usr_password', true), PASSWORD_BCRYPT),
      'usr_role' => $this->input->post('usr_role', TRUE),
      'date_created' => date('Y-m-d H:i:s'),
    );
    
    $this->User_model->save_user(array_filter($data));

    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Add User", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));
  }

  /**
   * Update user
   *
   * @return void
   */
  public function update_user(){
    
    $pass_input = $this->input->post('usr_password', true);
    $password = ($pass_input != '') ? password_hash($pass_input, PASSWORD_BCRYPT) : $this->input->post('current_password', TRUE);

    $data = array(
      'usr_username' => $this->input->post('usr_username', TRUE),
      'usr_password' => $password,
      'usr_role' => $this->input->post('usr_role', TRUE),
      'last_updated' => date('Y-m-d H:i:s'),
    );

    $where = array('row_id' => $this->input->post('row_id', TRUE));
    
    $this->User_model->update_user(array_filter($data), $where);

    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Update User", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));
  }

  /**
   * Retrieve user data
   *
   * @param [int] $id   user id
   * @return void
   */
  public function get_user($id){
    $output = $this->User_model->get_user_by_id($id);
    echo json_encode($output);
  }

  /**
   * Remove user
   *
   * @param [type] $id
   * @return void
   */
  public function remove_user($id){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Remove User", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));

    $output = $this->User_model->remove_user_by_id($id);
  }

  /**
   * Export ILC application to excel
   * 
   * ILC - International and Local Conferences
   *
   * @return void
   */
  public function export_ilc_log(){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Export International and Local Conference Application", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));
  }

  /**
   * Export PUB application to excel
   *
   * PUB - Publication Grant
   * 
   * @return void
   */
  public function export_pub_log(){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Export Publication Grant", 'log_cat' => 1, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));
  }

  public function update_deadline(){

    $line = $this->input->post('app_deadline', TRUE);
    
    $file = './assets/rdlip/uploads/deadline.txt';
    
    file_put_contents($file, $line);

    redirect('/rdlip/admin/dashboard_ilc');
  }

  public function csf_feedbacks(){
    
    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/admin');
    }
    
    if($this->session->userdata('_rdlip_role') == 1){
					$data['main_title'] = "RDLIP Administrator";
					$data['main_content'] = "rdlip/admin_feedbacks";
					// $data['feedbacks'] = $this->Feedback_model->get_feedbacks();
					$data['csf_feedbacks'] = $this->CSF_model->get_csf_feedbacks();
					$data['questions'] = $this->Library_model->get_csf_questions();
          $data['ilc_count'] = $this->Application_model->count_ilc();
      $data['pub_count'] = $this->Application_model->count_pub();
					// $this->update_feedbacks();
					$this->_LoadPage('common/body', $data);
    }else{
      redirect('/rdlip/application/ilc');
    }
  }

  public function get_csf_feedback_by_ref($id){
		$output = $this->CSF_model->get_csf_feedback_by_ref($id);
		echo json_encode($output);
  }

	public function get_csf_graph($id){
		$output = $this->CSF_model->csf_graph($id);
		echo json_encode($output);
	}

  public function backup_import(){
    
    if (!$this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/admin');
    }
    
    if($this->session->userdata('_rdlip_role') == 1){
					$data['main_title'] = "RDLIP Administrator";
					$data['main_content'] = "rdlip/backup_import";
					$data['tables'] = $this->Library_model->get_tables();
          $data['ilc_count'] = $this->Application_model->count_ilc();
      $data['pub_count'] = $this->Application_model->count_pub();
					$this->_LoadPage('common/body', $data);
    }else{
      redirect('/rdlip/application/ilc');
    }
  }
}

/* End of file Admin.php */