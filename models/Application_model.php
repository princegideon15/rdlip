<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Application_model extends CI_Model {

    private $users = 'tblusers';
    private $personal = 'tblpersonal_profiles';
    private $employment = 'tblemployments';
    private $membership = 'tblmembers';
    private $title = 'tbltitles';
    private $sex = 'tblsex';
    private $home = 'tblresidence_address';
    private $city = 'tblcities';
    private $province = 'tblprovinces';
    private $region = 'tblregions';
    private $country = 'tblcountries';
    private $member_type = 'tblmembership_types';
    private $division = 'tbldivisions';

	public function __construct() {
		parent::__construct();
		$this->load->database(ENVIRONMENT);
	}
    
    /**
     * Rretrieve personal profile by user id
     *
     * @param [int] $id     pp_usr_id
     * @return void
     */
	public function get_personal($id) {

		$this->db->select('title_name, pp_last_name, pp_first_name, pp_middle_name, pp_extension, sex, pp_date_of_birth, pp_usr_id');
        $this->db->from($this->personal);
        $this->db->join($this->title, 'pp_title = title_id');
        $this->db->join($this->sex, 'pp_sex = s_id');
		$this->db->where('pp_usr_id', $id);
		$query = $this->db->get();
		return $query->result();
    }
    
    /**
     * Retreive residence address by user id
     *
     * @param [int] $id     adr_usr_id
     * @return void
     */
    public function get_home_address($id){

        $this->db->select('adr_street_subdv, adr_brgy, adr_zip_code, city_name, province_name, region_name, country_name');
        $this->db->from($this->home);
        $this->db->join($this->city, 'adr_city = city_id', 'left');
        $this->db->join($this->province, 'adr_province = province_id', 'left');
        $this->db->join($this->region, 'adr_region = region_id', 'left');
        $this->db->join($this->country, 'adr_country = country_id', 'left');
		$this->db->where('adr_usr_id', $id);
        $query = $this->db->get();
		return $query->result();
    }

    /**
     * Retrieve employemnt by user id
     *
     * @param [int] $id     emp_usr_id
     * @return void
     */
    public function get_employment($id){

        $this->db->select('emp_pos, emp_ins, emp_address');
        $this->db->from($this->employment);
		$this->db->where('emp_usr_id', $id);
		$this->db->where('emp_period_to', 'Present');
		$this->db->limit('1');
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Retreive member data by user id
     *
     * @param [int] $id     mem_usr_id
     * @return void
     */
    public function get_membership($id){

        $this->db->select('membership_type_name, concat(div_number,"-",div_name) as division, mem_date_elected');
        $this->db->from($this->membership);
        $this->db->join($this->member_type, 'mem_type = membership_type_id');
        $this->db->join($this->division, 'mem_div_id = div_id');
		$this->db->where('mem_usr_id', $id);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * Retreive nibra
     *
     * @return void
     */
    public function get_nibra(){
        
        $CI =& get_instance();
        $nibra = $CI->load->database('bris', TRUE);

        $nibra->select('nibra_id, nibra_name');
        $nibra->from('tblnibra');
        $query = $nibra->get();
        return $query->result();
    }

    /**
     * Save ILC data
     * 
     * ILC - Internation and Local Conferences
     *
     * @param [array] $data
     * @return void
     */
    public function save_ilc_infos($data){

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
		$rdlip->insert('tblilc_infos', $data);
		return $rdlip->affected_rows();
    }

    /**
     * Save ILC attachments file name
     * 
     * ILC - International and Local Conference
     *
     * @param [array] $data
     * @return void
     */
    public function save_ilc_attachments($data){

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
		$rdlip->insert('tblilc_attachments', $data);
		return $rdlip->affected_rows();
    }

    /**
     * Check if ILC application exists by user id
     * 
     * ILC - Internation and Local Conferences
     *
     * @param [int] $id rd_user_id
     * @return void
     */
    public function verify_ilc_application($id){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblilc_infos');
        $rdlip->where('rd_user_id', $id);
        $query = $rdlip->get()->num_rows();
        return $query;
    }
    
    /**
     * Rretreive ILC info
     *
     * ILC - International and Local Conferences
     * 
     * @param [int] $id rd_user_id
     * @return void
     */
    public function get_ilc_info($id){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblilc_infos');
        $rdlip->where('rd_user_id', $id);
        $query = $rdlip->get()->result();
        return $query;
    }
    
    /**
     * Retreive ILc attachments file name
     * 
     * ILC - Internation and Local Conferences
     *
     * @param [array] $id
     * @return void
     */
    public function get_ilc_attachments($id){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblilc_attachments');
        $rdlip->where('rd_user_id', $id);
        $query = $rdlip->get()->result();
        return $query;
    }

    
    /**
     * Save PUB data
     * 
     * PUB - Publication Grant
     *
     * @param array $data
     * @return void
     */
    public function save_pub_infos($data){

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
		$rdlip->insert('tblpub_infos', $data);
		return $rdlip->affected_rows();
    }

    /**
     * Save PUB attachements file name
     * 
     * PUB - Publication Grant
     *
     * @param array $data
     * @return void
     */
    public function save_pub_attachments($data){

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
		$rdlip->insert('tblpub_attachments', $data);
		return $rdlip->affected_rows();
    }

    /**
     * Check if PUB application exists by user
     *
     * @param [int] $id     pub_user_id
     * @return void
     */
    public function verify_pubgr_application($id){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblpub_infos');
        $rdlip->where('pub_user_id', $id);
        $query = $rdlip->get()->num_rows();
        return $query;
    }
    
    /**
     * Retreive PUB data by user id
     * 
     * PUB - Publication Grant
     *
     * @param [int] $id     pub_user_id
     * @return void
     */
    public function get_pub_info($id){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblpub_infos');
        $rdlip->where('pub_user_id', $id);
        $query = $rdlip->get()->result();
        return $query;
    }
    
    /**
     * Retreive PUB attachments file name
     * 
     * PUB - Publication
     *
     * @param [int] $id
     * @return void
     */
    public function get_pub_attachments($id){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblpub_attachments');
        $rdlip->where('att_user_id', $id);
        $query = $rdlip->get()->result();
        return $query;
    }

    /**
     * Count ILC application
     * 
     * ILC - Internation and Local Conferences
     *
     * @return void
     */
    public function count_ilc(){

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblilc_infos');
        $rdlip->where('rd_status', 0);
        $query = $rdlip->get()->num_rows();
        return $query;
    }

    /**
     * Count PUB application
     * 
     * PUB - Publication Grant
     *
     * @return void
     */
    public function count_pub(){

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from('tblpub_infos');
        $rdlip->where('pub_status', 0);
        $query = $rdlip->get()->num_rows();
        return $query;
    }

    /**
     * Count associate members
     *
     * @param [int] $val
     * @return void
     */
    public function count_asso_member($val){

        $table = ($val == 1) ? 'dbrdlip.tblilc_infos' : 'dbrdlip.tblpub_infos';
        $id = ($val == 1) ? 'a.rd_user_id' : 'a.pub_user_id';

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from($table . ' a');
        $rdlip->join('new_dbskms.tblmembers b', $id . ' = b.mem_usr_id');
        $rdlip->where('b.mem_type', 1);
        $query = $rdlip->get()->num_rows();
        return $query;
    }


    /**
     * Count special provision members
     *
     * @param [int] $val
     * @return void
     */
    public function count_spc_member($val){

        $table = ($val == 1) ? 'dbrdlip.tblilc_infos' : 'dbrdlip.tblpub_infos';
        $id = ($val == 1) ? 'a.rd_user_id' : 'a.pub_user_id';

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from($table . ' a');
        $rdlip->join('new_dbskms.tblmembers b', $id . ' = b.mem_usr_id');
        $rdlip->where('b.mem_type', 2);
        $query = $rdlip->get()->num_rows();
        return $query;
    }

    /**
     * Count regular members
     *
     * @param [int] $val
     * @return void
     */
    public function count_reg_member($val){

        $table = ($val == 1) ? 'dbrdlip.tblilc_infos' : 'dbrdlip.tblpub_infos';
        $id = ($val == 1) ? 'a.rd_user_id' : 'a.pub_user_id';

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from($table . ' a');
        $rdlip->join('new_dbskms.tblmembers b', $id . ' = b.mem_usr_id');
        $rdlip->where('b.mem_type', 3);
        $query = $rdlip->get()->num_rows();
        return $query;
    }

    /**
     * Count honorary members
     *
     * @param [int] $val
     * @return void
     */
    public function count_hon_member($val){

        $table = ($val == 1) ? 'dbrdlip.tblilc_infos' : 'dbrdlip.tblpub_infos';
        $id = ($val == 1) ? 'a.rd_user_id' : 'a.pub_user_id';

        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('*');
        $rdlip->from($table . ' a');
        $rdlip->join('new_dbskms.tblmembers b', $id . ' = b.mem_usr_id');
        $rdlip->where('b.mem_type', 4);
        $query = $rdlip->get()->num_rows();
        return $query;
    }

    /**
     * Retreive all ILC applications
     * 
     * ILC - International and Local Conferences
     *
     * @return void
     */
    public function get_ilc(){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('a.row_id as id, pp_first_name, pp_middle_name, pp_last_name, membership_type_name, a.date_created as date_submitted, mem_type, rd_status, rd_user_id');
        $rdlip->from('tblilc_infos a');
        $rdlip->join('new_dbskms.tblpersonal_profiles b', 'a.rd_user_id = b.pp_usr_id');
        $rdlip->join('new_dbskms.tblmembers c', 'a.rd_user_id = c.mem_usr_id', 'left');
        $rdlip->join('new_dbskms.tblmembership_types d', 'c.mem_type = d.membership_type_id', 'left');
        $query = $rdlip->get()->result();
        return $query;
    }

    /**
     * Retreive all PUB applications
     * 
     * PUB - Publication Grant
     *
     * @return void
     */
    public function get_pub(){
        $CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
		
        $rdlip->select('pp_first_name, pp_middle_name, pp_last_name, membership_type_name, a.date_created as date_submitted, mem_type, pub_status, pub_user_id');
        $rdlip->from('tblpub_infos a');
        $rdlip->join('new_dbskms.tblpersonal_profiles b', 'a.pub_user_id = b.pp_usr_id');
        $rdlip->join('new_dbskms.tblmembers c', 'a.pub_user_id = c.mem_usr_id', 'left');
        $rdlip->join('new_dbskms.tblmembership_types d', 'c.mem_type = d.membership_type_id', 'left');
        $query = $rdlip->get()->result();
        return $query;
    }
    
    /**
     * Retreive ILC data by user id
     * 
     * ILC - International and Local Conferences
     *
     * @param [int] $id     rd_user_id
     * @return void
     */
    public function get_ilc_info_by_id($id){
        $CI =& get_instance();
        $rdlip = $CI->load->database('rdlip', TRUE);
        
        $rdlip->select('e.title_name, concat(b.pp_first_name," ",b.pp_middle_name," ",b.pp_last_name," ",b.pp_extension),
                       b.pp_sex, b.pp_date_of_birth, b.pp_usr_id');
        $rdlip->from('tblilc_infos a');
        $rdlip->join('new_dbskms.tblpersonal_profiles b', 'a.rd_user_id = b.pp_usr_id');
        $rdlip->join('new_dbskms.tblmembers c', 'a.rd_user_id = c.mem_usr_id');
        $rdlip->join('new_dbskms.tblmembership_types d', 'c.mem_type = d.membership_type_id'); 
        $rdlip->join('new_dbskms.tbltitles e', 'b.pp_title = e.title_id'); 
        $rdlip->where('a.rd_user_id', $id);
        $query = $rdlip->get()->result();
        return $query;
    }

    /**
     * Retreive member data by user id
     *
     * @param [int] $id     pp_user_id
     * @return void
     */
    public function get_member_info($id){

        $this->db->select('pp_email, concat(pp_first_name," ",pp_middle_name," ",pp_last_name) as name');
        $this->db->from($this->personal);
        $this->db->where('pp_usr_id', $id);
        $query = $this->db->get()->result();
        return $query;

    }      
}
/* End of file Application_model.php */
