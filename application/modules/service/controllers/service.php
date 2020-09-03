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
        $this->data['title'] 	        = "Service Enquiry";
        $this->data['title_for_view']   = "Sales Spare";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("service/");
        $this->load->library('form_module_lib', $this->data['base_url']);
        // $this->load->library('order_lib', $this->data['base_url']);
        $this->load->model('service_mod');
        $this->load->model('job_mod');
        $this->data['module_url'] 		= base_url("service/");
        $this->data['sales_enquiry_url']= base_url("enquiry/sales_spares_enquiry_china/");;
        $this->data['table_name']       = "service";
		
    }
    
	public function list_items()
	{  
		$config['base_url']     = $this->data['base_url']."/list_items/";
        $config['per_page']     = PERPAGE;
        $config["uri_segment"]  = 4;
        if( count($_GET) > 0 )
        {
            $query_string_url               = '?'.http_build_query($_GET, '', "&");
            $config['enable_query_string']  = TRUE;
            $config['suffix']               = $query_string_url;
            $config['first_url']            = $config["base_url"].$config['suffix'];
        }
        $config['full_tag_open']    = '<ul class="pagination pagination-sm">';
        $config['full_tag_close']   = '</ul>';
        $config['first_link']       = FALSE;
        $config['last_link']        = FALSE;
        $config['first_tag_open']   = '<li>';
        $config['first_tag_close']  = '</li>';
        $config['prev_link']        = '&laquo;';
        $config['prev_tag_open']    = '<li class="prev">';
        $config['prev_tag_close']   = '</li>';
        $config['next_link']        = '&raquo;';
        $config['next_tag_open']    = '<li>';
        $config['next_tag_close']   = '</li>';
        $config['last_tag_open']    = '<li>';
        $config['last_tag_close']   = '</li>';
        $config['cur_tag_open']     = '<li class="active"><a href="#">';
        $config['cur_tag_close']    = '</a></li>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $page                       = $this->uri->segment(4) ? $this->uri->segment(4) : 0;
        $data['total_pages']        = $page;
        $response                   = $this->service_mod->get_service_list('', '', PERPAGE, $page);
        $this->data['data_list']    = $response['result'];
        $this->data['total_record'] = $response['total'];
        $config['total_rows']       = $response['total'];
        // pr($response);die;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $this->data['pagination_link'] = $this->pagination->create_links();
        /*Pagination*/
        $this->data['place_holder']    = "Enter filter terms here";        
        $this->data['action']          = "list";
        $this->data['module']          = "Service Enquiry";//for breadcrumb
        $views[]                       = "service_list";
        // pr($this->data);die;
        view_load($views, $this->data);
	}
    
    public function add()
    {
        $this->data['module'] = "Service Enquiry";
    	$this->form_module_lib->dynamic_add($this->data['table_name'],'',false);
    }

	public function edit($id)
    {
        $this->form_module_lib->dynamic_edit($id, $this->data['table_name']);
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
        $this->data['result']          = $response['result'][0];
        $this->data['no_of_delivery_challans']    = $this->service_mod->get_delivery_challan_no($id);
        $this->data['internal_notes']  = $this->service_mod->get_internal_notes($id);
        $job_cards                     = $this->job_mod->get_job_list('','','','',$id);
        $this->data['job_cards']       = isset($job_cards) && !empty($job_cards)?$job_cards['result']:'';
        $estimations                   = $this->service_mod->get_estimation($id);
        if(isset($estimations) && !empty($estimations))
        {
            foreach ($estimations as $key=>$estimation)
            {
                $job_name          = $estimation->inquiry_no.'-'.$estimation->job_sequence;
                $components        = $this->job_mod->get_store_issue($job_name);
                $components_cost = 0;
                foreach($components as $component)
                {
                    $components_cost += $component->total;
                }
                $estimations[$key]->components_cost_act = $components_cost;
            }
        }
        $this->data['estimation']           = $estimations;
        $this->data['total_revision_offer'] = $this->service_mod->get_revisions_offer($id);
        $this->data['payment_list']         = $this->service_mod->get_payment_list($id);
        $this->data['invoice_list']         = $this->service_mod->get_invoice_list($id);
        $this->data['document_list']        = $this->service_mod->get_document_list(NULL, $id);
        $this->data['offer_revision_list']  = $this->service_mod->get_offer_revision_list($id);
        $mails                              = $this->service_mod->get_mail_list($this->data['result']->mail_no, $this->data['result']->china_mail_no);
        $mail_list                         = $mails['india_mail_list'];
        $china_mail_list                   = $mails['china_mail_list'];
        $user_sess                         = currentuserinfo();
        $user_id                           = $user_sess->id;
        $user_name                         = $user_sess->first_name.' '.$user_sess->last_name;
        $this->data['user_id']             = $user_id;
        $this->data['user_name']           = $user_name;
        $this->data['mail_lists']          = @$mail_list['mail_list'];
        $this->data['attachments']         = @$mail_list['mail_doc'];
        $this->data['china_mail_lists']    = @$china_mail_list['mail_list'];
        $this->data['china_attachments']   = @$china_mail_list['mail_doc'];
        $this->data['module']              = "Service Enquiry";//for breadcrumb
        $this->data['submodule']           = 'View '.$this->data['module'];
        $this->data['title']               = 'View '.$this->data['module'];
        $views[]                           = "view_service"; 
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

    public function add_offer($id = NULL)
	{	
		if(!$id)
		{
			redirect($this->data['module_url'].'/list_items');
		}
		$status = $this->service_mod->add_offer($id);
        if($status)
        {
            set_flashdata('success',' Offer added successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$id);
	   
	}

    public function edit_offer($service_id = NULL)
    {   
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->service_mod->edit_offer($service_id);
        if($status)
        {
            set_flashdata('success',' Offer edited successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$service_id);
       
    }

	public function freeze_offer($service_id)
	{	
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->service_mod->freeze_offer($service_id);
        if($status)
        {
            set_flashdata('success',' Offer freezed successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$service_id);
		
	} 


    public function unfreeze_offer($service_id)
    {   
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->service_mod->unfreeze_offer($service_id);
        if($status)
        {
            set_flashdata('success',' Offer un-freezed successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$service_id);
        
    }

    public function download_offer($service_id = null)
    {   
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items/');
        }
        $response = $this->service_mod->get_service_list($service_id, '', '', '');
        $this->data['result']        = $response['result'][0];
        $this->data['offer_list']    = $this->service_mod->get_offer_details($service_id);
        $views                       = "service_offer"; 
        $this->load->view($views, $this->data);
    }
    
    public function add_payment_details_service($service_id)
    {
        // $this->order_lib->check_custom_permission($service_id,$this->data['table_name']);
        if($service_id)
        {
            $_POST['service_id'] = $service_id;
            $dynamic_redirect = false;
            $this->form_module_lib->dynamic_add("payment_details_service",'',$dynamic_redirect);
        }
        set_flashdata('error','Something went wrong,Please try again!!!');
        redirect($_SERVER['HTTP_REFERER']);
    }


    public function edit_payment_details_service($id,$service_id)
    {
        // $this->order_lib->check_custom_permission($service_id,$this->data['table_name']);
        if($service_id)
        {
            $form = "payment_details_service";
            $dynamic_redirect = false;
            $this->form_module_lib->dynamic_edit($id,$form,'',$dynamic_redirect);
        }
        set_flashdata('error','Something went wrong,Please try again!!!');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function delete_payment_details_service($id,$service_id)
    {
        // $this->order_lib->check_custom_permission($service_id,$this->data['table_name']);
        if($service_id && $id)
        {
            $form = "payment_details_service";
           $this->db->where_in('form_id', $id);
            $status = $this->db->delete(TBL_PREFIX.$form);
            if($status)
            {
                set_flashdata('success','Record deleted successfully!');
            }
            else
            {
                set_flashdata('error','Something went wrong,Please try again!');    
            }
        }
        set_flashdata('error','Something went wrong,Please try again!!!');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function create_delivery_challan($service_id = null)
    {   
        $ids = $this->input->get('job_id');
        if(!$ids)
        {
            set_flashdata('error','Something went wrong, Please try again!!!');
            redirect($this->data['module_url'].'/view/'.$service_id);
        }
        $status = $this->service_mod->create_delivery_challan($ids,$service_id);
        if($status)
        {
            set_flashdata('success','Job card added to delivery challan!!!');
        }
        else
        {
            set_flashdata('error','Something went wrong,Please try again!!!');
        }
        redirect($this->data['module_url'].'/view/'.$service_id);
       
    }

    public function add_delivery_box($id = NULL)
    {   
        if(!$id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->service_mod->add_delivery_box($id);
        if($status)
        {
            set_flashdata('success','Box added to delivery challan!!!');
        }
        else
        {
            set_flashdata('error','Something went wrong,Please try again!!!');
        }
        return redirect($this->data['module_url'].'/view/'.$id);
       
    }

    public function delete_box($id = NULL,$service_id = NULL)
    {   
        if(!$id && !$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->service_mod->delete_box($id,$service_id);
        return redirect($this->data['module_url'].'/view/'.$service_id);
       
    }

    public function delete_challan($service_id = NULL)
    {   
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $this->service_mod->delete_challan($service_id);
        return redirect($this->data['module_url'].'/view/'.$service_id);
       
    }


    public function download_delivery_challan($service_id = null, $challan=null)
    {   
        if(!$challan)
        {
            redirect($this->data['module_url'].'/view/'.$service_id);
        }
        $this->data['challan_details'] = $this->service_mod->get_challan_data($service_id,$challan);
        $views                         = "delivery_packing_list"; 
        $this->load->view($views, $this->data);
    }
    
	public function create_invoice($service_id = NULL)
	{	
		if(isPostBack())
        {
            $status = $this->service_mod->add_invoice($service_id);
            if($status)
            {
                set_flashdata('success','Invoice created successfully!!!');
                redirect($this->data['module_url'].'/view/'.$service_id);
            }
            else
            {
                set_flashdata('error','Invoice not added,Please try again!!!');
            }
        }
        $job_id                         = $this->input->get('job_ids');
        $this->data['title']            = "Add";
        $this->data['service_id']       = $service_id;
        $this->data['contact_person']   = $this->service_mod->get_contact_person($service_id);
        $this->data['consignee']        = $this->service_mod->get_client_name();
        $this->data['shipment_company'] = get_shipment_company();
        $this->data['taxable_value']    =  $this->service_mod->get_job_costs_for_invoice($service_id,$job_id);
        $views[]                        = "add_invoice";
        $this->data['unit_master']      = get_uom_from_master();
        // pr($this->data['unit_master']);die;
        view_load($views,$this->data);
	}

    public function fetch_data_according_company()
    {
        if($this->input->is_ajax_request())
        {
            $company_id = $this->input->get_post('company_id');
            $data = $this->service_mod->fetch_data_according_company($company_id);
            if($data['status'] == 'success')
            {
                echo json_encode($data['result']);
            }
        }
    }

    public function fetch_contact_according_company()
    {
        if($this->input->is_ajax_request())
        {
            $company_id = $this->input->get_post('company_id');
            $data = $this->service_mod->fetch_contact_according_company($company_id);
            echo $data;
        }
    }
	
    public function edit_invoice($id = NULL ,$service_id = NULL)
    {   
        if(isPostBack())
        {
            $status = $this->service_mod->edit_invoice($id,$service_id);
            if($status)
            {
                set_flashdata('success','Invoice updated successfully!!!');
                redirect($this->data['module_url'].'/view/'.$service_id);
            }
            else
            {
                set_flashdata('error','Invoice not updated,Please try again!!!');
            }
        }
        $this->data['title']            = "Update";
        $this->data['service_id']       = $service_id;
        $this->data['invoice_detail']   = $this->service_mod->get_invoice_list($service_id,$id);
        $this->data['contact_person']   = $this->service_mod->get_contact_person($service_id);
        $this->data['consignee']        = $this->service_mod->get_client_name();
        $this->data['shipment_company'] = get_shipment_company();
        $this->data['taxable_value']    =  $this->service_mod->get_job_costs_for_invoice($service_id,$this->data['invoice_detail']->job_id);
        $views[]                        = "add_invoice";
        $this->data['unit_master']      = get_uom_from_master();
        // pr($this->data['invoice_detail']);die;
        view_load($views,$this->data);
    }
	
    public function freeze_invoice($service_id)
    {   
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->service_mod->freeze_invoice($service_id);
        if($status)
        {
            set_flashdata('success',' Invoice freezed successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$service_id);
        
    }
    
    public function dispatch_invoice($service_id)
	{	
		
		if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items');
        }
        $status = $this->service_mod->dispatch_invoice($service_id);
        if($status)
        {
            set_flashdata('success',' Invoice dispatched successfully.');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$service_id);
	}
	
    public function delete_invoice($id,$service_id)
    {
    	if(!$id || !$service_id)
		{
			set_flashdata('error', 'Record could not be deleted..');
			redirect($this->data['base_url'].'/list_items/');
		}
		$status = $this->service_mod->delete_invoice($id,$service_id);
        if($status)
        {
            set_flashdata('success',' Invoice deleted successfully!!!');
        }
        else
        {
            set_flashdata('error',' Something went wrong,Please try again.');
        }
        return redirect($this->data['module_url'].'/view/'.$service_id);
    }
		
    public function invoice_print($service_id = null)
    {   
        if(!$service_id)
        {
            redirect($this->data['module_url'].'/list_items/');
        }
        $this->data['invoice_detail'] = $this->service_mod->get_invoice_details($service_id);
        $this->data['job_details']    = $this->service_mod->get_job_details($service_id);
        // pr($this->data['invoice_detail']);die;
        //title & other info
        $this->data['title']      = 'Inch Digital Technologies Pvt. Ltd.';
        $this->data['email']      = 'sales.technologies@inchgroup.co.in';
        $this->data['website']    = 'www.inchgroup.co.in/energy';
        $this->data['cin']        = 'U29307HR2017PTC070634';
        $this->data['gst']        = '06AAECI6178C1ZN';
        $this->data['pan']        = 'AAECI6178C';
        $this->data['msme']       = 'HR05A0008820';
        $this->data['account_no'] = '37985141267';
        $views                    = "view_invoice"; 
        $this->load->view($views, $this->data);
    }

    public function delete_records()
    {
        $this->order_lib->delete_records();
    }

	public function get_dependent_data()
    {

        $this->form_module_lib->get_dependent_data();
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
    


    public function get_dynamic_edit_form()
    {
        if($this->input->is_ajax_request())
        {
            $order_id = $this->input->get('order_id');
            $id = $this->input->get('id');
            $form = $this->input->get('form');
            $dynamic_redirect = false;
            $form_data = $this->form_module_lib->dynamic_edit($id,$form,true,$dynamic_redirect);
            $form_data['is_modal_view'] = true;
            $form_data['module_url']= $this->data['module_url'];
            $form_data['action_url']    = $this->data['base_url'].'/edit_'.$form.'/'.$id.'/'.$order_id;
            $this->load->view("dynamic_view/edit_form",$form_data);
        }
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

    
 