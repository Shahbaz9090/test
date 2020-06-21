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

class Enquiry_database_lib {
   
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
		$this->obj->load->model('enquiry_database_mod');
        $this->obj->data['china_designation'] = [31,32];
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
		// $response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, '', '', PERPAGE, $page);
        $response    = $this->obj->enquiry_database_mod->get_product_list($this->obj->type);
		// pr($response);die;
		$this->obj->data['data_list']   = $response['result'];
		$this->obj->data['total_record']= $response['total'];
		$config['total_rows']           = $response['total'];
		$this->obj->load->library('pagination');
		$this->obj->pagination->initialize($config);
		$this->obj->data['pagination_link']	= $this->obj->pagination->create_links();
		/*Pagination*/
		$this->obj->data['place_holder']	= "Enter filter terms here";        
		$this->obj->data['action']			= "list";
		$views[]							= "list";
		// pr($this->obj->data);die;
		view_load($views, $this->obj->data);
	}

	public function add($id)
	{
		//
	}

	public function view($enquiry_id = NULL)
	{
		// pr($_POST);die;
		$this->obj->data['action']			= "view";
		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $enquiry_id, '', '', '');
		// pr($response);die;
		$this->obj->data['result'] 			= $response['result'][0];
		/*$this->obj->data['data_list']   = $response['result'];*/
        if(isset($this->obj->data['result']) && !empty($this->obj->data['result']) && !empty($this->obj->data['result']->client_contact))
        {
            $client_contact_id = $this->obj->data['result']->client_contact;
            // pr($client_contact_id);die;
            $client_contact_id = explode(",", $client_contact_id);
            $client_contact_list = $this->obj->enquiry_database_mod->get_client_contact_list($client_contact_id);
            $this->obj->data['client_contact_list'] = $client_contact_list;
        }
        // pr($this->obj->data['client_contact_list']);die;
		$this->obj->data['add_product_title'] = lang('sales_spare_add_product_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['edit_product_title'] = lang('sales_spare_edit_product_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['add_quotation_title']	= lang('sales_spare_add_quotation_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['title']			= lang('sales_spare_title').' ['.$this->obj->data['result']->enq_no.']';
		$this->obj->data['product_list'] 	= $this->obj->enquiry_database_mod->get_product_list(NULL, $enquiry_id);
		$this->obj->data['quotation_list'] 	= $this->obj->enquiry_database_mod->get_quotation_list(NULL, $enquiry_id);
        $this->obj->data['offer_list']      = $this->obj->enquiry_database_mod->get_offer_list(NULL, $enquiry_id);
		$this->obj->data['price_calc_list'] = $this->obj->enquiry_database_mod->__get_offer_list(NULL, $enquiry_id);
		$this->obj->data['document_list'] 	= $this->obj->enquiry_database_mod->get_document_list(NULL, $enquiry_id);
		$mails								= $this->obj->enquiry_database_mod->get_mail_list($this->obj->data['result']->mail_no, $this->obj->data['result']->china_mail_no);
		$mail_list 			= $mails['india_mail_list'];
		$china_mail_list 	= $mails['china_mail_list'];

		// pr(currentuserinfo());die;
		$user_sess	= currentuserinfo();
        $user_id	= $user_sess->id;
        $user_name	= $user_sess->first_name.' '.$user_sess->last_name;
		$this->obj->data['user_id'] 			= $user_id;
		$this->obj->data['user_name'] 			= $user_name;
		$this->obj->data['mail_lists'] 			= @$mail_list['mail_list'];
		$this->obj->data['attachments']			= @$mail_list['mail_doc'];

		$this->obj->data['china_mail_lists']	= @$china_mail_list['mail_list'];
		$this->obj->data['china_attachments']	= @$china_mail_list['mail_doc'];
		
		$views[] 					  		= "view_enquiry"; 
		$this->obj->data['unit_master'] 	= get_uom_from_master();
		$this->obj->data['hsncode_master']	= get_hsncode_from_master();
		$this->obj->data['supplier_master']	= get_supplier_from_master();
		// pr($this->obj->data['offer_list']);die;
		view_report($enquiry_id);
		view_load($views,$this->obj->data);
	}

	
	public function add_product($enquiry_id)
	{
		if(isPostBack())
		{
			$status = $this->obj->enquiry_database_mod->add_product($enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}

		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $enquiry_id, '', '', '');
		$this->obj->data['action']	= "add_product";
		$this->obj->data['title']	= lang('sales_spare_add_product_title').' '.$response['result'][0]->enq_no;
		$views[]					= "add_product";
		$this->obj->data['unit_master'] = get_uom_from_master();
		// pr($this->obj->data['unit_master']);die;
		view_load($views,$this->obj->data);
	}

	public function edit_product($id, $enquiry_id)
	{

		$product_list = $this->obj->enquiry_database_mod->get_product_list($id, $enquiry_id);
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		if(isPostBack())
		{
			$status = $this->obj->enquiry_database_mod->edit_product($id, $enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}

		$this->obj->data['product_list']  = $product_list[0];
		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $id, '', '', '');
		$this->obj->data['action']	= "edit_product";
		$this->obj->data['title']	= lang('sales_spare_edit_product_title').' '.$response['result'][0]->enq_no;
		$views[]					= "edit_product"; 
		$this->obj->data['unit_master'] = get_uom_from_master();
		// pr($this->obj->data['product_list']);die;
		view_load($views,$this->obj->data);
	}
	
	public function delete_product($product_id, $enquiry_id)
	{
		// $this->obj->db->set('is_deleted', 1);
		$this->obj->db->where(PRIMARY_KEY, $product_id);
		$status = $this->obj->db->delete(TBL_PREFIX.'enquiry_product');
		if($status)
		{
			set_flashdata('success', 'Record deleted successfully.');
		}
		else
		{
			set_flashdata('error', 'Record could not be deleted.');
		}
		redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
	}

	public function edit_product_china($id, $enquiry_id)
	{

		$product_list = $this->obj->enquiry_database_mod->get_product_list($id, $enquiry_id);
		// pr($product_list);die;
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		if(isPostBack())
		{
			$status = $this->obj->enquiry_database_mod->edit_product_china($id, $enquiry_id);
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
				$response = $this->obj->enquiry_database_mod->get_product_list($product_id, NULL);
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

	public function add_quotation($product_id, $enquiry_id)
	{     

		if(isPostBack())
		{
			$status = $this->obj->enquiry_database_mod->add_quotation($product_id, $enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}
		$product_list = $this->obj->enquiry_database_mod->get_product_list($product_id, $enquiry_id);
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		// pr($product_list);die;
		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $enquiry_id, '', '', '');
		$this->obj->data['action']					= "add_quotation";
		$this->obj->data['title']					= lang('sales_spare_add_quotation_title').' '.$response['result'][0]->enq_no;
		$views[]									= "add_quotation"; 
		$this->obj->data['unit_master'] 			= get_uom_from_master();
		$this->obj->data['supplier_master']			= get_supplier_from_master();
		// $this->obj->data['supplier_type_master']	= get_supplier_type_from_master(NULL, 2); // for china
		$this->obj->data['product_list'] 			= $product_list[0];
		// pr($this->obj->data['supplier_master']);die;
		view_load($views,$this->obj->data);
	}

	public function edit_quotation($id, $product_id, $enquiry_id)
	{

		if(isPostBack())
		{
			$status = $this->obj->enquiry_database_mod->edit_quotation($id, $enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}

		$quotation_list = $this->obj->enquiry_database_mod->get_quotation_list($id, $enquiry_id);
		if(!isset($quotation_list) || empty($quotation_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		// pr($quotation_list);die;
		$product_list = $this->obj->enquiry_database_mod->get_product_list($product_id, $enquiry_id);
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}

		$this->obj->data['quotation_list']  		= $quotation_list[0];
		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $id, '', '', '');
		$this->obj->data['action']					= "edit_quotation";
		$this->obj->data['title']					= lang('sales_spare_edit_quotation_title').' '.$response['result'][0]->enq_no;
		$views[]									= "edit_quotation"; 
		$this->obj->data['unit_master'] 			= get_uom_from_master();
		$this->obj->data['supplier_master']			= get_supplier_from_master();
		$this->obj->data['supplier_type_master']	= get_supplier_type_from_master($this->obj->data['quotation_list']->supplier_type, 2); // for china
		$this->obj->data['product_list'] 			= $product_list[0];
		view_load($views,$this->obj->data);
		// pr($this->obj->data['quotation_list']);die;
	}

	public function edit_offer($quotation_id, $product_id, $enquiry_id)
	{
		// id quotation_id
		// $offer_list    	= $this->obj->enquiry_database_mod->get_offer_list($product_id, $enquiry_id);
		if(isPostBack())
		{
			$status = $this->obj->enquiry_database_mod->edit_offer($quotation_id, $product_id, $enquiry_id);
			if($status)
			{
				redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
			}
		}

		$quotation_list = $this->obj->enquiry_database_mod->get_quotation_list($quotation_id, $enquiry_id);
		if(!isset($quotation_list) || empty($quotation_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		// pr($quotation_list);die;
		$product_list = $this->obj->enquiry_database_mod->get_product_list($product_id, $enquiry_id);
		if(!isset($product_list) || empty($product_list[0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}

		$this->obj->data['quotation_list']  		= $quotation_list[0];
		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $enquiry_id, '', '', '');
		if(!isset($response['result']) || empty($response['result'][0]))
		{
			redirect($this->obj->data['module_url'].'/view/'.$enquiry_id);
		}
		// pr($response);die;
		$this->obj->data['action']					= "edit_offer";
		$this->obj->data['title']					= lang('sales_spare_edit_offer_title').' '.$response['result'][0]->enq_no;
		$views[]									= "edit_offer"; 
		$this->obj->data['unit_master'] 			= get_uom_from_master();
		$this->obj->data['supplier_master']			= get_supplier_from_master();
		$this->obj->data['supplier_type_master']	= get_supplier_type_from_master($this->obj->data['quotation_list']->supplier_type, 2); // for china
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
		$response = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $enquiry_id, '', '', '');
		// pr($response);die;
		$this->obj->data['result'] 			= $response['result'][0];
		/*$this->obj->data['data_list']   = $response['result'];*/
		$this->obj->data['add_product_title'] = lang('sales_spare_add_product_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['edit_product_title'] = lang('sales_spare_edit_product_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['add_quotation_title']	= lang('sales_spare_add_quotation_title').' '.$this->obj->data['result']->enq_no;
		$this->obj->data['title']			= lang('sales_spare_title').' ['.$this->obj->data['result']->enq_no.']';
		// $this->obj->data['product_list'] 	= $this->obj->enquiry_database_mod->get_product_list(NULL, $enquiry_id);
		// $this->obj->data['quotation_list'] 	= $this->obj->enquiry_database_mod->get_quotation_list(NULL, $enquiry_id);
		$this->obj->data['offer_list'] 		= $this->obj->enquiry_database_mod->get_offer_list(NULL, $enquiry_id);
		// $this->obj->data['document_list'] 	= $this->obj->enquiry_database_mod->get_document_list(NULL, $enquiry_id);
		$mail_list 							= $this->obj->enquiry_database_mod->get_mail_list($this->obj->data['result']->mail_no);
		// pr($this->obj->data['result']);die;
		$this->obj->data['mail_lists'] 		= @$mail_list['mail_list'];
		$this->obj->data['attachments']		= @$mail_list['mail_doc'];
		
		$views[] 					  		= "quotation_print"; 
		// $this->obj->data['unit_master'] 	= get_uom_from_master();
		// $this->obj->data['hsncode_master']	= get_hsncode_from_master();
		// $this->obj->data['supplier_master']	= get_supplier_from_master();
		// pr($this->obj->data);die;
		add_report($enquiry_id);
		// view_load($views,$this->obj->data);
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
			$status = $this->obj->enquiry_database_mod->add_document($enquiry_id);
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
				$doc = $this->obj->enquiry_database_mod->get_document_list($doc_id, NULL);
				if(isset($doc) && !empty($doc[0]))
				{
					$this->obj->db->where("id", $doc_id);
					$status = $this->obj->db->delete(TBL_PREFIX."enquiry_document");
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
				$this->obj->db->where("product_id", $product_id);
				$this->obj->db->where("enquiry_id", $enquiry_id);
				$this->obj->db->set("status", '0');
				$this->obj->db->update(TBL_PREFIX."enquiry_quotation");
				/*Set 0 for product wise all quotation*/

				$this->obj->db->where("form_id", $quotation_id);
				$this->obj->db->where("product_id", $product_id);
				$this->obj->db->where("enquiry_id", $enquiry_id);
				$this->obj->db->set("status", 1);
				$status = $this->obj->db->update(TBL_PREFIX."enquiry_quotation");
				if(@$status)
				{

                    $data['enquiry_id']     = $enquiry_id;
                    $data['product_id']     = $product_id;
                    $data['quotation_id']   = $quotation_id;
                    $data['status']         = 1;
                    set_common_insert_value2();
                    $this->obj->db->insert(TBL_PREFIX."enquiry_revision", $data);
                    $this->obj->db->trans_complete();
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
		$perPage = $this->obj->enquiry_database_mod->perPage($user->id);
		if($perPage) {
		} else {
			$controllerInfo = $this->obj->uri->segment(1) . "/" . $this->obj->uri->segment(2);
			$pageArr = array(
				'action' => $controllerInfo,
				'records' => $this->obj->input->get_post('rp', true),
				'user_id' => $user->id);
				$this->obj->enquiry_database_mod->insert_perPage($pageArr);
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
		
		$data = $this->obj->enquiry_database_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
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
			}else
			{
				$row->status = '<a href="' . $this->obj->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
			}
			//$cityResult = viewCity($row->city);
			//pr($cityResult);die;
			//$row->city = @$cityResult->cityName;
		}
	   
		$data['grid']['total'] = $data['total'];
		$data['grid']['cols'] = $this->obj->enquiry_database_mod->get_flexigrid_cols();
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
		$data 		= $this->obj->enquiry_database_mod->export();

		export_report($items_data);
		array_to_csv($data,"Client.csv");
	}
	
	public function delete($id)
	{
		$this->obj->db->set('is_deleted', 1);
		$this->obj->db->where(PRIMARY_KEY, $id);
		$status = $this->obj->db->update(TBL_PREFIX.$this->obj->table_name);
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
		$result = $this->obj->enquiry_database_mod->get($id);
		$r = $this->obj->enquiry_database_mod->status_update($id, $result->status);
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
			$status = $this->obj->db->update(TBL_PREFIX.$this->obj->table_name);
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
	

	/*Dynamic add , edit view form */
	
	public function dynamic_add($table_name)
	{
		// echo "string";
		if (!$table_name) {
			redirect(($this->obj->data['base_url'].'/list_items'));
		}
		// echo PRIMARY_KEY;die;
		$res = $this->obj->form_module_mod->get_form_by_name($table_name);
		// pr($res);die;
		if (!isset($res) || empty($res) &&  count($res)==0) {
			redirect(($this->obj->data['base_url'].'/list_items'));
		}

		$id = $res->id;
		if (isPostBack()) {
			$postData = $this->obj->input->post(null, true);
			// pr($_FILES);
			// pr($postData);die;
			$all_form_data = [];
			if(isset($res->form_data) && !empty($res->form_data))
			{
				$form1 = json_decode($res->form_data);
				$move_columns = $form1->form_data;
				if(count($form1->form_data) && !empty($form1->form_data)){
					foreach ($form1->form_data as $key1 => $value) {
						if(!empty($value->elements && count($value->elements)>0))
						{
							foreach ($value->elements as $key2 => $value) {
								$all_form_data[] = $value;
							}
						}
					}
				}
			}
			// pr($all_form_data);die;
			foreach ($all_form_data as $key => $frm_data1) {
				$frm_data = (array) $frm_data1;
				if($frm_data['type']=='file')
				{
					// pr($frm_data);die;
					if($frm_data['data-input']=='multiplefile')
					{
						/*Start save client multiple  document*/
						$upld_file 	= [];
						$act_file 	= $frm_data['name'];
						$allowed_extensions = $frm_data['allowed_extensions'];
						// pr($act_file);die;
						if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
						{
							foreach ($_FILES[$act_file]['name'] as $myfile_key => $myfile) {
								$_FILES['myfile']['name']     = $_FILES[$act_file]['name'][$myfile_key];
								$_FILES['myfile']['type']     = $_FILES[$act_file]['type'][$myfile_key];
								$_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'][$myfile_key];
								$_FILES['myfile']['error']    = $_FILES[$act_file]['error'][$myfile_key];
								$_FILES['myfile']['size']     = $_FILES[$act_file]['size'][$myfile_key];
								$fileData = $this->obj->uploadFiles($_FILES['myfile'], $allowed_extensions);
								// pr($fileData);die;
								if(isset($fileData['success'])){
									$upld_file[]	= $fileData['success']['file_name'];
								}
							}
						}
						if(isset($upld_file) && !empty($upld_file))
						{
							$postData[$act_file] = implode("####", $upld_file);
						}
						// pr($postData[$act_file]);die;
						/*End save client multiple  document*/
					}
					elseif($frm_data['data-input']=='file')
					{
						/*Start save client multiple  document*/
						$upld_file 	= [];
						$act_file 	= $frm_data['name'];
						if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
						{
							$_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
							$_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
							$_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
							$_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
							$_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
							$fileData=$this->obj->uploadFiles($_FILES['myfile']);
							
							if(isset($fileData['success'])){
								$upld_file	= $fileData['success']['file_name'];
							}
						}
						if(isset($upld_file) && !empty($upld_file))
						{
							$postData[$act_file] = $upld_file;
						}
					}
				}
				elseif($frm_data['type']=='multiselect')
				{
					$frm_name 				= $frm_data['name'];
					$postData[$frm_name] 	= @implode(",", $_POST[$frm_name]);
				}
			}
			// pr($postData);die;
			unset($postData['submit']);
			set_common_insert_value2();
			if($res->form_name == 'enquiry')
			{
				$postData['enquiry_type']= $this->obj->type;
			}
			
			$this->obj->db->insert(TBL_PREFIX . $res->form_name, $postData);
			$id = $this->obj->db->insert_id();
			/*if($res->form_name == 'enquiry')
			{
				$inqPrefix      = "ENQ";
				$enq_no         = str_pad($id,2,"0",STR_PAD_LEFT);
				$final_enq_no   = $inqPrefix.$enq_no;
				$this->obj->db->where(PRIMARY_KEY, $id);
				$this->obj->db->set('enq_no', $final_enq_no);
				$this->obj->db->set('enquiry_type', $this->obj->type);
				$this->obj->db->update(TBL_PREFIX . $res->form_name);
			}*/
			//echo $id;die;
			if (!empty($id)) {
				clearPostData();
				set_flashdata('success', 'Record successfully saved.');
				redirect(($this->obj->data['base_url'].'/list_items'));
			}
		}

		$cols  = json_decode($res->form_data);
		// pr($cols);die;
		if(isset($cols->form_data) && !empty($cols->form_data))
		{
			foreach ($cols->form_data as $block_key => $block) {
				// echo "string";
				if(isset($block->elements) && !empty($block->elements))
				{
					foreach ($block->elements as $elem_key => $element) {
						// pr($element->name);
						if($element->option_type=='table')
						{
							if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
							{
								$table_name = $element->options->table_name;
								$label_name = $element->options->label_name;
								$value_name = $element->options->value_name;
								if ($this->obj->db->table_exists($table_name) )
								{
									$list_fields = $this->obj->db->list_fields($table_name);
									if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
									{
										
										$this->obj->db->select("$label_name, $value_name");
										if($table_name=='company_employee')
										{
											$this->obj->db->where('desg_id',2);
										}
										if($table_name=='users' && $element->name=='inch_name')
										{
											$this->obj->db->where('group_id',3); // sales space group
										}
										if($table_name=='users' && $element->name=='cfit_name')
										{
											$this->obj->db->where('group_id',31);// China group
										}
										$result = $this->obj->db->get($table_name)->result();

										$cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
									}
									
									// pr($result);die;
								}
							}
						}
					}
				}
			}
		}
		else
		{
			set_flashdata('error','Incomplete Module');
			redirect(($this->obj->data['base_url'].'/list_items'));
		}

		$form_data 						 = $cols->form_data;
		$this->obj->data['action']       = "add";
		$this->obj->data['module_title'] = "Create ".ucwords($res->form_label);
		// $this->obj->data['form_title']   = ucwords($res->form_label)." Form";
		$this->obj->data['form_title']   = "Enquiry";
		$this->obj->data['table_id']     = $id;
		// $this->obj->data['cols']      = $cols;
		$this->obj->data['form_data']    = $form_data;
		$views[]                         = "add_form";
		$this->obj->data['submodule']    = 'Add Sales Spares Enquiry China';
		view_load($views, $this->obj->data);

	}

	public function dynamic_edit($recId, $table_name)
	{
		
		if (!$recId && !$table_name) {
			redirect(($this->obj->data['base_url'].'/list_items'));
		}
		$res = $this->obj->form_module_mod->get_form_by_name($table_name);
		$id = $res->id;
		$result1 = $this->obj->form_module_mod->dynamic_list_view($recId, $id);
		// pr($res);die;
		if (isPostBack()) {
			$postData = $this->obj->input->post(null, true);
			// pr($_FILES);
			// pr($postData);die;
			$all_form_data = [];
			if(isset($res->form_data) && !empty($res->form_data))
			{
				$form1 = json_decode($res->form_data);
				$move_columns = $form1->form_data;
				if(count($form1->form_data) && !empty($form1->form_data)){
					foreach ($form1->form_data as $key1 => $value) {
						if(!empty($value->elements && count($value->elements)>0))
						{
							foreach ($value->elements as $key2 => $value) {
								$all_form_data[] = $value;
							}
						}
					}
				}
			}
			// pr($all_form_data);die;
			foreach ($all_form_data as $key => $frm_data1) {
				$frm_data = (array) $frm_data1;
				if($frm_data['type']=='file')
				{
					// pr($frm_data);die;
					if($frm_data['data-input']=='multiplefile')
					{
						/*Start save client multiple  document*/
						$upld_file 	= [];
						$act_file 	= $frm_data['name'];
						$allowed_extensions = $frm_data['allowed_extensions'];
						// pr($act_file);die;
						if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name'][0]))
						{
							foreach ($_FILES[$act_file]['name'] as $myfile_key => $myfile) {
								$_FILES['myfile']['name']     = $_FILES[$act_file]['name'][$myfile_key];
								$_FILES['myfile']['type']     = $_FILES[$act_file]['type'][$myfile_key];
								$_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'][$myfile_key];
								$_FILES['myfile']['error']    = $_FILES[$act_file]['error'][$myfile_key];
								$_FILES['myfile']['size']     = $_FILES[$act_file]['size'][$myfile_key];
								$fileData = $this->obj->uploadFiles($_FILES['myfile'], $allowed_extensions);
								// pr($fileData);die;
								if(isset($fileData['success'])){
									$upld_file[]	= $fileData['success']['file_name'];
								}
							}
						}
						if(isset($upld_file) && !empty($upld_file))
						{
							$postData[$act_file] = implode("####", $upld_file);
						}
						// pr($postData[$act_file]);die;
						/*End save client multiple  document*/
					}
					elseif($frm_data['data-input']=='file')
					{
						/*Start save client multiple  document*/
						$upld_file 	= [];
						$act_file 	= $frm_data['name'];
						if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
						{
							$_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
							$_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
							$_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
							$_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
							$_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
							$fileData=$this->obj->uploadFiles($_FILES['myfile']);
							
							if(isset($fileData['success'])){
								$upld_file	= $fileData['success']['file_name'];
							}
						}
						if(isset($upld_file) && !empty($upld_file))
						{
							$postData[$act_file] = $upld_file;
						}
					}
				}
				elseif($frm_data['type']=='multiselect')
				{
					$frm_name 				= $frm_data['name'];
					$postData[$frm_name] 	= @implode(",", $_POST[$frm_name]);
				}
			}
			// pr($postData);die;
			unset($postData['submit']);
			//$this->obj->db->where('form_id',$id);
			$this->obj->db->trans_start();
			set_common_update_value2();
			$this->obj->db->where('form_id', $recId);
			$res =  $this->obj->db->update(TBL_PREFIX . $res->form_name, $postData);
			$this->obj->db->trans_complete();
			//echo $id;die;
			if (!empty($id)) {
				clearPostData();
				set_flashdata('success', 'Record successfully saved.');
				redirect(($this->obj->data['base_url'].'/list_items'));
			}
		}

		$cols  = json_decode($res->form_data);
		// pr($cols);die;
		if(isset($cols->form_data) && !empty($cols->form_data))
		{
			foreach ($cols->form_data as $block_key => $block) {
				// echo "string";
				if(isset($block->elements) && !empty($block->elements))
				{
					foreach ($block->elements as $elem_key => $element) {
						if($element->option_type=='table')
						{
							if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
							{
								$table_name = $element->options->table_name;
								$label_name = $element->options->label_name;
								$value_name = $element->options->value_name;
								if ($this->obj->db->table_exists($table_name) )
								{
									$list_fields = $this->obj->db->list_fields($table_name);
									if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
									{

										if($table_name=='company_employee')
										{
											$this->obj->db->where('desg_id',2);
										}
										if($table_name=='users' && $element->name=='inch_name')
										{
											$this->obj->db->where('group_id',3); // sales space group
										}
										if($table_name=='users' && $element->name=='cfit_name')
										{
											$this->obj->db->where('group_id',31);// China group
										}
										$result = $this->obj->db->select("$label_name, $value_name")->get($table_name)->result();
										$cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
									}

									
									// pr($result);die;
								}
							}
						}
						elseif($element->option_type=='dependent')
						{
							// 
							$table_name = $element->options->table_name;
							$label_name = $element->options->label_name;
							$value_name = $element->options->value_name;
							$event_field = $element->options->event_field;
							$condition_column = $element->options->condition_column;
							$condition_values = $result1['data'][$event_field];

							if(isset($condition_values) && !empty($condition_values))
							{
								$condition_values = explode(",", $condition_values);
							}
							$this->obj->db->select("$label_name, $value_name");
							$this->obj->db->where_in("$condition_column",$condition_values);
							// echo $this->obj->db->last_query();
							$query = $this->obj->db->get("$table_name");
							if ($query->num_rows() > 0) {
								$result  = $query->result_array();
								$cols->form_data[$block_key]->elements[$elem_key]->options->dpnd_data = $result; 
							}
							// pr($element);die;
						}
					}
				}
			}
		}
		else
		{
			set_flashdata('error','Incomplete Module');
			redirect(($this->obj->data['base_url'].'/list_items'));
		}

		$form_data 					     = $cols->form_data;
		$this->obj->data['action']       = "edit";
		$this->obj->data['module_title'] = "Create ".ucwords($res->form_label);
		// $this->obj->data['form_title']   = ucwords($res->form_label)." Form";
		$this->obj->data['form_title']   = "Enquiry";
		$this->obj->data['table_id']     = $id;
		// $this->obj->data['cols']      = $cols;
		$this->obj->data['data_list']    = $result1['data'];
		$this->obj->data['columns']  	 = $result1['columns'];
		$this->obj->data['form_data']    = $form_data;
		$views[]                         = "edit_form";
		// $this->obj->data['state'] = get_state_from_master_acord_country($result->country);
		// $this->obj->data['city'] = get_state_from_master_acord_country($result->state_comp);
		$this->obj->data['submodule']    = 'Add Dynamic Values';
		// pr($form_data);die;
		view_load($views, $this->obj->data);

	}
	
	public function dynamic_view($recId, $table_name, $id)
	{
		
		if (!$table_name && !$id) {
			redirect(base_url());
		}
		$res = $this->obj->form_module_mod->get_form($id);
		$result1 = $this->obj->form_module_mod->dynamic_list_view($recId, $id);
		$cols  = json_decode($res->form_data);
		// pr($cols);die;
		if(isset($cols->form_data) && !empty($cols->form_data))
		{
			foreach ($cols->form_data as $block_key => $block) {
				// echo "string";
				if(isset($block->elements) && !empty($block->elements))
				{
					foreach ($block->elements as $elem_key => $element) {
						if($element->option_type=='table')
						{
							if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
							{
								$table_name = $element->options->table_name;
								$label_name = $element->options->label_name;
								$value_name = $element->options->value_name;
								if ($this->obj->db->table_exists($table_name) )
								{
									$list_fields = $this->obj->db->list_fields($table_name);
									if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
									{

										$result = $this->obj->db->select("$label_name, $value_name")->get($table_name)->result();
										$cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
									}
									
									// pr($result);die;
								}
							}
						}
						elseif($element->option_type=='dependent')
						{
							// 
							$table_name = $element->options->table_name;
							$label_name = $element->options->label_name;
							$value_name = $element->options->value_name;
							$event_field = $element->options->event_field;
							$condition_column = $element->options->condition_column;
							$condition_values = $result1['data'][$event_field];

							if(isset($condition_values) && !empty($condition_values))
							{
								$condition_values = explode(",", $condition_values);
							}
							$this->obj->db->select("$label_name, $value_name");
							$this->obj->db->where_in("$condition_column",$condition_values);
							// echo $this->obj->db->last_query();
							$query = $this->obj->db->get("$table_name");
							if ($query->num_rows() > 0) {
								$result  = $query->result_array();
								$cols->form_data[$block_key]->elements[$elem_key]->options->dpnd_data = $result; 
							}
							// pr($element);die;
						}
					}
				}
			}
		}
		else
		{
			set_flashdata('error','Incomplete Module');
			redirect(base_url('form_module/'));
		}

		$form_data 					= $cols->form_data;
		$this->obj->data['action']       = "add";
		$this->obj->data['module_title'] = "Create ".ucwords($res->form_name);
		$this->obj->data['form_title']   = ucwords($res->form_name)." Form";
		$this->obj->data['table_id']     = $id;
		$this->obj->data['data_list']   	= $result1['data'];
		$this->obj->data['columns']  	= $result1['columns'];
		$this->obj->data['form_data']    = $form_data;
		$views[]                    = "view_form";
		$this->obj->data['submodule']    = 'Add Dynamic Values';
		// pr($form_data);die;
		view_load($views, $this->obj->data);

	}

	public function get_dependent_data()
	{
		if ($this->obj->input->is_ajax_request()) {
			// pr($_POST);die;
			
			$label_title		= $this->obj->input->get_post('label_title');
			$tblname            = $this->obj->input->get_post('tblname');
			$label_name         = $this->obj->input->get_post('label_name');
			$value_name         = $this->obj->input->get_post('value_name');
			$condition_column   = $this->obj->input->get_post('condition_column');
			$condition_values   = $this->obj->input->get_post('condition_values');
			$options 			= '';
			$this->obj->db->select("$label_name, $value_name");
			$this->obj->db->where_in("$condition_column",$condition_values);
			$query = $this->obj->db->get("$tblname");
			// echo $this->db->last_query();
			if ($query->num_rows() > 0) {
				$options .= '<option value="" disabled="" selected>Select '.$label_title.'</option>';
				$result  = $query->result_array();
				// pr($result);
				foreach ($result as $key => $value) {
					$options .= "<option value='" . $value[$value_name] . "'>" . $value[$label_name] . "</option>";
				}
				// pr($options);
				echo json_encode(['status' => 1, 'message' => 'Record found', 'data' => $options]);
			} else {
				$options .= '<option value="" disabled="">No '.$label_title.' Found</option>';
				echo json_encode(['status' => 0, 'message' => 'No record found', 'data' => $options]);
			}
			// pr($res);die;

		} else {
			echo json_encode(['status' => 0, 'message' => 'No direct script access allowed', 'data' => $options]);
		}
	}

	private function uploadFiles($file_arr, $ext = '') {
		
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
		$query = $this->obj->db->get(TBL_PREFIX."enquiry_document");
		if($query->num_rows()>0)
		{
			$row = $query->row();
			// pr($row);die;
			$filepath = FCPATH.'/upload/enquiry/'.$row->file_name;
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

	public function download_supplier_sheet($enquiry_id)
	{
		$enquiry_list = $this->obj->enquiry_database_mod->get_enquiry_list($this->obj->type, $enquiry_id, '', '', '');
	   	$product_list = $this->obj->enquiry_database_mod->get_product_list(NULL, $enquiry_id);
	   	// pr($enquiry_list);die;
		if(isset($enquiry_list) && !empty($enquiry_list['result'][0]->enq_no) && isset($product_list) && !empty($product_list))
		{
			$filename = $enquiry_list['result'][0]->enq_no . "_Supplier Sheet" . date('d-m-Y'). ".xls";

	        $header = "Comm ID \t Description English \t Description Chinease \t Make English \t make Chinease \t Qty  \t UOM  \t Unit Price/单价 ¥  \t VAT %  \t Unit price with Tax 含税单价 ¥  \t Total Price with Tax/含税总价 ¥ \t Delivery time交货时间 \t Goods Gross weight货物毛重/kgs \t Payment term付款方式 \t Valid date报价有效期 \t Delivery Cost/ 交货 成本 \t Packing Cost/包装费用 \t Warranty period/保修期";
	      	$i = 1;
            foreach ($product_list as $product) {
	            $data_array[] = array(
	                'Comm ID' => $enquiry_list['result'][0]->enq_no.'-'.$i++,
	                'Description English' => $product->description_issued_by_inch,
	                'Description Chinease' => $product->make_issue_inch,
	                'Make English' =>$product->description_issued_by_cfit,
	                'Make Chinease' =>$product->make_issue_cfit,
	                'Qty' =>$product->qty,
	                'UOM' => $product->unit_name,
	                'Unit Price' => '',
	                'VAT' => '',
	                'Unit price with Tax' => '',
	                'Total Price with Tax' => '',
	                'Delivery time' => '',
	                'Goods Gross weight' => '',
	                'Payment term' => '',
	                'Valid date' => '',
	                'Delivery Cost' =>'',
	                'Packing Cost' =>'',
	                'Warranty period' =>'',
	            );
            }
            // pr($data_array);die;
        	array_to_exl($header, $data_array, $filename);
		}
		else
		{
			echo "string";
			return false;
		}
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

 	/*Chat system*/
	public function get_ticket_message_chat() {

        //$this->load->model('sale/order');
        $ticket_id_for_message = $this->obj->input->post('ticket_id_for_message');

     	$update_chat= $this->obj->enquiry_database_mod->updatechat($ticket_id_for_message);
		                               
        if (!empty($ticket_id_for_message)) {
            $result = $this->obj->enquiry_database_mod->get_ticket_message_chat($ticket_id_for_message);
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
           	$this->obj->enquiry_database_mod->insert_chat($_POST);
           
          	$this->obj->session->data['success'] = "Chat Message Sent Successfully"; 
          	$this->obj->response->redirect($this->obj->url->link('sale/order', 'token=' . $this->obj->session->data['token'] . $url, 'SSL'));
        }
        
    }

    public function tickets_logs() {

        $ticket_id = $this->obj->input->post('ticket_id');
        $this->obj->enquiry_database_mod->updatechat($ticket_id);
        $log = $this->obj->ticket_refresh();
    }

    public function ticket_refresh() {

        $ticket_id = $this->obj->input->post('ticket_id');
       	
        $log = $this->obj->enquiry_database_mod->get_ticket_message_chat($ticket_id);

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
            $data['status'] = 'success';
            $data['tickets_log'] = $log;
            $data['tickets_log_view'] = $html;
        } else {
            $data['status'] = 'error';
            $data['tickets_log_view_error'] = '<li class="chat_thread by_support"> <h5>No Chat Found</h5> </li>';
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
        $this->obj->enquiry_database_mod->insert_chat($dat);
        $data['status'] = 'success';
        echo json_encode($data);
    }

    
 	/*Chat system*/

		
}

	
 