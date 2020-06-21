<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		Rookie
 * @subpackage	Models
 * @category	Account * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class User_group_mod extends CI_Model
 {

   
	public $groups                 = "user_groups";
 	public $users                  = "users";
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
        
        
        
    }
    
   //----------------------------------------------------------------------------------
     /**
     * Get USer Groups
     *
     * This function Get Groups
     * 
     * @access	public
     * @return	int 
     */     
     
     
     function get_groups()
     {
		$this->db->select('*,name as group_name');
        $this->db->where("site_id",current_site_id());
		$this->db->where("status","active");
        $query =$this->db->get("$this->groups");
        return $query->result();
     }
     
     
     
     //----------------------------------------------------------------------------------
     /**
     * Get User
     *
     * This function Get User by Group ID
     * 
     * @access	public
     * @return	int 
     */     
     
     
     function get_users($group_id =NULL)
     {
        if(is_array($group_id) && !empty($group_id))
        {
            $this->db->where_in("group_id",$group_id);

        }
        else
        {

            $this->db->where("group_id",$group_id);
        }
	 
		$this->db->where("status","active");
        //$this->db->select("id,first_name,last_name",TRUE);
        $query =$this->db->get("$this->users");
        return $query->result();
     }
    
  
    
}
    
    