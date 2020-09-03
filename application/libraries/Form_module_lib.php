<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Manage Support Form Controller
 *
 * @package        	CodeIgniter
 * @subpackage    	Controllers
 * @category    	Dynamic module
 * @author        	Pradeep Kumar
 * @website        	http://www.Techbuddiesit.com
 * @company     	Techbuddiesit INC
 * @since        	Version 1.0
 */
// require_once (APPPATH.'/libraries/form_module_mod_lib.php'); 
class Form_module_lib
{
	
    public function __construct($base_url=NULL)
    {
        
        $this->obj    = &get_instance();
        $this->obj->load->library('form_module_mod_lib');
        $this->obj->lang->load('form_module', get_site_language());
        $this->obj->data['bCrmb_func']    	= "";
        $this->obj->data['head']['title'] 	= "Form Module";
        $this->obj->data['readonly']      	= null;
		$this->obj->data["new"] = $this->get_module(); 
		//pr($this->obj->data);die;
        if(isset($base_url) && !empty($base_url))
        {
            $this->obj->data['base_url']      	= $base_url;
			$this->obj->data['module_link']     = $base_url . "/list_items";
        }
        else
        {
            $this->obj->data['base_url']        = base_url("form_module/");
        }
        $this->obj->export_limit          	= $this->obj->config->item('export_limit');
        $this->obj->delete_limit          	= $this->obj->config->item('delete_limit');
        $this->obj->data['module'] = $this->obj->data['new']->module_title;
        //$this->obj->data['module_link'] = base_url("form_module/dynamic")."/".$this->obj->data['new']->module_controller;
        
        
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
        
        $this->obj->data['action']               = "list";
        $this->obj->data['grid']['base_url']     = $this->obj->data['base_url'];
        $this->obj->data['grid']['export_limit'] = $this->obj->export_limit;
        $this->obj->data['grid']['delete_limit'] = $this->obj->delete_limit;
		        
        $result   = $this->obj->form_module_mod_lib->dynamic_list_items($id);
        
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
        $this->obj->data['grid']['cols'] = $result['grid_cols'];
        //pr($this->obj->data['grid']['cols']);

        $views[]                			= 'form_list';
        $this->obj->data['title']    			= $result['module_name']." List";
        $this->obj->data['grid']['result']      	= $result;
        $this->obj->data['grid']["page_offset"] 	= 1;
        $this->obj->data['grid']["limit"]       	= $limit;
        $this->obj->data['grid']["order_by"]    	= 'id';
        $this->obj->data['dynamic_module_name'] 	= $id;
        $this->obj->data['column_add_id']       	= $id;
        $this->obj->data['dynamic_module_id']   	= $result['module_main_id'];
        $this->obj->data['buttons'][]			= [
        	"name" => 'My '.$result['module_name'],
        	"url" => $this->obj->data['base_url'].'/dynamic/'.$id.'/'.$frm_id,
        	"icon" => 'icon-filter'
        ];

        $this->obj->data['buttons'][]			= [
        	"name" => 'All '.$result['module_name'],
        	"url" => $this->obj->data['base_url'].'/dynamic/'.$id.'/'.$frm_id.'/?all=true',
        	"icon" => 'icon-filter'
        ];
        
        $this->obj->data['buttons'][]				= [
        	"name" => 'Create '.$result['module_name'],
        	"url" => $this->obj->data['base_url'].'/dynamic_add/'.$id.'/'.$frm_id,
        	"icon" => 'icon-plus-sign'
        ];
        // if($id=='task')
        // {
	       //  $this->obj->data['action_buttons'][]	= [
	       //  	"url" => $this->obj->data['base_url'].'/daily_activity_report/'.$id.'/'.$frm_id,
	       //  	"icon" => 'icon-plus-sign'
	       //  ];
        // }
        
        // pr($this->obj->session->userdata['userinfo']);die;
        // pr($this->obj->data['buttons']);die;
        // pr($result);die;
        // pr($this->obj->data);die;
        $this->obj->data['submodule'] = 'List';
        view_subcompanylayout($views, $this->obj->data);
    }

    /*Dynamic add , edit view form */
    
    public function dynamic_add($table_name,$default_view = false,$dynamic_redirect = true)
    {
        // echo "string";
        if (!$table_name) {
            redirect(($this->obj->data['base_url'].'/list_items'));
        }
        
        $res = $this->obj->form_module_mod_lib->get_form_by_name($table_name);
        // pr($res);die;
        if (!isset($res) || empty($res) &&  count($res)==0) {
            redirect(($this->obj->data['base_url'].'/list_items'));
        }

        $id = $res->id;
        if (isPostBack()) {
            $this->obj->db->db_debug = false;
            $postData = $this->obj->input->post(null, true);
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
                        $upld_file  = [];
                        $act_file   = $frm_data['name'];
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
                                $fileData = $this->obj->uploadFiles($_FILES['myfile'], $allowed_extensions);
                                // pr($fileData);die;
                                if(isset($fileData['success'])){
                                    $upld_file[]    = $fileData['success']['file_name'];
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
                        $upld_file  = [];
                        $act_file   = $frm_data['name'];
                        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
                        {
                            $_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
                            $_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
                            $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
                            $_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
                            $_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
                            $fileData=$this->obj->uploadFiles($_FILES['myfile']);
                            
                            if(isset($fileData['success'])){
                                $upld_file  = $fileData['success']['file_name'];
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
                    $frm_name               = $frm_data['name'];
                    $postData[$frm_name]    = @implode(",", $_POST[$frm_name]);
                }
            }
            // pr($postData);die;

            unset($postData['submit']);
            set_common_insert_value2();
            if($res->form_name == 'order')
            {
                $postData['order_type'] = $this->obj->type;
            }
            if($res->form_name == 'enquiry')
            {
                $postData['enquiry_type']= $this->obj->type;
            }
			if($this->obj->db->insert(TBL_PREFIX . $res->form_name, $postData))
            {
    			$id = $this->obj->db->insert_id();
                if (!empty($id)) {
                    clearPostData();
                    set_flashdata('success', 'Record successfully saved.');
                    if(!$dynamic_redirect)
                    {
                        if($table_name == 'service')
                        {
                            $this->obj->service_mod->insert_job_card_entry($id);
                        }                        
                        return true;
                    }
                    redirect(($this->obj->data['base_url'].'/list_items'));
                }
            }
            else
            {
                $_error_number = $this->obj->db->_error_number();
    			// $_error_message = $this->obj->db->_error_message();
                if($_error_number==1062)
                {
                    $_error_message = "Duplicate entry not allowed.";
                }
                else
                {
                    $_error_message = "Something went wrong in database.";
                }
                clearPostData();
                set_flashdata('error', $_error_message);
                if(!$dynamic_redirect)
                {
                    return true;
                }
                redirect(($this->obj->data['base_url'].'/list_items'));
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
                        // pr($element->name);
                        if($element->option_type=='table')
                        {
                            if(isset($element->options) && !empty($element->options) && isset($element->options->table_name) && !empty($element->options->table_name))
                            {
                                $table_name = $element->options->table_name;
                                $label_name = $element->options->label_name;
                                $value_name = $element->options->value_name;
                                if ($this->obj->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->obj->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {
                                        
                                        $this->obj->db->select("$label_name, $value_name");
                                        if($table_name=='company_employee')
                                        {
                                            $this->obj->db->where('desg_id',2);
                                        }
                                        if($table_name=='users' && $element->name=='inch_name')
                                        {
                                            $this->obj->db->where('group_id',3); // sales space group
                                        }
                                        if($table_name=='users' && $element->name=='cfit_name')
                                        {
                                            $this->obj->db->where('group_id',31);// China group
                                        }
                                        $result = $this->obj->db->get($table_name)->result();

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
            redirect(($this->obj->data['base_url'].'/list_items'));
        }

        if($default_view)
        {
            return $cols->form_data;
        }
        $form_data                       = $cols->form_data;
        $this->obj->data['action']       = "add";
        $this->obj->data['name'] = $this->get_module();
        $this->obj->data['module_title'] = 'Add '.$this->obj->data["name"]->module_title;
        // $this->obj->data['form_title']   = ucwords($res->form_label)." Form";
        $this->obj->data['form_title']   = "Enquiry";
        $this->obj->data['table_id']     = $id;
        // $this->obj->data['cols']      = $cols;
        $this->obj->data['form_data']    = $form_data;
        $views[]                         = "dynamic_view/add_form";
        
        $this->obj->data['submodule'] = 'Add '.$this->obj->data["name"]->module_title;
        //pr($this->obj->data);die;

        view_load($views, $this->obj->data);

    }

    public function dynamic_edit($recId, $table_name,$default_view = false,$dynamic_redirect = true)
    {
        
        if (!$recId && !$table_name) {
            redirect(($this->obj->data['base_url'].'/list_items'));
        }
        $res = $this->obj->form_module_mod_lib->get_form_by_name($table_name);
        $id = $res->id;
        $result1 = $this->obj->form_module_mod_lib->dynamic_list_view($recId, $id);
        // pr($res);die;
        if (isPostBack()) {
            $postData = $this->obj->input->post(null, true);
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
                        $upld_file  = [];
                        $act_file   = $frm_data['name'];
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
                                $fileData = $this->obj->uploadFiles($_FILES['myfile'], $allowed_extensions);
                                // pr($fileData);die;
                                if(isset($fileData['success'])){
                                    $upld_file[]    = $fileData['success']['file_name'];
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
                        $upld_file  = [];
                        $act_file   = $frm_data['name'];
                        if(isset($_FILES[$act_file]) && !empty($_FILES[$act_file]['name']))
                        {
                            $_FILES['myfile']['name']     = $_FILES[$act_file]['name'];
                            $_FILES['myfile']['type']     = $_FILES[$act_file]['type'];
                            $_FILES['myfile']['tmp_name'] = $_FILES[$act_file]['tmp_name'];
                            $_FILES['myfile']['error']    = $_FILES[$act_file]['error'];
                            $_FILES['myfile']['size']     = $_FILES[$act_file]['size'];
                            $fileData=$this->obj->uploadFiles($_FILES['myfile']);
                            
                            if(isset($fileData['success'])){
                                $upld_file  = $fileData['success']['file_name'];
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
                    $frm_name               = $frm_data['name'];
                    $postData[$frm_name]    = @implode(",", $_POST[$frm_name]);
                }
            }
            // pr($postData);die;
            unset($postData['submit']);
            //$this->obj->db->where('form_id',$id);
            $this->obj->db->trans_start();
            set_common_update_value2();
            $this->obj->db->where('form_id', $recId);
            $res =  $this->obj->db->update(TBL_PREFIX . $res->form_name, $postData);
            $this->obj->db->trans_complete();
            //echo $id;die;
            if (!empty($id)) {
                clearPostData();
                set_flashdata('success', 'Record successfully saved.');
                if(!$dynamic_redirect)
                {
                    return true;
                }
                redirect(($this->obj->data['base_url'].'/list_items'));
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
                                if ($this->obj->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->obj->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        if($table_name=='company_employee')
                                        {
                                            $this->obj->db->where('desg_id',2);
                                        }
                                        if($table_name=='users' && $element->name=='inch_name')
                                        {
                                            $this->obj->db->where('group_id',3); // sales space group
                                        }
                                        if($table_name=='users' && $element->name=='cfit_name')
                                        {
                                            $this->obj->db->where('group_id',31);// China group
                                        }
                                        $result = $this->obj->db->select("$label_name, $value_name")->get($table_name)->result();
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
                            $this->obj->db->select("$label_name, $value_name");
                            $this->obj->db->where_in("$condition_column",$condition_values);
                            // echo $this->obj->db->last_query();
                            $query = $this->obj->db->get("$table_name");
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
            redirect(($this->obj->data['base_url'].'/list_items'));
        }

        if($default_view)
        {
            $data1['form_data'] = $cols->form_data;
            $data1['data_list'] = $result1['data'];
            $data1['columns']   = $result1['columns'];
            return $data1;
        }
        $form_data                       = $cols->form_data;
        $this->obj->data['action']       = "edit";
        $this->obj->data['name'] = $this->get_module();
        $this->obj->data['module_title'] = 'Edit '.$this->obj->data["name"]->module_title;
        // $this->obj->data['form_title']   = ucwords($res->form_label)." Form";
        $this->obj->data['form_title']   = "Enquiry";
        $this->obj->data['table_id']     = $id;
        // $this->obj->data['cols']      = $cols;
        $this->obj->data['data_list']    = $result1['data'];
        $this->obj->data['columns']      = $result1['columns'];
        $this->obj->data['form_data']    = $form_data;
        $views[]                         = "dynamic_view/edit_form";
        // $this->obj->data['state'] = get_state_from_master_acord_country($result->country);
        // $this->obj->data['city'] = get_state_from_master_acord_country($result->state_comp);
        
        $this->obj->data['submodule'] = 'Edit '.$this->obj->data["name"]->module_title;
        // pr($form_data);die;
        view_load($views, $this->obj->data);

    }
    
    public function dynamic_view($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->obj->form_module_mod_lib->get_form($id);
        $result1 = $this->obj->form_module_mod_lib->dynamic_list_view($recId, $id);
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
                                if ($this->obj->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->obj->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->obj->db->select("$label_name, $value_name")->get($table_name)->result();
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
                            $this->obj->db->select("$label_name, $value_name");
                            $this->obj->db->where_in("$condition_column",$condition_values);
                            // echo $this->obj->db->last_query();
                            $query = $this->obj->db->get("$table_name");
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

        $form_data                  	= $cols->form_data;
        $this->obj->data['action']      = "add";
        $this->obj->data['name'] = $this->get_module();
        $this->obj->data['module_title']= 'View '.$this->obj->data["name"]->module_title;
        $this->obj->data['form_title']	= ucwords($res->form_name)." Form";
        $this->obj->data['table_id']	= $id;
        $this->obj->data['data_list']	= $result1['data'];
        $this->obj->data['columns']     = $result1['columns'];
        $this->obj->data['form_data']	= $form_data;
        $views[]						= "dynamic_view/view_form";
        
        $this->obj->data['submodule'] = 'View '.$this->obj->data["name"]->module_title;
         pr($this->obj->data);die;
        view_load($views, $this->obj->data);

    }
        
    public function daily_activity_report($frm_id='')
    {

        if (!$frm_id) {
            redirect(base_url('form_module'));
        }
	    $res			= $this->obj->form_module_mod_lib->get_form($frm_id);  
        $result			= $this->obj->form_module_mod_lib->daily_activity_report();
        $project_list	= $this->obj->form_module_mod_lib->project_list();
        $approval_list	= $this->obj->form_module_mod_lib->approval_list();
        // pr($project_list);die;
        $this->obj->data['action']               = "list";
        $this->obj->data['current_url']     		= $this->obj->data['base_url'].'/daily_activity_report/'.$frm_id;
        $views[]                			= 'daily_activity_report/daily_activity_report_list';
        $this->obj->data['title']    			= $res->form_label." List";
        $this->obj->data['result']      			= $result;
        $this->obj->data['project_list']			= $project_list;
        $this->obj->data['approval_list']		= $approval_list;
        $this->obj->data['dynamic_module_name'] 	= $res->form_name;
        $this->obj->data['dynamic_module_id']   	= $frm_id;
        $this->obj->data['submodule'] 			= 'List';

        view_subcompanylayout($views, $this->obj->data);
    }

    public function add_daily_activity_report($id, $task_id, $prj_id)
    {
    	if(!$id && !$task_id && !$prj_id)
    	{
    		redirect(base_url());
    	}

    	$prj_tsk 	= $this->obj->form_module_mod_lib->get_task_detail($task_id);
    	// pr($prj_tsk);die;
    	$res 		= $this->obj->form_module_mod_lib->get_form($id);
        $table_name = $res->form_name;
        // pr($res);die;
        if (isPostBack()) {
            $postData = $this->obj->input->post(null, true);
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
				                $fileData = $this->obj->uploadFiles($_FILES['myfile'], $allowed_extensions);
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
			                $fileData=$this->obj->uploadFiles($_FILES['myfile']);
			                
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
            //$this->obj->db->where('form_id',$id);
            set_common_insert_value2();
            $this->obj->db->insert(TBL_PREFIX . $res->form_name, $postData);
            $id = $this->obj->db->insert_id();
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
                                if ($this->obj->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->obj->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $this->obj->db->select("$label_name, $value_name");
                                        if($table_name=='company_employee')
                                        {
                                        	$this->obj->db->where('desg_id',2);
                                        }
                                        $result = $this->obj->db->get($table_name)->result();

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
        $this->obj->data['action']       = "add";
        $this->obj->data['module_title'] = "Create ".ucwords($res->form_label).' > '.$prj_tsk->project_name.' > '.$prj_tsk->task_title;
        $this->obj->data['form_title']   = ucwords($res->form_label)." Form";
        $this->obj->data['table_id']     = $id;
        $this->obj->data['task_id']     	= $task_id;
        $this->obj->data['project_id']	= $prj_id;
        // $this->obj->data['cols']      = $cols;
        $this->obj->data['form_data']    = $form_data;
        $views[]                    = "daily_activity_report/add_form";
        
        $this->obj->data['submodule']    = 'Add Dynamic Values';
       	
        view_subcompanylayout($views, $this->obj->data);

    }

    public function edit_daily_activity_report($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->obj->form_module_mod_lib->get_form($id);
        $result1 = $this->obj->form_module_mod_lib->dynamic_list_view($recId, $id);
        // pr($result1);die;
        if (isPostBack()) {
            $postData = $this->obj->input->post(null, true);
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
				                $fileData = $this->obj->uploadFiles($_FILES['myfile'], $allowed_extensions);
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
			                $fileData=$this->obj->uploadFiles($_FILES['myfile']);
			                
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
            //$this->obj->db->where('form_id',$id);
            $this->obj->db->trans_start();
            set_common_update_value2();
            $this->obj->db->where('form_id', $recId);
           	$res =  $this->obj->db->update(TBL_PREFIX . $res->form_name, $postData);
            $this->obj->db->trans_complete();
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
                                if ($this->obj->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->obj->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->obj->db->select("$label_name, $value_name")->get($table_name)->result();
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
                            $this->obj->db->select("$label_name, $value_name");
				            $this->obj->db->where_in("$condition_column",$condition_values);
				            // echo $this->obj->db->last_query();
				            $query = $this->obj->db->get("$table_name");
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
        $this->obj->data['action']       = "add";
        $this->obj->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->obj->data['form_title']   = ucwords($res->form_name)." Form";
        $this->obj->data['table_id']     = $id;
        // $this->obj->data['cols']      = $cols;
        $this->obj->data['data_list']   	= $result1['data'];
        $this->obj->data['columns']  	= $result1['columns'];
        $this->obj->data['form_data']    = $form_data;
        $views[]                    = "daily_activity_report/edit_form";
        // $this->obj->data['state'] = get_state_from_master_acord_country($result->country);
        // $this->obj->data['city'] = get_state_from_master_acord_country($result->state_comp);
        $this->obj->data['submodule']    = 'Add Dynamic Values';
        // pr($form_data);die;
        view_subcompanylayout($views, $this->obj->data);

    }

    public function view_daily_activity_report($recId, $table_name, $id)
    {
        
        if (!$table_name && !$id) {
            redirect(base_url());
        }
        $res = $this->obj->form_module_mod_lib->get_form($id);
        $result1 = $this->obj->form_module_mod_lib->dynamic_list_view($recId, $id);
        
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
                                if ($this->obj->db->table_exists($table_name) )
                                {
                                    $list_fields = $this->obj->db->list_fields($table_name);
                                    if(in_array($label_name, $list_fields) && in_array($value_name, $list_fields))
                                    {

                                        $result = $this->obj->db->select("$label_name, $value_name")->get($table_name)->result();
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
                            $this->obj->db->select("$label_name, $value_name");
				            $this->obj->db->where_in("$condition_column",$condition_values);
				            // echo $this->obj->db->last_query();
				            $query = $this->obj->db->get("$table_name");
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
        $this->obj->data['action']       = "add";
        $this->obj->data['module_title'] = "Create ".ucwords($res->form_name);
        $this->obj->data['form_title']   = ucwords($res->form_name)." Form";
        $this->obj->data['table_id']     = $id;
        // $this->obj->data['cols']      = $cols;
        $this->obj->data['data_list']   	= $result1['data'];
        $this->obj->data['columns']  	= $result1['columns'];
        $this->obj->data['form_data']    = $form_data;
        $views[]                    = "daily_activity_report/view_form";
        $this->obj->data['submodule']    = 'Add Dynamic Values';
        // pr($form_data);die;
        view_subcompanylayout($views, $this->obj->data);
    }
    
    public function check_all_fields_unq()
    {

        $array_input_name  = $this->obj->input->get_post('array_input_name', true);
        $array_input_type  = $this->obj->input->get_post('array_input_type', true);
        $array_input_value = $this->obj->input->get_post('array_input_value', true);
        $column_id         = $this->obj->input->get_post('column_id', true);
        $module_id         = $this->obj->input->get_post('module_id', true);
        $action            = $this->obj->input->get_post('action', true);

        if ($action == 'edit') {
	        if (!$column_id && !$module_id) {
	            // redirect(base_url('form_module'));
             	echo json_encode(['status'=>0,'messae'=>'Module id missing','data'=>'']);
	        }
	        else
	        {
	            // get the module tablename by module_id
	            $this->obj->db->select('form_name');
	            $this->obj->db->where('id', $module_id);
	            $query_tbl_dynamic = $this->obj->db->get(DYNAMIC_FORM_TBL);
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
	                        $this->obj->db->select("$val");
	                        $this->obj->db->where("form_id !=", $column_id);
	                        $this->obj->db->where("$val", $col_val_values);
	                        $result_query = $this->obj->db->get($table_name);
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
        elseif ($action == 'add') {
            if (!$column_id && !$module_id) {
                // redirect(base_url('form_module'));
                echo json_encode(['status'=>0,'messae'=>'Module id missing','data'=>'']);
            }
            else
            {
                // get the module tablename by module_id
                $this->obj->db->select('form_name');
                $this->obj->db->where('id', $module_id);
                $query_tbl_dynamic = $this->obj->db->get(DYNAMIC_FORM_TBL);
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
                            $this->obj->db->select("$val");
                            // $this->obj->db->where("form_id !=", $column_id);
                            $this->obj->db->where("$val", $col_val_values);
                            $result_query = $this->obj->db->get($table_name);
                            if ($result_query->num_rows() > 0) {

                                $error_msgs_arr[$i]["id"]    = $val;
                                $error_msgs_arr[$i]["error"] = $val . " field must be unique.";
                                $i++;
                            }
                        }
                    }
                    //pr($error_msgs_arr);die;
                    echo json_encode(['status'=>1,'message'=>'Data validated','validation'=>count($error_msgs_arr)?1:0,'data'=>$error_msgs_arr]);
                    // echo json_encode($error_msgs_arr);
                }
                else
                {
                    echo json_encode(['status'=>0,'message'=>'Module missing','validation'=>0,'data'=>'']);
                }
            }
        }
    }

    public function get_table_list()
    {
        if ($this->obj->input->is_ajax_request()) {
            $query = $this->obj->db->query("SHOW TABLES");
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
        if ($this->obj->input->is_ajax_request()) {
            if (isset($_POST['table_name']) && !empty($_POST['table_name'])) {
                $tablename = $this->obj->input->post('table_name');
                $query     = $this->obj->db->query("SHOW COLUMNS FROM " . $tablename);
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
        if ($this->obj->input->is_ajax_request()) {

        	// pr($_POST);die;
            if (isset($_POST['block_name']) && !empty($_POST['block_name']) && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $block_name = $this->obj->input->post('block_name');
                $frm_id 	= $this->obj->input->post('frm_id');
                $result 	= $this->obj->form_module_mod_lib->get_form($frm_id);
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
		                $this->obj->db->where('id', $result->id);
		                $res = $this->obj->db->update(TBL_PREFIX.'form', $updates);
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
        if ($this->obj->input->is_ajax_request()) {

        	// pr($_POST);die;
        	// echo "No permission"; exit;
            if (isset($_POST['block_index']) && $_POST['block_index']>=0 && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $block_index 	= $this->obj->input->post('block_index');
                $frm_id 		= $this->obj->input->post('frm_id');
                $result 		= $this->obj->form_module_mod_lib->get_form($frm_id);

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
			            $this->obj->db->trans_start();
			            foreach ($form_data->elements as $key1 => $value1) {
			            	// pr($value);
			            	$this->obj->db->query("ALTER TABLE ".TBL_PREFIX.$tablename." DROP ".$value1->name);
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
		                $this->obj->db->where('id', $result->id);
		                $res = $this->obj->db->update(TBL_PREFIX.'form', $updates);
		                $this->obj->db->trans_complete();
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
        if ($this->obj->input->is_ajax_request()) {

        	// pr($_POST);die;
        	// echo "No permission"; exit;
            if (isset($_POST['block_index']) && $_POST['block_index']>=0 && isset($_POST['frm_id']) && !empty($_POST['block_name']) && !empty($_POST['block_name'])) {
                $block_index 	= $this->obj->input->post('block_index');
                $frm_id 		= $this->obj->input->post('frm_id');
                $block_name		= $this->obj->input->post('block_name');
                $result 		= $this->obj->form_module_mod_lib->get_form($frm_id);

		        // pr(json_decode($result->form_data));die;
		        if ($result) {
		            $form 		= json_decode($result->form_data);
		            $form_data1	= $form->form_data;
		            // pr($form);die;
		            if(isset($form_data1[$block_index]) && !empty($form_data1[$block_index]))
		            {
			            $form->form_data[$block_index]->block = $block_name;
			            // pr($form);die;

			            $this->obj->db->trans_start();
			            $updates              = array();
		                $updates['form_data'] = json_encode($form);
		                $this->obj->db->where('id', $result->id);
		                $res = $this->obj->db->update(TBL_PREFIX.'form', $updates);
		                $this->obj->db->trans_complete();

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
        if ($this->obj->input->is_ajax_request()) {

            if (isset($_POST['reorder_data']) && !empty($_POST['reorder_data']) && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $reorder_data 	= (array) json_decode($this->obj->input->post('reorder_data'));
                $frm_id 		= $this->obj->input->post('frm_id');
                $result 		= $this->obj->form_module_mod_lib->get_form($frm_id);
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
	                $this->obj->db->trans_start();
	                $this->obj->db->where('id', $result->id);
	                $res = $this->obj->db->update(TBL_PREFIX.'form', $updates);
	                $this->obj->db->trans_complete();
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
        if ($this->obj->input->is_ajax_request()) {

        	// pr($_POST);die;
            if (isset($_POST['reorder_block']) && !empty($_POST['reorder_block']) && isset($_POST['frm_id']) && !empty($_POST['frm_id'])) {
                $reorder_block 	= json_decode($this->obj->input->post('reorder_block'));
                $frm_id 		= $this->obj->input->post('frm_id');
                $result 		= $this->obj->form_module_mod_lib->get_form($frm_id);
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
	                $this->obj->db->trans_start();
	                $this->obj->db->where('id', $result->id);
	                $res = $this->obj->db->update(TBL_PREFIX.'form', $updates);
	                $this->obj->db->trans_complete();
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
        if ($this->obj->input->is_ajax_request()) {
            // pr($_POST);die;
            
            $label_title		= $this->obj->input->get_post('label_title');
            $tblname            = $this->obj->input->get_post('tblname');
            $label_name         = $this->obj->input->get_post('label_name');
            $value_name         = $this->obj->input->get_post('value_name');
            $condition_column   = $this->obj->input->get_post('condition_column');
            $condition_values   = $this->obj->input->get_post('condition_values');
            $options 			= '';
            $this->obj->db->select("$label_name, $value_name");
            $this->obj->db->where_in("$condition_column",$condition_values);
            $query = $this->obj->db->get("$tblname");
            // echo $this->obj->db->last_query();
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
        if ($this->obj->input->is_ajax_request()) {
            // pr($_POST);die;
            $tblname            = $this->obj->input->get_post('tbl_deta');
            $delRow   			= $this->obj->input->get_post('delRow');
            $this->obj->db->where_in('form_id', $delRow);
            $status = $this->obj->db->delete(TBL_PREFIX.$tblname);
            // echo $this->obj->db->last_query();
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
            $this->obj->load->library('upload');
            $this->obj->upload->initialize($config);
            $data=array();
            if (!$this->obj->upload->do_upload('myfile'))
            {
                $data['error'] = $this->obj->upload->display_errors();
            } else
            {
                $data['success'] = $this->obj->upload->data();
            }
            return $data;
        }
    }
	public function get_module(){
		$data = strtolower($this->obj->uri->segment(2));
		//pr($data);die;
		$this->obj->db->select('module_controller,module_title');
		$this->obj->db->from('inch_form');
		$this->obj->db->where('module_controller',$data);   
	   
		
		$query = $this->obj->db->get();
		
		$module = $query->row();
		//$this->session->set_userdata("key",$module->form_label);
		//$result = $this->session->userdata("key");
		//pr($module);die;
		return $module;
	}

} //End of the class
