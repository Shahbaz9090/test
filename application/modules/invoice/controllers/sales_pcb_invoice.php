<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter sales_pcb_order Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	sales_pcb_order
 * @author		Pradeep Kumar
 * @website		http://www.techbuddieit.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Sales_pcb_invoice extends MY_Controller {
   
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
        ini_set('memory_limit', '-1');
        isProtected();
        define('PRIMARY_KEY', 'form_id');
        $this->load->library('invoice_lib', [$this, 'Sales PCB Invoice List', 3] );
        $this->lang->load('invoice', get_site_language());
        $this->data['title'] 	        = "Sales Spares Invoice";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("invoice/sales_pcb_invoice/");
        $this->data['module_url'] 		= base_url("invoice/sales_pcb_invoice/");
        $this->data['table_name']       = "invoice";
		$this->data['module'] 			= 'Invoice';
    }
    
	public function list_items()
	{  

		$this->invoice_lib->list_items();

	}
    
    public function add()
    {
    	$this->invoice_lib->add($this->data['table_name']);
    }

	public function edit($id)
    {
        $this->invoice_lib->edit( $id, $this->data['table_name'] );
    }

    public function check_all_fields_unq()
    {
        $this->invoice_lib->check_all_fields_unq();
    }
    
    public function check_enquiry_no()
    {
        $this->invoice_lib->check_enquiry_no();
    }
    
    public function quotation_print($id = NULL)
	{	
        
		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->quotation_print($id);
	   
	}

	public function view($id = NULL)
	{	

		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->view($id);
	   
	}
	
    public function add_product($id = NULL)
	{	
		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->add_product($id);
	   
	}

	public function edit_product($id, $enquiry_id)
	{	
		if(!$id && !$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->edit_product($id, $enquiry_id);
	}

    public function delete_product($product_id, $enquiry_id)
    {   
        if(!$enquiry_id && !$product_id)
        {
            redirect($this->data['module_url'].'/view/'.$enquiry_id);
        }
        $this->invoice_lib->delete_product($product_id, $enquiry_id);
    }

	public function edit_product_china($id, $enquiry_id)
    {   
        if(!$id && !$enquiry_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->invoice_lib->edit_product_china($id, $enquiry_id);
    }

    public function add_po_product($order_id)
	{	
		if(!$order_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->add_po_product($order_id);
	   
	}

	public function edit_po_product($product_id, $enquiry_id)
	{	
		if(!$product_id && !$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->edit_po_product($product_id, $enquiry_id);
	}

	public function edit_quotation($id, $product_id, $enquiry_id)
    {   
        if(!$id && !$product_id && !$enquiry_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->invoice_lib->edit_quotation($id, $product_id, $enquiry_id);
    }

    public function edit_offer($product_id, $order_id)
    {   
        if(!$product_id && !$order_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->invoice_lib->edit_offer($product_id, $order_id);
    }

    public function delete_quotation($quotation_id, $enquiry_id)
    {   
        if(!$id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->invoice_lib->delete_quotation($quotation_id, $enquiry_id);
    }
    
	public function add_document($enquiry_id = NULL)
	{	
		if(!$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->invoice_lib->add_document($enquiry_id);
	}

	public function delete_document()
	{	
		
		$this->invoice_lib->delete_document();
	}
	
	public function release_quotation()
	{	
		
		$this->invoice_lib->release_quotation();
	}
	
    public function received_product($order_id)
    {   
        $this->invoice_lib->received_product($order_id);
    }
    
    public function release_final_quotation()
	{	
		
		$this->invoice_lib->release_final_quotation();
	}
	
    public function ajax_list_items($limit = 10)
	{	

		$this->invoice_lib->ajax_list_items($limit);
	}
    
    public function delete($id)
    {
    	if(!$id)
		{
			set_flashdata('error', 'Record could not be deleted..');
			redirect($this->data['base_url'].'/list_items/');
		}
		$this->invoice_lib->delete($id);
    }
		
    public function status($id = null) 
    {

        $this->invoice_lib->status($id);

    }

    public function delete_records()
    {

        $this->invoice_lib->delete_records();
    }

	public function get_dependent_data()
    {

        $this->invoice_lib->get_dependent_data();
    }
  	
  	public function get_product_detail()
    {
        $this->invoice_lib->get_product_detail();
    }

  	public function add_more_email($enquiry)
    {
        if(!isset($enquiry) || empty($enquiry))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->invoice_lib->add_more_email($enquiry);
    }
    
  	public function doc_download($id = NULL, $recID)
    {
        if(!isset($id) || empty($id))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->invoice_lib->doc_download($id);
        if(!$status)
        {
            set_flashdata('error', 'File Not Found');
            redirect($this->data['module_url'].'/view/'.$recID);
        }
    }
    
    public function download_supplier_sheet($id)
    {
        if(!isset($id) || empty($id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$id);
        }
        
        $this->invoice_lib->download_supplier_sheet($id);
    }
    
    public function create_supplier_po($id)
    {
        if(!isset($id) || empty($id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$id);
        }
        
        $this->invoice_lib->create_supplier_po($id);
    }
    
    public function download_supplier_po($id, $po_nos)
    {
        if(!isset($id) || empty($id))
        {
            set_flashdata('error', "Order ID missing");
            redirect($this->data['module_url'].'/view/'.$id);
        }
        
        $this->invoice_lib->download_supplier_po($id, $po_nos);
    }
    
    public function freeze_quotation($enquiry_id)
    {
        if(!isset($enquiry_id) || empty($enquiry_id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$enquiry_id);
        }
        
        $this->invoice_lib->freeze_quotation($enquiry_id);
    }
    
    public function get_vender_type()
    {
        $this->invoice_lib->get_vender_type();
    }

    /*Chat system*/
    public function get_ticket_message_chat() {
        $this->invoice_lib->get_ticket_message_chat();
    }

    public function add_chat(){
        $this->invoice_lib->add_chat();
    }

    public function tickets_logs() {
        $this->invoice_lib->tickets_logs();
    }
    
    public function reply_on_ticket() {
        $this->invoice_lib->reply_on_ticket();
    }
    
    public function ticket_refresh() {
        $this->invoice_lib->ticket_refresh();
    }
    /*Chat system*/
    
    
}

    
 