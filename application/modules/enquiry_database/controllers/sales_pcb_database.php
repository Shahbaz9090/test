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

class Sales_pcb_database extends MY_Controller {
   
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
        $this->load->library('enquiry_database_lib', [$this, 'Sales PCB Database List', 2] );
        $this->load->helper('comman');
        $this->lang->load('enquiry_database', get_site_language());
        $this->export_limit 			= $this->config->item('export_limit');
        $this->delete_limit 			= $this->config->item('delete_limit');
        $this->data['title'] 	        = "Sales PCB Database Enquiry";
        $this->data['readonly'] 		= NULL;
        $this->data['base_url'] 		= base_url("enquiry_database/sales_pcb_database/");
        $this->data['module_url'] 		= base_url("enquiry_database/sales_pcb_database/");
        $this->table_name   			= "enquiry";
		$this->data['module'] 			= 'Enquiry';
    }
    
	/*public function list_items()
	{  

		$this->enquiry_database_lib->list_items();

	}*/
    /**
     * list items
     *
     * This function display all Enquiry Database list
     * 
     * @access	public
     * @return	html data
     */
	public function list_items()
	{  
		
	    $views[] = "list";
        $this->data['title'] = 'Sales PCB Database List';
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";
		
        $this->data['grid']['cols'] = $this->enquiry_database_mod->get_flexigrid_cols();
	
        $this->data['grid']['base_url'] = $this->data['base_url'];
        $this->data['grid']['export_limit'] = $this->export_limit;
        $this->data['grid']['delete_limit'] = $this->delete_limit;
        
        //check session offset
        if($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        $text = $this->input->post('text');
        $limit=@$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset=1;
        $order_by='form_id';
        $order='desc';
		//pr("yess");die;
		//$response    = $this->obj->enquiry_database_mod->get_product_list($this->obj->type);
        $result =  $this->enquiry_database_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$this->type,null);
        $i =0;
        $prev_revision_product_id = 0;
        $curr_revision_product_id = 0;
        foreach ($result['result'] as $key => $value)
        {
            $prev_revision_product_id = $curr_revision_product_id;
            $curr_revision_product_id = $value->enq_no;
             if($prev_revision_product_id == $curr_revision_product_id)
            {
                $i++;
            }
            else
            {
                $i = 1;
            }
            $result['result'][$key]->enq_no = $value->enq_no.'-'.$i;
        }
		//echo "yess";die;
        
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'form_id';
        //pr($this->data);die;
        $this->data['submodule'] = 'Sales PCB Database List';
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->enquiry_database_mod->perPage($user->id);
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->enquiry_database_mod->insert_perPage($pageArr);
        }

       
        if($this->input->post("order_by")) {
            $order_by = $this->input->post("order_by");
        }else{
            $order_by = 'form_id';
        }
        if($this->input->post("order")) {
            $order = $this->input->post("order");
        }else{
            $order = 'desc';
        }
        $offset = $this->input->post("offset");
        if(!$offset){
            $offset =1;
        }
        if(!$limit) {
            $limit = 10;
        }
        if($this->input->post("limit")) {
            $limit = $this->input->post("limit");
            $this->data["hiddenLimit"] = $limit;
        }
        if($this->input->post('text')) {
            $text = $this->input->post('text');
        } else {
            $text = null;
        }
        
        $data =  $this->enquiry_database_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$this->type,null);
        $i =0;
        $prev_revision_product_id = 0;
        $curr_revision_product_id = 0;
        foreach ($data['result'] as $key => $value)
        {
            $prev_revision_product_id = $curr_revision_product_id;
            $curr_revision_product_id = $value->enq_no;
             if($prev_revision_product_id == $curr_revision_product_id)
            {
                $i++;
            }
            else
            {
                $i = 1;
            }
            $data['result'][$key]->enq_no = $value->enq_no.'-'.$i;
        }
        //$permission=_check_perm();
       // pr($data);die;
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->enquiry_database_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];
        //pr($data);die;
        $this->load->view('kg_grid/ajax_grid', $data);
       
  
	}

    public function export($id='')
    {
        $this->load->library('export_lib');
        $text          =$this->input->get_post('text',TRUE);
        $is_export =true;
        $items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);
        if($items==''){
            $items_data='';
        }

        $result =  $this->enquiry_database_mod->ajax_list_items($text, null, null, null, null,$this->type, null, $is_export, $items_data);
        $result = $result['result'];
        //pr($result);die;
        $table_columns = ["enq_no"=>"Comm ID","description_issued_by_customer"=>"Description Issued By Customer","description_issued_by_inch"=>"Description Issued By Inch","make_issue_inch"=>"Make Issue Inch","qty"=>"QTY ","uom"=>"UOM","description_issued_by_cfit"=>"Description issued by  CFIT","make_issue_cfit"=>"Make issued by CFIT"];
        $filename = "Sales PCB Enquiry Database" . date('d-m-Y'). ".xls";
        $this->export_lib->export($table_columns, $result, $filename); 
    }
    
}

    
 