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
 
class Supplier_Ind_mod extends CI_Model {

   // public $table     = "companies";
	public $per_page  = "per_page";
    var $table = "supplier_ind";
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
        
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('country', lang('country'), "trim|required");
	    $this->form_validation->set_rules('state_comp', lang('state'), 'trim|required');
		$this->form_validation->set_rules('city_comp', lang('city'), "trim|required");
		 $this->form_validation->set_rules('city_code', lang('city_code'), 'trim|required');
		$this->form_validation->set_rules('pincode', lang('pincode'), "trim|required");
		 $this->form_validation->set_rules('type_of_establishment', lang('type_of_establishment'), 'trim|required');
		$this->form_validation->set_rules('website_address', lang('item_service_description'), "trim|required");
		 //$this->form_validation->set_rules('item_description', lang('item_description'), 'trim|required');
		$this->form_validation->set_rules('cin_no', lang('cin'), "trim|required");
		 $this->form_validation->set_rules('pan_no', lang('pan'), 'trim|required');
		$this->form_validation->set_rules('gst_no', lang('gst'), "trim|required");
		 $this->form_validation->set_rules('iec_no', lang('iec'), 'trim|required');
		$this->form_validation->set_rules('tds_section', lang('tds_section'), "trim|required");
		$this->form_validation->set_rules('bank_name', lang('bank_name'), 'trim|required');
		$this->form_validation->set_rules('account_number', lang('account_number'), "trim|required");
		 $this->form_validation->set_rules('account_type', lang('type_of_account'), 'trim|required');
		$this->form_validation->set_rules('ifsc_code', lang('ifsc_code'), "trim|required");
		//$this->form_validation->set_rules('vendor_code', lang('vendor_code'), 'trim|required|is_unique[supplier_ind.vendor_code]');
        
        if($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            return FALSE;
        } 
        $user_id = currentuserinfo()->id;
        $data['name']           = $this->input->post('name',TRUE);
        $data['vendor_type']        = $this->input->post('vendor_type',TRUE);
		$data['address']           = $this->input->post('address',TRUE);
        $data['factory_address']        = $this->input->post('factory_address',TRUE);
		$data['country']           = $this->input->post('country',TRUE);
        $data['state']        = $this->input->post('state_comp',TRUE);
		$data['city']           = $this->input->post('city_comp',TRUE);
        $data['pincode']        = $this->input->post('pincode',TRUE);
		$data['city_code']           = $this->input->post('city_code',TRUE);
        $data['landline']        = $this->input->post('landline',TRUE);
		$data['established_year']           = $this->input->post('established_year',TRUE);
        $data['type_of_establishment']        = $this->input->post('type_of_establishment',TRUE);
		$data['website_address']           = $this->input->post('website_address',TRUE);
        $data['item_description']        = $this->input->post('item_description',TRUE);
		$data['cin_no']           = $this->input->post('cin_no',TRUE);
        $data['pan_no']        = $this->input->post('pan_no',TRUE);
        $data['iec_no']        = $this->input->post('iec_no',TRUE);
        $data['gst_no']        = $this->input->post('gst_no',TRUE);
		$data['tds_section']           = $this->input->post('tds_section',TRUE);
        $data['tds_age']        = $this->input->post('tds_age',TRUE);
		$data['msme']           = $this->input->post('msme',TRUE);
        $data['msme_number']        = $this->input->post('msme_number',TRUE);
		
		$data['bank_name']           = $this->input->post('bank_name',TRUE);
        $data['account_number']        = $this->input->post('account_number',TRUE);
		$data['account_type']           = $this->input->post('account_type',TRUE);
        $data['bank_address']        = $this->input->post('bank_address',TRUE);
		$data['ifsc_code']           = $this->input->post('ifsc_code',TRUE);
        $data['other_bank_name']        = $this->input->post('other_bank_name',TRUE);
		$data['other_account_number']           = $this->input->post('other_account_number',TRUE);
        $data['other_bank_address']        = $this->input->post('other_bank_address',TRUE);
		$data['other_ifsc_code']           = $this->input->post('other_ifsc_code',TRUE);
		$data['other_account_type']           = $this->input->post('other_account_type',TRUE);
		//$data['vendor_code'] = $this->input->post('vendor_code',TRUE);
		 //pr($data);die;
		 set_common_insert_value();        
        $this->db->insert($this->table,$data);           
        $id = $this->db->insert_id();
		//vendor code autogenerated
		$pattern = "IN0000";
		$auto['vendor_code']              = $pattern.$id;
		$this->db->where("id",$id);
		$this->db->update($this->table,$auto); 
		
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
                    $company_doc[$document_key]['supplier_id']   = $id;   
                }
            }
            
            if(!empty($company_doc))
            {
                $this->save_company_doc($company_doc);
            }
        }
       // add company notes
		/*$note['supplier_id'] 	= $id;
		$note['notes']  			= $this->input->post('notes',TRUE);
		$this->db->insert('supplier_ind_notes',$note);  */
        
		
		/*$contact_add['email_id']	=	$_POST['company_contact_email_company'];
		$contact_add['name']	=	$_POST['company_contact_person'];
		$contact_add['supplier_id']	=	$id;
		$contact_add['primary_phone']	=	$_POST['company_contact_person_phone'];
		$contact_add['department']	=	$_POST['department'];
		$contact_add['designation']	=	$_POST['designation'];
		$contact_add['notes']	=	$_POST['notes'];
		$contact_add['previous_company']	=	$_POST['company_contact_person_previous_company'];
		$contact_add['personal_email']	=	$_POST['company_contact_email'];
		$contact_add['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
		$contact_add['current_working']	=	$_POST['company_contact_person_current_company_status'];*/
		//pr($contact_add);die;
		//set_common_insert_value(); 
		/*End of putting company data into table in form of json*/
		//$this->db->insert('supplier_ind_contact',$contact_add);
		//$contact_id 	=	$this->db->insert_id();
		$note = $_POST['notes'];
          if($note){
                $noteArray=array(
                  'supplier_id'=>$id,
                  'added_by'=>$user_id,
                  'note'=>$note,
                  'created'=>date_time(),
                  'modified'=>date_time()
                );
             //pr($noteArray);die;
		$inser_id=$this->db->insert('supplier_ind_notes',$noteArray);
		  }
		   if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
			}
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
        
        $this->db->select('sup.*,sup.name as vendor_names,sup.address as vendor_address,sup.state as state_id,sic.*,sin.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,dept.name as department_name,desg.name as designation_name');
		$this->db->from('supplier_ind sup');
		$this->db->join("countries co" , 'co.id=sup.country','left');
		$this->db->join("states st" , 'st.country_id=co.id','left');
		$this->db->join("cities ct" , 'ct.state_id=st.id','left');
		$this->db->join('supplier_ind_contact sic','sup.id=sic.supplier_id','left');
		$this->db->join('supplier_ind_notes sin','sup.id=sin.supplier_id','left');
		$this->db->join('department dept','sic.department=dept.id','left');
        $this->db->join('designation desg','sic.designation=desg.id','left');
		//$this->db->join("industry in" , 'c.industry=in.id');
		$this->db->where('sup.id',$id);
		$query = $this->db->get();
		//pr($query->row());die;
        if($query->num_rows() > 0)
           $query = $query->row();
	   
	    $this->db->select('*');
        $this->db->where('supplier_id', $id);
        $company_doc = $this->db->get("supplier_ind_doc")->result();
        @$query->company_doc  =   $company_doc;
		return $query;
    }
    
    
    
    // ------------------------------------------------------------------------ // ------------------------------------------------------------------------


    function get_notes($id = NULL)
    {
        //pr($id);die;
        
        $this->db->select("supplier_ind_notes.*,users.first_name,users.last_name");
        $this->db->join('users','users.id =supplier_ind_notes.added_by');
        $this->db->from("supplier_ind_notes");
        $this->db->where('supplier_ind_notes.supplier_id',$id);
        $this->db->order_by("note","desc");
        $result = $this->db->get();
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
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
           
        //show_404();
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
        //pr('yess');die;
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
            // $this->db->like("$this->table.*", $text);
            $this->db->like("CONCAT(sup.name,sup.vendor_code,ct.city_name,st.state_name,co.country_name,ven.name)",$text);
        }

        if($order_by && $order)
            $this->db->order_by($order_by, $order);

      //$this->db->select("SQL_CALC_FOUND_ROWS $this->table .*",FALSE);
        //$this->db->from("$this->table");
        filter_data('sup');      
        //$query = $this->db->get();
       // pr($query->result());exit;
        //echo $this->db->last_query();exit;
		
		$this->db->select('SQL_CALC_FOUND_ROWS sup.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ven.name as vendor_name',false);
		$this->db->from('supplier_ind as sup');
		$this->db->join("countries co" , 'co.id=sup.country','LEFT');
		$this->db->join("states st" , 'st.id=sup.state','LEFT');
		$this->db->join("cities ct" , 'ct.id=sup.city','LEFT');
		$this->db->join("supplier_vendor ven" , 'ven.id=sup.vendor_type','LEFT');
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
		
		//$this->form_validation->set_rules('vendor_code', lang('vendor_code'), 'trim|required|is_unique[supplier_ind.vendor_code]');
       $this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('country', lang('country'), "trim|required");
	    $this->form_validation->set_rules('state_comp', lang('state'), 'trim|required');
		$this->form_validation->set_rules('city_comp', lang('city'), "trim|required");
		 $this->form_validation->set_rules('city_code', lang('city_code'), 'trim|required');
		$this->form_validation->set_rules('pincode', lang('pincode'), "trim|required");
		 $this->form_validation->set_rules('type_of_establishment', lang('type_of_establishment'), 'trim|required');
		$this->form_validation->set_rules('website_address', lang('item_service_description'), "trim|required");
		 $this->form_validation->set_rules('item_description', lang('item_description'), 'trim|required');
		$this->form_validation->set_rules('cin_no', lang('cin'), "trim|required");
		 $this->form_validation->set_rules('pan_no', lang('pan'), 'trim|required');
		$this->form_validation->set_rules('gst_no', lang('gst'), "trim|required");
		 $this->form_validation->set_rules('iec_no', lang('iec'), 'trim|required');
		$this->form_validation->set_rules('tds_section', lang('tds_section'), "trim|required");
		$this->form_validation->set_rules('bank_name', lang('bank_name'), 'trim|required');
		$this->form_validation->set_rules('account_number', lang('account_number'), "trim|required");
		 $this->form_validation->set_rules('account_type', lang('type_of_account'), 'trim|required');
		$this->form_validation->set_rules('ifsc_code', lang('ifsc_code'), "trim|required");
        
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $data['name']           = $this->input->post('name',TRUE);
        $data['vendor_type']        = $this->input->post('vendor_type',TRUE);
		$data['address']           = $this->input->post('address',TRUE);
        $data['factory_address']        = $this->input->post('factory_address',TRUE);
		$data['country']           = $this->input->post('country',TRUE);
        $data['state']        = $this->input->post('state_comp',TRUE);
		$data['city']           = $this->input->post('city_comp',TRUE);
        $data['pincode']        = $this->input->post('pincode',TRUE);
		$data['city_code']           = $this->input->post('city_code',TRUE);
        $data['landline']        = $this->input->post('landline',TRUE);
		$data['established_year']           = $this->input->post('established_year',TRUE);
        $data['type_of_establishment']        = $this->input->post('type_of_establishment',TRUE);
		$data['website_address']           = $this->input->post('website_address',TRUE);
        $data['item_description']        = $this->input->post('item_description',TRUE);
		$data['cin_no']           = $this->input->post('cin_no',TRUE);
        $data['pan_no']        = $this->input->post('pan_no',TRUE);
        $data['iec_no']        = $this->input->post('iec_no',TRUE);
        $data['gst_no']        = $this->input->post('gst_no',TRUE);
		$data['tds_section']           = $this->input->post('tds_section',TRUE);
        $data['tds_age']        = $this->input->post('tds_age',TRUE);
		$data['msme']           = $this->input->post('msme',TRUE);
        $data['msme_number']        = $this->input->post('msme_number',TRUE);
		
		$data['bank_name']           = $this->input->post('bank_name',TRUE);
        $data['account_number']        = $this->input->post('account_number',TRUE);
		$data['account_type']           = $this->input->post('account_type',TRUE);
        $data['bank_address']        = $this->input->post('bank_address',TRUE);
		$data['ifsc_code']           = $this->input->post('ifsc_code',TRUE);
        $data['other_bank_name']        = $this->input->post('other_bank_name',TRUE);
		$data['other_account_number']           = $this->input->post('other_account_number',TRUE);
        $data['other_bank_address']        = $this->input->post('other_bank_address',TRUE);
		$data['other_ifsc_code']           = $this->input->post('other_ifsc_code',TRUE);
		//$data['vendor_code'] = $this->input->post('vendor_code',TRUE);
		
		$this->db->where("id",$id);
        filter_data();
		
		
		set_common_update_value();
        $r = $this->db->update($this->table,$data);
		
					
				$contact_upd['email_id']	=	$_POST['company_contact_email_company'];
				$contact_upd['name']	=	$_POST['company_contact_person'];
				$contact_upd['supplier_id']	=	$id;
				$contact_upd['primary_phone']	=	$_POST['company_contact_person_phone'];
				$contact_upd['department']	=	$_POST['department'];
				$contact_upd['designation']	=	$_POST['designation'];
				$contact_upd['notes']	=	$_POST['notes'];
				$contact_upd['previous_company']	=	$_POST['company_contact_person_previous_company'];
				$contact_upd['personal_email']	=	$_POST['company_contact_email'];
				$contact_upd['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
				$contact_upd['current_working']	=	$_POST['company_contact_person_current_company_status'];
				//pr($contact_upd);die;
				$this->db->where("supplier_id",$supplier_id);
				//set_common_update_value();
				/*End of putting company data into table in form of json*/
				
				//$this->db->update('supplier_ind_contact',$contact_upd);
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
                            $company_doc[$document_key]['supplier_id']   = $id;   
                        }
                    }
                    
                    if(!empty($company_doc))
                    {
                        $this->save_company_doc($company_doc);
                    }
                }
				$note = $_POST['note'];
			if($note){
			  
				//s$this->db->where("supplier_id",$supplier_id);
				set_common_update_value();
				/*End of putting company data into table in form of json*/
				$note_up['note'] = $note;
				$this->db->insert('supplier_ind_notes',$note_up); 
			  
			}
        
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
                "display"   =>lang('vendor_type'),
                "name"      =>"vendor_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('vendor_address'),
                "name"      =>"address",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('item_service_description'),
                "name"      =>"item_description",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('vendor_code'),
                "name"      =>"vendor_code",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('country'),
                "name"      =>"country_name",
                "order_by" => "no"
            ),array(
                "display"   =>lang('state'),
                "name"      =>"state_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('city'),
                "name"      =>"city_name",
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

		$this->db->select('sup.*,co.id as country_id,co.country_name,st.id as state_id,st.state_name,ct.id as city_id,ct.city_name,ven.name as vendor_name');
        $this->db->from('supplier_ind as sup');
        $this->db->join("countries co" , 'co.id=sup.country');
        $this->db->join("states st" , 'st.id=sup.state');
        $this->db->join("cities ct" , 'ct.id=sup.city');
        $this->db->join("supplier_vendor ven" , 'ven.id=sup.vendor_type');
		if(!empty($items)){ 
             $this->db->where_in("sup.id",$items_data);
        }
		
		$query = $this->db->get();

		$data= $query->result();	
		//pr($data);die;
		return $data;
	}*/
    
	
	function fetch_state($country_id){
       
	   if(!empty($country_id)){
		   $country_ids=explode(',',$country_id);
	   }
        $this->db->where_in('country_id', $country_ids);
		$this->db->where_in('status','1');
        $this->db->order_by('state_name', 'ASC');
        $query = $this->db->get('states');
		//echo $this->db->last_query();die;
        if($query->num_rows()>0){
        $output .= '<option value="">Select</option>';
        foreach($query->result() as $row){
           // pr($row);die;
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
        $this->db->where_in('state_id', $state_ids);
		$this->db->where_in('status','1');
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('cities');
		//echo $this->db->last_query();die;
        if($query->num_rows()>0){
        $output .= '<option value="">Select</option>';
        foreach($query->result() as $row){
            //pr($row);die;
			$output .= '<option value="'.$row->id.'">'.$row->city_name.'</option>';
        }
        }else{
			$output .= '<option value="">No city found</option>';
		}
        return $output;
    }
	function uploadDoc($file_arr) {
        
        if (@$file_arr['name'] != '') {
            
            $path = $file_arr['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $name = md5(time());
            $file_name = $name . "." . $ext;
            $folder_doc = './upload/supplier_india_doc/';
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
        return $this->db->insert_batch('supplier_ind_doc', $data);
    }
	
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
        $query=$this->db->query("SELECT id FROM supplier_ind WHERE vendor_code='$vendor_code'");
        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
    }
	
	/*function uploadDoc($file_arr) {
		
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
        $config['allowed_types'] = 'doc|docx|txt|pdf|csv|xls|xlsx';
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
    }*/
	public function get_table_name(){
		$this->db->where('is_deleted','1');
        $this->db->select("*");
		$result = $this->db->get('inch_form');
        if ($result->num_rows > 0) {
            return $result->result();
        }
    }
    
   
}