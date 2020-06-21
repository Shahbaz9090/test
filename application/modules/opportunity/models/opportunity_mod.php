<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Opportunity_mod extends CI_Model {

    var $table = "leads_sales_spares";
    var $appointment = "appointment";
    var $assign_leads = "assign_leads";
    var $assign_product = "assign_product";
    var $contacts = "contacts";
    var $company = "company";
    var $company_contacts = "company_contacts";
    var $users = "users";
    var $referral_source = "referral_source";
    var $tasks = "tasks";
    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function Add Opportunity
     * 
     * @access	public
     * @return	int or Boolean
     */
    function add() {
        $data = $this->input->post(null, true);
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        $this->session->set_flashdata("success", "Great..!! Opportunity Created Successfully");
        return $id;
    }
	
	function get() {
        $this->db->select('appointment.*,inch_set_notification_type.notification_type');
		$this->db->join("inch_set_notification_type" , 'inch_set_notification_type.form_id=appointment.type');
		$this->db->from('appointment');
		$query = $this->db->get();
        if($query->num_rows() > 0)
           return $query->row();
		}

    // ------------------------------------------------------------------------

    /**
     * edit
     *
     * This function edit opportunity
     * 
     * @access	public
     * @return	int or Boolean
     */
    function edit($id = null) {
        $data = $this->input->post(null, true);
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        $this->session->set_flashdata("success", "Great..!! Information Updated successfully");
        return true;
    }

    // ------------------------------------------------------------------------

    /**
     * get_Opportunities
     *
     * This function return opportunity data
     * 
     * @access	public
     * @return	Object 
     */
    function get_Opportunities($limit = null, $offset = null, $text = null, $order_by = null, $order = null, $status = null,$user = null,$is_all = null) {
		//_pr($user);die;
        $assigndLeads = _assignToData(currentuserinfo()->id);
		if(isset($user) && $user !='')
		{
			$lead_array	=	array();
		}else{
			$lead_array = getAssignLead();
		}
        //$invoicedleads = _getInvoicedLeads(); //_pr($invoicedleads);die;
        //$sub = $this->db->query();
        $this->db->select("SQL_CALC_FOUND_ROWS $this->table.*,utu.first_name AS USER_NAME,$this->assign_leads.assigned_to,$this->contacts.email,$this->contacts.country,(SELECT $this->tasks.task_name FROM $this->tasks WHERE $this->tasks.lead_id=$this->table.id order by $this->tasks.id desc limit 1) as task_name,(SELECT $this->tasks.created FROM $this->tasks WHERE $this->tasks.lead_id=$this->table.id order by $this->tasks.id desc limit 1) as task_date,CONCAT(users.first_name,' ',users.last_name) AS ASSIGNRD_TO", false);
        
        if (!empty($text)) {
            if(is_numeric($text)){
                $this->db->where("display_id", $text); 
            }else{
                $text = strtolower($text);
                $this->db->like("LOWER(CONCAT($this->company.company_data,' ',$this->company_contacts.contacts_data,' ',priority,' ',$this->users.first_name,' ',$this->users.last_name,' ',$this->referral_source.name,ut.first_name,' ',ut.last_name))", $text);   
            }
        }
        $this->db->join($this->assign_leads, "$this->assign_leads.lead_id=$this->table.id", 'left');
        $this->db->join($this->users, "$this->users.id=$this->assign_leads.assigned_to", 'left');
        $this->db->join($this->company, "$this->company.id=$this->table.company_name",'left');
        $this->db->join($this->company_contacts, "$this->company_contacts.id=$this->table.company_contact",'left');
        $this->db->join($this->contacts, "$this->contacts.lead_id=$this->table.id",'left');
        $this->db->join($this->referral_source, "$this->referral_source.id=$this->table.referral_source", 'left');
		$this->db->join("$this->users as utu", "utu.id=$this->table.added_by", 'left');
        $this->db->join("$this->users as ut", "ut.id=$this->table.assigned_telemarketer", 'left');
        //$this->db->join($this->tasks, "$this->tasks.lead_id=$this->table.id", 'left');
        
        //$this->db->group_by("$this->table.id");
        $this->db->order_by($order_by, $order);
        

        $this->db->limit($limit, $offset);
		/*Applying custom filter from leads listing page*/
		if(@$this->input->post('filter_by') == 'added_by')		/*Is for added by*/
		{
			$search = strtolower(@$this->input->post('search'));
			$this->db->like('lower(CONCAT(utu.first_name," ",utu.last_name) )',$search);
		}else if(@$this->input->post('filter_by') == 'assigned_telemarketer'){		/*Is for assigned telemarketer*/
			$search = strtolower(@$this->input->post('search'));
			//$this->db->like('lower(ut.first_name)',$search);
			$this->db->like('lower(CONCAT(ut.first_name," ",ut.last_name) )',$search);			
		}else if(@$this->input->post('filter_by') == 'assigned_salesperson'){		/*Is for assigned salesperson*/
			$search = strtolower(@$this->input->post('search'));
			//$this->db->like('lower(ut.first_name)',$search);
			$this->db->like('lower(CONCAT(users.first_name," ",users.last_name)) ',$search);	
			//concat(users.first_name," ",users.last_name) AS ASSIGNRD_TO			
		}
		
		/*End of Applying custom filter from leads listing page*/
        

        if ($status == 'unassigned') {
            if (!empty($lead_array) ) {
                $this->db->where_not_in("$this->table.id", $lead_array);
            }
            $this->db->where('lead_status', '2');
        } else
            if ($status == 'working') {
                if (!empty($lead_array) && is_array($lead_array) ) {
                    $this->db->where_in("$this->table.id", $lead_array);
                } else {
					if (is_array($user)) {
						//_pr($user);
						$this->db->where_in('lead_sales_spares.added_by', $user);
					} else if ($user) {
						if($is_all == ''){
							
						}else if($is_all == '' && $user != 1){
							$this->db->where('lead_sales_spares.added_by', $user);
						}else if($is_all == 'yes'){
							//$this->db->where('lead_sales_spares.added_by', $user);
						}else if($is_all == 'no'){
							$this->db->where('lead_sales_spares.added_by', $user);
						}
					}else if($user == '' && _userId() != 1){
						$this->db->where('lead_sales_spares.added_by', _userId());
					}else{
						$this->db->where("$this->table.id", '');
					}
                }
				$this->db->where('lead_status', '2');
				
            } else if ($status == 'won') {
                /*if ($invoicedleads) {
                    $this->db->where('lead_status', '3');
                    $this->db->where_not_in("$this->table.id", $invoicedleads);
                } else {
                    $this->db->where('lead_status', '3'); //set result null
                }*/
                $this->db->where('lead_status', '3');
            } else if ($status == 'archieved') {
                if ($invoicedleads) {
                    $this->db->where('lead_status', '3');
                    $this->db->where_in("$this->table.id", $invoicedleads);
                } else {
                    $this->db->where("$this->table.id", '0'); //set result null
                }
            } else if ($status == 'lost') {
                    $this->db->where('lead_status', '4');
            }else if ($status == 'disqualified') {
                $this->db->where('lead_status', '5');
            }
            else if ($status == 'billed') {
                $this->db->where('lead_status', '6');
            }
             else if ($status == 'compelete') {
                $this->db->where('lead_status', '7');
            }
            
        if (_isSalesPerson()) { //Sales person access own data
            if ($assigndLeads) {
                foreach ($assigndLeads as $k => $v) {
                    $arr[] = $v->lead_id;
                }
            }
            //_pr($assigndLeads);exit;
            $sql = '';
            if (isset($arr)) {
                $sql .= '( ';
            }
            $sql .= "$this->table.added_by = " . _userId();
            if (isset($arr)) {
                $arr = implode(',', $arr);
                $sql .= " OR $this->table.id IN ($arr)) ";
                //$this->db->join($this->assign_leads, "$this->assign_leads.lead_id=$this->table.id", 'left');
            }
            $this->db->where($sql);

        }

        $query = $this->db->get($this->table);
		//echo $this->db->last_query();
		//die;
        $result['result'] = $query->result_array();
        //_pr($result['result']);
        //exit;

        //check if lead is private or public for sales manager
        if (_isSalesManager()) {
            foreach ($result['result'] as $k => $v) {
                if ($v['lead_type'] == '2' && $v['added_by'] != _userId()) {
                    unset($result['result'][$k]);
                }
            }
        }
        //echo $this->db->last_query();die;
        $total_record = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $result['total_data'] = $total_record->row()->count;

        return $result;
    }
    /**
     * grid_cols
     *
     * This function retum  Columns array
     * 
     * @access	public
     * @return	Array 
     */
    function grid_cols() {
        $user_id=_userId();//for punney agarwal
        //_pr(_getFieldTable());
        //exit;
        $fields = _getField(1);
        //_pr($fields);exit;
        $data[] = array(
            "display" => "Lead Id",
            "name" => "display_id",
            "fetch_name" => "display_id",
            "sorting" => "yes");

        /*foreach ($fields as $key => $val) {
            if ($key < 5) {
                $data[] = array(
                    "display" => $val->label,
                    "name" => _tableAttribute($val->label),
                    "fetch_name" => _tableAttribute($val->label),
                    "sorting" => "yes");
            }

        }*/
        if($user_id!=322){
           $data[] = array(
            "display" => "Company Name",
            "name" => "company_name",
            "fetch_name" => "company_name",
            "sorting" => "yes");   
        }else{
           $data[] = array(
            "display" => "Email Id",
            "name" => "email",
            "fetch_name" => "email",
            "sorting" => "yes");   
        }    
        
        if($user_id!=322){
           $data[] = array(
            "display" => "Company Contact",
            "name" => "company_contact",
            "fetch_name" => "company_contact",
            "sorting" => "yes");   
        }else{
           $data[] = array(
            "display" => "Contact Name",
            "name" => "company_contact",
            "fetch_name" => "company_contact",
            "sorting" => "yes"); 
        }    
        
        if($user_id!=322){
           $data[] = array(
            "display" => "Referral Source",
            "name" => "referral_source",
            "fetch_name" => "referral_source",
            "sorting" => "yes");   
        }else{
           $data[] = array(
            "display" => "Task Name",
            "name" => "task_name",
            "fetch_name" => "task_name",
            "sorting" => "yes");
            
           $data[] = array(
            "display" => "Task Date",
            "name" => "task_date",
            "fetch_name" => "task_date",
            "sorting" => "yes"); 
        }    
        
        $data[] = array(
            "display" => "Priority",
            "name" => "priority",
            "fetch_name" => "priority",
            "sorting" => "yes");  
            
        $data[] = array(
            "display" => "Telemarketer",
            "name" => "assigned_telemarketer",
            "fetch_name" => "assigned_telemarketer",
            "sorting" => "yes");   
		
		 $data[] = array(
            "display" => "Date",
            "name" => "created",
            "fetch_name" => "created",
            "sorting" => "yes"); 

		$data[] = array(
            "display" => "Added By",
            "name" => "added_by",
            "fetch_name" => "added_by",
            "sorting" => "yes"); 
            
        if(!_isSalesPerson()){
            $data[] = array(
            "display" => "Assigned Salesperson",
            "name" => "assigned_to",
            "fetch_name" => "assigned_to",
            "sorting" => "yes");   
        }else{
            $data[] = array(
            "display" => "Country",
            "name" => "country",
            "fetch_name" => "country",
            "sorting" => "yes");
        }

        /*
        $data[] = array(
        "display" => "Group Name",
        "name" => "group_name",
        "fetch_name" => "group_name",
        "sorting" => "no");

        $data[] = array(
        "display" => "Email",
        "name" => "email",
        "fetch_name" => "user_email",
        "sorting" => "yes");

        $data[] = array(
        "display" => "Status",
        "name" => "status",
        "fetch_name" => "user_status",
        "sorting" => "yes");*/

        return $data;
    }

    /**
     * delete_row
     *
     * This function delete single row of listing
     * 
     * @access	public
     * @return  True or False
     */
    function delete_row($id = null) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        if ($this->db->affected_rows() > 0) {
            return true;
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
    function appointment_data($id = null) {
		$data = $this->session->userdata('module_key');
        $this->db->select('id,type as notification_type,appointment_name as title,description,appointment_date as start,module');
        $this->db->where('lead_id', $id);
        $this->db->where('module',$data);
        $query = $this->db->get_where($this->appointment);
		//pr($this->db->last_query());die;
        if ($query->num_rows()) {
			return json_encode($query->result());
        }
    }
    /**
     * assign_opportunity
     *
     * This function assign opportunity to SM or SP
     * 
     * @access	public
     * @return  True or False
     */
    function assign_opportunity($id = null) {
        $data = $this->input->post();
        $dateTime = _dateTime();
        $assigned_to = $data['assigned_to'];
        $is_assigned = $data['is_assigned']; //if hav any value then already assigned then update else insert
        unset($data['assigned_to']);
        unset($data['is_assigned']);
        $data['modified'] = $dateTime;
        $this->db->where('lead_id', $id);
        $query = $this->db->update($this->contacts, $data);
        if ($query) {
            $user_id = currentUserID();
            $assign_array = array(
                'lead_id' => $id,
                'assigned_by' => $user_id,
                'assigned_to' => $assigned_to,
                'created' => $dateTime,
                'modified' => $dateTime);
            if ($is_assigned) {
                unset($assign_array['created']);
                $this->db->where('lead_id', $id);
                $last_id = $this->db->update($this->assign_leads, $assign_array);
            } else {
                $this->db->insert($this->assign_leads, $assign_array);
                $last_id = $this->db->insert_id();
            }
            if ($last_id) {
                $array = array('lead_status' => '2', 'modified' => $dateTime);
                $this->db->where('id', $id);
                $query = $this->db->update($this->table, $array);

                ////////email notification to assgined user//////////

                //_pr($assign_array);
                $currentuserinfo=currentuserinfo();
                $display_id=fieldByCondition("$this->table",array('id'=>$id),"display_id")->display_id;
                $assigned_toInfo=fieldByCondition("users",array('id'=>$assigned_to),"CONCAT(first_name,' ',last_name) as name,email");
                $email_data['to'] = $currentuserinfo->email;
                $email_data['from'] = ADMIN_EMAIL;
                $email_data['sender_name'] = ADMIN_NAME;
                $email_data['subject'] = "Elitebiz Crm- Opportunity Assigned";
                $email_data['message'] = array(
                    'header' => 'Opportunity Assigned',
                    'body' => "Opportunity #$display_id has been assigned to $assigned_toInfo->name by you.",
                    'button_content' => 'Click here to view',
                    'button_link' => base_url() . 'opportunity/view/' . $id);
                _sendEmail($email_data);
                //----------------------------Mail to Sales Person to whom lead has been assigned--------------------
                $email_data['to'] = $assigned_toInfo->email;
                $email_data['message']['header']="You have been assigned for a opportunity #$display_id by $currentuserinfo->name.";
                _sendEmail($email_data);
                //---------------------------------------------------------------------------------------------------
                $hierarchy=usersByHierarchy();
                foreach($hierarchy as $user_id=>$user_email){
                    $email_data['to'] = $user_email;
                    $email_data['message']['header']="Opportunity #$display_id has been assigned to $assigned_toInfo->name by $currentuserinfo->name.";
                    _sendEmail($email_data);
                }
                //////////////////////////////////////////////////////

                //set notification for assigned user
                /*$data = array(
                    "id" => $id,
                    "sid" => currentuserinfo()->id,
                    "rid" => $assigned_to,
                    "module" => 'opportunity',
                    "notificationType" => 'assigned',
                    "date" => _notificationTime(),
                    "description" => currentuserinfo()->first_name . " " . currentuserinfo()->last_name . ' Assigned you an opportunity');*/
                //_websocket($data); //notification send to websocket
            }
            return true;
        }

    }

    // ------------------------------------------------------------------------

    /**
     * Update
     *
     * This function Update data
     * 
     * @access	public
     * @return	int or Boolean
     */
    function update($data = null) {
        $this->db->where('id', $data['id']);
        $this->db->set('lead_status', $data['status']);
        $this->db->set('modified', date('Y-m-d H:i:s'));
        if($data['status']==4){
           $this->db->set('lost_reason', $data['lost_reason']);   
        }
        $this->db->update($this->table);
        if ($this->db->affected_rows()) {
            return true;
        }
        return false;
    }

    // ------------------------------------------------------------------------
    function addProduct($data = array()) {
        $data['assigned_by'] = _userID();
        $data['created'] = _dateTime();
        $data['modified'] = _dateTime();
        $this->db->insert($this->assign_product, $data);
        $last_id = $this->db->insert_id();
        return $last_id;
    }
    //-------------------------------------------------------------------------

    function getOpportunityProducts($lead_id = null) {
        $this->db->select('*');
        $this->db->from($this->assign_product);
        $this->db->where('lead_id', $lead_id);
        $query = $this->db->get();
        if ($query->num_rows()) {
            //return $query->result();
        }
		//echo $this->db->last_query();
		//die;
        return false;
    }

    //--------------------------------------------------------------------------
    function deleteProduct($data = array()) {
        $this->db->where('lead_id', $data['lead_id']);
        $this->db->where('product_id', $data['product_id']);
        $query = $this->db->delete($this->assign_product);
        return $query;
    }

}
