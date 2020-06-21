<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Auth Controller
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Authentication
 * @author		Ajit Rajput 
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Auth extends MY_Controller {
   
    private $data = array();
    
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('auth_mod');
        $this->lang->load('auth', get_site_language());
    }
    
    public function index()
	{
	   $r = $this->auth_mod->get_user_by_id(1);
       print_array($r);
	}
    
    
    // ------------------------------------------------------------------------

    /**
     * Login
     *
     * This function display login page
     * 
     * @access	public
     * @return	html data
     */     
    public function login()
    {die;
        if($this->session->userdata('isLogin') == 'yes')
            redirect(base_url('dashboard'));
            
            
        $data['error_msg'] = NULL;
        
        
        if(isPostBack())
        {
            $r = $this->auth_mod->check_login();
            
            if($r['valid'])
            {
                redirect(base_url('dashboard'));
            }  
                   
            $data['error_msg'] = $r['error_msg'];  
        }   
        
		$this->load->view('login',$data);
    }
    
    // ------------------------------------------------------------------------

    /**
     * Logout
     *
     * This function destroy all saved session
     * 
     * @access	public
     * @return	html data
     */     
    public function logout()
    {
        isProtected();
        $this->session->sess_destroy();
        echo 'Logout!';
    }
    
    
    
    
    // ------------------------------------------------------------------------

    /**    
     *
     * This function generate encyrpted password
     * 
     * @access	public
     * @param   String 
     * @return	String
     */     
    public function enc($str = '')
    {
        $pwd = $this->auth_mod->encode_pwd($str);
        echo $pwd;
    }
    
    
    
    function test()
    {
        $this->db->where("id",300);
        
        $this->db->set("id",300);
        
        $data['username'] = 'ajit';
        
        $this->db->update('users',$data);
        
        echo $this->db->last_query();
    }
    
    
    
    
}