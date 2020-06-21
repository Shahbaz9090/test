<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Site Controller
 *
 * @package		User
 * @subpackage	Group
 * @category	User 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Group extends MY_Controller {

    private $data = array();
    private $export_limit = null;
    private $delete_limit = null;
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('group_mod');
        $this->lang->load('group', get_site_language());

        $this->data['head']['title'] = "Designation";
        $this->data['readonly'] = null;
        $this->data['base_url'] = base_url("user/group");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name = "user_groups";

        $this->data['module'] = 'User';
        $this->data['module_lev1_link'] = base_url("user") . "/group/list_items";

    }


    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function add new Group
     * 
     * @access	public
     * @return	html data
     */
    public function add() {
        if (isPostBack()) {
            $id = $this->group_mod->add();
            if ($id)
                redirect($this->data['base_url'] . "/list_items/");
            else
                redirect($this->data['base_url'] . "/add/");
        }
        $this->data['groups'] = $this->group_mod->get_groups();
        $this->data['action'] = "add";
        $views[] = "group_form";

        $this->data['module_lev1'] = "Designation List";
        $this->data['submodule'] = "Add Designation";

        view_load($views, $this->data);
    }

    //------------------------------------------------------------------------
    /**
     * View
     *
     * This function View Group Details
     * 
     * @access	public
     * @param   int - Group Id
     * @return	html data
     */
    public function view($id = null) {
        $result = $this->group_mod->get($id);
        $this->data['result'] = $result;
        $this->data['readonly'] = 'readonly="true"';
        $this->data['action'] = "view";

        $this->data['groups'] = $this->group_mod->view_parent_groups($result->parent_group_id);

        $views[] = "group_view";

        $this->data['module_lev1'] = "Designation List";
        $this->data['submodule'] = "View Designation";
		view_report($id);
        view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------
    /**
     * Edit
     *
     * This function Edit Group Details
     * 
     * @access	public
     * @param   int - Group Id
     * @return	html data
     */
    public function edit($id = null) {
        if (isPostBack()) {
            $r = $this->group_mod->update($id);
            if ($r)
                redirect($this->data['base_url'] . "/list_items");
            else
                redirect($this->data['base_url'] . "/edit/" . $id);
        }

        $result = $this->group_mod->get($id);

        $this->data['result'] = $result;
        $this->data['groups'] = $this->group_mod->get_groups();
        $this->data['action'] = "edit";
        $views[] = "group_form";

        $this->data['module_lev1'] = "Designation List";
        $this->data['submodule'] = "Edit Designation";

        view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------
    /**
     * list items
     *
     * This function display all Group list
     * 
     * @access	public
     * @return	html data
     */
    public function list_items() {
        $views[] = "group_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter Filter terms here";
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->group_mod->get_flexigrid_cols();

        $this->data['grid']['base_url'] = $this->data['base_url'];
        $this->data['grid']['export_limit'] = $this->export_limit;
        $this->data['grid']['delete_limit'] = $this->delete_limit;

        if ($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        $text = $this->input->post('text');
        $limit = @$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset = 1;
        $order_by = 'id';
        $order = 'desc';
        $result = $this->group_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);

        $url = $this->data['base_url'] . "/permission/";

        foreach ($result['result'] as $row) {
            if ($row->is_super == 1) {
                $row->permission = '<span style="color:#1569BC;">View | Set</span>';
            } else {
                $row->permission = '<a href="' . $url . $row->id .
                    '" class="permission" id="permission">View | Set</a>';
            }
			
			if ($row->status == 'inactive')
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
                $row->status = '<a href="' . $this->data['base_url'] . '/status/' . $row->id . '" class="status" >' . $row->status . '</a>';
            }
        }


        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';

        $this->data['submodule'] = 'Designation List';

        view_load($views, $this->data);
    }


    public function ajax_list_items($limit = 10) {

        $user = currentuserinfo();
        $perPage = $this->group_mod->perPage($user->id);
		//pr($perPage);die;
        if ($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2) . "/" . $this->uri->segment(3);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->group_mod->insert_perPage($pageArr);
        }
        if ($this->input->post("order_by")) {
            $order_by = $this->input->post("order_by");
        } else {
            $order_by = 'id';
        }
        if ($this->input->post("order")) {
            $order = $this->input->post("order");
        } else {
            $order = 'desc';
        }
        $offset = $this->input->post("offset");
        if (!$offset) {
            $offset = 1;
        }
        if (!$limit) {
            $limit = 10;
        }
        if ($this->input->post("limit")) {
            $limit = $this->input->post("limit");
            $this->data["hiddenLimit"] = $limit;
        }
        if ($this->input->post('text')) {
            $text = $this->input->post('text');
        } else {
            $text = null;
        }

        $data = $this->group_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        $permission=_check_perm();
        
        foreach ($data['result'] as $row)
        {

            if ($row->status == 'inactive')
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

        $url = $this->data['base_url'] . "/permission/";

        foreach ($data['result'] as $row) {
            if ($row->is_super == 1) {
                $row->permission = '<span style="color:#1569BC;">View | Set</span>';
            } else {
                $row->permission = '<a href="' . $url . $row->id .
                    '" class="permission" id="permission" >View | Set</a>';
            }
        }

        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->group_mod->get_flexigrid_cols();
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

    public function export() {
        $items = $this->input->get_post('items', true);
        $items_data = str_replace("row", "", $items);

        $items_data = explode(",", $items_data);

        $this->db->where_in("id", $items_data);
        filter_data();
        $query = $this->db->get($this->table_name);
        $data = $query->result_array();
        $headers = array();
        foreach ($data[0] as $k => $v) {
            $headers[] = $k;
        }
        array_to_csv($data, "group.csv",$headers);
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
        $items = $this->input->get_post('items', true);
        $items_data = str_replace("row", "", $items);
        $items_data = explode(",", $items_data);

        $this->db->where_in("id", $items_data);
        $this->db->where("is_super", 0);
        filter_data();
        $this->db->delete($this->table_name);
    }


    // ------------------------------------------------------------------------

    /**
     * Set Permission
     *
     * This function set access permission
     * 
     * @access	public
     * @param   int - Group Id
     * @return	html data
     */
    public function permission($id = null) {

        $this->load->model('group_permission_mod');

        if (isPostBack()) {
            // if ($this->group_permission_mod->set_permission($id))
            if ($this->group_permission_mod->set_permission_new($id))
                $data['updated'] = true;
        }
        $methods = $this->group_permission_mod->method_list();
        $module_list = $this->group_permission_mod->module_list();
        $permission_data = $this->group_permission_mod->permission_data($id);
        $group_data = $this->group_mod->get($id);
		// pr($module_list);die;
        // pr($permission_data);die;

        
        $data['permission_data'] = $permission_data;
        $data['group_data'] = $group_data;

        $data['methods'] = $module_list;
        $this->load->view("group_permission", $data);
        /*************************/
        // $data['methods'] = $methods;
        // $this->load->view("group_permission2", $data);
        /*************************/
    }
    
	public function status($id = null) {
        $result = $this->group_mod->get($id);
        $r = $this->group_mod->status_update($id, $result->status);
        if($r) {
            redirect($this->data['base_url'] . "/list_items");
        }

    }  
}
