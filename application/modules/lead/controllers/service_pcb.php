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
 
class Service_Pcb extends MY_Controller {
   
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

        $this->load->model('service_pcb_mod');
		$this->load->model('user_group_mod');
        $this->load->model('company/company_mod');
		$this->load->model('opportunity/opportunity_mod');
        $this->load->model('product/product_mod');
        $this->lang->load('service_pcb', get_site_language());
               
        $this->data['head']['title'] = "Service PCB";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("lead/service_pcb");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "leads_service_pcb";

		$this->data['module'] = 'Installation Base/Service PCB';
        $this->data['module_link'] = base_url("lead/service_pcb")."/list_items";
        
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
            $id = $this->service_pcb_mod->add();
            if($id){
				//set_flashdata("success",lang('success'));
                redirect($this->data['base_url']."/list_items/");
            }else{
			   //redirect($this->data['base_url']."/add");
			  }
       }
	    $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "add";
	   $views[] = "service_pcb/lead_form";
	   $table_data = $this->service_pcb_mod->get_table_name();
		//pr($table_data);die;
		foreach($table_data as $key=>$val){
			if($val->form_name=='plc_dcs_make'){
			$table_name = 'inch_plc_dcs_make';
			$form_data ='';
			$this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='actuator_make'){
			$table_name = 'inch_actuator_make';
			$form_data ='';
			$this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vfd_make'){
			$table_name = 'inch_vfd_make';
			$form_data ='';
			$this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
		}
	  $this->data['submodule'] = 'Add Service PCB';
	  $this->data['industry'] = $this->service_pcb_mod->get_industry();
	  $this->data['country'] = get_country_from_master();
	  $this->data['department'] = get_all_department_from_masters();
      $this->data['designation'] = get_all_designation_from_masters();
		//pr($data['designation']);die;
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
       $result = $this->service_pcb_mod->get($id);
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "service_pcb/view_lead"; 
	   $appoitment = $this->service_pcb_mod->appointment_data();
       $this->data['appoitment'] = $appoitment;
	   $table_data = $this->service_pcb_mod->get_table_name();
		//pr($table_data);die;
		foreach($table_data as $key=>$val){
			if($val->form_name=='plc_dcs_make'){
			$table_name = 'inch_plc_dcs_make';
			$form_data ='';
			$this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='actuator_make'){
			$table_name = 'inch_actuator_make';
			$form_data ='';
			$this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vfd_make'){
			$table_name = 'inch_vfd_make';
			$form_data ='';
			$this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
		}
		$note = $this->service_pcb_mod->get_notes($id);
	   $this->data['note'] = $note;
	   $appoitment = $this->service_pcb_mod->appointment_data();
	   $disqualified_notes = $this->service_pcb_mod->disqualified_notes();
	   $notes = $this->service_pcb_mod->notes();
	   $product = $this->service_pcb_mod->product();
	   $service = $this->service_pcb_mod->service();
	   $this->data['service'] = $service;
	   $this->data['product'] = $product;
	   $this->data['notes'] = $notes;
       $this->data['appoitment'] = $appoitment;
       $this->data['disqualified_notes'] = $disqualified_notes;
	   $this->data['submodule'] = 'View Service PCB';
	   $this->data['leads_ids'] = $id;
	   $this->data['user_groups'] = $this->user_group_mod->get_groups();
	   $this->data['assign_user'] = $this->user_group_mod->get_users($result->group_id);
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
           $r = $this->service_pcb_mod->update($id);
		   
            if($r){
                redirect($this->data['base_url']."/list_items/");
			} else{
                $this->data['error_msg']="Oops !! This Vendor Code is Alreday Exists.";
			}
       }
       $table_data = $this->service_pcb_mod->get_table_name();
		//pr($table_data);die;
		foreach($table_data as $key=>$val){
			if($val->form_name=='plc_dcs_make'){
			$table_name = 'inch_plc_dcs_make';
			$form_data ='';
			$this->data['plc_dcs_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='actuator_make'){
			$table_name = 'inch_actuator_make';
			$form_data ='';
			$this->data['actuator_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='vfd_make'){
			$table_name = 'inch_vfd_make';
			$form_data ='';
			$this->data['vfd_make'] = dynamic_module_master($table_name,$form_data);
		   }
		   if($val->form_name=='client_type_establishment'){
			$table_name = 'inch_client_type_establishment';
			$form_data ='';
			$this->data['client_type_establishment'] = dynamic_module_master($table_name,$form_data);
		   }if($val->form_name=='type_of_client'){
			$table_name = 'inch_type_of_client';
			$form_data ='';
			$this->data['type_of_client'] = dynamic_module_master($table_name,$form_data);
		   }
		}
		$note = $this->service_pcb_mod->get_notes($id);
	   $this->data['notes'] = $note;
       $result = $this->service_pcb_mod->get($id);
	   //pr($result);die;
	   $this->data['row'] = $result;
	   $this->data['industry'] = $this->service_pcb_mod->get_industry();
	  $this->data['country'] = get_country_from_master();
	  $this->data['state'] = get_state_from_master_acord_country($result->country);
	  $this->data['city'] = get_city_from_master_acord_state($result->state_comp);
	  //pr($this->data['state']);die;
	  $this->data['department'] = get_all_department_from_masters();
      $this->data['designation'] = get_all_designation_from_masters();
       $this->data['action'] = "edit";
       $views[] = "service_pcb/lead_form";

	   $this->data['submodule'] = 'Edit Service PCB';
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
        
		$views[] = "service_pcb/lead_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->service_pcb_mod->get_flexigrid_cols();

        $this->data['grid']['base_url'] = $this->data['base_url'];
        $this->data['grid']['export_limit'] = $this->export_limit;
        $this->data['grid']['delete_limit'] = $this->delete_limit;
        
        //check session offset
        if($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
		/*Getting user by filter options*/
		if($this->input->post('user'))
		{
			$user=$this->input->post('user');
		}else if($this->input->get('user'))
		{
			$user=$this->input->get('user');
		}
		if($user)
		{
			//echo $user;die;
			if(!is_array($user)){
				$is_all = 'yes';
				$data['user_id']	=	$user;
				if(!isset($user) || !$user){
					$user=currentUserID();
				}else{
					$is_all = 'no';
				}
				if($user=='all_sm'){
				   $user=array(); 
				   $usersList=usersList(SALES_MANAGER);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}elseif($user=='all_sp'){
				   $user=array(); 
				   $usersList=usersList(SALES_PERSON);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}elseif($user=='all_tm'){
				   $user=array(); 
				   $usersList=usersList(TELE_MARKETER);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}
				if(_isTaleMarketer() || _isSalesPerson()){
					$user= currentUserID();    
				}
			}else{
				echo "asdasd";die;
			}
		}else{
			$added_by =  '';
			$is_all	=	'';		/*This is for initial land of dashboard*/
		}
        $this->data['user'] = $user;
		
		
		
		
        $text = $this->input->post('text');
        $limit=@$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset=1;
        $order_by='id';
        $order='desc';
        $result =  $this->service_pcb_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$user);
		//pr($result['result']);
		$priority = _priority();
        $referalSource = _referalSourceList();
        foreach ($result['result'] as $row) { 
            if (!empty($row->display_id)) {
                $row->display_id = '<a href="'.base_url().'lead/service_pcb/view/'.$row->id.'">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
				//$row->display_id = '<a href="#">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
            } 
			
			if (!empty($row->assigned_telemarketer)) { // for assign telemarketer value
                    $name = @get_user_data($v[$val['name']])->first_name . ' ' . @get_user_data($v[$val['name']])->last_name;
                    $result[$k][$val['name']] = ($name != ' ') ? $name : 'Not Assigned';
                } else {
                    $result[$k][$val['name']] = $v[$val['name']];
                }
				
				if (!empty($row->contact_name)) {
                    //$companyContact = _contactPersonById($row->company_contact);
                    $row->contact_name = ucwords($row->contact_name); //@$companyContact->contact_person;
                }
				
				/*if ($row->lead_status==0 || $row->lead_status) {
                    $status = _getLeadStatus($row->lead_status);
                    $row->lead_status = ucwords($status); //@$companyContact->contact_person;
                }
				
				if ($row->company_name==0 || $row->company_name) {
                   $row->company_name = @_companyNameById($row->company_name);
                    //@$companyContact->contact_person;
                }*/
				
				if ($row->priority==0 || $row->priority) {
                   $row->priority = @$priority[$row->priority];
                    //@$companyContact->contact_person;
                }
				
				/*if ($row->added_by==0 || $row->added_by) {
                   $row->added_by = $row->ADDED_BY;
                    //@$companyContact->contact_person;
                }*/
				
				if ($row->referral_source==0 || $row->referral_source) {
                   $row->referral_source = @$referalSource[$row->referral_source];
                    
                }
				
				if ($row->created==0 || $row->created) {
                   $row->created = date("d/m/Y ",strtotime($row->created_time));
                    
                }
				
				if ($row->follow_up_date==0 || $row->follow_up_date) {
                   $row->follow_up_date = formatDate(_latestFollowUpDate($row->follow_up_date));
				   
				    $followupdate = date('d-m-Y',strtotime($row->follow_up_date));
			        if($followupdate=='01-01-1970'){
                        $row->follow_up_date='N/A';
                    }
                    
                }
			
			
        }
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
       
        $this->data['submodule'] = 'Service PCB';
        //pr($this->data);die;
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->service_pcb_mod->perPage($user->id);
       
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->service_pcb_mod->insert_perPage($pageArr);
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
        
        $data = $this->service_pcb_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        foreach ($data['result'] as $row) { 
            if (!empty($row->display_id)) {
                $row->display_id = '<a href="'.base_url().'lead/service_pcb/view/'.$row->id.'">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
				//$row->display_id = '<a href="#">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
            } 
			
			if (!empty($row->assigned_telemarketer)) { // for assign telemarketer value
                    $name = @get_user_data($v[$val['name']])->first_name . ' ' . @get_user_data($v[$val['name']])->last_name;
                    $data[$k][$val['name']] = ($name != ' ') ? $name : 'Not Assigned';
                } else {
                    $data[$k][$val['name']] = $v[$val['name']];
                }
				
				if (!empty($row->contact_name)) {
                    //$companyContact = _contactPersonById($row->company_contact);
                    $row->contact_name = ucwords($row->contact_name); //@$companyContact->contact_person;
                }
				
				/*if ($row->lead_status==0 || $row->lead_status) {
                    $status = _getLeadStatus($row->lead_status);
                    $row->lead_status = ucwords($status); //@$companyContact->contact_person;
                }
				
				if ($row->company_name==0 || $row->company_name) {
                   $row->company_name = @_companyNameById($row->company_name);
                    //@$companyContact->contact_person;
                }*/
				
				if ($row->priority==0 || $row->priority) {
                   $row->priority = @$priority[$row->priority];
                    //@$companyContact->contact_person;
                }
				
				/*if ($row->added_by==0 || $row->added_by) {
                   $row->added_by = $row->ADDED_BY;
                    //@$companyContact->contact_person;
                }*/
				
				if ($row->referral_source==0 || $row->referral_source) {
                   $row->referral_source = @$referalSource[$row->referral_source];
                    
                }
				
				if ($row->created==0 || $row->created) {
                   $row->created = date("d/m/Y ",strtotime($row->created_time));
                    
                }
				
				if ($row->follow_up_date==0 || $row->follow_up_date) {
                   $row->follow_up_date = formatDate(_latestFollowUpDate($row->follow_up_date));
				   
				    $followupdate = date('d-m-Y',strtotime($row->follow_up_date));
			        if($followupdate=='01-01-1970'){
                        $row->follow_up_date='N/A';
                    }
                    
                }
			
			
        }
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->service_pcb_mod->get_flexigrid_cols();
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
    
    public function export()
    {
       $items          =$this->input->get_post('items',TRUE);
       $items_data     = str_replace("row","",$items);       
       $items_data      = explode(",",$items_data);
       $data = $this->service_pcb_mod->export();

       export_report($items_data);
       array_to_csv($data,"Company.csv");
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
     * get company name suggestion
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_company_suggestion()
    {
       $comp_text           = $this->input->get_post('query',TRUE);
	   
	   if(!empty($comp_text)){
		   $this->db->select("com.*,plc.*,act.*,vfd.*");
		   $this->db->join('lead_sales_pcb_common_plc as plc','plc.lead_id =com.id','left');
		   $this->db->join('lead_sales_pcb_common_actuator as act','act.lead_id =com.id','left');
		   $this->db->join('lead_sales_pcb_common_vfd as vfd','vfd.lead_id =com.id','left');
		   $this->db->where("(com.name like '%".$comp_text."%')");
		   $query = $this->db->get('companies as com');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->result();
			    $output = ''; 
				$output = '<ul class="list-unstyled max_overflow">';
				foreach($result as $val){
					$output .= '<li class="suggestion"><a>'.ucwords($val->name).'</a></li>'; 
				}
				$output .= '</ul>';  
				echo $output;  
		   }
	   }
    }
	
	
	/**
     * get All company Data
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_company_all_data()
    {
       $comp_text           = $this->input->get_post('company_name',TRUE);
	  
	   if(!empty($comp_text)){
		   $this->db->select("com.*,plc.plc_dcs_qty,inch_plc.name as plc_name,act.actuator_qty,inch_act.name as actuator_name,vfd.vfd_qty,inch_vfd.name as vfd_name");
		   $this->db->join('lead_sales_pcb_common_plc as plc','plc.lead_id =com.id','left');
		   $this->db->join('inch_plc_dcs_make as inch_plc','inch_plc.form_id =plc.plc_dcs_make','left');
		   $this->db->join('lead_sales_pcb_common_actuator as act','act.lead_id =com.id','left');
		   $this->db->join('inch_actuator_make as inch_act','inch_act.form_id =act.actuator_make','left');
		   $this->db->join('lead_sales_pcb_common_vfd as vfd','vfd.lead_id =com.id','left');
		   $this->db->join('inch_vfd_make as inch_vfd','inch_vfd.form_id =vfd.vfd_make','left');
		   $this->db->where("com.name",$comp_text);
		   $query = $this->db->get('companies as com');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->row();
			   
			    $output = ''; 
				
				$output = $result; 
				///$this->session->set_userdata("key",$output->id);
				//pr($this->session->userdata("key"));
				echo json_encode($output);  
		   }
	   }
    }
	
	// ------------------------------------------------------------------------
	
	/**
     * get contact name suggestion
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_contact_suggestion()
    {
       $cont_text           = $this->input->get_post('query',TRUE);
	   $company_id = $this->input->get_post('company_id',TRUE);
	   if(!empty($cont_text)){
		   $this->db->select("primary_phone");
		   $this->db->where("(companies_contact.primary_phone like '%".$cont_text."%' )");
		   $query = $this->db->get('companies_contact');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->result();
			    $output = ''; 
				$output = '<ul class="list-unstyled">';
				foreach($result as $val){
					$output .= '<li class="suggestion_cont"><a>'.ucwords($val->primary_phone).'</a></li>'; 
				}
				$output .= '</ul>';  
				echo $output;  
		   }
	   }
    }
	
	
	/**
     * get All company Data
     *
     * This function display 
     * 
     * @access	public
     * @return	html data
     */
    
    public function get_contact_all_data()
    {
       $comp_contact           = $this->input->get_post('company_contact',TRUE);
	   $company_id = $this->input->get_post('company_id',TRUE);
	   
	   if(!empty($comp_contact)){
		   $this->db->select("*");
		   $this->db->where("primary_phone",$comp_contact);
		   $query = $this->db->get('companies_contact');
		   //echo $this->db->last_query();die;
		   if($query->num_rows()>0){
			   $result = $query->row();
			   
			    $output = ''; 
				
				$output = $result;  
				echo json_encode($output);  
		   }
	   }
    }
	
	// ------------------------------------------------------------------------

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
			echo $data['value'] =fetch_state($id);
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
			echo $data['value'] = fetch_city($id);
		}else{
			return false;
		}
    }
	
	public function checkVendorCodeExistence() {
        is_ajax_request();
        $vendor_code = $this->input->post('vendor_code', true);
        $result = $this->service_pcb_mod->check_vendor_code_existance($vendor_code);
        //pr($result);die;
        if ($result == true)
            echo true;
    }
	/**
     * installation_view_notes
     *
     * This function show installation view notes
     * 
     * @access	public
     * @return  json array 
     */
	  public function addNote() {
		
	  $data['module'] = strtolower($this->uri->segment(2));
	  $data['lead_id'] = $_POST['lead_id'];
	  $data['notes'] = $_POST['notes'];
	  $data['created_time'] = date('Y-m-d H:i:s');
	  //pr($data);die;
	  $this->db->insert('installation_view_notes', $data);
	  // pr($this->db->last_query());die;
	  return redirect(base_url('lead/service_pcb/view/'.$_POST['lead_id']));
  }
   /**
     * Qualified Sales Spares
     *
     * This function show Sales Spares
     * 
     * @access	public
     * @return  json array 
     */
	public function qualified_form() {
	  $id = $_POST['lead_id'];
	  
	  $data['qualified_reason'] = $_POST['qualified_reason'];
	  $data['lead_status'] = '2';
	  set_common_update_value();
	  $this->db->where('id',$id);
	  $this->db->update('leads_service_pcb', $data);
	  //pr($this->db->last_query());die;
	  return redirect(base_url('lead/service_pcb/list_items'));
  }

   /**
     * Diequalified Sales Spares
     *
     * This function show Sales Spares
     * 
     * @access	public
     * @return  json array 
     */
	public function disqualified_form() {
		$id = $_POST['lead_id'];
		
		$data['disqualified_reason'] = $_POST['disqualified_reason'];
		$data['lead_status'] = '1';
		$this->db->where('id',$id);
		$this->db->update('leads_service_pcb', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('lead/service_pcb/list_items'));
	}
	
	/**
     * Add Product
     *
     * This function show Product
     * 
     * @access	public
     * @return  json array 
     */
	public function addproduct() {
		$id = $_POST['lead_id'];
		
		$data['product'] = $_POST['product'];
		$this->db->where('id',$id);
		$this->db->update('leads_service_pcb', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('lead/service_pcb/list_items'));
	}
	
	/**
     * Add Product
     *
     * This function show Product
     * 
     * @access	public
     * @return  json array 
     */
	public function addservice() {
		$id = $_POST['lead_id'];
		
		$data['service'] = $_POST['service'];
		$this->db->where('id',$id);
		$this->db->update('leads_service_pcb', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('lead/service_pcb/list_items'));
	}
	
	/**
     * Assign Opportunity
     *
     * This function assign opportunity
     * 
     * @access	public
     * @return  json array 
     */
	public function assignopportunity() {
		$id = $_POST['lead_id'];
		
		$data['group_id']   		 		 = $this->input->post('assign_group',TRUE);
		$data['added_by']            = $this->input->post('assign_user',TRUE);
		$this->db->where('id',$id);
		$this->db->update('leads_service_pcb', $data);
		//pr($this->db->last_query());die;
		return redirect(base_url('lead/service_pcb/list_items'));
	}

	public function remove_client_doc() {

		if(isset($_GET['leads_service_pcb_doc_id']) && !empty($_GET['leads_service_pcb_doc_id']) && is_numeric($_GET['leads_service_pcb_doc_id']))
		{
			$leads_service_pcb_doc_id = $_GET['leads_service_pcb_doc_id'];
			$this->db->select('filename');
			$this->db->where('id',$leads_service_pcb_doc_id);
			$record = $this->db->get("leads_service_pcb_doc")->row();
			if(isset($record->filename) && !empty($record->filename))
			{
				unlink(FCPATH.'upload/service_pcb/'.$record->filename);
				$this->db->where('id',$leads_service_pcb_doc_id);
				$this->db->delete('leads_service_pcb_doc');
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
	public function checkNameExistence() {
		//pr("yess");die;
		is_ajax_request();
		
        $company_text = $this->input->get_post('company_name', true);
        $id = $this->input->get_post('id', true);
		$result = $this->service_pcb_mod->check_name_existance($company_text,$id);
        //pr($result);die;
        if ($result == true)
            echo true;
    }
}