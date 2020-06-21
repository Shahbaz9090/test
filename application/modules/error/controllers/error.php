<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Company * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Error extends MY_Controller {
   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
        isProtected();
        $this->lang->load('error', get_site_language());
               
        $this->data['head']['title'] = "Error";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("error");

        
    }
    
    
    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function add new Company
     * 
     * @access	public
     * @return	html data
     */
	public function permission_denied()
	{
	   $views[] = "permission_denied";
       view_load($views,$this->data);
	}   
 
}