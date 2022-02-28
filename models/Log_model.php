<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Log_model extends CI_Model {

	private $logs = 'tbllogs';
	private $users = 'tblusers';

	public function __construct() {
		parent::__construct();
		$this->load->database(ENVIRONMENT);

    }
    
	/**
	 * Save activity log
	 *
	 * @param [array] $data
	 * @return void
	 */
    public function save_log($data){
        $CI =& get_instance();
        $rdlip = $CI->load->database('rdlip', TRUE);
        $rdlip->insert($this->logs, $data);
    }

	/**
	 * Retreive all activity logs
	 *
	 * @return void
	 */
	public function get_logs(){
		$CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
	
		$rdlip->select('*');
        $rdlip->from('tbllogs');
        $rdlip->order_by('date_created', 'desc');
		$query = $rdlip->get();
		return $query->result();
	}


	// /**
	//  * this function Retrieve all activity logs per user
	//  *
	//  * @return  array  
	//  */
	// public function get_logs() {
	// 	$this->db->select('b.log_user_id as log_user_id,b.log_action as log_action,a.acc_dp as acc_dp, b.date_created as date_created,log_insert_id');
	// 	$this->db->from($this->logs . ' b');
	// 	$this->db->join($this->accounts . ' a', 'b.log_user_id = a.row_id');
	// 	$this->db->where("log_user_id IN (select row_id from tblaccounts)");
	// 	$this->db->where_not_in('log_user_id', _UserIdFromSession());
	// 	$this->db->where('log_user_id IN (select row_id from tblaccounts where acc_type != 0)');
	// 	$this->db->order_by('date_created', 'desc');
	// 	$this->db->limit(5);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// 	// return $this->db->last_query();
	// }

	// /**
	//  * this function Retrieve all activities
	//  *
	//  * @return  array  
	//  */
	// public function get_all_logs() {
	// 	$this->db->select('*');
	// 	$this->db->from($this->logs);
	// 	$this->db->where("log_user_id IN (select row_id from tblaccounts)");
	// 	$this->db->where_not_in('log_user_id', _UserIdFromSession());
	// 	$this->db->where('log_user_id IN (select row_id from tblaccounts where acc_type != 0)');
	// 	$this->db->order_by('date_created', 'desc');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// 	// return $this->db->last_query();
	// }

	// /**
	//  * this function Retrieve all activities today
	//  *
	//  * @return  array
	//  */
	// public function get_all_logs_today() {
	// 	$this->db->select('b.acc_username,a.row_id,a.log_user_id,a.log_action');
	// 	$this->db->from($this->logs . ' a');
	// 	$this->db->join($this->accounts . ' b', 'b.row_id = a.log_user_id');
	// 	$this->db->where("log_user_id IN (select row_id from tblaccounts)");
	// 	$this->db->where_not_in('log_user_id', _UserIdFromSession());
	// 	$this->db->where('log_user_id IN (select row_id from tblaccounts where acc_type != 0)');
	// 	$this->db->like('a.date_created', date('Y-m-d'), 'both');
	// 	$this->db->where('notif_shown', '1');
	// 	$query = $this->db->get();
	// 	return $query->result();
	// 	// return $this->db->last_query();
	// }

	// /**
	//  * this function update notif show of a log
	//  *
	//  * @param   int  $id  log id
	//  *
	//  * @return  int		number of updated rows
	//  */
	// public function update_log($id) {
	// 	$post['notif_shown'] = 0;
	// 	$where['notif_shown'] = 1;
	// 	$where['row_id'] = $id;
	// 	$this->db->update($this->logs, $post, $where);
	// 	return $this->db->affected_rows();
	// }

	// /**
	//  * this function save export in activity log
	//  *
	//  * @param   array  $data  action
	//  *
	//  * @return  void
	//  */
	// public function save_log_export($data) {
	// 	$this->db->insert($this->logs, $data);
    // }
    
}

/* End of file Log_model.php */
