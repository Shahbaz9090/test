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
 
class Lead_mod extends CI_Model {

   // public $table     = "companies";
	public $per_page  = "per_page";
    var $table = "leads";
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
        
        $this->db->where("website",$this->input->post('website',TRUE));
        $this->db->where("site_id",current_site_id());
        $r =$this->db->get($this->table);
                
        if($r->num_rows() > 0)
        {      
            set_flashdata("error","The Company Website field must contain a unique value");       
            return FALSE;
                          
        }
        
        
        $this->form_validation->set_rules('name', lang('name'), 'trim|required');
		$this->form_validation->set_rules('website', lang('website'), "trim|required");
        
        if($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $data['name']           = $this->input->post('name',TRUE);
        $data['website']        = $this->input->post('website',TRUE);
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
        filter_data($this->table);
        $this->db->where('id',$id);
        $query = $this->db->get($this->table);
        
        if($query->num_rows() > 0)
           return $query->row();
           
        show_404();
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
        $this->db->select("SQL_CALC_FOUND_ROWS $this->table.*,utu.first_name AS USER_NAME,ut.first_name AS TELEMARKETER_NAME,$this->contacts.contact_person,(select concat(first_name,' ',last_name) from users where id = $this->table.added_by) as ADDED_BY", false);
        if (!empty($text)) {
			$text	=	trim($text);
            if(is_numeric($text)){
                $this->db->where("display_id", $text); 
            }else{
                $text = strtolower($text);
				//$this->db->where("($this->company.company like '%".$text."%' OR $this->referral_source.name like '%".$text."%' OR $this->table.priority = '".$text."%')");
				//$this->db->or_like("$this->company.company",$text);
                $this->db->like("LOWER(CONCAT($this->company.company_data,' ',$this->company_contacts.contacts_data,' ',referral_source,' ',priority,' ',$this->referral_source.name,ut.first_name,' ',ut.last_name))", $text);   
            }
        }
        $this->db->join($this->company, "$this->company.id=$this->table.company_name",'left');
        $this->db->join($this->company_contacts, "$this->company_contacts.id=$this->table.company_contact",'left');
		$this->db->join($this->contacts, "$this->contacts.lead_id = $this->table.id",'left');
        $this->db->join($this->referral_source, "$this->referral_source.id=$this->table.referral_source", 'left');
        $this->db->join("$this->users as utu", "utu.id=$this->table.added_by", 'left');
		$this->db->join("$this->users as ut", "ut.id=$this->table.assigned_telemarketer", 'left');
		
		
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

        if ($status == 'archieved') {
            $this->db->where('lead_status', '1');
        } else {
            $this->db->where('lead_status', '0');
        }
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
       $this->form_validation->set_rules('name', lang('name'), 'trim|required');
  	    //$this->form_validation->set_rules('website', lang('website'), "trim|required|is_unique[$this->table.website]");
        
        if ($this->form_validation->run() == FALSE)
        {
            set_flashdata("error",validation_errors());
            return FALSE;
        } 
        
        $data['name']               = $this->input->post('name',TRUE);
       // $data['website']            = $this->input->post('website',TRUE);
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
                "display"   =>lang('lead_id'),
                "name"      =>"display_id",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('name'),
                "name"      =>"company_name",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('company_contact'),
                "name"      =>"company_contact",
                "order_by" => "no"
            ),array(
                "display"   =>lang('referral_source'),
                "name"      =>"referral_source",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('priority'),
                "name"      =>"priority",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('assigned_telemarketer'),
                "name"      =>"assigned_telemarketer",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('added_by'),
                "name"      =>"added_by",
                "order_by" => "yes"
            ),array(
                "display"   =>lang('created_date'),
                "name"      =>"created",
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
    
    
   
}