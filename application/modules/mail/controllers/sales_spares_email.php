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

class Sales_spares_email extends MY_Controller {
   
    public $data 			= array();
    public $export_limit 	= NULL;
    public $delete_limit 	= NULL;
    /**
	 * Constructor
	 */ 
    public function __construct()
    {
        // echo mb_decode_mimeheader('=?UTF-8?B?5oiQ6YO95a+M5YW05rqQ5Zu96ZmF6LS45piT5pyJ6ZmQ?= =?UTF-8?B?5YWs5Y+45byA56Wo6LWE5paZLnhsc3g=?=');die;
        parent::__construct();
        isProtected();
        $this->load->library('syncemaillib', 'Sales Spares Email List');
        $this->load->model('mail_mod');
        $this->load->helper('comman');
        $this->lang->load('mail', get_site_language());
        ini_set('max_excecution_time', 900);
        ini_set('memory_limit', '250M');
        $this->data['head']['title'] 	= "Mail";
        $this->data['readonly'] 		= NULL;
        $this->data['country_type']     = 1;
        $this->data['base_url'] 		= base_url("mail/sales_spares_email");
        $this->export_limit 			= $this->config->item('export_limit');
        $this->delete_limit 			= $this->config->item('delete_limit');
        $this->data['table']            = "email_data";
        $this->data['table_doc']        = "email_data_doc";
		$this->data['module'] 			= 'Email';
        $this->data['module_link'] 		= base_url("mail/sales_spares_email")."/list_items";
        // error_reporting(E_ALL);
        // ini_set('display_errors', '1');
    }

    public function index()
    {
        redirect(base_url("mail/sales_spares_email")."/list_items");
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

    public function sync_inbox2()
    {

        $this->syncemaillib->sync_inbox2('inbox');

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

    
 