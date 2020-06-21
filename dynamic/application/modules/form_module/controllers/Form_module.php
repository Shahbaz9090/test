<?php defined('BASEPATH') OR exit('No direct script access allowed');
defined('DYNAMIC_FORM_TBL')    OR define('DYNAMIC_FORM_TBL', 'dynamic_form_master');
class Form_module extends MY_Controller{
    private $global_data   = array();
    private $data           = array();
    private $export_limit   = null;
    private $delete_limit   = null;
    private $controller;
    private $db2;
	function __construct()
	{
		parent::__construct();
		// $this->load->model("category_model");
        $this->load->model("form_module_mod");
		$this->load->library('form_validation');
        $this->global_data['module'] = 'Form Module';
        $this->controller = strtolower(__CLASS__);
        // $this->session->set_userdata("userName","Pradeep");
        // pr($this->session->userdata("userName"));
    }

    public function index()
    {
        $metaData['page_title']	= "Module List";
        $data['breadcrumbs']    = ['Module Listing'=>''];
        $data['action']         = "list";
        $data['page_heading'] 	= "Module Listing";
        $data['total_title']    = "Total Modules";
        $data['controller']     = $this->controller;
        $config['base_url'] 	= MAINSITE_MADMIN_URL.'/'.$this->controller.'/page/';
        $config['per_page'] 	= PERPAGE;
        $config["uri_segment"] 	= 3;
        if( count($_GET) > 0 )
        {
            $query_string_url 				= '?'.http_build_query($_GET, '', "&");
            $config['enable_query_string'] 	= TRUE;
            $config['suffix'] 				= $query_string_url;
            $config['first_url'] 			= $config["base_url"].$config['suffix'];
        }
        $config['full_tag_open'] 	= '<ul class="pagination pagination-sm">';
        $config['full_tag_close'] 	= '</ul>';
        $config['first_link'] 		= FALSE;
        $config['last_link'] 		= FALSE;
        $config['first_tag_open'] 	= '<li>';
        $config['first_tag_close'] 	= '</li>';
        $config['prev_link'] 		= '&laquo;';
        $config['prev_tag_open'] 	= '<li class="prev">';
        $config['prev_tag_close'] 	= '</li>';
        $config['next_link'] 		= '&raquo;';
        $config['next_tag_open'] 	= '<li>';
        $config['next_tag_close'] 	= '</li>';
        $config['last_tag_open'] 	= '<li>';
        $config['last_tag_close'] 	= '</li>';
        $config['cur_tag_open'] 	= '<li class="active"><a href="#">';
        $config['cur_tag_close'] 	= '</a></li>';
        $config['num_tag_open'] 	= '<li>';
        $config['num_tag_close'] 	= '</li>';
        $page 						= $this->uri->segment(3) ? $this->uri->segment(3) : 0;
        $data['total_pages']  		= $page;
        $response                   = $this->form_module_mod->get_list('','',PERPAGE,$page);
        $data['data_list']          = $response['result'];
        $data['total_record']       = $response['total'];
        $config['total_rows']       = $response['total'];
        $this->load->library('pagination');
        $this->pagination->initialize($config);
        $data['pagination_link']    = $this->pagination->create_links();
    	$this->load->view("includes/header",$metaData);
    	$this->load->view("includes/aside");
    	$this->load->view("list",$data);
    	$this->load->view("includes/footer");
    }

    public function page()
    {
        $this->index();
    }
    
    public function add()
    {
        if (isPostBack()) {
            $id = $this->form_module_mod->add();
            // pr($id);die;
            if (!$id['empty']) {
                clearPostData();
                set_flashdata('success', 'Form added Successfully');
                redirect(base_url($this->controller));
            } else {
                // echo "aya";die;
                $this->data['error_msg'] = @$id['form_error'];
                //pr($this->data['error_msg']);die;
            }
        }

    	$metaData['page_title'] = "Add New Module";
        $data['breadcrumbs']    = ['Module Listing'=>base_url($this->controller),'Add New Module'=>''];
        $data['action']         = "list";
        $data['page_heading']   = "Add New Module";
        $data['form_title']     = "Add Module Form";
        $data['controller']     = $this->controller;
    	$this->load->view("includes/header",$metaData);
    	$this->load->view("includes/aside");
    	$this->load->view("add",$data);
    	$this->load->view("includes/footer");
    }

    public function view($id='')
    {
        if(empty($id))
        {
            return redirect(base_url($this->controller));
        }
        $this->data['grid']['cols'] = $this->form_module_mod->get_flexigrid_cols_dynamic_form();
        $result                     = $this->form_module_mod->get_form($id);
        // pr($result);die;
        $all_form_data = [];
        $move_columns = [];
        if(isset($result->form_data) && !empty($result->form_data))
        {
            $form1 = json_decode($result->form_data);
            // pr($form1->form_data);die;
            $move_columns = $form1->form_data;
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
        }
        // pr($all_form_data);die;
        $metaData['page_title']     = "View Module";
        $this->data['forms']        = $all_form_data;
        $this->data['form_id']      = $id;
        $this->data['data_list']    = $all_form_data;
        // pr($this->data['forms']);die;
        $this->data['move_columns'] = $move_columns;
        $data['extra_btn']          = '<span class="grid-button" style="margin-right:0px;" ><div class="fbutton"><div><span data-toggle="modal" data-target="#move_column" class="add"><span aria-hidden="true" class="fa fa-random grid-list-icon"></span>Set Position</span></div></div></span>';
        $metaData['page_title']     = "Module List";
        $this->data['breadcrumbs']  = ['Module Listing'=>base_url($this->controller.''),$result->module_name=>''];
        // $this->data['breadcrumbs']  = ['Module Listing'=>base_url($this->controller.''),$result->module_name=>base_url($this->controller.'/view/'.$id)];
        $this->data['form_title']   = "Add New Column";
        $this->data['action']       = "list";
        $this->data['page_heading'] = "Module Listing";
        $this->data['total_title']  = "Total Modules";
        $this->data['controller']   = $this->controller;
        $this->load->view("includes/header",$metaData);
        $this->load->view("includes/aside");
        $this->load->view("view_column",$this->data);
        $this->load->view("includes/footer");
    }

    public function add_Column($id)
    {
        // echo $id;die;
        if (empty($id)) {
            redirect(base_url($this->controller));
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
                // pr($requ);die;

                if ($this->db->field_exists(strtolower($requ['field_name']), TBL_PREFIX. $result->form_name)) {

                    $this->data['error_msg'] = 'This column already exists. Please another name of the column. ';
                    // pr($data['error_msg']);die;
                    set_flashdata('error', $this->data['error_msg']);

                }
                elseif(!isset($requ['block_name']) || empty($requ['block_name']))
                {
                    $this->data['error_msg'] = 'Please select block';
                    // pr($data['error_msg']);die;
                    set_flashdata('error', $data['error_msg']);
                }
                else {
                    // pr($requ['field_name']);
                    // pr($result->form_name);die;
                    // pr($requ);die;
                    $addColumn = array();
                                        
                    // echo "yesss";
                    // pr($requ);die;
                    // pr($requ['field_type']);die;
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'      => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
                        );
                    }  else if ($requ['field_type'] == 'multiplefile') {
                        $addColumn = (object) array(
                            'type'           => 'file',
                            'data-input'     => 'multiplefile',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'      => (isset($requ['field_required']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
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
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'value'          => $requ['hidden_value']
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'list'           => $options
                        );

                        //$addColumn = (object) array('type' => 'label', 'data-input' => 'radio', 'label' => $requ['field_label'], 'name' => strtolower($requ['field_name']), 'list' => $options);

                    } else if ($requ['field_type'] == 'select') {
                        // echo"opennnn";die;
                        // pr($requ);die;
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                'option_type'  => 'local',
                                'options'        => $options
                            );
                        } else if ($requ['type'] == 2) {

                            $addColumn = (object) array(
                                'type'           => 'select',
                                'data-input'     => 'select',
                                'label'          => $requ['field_label'],
                                'name'           => strtolower($requ['field_name']),
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                'option_type'  => 'table',
                                'options'        => ['table_name'=>$requ['select_db_table'],'label_name'=>$requ['select_db_column_label'],'value_name'=>$requ['select_db_column_value']]
                            );
                        } else if ($requ['type'] == 3) {
                                // echo "jkkj";die;
                            // pr($requ);die;
                            if(isset($requ['dependent_table']) && !empty($requ['dependent_table']) && isset($requ['dependent_field']) && !empty($requ['dependent_field']) && isset($requ['dependent_column_label']) && !empty($requ['dependent_column_label']) && isset($requ['dependent_column_value']) && !empty($requ['dependent_column_value']) && isset($requ['dependent_condition_column']) && !empty($requ['dependent_condition_column']))
                            {
                                $addColumn = (object) array(
                                    'type'           => 'select',
                                    'data-input'     => 'select',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                    'option_type'  => 'dependent',
                                    'options'       => ['table_name'=>$requ['dependent_table'],'label_name'  =>$requ['dependent_column_label'],'value_name'=>$requ['dependent_column_value'],'event_field'=>$requ['dependent_field'],'condition_column'=>$requ['dependent_condition_column']]
                                );
                            }
                            else
                            {
                                return false;
                                echo "Table detail missing";
                                die;
                            }
                            // pr($addColumn);die;
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                'option_type'  => 'local',
                                'options'        => $options
                            );
                        } else if ($requ['type'] == 2) {

                            if(isset($requ['select_db_table']) && !empty($requ['select_db_table']) &&isset($requ['select_db_column_label']) && !empty($requ['select_db_column_label']) &&isset($requ['select_db_column_value']) && !empty($requ['select_db_column_value']))
                            {
                                $addColumn = (object) array(
                                    'type'           => 'multiselect',
                                    'data-input'     => 'multiple_select',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                    'option_type'  => 'table',
                                    'options'       => ['table_name'=>$requ['select_db_table'],'label_name'=>$requ['select_db_column_label'],'value_name'=>$requ['select_db_column_value']]
                                );
                            }
                            else
                            {
                                return false;
                                echo "Table detail missing";
                                die;
                            }
                        } else if ($requ['type'] == 3) {
                            // echo "string";
                            // pr($requ);
                            if(isset($requ['dependent_table']) && !empty($requ['dependent_table']) &&isset($requ['dependent_field']) && !empty($requ['dependent_field']) &&isset($requ['dependent_column_label']) && !empty($requ['dependent_column_label']) &&isset($requ['dependent_column_value']) && !empty($requ['dependent_column_value']) &&isset($requ['dependent_condition_column']) && !empty($requ['dependent_condition_column']))
                            {
                                $addColumn = (object) array(
                                    'type'           => 'multiselect',
                                    'data-input'     => 'multiple_select',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                    'option_type'  => 'dependent',
                                    'options'       => ['table_name'=>$requ['dependent_table'],'label_name'  =>$requ['dependent_column_label'],'value_name'=>$requ['dependent_column_value'],'event_field'=>$requ['dependent_field'],'condition_column'=>$requ['dependent_condition_column']]
                                );
                            }
                            else
                            {
                                echo "Table detail missing";
                                return false;die;
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty,ValidEmail" : ""
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
                            'required'         => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'calendarPosition' => "right",
                            "dateFormat"       => "%Y-%m-%d"
                        );
                    }  else if ($requ['field_type'] == 'time') {
                        $addColumn = (object) array(
                            'type'             => 'timepicker',
                            'data-input'       => 'time',
                            'label'            => $requ['field_label'],
                            'name'             => strtolower($requ['field_name']),
                            'view_in_mobile'   => strtolower($requ['view_in_mobile']),
                            'view_on_left'     => strtolower($requ['view_on_left']),
                            'status'           => strtolower($requ['status']),
                            'values'           => strtolower($requ['field_default_value']),
                            'required'         => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'calendarPosition' => "right",
                            "dateFormat"       => "%Y-%m-%d"
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => "ValidNumeric"
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            "rows"           => "5"
                        );
                    }  else if ($requ['field_type'] == 'texteditor') {
                        $addColumn = (object) array(
                            'type'           => 'input',
                            'data-input'     => 'texteditor',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            "rows"           => "5"
                        );
                    } else if ($requ['field_type'] == 'checkbox') {

                        if (isset($requ['display']) && !empty($requ['display'])) {
                            $options = array();
                            $i       = 0;
                            foreach ($requ['display'] as $val) {
                                if (!empty($requ['display'][$i]) && !empty($requ['value'][$i])) {
                                    $options[] = (object) array('label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                }
                                $i++;
                            }
                        }
                        $addColumn = (object) array(
                            'type'           => 'checkbox',
                            'data-input'     => 'checkbox',
                            'label'          => $requ['field_label'],
                            'name'           => strtolower($requ['field_name']),
                            'view_in_mobile' => strtolower($requ['view_in_mobile']),
                            'view_on_left'   => strtolower($requ['view_on_left']),
                            'status'         => strtolower($requ['status']),
                            'values'         => strtolower($requ['field_default_value']),
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'list'           => $options
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                            'list'           => $options
                        );
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
                            'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                            'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                            'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
                        );
                    }
                    // echo "string";
                    if(isset($requ['is_relation']) && $requ['is_relation']=='on')
                    {
                        $addColumn->is_relation->table = $requ['relation_table'];
                        $addColumn->is_relation->column = $requ['relation_column'];
                    }
                    else
                    {
                        $addColumn->is_relation = 0;
                    }

                    if(isset($requ['is_readonly']) && $requ['is_readonly']=='on')
                    {
                        $addColumn->is_readonly = 1;
                    }
                    else
                    {
                        $addColumn->is_readonly = 0;
                    }
                    if(isset($requ['field_type']) && ($requ['field_type']=='file' || $requ['field_type']=='multiplefile'))
                    {
                        if(isset($requ['allowed_extension']) && !empty($requ['allowed_extension']))
                        {
                            $addColumn->allowed_extensions = $requ['allowed_extension'];
                        }
                        else
                        {
                            $addColumn->allowed_extensions = 0;
                        }
                    }

                    // pr($requ);die;
                    $tblFormData = new stdClass();
                    $flag = 0;
                    if (isset($result->form_data) && !empty($result->form_data)) {
                        /*If column exist*/
                        $tblFormData    = json_decode($result->form_data);
                        // echo "Old tblFormData<br>";
                        
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
                        $settings   = ['type'=>'settings','position'=>'label-left','labelWidth'=>'150','inputWidth'=>'350'];
                        $extra[0]   = (object) array("type" => "hidden", "name" => "form_name", "value" => $result->form_name);
                        $extra[1]   = (object) array("type" => "button", "name" => "submit", "value" => "submit", "offsetLeft" => "45");
                        /*Extra param*/

                        $tblFormData->setting                   = (object) $settings;
                        $tblFormData->extra                     =  $extra;
                        $tblFormData->form_data[0]->block       = 'default';
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
                    $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
                    // echo $this->db->last_query();
                    // var_dump($res);
                    if ($res) {

                        $data_type              = "";
                        $field_length           = " (250) ";
                        $column_df_value        = " NULL ";

                        if(isset($requ['column_df_value']) && $requ['column_df_value']!='')
                        {
                            $column_df_value    = " NOT NULL DEFAULT '".$requ['column_df_value']."'";
                        }
                        if(isset($requ['field_length']) && !empty($requ['field_length']))
                        {
                            $field_length       = " (".$requ['field_length'].") ";
                        }
                        if(isset($requ['data_type']) && !empty($requ['data_type']))
                        {
                            if($requ['data_type']=='INT' && (!isset($requ['field_length']) || empty($requ['field_length']) ))
                            {
                                $data_type  = $requ['data_type']." (11) ";
                            }
                            elseif($requ['data_type']=='DECIMAL' || $requ['data_type']=='FLOAT' || $requ['data_type']=='DOUBLE' && (!isset($requ['field_length']) || empty($requ['field_length']) ))
                            {
                                $data_type  = $requ['data_type']." (8,2) ";
                            }
                            elseif($requ['data_type'] == 'DATE' || $requ['data_type'] == 'DATETIME' || $requ['data_type'] == 'TIMESTAMP' || $requ['data_type'] == 'TIME') 
                            {

                                $data_type  = $requ['data_type'];
                            }
                            else
                            {
                                $data_type  = $requ['data_type'].$field_length;
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

        $formData1  = json_decode($result->form_data);
        $blocks     = [];
        if(!empty($formData1))
        {
            $formData   = $formData1->form_data;
            foreach ($formData as $key => $value) {

                $blocks[] = $value->block;
            }
        }
        // pr($blocks);die;
        $this->data['breadcrumbs']  = ['Module Listing'=>base_url($this->controller.''),$result->module_name=>base_url($this->controller.'/view/'.$id),'Add Column'=>''];
        $metaData['page_title']     = "Add New Column";
        $this->data['page_heading'] = "Add New Column";
        $this->data['form_title']   = "Add New Column";
        $this->data['total_title']  = "Total Modules";
        $this->data['form_id']      = $id;
        $this->data['controller']   = $this->controller;
        $this->data['result']       = $result;
        $this->data['blocks']       = $blocks;
        $this->data['action']       = "add";
        $this->data['submodule']    = 'Add Form Column';
        // pr($this->data);die;
        $this->load->view("includes/header",$metaData);
        $this->load->view("includes/aside");
        $this->load->view("add_column", $this->data);
        $this->load->view("includes/footer");
    }

    public function edit_column($id, $keys)
    {
        if (empty($id)) {
            redirect(base_url($this->controller));
        }

        $result     = $this->form_module_mod->get_form($id);
        $form_name  = $result->form_name;
        $form1      = json_decode($result->form_data);
        $key        = explode('_', $keys);
        // pr($result);die;
        // echo count($key);die;
        if(!is_array($key) || !count($key)>1)
        {
            redirect(base_url('form_module'));
        }
        $block_indx     = $key[0];
        $column_indx    = $key[1];
        if(!isset($form1->form_data[$block_indx]->elements))
        {
            redirect(base_url('form_module'));
        }
        $form   = $form1->form_data[$block_indx]->elements;
        if(!isset($form[$column_indx]))
        {
            redirect(base_url('form_module'));
        }
        $col            = $form[$column_indx];
        $field_name     = $col->name;
        $field_details  = [];
        $columns        = $this->db->field_data(TBL_PREFIX.$form_name);
        foreach ($columns as $key1 => $val) {
            if ($val->name == $field_name) {
                $field_details = $val;
            }
        }

        /*is Post*/
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique'      => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "", 'unique'      => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
                            );

                        }  else if ($requ['field_type'] == 'multiplefile') {
                            $addColumn = (object) array(
                                'type'           => 'file',
                                'data-input'     => 'multiplefile',
                                'label'          => $requ['field_label'],
                                'name'           => strtolower($requ['field_name']),
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'unique'      => (isset($requ['field_required']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : ""
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "", 
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
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
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"

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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "", 
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "", 
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false",
                                'list'           => $options
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
                                    'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                    'options'        => $options
                                );
                            } else if ($requ['type'] == 2) {

                                $addColumn = (object) array(
                                    'type'           => 'select',
                                    'data-input'     => 'select',
                                    'label'          => $requ['field_label'],
                                    'name'           => strtolower($requ['field_name']),
                                    'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                    'view_on_left'   => strtolower($requ['view_on_left']),
                                    'status'         => strtolower($requ['status']),
                                    'values'         => strtolower($requ['field_default_value']),
                                    'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                    'option_type'  => 'table',
                                    'options'        => ['table_name'=>$requ['select_db_table'],'label_name'=>$requ['select_db_column_label'],'value_name'=>$requ['select_db_column_value']]
                                );
                            }
                            else if ($requ['type'] == 3) {
                                
                                if(isset($requ['select_db_table']) && !empty($requ['select_db_table']) &&isset($requ['select_db_column_label']) && !empty($requ['select_db_column_label']) &&isset($requ['select_db_column_value']) && !empty($requ['select_db_column_value']))
                                {
                                    $addColumn = (object) array(
                                        'type'           => 'select',
                                        'data-input'     => 'select',
                                        'label'          => $requ['field_label'],
                                        'name'           => strtolower($requ['field_name']),
                                        'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                        'view_on_left'   => strtolower($requ['view_on_left']),
                                        'status'         => strtolower($requ['status']),
                                        'values'         => strtolower($requ['field_default_value']),
                                        'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                        'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                        'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                        'option_type'  => 'dependent',
                                        'options'       => ['table_name'=>$requ['dependent_table'],'label_name'  =>$requ['dependent_column_label'],'value_name'=>$requ['dependent_column_value'],'event_field'=>$requ['dependent_field'],'condition_column'=>$requ['dependent_condition_column']]
                                    );
                                }
                                else
                                {
                                    return false;
                                    echo "Table detail missing";
                                    die;
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
                                    'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                    'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                    'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false",
                                    'options'        => $options
                                );
                            } else if ($requ['type'] == 2) {
                                
                                if(isset($requ['select_db_table']) && !empty($requ['select_db_table']) &&isset($requ['select_db_column_label']) && !empty($requ['select_db_column_label']) &&isset($requ['select_db_column_value']) && !empty($requ['select_db_column_value']))
                                {
                                    $addColumn = (object) array(
                                        'type'           => 'multiselect',
                                        'data-input'     => 'multiple_select',
                                        'label'          => $requ['field_label'],
                                        'name'           => strtolower($requ['field_name']),
                                        'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                        'view_on_left'   => strtolower($requ['view_on_left']),
                                        'status'         => strtolower($requ['status']),
                                        'values'         => strtolower($requ['field_default_value']),
                                        'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                        'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                        'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                        'option_type'  => 'table',
                                        'options'       => ['table_name'=>$requ['select_db_table'],'label_name'  =>$requ['select_db_column_label'],'value_name'=>$requ['select_db_column_value']]
                                    );
                                }
                                else
                                {
                                    return false;
                                    echo "Table detail missing";
                                    die;
                                }
                            } else if ($requ['type'] == 3) {
                                
                                if(isset($requ['select_db_table']) && !empty($requ['select_db_table']) &&isset($requ['select_db_column_label']) && !empty($requ['select_db_column_label']) &&isset($requ['select_db_column_value']) && !empty($requ['select_db_column_value']))
                                {
                                    $addColumn = (object) array(
                                        'type'           => 'multiselect',
                                        'data-input'     => 'multiple_select',
                                        'label'          => $requ['field_label'],
                                        'name'           => strtolower($requ['field_name']),
                                        'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                        'view_on_left'   => strtolower($requ['view_on_left']),
                                        'status'         => strtolower($requ['status']),
                                        'values'         => strtolower($requ['field_default_value']),
                                        'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                        'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                        'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                        'option_type'  => 'dependent',
                                        'options'       => ['table_name'=>$requ['dependent_table'],'label_name'  =>$requ['dependent_column_label'],'value_name'=>$requ['dependent_column_value'],'event_field'=>$requ['dependent_field'],'condition_column'=>$requ['dependent_condition_column']]
                                    );
                                }
                                else
                                {
                                    return false;
                                    echo "Table detail missing";
                                    die;
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty,ValidEmail" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
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
                                'required'         => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'calendarPosition' => "right",
                                "dateFormat"       => "%Y-%m-%d",
                                'unique'           => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false",
                                'validate'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "NotEmpty" : ""
                            );
                        } else if ($requ['field_type'] == 'time') {
                            $addColumn = (object) array(
                                'type'             => 'timepicker',
                                'data-input'       => 'time',
                                'label'            => $requ['field_label'],
                                'name'             => strtolower($requ['field_name']),
                                'view_in_mobile'   => strtolower($requ['view_in_mobile']),
                                'view_on_left'     => strtolower($requ['view_on_left']),
                                'status'           => strtolower($requ['status']),
                                'values'           => strtolower($requ['field_default_value']),
                                'required'         => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                'calendarPosition' => "right",
                                "dateFormat"       => "%Y-%m-%d"
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => "ValidNumeric",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
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
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                "rows"           => "5",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false"
                            );
                        
                        }   else if ($requ['field_type'] == 'texteditor') {
                            $addColumn = (object) array(
                                'type'           => 'input',
                                'data-input'     => 'texteditor',
                                'label'          => $requ['field_label'],
                                'name'           => strtolower($requ['field_name']),
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                "rows"           => "5"
                            );
                        } else if ($requ['field_type'] == 'checkbox') {
                            $addColumn[] = new stdClass();
                            if (isset($requ['display']) && !empty($requ['display'])) {
                                $options = array();
                                $i       = 0;
                                foreach ($requ['display'] as $val) {
                                    if (!empty($requ['display'][$i]) && !empty($requ['value'][$i])) {
                                        $options[] = (object) array('label' => $requ['display'][$i], 'value' => $requ['value'][$i]);
                                    }

                                    $i++;
                                }
                            }

                            $addColumn = (object) array(
                                'type'           => 'checkbox',
                                'label'          => $requ['field_label'],
                                'data-input'     => 'checkbox',
                                'name'           => strtolower($requ['field_name']),
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] ) ? "true" : "false",
                                'list'           =>$options

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
                                'label'          => $requ['field_label'],
                                'data-input'     => 'multiple_checkbox',
                                'name'           => strtolower($requ['field_name']),
                                'view_in_mobile' => strtolower($requ['view_in_mobile']),
                                'view_on_left'   => strtolower($requ['view_on_left']),
                                'status'         => strtolower($requ['status']),
                                'values'         => strtolower($requ['field_default_value']),
                                'required'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "true" : "false",
                                'validate'       => (isset($requ['field_required']) && $requ['field_required'] == 'on') ? "NotEmpty" : "",
                                'unique'         => (isset($requ['field_unique']) && $requ['field_unique'] == 'on') ? "true" : "false",
                                'list'           =>$options
                            );
                        }
                        // pr($requ);
                        // pr($addColumn);die;
                        if(isset($requ['is_relation']) && $requ['is_relation']=='on')
                        {
                            $addColumn->is_relation->table = $requ['relation_table'];
                            $addColumn->is_relation->column = $requ['relation_column'];
                        }
                        else
                        {
                            $addColumn->is_relation = 0;
                        }
                        
                        if(isset($requ['is_readonly']) && $requ['is_readonly']=='on')
                        {
                            $addColumn->is_readonly = 1;
                        }
                        else
                        {
                            $addColumn->is_readonly = 0;
                        }
                        if(isset($requ['field_type']) && ($requ['field_type']=='file' || $requ['field_type']=='multiplefile'))
                        {
                            if(isset($requ['allowed_extension']) && !empty($requ['allowed_extension']))
                            {
                                $addColumn->allowed_extensions = $requ['allowed_extension'];
                            }
                            else
                            {
                                $addColumn->allowed_extensions = 0;
                            }
                        }
                        // pr($requ);
                        // pr($addColumn);die;
                        $tblFormData = new stdClass();
                        $tblFormData = json_decode($result->form_data);
                        // echo "Old tblFormData";
                        // pr($tblFormData);

                        $tblFormData->form_data[$block_indx]->elements[$column_indx] = $addColumn;
                        //pr($addColumn);die;
                        // echo "New tblFormData";
                        // pr($requ);die;
                        $this->db->trans_start();
                        $updates              = array();
                        $updates['form_data'] = json_encode($tblFormData);
                        $this->db->where('id', $result->id);
                        $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
                        if ($res) {

                            $data_type              = "";
                            $field_length           = " (250) ";
                            $column_df_value        = " NULL ";

                            if(isset($requ['column_df_value']) && $requ['column_df_value']!='')
                            {
                                $column_df_value    = " NOT NULL DEFAULT '".$requ['column_df_value']."'";
                            }
                            if(isset($requ['field_length']) && !empty($requ['field_length']))
                            {
                                $field_length       = " (".$requ['field_length'].") ";
                            }
                            if(isset($requ['data_type']) && !empty($requ['data_type']))
                            {
                                // echo "string";
                                if($requ['data_type']=='INT' && (!isset($requ['field_length']) || empty($requ['field_length']) ))
                                {
                                    $data_type  = $requ['data_type']." (11) ";
                                }
                                elseif($requ['data_type']=='DECIMAL' || $requ['data_type']=='FLOAT' || $requ['data_type']=='DOUBLE' && (!isset($requ['field_length']) || empty($requ['field_length']) ))
                                {
                                    $data_type  = $requ['data_type']." (8,2) ";
                                }
                                elseif ($requ['data_type'] == 'DATE' || $requ['data_type'] == 'DATETIME' || $requ['data_type'] == 'TIMESTAMP' || $requ['data_type'] == 'TIME') {
                                
                                    $data_type  = $requ['data_type'];
                                }
                                elseif ($requ['data_type'] == 'TEXT' || $requ['data_type'] == 'TINYTEXT' ) 
                                {
                                
                                    $data_type  = $requ['data_type'];
                                }
                                else
                                {
                                    $data_type  = $requ['data_type'].$field_length;
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

                            $alter = "ALTER TABLE ".TBL_PREFIX. $result->form_name . " CHANGE " . $col->name . " " . strtolower($requ['field_name'])." ".$data_type.$column_df_value;
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
        /*is Post*/

        $formData1  = json_decode($result->form_data);
        $blocks     = [];
        if(!empty($formData1))
        {
            $formData   = $formData1->form_data;
            foreach ($formData as $key2 => $value) {

                $blocks[] = $value->block;
            }
        }

        if(isset($col->option_type) && $col->option_type=='table')
        {
            $options = $col->options;
            $tables_list = $this->db->list_tables();

            $fields = $this->db->list_fields($options->table_name);
            $col->options->data['tables'] = $tables_list;
            $col->options->data['columns'] = $fields;
        }
        elseif(isset($col->option_type) && $col->option_type=='dependent')
        {
            $options = $col->options;
            $tables_list = $this->db->list_tables();

            $fields = $this->db->list_fields($options->table_name);
            $col->options->data['tables']   = $tables_list;
            $col->options->data['columns']  = $fields;
            $tablename = TBL_PREFIX.$result->form_name;
            $fields2 = $this->db->list_fields($tablename);
            $col->options->data['event_fields']  = $fields2;
        }
        if(isset($col->type) && ($col->type=='file'))
        {
            $tables = $this->db->table_exists('pms_extension_master');
            $extensions = '';
            if (isset($tables) && count($tables)>0) {

                $query = $this->db->get_where('pms_extension_master');
                if($query->num_rows()>0)
                {
                    $extensions = $query->result();
                }
            }
            $col->extensions = $extensions;
        }
        // pr($col);die;
        $this->data['breadcrumbs']  = ['Module Listing'=>base_url($this->controller.''),$result->module_name=>base_url($this->controller.'/view/'.$id),'Edit Column'=>''];

        $metaData['page_title']     = "Edit [".$col->label."] Column";
        $this->data['page_heading'] = "Edit ".$result->form_label." Column";
        $this->data['form_title']   = "Edit [".$field_details->name."] Column";
        $this->data['total_title']  = "Total Modules";
        $this->data['form_id']      = $id;
        $this->data['column_key']   = $keys;
        $this->data['controller']   = $this->controller;
        $this->data['result']       = $result;
        $this->data['blocks']       = $blocks;
        $this->data['action']       = "edit";
        $this->data['submodule']    = 'Edit Form Column';
        $this->data['field_details']= $field_details;
        $this->data['cols']         = (array) $col;
        // pr($this->data);die;
        $this->load->view("includes/header",$metaData);
        $this->load->view("includes/aside");
        $this->load->view("edit_column", $this->data);
        $this->load->view("includes/footer");
    }

    public function edit($id)
    {
    	
    	if (isPostBack()) {
            $response = $this->form_module_mod->edit($id);
            // pr($response);die;
            if (!$response['empty']) {
                clearPostData();
                set_flashdata('success', 'Form updated Successfully');
                redirect(base_url($this->controller));
            } else {
                $data['error_msg'] = $response['error_msg'];
            }
        }

        $result = $this->form_module_mod->get_form($id);
        // pr($result);die;
        $this->data['result']       = $result;
        $this->data['form_id']      = $id;
        $metaData['page_title']     = "Edit Module";
        $this->data['breadcrumbs']  = ['Module Listing'=>base_url($this->controller),'Edit Module'=>''];
        $this->data['action']       = "list";
        $this->data['page_heading'] = "Edit Module";
        $this->data['form_title']   = "Edit Module Form";
        $this->data['controller']   = $this->controller;
        $this->load->view("includes/header",$metaData);
        $this->load->view("includes/aside");
        $this->load->view("edit",$this->data);
        $this->load->view("includes/footer");
    }

    public function delete($id)
	{   
		$this->form_module_mod->delete($id);
        $this->session->set_flashdata("success","Record successfully deleted");
        redirect(base_url($this->controller));
	}

    public function status($id,$status)
    {
        if($status!='' && is_numeric($status) && $id!='' && is_numeric($id))
        {
            $data           = [];
            $data['status'] = $status==1?2:1;
            $this->form_module_mod->update($id, $data);
            $this->session->set_flashdata('success',"Staus successfully updated!");
            redirect(base_url($this->controller),'refresh');
        }
        else
        {
            $this->session->set_flashdata('error',"Staus could not be updated!");
            redirect(base_url($this->controller),'refresh');
        }
    }

    public function is_unique_category_name($val){
        $id = $this->uri->segment(4);
        if(!empty($id) && !empty($val)){
            $this->db->select('id');
            $this->db->where('id!=',$id);
            $this->db->where('category',$val);
            $query = $this->db->get('category');
            if($query->num_rows() > 0){
                $this->form_validation->set_message('is_unique_category_name','Category Name is already Exists.');
                return false;
            }
        }
    }

    public function reorder_module()
    {
        if ($this->input->is_ajax_request()) {

            // pr(json_decode($_POST['reorder_module']));die;
            if (isset($_POST['reorder_module']) && !empty($_POST['reorder_module'])) 
            {
                $reorder_module = json_decode($this->input->post('reorder_module'));

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
                $form->form_data        = $new_data;
                $updates                = array();
                $updates['form_data']   = json_encode($form);
                // pr(json_decode($updates['form_data']));die;
                $this->db->trans_start();
                $this->db->where('id', $result->id);
                $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
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
                $module_id  = ($this->input->post('module_id'));
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

    public function get_table_list()
    {
        if ($this->input->is_ajax_request()) {
            $tables = $this->db->list_tables();
            if (isset($tables) && count($tables)>0) {
                $options = '<option value="">Select Table Name</option>';
                // pr($tables);
                foreach ($tables as $key => $table) {
                    $options .= "<option value='" . $table . "'>" . $table . "</option>";
                }
                echo json_encode(['status' => 1, 'message' => 'Record found', 'data' => $options]);
            } else {
                echo json_encode(['status' => 0, 'message' => 'No record found', 'data' => $options]);
            }
            

        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed', 'data' => $options]);
        }
    }

    public function get_extension_list()
    {
        if ($this->input->is_ajax_request()) {
            $tables = $this->db->table_exists('pms_extension_master');
            if (isset($tables) && count($tables)>0) {

                $query = $this->db->get_where('pms_extension_master');
                if($query->num_rows()>0)
                {
                    $extensions = $query->result();
                    // pr($extensions);die;
                    $options = '';
                    // pr($tables);
                    foreach ($extensions as $key => $extension) {
                        $options .= "<option value='" . $extension->extension_name . "'>" . $extension->extension_name . "</option>";
                    }
                    echo json_encode(['status' => 1, 'message' => 'Record found', 'data' => $options]);
                }
                else
                {
                    echo json_encode(['status' => 0, 'message' => 'No record found', 'data' => '']);
                }
            } else {
                echo json_encode(['status' => 0, 'message' => 'extension table missing', 'data' => '']);
            }
            

        } else {
            echo json_encode(['status' => 0, 'message' => 'No direct script access allowed', 'data' => '']);
        }
    }
    
    public function get_column_list()
    {
        if ($this->input->is_ajax_request()) {
            if (isset($_POST['table_name']) && !empty($_POST['table_name'])) {
                $tablename = $this->input->post('table_name');
                // $query     = $this->db->query("SHOW COLUMNS FROM " . $tablename);
                // pr($query->num_rows());die;
                $fields = $this->db->list_fields($tablename);
                // pr($fields);die;
                if (isset($fields) && count($fields)>0) {
                    $options = '<option value="">Select Column Name</option>';
                    // $result  = $query->result_array();
                    // pr($result);
                    foreach ($fields as $field) {
                        $options .= "<option value='" . $field . "'>" . $field . "</option>";
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

    public function get_column_list_by_frm()
    {
        if ($this->input->is_ajax_request()) {
            if (isset($_POST['frm_name']) && !empty($_POST['frm_name'])) {
                $tablename = TBL_PREFIX.$this->input->post('frm_name');
                // $query     = $this->db->query("SHOW COLUMNS FROM " . $tablename);
                // pr($query->num_rows());die;
                $fields = $this->db->list_fields($tablename);
                // pr($fields);die;
                if (isset($fields) && count($fields)>0) {
                    $options = '<option value="">Select Field Name</option>';
                    // $result  = $query->result_array();
                    // pr($result);
                    foreach ($fields as $field) {
                        $options .= "<option value='" . $field . "'>" . $field . "</option>";
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
                $frm_id     = $this->input->post('frm_id');
                $result     = $this->form_module_mod->get_form($frm_id);
                // pr(json_decode($result->form_data));die;
                if ($result) {
                    $status     = 0; 
                    $def_exist  = 0; 
                    $form       = json_decode($result->form_data);
                    $lst_indx   = count($form->form_data);
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
                            $form->form_data[0]->block  = $block_name;
                        }
                        else
                        {
                            @$form->form_data[$lst_indx]->block      = $block_name;
                            @$form->form_data[$lst_indx]->elements   = '';
                        }
                        // pr($form);die;
                        $updates              = array();
                        $updates['form_data'] = json_encode($form);
                        $this->db->where('id', $result->id);
                        $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
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
                $block_index    = $this->input->post('block_index');
                $frm_id         = $this->input->post('frm_id');
                $result         = $this->form_module_mod->get_form($frm_id);

                // pr(json_decode($result->form_data));die;
                if ($result) {
                    $form       = json_decode($result->form_data);
                    $form_data1 = $form->form_data;
                    $tablename  = $form->extra[0]->value;
                    $new_form_data = [];
                    if(!isset($tablename) || empty($tablename))
                    {
                        echo json_encode(['status' => 0, 'message' => 'Block could not be delete.']);
                    }
                    elseif(isset($form_data1[$block_index]) && !empty($form_data1[$block_index]))
                    {
                        $form_data  = $form_data1[$block_index];
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
                        $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
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
                $block_index    = $this->input->post('block_index');
                $frm_id         = $this->input->post('frm_id');
                $block_name     = $this->input->post('block_name');
                $result         = $this->form_module_mod->get_form($frm_id);

                // pr(json_decode($result->form_data));die;
                if ($result) {
                    $form       = json_decode($result->form_data);
                    $form_data1 = $form->form_data;
                    // pr($form);die;
                    if(isset($form_data1[$block_index]) && !empty($form_data1[$block_index]))
                    {
                        $form->form_data[$block_index]->block = $block_name;
                        // pr($form);die;

                        $this->db->trans_start();
                        $updates              = array();
                        $updates['form_data'] = json_encode($form);
                        $this->db->where('id', $result->id);
                        $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
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
                $reorder_data   = (array) json_decode($this->input->post('reorder_data'));
                $frm_id         = $this->input->post('frm_id');
                $result         = $this->form_module_mod->get_form($frm_id);
                // pr(json_decode($result->form_data));
                // pr($reorder_data);die;
                if ($result) {
                    $status     = 0;
                    $form       = json_decode($result->form_data);
                    $form_data  = $form->form_data;
                    $new_data   = $form_data;
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
                    $form->form_data        = $new_data;
                    // pr($form);die;
                    // $form->form_data[$lst_indx]->block       = $block_name;
                    // $form->form_data[$lst_indx]->elements    = '';
                    // pr($form);die;
                    $updates                = array();
                    $updates['form_data']   = json_encode($form);
                    // pr(json_decode($updates['form_data']));die;
                    $this->db->trans_start();
                    $this->db->where('id', $result->id);
                    $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
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
                $reorder_block  = json_decode($this->input->post('reorder_block'));
                $frm_id         = $this->input->post('frm_id');
                $result         = $this->form_module_mod->get_form($frm_id);
                // pr(json_decode($result->form_data));
                // echo "form-data";
                // pr($reorder_block);
                if ($result) {
                    $status     = 0;
                    $form       = json_decode($result->form_data);
                    $form_data  = $form->form_data;
                    $new_data   = [];
                    // pr($form);die;
                    // pr($form_data);die;
                    if(isset($form_data) && count($form_data)>1)
                    {
                        foreach ($reorder_block as $rbkey => $reorder_block_value) {
                            /*pr($reorder_block_value);die;
                            if($reorder_block_value->block_name==$form_data[$reorder_block_value]->block)
                            {
                                $new_data[] = $form_data[$reorder_block_value];
                            }*/
                            $new_data[] = $form_data[$reorder_block_value];
                        }
                        // pr($new_data);die;
                        $form->form_data        = $new_data;
                        $updates                = array();
                        $updates['form_data']   = json_encode($form);
                        // pr(json_decode($updates['form_data']));die;
                        $this->db->trans_start();
                        $this->db->where('id', $result->id);
                        $res = $this->db->update(DYNAMIC_FORM_TBL, $updates);
                        $this->db->trans_complete();
                    }
                    else{
                        $res= 1;
                    }

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

    public function delete_column($id, $keys)
    {
        if(!isset($id) || empty($id))
        {
            redirect(base_url($this->controller));
        }
        $result = $this->form_module_mod->get_form($id);
        // pr($result);

        if ($result) {
            $result     = $this->form_module_mod->get_form($id);
            $form_name  = $result->form_name;
            $form       = json_decode($result->form_data);
            $form_data  = $form->form_data;
            $key        = explode('_', $keys);
            if(!is_array($key) || !count($key)>1)
            {
                redirect(base_url('form_module'));
            }
            $block_indx     = $key[0];
            $column_indx    = $key[1];
            if(!isset($form->form_data[$block_indx]->elements[$column_indx]) || empty($form->form_data[$block_indx]->elements[$column_indx]))
            {
                redirect(base_url('form_module'));
            }

            $col_name       = $form->form_data[$block_indx]->elements[$column_indx]->name;
            unset($form->form_data[$block_indx]->elements[$column_indx]);
            // pr($form->form_data[$block_indx]->elements[$column_indx]);die;
            // pr($form);die;
            // $form_data
            if ($col_name) {
                if ($this->db->field_exists($col_name, TBL_PREFIX.$form_name)) {
                    $this->db->query("ALTER TABLE ".TBL_PREFIX.$form_name ." DROP ". $col_name);
                }
            }
            $form_data_indx = $form->form_data[$block_indx]->elements;
            $new_form_data  = [];
            #Resindex
            foreach ($form_data_indx as $key2 => $value2) {
                $new_form_data[] = $value2;
            }
            #Resindex
            $form->form_data[$block_indx]->elements = $new_form_data;
            // pr(json_encode($form));die;
            $update              = array();
            $update['form_data'] = json_encode($form);
            // pr(json_decode($update['form_data']));die;
            $this->db->where('id', $result->id);
            $res = $this->db->update(DYNAMIC_FORM_TBL, $update);

            if ($res) {
                set_flashdata('success', 'Column delete successfully');
                redirect(base_url($this->controller.'/view/'.$id));
            } else {
                set_flashdata('error', 'Column not deleted ');
                redirect(base_url($this->controller.'/view/'.$id));
            }
        }

    }
    
}