<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter email_template Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	email_template
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @email_template     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Email_Template extends MY_Controller {
   
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
        $this->load->model('email_template_mod');
        $this->lang->load('email_template', get_site_language());
               
        $this->data['head']['title'] = "Email Template";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("email_template");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "companies";

		$this->data['module'] = 'Email Template';
        $this->data['module_link'] = base_url("email_template")."/list_items";
        
    }
    
    
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * This function add new email_template
     * 
     * @access	public
     * @return	html data
     */
	public function add()
	{
		if(isPostBack())
       {
            $id = $this->email_template_mod->add();
            if($id)
                redirect($this->data['base_url']."/list_items/");
            else
                redirect($this->data['base_url']."/add");
       }
	   $this->data['category'] = $this->email_template_mod->get_email_template_category();
	   $this->data['action'] = "add";
	   $views[] = "email_template_form";
	   $this->data['submodule'] = 'Add Email Template';
	   //pr($this->data);die;
	   view_load($views,$this->data);
	}
    
    // ------------------------------------------------------------------------

    /**
     * View
     *
     * This function View email_template Details
     * 
     * @access	public
     * @param   int - email_template Id
     * @return	html data
     */
	public function view($id = NULL)
	{      
       $result = $this->email_template_mod->get($id);
	   $this->data['result'] = $result;
	   $this->data['readonly'] = 'readonly="true"';
	   $this->data['action'] = "view";
       $views[] = "email_template_form_view"; 
	   $this->data['submodule'] = 'View Email Template';
	   //pr($this->data);die;
	   view_report($id);
       view_load($views,$this->data);
	}
    
    
    // ------------------------------------------------------------------------

    /**
     * Edit
     *
     * This function Edit email_template Details
     * 
     * @access	public
     * @param   int - email_template Id
     * @return	html data
     */
	public function edit($id = NULL)
	{   	   
       if(isPostBack())
       {
           $r = $this->email_template_mod->update($id);
            if($r)
                redirect($this->data['base_url']."/list_items/");
            else
                redirect($this->data['base_url']."/edit/".$id);
       }
	   $this->data['category'] = $this->email_template_mod->get_email_template_category();
       $result = $this->email_template_mod->get($id);
	   $this->data['result'] = $result;
       // pr($result);die;
       $this->data['action'] = "edit";
       $views[] = "email_template_form";
	   $this->data['submodule'] = 'Edit Email Template';
	   //pr($this->data);die;
	   view_load($views,$this->data);
	}
    
    // ------------------------------------------------------------------------

    /**
     * list items
     *
     * This function display all email_template list
     * 
     * @access	public
     * @return	html data
     */
	public function list_items()
	{  
	   $views[] = "email_template_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->email_template_mod->get_flexigrid_cols();

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
        $result =  $this->email_template_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        foreach ($result['result'] as $row) { 
            
				
                $row->name = ucwords($row->name); //@$email_templateContact->contact_person;
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
				//$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }else
            {
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
		}
		//pr($result);die;
		
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
        //pr($this->data);die;
        $this->data['submodule'] = 'Email Template List';
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
  $perPage = $this->email_template_mod->perPage($user->id);
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->email_template_mod->insert_perPage($pageArr);
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
        
        $data = $this->email_template_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        $permission=_check_perm();
       // pr($data);die;
        foreach ($data['result'] as $row)
        {

             $row->name = ucwords($row->name); //@$email_templateContact->contact_person;
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
				//$row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }else
            {
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
            //$cityResult = viewCity($row->city);
			//pr($cityResult);die;
            //$row->city = @$cityResult->cityName;
        }
       
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->email_template_mod->get_flexigrid_cols();
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
       $data = $this->email_template_mod->export();

       export_report($items_data);
       array_to_csv($data,"Email Template.csv");
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
	
	// ------------------------------------------------------------------------

    public function checkemail_templateExistence() {
        is_ajax_request();
        $name = $this->input->post('name', true);
        $result = $this->email_template_mod->check_email_template_existance($name);
        //pr($result);die;
        if ($result == true)
            echo true;
    }
	
	
	public function checkClientIdExistence() {
        is_ajax_request();
        $client_id = $this->input->post('client_id', true);
        $result = $this->email_template_mod->check_client_id_existance($client_id);
       // pr($result);die;
        if ($result == true)
            echo true;
    }
        
	/**
     * Contact Status
     *
     * This function action on Contact Status
     * 
     * @access	public
     * @return	html data
     */
    public function status($id = null) {
        $result = $this->email_template_mod->get($id);
        $r = $this->email_template_mod->status_update($id, $result->status);
        if($r) {
            redirect($this->data['base_url'] . "/list_items");
        }

    }
  
    	
}

    
 