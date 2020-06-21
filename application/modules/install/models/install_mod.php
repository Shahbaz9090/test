<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		Rookie
 * @subpackage	Models
 * @category	Install * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Install_mod extends CI_Model {

  
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
        $this->load->library('email');
    }
    
    // ------------------------------------------------------------------------

    /**
     * Add Default Site
     *
     * This function Add a New Candidate
     * 
     * @access	public
     * @return	mixed Array 
     */     
    function add()
    {
        
       $this->db->trans_start();
       $email                   = "prabhakar@tekshapers.com";
        
       $site["added_by"]        =  0;
       $site["last_ip"]         =  current_ip();
       $site["created_time"]    =  current_date();
       $site["name"]            =  "Tekshapers Software Solution";
       $site["email"]           =  $email;
       $site["description"]     =  "Super Site";
       $site["website"]         =  "http://www.tekshapers.com";
       $site["language"]        =  "english";
       $site["status"]          =  "active";
       $site["status_comment"]  =  "Default Super Site";
       $site["is_super"]        =  1;
       
       
       $this->db->insert("site",$site);
       $site_id =$this->db->insert_id();
        
       
       $group['site_id']         = $site_id;
       $group['added_by']        = 0;
       $group['last_ip']         = current_ip();
       $group['created_time']    = current_date();
       $group['name']            = "Super Group";
       $group['description']     = "Super Group OF Tekshapers Software";
       $group['status']          = "active";
       $group['is_super']        = 1;
       
       $this->db->insert("user_groups",$group);
       $group_id =$this->db->insert_id();
       
       $password                 = '123456';//rand();
      
       $users['site_id']         = $site_id;
       $users['added_by']        = 0;
       $users['last_ip']         = current_ip();
       $users['created_time']    = current_date();
       $users['group_id']        = $group_id;
       $users['parent_user_id']  = 0;
       $users['first_name']      = "admin";
       $users['last_name']       = "admin";
       $users['password']        = md5($password);
       $users['email']           = $email;
       $users['status']          = "active";
       $users['status_comment']  = "Super User";
       
       $this->db->insert("users",$users);
                 
       $this->db->trans_complete();
       
       $this->_send_email($email,$password);
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Check Super Site
     *
     * This function check SuperSite
     * 
     * @access	public
     * @return	mixed Array 
     */   
    
    function is_super_site()
    {
        
        $this->db->where('is_super',1);
        $query = $this->db->get("site");
        
        if($query->num_rows() > 0)
        return TRUE;
        
        return FALSE;
    }
    
    
    
    private function _send_email($email = NULL,$password =NULL)
    {
       
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = TRUE;
        $config['mailtype'] = 'html';
        
        $this->email->initialize($config);

        $this->email->from('info@e-rookie.com', 'E-Rookie');
        $this->email->to($email);
        
        $this->email->subject("Super Site has Been Created Sucessfully");
        $this->email->message("<h2>Use the following details for Login</h2><br/>
                               Email id:$email <br/>
                               password: $password <br /> ");

        $this->email->send();
    
    }
    
    
    
    
}
    // ------------------------------------------------------------------------
