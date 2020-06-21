<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * CodeIgniter Manage Support Form Controller
 *
 * @package        CodeIgniter
 * @subpackage    Controllers
 * @category    Support Form
 * @author        Tekshapers INC
 * @website        http://www.nss.com
 * @company     Tekshapers Inc
 * @since        Version 1.0
 */

class Form_module extends MY_Controller
{
    private $data         = array();
    private $export_limit = null;
    private $delete_limit = null;
    private $db2;
    
    public function __construct()
    {
        parent::__construct();
        //checkSuperAdmin();
        $this->load->model('form_module_mod');
        $this->lang->load('form_module', get_site_language());

        $this->data['head']['title'] = "Form Module";
        $this->data['readonly']      = null;
        $this->data['base_url']      = base_url("form_module");
        $this->export_limit          = $this->config->item('export_limit');
        $this->delete_limit          = $this->config->item('delete_limit');
        $this->table_name            = "inch_support";

        $this->data['module']      = 'Form Module';
        $this->data['module_link'] = base_url("form_module") . "/list_items";
    }

    /**
     * Index
     *
     * This function display support
     *
     * @access    public
     * @return    html data
     */
    public function index()
    {
        redirect(base_url('form_module/list_items'));
    }

    public function list_items($pageno = 1)
    {
    	
        $data['action'] 				= "list";
        $data['grid']['cols']         	= $this->form_module_mod->get_flexigrid_cols();
        $data['grid']['base_url']     	= $this->data['base_url'];
        $data['grid']['export_limit'] 	= $this->export_limit;
        $data['grid']['delete_limit'] 	= $this->delete_limit;

        //check session offset
        if ($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        if ($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        $text     = $this->input->post('text');
        $limit    = @$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset   = 1;
        $order_by = 'id';
        $order    = 'desc';
        $result   = $this->form_module_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        foreach ($result['result'] as $row) {
            $row->form_name = ucwords($row->form_name);
            if ($row->status == "1") {
                $row->status = "Active";
            } else {
                $row->status = "Inctive";
            }
            $row->view_in_left_menu = "Yes";

            //pr($row->name);die;
        }
        //echo "yess";die;
        $views[]       = 'form_list';
        $data['title'] = "Form List";

        //$this->breadcrumbcomponent->add('Dashboard <li><i class="fa fa-circle"></i></li>', base_url()."dashboard");
        // $this->breadcrumbcomponent->add('List Form', base_url());
        //$data['header']['bread_cum'] = $this->breadcrumbcomponent->output();
        // pr($result);die;
        $data['grid']['result']     = $result;
        $data['grid']["page_offset"]= 1;
        $data['grid']["limit"]      = $limit;
        $data['grid']["order_by"]   = 'id';
        $data['submodule'] 			= 'List';
        $data['extra_btn']        	= '<span class="grid-button" style="margin-right:0px;" ><div class="fbutton"><div><a href="'.base_url('form_module/module_list').'" class="add"><span aria-hidden="true" class="fa fa-random grid-list-icon"></span>Module List</a></div></div></span>';
        view_load($views, $data);
    }

    public function module_list()
    {
        $config["base_url"]	= SITE_PATH."form_module/module_list/";
    	if(isPostBack())
    	{	
    		if(isset($_POST['add_new_module']))
    		{
	    		$status = $this->form_module_mod->module_save();
	    		if($status)
	    		{
	    			// unset($_POST);
	    			set_flashdata('success','Module successfully added');
	    			redirect($config["base_url"]);
	    		}
    		}
    		elseif(isset($_POST['edit_module']))
    		{
	    		$status = $this->form_module_mod->module_edit();
	    		if($status)
	    		{
	    			// unset($_POST);
	    			set_flashdata('success','Module successfully added');
	    			redirect($config["base_url"]);
	    		}
    		}
    	}

		$result = $this->form_module_mod->module_list();
		// pr($result);die;
		$this->data["result"] = $result;
		$views[] = "module_list";
        view_load($views,$this->data);
    }

    public function reorder_module()
    {
        if ($this->input->is_ajax_request()) {

        	// pr(json_decode($_POST['reorder_module']));die;
            if (isset($_POST['reorder_module']) && !empty($_POST['reorder_module'])) 
            {
                $reorder_module	= json_decode($this->input->post('reorder_module'));

            	foreach ($reorder_module as $rbkey => $module) {

            		$this->db->where("id",$module->id);
            		$this->db->update(TBL_PREFIX."form",['order_by'=>$rbkey+1,'parent_id'=>0]);
            		if(isset($module->children) && !empty($module->children))
            		{
            			foreach ($module->children as $key2 => $children) {

		            		$this->db->where("id",$children->id);
		            		$this->db->update(TBL_PREFIX."form",['order_by'=>$key2+1,'parent_id'=>$module->id]);
		            	}
            		}
            	}

            	// pr($new_data);die;
	            $form->form_data		= $new_data;
	            $updates              	= array();
                $updates['form_data'] 	= json_encode($form);
                // pr(json_decode($updates['form_data']));die;
                $this->db->trans_start();
                $this->db->where('id', $result->id);
                $res = $this->db->update(TBL_PREFIX.'form', $updates);
                $this->db->trans_complete();
                if($res)
                {
        			echo json_encode(['status' => 1, 'message' => 'Module successfully reordered.']);
                }
                else
                {
        			echo json_encode(['status' => 0, 'message' => 'Module could not be reordered.']);
                }
		        
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
    
    public function remove_module()
    {
        if ($this->input->is_ajax_request()) {
        	// pr($_POST);die;
            if (isset($_POST['module_id']) && !empty($_POST['module_id'])) 
            {
                $module_id	= ($this->input->post('module_id'));
                $this->db->trans_start();
                $this->db->where('id', $module_id);
                $this->db->where('module_type',2);
                $res = $this->db->update(TBL_PREFIX.'form',['is_deleted'=>2]);
                $this->db->trans_complete();
                if($res)
                {
        			echo json_encode(['status' => 1, 'message' => 'Module successfully deleted.']);
                }
                else
                {
        			echo json_encode(['status' => 0, 'message' => 'Module could not be deleted.']);
                }
		        
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
    
    
    public function ajax_list_items($per_page = 10)
    {
        
        $search   = '';
        if ($this->input->is_ajax_request()) {
            $page	= $this->input->post('offset');
            // $per_page = $this->input->post('perpage');
            $search   = $this->input->post('search');
            $search   = isset($search) && !empty($search) ? $search : '';
            $search   = trim($search);
            $cur_page = $page;
            if($page>1){$page -= 1;}
            
            $start = $page * $per_page;
            
            $previous_btn              = true;
            $next_btn                  = true;
            $first_btn                 = false;
            $last_btn                  = false;
            $response                  = $this->form_module_mod->ajax_list_items($search, $per_page, $start);
            $data['result']            = $response;
            $views[]                   = 'ajax_form_list';
            $count                     = $response['count'];
            $data['start']             = $start;
            $data['cur_page']          = $cur_page;
            $data['no_of_paginations'] = ceil($count / $per_page);
            $data['previous_btn']      = $previous_btn;
            $data['next_btn']          = $next_btn;
            $data['first_btn']         = $first_btn;
            $data['last_btn']          = $last_btn;
            ajax_layout($views, $data);
        }
    }

    /**
     * add()
     *
     * This function add Support
     *
     * @access    public
     * @return    boolean data
     */
    public function add()
    {

        if (isPostBack()) {
            $id = $this->form_module_mod->add();
            // pr($id);die;
            if (!$id['empty']) {
                clearPostData();
                set_flashdata('success', 'Form added Successfully');
                redirect($this->data['base_url'] . "/list_items/");
            } else {
                // echo "aya";die;
                $this->data['error_msg'] = $id['form_error'];
                //pr($this->data['error_msg']);die;
            }
        }
        $this->data['action']    = "add";
        $views[]                 = "dynamic_form";
        $this->data['submodule'] = 'Add Form Module';
        //pr($data);die;
        view_load($views, $this->data);
    }

    /**
     * add()
     *
     * This function add Support
     *
     * @access    public
     * @return    boolean data
     */

    public function add_Column($id)
    {
        //echo $id;die;
        if (empty($id)) {
            redirect(base_url('form_module'));
        }
        $result = $this->form_module_mod->get_form($id);
        // pr($result);die;
        if (isPostBack()) {
            $this->form_validation->set_rules('field_label', 'field label', 'trim|xss_clean|required');
            $this->form_validation->set_rules('field_name', 'field name', 'trim|xss_clean|required');
            $this->form_validation->set_rules('field_type', 'field type', 'trim|xss_clean|required');

            if ($this->form_validation->run() == false) {
                $this->data['error_msg'] = validation_errors();
            } else {

                $requ = $this->input->post(null, true);
                // pr($requ);

                if ($this->db->field_exists(strtolower($requ['field_name']), TBL_PREFIX. $result->form_name)) {

                    $this->data['error_msg'] = 'This column already exists. Please another name of the column. ';
                    // pr($data['error_msg']);die;
                    set_flashdata('error', $data['error_msg']);

                }
                elseif(!isset($requ['block_name']) || empty($requ['block_name']))
                {
                	$this->data['error_msg'] = 'Please select block';
                    // pr($data['error_msg']);die;
                    set_flashdata('error', $data['error_msg']);
                }
                else {
                    //pr($requ['field_name']);
                    //pr($result->form_name);die;
                    //pr($requ);die;
                    $addColumn = array();
					                    
                    //echo "yesss";die;
                    // pr($requ);die;
                    if ($requ['field_type'] == 'text') {
                        $addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'text',
                            'label'          => ucwords($requ['field_label']),
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                        // pr($addColumn);die;

                    } else if ($requ['field_type'] == 'file') {
                        $addColumn = (object) array(
                            'type'           => 'file',
                            'data-input'     => 'file',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                    } else if ($requ['field_type'] == 'image') {
                        $addColumn = (object) array(
                            'type'           => 'file',
                            'data-input'     => 'image',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                    } else if ($requ['field_type'] == 'hidden') {
                        $addColumn = (object) array(
                            'label'          => $requ['field_label'],
                            'type'           => 'hidden',
                            'data-input'     => 'hidden',
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'value'          => $requ['hidden_value'],
                        );
                    } else if ($requ['field_type'] == 'url') {
                        $addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'url',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                    } else if ($requ['field_type'] == 'password') {
                        $addColumn = (object) array(
                            'type'           => 'password',
                            'data-input'     => 'password',
                            'label'          => $requ['field_label'],

                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                    } else if ($requ['field_type'] == 'radio') {

                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {

                                if (!empty($requ['display'][$i]) && !empty($requ['value'][$i])) {
                                    $options[] = (object) array('type' => 'radio', 'data-input' => 'radio', 'name' => strtolower($requ['field_name']), 'label' => $requ['display'][$i], 'value' => $requ['value'][$i], "checked" => ($i == 0) ? "true" : "");
                                }

                                $i++;
                            }
                        }

                        //pr($requ);die;
                        //pr($options);die;
                        $addColumn = (object) array(
                            'type'           => 'label',
                            'data-input'     => 'radio',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'list'			 => $options
                        );

                        //$addColumn = (object) array('type' => 'label', 'data-input' => 'radio', 'label' => $requ['field_label'], 'name' => strtolower($requ['field_name']), 'list' => $options);

                    } else if ($requ['field_type'] == 'select') {
                        //echo"opennnn";die;
                        if ($requ['type'] == 1) {
                            if (isset($requ['display']) && !empty($requ['display'])) {
                                $options = array();
                                $i       = 0;
                                foreach ($requ['display'] as $val) {
                                    $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                    $i++;
                                }
                            }

                            $addColumn = (object) array(
                                'type'           => 'select',
                                'data-input'     => 'select',
                                'label'          => $requ['field_label'],
                                'name'           => strtolower($requ['field_name']),
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'options'        => $options,
                            );
                        } else if ($requ['type'] == 2) {
                            if ($requ['table_name'] == 'country') {
                                $addColumn = (object) array(
                                    'type'           => 'combo',
                                    'data-input'     => 'select',
                                    'data-select'    => 'country',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'connector'      => $this->get_Country(),
                                    'filtering'      => "true",
                                );
                            } else if ($requ['table_name'] == 'state') {
                                $addColumn = (object) array(
                                    'type'           => 'combo',
                                    'data-input'     => 'select',
                                    'data-select'    => 'state',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'connector'      => $this->get_state(),
                                    'filtering'      => "true",
                                );
                            } else if ($requ['table_name'] == 'city') {
                                $addColumn = (object) array(
                                    'type'           => 'combo',
                                    'data-input'     => 'select',
                                    'data-select'    => 'city',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'connector'      => $this->get_city(),
                                    'filtering'      => "true",
                                );
                            }

                        }

                    } else if ($requ['field_type'] == 'multiple_select') {

                        if ($requ['type'] == 1) {
                            if (isset($requ['display']) && !empty($requ['display'])) {
                                $options = array();
                                $i       = 0;
                                foreach ($requ['display'] as $val) {
                                    $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                    $i++;
                                }
                            }

                            $addColumn = (object) array(
                                'type'           => 'multiselect',
                                'data-input'     => 'multiple_select',
                                'label'          => $requ['field_label'],
                                'inputHeight'    => '100',
                                'inputWidth'     => '150',
                                'name'           => strtolower($requ['field_name']) . '[]',
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'options'        => $options,
                            );
                        } else if ($requ['type'] == 2) {
                            if ($requ['table_name'] == 'country') {
                                $addColumn = (object) array(
                                    'type'           => 'combo',
                                    'data-input'     => 'multiple_select',
                                    'data-select'    => 'country',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'connector'      => $this->get_Country(),
                                    'filtering'      => "true",
                                );
                            } else if ($requ['table_name'] == 'state') {
                                $addColumn = (object) array(
                                    'type'           => 'combo',
                                    'data-input'     => 'multiple_select',
                                    'data-select'    => 'state',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'connector'      => $this->get_state(),
                                    'filtering'      => "true",
                                );
                            } else if ($requ['table_name'] == 'city') {
                                $addColumn = (object) array(
                                    'type'           => 'combo',
                                    'data-input'     => 'multiple_select',
                                    'data-select'    => 'city',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'connector'      => $this->get_city(),
                                    'filtering'      => "true",
                                );
                            }

                        }
                    } else if ($requ['field_type'] == 'email') {
                        $addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'email',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty,ValidEmail" : "",
                        );
                    } else if ($requ['field_type'] == 'date') {
                        $addColumn = (object) array(
                            'type'             => 'calendar',
                            'data-input'       => 'date',
                            'label'            => $requ['field_label'],
                            'name'             => strtolower($requ['field_name']),
                            'view_in_mobile'   => strtolower($requ['view_in_mobile']),
                            'view_on_left'     => strtolower($requ['view_on_left']),
                            'status'           => strtolower($requ['status']),
                            'values'           => strtolower($requ['field_default_value']),
                            'required'         => ($requ['field_required'] == 'on') ? "true" : "false",
                            'calendarPosition' => "right",
                            "dateFormat"       => "%Y-%m-%d",
                        );
                    } else if ($requ['field_type'] == 'number') {
                        $addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'number',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => "ValidNumeric",
                        );
                    } else if ($requ['field_type'] == 'textarea') {
                        $addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'textarea',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            "rows"           => "5",
                        );
                    } else if ($requ['field_type'] == 'checkbox') {
                        $addColumn = (object) array(
                            'type'           => 'checkbox',
                            'data-input'     => 'checkbox',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                    } else if ($requ['field_type'] == 'multiple_checkbox') {
                        $addColumn[] = new stdClass();
                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                if (!empty($requ['display'][$i]) && !empty($requ['value'][$i])) {
                                    $options[] = (object) array('type' => 'checkbox', 'data-input' => 'checkbox', 'name' => strtolower($requ['field_name']) . '[' . $requ['value'][$i] . ']', 'label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                }

                                $i++;
                            }
                        }
                        $addColumn = (object) array(
                            'type'           => 'label',
                            'data-input'     => 'multiple_checkbox',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'list'			 => $options
                        );

                        //$addColumn = (object) array('type' => 'label', 'data-input' => 'multiple_checkbox', 'label' => $requ['field_label'], 'name' => strtolower($requ['field_name']), 'list' => $options);

                        //$addColumn = $options;
                        //pr($addColumn);    die;
                    }
                    else
                    {
                    	$addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'text',
                            'label'          => ucwords($requ['field_label']),
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        );
                    }

                   	if(isset($requ['is_relation']) && $requ['is_relation']=='on')
                   	{
	                   	$addColumn->is_relation->table = $requ['relation_table'];
	                   	$addColumn->is_relation->column = $requ['relation_column'];
                   	}
                   	else
                   	{
	                   	$addColumn->is_relation = 0;
                   	}

                    $tblFormData = new stdClass();
                    $flag = 0;
                    if (isset($result->form_data) && !empty($result->form_data)) {
                    	/*If column exist*/
                    	$tblFormData 	= json_decode($result->form_data);
                    	// echo "Old tblFormData<br>";
                    	// pr($tblFormData->form_data);
                    	// pr($requ['block_name']);die;
                    	foreach ($tblFormData->form_data as $key => $frm_data) {
                    		if(strtolower($frm_data->block) == strtolower($requ['block_name']) && $flag==0)
                    		{
                    			/*echo $frm_data->block;
                    			echo "<br>";
                    			echo $requ['block_name'];*/
                    			$tblFormData->form_data[$key]->elements[] = $addColumn;
                    			$flag = 1;
                    		}
                    	}
                    	
                    	// echo "New tblFormData";
                    	// pr($tblFormData);die;
                    }
                    else { 
                    	
                    	#If no column added

	                    /*Extra param*/
	                    $settings 	= ['type'=>'settings','position'=>'label-left','labelWidth'=>'150','inputWidth'=>'350'];
	                    $extra[0] 	= (object) array("type" => "hidden", "name" => "form_name", "value" => $result->form_name);
	                    $extra[1] 	= (object) array("type" => "button", "name" => "submit", "value" => "submit", "offsetLeft" => "45");
	                    /*Extra param*/

	                    $tblFormData->setting 					= (object) $settings;
	                    $tblFormData->extra 					=  $extra;
	                    $tblFormData->form_data[0]->block 		= 'default';
	                    $tblFormData->form_data[0]->elements[0] = $addColumn;
	                    // echo "else";
	                    // pr($tblFormData);die;
                    }
                    // echo "Last";die;
                    // pr($tblFormData);die;

                    //pr(json_encode($addColumn));die;

                    $updates              = array();
                    $updates['form_data'] = json_encode($tblFormData);
                    $this->db->trans_start();
                    $this->db->where('id', $result->id);
                    $res = $this->db->update(TBL_PREFIX.'form', $updates);
                    // echo $this->db->last_query();
                    // var_dump($res);
                    if ($res) {

                    	$data_type 				= "";
                    	$field_length 			= " (250) ";
                    	$column_df_value		= " NULL ";

                    	if(isset($requ['column_df_value']) && $requ['column_df_value']!='')
                    	{
                    		$column_df_value	= " NOT NULL DEFAULT '".$requ['column_df_value']."'";
                    	}
                    	if(isset($requ['field_length']) && !empty($requ['field_length']))
                    	{
                    		$field_length 		= " (".$requ['field_length'].") ";
                    	}
                    	if(isset($requ['data_type']) && !empty($requ['data_type']))
                    	{
                    		$data_type 			= $requ['data_type'].$field_length;
                    	}
                    	else
                    	{
                    		if ($requ['field_type'] == 'text') {

	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'email') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'textarea') {

	                            $data_type = "TEXT";

	                        } else if ($requ['field_type'] == 'checkbox') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'multiple_checkbox') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'hidden') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'url') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'file') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'image') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'password') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'radio') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'select') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'multiple_select') {
	                            
	                            $data_type = "VARCHAR".$field_length;

	                        } else if ($requ['field_type'] == 'date') {

	                            $data_type = "DATE";

	                        } else if ($requ['field_type'] == 'number') {
	                            
	                            $data_type = "VARCHAR".$field_length;
	                        }
                    	}

                        $alter = " ADD COLUMN " . strtolower($requ['field_name']) ." ". $data_type;
                        // echo $alter;die;
                        $sql = "ALTER TABLE ".TBL_PREFIX . $result->form_name .$alter.$column_df_value;
                        $this->db->query($sql);
                        $this->db->trans_complete();
                        // echo "<br>";
                        // echo $this->db->last_query();die;
                        set_flashdata('success', 'Add column successfully');
                        redirect(base_url('form_module/view/' . $result->id));
                    }
                    else
                    {
                    	set_flashdata('success', 'Column could not added');
                        // redirect(base_url('form_module/view/' . $result->id));
                    }

                    //pr(trim(explode(',',$val)[1]));die;
                    set_flashdata('error', 'cross site attack');
                    redirect(base_url('form_module/view/' . $result->id));
                }
            }

        }
        $formData1	= json_decode($result->form_data);
        $blocks		= [];
        if(!empty($formData1))
        {
	        $formData	= $formData1->form_data;
	        foreach ($formData as $key => $value) {

	        	$blocks[] = $value->block;
	        }
        }
        // pr($blocks);die;
        $this->data['result']	= $result;
        $this->data['blocks']	= $blocks;
        $this->data['action']	= "add";
        $views[]				= "add_column";
        $this->data['submodule']= 'Add Form Column';
        //pr($this->data);die;
        view_load($views, $this->data);

    }

    /**
     * add()
     *
     * This function add Support
     *
     * @access    public
     * @return    boolean data
     */
    public function edit_Column($id, $key)
    {
        if (empty($id)) {
            redirect(base_url('form_module'));
        }

        $result 	= $this->form_module_mod->get_form($id);
        $form_name 	= $result->form_name;
        $form1 		= json_decode($result->form_data);
        $key 		= explode('_', $key);
        // pr($result);die;
        // echo count($key);die;
        if(!is_array($key) || !count($key)>1)
        {
        	redirect(base_url('form_module'));
        }
        $block_indx 	= $key[0];
        $column_indx 	= $key[1];
        if(!isset($form1->form_data[$block_indx]->elements))
        {
        	redirect(base_url('form_module'));
        }
        $form 	= $form1->form_data[$block_indx]->elements;
        if(!isset($form[$column_indx]))
        {
        	redirect(base_url('form_module'));
        }
        $col 		= $form[$column_indx];
        $field_name = $col->name;
        $field_details = [];
        $columns 	= $this->db->field_data(TBL_PREFIX.$form_name);
        foreach ($columns as $key => $val) {
	       	if ($val->name == $field_name) {
	           $field_details = $val;
	       }
	   	}

        // pr($field_details);die;
        // unset($form[$key]);
        //$form 		= array_values($form);
        //$addColumn 	= $form;
        if (isPostBack()) {

            $this->form_validation->set_rules('field_label', 'field label', 'trim|xss_clean|required');
            $this->form_validation->set_rules('field_name', 'field name', 'trim|xss_clean|required');

            if ($this->form_validation->run() == FALSE) {
                $data['error_msg'] = validation_errors();
            } else {

                $requ = $this->input->post(NULL, TRUE);
                // pr($requ);die;
                
                if (strtolower($requ['previous_name']) != strtolower($requ['field_name']) && $this->db->field_exists(strtolower($requ['field_name']), TBL_PREFIX . $result->form_name)) {

                	$this->data['error_msg'] = 'This column already exists. Please another name of the column. ';
                }
                else{

	                $addColumn = array();
	                if (isset($result->form_data) && !empty($result->form_data)) {
	                    if ($requ['field_type'] == 'text') {
	                        $addColumn = (object) array(
	                            'type'           => 'input',
	                            'label'          => ucwords($requ['field_label']),
	                            'data-input'     => 'text',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique' 	   => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    } else if ($requ['field_type'] == 'file') {
	                        $addColumn = (object) array(
	                            'type'           => 'file',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'file',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique' => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    } else if ($requ['field_type'] == 'image') {
	                        $addColumn = (object) array(
	                            'type'           => 'file',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'image',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique' => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    } else if ($requ['field_type'] == 'hidden') {
	                        $addColumn = (object) array(
	                            'label'          => $requ['field_label'],
	                            'type'           => 'hidden',
	                            'data-input'     => 'hidden',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'value'          => $requ['hidden_value'],
	                        );
	                    } else if ($requ['field_type'] == 'url') {
	                        $addColumn = (object) array(
	                            'type'           => 'input',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'url',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique' => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    } else if ($requ['field_type'] == 'password') {
	                        $addColumn = (object) array(
	                            'type'           => 'password',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'password',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique' => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    } else if ($requ['field_type'] == 'radio') {

	                        if (isset($requ['display']) && !empty($requ['display'])) {
	                            $options = array();
	                            $i       = 0;
	                            foreach ($requ['display'] as $val) {
	                                
	                                if (!empty($requ['display'][$i]) && !empty($requ['value'][$i])) {
	                                    $options[] = (object) array('type' => 'radio', 'name' => strtolower($requ['field_name']), 'label' => $requ['display'][$i], 'value' => $requ['value'][$i], "checked" => ($i == 0) ? "true" : "");
	                                }

	                                $i++;
	                            }
	                        }

	                        //pr($requ);die;
	                        //pr($options);die;
	                        $addColumn = (object) array(
	                            'type'           => 'label',
	                            'data-input'     => 'radio',
	                            'label'          => $requ['field_label'],
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                            'list'			 => $options
	                        );
	                        //$addColumn = (object) array('type' => 'label', 'data-input' => 'radio', 'label' => $requ['field_label'], 'name' => strtolower($requ['field_name']), 'list' => $options);

	                    } else if ($requ['field_type'] == 'select') {
	                        if ($requ['type'] == 1) {
	                            if (isset($requ['display']) && !empty($requ['display'])) {
	                                $options = array();
	                                $i       = 0;
	                                foreach ($requ['display'] as $val) {
	                                    $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
	                                    $i++;
	                                }
	                            }

	                            $addColumn = (object) array(
	                                'type'           => 'select',
	                                'label'          => $requ['field_label'],
	                                'data-input'     => 'select',
	                                'name'           => strtolower($requ['field_name']),
	                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                'view_on_left'   => strtolower($requ['view_on_left']),
	                                'status'         => strtolower($requ['status']),
	                                'values'         => strtolower($requ['field_default_value']),
	                                'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                'options'        => $options,
	                            );
	                        } else if ($requ['type'] == 2) {
	                            if ($requ['table_name'] == 'country') {
	                                $addColumn = (object) array(
	                                    'type'           => 'combo',
	                                    'label'          => $requ['field_label'],
	                                    'data-input'     => 'select',
	                                    'data-select'    => 'country',
	                                    'name'           => strtolower($requ['field_name']),
	                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                    'view_on_left'   => strtolower($requ['view_on_left']),
	                                    'status'         => strtolower($requ['status']),
	                                    'values'         => strtolower($requ['field_default_value']),
	                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                    'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                    'connector'      => $this->get_Country(),
	                                    'filtering'      => "true",
	                                );
	                            } else if ($requ['table_name'] == 'state') {
	                                $addColumn = (object) array(
	                                    'type'           => 'combo',
	                                    'label'          => $requ['field_label'],
	                                    'data-input'     => 'select',
	                                    'data-select'    => 'state',
	                                    'name'           => strtolower($requ['field_name']),
	                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                    'view_on_left'   => strtolower($requ['view_on_left']),
	                                    'status'         => strtolower($requ['status']),
	                                    'values'         => strtolower($requ['field_default_value']),
	                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                    'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                    'connector'      => $this->get_state(),
	                                    'filtering'      => "true",
	                                );
	                            } else if ($requ['table_name'] == 'city') {
	                                $addColumn = (object) array(
	                                    'type'           => 'combo',
	                                    'label'          => $requ['field_label'],
	                                    'data-input'     => 'select',
	                                    'data-select'    => 'city',
	                                    'name'           => strtolower($requ['field_name']),
	                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                    'view_on_left'   => strtolower($requ['view_on_left']),
	                                    'status'         => strtolower($requ['status']),
	                                    'values'         => strtolower($requ['field_default_value']),
	                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                    'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                    'connector'      => $this->get_city(),
	                                    'filtering'      => "true",
	                                );
	                            }
	                        }

	                    } else if ($requ['field_type'] == 'multiple_select') {
	                    	
	                        if ($requ['type'] == 1) {
	                            if (isset($requ['display']) && !empty($requ['display'])) {
	                                $options = array();
	                                $i       = 0;
	                                foreach ($requ['display'] as $val) {
	                                    $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
	                                    $i++;
	                                }
	                            }

	                            $addColumn = (object) array(
	                                'type'           => 'multiselect',
	                                'label'          => $requ['field_label'],
	                                'data-input'     => 'multiple_select',
	                                'inputHeight'    => '100',
	                                'inputWidth'     => '150',
	                                'name'           => strtolower($requ['field_name']) . '[]',
	                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                'view_on_left'   => strtolower($requ['view_on_left']),
	                                'status'         => strtolower($requ['status']),
	                                'values'         => strtolower($requ['field_default_value']),
	                                'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                'options'        => $options,
	                            );
	                        } else if ($requ['type'] == 2) {
	                            if ($requ['table_name'] == 'country') {
	                                $addColumn = (object) array(
	                                    'type'           => 'combo',
	                                    'label'          => $requ['field_label'],
	                                    'data-input'     => 'multiple_select',
	                                    'data-select'    => 'country',
	                                    'name'           => strtolower($requ['field_name']),
	                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                    'view_on_left'   => strtolower($requ['view_on_left']),
	                                    'status'         => strtolower($requ['status']),
	                                    'values'         => strtolower($requ['field_default_value']),
	                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                    'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                    'connector'      => $this->get_Country(),
	                                    'filtering'      => "true",
	                                );
	                            } else if ($requ['table_name'] == 'state') {
	                                $addColumn = (object) array(
	                                    'type'           => 'combo',
	                                    'label'          => $requ['field_label'],
	                                    'data-input'     => 'multiple_select',
	                                    'data-select'    => 'state',
	                                    'name'           => strtolower($requ['field_name']),
	                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                    'view_on_left'   => strtolower($requ['view_on_left']),
	                                    'status'         => strtolower($requ['status']),
	                                    'values'         => strtolower($requ['field_default_value']),
	                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                    'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                    'connector'      => $this->get_state(),
	                                    'filtering'      => "true",
	                                );
	                            } else if ($requ['table_name'] == 'city') {
	                                $addColumn = (object) array(
	                                    'type'           => 'combo',
	                                    'label'          => $requ['field_label'],
	                                    'data-input'     => 'multiple_select',
	                                    'data-select'    => 'city',
	                                    'name'           => strtolower($requ['field_name']),
	                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                                    'view_on_left'   => strtolower($requ['view_on_left']),
	                                    'status'         => strtolower($requ['status']),
	                                    'values'         => strtolower($requ['field_default_value']),
	                                    'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                                    'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                                    'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                                    'connector'      => $this->get_city(),
	                                    'filtering'      => "true",
	                                );
	                            }

	                        }
	                    
	                    } else if ($requ['field_type'] == 'email') {
	                        $addColumn = (object) array(
	                            'type'           => 'input',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'email',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty,ValidEmail" : "",
	                            'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    
	                    } else if ($requ['field_type'] == 'date') {
	                        $addColumn = (object) array(
	                            'type'             => 'calendar',
	                            'label'            => $requ['field_label'],
	                            'data-input'       => 'date',
	                            'name'             => strtolower($requ['field_name']),
	                            'view_in_mobile'   => strtolower($requ['view_in_mobile']),
	                            'view_on_left'     => strtolower($requ['view_on_left']),
	                            'status'           => strtolower($requ['status']),
	                            'values'           => strtolower($requ['field_default_value']),
	                            'required'         => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'calendarPosition' => "right",
	                            "dateFormat"       => "%Y-%m-%d",
	                            'unique'           => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'         => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    } else if ($requ['field_type'] == 'number') {
	                        $addColumn = (object) array(
	                            'type'           => 'input',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'number',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => "ValidNumeric",
	                            'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    
	                    } else if ($requ['field_type'] == 'textarea') {
	                        $addColumn = (object) array(
	                            'type'           => 'input',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'textarea',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                            "rows"           => "5",
	                            'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    
	                    } else if ($requ['field_type'] == 'checkbox') {
	                        $addColumn = (object) array(
	                            'type'           => 'checkbox',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'checkbox',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                            'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                        );
	                    
	                    } else if ($requ['field_type'] == 'multiple_checkbox') {
	                        $addColumn[] = new stdClass();
	                        if (isset($requ['display']) && !empty($requ['display'])) {
	                            $options = array();
	                            $i       = 0;
	                            foreach ($requ['display'] as $val) {
	                                if (!empty($requ['display'][$i]) && !empty($requ['value'][$i])) {
	                                    $options[] = (object) array('type' => 'checkbox', 'data-input' => 'multiple_checkbox', 'name' => strtolower($requ['field_name']) . '[' . $requ['value'][$i] . ']', 'label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
	                                }

	                                $i++;
	                            }
	                        }

	                        $addColumn = (object) array(
	                            'type'           => 'label',
	                            'label'          => $requ['field_label'],
	                            'data-input'     => 'multiple_checkbox',
	                            'name'           => strtolower($requ['field_name']),
	                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
	                            'view_on_left'   => strtolower($requ['view_on_left']),
	                            'status'         => strtolower($requ['status']),
	                            'values'         => strtolower($requ['field_default_value']),
	                            'required'       => ($requ['field_required'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
	                            'unique'         => ($requ['field_unique'] == 'on') ? "true" : "false",
	                            'validate'       => ($requ['field_unique'] == 'on') ? "NotEmpty" : "",
	                            'list'			 =>$options
	                        );

	                        //$addColumn = (object) array('type' => 'label', 'data-input' => 'multiple_checkbox', 'name' => strtolower($requ['field_name']), 'label' => $requ['field_label'], 'list' => $options);
	                    }

		                $tblFormData = new stdClass();
		                $tblFormData = json_decode($result->form_data);
		            	// echo "Old tblFormData";
		            	// pr($tblFormData);

		            	$tblFormData->form_data[$block_indx]->elements[$column_indx] = $addColumn;
		                //pr($addColumn);die;
		                // echo "New tblFormData";
		            	// pr($tblFormData);die;
		            	$this->db->trans_start();
		                $updates              = array();
		                $updates['form_data'] = json_encode($tblFormData);
		                $this->db->where('id', $result->id);
		                $res = $this->db->update(TBL_PREFIX.'form', $updates);
		                if ($res) {

		                    $data_type 				= "";
		                	$field_length 			= " (250) ";
		                	$column_df_value		= " NULL ";

		                	if(isset($requ['column_df_value']) && $requ['column_df_value']!='')
		                	{
		                		$column_df_value	= " NOT NULL DEFAULT '".$requ['column_df_value']."'";
		                	}
		                	if(isset($requ['field_length']) && !empty($requ['field_length']))
		                	{
		                		$field_length 		= " (".$requ['field_length'].") ";
		                	}
		                	if(isset($requ['data_type']) && !empty($requ['data_type']))
		                	{
		                		if($requ['data_type']=='INT' && (!isset($requ['field_length']) || empty($requ['field_length']) ))
		                		{
		                			$data_type	= $requ['data_type']." (11) ";
		                		}
		                		elseif($requ['data_type']=='DECIMAL' || $requ['data_type']=='FLOAT' || $requ['data_type']=='DOUBLE' && (!isset($requ['field_length']) || empty($requ['field_length']) ))
		                		{
		                			$data_type	= $requ['data_type']." (8,2) ";
		                		}
		                		else
		                		{
		                			$data_type	= $requ['data_type'].$field_length;
		                		}
		                	}
		                	else
		                	{
		                		if ($requ['field_type'] == 'text') {

		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'email') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'textarea') {

		                            $data_type = "TEXT";

		                        } else if ($requ['field_type'] == 'checkbox') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'multiple_checkbox') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'hidden') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'url') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'file') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'image') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'password') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'radio') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'select') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'multiple_select') {
		                            
		                            $data_type = "VARCHAR".$field_length;

		                        } else if ($requ['field_type'] == 'date') {

		                            $data_type = "DATE";

		                        } else if ($requ['field_type'] == 'number') {
		                            
		                            $data_type = "VARCHAR".$field_length;
		                        }
		                	}

		                	// echo "End";
		                	// pr($requ);die;
		                    $alter = "ALTER TABLE ".TBL_PREFIX. $result->form_name . " CHANGE " . $col->name . " " . strtolower($requ['field_name'])." ".$alter.$data_type.$column_df_value;
		                    // pr($alter);die;

		                    $this->db->query($alter);
		                    $this->db->trans_complete();
		                    set_flashdata('success', 'Edit column successfully');
		                    redirect(base_url('form_module/view/' . $result->id));
		                }
	                }
                }
            }
        }
        
        $this->data['field_details']= $field_details;
        $this->data['result']    	= $result;
        $this->data['cols']      	= (array) $col;
        $this->data['action']    	= "edit";
        $views[]                 	= "edit_column";
        $this->data['submodule'] 	= 'Edit Form Column';
        //pr($this->data);die;
        view_load($views, $this->data);
    }

    //==============Update Support=======================//
    /**
     * edit()
     *
     * This function Update Support against id
     *
     * @access    public
     * @return    boolean data
     */
    public function edit($id)
    {

        if (isPostBack()) {
        	// pr($_POST);
            $response = $this->form_module_mod->edit($id);
            // pr($response);die;
            if (!$response['empty']) {
                clearPostData();
                set_flashdata('success', 'Form updated Successfully');
                redirect(base_url('form_module/list_items'));
            } else {
                $data['error_msg'] = $response['error_msg'];
            }
        }

        $result = $this->form_module_mod->get_form($id);
        //pr($result);die;
        if (isset($result)) {
            $this->data['result']    = $result;
            $this->data['action']    = "edit";
            $views[]                 = "dynamic_edit_form";
            $this->data['submodule'] = 'Edit Form';

            view_load($views, $this->data);
        } else {
            redirect(base_url('form_module/list_items'));
        }
    }

	//==============View Support=================//
    /**
     * View()
     *
     * This function View Support against id
     *
     * @access    public
     * @return    boolean data
     */
    public function view($id = null)
    {

        if (isPostBack()) {
            set_flashdata('error', 'cross site attack');
            redirect(base_url('support/list_items'));
        }
        $this->data['grid']['cols'] = $this->form_module_mod->get_flexigrid_cols_dynamic_form();
        $result                     = $this->form_module_mod->get_form($id);
        // pr($result);die;
        if ($result) {
        	// echo "string";
            $form1 = json_decode($result->form_data);
            // pr($form1->form_data);die;
            $all_form_data = [];
            if(count($form1->form_data) && !empty($form1->form_data)){
	            foreach ($form1->form_data as $key1 => $value) {
	            	if(!empty($value->elements && count($value->elements)>0))
	            	{
	            		// $all_form_data = array_merge($all_form_data, $value->elements);

	            		foreach ($value->elements as $key2 => $value) {
	            			
	            			$all_form_data[$key1.'_'.$key2] = $value;
	            		}
	            	}
	            	// pr($value->elements);
	            }
        	}
            // $form = $form1->form_data[0]->elements;
            // pr($all_form_data);die;
            //$this->data['grid']['result'] = $result;
            $this->data['grid']['forms']       	= $all_form_data;
            $this->data['move_columns']			= $form1->form_data;
            $this->data['grid']["page_offset"] 	= 1;
            $this->data['grid']["limit"]       	= $limit;
            $this->data['grid']["order_by"]    	= 'id';

            $this->data['grid']['base_url'] 	= $this->data['base_url'];
            $this->data['column_add_id']    	= $id;
            $this->data['action']           	= "view";
            $views[]                        	= "view_column";
            $this->data['submodule']        	= 'Add Column';
            $this->data['custom_edit']			= '1';
            $this->data['extra_btn']        	= '<span class="grid-button" style="margin-right:0px;" ><div class="fbutton"><div><span data-toggle="modal" data-target="#move_column" class="add"><span aria-hidden="true" class="fa fa-random grid-list-icon"></span>Set Position</span></div></div></span>';
            // pr($this->data['move_columns']);die;
            view_load($views, $this->data);
        } else {
            //set_flashdata('error','No form Found');
            redirect(base_url('form_module/list_items'));
        }
    }

    public function delete()
    {

        $items      = $this->input->get_post('items', true);
        $items_data = str_replace("row", "", $items);
        $items_data = explode(",", $items_data);
        if (!$items) {
            redirect(base_url('form_module'));
        }

        $result = $this->form_module_mod->get_form($id);

        $update                 = array();
        $update['is_deleted']   = 2;
        $update['view_on_left'] = 2;

        $this->db->where_in('id', $items_data);
        //filter_data();
        $qry = $this->db->update(TBL_PREFIX.'form', $update);
        //$qry = $this->db->delete(TBL_PREFIX.'form');
        //delete_report($items_data)

        if ($qry) {
            //$this->db->query("DROP TABLE ".TBL_PREFIX.$result->form_name);
            set_flashdata('success', 'Delete successfully');
            redirect(base_url('form_module'));
        } else {
            set_flashdata('error', 'Not deleted ');
            redirect(base_url('form_module'));
        }

    }

    //==============Close View Support=======================//
    public function support_delete($id)
    {
        $delete = $this->support_mod->delete_support($id);
        if ($delete) {
            redirect(base_url('support/list_items'));
        }

    }

    public function get_Country()
    {
        $this->db2 = $this->load->database('dbclient', true);

        $this->db2->select('*');
        $this->db2->from('country_master');
        $this->db2->where('Data_Flag', 'GANGOTRI');
        $this->db2->limit(10);
        $qry = $this->db2->get();

        if ($qry->num_rows()) {
            $country = $qry->result();
        } else {
            $country = array();
        }
        $newArr = array();
        if (!empty($country)) {
            //$newArr = new StdClass();
            $i = 0;
            foreach ($country as $k => $v) {
                //$newArr['options'][$i]->value = $v->Country_Code;
                $newArr['options'][$i]->value = $v->Country_Name;
                $newArr['options'][$i]->text  = $v->Country_Name;
                $i++;
            }
        }
        return json_encode($newArr);
    }

    public function get_state()
    {
        $this->db2 = $this->load->database('dbclient', true);

        $this->db2->select('*');
        $this->db2->from('state_master');
        $this->db2->where('DATA_FLAG', 'GANGOTRI');
        $this->db2->limit(10);
        $qry = $this->db2->get();

        if ($qry->num_rows()) {
            $country = $qry->result();
        } else {
            $country = array();
        }
        $newArr = array();
        if (!empty($country)) {
            //$newArr = new StdClass();
            $i = 0;
            foreach ($country as $k => $v) {
                //$newArr['options'][$i]->value = $v->STATE_CODE;
                $newArr['options'][$i]->value = $v->STATE_NAME;
                $newArr['options'][$i]->text  = $v->STATE_NAME;
                $i++;
            }
        }
        return json_encode($newArr);
    }
    public function get_city()
    {
        $this->db2 = $this->load->database('dbclient', true);

        $this->db2->select('*');
        $this->db2->from('city_master');
        $this->db2->where('Data_Flag', 'GANGOTRI');
        $this->db2->limit(10);
        $qry = $this->db2->get();

        if ($qry->num_rows()) {
            $country = $qry->result();
        } else {
            $country = array();
        }
        $newArr = array();
        if (!empty($country)) {
            //$newArr = new StdClass();
            $i = 0;
            foreach ($country as $k => $v) {
                //$newArr['options'][$i]->value = $v->CITY_CODE;
                $newArr['options'][$i]->value = $v->CITY_NAME;
                $newArr['options'][$i]->text  = $v->CITY_NAME;
                $i++;
            }
        }
        return json_encode($newArr);
    }

    //==============Close View Support=======================//

    public function dynamic_form($id)
    {

        $result = $this->support_form_mod->get_form(ID_decode($id));

        if (isPostBack()) {

            $requ = $this->input->post(null, true);

            if ($this->db->field_exists($requ['field_name'], TBL_PREFIX. $result->form_name)) {
                $data['error_msg'] = 'This column already exists. Please another name of the column. ';

            } else {
                $addColumn = array();

                if (isset($result->form_data) && !empty($result->form_data)) {
                    if ($requ['field_type'] == 'text') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'file') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'file',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'image') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'file',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'hidden') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'  => 'hidden',
                            'name'  => $requ['field_name'],
                            'value' => $requ['hidden_value'],
                        ));
                    } else if ($requ['field_type'] == 'url') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'password') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'password',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'radio') {
                        /* $addColumn[] = new stdClass();
                        $addColumn[0]->list = array((object)array(
                        'type'=>'radio',
                        'label'=>$requ['field_label'],
                        'name'=>$requ['field_name'],
                        'required'=>($requ['field_required']=='on')?"true":"false",
                        'value'=>$requ['radio_value'],
                        ));     */
                        $addColumn[] = new stdClass();
                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                $options[] = (object) array('type' => 'radio', 'name' => $requ['field_name'], 'label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                $i++;
                            }
                        }

                        //pr($requ);die;
                        //pr($options);die;

                        $addColumn[0]->list = array((object) array('type' => 'label', 'label' => $requ['field_label'], 'required' => ($requ['field_required'] == 'on') ? "true" : "false", 'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "", 'list' => $options));

                    } else if ($requ['field_type'] == 'select') {
                        $addColumn[] = new stdClass();
                        if ($requ['type'] == 1) {
                            if (isset($requ['display']) && !empty($requ['display'])) {
                                $options = array();
                                $i       = 0;
                                foreach ($requ['display'] as $val) {
                                    $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                    $i++;
                                }
                            }

                            $addColumn[0]->list = array((object) array(
                                'type'     => 'select',
                                'label'    => $requ['field_label'],
                                'name'     => $requ['field_name'],
                                'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                                'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'options'  => $options,
                            ));
                        } else if ($requ['type'] == 2) {
                            $addColumn[0]->list = array((object) array(
                                'type'      => 'combo',
                                'label'     => $requ['field_label'],
                                'name'      => $requ['field_name'],
                                'required'  => ($requ['field_required'] == 'on') ? "true" : "false",
                                'validate'  => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'connector' => $this->get_Country(),
                                'filtering' => "true",
                            ));
                        }

                    } else if ($requ['field_type'] == 'multiple_select') {
                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                $i++;
                            }
                        }

                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'        => 'multiselect',
                            'label'       => $requ['field_label'],
                            'inputHeight' => '100',
                            'inputWidth'  => '150',
                            'name'        => $requ['field_name'] . '[]',
                            'required'    => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'    => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'options'     => $options,
                        ));
                    } else if ($requ['field_type'] == 'email') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty,ValidEmail" : "",
                        ));
                    } else if ($requ['field_type'] == 'textarea') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            "rows"     => "5",
                        ));
                    } else if ($requ['field_type'] == 'checkbox') {
                        $addColumn[]        = new stdClass();
                        $addColumn[0]->list = array((object) array(
                            'type'     => 'checkbox',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'multiple_checkbox') {
                        $addColumn[] = new stdClass();
                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                $options[] = (object) array('type' => 'checkbox', 'name' => $requ['field_name'] . '[' . $requ['value'][$i] . ']', 'label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                $i++;
                            }
                        }

                        //pr($requ);die;
                        //pr($options);die;

                        $addColumn[0]->list = array('check' => $options);

                        //pr($addColumn);die;
                    }
                    /* else
                    {
                    $addColumn[] = new stdClass();
                    $addColumn->list = array(
                    'type'=>$requ['field_type'],
                    'label'=>$requ['field_label'],
                    'name'=>$requ['field_name'],
                    'required'=>($requ['field_required']=='on')?true:false,
                    );
                    } */

                    // add more column

                    $column = json_decode($result->form_data);

                    $col = $column[0]->list;
                    unset($column[0]->list);

                    $column = array_merge($column, $col);

                    $count = count($column);

                    $sub = array($column[$count - 1]);

                    unset($column[$count - 1]);

                    /* if($requ['field_type'] == 'multiple_checkbox')
                    {
                    $x = 0;
                    foreach($requ['display'] as $v)
                    {
                    $column[0]->list[] = $addColumn[0]->list['check'][$x];
                    $x++;
                    }
                    }
                    else{
                    $column[0]->list[] = $addColumn[0]->list[0];
                    } */

                    $hidden = (object) array("type" => "hidden", "name" => "form_name", "value" => $result->form_name);
                    $newCol = $addColumn[0]->list;

                    /* $column[0]->list[] = $sub;
                    $list = array_values($column[0]->list);
                    unset($column[0]->list);
                    $column[0]->list = $list; */

                    $addColumn = array_merge($column, $hidden, $newCol, $sub);
                    //pr(json_encode($addColumn));die;
                    //pr($addColumn);die;
                } else {
                    if ($requ['field_type'] == 'text') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'file') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'file',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'image') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'file',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'hidden') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'hidden',
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'value'    => $requ['hidden_value'],
                        ));
                    } else if ($requ['field_type'] == 'url') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'password') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'password',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                        ));
                    } else if ($requ['field_type'] == 'radio') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';

                        /* $addColumn[0]->list = array((object)array(
                        'type'=>'radio',
                        'label'=>$requ['field_label'],
                        'name'=>$requ['field_name'],
                        'required'=>($requ['field_required']=='on')?"true":"false",
                        'value'=>$requ['radio_value'],
                        ));
                         */

                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                $options[] = (object) array('type' => 'radio', 'name' => $requ['field_name'], 'label' => $requ['display'][$i], 'value' => $requ['value'][$i], 'required' => ($requ['field_required'] == 'on') ? "true" : "false", 'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "");
                                $i++;
                            }
                        }

                        //pr($requ);die;
                        //pr($options);die;

                        $addColumn[0]->list = array((object) array('type' => 'label', 'label' => $requ['field_label'], 'list' => $options));

                    } else if ($requ['field_type'] == 'select') {
                        if ($requ['type'] == 1) {
                            if (isset($requ['display']) && !empty($requ['display'])) {
                                $options = array();
                                $i       = 0;
                                foreach ($requ['display'] as $val) {
                                    $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                    $i++;
                                }
                            }

                            $addColumn[] = new stdClass();
                            //$addColumn[0]->type = 'fieldset';
                            $addColumn[0]->type       = 'settings';
                            $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                            $addColumn[0]->labelWidth = '150';
                            $addColumn[0]->inputWidth = '350';
                            $addColumn[0]->list       = array((object) array(
                                'type'     => 'select',
                                'label'    => $requ['field_label'],
                                'name'     => $requ['field_name'],
                                'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                                'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'options'  => $options,
                            ));
                        } else if ($requ['type'] == 2) {
                            $addColumn[] = new stdClass();
                            //$addColumn[0]->type = 'fieldset';
                            $addColumn[0]->type       = 'settings';
                            $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                            $addColumn[0]->labelWidth = '150';
                            $addColumn[0]->inputWidth = '350';
                            $addColumn[0]->list       = array((object) array(
                                'type'      => 'combo',
                                'label'     => $requ['field_label'],
                                'name'      => $requ['field_name'],
                                'required'  => ($requ['field_required'] == 'on') ? "true" : "false",
                                'validate'  => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'connector' => $this->get_Country(),
                                'filtering' => "true",
                            ));
                        }

                    } else if ($requ['field_type'] == 'multiple_select') {
                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                $options[] = (object) array('text' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                $i++;
                            }
                        }

                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'        => 'multiselect',
                            'label'       => $requ['field_label'],
                            'inputHeight' => '90',
                            'inputWidth'  => '130',
                            'name'        => $requ['field_name'] . '[]',
                            'required'    => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate'    => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'options'     => $options,
                        ));
                    } else if ($requ['field_type'] == 'email') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty,ValidEmail" : "",
                        ));
                    } else if ($requ['field_type'] == 'textarea') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'input',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            "rows"     => "5",
                        ));
                    } else if ($requ['field_type'] == 'checkbox') {
                        $addColumn[] = new stdClass();
                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = array((object) array(
                            'type'     => 'checkbox',
                            'label'    => $requ['field_label'],
                            'name'     => $requ['field_name'],
                            'required' => ($requ['field_required'] == 'on') ? "true" : "false",
                            'validate' => ($requ['field_required'] == 'on') ? "NotEmpty" : "",
                            "checked"  => true,
                        ));
                    } else if ($requ['field_type'] == 'multiple_checkbox') {
                        $addColumn[] = new stdClass();
                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                $options[] = (object) array('type' => 'checkbox', 'name' => $requ['field_name'] . '[' . $requ['value'][$i] . ']', 'label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                $i++;
                            }
                        }

                        //pr($requ);die;
                        //pr($options);die;

                        //$addColumn[0]->type = 'fieldset';
                        $addColumn[0]->type       = 'settings';
                        $addColumn[0]->label      = str_replace('_', ' ', $result->form_name);
                        $addColumn[0]->labelWidth = '150';
                        $addColumn[0]->inputWidth = '350';
                        $addColumn[0]->list       = $options;

                    }
                    /* else
                    {
                    $addColumn[] = new stdClass();
                    $addColumn[0]->type = 'fieldset';
                    $addColumn[0]->label = str_replace(' ','_',$result->form_name);
                    $addColumn[0]->inputWidth = '350';
                    $addColumn[0]->list = array(
                    'type'=>$requ['field_type'],
                    'label'=>$requ['field_label'],
                    'name'=>$requ['field_name'],
                    'required'=>($requ['field_required']=='on')?true:false,
                    );
                    } */
                    // add submit button

                    $addColumn[0]->list[] = (object) array("type" => "hidden", "name" => "form_name", "value" => $result->form_name);
                    $addColumn[0]->list[] = (object) array("type" => "button", "name" => "submit", "value" => "submit", "offsetLeft" => "45");

                }

                //pr($addColumn);die;
                //pr(json_encode($addColumn));die;

                $updates              = array();
                $updates['form_data'] = json_encode($addColumn);

                $this->db->where('id', $result->id);
                $res = $this->db->update(TBL_PREFIX.'form', $updates);
                if ($res) {
                    $alter = '';

                    if ($requ['field_type'] == 'text') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'email') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'textarea') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " TEXT";
                    } else if ($requ['field_type'] == 'checkbox') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'multiple_checkbox') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'hidden') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'url') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'file') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'image') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'password') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'radio') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'select') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    } else if ($requ['field_type'] == 'multiple_select') {
                        $alter .= "ADD COLUMN " . $requ['field_name'] . " VARCHAR (250)";
                    }

                    $sql = "ALTER TABLE ".TBL_PREFIX . $result->form_name . " $alter";
                    $this->db->query($sql);

                    set_flashdata('success', 'add column successfully');
                    redirect(base_url('support_form/dynamic_form/' . $id));
                }

                //pr(trim(explode(',',$val)[1]));die;
                //set_flashdata('error','cross site attack');
                //redirect(base_url('support/list_items'));
            }

        }

        if ($result) {
            //pr(json_decode($result->form_data));die;
            $views          = 'dynamic_form';
            $data['title']  = "Dynamic Support Form";
            $data['result'] = $result;
            $data['forms']  = json_decode($result->form_data);
            $this->breadcrumbcomponent->add('Dashboard <li><i class="fa fa-circle"></i></li>', base_url() . "dashboard");
            $this->breadcrumbcomponent->add('Form List <li><i class="fa fa-circle"></i></li>', base_url() . "support/list_items/");
            $this->breadcrumbcomponent->add('Form', base_url());
            $data['header']['bread_cum'] = $this->breadcrumbcomponent->output();
            admin_layout($views, $data);
        } else {
            set_flashdata('error', 'No Support Found');
            redirect(base_url('support/list_items'));
        }
    }

    public function get_formData()
    {

        $id = $this->input->post('form_id', true);
        //$result = $this->support_form_mod->get_form(ID_decode($id));
        $result = $this->support_form_mod->get_form($id);

        if ($result) {
            echo $result->form_data;
            die;
        }

    }

    public function get_postData()
    {
        /* if(empty($id))
        {
        set_flashdata('error','No Form Found');
        redirect(base_url('support/list_items'));
        } */

        if (isPostBack()) {
            pr($this->input->post(null, true));die;
            $result = $this->support_form_mod->get_form(ID_decode($id));

            if ($result) {
                $postData = $this->input->post(null, true);

                $res = $this->db->insert(TBL_PREFIX. $result->form_name, $postData);

                if ($res) {
                    clearPostData();
                    set_flashdata('success', 'Support Form added Successfully');
                    redirect(base_url('/'));
                } else {
                    clearPostData();
                    redirect(base_url('/'));
                }

            }
        }

    }

    public function change_order($id)
    {
        $result = $this->form_module_mod->get_form(ID_decode($id));
        if (isPostBack()) {

            if ($result) {

                $form = json_decode($result->form_data);

                $count = count($form);

                $formName[] = $form[0];
                $sub[]      = $form[$count - 1];
                $hidden[]   = $form[$count - 2];

                //pr($sub);
                unset($form[$count - 1]);
                unset($form[$count - 2]);

                $postData = $this->input->post('order', true);

                $newOrder = explode(',', $postData);

                $newList = array();
                foreach ($newOrder as $k => $v) {
                    $newList[$k] = $form[$v];
                }

                /* $newList[] = $formName;
                $newList[] = $hidden;
                $newList[] = $sub; */

                $fianl = array_merge($formName, $newList, $hidden, $sub);

                //pr($fianl);die;

                $update              = array();
                $update['form_data'] = json_encode($fianl);

                $this->db->where('id', $result->id);
                $res = $this->db->update(TBL_PREFIX.'form', $update);

                if ($res) {
                    echo "1";
                } else {
                    echo "2";
                }

            }

        }
    }

    public function delete_column($id)
    {

        $result = $this->form_module_mod->get_form(ID_decode($id));
        if (isPostBack()) {

            if ($result) {
                $key = $this->input->post('key', true);

                $form = json_decode($result->form_data);

                $col = $form[$key];

                if ($col) {
                    if ($this->db->field_exists($col->name, TBL_PREFIX.$result->form_name)) {
                        $this->db->query("ALTER TABLE ".TBL_PREFIX.$result->form_name ." DROP ". $col->name);
                    }

                }

                unset($form[$key]);

                $form = array_values($form);

                $addColumn = $form;

                $update              = array();
                $update['form_data'] = json_encode($addColumn);

                $this->db->where('id', $result->id);
                $res = $this->db->update(TBL_PREFIX.'form', $update);

                if ($res) {
                    set_flashdata('success', 'Column delete successfully');
                    echo "1";
                } else {
                    set_flashdata('error', 'Column not deleted ');
                    echo "2";
                }

            }

        }
    }

    public function dynamic($id)
    {

        if (!$id) {
            redirect(base_url('form_module'));
        }

        $data['action'] = "list";

        $data['grid']['base_url']     = $this->data['base_url'];
        $data['grid']['export_limit'] = $this->export_limit;
        $data['grid']['delete_limit'] = $this->delete_limit;

        //check session offset
        if ($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        if ($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        $text     = $this->input->post('text');
        $limit    = @$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset   = 1;
        $order_by = 'id';
        $order    = 'desc';
        $result   = $this->form_module_mod->dynamic_list_items($id);
        // pr($result);die;
        foreach ($result['grid_cols'] as $row) {
            if (!empty($row['name'])) {
                $row['name'] = ucwords($row['name']);
            }

        }

        foreach ($result['result'] as $rows) {
            if (!empty($rows->status)) {
                if ($rows->status == '1') {
                    $rows->status = "Active";
                } else {
                    $rows->status = "Inactive";
                }

            }

        }

        //pr($row['name']);die;
        $data['grid']['cols'] = $result['grid_cols'];
        //pr($data['grid']['cols']);

        $views[]       = 'dynamic_form_list';
        $data['title'] = "Dynamic Form List";

        //$this->breadcrumbcomponent->add('Dashboard <li><i class="fa fa-circle"></i></li>', base_url()."dashboard");
        // $this->breadcrumbcomponent->add('List Form', base_url());
        //$data['header']['bread_cum'] = $this->breadcrumbcomponent->output();

        $data['grid']['result']      = $result;
        $data['grid']["page_offset"] = 1;
        $data['grid']["limit"]       = $limit;
        $data['grid']["order_by"]    = 'id';
        $data['dynamic_module_name'] = $id;
        $data['dynamic_module_id']   = $result['module_main_id'];
        //pr($data['dynamic_module_name']);die;
        $data['submodule'] = 'List';
        view_load($views, $data);
    }

    public function dynamic_add($table_name, $id)
    {
        //$id = ID_decode($id);
        //$table_id = ID_decode($table_id);
        //pr($table_id);die;
        if (!$table_name && !$id) {
            redirect(base_url('form_module'));
        }
        // $result = $this->form_module_mod->dynamic_list_view($id,$table_id);
        $res = $this->form_module_mod->get_form($id);
        // pr($res);die;
        if (isPostBack()) {
            $postData = $this->input->post(null, true);
            // pr($postData);die;
            if (isset($_FILES) && !empty($_FILES)) {

                foreach ($_FILES as $key => $val) {
                    if ($val['error'] == 0) {
                        $_FILES['image']['name']     = $val['name'];
                        $_FILES['image']['type']     = $val['type'];
                        $_FILES['image']['tmp_name'] = $val['tmp_name'];
                        $_FILES['image']['error']    = $val['error'];
                        $_FILES['image']['size']     = $val['size'];
                        //pr($_FILES);die;
                        $folderName = '/home/imagenss/public_html/uploads/dynamic_form/';
                        if (!is_dir($folderName)) {
                            mkdir($folderName, 0777, true);
                        }
                        $config['upload_path']   = $folderName;
                        $config['allowed_types'] = '*';

                        $this->load->library('upload', $config);
                        $this->upload->initialize($config);
                        if (!$this->upload->do_upload('image')) {
                            $error = array('error' => $this->upload->display_errors());
                            return false;
                        } else {
                            $event_img = $this->upload->data();
                            $image     = $event_img['raw_name'] . $event_img['file_ext'];
                        }
                        $postData[$key] = $image;
                    }

                }

            }

            unset($postData['submit']);

            //$this->db->where('form_id',$id);
            $this->db->insert(TBL_PREFIX . $res->form_name, $postData);
            $id = $this->db->insert_id();
            //echo $id;die;
            if (!empty($id)) {
                clearPostData();
                set_flashdata('success', 'Form values added Successfully');

                redirect(base_url('form_module/dynamic/' . $table_name));
            }

        }

        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        $all_form_data = [];
		foreach ($cols->form_data as $key1 => $frm) {
	    	if(!empty($frm->elements && count($frm->elements)>0))
	    	{
	    		$all_form_data = array_merge($all_form_data, $frm->elements);
	    	}
	    }

	    $form_data = $cols->form_data;
	    $cols = $all_form_data;
        /*$count = count($cols);
        unset($cols[0]);
        unset($cols[$count - 1]);
        unset($cols[$count - 1]);*/

        // pr($form_data);die;

        $this->data['action']   = "add";
        $this->data['table_id'] = $id;
        $this->data['cols']     = $cols;
        $this->data['form_data']= $form_data;
        $views[]                = "add_form";

        // $this->data['state'] = get_state_from_master_acord_country($result->country);
        // $this->data['city'] = get_state_from_master_acord_country($result->state_comp);
        $this->data['submodule'] = 'Add Dynamic Values';
        //pr($this->data);die;
        view_load($views, $this->data);

    }

    public function dynamic_edit($id, $table_id, $table_name)
    {
        //$id = ID_decode($id);
        //$table_id = ID_decode($table_id);

        if (!$id && !$table_id) {
            redirect(base_url('form_module'));
        }
        $result = $this->form_module_mod->dynamic_list_view($id, $table_id);
        $res    = $this->form_module_mod->get_form($table_id);
        //pr($result);die;
        if (isPostBack()) {
            $postData = $this->input->post(null, true);
            //pr($postData);die;
            if (isset($_FILES) && !empty($_FILES)) {

                foreach ($_FILES as $key => $val) {
                    if ($val['error'] == 0) {
                        $_FILES['image']['name']     = $val['name'];
                        $_FILES['image']['type']     = $val['type'];
                        $_FILES['image']['tmp_name'] = $val['tmp_name'];
                        $_FILES['image']['error']    = $val['error'];
                        $_FILES['image']['size']     = $val['size'];
                        //pr($_FILES);die;
                        $folderName = '/home/imagenss/public_html/uploads/dynamic_form/';
                        if (!is_dir($folderName)) {
                            mkdir($folderName, 0777, true);
                        }
                        $config['upload_path']   = $folderName;
                        $config['allowed_types'] = '*';

                        $this->upload->initialize($config);
                        $this->load->library('upload', $config);
                        if (!$this->upload->do_upload('image')) {
                            $error = array('error' => $this->upload->display_errors());
                            return false;
                        } else {
                            $event_img = $this->upload->data();
                            $image     = $event_img['raw_name'] . $event_img['file_ext'];
                        }
                        $postData[$key] = $image;
                    }

                }

            }

            unset($postData['submit']);

            $this->db->where('form_id', $id);
            $res = $this->db->update(TBL_PREFIX. $res->form_name, $postData);
            if ($res) {
                clearPostData();
                set_flashdata('success', 'Form updated Successfully');
                redirect(base_url('form_module/dynamic/' . $table_name));
            }

        }

        $cols  = json_decode($res->form_data);
        $count = count($cols);
        unset($cols[0]);
        unset($cols[$count - 1]);
        unset($cols[$count - 1]);

        //pr($cols);die;

        $this->data['action']   = "edit";
        $this->data['table_id'] = $table_id;
        $this->data['result']   = $result['data'];
        $this->data['columns']  = $result['columns'];
        $this->data['cols']     = $cols;
        $views[]                = "edit_form";

        $this->data['submodule'] = 'Edit Dynamic Values';

        view_load($views, $this->data);

    }

    public function dynamic_view($id, $table_id, $table_name)
    {

        //$id = ID_decode($id);
        //$table_id = ID_decode($table_id);
        //echo $id;
        if (!$id && !$table_id) {
            redirect(base_url('form_module'));
        }
        $result = $this->form_module_mod->dynamic_list_view($id, $table_id);
        $res    = $this->form_module_mod->get_form($table_id);

        $cols  = json_decode($res->form_data);
        $count = count($cols);
        unset($cols[0]);
        unset($cols[$count - 1]);
        unset($cols[$count - 1]);

        //pr($cols);
        //pr($result);die;

        $this->data['action']   = "view";
        $this->data['table_id'] = $table_id;
        $this->data['result']   = $result['data'];
        $this->data['columns']  = $result['columns'];
        $this->data['cols']     = $cols;
        $views[]                = "view_form";

        $this->data['submodule'] = 'View Dynamic Values';

        view_load($views, $this->data);

    }

    public function dynamic_delete()
    {

        $table_id            = $this->input->get_post('id', true);
        $id                  = $this->input->get_post('module_id', true);
        $dynamic_module_name = $this->input->get_post('dynamic_module_name', true);
        if (!$id && !$table_id) {
            redirect(base_url('form_module'));
        }

        $result = $this->form_module_mod->dynamic_delete_row($id, $table_id);

        if ($result) {
            set_flashdata('success', 'Delete successfully');
            redirect(base_url('form_module/dynamic/' . $dynamic_module_name), 'refresh');
        } else {
            set_flashdata('error', 'Not deleted ');
            redirect(base_url('form_module/dynamic/' . $dynamic_module_name));
        }

    }

    public function check_all_fields_unq()
    {

        $array_input_name  = $this->input->get_post('array_input_name', true);
        $array_input_type  = $this->input->get_post('array_input_type', true);
        $array_input_value = $this->input->get_post('array_input_value', true);
        $column_id         = $this->input->get_post('column_id', true);
        $module_id         = $this->input->get_post('module_id', true);
        $action            = $this->input->get_post('action', true);

        if ($action == 'edit') {
	        if (!$column_id && !$module_id) {
	            // redirect(base_url('form_module'));
             	echo json_encode(['status'=>0,'messae'=>'Module id missing','data'=>'']);
	        }
	        else
	        {
	            // get the module tablename by module_id
	            $this->db->select('form_name');
	            $this->db->where('id', $module_id);
	            $query_tbl_dynamic = $this->db->get(TBL_PREFIX.'form');
	            if ($query_tbl_dynamic->num_rows() > 0) {
	                $table_name = TBL_PREFIX. $query_tbl_dynamic->row()->form_name;
	                // echo $table_name;die;
	                $column_arr    = explode(',', $array_input_name);
	                $column_values = explode(',', $array_input_value);
	                //pr($column_arr);
	                //pr($column_values);
	                $error_msgs_arr = array();
	                $i              = 0;
	                foreach ($column_arr as $key => $val) {
	                    foreach ($column_values as $col_val_key => $col_val_values) {
	                        $this->db->select("$val");
	                        $this->db->where("form_id !=", $column_id);
	                        $this->db->where("$val", $col_val_values);
	                        $result_query = $this->db->get($table_name);
	                        if ($result_query->num_rows() > 0) {

	                            $error_msgs_arr[$i]["id"]    = $val;
	                            $error_msgs_arr[$i]["error"] = $val . " field must be unique.";
	                            $i++;
	                        }
	                    }
	                }
	                //pr($error_msgs_arr);die;
	                echo json_encode(['status'=>1,'messae'=>'Data validated','validation'=>count($error_msgs_arr)?1:0,'data'=>$error_msgs_arr]);
	                // echo json_encode($error_msgs_arr);
	            }

	        }
        }
        else
        {
        	echo json_encode(['status'=>1,'messae'=>'Add mode validation not implement yet.','data'=>'']);
        }

    }

    public function get_table_list()
    {
        if ($this->input->is_ajax_request()) {
            $query = $this->db->query("SHOW TABLES");
            // pr($query->num_rows());
            if ($query->num_rows() > 0) {
                $options = '<option value="">Select Table Name</option>';
                $result  = $query->result_array();
                // pr($result);
                foreach ($result as $key => $value) {
                    $options .= "<option value='" . $value['Tables_in_inchgroup-erp'] . "'>" . $value['Tables_in_inchgroup-erp'] . "</option>";
                }
                // pr($options);
                echo json_encode(['status' => 1, 'message' => 'Record found', 'data' => $options]);
            } else {
                echo json_encode(['status' => 0, 'message' => 'No record found', 'data' => $options]);
            }
            // pr($res);die;

        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed', 'data' => $options]);
        }
    }

    public function get_column_list()
    {
        if ($this->input->is_ajax_request()) {
            if (isset($_POST['table_name']) && !empty($_POST['table_name'])) {
                $tablename = $this->input->post('table_name');
                $query     = $this->db->query("SHOW COLUMNS FROM " . $tablename);
                // pr($query->num_rows());die;
                if ($query->num_rows() > 0) {
                    $options = '<option value="">Select Column Name</option>';
                    $result  = $query->result_array();
                    // pr($result);
                    foreach ($result as $key => $value) {
                        $options .= "<option value='" . $value['Field'] . "'>" . $value['Field'] . "</option>";
                    }
                    // pr($options);
                    echo json_encode(['status' => 1, 'message' => 'Record found', 'data' => $options]);
                } else {
                    echo json_encode(['status' => 0, 'message' => 'No record found', 'data' => $options]);
                }
            } else {
                echo json_encode(['status' => 0, 'message' => 'Table name missing', 'data' => 0]);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed', 'data' => 0]);
        }
    }

    /***********************************************************************************/
    /***********************************************************************************/
    public function add_block()
    {
        if ($this->input->is_ajax_request()) {

        	// pr($_POST);die;
            if (isset($_POST['block_name']) && !empty($_POST['block_name']) && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $block_name = $this->input->post('block_name');
                $frm_id 	= $this->input->post('frm_id');
                $result 	= $this->form_module_mod->get_form($frm_id);
		        // pr(json_decode($result->form_data));die;
		        if ($result) {
		        	$status 	= 0; 
		        	$def_exist 	= 0; 
		            $form 		= json_decode($result->form_data);
		            $lst_indx 	= count($form->form_data);
		            foreach ($form->form_data as $key => $value) {
		            	if($value->block==$block_name)
		            	{
		            		$status++;
		            	}
		            	if(strtolower($value->block)=='default')
		            	{
		            		$def_exist = 1; 
		            	}
		            }
		            if($status==0)
		            {	
		            	if($def_exist==1)
		            	{
		            		$form->form_data[0]->block	= $block_name;
		            	}
		            	else
		            	{
				           	$form->form_data[$lst_indx]->block 		= $block_name;
				           	$form->form_data[$lst_indx]->elements 	= '';
		            	}
			            // pr($form);die;
			            $updates              = array();
		                $updates['form_data'] = json_encode($form);
		                $this->db->where('id', $result->id);
		                $res = $this->db->update(TBL_PREFIX.'form', $updates);
		                if($res)
		                {
		        			echo json_encode(['status' => 1, 'message' => 'Block successfully added.']);
		                }
		                else
		                {
		        			echo json_encode(['status' => 0, 'message' => 'Block could not be add.']);
		                }
		            }
		            else
		            {
		        		echo json_encode(['status' => 0, 'message' => 'Block already exist.']);
		            }
		        }
		        else
		        {
                	echo json_encode(['status' => 0, 'message' => 'Form detail missing.']);
		        }
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }

    public function remove_block()
    {
        if ($this->input->is_ajax_request()) {

        	// pr($_POST);die;
        	// echo "No permission"; exit;
            if (isset($_POST['block_index']) && $_POST['block_index']>=0 && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $block_index 	= $this->input->post('block_index');
                $frm_id 		= $this->input->post('frm_id');
                $result 		= $this->form_module_mod->get_form($frm_id);

		        // pr(json_decode($result->form_data));die;
		        if ($result) {
		            $form 		= json_decode($result->form_data);
		            $form_data1	= $form->form_data;
		            $tablename	= $form->extra[0]->value;
		            $new_form_data = [];
		            if(!isset($tablename) || empty($tablename))
		            {
		            	echo json_encode(['status' => 0, 'message' => 'Block could not be delete.']);
		            }
		            elseif(isset($form_data1[$block_index]) && !empty($form_data1[$block_index]))
		            {
			            $form_data	= $form_data1[$block_index];
			            // pr($form_data);die;
			            $this->db->trans_start();
			            foreach ($form_data->elements as $key1 => $value1) {
			            	// pr($value);
			            	$this->db->query("ALTER TABLE ".TBL_PREFIX.$tablename." DROP ".$value1->name);
			            }

			            unset($form->form_data[$block_index]);
			            #Resindex
			            foreach ($form->form_data as $key2 => $value2) {
			            	$new_form_data[] = $value2;
			            }
			            $form->form_data = $new_form_data;
			            // pr($form);die;

			            $updates              = array();
		                $updates['form_data'] = json_encode($form);
		                $this->db->where('id', $result->id);
		                $res = $this->db->update(TBL_PREFIX.'form', $updates);
		                $this->db->trans_complete();
		                if($res)
		                {
		        			echo json_encode(['status' => 1, 'message' => 'Block successfully deleted.']);
		                }
		                else
		                {
		        			echo json_encode(['status' => 0, 'message' => 'Block could not be delete.']);
		                }
		            }
		            else
		            {
		            	echo json_encode(['status' => 0, 'message' => 'Block not exist']);
		            }
		        }
		        else
		        {
                	echo json_encode(['status' => 0, 'message' => 'Form detail missing.']);
		        }
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
    
    public function rename_block()
    {
        if ($this->input->is_ajax_request()) {

        	// pr($_POST);die;
        	// echo "No permission"; exit;
            if (isset($_POST['block_index']) && $_POST['block_index']>=0 && isset($_POST['frm_id']) && !empty($_POST['block_name']) && !empty($_POST['block_name'])) {
                $block_index 	= $this->input->post('block_index');
                $frm_id 		= $this->input->post('frm_id');
                $block_name		= $this->input->post('block_name');
                $result 		= $this->form_module_mod->get_form($frm_id);

		        // pr(json_decode($result->form_data));die;
		        if ($result) {
		            $form 		= json_decode($result->form_data);
		            $form_data1	= $form->form_data;
		            // pr($form);die;
		            if(isset($form_data1[$block_index]) && !empty($form_data1[$block_index]))
		            {
			            $form->form_data[$block_index]->block = $block_name;
			            // pr($form);die;

			            $this->db->trans_start();
			            $updates              = array();
		                $updates['form_data'] = json_encode($form);
		                $this->db->where('id', $result->id);
		                $res = $this->db->update(TBL_PREFIX.'form', $updates);
		                $this->db->trans_complete();

		                if($res)
		                {
		        			echo json_encode(['status' => 1, 'message' => 'Block successfully renamed.']);
		                }
		                else
		                {
		        			echo json_encode(['status' => 0, 'message' => 'Block could not be rename.']);
		                }
		            }
		            else
		            {
		            	echo json_encode(['status' => 0, 'message' => 'Block not exist']);
		            }
		        }
		        else
		        {
                	echo json_encode(['status' => 0, 'message' => 'Form detail missing.']);
		        }
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
    
    public function reorder_column()
    {
        if ($this->input->is_ajax_request()) {

            if (isset($_POST['reorder_data']) && !empty($_POST['reorder_data']) && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $reorder_data 	= (array) json_decode($this->input->post('reorder_data'));
                $frm_id 		= $this->input->post('frm_id');
                $result 		= $this->form_module_mod->get_form($frm_id);
		        // pr(json_decode($result->form_data));
		        // pr($reorder_data);die;
		        if ($result) {
		        	$status 	= 0;
		            $form		= json_decode($result->form_data);
		            $form_data	= $form->form_data;
		            $new_data	= $form_data;
		            // pr($form);die;
		            // pr($form_data);
		            
		            foreach ($form_data as $form_data_key => $form_data_value) {
		            
		            	// echo "<pre>";
		            	// echo "block_name:".$reorder_data_value->block_name;
		            	// pr("block_data:".$form_data_value->block_data);
		            	// $line_block = json_decode($reorder_data_value->block_data);
		            	// pr($line_block);

		            	foreach ($reorder_data as $reorder_data_key => $reorder_data_value) {
		            		if($reorder_data_value->block_name==$form_data_value->block)
		            		{
		            			$new_data[$form_data_key]->elements = "";
		            			// echo "match found:".$form_data_value->block;
		            			$line_block = json_decode($reorder_data_value->block_data);
			            		// pr($line_block);
		            			foreach ($line_block as $key1 => $value1) {
				            		$line_block2 = json_decode($value1);
				            		$new_data[$form_data_key]->elements[] = $line_block2;
				            		// pr($line_block2);
				            	}
				            	// pr($new_data);
		            		}
		            	}
		            	// break;
		            }
		            $form->form_data 		= $new_data;
		            // pr($form);die;
		           	// $form->form_data[$lst_indx]->block 		= $block_name;
		           	// $form->form_data[$lst_indx]->elements 	= '';
		            // pr($form);die;
		            $updates              	= array();
	                $updates['form_data'] 	= json_encode($form);
	                // pr(json_decode($updates['form_data']));die;
	                $this->db->trans_start();
	                $this->db->where('id', $result->id);
	                $res = $this->db->update(TBL_PREFIX.'form', $updates);
	                $this->db->trans_complete();
	                if($res)
	                {
	        			echo json_encode(['status' => 1, 'message' => 'Column successfully reordered.']);
	                }
	                else
	                {
	        			echo json_encode(['status' => 0, 'message' => 'Column could not be reordered.']);
	                }
		        }
		        else
		        {
                	echo json_encode(['status' => 0, 'message' => 'Form detail missing.']);
		        }
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }

    public function reorder_block()
    {
        if ($this->input->is_ajax_request()) {

        	// pr($_POST);die;
            if (isset($_POST['reorder_block']) && !empty($_POST['reorder_block']) && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $reorder_block 	= json_decode($this->input->post('reorder_block'));
                $frm_id 		= $this->input->post('frm_id');
                $result 		= $this->form_module_mod->get_form($frm_id);
		        // pr(json_decode($result->form_data));
		        // echo "form-data";
		        // pr($reorder_block);
		        if ($result) {
		        	$status 	= 0;
		            $form		= json_decode($result->form_data);
		            $form_data	= $form->form_data;
		            $new_data	= [];
		            // pr($form);die;
		            // pr($form_data);
		            
	            	foreach ($reorder_block as $rbkey => $reorder_block_value) {
	            		if($reorder_block_value->block_name==$form_data_value->block)
	            		{
	            			$new_data[] = $form_data[$reorder_block_value];
	            		}
	            	}

	            	// pr($new_data);die;
		            $form->form_data		= $new_data;
		            $updates              	= array();
	                $updates['form_data'] 	= json_encode($form);
	                // pr(json_decode($updates['form_data']));die;
	                $this->db->trans_start();
	                $this->db->where('id', $result->id);
	                $res = $this->db->update(TBL_PREFIX.'form', $updates);
	                $this->db->trans_complete();
	                if($res)
	                {
	        			echo json_encode(['status' => 1, 'message' => 'Block successfully reordered.']);
	                }
	                else
	                {
	        			echo json_encode(['status' => 0, 'message' => 'Block could not be reordered.']);
	                }
		        }
		        else
		        {
                	echo json_encode(['status' => 0, 'message' => 'Form detail missing.']);
		        }
            } else {
                echo json_encode(['status' => 0, 'message' => 'Parameter missing.']);
            }
            // pr($res);die;
        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed.']);
        }
    }
 	
 	/***********************************************************************************/
    /***********************************************************************************/

} //End of the class
