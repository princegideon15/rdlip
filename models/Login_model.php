<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    private $users = 'tblusers';
    private $personal = 'tblpersonal_profiles';

	public function __construct() {
		parent::__construct();
		$this->load->database(ENVIRONMENT);
	}

	/**
	 * Authenticate login credentials of a member account
	 *
	 * @param   string  $user  usr_name
	 *
	 * @return  array         user data
	 */
	public function authenticate_user($user) {

		$this->db->select('usr_password, tblusers.usr_id, pp_first_name, pp_last_name, usr_status_id');
        $this->db->from($this->users);
		$this->db->join($this->personal, 'tblusers.usr_id = pp_usr_id');
		$this->db->where('usr_grp_id', 3);
		$this->db->where('usr_name', $user);
		$query = $this->db->get();
		return $query->result();
	}

	/**
	 * Authenticate login credentials of an admin account
	 *
	 * @param [string] $user		usr_username
	 * @return void
	 */
	public function authenticate_admin($user) {

		$CI =& get_instance();
		$rdlip = $CI->load->database('rdlip', TRUE);
	
		$rdlip->select('*');
        $rdlip->from('tblusers');
		$rdlip->where('usr_username', $user);
		$query = $rdlip->get();
		return $query->result();

		// select pp_last_name, pp_first_name, pp_middle_name, 
		// mem_type, membership_type_name, mem_status, membership_status_name, mem_div_id, div_number
		// emp_pos, city_name, province_name, region_name, 
		// mpr_google_scholar_url, mpr_h_index,
		// pup_title, proj_title
		// from tblmembers m
		// join tblpersonal_profiles p on m.mem_usr_id = p.pp_usr_id
		// join tblemployments e on m.mem_usr_id = e.emp_usr_id
		// join tblpublication_profiles pp on m.mem_usr_id = pp.pup_usr_id
		// join tblproject_profiles pr on m.mem_usr_id = pr.proj_usr_id
		// join tblmembership_types mt on m.mem_type = mt.membership_type_id
		// join tblmembership_profiles mp on m.mem_usr_id = mp.mpr_usr_id
		// join tblmembership_status ms on m.mem_status = ms.membership_status_id
		// join tblusers u on m.mem_usr_id = u.usr_id 
		// left join tblprovinces v on e.emp_province = v.province_id
		// left join tblcities c on e.emp_province = c.city_id
		// left join tblregions r on e.emp_province = r.region_id
		// join tbldivisions d on m.mem_div_id = d.div_id
		// where u.usr_grp_id like 3
		// order by pp_last_name;

	//   select *,tblmembers.date_created as date_created
    //   from tblpersonal_profiles
    //   left join tblsex on tblsex.s_id = tblpersonal_profiles.pp_sex
    //   left join tblresidence_address on tblresidence_address.adr_usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tblcities on tblcities.city_id = tblresidence_address.adr_city
    //   left join tblprovinces on tblprovinces.province_id = tblresidence_address.adr_province
    //   left join tblregions on tblregions.region_id = tblresidence_address.adr_region
    //   left join tblcountries on tblcountries.country_id = tblresidence_address.adr_country
    //   left join tblmembership_applications on tblmembership_applications.mapl_usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tblmembership_types on tblmembership_types.membership_type_id = tblmembership_applications.mapl_type  
    //   inner join tblusers on tblusers.usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tblmembers on tblmembers.mem_usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tbldivisions on tbldivisions.div_id = tblmembers.mem_div_id 
    //   left join tbldivision_sections on tbldivision_sections.ds_id = tblmembers.mem_div_section_id
    //   left join tblmembership_profiles on tblmembership_profiles.mpr_usr_id = tblpersonal_profiles.pp_usr_id
	//   left join tblmembership_status on tblmembership_status.membership_status_id = tblmembers.mem_status
	//   where usr_grp_id like 3; 
	//   5064

	//   select *,tblmembers.date_created as date_created
    //   from tblpersonal_profiles
    //   left join tblsex on tblsex.s_id = tblpersonal_profiles.pp_sex
    //   left join tblresidence_address on tblresidence_address.adr_usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tblcities on tblcities.city_id = tblresidence_address.adr_city
    //   left join tblprovinces on tblprovinces.province_id = tblresidence_address.adr_province
    //   left join tblregions on tblregions.region_id = tblresidence_address.adr_region
    //   left join tblcountries on tblcountries.country_id = tblresidence_address.adr_country
    //   left join tblmembership_applications on tblmembership_applications.mapl_usr_id = tblpersonal_profiles.pp_usr_id 
    //   inner join tblusers on tblusers.usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tblmembers on tblmembers.mem_usr_id = tblpersonal_profiles.pp_usr_id
    //   left join tbldivisions on tbldivisions.div_id = tblmembers.mem_div_id 
    //   left join tbldivision_sections on tbldivision_sections.ds_id = tblmembers.mem_div_section_id
    //   left join tblmembership_profiles on tblmembership_profiles.mpr_usr_id = tblpersonal_profiles.pp_usr_id
	//   left join tblmembership_status on tblmembership_status.membership_status_id = tblmembers.mem_status
    //   left join tblmembership_types on tblmembership_types.membership_type_id = tblmembers.mem_type  
	//   where usr_grp_id like 3;
	//   5064

		
	//   select * from tblpersonal_profiles 
	//   left join tblmembers on tblpersonal_profiles.pp_usr_id = tblmembers.mem_usr_id 
	//   left join tblproject_profiles on tblpersonal_profiles.pp_usr_id = tblproject_profiles.proj_usr_id 
	//   inner join tblusers on tblusers.usr_id = tblpersonal_profiles.pp_usr_id 
	//   where tblusers.usr_grp_id = 3;
	//   projects

	//   select * from tblpersonal_profiles 
	//   left join tblmembers on tblpersonal_profiles.pp_usr_id = tblmembers.mem_usr_id 
	//   left join tblpublication_profiles on tblpersonal_profiles.pp_usr_id = tblpublication_profiles.pup_usr_id 
	//   inner join tblusers on tblusers.usr_id = tblpersonal_profiles.pp_usr_id 
	//   where tblusers.usr_grp_id = 3;
	//   google scholar

	// select * from tblpersonal_profiles 
	//   left join tblmembers on tblpersonal_profiles.pp_usr_id = tblmembers.mem_usr_id 
	//   left join tblpublication_profiles on tblpersonal_profiles.pp_usr_id = tblpublication_profiles.pup_usr_id 
	//   left join tblproject_profiles on tblpersonal_profiles.pp_usr_id = tblproject_profiles.proj_usr_id 
	//   inner join tblusers on tblusers.usr_id = tblpersonal_profiles.pp_usr_id 
	//   where tblusers.usr_grp_id = 3;
	// project and publication
	}
	
}

/* End of file Login_model.php */
