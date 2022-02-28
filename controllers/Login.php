<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends SKMS_Controller
{
    
  public function __construct()
  {
    parent::__construct();
    
    error_reporting(0);
    
    $this->load->model('Login_model');
    $this->load->model('Log_model');
    
    
  }

  /**
   * Display login page
   *
   * @return void
   */
  public function index()
  {
    if ($this->session->userdata('_rdlip_logged_in')) {
			redirect('rdlip/application/ilc');
    }
    
    $data['main_title'] = "RDLIP Online Application";
    $data['main_content'] = "rdlip/login";
    $data['flag'] = 0;
	
	  $this->_LoadPage('common/body',$data);
  }

  /**
   * Authenticate login credentials
   *
   * @return void
   */
  public function auth(){

    $user = $this->input->post('usr_name');
    $pass = $this->input->post('usr_password');

    if ($this->Login_model->authenticate_user($user)){

      $result = $this->Login_model->authenticate_user($user);
      
      foreach ($result as $row) {
        $hash = $row->usr_password;
        $id = $row->usr_id;
        $name = $row->pp_first_name . ' ' . $row->pp_last_name;
        $status = $row->usr_status_id;
      }

      if($status == 1){
          if (password_verify($pass, $hash)) {

            // login successfull
            $sess = array(
              '_rdlip_logged_in' => TRUE,
              '_rdlip_username' => $user,
              '_rdlip_name' => $name,
              '_rdlip_user_id' => $id,
              '_rdlip_role' => '2',
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

            redirect('/rdlip/application/ilc');

            $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Login successful", 'log_cat' => 2, 'date_created' => date('Y-m-d H:i:s'));
            $this->Log_model->save_log(array_filter($log));
          } else {
            // incorrect password
            $array_msg = array('icon' => 'fa fa-exclamation-circle', 'msg' => 'Incorrect Password');
            $this->session->set_flashdata('login_msg', $array_msg);

            $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Login attempt (Incorrect Password)", 'log_cat' => 2, 'date_created' => date('Y-m-d H:i:s'));
            $this->Log_model->save_log(array_filter($log));

            redirect('/rdlip/login');
          }
      }else{
          
            // not activated account
            $array_msg = array('icon' => 'fa fa-exclamation-circle', 'msg' => 'Account not activated. Please contact SKMS admin.');
            $this->session->set_flashdata('login_msg', $array_msg);

            $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Login attempt (Account not activated)", 'log_cat' => 2, 'date_created' => date('Y-m-d H:i:s'));
            $this->Log_model->save_log(array_filter($log));

            redirect('/rdlip/login');
      }

      
    }else{
      // invalid account
      $array_msg = array('icon' => 'fa fa-exclamation-circle', 'msg' => 'Invalid User/Non-member account');
      $this->session->set_flashdata('login_msg', $array_msg);
      
      $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Login attempt (Invalid User/Non-member account)", 'log_cat' => 2, 'date_created' => date('Y-m-d H:i:s'));
      $this->Log_model->save_log(array_filter($log));
      redirect('/rdlip/login');
    }
  }

  /**
   * Logout
   *
   * @return void
   */
  public function logout(){
    $log = array('log_usr_id' => $this->session->userdata('_rdlip_user_id'), 'log_activity' => "Logout", 'log_cat' => 2, 'date_created' => date('Y-m-d H:i:s'));
    $this->Log_model->save_log(array_filter($log));

    session_unset();
		redirect('/rdlip/login');
  }

}

/* End of file Login.php */