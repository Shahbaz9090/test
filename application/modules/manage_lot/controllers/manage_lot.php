<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Manage_lot Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Manage_lot
 * @author		Pradeep Kumar
 * @website		http://www.techbuddieit.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Manage_lot extends MY_Controller {
   
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
        define('PRIMARY_KEY', 'id');
        $this->load->model('lot_mod');
        $this->lang->load('manage_lot', get_site_language());
        $this->data['title'] 	        = "Lot management";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("manage_lot/");
        $this->data['module_url'] 		= base_url("manage_lot/list_items");
        $this->data['table_name']       = "manage_lot";
		$this->data['module'] 			= 'Manage Lot';
		$this->data['china_designation'] = [31,32];
        $currentuserinfo                = currentuserinfo();
        // pr($currentuserinfo);die;
        if(isset($currentuserinfo->is_super) && !empty($currentuserinfo->is_super) && $currentuserinfo->is_super==1 && $currentuserinfo->name=='Super Admin')
        {
            $this->data['designation'] = 'Super Admin';
            $this->data['is_india']    = 1;
            $this->data['is_china']    = 1;
        }
        else
        {
            
            $this->data['designation'] = $currentuserinfo->group_id;
            if(in_array($currentuserinfo->group_id, $this->data['china_designation']))
            {
                $this->data['is_india'] = 0;
                $this->data['is_china'] = 1;
            }
            else
            {
                $this->data['is_india'] = 1;
                $this->data['is_china'] = 0;
            }
        }
    }
    
	public function index()
	{
		redirect($this->data['module_url']);
	}

	public function list_items()
    {  
        /*Pagination*/
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
        $response 					= $this->lot_mod->get_list($this->type, '', '', PERPAGE, $page);
        $this->data['data_list']    = $response['result'];
        $this->data['total_record'] = $response['total'];
        $config['total_rows']       = $response['total'];
        // pr($response);die;
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $this->data['pagination_link'] 	= $this->pagination->create_links();
        /*Pagination*/
        $this->data['place_holder']    	= "Enter filter terms here";        
        $this->data['action']          	= "list";
        $views[]						= "lot_list";
        // pr($this->data);die;
        view_load($views, $this->data);
    }
    
    public function add()
    {
    	if(isPostBack())
		{
			$status = $this->lot_mod->add();
			if($status)
			{
				redirect($this->data['module_url']);
			}
		}
		$this->data['action']		= "add_product";
		$this->data['title']		= lang('add_lot').' '.$response['result'][0]->po_no;
		$views[]					= "add_lot";
		$this->data['order_list'] 	= $this->lot_mod->get_order_list(NULL, 20);
		$this->data['submodule']    = 'Add Lot';
		// pr($this->data['unit_master']);die;
		view_load($views, $this->data);
    }

	public function edit($id)
    {
        $this->order_lib->edit( $id, $this->data['table_name'] );
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

		if(isPostBack())
        {
           	// pr($_POST);die;
            if(isset($_POST['change_india_status']))
            {
                $status_id = $this->input->post('status_id');
                $whose = 'india';
           	 	// $status = $this->lot_mod->change_order_status($status_id, $whose, $order_id);
            }
            
            if($status)
            {
            	set_flashdata('success',' Status changed successfully.');
                return redirect($this->data['module_url'].'/view/'.$order_id);
            }
        }
		$mails				= $this->lot_mod->get_mail_list($this->data['result']->mail_no, $this->data['result']->china_mail_no);
        $result				= $this->lot_mod->get_list($id);
		$mail_list			= $mails['india_mail_list'];
		$china_mail_list  	= $mails['china_mail_list'];
		$user_sess			= currentuserinfo();
        $user_id			= $user_sess->id;
        $user_name			= $user_sess->first_name.' '.$user_sess->last_name;
		$this->data['action']			= "view";
		$this->data['user_id'] 			= $user_id;
		$this->data['user_name']		= $user_name;
		$this->data['mail_lists']		= @$mail_list['mail_list'];
		$this->data['result']			= @$result['result'];
		$this->data['china_mail_lists']	= @$china_mail_list['mail_list'];
		$this->data['china_attachments']= @$china_mail_list['mail_doc'];
		$views[]						= "view_lot"; 
		$this->data['submodule']    = 'View Lot';
		add_report($order_id);
		view_load($views,$this->data);
	   
	}
	
	public function get_order_list()
	{
		if($this->input->is_ajax_request())
		{
			$searchText = $this->input->post('searchText');
			$result 	= $this->lot_mod->get_order_list($searchText);
			if(isset($result) && !empty($result))
			{
				$option = '';
				foreach ($result as $key => $row) {
					$option .= "<option value=".$row->form_id.">".$row->po_no."</option>";
				}
				echo json_encode(['status'=>1,'message'=>'Record successfully found.','data'=>$option]);
			}
			else
			{
				echo json_encode(['status'=>0,'message'=>'Record successfully found.','data'=>'']);
			}
		}
		else
		{
			echo json_encode(['status'=>0,'message'=>'Direct script not allowed.','data'=>'']);
		}
	}

	public function get_order_product_list()
	{
		if($this->input->is_ajax_request())
		{
			$ids 			= $this->input->post('ids');
			$added_product	= $this->input->post('added_product');
			// pr($_POST);die;
			if(isset($ids) && !empty($ids)){$ids = explode(",", $ids);}
			if(isset($added_product) && !empty($added_product)){$added_product = explode(",", $added_product);}
			$result 	= $this->lot_mod->get_order_product_list($ids, $added_product);
			if(isset($result) && !empty($result))
			{
				$table_row = '';
				$i = 1;
				$p = 0;
				$n = 0;
				$prd = 0;
				foreach ($result as $key => $row) {
					$p = $n;
					$n = $row->form_id;
					$unit_offer_price = isset($row->unit_offer_price) && !empty($row->unit_offer_price)?$row->unit_offer_price:0;
					$total_unit_offer_price = isset($row->total_unit_offer_price) && !empty($row->total_unit_offer_price)?$row->total_unit_offer_price:0;
					if($p==$n){$prd=1;}else{$prd++;}
					$table_row .= '<tr class="product_'.$row->form_id.'">';
                    $table_row .= '<td>';
                	$table_row .= '<input onchange="add_in_box(this,'.$row->form_id.','.$row->order_id.','.$row->qty.','.$unit_offer_price.','.$total_unit_offer_price.','."'".$row->po_no."'".')" type="checkbox" value="1" data-order-id="'.$row->order_id.'" data-product-id="'.$row->form_id.'" class="record_checkbox"/>';
                    $table_row .= '</td>';
                    $table_row .= '<td class="text-left">'.$i++.'</td>';
                    $table_row .= '<td class="text-left">'.$row->po_no.'-'.$prd.'</td>';
                    $table_row .= '<td class="text-left">'.$row->description_issued_by_inch.'</td>';
                    $table_row .= '<td class="text-left">'.$row->qty.'</td>';
                    $table_row .= '<td class="text-left">'.$row->unit_offer_price.'</td>';
                    $table_row .= '<td class="text-left">'.$row->total_unit_offer_price.'</td>';
                	$table_row .= '</tr>';
				}
				echo json_encode(['status'=>1,'message'=>'Record successfully found.','data'=>$table_row]);
			}
			else
			{
				echo json_encode(['status'=>0,'message'=>'Record successfully found.','data'=>'']);
			}
		}
		else
		{
			echo json_encode(['status'=>0,'message'=>'Direct script not allowed.','data'=>'']);
		}
	}

	public function add_document($lot_id)
	{     

		if(isPostBack())
		{
			$status = $this->lot_mod->add_document($lot_id);
			if($status)
			{
				set_flashdata("success",'Success');
				redirect($this->data['module_url'].'/view/'.$lot_id);
			}
			else
			{
				set_flashdata("error",'Error');
				redirect($this->data['module_url'].'/view/'.$lot_id);
			}
		}
	}

	/*Chat system*/
	public function get_ticket_message_chat() {

        //$this->load->model('sale/order');
        $ticket_id_for_message = $this->input->post('ticket_id_for_message');

     	$update_chat= $this->order_mod->updatechat($ticket_id_for_message);
		                               
        if (!empty($ticket_id_for_message)) {
            $result = $this->order_mod->get_ticket_message_chat($ticket_id_for_message);
        }
        foreach ($result as $key_r => $val_r) {
            $result[$key_r]['CREATED_DATE'] = date('d-m-Y H:i:s', strtotime($val_r['created_date']));
        }

        //echo "<pre>";print_r($result);die;

        echo json_encode($result);
    }

    public function add_chat(){
        
        if (($this->input->server('REQUEST_METHOD') == 'POST')) { 
            //$this->load->model('sale/order');
           	$this->order_mod->insert_chat($_POST);
           
          	$this->session->data['success'] = "Chat Message Sent Successfully"; 
          	$this->response->redirect($this->url->link('sale/order', 'token=' . $this->session->data['token'] . $url, 'SSL'));
        }
    }

    public function tickets_logs() {

        $ticket_id = $this->input->post('ticket_id');
        $this->order_mod->updatechat($ticket_id);
        $log = $this->ticket_refresh();
    }

    public function ticket_refresh() {

        $ticket_id = $this->input->post('ticket_id');
       	
        $log = $this->order_mod->get_ticket_message_chat($ticket_id);

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

        $user_id    		= currentuserinfo()->id;
        $dat['ticket_id'] 	= $this->input->post('ticket_id');
        $dat['receiver'] 	= $this->input->post('receiver_id');
        $dat['sender'] 		= 1;
        $dat['is_read'] 	= 1;
        $dat['is_user_read']= 1;
        $dat['added_by'] 	= $user_id;
        $dat['content'] 	= $this->input->post('content');
        //echo "<pre>";print_r($dat);die;
        $this->order_mod->insert_chat($dat);
        $data['status'] 	= 'success';
        echo json_encode($data);
    }
 	/*Chat system*/
	
	    
    
}

    
 