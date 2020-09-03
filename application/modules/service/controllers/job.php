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

class Job extends MY_Controller {
   
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
        $this->data['module']           = 'Job';
        $this->lang->load('order', get_site_language());
        $this->data['title'] 	        = "Job Card";
        $this->data['title_for_view']   = "Sales Spare";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("service/job");
        $this->load->library('form_module_lib', $this->data['base_url']);
        $this->load->model('job_mod');
        $this->load->model('order/order_mod');
        $this->data['module_url'] 		= base_url("service/job");
        $this->data['table_name']       = "job_card_details";
		
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
        $response                   = $this->job_mod->get_job_list('', '', PERPAGE, $page);
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
        $this->data['module']          = "Job Card";//for breadcrumb
        $views[]                       = "job_list";
        // pr($this->data);die;
        view_load($views, $this->data);
	}
    
    public function add()
    {
        $this->data['module'] = "Job Card";
    	$this->form_module_lib->dynamic_add($this->data['table_name']);
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
                $status    = $this->job_mod->change_job_status($status_id, $id);
            }
            elseif(isset($_POST['change_cfit_name']))
            {
                $cfit_id = $this->input->post('cfit_id');
                $status = $this->job_mod->change_cfit_name($cfit_id, $id);
            }
            
            if($status)
            {
                set_flashdata('success',' Status changed successfully.');
                return redirect($this->data['module_url'].'/view/'.$id);
            }
        }
        $this->data['action']          = "view";
        $response = $this->job_mod->get_job_list($id, '', '', '');
        // pr($response);die;
        $this->data['result']          = $response['result'][0];
        /*$this->data['data_list']   = $response['result'];*/
        if(isset($this->data['result']) && !empty($this->data['result']) && !empty($this->data['result']->inquiry_no))
        {
            $job_name                      = $this->data['result']->inquiry_no.'-'.$this->data['result']->job_sequence;
            $this->data['store_issue_list']= $this->job_mod->get_store_issue($job_name);
        }
        $this->data['contract']            = $this->job_mod->get_contract($id);
        $this->data['in_out_details']      = $this->job_mod->get_in_out_details($id,'');
        $this->data['job_estimation']      = $this->job_mod->get_job_estimation($id);
        $this->data['store_requirements']  = $this->job_mod->get_store_requirements($id);
        $this->data['job_status']          = $this->job_mod->get_job_status();
        $this->data['additional_assign']   = $this->job_mod->get_additional_assign($id);
        $this->data['internal_notes']      = $this->job_mod->get_internal_notes($id);
        $this->data['document_list']       = $this->job_mod->get_document_list(NULL, $id);
        $mails                             = $this->job_mod->get_mail_list($this->data['result']->mail_no, $this->data['result']->china_mail_no);
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
        $this->data['module']          = "Job Card";//for breadcrumb
        $this->data['submodule']       = 'View '.$this->data['module'];
        $this->data['title']           = 'View '.$this->data['module'];
        $views[]                       = "view_job"; 
        // pr($this->data['contract']);die;
        view_report($order_id);
        view_load($views,$this->data);
	   
	}
	
    public function get_dependent_data()
    {

        $this->form_module_lib->get_dependent_data();
    }

    public function add_more_email($service)
    {
        if(!isset($service) || empty($service))
        {
            redirect($this->data['module_url'].'/list_items');
        }
        // $this->job_mod->add_more_email($service);//function to be created
    }

    public function add_estimation($job_id)
    {

        if(isPostBack())
        {
            $status = $this->job_mod->add_estimation($job_id);
            if($status)
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']       = "add";
        $this->data['title']        = 'Add Estimation';
        $views[]                    = "add_estimation";
        $this->data['submodule']    = 'Add Estimation';
        $job_details                = $this->job_mod->get_job_list($job_id);
        $this->data['job_details']  = isset($job_details['result'][0]) && !empty($job_details['result'][0])?$job_details['result'][0]:'';
        // pr($this->data);die;
        view_load($views, $this->data);
    }

    public function edit_estimation($job_id,$id)
    {

        if(isPostBack())
        {
            $status = $this->job_mod->edit_estimation($job_id,$id);
            if($status)
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']       = "add";
        $this->data['title']        = 'Edit Estimation';
        $views[]                    = "edit_estimation";
        $this->data['submodule']    = 'Edit Estimation';
        $this->data['estimation']   = $this->job_mod->get_job_estimation($job_id);
        $job_details                = $this->job_mod->get_job_list($job_id);
        $this->data['job_details']  = isset($job_details['result'][0]) && !empty($job_details['result'][0])?$job_details['result'][0]:'';
        // pr($this->data);die;
        view_load($views, $this->data);
    }

    public function add_in_out($job_id)
    {

        if(isPostBack())
        {
            $status = $this->job_mod->add_in_out($job_id);
            redirect($this->data['module_url']."/view/".$job_id);
        }
        $this->data['action']       = "add";
        $this->data['title']        = 'Add In/Out Details';
        $views[]                    = "add_in_out_details";
        $this->data['submodule']    = 'Add In/Out Details';
        $this->data['employee_list']= $this->job_mod->get_employee_list();
        // $this->data['job_details']  = isset($job_details['result'][0]) && !empty($job_details['result'][0])?$job_details['result'][0]:'';
        view_load($views, $this->data);
    }

    public function add_in_detail($id,$job_id)
    {
        if((isset($id) && !empty($id)) && (isset($job_id) && !empty($job_id)))
        {
            $status = $this->job_mod->add_in_detail($id,$job_id);
            redirect($this->data['module_url']."/view/".$job_id);
        }
        redirect($this->data['module_url']."/list_items");
    }

    public function edit_in_out_details($id,$job_id)
    {

        if(isPostBack())
        {
            $status = $this->job_mod->edit_in_out($id,$job_id);
            if($status)
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']       = "add";
        $this->data['title']        = 'Edit In/Out Details';
        $views[]                    = "edit_in_out_details";
        $this->data['submodule']    = 'Edit In/Out Details';
        $this->data['employee_list']= $this->job_mod->get_employee_list();
        $in_out_detail              = $this->job_mod->get_in_out_details($job_id,$id);
        $this->data['in_out_detail']= isset($in_out_detail[0]) && !empty($in_out_detail[0])?$in_out_detail[0]:'';
        // $this->data['job_details']  = isset($job_details['result'][0]) && !empty($job_details['result'][0])?$job_details['result'][0]:'';
        view_load($views, $this->data);
    }

    public function delete_in_out_details($id,$job_id)
    {   
        $this->job_mod->delete_in_out($id, $job_id);
        redirect($this->data['module_url']."/view/".$job_id);
    }



    public function add_requirements($job_id)
	{	
		if(isPostBack())
        {
            $status = $this->job_mod->add_requirements($job_id);
            if(!$status['validation_errors'])
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']       = "add";
        $this->data['btn_title']    = 'Add';
        $this->data['title']        = 'Add Store Requirements';
        $this->data['submodule']    = 'Add Store Requirements';
        $this->data['upc_list']     = $this->job_mod->get_upc_list();
        $views[]                    = "add_store_requirements";
        view_load($views, $this->data);
	   
	}

	public function get_product_details()
	{	
		$product_id = $this->input->post('product_id');
        if($product_id)
        {
	      $data = $this->job_mod->get_digital_product_details($product_id);
          if(isset($data) && !empty($data))
          {
            echo json_encode($data);die; 
          }
        }
        echo json_encode(['error'=>'Something went wrong, Please try again']);
	}

    public function edit_store_requirements($id,$job_id)
    {   
        if(isPostBack())
        {
            $status = $this->job_mod->edit_requirements($id,$job_id);
            if(!$status['validation_errors'])
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']       = "add";
        $this->data['btn_title']    = 'Update';
        $this->data['title']        = 'Edit Store Requirements';
        $this->data['submodule']    = 'Edit Store Requirements';
        $this->data['store_req']    = $this->job_mod->get_store_requirements($job_id,$id)[0];
        $this->data['upc_list']     = $this->job_mod->get_upc_list();
        $views[]                    = "add_store_requirements";
        view_load($views, $this->data);
    }

	public function delete_store_requirements($id,$job_id)
    {   
        $this->job_mod->delete_store_requirements($id, $job_id);
        redirect($this->data['module_url']."/view/".$job_id);
    }


    public function add_contract($job_id)
    {   
        if(isPostBack())
        {
            // pr($_POST);die;
            $status = $this->job_mod->add_contract($job_id);
            if(!$status['validation_errors'])
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']               = "add";
        $this->data['btn_title']            = 'Add';
        $this->data['title']                = 'Add Contract';
        $this->data['submodule']            = 'Add Contract';
        $this->data['contract_status'] = get_contract_status();
        // $this->data['upc_list']             = $this->job_mod->get_upc_list();
        $views[]                            = "add_contract_india";
        view_load($views, $this->data);
       
    }
    
    public function get_venders()
    {
        if($this->input->is_ajax_request())
        {
            // pr($_POST);
            if(isset($_POST['supplier_country']) && !empty($_POST['supplier_country']))
            {
                $supplier_country   = $_POST['supplier_country'];
                $response           = get_supplier_from_master($supplier_country);
                // pr($response);die;
                $option             = '<option value="">Select Supplier</option>';
                foreach ($response as $key => $supplier) {
                    $option .= '<option value="'.$supplier->id.'" data-vendor-type="'.$supplier->vendor_type.'">'.$supplier->supplier_name.'</option>';
                }
                // pr($option);die;
                if(isset($response) && !empty($response) && !empty($response[0]))
                {
                    echo json_encode(['status'=>1,'message'=>'Record successfully found.','data'=>$option]);
                }
                else
                {
                    echo json_encode(['status'=>0,'message'=>'Record could not be found.']);
                }
            }
            else
            {
                echo json_encode(['status'=>0,'message'=>'Record ID missing.']);
            }
        }
        else
        {
            echo json_encode(['status'=>0,'message'=>'Direct script not allowed.']);
        }
    }

   public function get_supplier_state()
    {
        if($this->input->is_ajax_request())
        {
            // pr($_POST);
            if(isset($_POST['supplier']) && !empty($_POST['supplier']))
            {
                $supplier = $_POST['supplier'];
                $response = $this->order_mod->get_supplier_state($supplier);
                // pr($response);die;
                if($response)
                {
                    echo json_encode(['status'=>1,'message'=>'Supplier successfully found.','data'=>'1']);
                }
                else
                {
                    echo json_encode(['status'=>0,'message'=>'Supplier could not be found.','data'=>'2']);
                }
            }
            else
            {
                echo json_encode(['status'=>0,'message'=>'Supplier ID missing.']);
            }
        }
        else
        {
            echo json_encode(['status'=>0,'message'=>'Direct script not allowed.']);
        }
    }
	
   public function get_supplier_contact()
    {
        if($this->input->is_ajax_request())
        {
            // pr($_POST);
            if((isset($_POST['supplier']) && !empty($_POST['supplier'])) && (isset($_POST['country_id']) && !empty($_POST['country_id'])))
            {
                $supplier   = $_POST['supplier'];
                $country_id     = $_POST['country_id'];
                $response       = get_supplier_contract($supplier, $country_id); // for china 2,for india 1
                // var_dump($response);die;
                if(isset($response) && !empty($response) && !empty($response[0]))
                {
                    echo json_encode(['status'=>1,'message'=>'Record successfully found.','data'=>$response[0]]);
                }
                else
                {
                    echo json_encode(['status'=>0,'message'=>'Record could not be found.']);
                }
            }
            else
            {
                echo json_encode(['status'=>0,'message'=>'Record ID missing.']);
            }
        }
        else
        {
            echo json_encode(['status'=>0,'message'=>'Direct script not allowed.']);
        }
    }
	
    public function edit_contract($id,$job_id)
    {   
        if(isPostBack())
        {
            // pr($_POST);die;
            $status = $this->job_mod->edit_contract($id,$job_id);
            if(!$status['validation_errors'])
            {
                redirect($this->data['module_url']."/view/".$job_id);
            }
        }
        $this->data['action']               = "Edit";
        $this->data['btn_title']            = 'Update';
        $this->data['title']                = 'Edit Contract';
        $this->data['submodule']            = 'Edit Contract';
        $this->data['contract_details']     = $this->job_mod->get_contract($job_id,$id);
        $this->data['contract_status']      = get_contract_status();
        $views[]                            = "add_contract_india";
        // pr($this->data['contract_details']);die;
        view_load($views, $this->data);
    }
    
    public function freeze_contract($job_id)
	{	
        $id = !empty($_GET['ids'])?$_GET['ids']:'';
		if($id)
        {
              $id     = explode(',',$id);
    		  $status = $this->job_mod->freeze_unfreeze_contract($id,$job_id,1);
              if($status)
              {
                    set_flashdata('success','Contract frozen successfully!!!');
              }
              else
              {
                    set_flashdata('error','Contract already frozen!!!');
              }
        }
        redirect($this->data['module_url']."/view/".$job_id);
	}
	
    public function unfreeze_contract($job_id)
    {   
        $id = !empty($_GET['ids'])?$_GET['ids']:'';
        if($id)
        {
              $id     = explode(',',$id);
              $status = $this->job_mod->freeze_unfreeze_contract($id,$job_id,0);
              if($status)
              {
                    set_flashdata('success','Contract unfreezed successfully!!!');
              }
              else
              {
                    set_flashdata('error','Contract already unfreezed!!!');
              }
        }
        redirect($this->data['module_url']."/view/".$job_id);
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
        if($this->input->is_ajax_request())
        {
            $order_id = $this->input->get('order_id');
            $id = $this->input->get('id');
            $form = $this->input->get('form');
            $dynamic_redirect = false;
            $form_data = $this->form_module_lib->dynamic_edit($id,$form,true,$dynamic_redirect);
            $form_data['is_modal_view'] = true;
            $form_data['module_url']    = $this->data['module_url'];
            $form_data['action_url']    = $this->data['base_url'].'/edit_'.$form.'/'.$id.'/'.$order_id;
            $this->load->view("dynamic_view/edit_form",$form_data);
        }
    }

    public function get_dynamic_form()
    {
        if($this->input->is_ajax_request())
        {
            $id = $this->input->get('job_id');
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

    public function add_job_additional_assignment($job_id)
    {
        $_POST['job_id'] = $job_id;//set job id for joining tables
        $dynamic_redirect = false;
        $this->form_module_lib->dynamic_add('job_additional_assignment','',$dynamic_redirect);
        redirect($this->data['module_url'].'/view/'.$job_id);
    }

    public function edit_job_additional_assignment($id,$job_id)
    {
        $form = "job_additional_assignment";
        $dynamic_redirect = false;
        $this->form_module_lib->dynamic_edit($id,$form,'',$dynamic_redirect);
        redirect($this->data['module_url'].'/view/'.$job_id);
    }

    public function delete_job_additional_assignment($id,$job_id)
    {
        $table = "job_additional_assignment";
        if($id && $table)
        {
            $this->db->where_in('form_id', $id);
            $status = $this->db->delete(TBL_PREFIX.$table);
            if($status)
            {
                set_flashdata('success','Record deleted successfully!');
            }
            else
            {
                set_flashdata('error','Something went wrong,Please try again!');    
            }
        }
        redirect($this->data['module_url'].'/view/'.$job_id);
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
}

    
 