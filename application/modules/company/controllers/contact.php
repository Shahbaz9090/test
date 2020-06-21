<?php

if(!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Contact * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Contact extends MY_Controller {

    private $data           = array();
    public $table           = "companies_contact";
    private $export_limit   = null;
    private $delete_limit   = null;
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('contact_mod');
        //$this->load->model('country_mod');
        $this->load->model('company_mod');
       $this->load->model('user_group_mod');
        $this->lang->load('contact', get_site_language());

        $this->data['head']['title'] = "Contact";
        $this->data['readonly'] = null;
        $this->data['base_url'] = base_url("company/contact");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name = "companies_contact";

        $this->data['module'] = 'Company';
        $this->data['module_link'] = base_url("company") . "/list_items";
        $this->data['module_lev1_link'] = base_url("company") . "/contact/list_items";
	}

    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function add new Company Contact
     * 
     * @access	public
     * @return	html data
     */
    public function add() {

        if(isPostBack()) {
                 $this->data['error_msg']='';
                $this->data['error_msg_email']='';
            $id = $this->contact_mod->add();
           // pr($id);die;
            if($id && $id!='error_email' && $id!='error_phone' && $id!='error_required' ){
                redirect($this->data['base_url']."/list_items/");
            } else if($id=='error_phone' && $id!='error_email' && $id!='error_required'){
                //redirect($this->data['base_url']."/edit/".$id);
                $this->data['error_msg']="Oops !! This Primary Phone is Alreday Exists.";
                
            }  else if($id=='error_email' && $id!='error_phone'  && $id!='error_required'){
                //redirect($this->data['base_url']."/edit/".$id);
                $this->data['error_msg_email']="Oops !! This Official Email is Alreday Exists.";
                
            }else{
               //redirect($this->data['base_url']."/list_items/"); 
            }
        }

        $this->data['action'] = "add";
        $views[] = "contact_form";
        //$this->data['countries'] = $this->country_mod->get_countries();
        $this->data['user_groups'] = $this->user_group_mod->get_groups();
        $this->data['company'] = get_all_companies();
        $this->data['department'] = get_all_department_from_masters();
        $this->data['designation'] = get_all_designation_from_masters();

        $this->data['module_lev1'] = 'Company Contact';
        $this->data['submodule'] = 'Add Company Contact';
		//pr($this->data);die;
		view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------

    /**
     * View
     *
     * This function View Company Contact Details
     * 
     * @access	public
     * @param   int - Company Id
     * @return	html data
     */
    public function view($id = null) {
        
        $result = $this->contact_mod->get($id);
		
		if($result->campany_doc=='1')
               {
                    $this->data['campany_doc_file'] = $this->contact_mod->get_contact_doc_file($id);
               }
        //$state = $this->country_mod->get_state_name($result->state);

        //$this->data['state'] = $state;
         
        $this->data['result'] = $result;
        $this->data['readonly'] = 'readonly="true"';
        $this->data['action'] = "view";
        
        $views[] = "contact_form_view";
        //$this->data['company'] = $this->company_mod->get($result->company_id);
        //$this->data['countries'] = $this->country_mod->get_countries_name($result->country_id);
		//$this->data['assign_user'] = $this->user_group_mod->get_users($result->group_id);
        $this->data['user_groups'] = $this->user_group_mod->get_groups();
        if(!empty($result->group_id)){
            $user_group_arr = explode(',',$result->group_id);
        }
        $this->data['assign_user'] = $this->user_group_mod->get_users($user_group_arr);
        $this->data['module_lev1'] = 'Company Contact';
        $this->data['submodule'] = 'View Company Contact';
		//pr($this->data);die;
        view_report($id);
		view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------

    /**
     * Edit
     *
     * This function Edit Company Contact Details
     * 
     * @access	public
     * @param   int - Company Id
     * @return	html data
     */
    public function edit($id = null) {
		//check permission for edit
        $assigned_users = $this->contact_mod->get_assigned_users($id);
        if(check_own_all_permission(['id'=>$id],$this->table,$assigned_users) == false)
        {
            set_flashdata('error','You do not have permission to access this module.');
            redirect($this->data['base_url']."/list_items/"); 
        }
        if(isPostBack()) {
            $r = $this->contact_mod->update($id,$result->company_id);
         //pr($r);die;
                 $this->data['error_msg']='';
                $this->data['error_msg_email']='';
            if($r!='error_phone' && $r!='error_email'   && $r=='error_required'){
               
               // redirect($this->data['base_url']."/list_items/");
            }else if($r=='error_phone' && $r!='error_email' && $r!='error_required'){
                //redirect($this->data['base_url']."/edit/".$id);
                $this->data['error_msg']="Oops !! This Primary Phone is Alreday Exists.";
                
            }else if($r=='error_email' && $r!='error_phone'  && $r!='error_required'){
                //redirect($this->data['base_url']."/edit/".$id);
                $this->data['error_msg_email']="Oops !! This Official Email is Alreday Exists.";
                
            }else{
               redirect($this->data['base_url']."/list_items/"); 
            }
        }

        
		$result = $this->contact_mod->get($id);
        // pr($result);die;
        if($result->campany_doc=='1')
       {
            $this->data['campany_doc_file'] = $this->contact_mod->get_contact_doc_file($id);
       } 
	   
        //$state = $this->country_mod->get_state($result->country_id);
        //$this->data['state'] = $state;

        $this->data['result'] = $result;
        $this->data['action'] = "edit";
        $views[] = "contact_form";
        $this->data['company'] = get_all_companies();
        $this->data['department'] = get_all_department_from_masters();
        $this->data['designation'] = get_all_designation_from_masters();
        $this->data['user_groups'] = $this->user_group_mod->get_groups();
        if(!empty($result->group_id)){
            $user_group_arr = explode(',',$result->group_id);
        }
		$this->data['assign_user'] = $this->user_group_mod->get_users($user_group_arr);
		 //pr($result);die;
        $this->data['module_lev1'] = 'Company Contact';
        $this->data['submodule'] = 'Edit Company Contact';
		
		//pr($this->data);die;
        view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------

    /**
     * list items
     *
     * This function display all Company Contact list
     * 
     * @access	public
     * @return	html data
     */
    public function list_items() {
		
        //$user = currentuserinfo();
        $views[] = "contact_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder']= "Enter Filter terms here";
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->contact_mod->get_flexigrid_cols();

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
        $result =  $this->contact_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
		$url = $this->data['base_url'] . "/permission/";
        //pr($result);die;
        //pr($permission);die;
        foreach ($result['result'] as $row)
        { //pr($row);
			$row->company_name = '<a href="'.base_url().'company/contact/view/'.$row->id.'">#'.$row->company_name.'</a>';
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
				//$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }else
            {
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
            //$cityResult = viewCity($row->city);
            //$row->city = @$cityResult->cityName;
        }
        
        
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
        //pr($this->data['grid']);exit;
        $this->data['submodule'] = 'Company Contact List';
		$this->data['user_groups'] = $this->user_group_mod->get_groups();
		//pr($this->data);die;
        view_load($views, $this->data);
    }

    public function ajax_list_items($limit = 10)
    {
      
       $user = currentuserinfo();
        $perPage = $this->contact_mod->perPage($user->id);
        //pr($perPage);die;
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->contact_mod->insert_perPage($pageArr);
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
        
        $data = $this->contact_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        $permission=_check_perm();
       // pr($data);die;
        foreach ($data['result'] as $row)
        { //pr($row);
            $row->company_name = '<a href="'.base_url().'company/contact/view/'.$row->id.'">#'.$row->company_name.'</a>';
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
                //$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }else
            {
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
            //$cityResult = viewCity($row->city);
            //$row->city = @$cityResult->cityName;
        }
        $url = $this->data['base_url'] . "/permission/";
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->contact_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];

        //pr($data);exit;
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


            $result =  $this->contact_mod->ajax_list_items($text, null, null, null, null,null,$is_export,$items_data);

            $result = $result['result'];
              //pr($result);die;
            $table_columns = ["company_name"=>"Client Name","name"=>"Contact Person Name","primary_phone"=>"Primary Phone","department_name"=>"Department","designation_name"=>"Designation ","personal_email"=>"Personal Email","secondary_phone"=>"Personal Mobile","email_id"=>"Official Email"];
            $filename = "Company Contact" . date('d-m-Y'). ".xls";
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

    public function delete() {
	
       $items           = $this->input->get_post('items',TRUE);
       $items_data      = str_replace("row","",$items);       
       $items_data      = explode(",",$items_data);      
       $this->db->where_in("id",$items_data);
       filter_data();
      $this->db->delete($this->table_name);
	   delete_report($items_data);
    }

    // ------------------------------------------------------------------------
    /**
     * Email Item items
     *
     * This function check if Email id is Exists or Not
     * 
     * @access	public
     * @return	html data
     */

    public function ajax_is_email() {
        $num_rows = $this->contact_mod->ajax_is_email($this->input->post("email"), $this->input->post("id"));
        if($num_rows > 0)
            echo '1';
        else
            echo "2";
    }

    function ajax_is_website() {
        $num_rows = $this->contact_mod->ajax_is_website($this->input->post("email"));
    }

    // ------------------------------------------------------------------------

    /**
     * Contact Status
     *
     * This function action on Contact Status
     * 
     * @access	public
     * @return	html data
     */
    public function status($id = null) {
        $result = $this->contact_mod->get($id);
		//pr($result);die;
        $r = $this->contact_mod->status_update($id, $result->status);
		//pr($r);die;
        if($r) {
            redirect($this->data['base_url'] . "/list_items");
        }

    }
    
      /*
      * This function remove Contact Doc file 
      * @public
      * 
      */    
     
	 function ajax_remove_doc($id=null)
                { 
                        $this->contact_mod->ajax_remove_doc($id);
                        return TRUE;
	         }
			 
	function assign_group_user()
	{
		$assign_group = $this->input->post('assign_group');
		$assign_user = $this->input->post('assign_user');
		$company_contact = $this->input->post('company_contact');
		$company_contact = trim($company_contact,',');
		$company_contact = explode(',',$company_contact);
		if(isset($company_contact) && is_array($company_contact))
		{
			foreach($company_contact as $cc_key => $cc_val)
			{
				$this->db->select('*');
                $this->db->where('id',$cc_val);
                $this->db->from('companies_contact');
                $query = $this->db->get();
                $result = $query->row();
                $assign_group = $result->group_id.','.$assign_group;
                $assign_group = explode(',', $assign_group);
                $unique = array_unique($assign_group);
                $assign_group = implode(',', $unique);
                $assign_users = $result->assign_users.','.$assign_user;
                $assign_users = explode(',', $assign_users);
                $unique = array_unique($assign_users);
                $assign_users = implode(',', $unique);
                $upd['assign_users']	=	$assign_users;
				$upd['group_id']	=	$assign_group;
                //pr($upd);die;
				$this->db->where('id',$cc_val);
				$this->db->update('companies_contact',$upd);
			}
		}
		set_flashdata("success", lang('updated'));
		echo "true";
	}
	
	public function checkContactExistence() {
        is_ajax_request();
        $primary_phone = $this->input->get_post('primary_phone', true);
        $contact_id = $this->input->get_post('contact_id', true);
        $id = $this->input->get_post('id', true);
        $result = $this->contact_mod->check_contact_existance($primary_phone,$contact_id,$id);
        //pr($result);die;
        if ($result == true)
            echo true;
    }
	
}
