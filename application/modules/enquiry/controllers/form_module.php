<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Manage Support Form Controller
 *
 * @package        	CodeIgniter
 * @subpackage    	Controllers
 * @category    	Dynamic module
 * @author        	Techbuddies INC @ Pradeep Kumar
 * @website        	http://www.nss.com
 * @company     	Techbuddiesit.com
 * @since        	Version 1.0
 */

class Form_module extends MY_Controller
{
    private $data         = array();
    private $export_limit = null;
    private $delete_limit = null;
    
    public function __construct()
    {
        parent::__construct();
        define('TBL_PREFIX', 'inch_');
        define('PRIMARY_KEY', 'form_id');
        $this->load->model('form_module_mod');
        $this->lang->load('form_module', get_site_language());
        $this->data['bCrmb_func']    = "";
        $this->data['head']['title'] = "Form Module";
        $this->data['readonly']      = null;
        $this->data['base_url']      = base_url("form_module/");
        $this->export_limit          = $this->config->item('export_limit');
        $this->delete_limit          = $this->config->item('delete_limit');
        $this->data['module']      	 = 'Form Module';
        $this->data['module_link'] 	 = base_url("form_module") . "/list_items";
        
        // ini_set('display_errors', 0);
        // error_reporting(0);
        //checkSuperAdmin();
        /*Subcompany data*/
        if ($this->session->userdata['isLogin']) {
            $this->config->set_item('companyID', $this->session->userdata['userinfo']->email);
        }
        if (!empty($this->session->userdata['activecomdata']['active_id']) && !empty($this->session->userdata['activecomdata']['active_uid'])) {
            $this->comp_id = $this->session->userdata['activecomdata']['active_id'];
            $this->user_id = $this->session->userdata['activecomdata']['active_uid'];
        } else {
           // redirect('company/dashboard');
        }
        $this->companyID = $this->config->item('companyID');
        /*Subcompany data*/
    }

    public function index()
    {
        redirect(base_url());
    }
    
    public function dynamic($id, $frm_id='')
    {

        if (!$id) {
            redirect(base_url('form_module'));
        }
        
        $this->data['action']               = "list";
        $this->data['grid']['base_url']     = $this->data['base_url'];
        $this->data['grid']['export_limit'] = $this->export_limit;
        $this->data['grid']['delete_limit'] = $this->delete_limit;
		        
        $result   = $this->form_module_mod->dynamic_list_items($id);
        
        if(isset($result['grid_cols']) && !empty($result['grid_cols']))
        {
	        foreach ($result['grid_cols'] as $row) {
	            if (!empty($row['name'])) {
	                $row['name'] = ucwords($row['name']);
	            }
	        }
        }

        if(isset($result['result']) && !empty($result['result']))
        {
	        foreach ($result['result'] as $rows) {
	            if (!empty($rows->status)) {
	                if ($rows->status == '1') {
	                    $rows->status = "Active";
	                } else {
	                    $rows->status = "Inactive";
	                }
	            }
	        }
        }

        //pr($row['name']);die;
        $this->data['grid']['cols'] = $result['grid_cols'];
        //pr($this->data['grid']['cols']);

        $views[]                			= 'form_list';
        $this->data['title']    			= $result['module_name']." List";
        $this->data['grid']['result']      	= $result;
        $this->data['grid']["page_offset"] 	= 1;
        $this->data['grid']["limit"]       	= $limit;
        $this->data['grid']["order_by"]    	= 'id';
        $this->data['dynamic_module_name'] 	= $id;
        $this->data['column_add_id']       	= $id;
        $this->data['dynamic_module_id']   	= $result['module_main_id'];
        $this->data['buttons'][]			= [
        	"name" => 'My '.$result['module_name'],
        	"url" => $this->data['base_url'].'/dynamic/'.$id.'/'.$frm_id,
        	"icon" => 'icon-filter'
        ];

        $this->data['buttons'][]			= [
        	"name" => 'All '.$result['module_name'],
        	"url" => $this->data['base_url'].'/dynamic/'.$id.'/'.$frm_id.'/?all=true',
        	"icon" => 'icon-filter'
        ];
        
        $this->data['buttons'][]				= [
        	"name" => 'Create '.$result['module_name'],
        	"url" => $this->data['base_url'].'/dynamic_add/'.$id.'/'.$frm_id,
        	"icon" => 'icon-plus-sign'
        ];
        // if($id=='task')
        // {
	       //  $this->data['action_buttons'][]	= [
	       //  	"url" => $this->data['base_url'].'/daily_activity_report/'.$id.'/'.$frm_id,
	       //  	"icon" => 'icon-plus-sign'
	       //  ];
        // }
        
        // pr($this->session->userdata['userinfo']);die;
        // pr($this->data['buttons']);die;
        // pr($result);die;
        // pr($this->data);die;
        $this->data['submodule'] = 'List';
        view_subcompanylayout($views, $this->data);
    }

    public function dynamic_add($table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        
        $res = $this->form_module_mod->get_form($id);
        // pr($res);die;
        if (isPostBack()) {
            $postData = $this->input->post(null, true);
            // pr($_FILES);
            // pr($postData);
            $all_form_data = [];
	        if(isset($res->form_data) && !empty($res->form_data))
	        {
	            $form1 = json_decode($res->form_data);
	            $move_columns = $form1->form_data;
	            if(count($form1->form_data) && !empty($form1->form_data)){
	                foreach ($form1->form_data as $key1 => $value) {
	                    if(!empty($value->elements && count($value->elements)>0))
	                    {
	                        foreach ($value->elements as $key2 => $value) {
	                            $all_form_data[] = $value;
	                        }
	                    }
	                }
	            }
	        }
         	// pr($all_form_data);die;
         	foreach ($all_form_data as $key => $frm_data1) {
         		$frm_data = (array) $frm_data1;
         		if($frm_data['type']=='file')
         		{
     				// pr($frm_data);die;
         			if($frm_data['data-input']=='multiplefile')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        $allowed_extensions = $frm_data['allowed_extensions'];
				        // pr($act_file);die;
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
				        {
				            foreach ($_FILES[$act_file]['name'] as $myfile_key => $myfile) {
				                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'][$myfile_key];
				                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'][$myfile_key];
				                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'][$myfile_key];
				                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'][$myfile_key];
				                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'][$myfile_key];
				                $fileData = $this->uploadFiles($_FILES['myfile'], $allowed_extensions);
				                // pr($fileData);die;
				                if(isset($fileData['success'])){
				                    $upld_file[]	= $fileData['success']['file_name'];
				                }
				            }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = implode("####", $upld_file);
				        }
				        // pr($postData[$act_file]);die;
				        /*End save client multiple  document*/
         			}
         			elseif($frm_data['data-input']=='file')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
				        {
			                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
			                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
			                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
			                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
			                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
			                $fileData=$this->uploadFiles($_FILES['myfile']);
			                
			                if(isset($fileData['success'])){
			                    $upld_file	= $fileData['success']['file_name'];
			                }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = $upld_file;
				        }
         			}
         		}
         		elseif($frm_data['type']=='multiselect')
         		{
         			$frm_name 				= $frm_data['name'];
         			$postData[$frm_name] 	= @implode(",", $_POST[$frm_name]);
         		}
         	}
         	// pr($postData);die;
            unset($postData['submit']);
            //$this->db->where('form_id',$id);
            set_common_insert_value2();
            $this->db->insert(TBL_PREFIX . $res->form_name, $postData);
            $id = $this->db->insert_id();
            //echo $id;die;
            if (!empty($id)) {
                clearPostData();
                set_flashdata('success', 'Record successfully saved.');
                redirect(base_url('form_module/dynamic/' . $table_name.'/'.$id));
            }
        }

        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        if(isset($cols->form_data) && !empty($cols->form_data))
        {
    		foreach ($cols->form_data as $block_key => $block) {
                // echo "string";
                if(isset($block->elements) && !empty($block->elements))
                {
        	    	foreach ($block->elements as $elem_key => $element) {
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $this->db->select("$label_name, $value_name");
                                        if($table_name=='company_employee')
                                        {
                                        	$this->db->where('desg_id',2);
                                        }
                                        $result = $this->db->get($table_name)->result();

                                        $cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
                                    }
                                    
                                    // pr($result);die;
                                }
                            }
                        }
                    }
                }
    	    }
        }
        else
        {
            set_flashdata('error','Incomplete Module');
            redirect(base_url('form_module/'));
        }

	    $form_data 					= $cols->form_data;
        $this->data['action']       = "add";
        $this->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->data['form_title']   = ucwords($res->form_name)." Form";
        $this->data['table_id']     = $id;
        // $this->data['cols']      = $cols;
        $this->data['form_data']    = $form_data;
        $views[]                    = "add_form";
        
        $this->data['submodule']    = 'Add Dynamic Values';
       	
        view_subcompanylayout($views, $this->data);

    }

    public function dynamic_edit($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->form_module_mod->get_form($id);
        $result1 = $this->form_module_mod->dynamic_list_view($recId, $id);
        // pr($result1);die;
        if (isPostBack()) {
            $postData = $this->input->post(null, true);
            // pr($_FILES);
            // pr($postData);die;
            $all_form_data = [];
	        if(isset($res->form_data) && !empty($res->form_data))
	        {
	            $form1 = json_decode($res->form_data);
	            $move_columns = $form1->form_data;
	            if(count($form1->form_data) && !empty($form1->form_data)){
	                foreach ($form1->form_data as $key1 => $value) {
	                    if(!empty($value->elements && count($value->elements)>0))
	                    {
	                        foreach ($value->elements as $key2 => $value) {
	                            $all_form_data[] = $value;
	                        }
	                    }
	                }
	            }
	        }
         	// pr($all_form_data);die;
         	foreach ($all_form_data as $key => $frm_data1) {
         		$frm_data = (array) $frm_data1;
         		if($frm_data['type']=='file')
         		{
     				// pr($frm_data);die;
         			if($frm_data['data-input']=='multiplefile')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        $allowed_extensions = $frm_data['allowed_extensions'];
				        // pr($act_file);die;
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name'][0]))
				        {
				            foreach ($_FILES[$act_file]['name'] as $myfile_key => $myfile) {
				                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'][$myfile_key];
				                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'][$myfile_key];
				                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'][$myfile_key];
				                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'][$myfile_key];
				                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'][$myfile_key];
				                $fileData = $this->uploadFiles($_FILES['myfile'], $allowed_extensions);
				                // pr($fileData);die;
				                if(isset($fileData['success'])){
				                    $upld_file[]	= $fileData['success']['file_name'];
				                }
				            }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = implode("####", $upld_file);
				        }
				        // pr($postData[$act_file]);die;
				        /*End save client multiple  document*/
         			}
         			elseif($frm_data['data-input']=='file')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
				        {
			                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
			                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
			                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
			                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
			                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
			                $fileData=$this->uploadFiles($_FILES['myfile']);
			                
			                if(isset($fileData['success'])){
			                    $upld_file	= $fileData['success']['file_name'];
			                }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = $upld_file;
				        }
         			}
         		}
         		elseif($frm_data['type']=='multiselect')
         		{
         			$frm_name 				= $frm_data['name'];
         			$postData[$frm_name] 	= @implode(",", $_POST[$frm_name]);
         		}
         	}
         	// pr($postData);die;
            unset($postData['submit']);
            //$this->db->where('form_id',$id);
            $this->db->trans_start();
            set_common_update_value2();
            $this->db->where('form_id', $recId);
           	$res =  $this->db->update(TBL_PREFIX . $res->form_name, $postData);
            $this->db->trans_complete();
            //echo $id;die;
            if (!empty($id)) {
                clearPostData();
                set_flashdata('success', 'Record successfully saved.');
                redirect(base_url('form_module/dynamic/' . $table_name));
            }
        }

        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        if(isset($cols->form_data) && !empty($cols->form_data))
        {
    		foreach ($cols->form_data as $block_key => $block) {
                // echo "string";
                if(isset($block->elements) && !empty($block->elements))
                {
        	    	foreach ($block->elements as $elem_key => $element) {
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->db->select("$label_name, $value_name")->get($table_name)->result();
                                        $cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
                                    }
                                    
                                    // pr($result);die;
                                }
                            }
                        }
                        elseif($element->option_type=='dependent')
                        {
                        	// 
                        	$table_name = $element->options->table_name;
                            $label_name = $element->options->label_name;
                            $value_name = $element->options->value_name;
                            $event_field = $element->options->event_field;
                            $condition_column = $element->options->condition_column;
                            $condition_values = $result1['data'][$event_field];

                            if(isset($condition_values) && !empty($condition_values))
                            {
                            	$condition_values = explode(",", $condition_values);
                            }
                            $this->db->select("$label_name, $value_name");
				            $this->db->where_in("$condition_column",$condition_values);
				            // echo $this->db->last_query();
				            $query = $this->db->get("$table_name");
				            if ($query->num_rows() > 0) {
				                $result  = $query->result_array();
				                $cols->form_data[$block_key]->elements[$elem_key]->options->dpnd_data = $result; 
				            }
                        	// pr($element);die;
                        }
                    }
                }
    	    }
        }
        else
        {
            set_flashdata('error','Incomplete Module');
            redirect(base_url('form_module/'));
        }

	    $form_data 					= $cols->form_data;
        $this->data['action']       = "add";
        $this->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->data['form_title']   = ucwords($res->form_name)." Form";
        $this->data['table_id']     = $id;
        // $this->data['cols']      = $cols;
        $this->data['data_list']   	= $result1['data'];
        $this->data['columns']  	= $result1['columns'];
        $this->data['form_data']    = $form_data;
        $views[]                    = "edit_form";
        // $this->data['state'] = get_state_from_master_acord_country($result->country);
        // $this->data['city'] = get_state_from_master_acord_country($result->state_comp);
        $this->data['submodule']    = 'Add Dynamic Values';
        // pr($form_data);die;
        view_subcompanylayout($views, $this->data);

    }
    public function dynamic_view($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->form_module_mod->get_form($id);
        $result1 = $this->form_module_mod->dynamic_list_view($recId, $id);
        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        if(isset($cols->form_data) && !empty($cols->form_data))
        {
    		foreach ($cols->form_data as $block_key => $block) {
                // echo "string";
                if(isset($block->elements) && !empty($block->elements))
                {
        	    	foreach ($block->elements as $elem_key => $element) {
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->db->select("$label_name, $value_name")->get($table_name)->result();
                                        $cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
                                    }
                                    
                                    // pr($result);die;
                                }
                            }
                        }
                        elseif($element->option_type=='dependent')
                        {
                        	// 
                        	$table_name = $element->options->table_name;
                            $label_name = $element->options->label_name;
                            $value_name = $element->options->value_name;
                            $event_field = $element->options->event_field;
                            $condition_column = $element->options->condition_column;
                            $condition_values = $result1['data'][$event_field];

                            if(isset($condition_values) && !empty($condition_values))
                            {
                            	$condition_values = explode(",", $condition_values);
                            }
                            $this->db->select("$label_name, $value_name");
				            $this->db->where_in("$condition_column",$condition_values);
				            // echo $this->db->last_query();
				            $query = $this->db->get("$table_name");
				            if ($query->num_rows() > 0) {
				                $result  = $query->result_array();
				                $cols->form_data[$block_key]->elements[$elem_key]->options->dpnd_data = $result; 
				            }
                        	// pr($element);die;
                        }
                    }
                }
    	    }
        }
        else
        {
            set_flashdata('error','Incomplete Module');
            redirect(base_url('form_module/'));
        }

	    $form_data 					= $cols->form_data;
        $this->data['action']       = "add";
        $this->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->data['form_title']   = ucwords($res->form_name)." Form";
        $this->data['table_id']     = $id;
        $this->data['data_list']   	= $result1['data'];
        $this->data['columns']  	= $result1['columns'];
        $this->data['form_data']    = $form_data;
        $views[]                    = "view_form";
        $this->data['submodule']    = 'Add Dynamic Values';
        // pr($form_data);die;
        view_subcompanylayout($views, $this->data);

    }
    
    public function daily_activity_report($frm_id='')
    {

        if (!$frm_id) {
            redirect(base_url('form_module'));
        }
	    $res			= $this->form_module_mod->get_form($frm_id);  
        $result			= $this->form_module_mod->daily_activity_report();
        $project_list	= $this->form_module_mod->project_list();
        $approval_list	= $this->form_module_mod->approval_list();
        // pr($project_list);die;
        $this->data['action']               = "list";
        $this->data['current_url']     		= $this->data['base_url'].'/daily_activity_report/'.$frm_id;
        $views[]                			= 'daily_activity_report/daily_activity_report_list';
        $this->data['title']    			= $res->form_label." List";
        $this->data['result']      			= $result;
        $this->data['project_list']			= $project_list;
        $this->data['approval_list']		= $approval_list;
        $this->data['dynamic_module_name'] 	= $res->form_name;
        $this->data['dynamic_module_id']   	= $frm_id;
        $this->data['submodule'] 			= 'List';

        view_subcompanylayout($views, $this->data);
    }

    public function add_daily_activity_report($id, $task_id, $prj_id)
    {
    	if(!$id && !$task_id && !$prj_id)
    	{
    		redirect(base_url());
    	}

    	$prj_tsk 	= $this->form_module_mod->get_task_detail($task_id);
    	// pr($prj_tsk);die;
    	$res 		= $this->form_module_mod->get_form($id);
        $table_name = $res->form_name;
        // pr($res);die;
        if (isPostBack()) {
            $postData = $this->input->post(null, true);
            // pr($_FILES);
            // pr($postData);die;
            $all_form_data = [];
	        if(isset($res->form_data) && !empty($res->form_data))
	        {
	            $form1 = json_decode($res->form_data);
	            $move_columns = $form1->form_data;
	            if(count($form1->form_data) && !empty($form1->form_data)){
	                foreach ($form1->form_data as $key1 => $value) {
	                    if(!empty($value->elements && count($value->elements)>0))
	                    {
	                        foreach ($value->elements as $key2 => $value) {
	                            $all_form_data[] = $value;
	                        }
	                    }
	                }
	            }
	        }
         	// pr($all_form_data);die;
         	foreach ($all_form_data as $key => $frm_data1) {
         		$frm_data = (array) $frm_data1;
         		if($frm_data['type']=='file')
         		{
     				// pr($frm_data);die;
         			if($frm_data['data-input']=='multiplefile')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        $allowed_extensions = $frm_data['allowed_extensions'];
				        // pr($act_file);die;
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
				        {
				            foreach ($_FILES[$act_file]['name'] as $myfile_key => $myfile) {
				                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'][$myfile_key];
				                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'][$myfile_key];
				                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'][$myfile_key];
				                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'][$myfile_key];
				                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'][$myfile_key];
				                $fileData = $this->uploadFiles($_FILES['myfile'], $allowed_extensions);
				                // pr($fileData);die;
				                if(isset($fileData['success'])){
				                    $upld_file[]	= $fileData['success']['file_name'];
				                }
				            }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = implode("####", $upld_file);
				        }
				        // pr($postData[$act_file]);die;
				        /*End save client multiple  document*/
         			}
         			elseif($frm_data['data-input']=='file')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
				        {
			                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
			                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
			                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
			                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
			                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
			                $fileData=$this->uploadFiles($_FILES['myfile']);
			                
			                if(isset($fileData['success'])){
			                    $upld_file	= $fileData['success']['file_name'];
			                }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = $upld_file;
				        }
         			}
         		}
         		elseif($frm_data['type']=='multiselect')
         		{
         			$frm_name 				= $frm_data['name'];
         			$postData[$frm_name] 	= @implode(",", $_POST[$frm_name]);
         		}
         	}
         	// pr($postData);die;
            unset($postData['submit']);
            //$this->db->where('form_id',$id);
            set_common_insert_value2();
            $this->db->insert(TBL_PREFIX . $res->form_name, $postData);
            $id = $this->db->insert_id();
            //echo $id;die;
            if (!empty($id)) {
                clearPostData();
                set_flashdata('success', 'Record successfully saved.');
                redirect(base_url('form_module/dynamic/' . $table_name));
            }
        }

        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        if(isset($cols->form_data) && !empty($cols->form_data))
        {
    		foreach ($cols->form_data as $block_key => $block) {
                // echo "string";
                if(isset($block->elements) && !empty($block->elements))
                {
        	    	foreach ($block->elements as $elem_key => $element) {
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $this->db->select("$label_name, $value_name");
                                        if($table_name=='company_employee')
                                        {
                                        	$this->db->where('desg_id',2);
                                        }
                                        $result = $this->db->get($table_name)->result();

                                        $cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
                                    }
                                    
                                    // pr($result);die;
                                }
                            }
                        }
                    }
                }
    	    }
        }
        else
        {
            set_flashdata('error','Incomplete Module');
            redirect(base_url('form_module/'));
        }

	    $form_data 					= $cols->form_data;
        $this->data['action']       = "add";
        $this->data['module_title'] = "Create ".ucwords($res->form_label).' > '.$prj_tsk->project_name.' > '.$prj_tsk->task_title;
        $this->data['form_title']   = ucwords($res->form_label)." Form";
        $this->data['table_id']     = $id;
        $this->data['task_id']     	= $task_id;
        $this->data['project_id']	= $prj_id;
        // $this->data['cols']      = $cols;
        $this->data['form_data']    = $form_data;
        $views[]                    = "daily_activity_report/add_form";
        
        $this->data['submodule']    = 'Add Dynamic Values';
       	
        view_subcompanylayout($views, $this->data);

    }

    public function edit_daily_activity_report($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->form_module_mod->get_form($id);
        $result1 = $this->form_module_mod->dynamic_list_view($recId, $id);
        // pr($result1);die;
        if (isPostBack()) {
            $postData = $this->input->post(null, true);
            // pr($_FILES);
            // pr($postData);die;
            $all_form_data = [];
	        if(isset($res->form_data) && !empty($res->form_data))
	        {
	            $form1 = json_decode($res->form_data);
	            $move_columns = $form1->form_data;
	            if(count($form1->form_data) && !empty($form1->form_data)){
	                foreach ($form1->form_data as $key1 => $value) {
	                    if(!empty($value->elements && count($value->elements)>0))
	                    {
	                        foreach ($value->elements as $key2 => $value) {
	                            $all_form_data[] = $value;
	                        }
	                    }
	                }
	            }
	        }
         	// pr($all_form_data);die;
         	foreach ($all_form_data as $key => $frm_data1) {
         		$frm_data = (array) $frm_data1;
         		if($frm_data['type']=='file')
         		{
     				// pr($frm_data);die;
         			if($frm_data['data-input']=='multiplefile')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        $allowed_extensions = $frm_data['allowed_extensions'];
				        // pr($act_file);die;
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name'][0]))
				        {
				            foreach ($_FILES[$act_file]['name'] as $myfile_key => $myfile) {
				                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'][$myfile_key];
				                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'][$myfile_key];
				                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'][$myfile_key];
				                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'][$myfile_key];
				                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'][$myfile_key];
				                $fileData = $this->uploadFiles($_FILES['myfile'], $allowed_extensions);
				                // pr($fileData);die;
				                if(isset($fileData['success'])){
				                    $upld_file[]	= $fileData['success']['file_name'];
				                }
				            }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = implode("####", $upld_file);
				        }
				        // pr($postData[$act_file]);die;
				        /*End save client multiple  document*/
         			}
         			elseif($frm_data['data-input']=='file')
         			{
         				/*Start save client multiple  document*/
				        $upld_file 	= [];
				        $act_file 	= $frm_data['name'];
				        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
				        {
			                $_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
			                $_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
			                $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
			                $_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
			                $_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
			                $fileData=$this->uploadFiles($_FILES['myfile']);
			                
			                if(isset($fileData['success'])){
			                    $upld_file	= $fileData['success']['file_name'];
			                }
				        }
				        if(isset($upld_file) && !empty($upld_file))
				        {
				        	$postData[$act_file] = $upld_file;
				        }
         			}
         		}
         		elseif($frm_data['type']=='multiselect')
         		{
         			$frm_name 				= $frm_data['name'];
         			$postData[$frm_name] 	= @implode(",", $_POST[$frm_name]);
         		}
         	}
         	// pr($postData);die;
            unset($postData['submit']);
            //$this->db->where('form_id',$id);
            $this->db->trans_start();
            set_common_update_value2();
            $this->db->where('form_id', $recId);
           	$res =  $this->db->update(TBL_PREFIX . $res->form_name, $postData);
            $this->db->trans_complete();
            //echo $id;die;
            if (!empty($id)) {
                clearPostData();
                set_flashdata('success', 'Record successfully saved.');
                redirect(base_url('form_module/daily_activity_report/' . $table_name.'/'.$id));
            }
        }

        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        if(isset($cols->form_data) && !empty($cols->form_data))
        {
    		foreach ($cols->form_data as $block_key => $block) {
                // echo "string";
                if(isset($block->elements) && !empty($block->elements))
                {
        	    	foreach ($block->elements as $elem_key => $element) {
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->db->select("$label_name, $value_name")->get($table_name)->result();
                                        $cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
                                    }
                                    
                                    // pr($result);die;
                                }
                            }
                        }
                        elseif($element->option_type=='dependent')
                        {
                        	// 
                        	$table_name = $element->options->table_name;
                            $label_name = $element->options->label_name;
                            $value_name = $element->options->value_name;
                            $event_field = $element->options->event_field;
                            $condition_column = $element->options->condition_column;
                            $condition_values = $result1['data'][$event_field];

                            if(isset($condition_values) && !empty($condition_values))
                            {
                            	$condition_values = explode(",", $condition_values);
                            }
                            $this->db->select("$label_name, $value_name");
				            $this->db->where_in("$condition_column",$condition_values);
				            // echo $this->db->last_query();
				            $query = $this->db->get("$table_name");
				            if ($query->num_rows() > 0) {
				                $result  = $query->result_array();
				                $cols->form_data[$block_key]->elements[$elem_key]->options->dpnd_data = $result; 
				            }
                        	// pr($element);die;
                        }
                    }
                }
    	    }
        }
        else
        {
            set_flashdata('error','Incomplete Module');
            redirect(base_url('form_module/'));
        }

	    $form_data 					= $cols->form_data;
        $this->data['action']       = "add";
        $this->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->data['form_title']   = ucwords($res->form_name)." Form";
        $this->data['table_id']     = $id;
        // $this->data['cols']      = $cols;
        $this->data['data_list']   	= $result1['data'];
        $this->data['columns']  	= $result1['columns'];
        $this->data['form_data']    = $form_data;
        $views[]                    = "daily_activity_report/edit_form";
        // $this->data['state'] = get_state_from_master_acord_country($result->country);
        // $this->data['city'] = get_state_from_master_acord_country($result->state_comp);
        $this->data['submodule']    = 'Add Dynamic Values';
        // pr($form_data);die;
        view_subcompanylayout($views, $this->data);

    }

    public function view_daily_activity_report($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->form_module_mod->get_form($id);
        $result1 = $this->form_module_mod->dynamic_list_view($recId, $id);
        
        $cols  = json_decode($res->form_data);
        // pr($cols);die;
        if(isset($cols->form_data) && !empty($cols->form_data))
        {
    		foreach ($cols->form_data as $block_key => $block) {
                // echo "string";
                if(isset($block->elements) && !empty($block->elements))
                {
        	    	foreach ($block->elements as $elem_key => $element) {
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->db->select("$label_name, $value_name")->get($table_name)->result();
                                        $cols->form_data[$block_key]->elements[$elem_key]->options->data = $result; 
                                    }
                                    
                                    // pr($result);die;
                                }
                            }
                        }
                        elseif($element->option_type=='dependent')
                        {
                        	// 
                        	$table_name = $element->options->table_name;
                            $label_name = $element->options->label_name;
                            $value_name = $element->options->value_name;
                            $event_field = $element->options->event_field;
                            $condition_column = $element->options->condition_column;
                            $condition_values = $result1['data'][$event_field];

                            if(isset($condition_values) && !empty($condition_values))
                            {
                            	$condition_values = explode(",", $condition_values);
                            }
                            $this->db->select("$label_name, $value_name");
				            $this->db->where_in("$condition_column",$condition_values);
				            // echo $this->db->last_query();
				            $query = $this->db->get("$table_name");
				            if ($query->num_rows() > 0) {
				                $result  = $query->result_array();
				                $cols->form_data[$block_key]->elements[$elem_key]->options->dpnd_data = $result; 
				            }
                        	// pr($element);die;
                        }
                    }
                }
    	    }
        }
        else
        {
            set_flashdata('error','Incomplete Module');
            redirect(base_url('form_module/'));
        }

	    $form_data 					= $cols->form_data;
        $this->data['action']       = "add";
        $this->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->data['form_title']   = ucwords($res->form_name)." Form";
        $this->data['table_id']     = $id;
        // $this->data['cols']      = $cols;
        $this->data['data_list']   	= $result1['data'];
        $this->data['columns']  	= $result1['columns'];
        $this->data['form_data']    = $form_data;
        $views[]                    = "daily_activity_report/view_form";
        $this->data['submodule']    = 'Add Dynamic Values';
        // pr($form_data);die;
        view_subcompanylayout($views, $this->data);
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
	            $query_tbl_dynamic = $this->db->get('inch_form');
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
                else
                {
                    echo json_encode(['status'=>0,'messae'=>'Data validated','validation'=>0,'data'=>$error_msgs_arr]);
                }

	        }
        }
        elseif ($action == 'add') {
            if (!$column_id && !$module_id) {
                // redirect(base_url('form_module'));
                echo json_encode(['status'=>0,'messae'=>'Module id missing','data'=>'']);
            }
            else
            {
                // get the module tablename by module_id
                $this->db->select('form_name');
                $this->db->where('id', $module_id);
                $query_tbl_dynamic = $this->db->get('dynamic_form_master');
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
                            // $this->db->where("form_id !=", $column_id);
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
                else
                {
                    echo json_encode(['status'=>0,'messae'=>'Data validated','validation'=>0,'data'=>$error_msgs_arr]);
                }
            }
        }
        else
        {
        	echo json_encode(['status'=>0,'message'=>'Something went wrong','data'=>'']);
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
 	
 	public function get_dependent_data()
    {
        if ($this->input->is_ajax_request()) {
            // pr($_POST);die;
            
            $label_title		= $this->input->post('label_title');
            $tblname            = $this->input->post('tblname');
            $label_name         = $this->input->post('label_name');
            $value_name         = $this->input->post('value_name');
            $condition_column   = $this->input->post('condition_column');
            $condition_values   = $this->input->post('condition_values');
            $options 			= '';
            $this->db->select("$label_name, $value_name");
            $this->db->where_in("$condition_column",$condition_values);
            $query = $this->db->get("$tblname");
            // echo $this->db->last_query();
            if ($query->num_rows() > 0) {
                $options .= '<option value="" disabled="">Select '.$label_title.'</option>';
                $result  = $query->result_array();
                // pr($result);
                foreach ($result as $key => $value) {
                    $options .= "<option value='" . $value[$value_name] . "'>" . $value[$label_name] . "</option>";
                }
                // pr($options);
                echo json_encode(['status' => 1, 'message' => 'Record found', 'data' => $options]);
            } else {
                $options .= '<option value="" disabled="">No '.$label_title.' Found</option>';
                echo json_encode(['status' => 0, 'message' => 'No record found', 'data' => $options]);
            }
            // pr($res);die;

        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed', 'data' => $options]);
        }
    }

    public function delete_records()
    {
        if ($this->input->is_ajax_request()) {
            // pr($_POST);die;
            $tblname            = $this->input->post('tbl_deta');
            $delRow   			= $this->input->post('delRow');
            $this->db->where_in(PRIMARY_KEY, $delRow);
            $status = $this->db->delete(TBL_PREFIX.$tblname);
            // echo $this->db->last_query();
            if ($status) {
                echo json_encode(['status' => 1, 'message' => 'Record successfully deleted']);
            } else {
                
                echo json_encode(['status' => 0, 'message' => 'Records could not be delete']);
            }

        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed']);
        }
    }

    private function uploadFiles($file_arr, $ext = '') {
        
        if (isset($file_arr['name']) && $file_arr['name'] != '') {
            
            $path 		= $file_arr['name'];
            $ext 		= pathinfo($path, PATHINFO_EXTENSION);
            $name 		= md5(time());
            $file_name 	= $name . "." . $ext;
            $folder_doc = FCPATH.'upload/documents/';
            if (!file_exists($folder_doc)) {
                mkdir($folder_doc, 0777, true);
            }
            $file_arr['name'] 			= $file_name;
            $config['upload_path'] 		= $folder_doc;
            if(isset($ext) && !empty($ext) && is_array($ext))
            {
            	$config['allowed_types'] 	= implode("|", $ext);
            }
            else
            {
            	$config['allowed_types'] 	= '*';
            }
            $config['max_size'] 		= 0;
            $config['encrypt_name'] 	= FALSE;
            $config['remove_spaces']	= TRUE;
            $config['overwrite'] 		= FALSE;
            $this->load->library('upload');
            $this->upload->initialize($config);
            $data=array();
            if (!$this->upload->do_upload('myfile'))
            {
                $data['error'] = $this->upload->display_errors();
            } else
            {
                $data['success'] = $this->upload->data();
            }
            return $data;
        }
    }
    

} //End of the class
