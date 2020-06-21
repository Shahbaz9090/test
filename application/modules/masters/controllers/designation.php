<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package		CodeIgniter
 * @subpackage	Controllers
 * @category	Company
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Designation extends CI_Controller {
   
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
		
        $this->load->model('designation_mod');
        $this->lang->load('designation', get_site_language());
               
        $this->data['head']['title'] = "Designation";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("masters/designation");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "designation";

		$this->data['module'] = 'Masters/Designation';
        $this->data['module_link'] = base_url("masters/designation")."/list_items";
        
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
            $id = $this->designation_mod->add();
            if($id){
                redirect($this->data['base_url']."/list_items/");
            }else{
                //redirect($this->data['base_url']."/add");
			}
       }
       $this->data['action'] = "add";
	   $views[] = "designation/form";

	   $this->data['submodule'] = 'Add Designation';

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
       $result = $this->designation_mod->get($id);
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "designation/form_view"; 
		view_report($id);
	   $this->data['submodule'] = 'View Designation';
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
           $r = $this->designation_mod->update($id);
            if($r==1){
                redirect($this->data['base_url']."/list_items/");
            }else if($r=='error'){
                //redirect($this->data['base_url']."/edit/".$id);
				$this->data['error_msg']="Name is already exists";
				
			}else{
				$this->data['error_msg']='';
			}
       }
       
       $result = $this->designation_mod->get($id);
	  
	   $this->data['result'] = $result;
       $this->data['action'] = "edit";
	   
       $views[] = "designation/form";
 
	   $this->data['submodule'] = 'Edit Designation';
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
		$views[] = "designation/list";
		
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter filter terms here";        
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->designation_mod->get_flexigrid_cols();

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
        $result =  $this->designation_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
		foreach ($result['result'] as $row) {  
				if ($row->created_time==0 || $row->created_time) {
                   $row->created_time = date("d-M-Y H:i A",strtotime($row->created_time));
                    
                }
				
				if ($row->modified_time==0 || $row->modified_time) {
                   $row->modified_time = date("d-M-Y H:i A",strtotime($row->modified_time));
                    
                }
				if ($row->name!='') {
                   $row->name = $row->name;
                    
                }
				
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
				//pr($row->status);die;
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
		}
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
        
        $this->data['submodule'] = 'Designation List';
        view_load($views, $this->data);
	}
    
     public function ajax_list_items($limit = 10)
	{ 
	    $user=currentuserinfo();
		$perPage = $this->designation_mod->perPage($user->id);
		//pr($perPage);die;
        if($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(2) . "/" . $this->uri->segment(3);
			//pr($controllerInfo);die;
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->designation_mod->insert_perPage($pageArr);
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
        
        $data = $this->designation_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        //$permission=_check_perm();
        
        foreach ($data['result'] as $row)
        {
			if ($row->created_time==0 || $row->created_time) {
                   $row->created_time = date("d-M-Y H:i A",strtotime($row->created_time));
                    
                }
				
				if ($row->modified_time==0 || $row->modified_time) {
                   $row->modified_time = date("d-M-Y H:i A",strtotime($row->modified_time));
                    
                }
				if ($row->name!='') {
                   $row->name = $row->name;
                    
                }
            if ($row->status == '0')
            {
                $row->status = "Inactive";
            } else
            {
                $row->status = "Active";
            }            
            
            if($row->added_by == $user->id)
            {
                $row->status =  $row->status;
            }else
            {
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" style="color:#000">' . $row->status . '</a>';
            }
		}
       //pr($data);die;
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->designation_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
      	$data['grid']["base_url"] = $this->data['base_url'];
		//pr($data);die;
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
       $data = $this->designation_mod->export();

       export_report($items_data);
       array_to_csv($data,"Designation.csv");
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
       //filter_data();
       $this->db->delete($this->table_name);
       delete_report($items_data);
    }
    public function status($id = null) {
        $result = $this->designation_mod->get($id);
        $r = $this->designation_mod->status_update($id, $result->status);
		//pr($r);die;
        if($r) {
            redirect($this->data['base_url'] . "/list_items");
        }

    }    

  
    	
}

    
 