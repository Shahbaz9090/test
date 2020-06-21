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
	
	
    var $table = "inch_support";
    var $inch_form = "inch_form";
	public $per_page  = "per_page";
    
	/**
	 * Constructor
	 */     
    
	function __construct()
    {
        parent::__construct();
    }
    
	public function ajax_list_items($text, $limit, $offset, $order_by, $order, $table_name) 
    {   
 		//

        //$this->db->limit($limit, $offset);
        $text=strtolower(trim($text));
		$uri = $this->uri->segment(1);
		$uri1 = $this->uri->segment(2);
		$uri2 = $this->uri->segment(3);
		
		$module_name = $table_name;
		$controllerInfo=$uri."/".$uri1;
        $controllerInfo1=$uri1."/".$uri2;
        if($controllerInfo == 'form_module/list_items'){
		$this->db->select('SQL_CALC_FOUND_ROWS inch_form.*', false);
        if($text!='')
        {
            $this->db->like('form_name',$text);
        }
        $offset = ($offset - 1) * $limit;
        $this->db->limit($limit, $offset);
        filter_data($this->inch_form); 
        $this->db->from($this->inch_form);
        $this->db->where('is_deleted',1);
        $this->db->where('module_type',1);
        $this->db->order_by('form_id', 'DESC');
        
        $query =$this->db->get();
        //echo $this->db->last_query();die;
        
        if($text!='')
        {
            $this->db->like('form_name',$text);
        }
        if($order_by && $order)
            $this->db->order_by($order_by, $order);


        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset; 
		}else{   
				$qry = $this->db->select("*",false)
							->from($this->inch_form)
							->where('form_name',$module_name)
							->get();
			//$data = json_decode('{"setting":{"type":"settings","position":"label-left","labelWidth":"150","inputWidth":"350"},"extra":[{"type":"hidden","name":"form_name","value":"spares_turbine_make"},{"type":"button","name":"submit","value":"submit","offsetLeft":"45"}],"form_data":[{"block":"default","elements":[{"type":"input","data-input":"text","label":"Name","name":"name","view_in_mobile":"1","view_on_left":"1","status":"1","values":"","required":"true","validate":"NotEmpty"},{"type":"select","data-input":"select","label":"Status","name":"status","view_in_mobile":"1","view_on_left":"1","status":"1","values":"","required":"true","validate":"NotEmpty","options":[{"text":"Active","value":"1"},{"text":"Inactive","value":"2"}]}]}]}');
			//pr($data);die;
			//pr(json_decode($qry->row()->form_data));die;
			//pr($qry->row());die;
			if($qry->num_rows())
			{
				$table = "inch_".$qry->row()->form_name;
				$module_id = $qry->row()->id;
				$form_data = json_decode($qry->row()->form_data);
			}
			else{
				$table = '';
			}
			//pr($form_data);die;
			$all_form_data = [];
			foreach ($form_data->form_data as $key1 => $frm) {
				if(!empty($frm->elements && count($frm->elements)>0))
				{
					$all_form_data = array_merge($all_form_data, $frm->elements);
				}
			}

			$form_data = $all_form_data;
			$form_data_count = count($form_data);
			
			// pr($form_data);die;
			/*unset($form_data[0]);
			unset($form_data[$form_data_count-1]);
			unset($form_data[$form_data_count-1]);
			*/
			if(!empty($form_data)){
				
				$show_listing_fields = array();
				$display_values_arr = array();
				array_push($show_listing_fields,'1');
				array_push($display_values_arr,'Id');
				foreach($form_data as $form_key=>$form_val){
					if($form_val->type!= 'hidden'){
						array_push($show_listing_fields,$form_val->view_on_left);
						array_push($display_values_arr,$form_val->label);
					}
				}
			}
			// pr($form_data);
			// pr($show_listing_fields);
			// pr($display_values_arr);die;
			if(isset($table) && !empty($table))
			{
				$this->db->select("SQL_CALC_FOUND_ROWS *, CASE WHEN status = 1 THEN 'Active' WHEN status = 2 THEN 'Inactive' WHEN status = 0 THEN 'Inactive' ELSE 'Unknown' END AS status", FALSE);
				if($text)
				{   
					switch ($table) {
						case "inch_emailsmtpuserpass":
							$where = "( (email_id LIKE '%$text%') OR (type LIKE '%$text%'))";
							$this->db->where($where);
							break;
						case "inch_bypass_permission":
							$where = "( (controller LIKE '%$text%') OR (method LIKE '%$text%'))";
							$this->db->where($where);
							break;
						case "inch_hsn_code_master":
							$where = "( (name LIKE '%$text%') OR (hsn_no LIKE '%$text%') OR (customs_duty LIKE '%$text%') OR (gst LIKE '%$text%'))";
							// $where = "( (e.from_client LIKE '%$change_formate%') )";
				            $this->db->where($where);
							//$this->db->like("CONCAT(name,hsn_no,customs_duty,gst)",$text);
							break;
						default:
						$where = "( (name LIKE '%$text%'))";
							// $where = "( (e.from_client LIKE '%$change_formate%') )";
				            $this->db->where($where);
						break;
					}
				
			}
				
				$this->db->from($table);
				// var_dump($offset);die;
				$offset = ($offset - 1) * $limit;
		        if($limit)
		        {
		            $this->db->limit($limit,$offset);
		        }
				$this->db->order_by($order_by,$order);
				$qry = $this->db->get();
				// pr($this->db->last_query())

					$data['result'] = $qry->result();
					$query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

					$data["total"] = $query->row()->count;
					$data['offset'] = $offset; 
					//$data['columns'] = $this->db->list_fields($table);
					$data_col_fields = $this->db->list_fields($table);
					$only_visible_keys = array();
					foreach($show_listing_fields as $lf_key=>$lf_val){
						if($lf_val=='1'){
							array_push($only_visible_keys,$lf_key);
						}
					}
					
					$final_cols_arr =array();
					//pr($display_values_arr);die;
					foreach($only_visible_keys  as $df_key=>$df_val){
						array_push($final_cols_arr,$data_col_fields[$df_key]);
					}
					$final_cols_arr_new = array_combine( $final_cols_arr, $display_values_arr );
					$data['columns'] = $final_cols_arr_new;
					//$data['display'] = $display_values_arr;
					//pr($data['columns']);
					
					$data['module_main_id'] = $module_id;
					
					$data['grid_cols'] =  $this->get_flexigrid_dynamic_form_cols($data['columns']);
				
			}
		
		}
        // pr($data);die;   
        return $data;
    }
	

//=====================Add Support====================//
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
		
			$this->form_validation->set_rules('form_name', 'Form Name', 'trim|xss_clean|required');
			if($_POST['email']){
				$this->form_validation->set_rules('email', 'Email', 'trim|xss_clean|valid_email|required');
			}
			$this->form_validation->set_rules('status', 'Status', 'trim|xss_clean|required');
			
			if ($this->form_validation->run() == FALSE) 
			{ 
				$result['error_msg'] = validation_errors();
				return $result;
			}
			else 
			{	
				
				$form_name = $this->input->post('form_name',true);
				$form_label = ucwords($this->input->post('form_label',true));
					
				$this->db->select('id');
				$this->db->from($this->inch_form);
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
				
				
				
				$savedata1['form_name']  = 	$form_name;
				$savedata1['form_label']  = 	$form_label;
				$savedata1['source_code']  = 	"{{FORM_CODE_".strtoupper($randomString)."}}";
				
				$savedata1['email']  	 = 	$this->input->post('email',true);
				$savedata1['status']  	 = 	$this->input->post('status',true);
				$savedata1['view_on_left']  	 = 	$this->input->post('view_on_left',true);
				$savedata1['is_deleted']  	 = 	1;
				$savedata1['module_type']  	 	= 	1;
				$savedata1['module_controller']	= 	$form_name;
				$savedata1['module_name']  	 	= 	'form_module';
				$savedata1['parent_id']  	 	= 	73;
				$savedata1['module_title']  	= 	$form_label;
				$savedata1['module_icon']  	 	= 	'fa fa-user';
				$savedata1['action']  	 		= 	'103,102,104,101,101,101,105,211';
				$savedata1['created_date']  	= 	date('Y-m-d H:i:s');
				//pr($savedata1);die;
				//$qry = $this->db->insert($this->inch_form,$savedata1);
				//$form_id = $this->db->insert_id();
				
				$qry = '';
				
				// create tables form 
				if ($this->db->table_exists("inch_".$form_name))
				{
					
					$result['form_error'] = "form name table already exists.";
					$result['is_support'] = true;
					$result['is_form'] = true;
					return $result;
				}
				else
				{
					//echo "AYAAAA";die;
					$qry = $this->db->insert($this->inch_form,$savedata1);
					
					$form_id = $this->db->insert_id();
					$this->db->query("CREATE table inch_".$form_name." (form_id INT NOT NULL AUTO_INCREMENT, `create_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP() , `modified_time` TIMESTAMP on update CURRENT_TIMESTAMP() NULL, PRIMARY KEY (form_id)) ENGINE = InnoDB");
				}
								
				if($qry) 
				{
					$scriptCode = '<script>var ajaxurl= "{{base_url}}home/get_formData";var sk_draw_form = null;jQuery(function() {sk_draw_form = new SK_Form();sk_draw_form.init("myForm_'.$randomString.'","realForm_'.$randomString.'","'.$form_id.'");});</script><form id="realForm_'.$randomString.'" action="{{base_url}}home/postData" method="POST" enctype="multipart/form-data"><div id="myForm_'.$randomString.'"></div></form>';
					
					$upda = array();
					$upda['script_code']  = 	$scriptCode;
					
					$this->db->where('id',$form_id);
					$this->db->update($this->inch_form,$upda);
					
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
				$this->db->from($this->inch_form);
				$this->db->where('form_name',$form_name);
				//$this->db->where('status','1');
				$this->db->where('is_deleted','1');
				$results = $this->db->get()->row();
				
				if(!empty($results) && $results->id == $id)
				{
					$result['empty'] = FALSE;
					$result['is_support'] = true;
					
					$savedata1['form_name']  = 	$form_name;
					$savedata1['form_label']  = 	$form_label;
					$savedata1['view_on_left'] = 	$this->input->post('view_on_left',true);
					$savedata1['email']  	 = 	$this->input->post('email',true);
					$savedata1['status']  = 	$this->input->post('status',true);
					
					$this->db->where('id',$id);
					$qry = $this->db->update($this->inch_form,$savedata1);
					
					if(!empty($results->form_data))
					{
						$form = json_decode($results->form_data);
					
						$count = count($form);
						
						// $form[$count-2]->value = $form_name;
						$form->extra[0]->value = $form_name;
						
						$updates = array();
						$updates['form_data'] = json_encode($form);
						
						$this->db->where('id',$results->id);
						$this->db->update('inch_form',$updates);
						$result['empty'] = FALSE;
					}
					//pr($result);die;
					return $result; 
				}
				else
				{
					$this->db->select('id,form_name,form_data');
					$this->db->from($this->inch_form);
					$this->db->where('id',$id);
					//$this->db->where('status','1');
					$this->db->where('is_deleted','1');
					$res = $this->db->get()->row();
					//pr($res);die;
					if ($this->db->table_exists("inch_".$form_name) && $this->db->table_exists($form_name))
					{
						$result['error_msg'] = "form name table already exists.";
						$result['empty'] = true;
						return $result;
					}
					else
					{
						$this->db->query("RENAME TABLE inch_".$res->form_name."  TO inch_".$form_name);
						
					}
					$savedata1['form_name']  = 	$form_name;
					$savedata1['form_label']  = 	$form_label;
					$savedata1['view_on_left']  	 = 	$this->input->post('view_on_left',true);
					$savedata1['email']  = 	$this->input->post('email',true);
					$savedata1['status']  = 	$this->input->post('status',true);
					
					$this->db->where('id',$id);
					$qry = $this->db->update($this->inch_form,$savedata1);
					
					if(!empty($res->form_data))
					{
						$form = json_decode($res->form_data);
					
						$count = count($form);
						
						$form[$count-2]->value = $form_name;
						
						$updates = array();
						$updates['form_data'] = json_encode($form);
						
						$this->db->where('id',$res->id);
						$this->db->update('inch_form',$updates);
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
		$qry=$this->db->select("$this->table.dynamic_from,$this->table.dynamic_url,$this->table.form_id,$this->inch_form.form_name")->join($this->inch_form,"$this->inch_form.id = $this->table.form_id")->get_where($this->table,array("$this->table.id" => $support_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
//==========Close Get Form Data===========//


//============Get Form Data===============//
	public function get_form($form_id)
	{
		$qry=$this->db->select('*')->get_where($this->inch_form,array('id' => $form_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
	
	public function get_json_data($form_id)
	{
		$qry=$this->db->select('*')->get_where($this->inch_form,array('form_id' => $form_id));
		if($qry->num_rows())
		{
			return $qry->row();
		}
	}
	
	
	
	public function dynamic_list_items($module_name, $offset, $limit, $is_export=NULL, $items_data=NULL, $text=NULL) 
    { 
		//pr($module_name);die;	
		$qry = $this->db->select('*')
						->from($this->inch_form)
						->where('form_name',$module_name)
						->get();
		//$data = json_decode('{"setting":{"type":"settings","position":"label-left","labelWidth":"150","inputWidth":"350"},"extra":[{"type":"hidden","name":"form_name","value":"india_bank_name"},{"type":"button","name":"submit","value":"submit","offsetLeft":"45"}],"form_data":[{"block":"default","elements"[{"type":"input","label":"Name","data-input":"text","name":"name","view_in_mobile":"1","view_on_left":"1","status":"1","values":"","required":"true","validate":"NotEmpty","unique":"true"},{"type":"select","data-input":"select","label":"Status","name":"status","view_in_mobile":"1","view_on_left":"1","status":"1","values":"","required":"false","validate":"","options":[{"text":"Active","value":"1"},{"text":"Inactive","value":"2"}]}]}]}]}');
        //pr($data);die;
		//pr($qry->row()->form_data);die;
		if($qry->num_rows())
		{
			$table = "inch_".$qry->row()->form_name;
			$module_id = $qry->row()->id;
			$form_data = json_decode($qry->row()->form_data);
		}
		else{
			$table = '';
		}
		//pr($form_data);die;
		$all_form_data = [];
		foreach ($form_data->form_data as $key1 => $frm) {
	    	if(!empty($frm->elements && count($frm->elements)>0))
	    	{
	    		$all_form_data = array_merge($all_form_data, $frm->elements);
	    	}
	    }

	    $form_data = $all_form_data;
		$form_data_count = count($form_data);
		
	    // pr($form_data);die;
		/*unset($form_data[0]);
		unset($form_data[$form_data_count-1]);
		unset($form_data[$form_data_count-1]);
		*/
		if(!empty($form_data)){
			
			$show_listing_fields = array();
			$display_values_arr = array();
			array_push($show_listing_fields,'1');
			array_push($display_values_arr,'Id');
			foreach($form_data as $form_key=>$form_val){
				if($form_val->type!= 'hidden'){
					array_push($show_listing_fields,$form_val->view_on_left);
					array_push($display_values_arr,$form_val->label);
				}
			}
		}
		// pr($form_data);
		// pr($show_listing_fields);
		// pr($display_values_arr);die;
		if(isset($table) && !empty($table))
		{
			$this->db->select("SQL_CALC_FOUND_ROWS *, CASE WHEN status = 1 THEN 'Active' WHEN status = 2 THEN 'Inactive' WHEN status = 0 THEN 'Inactive' ELSE 'Unknown' END AS status", FALSE);
			$this->db->from($table);
			if(isset($is_export) && $is_export==true && isset($items_data) &&  !empty($items_data))
	        {
	            $this->db->where_in("form_id", $items_data);
	        }
	        $offset = ($offset - 1) * $limit;
	        if($limit)
	        {
	            $this->db->limit($limit, $offset);
	        }
			$this->db->order_by('form_id','desc');
			$qry = $this->db->get();
				$data['result'] = $qry->result();
				$query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
		        $data["total"] = $query->row()->count;
		        $data['offset'] = $offset;
				// echo $this->db->last_query();die;
				//$data['columns'] = $this->db->list_fields($table);
				$data_col_fields = $this->db->list_fields($table);
				$only_visible_keys = array();
				foreach($show_listing_fields as $lf_key=>$lf_val){
					if($lf_val=='1'){
						array_push($only_visible_keys,$lf_key);
					}
				}
				
				$final_cols_arr =array();
				// pr($display_values_arr);die;
				foreach($only_visible_keys  as $df_key=>$df_val){
					array_push($final_cols_arr,$data_col_fields[$df_key]);
				}
				$final_cols_arr_new = array_combine( $final_cols_arr, $display_values_arr );
				$data['columns'] = $final_cols_arr_new;
				//$data['display'] = $display_values_arr;
				// pr($data_col_fields);die;
				
				$data['module_main_id'] = $module_id;
				
				$data['grid_cols'] =  $this->get_flexigrid_dynamic_form_cols($data['columns']);
			
		}
		
		 //pr($data);die;
         return $data;
    } 
	
	public function dynamic_list_view($id,$table_id) 
    {
		
		$qry = $this->db->select('*')
						->from($this->inch_form)
						->where('id',$table_id)
						->get();
		
		if($qry->num_rows())
		{
			$table = "inch_".$qry->row()->form_name;
		}
		else{
			$table = '';
		}
		
		
		
		if(isset($table) && !empty($table))
		{
			$this->db->select('*');
			$this->db->from($table);
			$this->db->where('form_id',$id);
			$qry = $this->db->get();
			if($qry->num_rows())
			{
				$data['data'] = (array)$qry->row();
				$data['columns'] = $this->db->list_fields($table);
			}
		}
		
		
            
        return $data;
    } 
	
	
	public function dynamic_delete_row($id,$table_id) 
    {
		
		$qry = $this->db->select('*')
						->from($this->inch_form)
						->where('id',$table_id)
						->get();
		
		if($qry->num_rows())
		{
			$table = "inch_".$qry->row()->form_name;
		}
		else{
			$table = '';
		}
		//pr($table);die;
		if(isset($table) && !empty($table))
		{
			$this->db->where('form_id',$id);
			$data = $this->db->delete($table);
			
			/* $this->db->select('*');
			$this->db->from($table);
			$this->db->order_by('form_id','desc');
			$qry = $this->db->get();
			if($qry->num_rows())
			{
				$data['data'] = $qry->result();
				$data['columns'] = $this->db->list_fields($table);
			} */
		}
		
		
            
        return $data;
    } 
	

function get_flexigrid_cols()  
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
	
	
	function get_flexigrid_dynamic_form_cols($cols_arr)  
    {
		//pr($cols_arr);die;
		  // get all display value from name 
		$data = array();
		$i=1;
		foreach($cols_arr as $key => $val){ 
			
			$data[$i]['display'] = $val;
			$data[$i]['name'] = $key;
			$data[$i]['order_by'] = 'yes';
			$i++;
		}
         
     //pr($data);die;
        return $data;       
    }

    public function module_list()
    {
    	$result = [];
    	$this->db->select('id,form_name,form_label,parent_id,module_name,module_type,module_controller,order_by,status,is_deleted');
    	$this->db->where('status',1);
    	$this->db->where('is_deleted',1);
    	$this->db->where('parent_id',0);
    	$this->db->order_by('order_by',"ASC");
    	$query =  $this->db->get($this->inch_form);
    	if($query->num_rows()>0)
    	{
    		$result = $query->result();
    		// pr($result);die;
    		foreach ($result as $key => $value) {
    			
    			$this->db->select('id,form_name,form_label,parent_id,module_name,module_type,module_controller,order_by,status,is_deleted');
		    	$this->db->where('status',1);
		    	$this->db->where('is_deleted',1);
		    	$this->db->where('parent_id',$value->id);
		    	$this->db->order_by('order_by',"ASC");
		    	$result[$key]->child_list =  $this->db->get($this->inch_form)->result();
    		}
    	}

    	return $result;
    }

    public function module_save()
    {
    	$data 					= [];
    	$postData 				= $this->input->post();
    	$data['parent_id'] 		= $postData['parent_id'];
    	$data['status'] 		= 1; // static by default
    	$data['is_deleted'] 	= 1; // static by default
    	$data['module_type'] 	= 2; // static by default
    	$data['module_name'] 	= $postData['module_name'];
    	$data['module_controller']=$postData['module_controller'];
    	$this->db->insert($this->inch_form, $data);
    	return $this->db->insert_id();
    }

    public function module_edit()
    {
    	$data 					= [];
    	$postData 				= $this->input->post();
    	$data['parent_id'] 		= $postData['parent_id'];
    	$data['module_name'] 	= $postData['module_name'];
    	$data['module_controller']=$postData['module_controller'];
    	$this->db->where('id',$postData['module_id']);
    	return $this->db->update($this->inch_form, $data);
    }
    
	/**
	 * @function Name   update()
	 * @purpose         to update a record 
	 * @return			boolean
	 * @created         2 May 2013
	 */
 
    function insert_perPage($array){		
		$query=$this->db->insert_string($this->per_page,$array); 
		$result=$this->db->query($query);
		if($result){			
			return true;
		}else{			
			return false;
		}	
    }

    function import($data,$module_name)
	 {
	    $this->db->insert('inch_'.$module_name, $data);
	   
	 }
} //=========End Class==============//