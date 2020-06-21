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

class Sales_pcb_order extends MY_Controller {
   
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
        $this->load->library('order_lib', [$this, 'Sales PCB Order List', 3] );
        $this->lang->load('order', get_site_language());
        $this->data['title'] 	        = "Sales PCB Order";
        $this->data['title_for_view']   = "Sales PCB";
        $this->data['readonly'] 		= NULL;
        $this->data['sales_enquiry_url']= base_url('enquiry/sales_pcb_enquiry_china');
        $this->data['base_url'] 		= base_url("order/sales_pcb_order/");
        $this->data['module_url'] 		= base_url("order/sales_pcb_order/");
        $this->data['table_name']       = "order";
		$this->data['module'] 			= 'Order';
    }
    
	public function list_items()
	{  

		$this->order_lib->list_items();

	}
    
    public function add()
    {
    	$this->order_lib->add($this->data['table_name']);
    }

	public function edit($id)
    {
        $this->order_lib->edit( $id, $this->data['table_name'] );
    }

    public function check_all_fields_unq()
    {
        $this->order_lib->check_all_fields_unq();
    }
    
    public function check_enquiry_no()
    {
        $this->order_lib->check_enquiry_no();
    }
    
    public function quotation_print($id = NULL)
	{	
        
		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->quotation_print($id);
	   
	}

	public function view($id = NULL)
	{	

		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->view($id);
	   
	}
	
    public function add_product($id = NULL)
	{	
		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->add_product($id);
	   
	}

	public function edit_product($id, $enquiry_id)
	{	
		if(!$id && !$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->edit_product($id, $enquiry_id);
	}

    public function delete_product($product_id, $enquiry_id)
    {   
        if(!$enquiry_id && !$product_id)
        {
            redirect($this->data['module_url'].'/view/'.$enquiry_id);
        }
        $this->order_lib->delete_product($product_id, $enquiry_id);
    }

	public function edit_product_china($id, $enquiry_id)
    {   
        if(!$id && !$enquiry_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->order_lib->edit_product_china($id, $enquiry_id);
    }

    public function add_po_product($order_id)
	{	
		if(!$order_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->add_po_product($order_id);
	   
	}

	public function edit_po_product($product_id, $enquiry_id)
	{	
		if(!$product_id && !$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->edit_po_product($product_id, $enquiry_id);
	}

	public function edit_quotation($id, $product_id, $enquiry_id)
    {   
        if(!$id && !$product_id && !$enquiry_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->order_lib->edit_quotation($id, $product_id, $enquiry_id);
    }

    public function edit_offer($product_id, $order_id)
    {   
        if(!$product_id && !$order_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->order_lib->edit_offer($product_id, $order_id);
    }

    public function delete_quotation($quotation_id, $enquiry_id)
    {   
        if(!$id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->order_lib->delete_quotation($quotation_id, $enquiry_id);
    }
    
	public function add_document($enquiry_id = NULL)
	{	
		if(!$enquiry_id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$this->order_lib->add_document($enquiry_id);
	}

	public function delete_document()
	{	
		
		$this->order_lib->delete_document();
	}
	
	public function release_quotation()
	{	
		
		$this->order_lib->release_quotation();
	}
	
    public function received_product($order_id)
    {   
        $this->order_lib->received_product($order_id);
    }
    
    public function release_final_quotation()
	{	
		
		$this->order_lib->release_final_quotation();
	}
	
    public function ajax_list_items($limit = 10)
	{	

		$this->order_lib->ajax_list_items($limit);
	}
    
    public function delete($id)
    {
    	if(!$id)
		{
			set_flashdata('error', 'Record could not be deleted..');
			redirect($this->data['base_url'].'/list_items/');
		}
		$this->order_lib->delete($id);
    }
		
    public function status($id = null) 
    {

        $this->order_lib->status($id);

    }

    public function delete_records()
    {

        $this->order_lib->delete_records();
    }

	public function get_dependent_data()
    {

        $this->order_lib->get_dependent_data();
    }
  	
  	public function get_product_detail()
    {
        $this->order_lib->get_product_detail();
    }

  	public function add_more_email($enquiry)
    {
        if(!isset($enquiry) || empty($enquiry))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->order_lib->add_more_email($enquiry);
    }
    
  	public function doc_download($id = NULL, $recID)
    {
        if(!isset($id) || empty($id))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->order_lib->doc_download($id);
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
        
        $this->order_lib->download_supplier_sheet($id);
    }
    
    public function create_supplier_po($id)
    {
        if(!isset($id) || empty($id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$id);
        }
        
        $this->order_lib->create_supplier_po($id);
    }
    
    public function download_supplier_po($id, $po_nos)
    {
        if(!isset($id) || empty($id))
        {
            set_flashdata('error', "Order ID missing");
            redirect($this->data['module_url'].'/view/'.$id);
        }
        
        $this->order_lib->download_supplier_po($id, $po_nos);
    }
    
    public function freeze_quotation($enquiry_id)
    {
        if(!isset($enquiry_id) || empty($enquiry_id))
        {
            set_flashdata('error', "Enquiry ID missing");
            redirect($this->data['module_url'].'/view/'.$enquiry_id);
        }
        
        $this->order_lib->freeze_quotation($enquiry_id);
    }
    
    public function get_venders()
    {
        $this->order_lib->get_venders();
    }
    
    public function get_vender_type()
    {
        $this->order_lib->get_vender_type();
    }

    /*Chat system*/
    public function get_ticket_message_chat() {
        $this->order_lib->get_ticket_message_chat();
    }

    public function add_chat(){
        $this->order_lib->add_chat();
    }

    public function tickets_logs() {
        $this->order_lib->tickets_logs();
    }
    
    public function reply_on_ticket() {
        $this->order_lib->reply_on_ticket();
    }
    
    public function ticket_refresh() {
        $this->order_lib->ticket_refresh();
    }
    /*Chat system*/
    
    
}

    
 