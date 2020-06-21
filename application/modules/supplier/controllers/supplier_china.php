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
 
class Supplier_China extends MY_Controller {
   
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

        $this->load->model('supplier_china_mod');
		$this->load->model('opportunity/opportunity_mod');
        $this->load->model('product/product_mod');
        $this->lang->load('supplier_china', get_site_language());
               
        $this->data['head']['title'] = "Supplier";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("supplier/supplier_china");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "supplier_ind";

		$this->data['module'] = 'Supplier/Supplier China';
        $this->data['module_link'] = base_url("supplier/supplier_china")."/list_items";
        
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
	   $result = $this->supplier_china_mod->get_vendor();
	   $state = $this->supplier_china_mod->get_china_state();
	   if(isPostBack())
       {
            $id = $this->supplier_china_mod->add();
            if($id){
                redirect($this->data['base_url']."/list_items/");
            }else{
                //redirect($this->data['base_url']."/add");
			}
       }
	   $table_data = $this->supplier_china_mod->get_table_name();
	   //pr($table_data);die;
	   foreach($table_data as $key=>$val){ 
			
		   if($val->form_name=='china_bank_name'){
			$table_name = 'inch_china_bank_name';
			$form_data ='';
			$this->data['sup_china_bank_name'] = dynamic_module_master($table_name,$form_data);
		   }
		}
	   $this->data['vendor'] = $result;
	   $this->data['state'] = $state;
       $this->data['action'] = "add";
       //$this->data['country'] = get_country_from_master();
       $this->data['department'] = get_all_department_from_masters();
       $this->data['designation'] = get_all_designation_from_masters();
	   $views[] = "supplier_china/lead_form";
	   $this->data['submodule'] = 'Add ';
	   //$data['industry'] = $this->supplier_ind_mod->get_industry();
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
       $result = $this->supplier_china_mod->get($id);
	   $table_data = $this->supplier_china_mod->get_table_name();
	  // pr($table_data);die;
	   $vendor = $this->supplier_china_mod->get_vendor();	
		$this->data['vendor'] = $vendor;
	   foreach($table_data as $key=>$val){
			
		   if($val->form_name=='china_bank_name'){
			$table_name = 'inch_china_bank_name';
			$form_data ='';
			$this->data['sup_china_bank_name'] = dynamic_module_master($table_name,$form_data);
		   }
		}
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "supplier_china/view_lead"; 
		view_report($id);
	   $this->data['submodule'] = 'View Supplier';
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
        $vendor = $this->supplier_china_mod->get_vendor();
	   $state = $this->supplier_china_mod->get_china_state();	
       if(isPostBack())
       {
           $r = $this->supplier_china_mod->update($id);
            if($r){
                redirect($this->data['base_url']."/list_items/");
            }else{
                //redirect($this->data['base_url']."/edit/".$id);
			}
       }
       $table_data = $this->supplier_china_mod->get_table_name();
	   //pr($table_data);die;
	   foreach($table_data as $key=>$val){
			
		   if($val->form_name=='china_bank_name'){
			$table_name = 'inch_china_bank_name';
			$form_data ='';
			$this->data['sup_china_bank_name'] = dynamic_module_master($table_name,$form_data);
		   }
		}
	   $note = $this->supplier_china_mod->get_notes($id);
	   $this->data['note'] = $note;
       $result = $this->supplier_china_mod->get($id);
       //$result = $this->fetch_city_by_state_id();
       $this->data['city'] = get_city_from_master_acord_state($result->state_id);
       $this->data['department'] = get_all_department_from_masters();
       $this->data['designation'] = get_all_designation_from_masters();
       $this->data['vendor'] = $vendor;
	   $this->data['state'] = $state;
	   $this->data['result'] = $result;
       $this->data['action'] = "edit";
	   //$this->data['country'] = get_country_from_master();
	   //$this->data['state'] = get_state_from_master();
       
       $views[] = "supplier_china/lead_form";

	   $this->data['submodule'] = 'Edit China Supplier';
	   
	  //pr($this->data);die;
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
        
		$views[] = "supplier_china/lead_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->supplier_china_mod->get_flexigrid_cols();

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
        $result =  $this->supplier_china_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$user);
		//pr($result);die;
		$priority = _priority();
        $referalSource = _referalSourceList();
        foreach ($result['result'] as $row) { //pr($row);die;
                    
                    $row->country_name = ucwords($row->country_name); 
					$row->state_name = ucwords(strtolower($row->state_name)); 
					$row->city_name = ucwords(strtolower($row->city_name)); 
					//pr($row->city_name);die;
					
					if($row->vendor_type==1){
						$row->vendor_type = "Manufacturer";
					}if($row->vendor_type==2){
						$row->vendor_type = "Auth. Agent";
					}if($row->vendor_type==3){
						$row->vendor_type = "Agent";
					}if($row->vendor_type==4){
						$row->vendor_type = "Trader";
					}if($row->vendor_type==5){
						$row->vendor_type = "Services";
					}if($row->vendor_type==6){
						$row->vendor_type = "Other";
					}
		}
        $this->data['grid']['result'] = $result;
        $this->data['grid']['total'] = $result['total'];
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
       
        $this->data['submodule'] = 'Supplier List';
        // pr($this->data);die;
		view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->supplier_china_mod->perPage($user->id);
       
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->supplier_china_mod->insert_perPage($pageArr);
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
        
        $data = $this->supplier_china_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
       
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->supplier_china_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];
        // die('hii');
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
            

            $result =  $this->supplier_china_mod->ajax_list_items($text, null, null, null, null,null,$is_export,$items_data);

            $result = $result['result'];
            $table_columns = ["name"=>"Vendor Name/供应商名称","vendor_name"=>"vendor Type","vendor_code"=>"Vendor Code","state_name"=>"State/Province","city_name"=>"City"];
            $filename = "Supplier China" . date('d-m-Y'). ".xls";
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
       $vendor = $this->supplier_china_mod->delete($id);
	   $this->data['vendor'] = $vendor;
       $this->data['action'] = "delete";
	   //$this->data['country'] = get_country_from_master();
	   //$this->data['state'] = get_state_from_master();
       
       $views[] = "supplier_china/lead_list";
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
			echo $data['value'] = $this->supplier_china_mod->fetch_state($id);
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
			echo $data['value'] = $this->supplier_china_mod->fetch_city($id);
		}else{
			return false;
		}
    }    

    public function checkVendorCodeExistence() {
        is_ajax_request();
        $vendor_code = $this->input->post('vendor_code', true);
        $result = $this->supplier_china_mod->check_vendor_code_existance($vendor_code);
        //pr($result);die;
        if ($result == true)
            echo true;
    }
	  public function remove_client_doc() {

			if(isset($_GET['leads_sales_spares_doc_id']) && !empty($_GET['leads_sales_spares_doc_id']) && is_numeric($_GET['leads_sales_spares_doc_id']))
			{
				$leads_sales_spares_doc_id = $_GET['leads_sales_spares_doc_id'];
				$this->db->select('filename');
				$this->db->where('id',$leads_sales_spares_doc_id);
				$record = $this->db->get("supplier_china_doc")->row();
				if(isset($record->filename) && !empty($record->filename))
				{
					unlink(FCPATH.'upload/supplier_china/'.$record->filename);
					$this->db->where('id',$leads_sales_spares_doc_id);
					$this->db->delete('supplier_china_doc');
					echo json_encode(['status'=>1,'message'=>'Document removed.']);
				}
				else
				{
					echo json_encode(['status'=>0,'message'=>'Document not found.']);
				}
			}
			else
			{
				echo json_encode(['status'=>0,'message'=>'Document did not remove.']);
			}
		}
    	
}

    
 