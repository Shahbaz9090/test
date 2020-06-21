<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		
 * @subpackage	Models
 * @category	Company
 * @author		Prabhakar Ram
 * @website		http://www.onlienprabhakar.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Company_mod extends CI_Model {

    public $table     = "companies";
	public $per_page  = "per_page";
   
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
        $this->form_validation->set_error_delimiters('', '');
    }
    
    // ------------------------------------------------------------------------

    /**
     * Add Company
     *
     * This function Add Company
     * 
     * @access	public
     * @return	mixed Array 
     */     
    function add()
    {
        // pr($_FILES);die;
		//$this->form_validation->set_rules('client_id', lang('client_id'), 'trim|required|is_unique[companies.client_id]');
        $this->db->where("website",$this->input->post('website_address',TRUE));
        $this->db->where("site_id",current_site_id());
        $r =$this->db->get($this->table);
                
        if($r->num_rows() > 0)
        {      
            set_flashdata("error","The Company Website field must contain a unique value");       
            return FALSE;
                          
        }
		
        $this->form_validation->set_rules('company_name', lang('name'), 'trim|required|is_unique[companies.name]');
		$this->form_validation->set_rules('type_of_establishment', lang('type_of_establishment'), "trim|required");
        $this->form_validation->set_rules('type_of_client', lang('type_of_client'), "trim|required");
		$this->form_validation->set_rules('industry', lang('industry'), 'trim|required');
        $this->form_validation->set_rules('pincode', lang('pincode'), 'trim|required');
		$this->form_validation->set_rules('company_address', lang('company_address'), "trim|required");
		$this->form_validation->set_rules('country', lang('country'), 'trim|required');
		$this->form_validation->set_rules('state_comp[]', lang('state'), "trim|required");
		$this->form_validation->set_rules('city_comp[]', lang('city'), 'trim|required');
		$this->form_validation->set_rules('pincode', lang('pincode'), "trim|required");
        
        $this->form_validation->set_rules('pan', lang('pan'), "trim|required|min_length[10]");
        $this->form_validation->set_rules('cin', lang('cin'), "trim|required|min_length[21]");
        $this->form_validation->set_rules('gst', lang('gst'), "trim|required|min_length[15]");
        $this->form_validation->set_rules('tan', lang('tan'), "trim|required|min_length[10]");
		$this->form_validation->set_rules('data[common][plc_dcs_make][]', lang('plc_dcs_make'), "trim|required");
        //$st = $this->is_unique_client_id($this->input->post('company_name',TRUE));
        
        if($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            //pr(validation_errors());
            return FALSE;
        } 
		/*elseif ($st == FALSE)
        {
            set_flashdata("error","Oops !! This Company Name is Alreday Exists.");
            return FALSE;
        }*/
        //$industry_arr = $this->input->post('industry',TRUE);
		//$industry_str = implode(',',$industry_arr);
        //$data['client_id']              = $this->input->post('client_id',TRUE);
        $data['name']                   = $this->input->post('company_name',TRUE);
        $data['industry']               = $this->input->post('industry',TRUE);
        $data['company_address']        = $this->input->post('company_address',TRUE);
        $data['country']                = $this->input->post('country',TRUE);
        $data['state_comp']             = $this->input->post('state_comp',TRUE);
        $data['city_comp']              = $this->input->post('city_comp',TRUE);
        $data['pincode']                = $this->input->post('pincode',TRUE);
        $data['cordinates']             = $this->input->post('cordinates',TRUE);
        $data['city_code']              = $this->input->post('city_code',TRUE);
        $data['landline']               = $this->input->post('landline',TRUE);
        $data['fax']                    = $this->input->post('fax',TRUE);
        $data['plant_established_year'] = $this->input->post('plant_established_year',TRUE);
        $data['tax_cin']                = $this->input->post('cin',TRUE);
        $data['tax_pan']                = $this->input->post('pan',TRUE);
        $data['tax_tan']                = $this->input->post('tan',TRUE);
        $data['tax_gst']                = $this->input->post('gst',TRUE);
        $data['website']                = $this->input->post('website_address',TRUE);
		$data['type_of_establishment']	= $this->input->post('type_of_establishment',TRUE);
		$data['type_of_client']        	= $this->input->post('type_of_client',TRUE);
        //pr($data);die;
        set_common_insert_value();        
        $this->db->insert($this->table,$data);           
        $id = $this->db->insert_id();
        //client_id autogenerated
		$pattern = "202000";
		$auto['client_id']              = $pattern.$id;
		$this->db->where("id",$id);
		$this->db->update($this->table,$auto);  
		
		
		// add company notes
		$note['company_id'] 	= $id;
		$note['notes']  			= $this->input->post('notes',TRUE);
		set_common_insert_value();    
		$this->db->insert('company_notes',$note);   
        // add all common Information 
        $commonData 				= $_POST['data']['common'];
        $commonData['lead_id'] 		= $id;
        $commonData['company_id'] 	= $id;
        $commonData['open_plc_varient_count'] = $_POST['open_plc_varient_count'];
        $commonData['open_actuator_varient_count'] = $_POST['open_actuator_varient_count'];
        $commonData['open_vfd_varient_count'] = $_POST['open_vfd_varient_count'];
        $this->addCommon($commonData);

        /*Start save client multiple  document*/
        $company_doc = [];
        if(isset($_FILES['document']) && !empty($_FILES['document']['name']))
        {
            
            foreach ($_FILES['document']['name'] as $document_key => $document_value) {
                $_FILES['document_file']['name']     = $_FILES['document']['name'][$document_key];
                $_FILES['document_file']['type']     = $_FILES['document']['type'][$document_key];
                $_FILES['document_file']['tmp_name'] = $_FILES['document']['tmp_name'][$document_key];
                $_FILES['document_file']['error']    = $_FILES['document']['error'][$document_key];
                $_FILES['document_file']['size']     = $_FILES['document']['size'][$document_key];
                $fileData=$this->uploadDoc($_FILES['document_file']);
                
                if(isset($fileData['success'])){
                    $company_doc[$document_key]['filename']     = $fileData['success']['file_name'];   
                    $company_doc[$document_key]['company_id']   = $id;   
                }
            }
            
            if(!empty($company_doc))
            {
                $this->save_company_doc($company_doc);
            }
        }
        
        /*End save client multiple  document*/

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
        //filter_data($this->table);
        
        $this->db->select('SQL_CALC_FOUND_ROWS companies.id as ids,companies.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ind.name as industry_name,tc.name as type_client_name,cte.name as type_of_establishment_name',false);
		$this->db->from('companies');
		$this->db->join("industry ind" , 'companies.industry=ind.id',"left");
		$this->db->join("countries co" , 'co.id=companies.country',"left");
		$this->db->join("states st" , 'st.id=companies.state_comp',"left");
		$this->db->join("cities ct" , 'ct.id=companies.city_comp',"left");
		$this->db->join("inch_client_type_establishment cte" , 'cte.form_id=companies.type_of_establishment',"left");
		$this->db->join("inch_type_of_client tc" , 'tc.form_id=companies.type_of_client',"left");
		//$this->db->join("company_doc cd" , 'cd.company_id=companies.id',"left");
		
		$this->db->where('companies.id',$id);
		$query = $this->db->get();
        if($query->num_rows() > 0)
           $query = $query->row();
		//pr($query);die;
       /*fetching Trading varients*/
        $this->db->select('*');
        $this->db->where('company_id', $id);
        $menu_varient_plc = $this->db->get("lead_sales_pcb_common_plc")->result();
        @$query->lead_sales_pcb_common_plc  =   $menu_varient_plc;
        
        $this->db->select('*');
        $this->db->where('company_id', $id);
        $menu_varient_actuator = $this->db->get("lead_sales_pcb_common_actuator")->result();
        @$query->lead_sales_pcb_common_actuator =   $menu_varient_actuator;
        
        $this->db->select('*');
        $this->db->where('company_id', $id);
        $menu_varient_vfd = $this->db->get("lead_sales_pcb_common_vfd")->result();
        @$query->lead_sales_pcb_common_vfd  =   $menu_varient_vfd;

        $this->db->select('*');
        $this->db->where('company_id', $id);
        $company_doc = $this->db->get("company_doc")->result();
        @$query->company_doc  =   $company_doc;
		//pr($query);die;
        return $query;
        
        //show_404();
    }
	
    
	function get_notes($id = NULL)
    {
        //pr($id);die;
        
        $this->db->select("company_notes.*,users.first_name,users.last_name");
        $this->db->join('users','users.id =company_notes.added_by');
        $this->db->from("company_notes");
        $this->db->where('company_notes.company_id',$id);
        $this->db->order_by("company_notes.created_time","desc");
        $result = $this->db->get();
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    
	function get_doc($id = NULL)
    {
		
		$this->db->where('company_id',$id);
        $this->db->select("*");
		$this->db->order_by("filename","desc");
        $result = $this->db->get("company_doc");
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
    function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc', $is_export=false, $items_data = NULL) {
		
        $offset = ($offset - 1) * $limit;
        if($is_export==false)
        {
            $this->db->limit($limit, $offset);
        }
        if($is_export==true &&  !empty($items_data))
        {
            $this->db->where_in("companies.id", $items_data);
        }
        $text=strtolower(trim($text));

        if($text)
        {
            if(strpos($text, '/'))
            {
                $text = str_replace('/', '-', $text);
                $text = date('Y-m-d',strtotime($text));
            }
            // $this->db->like("CONCAT(companies.name,companies.website,companies.client_id,co.country_name,st.state_name,ct.city_name,ind.name)",
                // $text);
            $where = "companies.name LIKE '%$text%' OR companies.website LIKE '%$text%' OR companies.client_id LIKE '%$text%' OR co.country_name LIKE '%$text%' OR st.state_name LIKE '%$text%' OR ct.city_name LIKE '%$text%' OR companies.company_address LIKE '%$text%'  OR companies.tax_gst LIKE '%$text%' OR ind.name LIKE '%$text%' OR companies.created_time LIKE '%$text%'";
            $this->db->where($where);
        }

        if($order_by && $order){
            $this->db->order_by($order_by, $order);
        }

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
        //filter_data($this->table);  // c is alias of companies   
        //$query = $this->db->get();
       // pr($query->result());exit;
        // echo $this->db->last_query();exit;
		
		$this->db->select('SQL_CALC_FOUND_ROWS companies.id as ids,companies.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ind.name as industry_name,tc.name as type_client_name,cte.name as type_of_establishment_name,CONCAT(users.first_name," " ,users.last_name) as username',false);
		$this->db->from('companies');
		$this->db->join("industry ind" , 'companies.industry=ind.id',"left");
		$this->db->join("countries co" , 'co.id=companies.country',"left");
		$this->db->join("states st" , 'st.id=companies.state_comp',"left");
		$this->db->join("cities ct" , 'ct.id=companies.city_comp',"left");
		$this->db->join("inch_client_type_establishment cte" , 'cte.form_id=companies.type_of_establishment',"left");
        $this->db->join("users" , 'users.id=companies.added_by',"left");
		$this->db->join("inch_type_of_client tc" , 'tc.form_id=companies.type_of_client',"left");
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
		// pr($data);die;
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
		/*$name   = $this->input->post('company_name',TRUE);
		$client_id   = $this->input->post('client_id',TRUE);
		//pr($client_id);
		$this->db->select('name,client_id');
		$this->db->from('companies');
		$this->db->where_in('id',$id);
		$query = $this->db->get();
		$result = $query->row();
		//pr($result->client_id);die;
		if($result->name!=$name && $result->client_id!=$client_id){*/
		//$this->form_validation->set_rules('client_id', lang('client_id'), 'trim|required');
		
		//pr($st);die;
		$this->form_validation->set_rules('company_name', lang('name'), 'trim|required');
		$st = $this->check_name_existance($this->input->post('company_name',TRUE),$id);
		$this->form_validation->set_rules('type_of_establishment', lang('type_of_establishment'), "trim|required");
	    $this->form_validation->set_rules('type_of_client', lang('type_of_client'), "trim|required");
        $this->form_validation->set_rules('industry', lang('industry'), 'trim|required');
        $this->form_validation->set_rules('pincode', lang('pincode'), 'trim|required');
        $this->form_validation->set_rules('company_address', lang('company_address'), "trim|required");
        $this->form_validation->set_rules('country', lang('country'), 'trim|required');
        $this->form_validation->set_rules('state_comp', lang('state'), "trim|required");
        $this->form_validation->set_rules('city_comp', lang('city'), 'trim|required');
        $this->form_validation->set_rules('pincode', lang('pincode'), "trim|required");
        
        $this->form_validation->set_rules('pan', lang('pan'), "trim|required|min_length[10]");
        $this->form_validation->set_rules('cin', lang('cin'), "trim|required|min_length[21]");
        $this->form_validation->set_rules('gst', lang('gst'), "trim|required|min_length[15]");
        $this->form_validation->set_rules('tan', lang('tan'), "trim|required|min_length[10]");
        //$this->form_validation->set_rules('data[common][plc_dcs_make][]', lang('plc_dcs_make'), "trim|required");
        
  	    //$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
        
        if ($this->form_validation->run() == FALSE)
        {   //pr("nhi");die;
            //set_flashdata("error",validation_errors());
			$data_status = 'error_required';
			return $data_status;
           
        } 
		//pr($st);
		elseif ($st == TRUE)
        {   //pr("aya");die;
            //set_flashdata("error","Oops !! This Company Name is Alreday Exists.");
            $data_status = 'error';
			return $data_status;
        } 
			 

        //$industry_arr = $this->input->post('industry',TRUE);
		//$industry_str = implode(',',$industry_arr);
        //$data['client_id']                  = $this->input->post('client_id',TRUE);
        $data['name']           			= $this->input->post('company_name',TRUE);
        $data['industry']          		 	= $this->input->post('industry',TRUE);
        $data['company_address']            = $this->input->post('company_address',TRUE);
        $data['country']           			= $this->input->post('country',TRUE);
        $data['state_comp']           		= $this->input->post('state_comp',TRUE);
        $data['city_comp']          		= $this->input->post('city_comp',TRUE);
        $data['pincode']           			= $this->input->post('pincode',TRUE);
        $data['cordinates']           		= $this->input->post('cordinates',TRUE);
        $data['city_code']           		= $this->input->post('city_code',TRUE);
        $data['landline']           		= $this->input->post('landline',TRUE);
        $data['fax']           				= $this->input->post('fax',TRUE);
        $data['plant_established_year']     = $this->input->post('plant_established_year',TRUE);
        $data['tax_cin']           			= $this->input->post('cin',TRUE);
        $data['tax_pan']           			= $this->input->post('pan',TRUE);
        $data['tax_tan']           			= $this->input->post('tan',TRUE);
        $data['tax_gst']           			= $this->input->post('gst',TRUE);
        $data['website']        			= $this->input->post('website_address',TRUE);
		$data['type_of_establishment']      = $this->input->post('type_of_establishment',TRUE);
		$data['type_of_client']        		= $this->input->post('type_of_client',TRUE);
        //$data['notes']                      = $this->input->post('notes',TRUE);
	   //pr($data);die;
		/*}else{
			$this->form_validation->set_rules('client_id', lang('client_id'), 'trim|required');
			$this->form_validation->set_rules('company_name', lang('name'), 'trim|required');
			$this->form_validation->set_rules('website_address', lang('website'), "trim|required");
			$this->form_validation->set_rules('industry', lang('industry'), 'trim|required');
			$this->form_validation->set_rules('company_address', lang('company_address'), "trim|required");
			$this->form_validation->set_rules('country', lang('country'), 'trim|required');
			$this->form_validation->set_rules('state_comp', lang('state'), "trim|required");
			$this->form_validation->set_rules('city_comp', lang('city'), 'trim|required');
			$this->form_validation->set_rules('pincode', lang('pincode'), "trim|required");
			//$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
			
			if ($this->form_validation->run() == FALSE)
			{
				set_flashdata("error",validation_errors());
				return FALSE;
			} 
			
			//$industry_arr = $this->input->post('industry',TRUE);
			//$industry_str = implode(',',$industry_arr);
			$data['client_id']           			= $this->input->post('client_id',TRUE);
			$data['name']           			= $this->input->post('company_name',TRUE);
			$data['industry']          		 	= $this->input->post('industry',TRUE);
			$data['company_address']            = $this->input->post('company_address',TRUE);
			$data['country']           			= $this->input->post('country',TRUE);
			$data['state_comp']           		= $this->input->post('state_comp',TRUE);
			$data['city_comp']          		= $this->input->post('city_comp',TRUE);
			$data['pincode']           			= $this->input->post('pincode',TRUE);
			$data['cordinates']           		= $this->input->post('cordinates',TRUE);
			$data['city_code']           		= $this->input->post('city_code',TRUE);
			$data['landline']           		= $this->input->post('landline',TRUE);
			$data['fax']           				= $this->input->post('fax',TRUE);
			$data['plant_established_year']     = $this->input->post('plant_established_year',TRUE);
			$data['tax_cin']           			= $this->input->post('cin',TRUE);
			$data['tax_pan']           			= $this->input->post('pan',TRUE);
			$data['tax_tan']           			= $this->input->post('tan',TRUE);
			$data['tax_gst']           			= $this->input->post('gst',TRUE);
			$data['website']        			= $this->input->post('website_address',TRUE);
			$data['type_of_establishment']      = $this->input->post('type_of_establishment',TRUE);
			$data['type_of_client']        		= $this->input->post('type_of_client',TRUE);
		}*/
        $this->db->where("id",$id);
        // filter_data();
        // pr($_POST);die;
        // set_common_update_value();
        $r = $this->db->update($this->table,$data);
        // echo $this->db->last_query();die;
        // add company notes
        $val         = $this->input->post('notes',TRUE);
        if($val){
		$note['company_id'] 	=	 $id;
		$note['notes']  		= $this->input->post('notes',TRUE);
		set_common_insert_value();    
		$this->db->insert('company_notes',$note);  
    }
        // add all common Information 
        $commonData = $_POST['data']['common'];
        $commonData['lead_id'] = $id;
        $commonData['company_id'] = $id;
        $commonData['open_plc_varient_count'] =  $_POST['open_plc_varient_count'];
        $commonData['plc_varient_all_ids'] = $_POST['plc_varient_all_ids'];
        $commonData['open_actuator_varient_count'] =  $_POST['open_actuator_varient_count'];
        $commonData['actuator_varient_all_ids'] = $_POST['actuator_varient_all_ids'];
        $commonData['open_vfd_varient_count'] =  $_POST['open_vfd_varient_count'];
        $commonData['vfd_varient_all_ids'] = $_POST['vfd_varient_all_ids'];
        $this->addCommon($commonData);

        /*Start save client multiple  document*/
        $company_doc = [];
        if(isset($_FILES['document']) && !empty($_FILES['document']['name']))
        {
            
            foreach ($_FILES['document']['name'] as $document_key => $document_value) {
                $_FILES['document_file']['name']     = $_FILES['document']['name'][$document_key];
                $_FILES['document_file']['type']     = $_FILES['document']['type'][$document_key];
                $_FILES['document_file']['tmp_name'] = $_FILES['document']['tmp_name'][$document_key];
                $_FILES['document_file']['error']    = $_FILES['document']['error'][$document_key];
                $_FILES['document_file']['size']     = $_FILES['document']['size'][$document_key];
                $fileData=$this->uploadDoc($_FILES['document_file']);
                
                if(isset($fileData['success'])){
                    $company_doc[$document_key]['filename']     = $fileData['success']['file_name'];   
                    $company_doc[$document_key]['company_id']   = $id;   
                }
            }
            
            if(!empty($company_doc))
            {
                $this->save_company_doc($company_doc);
            }
        }
        
        /*End save client multiple  document*/

        update_report($id);
        
        if($r)
            set_flashdata("success",lang('updated'));
         //pr($r);die;           
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
                "display"   =>lang('client_id'),
                "name"      =>"client_id",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('added_by'),
                "name"      =>"username",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('industry_type'),
                "name"      =>"industry_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('country'),
                "name"      =>"country_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('state'),
                "name"      =>"state_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('city'),
                "name"      =>"city_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('date'),
                "name"      =>"created_time",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('website'),
                "name"      =>"website",
                "order_by" => "yes"
            ),
			array(
                "display"   =>lang('plant_established_year'),
                "name"      =>"plant_established_year",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('type_of_establishment'),
                "name"      =>"type_of_establishment",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('type_of_client'),
                "name"      =>"type_of_client",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('gst'),
                "name"      =>"tax_gst",
                "order_by" => "no"
            ),array(
                "display"   =>lang('company_address'),
                "name"      =>"company_address",
                "order_by" => "yes"
            ),array(
                "display" => lang("status"),
                "name" => "status",
                "order_by" => "yes"),
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
	/*function export(){
		$items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);
        //pr($items_data);die;
		$this->db->select('companies.id as ids,companies.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ind.name as industry_name,est.name as type_of_establishment,cest.name as type_of_client',false);
        $this->db->from('companies');
        $this->db->join("industry ind" , 'companies.industry=ind.id',"left");
        $this->db->join("countries co" , 'co.id=companies.country',"left");
        $this->db->join("states st" , 'st.id=companies.state_comp',"left");
        $this->db->join("cities ct" , 'ct.id=companies.city_comp',"left");
        $this->db->join("inch_client_type_establishment est" , 'est.form_id=companies.type_of_establishment',"left");
        $this->db->join("inch_client_type_establishment cest" , 'cest.form_id=companies.type_of_client',"left");
        if(!empty($items)){ 
             $this->db->where_in("companies.id",$items_data);
        }
       
		$query = $this->db->get();

		$data= $query->result();	
		//pr($data);die;
		return $data;
	}*/
	
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
    
    
	
	/*public function check_client_id_existance($client_id) {
        //$database=DEFAULT_DATABASE;
        $query=mysql_query("SELECT id FROM companies WHERE client_id='$client_id'");
        $count=mysql_num_rows($query); 
        if ($count > 0)
            return true;
    }*/
	
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
        // pr($data);die;
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
                    if(!empty($data['plc_dcs_make'][$i]) && $data['plc_dcs_qty'][$i] != ''){
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
                    if(!empty($data['actuator_make'][$i]) && $data['actuator_qty'][$i] != ''){
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
                    if(!empty($data['vfd_make'][$i]) && $data['vfd_qty'][$i] != ''){
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
			//pr($data);die;
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
     public function check_name_existance($company_name,$id=null) {
		
        $this->db->select('id');
        $this->db->where('LOWER(name)', trim(strtolower($company_name)));
        if(isset($id) && !empty($id))
        {
            $this->db->where('id !='.$id, NULL, FALSE);
        }
        $is_row = $this->db->get('companies')->num_rows();

        if ($is_row>0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

	public function is_unique_client_id($company_name) {

        //$database=DEFAULT_DATABASE;
        // echo "SELECT id FROM $this->table WHERE country_name='$name' AND id!=".$country_id;die;
        $id = $this->uri->segment(3);
		//pr($id);die;
        $query=$this->db->query("SELECT id FROM companies WHERE name='$company_name' AND id!=".$id);
        // echo $this->db->last_query();exit;
        $count=$query->num_rows();	
        if ($count)
        {
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}