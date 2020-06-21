<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		
 * @subpackage	Models
 * @category	email_template
 * @author		Prabhakar Ram
 * @website		http://www.onlienprabhakar.com
 * @email_template     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Email_Template_mod extends CI_Model {

    public $table     = "email_template";
	public $per_page  = "per_page";
   
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }
    
    // ------------------------------------------------------------------------

    /**
     * Add email_template
     *
     * This function Add email_template
     * 
     * @access	public
     * @return	mixed Array 
     */     
    function add()
    {
       
		$this->form_validation->set_rules('name', lang('name'), 'trim|required|');
		 if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        //$industry_arr = $this->input->post('industry',TRUE);
		//$industry_str = implode(',',$industry_arr);
        $data['category']              = $this->input->post('category',TRUE);
        $data['name']                   = $this->input->post('name',TRUE);
        $data['notes']               	= $this->input->post('notes',TRUE);
		//pr($data);die;
        set_common_insert_value();        
        $this->db->insert($this->table,$data);           
        $id = $this->db->insert_id();
        
        add_report($id);
        
        set_flashdata("success",lang('success'));
        return $id;
    }
    

    // ------------------------------------------------------------------------

    /**
     * Get Company
     *
     * This function Get Company search by company id
     * 
     * @access	public
     * @return	Object 
     */     
    function get($id = NULL)
    {  
        filter_data('c');
        
        $this->db->select('c.*,ct.name as category_name');
		$this->db->join("inch_email_template_category ct" , 'ct.form_id=c.category');
		$this->db->from('email_template c');
		//$this->db->join("industry in" , 'c.industry=in.id');
		$this->db->where('c.id',$id);
		$query = $this->db->get();
        if($query->num_rows() > 0)
           $query = $query->row();
		return $query;
        
        //show_404();
    }
	
	function get_email_template_category()
    {
		$this->db->select("form_id,name");
		$this->db->order_by("name","asc");
        $result = $this->db->get("inch_email_template_category");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    
    
    
    // ------------------------------------------------------------------------

    /**
     * Get Ajax Companies
     *
     * This function Get Companies with Search and offset functions 
     * 
     * @access	public
     * @return	Object 
     */     
    function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc') {
        $offset = ($offset - 1) * $limit;

        $this->db->limit($limit, $offset);
        $text=strtolower(trim($text));

        if($text) {
            $this->db->like("CONCAT(c.name,c.notes,ct.name)",
                $text);
        }

        if($order_by && $order)
            $this->db->order_by($order_by, $order);

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
        filter_data($this->table);      
        //$query = $this->db->get();
       // pr($query->result());exit;
        //echo $this->db->last_query();exit;
		
		$this->db->select('SQL_CALC_FOUND_ROWS c.id as ids,c.*,ct.name as category_name',false);
		$this->db->join("inch_email_template_category ct" , 'ct.form_id=c.category');
		$this->db->from('email_template c');
		$query = $this->db->get();
		//echo $this->db->last_query();die;
		//$this->db->select("id,name as industry_name");
		//$this->db->order_by("name","asc");
       // $query1 = $this->db->get("industry");
		//$data['industry'] = $query1->result();
        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
		//pr($data);die;
        return $data;
    }
    
    
    
    
    //----------------------------------------------------------------------------------
     /**
     * Update Company
     *
     * This function Update Company Name
     * 
     * @access	public
     * @return	int 
     */     
    function update($id = NULL)
    {
		
			$this->form_validation->set_rules('name', lang('name'), 'trim|required');
			//$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
			
			if ($this->form_validation->run() == FALSE)
			{
				set_flashdata("error",validation_errors());
				return FALSE;
			} 
			
			//$industry_arr = $this->input->post('industry',TRUE);
			//$industry_str = implode(',',$industry_arr);
			$data['category']           			= $this->input->post('category',TRUE);
			$data['name']           			= $this->input->post('name',TRUE);
			$data['notes']           			= $this->input->post('notes',TRUE);
			

        $this->db->where("id",$id);
        filter_data();
        set_common_update_value();
        $r = $this->db->update($this->table,$data);
        
        update_report($id);
        
        if($r)
            set_flashdata("success",lang('updated'));
                    
        return $r;
    }
    
   
    function get_flexigrid_cols()  
    {
           $data = array(
            array(
                "display"   =>lang('name'),
                "name"      =>"name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('category'),
                "name"      =>"category_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('doc_notes'),
                "name"      =>"notes",
                "order_by" => "yes"
            )
        );
     
        return $data;       
    }
	//----------------------------------------------------------------------------------
     /**
     * Get  per page listing
     * This function get perpage record in flexigrid     
     * @access	public
     * @return	int 
     */
     
     function perPage($user_id){    		
		$controllerInfo=$this->uri->segment(1)."/".$this->uri->segment(2);
		$this->db->where("action",$controllerInfo);
		$this->db->where("user_id",$user_id);
        $query =$this->db->get($this->per_page);		
		if($query->num_rows >0){
			return $query->row()->records;
		}else{
			return false;
		}
     }

	 // ------------------------------------------------------------------------

	 /**
	 * @function Name   update()
	 * @purpose         to update a record 
	 * @return			boolean
	 * @created         2 May 2013
	 */
 
    function update_perPage($array,$userId){	
        $controllerInfo=$this->uri->segment(1)."/".$this->uri->segment(2);
		$where="action = '$controllerInfo' AND user_id = $userId";
		$query=$this->db->update_string($this->per_page,$array,$where); 
		$result=$this->db->query($query);
		if($result){			
			return true;
		}else{			
			return false;
		}	
    }

	// ------------------------------------------------------------------------

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
	
	/**
	 * @function Name   export()
	 * @purpose         to export a record 
	 * @return			boolean
	 * @created         2 Aug 2013
	 */
	function export(){
		$items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);

		$this->db->select('c.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ind.name as industry_name');
		$this->db->from('companies c');
		$this->db->join("industry ind" , 'c.industry=ind.id');
		$this->db->join("countries co" , 'co.id=c.country');
		$this->db->join("states st" , 'st.id=c.state_comp');
		$this->db->join("cities ct" , 'ct.id=c.city_comp');
		$this->db->where_in("c.id",$items_data);
		$query = $this->db->get();

		$data= $query->result_array();	
		//pr($data);die;
		return $data;
	}
	
	// fetch the state according to country
	
	function fetch_state($country_id){
       
	   if(!empty($country_id)){
		   $country_ids=explode(',',$country_id);
	   }
        $this->db->where_in('country_id', $country_ids);
		$this->db->where('status', '1');
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get('states');
		//echo $this->db->last_query();die;
        if($query->num_rows()>0){
        $output = '<option value="">Select</option>';
        foreach($query->result() as $row){
           // pr($row);die;
		    //$output .= '';
            $output .= '<option value="'.$row->id.'">'.$row->state_name.'</option>';
        }
        //pr($output);die;
		}else{
			$output .= '<option value="">No state found</option>';
		}
        return $output;
    }
	
	// fetch the city according to country
	
	function fetch_city($state_id){
       
	   if(!empty($state_id)){
		   $state_ids=explode(',',$state_id);
	   }
	    $this->db->where('status', '1');
        $this->db->where_in('state_id', $state_ids);
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('cities');
		//echo $this->db->last_query();die;
        if($query->num_rows()>0){
        $output = '<option value="">Select</option>';
        foreach($query->result() as $row){
            //pr($row);die;
			//$output .= '';
            $output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
        }
        }else{
			$output .= '<option value="">No city found</option>';
		}
        return $output;
    }
    
    public function check_company_existance($name) {
        //$database=DEFAULT_DATABASE;
        $query=$this->db->query("SELECT id FROM companies WHERE name='$name'");
        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
    }
	
	public function check_client_id_existance($client_id) {
        //$database=DEFAULT_DATABASE;
        $query=$this->db->query("SELECT id FROM companies WHERE client_id='$client_id'");
        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
    }
	
	/**
     * Update Status of contact
     *
     * This function Update Status Company Contact
     * 
     * @access	public
     * @return	int currentuserinfo()->id
     */     
    function status_update($id  =NULL,$status)
    {
		if($status=='0')
		{
			$status =1;
		}
		else
		{
			$status =0;
		}
		$user_id= currentuserinfo()->id;
		foreach($this->session->userdata('child_list') as $row)		
		{
			$rows[]=str_replace("$user_id","", "$row");
			
		}
	
        //$this->db->where('site_id',current_site_id());
		$this->db->where('id',$id);

		$data['status']= $status;
        $r = $this->db->update($this->table,$data);  
		//echo $this->db->last_query();exit;

      if($this->db->affected_rows()>=1)
	 	{
			set_flashdata("success",lang('updated')); 

		}else{
			set_flashdata("error",lang('permisson'));
		}      
        return $r;
		
    }

    public function get_table_name(){
		$this->db->where('is_deleted','1');
        $this->db->select("*");
		$result = $this->db->get('inch_form');
        if ($result->num_rows > 0) {
            return $result->result();
        }
    }

    /**
     * addCommon Data
     *
     * This function save dynamic fields data of lead form
     * 
     * @access  public
     * @return  TRUE or FALSE 
     */
    function addCommon($data = array()) {
        //pr($data);die;
        $leadOthers_plc = _otherFieldsData('lead_sales_pcb_common_plc', 'lead_id', $data['lead_id']);
        $leadOthers_actuator = _otherFieldsData('lead_sales_pcb_common_actuator', 'lead_id', $data['lead_id']);
        $leadOthers_vfd = _otherFieldsData('lead_sales_pcb_common_vfd', 'lead_id', $data['lead_id']);
        //pr($leadOthers_plc);die;
        $data['modified'] = _dateTime();
        if ($leadOthers_plc) {
                //inserting all varient in table
             $len_plc = $data['open_plc_varient_count'];
                for ($i = 0; $i < $len_plc; $i++) {
                if ($data['plc_varient_all_ids'][$i] != '') {
                $plc_varient_id_up = $_POST['plc_varient_all_ids'][$i];
                $varient_menu_plc['lead_id'] = $data['lead_id'];
                $varient_menu_plc['company_id'] = $data['company_id'];
                $varient_menu_plc['modified'] = _dateTime();
                    if(!empty($data['plc_dcs_make'][$i]) && !empty($data['plc_dcs_qty'][$i])){
                        $varient_menu_plc['plc_dcs_make'] = $data['plc_dcs_make'][$i];
                        $varient_menu_plc['plc_dcs_qty'] = $data['plc_dcs_qty'][$i];
                        
                        $this->db->where('id', $plc_varient_id_up);
                        $this->db->update( 'lead_sales_pcb_common_plc', $varient_menu_plc);
                    }else{
                    
                        $this->db->where('id', $plc_varient_id_up);
                        $this->db->delete('lead_sales_pcb_common_plc');
                    }
                }else{
                    $varient_menu_plc['lead_id'] = $data['lead_id'];
                    $varient_menu_plc['company_id'] = $data['company_id'];
                    $varient_menu_plc['created'] = _dateTime();
                    $varient_menu_plc['modified'] = _dateTime();
                    $varient_menu_plc['plc_dcs_make'] = $data['plc_dcs_make'][$i];
                    $varient_menu_plc['plc_dcs_qty'] = $data['plc_dcs_qty'][$i];
                    if(!empty($data['plc_dcs_make'][$i]) && !empty($data['plc_dcs_qty'][$i])){
                    $this->db->insert('lead_sales_pcb_common_plc', $varient_menu_plc);
                    }
                }
                
            }
             
        }else{
            $data['created'] = _dateTime();
                //inserting all varient in table
             $len_plc = $data['open_plc_varient_count'];
             for ($i = 0; $i < $len_plc; $i++) {
                
                $varient_menu_plc['lead_id'] = $data['lead_id'];
                $varient_menu_plc['company_id'] = $data['company_id'];
                $varient_menu_plc['created'] = _dateTime();
                $varient_menu_plc['modified'] = _dateTime();
                $varient_menu_plc['plc_dcs_make'] = $data['plc_dcs_make'][$i];
                $varient_menu_plc['plc_dcs_qty'] = $data['plc_dcs_qty'][$i];
                $this->db->insert('lead_sales_pcb_common_plc', $varient_menu_plc);
                
            }
        }   
        
        
        // all data
        
        
         if ($leadOthers_actuator) {
                //inserting all varient in table
             $len_actuator = $data['open_actuator_varient_count'];
                for ($i = 0; $i < $len_actuator; $i++) {
                if ($data['actuator_varient_all_ids'][$i] != '') {
                $actuator_varient_id_up = $_POST['actuator_varient_all_ids'][$i];
                $varient_menu_actuator['lead_id'] = $data['lead_id'];
                $varient_menu_actuator['company_id'] = $data['company_id'];
                $varient_menu_actuator['modified'] = _dateTime();
                    if(!empty($data['actuator_make'][$i]) && !empty($data['actuator_qty'][$i])){
                        $varient_menu_actuator['actuator_make'] = $data['actuator_make'][$i];
                        $varient_menu_actuator['actuator_qty'] = $data['actuator_qty'][$i];
                        
                        $this->db->where('id', $actuator_varient_id_up);
                        $this->db->update( 'lead_sales_pcb_common_actuator', $varient_menu_actuator);
                    }else{
                    
                        $this->db->where('id', $actuator_varient_id_up);
                        $this->db->delete('lead_sales_pcb_common_actuator');
                    }
                }else{
                    $varient_menu_actuator['lead_id'] = $data['lead_id'];
                    $varient_menu_actuator['company_id'] = $data['company_id'];
                    $varient_menu_actuator['created'] = _dateTime();
                    $varient_menu_actuator['modified'] = _dateTime();
                    $varient_menu_actuator['actuator_make'] = $data['actuator_make'][$i];
                    $varient_menu_actuator['actuator_qty'] = $data['actuator_qty'][$i];
                    if(!empty($data['actuator_make'][$i]) && !empty($data['actuator_qty'][$i])){
                    $this->db->insert('lead_sales_pcb_common_actuator', $varient_menu_actuator);
                    }
                }
                
            }
             
        }else{
            $data['created'] = _dateTime();
                //inserting all varient in table
             $len_actuator = $data['open_actuator_varient_count'];
             for ($i = 0; $i < $len_actuator; $i++) {
                $varient_menu_actuator['lead_id'] = $data['lead_id'];
                $varient_menu_actuator['company_id'] = $data['company_id'];
                $varient_menu_actuator['created'] = _dateTime();
                $varient_menu_actuator['modified'] = _dateTime();
                $varient_menu_actuator['actuator_make'] = $data['actuator_make'][$i];
                $varient_menu_actuator['actuator_qty'] = $data['actuator_qty'][$i];
                $this->db->insert('lead_sales_pcb_common_actuator', $varient_menu_actuator);
                
            }
        }
        // all data
        if ($leadOthers_vfd) {
            //inserting all varient in table
            $len_vfd = $data['open_vfd_varient_count'];
            for ($i = 0; $i < $len_vfd; $i++) {
                if ($data['vfd_varient_all_ids'][$i] != '') {
                    $vfd_varient_id_up = $_POST['vfd_varient_all_ids'][$i];
                    $varient_menu_vfd['lead_id'] = $data['lead_id'];
                    $varient_menu_vfd['company_id'] = $data['company_id'];
                    $varient_menu_vfd['modified'] = _dateTime();
                    $varient_menu_vfd['vfd_make'] = $data['vfd_make'][$i];
                    $varient_menu_vfd['vfd_qty'] = $data['vfd_qty'][$i];
                    if(!empty($data['vfd_make'][$i]) && !empty($data['vfd_qty'][$i])){
                        $this->db->where('id', $vfd_varient_id_up);
                        $this->db->update('lead_sales_pcb_common_vfd', $varient_menu_vfd);
                    }else{
                        //echo "ayaaa";die;
                        $this->db->where('id', $vfd_varient_id_up);
                        $this->db->delete('lead_sales_pcb_common_vfd');
                    }
                }else{
                    $varient_menu_vfd['lead_id'] = $data['lead_id'];
                    $varient_menu_vfd['company_id'] = $data['company_id'];
                    $varient_menu_vfd['created'] = _dateTime();
                    $varient_menu_vfd['modified'] = _dateTime();
                    $varient_menu_vfd['vfd_make'] = $data['vfd_make'][$i];
                    $varient_menu_vfd['vfd_qty'] = $data['vfd_qty'][$i];
                    if(!empty($data['vfd_make'][$i]) && !empty($data['vfd_qty'][$i])){
                        $this->db->insert('lead_sales_pcb_common_vfd', $varient_menu_vfd);
                    }
                }
            }
        }else{
            $data['created'] = _dateTime();
                //inserting all varient in table
             $len_vfd = $data['open_vfd_varient_count'];
             for ($i = 0; $i < $len_vfd; $i++) {
                $varient_menu_vfd['lead_id'] = $data['lead_id'];
                $varient_menu_vfd['company_id'] = $data['company_id'];
                $varient_menu_vfd['created'] = _dateTime();
                $varient_menu_vfd['modified'] = _dateTime();
                $varient_menu_vfd['vfd_make'] = $data['vfd_make'][$i];
                $varient_menu_vfd['vfd_qty'] = $data['vfd_qty'][$i];
                $this->db->insert('lead_sales_pcb_common_vfd', $varient_menu_vfd);
            }
        }
        return;
    }

    function uploadDoc($file_arr) {
        
        if (@$file_arr['name'] != '') {
            
            $path = $file_arr['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $name = md5(time());
            $file_name = $name . "." . $ext;
            $folder_doc = './upload/company_doc/';
            if (!file_exists($folder_doc)) {
                mkdir($folder_doc, 0777, true);
            }
            $file_arr['name'] = $file_name;
            $config['upload_path'] = $folder_doc;
            $config['allowed_types'] = check_file_extension();
            $config['max_size'] = '5000';
            $config['encrypt_name'] = false;
            $config['remove_spaces'] = true;
            $config['overwrite'] = false;
            $this->load->library('upload');
            $this->upload->initialize($config);
            $data=array();
            if (!$this->upload->do_upload('document_file'))
            {
                $data['error'] = $this->upload->display_errors();
            } else
            {
                $data['success'] = $this->upload->data();
            }
            return $data;
        }
    }
    
    function save_company_doc($data)
    {
        return $this->db->insert_batch('company_doc', $data);
    }

    function is_unique_company_name($val)
    {
        $id = $this->uri->uri_segment(3);
        $this->db->select('name');
        $this->db->where('name',trim($val));
        $this->db->where('id!=',$id);
        $is_row = $this->db->get('companies')->num_rows();
        if ($is_row>0)
        {
            $this->form_validation->set_message('is_unique_company_name', 'Client Name already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
       
}