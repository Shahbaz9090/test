<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
if ( ! defined('TBL_PREFIX')) exit('TBL_PREFIX constant not defined. Define first');
/**
 * CodeIgniter Manage Support Form Model 
 *
 * @package		CodeIgniter
 * @subpackage	Models
 * @category	Support Form
 * @author		Tekshapers Inc
 * @website		http://www.nss.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Form_module_mod_lib {
    	
    public $user_id;
	public function __construct()
    {
        $this->obj    = &get_instance();
        define('PRIMARY_KEY', 'form_id');
        $this->obj->user_id = $this->obj->session->userdata['userinfo']->id;
    }
    
	public function ajax_list_items($text, $limit, $offset, $order_by='form_id', $order='DESC') 
    {
    	$offset = ($offset - 1) * $limit;
        $this->obj->db->limit($limit, $offset);
        $text   = strtolower(trim($text));
        if($text!='')
        {
            $this->obj->db->like('form_name',$text);
        }
        $this->obj->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->obj->db->from("DYNAMIC_FORM_TBL");
        $this->obj->db->where('is_deleted',1);
        $this->obj->db->where('module_type',1);
        $this->obj->db->order_by('id', 'DESC');
        
        $query =$this->obj->db->get();
        //echo $this->obj->db->last_query();die;
        
        if($text!='')
        {
            $this->obj->db->like('form_name',$text);
        }
        if($order_by && $order)
            $this->obj->db->order_by($order_by, $order);


        $data['result'] = $query->result();
        $query = $this->obj->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset; 
       // pr($data);die;   
        return $data;
    }

    /**
     * add()
     *
     * This function add Support
     * 
     * @access	public
     * @return	boolean data
     */
    public function add() 
    {
    	//pr($_POST);die;
        $result['empty'] = TRUE;
        $result['is_support'] = false;
		
			$this->obj->form_validation->set_rules('form_name', 'Form Name', 'trim|xss_clean|required');
			if($_POST['email']){
				$this->obj->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email|required');
			}
			$this->obj->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
			
			if ($this->obj->form_validation->run() == FALSE) 
			{ 
				$result['error_msg'] = validation_errors();
				return $result;
			}
			else 
			{	
				
				$form_name = $this->obj->input->post('form_name',true);
				$form_label = ucwords($this->obj->input->post('form_label',true));
					
				$this->obj->db->select('id');
				$this->obj->db->from(DYNAMIC_FORM_TBL);
				$this->obj->db->where('form_name',$form_name);
				$this->obj->db->where('status','1');
				$this->obj->db->where('is_deleted','1');
				$results = $this->obj->db->get();
				
				if($results->num_rows())
				{
					$result['is_support'] = true;
					$result['is_form'] = true;
					$result['form_error'] = "Forn name should be unique";
					return $result; 
				}
				
				// generate code form form.
				$length = rand(4,4);
				$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
				$randomString = '';

				for ($i = 0; $i < $length; $i++) {
					$randomString .= $characters[rand(0, strlen($characters) - 1)];
				}
				
				// script code here
								
				$savedata1['form_name']  		= $form_name;
				$savedata1['form_label']  		= $form_label;
				$savedata1['source_code']  		= "{{FORM_CODE_".strtoupper($randomString)."}}";
				$savedata1['email']  	 		= $this->obj->input->post('email',true);
				$savedata1['status']  	 		= $this->obj->input->post('status',true);
				$savedata1['view_on_left']  	= $this->obj->input->post('view_on_left',true);
				$savedata1['is_deleted']  	 	= 1;
				$savedata1['module_type']  	 	= 1;
				$savedata1['module_controller']	= $form_name;
				$savedata1['module_name']  	 	= $form_label;
				$savedata1['parent_id']  	 	= 0;
				$savedata1['created_date']		= date('Y-m-d H:i:s');
				
				//$qry = $this->obj->db->insert(DYNAMIC_FORM_TBL,$savedata1);
				//$form_id = $this->obj->db->insert_id();
				
				$qry = '';
				
				// create tables form 
				if ($this->obj->db->table_exists(TBL_PREFIX.$form_name))
				{
					$result['form_error'] 	= "form name table already exists.";
					$result['is_support'] 	= true;
					$result['is_form'] 		= true;
					return $result;
				}
				else
				{
					//echo "AYAAAA";die;
					$qry = $this->obj->db->insert(DYNAMIC_FORM_TBL,$savedata1);
					
					$form_id = $this->obj->db->insert_id();
					$this->obj->db->query("CREATE table ".TBL_PREFIX.$form_name." (form_id INT NOT NULL AUTO_INCREMENT, `created_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() , `modified_time` TIMESTAMP on update CURRENT_TIMESTAMP() NULL, `create_by` INT(11) NULL, `updated_by` INT(11) NULL, PRIMARY KEY (form_id)) ENGINE = InnoDB");
				}
								
				if($qry) 
				{
					$scriptCode = '<script>var ajaxurl= "{{base_url}}home/get_formData";var sk_draw_form = null;jQuery(function() {sk_draw_form = new SK_Form();sk_draw_form.init("myForm_'.$randomString.'","realForm_'.$randomString.'","'.$form_id.'");});</script><form id="realForm_'.$randomString.'" action="{{base_url}}home/postData" method="POST" enctype="multipart/form-data"><div id="myForm_'.$randomString.'"></div></form>';
					
					$upda = array();
					$upda['script_code']  = 	$scriptCode;
					
					$this->obj->db->where('id',$form_id);
					$this->obj->db->update(DYNAMIC_FORM_TBL,$upda);
					
					/* $result['is_support'] 	= 	true;
					$savedata['dynamic_from']  		= 	$dynamic_from;
					$savedata['form_id']  			= 	$form_id;
					$this->obj->db->where('id',$support_id);
					$qry = $this->obj->db->update($this->obj->table,$savedata); */
					
					$result['empty'] = FALSE;
					$result['form_id'] = $form_id;
				}
			}
			//pr($result);die;
		return $result;
    }
	
	
	/**
     * add()
     *
     * This function add Support
     * 
     * @access	public
     * @return	boolean data
     */
    public function edit($id) 
    {
        $result['empty'] = TRUE;
        $result['is_support'] = false;
		
			$this->obj->form_validation->set_rules('form_name', 'Form Name', 'trim|xss_clean|required');
			$this->obj->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
			$this->obj->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
			
			if ($this->obj->form_validation->run() == FALSE) 
			{ 
				$result['error_msg'] = validation_errors();
				return $result;
			}
			else 
			{	
				//echo"ayaa";die;
				$form_name = $this->obj->input->post('form_name',true);
				$form_label = ucwords($this->obj->input->post('form_label',true));
				
					
				$this->obj->db->select('id,form_name,form_data');
				$this->obj->db->from(DYNAMIC_FORM_TBL);
				$this->obj->db->where('form_name',$form_name);
				//$this->obj->db->where('status','1');
				$this->obj->db->where('is_deleted','1');
				$results = $this->obj->db->get()->row();
				
				if(!empty($results) && $results->id == $id)
				{
					$result['empty'] = FALSE;
					$result['is_support'] = true;
					
					$savedata1['form_name']  = 	$form_name;
					$savedata1['form_label']  = 	$form_label;
					$savedata1['view_on_left'] = 	$this->obj->input->post('view_on_left',true);
					$savedata1['email']  	 = 	$this->obj->input->post('email',true);
					$savedata1['status']  = 	$this->obj->input->post('status',true);
					
					$this->obj->db->where('id',$id);
					$qry = $this->obj->db->update(DYNAMIC_FORM_TBL,$savedata1);
					
					if(!empty($results->form_data))
					{
						$form = json_decode($results->form_data);
					
						$count = count($form);
						
						// $form[$count-2]->value = $form_name;
						$form->extra[0]->value = $form_name;
						
						$updates = array();
						$updates['form_data'] = json_encode($form);
						
						$this->obj->db->where('id',$results->id);
						$this->obj->db->update('inch_form',$updates);
						$result['empty'] = FALSE;
					}
					//pr($result);die;
					return $result; 
				}
				else
				{
					$this->obj->db->select('id,form_name,form_data');
					$this->obj->db->from(DYNAMIC_FORM_TBL);
					$this->obj->db->where('id',$id);
					//$this->obj->db->where('status','1');
					$this->obj->db->where('is_deleted','1');
					$res = $this->obj->db->get()->row();
					//pr($res);die;
					if ($this->obj->db->table_exists(TBL_PREFIX.$form_name) && $this->obj->db->table_exists($form_name))
					{
						$result['error_msg'] = "form name table already exists.";
						$result['empty'] = true;
						return $result;
					}
					else
					{
						$this->obj->db->query("RENAME TABLE inch_".$res->form_name."  TO inch_".$form_name);
						
					}
					$savedata1['form_name']  = 	$form_name;
					$savedata1['form_label']  = 	$form_label;
					$savedata1['view_on_left']  	 = 	$this->obj->input->post('view_on_left',true);
					$savedata1['email']  = 	$this->obj->input->post('email',true);
					$savedata1['status']  = 	$this->obj->input->post('status',true);
					
					$this->obj->db->where('id',$id);
					$qry = $this->obj->db->update(DYNAMIC_FORM_TBL,$savedata1);
					
					if(!empty($res->form_data))
					{
						$form = json_decode($res->form_data);
					
						$count = count($form);
						
						$form[$count-2]->value = $form_name;
						
						$updates = array();
						$updates['form_data'] = json_encode($form);
						
						$this->obj->db->where('id',$res->id);
						$this->obj->db->update('inch_form',$updates);
					}
				}
				if($qry) 
				{
					$result['empty'] = FALSE;
					$result['form_id'] = $form_id;
				}
			}
			//pr($result);die;
		return $result;
    }
	
    //============Get Form Data===============//
	public function get_form_data($support_id=NULL)
	{
		$qry=$this->obj->db->select("$this->obj->table.dynamic_from,$this->obj->table.dynamic_url,$this->obj->table.form_id,DYNAMIC_FORM_TBL.form_name")->join(DYNAMIC_FORM_TBL,"DYNAMIC_FORM_TBL.id = $this->obj->table.form_id")->get_where($this->obj->table,array("$this->obj->table.id" => $support_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
    //==========Close Get Form Data===========//


    //============Get Form Data===============//
	public function get_form($form_id)
	{
		$qry=$this->obj->db->select('*')->get_where(DYNAMIC_FORM_TBL,array('id' => $form_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
	
	public function get_form_by_name($form_name)
	{
		$qry=$this->obj->db->select('*')->get_where(DYNAMIC_FORM_TBL,array('form_name' => $form_name));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
	
	public function get_json_data($form_id)
	{
		$qry=$this->obj->db->select('*')->get_where(DYNAMIC_FORM_TBL,array('form_id' => $form_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
		
	public function dynamic_list_items($module_name) 
    {
		
		$qry = $this->obj->db->select('*')
			->from(DYNAMIC_FORM_TBL)
			->where('form_name',$module_name)
			->get();
		
		if($qry->num_rows())
		{
			$res 	= $qry->row();
			$table 	= TBL_PREFIX.$res->form_name;
			$module_id = $qry->row()->id;
			$form_data = json_decode($qry->row()->form_data);
		}
		else{
			$table = '';
		}
		$all_form_data = [];
		if(isset($form_data->form_data) && !empty($form_data->form_data))
		{
			foreach ($form_data->form_data as $key1 => $frm) {
		    	if(!empty($frm->elements && count($frm->elements)>0))
		    	{
		    		$all_form_data = array_merge($all_form_data, $frm->elements);
		    	}
		    }
		}

		// pr($all_form_data);die;
	    $form_data = $all_form_data;
		$form_data_count = count($form_data);
		$columns 	= array();
		if(isset($table) && !empty($table))
		{
			$this->obj->db->select('*, form_id as id');
			if(!isset($_GET['all']) || $_GET['all']!=true)
			{
				$this->obj->db->where('created_by', $this->obj->user_id);
			}

			$this->obj->db->from($table);
			$this->obj->db->order_by('form_id','desc');
			$qry 			= $this->obj->db->get();
			$data['result'] = $qry->result_array();
			$query 			= $this->obj->db->query('SELECT FOUND_ROWS() AS `count`');
        	$data["total"]	= $query->row()->count;
			// pr($data['result']);die;

			$data_col_fields = $this->obj->db->list_fields($table);
			if(!empty($form_data))
			{
				foreach($form_data as $form_key=>$form_val){
					if($form_val->type!= 'hidden' && $form_val->view_on_left==1){
						$fld_indx = array_search($form_val->name, $data_col_fields);
						if($fld_indx!='')
						{
							$columns[$data_col_fields[$fld_indx]] = $form_val->label;
						}
					}
				}
			}
			
			$data['all_form_data']	= $all_form_data;
			$data['columns'] 		= $columns;
			$data['module_main_id'] = $module_id;
			$data['module_name'] 	= $res->module_name;
			$data['grid_cols'] 		= $this->obj->get_flexigrid_dynamic_form_cols($data['columns']);
		}
        return $data;
    } 
	
	public function dynamic_list_view($id,$table_id) 
    {
		
		$qry = $this->obj->db->select('*')
						->from(DYNAMIC_FORM_TBL)
						->where('id',$table_id)
						->get();
		
		if($qry->num_rows())
		{
			$table = TBL_PREFIX.$qry->row()->form_name;
		}
		else{
			$table = '';
		}
		
		if(isset($table) && !empty($table))
		{
			$this->obj->db->select('*');
			$this->obj->db->from($table);
			$this->obj->db->where('form_id',$id);
			$qry = $this->obj->db->get();
			if($qry->num_rows())
			{
				$data['data'] = (array)$qry->row();
				$data['columns'] = $this->obj->db->list_fields($table);
			}
		}
        return $data;
    } 
	
	public function dynamic_delete_row($id,$table_id) 
    {
		
		$qry = $this->obj->db->select('*')
						->from(DYNAMIC_FORM_TBL)
						->where('id',$table_id)
						->get();
		
		if($qry->num_rows())
		{
			$table = TBL_PREFIX.$qry->row()->form_name;
		}
		else{
			$table = '';
		}
		//pr($table);die;
		if(isset($table) && !empty($table))
		{
			$this->obj->db->where('form_id',$id);
			$data = $this->obj->db->delete($table);
			
			/* $this->obj->db->select('*');
			$this->obj->db->from($table);
			$this->obj->db->order_by('form_id','desc');
			$qry = $this->obj->db->get();
			if($qry->num_rows())
			{
				$data['data'] = $qry->result();
				$data['columns'] = $this->obj->db->list_fields($table);
			} */
		}
		
		
            
        return $data;
    } 

    public function get_flexigrid_cols()  
    {
           $data = array(
            array(
                "display"   =>lang('id'),
                "name"      =>"id",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('name'),
                "name"      =>"form_label",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('source_code'),
                "name"      =>"source_code",
                "order_by" => "no"
            ),array(
                "display"   =>lang('view_in_left_menu'),
                "name"      =>"view_in_left_menu",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('status'),
                "name"      =>"status",
                "order_by" => "yes"
            )
        );
     
        return $data;       
    }
	
	
    public function get_flexigrid_cols_dynamic_form()  
    {
           $data = array(
            array(
                "display"   =>lang('id'),
                "name"      =>"id",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('field_name'),
                "name"      =>"label",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('field_required'),
                "name"      =>"required",
                "order_by" => "no"
            ),array(
                "display"   =>lang('field_default_value'),
                "name"      =>"value",
                "order_by" => "no"
            ),array(
                "display"   =>lang('view_in_listing'),
                "name"      =>"view_on_left",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('view_in_mobile'),
                "name"      =>"view_in_mobile",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('status'),
                "name"      =>"status",
                "order_by" => "yes"
            )
        );
     
        return $data;       
    }
	
	
	public function get_flexigrid_dynamic_form_cols($cols_arr)  
    {
		//pr($cols_arr);die;
		  // get all display value from name 
		$data = array();
		$i=1;
		foreach($cols_arr as $key => $val){ 
			
			$data[$i]['display'] = $val;
			$data[$i]['name'] = $key;
			$data[$i]['order_by'] = 'no';
			$i++;
		}
         
     //pr($data);die;
        return $data;       
    }

    public function module_list()
    {
    	$result = [];
    	$this->obj->db->select('id,form_name,form_label,parent_id,module_name,module_type,module_controller,order_by,status,is_deleted');
    	$this->obj->db->where('status',1);
    	$this->obj->db->where('is_deleted',1);
    	$this->obj->db->where('parent_id',0);
    	$this->obj->db->order_by('order_by',"ASC");
    	$query =  $this->obj->db->get(DYNAMIC_FORM_TBL);
    	if($query->num_rows()>0)
    	{
    		$result = $query->result();
    		// pr($result);die;
    		foreach ($result as $key => $value) {
    			
    			$this->obj->db->select('id,form_name,form_label,parent_id,module_name,module_type,module_controller,order_by,status,is_deleted');
		    	$this->obj->db->where('status',1);
		    	$this->obj->db->where('is_deleted',1);
		    	$this->obj->db->where('parent_id',$value->id);
		    	$this->obj->db->order_by('order_by',"ASC");
		    	$result[$key]->child_list =  $this->obj->db->get(DYNAMIC_FORM_TBL)->result();
    		}
    	}

    	return $result;
    }

    public function module_save()
    {
    	$data 					= [];
    	$postData 				= $this->obj->input->post();
    	$data['parent_id'] 		= $postData['parent_id'];
    	$data['status'] 		= 1; // static by default
    	$data['is_deleted'] 	= 1; // static by default
    	$data['module_type'] 	= 2; // static by default
    	$data['module_name'] 	= $postData['module_name'];
    	$data['module_controller']=$postData['module_controller'];
    	$this->obj->db->insert(DYNAMIC_FORM_TBL, $data);
    	return $this->obj->db->insert_id();
    }

    public function module_edit()
    {
    	$data 					= [];
    	$postData 				= $this->obj->input->post();
    	$data['parent_id'] 		= $postData['parent_id'];
    	$data['module_name'] 	= $postData['module_name'];
    	$data['module_controller']=$postData['module_controller'];
    	$this->obj->db->where('id',$postData['module_id']);
    	return $this->obj->db->update(DYNAMIC_FORM_TBL, $data);
    }
    
    public function get_task_detail($task=NULL, $column = NULL)
    {
    	$data	= [];
    	$this->obj->db->select('p.project_name, t.task_title');
    	$this->obj->db->join('pms_projects as p','p.form_id=t.project');
    	$this->obj->db->where('t.form_id', $task);
    	return $this->obj->db->get('pms_task as t')->row();
    }

    public function daily_activity_report()
    {
    	// pr($_GET);die;

    	$data	= [];
    	$this->obj->db->select('dar.*,p.project_name, t.task_title,tt.type_name as task_type_name, aps.status_name as approval_status_name');
    	$this->obj->db->join('pms_projects as p','p.form_id=dar.project');
    	$this->obj->db->join('pms_task as t','t.form_id=dar.task');
    	$this->obj->db->join('pms_task_type_master as tt','tt.form_id=dar.task_type');
    	$this->obj->db->join('pms_approval_status_master as aps','aps.form_id=dar.approval_status','left');
    	/*Search*/
    	if(isset($_GET['search']))
    	{
    		$from_date = $this->obj->input->get_post('from_date');
    		$to_date = $this->obj->input->get_post('to_date');
    		$project = $this->obj->input->get_post('project');
    		$approval_status = $this->obj->input->get_post('approval_status');
    		if(isset($from_date) && !empty($from_date) && isset($to_date) && !empty($to_date))
    		{
    			$this->obj->db->where('dar.created_time BETWEEN "'. date('Y-m-d', strtotime($from_date)). '" and "'. date('Y-m-d', strtotime($to_date)).'"');
    		}
    		elseif(isset($from_date) && !empty($from_date))
    		{
    			$this->obj->db->where("dar.created_time>=",$from_date);
    		}
    		elseif(isset($to_date) && !empty($to_date))
    		{
    			$this->obj->db->where("dar.created_time<=",$to_date);
    		}
    		if(isset($project) && !empty($project))
    		{
    			$this->obj->db->where("dar.project",$project);
    		}
    		if(isset($approval_status) && !empty($approval_status))
    		{
    			$this->obj->db->where("dar.approval_status",$approval_status);
    		}
    	}
    	/*Search*/
    	$this->obj->db->where('dar.created_by', $this->obj->user_id);
    	$query =  $this->obj->db->get('pms_daily_activity_report as dar');
    	// echo $this->obj->db->last_query();die;
    	if($query->num_rows()>0)
    	{
    		$data = $query->result();
    	}
    	return $data;
    }

    public function project_list()
    {
    	$data	= [];
    	// $this->obj->db->where('dar.created_by', $this->obj->user_id);
    	$query =  $this->obj->db->get('pms_projects');
    	// echo $this->obj->db->last_query();die;
    	if($query->num_rows()>0)
    	{
    		$data = $query->result();
    	}

    	return $data;
    }

    public function approval_list()
    {
    	$data	= [];
    	// $this->obj->db->where('dar.created_by', $this->obj->user_id);
    	$query =  $this->obj->db->get('pms_approval_status_master');
    	// echo $this->obj->db->last_query();die;
    	if($query->num_rows()>0)
    	{
    		$data = $query->result();
    	}

    	return $data;
    }
    
}