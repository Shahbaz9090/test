<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Database helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db * @author		Punit Kumar
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc 
 * @since		Version 1.0
 */
//------------------------------------------------------------------------------
if (!function_exists('set_flashdata')) {
    function set_flashdata($type, $msg) {
        $CI = &get_instance();
        $CI->session->set_flashdata($type, $msg);
    }
}
//------------------------------------------------------------------------------
if (!function_exists('get_flashdata')) {
    function get_flashdata() {
        $CI = &get_instance();
        $success = $CI->session->flashdata('success') ? $CI->session->flashdata('success') : '';
        $error = $CI->session->flashdata('error') ? $CI->session->flashdata('error') : '';
        $warning = $CI->session->flashdata('warning') ? $CI->session->flashdata('warning') : '';
        if ($success) {
            $msg = '<div class="alert alert-success flash-row">
					<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
					 ' . $success . ' 
            </div>';
        } elseif ($error) {
            $msg = '<div class="alert alert-danger flash-row">
					<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button><i class="ace-icon fa fa-check green"></i>
					<strong>Error!</strong> ' . $error . ' 
            </div>';
        } elseif ($warning) {
            $msg = '<div class="alert alert-warning flash-row">
					<button class="close" data-dismiss="alert"><i class="ace-icon fa fa-times"></i></button>
					' . $warning . '
            </div>';
        } else {
            return;
        }
        return $msg;
    }
}
// ------------------------------------------------------------------------
if (!function_exists('getAssignLead')) {
    function getAssignLead() {
        $CI = &get_instance();
        $CI->db->select('lead_id');
        $CI->db->from('assign_leads');
        $query = $CI->db->get();
        $lead_array = array();
        if ($query->num_rows()) {
            $result = $query->result_array();
            foreach ($result as $value) {
                $lead_array[] = $value['lead_id'];
            }
        }
        return $lead_array;
    }
}
//-----------------------------------------------------------------------
if (!function_exists('_leadData')) {
    function _leadData($id = null) {
        $CI = &get_instance();
        if ($id) {
            $CI->db->where('id', $id);
        }
        $query = $CI->db->get('leads');
        if ($query->num_rows()) {
            if ($id) {
                return $query->row();
            } else {
                return $query->result();
            }

        }
        return false;
    }

}

//-----------------------------------------------------------------------
if (!function_exists('_assignData')) {
    function _assignData($id = null) {
        $CI = &get_instance();
        $CI->db->where('lead_id', $id);
        $query = $CI->db->get('assign_leads');
        if ($query->num_rows()) {
            return $query->row();
        }
        return false;
    }

}
//-----------------------------------------------------------------------
if (!function_exists('_facilityType')) {
    function _facilityType() {
        $array = array('1' => 'Product', '2' => 'Service');
        return $array;
    }
}
//-----------------------------------------------------------------------
if (!function_exists('_currency')) {
    function _currency() {
        $array = array('1' => 'USD', '2' => 'INR');
        return $array;
    }
}
//-----------------------------------------------------------------------
if (!function_exists('_productStatus')) {
    function _productStatus() {
        $array = array('1' => 'Active', '2' => 'Inactive');
        return $array;
    }
}

//------------------------------------------------------------------------
/**
 * @function __addLeadDefFields
 * @purpose gets fields from tables(modules)
 * @created 3Dec2014
 */
if (!function_exists('_addDefaultFields')) {
    function _addDefaultFields($field_arr = array()) {
        $CI = &get_instance();
        $data = $field_arr; //_pr($data);die;
        foreach ($data as $k => $row) {
            if (is_array($row)) {
                if (is_array($row['default_value'])) {
                    $row['default_value'] = array_filter($row['default_value']);
                }
                $row['module'] = $field_arr['module'];
                /////////////start transaction /////////////////
                $CI->db->trans_start();
                $CI->db->trans_begin();
                //alter existing table
                $tableName = _getTable($row['module']);
                $row['tableName'] = $tableName;
                $alter = _alterFields($row);
                if ($alter) {
                    //save to fields table
                    $CI->common_mod->save('form_fields', $row);
                }
                $CI->db->trans_complete();
                /////////////////End Transaction///////////////
                /////////////////check if error occurs/////////
                if ($CI->db->trans_status() === false) {
                    $CI->db->trans_rollback();
                    return false;
                } else {
                    $CI->db->trans_commit();
                }
            }
        }
        return true;
    }
}

/**
 * @function _defaultProductFields
 * @purpose default array fields
 * @created 17 Dec2014
 */
if (!function_exists('_defaultProductFields')) {
    function _defaultProductFields() {
        $arr = array(
            array(
                'field_type' => '5',
                'label' => 'Facility Type',
                'default_value' => _facilityType(),
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Name',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Remarks',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '5',
                'label' => 'Status',
                'default_value' => _productStatus(),
                'field_required' => 1),
            array(
                'field_type' => '5',
                'label' => 'Currency',
                'default_value' => _currency(),
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Amount',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Commission',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '9',
                'label' => 'VAT',
                'default_value' => '4.50',
                'field_required' => 2),
            array(
                'field_type' => '9',
                'label' => 'Sales',
                'default_value' => '10.00',
                'field_required' => 2),
            array(
                'field_type' => '9',
                'label' => 'Service',
                'default_value' => '12.50',
                'field_required' => 2),
            array(
                'field_type' => '5',
                'label' => 'Usage Unit',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '2',
                'label' => 'Unit in Stock',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '4',
                'label' => 'Description',
                'default_value' => '',
                'field_required' => 1),
            );
        return $arr;
    }
}
//------------------------------------------------------------------------
/**
 * @function _productList
 * @purpose products listing in array
 * @created 18 Dec2014
 */
if (!function_exists('_productList')) {
    function _productList($type = null) {
        $CI = &get_instance();
        $CI->db->select('id,name');
        $CI->db->from('products');
        if ($type) {
            $CI->db->where('facility_type', $type);
        }
        $CI->db->where('status', '1');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}
//------------------------------------------------------------------------
/**
 * @function _productList
 * @purpose products listing in array
 * @created 18 Dec2014
 */
if (!function_exists('_isOpportunityProduct')) {
    function _isOpportunityProduct($lead_id = null, $product_id = null) {
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->from('assign_product');
        if ($lead_id) {
            $CI->db->where('lead_id', $lead_id);
        }
        if ($product_id) {
            $CI->db->where('product_id', $product_id);
        }
        $query = $CI->db->get();
        return $query->num_rows();
    }
}
//------------------------------------------------------------------------
/**
 * @function _taskStatus
 * @purpose Status of Task in array
 * @created 22 Dec2014
 */
if (!function_exists('_taskStatus')) {
    function _taskStatus() {
        $array = array(
            '1' => 'Assigned',
            '2' => 'Working',
            '3' => 'Complete');
        return $array;
    }
}
//------------------------------------------------------------------------
/**
 * @function _assignedToByTaskID
 * @purpose Status of Task in array
 * @created 22 Dec2014
 */
if (!function_exists('_assignedToByTaskID')) {
    function _assignedToByTaskID($task_id = null, $user_id = null,$isActive=null) {
        $CI = &get_instance();
        $CI->db->select('assigned_to');
        $CI->db->from('assign_task');
        $CI->db->where('task_id', $task_id);
        $CI->db->where('assigned_by', $user_id);
        if($isActive==1){
            $CI->db->where('is_active', 1);
        }
        $query = $CI->db->get();
        $array = array();
        if ($query->num_rows()) {
            foreach ($query->result() as $row) {
                $array[] = $row->assigned_to;
            }
        }
        return $array;
    }
}
//-----------------------------------------------------------------------------
/**
 * @function _parentProducts
 * @purpose products listing in array
 * @created 18 Dec2014
 */
if (!function_exists('_parentProducts')) {
    function _parentProducts($type = null) {
        $CI = &get_instance();
        $CI->db->select('id,name');
        $CI->db->from('products');
        if ($type) {
            $CI->db->where('facility_type', $type);
        }
        $CI->db->where('p_id', 0);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}
//------------------------------------------------------------------------
/**
 * @function _leadProducts
 * @purpose products listing in array
 * @created 29 Dec 2014
 */
if (!function_exists('_leadProducts')) {
    function _leadProducts($lead_id = null) {
        if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('id,product_id');
            $CI->db->from('assign_product');
            if ($lead_id) {
                $CI->db->where('lead_id', $lead_id);
            }
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->result();
            }
        }
        return false;
    }
}
//---------------------------------------------------------------------------
/**
 * @function _contacts
 * @purpose contact data for particuler lead
 * @created 29 Dec 2014
 */
if (!function_exists('_contacts')) {
    function _contacts($lead_id = null) {
        if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('contacts');
            if ($lead_id) {
                $CI->db->where('lead_id', $lead_id);
            }
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->row();
            }
        }
        return false;
    }
}
//---------------------------------------------------------------------------
/**
 * @function _leadReminders
 * @purpose fetch leads reminder data for particuler lead
 * @created 29 Dec 2014
 */
if (!function_exists('_leadReminders')) {
    function _leadReminders($lead_id = null,$for_whom = null,$added_by=null) {
        if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('lead_reminder');
            if ($lead_id) {
                $CI->db->where('lead_id', $lead_id);
            }
			if($for_whom){
				$CI->db->where('for_whom', $for_whom);
			}
			if($added_by){
				$CI->db->where('added_by', $added_by);
			}
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->result();
            }
        }
        return false;
    }
}
//---------------------------------------------------------------------------
/**
 * @function _leadReminders
 * @purpose fetch leads reminder data for particuler lead
 * @created 29 Dec 2014
 */
if (!function_exists('_leadFollowUps')) {
    function _leadFollowUps($lead_id = null) {
        if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('follow_ups');
            if ($lead_id) {
                $CI->db->where('lead_id', $lead_id);
            }
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->result();
            }
        }
        return false;
    }
}

if (!function_exists('_leadReminders')) {
    function _leadReminders($lead_id = null) {
        if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('lead_reminders');
            if ($lead_id) {
                $CI->db->where('lead_id', $lead_id);
            }
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->result();
            }
        }
        return false;
    }
}


function _countNotes($lead_id = null){
	 if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('lead_notes');
            if ($lead_id) {
                $CI->db->where('lead_id', $lead_id);
            }
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->num_rows();
            }
        }
        return false;
}
//--------------------------------------------------------------------------
/**
 * @function _leadOthers
 * @purpose fetch leads reminder data for particuler lead
 * @created 29 Dec 2014
 */
if (!function_exists('_leadOthers')) {
    function _otherFieldsData($table = null, $field = null, $lead_id = null) {
        if ($lead_id) {
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from($table);
            $CI->db->where($field, $lead_id);
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->row();
            }
        }
        return false;
    }
}
//--------------------------------------------------------------------------
/**
 * @function _companyNameByLeadId
 * @purpose fetch leads reminder data for particuler lead
 * @created 29 Dec 2014
 */
if (!function_exists('_companyNameByLeadId')) {
    function _companyNameByLeadId($id = null) {
        $CI = &get_instance();
        $CI->db->select('company_name');
        if ($id) {
            $CI->db->where('id', $id);
        }
        $query = $CI->db->get('leads');
        if ($query->num_rows()) {
            $result = $query->row();
            return $result->company_name;
        }
        return false;
    }

}
/**
 * @function _productNameByLeadId
 * @purpose fetch leads reminder data for particuler lead
 * @created 29 Dec 2014
 */
if (!function_exists('_productNameByLeadId')) {
    function _productNameByLeadId($id = null) {
        $CI = &get_instance();
        $CI->db->select('name');
        if ($id) {
            $CI->db->where('id', $id);
        }
        $query = $CI->db->get('products');
        if ($query->num_rows()) {
            $result = $query->row();
            return $result->name;
        }
        return false;
    }

}
/**
 * @function _getCommissions
 * @purpose fetch common commissonss  data for all invoices
 * @created 6 Jan 2014
 */
if (!function_exists('_getCommissions')) {
    function _getCommissions() {
        $CI = &get_instance();
        $CI->db->order_by('id', 'asc');
        $query = $CI->db->get('commissions');
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;

    }
}
/**
 * @function _getInvoicedLeads
 * @purpose fetch array of invoice generated leads 
 * @created 6 Jan 2014
 */
if (!function_exists('_getInvoicedLeads')) {
    function _getInvoicedLeads() {
        $CI = &get_instance();
        $CI->db->select('lead_id');
        $CI->db->from('invoices');
        $query = $CI->db->get();
        $lead_array = array();
        if ($query->num_rows()) {
            $result = $query->result_array();
            foreach ($result as $value) {
                $lead_array[] = $value['lead_id'];
            }
            return $lead_array;
        }
        return false;
    }

}
/**
 * @function _leadInvoices
 * @purpose fetch array of invoice generated leads 
 * @created 6 Jan 2014
 */
if (!function_exists('_leadInvoices')) {
    function _leadInvoices($id = null) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('invoices');
        $CI->db->where('lead_id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}
/**
 * @function _companyContacts
 * @purpose fetch array of company contacts 
 * @created 6 Jan 2014
 */
if (!function_exists('_companyContacts')) {
    function _companyContacts($id = null) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('company_contacts');
        $CI->db->where('company_id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}
/**
 * @function _companyList
 * @purpose fetch company listing 
 * @created 6 Jan 2014
 */
if (!function_exists('_companyList')) {
    function _companyList() {
        $CI = &get_instance();
        $CI->db->select('id,company_data');
        $CI->db->from('company');
        if (_isTaleMarketer() || _isSalesPerson()) {
            $CI->db->where('added_by', _userId());
        }
        $CI->db->order_by('id','desc');
        //$CI->db->limit(5);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->result();
            foreach ($result as $key => $value) {
                $companyData = json_decode($value->company_data);
                $array[$value->id] = $companyData->name;
            }
            return $array;
        }
        return false;
    }
}
/**
 * @function _contactById
 * @purpose fetch company contact by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_contactById')) {
    function _contactById($id = null) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('company_contacts');
        $CI->db->where('id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->row();
        }
        return false;
    }
}
/**
 * @function _contactById
 * @purpose fetch company contact by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_contactPersonById')) {
    function _contactPersonById($id = null) {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('company_contacts');
        $CI->db->where('id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return json_decode($query->row()->contacts_data);
        }
        return false;
    }
}

/**
 * @function _contactById
 * @purpose fetch company contact by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_referalSourceList')) {
    function _referalSourceList() {
        $CI = &get_instance();
        $CI->db->select('*');
        $CI->db->from('referral_source');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->result();
            $array = array();
            foreach ($result as $k => $val) {
                $array[$val->id] = $val->name;
            }
            return $array;
        }
        return false;
    }
}
/**
 * @function _companyNameById
 * @purpose fetch company name by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_companyNameById')) {
    function _companyNameById($id = null) {
        $CI = &get_instance();
        $CI->db->select('company_data');
        $CI->db->from('company');
        $CI->db->where('id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->row();
            $companyName = json_decode($result->company_data)->name;
            return $companyName;
        }
        return false;
    }
}

/**
 * @function _countryNameById
 * @purpose fetch country name by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_countryNameById')) {
    function _countryNameById($id = null) {
        $CI = &get_instance();
        $CI->db->select('country_name');
        $CI->db->from('countries');
        $CI->db->where('country_id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->row()->country_name;
        }
        return false;
    }
}
/**
 * @function _tasksByLeadId
 * @purpose fetch tasks list by lead id 
 * @created 6 Jan 2014
 */
if (!function_exists('_tasksByLeadId')) {
    function _tasksByLeadId($id = null) {
        $CI = &get_instance();
        $CI->db->select('id,task_name,description,created');
        $CI->db->from('tasks');
        $CI->db->where('lead_id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }
}

/**
 * @function _taskStausByUser
 * @purpose fetch task status by user id 
 * @created 6 Jan 2014
 */
if (!function_exists('_taskStausByUser')) {
    function _taskStausByUser($task_id=null,$user_id=null) {
        $CI = &get_instance();
        $CI->db->select('status');
        $CI->db->from('assign_task');
        $CI->db->where('task_id',$task_id);
        $CI->db->where('assigned_to',$user_id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $taskStatus=_taskStatus();
            return $taskStatus[$query->row()->status];
        }
        return false;
    }
}

//----------------------------------------------------------------------
/**
 * @function formatDate
 * @purpose format the date and time
 * @created 3 Feb 2015
 */
if (!function_exists('formatDate')) { 
    function formatDate($str=null){
        return date('d-M-Y h:i A',strtotime($str));
    }
}
//----------------------------------------------------------------------
/**
 * @function alertList
 * @purpose List the alert options 
 * @created 9 Mar 2015
 */
if (!function_exists('_alertList')) { 
    function _alertList(){
        $array=array(
            '1'=>'At Time of Event',
            '2'=>'5 Min Before',
            '3'=>'15 Min Before',
            '4'=>'30 Min Before',
            '5'=>'1 Hour Before',
            '6'=>'1 Day Before',
            '7'=>'1 Week Before'
        );
       return $array; 
    }
}

//----------------------------------------------------------------------
/**
 * @function _leadsByCompany
 * @purpose List lead/opportunity data by company id
 * @created 12 Mar 2015
 */
if (!function_exists('_leadsByCompany')) { 
    function _leadsByCompany($company=null,$status=null){
         if($company){
             $CI = &get_instance();
             $CI->db->select("id,display_id,lead_type,added_by,created");
             $CI->db->from('leads');
             $CI->db->where('company_name', $company);
             if ($status == 'archieved') {
                $CI->db->where('lead_status', '1');
             }else {
                $CI->db->where('lead_status', '0');
             }
             if (_isTaleMarketer() || _isSalesPerson()) { //talemarketer and sales person lists own or assigned data only
                $CI->db->where('(added_by', _userId());
                $CI->db->or_where('assigned_telemarketer', _userId() . ')', false);
             }
             $CI->db->order_by('modified', 'desc');
             $query = $CI->db->get();
             if($query->num_rows()){
                $result=$query->result();
                    //check if lead is private or public for sales manager
                    if (_isSalesManager()) {
                        foreach ($result as $k => $v) {
                            if ($v->lead_type == '2' && $v->added_by != _userId()) {
                                unset($result[$k]);
                            }
                        }
                    }
                return $result;    
             }
         }
         return false;
    }
}

if (!function_exists('checkassignLead')) { 
    function checkassignLead($loggedinUser=null){
		$CI = &get_instance();
		$CI->db->select('id','lead_id');
		$CI->db->from('assign_leads');
		$CI->db->where('assigned_to',$loggedinUser);
		$query = $CI->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}
	}
}


if (!function_exists('assignUser')) { 
    function assignUser($lead_id=null) {
		$CI = &get_instance();
		$CI->db->select('assigned_to');
		$CI->db->from('assign_leads');
		$CI->db->where('lead_id',$lead_id);
		$query = $CI->db->get();
		if($query->num_rows()>0) {
			return $query->row();
		}
	}
}

if (!function_exists('assignUserMail')) { 
    function assignUserMail($lead_id=null) {
		$CI = &get_instance();
		$CI->db->select('assign_leads.assigned_to,users.first_name,users.last_name,users.email');
		$CI->db->from('assign_leads');
		$CI->db->join('users','users.id = assign_leads.assigned_to');
		$CI->db->where('assign_leads.lead_id',$lead_id);
		$query = $CI->db->get();
		if($query->num_rows()>0) {
			return $query->row();
		}
	}
}

if (!function_exists('checkReminder')) { 
    function checkReminder(){
		$CI = &get_instance();
		$CI->db->select('id,lead_id,reminder');
		$CI->db->from('lead_reminder');
		//set date time before 30-min
		$date = '';
		$date = (time()-(30*60));
		$date = date('Y-m-d H:i:s',$date);
		$CI->db->where('reminder >=', $date);
		$CI->db->where('reminder <=', date('Y-m-d H:i:s'));
		$CI->db->where('flag', '0');
		$query = $CI->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}

	}
}

if (!function_exists('checkReminderMail')) { 
    function checkReminderMail(){
		$CI = &get_instance();
		$CI->db->select('id,lead_id,reminder');
		$CI->db->from('lead_reminder');
		//set date time before 30-min
		$date = '';
		$date = (time()-(30*60));
		$date = date('Y-m-d H:i:s',$date);
		$CI->db->where('reminder >=', $date);
		$CI->db->where('reminder <=', date('Y-m-d H:i:s'));
		$CI->db->where('flag_mail', '0');
		$query = $CI->db->get();
		if($query->num_rows()>0) {
			return $query->result();
		}

	}
}


//----------------------------------------------------------------------
/**
 * @function _leadsByCompany
 * @purpose List lead/opportunity data by company id
 * @created 12 Mar 2015
 */
if (!function_exists('_opportunityByCompany')) { 
    function _opportunityByCompany($company=null,$status=null){
         if($company){
                $CI = &get_instance();
                $assigndLeads = _assignToData(currentuserinfo()->id);
                $lead_array = getAssignLead();
                $invoicedleads = _getInvoicedLeads(); //_pr($invoicedleads);die;
                $CI->db->select("id,display_id,lead_type,added_by,created");
                $CI->db->from('leads');
                $CI->db->where('company_name', $company);
                if ($status == 'unassigned') {
                    if ($lead_array) {
                        $CI->db->where_not_in("id", $lead_array);
                    }
                    $CI->db->where('lead_status', '2');
                } else
                    if ($status == 'working') {
                        if ($lead_array) {
                            $CI->db->where_in("id", $lead_array);
                        } else {
                            $CI->db->where("id", '');
                        }
                        $CI->db->where('lead_status', '2');
                    } else
                        if ($status == 'won') {
                            if ($invoicedleads) {
                                $CI->db->where('lead_status', '3');
                                $CI->db->where_not_in("id", $invoicedleads);
                            } else {
                                $CI->db->where('lead_status', '3'); //set result null
                            }
                        } else
                            if ($status == 'archieved') {
                                if ($invoicedleads) {
                                    $CI->db->where('lead_status', '3');
                                    $CI->db->where_in("id", $invoicedleads);
                                } else {
                                    $CI->db->where("id", '0'); //set result null
                                }
                            } else
                                if ($status == 'lost') {
                                    $CI->db->where('lead_status', '4');
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
                    $sql .= "added_by = " . _userId();
                    if (isset($arr)) {
                        $arr = implode(',', $arr);
                        $sql .= " OR id IN ($arr)) ";
                    }
                    $CI->db->where($sql);
        
                }
                 $CI->db->order_by('modified', 'desc');
                 $query = $CI->db->get();
                 if($query->num_rows()){
                    $result=$query->result();
                        //check if lead is private or public for sales manager
                        if (_isSalesManager()) {
                            foreach ($result as $k => $v) {
                                if ($v->lead_type == '2' && $v->added_by != _userId()) {
                                    unset($result[$k]);
                                }
                            }
                        }
                   return $result;     
                 }
         }
         return false;
    }
}

//----------------------------------------------------------------------
/**
 * @function _latestFollowUpDate
 * @purpose return latest follow up date
 * @created 12 Mar 2015
 */
function _latestFollowUpDate($id=null){
    $CI = &get_instance();
    $CI->db->select('follow_up_date');
    $CI->db->where('lead_id',$id);
    $CI->db->order_by('follow_up_date','desc');
    $query=$CI->db->get('follow_ups');
    if($query->num_rows()){
        return $query->row()->follow_up_date;   
    }
    return false;
}

function cmpArr($a, $b)
    {
        if ($a['followupdate'] == $b['followupdate']) {
            return 0;
        }
        return ($a['followupdate'] > $b['followupdate']) ? -1 : 1;
    }
    
/**
 * @function dateFormat
 * @purpose format the date only not time
 * @created 28 Apr 2015
 */
if (!function_exists('dateFormat')) { 
    function dateFormat($str=null){
        return date('d-M-Y',strtotime($str));
    }
}    

if (!function_exists('fieldByCondition')) {
    function fieldByCondition($table,$conArr,$field) {
        $CI = &get_instance();
        $CI->db->select($field,false);
        $CI->db->from($table);
        $CI->db->where($conArr);
        $query=$CI->db->get();
        if($query->num_rows()){
            return $query->row();
        }
        return false;
    }
}

if(!function_exists('usersByHierarchy')){
    function usersByHierarchy(){
        $CI=&get_instance();
        if(!_isSuperAdmin()){
            $CI->db->select('id,email');
            $CI->db->from('users');
            if(_isTaleMarketer() || _isSalesPerson()){
                $CI->db->where('group_id',1);
                $CI->db->or_where('group_id',4);    
            }elseif(_isSalesManager()){
                $CI->db->where('group_id',1);
            }
            $query=$CI->db->get();
            if($query->num_rows()){
                $result=array();
                foreach($query->result() as $val){
                    $result[$val->id]=$val->email;
                }
                return $result;
            }   
        }
        return false;
    }
}

