<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Cats Account Model *  @package		Rookie
 * @subpackage	Models
 * @category	Company
 * @author		Prabhakar Ram
 * @website		http://www.onlienprabhakar.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Supplier_Ind_Contact_mod extends CI_Model {

   // public $table     = "companies";
	public $per_page  = "per_page";
    var $table = "supplier_ind_contact";
    var $assign_leads = "assign_leads";
    var $assign_product = "assign_product";
    var $lead_reminder = "lead_reminder";
    var $follow_ups = "follow_ups";
    var $contacts = "contacts";
    var $lead_others = "lead_others";
    var $disqualify_leads = "disqualify_leads";
    var $company = "company";
    var $company_contacts = "company_contacts";
    var $lead_notes = "lead_notes";
    var $users = "users";
    var $referral_source = "referral_source";
    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
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
        $this->form_validation->set_rules('supplier_name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('company_contact_person_phone', lang('company_contact_person_mobile'), "trim|required");
	    $this->form_validation->set_rules('company_contact_person', lang('company_contact_person'), 'trim|required');
		$this->form_validation->set_rules('department', lang('company_contact_person_department'), "trim|required");
		$this->form_validation->set_rules('designation', lang('company_contact_person_designation'), 'trim|required');
        
        if($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $user_id = currentuserinfo()->id;
        
        //$data['supplier_id']         = $this->input->post('name',TRUE);
        $contact_add['email_id']	=	$_POST['company_contact_email_company'];
		$contact_add['name']	=	$_POST['company_contact_person'];
		$contact_add['supplier_id']         = $this->input->post('supplier_name',TRUE);
		$contact_add['primary_phone']	=	$_POST['company_contact_person_phone'];
		$contact_add['department']	=	$_POST['department'];
		$contact_add['designation']	=	$_POST['designation'];
		$contact_add['notes']	=	$_POST['notes'];
		$contact_add['previous_company']	=	$_POST['company_contact_person_previous_company'];
		$contact_add['personal_email']	=	$_POST['company_contact_email'];
		$contact_add['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
		$contact_add['current_working']	=	$_POST['company_contact_person_current_company_status'];
		//pr($contact_add);die;
		set_common_insert_value(); 
		/*End of putting company data into table in form of json*/
		$id = $this->db->insert('supplier_ind_contact',$contact_add);
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
        filter_data('sup');
        
        $this->db->select('sup.*,supplier_ind.name as supplier_name,department.name as department_name,designation.name as designation_name');
        $this->db->join('supplier_ind', "supplier_ind.id = sup.supplier_id");
		$this->db->join('department', "department.id = sup.department");
        $this->db->join('designation', "designation.id = sup.designation");
        $this->db->from('supplier_ind_contact sup');
        $this->db->where('sup.id',$id);
		$query = $this->db->get();
		//pr($query->row());die;
        if($query->num_rows() > 0)
           return $query->row();
    }
    
    
    
    // ------------------------------------------------------------------------ // ------------------------------------------------------------------------

    /**
     * Get Industry
     *
     * This function Get ALL Industry 
     * 
     * @access	public
     * @return	Object 
     */     
    function get_industry()
    {  
        //filter_data($this->table);
        //$this->db->where('id',$id);
		$this->db->select("id,name");
		$this->db->order_by("id","desc");
        $query = $this->db->get("industry");
        
        if($query->num_rows() > 0)
           return $query->result();
           
        show_404();
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
    function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc',$user='',$is_export=false, $items_data = NULL) {
         $offset = ($offset - 1) * $limit;

        if($is_export==false)
        {
            $this->db->limit($limit, $offset);
        }
        if($is_export==true &&  !empty($items_data))
        {
            $this->db->where_in("$this->table.id", $items_data);
        }
        $text=strtolower(trim($text));

        if($text) {
            // $this->db->like("$this->table.*",$text);
            $this->db->like("CONCAT(sup.name,sup.email_id,sup.primary_phone,sup.secondary_phone)",$text);
        }

        if($order_by && $order)
            $this->db->order_by($order_by, $order);

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
        filter_data('sup');      
        //$query = $this->db->get();
       // pr($query->result());exit;
        //echo $this->db->last_query();exit;
		
		$this->db->select('SQL_CALC_FOUND_ROWS sup.*,supplier_ind.name as supplier_name,department.name as department_name,designation.name as designation_name',false);
        $this->db->from('supplier_ind_contact as sup');
        $this->db->join('supplier_ind', "supplier_ind.id = sup.supplier_id");
        $this->db->join('department', "department.id = sup.department");
        $this->db->join('designation', "designation.id = sup.designation");
		$query = $this->db->get();
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
		//$user_id = currentuserinfo()->id;
		
			
		
		$this->form_validation->set_rules('supplier_name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('company_contact_person_phone', lang('company_contact_person_mobile'), "trim|required");
	    $this->form_validation->set_rules('company_contact_person', lang('company_contact_person'), 'trim|required');
		$this->form_validation->set_rules('department', lang('company_contact_person_department'), "trim|required");
		$this->form_validation->set_rules('designation', lang('company_contact_person_designation'), 'trim|required');
		
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        }
        
        
                $contact_upd['email_id']	=	$_POST['company_contact_email_company'];
				$contact_upd['name']	=	$_POST['company_contact_person'];
				$contact_upd['supplier_id']         = $this->input->post('supplier_name',TRUE);
				$contact_upd['primary_phone']	=	$_POST['company_contact_person_phone'];
				$contact_upd['department']	=	$_POST['department'];
				$contact_upd['designation']	=	$_POST['designation'];
				$contact_upd['previous_company']	=	$_POST['company_contact_person_previous_company'];
				$contact_upd['personal_email']	=	$_POST['company_contact_email'];
				$contact_upd['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
				$contact_upd['current_working']	=	$_POST['company_contact_person_current_company_status'];
				//pr($contact_upd);die;
                /*End of putting company data into table in form of json*/
                filter_data();
		        set_common_update_value();
				$this->db->where("id",$id);
				$r = $this->db->update('supplier_ind_contact',$contact_upd);
				
               // pr($this->db->last_query());die;
				
                
                update_report($id);
        
            if($r)
                set_flashdata("success",lang('updated'));
                    
            return $r;
    }
    
   
    function get_flexigrid_cols()  
    {
           $data = array(
            array(
                "display"   =>lang('company_contact_person'),
                "name"      =>"name",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('supplier_name'),
                "name"      =>"supplier_name",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('primary_phone'),
                "name"      =>"primary_phone",
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
	/*function export(){
		$items          =$this->input->get_post('items',TRUE);
        $items_data     = str_replace("row","",$items);       
        $items_data      = explode(",",$items_data);

		$this->db->select('sup.*,supplier_ind.name as supplier_name,department.name as department_name,designation.name as designation_name');
        $this->db->from('supplier_ind_contact as sup');
        $this->db->join('supplier_ind', "supplier_ind.id = sup.supplier_id");
        $this->db->join('department', "department.id = sup.department");
        $this->db->join('designation', "designation.id = sup.designation");
		if(!empty($items)){ 
             $this->db->where_in("sup.id",$items_data);
        }
		
		$query = $this->db->get();

		$data= $query->result();	
		//pr($data);die;
		return $data;
	}*/
    
	
	
	
	public function get_vendor(){
		$this->db->select("id,name");
		$this->db->order_by("name","asc");
		$this->db->where_in('country','1');
		$this->db->where_in('status','1');
        $query = $this->db->get("supplier_vendor");
        
        if($query->num_rows() > 0)
           return $query->result();
           
	}
	
	public function check_vendor_code_existance($vendor_code) {
        //$database=DEFAULT_DATABASE;
        $query=$this->db->query("SELECT id FROM supplier_ind_contact_contact_contact_contact_contact_contact_contact_contact WHERE vendor_code='$vendor_code'");
        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
    }
	
	function uploadDoc($file_arr) {
		
		if (@$file_arr['name'] != '') {
			
			$path = $file_arr['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $name = md5(time());
            $file_name = $name . "." . $ext;
			$folder_doc = './upload/documents/';
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
        if (!$this->upload->do_upload('document'))
        {
            $data['error'] = $this->upload->display_errors();
        } else
        {
            $data['success'] = $this->upload->data();
        }
        return $data;
		}
    }
	public function get_table_name(){
		$this->db->where('is_deleted','1');
        $this->db->select("*");
		$result = $this->db->get('inch_form');
        if ($result->num_rows > 0) {
            return $result->result();
        }
    }

    function get_supplier()
    {
        $this->db->where("status","1");
        $this->db->select("id,name as supplier_name");
		$this->db->order_by("name","asc");
        $result = $this->db->get("supplier_ind");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    
   
}