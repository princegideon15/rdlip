<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

	private $logs = 'tbllogs';
	private $users = 'tblusers';

	public function __construct() {
		parent::__construct();
		$this->load->database(ENVIRONMENT);

    }
    
	/**
	 * Save user account
	 *
	 * @param [array] $data
	 * @return void
	 */
    public function save_user($data){
        $CI =& get_instance();
        $rdlip = $CI->load->database('rdlip', TRUE);
        $rdlip->insert($this->users, $data);
    }
    
	/**
	 * Update user data
	 *
	 * @param [array] $data
	 * @param [array] $where
	 * @return void
	 */
    public function update_user($data, $where){
        $CI =& get_instance();
        $rdlip = $CI->load->database('rdlip', TRUE);
        $rdlip->update($this->users, $data, $where);
    }

	/**
	 * Retreive all users
	 *
	 * @return void
	 */
	public function get_users(){
		$CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
	
		$rdlip->select('*');
        $rdlip->from('tblusers');
        $rdlip->order_by('usr_username', 'asc');
        $rdlip->where('row_id !=', $this->session->userdata('_rdlip_user_id'));
		$query = $rdlip->get();
		return $query->result();
    }
    
	/**
	 * Retreive user data by id
	 *
	 * @param [int] $id		row_id
	 * @return void
	 */
    public function get_user_by_id($id){
		$CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
	
		$rdlip->select('*');
        $rdlip->from('tblusers');
        $rdlip->where('row_id', $id);
		$query = $rdlip->get();
		return $query->result();
	}

	/**
	 * Delete user
	 *
	 * @param [int] $id		row_id
	 * @return void
	 */
	public function remove_user_by_id($id){
		$CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);

		$where = array('row_id' => $id);
		$rdlip->delete($this->users, $where);
	}
    
}

/* End of file User_model.php */