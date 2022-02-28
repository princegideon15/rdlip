<?php

/**
* File Name: CSF_model.php
* ----------------------------------------------------------------------------------------------------
* Purpose of this file: 
* To get library items
* ----------------------------------------------------------------------------------------------------
* System Name: RDLIP Online Application
* ----------------------------------------------------------------------------------------------------
* Author: -
* ----------------------------------------------------------------------------------------------------
* Date of revision: -
* ----------------------------------------------------------------------------------------------------
* Copyright Notice:
* Copyright (C) 2018 by the Department of Science and Technology - National Research Council of the Philiipines
*/


defined('BASEPATH') OR exit('No direct script access allowed');

class CSF_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        $this->load->database(ENVIRONMENT);
    }
    
    public function save_csf($post){

      $rdlip = $this->load->database('rdlip', TRUE);
      $rdlip->insert('tblservice_feedbacks', $post);
      return $rdlip->affected_rows();

    }

    public function check_fdbk_ref($ref){
      

      $rdlip = $this->load->database('rdlip', TRUE);
      $rdlip->select('*');
      $rdlip->from('tblservice_feedbacks');
      $rdlip->where('svc_fdbk_ref', $ref);
      $query = $rdlip->get();
      return $query->num_rows();

    }

    public function check_client_id_exists($id){
      

      $rdlip = $this->load->database('rdlip', TRUE);
      $rdlip->select('*');
      $rdlip->from('tblilc_infos');
      $rdlip->where('rd_user_id', $id);
      $query = $rdlip->get();
      return $query->num_rows();

    }

    public function get_csf_feedbacks(){

      $rdlip = $this->load->database('rdlip', TRUE);
      
      $rdlip->select('svc_fdbk_usr_id as id, svc_fdbk_ref, pp_sex, pp_email, pp_first_name, pp_middle_name, pp_last_name, membership_type_name, a.date_created as date_submitted, mem_type');
      $rdlip->from('dbrdlip.tblservice_feedbacks a');
      $rdlip->join('new_dbskms.tblpersonal_profiles b', 'a.svc_fdbk_usr_id = b.pp_usr_id');
      $rdlip->join('new_dbskms.tblmembers c', 'a.svc_fdbk_usr_id = c.mem_usr_id');
      $rdlip->join('new_dbskms.tblmembership_types d', 'c.mem_type = d.membership_type_id');
      $rdlip->group_by('svc_fdbk_ref');
      $query = $rdlip->get()->result();
      return $query;

    }

    public function get_csf_feedback_by_ref($id){
      
      $rdlip = $this->load->database('rdlip', TRUE);

      $rdlip->select('*');
      $rdlip->from('dbrdlip.tblservice_feedbacks a');
      $rdlip->join('new_dbskms.tblservice_feedback_questions b', 'a.svc_fdbk_q_id = b.svc_fdbk_q_id ');
      $rdlip->join('new_dbskms.tblservice_feedback_ratings c', 'a.svc_fdbk_q_answer = c.svc_fdbk_rating_id', 'left');
      $rdlip->join('new_dbskms.tblnrcp_services d', 'a.svc_fdbk_q_answer = d.nrcp_svc_id', 'left');
      $rdlip->join('new_dbskms.tblaffiliation_type e', 'a.svc_fdbk_q_answer = e.aff_type_id ', 'left');
      $rdlip->where('svc_fdbk_ref', $id);
      $query = $rdlip->get();
      return $query->result();
    }
    
    public function csf_graph($id){

      $rdlip = $this->load->database('rdlip', TRUE);

      if($id == 1){ //affiliation
        $rdlip->select('count(*) as total, aff_type as label , aff_type_id as id ');
        $rdlip->join('new_dbskms.tblaffiliation_type b', 'a.svc_fdbk_q_answer = b.aff_type_id');
      }else if($id == 2){ //service
        $rdlip->select('count(*) as total, nrcp_svc as label, nrcp_svc_id as id');
        $rdlip->join('new_dbskms.tblnrcp_services b', 'a.svc_fdbk_q_answer = b.nrcp_svc_id');
      }else{
        $rdlip->select('count(*) as total, svc_fdbk_rating as label, svc_fdbk_rating_id as id');
        $rdlip->join('new_dbskms.tblservice_feedback_ratings b', 'a.svc_fdbk_q_answer = b.svc_fdbk_rating_id');
      }
  
      $rdlip->from('dbrdlip.tblservice_feedbacks a');
  
      if($id > 0){
        $rdlip->where('svc_fdbk_q_id', $id);
      }
  
      if($id == 1){ //affiliation
        $rdlip->group_by('aff_type_id');
      }else if($id == 2){ //service
        $rdlip->group_by('nrcp_svc_id');
      }else{
        $rdlip->group_by('svc_fdbk_rating_id');
      }
  
  
      $query = $rdlip->get();
      return $query->result();
    }
}

/* End of file Library_model.php */