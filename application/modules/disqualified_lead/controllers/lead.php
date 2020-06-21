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
 
class Lead extends MY_Controller {
   
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
        $this->load->model('lead_mod');
		$this->load->model('opportunity/opportunity_mod');
        $this->load->model('product/product_mod');
        $this->lang->load('lead', get_site_language());
               
        $this->data['head']['title'] = "Lead";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("lead");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "leads";

		$this->data['module'] = 'lead';
        $this->data['module_link'] = base_url("lead")."/list_items";
        
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
            $id = $this->lead_mod->add();
            if($id)
                redirect($this->data['base_url']."/list_items/");
            else
                redirect($this->data['base_url']."/add");
       }
       $data['action'] = "add";
	   $views[] = "lead_form";

	   $data['submodule'] = 'Add Lead';
	  $data['industry'] = $this->lead_mod->get_industry();
		//pr($data['industry']);die;
       view_load($views,$data);
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
       $result = $this->company_mod->get($id);
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "company_form_view"; 

	   $this->data['submodule'] = 'View Company';
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
           $r = $this->company_mod->update($id);
            if($r)
                redirect($this->data['base_url']."/list_items/");
            else
                redirect($this->data['base_url']."/edit/".$id);
       }
       
       $result = $this->company_mod->get($id);
	   $this->data['result'] = $result;
       $this->data['action'] = "edit";
       $views[] = "company_form";

	   $this->data['submodule'] = 'Edit Company';
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
		$views[] = "lead_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->lead_mod->get_flexigrid_cols();

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
        $result =  $this->lead_mod->ajax_list_items($text, $limit, $offset, $order_by, $order,$user);
		
		$priority = _priority();
        $referalSource = _referalSourceList();
        foreach ($result['result'] as $row) { //pr($row);die;
            if (!empty($row->display_id)) {
                $row->display_id = '<a href="'.base_url().'lead/view/'.$row->id.'">#'.$row->display_id.'</a>';//'#'.$v[$val['name']];
            } 
			
			if (!empty($row->assigned_telemarketer)) { // for assign telemarketer value
                    $name = @get_user_data($v[$val['name']])->first_name . ' ' . @get_user_data($v[$val['name']])->last_name;
                    $result[$k][$val['name']] = ($name != ' ') ? $name : 'Not Assigned';
                } else {
                    $result[$k][$val['name']] = $v[$val['name']];
                }
				
				if (!empty($row->contact_person)) {
                    $companyContact = _contactPersonById($row->company_contact);
                    $row->company_contact = $row->contact_person; //@$companyContact->contact_person;
                }
				
				if ($row->lead_status==0 || $row->lead_status) {
                    $status = _getLeadStatus($row->lead_status);
                    $row->lead_status = ucwords($status); //@$companyContact->contact_person;
                }
				
				if ($row->company_name==0 || $row->company_name) {
                   $row->company_name = @_companyNameById($row->company_name);
                    //@$companyContact->contact_person;
                }
				
				if ($row->priority==0 || $row->priority) {
                   $row->priority = @$priority[$row->priority];
                    //@$companyContact->contact_person;
                }
				
				if ($row->added_by==0 || $row->added_by) {
                   $row->added_by = $row->ADDED_BY;
                    //@$companyContact->contact_person;
                }
				
				if ($row->referral_source==0 || $row->referral_source) {
                   $row->referral_source = @$referalSource[$row->referral_source];
                    
                }
				
				if ($row->created==0 || $row->created) {
                   $row->created = date("d-M-Y H:i A",strtotime($row->created));
                    
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
        
        $this->data['submodule'] = 'Lead List';
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->lead_mod->perPage($user->id);
       
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->lead_mod->insert_perPage($pageArr);
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
        
        $data = $this->lead_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
       
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->lead_mod->get_flexigrid_cols();
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
       $data = $this->company_mod->export();

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
        

  
    	
}

    
 