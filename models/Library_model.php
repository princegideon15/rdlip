<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Library_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database(ENVIRONMENT);
    }

    public function get_csf_questions(){

        $this->db->select('*');
        $this->db->from('tblservice_feedback_questions');
		$query = $this->db->get();
		return $query->result();
    }

    public function get_csf_q_choices($val){

        $table = (($val == 1) ? 'tblaffiliation_type' : 
                 (($val == 2) ? 'tblnrcp_services' : 'tblservice_feedback_ratings'));
        
        $this->db->select('*');
        $this->db->from($table);
		$query = $this->db->get();
		return $query->result();
    }

	public function get_tables(){

		$rdlip = $this->load->database('rdlip', TRUE);
        return $rdlip->list_tables();
    }
}

/* End of file Library_model.php */