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
 
class Authorisation_mod extends CI_Model {
  
    var $table = "site";
    var $user_table = "users";
    var $group_table = "user_groups";
       
    var $permission_table = "user_group_permissions";

	var $per_page = "per_page";
   
    
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }    

	function list_items($offset=0,$perpage=20,$type=0,$keyword=null){
		$user=currentuserinfo();
		$site_id=$user->site_id;
		$this->db->select("SQL_CALC_FOUND_ROWS $this->user_table .*",FALSE);
		$this->db->where("site_id","$site_id");
		$this->db->where("login_type","$type");
        
        if($keyword != null)
        {
            $this->db->like("concat(lower(first_name),lower(last_name),lower(email))",$keyword);
        }
		$this->db->limit($perpage,$offset);

		$queryData=$this->db->get($this->user_table);
		$data["result"]=array();
		if($queryData->num_rows >0){
			$data["result"] = $queryData->result();
		}
		$query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
		return $data;
	}
    
	function update(){
		$login_type=$this->input->post("login_type",true);
		$multiple=$this->input->post("multi_update",true);
		$users_id=$this->input->post("users_id",true);
		$static_ip=$this->input->post("static_ip",true);

		$this->form_validation->set_rules('login_type', "Login type", 'trim|required');
		$this->form_validation->set_rules('users_id', "Users", "trim|required");
        
		if($login_type==1){
			$this->form_validation->set_rules('static_ip', "Static IP", "trim|required");
		}
		if($login_type==2){
			$this->form_validation->set_rules('ip', "IP", "trim|required");
		}
		$return["error"]=false;
		$return["response"]=false;
		if ($this->form_validation->run() == FALSE)
        {
			$return["error"]=validation_errors();
			$return["response"]=false;
			return $return;
        }
		$users=explode(",",$users_id);
		foreach($users as $key=>$row){
			$data=array(
				'login_type'=>$login_type,
				'static_ip'=>$static_ip
				);
				$this->db->where("$this->user_table.id",$row);
				$r = $this->db->update($this->user_table,$data);
		}
		$return["response"]=true;
		return $return;
  }
		

}