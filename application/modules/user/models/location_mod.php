<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Location_mod extends CI_Model {  
    
	var $company_location="company_areas";
   
    
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    } 

	 function set_location($id){
		$this->form_validation->set_rules('country_id', "Country", 'trim|required');
		$this->form_validation->set_rules('area_name', "Company area", "trim|required");

		$return["error"]=false;
		$return["response"]=false;
		if ($this->form_validation->run() == FALSE)
        {
			$return["error"]=validation_errors();
			$return["response"]=false;
			return $return;
        }
		
		$userinfo=currentuserinfo();
		
		$check=$this->db->get_where($this->company_location,array("site_id"=>$userinfo->site_id,"area_name"=>$this->input->post("area_name"),"country_id"=>$this->input->post("country_id")));
		if($check->num_rows >0){
			if($id!=$check->row()->id){
				$return["error"]="This location is already exist";
				$return["response"]=false;
				return $return;
			}
		}
		$data["country_id"]=$this->input->post("country_id");
		$data["area_name"]=$this->input->post("area_name");
		if($id!=null){
			$this->db->where("id",$id);  
			$this->db->update($this->company_location,$data);  
			$return["response"]="2";
		}else{
			set_common_insert_value();
			$this->db->insert($this->company_location,$data);           
			$id = $this->db->insert_id();
			$return["response"]="1";
		}
		
		return $return;

	 }

	 function company_location_list(){
		 $userinfo=currentuserinfo();
		 $this->db->where("site_id",$userinfo->site_id);
		 $result = $this->db->get($this->company_location);
		 if($result->num_rows > 0){
			 return $result->result();
		 }
		return false;

	 }

	 function get_location($id=null){
		 $result=$this->db->get_where($this->company_location,array("id"=>$id));
		 if($result->num_rows > 0){
			 return $result->row();
		 }
		 return false;

	 }
    
    
}
