<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Lead Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Company
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Supplier_China_Contact extends MY_Controller {
   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
        isProtected();

        $this->load->model('supplier_china_contact_mod');
		$this->load->model('opportunity/opportunity_mod');
        $this->load->model('product/product_mod');
        $this->lang->load('supplier_china', get_site_language());
               
        $this->data['head']['title'] = "Supplier";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("supplier/supplier_china_contact");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "supplier_china_contact";

		$this->data['module'] = 'Supplier/Supplier India';
        $this->data['module_link'] = base_url("supplier/supplier_china_contact")."/list_items";
        
    }
    
    
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * This function add new Company
     * 
     * @access	public
     * @return	html data
     */
	public function add()
	{
		 if(isPostBack())
       {
            $id = $this->supplier_china_contact_mod->add();
            if($id){
				//set_flashdata("success",lang('success'));
                redirect($this->data['base_url']."/list_items/");
            }else{
			   //redirect($this->data['base_url']."/add");
			  }
       }
	   $table_data = $this->supplier_china_contact_mod->get_table_name();
	   //pr($table_data);die;
	   foreach($table_data as $key=>$val){
			if($val->form_name=='sup_ind_type_establishment'){
			$table_name = 'inch_sup_ind_type_establishment';
			$form_data ='';
			$this->data['sup_ind_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }
		}
       $this->data['supplier'] = $this->supplier_china_contact_mod->get_supplier();
       $this->data['department'] = get_all_department_from_masters();
        $this->data['designation'] = get_all_designation_from_masters();
	   $this->data['action'] = "add";
	   $views[] = "supplier_china_contact/lead_form";
	   $this->data['submodule'] = 'Add ';
	   //$data['industry'] = $this->supplier_china_contact_mod->get_industry();
	   //pr($this->data);die;
       view_load($views,$this->data);
	}
    
    // ------------------------------------------------------------------------

    /**
     * View
     *
     * This function View Company Details
     * 
     * @access	public
     * @param   int - Company Id
     * @return	html data
     */
	public function view($id = NULL)
	{        
       $result = $this->supplier_china_contact_mod->get($id);
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "supplier_china_contact/view_lead"; 
		$table_data = $this->supplier_china_contact_mod->get_table_name();
		$vendor = $this->supplier_china_contact_mod->get_vendor();	
		$this->data['vendor'] = $vendor;
	   //pr($table_data);die;
	   foreach($table_data as $key=>$val){
			if($val->form_name=='sup_ind_type_establishment'){
			$table_name = 'inch_sup_ind_type_establishment';
			$form_data ='';
			$this->data['sup_ind_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }
		}
		$this->data['department'] = get_all_department_from_masters();
        $this->data['designation'] = get_all_designation_from_masters();
	   $this->data['submodule'] = 'View Supplier';
	   //pr($this->data);die;
	   view_report($id);
       view_load($views,$this->data);
	}
    
    
    // ------------------------------------------------------------------------

    /**
     * Edit
     *
     * This function Edit Company Details
     * 
     * @access	public
     * @param   int - Company Id
     * @return	html data
     */
	public function edit($id = NULL)
	{  
        if(isPostBack())
       {
           $r = $this->supplier_china_contact_mod->update($id);
            if($r){
                redirect($this->data['base_url']."/list_items/");
            }else{
                //redirect($this->data['base_url']."/edit/".$id);
            }
       }
      $result = $this->supplier_china_contact_mod->get($id);
	   $this->data['supplier'] = $this->supplier_china_contact_mod->get_supplier();
       $this->data['department'] = get_all_department_from_masters();
        $this->data['designation'] = get_all_designation_from_masters();
       $this->data['result'] = $result;
       $this->data['action'] = "edit";
       $views[] = "supplier_china_contact/lead_form";

	   $this->data['submodule'] = 'Edit Company';
	  // pr($this->data);die;
	   view_load($views,$this->data);
	}
    
    // ------------------------------------------------------------------------

    /**
     * list items
     *
     * This function display all Company list
     * 
     * @access	public
     * @return	html data
     */
	public function list_items()
	{  
        
		$views[] = "supplier_china_contact/lead_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->supplier_china_contact_mod->get_flexigrid_cols();

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
        $order_by='id';
        $order='desc';
        $result =  $this->supplier_china_contact_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$user);
		// pr($result);die;
		$priority = _priority();
        $referalSource = _referalSourceList();
        foreach ($result['result'] as $row) { //pr($row);die;
                    
                    $row->country_name = ucwords($row->country_name); 
					$row->state_name = ucwords(strtolower($row->state_name)); 
					$row->city_name = ucwords(strtolower($row->city_name)); 
					//pr($row->city_name);die;
		}
        $this->data['grid']['result'] = $result;
        $this->data['grid']['total'] = $result['total'];
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
       
        $this->data['submodule'] = 'Supplier List';
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->supplier_china_contact_mod->perPage($user->id);
       
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->supplier_china_contact_mod->insert_perPage($pageArr);
        }

       
        if($this->input->post("order_by")) {
            $order_by = $this->input->post("order_by");
        }else{
            $order_by = 'id';
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
        
        $data = $this->supplier_china_contact_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
       
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->supplier_china_contact_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];

        $this->load->view('kg_grid/ajax_grid', $data);
       
  
	}
    
    
     // ------------------------------------------------------------------------

    /**
     * Export items
     *
     * This function display Export by id
     * 
     * @access	public
     * @return	html data
     */
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
            

            $result =  $this->supplier_china_contact_mod->ajax_list_items($text, null, null, null, null,null,$is_export,$items_data);

            $result = $result['result'];
            $table_columns = ["supplier_name"=>"Vendor Name/供应商名称","secondary_phone"=>"Mobile No.","email_id"=>"Email-Id","name"=>"Contact Person Name","wechat"=>"Wechat ID","department_name"=>"Department","designation_name"=>"Designation","qq_id"=>"QQ ID","personal_email"=>"Personal Email","primary_phone"=>"Personal Mobile No."];
            $filename = "Supplier China Contact" . date('d-m-Y'). ".xls";
            $this->export_lib->export($table_columns, $result, $filename); 
        } 
   
    
    
    
  // ------------------------------------------------------------------------

    /**
     * delete items
     *
     * This function display delete by id
     * 
     * @access	public
     * @return	html data
     */
    
    public function delete()
    {
       $items           = $this->input->get_post('items',TRUE);
       $items_data      = str_replace("row","",$items);       
       $items_data      = explode(",",$items_data);      
       
       $this->db->where_in("id",$items_data);
       filter_data();
       $this->db->delete($this->table_name);
       delete_report($items_data);
    }
    
/**
     * Fetch State 
     *
     * This function Fetch All State by Country id
     * 
     * @access	public
     * @return	html data
     */
    
    public function fetch_state_according_country()
    {
       $id          = $this->input->get_post('id',TRUE);
		
		if(!empty($id)){
			echo $data['value'] = $this->supplier_china_contact_mod->fetch_state($id);
		}else{
			return false;
		}
    }
	
	/**
     * Fetch City 
     *
     * This function Fetch All City by State id
     * 
     * @access	public
     * @return	html data
     */
    
    public function fetch_city_according_country()
    {
       $id          = $this->input->get_post('id',TRUE);
		
		if(!empty($id)){
			echo $data['value'] = $this->supplier_china_contact_mod->fetch_city($id);
		}else{
			return false;
		}
    }    

		public function checkVendorCodeExistence() {
        is_ajax_request();
        $vendor_code = $this->input->post('vendor_code', true);
        $result = $this->supplier_china_contact_mod->check_vendor_code_existance($vendor_code);
        //pr($result);die;
        if ($result == true)
            echo true;
    }

    	
}

    
 