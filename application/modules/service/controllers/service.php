<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Sales_spares_order Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Sales_spares_order
 * @author		Pradeep Kumar
 * @website		http://www.techbuddieit.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Service extends MY_Controller {
   
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
        $this->data['module']           = 'Service';
        $this->lang->load('order', get_site_language());
        $this->data['title'] 	        = "Sales Spares Order";
        $this->data['title_for_view']   = "Sales Spare";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("service/");
        $this->load->library('form_module_lib', $this->data['base_url']);
        $this->load->model('service_mod');
        $this->data['module_url'] 		= base_url("service/");
        $this->data['sales_enquiry_url']= base_url("enquiry/sales_spares_enquiry_china/");;
        $this->data['table_name']       = "service";
		
    }
    
	public function list_items()
	{  
		$this->order_lib->list_items();
	}
    
    public function add()
    {
    	$this->form_module_lib->dynamic_add($this->data['table_name']);
    }

	public function edit($id)
    {
        $this->order_lib->edit( $id, $this->data['table_name'] );
    }

    public function check_all_fields_unq()
    {
        $this->form_module_lib->check_all_fields_unq();
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
		if(isPostBack())
        {
            // pr($_POST);die;
            if(isset($_POST['status_id']))
            {
                $status_id = $this->input->post('status_id');
                $status = $this->service_mod->change_po_status($status_id, $id);
            }
            // elseif(isset($_POST['status_id_china']))
            // {
            //     $status_id = $this->input->post('status_id_china');
            //     $product_id = $this->input->post('product_id');
            //     $whose = 'china';
            //      $status = $this->service_mod->change_po_status($status_id, $whose, $product_id);
            // }
            elseif(isset($_POST['change_cfit_name']))
            {
                $cfit_id = $this->input->post('cfit_id');
                $status = $this->service_mod->change_cfit_name($cfit_id, $id);
            }
            
            if($status)
            {
                set_flashdata('success',' Status changed successfully.');
                return redirect($this->data['module_url'].'/view/'.$id);
            }
        }
        $this->data['action']          = "view";
        $response = $this->service_mod->get_service_list($id, '', '', '');
        // pr($response);die;
        $this->data['result']          = $response['result'][0];
        /*$this->data['data_list']   = $response['result'];*/
        if(isset($this->data['result']) && !empty($this->data['result']) && !empty($this->data['result']->client_contact))
        {
            // $client_contact_id = $this->data['result']->client_contact;
            // pr($client_contact_id);die;
            // $client_contact_id = explode(",", $client_contact_id);
            // $client_contact_list = $this->service_mod->get_client_contact_list($client_contact_id);
            // $this->data['client_contact_list'] = $client_contact_list;
        }
        $this->data['add_product_title'] = lang('sales_spare_add_product_title').' '.$this->data['result']->enq_no;
        $this->data['edit_product_title'] = lang('sales_spare_edit_product_title').' '.$this->data['result']->enq_no;
        $this->data['add_quotation_title'] = lang('sales_spare_add_quotation_title').' '.$this->data['result']->enq_no;
        $this->data['title']           = $this->data['title_for_view'].' Order ['.$this->data['result']->enq_no.']';
        $this->data['enq_title']       = $this->data['title_for_view'].' Enquiry ['.$this->data['result']->enq_no.']';
        $this->data['enq_id']          = $this->data['result']->enq_id;
        $this->data['enq_url']         = $this->data['sales_enquiry_url'];
        $this->data['product_list']    = $this->service_mod->get_product_list(NULL, $id);
        $this->data['payment_list']    = $this->service_mod->get_payment_list($id);
        $this->data['internal_notes']  = $this->service_mod->get_internal_notes($id);
        $this->data['pbg_details']     = $this->service_mod->get_pbg_details($id);
        $this->data['offer_list']      = $this->service_mod->get_offer_list(NULL, $id);
        $this->data['price_calc_list'] = $this->service_mod->get_price_calc(NULL, $id);
        $this->data['document_list']   = $this->service_mod->get_document_list(NULL, $id);
        $this->data['offer_revision_list']   = $this->service_mod->get_offer_revision_list($id);
        $mails                              = $this->service_mod->get_mail_list($this->data['result']->mail_no, $this->data['result']->china_mail_no);
        $mail_list          = $mails['india_mail_list'];
        $china_mail_list    = $mails['china_mail_list'];
        $user_sess  = currentuserinfo();
        $user_id    = $user_sess->id;
        $user_name  = $user_sess->first_name.' '.$user_sess->last_name;
        $this->data['user_id']             = $user_id;
        $this->data['user_name']           = $user_name;
        $this->data['mail_lists']          = @$mail_list['mail_list'];
        $this->data['attachments']         = @$mail_list['mail_doc'];
        $this->data['china_mail_lists']    = @$china_mail_list['mail_list'];
        $this->data['china_attachments']   = @$china_mail_list['mail_doc'];
        $views[]                           = "view_order"; 
        $this->data['unit_master']         = get_uom_from_master();
        $this->data['supplier_master']     = get_supplier_from_master();
        $this->data['order_status_india_master'] = get_order_status_india_master();
        $this->data['po_status']                 = get_po_status();
        $this->data['order_status_china_master'] = get_order_status_china_master();
        $this->data['china_employee_master']     = get_china_employee_master();
        $this->data['total_supplier_po']         = get_supplier_po($order_id);
        // $this->data['name'] = $this->get_module();
        $this->data['submodule'] = 'View '.$this->data["name"]->module_title;
        // pr($this->data);die;
        view_report($order_id);
        view_load($views,$this->data);
	   
	}
	

    public function add_more_email($service)
    {
        if(!isset($service) || empty($service))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        // $this->service_mod->add_more_email($service);//function to be created
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
    

    public function add_payment_details($order_id)
    {
        $this->order_lib->add_dynamic_details($order_id,'payment_details');
    }


    public function edit_payment_details($id,$order_id)
    {
        $form = "payment_details";
        $this->order_lib->edit_dynamic_details($id,$order_id,$form);
    }

    public function delete_payment_details($id,$order_id)
    {
        $this->order_lib->delete_dynamic($id,$order_id,'payment_details');
    }

    public function get_dynamic_edit_form()
    {
        $this->order_lib->get_dynamic_edit_form();
    }

    public function get_dynamic_form()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->get('order_id');
            $form = $this->input->get('form');
            $form_data['form_data']= $this->form_module_lib->dynamic_add($form,true);
            $form_data['action_url']= $this->data['base_url'].'/add_'.$form.'/'.$id;
            $form_data['module_url']= $this->data['module_url'];
            $form_data['is_modal_view'] = true;
            // pr($form_data);die;
            $this->load->view("dynamic_view/add_form",$form_data);
        }
    }
    
    public function add_service_internal_note($id)
    {
        $_POST['service_id'] = $id;//set order id for joining tables
        $dynamic_redirect = false;
        $this->form_module_lib->dynamic_add('service_internal_note','',$dynamic_redirect);
        redirect($this->data['module_url'].'/view/'.$order_id);
    }

    public function edit_pbg_details($id,$order_id)
    {
        $form = "pbg_details";
        $this->order_lib->edit_dynamic_details($id,$order_id,$form);
    }


    public function delete_pbg_details($id,$order_id)
    {
        $form = "pbg_details";
        $this->order_lib->delete_dynamic($id,$order_id,$form);
    }

    public function add_abg_details($order_id)
    {
        $this->order_lib->add_dynamic_details($order_id,'abg_details');
    }

    public function edit_abg_details($id,$order_id)
    {
        $form = "abg_details";
        $this->order_lib->edit_dynamic_details($id,$order_id,$form);
    }

    public function delete_abg_details($id,$order_id)
    {
        $form = "abg_details";
        $this->order_lib->delete_dynamic($id,$order_id,$form);
    }

    public function get_hsn_tax()
    {
        $this->order_lib->get_hsn_tax();
    }

    public function get_products_list()
    {
        $this->order_lib->get_products_list();
    }

    public function add_contract_india()
    {
        $this->order_lib->add_contract_india();
    }

    public function add_contract_china()
    {
        $this->order_lib->add_contract_china();
    }

    public function get_supplier_contact()
    {
        $this->order_lib->get_supplier_contact();
    }
}

    
 