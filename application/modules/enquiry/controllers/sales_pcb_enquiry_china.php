<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter sales_governing_enquiry_china Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Sales_spares_enquiry_china
 * @author		Pradeep Kumar
 * @website		http://www.techbuddieit.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Sales_pcb_enquiry_china extends MY_Controller {
   
    public $data 			= array();
    public $export_limit 	= NULL;
    public $delete_limit 	= NULL;
    public $add_url         = NULL;
    /**
	 * Constructor
	 */ 
    public function __construct()
    {
        parent::__construct();
        isProtected();
        define('TBL_PREFIX', 'inch_');
        define('PRIMARY_KEY', 'form_id');
        $this->load->helper('comman');
        $this->lang->load('enquiry', get_site_language());
        $this->export_limit 			= $this->config->item('export_limit');
        $this->delete_limit 			= $this->config->item('delete_limit');
        $this->data['title'] 	        = "Sales PCB Enquiry";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("enquiry/sales_pcb_enquiry_china/");
        $this->data['module_url'] 		= base_url("enquiry/sales_pcb_enquiry_china/");
        $this->data['table_name']       = "enquiry";
		$this->data['module'] 			= 'Enquiry';
        $this->load->library('enquiry_china_lib', [$this, 'Sales PCB List', 3] );
    }
    
	public function list_items()
	{  

		$this->enquiry_china_lib->list_items();

	}
    
    public function add()
    {
        // $this->enquiry_china_lib->dynamic_add($this->table_name);
        $this->enquiry_china_lib->add($this->data['table_name']);
    }

    public function edit($id)
    {
        $own_all_array = $this->session->userdata('permission');
        $all_edit = array_key_exists('all_edit',$own_all_array)?true:false;
        $this->enquiry_china_lib->check_own_permission( $id,$this->data['table_name'],$all_edit);
        // $this->enquiry_china_lib->dynamic_edit( $id, $this->table_name );
        $this->enquiry_china_lib->edit( $id, $this->data['table_name'] );
    }
    
    public function check_all_fields_unq()
    {
        $this->enquiry_china_lib->check_all_fields_unq();
    }

    public function check_enquiry_no()
    {
        $this->enquiry_china_lib->check_enquiry_no();
    }

    public function get_dependent_data()
    {

        $this->enquiry_china_lib->get_dependent_data();
    }
    
    public function quotation_print($id = NULL)
    {   
        
        if(!$id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->enquiry_china_lib->check_custom_permission($id,$this->data['table_name']);
        $action = "print";
        $this->enquiry_china_lib->quotation_print($id,$action);
       
    }

    public function quotation_download($id = NULL)
    {   
        
        if(!$id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->enquiry_china_lib->check_custom_permission($id,$this->data['table_name']);
        $action = "download";
        $this->enquiry_china_lib->quotation_print($id,$action);
       
    }

	public function view($id = NULL)
	{	

		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->enquiry_china_lib->view($id);
	   
	}
	
    public function add_product($id = NULL)
	{	
		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
        $this->enquiry_china_lib->check_custom_permission($id,$this->data['table_name']);
		$this->enquiry_china_lib->add_product($id);
	   
	}

	public function edit_product($id, $enquiry_id, $type=NULL)
    {   
        if(!$id && !$enquiry_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        if(isset($type) && $type =='china')
        {
            $this->enquiry_china_lib->check_custom_permission($enquiry_id,$this->data['table_name']);
            $this->enquiry_china_lib->edit_product_china($id, $enquiry_id);
        }
        else
        {
            $this->enquiry_china_lib->check_custom_permission($enquiry_id,$this->data['table_name']);
            $this->enquiry_china_lib->edit_product($id, $enquiry_id);
        }
    }

    public function delete_product($product_id, $enquiry_id)
    {   
        if(!$enquiry_id && !$product_id)
        {
            redirect($this->data['module_url'].'/view/'.$enquiry_id);
        }
        $this->enquiry_china_lib->check_custom_permission($enquiry_id,$this->data['table_name']);
        $this->enquiry_china_lib->delete_product($product_id, $enquiry_id);
    }
    
	public function add_quotation($product_id, $enquiry_id)
	{	
		if(!$product_id && $enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
        $this->enquiry_china_lib->check_custom_permission($enquiry_id,$this->data['table_name']);
		$this->enquiry_china_lib->add_quotation($product_id, $enquiry_id);
	   
	}

	public function edit_quotation($id, $product_id, $enquiry_id)
	{	
		if(!$id && !$product_id && !$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->enquiry_china_lib->edit_quotation($id, $product_id, $enquiry_id);
	}
	
	public function add_document($enquiry_id = NULL)
	{	
		if(!$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->enquiry_china_lib->add_document($enquiry_id);
	}

	public function delete_document()
	{	
		
		$this->enquiry_china_lib->delete_document();
	}
	
	public function release_quotation()
	{	
		
		$this->enquiry_china_lib->release_quotation();
	}
	
    public function release_final_quotation()
	{	
		
		$this->enquiry_china_lib->release_final_quotation();
	}
	
    public function ajax_list_items($limit = 10)
	{	

		$this->enquiry_china_lib->ajax_list_items($limit);
	}
    
    public function delete($id)
    {
    	if(!$id)
		{
			set_flashdata('error', 'Record could not be deleted..');
			redirect($this->data['module_url'].'/list_items/');
		}
        $own_all_array = $this->session->userdata('permission');
        $all_edit = array_key_exists('all_delete',$own_all_array)?true:false;
        $this->enquiry_china_lib->check_own_permission( $id,$this->data['table_name'],$all_edit);
		$this->enquiry_china_lib->delete($id);
    }
		
    public function status($id = null) 
    {

        $this->enquiry_china_lib->status($id);

    }

    public function delete_records()
    {

        $this->enquiry_china_lib->delete_records();
    }

  	
  	public function get_product_detail()
    {
        $this->enquiry_china_lib->get_product_detail();
    }
  	
  	public function doc_download($id = NULL, $recID)
    {
        if(!isset($id) || empty($id))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->enquiry_china_lib->doc_download($id);
        if(!$status)
        {
            set_flashdata('error', 'File Not Found');
            redirect($this->data['module_url'].'/view/'.$recID);
        }
    }
    
    public function add_more_email($enquiry)
    {
        if(!isset($enquiry) || empty($enquiry))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->enquiry_china_lib->add_more_email($enquiry,3);//second parameter is for enquiry type
    }

    public function download_supplier_sheet($id)
    {
        if(!isset($id) || empty($id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$id);
        }
        
        $this->enquiry_china_lib->download_supplier_sheet($id);
    }

    public function freeze_quotation($enquiry_id)
    {
        if(!isset($enquiry_id) || empty($enquiry_id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$enquiry_id);
        }
        
        $this->enquiry_china_lib->freeze_quotation($enquiry_id);
    }
    
    public function get_vender_type()
    {
        $this->enquiry_china_lib->get_vender_type();
    }
    
    public function get_venders()
    {
        $this->enquiry_china_lib->get_venders();
    }

    /*Chat system*/
    public function get_ticket_message_chat() {
        $this->enquiry_china_lib->get_ticket_message_chat();
    }

    public function add_chat(){
        $this->enquiry_china_lib->add_chat();
    }

    public function tickets_logs() {
        $this->enquiry_china_lib->tickets_logs();
    }
    
    public function reply_on_ticket() {
        $this->enquiry_china_lib->reply_on_ticket();
    }
    
    public function ticket_refresh() {
        $this->enquiry_china_lib->ticket_refresh();
    }
    /*Chat system*/
    //======check email ids=========//
    public function check_email_id()
    {
        $this->enquiry_china_lib->check_email_id();
    }
    //======check email ids=========//
    public function edit_offer($quotation_id, $product_id, $enquiry_id)
    {   
        if(!$quotation_id && !$product_id && !$enquiry_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->enquiry_china_lib->edit_offer($quotation_id, $product_id, $enquiry_id);
    }

    public function view_email($email_id,$type)
    {
        if($type == 1)
        {
            redirect(base_url().'mail/sales_pcb_email/view/'.$email_id);
        }
        else
        {
            redirect(base_url().'mail/sales_pcb_email_china/view/'.$email_id);
        }
    }

    public function export()
     {
        $this->load->library('export_lib');
        $search_keyword  = $this->input->get_post('search_keyword');
        $checkbox_id  = $this->input->get_post('checkbox_id');
        $checkbox_id     = str_replace("row","",$checkbox_id);       
        $checkbox      = explode(",",$checkbox_id);
        $is_export = true;
        if(empty($checkbox_id)){
            $checkbox='';
        }
        //pr($checkbox_id);die;
        //pr($items);die;
        $result = $this->enquiry_china_mod->get_enquiry_list($this->type,null,null,null,null,$checkbox,$search_keyword, $is_export);
        //pr($result);die;
        
        $result =$result['result'];
        //pr($result);die;
        $table_columns = ["enq_no"=>"Enq. No.","client_name"=>"Client Name","internal_subject"=>"Internal Subject", "from_client"=>"From Client", "inch_name"=>"Inch Engineer", "cfit_name"=>"CFIT Engineer", "status_name"=>"India Status", "china_status_name"=>"China Status", "to_cfit"=>"Inch", "from_cfit"=>"CFIT", "to_client"=>"To Client"];
        $filename = "Sales PCB enquiry China-" . date('dmYhis'). ".xls";
        //pr($table_columns);
        //pr($filename);
        //pr($result);die;
        $this->export_lib->export($table_columns, $result, $filename); 
     }
}

    
 