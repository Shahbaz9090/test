<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Auth Model 
 *
 * @package		Auth
 * @subpackage	Models
 * @category	Authentication * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Auth_mod extends CI_Model {

    var $user_table = "users";
    var $group_table = "user_groups";
    var $site_table = "site";
    var $permission_table = "user_group_permissions";
   
    
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }
    
    // ------------------------------------------------------------------------

    /**
     * Get usrnaeme by id
     *
     * This function get Username if exist
     * 
     * @access	public
     * @param   int - user id
     * @return	string or NULL
     */     
    function get_username_by_id($id = NULL)
    {
        $this->db->select("username");
        $this->db->where("id",$id);
        $query = $this->db->get($this->user_table);
        if($query->num_rows() > 0)
            return $query->row()->username;
        return NULL;
    }
    
    /**
     * Get Permission Data by group id
     * 
     * @access	public
     * @param   int - group id
     * @return	array - mixed
     */     
    function get_permission_by_group_id($group_id = NULL)
    {
        $this->db->select("data");
        $this->db->where("group_id",$group_id);
        $query = $this->db->get($this->permission_table);
        
        $data = array();
        
        if($query->num_rows() > 0)
        {
            $data = unserialize($query->row()->data);
        }
        return $data;
    }
    
    // ------------------------------------------------------------------------

    /**
     * Get User By Id
     *
     * This function get user details filtered by id
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */     
    function get_user_by_id($id = NULL)
    {
        $this->db->select($this->user_table.' .*'); //Select user table
        $this->db->select($this->group_table.'.name as group_name'); // select user group name
        $this->db->select($this->group_table.'.site_id');   // select user gourp site id     
        $this->db->select($this->site_table.'.language');   // select user gourp site language 
        
        $this->db->from($this->user_table);
        $this->db->join($this->group_table, "$this->user_table.group_id = $this->group_table.id");
        $this->db->join($this->site_table, "$this->site_table.id = $this->group_table.site_id");
                
        $this->db->where("$this->user_table.id",$id);
        $query = $this->db->get();
        
        //echo $this->db->last_query();
        
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            $row->parent_user = $this->get_username_by_id($row->id);
            $row->permission  = $this->get_permission_by_group_id($row->group_id);
            return $row;
        }
        return FALSE;
    }
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Group Users
     *
     * This function get all Group Users filtered by group_id
     * 
     * @access	public
     * @param   int - group id
     * @return	mixed Array 
     */     
    function get_group_users($group_id = NULL)
    {
        $this->db->where('group_id',$group_id);
        $query = $this->db->get($this->table);
        
        return $query->results();
    }
    
    
    // ------------------------------------------------------------------------

    /**
     * Insert User
     *
     * This function insert user details
     * 
     * @access	public
     * @param   mixed Array
     * @return	int - id - primary key 
     */     
    function insert_user($data = array())
    {
        $this->db->insert($this->table,$data);
        return $this->db->insert_id();
    }
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Check Login
     *
     * This function check user valid or not 
     * 
     * @access	public
     * @return	mixed   array contains
     */     
    function check_login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        $username = $this->input->post('username',TRUE);
        $password = $this->input->post('password',TRUE);
        
        if ($this->form_validation->run() == FALSE)
        {
            $data['error_msg'] = validation_errors();
            $data['valid'] = FALSE;            
            return $data;
        } 
        
        $this->db->where("username",$username);
        $query = $this->db->get($this->user_table);


        
        if($query->num_rows() > 0)
        {
           $row = $query->row();
           
           if($password == $this->decode_pwd($row->password))
           {
               $user_info = $this->get_user_by_id($row->id);
               
               unset($user_info->password);
               
               $user_info->last_login = strtotime('now');
               
               $this->session->set_userdata("language",$user_info->language);
               $this->session->set_userdata("userinfo",$user_info);
               $this->session->set_userdata("isLogin",'yes');
               
               $data['valid'] = TRUE;
               return $data;    
           }           
        }
        
        $data['error_msg'] = lang('error_login');
        $data['valid'] = FALSE;
        return $data;
    }
    
    
    
    
    
    // ------------------------------------------------------------------------

    /**
     *
     * This function Encode password 
     * 
     * @access	public
     * @param   String   plain string
     * @return	String   encrypted string
     */     
    public function encode_pwd($str = '')
    {
        $this->load->library('encrypt');        
        $encrypted_pwd = $this->encrypt->encode($str);
        return $encrypted_pwd;
    }
    
    // ------------------------------------------------------------------------

    /**
     *
     * This function Decode encrypted password 
     * 
     * @access	public
     * @param   String   encrypted string
     * @return	String   plain string
     */     
    public function decode_pwd($str = '')
    {
        $this->load->library('encrypt');
        $plaintext_string = $this->encrypt->decode($str);
        return $plaintext_string;
    }
    
}