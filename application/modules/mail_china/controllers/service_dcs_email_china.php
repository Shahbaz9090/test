<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Company
 * @author		Pradeep Kumar
 * @website		http://www.techbuddieit.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Service_dcs_email_china extends MY_Controller {
   
    public $data 			= array();
    public $export_limit 	= NULL;
    public $delete_limit 	= NULL;
    /**
	 * Constructor
	 */ 
    public function __construct()
    {
        parent::__construct();
        isProtected();
        $this->load->library('syncemaillib', 'Service DCS Email List');
        $this->load->model('mail_mod');
        $this->load->helper('comman');
        ini_set('max_excecution_time', 900);
        ini_set('memory_limit', '250M');
        $this->data['head']['title'] 	= "Mail";
        $this->data['readonly'] 		= NULL;
        $this->data['country_type']     = 2;
        $this->data['base_url'] 		= base_url("mail_china/service_dcs_email_china");
        $this->export_limit 			= $this->config->item('export_limit');
        $this->delete_limit 			= $this->config->item('delete_limit');
        $this->data['table']            = "email_data_china";
        $this->data['table_doc']        = "email_data_doc_china";
		$this->data['module'] 			= 'Email';
        $this->data['module_link'] 		= base_url("mail_china/service_dcs_email_china")."/list_items";
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
    }
    
	public function list_items()
    {  
        $this->syncemaillib->list_items('inbox');

    }
    
    public function inbox()
    {
        redirect($this->data['module_link']);
    }
    
    public function sent()
    {  
        //pr('yess');die;
        $this->syncemaillib->list_items('sent');
    }
    
	public function outbox()
    {  
        $this->syncemaillib->list_items('outbox');
    }
    
    public function draft()
    {
        $this->syncemaillib->list_items('draft');
    }
    
    public function view($id = NULL)
	{	

		$this->syncemaillib->view($id);
	   
	}

    public function reply($id)
    {
    	$this->syncemaillib->reply($id);
    }
	
	public function reply_all($id)
    {
    	$this->syncemaillib->reply_all($id);
    }
	
    public function forword($id='')
    {

    	$this->syncemaillib->forword($id);

    }

    public function compose_email($msg_type='inbox')
    {

        $this->syncemaillib->compose_email($msg_type);

    }

    public function add_mail_tags($msg_type='inbox')
    {

        $this->syncemaillib->add_mail_tags($msg_type);

    }
    
    public function sync_inbox()
    {

        $this->syncemaillib->sync_inbox('inbox');

    }

    public function sync_sent()
    {

        $this->syncemaillib->sync_inbox('sent');

    }

    public function ajax_list_items($limit = 10)
	{	

		$this->syncemaillib->ajax_list_items($limit);

	}
    
    public function export()
    {

       	$this->syncemaillib->export();

    }
    
    public function delete()
    {

    	$this->syncemaillib->delete();

    }
		
    public function delete_records()
    {

        $this->syncemaillib->delete_records();

    }
        
    public function status($id = null) 
    {

        $this->syncemaillib->status($id);

    }

    public function uploadDoc($file_arr) 
    {

    	$this->syncemaillib->uploadDoc($file_arr);

    }
	public function get_mail_list() 
    {

        $this->syncemaillib->get_mail_list();

    }
    
	public function addNote() 
    {
		$this->syncemaillib->addNote();

    }
   
   public function release() 
    {
		$this->syncemaillib->release();

    }
    
	public function unrelease() 
    {
		$this->syncemaillib->unrelease();

    } 	
    
    public function download($id)
    {
        $this->syncemaillib->download($id);

    }
}

    
 