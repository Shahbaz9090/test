<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Enquiry_china Controller
 *
 * @package		CodeIgniter
 * @subpackage	Library
 * @category	Enquiry
 * @author		Pradeep Kumar
 * @website		http://www.techbuddieit.com
 * @company     Techbuddiesit Inc
 * @since		Version 1.0 (initial)
 */
/*Note: This library is dependent library to Sales_spares_enquiry_china detail and table structure*/
// require_once (APPPATH.'/libraries/Form_module_lib.php'); 
class Invoice_lib {
   
	public $type            = NULL;
	public $submodule		= NULL;
	public $obj             = NULL;
	/**
	 * Constructor
	 */
	public function __construct($param = array())
	{
		$this->obj            = $param[0];
		$this->obj->submodule = $param[1];
		$this->obj->type      = $param[2];
        // $this->obj->load->library('form_module_lib');
        // $this->obj->load->library('form_module_mod_lib');
		// $this->obj->load->model('form_module_mod');
		$this->obj->load->model('invoice_mod');
        $this->obj->data['china_designation']   = [31,32];
        $this->obj->data['check_enquiry_no']    = 1;
        $currentuserinfo = currentuserinfo();
        // pr($currentuserinfo);die;
        if(isset($currentuserinfo->is_super) && !empty($currentuserinfo->is_super) && $currentuserinfo->is_super==1 && $currentuserinfo->name=='Super Admin')
        {
            $this->obj->data['designation'] = 'Super Admin';
            $this->obj->data['is_india']    = 1;
            $this->obj->data['is_china']    = 1;
        }
        else
        {
            
            $this->obj->data['designation'] = $currentuserinfo->group_id;
            if(in_array($currentuserinfo->group_id, $this->obj->data['china_designation']))
            {
                $this->obj->data['is_india'] = 0;
                $this->obj->data['is_china'] = 1;
            }
            else
            {
                $this->obj->data['is_india'] = 1;
                $this->obj->data['is_china'] = 0;
            }
        }
        // pr($this->obj->data['is_india']);
        // pr($this->obj->data['is_china']);die;
	}
	
	public function list_items()
	{  
		/*Pagination*/
		$config['base_url']     = $this->obj->data['base_url']."/list_items/";
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
		$page                       = $this->obj->uri->segment(4) ? $this->obj->uri->segment(4) : 0;
		$data['total_pages']        = $page;
		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, '', '', PERPAGE, $page);
		$this->obj->data['data_list']   = $response['result'];
		$this->obj->data['total_record']= $response['total'];
		$config['total_rows']           = $response['total'];
		// pr($response);die;
		$this->obj->load->library('pagination');
		$this->obj->pagination->initialize($config);
		$this->obj->data['pagination_link']	= $this->obj->pagination->create_links();
		/*Pagination*/
		$this->obj->data['place_holder']	= "Enter filter terms here";        
		$this->obj->data['action']			= "list";
		$views[]							= "invoice_list";
		// pr($this->obj->data);die;
		view_load($views, $this->obj->data);
	}

	public function add($table_name)
	{
		// $this->obj->form_module_lib->dynamic_add($table_name);
	}

	public function edit($id, $table_name)
    {
        // $this->obj->form_module_lib->dynamic_edit($id, $table_name);
    }

    public function view($order_id = NULL)
	{
        if(isPostBack())
        {}
        $views[]  = 'view_invoice';
		add_report($order_id);
		view_load($views,$this->obj->data);
	}

	public function add_product($order_id)
	{
		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->add_product($order_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$order_id);
			}
		}

		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, $order_id, '', '', '');
		$this->obj->data['action']	= "add_product";
		$this->obj->data['title']	= lang('sales_spare_add_product_title').' '.$response['result'][0]->po_no;
		$views[]					= "add_product";
		$this->obj->data['unit_master'] = get_uom_from_master();
		// pr($this->obj->data['unit_master']);die;
		view_load($views,$this->obj->data);
	}

	public function edit_product($id, $enquiry_id)
	{

		$product_list = $this->obj->invoice_mod->get_product_list($id, $enquiry_id);
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->edit_product($id, $enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}

		$this->obj->data['product_list']  = $product_list[0];
		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, $id, '', '', '');
		$this->obj->data['action']	= "edit_product";
		$this->obj->data['title']	= lang('sales_spare_edit_product_title').' '.$response['result'][0]->enq_no;
		$views[]					= "edit_product"; 
		$this->obj->data['unit_master'] = get_uom_from_master();
		// pr($this->obj->data['product_list']);die;
		view_load($views,$this->obj->data);
	}
	
	public function delete_product($product_id, $order_id)
	{
		// $this->obj->db->set('is_deleted', 1);
		$this->obj->db->where(PRIMARY_KEY, $product_id);
		$status = $this->obj->db->delete(TBL_PREFIX.'order_product');
		if($status)
		{
			set_flashdata('success', 'Product deleted successfully.');
		}
		else
		{
			set_flashdata('error', 'Product could not be deleted.');
		}
		redirect($this->obj->data['module_url'].'/view/'.$order_id);
	}

	public function edit_product_china($id, $enquiry_id)
	{

		$product_list = $this->obj->invoice_mod->get_product_list($id, $enquiry_id);
		// pr($product_list);die;
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->edit_product_china($id, $enquiry_id);
			if($status)
			{
				set_flashdata('success', 'Product update successfully.');
			}
			else
			{
				set_flashdata('error', 'Product could not be update.');
			}
		}

		redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
	}
	
	public function get_product_detail()
	{
		if($this->obj->input->is_ajax_request())
		{
			// pr($_POST);
			if(isset($_POST['product_id']) && !empty($_POST['product_id']))
			{
				$product_id = $_POST['product_id'];
				$response = $this->obj->invoice_mod->get_product_list($product_id, NULL);
				// pr($response);die;
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

	public function add_po_product($enquiry_id)
	{     
		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->add_po_product($enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}
		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, $enquiry_id, '', '', '');
		$this->obj->data['action']					= "add_po_product";
		$this->obj->data['title']					= lang('sales_spare_add_product_title').' '.$response['result'][0]->po_no;
		$views[]									= "add_product"; 
		$this->obj->data['unit_master'] 			= get_uom_from_master();
		$this->obj->data['supplier_master']			= get_supplier_from_master();
        $this->obj->data['hsncode_master']          = get_hsncode_from_master();
		view_load($views,$this->obj->data);
	}

    public function edit_po_product($product_id, $order_id)
	{

		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->edit_po_product($product_id, $order_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$order_id);
			}
		}

		$product_list = $this->obj->invoice_mod->get_product_list($product_id, $order_id);
		// pr($product_list);die;
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$order_id);
		}

		// $this->obj->data['quotation_list']  		= $quotation_list[0];
		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, $id, '', '', '');
		$this->obj->data['action']					= "edit_po_product";
		$this->obj->data['title']					= lang('sales_spare_edit_product_title').' '.$response['result'][0]->po_no;
		$views[]									= "edit_product";
		$this->obj->data['unit_master'] 			= get_uom_from_master();
		$this->obj->data['supplier_master']			= get_supplier_from_master();
        $this->obj->data['hsncode_master']          = get_hsncode_from_master();
		$this->obj->data['supplier_type_master']	= get_supplier_type_from_master($product_list[0]->supplier_type, 2); // for china
		$this->obj->data['product_list'] 			= $product_list[0];
		view_load($views,$this->obj->data);
		// pr($this->obj->data['quotation_list']);die;
	}

	public function edit_offer($product_id, $enquiry_id)
	{
		// $offer_list    	= $this->obj->invoice_mod->get_offer_list($product_id, $enquiry_id);
		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->edit_offer($product_id, $enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}

		$product_list = $this->obj->invoice_mod->get_product_list($product_id, $enquiry_id);
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		// pr($product_list);die;
		// $this->obj->data['quotation_list']  		= $quotation_list[0];
		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, $enquiry_id, '', '', '');
		if(!isset($response['result']) || empty($response['result'][0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		// pr($response);die;
		$this->obj->data['action']					= "edit_offer";
		$this->obj->data['title']					= lang('sales_spare_edit_offer_title').' '.$response['result'][0]->po_no;
		$views[]									= "edit_offer"; 
		$this->obj->data['product_list'] 			= $product_list[0];
		$this->obj->data['enquiry_list'] 			= $response['result'][0];
		view_load($views,$this->obj->data);
		// pr($this->obj->data['enquiry_list']);
		// pr($this->obj->data['quotation_list']);die;
	}
		
	public function delete_quotation($quotation_id, $enquiry_id)
	{
		// $this->obj->db->set('is_deleted', 1);
		$this->obj->db->where(PRIMARY_KEY, $quotation_id);
		$status = $this->obj->db->delete(TBL_PREFIX.'enquiry_quotation');
		if($status)
		{
			set_flashdata('success', 'Record deleted successfully.');
			redirect($this->obj->data['base_url'].'/list_items/');
		}
		else
		{
			set_flashdata('error', 'Record could not be deleted.');
			redirect($this->obj->data['base_url'].'/view/'.$enquiry_id);
		}
	}

	public function quotation_print($enquiry_id = NULL)
	{
		
		$this->obj->data['action']			= "view";
		$response = $this->obj->invoice_mod->get_order_list($this->obj->type, $enquiry_id, '', '', '');
		// pr($response);die;
		$this->obj->data['result'] 			= $response['result'][0];
		/*$this->obj->data['data_list']   = $response['result'];*/
		$this->obj->data['add_product_title'] = lang('sales_spare_add_product_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['edit_product_title'] = lang('sales_spare_edit_product_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['add_quotation_title']	= lang('sales_spare_add_quotation_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['title']			= lang('sales_spare_title').' ['.$this->obj->data['result']->enq_no.']';
		$this->obj->data['offer_list'] 		= $this->obj->invoice_mod->get_price_calc_print(NULL, $enquiry_id);
		$views[] 					  		= "quotation_print"; 
		add_report($enquiry_id);
		if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action']=='download')
		{
            /***********dompdf old*************/
			/*$this->obj->load->helper('file'); 
			$this->obj->load->library('pdf');
			$this->obj->pdf->load_view('quotation_print', $this->obj->data);
			$this->obj->pdf->render();
			$this->obj->pdf->stream("Quotation_print-".time().".pdf", array('Attachment'=>'0')); exit;*/
            /***********dompdf old*************/
            
            /***********dompdf old*************/
            $this->obj->load->helper('file'); 
            $this->obj->load->library('pdf');
            $html = $this->obj->load->view('quotation_print', $this->obj->data, TRUE);
            $this->obj->pdf->loadHtml($html);
            $this->obj->pdf->render();
            $this->obj->pdf->stream("Quotation_print-".time().".pdf", array('Attachment'=>'1')); exit;
            /***********dompdf old*************/
                        
            /***********mpdf*************/
            /*$this->obj->load->library('m_pdf');
            $html = $this->obj->load->view('quotation_print', $this->obj->data, true);
            $pdfFilePath ="Quotation_print-".time().".pdf"; 
            $pdf = $this->obj->m_pdf->load();
            $pdf->WriteHTML($html);
            $pdf->Output($pdfFilePath, "I"); exit;*/
            /***********mpdf*************/
		}
		else
		{
			$this->obj->load->view('quotation_print', $this->obj->data);
		}
	}
	
	public function add_document($enquiry_id)
	{     

		if(isPostBack())
		{
			$status = $this->obj->invoice_mod->add_document($enquiry_id);
			if($status)
			{
				set_flashdata("success",'Success');
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
			else
			{
				set_flashdata("error",'Error');
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}
	}

	public function delete_document()
	{     
		if($this->obj->input->is_ajax_request())
		{

			if(isset($_POST['doc_id']) && !empty($_POST['doc_id']))
			{
				$doc_id = $_POST['doc_id'];
				$doc = $this->obj->invoice_mod->get_document_list($doc_id, NULL);
				if(isset($doc) && !empty($doc[0]))
				{
					$this->obj->db->where("id", $doc_id);
					$status = $this->obj->db->delete(TBL_PREFIX."order_document");
					if($status)
					{
						$file_name = $doc[0]->file_name;
						@unlink(FCPATH.'/upload/enquiry/'.$file_name);
						echo json_encode(['status'=>1,'message'=>'Record successfully deleted.']);
					}
					else
					{
						echo json_encode(['status'=>0,'message'=>'Record could not be deleted.']);
					}
				}
				else
				{
					echo json_encode(['status'=>0,'message'=>'No Record exist.']);
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

	public function received_product($order_id)
	{     
		// pr($_GET);die;
		if(isset($order_id) && !empty($order_id) && isset($_GET['ids']) && !empty($_GET['ids']))
		{
			$product_id     = $_GET['ids'];
            $product_id     = explode(',', $product_id);
			$this->obj->db->where_in("form_id", $product_id);
			$this->obj->db->where("order_id", $order_id);
			$this->obj->db->set("status", 1);
            $this->obj->db->set("is_received", 1);
			$status = $this->obj->db->update(TBL_PREFIX."order_product");
			// echo $this->obj->db->last_query();die;
			if($status)
			{
                set_flashdata('success','Product successfully received.');
			}
			else
			{
                set_flashdata('error','Product could not be receive');
			}
		}
		else
		{
			set_flashdata('error','Please select product.');
		}
        return redirect($this->obj->data['module_url'].'/view/'.$order_id);
	}

	public function release_quotation()
    {     
        if($this->obj->input->is_ajax_request())
        {
            // pr($_POST);die;
            if(isset($_POST['quotation_id']) && !empty($_POST['quotation_id']) && isset($_POST['product_id']) && !empty($_POST['product_id']) && isset($_POST['enquiry_id']) && !empty($_POST['enquiry_id']))
            {
                $quotation_id   = $_POST['quotation_id'];
                $product_id     = $_POST['product_id'];
                $enquiry_id     = $_POST['enquiry_id'];
                
                /*Set 0 for product wise all quotation*/
                $this->obj->db->trans_start();
                /*$this->obj->db->where("product_id", $product_id);
                $this->obj->db->where("enquiry_id", $enquiry_id);
                $this->obj->db->set("status", '0');
                $this->obj->db->update(TBL_PREFIX."enquiry_quotation");*/
                /*Set 0 for product wise all quotation*/

                /*Set 0 for product wise all quotation*/
                $this->obj->db->select_max("revision");
                $this->obj->db->where("product_id", $product_id);
                $this->obj->db->where("enquiry_id", $enquiry_id);
                $row1 = $this->obj->db->get(TBL_PREFIX."enquiry_quotation")->row();
                $rev_no = 1;
                if(isset($row1->revision) && !empty($row1->revision))
                {
                    $rev_no = $row1->revision+1;
                }
                // echo $this->obj->db->last_query();die;
                /*Set 0 for product wise all quotation*/
                                
                $this->obj->db->where("form_id", $quotation_id);
                $this->obj->db->where("product_id", $product_id);
                $this->obj->db->where("enquiry_id", $enquiry_id);
                $this->obj->db->set("status", 1);
                $this->obj->db->set("revision", $rev_no);
                $status = $this->obj->db->update(TBL_PREFIX."enquiry_quotation");
                $this->obj->db->trans_complete();
                // echo $this->obj->db->last_query();die;
                if($status)
                {

                    /*$data['enquiry_id']   = $enquiry_id;
                    $data['product_id']     = $product_id;
                    $data['quotation_id']   = $quotation_id;
                    $data['status']         = 1;
                    set_common_insert_value2();
                    $this->obj->db->insert(TBL_PREFIX."enquiry_revision", $data);
                    $this->obj->db->trans_complete();*/
                    echo json_encode(['status'=>1,'message'=>'Record successfully saved.']);
                }
                else
                {
                    echo json_encode(['status'=>0,'message'=>'Record could not be updated.']);
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

    public function release_final_quotation()
	{     
		if($this->obj->input->is_ajax_request())
		{
			// pr($_POST);die;
			if(isset($_POST['enquiry_id']) && !empty($_POST['enquiry_id']))
			{
				$enquiry_id = $_POST['enquiry_id'];
				$this->obj->db->where(PRIMARY_KEY, $enquiry_id);
				$this->obj->db->set("current_status", 2);
				$status = $this->obj->db->update(TBL_PREFIX."enquiry");
				if(@$status)
				{
					echo json_encode(['status'=>1,'message'=>'Record successfully updated.']);
				}
				else
				{
					echo json_encode(['status'=>0,'message'=>'Record could not be updated.']);
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
	
	public function ajax_list_items($limit = 10)
	{ 
		$thisObj = &get_instance();
		$user=currentuserinfo();
		$perPage = $this->obj->invoice_mod->perPage($user->id);
		if($perPage) {
		} else {
			$controllerInfo = $this->obj->uri->segment(1) . "/" . $this->obj->uri->segment(2);
			$pageArr = array(
				'action' => $controllerInfo,
				'records' => $this->obj->input->get_post('rp', true),
				'user_id' => $user->id);
				$this->obj->invoice_mod->insert_perPage($pageArr);
		}

	   
		if($this->obj->input->post("order_by")) {
			$order_by = $this->obj->input->post("order_by");
		}else{
			$order_by = 'id';
		}
		if($this->obj->input->post("order")) {
			$order = $this->obj->input->post("order");
		}else{
			$order = 'desc';
		}
		$offset = $this->obj->input->post("offset");
		if(!$offset){
			$offset =1;
		}
		if(!$limit) {
			$limit = 10;
		}
		if($this->obj->input->post("limit")) {
			$limit = $this->obj->input->post("limit");
			$this->obj->data["hiddenLimit"] = $limit;
		}
		if($this->obj->input->post('text')) {
			$text = $this->obj->input->post('text');
		} else {
			$text = null;
		}
		
		$data = $this->obj->invoice_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
		$permission=_check_perm();
	   // pr($data);die;
		foreach ($data['result'] as $row)
		{

			$row->name = ucwords($row->name); //@$companyContact->contact_person;
			$row->industry_name = ucwords($row->industry_name);
			$row->country_name = ucwords($row->country_name);
			$row->state_name = ucwords(strtolower($row->state_name));
			$row->city_name = ucwords(strtolower($row->city_name));
			if($row->type_of_establishment!=0){
				$row->type_of_establishment = ucwords(strtolower($row->type_of_establishment_name));
			}else{
					$row->type_of_establishment = '-/-';
			}
			
			if($row->type_of_client!=0){
				$row->type_of_client = ucwords(strtolower($row->type_client_name));
			}else{
					$row->type_of_client = '-/-';
			}
			
			//pr($row->name);die;
			
			if ($row->status == '0')
			{
				$row->status = "Inactive";
			} else
			{
				$row->status = "Active";
			}  
				
			if($row->added_by == $user->id && ($permission != '1' && $permission !='' ))
			{
				$row->status =  $row->status;
				//$row->status = '<a href="' . $this->obj->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
			}
            else
			{
				$row->status = '<a href="' . $this->obj->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
			}
			//$cityResult = viewCity($row->city);
			//pr($cityResult);die;
			//$row->city = @$cityResult->cityName;
		}
	   
		$data['grid']['total'] = $data['total'];
		$data['grid']['cols'] = $this->obj->invoice_mod->get_flexigrid_cols();
		$data['grid']['result'] = $data['result'];
		$data['grid']["page_offset"] = $offset;
		$data['grid']["limit"] = $limit;
		$data['grid']["base_url"] = $this->obj->data['base_url'];
		$this->obj->load->view('kg_grid/ajax_grid', $data);
	}
	
	public function export()
	{
		$thisObj 	= &get_instance();
		$items		= $this->obj->input->get_post('items',TRUE);
		$items_data	= str_replace("row","",$items);       
		$items_data	= explode(",",$items_data);
		$data 		= $this->obj->invoice_mod->export();

		export_report($items_data);
		array_to_csv($data,"Client.csv");
	}
	
	public function delete($id)
	{
		$this->obj->db->set('is_deleted', 1);
		$this->obj->db->where(PRIMARY_KEY, $id);
		$status = $this->obj->db->update(TBL_PREFIX.$this->obj->data['table_name']);
		if($status)
		{
			set_flashdata('success', 'Record deleted successfully.');
			redirect($this->obj->data['base_url'].'/list_items/');
		}
		else
		{
			set_flashdata('error', 'Record could not be deleted.');
			redirect($this->obj->data['base_url'].'/list_items/');
		}
	}
		
	public function status($id = null) {
		$thisObj = &get_instance();
		$result = $this->obj->invoice_mod->get($id);
		$r = $this->obj->invoice_mod->status_update($id, $result->status);
		if($r) {
			redirect($this->obj->data['base_url'] . "/list_items");
		}
	}

	public function delete_records()
	{
		if ($this->obj->input->is_ajax_request()) {
			
			$delRow = $this->obj->input->post('delRow');
			$delRow = explode(",", $delRow);
			// pr($delRow);die;
			$this->obj->db->set('is_deleted', 1);
			$this->obj->db->where_in(PRIMARY_KEY, $delRow);
			$status = $this->obj->db->update(TBL_PREFIX.$this->obj->data['table_name']);
			// echo $this->db->last_query();
			if ($status) {
				echo json_encode(['status' => 1, 'message' => 'Record successfully deleted']);
			} else {
				
				echo json_encode(['status' => 0, 'message' => 'Records could not be delete']);
			}

		} else {
			echo json_encode(['status' => 0, 'message' => 'No direct script access allowed']);
		}
	}

	public function uploadFiles($file_arr, $ext = '') {
		
		if (isset($file_arr['name']) && $file_arr['name'] != '') {
			
			$path 		= $file_arr['name'];
			$ext 		= pathinfo($path, PATHINFO_EXTENSION);
			$name 		= md5(time());
			$file_name 	= $name . "." . $ext;
			$folder_doc = FCPATH.'upload/documents/';
			if (!file_exists($folder_doc)) {
				mkdir($folder_doc, 0777, true);
			}
			$file_arr['name'] 			= $file_name;
			$config['upload_path'] 		= $folder_doc;
			if(isset($ext) && !empty($ext) && is_array($ext))
			{
				$config['allowed_types'] 	= implode("|", $ext);
			}
			else
			{
				$config['allowed_types'] 	= '*';
			}
			$config['max_size'] 		= 0;
			$config['encrypt_name'] 	= FALSE;
			$config['remove_spaces']	= TRUE;
			$config['overwrite'] 		= FALSE;
			$this->load->library('upload');
			$this->upload->initialize($config);
			$data=array();
			if (!$this->upload->do_upload('myfile'))
			{
				$data['error'] = $this->upload->display_errors();
			} else
			{
				$data['success'] = $this->upload->data();
			}
			return $data;
		}
	}

	public function doc_download($id)
	{
	   
		$this->obj->db->where_in('id', $id);
		$query = $this->obj->db->get(TBL_PREFIX."order_document");
		if($query->num_rows()>0)
		{
			$row = $query->row();
			// pr($row);die;
			$filepath = FCPATH.'/upload/order/'.$row->file_name;
			$filename = $row->document;
			if(file_exists($filepath)) {
				header('Content-Description: File Transfer');
				header('Content-Type: application/octet-stream');
				header('Content-Disposition: attachment; filename="'.basename($filename).'"');
				header('Expires: 0');
				header('Cache-Control: must-revalidate');
				header('Pragma: public');
				header('Content-Length: ' . filesize($filepath));
				flush(); // Flush system output buffer
				readfile($filepath);
				die();
			}
		}
		else
		{
			return false;
		}
		// echo $this->db->last_query();
	}  

	public function create_supplier_po($order_id)
	{
		if(isset($_GET['ids']) && !empty($_GET['ids']) && isset($order_id) && !empty($order_id))
		{
			$product_id     = $_GET['ids'];
			$product_id 	= explode(",", $product_id);
			// pr($product_id);die;
            $this->obj->db->trans_start();
			$this->obj->db->select_max("supplier_po_seq");
			// $this->obj->db->where("product_id", $product_id);
			$this->obj->db->where("order_id", $order_id);
			$row1 = $this->obj->db->get(TBL_PREFIX."order_product")->row();
			$po_count = 1;
			if(isset($row1->supplier_po_seq) && !empty($row1->supplier_po_seq))
			{
				$po_count = $row1->supplier_po_seq+1;
			}
			// pr($po_count);die;
			$this->obj->db->where_in("form_id", $product_id);
			$this->obj->db->where("order_id", $order_id);
			$this->obj->db->set("supplier_po_seq", $po_count);
			$this->obj->db->set("supplier_po", "SPO".$po_count);
			$status = $this->obj->db->update(TBL_PREFIX."order_product");
			$this->obj->db->trans_complete();
			// echo $this->obj->db->last_query();die;
			if($status)
			{
				set_flashdata('success', "PO created successfully.");
				//self::__download_supplier_po($product_id, $order_id);exit;
			}
			else
			{
				set_flashdata('success', "PO could not be created.");
			}
		}
		else
		{
			set_flashdata('success', "Please select product.");
		}
		return redirect($this->obj->data['module_url'].'/view/'.$order_id);
	}	

	public function download_supplier_po($order_id, $po_nos)
    {

        $result  = $this->obj->invoice_mod->get_order_list($this->obj->type, $order_id);
        $this->obj->data['result']  = $result['result'][0];
        $this->obj->data['product_list']= $this->obj->invoice_mod->get_product_list(NULL, $order_id, $po_nos);
        // pr($this->obj->data['result']);die;
        // pr($this->obj->data['product_list']);die;
        if(isset($_GET['action']) && !empty($_GET['action']) && $_GET['action']=='download')
        {
            // $this->obj->load->view('supplier_po_print', $this->obj->data);

            $this->obj->load->helper('file'); 
            $this->obj->load->library('pdf');
            $html = $this->obj->load->view('supplier_po_print', $this->obj->data, TRUE);
            $this->obj->pdf->loadHtml($html);
            $this->obj->pdf->render();
            $this->obj->pdf->stream("supplier_po_print-".time().".pdf", array('Attachment'=>'1')); exit;
            
        }
        else
        {
            $this->obj->load->view('supplier_po_print', $this->obj->data);
        }
    }

    public function download_supplier_sheet($enquiry_id)
    {
        $this->obj->load->library("excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $table_columns = array("Comm ID", "Description English", "Description Chinease", "Make English", "make Chinease", "Qty ", "UOM ", "Unit Price/单价 ¥ ", "VAT % ", "Unit price with Tax 含税单价 ¥ ", "Total Price with Tax/含税总价 ¥", "Delivery time交货时间", "Goods Gross weight货物毛重/kgs", "Payment term付款方式", "Valid date报价有效期", "Delivery Cost/ 交货 成本", "Packing Cost/包装费用", "Warranty period/保修期");
        
        // $table_columns = array("Name", "Address", "Gender", "Designation", "Age");

        $column = 0;

        foreach($table_columns as $field)
        {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }

        $excel_row = 2;

        $enquiry_list = $this->obj->invoice_mod->get_order_list($this->obj->type, $enquiry_id, '', '', '');
        if(isset($_GET['ids']) && !empty($_GET['ids']))
        {
        	$ids = $_GET['ids'];
        	$ids = explode(',', $ids);
        }
        $product_list = $this->obj->invoice_mod->get_product_list($ids, $enquiry_id);
        // pr($enquiry_list);die;
        if(isset($enquiry_list) && !empty($enquiry_list['result'][0]->enq_no) && isset($product_list) && !empty($product_list))
        {
            $i = 1;
            foreach ($product_list as $product) {
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $enquiry_list['result'][0]->enq_no.'-'.$i++);
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, $product->description_issued_by_inch);
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $product->make_issue_inch);
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $product->description_issued_by_cfit);
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $product->make_issue_cfit);
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $product->qty);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $product->unit_name);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, '');
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, '');

                $excel_row++;
            }
        }
        $filename = $enquiry_list['result'][0]->enq_no . "_Supplier Sheet" . date('d-m-Y'). ".xls";
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$filename);
        $object_writer->save('php://output');
    }
    
    public function add_more_email($enquiry = NULL)
	{
		// pr($_POST);
		// echo $enquiry;die;
		if(isset($_POST['mail_ids']) && !empty($_POST['mail_ids']) && isset($_POST['mail_type']) && !empty($_POST['mail_type']) && isset($_POST['enquiry_id']) && !empty($_POST['enquiry_id']))
		{
			$mail_ids   = $_POST['mail_ids'];
			$mail_ids   = explode(",", $mail_ids);

			$mail_type  = $_POST['mail_type'];
			$enquiry_id = $_POST['enquiry_id'];
			if($mail_type==1)
			{
				$mail_no    = [];
				$result     = $this->obj->db->select('mail_no')->get_where("inch_enquiry", ['form_id'=>$enquiry_id])->row();
				if(isset($result->mail_no) && !empty($result->mail_no))
				{
					$mail_no    = explode(",", $result->mail_no);
				}
				$all_mail_ids   = array_merge(array_filter($mail_no), array_filter($mail_ids));
				$all_mail_ids   = array_unique($all_mail_ids);

				// pr(array_unique($all_mail_ids));die;
				if(isset($all_mail_ids) && !empty($all_mail_ids))
				{
					$status     = $this->obj->db->query("UPDATE `inch_enquiry` SET `mail_no` = '".implode(",", $all_mail_ids)."' WHERE `form_id` = ".$enquiry_id);
				}
			}
			elseif($mail_type==2)
			{
				$mail_no    = [];
				$result     = $this->obj->db->select('china_mail_no')->get_where("inch_enquiry", ['form_id'=>$enquiry_id])->row();
				if(isset($result->mail_no) && !empty($result->mail_no))
				{
					$mail_no    = explode(",", $result->mail_no);
				}
				$all_mail_ids   = array_merge(array_filter($mail_no), array_filter($mail_ids));
				$all_mail_ids   = array_unique($all_mail_ids);

				// pr(array_unique($all_mail_ids));die;
				if(isset($all_mail_ids) && !empty($all_mail_ids))
				{
					$status     = $this->obj->db->query("UPDATE `inch_enquiry` SET `china_mail_no` = '".implode(",", $all_mail_ids)."' WHERE `form_id` = ".$enquiry_id);
				}
			}

			// echo $this->obj->db->last_query();die;
			if($status)
			{
				set_flashdata('success',"Email tags saved successfully.");
			}
			else
			{
				set_flashdata('error',"Email tags could not be saved");
			}
		}
		else
		{
			set_flashdata('error',"Email tags could not be saved");
		}
		// echo $this->obj->data['base_url']."/view/".$enquiry;
		redirect($this->obj->data['base_url']."/view/".$enquiry);
	}

	public function get_vender_type()
	{
		if($this->obj->input->is_ajax_request())
		{
			// pr($_POST);
			if(isset($_POST['vendor_type']) && !empty($_POST['vendor_type']))
			{
				$vendor_type 	= $_POST['vendor_type'];
				$response 		= get_supplier_type_from_master($_POST['vendor_type'], 2); // for china
				// pr($response);die;
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

    public function freeze_quotation($enquiry_id)
    {
        if(isset($_GET['ids']) && !empty($_GET['ids']))
        {
            $ids = $_GET['ids'];
            $ids = explode(',', $ids);
        }
        // pr($ids);die;
        $is_offer_created = TRUE;
        $this->obj->db->where_in('form_id', $ids);
        $result = $this->obj->db->get(TBL_PREFIX.'enquiry_quotation')->result();
        // pr($result);die;
        if(isset($result) && !empty($result))
        {
            foreach ($result as $key => $row) {
                if($row->total_landed_price==NULL && $row->total_unit_offer_price==NULL)
                {
                    // var_dump($row->total_landed_price);
                    // echo "<br>";
                    $is_offer_created = FALSE;
                }
            }
        }
        else
        {
            $is_offer_created = FALSE;
        }
        // var_dump($is_offer_created);die;
        if($is_offer_created)
        {
            $data['is_freeze'] = 1;
            $this->obj->db->where_in('form_id', $ids);
            $status = $this->obj->db->update(TBL_PREFIX.'enquiry_quotation',$data);
            if($status)
            {
                set_flashdata("success", 'Offer freeze successfully.');
            }
            else
            {
                set_flashdata("error", 'Offer could not be freeze.');
            }
        }
        else
        {
            set_flashdata("error", 'Complete offer before freeze.');
        }
        redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
    }

 	/*Chat system*/
	public function get_ticket_message_chat() {

        //$this->load->model('sale/order');
        $ticket_id_for_message = $this->obj->input->post('ticket_id_for_message');

     	$update_chat= $this->obj->invoice_mod->updatechat($ticket_id_for_message);
		                               
        if (!empty($ticket_id_for_message)) {
            $result = $this->obj->invoice_mod->get_ticket_message_chat($ticket_id_for_message);
        }
        foreach ($result as $key_r => $val_r) {
            $result[$key_r]['CREATED_DATE'] = date('d-m-Y H:i:s', strtotime($val_r['created_date']));
        }

        //echo "<pre>";print_r($result);die;

        echo json_encode($result);
    }

    public function add_chat(){
        
        if (($this->obj->input->server('REQUEST_METHOD') == 'POST')) { 
            //$this->obj->load->model('sale/order');
           	$this->obj->invoice_mod->insert_chat($_POST);
           
          	$this->obj->session->data['success'] = "Chat Message Sent Successfully"; 
          	$this->obj->response->redirect($this->obj->url->link('sale/order', 'token=' . $this->obj->session->data['token'] . $url, 'SSL'));
        }
    }

    public function tickets_logs() {

        $ticket_id = $this->obj->input->post('ticket_id');
        $this->obj->invoice_mod->updatechat($ticket_id);
        $log = $this->obj->ticket_refresh();
    }

    public function ticket_refresh() {

        $ticket_id = $this->obj->input->post('ticket_id');
       	
        $log = $this->obj->invoice_mod->get_ticket_message_chat($ticket_id);

        // echo "<pre>";print_r($log);die;
        $html = "";
        if(isset($log) && !empty($log))
        {
	        foreach ($log as $key => $tl_val) {

	            if ($tl_val['sender'] == '1') {
	                $html .= '<li class="chat_thread by_user">
					<h5>' . ucfirst($tl_val['RECEIVER_NAME']) . '</h5>
					<p class="chat_desc"> ' . $tl_val['content'] . '</p>
					<small class="chat_time">' . date("d-m-Y h:i:s A", strtotime($tl_val['created_time'])) . '</small>
				       </li>';
	            } else {

	                $html .= '<li class="chat_thread by_support">
					<h5>' . ucfirst($tl_val['RECEIVER_NAME']) . '</h5>
					<p class="chat_desc"> ' . $tl_val['content'] . '</p>
					<small class="chat_time">' . date("d-m-Y h:i:s A", strtotime($tl_val['created_time'])) . '</small>
				       </li>';
	            }
	        }
        }

        if ($log) {
            $data['status'] 			= 'success';
            $data['tickets_log'] 		= $log;
            $data['tickets_log_view'] 	= $html;
        } else {
            $data['status'] 			= 'success';
            $data['tickets_log'] 		= $log;
            $data['tickets_log_view'] 	= '<li class="chat_thread by_support"> <h5>No Chat Found</h5> </li>';
        }
        //echo "<pre>";print_r($data);die;
        echo json_encode($data);
    }

    public function reply_on_ticket() {

        $user_id    = currentuserinfo()->id;
        $dat['ticket_id'] = $this->obj->input->post('ticket_id');
        $dat['receiver'] = $this->obj->input->post('receiver_id');
        $dat['sender'] = 1;
        $dat['is_read'] = 1;
        $dat['is_user_read'] = 1;
        $dat['added_by'] = $user_id;
        $dat['content'] = $this->obj->input->post('content');
        //echo "<pre>";print_r($dat);die;
        $this->obj->invoice_mod->insert_chat($dat);
        $data['status'] = 'success';
        echo json_encode($data);
    }
 	/*Chat system*/

}

	
 