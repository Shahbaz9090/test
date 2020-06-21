<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Install * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Install extends MY_Controller {
   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
       
        $this->load->model('install_mod');
        $this->data['head']['title'] = "Install";
                   
    }
    
    
    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function add new Candidate
     * 
     * @access	public
     * @return	html data
     */
	public function index()
	{       
	   $is_super_site =$this->install_mod->is_super_site();
       if(!$is_super_site)
	   $data    = $this->install_mod->add();
       
       redirect(base_url("auth/login"));
	}
    
    // ------------------------------------------------------------------------


    
    
}