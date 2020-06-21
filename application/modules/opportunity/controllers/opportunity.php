<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Lead Controller
 *
 * @package		User
 * @subpackage	User
 * @category	User 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Opportunity extends MY_Controller {
    var $table = "leads_sales_spares";
    var $appointment = "appointment";

    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('opportunity_mod');
        $this->load->model('lead/sales_spares_mod');
        $this->load->model('product/product_mod');

		$this->data['head']['title'] = "Set Notification";
        $this->data['readonly'] = NULL;
        $this->data['base_url'] = base_url("opportunity");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name   = "leads_sales_spares";

		$this->data['result'] = $this->opportunity_mod->get();
		//pr($this->data);die;
       // $this->data['module_link'] = base_url("lead/sales_spares")."/view_lead";
        
    }
    // ------------------------------------------------------------------------
    /**
     * view
     *
     * function detail of opportunity
     * 
     * @access	public
     */
    public function view($id = null) {
        $data['title'] = "Opportunity Information";
        $data['subTitle'] = "View Opportunity Information";
        $data['page'] = 'sales_spares/view_lead';
        $data['module_name'] = 'opportunity';
        $data['row'] = $this->common_mod->findFirst($this->table, array('id' => $id));
        $data['product_result'] = $this->opportunity_mod->getOpportunityProducts($id);
		//_pr($data['product_result']);die;
        $data['breadcrumb'] = array('Opportunities' => array(
                'link' => SITE_PATH . "opportunity/list_items/",
                'icon' => 'glyphicon  glyphicon-list',
                'status' => 'active'), 'View' => array(
                'link' => '',
                'icon' => 'glyphicon glyphicon-zoom-in',
                'status' => 'inactive'));

        if ($data['row']) {
            _layout($data);
        } else {
            _show404();
            return false;
        }
    }

    // ------------------------------------------------------------------------
    /**
     * Edit
     *
     * function edit lead
     * 
     * @access	public
     */
    public function edit($id = null) {

        $data['row'] = $this->common_mod->findFirst($this->table, array('id' => $id));
        $row = $data['row'];
        if (isPostBack()) {
			unset($_POST['company_text']);
            $data = $this->input->post(null, true);
            $contactData = $data['data']['contacts'];
            $remindersData = $data['data']['reminders'];
            $followUpsData = $data['data']['followUps'];
            $othersData = $data['data']['other'];
            unset($data['data']);
            $this->db->trans_begin();
            $data['lead_id'] = $id;
            $result = $this->sales_spares_mod->update($data);
            if ($result) {
                $othersData['lead_id'] = $id;
                $this->sales_spares_mod->addOthers($othersData);
                $remindersData['lead_id'] = $id;
                $this->sales_spares_mod->addReminder($remindersData);
                $followUpsData['lead_id'] = $id;
                $this->sales_spares_mod->addFollowUpDate($followUpsData);
                $contactData['lead_id'] = $id;
                $this->sales_spares_mod->addCompanyContact($contactData);
            }
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            $status = $row->lead_status;
            if ($status == 3) {
                redirect(base_url() . "opportunity/list_items/won");
            } elseif ($status == 4) {
                redirect(base_url() . "opportunity/list_items/lost");
            } else {
                $assignData = _assignData(@$row->id);
                if ($assignData) {
                    redirect(base_url() . "opportunity/list_items/working");
                } else {
                    redirect(base_url() . "opportunity/list_items");
                }

            }
        }
        $data['title'] = "Opportunity Edit Form";
        $data['subTitle'] = "Edit Opportunity Information";
        $data['page'] = 'sales_spares/lead_form';
        $data['action'] = "edit";
        $data['type'] = "opportunity";
        if ($data['row']) {
            _layout($data);
        } else {
            _show404();
            return false;
        }

    }

    // ------------------------------------------------------------------------
    /**
     * list items
     *
     * This function display all opportunity list
     * 
     * @access	public
     * @return	html data
     */
    public function list_items($status = 'unassigned') {
        $data['page'] = 'opportunity_list';
        $data['title'] = "Opportunity List";
        $data['subTitle'] = " All Opportunity Listing";
        $data['status'] = $status;

        _layout($data);
    }

    /**
     *listGridData
     *
     * This function display all opportunities list
     * 
     * @access	public
     * @return	html data
     */
    public function listGridData() {
		/*Getting user by filter options*/
		if($this->input->post('user'))
		{
			$user = $this->input->post('user');
		}else if($this->input->get('user') != '')
		{
			$user = $this->input->get('user');
		}
		//echo $user;die;
		if($user)
		{
			if(!is_array($user)){
				$is_all = 'yes';
				$data['user_id']	=	$user;
				if(!isset($user) || !$user){
					$user=currentUserID();
				}else{
					$is_all = 'no';
				}
				if($user=='all_sm'){
				   $user=array(); 
				   $usersList=usersList(SALES_MANAGER);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}elseif($user=='all_sp'){
				   $user=array(); 
				   $usersList=usersList(SALES_PERSON);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}elseif($user=='all_tm'){
				   $user=array(); 
				   $usersList=usersList(TELE_MARKETER);
				   foreach($usersList as $val){
					   $user[]=$val->id;
				   } 
				   $is_all = 'yes';
				}
				if(_isTaleMarketer() || _isSalesPerson()){
					$user= currentUserID();    
				}
			}else{
				echo "asdasd";die;
			}
		}else{
			$added_by =  '';
			$is_all	=	'';		/*This is for initial land of dashboard*/
		}
        //////////////////for grid use/////////////////////////
        $user_id=_userId();//for punney agarwal
        
        $page = $this->input->post('page');
        $limit = $this->input->post('change_limit');
        $text = $this->input->post('search_text');
        $order_by = $this->input->post('order_by');
        $order = $this->input->post('order');
        $status = $this->input->post('dynamic');
        /////////////////////////////////////////////////
        $cur_page = $page;
        $page -= 1;
        $offset = $page * $limit;
        $result = $this->opportunity_mod->get_Opportunities($limit, $offset, $text, $order_by,$order, $status,$user,$is_all);//_pr($result);
        $grid_cols = $this->opportunity_mod->grid_cols();
       //print_r($grid_cols);exit;
        $priority = _priority();
        $referalSource = _referalSourceList();
        foreach ($result['result'] as $k => $v) {
            foreach ($grid_cols as $key => $val) {
                //if ($key <= 6) {
                    if ($val['name'] == 'assigned_telemarketer') { // for assign telemarketer value
                        $name = @get_user_data($v[$val['name']])->first_name . ' ' . @get_user_data($v[$val['name']])->
                            last_name;
                        $result[$k][$val['name']] = ($name != ' ') ? $name : 'Not Assigned';
                    } else {
                        $result[$k][$val['name']] = @$v[$val['name']];
                    }
                    if ($val['name'] == 'display_id') {
                        $result[$k][$val['name']] = '<a href="'.base_url().'opportunity/view/'.$v['id'].'">#'.$v[$val['name']].'</a>';//'#'.$v[$val['name']];
                    }
                    if ($val['name'] == 'lead_status') { // for assign telemarketer value
                        $status = _getLeadStatus($v[$val['name']]);
                        $result[$k][$val['name']] = ucwords($status);
                    }
                    if($user_id!=322){
                        if ($val['name'] == 'company_name') {
                            $result[$k][$val['name']] = @_companyNameById($v[$val['name']]);
                        }
                    }else{
                        if ($val['name'] == 'email') {
                            $result[$k][$val['name']] = $v[$val['name']];
                        }
                    }   
                     
                    if ($val['name'] == 'company_contact') {
                        $companyContact = _contactPersonById($v[$val['name']]);
                        $result[$k][$val['name']] = @$companyContact->contact_person;
                    }
                    if ($val['name'] == 'priority') {
                        $result[$k][$val['name']] = @$priority[$v[$val['name']]];
                    }
                    if ($val['name'] == 'referral_source') {
                        $result[$k][$val['name']] = @$referalSource[$v[$val['name']]];
                    }
					if ($val['name'] == 'created') {
                        $result[$k][$val['name']] = date("d-M-Y H:i A",strtotime($v[$val['name']]));
                    }
					if ($val['name'] == 'added_by') {
                        $result[$k][$val['name']] = $v['USER_NAME'];
                    }
                    if ($val['name'] == 'task_date' && $user_id==322) {
                        if($v[$val['name']]){
                           $result[$k][$val['name']] = formatDate($v[$val['name']]);   
                        }else{
                           $result[$k][$val['name']] = Null; 
                        }
                    }
                    if(!_isSalesPerson()){
						/*echo "asasas";
						echo $val['name'];
						echo $v[$val['name']];
						die;*/
                        if ($val['name'] == 'assigned_to') {
                            $user_data=@get_user_data($v[$val['name']]);
                            $name = $user_data->first_name . ' ' . $user_data->last_name;
                            $result[$k][$val['name']] = ($name != ' ') ? $name : 'Not Assigned';
                        }
                    }else{
						//echo "aaaaaa";die;
                        if ($val['name'] == 'country') {
                            $result[$k][$val['name']] = fieldByCondition("countries",array('country_id'=>$v[$val['name']]),'country_name')->country_name;
                        }
                    }


                //}
            }
            //is delete for sales person
            if (_isSalesPerson()) {
                if ($v['added_by'] == _userId()) {
                    $result['result'][$k]['is_delete'] = '1';
                } else {
                    $result['result'][$k]['is_delete'] = '0';
                }
            }
        }
        //_pr($result);
        //exit;

        ////////////for grid cols///////////////////
        $result['grid_cols'] = $grid_cols;
        /////////////////////////////////////////
        echo json_encode($result);

    }

    /**
     * deleteGridRow
     *
     * This function delete single row of listing
     * 
     * @access	public
     * 
     */
    public function deleteGridRow() {
        $ids = @rtrim($this->input->post('delete_row'), ",");
        $idArr = @explode(",", $ids);
        foreach ($idArr as $id) {
            $result=$this->opportunity_mod->delete_row($id);
        }
        echo $result; 
    }

    /**
     * install
     *
     * This function install lead static fields
     * 
     * @access	public
     * 
     */
    public function install() {
        $table = 'form_fields';
        $module = 1;
        $isDefaultExists = _checkDefaultFields($table, $module);
        if ($isDefaultExists) {
            $this->session->set_flashdata("Error", "Already Installed!");
        } else {
            $field_arr = _defaultOpportunityFields();
            $field_arr['module'] = $module;
            $result = _addDefaultFields($field_arr);
            if ($result) {
                set_flashdata("success", "Lead module installed successfully.");
            } else {
                set_flashdata("error", "Lead module can't be installed because of some error!");
            }
        }
        redirect(base_url() . "form");
    }

    /**
     * appointment
     *
     * This function show appointment data in calender view
     * 
     * @access	public
     * 
     */
    public function appointment($id = null) {
		
        $views[] = 'appointment_calender';
		
        //$data['title'] = "Opportunity List";
        $this->data['submodule'] = " All Notification";
        $this->data['lead_id'] = $id;
        $this->data['result'] = $this->opportunity_mod->appointment_data($id);
		//pr( $this->data);die;
        view_load($views,$this->data);
    }

    /**
     * save_appointment
     *
     * This function save appointment data for particular opportunity
     * 
     * @access	public
     * 
     */
    public function save_appointment() {
        
		$data = array(
            'lead_id' => $this->input->post('lead_id'),
			'module' => $this->input->post('module'),
			'type' => $this->input->post('type'),
            'appointment_name' => str_replace("'", " ", $this->input->post('title')),
			'description' => str_replace("'", " ", $this->input->post('description')),
            'appointment_date' => $this->input->post('appointment_date'),
            'alert' => $this->input->post('alert'),
            'created' => date('Y-m-d H:i:s'),
            'added_by' => currentuserinfo()->id,
            'modified' => date('Y-m-d  H:i:s'));
		if ($this->input->post('title')) {
            $this->db->insert($this->appointment, $data);
            if($data['lead_id']==''){
                echo '1';
            }else{
                echo $this->db->insert_id();
            }
            exit;
        }
        return false;

    }

    /**
     * assign_opportunity
     *
     * This function assign opportunity to SM or SP
     * 
     * @access	public
     * 
     */
    public function assign_opportunity($id = null) {
        $this->db->trans_begin();
        $result = $this->opportunity_mod->assign_opportunity($id);
        if ($this->db->trans_status() === false) {
            $this->db->trans_rollback();
        } else {
            $this->db->trans_commit();
        }
        if ($result) {
            set_flashdata("success", "Great..!! Opportunity assigned successfully.");
        }
        redirect(base_url('opportunity/list_items/working'));
    }

    /**
     * changeStatus
     *
     * This function change status of opportunity either to closed won or lost
     * 
     * @access	public
     * 
     */
    public function changeStatus($id = null) {
        $dataArr = $this->input->post(null, true);
        $status = $dataArr['status'];
        $data = array('id' => $id, 'status' => $status,'lost_reason'=>$dataArr['lost_reason']);
        $result = $this->opportunity_mod->update($data);
        if ($result) {
            $statusMsg = ($status == 3 || $status == 4) ? (($status == 3) ? 'Closed Won' : 'Lost'): 'Disqualified';
            ////////Email opportunity status change
            $currentuserinfo=currentuserinfo();
            $display_id=fieldByCondition("$this->table",array('id'=>$id),"display_id")->display_id;
            $email_data['to'] = $currentuserinfo->email;
            $email_data['from'] = ADMIN_EMAIL;
            $email_data['sender_name'] = ADMIN_NAME;
            $email_data['subject'] = "Elitebiz Crm- Opportunity Status Changed";
            $email_data['message'] = array(
                'header' => 'Opportunity #'.$display_id." Status Changed !",
                'body' => "Opportunity #$display_id converted in to $statusMsg successfully by you.",
                'button_content' => 'Click here to view',
                'button_link' => base_url() . 'opportunity/view/' . $id);
            _sendEmail($email_data);
            $hierarchy=usersByHierarchy();
            foreach($hierarchy as $user_id=>$user_email){
                $email_data['to'] = $user_email;
                $email_data['message']['header']="Opportunity #$display_id converted in to $statusMsg successfully by $currentuserinfo->name.";
                _sendEmail($email_data);
            }
            //////////////////////////////////////////////
            set_flashdata("success", "Great..!! Opportunity Converted in to $statusMsg successfully.");
        }
        redirect(base_url('opportunity/list_items/working'));
    }

    /**
     * changeStatus
     *
     * This function change status of opportunity either to closed won or lost
     * 
     * @access	public
     * 
     */
    public function addProduct($lead_id = null) {
        $data['product_id'] = $this->input->post('product_id');
        $data['lead_id'] = $lead_id;
        $result = $this->opportunity_mod->addProduct($data);
        if ($result) {
            set_flashdata("success", "Great..!! Product added to opportunity successfully.");
        }
        redirect(base_url("opportunity/view/$lead_id"));
    }

    /**
     * changeStatus
     *
     * This function change status of opportunity either to closed won or lost
     * 
     * @access	public
     * 
     */
    public function ajaxDeleteProduct() {
        $data['lead_id'] = $this->input->post('lead_id');
        $data['product_id'] = $this->input->post('product_id');
        $result = $this->opportunity_mod->deleteProduct($data);
        echo $result;
    }

    /**
     * ajaxDeleteAppointment
     *
     * This function delete appointment by id
     * 
     * @access	public
     * 
     */
    public function ajaxDeleteAppointment() {
        $this->db->where('id', $this->input->post('id'));
        $result = $this->db->delete('appointment');
        echo $result;
    }

    /**
     * ajaxUpdateAppointment
     *
     * This function update appointment by id
     * 
     * @access	public
     * 
     */
    public function ajaxUpdateAppointment() {
		/*$this->db->where("id",$this->input->post('id'));
        $data = array(
            'lead_id' => $this->input->post('id'),
			'type' => $this->input->post('type'),
            'appointment_name' => str_replace("'", " ", $this->input->post('title')),
			'description' => str_replace("'", " ", $this->input->post('description')),
            'modified' => date('Y-m-d  H:i:s'));
		    $this->db->update($this->appointment, $data);
            echo $result;*/
			$this->db->where('id', $this->input->post('id'));
			$data = array('type' => $this->input->post('type'),'appointment_name' => $this->input->post('title'),'description' => $this->input->post('description'), 'modified' =>
					_dateTime());
			$result = $this->db->update('appointment', $data);
			echo $result;
     }
}
