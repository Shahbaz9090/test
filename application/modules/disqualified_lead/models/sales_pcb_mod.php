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
 
class Sales_Pcb_mod extends CI_Model {

   public $per_page  = "per_page";
    var $table = "leads_sales_pcb";
    var $assign_leads = "assign_leads";
    var $assign_product = "assign_product";
    var $lead_reminder = "lead_reminder";
    var $follow_ups = "follow_ups";
    var $contacts = "contacts";
    var $lead_sales_pcb_others = "lead_sales_pcb_others";
    var $lead_sales_pcb_common = "lead_sales_pcb_common";
    var $disqualify_leads = "disqualify_leads";
    var $company = "companies";
    var $company_contacts = "companies_contact";
    var $lead_sales_pcb_notes = "lead_sales_pcb_notes";
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
      // pr($_POST);die;
        /*$this->db->where("website",$this->input->post('website',TRUE));
        $this->db->where("site_id",current_site_id());
        $r =$this->db->get($this->table);
                
        if($r->num_rows() > 0)
        {      
            set_flashdata("error","The Company Website field must contain a unique value");       
            return FALSE;
                          
        }*/
        
        $this->form_validation->set_rules('vendor_code', lang('vendor_code'), 'trim|required');
        $this->form_validation->set_rules('company_text', lang('name'), 'trim|required');
		$this->form_validation->set_rules('note', lang('note'), 'trim|required');
		//$this->form_validation->set_rules('website', lang('website'), "trim|required");
        
        if($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            return FALSE;
        } 
		//pr($_POST);die;
        //pr($_POST['data']['common']);die;
		//pr($_FILES['document']);die;
			$user_id = currentuserinfo()->id;
			//echo $user_id;
			$company_name = strtolower(@$_POST['company_text']);
			/*@@ Inserting company data into companies table*/
			$this->db->select("*");
			$this->db->where('name',$company_name);
			$company_exit = $this->db->get('companies');
			//pr($company_exit);die;
			if($company_exit->num_rows() > 0){
				$company_exit = $company_exit->result();
				
				$company_id 	=	 $company_exit[0]->id;
				
				$company_upd['name']	=	$company_name;
				$company_upd['website']	=	$_POST['website_address'];
				$company_upd['industry']	=	$_POST['industry'];
				$company_upd['company_address']	=	$_POST['company_address'];
				$company_upd['country']	=	$_POST['country'];
				$company_upd['state_comp']	=	$_POST['state_comp'];
				$company_upd['city_comp']	=	$_POST['city_comp'];
				$company_upd['pincode']	=	$_POST['pincode'];
				$company_upd['cordinates']	=	$_POST['cordinates'];
				$company_upd['city_code']	=	$_POST['city_code'];
				$company_upd['landline']	=	$_POST['landline'];
				$company_upd['fax']	=	'1';
				$company_upd['plant_established_year']	=	$_POST['plant_established_year'];
				$company_upd['type_of_establishment']	=	$_POST['type_of_establishment'];
				$company_upd['type_of_client']	=	$_POST['type_of_client'];
				$company_upd['tax_cin']	=	$_POST['cin'];
				$company_upd['tax_pan']	=	$_POST['pan'];
				$company_upd['tax_tan']	=	$_POST['tan'];
				$company_upd['tax_gst']	=	$_POST['gst'];
				$this->db->where("id",$company_id);
				
					set_common_update_value();
					$this->db->update('companies',$company_upd);
				
			}else{
				
				$company_add['name']	=	$company_name;
				$company_add['website']	=	$_POST['website_address'];
				$company_add['industry']	=	$_POST['industry'];
				$company_add['company_address']	=	$_POST['company_address'];
				$company_add['country']	=	$_POST['country'];
				$company_add['state_comp']	=	$_POST['state_comp'];
				$company_add['city_comp']	=	$_POST['city_comp'];
				$company_add['pincode']	=	$_POST['pincode'];
				$company_add['cordinates']	=	$_POST['cordinates'];
				$company_add['city_code']	=	$_POST['city_code'];
				$company_add['landline']	=	$_POST['landline'];
				$company_add['fax']	=	'1';
				$company_add['plant_established_year']	=	$_POST['plant_established_year'];
				$company_add['type_of_establishment']	=	$_POST['type_of_establishment'];
				$company_add['type_of_client']	=	$_POST['type_of_client'];
				$company_add['tax_cin']	=	$_POST['cin'];
				$company_add['tax_pan']	=	$_POST['pan'];
				$company_add['tax_tan']	=	$_POST['tan'];
				$company_add['tax_gst']	=	$_POST['gst'];
				//$company_add['added_by']	= currentuserinfo()->id;
				set_common_insert_value(); 
				/*End of putting company data into table in form of json*/
				$this->db->insert('companies',$company_add);
				$company_id 	=	$this->db->insert_id();
			}
			
			/*End of inserting company name into company master*/
            
		/*inserting Contact  data into contactlist */
			$comming_mobile_number = $_POST['company_contact_person_phone'];
			/*@@ Inserting contact data into companies_contact table*/
			$this->db->select("*");
			$this->db->where('primary_phone',$comming_mobile_number);
			$contact_exit = $this->db->get('companies_contact');
			//pr($contact_exit);die;
			if($contact_exit->num_rows() > 0){
				$contact_exit = $contact_exit->result();
				
				$contact_up_ids 	=	 $contact_exit[0]->id;
				
				$contact_upds['email_id']	=	$_POST['company_contact_email_company'];
				$contact_upds['name']	=	$_POST['company_contact_person'];
				$contact_upds['company_id']	=	$company_id;
				$contact_upds['primary_phone']	=	$_POST['company_contact_person_phone'];
				$contact_upds['department']	=	$_POST['department'];
				$contact_upds['designation']	=	$_POST['designation'];
				$contact_upds['notes']	=	$_POST['notes'];
				$contact_upds['previous_company']	=	$_POST['company_contact_person_previous_company'];
				$contact_upds['personal_email']	=	$_POST['company_contact_email'];
				$contact_upds['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
				$contact_upds['company_status']	=	$_POST['company_contact_person_current_company_status'];
				//$this->db->where("id",$contact_up_ids);
				
					set_common_update_value();
					//$this->db->update('companies_contact',$contact_upds);
					$contact_id = $contact_up_ids;
				
			}else{
				$contact_add['email_id']	=	$_POST['company_contact_email_company'];
				$contact_add['name']	=	$_POST['company_contact_person'];
				$contact_add['company_id']	=	$company_id;
				$contact_add['primary_phone']	=	$_POST['company_contact_person_phone'];
				$contact_add['department']	=	$_POST['department'];
				$contact_add['designation']	=	$_POST['designation'];
				$contact_add['notes']	=	$_POST['notes'];
				$contact_add['previous_company']	=	$_POST['company_contact_person_previous_company'];
				$contact_add['personal_email']	=	$_POST['company_contact_email'];
				$contact_add['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
				$contact_add['company_status']	=	$_POST['company_contact_person_current_company_status'];
				//pr($contact_add);die;
				set_common_insert_value(); 
				/*End of putting company data into table in form of json*/
				//$this->db->insert('companies_contact',$contact_add);
				$contact_id 	=	$this->db->insert_id();
			
			}
			
			/*End of inserting contact data into companies */
		$data = $this->input->post(null, true);
		
		$lead_add['company_name'] = $company_id;
		$lead_add['company_contact'] = $contact_id;
		$lead_add['lead_status'] = '1';
		$lead_add['note'] = $_POST['note'];
		$lead_add['vendor_code'] = $_POST['vendor_code'];
        /*$fileData=$this->uploadDoc($_FILES['document']);
		
        if(isset($fileData['success'])){
            $lead_add['document'] = $fileData['success']['file_name'];   
        }*/
		
        set_common_insert_value();        
        $this->db->insert($this->table,$lead_add);           
        $id = $this->db->insert_id();
        // add company notes
		$note['lead_id'] 	= $id;
		$note['note']  	= $_POST['note'];
		set_common_insert_value();    
		$this->db->insert('leads_sales_pcb_notes',$note); 
        /*Start save client multiple  document*/
        $leads_sales_pcb_doc = [];
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
                    $leads_sales_pcb_doc[$document_key]['filename']	= $fileData['success']['file_name'];   
                    $leads_sales_pcb_doc[$document_key]['leads_sales_pcb_id']   = $id;   
                }
            }
            
            if(!empty($leads_sales_pcb_doc))
            {
                $this->db->insert_batch('leads_sales_pcb_doc', $leads_sales_pcb_doc);
            }
        }
		$this->db->where('id',$id);
        $this->db->update($this->table,array('display_id'=>(1000+$id)));
		//pr($_POST['note']);die;
		//$note = $_POST['note'];
          if($note){
                /*$noteArray=array(
                  'lead_id'=>$id,
                  'added_by'=>$user_id,
                  'note'=>$note,
                  'created'=>date_time(),
                  'modified'=>date_time()
                );*/
             //pr($noteArray);die;
			//$inser_id=$this->db->insert($this->lead_sales_pcb_notes,$noteArray);
		  $currentuserinfo=currentuserinfo();
                $display_id=fieldByCondition("$this->table",array('id'=>$id),"display_id")->display_id;
              //print_r($display_id);die;
                /*$email_data['to'] = $currentuserinfo->email;
                $email_data['from'] = ADMIN_EMAIL;
                $email_data['sender_name'] = ADMIN_NAME;
                $email_data['subject'] = "Tek Lead Crm- Notes Added";
                $email_data['message'] = array(
                    'header' => " A New Note  has been added by you on lead #$display_id",
                    'body' => '',
                    'button_content' => 'Click here to view',
                    'button_link' => base_url() . 'lead/view/' . $id);
                _sendEmail($email_data);*/
		  }
		  
		  // add all other Information 
		  
		  $othersData = $_POST['data']['other'];
		  $othersData['lead_id'] = $id;
		  $othersData['open_macho_varient_count'] = $_POST['open_macho_varient_count'];
		  
		   $this->addOthers($othersData);
		   
		   // add all common Information 
		  
		  /*$commonData = $_POST['data']['common'];
		  $commonData['lead_id'] = $id;
		  $commonData['open_plc_varient_count'] = $_POST['open_plc_varient_count'];
		  $commonData['open_actuator_varient_count'] = $_POST['open_actuator_varient_count'];
		  $commonData['open_vfd_varient_count'] = $_POST['open_vfd_varient_count'];
		  $commonData['lead_id'] = $id;
		  $commonData['lead_id'] = $id;
		  
		   $this->addCommon($commonData);*/
		  // Add Reminders
		  
		   $remindersData['lead_id'] = $id;
		   $this->addReminder($remindersData);
		   
		   //Add Followups Date
		   $followUpsData['lead_id'] = $id;
           $this->addFollowUpDate($followUpsData);
		   
		    if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();

                ////////email lead report to lead created user
                /*$content['data'] = $data;
                $content['contact_data'] = $contact_add;
                $body = $this->load->view('email_lead_detail', $content, true);
                $currentuserinfo=currentuserinfo();
                $display_id=fieldByCondition("$this->table",array('id'=>$id),"display_id")->display_id;
                $email_data['to'] = $currentuserinfo->email;
                $email_data['from'] = ADMIN_EMAIL;
                $email_data['sender_name'] = ADMIN_NAME;
                $email_data['subject'] = "Tek Lead Crm- Lead Created";
                $email_data['message'] = array(
                    'header' => "New Lead #$display_id has been created successfully !",
                    'body' => $body,
                    'button_content' => 'Click here to view',
                    'button_link' => base_url() . 'lead/view/' . $id);
                _sendEmail($email_data);*/
                /*$hierarchy=usersByHierarchy();
                foreach($hierarchy as $user_id=>$user_email){
                    $email_data['to'] = $user_email;
                    $email_data['message']['header']="A New Lead #$display_id has been created by $currentuserinfo->name!";
                    _sendEmail($email_data);
                }*/
                //////////////////////////////////////////////
            }
		   
				add_report($id);
        
				//set_flashdata("success",lang('success'));
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
        filter_data('lead');
		$this->db->select('lead.*,lead.id as main_id,companies.name as companys_name,companies.industry as comp_industry,companies.*,cont.*,cont.name as contact_person_name,lnd.note as lead_sales_pcb_notes,ins.name as industry_name,con.country_name as country_name,st.state_name as state_name,ct.city_name as city_name,dept.name as department_name,desg.name as designation_name');
		$this->db->join('companies','companies.id =lead.company_name','left');
		$this->db->join('companies_contact as cont','cont.id =lead.company_contact','left');
		$this->db->join('leads_sales_pcb_notes as lnd','lnd.lead_id =lead.id','left');
		$this->db->join('industry as ins','ins.id =companies.industry','left');
		$this->db->join('countries as con','con.id =companies.country','left');
		$this->db->join('states as st','st.id =companies.state_comp','left');
		$this->db->join('cities as ct','ct.id =companies.city_comp','left');
		$this->db->join('department as dept','dept.id =cont.department','left');
		$this->db->join('designation as desg','desg.id =cont.designation','left');
		$this->db->from("leads_sales_pcb as lead");
        $this->db->where('lead.id',$id);
        $query = $this->db->get();
		//echo $this->db->last_query();die;
		if($query->num_rows() > 0){
			$query = $query->row();
		}
        //pr($query);die;
		/*fetching Trading varients*/
		$common_id = $query->company_name;
		$this->db->select('*');
        $this->db->where('lead_id', $common_id);
        $menu_varient_plc = $this->db->get("lead_sales_pcb_common_plc")->result();
        @$query->lead_sales_pcb_common_plc  =   $menu_varient_plc;
        
        $this->db->select('*');
        $this->db->where('lead_id', $common_id);
        $menu_varient_actuator = $this->db->get("lead_sales_pcb_common_actuator")->result();
        @$query->lead_sales_pcb_common_actuator =   $menu_varient_actuator;
        
        $this->db->select('*');
        $this->db->where('lead_id', $common_id);
        $menu_varient_vfd = $this->db->get("lead_sales_pcb_common_vfd")->result();
        @$query->lead_sales_pcb_common_vfd  =   $menu_varient_vfd;
		
		// fet all form information on other data
		$this->db->select('*');
        $this->db->where('lead_id', $id);
        $menu_varient_other = $this->db->get("lead_sales_pcb_others")->result();
		@$query->lead_sales_pcb_others	=	$menu_varient_other;
		
		$this->db->select('*');
        $this->db->where('leads_sales_pcb_id', $id);
        $leads_sales_pcb_doc = $this->db->get("leads_sales_pcb_doc")->result();
        @$query->leads_sales_pcb_doc  =   $leads_sales_pcb_doc;
        //pr($this->db->last_query());die;
       return $query;
           
        //show_404();
    }
    
    
    
    // ------------------------------------------------------------------------ // ------------------------------------------------------------------------
	function get_notes($id = NULL)
    {
		//pr($id);die;
		
        $this->db->select("leads_sales_pcb_notes.*,users.first_name,users.last_name");
		$this->db->join('users','users.id =leads_sales_pcb_notes.added_by');
		$this->db->from("leads_sales_pcb_notes");
		$this->db->where('lead_id',$id);
		$this->db->order_by("note","desc");
		$result = $this->db->get();
		if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
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
        $this->db->where('status','1');
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
    function ajax_list_items($text, $limit, $offset, $order_by='id', $order='desc',$user) {
        $offset = ($offset - 1) * $limit;
		//pr($user);die;
        $this->db->limit($limit, $offset);
        if($this->input->post('filter_by') == 'date'){
			$duration	=	$this->input->post('search');
		}
		if(isset($duration) && $duration != ''){
			$duration	=	explode('-',$duration);
			$start_date = 	date("Y-m-d",strtotime(trim($duration[0])));
			$end_date = 	date("Y-m-d",strtotime(trim($duration[1])));
		}
        $this->db->select("SQL_CALC_FOUND_ROWS $this->table.*, CASE WHEN $this->table.lead_status='1' THEN 'Qualified' ELSE 'Unknown' END AS lead_status,utu.first_name AS USER_NAME,ut.first_name AS TELEMARKETER_NAME,$this->company_contacts.name as contact_name,concat(utu.first_name,' ',utu.last_name) as added_by, $this->company.name as company_name", false);
        if (!empty($text)) {
            $text   =   trim($text);
            if(is_numeric($text)){
                $this->db->where("display_id", $text); 
                $this->db->or_where("$this->table.vendor_code", $text); 
            }else{
                $text = strtolower($text);
                //$this->db->where("($this->company.company like '%".$text."%' OR $this->referral_source.name like '%".$text."%' OR $this->table.priority = '".$text."%')");
                //$this->db->or_like("$this->company.company",$text);
                $this->db->like("LOWER(CONCAT($this->company.name,' ',$this->company_contacts.name,' ',$this->table.vendor_code,' ',utu.first_name,' ',utu.last_name))", $text);
            }
        }
        $this->db->join($this->company, "$this->company.id=$this->table.company_name",'left');
        $this->db->join($this->company_contacts, "$this->company_contacts.id=$this->table.company_contact",'left');
		//$this->db->join($this->contacts, "$this->contacts.lead_id = $this->table.id",'left');
        //$this->db->join($this->referral_source, "$this->referral_source.id=$this->table.referral_source", 'left');
        $this->db->join("$this->users as utu", "utu.id=$this->table.added_by", 'left');
		$this->db->join("$this->users as ut", "ut.id=$this->table.assigned_telemarketer", 'left');
		$this->db->where('lead_status', '1');
		
		if(@$start_date && @$start_date != ''){
			$this->db->where("date($this->table.created) >= ", $start_date);
		}
		if(@$end_date && @$end_date != ''){
			$this->db->where("date($this->table.created) <= ", $end_date);
		}
		
		/*Applying custom filter from leads listing page*/
		if(@$this->input->post('filter_by') == 'added_by')		/*Is for added by*/
		{
			$search = strtolower(@$this->input->post('search'));
			$this->db->like('lower(CONCAT(utu.first_name," ",utu.last_name) )',$search);
			//$this->db->or_like('lower(utu.first_name)',$search);
		}else if(@$this->input->post('filter_by') == 'assigned_telemarketer'){		/*Is for assigned telemarketer*/
			$search = strtolower(@$this->input->post('search'));
			$this->db->like('lower(CONCAT(ut.first_name," ",ut.last_name) )',$search);
			//$this->db->or_like('lower(ut.last_name)',$search);
		}
		
		/*End of Applying custom filter from leads listing page*/
        if($order_by =='follow_up_date'){
            $this->db->order_by('modified', 'desc');   
        }else{
            $this->db->order_by($order_by, $order);
        }
		
        $this->db->limit($limit, $offset);

        
		//echo "yesss";die;
        /*if (_isTaleMarketer() || _isSalesPerson()) { //talemarketer and sales person lists own or assigned data only
            $this->db->where("($this->table.added_by", _userId());
            $this->db->or_where('assigned_telemarketer', _userId() . ')', false);
        }else{
			if (is_array($user)) {
				$this->db->where_in('leads.added_by', $user);
			} else if ($user) {
				if($is_all == ''){
					
				}else if($is_all == '' && $user != 1){
					$this->db->where('leads.added_by', $user);
				}else if($is_all == 'yes'){
					//$this->db->where('leads.added_by', $user);
				}else if($is_all == 'no'){
					$this->db->where('leads.added_by', $user);
				}
			}else if($user == '' && _userId() != 1){
				$this->db->where('leads.added_by', _userId());
			}
		}*/
		//echo "yesss";die;
        $query = $this->db->get($this->table);
        //echo $this->db->last_query();exit;
        $result['result'] = $query->result_array();

        //check if lead is private or public for sales manager
       /* if (_isSalesManager()) {
            foreach ($result['result'] as $k => $v) {
                if ($v['lead_type'] == '2' && $v['added_by'] != _userId()) {
                    unset($result['result'][$k]);
                }
            }
        }*/
		//echo "yesss";die;
        //filter_data($this->table);      
        //$querys = $this->db->get();
        //pr($querys->result());exit;
        //echo $this->db->last_query();exit;

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
		$vendor_code = $this->input->post('vendor_code',TRUE);
		$this->db->select('vendor_code,id');
		$this->db->from('leads_sales_pcb');
		$this->db->where_in('id',$id);
		$query = $this->db->get();
		$result = $query->row();
       $this->form_validation->set_rules('company_text', lang('name'), 'trim|required');
	  // $this->form_validation->set_rules('note', lang('note'), 'trim|required');
  	    $this->form_validation->set_rules('vendor_code', lang('vendor_code'), 'trim|required');
		//$st = $this->is_unique_vendor_code($this->input->post('vendor_code',TRUE));
  	    //$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
        
        if ($this->form_validation->run() == FALSE)
        {
            //set_flashdata("error",validation_errors());
            return FALSE;
        }
		/*elseif ($st == TRUE)
        {	//pr("yaa");die;
        	$data_status = 'error';
            //set_flashdata("error","Oops !! This Vendor Code is Alreday Exists.");
            return $data_status;
        } */
		//pr($_POST);die;
		$user_id = currentuserinfo()->id;
		$lead_id = $id;
		$company_id = $_POST['company_id'];
		$contact_id = $_POST['contact_id'];
		$company_name = strtolower(@$_POST['company_text']);
		
		
				$company_up['name']	=	$company_name;
				$company_up['website']	=	$_POST['website_address'];
				$company_up['industry']	=	$_POST['industry'];
				$company_up['company_address']	=	$_POST['company_address'];
				$company_up['country']	=	$_POST['country'];
				$company_up['state_comp']	=	$_POST['state_comp'];
				$company_up['city_comp']	=	$_POST['city_comp'];
				$company_up['pincode']	=	$_POST['pincode'];
				$company_up['cordinates']	=	$_POST['cordinates'];
				$company_up['city_code']	=	$_POST['city_code'];
				$company_up['landline']	=	$_POST['landline'];
				$company_up['fax']	=	'1';
				$company_up['plant_established_year']	=	$_POST['plant_established_year'];
				$company_up['type_of_establishment']	=	$_POST['type_of_establishment'];
				$company_up['type_of_client']	=	$_POST['type_of_client'];
				$company_up['tax_cin']	=	$_POST['cin'];
				$company_up['tax_pan']	=	$_POST['pan'];
				$company_up['tax_tan']	=	$_POST['tan'];
				$company_up['tax_gst']	=	$_POST['gst'];
				//pr($company_up);die;
				$this->db->where("id",$company_id);
				
				set_common_update_value();
				$this->db->update('companies',$company_up);
				
				
				/*inserting Contact  data into contactlist */
			
				$contact_upd['email_id']	=	$_POST['company_contact_email_company'];
				$contact_upd['name']	=	$_POST['company_contact_person'];
				$contact_upd['company_id']	=	$company_id;
				$contact_upd['primary_phone']	=	$_POST['company_contact_person_phone'];
				$contact_upd['department']	=	$_POST['department'];
				$contact_upd['designation']	=	$_POST['designation'];
				$contact_upd['notes']	=	$_POST['notes'];
				$contact_upd['previous_company']	=	$_POST['company_contact_person_previous_company'];
				$contact_upd['personal_email']	=	$_POST['company_contact_email'];
				$contact_upd['secondary_phone']	=	$_POST['company_contact_person_personal_mobile'];
				$contact_upd['company_status']	=	$_POST['company_contact_person_current_company_status'];
				//pr($contact_upd);die;
				//$this->db->where("id",$contact_id);
				//set_common_update_value();
				/*End of putting company data into table in form of json*/
				
				//$this->db->update('companies_contact',$contact_upd);
				
			
			
			
			/*End of inserting contact data into companies */
		$data = $this->input->post(null, true);
		
		$lead_upd['company_name'] = $company_id;
		$lead_upd['company_contact'] = $contact_id;
		$lead_upd['lead_status'] = '1';
		$lead_upd['note'] = $_POST['note'];
		$lead_upd['vendor_code'] = $_POST['vendor_code'];
		
		
        /*$fileData=$this->uploadDoc($_FILES['document']);
		
        if(isset($fileData['success'])){
            $lead_upd['document'] = $fileData['success']['file_name'];   
        }*/
		// add company notes
		$val = $_POST['note'];
        if($val){
		$note['lead_id'] 	= $id;
		$note['note']  	= $_POST['note'];
		set_common_insert_value();    
		$this->db->insert('leads_sales_pcb_notes',$note); 
		}
		/*Start save client multiple  document*/
        $leads_sales_pcb_doc = [];
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
                    $leads_sales_pcb_doc[$document_key]['filename']	= $fileData['success']['file_name'];   
                    $leads_sales_pcb_doc[$document_key]['leads_sales_pcb_id']   = $lead_id;   
                }
            }
            
            if(!empty($leads_sales_pcb_doc))
            {
                $this->db->insert_batch('leads_sales_pcb_doc', $leads_sales_pcb_doc);
            }
        }
		$this->db->where("id",$lead_id);
				set_common_update_value();
				/*End of putting company data into table in form of json*/
				
				$r = $this->db->update($this->table,$lead_upd);
		/*$note = $_POST['note'];
          if($note){
			  
				$this->db->where("lead_id",$lead_id);
				set_common_update_value();
				
				$note_up['note'] = $note;
				$this->db->update($this->lead_sales_pcb_notes,$note_up); 
			  
		  }*/
		  
		  
		  // add all other Information 
		  
		  $othersData = $_POST['data']['other'];
		  $othersData['lead_id'] = $lead_id;
		  $othersData['open_macho_varient_count'] = $_POST['open_macho_varient_count'];
		  $othersData['macho_varient_all_ids'] = $_POST['macho_varient_all_ids'];
		  
		   $this->addOthers($othersData);
		   
		   // add all common Information 
		  
		 /* $commonData = $_POST['data']['common'];
		  $commonData['lead_id'] = $lead_id;
		  $commonData['open_plc_varient_count'] =  $_POST['open_plc_varient_count'];
		  $commonData['plc_varient_all_ids'] = $_POST['plc_varient_all_ids'];
		  $commonData['open_actuator_varient_count'] =  $_POST['open_actuator_varient_count'];
		  $commonData['actuator_varient_all_ids'] = $_POST['actuator_varient_all_ids'];
		  $commonData['open_vfd_varient_count'] =  $_POST['open_vfd_varient_count'];
		  $commonData['vfd_varient_all_ids'] = $_POST['vfd_varient_all_ids'];
		  $commonData['lead_id'] = $lead_id;
		  $commonData['lead_id'] = $lead_id;
		  
		   $this->addCommon($commonData);*/
		  // Add Reminders
		  
		   $remindersData['lead_id'] = $lead_id;
		   $this->addReminder($remindersData);
		   
		   //Add Followups Date
		   $followUpsData['lead_id'] = $lead_id;
           $this->addFollowUpDate($followUpsData);
		   
		    if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();

                ////////email lead report to lead created user
                /*$content['data'] = $data;
                $content['contact_data'] = $contact_add;
                $body = $this->load->view('email_lead_detail', $content, true);
                $currentuserinfo=currentuserinfo();
                $display_id=fieldByCondition("$this->table",array('id'=>$id),"display_id")->display_id;
                $email_data['to'] = $currentuserinfo->email;
                $email_data['from'] = ADMIN_EMAIL;
                $email_data['sender_name'] = ADMIN_NAME;
                $email_data['subject'] = "Tek Lead Crm- Lead Created";
                $email_data['message'] = array(
                    'header' => "New Lead #$display_id has been created successfully !",
                    'body' => $body,
                    'button_content' => 'Click here to view',
                    'button_link' => base_url() . 'lead/view/' . $id);
                _sendEmail($email_data);*/
                /*$hierarchy=usersByHierarchy();
                foreach($hierarchy as $user_id=>$user_email){
                    $email_data['to'] = $user_email;
                    $email_data['message']['header']="A New Lead #$display_id has been created by $currentuserinfo->name!";
                    _sendEmail($email_data);
                }*/
                //////////////////////////////////////////////
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
                "display"   =>lang('lead_id'),
                "name"      =>"display_id",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('name'),
                "name"      =>"company_name",
                "order_by" => "yes"
            ),/*array(
                "display"   =>lang('company_contact'),
                "name"      =>"contact_name",
                "order_by" => "no"
            ),*/array(
                "display"   =>lang('added_by'),
                "name"      =>"added_by",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('vendor_code'),
                "name"      =>"vendor_code",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('disqualified_date'),
                "name"      =>"modified_time",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('follow_up_date'),
                "name"      =>"follow_up_date",
                "order_by" => "yes"
            ),
            array(
                "display"   =>lang('lead_status'),
                "name"      =>"lead_status",
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

		$this->db->select("$this->table .id,$this->table .name,$this->table .website");
        $this->db->from("$this->table");
		$this->db->order_by("name");

		$this->db->where_in("id",$items_data);
       
        $query = $this->db->get();
        
        $data= $query->result_array();		
		return $data;
	}
	
	
	function uploadDoc($file_arr) {
		
		if (@$file_arr['name'] != '') {
			
			$path = $file_arr['name'];
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $name = md5(time());
            $file_name = $name . "." . $ext;
			$folder_doc = './upload/sales_pcb/';
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
	
	//--------------------------------------------------------------------
    /**
     * addFollowUpDate
     *
     * This function add Multiples row of Follow Up Date
     * 
     * @access	public
     * @return	TRUE or FALSE 
     */
    function addFollowUpDate($data = array()) {
        $remark = $data['remark'];
        if (!empty($data['follow_up_date'])) {
            foreach ($data['follow_up_date'] as $key => $followUpDate) {
                $id = $data['follow_id'][$key];
                unset($data['follow_id'][$key]);
                $remark[$key] = str_replace("'", " ", $remark[$key]);
                if ($followUpDate) {
                    $array = array(
                        'lead_id' => $data['lead_id'],
                        'follow_up_date' => date('Y-m-d H:i:s',strtotime($followUpDate)),
                        'remark' => $remark[$key],
                        'modified' => _dateTime());
                    if (isset($id) && $id) {
                        $this->db->where('id', $id);
                        $this->db->update($this->follow_ups, $array);
                    } else {
                        $array['created'] = _dateTime();
                        $this->db->insert($this->follow_ups, $array);
                        $last_id = $this->db->insert_id();
                    }
                }
            }
        }
        return;
    }
    //--------------------------------------------------------------------
    
       
    /**
     * addReminder
     *
     * This function add Multiples row of Reminder
     * 
     * @access	public
     * @return	TRUE or FALSE 
     */
    function addReminder($data = array()) {
        $reminder_description = $data['reminder_description'];
        if (!empty($data['reminder'])) {
            foreach ($data['reminder'] as $key => $reminder) {
                $id = $data['reminder_id'][$key];
                unset($data['reminder_id'][$key]);
                $reminder_description[$key] = str_replace("'", " ", $reminder_description[$key]);
                if ($reminder) {
                    $array = array(
                        'lead_id' => $data['lead_id'],
                        'reminder' => date('Y-m-d H:i:s',strtotime($reminder)),
                        'reminder_description' => $reminder_description[$key],
                        'modified' => _dateTime());
                    if (isset($id) && $id) {
                        $this->db->where('id', $id);
                        $this->db->update($this->lead_reminder, $array);
                    } else {
                        $array['created'] = _dateTime();
                        $this->db->insert($this->lead_reminder, $array);
                        $last_id = $this->db->insert_id();
                    }
                }

            }
        }
        return;
    }
    //--------------------------------------------------------------------
	
	/**
     * addOthers
     *
     * This function save dynamic fields data of lead form
     * 
     * @access	public
     * @return	TRUE or FALSE 
     */
    function addOthers($data = array()) {
		//pr($data);die;
        $leadOthers = _otherFieldsData($this->lead_sales_pcb_others, 'lead_id', $data['lead_id']);
		//pr($leadOthers);die;
		//pr($leadOthers);die;
       
        if ($leadOthers) {
            
			 $len_macho = $data['open_macho_varient_count'];
			 
			 //pr($len_macho);die;
            for ($i = 0; $i < $len_macho; $i++) {
				
				if ($data['macho_varient_all_ids'][$i] != '') {
					
				$macho_varient_id_up = $_POST['macho_varient_all_ids'][$i];
                $varient_menu['lead_id'] = $data['lead_id'];
                $varient_menu['modified'] = _dateTime();
                $varient_menu['type_make_machine'] = $data['type_make_machine'][$i];
                $varient_menu['make_model_controller'] = $data['make_model_controller'][$i];
                $varient_menu['no_machine'] = $data['no_machine'][$i];
                $varient_menu['qty_controller'] = $data['qty_controller'][$i];
					
					if(!empty($data['type_make_machine'][$i])){
					$this->db->where('id', $macho_varient_id_up);
					$this->db->update($this->lead_sales_pcb_others, $varient_menu);
					//pr($this->db->last_query());die;
					}else{
						$this->db->where('id', $macho_varient_id_up);
						$this->db->delete($this->lead_sales_pcb_others);
					}
				}else{
				$varient_menu['lead_id'] = $data['lead_id'];
                $varient_menu['created'] = _dateTime();
                $varient_menu['type_make_machine'] = $data['type_make_machine'][$i];
                $varient_menu['make_model_controller'] = $data['make_model_controller'][$i];
                $varient_menu['no_machine'] = $data['no_machine'][$i];
                $varient_menu['qty_controller'] = $data['qty_controller'][$i];
				if(!empty($data['type_make_machine'][$i])){
					$this->db->insert($this->lead_sales_pcb_others, $varient_menu);
					}
				}
			
			}
		
			
			
        } else {
            //$data['created'] = _dateTime();
			
				//inserting Other varient in table
			 $len_macho = $data['open_macho_varient_count'];
			 //echo $len_macho;die;
			 
            for ($i = 0; $i < $len_macho; $i++) {
                $varient_menu['lead_id'] = $data['lead_id'];
                $varient_menu['created'] = _dateTime();
                $varient_menu['type_make_machine'] = $data['type_make_machine'][$i];
                $varient_menu['make_model_controller'] = $data['make_model_controller'][$i];
                $varient_menu['no_machine'] = $data['no_machine'][$i];
                $varient_menu['qty_controller'] = $data['qty_controller'][$i];
				$this->db->insert($this->lead_sales_pcb_others, $varient_menu);
			}
			
			
            
        }
        return;
    }
    //-----------------------------------------------------------------------
	
	
	/**
     * addCommon Data
     *
     * This function save dynamic fields data of lead form
     * 
     * @access	public
     * @return	TRUE or FALSE 
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
					$varient_menu_plc['created'] = _dateTime();
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
				$varient_menu_plc['created'] = _dateTime();
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
					$varient_menu_actuator['created'] = _dateTime();
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
				$varient_menu_actuator['created'] = _dateTime();
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
					$varient_menu_vfd['created'] = _dateTime();
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
				$varient_menu_vfd['created'] = _dateTime();
                $varient_menu_vfd['vfd_make'] = $data['vfd_make'][$i];
                $varient_menu_vfd['vfd_qty'] = $data['vfd_qty'][$i];
				$this->db->insert('lead_sales_pcb_common_vfd', $varient_menu_vfd);
			}
		}
		
		
		
		
		
			
            
        
        return;
    }
    
	public function check_vendor_code_existance($vendor_code) {
        //$database=DEFAULT_DATABASE;
        $query=$this->db->query("SELECT id FROM leads_sales_pcb WHERE vendor_code='$vendor_code'");
        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
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
     * appointment_data
     *
     * This function show appointment data
     * 
     * @access	public
     * @return  json array 
     */
    function appointment_data() {
		$var = strtolower($this->uri->segment(2));
		$this->session->set_userdata('module_key',$var);
		$data = $this->session->userdata('module_key');
        $this->db->select('id,lead_id,type,appointment_name as title,description,appointment_date as start,module');
        $this->db->where('module',$data);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('appointment');
		//pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return $query->result();
        }
    }
	/**
     * Disqualified
     *
     * This function show Disqualified
     * 
     * @access	public
     * @return  json array 
     */
    function disqualified_notes() {
		$var = strtolower($this->uri->segment(2));
		$this->db->select('id,lead_status,disqualified_reason');
        $this->db->order_by('id', 'desc');
		$query = $this->db->get('leads_sales_pcb');
		//pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return $query->result();
        }
    }
	
	/**
     * Disqualified
     *
     * This function show Disqualified
     * 
     * @access	public
     * @return  json array 
     */
    function product() {
		$var = strtolower($this->uri->segment(2));
		$this->db->select('id,product');
        $this->db->order_by('id', 'desc');
		$query = $this->db->get('leads_sales_pcb');
		//pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return $query->result();
        }
    }
	
	/**
     * Disqualified
     *
     * This function show Disqualified
     * 
     * @access	public
     * @return  json array 
     */
    function service() {
		$var = strtolower($this->uri->segment(2));
		$this->db->select('id,service');
        $this->db->order_by('id', 'desc');
		$query = $this->db->get('leads_sales_pcb');
		//pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return $query->result();
        }
    }
	
	/**
     * notes
     *
     * This function show notes
     * 
     * @access	public
     * @return  json array 
     */
    function notes() {
		$var = strtolower($this->uri->segment(2));
		$this->session->set_userdata('module_key',$var);
		$data = $this->session->userdata('module_key');
        $this->db->select('id,lead_id,notes');
        $this->db->where('module',$data);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('installation_view_notes');
		//pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return $query->result();
        }
    }
	
	public function check_name_existance($company_text,$id=null) {
		
       // pr($vendor_code);die;
        if(empty($id)){  //pr("yess");
            $query=$this->db->query("SELECT id FROM companies WHERE companies.name='$company_text'");
            $result = $query->row();
            //pr($result);die;
            $query1 = $this->db->query("SELECT company_name FROM leads_sales_pcb WHERE leads_sales_pcb.company_name=".$result->id);
            
        }else{  //pr("no");
        	$query=$this->db->query("SELECT id FROM companies WHERE companies.name='$company_text'");
            $result = $query->row();
            //pr($result);die;
            $query1 = $this->db->query("SELECT company_name FROM leads_sales_pcb WHERE leads_sales_pcb.id !='$id' && leads_sales_pcb.company_name=".$result->id);
        }
		//pr($this->db->last_query());die;
		$count=$query1->num_rows(); 
		//pr($count);die;
		if ($count > 0)
            return true;
	}


	public function is_unique_vendor_code($vendor_code) {

        //$database=DEFAULT_DATABASE;
        // echo "SELECT id FROM $this->table WHERE country_name='$name' AND id!=".$country_id;die;
        $id = $this->uri->segment(4);
		//pr($id);die;
        $query=$this->db->query("SELECT id FROM leads_sales_pcb WHERE vendor_code='$vendor_code' AND id!=".$id);
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