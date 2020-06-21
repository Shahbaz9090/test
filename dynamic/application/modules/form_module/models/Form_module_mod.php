<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 
class Form_module_mod extends CI_Model {
   // public $dynamic_form_tbl = "dynamic_form_master";
	function __construct()
    {
        parent::__construct();
        $this->table_exists_in_db();
        $this->load->library("security");
    }
    
    private function table_exists_in_db()
    {
    	if (!$this->db->table_exists(DYNAMIC_FORM_TBL) )
		{
		  	$sql = "CREATE TABLE ".DYNAMIC_FORM_TBL." (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `form_name` varchar(100) NOT NULL,
				  `source_code` varchar(250) NOT NULL,
				  `script_code` text NOT NULL,
				  `form_data` text NOT NULL,
				  `email` varchar(200) NOT NULL,
				  `status` tinyint(1) NOT NULL COMMENT '1->active,2->inactive',
				  `is_deleted` tinyint(1) NOT NULL COMMENT '1->not delete,2->delete',
				  `created_date` datetime NOT NULL,
				  `view_on_left` enum('1','2') NOT NULL DEFAULT '1' COMMENT '''1''=>\"Show in listing or left menu\",''2''=>''Don''t Show in listing or left menu''',
				  `form_label` varchar(200) NOT NULL,
				  `parent_id` int(11) DEFAULT NULL,
				  `module_name` varchar(200) DEFAULT NULL,
				  `module_type` enum('1','2') DEFAULT NULL COMMENT '1-dynamic,2-static',
				  `module_controller` varchar(200) DEFAULT NULL,
				  `order_by` int(5) DEFAULT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT";
				$status = $this->db->query($sql);
				// echo $this->db->last_query();die;
				if(!$status)
				{
					echo DYNAMIC_FORM_TBL." table not exists and could not be create by system<br>";
					echo "Manual setup to your table";exit;
				}
		}
    }

    public function get_list($id='', $count='', $limit='', $start='')
	{
		if(isset($_GET['search']))
		{
			$name 	= $this->security->xss_clean(trim($this->input->get_post('name')));
			// var_dump($name);die;
			if($name!='')
			{
				$this->db->where("( lower(form_name) LIKE '%".strtolower($name)."%' OR lower(form_label) LIKE '%".strtolower($name)."%' )" );
				$status 	= $this->security->xss_clean(trim($this->input->get_post('status')));
			}
			if($status!='' && is_numeric($status))
			{
				$this->db->where("status",$status);
			}
		}
		if($id!='')
		{
			$this->db->where("id",$id);
		}
		if ($limit != "" && $start != "") {
            $this->db->limit($limit, $start);
        }

        if($limit != '' && $start == '' && $count == '')
        {
            $this->db->limit(PERPAGE, 0);
        }
     	$this->db->select('SQL_CALC_FOUND_ROWS *', false);
        $this->db->where('is_deleted',1);
        $this->db->where('module_type',1);
        $this->db->order_by('id', 'DESC');
        $query =$this->db->get(DYNAMIC_FORM_TBL);
     	// echo $this->db->last_query();die;
     	$data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        return $data;
	}

	public function delete($id)
	{
		$this->db->where('id',$id);
		return $this->db->delete(DYNAMIC_FORM_TBL);
	}
	
	public function add() 
    {
    	// pr($this->security);die;
        $result['empty'] = TRUE;
        $result['is_support'] = false;
		$this->form_validation->set_rules('form_name', 'Form Name', 'trim|required');
		$this->form_validation->set_rules('form_label', 'Form label', 'trim|required');
		if($_POST['email']){
			$this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
		}
		$this->form_validation->set_rules('status', 'Status', 'trim|required');
		if ($this->form_validation->run() == FALSE) 
		{ 
			// pr(validation_errors());die;
			$result['error_msg'] = validation_errors();
			return $result;
		}
		else 
		{	
			$form_name = $this->input->post('form_name',true);
			$form_label = ucwords($this->input->post('form_label',true));
			$this->db->select('id');
			$this->db->from(DYNAMIC_FORM_TBL);
			$this->db->where('form_name',$form_name);
			$this->db->where('status','1');
			$this->db->where('is_deleted','1');
			$results = $this->db->get();
			
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
			$savedata1['email']  	 		= $this->input->post('email',true);
			$savedata1['status']  	 		= $this->input->post('status',true);
			$savedata1['view_on_left']  	= $this->input->post('view_on_left',true);
			$savedata1['is_deleted']  	 	= 1;
			$savedata1['module_type']       = 1;
            $savedata1['module_controller'] = $form_name;
            $savedata1['module_name']       = 'form_module';
            $savedata1['parent_id']         = 11;
            $savedata1['module_icon']       = 'fa fa-th-large';
            $savedata1['action']            = '103,102,104,101,101,101,105,211';
            $savedata1['module_title']      = $form_label;
            $savedata1['parent_id']         = 73;
            $savedata1['created_date']      = date('Y-m-d H:i:s');
			
			//$qry = $this->db->insert(DYNAMIC_FORM_TBL,$savedata1);
			//$form_id = $this->db->insert_id();
			
			$qry = '';
			
			// create tables form 
			if ($this->db->table_exists(TBL_PREFIX.$form_name))
			{
				
				$result['form_error'] 	= "form name table already exists.";
				$result['is_support'] 	= true;
				$result['is_form'] 		= true;
				return $result;
			}
			else
			{
				//echo "AYAAAA";die;
				$qry = $this->db->insert(DYNAMIC_FORM_TBL,$savedata1);
				
				$form_id = $this->db->insert_id();
				$this->db->query("CREATE table ".TBL_PREFIX.$form_name." (form_id INT NOT NULL AUTO_INCREMENT, `created_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(), `modified_time` TIMESTAMP on update CURRENT_TIMESTAMP() NULL, `added_by` INT(11) NULL, `updated_by` INT(11) NULL, `last_ip` VARCHAR(25) NULL, PRIMARY KEY (form_id)) ENGINE = InnoDB");
			}
							
			if($qry) 
			{
				$scriptCode = '<script>var ajaxurl= "{{base_url}}home/get_formData";var sk_draw_form = null;jQuery(function() {sk_draw_form = new SK_Form();sk_draw_form.init("myForm_'.$randomString.'","realForm_'.$randomString.'","'.$form_id.'");});</script><form id="realForm_'.$randomString.'" action="{{base_url}}home/postData" method="POST" enctype="multipart/form-data"><div id="myForm_'.$randomString.'"></div></form>';
				
				$upda = array();
				$upda['script_code']  = 	$scriptCode;
				
				$this->db->where('id',$form_id);
				$this->db->update(DYNAMIC_FORM_TBL,$upda);
				
				/* $result['is_support'] 	= 	true;
				$savedata['dynamic_from']  		= 	$dynamic_from;
				$savedata['form_id']  			= 	$form_id;
				$this->db->where('id',$support_id);
				$qry = $this->db->update($this->table,$savedata); */
				
				$result['empty'] = FALSE;
				$result['form_id'] = $form_id;
			}
		}
		//pr($result);die;
		return $result;
    }

    function get_flexigrid_cols_dynamic_form()  
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
    
    public function get_form($form_id)
	{
		$qry=$this->db->select('*')->get_where(DYNAMIC_FORM_TBL,array('id' => $form_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}

	public function edit($id) 
    {
        $result['empty'] = TRUE;
        $result['is_support'] = false;
		$this->form_validation->set_rules('form_name', 'Form Name', 'trim|xss_clean|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email');
		$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
		
		if ($this->form_validation->run() == FALSE) 
		{ 
			$result['error_msg'] = validation_errors();
			return $result;
		}
		else 
		{	
			//echo"ayaa";die;
			$form_name = $this->input->post('form_name',true);
			$form_label = ucwords($this->input->post('form_label',true));
			$this->db->select('id,form_name,form_data');
			$this->db->from(DYNAMIC_FORM_TBL);
			$this->db->where('form_name',$form_name);
			//$this->db->where('status','1');
			$this->db->where('is_deleted','1');
			$results = $this->db->get()->row();
			
			if(!empty($results) && $results->id == $id)
			{
				$result['empty'] 			= FALSE;
				$result['is_support'] 		= TRUE;
				$savedata1['form_name']		= $form_name;
				$savedata1['form_label']	= $form_label;
				$savedata1['module_controller']	= $form_name;
				$savedata1['module_name']  	 	= $form_label;
				$savedata1['view_on_left'] 	= $this->input->post('view_on_left',TRUE);
				$savedata1['email']  	 	= $this->input->post('email',TRUE);
				$savedata1['status']  		= $this->input->post('status',TRUE);
				
				$this->db->where('id',$id);
				$qry = $this->db->update(DYNAMIC_FORM_TBL,$savedata1);
				
				if(!empty($results->form_data))
				{
					$form 		= json_decode($results->form_data);
					$form->extra[0]->value 	= $form_name;
					$updates 	= array();
					$updates['form_data'] 	= json_encode($form);
					
					$this->db->where('id',$results->id);
					$this->db->update(DYNAMIC_FORM_TBL, $updates);
					$result['empty'] = FALSE;
				}
				//pr($result);die;
				return $result; 
			}
			else
			{
				$this->db->select('id,form_name,form_data');
				$this->db->from(DYNAMIC_FORM_TBL);
				$this->db->where('id',$id);
				//$this->db->where('status','1');
				$this->db->where('is_deleted','1');
				$res = $this->db->get()->row();
				//pr($res);die;
				if ($this->db->table_exists(TBL_PREFIX.$form_name) && $this->db->table_exists($form_name))
				{
					$result['error_msg'] = "form name table already exists.";
					$result['empty'] = true;
					return $result;
				}
				else
				{
					$this->db->query("RENAME TABLE ".TBL_PREFIX.$res->form_name."  TO ".TBL_PREFIX.$form_name);
				}
				$savedata1['form_name']  	= 	$form_name;
				$savedata1['form_label']  	= 	$form_label;
				$savedata1['view_on_left']	= 	$this->input->post('view_on_left',true);
				$savedata1['email']  		= 	$this->input->post('email',true);
				$savedata1['status']  		= 	$this->input->post('status',true);
				$this->db->where('id',$id);
				$qry = $this->db->update(DYNAMIC_FORM_TBL, $savedata1);
				
				if(!empty($res->form_data))
				{
					$form = json_decode($results->form_data);
					$form->extra[0]->value = $form_name;
					$updates = array();
					$updates['form_data'] = json_encode($form);
					$this->db->where('id',$results->id);
					$this->db->update(DYNAMIC_FORM_TBL, $updates);
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

	public function update($id,$data)
	{
		$this->db->where('id', $id);
		return $this->db->update(DYNAMIC_FORM_TBL, $data);
	}


}