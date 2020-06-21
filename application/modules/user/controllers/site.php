<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Site Controller
 *
 * @package		User
 * @subpackage	Site
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Site extends MY_Controller {
   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    private $table_name     = NULL;
    /**
	 * Constructor
	 */ 
    function __construct()
    {
        parent::__construct();
        isProtected();
        $this->load->model('site_mod');
        $this->lang->load('site', get_site_language());
               
        $this->data['head']['title'] = "Site";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("user/site");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "site";

		$this->data['module'] = 'User';
		$this->data['module_link'] = base_url("user")."/list_items";
        $this->data['submodule'] = 'Site List';

        
    }
    
    
    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function add new Site
     * 
     * @access	public
     * @return	html data
     */
	public function add()
	{
	   if(isPostBack())
       {
            $id = $this->site_mod->add();
            if($id)
                redirect($this->data['base_url']."/list_items/");
            else
                redirect($this->data['base_url']."/add/");
       }
       
       $this->data['action'] = "add";
	   $views[] = "site_form";
       view_load($views,$this->data);
	}
    
    
    
        // ------------------------------------------------------------------------

    /**
     * View
     *
     * This function View Site Details
     * 
     * @access	public
     * @param   int - Site Id
     * @return	html data
     */
	public function view($id = NULL)
	{        
       $result = $this->site_mod->get($id);
       $this->data['result'] = $result;
       $this->data['readonly'] = 'readonly="true"';
       $this->data['action'] = "view";
       $views[] = "site_view"; 
       view_load($views,$this->data);
	}
    
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Edit
     *
     * This function Edit Site Details
     * 
     * @access	public
     * @param   int - Site Id
     * @return	html data
     */
	public function edit($id = NULL)
	{    
	   
       if(isPostBack())
       {
		   //pr($_POST);die;
           $r = $this->site_mod->update($id);
            if($r)
                redirect($this->data['base_url']."/list_items/");
            else
                redirect($this->data['base_url']."/edit/".$id);
       }
       
       $result = $this->site_mod->get($id);
       
       $this->data['result'] = $result;
       
       $this->data['action'] = "edit";
       $views[] = "site_form";
	   view_load($views,$this->data);
	}
    
    
    
     // ------------------------------------------------------------------------

    /**
     * list items
     *
     * This function display all Site list
     * 
     * @access	public
     * @return	html data
     */
	public function list_items()
	{  
	   $views[]											= "site_list";
       $data['title']                                   = lang('list_title');
       $this->data['action']                            = "list";
       
       $this->data['flexigrid']['cols']                 = $this->site_mod->get_flexigrid_cols();
       $this->data['flexigrid']['base_url']             = $this->data['base_url'];
       $this->data['flexigrid']['export_limit']         = $this->export_limit;
       $this->data['flexigrid']['delete_limit']         = $this->delete_limit;
       $this->data['flexigrid']['sortname']             = 'name';
    
       view_load($views,$this->data);
	}
    
    
    public function ajax_list_items()
	{ 
	   $keyword            = $this->input->get_post('keyword',TRUE);
       $search_by          =$this->input->get_post('search_by',TRUE);
       $sortname           = $this->input->get_post('sortname',TRUE);
       $sortorder          = $this->input->get_post('sortorder',TRUE);
       $rp                 = $this->input->get_post('rp',TRUE);
       $page               = $this->input->get_post('page',TRUE);
        
       $data               = $this->site_mod->ajax_list_items($search_by,$keyword,$sortname,$sortorder,$rp,$page);
       
       echo flexigrid_json($data,$this->data['base_url'],$page);
       
  
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
       
       $this->db->where_in("id",$items_data);       
       $query = $this->db->get($this->table_name);
       $data = $query->result_array();
       
       array_to_csv($data,"Site.csv");
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
	   $items          =$this->input->get_post('items',TRUE);
       $items_data     = str_replace("row","",$items);       
       $items_data      = explode(",",$items_data);      
       
       $this->db->where_in("id",$items_data);              
       $this->db->where("is_super",0);       
       filter_data();
       //$this->db->delete($this->table_name);
    }
      
    
    
    
}