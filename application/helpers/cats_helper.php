<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * CodeIgniter Cats Helpers
 *
 * @package        CodeIgniter
 * @subpackage    Helpers
 * @category    Helpers * @author        Kumar Gaurav
 * @website        http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since        Version 1.0
 */

// ------------------------------------------------------------------------

// ------------------------------------------------------------------------

/**
 * Is Post Back
 *
 * Check Post Request or not
 *
 * @access    public
 * @return    boolean
 */
if (!function_exists('isPostBack')) {
    function isPostBack()
    {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST') {
            return true;
        } else {
            return false;
        }

    }
}

// ------------------------------------------------------------------------

/**
 * Encrypt String
 *
 * Check Post Request or not
 *
 * @access    public
 * @return    string
 */

if (!function_exists('encrypt_string')) {
    function encrypt_string($num = null)
    {
        $string = base64_encode(base64_encode(base64_encode(base64_encode($num))));
        return $string;

    }
}

// ------------------------------------------------------------------------

/**
 * Decrypt String
 *
 * Check Post Request or not
 *
 * @access    public
 * @return    string
 */

if (!function_exists('decrypt_number')) {
    function decrypt_string($num = null)
    {
        $string = base64_decode(base64_decode(base64_decode(base64_decode($num))));
        return $string;

    }
}

// ------------------------------------------------------------------------
/**
 * sctivityStatus
 *
 * to return sctivity Status
 *
 * @access    public
 * @return    array
 */
if (!function_exists('activityStatus')) {
    function activityStatus($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("job_order_activity_status_type");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}
/**
 * All Notification Type from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('_get_notification_type')) {
    function _get_notification_type()
    {
        $CI = &get_instance();
		$CI->db->where('status','1');
        $CI->db->select("form_id,notification_type");
		$CI->db->order_by("notification_type","desc");
        $result = $CI->db->get("inch_set_notification_type");
        if ($result->num_rows > 0) {
            $data = $result->result();
			return $data;
			
        } else {
            return false;
        }
    }
}
// ------------------------------------------------------------------------


/**
 * All industry from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_industry_from_master')) {
    function get_industry_from_master()
    {
        $CI = &get_instance();
		$CI->db->where('status','1');
        $CI->db->select("id,name");
		$CI->db->order_by("name","asc");
        $result = $CI->db->get("industry");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

if (!function_exists('get_email_tag_data')) {
    function get_email_tag_data()
    {
        $CI = &get_instance();
		$CI->db->select("form_id,name");
		$CI->db->order_by("name","asc");
		$CI->db->where("status","1");
        $result = $CI->db->get("inch_email_tag_master");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
if (!function_exists('get_action_data')) {
    function get_action_data()
    {
        $arr = array(
            '103'=>'Add',
            '102'=>'Edit',
            '101'=>'View',
            '104'=>'Delete',
        );
        return $arr;
    }
}

if (!function_exists('get_all_modules')) {
    function get_all_modules()
    {
        $arr = array(
            'master'=>'Master',
            'user'=>'Users & Permission',
            'company'=>'Client',
            'lead'=>'Installation Base',
            'qualified_lead'=>'Qualified Installation',
            'disqualified_lead'=>'Disqualified Installation',
            'supplier'=>'Supplier',
            'filter_instalation'=>'Filter',
            'email_template'=>'Template',
            'mail'=>'Manage Email',
            'mail_china'=>'Manage Email China',
            'enquiry'=>'Enquiry',
        );
        return $arr;
    }
}
/**
 * All company *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_all_companies')) {
    function get_all_companies()
    {
        $CI = &get_instance();
		$CI->db->where("status","1");
        $CI->db->select("id,name as company_name");
		$CI->db->order_by("name","asc");
        $result = $CI->db->get("companies");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

if (!function_exists('fetch_state')) {
	function fetch_state($country_id){
		   $CI = &get_instance();
		   if(!empty($country_id)){
			   $country_ids=explode(',',$country_id);
		   }
			$CI->db->where_in('country_id', $country_ids);
			$CI->db->where('status', '1');
			$CI->db->order_by('state_name', 'ASC');
			$query = $CI->db->get('states');
			//echo $this->db->last_query();die;
			if($query->num_rows()>0){
			$output = '<option disabled value="">Select</option>';
			foreach($query->result() as $row){
			   // pr($row);die;
				//$output .= '';
				$output .= '<option disabled value="'.$row->id.'">'.$row->state_name.'</option>';
			}
			//pr($output);die;
			}else{
				$output .= '<option value="">No state found</option>';
			}
			return $output;
		}
}
if (!function_exists('fetch_city')) {
	function fetch_city($state_id){
       $CI = &get_instance();
	   if(!empty($state_id)){
		   $state_ids=explode(',',$state_id);
	   }
	    $CI->db->where('status', '1');
        $CI->db->where_in('state_id', $state_ids);
        $CI->db->order_by('city_name', 'ASC');
        $query = $CI->db->get('cities');
		//echo $this->db->last_query();die;
        if($query->num_rows()>0){
        $output = '<option disabled value="">Select</option>';
        foreach($query->result() as $row){
            //pr($row);die;
			//$output .= '';
            $output .= '<option disabled value="'.$row->id.'">'.$row->city_name.'</option>';
        }
        }else{
			$output .= '<option value="">No city found</option>';
		}
        return $output;
    }
}
	
	
/**
 *Set Document Extension *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('check_file_extension')) {
    function check_file_extension()
    {
        $CI = &get_instance();
		$extension = "jpg|png|docx|xls|zip|xlsx|ppt|pptx|ppsm|sldx|ACCDB|xps|cad|cae|dwg|rar|txt|pdf|docm|dotx|dotm";
		return $extension;
   }
}

if (!function_exists('set_file_extension')) {
    function set_file_extension()
    {
        $CI = &get_instance();
		$extension = '\.docx|\.docm|\.dotx|\.dotm|\.xls|\.xlsx|\.ppt|\.pptx|\.ppsm|\.sldx|\.ACCDB|\.xps|\.cad|\.cae|\.dwg|\.jpg|\.png|\.rar|\.zip|\.txt|\.pdf';
		return $extension;
   }
}

// ------------------------------------------------------------------------
/**
 * @function _getChinaEmailCategory
 * @purpose gets status of Lead by id
 * @created 19Dec2014
 */

if (!function_exists('_getChinaEmailCategory')) {
    function _getChinaEmailCategory() {
        $CI = &get_instance();
        $arr = array(
            '1' => 'Sales Spares Email China',
            '2' => 'Sales Governing Email China',
            '3' => 'Sales PCB Email China',
            '4' => 'Service PCB Email China',
            '5' => 'Service Automation Email China',
            '6' => 'Service DCS Email China');
        return $arr;
    }

}
// ------------------------------------------------------------------------


/**
 * @function _getChinaEmailCategory
 * @purpose gets status of Lead by id
 * @created 19Dec2014
 */

if (!function_exists('_getIndiaEmailCategory')) {
    function _getIndiaEmailCategory() {
        $CI = &get_instance();
        $category = array(
            '1' => 'Sales PCB Email India');
        return $category;
    }

}

/**
 * All Department from master *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_all_department_from_masters')) {
    function get_all_department_from_masters()
    {
        $CI = &get_instance();
		$CI->db->where("status","1");
        $CI->db->select("id,name ");
		$CI->db->order_by("name","asc");
        $result = $CI->db->get("department");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * All Designation from master *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_all_designation_from_masters')) {
    function get_all_designation_from_masters()
    {
        $CI = &get_instance();
		$CI->db->where("status","1");
        $CI->db->select("id,name");
		$CI->db->order_by("name","asc");
        $result = $CI->db->get("designation");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------


/**
 * @function _getLeadStatus
 * @purpose gets status of Lead by id
 * @created 19Dec2014
 */

if (!function_exists('_getLeadStatus')) {
    function _getLeadStatus($leadStatus = null) {
        $CI = &get_instance();
        $arr = array(
            '0' => 'Initiated',
            '1' => 'Disqualified',
            '2' => 'Qualified',
            '3' => 'Closed Won',
            '4' => 'Lost');
        foreach ($arr as $key => $val) {
            if ($key == $leadStatus) {
                return $val;
            }
        }
        return false;
    }

}

/**
 * _dateTime 
 * 
 * return default  timestamp
 *
 * @access	public
 */

if (!function_exists('_dateTime')) {
    function _dateTime() {
        //date_default_timezone_set("Asia/Kolkata");
        return date('Y-m-d H:i:s');
    }
}

/**
 * 
 * _isSalesPerson
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('_isSalesPerson')) {
    function _isSalesPerson() {
        $CI = &get_instance();
        $userInfo = currentuserinfo();
        return ($userInfo->group_id == 3) ? true : false;
    }
}

/**
 * group data 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('_assignToData')) {
    function _assignToData($assignToId = null) {
        $CI = &get_instance();
        if(is_array($assignToId)){
            $CI->db->where_in('assigned_to', $assignToId);
        }else{
            $CI->db->where('assigned_to', $assignToId);   
        }
        $query = $CI->db->get('assign_leads');
        if ($query->num_rows()) {
            return $query->result();
        }
        //_pr($query->result());exit;
        return false;
    }

}

/**
 * @function alertList
 * @purpose List the alert options 
 * @created 9 Mar 2015
 */
if (!function_exists('_alertList')) { 
    function _alertList(){
        $array=array(
            '1'=>'At Time of Notification',
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

/**
 * All Country from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_country_from_master')) {
    function get_country_from_master()
    {
        $CI = &get_instance();
		$CI->db->where('status','1');
        $CI->db->select("id,country_name");
		$CI->db->order_by("country_name","asc");
        $result = $CI->db->get("countries");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * All State from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_state_from_master')) {
    function get_state_from_master()
    {
        $CI = &get_instance();
        $CI->db->select("st.id,st.state_name,cu.id as country_id");
		$CI->db->from("states st");
		$CI->db->join("countries cu",'st.country_id=cu.id');
		$CI->db->order_by("state_name","asc");
        $result = $CI->db->get();
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------


// ------------------------------------------------------------------------

/**
 * All State from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_state_from_master_acord_country')) {
    function get_state_from_master_acord_country($id)
    {
        $CI = &get_instance();
        $CI->db->select("st.id,st.state_name");
		$CI->db->from("states st");
		$CI->db->where('status','1');
		$CI->db->where("st.country_id",$id);
		$CI->db->order_by("st.state_name","asc");
        $result = $CI->db->get();
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------_



/**
 * All State from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_city_from_master_acord_state')) {
    function get_city_from_master_acord_state($id)
    {
        $CI = &get_instance();
        $CI->db->select("ct.id,ct.city_name");
		$CI->db->from("cities ct");
		$CI->db->where("ct.state_id",$id);
		$CI->db->where("status",'1');
		$CI->db->order_by("ct.city_name","asc");
        $result = $CI->db->get();
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------_




/**
 * All Country from masters
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('get_city_from_master')) {
    function get_city_from_master($state_id)
    {
		
		$CI = &get_instance();
		if(!empty($country_id)){
		   $state_ids=explode(',',$state_id);
	   }
        $CI->db->where_in('state_id', $state_ids);
        $CI->db->order_by('city_name', 'ASC');
        $query = $CI->db->get('cities');
		//echo $this->db->last_query();die;
        //pr($query->result());die;
        $output = '';
        if ($query->num_rows > 0) {
            return $query->result();
        } else {
            return false;
        }
    }
}
/**
 * All data from dynamic module
 *
 * 
 *
 * @access    public
 * @return    array
 */
 

if (!function_exists('dynamic_module_master')) {
    function dynamic_module_master($table,$form_data)
    {
        $CI = &get_instance();
		$CI->db->where('status','1');
        $CI->db->select("form_id,name");
		$CI->db->order_by("name","asc");
        $result = $CI->db->get($table);
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
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
if (!function_exists('appointment_data')) {
    function appointment_data() { 
		//echo "scvudbjk";die;
		//$CI = &get_instance();
		
		/*$CI->db->select('id,type as notification_type,appointment_name as title,description,appointment_date as start,module');
        //$this->db->where('lead_id', $id);
		$query = $CI->db->get_where($this->appointment);
		echo $this->db->last_query();die;
		if ($query->num_rows()) {
			return json_encode($query->result());
        }*/
    }
}
/**
 * All data from dynamic module
 *
 * 
 *
 * @access    public
 * @return    array
 */
 /*if (!function_exists('get_table_name')) {
		public function get_table_name(){
			$CI = &get_instance();
			$CI->db->where('is_deleted','1');
			$CI->db->select("*");
			$result = $CI->db->get('inch_form');
			if ($result->num_rows > 0) {
				return $result->result();
			} else {
				return false;
			}
		}
 }*/
// ------------------------------------------------------------------------

/**
 * pr
 *
 * to print array data in ordered format
 *
 * @access    public
 * @return    array
 */
if (!function_exists('pr')) {
    function pr($data)
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

if (!function_exists('dump')) {
    function dump($data)
    {
        echo '<pre>';
        print_r($data);
        die;
        echo '</pre>';
    }
}

/**
 * visaType
 *
 * to return type of visa
 *
 * @access    public
 * @return    array
 */
if (!function_exists('visaType')) {
    function visaType()
    {
        $CI = &get_instance();
        $query = $CI->db->get("visa_type");
        return $query->result();
    }
}

/**
 * sourceType
 *
 * to return type of visa
 *
 * @access    public
 * @return    array
 */
if (!function_exists('sourceType')) {
    function sourceType()
    {
        $CI = &get_instance();
        $query = $CI->db->get("source");
        return $query->result();
    }
}

/**
 * viewTimeZone
 *
 * to return type of visa
 *
 * @access    public
 * @return    array
 */
if (!function_exists('viewTimeZone')) {
    function viewTimeZone($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $query = $CI->db->get("time_zone");
        if ($query->num_rows > 0) {
            return $query->row()->name;
        }
        return false;
    }
}
// ------------------------------------------------------------------------
/**
 * experience
 *
 * to return type of visa
 *
 * @access    public
 * @return    array
 */
if (!function_exists('experience')) {
    function experience()
    {
        $CI = &get_instance();
        $data = array(
            '0' => '0 Year',
            '1' => '1 Year',
            '2' => '2 Year',
            '3' => '3 Year',
            '4' => '4 Year',
            '5' => '5 Year',
            '6' => '6 Year',
            '7' => '7 Year',
            '8' => '8 Year',
            '9' => '9 Year',
            '10' => '10 Year',
            '11' => '11 Year',
            '12' => '12 Year',
            '13' => '13 Year',
            '14' => '14 Year',
            '15' => '15 Year');
        return $data;
    }
}

// ------------------------------------------------------------------------
/**
 * getCountry
 *
 * to return country
 *
 * @access    public
 * @return    array
 */
if (!function_exists('getCountry')) {
    function getCountry($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("country_id", $id);
        $result = $CI->db->get("countries");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * getCountry
 *
 * to return country list
 *
 * @access    public
 * @return    object
 */
if (!function_exists('getCountryList')) {
    function getCountryList($id = null)
    {
        $CI = &get_instance();
        $result = $CI->db->get("countries");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * getState
 *
 * to return state
 *
 * @access    public
 * @return    array
 */
if (!function_exists('getState')) {
    function getState($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("regions");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * view State
 *
 * to return state
 *
 * @access    public
 * @return    array
 */
if (!function_exists('viewState')) {
    function viewState($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("regions");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * view City
 *
 * to return city
 *
 * @access    public
 * @return    array
 */
if (!function_exists('viewCity')) {
    function viewCity($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("cityId", $id);
        $result = $CI->db->get("cities");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * getSource
 *
 * to return source where you have seen
 *
 * @access    public
 * @return    array
 */
if (!function_exists('getSource')) {
    function getSource($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("source");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * getVisaType
 *
 * to return visa type
 *
 * @access    public
 * @return    array
 */
if (!function_exists('getVisaType')) {
    function getVisaType($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("visa_type");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * listState
 *
 * to return state
 *
 * @access    public
 * @return    array
 */
if (!function_exists('listState')) {
    function listState($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("country_id", $id);
        $result = $CI->db->get("regions");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * getJobOrderContactType
 *
 * to return contact type of job order
 *
 * @access    public
 * @return    array
 */
if (!function_exists('getJobOrderContactType')) {
    function getJobOrderContactType($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("job_order_type");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------
/**
 * getAssignGroup
 *
 * to return assigned group
 *
 * @access    public
 * @return    object array
 */
if (!function_exists('getAssignGroup')) {
    function getAssignGroup($id = null)
    {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $result = $CI->db->get("user_groups");
        if ($result->num_rows > 0) {
            return $result->row();
        } else {
            return false;
        }
    }
}

// ------------------------------------------------------------------------

/**
 * Is Current Site ID
 *
 * Get Current Site ID
 *
 * @access    public
 * @return    boolean
 */
if (!function_exists('current_site_id')) {
    function current_site_id()
    {
        $CI = &get_instance();
        $site_id = currentuserinfo()->site_id;
        return $site_id;
    }
}

// ------------------------------------------------------------------------

/**
 * Is Protected
 *
 * Check Resticted area or not
 *
 * @access    public
 * @return    boolean
 */
if (!function_exists('isProtected')) {
    function isProtected()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('isLogin') != "yes") {
            redirect(base_url('auth/login'));
        } else {
            return true;
        }

    }
}

// ------------------------------------------------------------------------

/**
 * Clear Post Data
 *
 * Clear all post data
 *
 * @access    public
 */
if (!function_exists('clearPostData')) {
    function clearPostData()
    {
        $data = array();

        foreach ($_POST as $k => $r) {
            $data[$k] = null;
        }

        $_POST = $data;
    }
}

// ------------------------------------------------------------------------

/**
 * Current User Info
 *
 * If user loged then returl current user info
 *
 * @access    public
 * @return    mixed    boolean or depends on what the array contains
 */
if (!function_exists('currentuserinfo')) {
    function currentuserinfo()
    {
        $CI = &get_instance();
		//pr($CI->session->userdata("userinfo"));die;
        return $CI->session->userdata("userinfo");
    }
}

/**
 * Current User Info For chat
 *
 * If user loged then returl current user info
 *
 * @access    public
 * @return    mixed    boolean or depends on what the array contains
 */
if (!function_exists('logged_user')) {
    function logged_user()
    {
        $CI = &get_instance();
        $result = $CI->session->userdata("userinfo");
        $arr = array();
        $arr['userid'] = $result->id;
        $arr['username'] = $result->first_name;
        return $arr;

    }
}

// ------------------------------------------------------------------------

/**
 * Last Access Url
 *
 * Get Last visited url
 *
 * @access    public
 * @return    string or boolean
 */
if (!function_exists('last_access_url')) {
    function last_access_url()
    {
        $CI = &get_instance();
        return $CI->session->userdata("last_access_url");
    }
}

// ------------------------------------------------------------------------

/**
 * View Load
 *
 * Display Page with header and footer file
 *
 * Example
 * $views[] = 'dashboard_top';
 * $views[] = 'dashboard_bottom';
 * $data['title'] = "Dashboard";
 * view_load($views,$data);
 *
 * @access    public
 * @param   array (This parameter parse to view file name)
 * @param   array (This parameter parse value to template parse)
 */
if (!function_exists('view_load')) {
    function view_load($views = array(), $data = array())
    {

        $CI = &get_instance();

        $data['user'] = currentuserinfo();
        //pr($data);die;

        //pr($data['user']);die;
		
        $CI->load->view("header", $data);
		
        $CI->load->view("left_sidebar", $data);
		
        $CI->load->view("breadcrumb", $data);
		
        foreach ($views as $view) {
			
			
            $CI->load->view($view, $data);
			
        }
		
        $CI->load->view("footer", $data);
    }
}

// ------------------------------------------------------------------------

/**
 * Set Flash Data
 *
 * Set Flash Data in Session Flashdata
 *
 * @access    public
 * @param   String - Message type value(info,success,warning,error)
 * @param   String - Text Message
 */
if (!function_exists('set_flashdata')) {
    function set_flashdata($type, $msg) {
        $CI = &get_instance();
        $CI->session->set_flashdata($type, $msg);
    }
}

// ------------------------------------------------------------------------

/**
 * Get Flash Data
 *
 * Get Flash Data in Session Flashdata
 *
 * @access    public
 * @return  String
 */
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
        $CI->session->unset_userdata('success');
        $CI->session->unset_userdata('warning');
        $CI->session->unset_userdata('error');
        return $msg;
    }
}

// ------------------------------------------------------------------------

/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access    public
 * @param    string    the language key
 * @return    string
 */
if (!function_exists('lang')) {
    function lang($key)
    {
        $CI = &get_instance();
        $line = $CI->lang->line($key);
        return $line;
    }
}

// ------------------------------------------------------------------------

/**
 * Table Fields
 *
 * This function get field list of database table
 *
 * @param    string    - Table Name
 * @return    array - Filed list
 */
if (!function_exists('table_fields')) {
    function table_fields($table = null)
    {
        $CI = &get_instance();
        $fields = $CI->db->list_fields($table);

        $r = new stdClass;
        foreach ($fields as $row) {
            $r->$row = null;
        }
        return $r;
    }
}

// ------------------------------------------------------------------------

/**
 * Current Date And Time
 *
 * This function get Current Date And Time
 *
 * @param
 * @return
 */
if (!function_exists('current_date')) {

    function current_date()
    {
        $dateFormat = date("Y-m-d H:i:s", time());
        $timeNdate = $dateFormat;

        return $timeNdate;
    }

}

// ------------------------------------------------------------------------

/**
 * Current IP
 *
 * This function get Current IP
 *
 * @param
 * @return
 */
if (!function_exists('current_ip')) {
    function current_ip()
    {
        $current_ip = $_SERVER['REMOTE_ADDR'];
        return $current_ip;
    }
}

// ------------------------------------------------------------------------

/**
 * Array To JSon
 *
 * This function get Array To Json
 *
 * @param
 * @return
 */
if (!function_exists('arry_to_json')) {
    function flexigrid_json($data, $base_url, $page = 1)
    {

        $userinfo = currentuserinfo();
        $CI = &get_instance();
        $uri = $CI->session->userdata("current_uri");
        $uri = str_replace("/ajax_list_items/", "", $uri);

        $userinfo = currentuserinfo();

        $permission = get_permissions_lists();

        $edit = false;
        $view = false;
        $add = false;

        foreach ($permission as $k => $v) {
            if ($v == AT_VIEW && $uri . '/view' == $k) {
                $view = true;
            }

            if ($v == AT_EDIT && $uri . '/edit' == $k) {
                $edit = true;
            }

            if ($v == AT_ADD && $uri . '/add' == $k) {
                $add = true;
            }

        }

        header("Content-type: application/json");
        $jsonData = array(
            'page' => $page,
            'total' => $data['total'],
            'rows' => array());

        $c = $data['offset'];
        foreach ($data['result'] as $row) {
            $c++;

            $cells = array();
            $cells['checkbox'] = '<input id="c_row' . $row->id .
            '" class="datacb single_checkbox" type="checkbox" value="' . $row->id . '"/>';
            $cells['sno'] = $c;

            foreach ($row as $k => $v) {
                $cells[$k] = $v;
                //pr($row);
            }
            //die;

            //pr($row);die;
            $temp = null;
            if ($userinfo->is_super_site || $userinfo->is_super || $view) {
                $temp .= '<a href="' . $base_url . "/view/" . $row->id . '">View</a>';
            }

            if ($userinfo->is_super_site || $userinfo->is_super || $edit) {
                if ($userinfo->is_super_site || $userinfo->is_super || $view) {
                    $temp .= ' | ';
                }

                $temp .= '<a href="' . $base_url . "/edit/" . $row->id . '" >Edit</a>';
            }

            if ($temp != null) {
                $cells['actions'] = $temp;
            }

            $entry = array('id' => $row->id, 'cell' => $cells);

            $jsonData['rows'][] = $entry;
        }

        return json_encode($jsonData);
    }
}

// ------------------------------------------------------------------------

/**
 * LISt Field
 *
 * This function get All Field From Database To Json
 *
 * @param
 * @return
 */
if (!function_exists('list_table_fields')) {
    function list_table_fields($table)
    {
        $CI = &get_instance();
        $fields = $CI->db->list_fields($table);
        return $fields;
    }
}

//------------------------------------------------------------------------

/**
 * Get Export Data
 *
 * Get Export Data From Array
 *
 * @access    public
 * @return  String
 */

function array_to_csv($array, $download = "", $headers = null)
{
    if ($download != "") {
        header('Content-Type: application/csv');
        header('Content-Disposition: attachement; filename="' . $download . '"');
    }

    ob_start();

    $f = fopen('php://output', 'w') or show_error("Can't open php://output");
    $n = 0;
    if (!empty($headers)) {
        fputcsv($f, $headers);
    }
    foreach ($array as $line) {
        $n++;
        if (!fputcsv($f, $line)) {
            show_error("Can't write line $n: $line");
        }
    }
    fclose($f) or show_error("Can't close php://output");
    $str = ob_get_contents();
    ob_end_clean();

    if ($download == "") {
        return $str;
    } else {
        echo $str;
    }
}

// ------------------------------------------------------------------------

/**
 * Print Array
 *
 * This function print array value
 *
 * @param string the language key
 * @return string
 */
if (!function_exists('print_array')) {
    function print_array($data = array())
    {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}

// ------------------------------------------------------------------------

/**
 * Site Language
 *
 * This function get site language from site table
 *
 * @return string
 */
if (!function_exists('get_site_language')) {
    function get_site_language()
    {
        $CI = &get_instance();
        if ($language = $CI->session->userdata('language')) {
            return $language;
        } else {
            return "english";
        }

    }
}

//-------------------------------------------------------
/**
 * Get Current URI
 *
 * This function get site language from site table
 *
 * @return string
 */
if (!function_exists('current_uri')) {
    function current_uri()
    {
        $CI = &get_instance();
        $directory = $CI->router->fetch_directory();
        $directory = str_replace(array('../modules/', '/controllers/'), '', $directory);

        $controller_name = $CI->router->fetch_class();
        $method_name = $CI->router->fetch_method();

        $uri = null;
        if ($controller_name === $directory) {
            $uri = $controller_name . '/' . $method_name;
        } else {
            $uri = $directory . '/' . $controller_name . '/' . $method_name;
        }

        return $uri;

    }

}

if (!function_exists('get_permissions_lists')) {
    function get_permissions_lists()
    {
        $CI = &get_instance();

        $permission = array();
        $uri = $CI->session->userdata("current_uri");
        $uri = str_replace("/list_items/", "", $uri);

        if (currentuserinfo()->extra_group_id == "") {
            $group_id = currentuserinfo()->group_id;
            $CI->db->where('group_id', $group_id);
            $CI->db->where('uri !=', '');
            $query = $CI->db->get('user_group_permissions');
            $row = $query->row();

            if ($row && $row->uri != '') {
                $permission = json_decode(stripslashes($row->uri));
            }
        } else {
            $group_id = currentuserinfo()->group_id;
            $extra_group = currentuserinfo()->extra_group_id . "," . $group_id;
            $extra_group_id = explode(",", $extra_group);

            $CI->db->where_in('group_id', $extra_group_id);
            $CI->db->where('uri !=', '');
            $query = $CI->db->get('user_group_permissions');

            $results = $query->result();

            foreach ($results as $row) {
                $temp = null;
                $temp = json_decode(stripslashes($row->uri));

                foreach ($temp as $k => $v) {
                    $permission[$k] = $v;
                }

            }
        }

        return $permission;

    }
}

if (!function_exists('permission_denied')) {
    function permission_denied()
    {
        $config = &get_config();
        redirect('error/permission_denied', 'location', "301");
    }

}
if (! function_exists('send_mail')) 
{
	function send_mail($email='',$subject="",$message="",$mail_cc="", $bccMailIds = '', $from = '',$file = '',$data = '')
	{ 
		$CI = &get_instance();
		if(is_numeric($email))
		{	
			$CI->db->where("id", $email);
			$r = $CI->db->get("users");
			$email = $r->row()->email;
		}	
		//echo $email; die;
        $CI->load->library('sendmail');
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
       /*  $mail->Username = "test.tekshapers@gmail.com";
        $mail->Password = "developer@tekshapers1";
        $mail->setFrom('test.tekshapers@gmail.com', 'SPD');  */
		if($_SERVER['HTTP_HOST']	==	'e-rookie.com' || $_SERVER['HTTP_HOST']	==	'india.e-rookie.com' ){
			//$mail->Username = "e-rookie@tekshapers.com";
			//$mail->Password = "Tek##54321";
		}else{
			//$mail->Username = "e-rookie@tekshapers.com";
			//$mail->Password = "Tek##54321";
		}
		
       // $mail->setFrom('e-rookie@tekshapers.com', 'E-rookie');
        $mail->Subject = $subject;
		$data=array();
        $data['message'] = $message;
        $msg = $message;
		$mail->Body = $msg;
        
		if(is_array($email)){
			//$addr = implode(',',$email);

			foreach ($email as $ad) {
				$mail->AddAddress( trim($ad) );       
			}
		}
		else{
			$mail->AddAddress($email);
		}
		//$mail->AddAddress('priya1@tekshapers.com');
		if ($mail_cc) 
		{
			$mail->AddCC($mail_cc);
		}
        $mail->AddBCC($bccMailIds);
        
        if($file!="")
		{
			if(is_array(@$file) && count(@$file)>0)
			{
                $arr_files   =   array();
                $arr_files   =   @$file;
                foreach($arr_files as $file)
				{
                    $mail->AddAttachment($file);
                }
            }
			else
			{
               $CI->email->attach();
               $mail->AddAttachment($file);
            }
		}
		if($mail->Send())
		{
             return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}

if (!function_exists('send_mail_dup')) {
    function send_mail_dup($user_id = null, $url = null, $message = null)
    {
        $config['protocol'] = 'smtp';
        // SMTP Server Address for Gmail.
        $config['smtp_host'] = "ssl://smtp.googlemail.com";
        // SMTP Port - the port that you is required
        $config['smtp_port'] = 465;
        // SMTP Username like. (abc@gmail.com)
        //$config['smtp_user'] = "e-rookie@tekshapers.com";
        // SMTP Password like (abc***##)
        $config['smtp_pass'] = "Tek##54321";
        
        $CI = &get_instance();
        $CI->db->where("id", $user_id);
        $r = $CI->db->get("users");
        $to_email = $r->row()->email;
        $from_email = currentuserinfo()->email;
        $name = currentuserinfo()->first_name . " " . currentuserinfo()->last_name;
        $CI->load->library('email',$config);
        $CI->email->from($from_email, $name);
        $CI->email->to($to_email);
        $CI->email->subject($message);
        $CI->email->message($url);
        $CI->email->send();
    }

}

if (!function_exists('sendsubmittal_mail')) {
    function sendsubmittal_mail($from = null, $to = null, $name = null, $subject, $message, $file_path = null,
        $cc_mail = null) {
        $CI = &get_instance();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['mailtype'] = 'html';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = true;
        $CI->email->initialize($config);

        $message = str_replace("</p>", "</p> \n", $message);

        $info = currentuserinfo();
        //pr($info->email);exit;
        $from_name = $info->first_name . " " . $info->last_name . "(Tekshapers)";

        $CI->email->from($from, $from_name);
        $CI->email->to($to);
        if ($cc_mail != null) {
            $ccEmails = explode(",", $cc_mail);
            if (!in_array($info->email, $ccEmails)) {
                $ccEmails[] = $info->email;
            }
            $CI->email->cc($ccEmails);
        } else {
            $CI->email->cc($info->email);
        }

        $CI->email->subject($subject);
        $CI->email->message($message);

        foreach ($file_path as $k => $v) {
            $CI->email->attach($v);
        }
        $email = $info->email;
        $CI->email->send();
    }
}

function _check_perm()
{
	//echo "yess";
    $CI = &get_instance();
    $uri = current_uri();
	//pr($uri);
    $controller_name = $CI->router->fetch_class();
    $method_name = $CI->router->fetch_method();
	//pr($method_name);die;
    $bypass_permission = $CI->config->item('bypass_permission');
    if (isset(currentuserinfo()->is_super_site) && !currentuserinfo()->is_super_site && $controller_name ==
        "site") {
        permission_denied();
        exit();
    }

    if (isset(currentuserinfo()->is_super_site)) {
        if (currentuserinfo()->is_super_site >= 1 || currentuserinfo()->is_super >= 1) {

            return true;
        }
    }

    $data = array();
    $current_uri = array();

    if (currentuserinfo()->extra_group_id == "") {
        $group_id = currentuserinfo()->group_id;
        $CI->db->where('group_id', $group_id);
        $CI->db->where('uri !=', '');
        $query = $CI->db->get('user_group_permissions');
        if ($query->num_rows > 0) {
            $decode = $query->row()->data;
        }

        $data = json_decode($decode, true);
        //pr($data); die;
        //$CI->session->set_userdata('display_menu', $data);
        return $data;
    } else {
        $group_id = currentuserinfo()->group_id;
        $extra_group = currentuserinfo()->extra_group_id . "," . $group_id;
        $extra_group_id = explode(",", $extra_group);

        $CI->db->where_in('group_id', $extra_group_id);

        $query = $CI->db->get('user_group_permissions');

        $counter = count($query->result());
        if ($counter > 1) {
            $finalArr = array();
            foreach ($query->result() as $key => $value) {
                $results = $value->data;
                $finalArr[] = json_decode($results, true);
            }

            $arr_first = $finalArr[0];
            $arr_second = $finalArr[1];
            $final = array_merge($arr_first, $arr_second);
            foreach ($final as $key => $value) {
                if (array_key_exists($key, $arr_first) && array_key_exists($key, $arr_second)) {
                    $data[$key] = array_merge($arr_first[$key], $arr_second[$key]);
                } else
                if (!array_key_exists($key, $arr_first)) {
                    $data[$key] = $arr_second[$key];
                } else
                if (!array_key_exists($key, $arr_second)) {
                    $data[$key] = $arr_first[$key];
                }

            }

            if (isset($finalArr[2])) {
                $final_1 = array_merge($data, $finalArr[2]);
                foreach ($final_1 as $key => $value) {
                    if (array_key_exists($key, $data) && array_key_exists($key, $finalArr[2])) {
                        $data[$key] = array_merge($data[$key], $finalArr[2][$key]);
                    } else
                    if (!array_key_exists($key, $data)) {
                        $data[$key] = $finalArr[2][$key];
                    } else
                    if (!array_key_exists($key, $finalArr[2])) {
                        $data[$key] = $data[$key];
                    }

                }
            }
            if (isset($finalArr[3])) {
                $final_2 = array_merge($data, $finalArr[3]);
                foreach ($final_2 as $key => $value) {
                    if (array_key_exists($key, $data) && array_key_exists($key, $finalArr[3])) {
                        $data[$key] = array_merge($data[$key], $finalArr[3][$key]);
                    } else
                    if (!array_key_exists($key, $data)) {
                        $data[$key] = $finalArr[3][$key];
                    } else
                    if (!array_key_exists($key, $finalArr[3])) {
                        $data[$key] = $data[$key];
                    }

                }
            }
            if (isset($finalArr[4])) {
                $final_3 = array_merge($data, $finalArr[4]);
                foreach ($final_3 as $key => $value) {
                    if (array_key_exists($key, $data) && array_key_exists($key, $finalArr[4])) {
                        $data[$key] = array_merge($data[$key], $finalArr[4][$key]);
                    } else
                    if (!array_key_exists($key, $data)) {
                        $data[$key] = $finalArr[4][$key];
                    } else
                    if (!array_key_exists($key, $finalArr[4])) {
                        $data[$key] = $data[$key];
                    }

                }
            }

        } else {
            $results = $query->row()->data;
            $data = json_decode($results, true);
        }

        // $CI->session->set_userdata('display_menu', $data);
        return $data;

    }

    if (isset($current_uri->$uri)) {
        $code = $current_uri->$uri;
        $temp_uri = str_replace('/' . $method_name, '', $uri);

        $permission['action'] = $method_name;
        $permission['code'] = $code;

        if (AT_VIEW == $code) {
            if (isset($data->$temp_uri->all_view)) {
                $permission['type'] = "all_view";
            } else {
                $permission['type'] = "own_view";
            }

        } else
        if (AT_EDIT == $code) {
            if (isset($data->$temp_uri->all_edit)) {
                $permission['type'] = "all_edit";
            } else {
                $permission['type'] = "own_edit";
            }

        }

        $CI->session->set_userdata("permission", $permission);
        return true;
    }

    permission_denied();
    exit();
}

function getGroup($group_id = null)
{
    $CI = &get_instance();
    $CI->db->where('group_id', $group_id);
    $CI->db->where('uri !=', '');
    $query = $CI->db->get('user_group_permissions');
    if ($query->num_rows > 0) {
        $decode = $query->row()->data;
        $data = json_decode($decode, true);
        return $data;
    } else {
        return false;
    }
}

function getUser($userId = null)
{
    $CI = &get_instance();
    $CI->db->select("users.id,users.first_name,users.last_name,users.parent_user_id,users.email");

    $CI->db->where('site_id', currentuserinfo()->site_id);

    $CI->db->from("users");
    $CI->db->where('id', $userId);
    $query = $CI->db->get();
    //pr($query->row());
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return 0;
    }

}

/**
 * @function name getParentGroup()
 * purpose to get parent list
 * @created date  17 dec 2013
 * @created by    Kumar Gaurav
 */
function getParentGroup($group_id = null, $list = array())
{
    $CI = &get_instance();

    $CI->db->select("parent_group_id, id");
    $q = $CI->db->get_where("user_groups", array("id" => $group_id));
    if ($q->num_rows > 0) {
        $list[] = $q->row()->parent_group_id;
		$CI->db->select("parent_group_id, id");
		$q2 = $CI->db->get_where("user_groups", array("parent_group_id" => $q->row()->parent_group_id, "id !=" => $group_id));
		if ($q2->num_rows > 0) 
		{
			$list[] = $q2->row()->id;
		}
		
    } else {
        return $list;
    }
    $group_list = getParentGroup($q->row()->parent_group_id, $list);
    return $group_list;

}

/**
 * @function name getCandidate()
 * purpose to get Candidate list
 * @created date   28 Oct 2013
 * @created by    Kumar Gaurav
 */
/*function getCandidate($userId = null)
{
    $CI = &get_instance();
    $CI->db->select("candidate.id,candidate.first_name,candidate.last_name,candidate.email,candidate.resume_title");
    $CI->db->where('site_id', currentuserinfo()->site_id);

    $CI->db->from("candidate");
    $CI->db->where('id', $userId);
    $query = $CI->db->get();
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return 0;
    }

}*/

/*function get_pipeline($type1 = null, $type2 = null, $user_list = null, $userId = null, $i = null)
{
    $CI = &get_instance();

    $CI->db->where("job_order.site_id", currentuserinfo()->site_id);

    $CI->db->where("is_added", "0");

    if ($type1 != null) {
        $CI->db->where('date(job_order_activity.modified_time) <=', $type1);
    }
    if ($type2 != null) {
        $CI->db->where('date(job_order_activity.modified_time) >=', $type2);
    }

    $CI->db->join("job_order", "job_order.id = job_order_activity.job_order_id", "LEFT");

    if ($userId != null) {
        $whr = "( job_order.added_by = '$userId' OR job_order_activity.added_by = '$userId' )";
    } else
    if ($user_list != null) {
        $user_list = implode(',', $user_list);
        $whr = "( job_order.added_by IN($user_list) OR job_order_activity.added_by IN($user_list) ) ";
    }

    $CI->db->where("job_order_activity.is_submitted !=", 1);

    $query = $CI->db->get_where("job_order_activity", $whr);
    //echo $CI->db->last_query();
    //echo '<br/>';
    if ($query->num_rows() > 0) {
        return $query->num_rows;
    } else {
        return 0;
    }

}*/

function submittal($type1 = null, $type2 = null, $user_list = null, $userId = null)
{
    $CI = &get_instance();
    //$CI->db->where('date(modified_time) <=',$type1);
    //$CI->db->where('date(modified_time) >=',$type2);
    $CI->db->where("job_order.site_id", currentuserinfo()->site_id);
    $CI->db->where("is_added", "0");

    if ($type1 != null) {
        $CI->db->where('date(job_order_activity.modified_time) <=', $type1);
    }
    if ($type2 != null) {
        $CI->db->where('date(job_order_activity.modified_time) >=', $type2);
    }

    $CI->db->where("status_id", 5);
    $CI->db->where("is_submitted", 1);

    $CI->db->join("job_order", "job_order.id = job_order_activity.job_order_id", "LEFT");

    if ($user_list != null) {
        $user_list = implode(',', $user_list);
        $whr = "( job_order.added_by IN($user_list) OR job_order_activity.added_by IN($user_list) ) ";
    }

    $query = $CI->db->get_where("job_order_activity", $whr);

    // echo $CI->db->last_query();exit;
    //echo '<br/>';

    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

/**
 * @function name getCompanyContact()
 * purpose to get user list
 * @created date  25 june 2013
 * @created by    Kumar Gaurav
 */
function getCompanyContact($status = null, $type1 = null, $type2 = null, $user_list = null, $userId = null)
{
    $CI = &get_instance();
    $CI->db->where('date(created_time) <=', $type1);
    $CI->db->where('date(created_time) >=', $type2);

    $CI->db->where("site_id", currentuserinfo()->site_id);

    if ($status == 1) {
        $CI->db->where("status", 1);
    } else
    if ($status == 2) {
        $CI->db->where("status", 0);
    }

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }

    $query = $CI->db->get("companies_contact");
    //echo $CI->db->last_query();exit;
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

/**
 * @function name getUser()
 * purpose to get user list
 * @created date  25 june 2013
 * @created by    Kumar Gaurav
 */
function getVendor($status = null, $type1 = null, $type2 = null, $user_list = null, $userId = null)
{
    $CI = &get_instance();
    $CI->db->where('date(created_time) <=', $type1);
    $CI->db->where('date(created_time) >=', $type2);

    $CI->db->where("site_id", currentuserinfo()->site_id);

    $CI->db->where("status", $status);
    /*if($userId!=null){
    $CI->db->where_in("added_by",$userId,FALSE);
    }*/
    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }

    $query = $CI->db->get("vendor");
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

function childUsers($user_d = null, $counter = null)
{
	if(!empty(cache_opration('get','childUsers_'.$user_d)))
	{
		$result= cache_opration('get','childUsers_'.$user_d);
		return $result;
	}
	else
	{
		$CI = &get_instance();
		$CI->db->select("id,concat(first_name,' ',last_name) as name", false);
		$CI->db->from("users");

		$CI->db->where("parent_user_id", $user_d);
		$CI->db->where("status", 'active');
		$resource = $CI->db->get();

		$list = array();
		if ($resource->num_rows > 0) {
			foreach ($resource->result() as $key => $result) {
				$list[$result->id] = $result->name;
			}
		}
		cache_opration('set','childUsers_'.$user_d,$list);
		return $list;
	}
}
// this function is not using any where
function child_users_sumit_old($list = array(), $user_list = array())
{
	$sees_user_data=isset($list) && !empty($list) ? $list : currentuserinfo()->id;
	if(!empty(cache_opration('get','child_users_'.$sees_user_data)))
	{
		$result= cache_opration('get','child_users_'.$sees_user_data);
		return $result;
	}
	else
	{
		$CI = &get_instance();
		if (empty($list)) {
			$user_list[] = currentuserinfo()->id;
		} else
		if (count($user_list) <= 1) {
			$user_list[] = $list;
			//print_r($user_list);exit;
		}

		$check_list = array();
		$return["check_list"] = array();
		$return["total_list"] = array();

		$CI->db->select("id");
		$CI->db->where_in("parent_user_id", $list);
		//$CI->db->where("status", 'active');
		$resource = $CI->db->get("users");

		if ($resource->num_rows > 0) {
			foreach ($resource->result() as $key => $res) {
				$check_list[] = $res->id;
			}

			$return["total_list"] = array_merge($user_list, $check_list);
			$return["check_list"] = $check_list;

			$return = child_users($return["check_list"], $return["total_list"]);
			cache_opration('set','child_users_'.$sees_user_data,$return);
			return $return;

		} else {
			$return['total_list'] = $user_list;
			//print_r($return);exit;
			cache_opration('set','child_users_'.$sees_user_data,$return);
			return $return;
		}
		cache_opration('set','child_users_'.$sees_user_data,$return);
		return $return;
	}
}

function child_users_live($list = array(), $user_list = array())
{
	$CI = &get_instance();
	if (empty($list)) {
		$user_list[] = currentuserinfo()->id;
	} else
	if (count($user_list) <= 1) {
		$user_list[] = $list;
		//print_r($user_list);exit;
	}

	$check_list = array();
	$return["check_list"] = array();
	$return["total_list"] = array();

	$CI->db->select("id");
	$CI->db->where_in("parent_user_id", $list);
	//$CI->db->where("status", 'active');
	$resource = $CI->db->get("users");

	if ($resource->num_rows > 0) {
		foreach ($resource->result() as $key => $res) {
			$check_list[] = $res->id;
		}

		$return["total_list"] = array_merge($user_list, $check_list);
		$return["check_list"] = $check_list;

		$return = child_users($return["check_list"], $return["total_list"]);
		return $return;

	} else {
		$return['total_list'] = $user_list;
		//print_r($return);exit;
		return $return;
	}

	return $return;
}

function child_users($list = array(), $user_list = array())
{
	//session_start();
	$CI = &get_instance();
	$sess_child_list =   isset($_SESSION["new_child_list"]) ? $_SESSION["new_child_list"] : array();
	if(isset($sess_child_list) && !empty($sess_child_list))
	{
		return $sess_child_list;
	}
	else
	{
		if (empty($list)) {
			$user_list[] = currentuserinfo()->id;
		} else
		if (count($user_list) <= 1) {
			$user_list[] = $list;
			//print_r($user_list);exit;
		}

		$check_list = array();
		$return["check_list"] = array();
		$return["total_list"] = array();

		$CI->db->select("id");
		$CI->db->where_in("parent_user_id", $list);
		//$CI->db->where("status", 'active');
		$resource = $CI->db->get("users");

		if ($resource->num_rows > 0) {
			foreach ($resource->result() as $key => $res) {
				$check_list[] = $res->id;
			}

			$return["total_list"] = array_merge($user_list, $check_list);
			$return["check_list"] = $check_list;

			$return = child_users($return["check_list"], $return["total_list"]);
			$_SESSION["new_child_list"] = $return;
			return $return;

		} else {
			$return['total_list'] = $user_list;
			//print_r($return);exit;
			$_SESSION["new_child_list"] = $return;
			return $return;
		}

		return $return;
	}
}

function child_users_old($list = array(), $user_list = array())
{
	$CI = &get_instance();
	//pr($CI->session->userdata); die;
	$sess_child_list = $CI->session->userdata("child_list");
	if(isset($sess_child_list) && !empty($sess_child_list))
	{
		return $CI->session->userdata("child_list");
	}
	else
	{
		if (empty($list)) {
			$user_list[] = currentuserinfo()->id;
		} else
		if (count($user_list) <= 1) {
			$user_list[] = $list;
			//print_r($user_list);exit;
		}

		$check_list = array();
		$return["check_list"] = array();
		$return["total_list"] = array();

		$CI->db->select("id");
		$CI->db->where_in("parent_user_id", $list);
		//$CI->db->where("status", 'active');
		$resource = $CI->db->get("users");

		if ($resource->num_rows > 0) {
			foreach ($resource->result() as $key => $res) {
				$check_list[] = $res->id;
			}

			$return["total_list"] = array_merge($user_list, $check_list);
			$return["check_list"] = $check_list;

			$return = child_users($return["check_list"], $return["total_list"]);
			return $return;

		} else {
			$return['total_list'] = $user_list;
			//print_r($return);exit;
			return $return;
		}

		return $return;
	}
}

function child_users_with_name($list = array(), $user_list = array())
{
    $CI = &get_instance();
    if (empty($user_list)) {
        $user_list[currentuserinfo()->first_name . ' ' . currentuserinfo()->last_name] = currentuserinfo()->
            id;
    }

    $check_list = array();
    $return["check_list"] = array();
    $return["total_list"] = array();

    $CI->db->select("id,concat(first_name,' ',last_name) as name", false);
    $CI->db->where_in("parent_user_id", $list);
    $resource = $CI->db->get("users");

    if ($resource->num_rows > 0) {
        foreach ($resource->result() as $key => $res) {
            $check_list[$res->name] = $res->id;
        }

        $return["total_list"] = array_merge($user_list, $check_list);
        $return["check_list"] = $check_list;

        $return = child_users_with_name($return["check_list"], $return["total_list"]);

        return $return;

    } else {
        $return['total_list'] = $user_list;

        return $return;
    }

    return $return;

}

function child_groups()
{
	$CI = &get_instance();
	$group_id = $CI->session->userdata("userinfo")->group_id;
	//if(!empty(cache_opration('get','user_groups_'.$group_id)))
	//{
		//$result= cache_opration('get','user_groups_'.$group_id);
		//return $result;
	//}
	//else
	//{
		$CI->db->where("id", $group_id);
		$r = $CI->db->get("user_groups");
		$parent_group_id = $r->row()->parent_group_id;
		$CI->db->select("u.id as parent_id", false);
		$CI->db->from("user_groups as u");

		for ($c = 1; $c < 2; $c++) {
			$CI->db->select("u$c.id as id$c", false);
			if ($c == 1) {
				$CI->db->join("user_groups as u$c", "u.id = u$c.parent_group_id", "LEFT", false);
			} else {
				$temp = $c - 1;
				$CI->db->join("user_groups as u$c", "u$temp.id = u$c.parent_group_id", "LEFT", false);
			}
		}
		$CI->db->where("u.id", $parent_group_id);
		$r = $CI->db->get("user_groups");
		$list = array();
		$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($r->result()));
		foreach ($it as $v) {
			if ($v != '') {
				$list[] = $v;
			}

		}
		$list = array_unique($list);
		//cache_opration('set','user_groups_'.$group_id,$list);
		return $list;
	//}
}

function set_child_users_new($user_id = null)
{
	$curr_date=date('Y-m-d');
	if(!empty(cache_opration('get','set_child_users_'.$curr_date.'_'.$user_id)))
	{
		$result= cache_opration('get','set_child_users_'.$curr_date.'_'.$user_id);
		return $result;
	}
	else
	{
		$CI = &get_instance();
		$CI->db->select("u.id as parent_id", false);
		$CI->db->from("users as u");

		for ($c = 1; $c < 10; $c++) {

			$CI->db->select("u$c.id as id$c", false);

			if ($c == 1) {
				$CI->db->join("users as u$c", "u.id = u$c.parent_user_id", "LEFT", false);
			} else {
				$temp = $c - 1;
				$CI->db->join("users as u$c", "u$temp.id = u$c.parent_user_id", "LEFT", false);
			}

		}

		$CI->db->where("u.id", $user_id);
		$r = $CI->db->get("users");

		$list = array();

		$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($r->result()));

		if (count($it) > 0) {
			foreach ($it as $v) {
				if ($v != '') {
					$list[] = $v;
				}

			}
			$list = array_unique($list);
		}

		//echo count($list);
		cache_opration('set','set_child_users_'.$curr_date.'_'.$user_id,$list);
		return $list;
	}

}

function _child_users($userid = null) {
	
	$sess_child_users =   isset($_SESSION["_child_users"]) ? $_SESSION["_child_users"] : array();
	if(isset($sess_child_users) && !empty($sess_child_users))
	{
		return $sess_child_users;
	}
	else
	{
		$CI = &get_instance();
		$CI->db->select("u.id as parent_id", false);
		$CI->db->from("users as u");
		for ($c = 1; $c < 10; $c++) {
			$CI->db->select("u$c.id as id$c", false);
			if ($c == 1)
				$CI->db->join("users as u$c", "u.id = u$c.parent_user_id", "LEFT", false);
			else {
				$temp = $c - 1;
				$CI->db->join("users as u$c", "u$temp.id = u$c.parent_user_id", "LEFT", false);
			}
			//$CI->db->order_by("u$c.first_name");
		}
		$CI->db->where("u.id", $userid);
		$r = $CI->db->get("users");
		$list = array();
		$it = new RecursiveIteratorIterator(new RecursiveArrayIterator($r->result()));
		foreach ($it as $v) {
			if ($v != '')
				$list[] = $v;
		}
		$list = array_unique($list);
		$_SESSION["_child_users"] = $list;
		return $list;
		//$CI->session->set_userdata("child_list", $list);
	}
}

function set_child_users($user_id = null)
{
    $CI = &get_instance();
    $CI->db->select("u.id as parent_id", false);
    $CI->db->from("users as u");

    for ($c = 1; $c < 10; $c++) {

        $CI->db->select("u$c.id as id$c", false);

        if ($c == 1) {
            $CI->db->join("users as u$c", "u.id = u$c.parent_user_id", "LEFT", false);
        } else {
            $temp = $c - 1;
            $CI->db->join("users as u$c", "u$temp.id = u$c.parent_user_id", "LEFT", false);
        }

    }

    $CI->db->where("u.id", $user_id);
    $r = $CI->db->get("users");

    $list = array();

    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($r->result()));

    if (count($it) > 0) {
        foreach ($it as $v) {
            if ($v != '') {
                $list[] = $v;
            }

        }
        $list = array_unique($list);
    }

    //echo count($list);

    return $list;

}

function currentUser($userId = null)
{
    $CI = &get_instance();
    $CI->db->select("*");
    $CI->db->from("users");
    $CI->db->where('id', $userId);
    $query = $CI->db->get();
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return 0;
    }

}

/**
 * @function name pipelineHistory()
 * @purpose  to get add history for the job order add candidate to pipeline
 * @created  date  9 july 2013
 * @created  by    Kumar Gaurav
 */
function pipelineHistory($array = null)
{
    $CI = &get_instance();
    $table = "pipeline_history";
    $query = $CI->db->insert_string($table, $array);
    $result = $CI->db->query($query);
    //echo $CI->db->last_query();die;
    if ($result) {
        return true;
    } else {
        return false;
    }
}


function set_child_groups()
{
    $CI = &get_instance();
    $group_id = currentuserinfo()->group_id;

    $CI->db->where("parent_group_id", $group_id);
    $r = $CI->db->get("user_groups");

    $CI->db->select("u.id as parent_id", false);
    $CI->db->from("user_groups as u");

    for ($c = 1; $c < 6; $c++) {

        $CI->db->select("u$c.id as id$c", false);

        if ($c == 1) {
            $CI->db->join("user_groups as u$c", "u.id = u$c.parent_group_id", "LEFT", false);
        } else {
            $temp = $c - 1;
            $CI->db->join("user_groups as u$c", "u$temp.id = u$c.parent_group_id", "LEFT", false);
        }

    }

    $CI->db->where("u.id", $group_id);
    $r = $CI->db->get("user_groups");

    $list = array();
    $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($r->result()));

    foreach ($it as $v) {
        //if(($v != '')&&($v!=$group_id))
        if ($v != '') {
            $list[] = $v;
        }

    }
    $list = array_unique($list);
    return $list;

}

function getData($table, $array = null)
{
    $CI = &get_instance();
    if ($array != '') {
        $CI->db->where($array);
    }
    $result = $CI->db->get($table);
    if ($result->num_rows > 0) {
        return $result->row();
    } else {
        return flase;
    }
}

function getPerPage($table = null, $adder = null)
{
    $CI = &get_instance();
    $user = currentuserinfo();
    //pr($_SERVER); die;
    $counter = count(explode("/", @$_SERVER['ORIG_PATH_TRANSLATED']));
    if ($adder != 1) {
        if ($counter > 3) {
            $controllerInfo = $CI->uri->segment(1) . "/" . $CI->uri->segment(2) . "/" . $CI->uri->segment(3);
            $controllerInfoLoad = $CI->uri->segment(1) . "/" . $CI->uri->segment(2) . "/ajax_list_items";
        } else {
            $controllerInfo = $CI->uri->segment(1) . "/" . $CI->uri->segment(2);
            $controllerInfoLoad = $CI->uri->segment(1) . "/ajax_list_items";
        }
    } else {
        $controllerInfo = "candidate/list_items";
        $controllerInfoLoad = "candidate/ajax_list_items";
    }

    $CI->db->where("action", $controllerInfo);
    $CI->db->or_where("action", $controllerInfoLoad);
    $CI->db->where("user_id", $user->id);
    $query = $CI->db->get($table);
    //echo $CI->db->last_query();exit;
    if ($query->num_rows > 0) {
        return $query->row()->records;
    } else {
        return false;
    }
}

/**
 * @function jobOrderHistory
 * @purpose  To add job order history
 * @created  18/july/2013
 */

function jobOrderHistory($array = '')
{
    $CI = &get_instance();
    $table = "job_order_history";
    $query = $CI->db->insert_string($table, $array);
    $result = $CI->db->query($query);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

/**
 * @function checkPerPage
 * @purpose  to check record per page
 * @created  24/july/2013
 */
function checkPerPage($first = '', $second = '', $third = '')
{
    $CI = &get_instance();
    $user = currentuserinfo();

    if ($third != '') {
        $controllerInfo = $first . "/" . $second . "/" . $third;
        $controllerInfoLoad = $first . "/" . $second . "/ajax_list_items";
    } else {
        $controllerInfo = $first . "/" . $second;
        $controllerInfoLoad = $first . "/ajax_list_items";
    }

    $CI->db->where("action", $controllerInfo);
    $CI->db->or_where("action", $controllerInfoLoad);
    $CI->db->where("user_id", $user->id);
    $query = $CI->db->get("per_page");

    if ($query->num_rows > 0) {
        return $query->row()->id;
    } else {
        return false;
    }
}

/**
 * @function update_perPage
 * @purpose  to update record per page
 * @created  24/july/2013
 */
function update_perPage($table, $array = null, $id = null)
{
    $CI = &get_instance();
    $where = "id = $id";
    $query = $CI->db->update_string($table, $array, $where);
    $result = $CI->db->query($query);
    if ($result) {
        return true;
    } else {
        return false;
    }
}

function not_available()
{

}

/**
 * @function name get_final_joborder_pipeline
 * purpose to find the activity on particular job
 * @created date  28 OCT 2014
 * @created * by    Nitish Janterparia */
function get_final_joborder_pipeline($id = null, $sdate = null, $edate = null)
{
    $CI = &get_instance();
    $site_id = currentuserinfo()->site_id;
    $whr = null;
    $elsewhr = null;

    if ($sdate != null) {
        $whr .= "AND date(job_order_history.created_time) >= '$sdate'";
        $elsewhr .= "AND date(modified_time) >= '$sdate' ";
    }

    if ($edate != null) {
        $whr .= "AND date(job_order_history.created_time) <= '$edate'";
        $elsewhr .= "AND date(modified_time) <= '$edate'";
    }

    $join = "select p.job_order_id from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE  job_order_history.`site_id` = '$site_id' $whr  AND job_order_id='$id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";

    $sql = " SELECT job_order_activity.id FROM (`job_order_activity`) join

            ($join) lj on lj.job_order_id=job_order_activity.job_order_id

            WHERE job_order_activity.`is_added` = '0' AND is_submitted!='1' AND status_id='0'  $elsewhr AND job_order_activity.`site_id` = '$site_id'

            ";
    $query = $CI->db->query($sql);
    // echo $CI->db->last_query();die;
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

function get_final_joborder_pipeline_new($id = null, $sdate = null, $edate = null, $user_list = null, $user_type = null,
    $report_type = null,$assign_user_id=NULL) {
    $CI = &get_instance();
    //$user_list = explode(",", $user_list) : ''; // Comment by sumit
    $user_list = isset($user_list) && !empty($user_list) ?  explode(",", $user_list) : ''; // addded by sumit
    $start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
    $end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
    $active_jobs = get_active_jobs($start_date, $end_date);
    $check = job_check();
	//change created date to modified date by sumit on 17-11-2018
    $CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", currentuserinfo()->site_id);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_submitted !=", 1);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) : ''; //comment by sumit
    //(!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //addedd by sumit
    $CI->db->where("added_by", $assign_user_id);
	$CI->db->where("status_id", '0');
    $CI->db->where("job_order_id", $id);
    $query = $CI->db->get("job_order_activity");
    $result = $query->result();
	//echo $CI->db->last_query(); die;
    if (!empty($result)) {
        foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
            foreach ($active_jobs as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (!in_array($v->job_order_id, $temp_arr)) {
                        //unset($result[$k]); //added by sumit for reset removed job on 29th oct 2018
                    }
                }
            }
        }
    }
    unset($active_jobs);
	$result2	=	0;
	//========new code added by sumit on 23-11-2018 by sumit //
	$CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", currentuserinfo()->site_id);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) : ''; //cooment by sumit
    //(!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //added by sumit
    $CI->db->where("added_by", $assign_user_id);
	$CI->db->where("job_order_id", $id);
    $CI->db->where("is_submitted", 1);
	$CI->db->where("status_id", 5);  //added by sumit for submittal on 29th oct 2018
    $query2 = $CI->db->get("job_order_activity");
    $result2 = $query2->result();
	//$result1	=	count($result) - count($result2);
	$result1	=	count($result);
    return $result1;
}

function get_final_joborder_pipeline_report($id = null, $sdate = null, $edate = null, $user_list = null, $user_type = null,
    $report_type = null,$assign_user_id=NULL) {
    $CI = &get_instance();
    //$user_list = explode(",", $user_list) : ''; // Comment by sumit
    $user_list = isset($user_list) && !empty($user_list) ?  explode(",", $user_list) : ''; // addded by sumit
    $start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
    $end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
    $active_jobs = get_active_jobs($start_date, $end_date);
    $check = job_check();
	//change created date to modified date by sumit on 17-11-2018
    $CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", 2);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_submitted !=", 1);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) : ''; //comment by sumit
    //(!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //addedd by sumit
    $CI->db->where("added_by", $assign_user_id);
	$CI->db->where("status_id", '0');
    $CI->db->where("job_order_id", $id);
    $query = $CI->db->get("job_order_activity");
    $result = $query->result();
	//echo $CI->db->last_query(); die;
    if (!empty($result)) {
        foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
            foreach ($active_jobs as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (!in_array($v->job_order_id, $temp_arr)) {
                        //unset($result[$k]); //added by sumit for reset removed job on 29th oct 2018
                    }
                }
            }
        }
    }
    unset($active_jobs);
	$result2	=	0;
	//========new code added by sumit on 23-11-2018 by sumit //
	$CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", 2);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) : ''; //cooment by sumit
    //(!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //added by sumit
    $CI->db->where("added_by", $assign_user_id);
	$CI->db->where("job_order_id", $id);
    $CI->db->where("is_submitted", 1);
	$CI->db->where("status_id", 5);  //added by sumit for submittal on 29th oct 2018
    $query2 = $CI->db->get("job_order_activity");
    $result2 = $query2->result();
	//$result1	=	count($result) - count($result2);
	$result1	=	count($result);
    return $result1;
}

// ------------------------------------------------------------------------

/**
 *  Activity Submittal
 *
 * This function Submittal of joborder for final report
 *
 * @access    public
 * @return    html data
 */
function get_final_joborder_submittal($id = null, $sdate = null, $edate = null, $added_by = null, $report_type = 2)
{
    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);
    if ($sdate != null) {
        $CI->db->where('date(modified_time) >=', $sdate);
    }

    if ($edate != null) {
        $CI->db->where('date(modified_time) <=', $edate);
    }
    //=================Added by Sumit on 27 may 2016===//
    if ($added_by != null && $report_type == 1) {
        $CI->db->where('added_by', $added_by);
    }
    //=================Added by Sumit on 27 may 2016===//
    //$CI->db->where("status_id", 5);
    $CI->db->where("is_added", "0");
    $CI->db->where("is_submitted", 1);
    $CI->db->where("job_order_id", $id);
    $query = $CI->db->get("job_order_activity");
    //echo '<br><br><br>';
    //echo $CI->db->last_query();exit;
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}



function get_final_joborder_submittal_new($id = null, $sdate = null, $edate = null, $user_list = null, $user_type = null,
    $report_type = null, $assign_user_id=NULL) {
    $CI = &get_instance();
    //$user_list = explode(",", $user_list) : ''; //comment by sumit
    $user_list = isset($user_list) && !empty($user_list) ? explode(",", $user_list) : ''; //add by sumit
    $check = job_check();
    $start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
    $end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
    $active_jobs = get_active_jobs($start_date, $end_date);
	
	//change created date to modified date by sumit on 17-11-2018
	
    $CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", currentuserinfo()->site_id);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) : ''; //cooment by sumit
    //(!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //added by sumit
    $CI->db->where("added_by", $assign_user_id);
	$CI->db->where("job_order_id", $id);
    $CI->db->where("is_submitted", 1);
	$CI->db->where("status_id", 5);  //added by sumit for submittal on 29th oct 2018
    $query = $CI->db->get("job_order_activity");
    $result = $query->result();
    if (!empty($result)) {
        foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
            foreach ($active_jobs as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (!in_array($v->job_order_id, $temp_arr)) {
                        //unset($result[$k]);  //added by sumit for reset removed job on 29th oct 2018
                    }
                }
            }
        }
    }
    unset($active_jobs); 
	
    return count($result);
}

function get_final_joborder_submittal_report($id = null, $sdate = null, $edate = null, $user_list = null, $user_type = null,
    $report_type = null, $assign_user_id=NULL) {
    $CI = &get_instance();
    //$user_list = explode(",", $user_list) : ''; //comment by sumit
    $user_list = isset($user_list) && !empty($user_list) ? explode(",", $user_list) : ''; //add by sumit
    $check = job_check();
    $start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
    $end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
    $active_jobs = get_active_jobs($start_date, $end_date);
	
	//change created date to modified date by sumit on 17-11-2018
	
    $CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", 2);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) : ''; //cooment by sumit
    //(!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //added by sumit
    $CI->db->where("added_by", $assign_user_id);
	$CI->db->where("job_order_id", $id);
    $CI->db->where("is_submitted", 1);
	$CI->db->where("status_id", 5);  //added by sumit for submittal on 29th oct 2018
    $query = $CI->db->get("job_order_activity");
    $result = $query->result();
    if (!empty($result)) {
        foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
            foreach ($active_jobs as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (!in_array($v->job_order_id, $temp_arr)) {
                        //unset($result[$k]);  //added by sumit for reset removed job on 29th oct 2018
                    }
                }
            }
        }
    }
    unset($active_jobs); 
	
    return count($result);
}

/**
 * @function name get_report_data()
 * purpose to get joborder report
 * @created date  12 NOV 2013
 * @created by    Kumar Gaurav
 */

function get_final_joborder_data($status_id = null, $id = null, $sdate = null, $edate = null)
{ 
    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);
    if ($sdate != null) {
        $CI->db->where('date(modified_time) >=', $sdate);
    }

    if ($edate != null) {
        $CI->db->where('date(modified_time) <=', $edate);
    }
    if ($status_id == 2) {
        $CI->db->where("is_submitted !=", '1');
    }
    $CI->db->where("is_added", "0");
    $CI->db->where("job_order_id", $id);
    $CI->db->where("status_id", $status_id);
    //$CI->db->where("is_submitted",1);
    $query = $CI->db->get("job_order_activity");
    // echo $CI->db->last_query();exit;
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}
function get_final_joborder_data_new($status_id = null, $id = null, $sdate = null, $edate = null, $user_list = null,
    $user_type = null, $report_type = null) {
    $CI = &get_instance();
    //$user_list=explode(",", $user_list); //comment by Sumit
    $user_list = isset($user_list) && !empty($user_list) ?  explode(",", $user_list) : '';  //add by sumit//
    $start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
    $end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
    $active_jobs = get_active_jobs($start_date, $end_date);
    $check = job_check();

    $CI->db->select('date(modified_time) as date_field,job_order_id');
    $CI->db->where("site_id", currentuserinfo()->site_id);
    $CI->db->where('date(modified_time) >=', $start_date);
    $CI->db->where('date(modified_time) <=', $end_date);
    $CI->db->where("is_added", "0");
    //(!in_array($user_type, $check) || $report_type == '1')  ? $CI->db->where_in("added_by", $user_list) : ''; //cooment by sumit
    (!in_array($user_type, $check) || $report_type == '1') && $user_list ? $CI->db->where_in("added_by", $user_list) : ''; //added by sumit
    $CI->db->where("job_order_id", $id);
    $CI->db->where("status_id", $status_id);
    $query = $CI->db->get("job_order_activity");
    $result = $query->result();
    if (!empty($result)) {
        foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
            foreach ($active_jobs as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (!in_array($v->job_order_id, $temp_arr)) {
                        // unset($result[$k]);   //added by sumit for reset removed job on 29th oct 2018
                    }
                }
            }
        }
    }
    unset($active_jobs);

    return count($result);
}

// ------------------------------------------------------------------------

/**
 *  View Training category
 *
 * This function to view category of training
 *
 * @access    public
 * @return    numeric data
 */
function view_training_category($id = null)
{
    $CI = &get_instance();
    $CI->db->where("id", $id);
    $CI->db->where("site_id", currentuserinfo()->site_id);

    $query = $CI->db->get("training_category");

    if ($query->num_rows() > 0) {
        return $query->row()->category_name;
    } else {
        return 0;
    }

}

// ------------------------------------------------------------------------

/**
 *  Training_category
 *
 * This function to view category of training
 *
 * @access    public
 * @return    numeric data
 */
function training_category($id = null)
{
    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);
    $query = $CI->db->get("training_category");
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
        return 0;
    }

}

function last_active_months()
{
    $months = array(
        '1' => '1',
        '2' => '2',
        '3' => '3',
        '5' => '5',
        '7' => '7',
        '15' => '15',
        '30' => '30',
        '60' => '60',
        '90' => '90',
        '120' => '120',
        '180' => '180',
        '365' => '365',
        '800' => 'All');
    return $months;
}

/**
 *  Notice Period
 *
 * This function to get notice period
 *
 * @access    public
 * @return    array
 */
function notice_period_list()
{
    $notice_period = array(
        '1' => 'Immediate',
        '2' => '1 Week',
        '3' => '2 Week',
        '4' => '3 Week',
        '5' => '4 Week',
        '6' => '5 Week');
    return $notice_period;
}

function resume_per_page()
{
    $notice_period = array(
        '1' => '30',
        '2' => '60',
        '3' => '90',
        '4' => '120');
    return $notice_period;
}

function education_list()
{
    $CI = &get_instance();
    $query = $CI->db->get("education");
    return $query->result();
}

function match_words()
{
    $match_words = array(
        '1' => 'Boolean',
        '2' => 'Match all words',
        '3' => 'Match any words');
    return $match_words;

}
function sort_by_list()
{
    $sort = array(
        '' => 'Select',
        '1' => 'Relevance',
        '2' => 'Active Days');
    return $sort;
}

function get_citylist($state_id = null)
{
    $CI = &get_instance();
    $query = $CI->db->get_where("cities", array('regionID' => $state_id));
    return $query->result();
}

/** Check cart item for today
 *
 * created by kumar gaurav
 */
/*function get_cart_total($attr = null)
{
    $CI = &get_instance();
    $today = date("Y-m-d");
    $send_date = date("Y-m-d", strtotime("-1 day"));
    //echo $send_date;exit;
    $where = array(
        'added_by' => currentuserinfo()->id,
        'site_id' => currentuserinfo()->site_id,
        'date(created_time) <= ' => $today,
        'date(created_time) >= ' => $send_date,
    );
    $CI->db->select($attr);
    $CI->db->from('cart_email_to_send');
    $CI->db->where($where);
    $query = $CI->db->get();
    //echo $CI->db->last_query();exit;
    $result = @$query->row()->$attr;
    return $result;
}*/

function get_data_by_id($tbl = null, $id = null)
{
    $CI = &get_instance();

    $where = array('id' => $id);
    $query = $CI->db->get_where($tbl, $where);
    //echo $CI->db->last_query();exit;
    $result = @$query->row();
    return $result;
}

/*function count_cart_total_id()
{
    $CI = &get_instance();
    $today = date("Y-m-d");
    $send_date = date("Y-m-d", strtotime("-24 hour"));

    $where = array(
        'added_by' => currentuserinfo()->id,
        'site_id' => currentuserinfo()->site_id,
        'date(created_time) <= ' => $today,
        'date(created_time) >= ' => $send_date,
    );
    $CI->db->select('recievers_id');
    $CI->db->from('cart_email_to_send');
    $CI->db->where($where);
    $query = $CI->db->get();
    $result = @$query->row()->recievers_id;
    $result = explode(',', $result);
    if (empty($result[0])) {
        return false;

    }
    $total_count = count($result);
    return $total_count;

}*/

/*function count_cart_total_by_id($id, $tbl = null)
{
    $CI = &get_instance();
    $where = array('id ' => $id);
    $CI->db->select('recievers_id');
    if ($tbl) {
        $CI->db->from($tbl);
    } else {
        $CI->db->from('cart_email_to_send');
    }

    $CI->db->where($where);
    $query = $CI->db->get();
    //echo $CI->db->last_query();exit;
    $result = @$query->row()->recievers_id;

    $result = explode(',', $result);

    if (empty($result[0])) {
        return false;

    }
    $total_count = count($result);
    return $total_count;

}*/

/*function delete_cart_total()
{
    $CI = &get_instance();
    $today = date("Y-m-d");
    $send_date = date("Y-m-d", strtotime("-1 day"));

    $site_id = currentuserinfo()->site_id;
    $CI->db->query("DELETE FROM `cart_email_to_send` WHERE  `site_id` = $site_id and (date(created_time) < '$today' or date(created_time) > '$today') ");
    //echo $CI->db->last_query();exit;

}*/

/*function delete_cart()
{
    $CI = &get_instance();
    $site_id = currentuserinfo()->site_id;
    $added_by = currentuserinfo()->id;
    $CI->db->where('added_by', $added_by);
    $CI->db->where('site_id', $site_id);
    $CI->db->update('cart_email_to_send', array('recievers_id' => ''));
}*/

function fckEditor($name = "message", $value = '', $width = '100%', $height = '300')
{
    $CI = &get_instance();
    $CI->load->view('fck_editor');

    $oFCKeditor = new FCKeditor("$name");

    $oFCKeditor->Width = "$width";
    $oFCKeditor->Height = "$height";
    $oFCKeditor->Value = "$value";

    $oFCKeditor->Create();
}

/**
 * @function name get_candidate()
 * purpose to get candidate dashboard report
 * @created date  14  NOV  2013
 * @created by    kumar gaurav
 */

/*function get_candidate($type = null, $type1 = null, $type2 = null, $user_list = null, $userId = null)
{
    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);

    $CI->db->where('date(created_time) <=', $type1);

    if ($type2 != null) {
        $CI->db->where('date(created_time) >=', $type2);
    }
    if ($type == 'refine') {
        $CI->db->where("is_refine", "0");
    } else
    if ($type == 'unrefine') {
        $CI->db->where("is_refine", "1");
    }

    if ($userId != null) {
        $CI->db->where_in("added_by", $userId, false);
    } else
    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }

    $query = $CI->db->get("candidate");
    //echo $CI->db->last_query();
    //echo '<br/>';
    if ($query->num_rows() > 0) {
        return $query->num_rows;
    } else {
        return 0;
    }

}*/

/**
 * @function name get_inactive__candidate()
 * purpose to get candidate dashboard report
 * @created date  14  NOV  2013
 * @created by    kumar gaurav
 */

/*function get_inactive__candidate($type1 = null, $type2 = null)
{
    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);

    if ($type1 != null) {
        $CI->db->where('date(created_time) <=', $type1);
    }

    if ($type2 != null) {
        $CI->db->where('date(created_time) >=', $type2);
    }

    $query = $CI->db->get("inactive_email");
    //echo $CI->db->last_query();
    //echo '<br/>';
    if ($query->num_rows() > 0) {
        return $query->num_rows;
    } else {
        return 0;
    }

}*/

/**
 * @function name job_order_data
 * purpose to total job record on job_order report
 * @created date  28 OCT 2014
 * @created * by    Nitish Janterparia */
function job_order_data($type1 = null, $type2 = null, $user_list = null, $user_id = null, $report_type = null)
{
    //pr($user_list);
    $CI = &get_instance();

    $site_id = currentuserinfo()->site_id;
    $whr = null;
    $elsewhr = null;
    $list = null;
    if (($report_type == 1) && ($user_id != null)) {

        $list = "job_order.added_by IN ($user_id) AND ";
        $elselist = "job_order_assign_list.assign_user_id IN ($user_id)  ";

    } else {
        if ($user_list != null) {
            if (is_array($user_list)) {
                $user_list = implode(',', $user_list);
            }
            $list = "job_order.added_by IN ($user_list) AND ";
            $elselist = "job_order_assign_list.assign_user_id IN ($user_list)  ";
        }
    }

    if ($type1 != null) {
        $from = date('Y-m-d', strtotime($type1));
        $whr .= "AND date(job_order_history.created_time) <= '$from'";
        $elsewhr .= " AND date(modified_time) <= '$from'";
    }
    if ($type2 != null) {
        $to = date('Y-m-d', strtotime($type2));
        $whr .= "AND date(job_order_history.created_time) >= '$to'";
        $elsewhr .= "AND date(modified_time) >= '$to'";
    }
    ///////////////////this mysql query used to fetch result for sales department //////////////////////////////
    $sql = "select job_order_id from (select k.* from (SELECT job_order_id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $list   job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k. job_order_id,k.date_field) as p where p.status!='3' ";

    $query = $CI->db->query($sql);

    $arr = array();

    if ($query->num_rows() > 0) {

        $result = $query->num_rows();
    } else {
        if (!empty($user_list)) {

            ////////////this mysql query fethted the result for recruitment department////////////////////////
            $join = "select p.job_order_id from (select k.* from (SELECT job_order_id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k. job_order_id,k.date_field) as p where p.status!='3'";
            $sql = "SELECT job_order_assign_list.job_order_id FROM (`job_order_assign_list`) join

            ($join) lj on lj.job_order_id=job_order_assign_list.job_order_id

            WHERE $elselist $elsewhr AND `site_id` = '$site_id' group by job_order_assign_list.job_order_id

            ";
            $query = $CI->db->query($sql);
            $result = $query->num_rows();

        }
    }
    // echo $CI->db->last_query();exit;
    //pr($result);exit;

    return $result;
}

/**
 * @function name get_job_order_value()
 * purpose to get values of status of joborder report
 * @created date  14 NOV 2013
 * @created by    Kumar Gaurav
 */
function get_job_order_value($status_id = null, $type1 = null, $type2 = null, $user_list = null, $userId = null)
{
    $CI = &get_instance();
    $CI->db->where("job_order.site_id", currentuserinfo()->site_id);

    $CI->db->where("is_added", "0");
    if ($type1 != null) {
        $CI->db->where('date(job_order_activity.modified_time) <=', $type1);
    }
    if ($type2 != null) {
        $CI->db->where('date(job_order_activity.modified_time) >=', $type2);
    }
    $CI->db->join("job_order", "job_order.id = job_order_activity.job_order_id", "LEFT");

    $CI->db->where("status_id", $status_id);

    if ($user_list != null) {
        $user_list = implode(',', $user_list);
        $whr = "( job_order.added_by IN($user_list) OR job_order_activity.added_by IN($user_list) ) ";
    }

    $query = $CI->db->get_where("job_order_activity", $whr);
    //echo 'okk '.$CI->db->last_query();exit;
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

/**
 * @function name get_total_job_order_value
 * purpose to get result for pipeline,salesreject,interview,offered,interview reject, etc for job_order report...
 * @created date  28 OCT 2014
 * @created * by    Nitish Janterparia */

function get_total_job_order_value($status_id = null, $type1 = null, $type2 = null, $user_list = null,
    $user_id = null, $report_type = null, $company = null, $contact = null) {
    $CI = &get_instance();

    $site_id = currentuserinfo()->site_id;

    $whr = null;
    $elsewhr = null;
    $userList = null;
    $elselist = null;
    if (($report_type == 1) && ($user_id != null)) {

        $userList = "AND job_order.added_by IN ($user_id)  ";
        $elselist = "AND job_order_activity.added_by IN ($user_id)  ";

    } else {
        if ($user_list != null) {
            $userList = "AND job_order.added_by IN ($user_list)  ";
            $elselist = " AND job_order_activity.added_by IN ($user_list) ";
        }
    }

    if ($type1 != null) {
        $from = date('Y-m-d', strtotime($type1));
        $whr .= "AND date(job_order_history.created_time) >= '$from'";
        $elsewhr .= "AND date(modified_time) >= '$from'";
    }
    if ($type2 != null) {
        $to = date('Y-m-d', strtotime($type2));
        $whr .= "AND date(job_order_history.created_time) <= '$to'";
        $elsewhr .= "AND date(modified_time) <= '$to'";
    }

    if ($company != null) {
        $whr .= "AND job_order.company_id='$company' ";
    }
    if ($contact != null) {
        $whr .= "AND job_order.contact_id='$contact'";
    }
    if ($status_id == 0) {
        $elsewhr .= "AND job_order_activity.is_submitted!='1' AND job_order_activity.status_id='$status_id'";
    } elseif ($status_id == 5) {
        $elsewhr .= "AND job_order_activity.is_submitted='1'";
    } else {
        $elsewhr .= "AND job_order_activity.status_id='$status_id'";
    }
    //====Added By sumit On 27 may 2016======//
    if ($user_list != null) {
        $elsewhr .= "AND job_order_activity.added_by IN ($user_list)  ";
    }
    //====Added By sumit On 27 may 2016======//
    $join = "select p.job_order_id from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE  job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
    $sql = " SELECT job_order_activity.id FROM (`job_order_activity`) join

            ($join) lj on lj.job_order_id=job_order_activity.job_order_id

            WHERE job_order_activity.`is_added` = '0'   $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id'

            ";
    $query = $CI->db->query($sql);
    // pr($query->result());exit;
    //echo $CI->db->last_query(); die;
    $list = array();
    if ($query->num_rows() > 0) {

        $result = $query->num_rows();
    } else {

        $join = "select p.job_order_id from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE job_order_history.`site_id` = '$site_id'   $whr  $userList   order by job_order_history.id desc ) as k group by k.job_order_id) as p where p.status!='3'";
        $sql = " SELECT  job_order_activity.id FROM (`job_order_activity`) join

            ($join) lj on lj.job_order_id=job_order_activity.job_order_id

            WHERE  job_order_activity.`is_added` = '0'  $elsewhr  AND job_order_activity.`site_id` = '$site_id'

            ";
        $query = $CI->db->query($sql);
        //echo $CI->db->last_query(); die;
        $result = $query->num_rows();
    }

    return $result;
}

function get_signature()
{
    $CI = &get_instance();
    $id = currentuserinfo()->id;
    $query = $CI->db->select("*");
    $query = $CI->db->get_where("users", array('id' => $id));
    $data = $query->row();

    $message = "";
    $message .= '<div><img src="https://www.e-rookie.com/assets/images/sign.png" width="100" height="50"></div>';

    $sign_result = $CI->db->get("user_sign")->row();
    $message .= "<b>" . $data->first_name . " " . $data->last_name . "</b><br/>";
    $message .= $data->designation . "<br/>";
    if ($data->phone_number != null) {
        $message .= "<b>Ph:</b> " . $data->phone_number . "<br/>";
    }
    if ($data->cell_number != null) {
        $message .= "<b>Cell:</b> " . $data->cell_number . "<br/>";
    }
    if ($data->fax_number != null) {
        $message .= "<b>Fax:</b> " . $data->fax_number . "<br/>";
    }

    $message .= "<b>Email:</b> " . $data->email . "<br/>";
    $message .= $data->company_name . "<br/>";
    $message .= $data->certification . "<br/>";
    $message .= $data->company_url;
    $message .= $sign_result->sign_field;
    return $message;

}
//----------------------------------------------------------------------------------
/**
 * Get job order Status
 *
 * This function Gets data from  job Status table
 *
 * @access    public
 * @return    object
 */

function job_order_status()
{
    $CI = &get_instance();
    $query = $CI->db->get("job_status");

    return $query->result();
}

//----------------------------------------------------------------------------------
/**
 * Get job job status view
 *
 * This function Gets data from  job status view table
 *
 * @access    public
 * @return    object
 */

function job_status_view()
{
    $CI = &get_instance();
    $query = $CI->db->get("job_status_view");

    return $query->result();
}

//----------------------------------------------------------------------------------
/**
 * Get week for dashboard
 *
 * This function Gets week list
 *
 * @access    public
 * @return    object
 */

function list_week()
{
    $notice_period = array(
        '1' => '1 Week',
        '2' => '2 Week',
        '3' => '3 Week',
        '4' => '4 Week',
        '5' => '5 Week');
    return $notice_period;
}

//----------------------------------------------------------------------------------
/**
 * Get months for dashboard
 *
 * This function Gets week list
 *
 * @access    public
 * @return    object
 */

function list_month()
{
    $notice_period = array(
        '01' => 'JAN',
        '02' => 'FEB',
        '03' => 'MAR',
        '04' => 'APR',
        '05' => 'MAY',
        '06' => 'JUN',
        '07' => 'JUL',
        '08' => 'AUG',
        '09' => 'SEP',
        '10' => 'OCT',
        '11' => 'NOV',
        '12' => 'DEC');
    return $notice_period;
}

//----------------------------------------------------------------------------------
/**
 * Get top dashboard select day
 *
 * This function Gets list of days used to  search
 *
 * @access    public
 * @return    object
 */

function top_dash_date()
{
    $notice_period = array(
        '0' => 'today',
        '1' => 'current -1 day',
        '2' => 'current -2 day',
        '3' => 'current -3 day',
        '5' => 'current -5 day');
    return $notice_period;
}

//----------------------------------------------------------------------------------
/**
 * Get user report data
 *
 * This function Gets data from user_report_type table
 *
 * @access    public
 * @return    object
 */

function user_report_type_data($data = null)
{
	/*if(!empty(cache_opration('get','user_report_type_data_'.currentuserinfo()->id)))
	{
		$result= cache_opration('get','user_report_type_data_'.currentuserinfo()->id);
		return $result;
	}*/
	/*else
	{
		$CI = &get_instance();
		pr($data);die;
		foreach ($data as $key => $value) {
			$CI->db->select($value);
		}
		$user_id = currentuserinfo()->id;
		//$site_id = currentuserinfo()->site_id;
		$whr = array(
			//'site_id' => $site_id,
			'user_id' => $user_id,
		);
		$query = $CI->db->get_where('user_report_type', $whr);
		//echo $CI->db->last_query();exit;
		//cache_opration('set','user_report_type_data_'.currentuserinfo()->id,$query->row());
		return $query->row();
	}*/
	
	$CI = &get_instance();
		//pr($data);die;
		foreach ($data as $key => $value) {
			$CI->db->select($value);
		}
		$user_id = currentuserinfo()->id;
		//$site_id = currentuserinfo()->site_id;
		$whr = array(
			//'site_id' => $site_id,
			'user_id' => $user_id,
		);
		$query = $CI->db->get_where('user_report_type', $whr);
		//echo $CI->db->last_query();exit;
		//cache_opration('set','user_report_type_data_'.currentuserinfo()->id,$query->row());
		return $query->row();
}
function user_report_type_data_ymd($data = null)
{
	/*if(!empty(cache_opration('get','user_report_type_data_ymd'.currentuserinfo()->id)))
	{
		$result= cache_opration('get','user_report_type_data_ymd'.currentuserinfo()->id);
		return $result;
	}
	else
	{
		$CI = &get_instance();

		foreach ($data as $key => $value) {
			$CI->db->select($value);
		}
		$user_id = currentuserinfo()->id;
		$site_id = currentuserinfo()->site_id;
		$whr = array(
			'site_id' => $site_id,
			'user_id' => $user_id,
		);
		$query = $CI->db->get_where('user_report_type', $whr);
		//echo $CI->db->last_query();exit;
		cache_opration('set','user_report_type_data_ymd'.currentuserinfo()->id,$query->row());
		return $query->row();
	}*/
	
	$CI = &get_instance();

		foreach ($data as $key => $value) {
			$CI->db->select($value);
		}
		$user_id = currentuserinfo()->id;
		$site_id = currentuserinfo()->site_id;
		$whr = array(
			'site_id' => $site_id,
			'user_id' => $user_id,
		);
		$query = $CI->db->get_where('user_report_type', $whr);
		//echo $CI->db->last_query();exit;
		//cache_opration('set','user_report_type_data_ymd'.currentuserinfo()->id,$query->row());
		return $query->row();
}

function pending_job_activity($type1 = null, $type2 = null, $user_list = null, $status_id = 1)
{
    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);

    $CI->db->where("is_added", "0");

    if ($type1 != null) {
        $CI->db->where('date(modified_time) <=', $type1);
    }
    if ($type2 != null) {
        $CI->db->where('date(modified_time) >=', $type2);
    }
    if ($status_id != null) {
        $CI->db->where("is_submitted", 1);
        $arr = array(
            1,
            2,
            5,
            6);
        $CI->db->where_in("status_id", $arr);

    }

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }

    $query = $CI->db->get("job_order_activity");

    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

/*function notifications($s_date = null, $e_date = null, $user_list = array(), $status_id = "0", $limit = null)
{

    $job_activity_tbl = "";
    $candidate_tbl = "";
    $comp_contact_tbl = "companies_contact";
    $comp_tbl = "companies";

    $CI = &get_instance();
    $CI->db->select(" SQL_CALC_FOUND_ROWS users.first_name as user_fname,users.last_name as user_lname,$comp_tbl.name as company_name,", false);
    //$CI->db->where("$job_activity_tbl.site_id", currentuserinfo()->site_id);
    //$CI->db->where("$job_activity_tbl.is_added", "0");
    //$CI->db->where("date($job_activity_tbl.interview_Date) <=", $s_date);
   // $CI->db->join("$candidate_tbl", "$candidate_tbl.id = job_order_activity.candidate_id");
    $CI->db->join("users", "users.id = job_order_activity.added_by");
    //$CI->db->join("job_order", "job_order.id = job_order_activity.job_order_id");
    $CI->db->join($comp_tbl, "$comp_tbl.id = job_order.company_id");

    if ($e_date != null) {
        //$CI->db->where("date($job_activity_tbl.interview_Date) >=", $e_date);
    }
    //$CI->db->where("$job_activity_tbl.status_id", $status_id);

    if ($limit != null) {
        $CI->db->limit($limit);
    }

    if (count($user_list) > 0) {
        $list = "";
        foreach ($user_list as $k => $v) {
            $list .= "'" . $v . "',";
        }
        $list = substr($list, 0, -1);
        $whr = "($job_activity_tbl.added_by IN($list) OR job_order.added_by IN ($list))";
        $query = $CI->db->get_where($job_activity_tbl, $whr);
    } else {
        $query = $CI->db->get($job_activity_tbl);
    }

    $data["result"] = array();
    //echo $CI->db->last_query();exit;

    $row_query = $CI->db->query('SELECT FOUND_ROWS() AS `count`');
    $data["total"] = $row_query->row()->count;

    if ($query->num_rows() > 0) {
        $data["result"] = $query->result();
    }
    return $data;

}*/

function interviewDetail($activity_id = null)
{
    $job_activity_tbl = "job_order_activity";
    $candidate_tbl = "candidate";
    $job_order_tbl = "job_order";
    $comp_contact_tbl = "companies_contact";
    $comp_tbl = "companies";

    $CI = &get_instance();
    $CI->db->select(" SQL_CALC_FOUND_ROWS users.first_name as user_fname,users.last_name as user_lname,$comp_tbl.name as company_name,$comp_contact_tbl.name as contact_name,$candidate_tbl.first_name,$candidate_tbl.last_name,$job_order_tbl.title,$job_order_tbl.id as job_order_id,$job_activity_tbl.id,$job_activity_tbl.added_by,$job_activity_tbl.Hours,$job_activity_tbl.Mint,$job_activity_tbl.interview_comment,$job_activity_tbl.interview_type,$job_activity_tbl.time_zone,$job_activity_tbl.interview_Date", false);
    $CI->db->where("$job_activity_tbl.site_id", currentuserinfo()->site_id);
    $CI->db->where("$job_activity_tbl.is_added", "0");
    $CI->db->where("$job_activity_tbl.id", $activity_id);

    $CI->db->join("$candidate_tbl", "$candidate_tbl.id = job_order_activity.candidate_id");
    $CI->db->join("users", "users.id = job_order_activity.added_by");
    $CI->db->join($job_order_tbl, "$job_order_tbl.id = job_order_activity.job_order_id");
    $CI->db->join($comp_contact_tbl, "$comp_contact_tbl.id = $job_order_tbl.contact_id");
    $CI->db->join($comp_tbl, "$comp_tbl.id = $comp_contact_tbl.company_id");

    $result = $CI->db->get($job_activity_tbl);
    //echo $CI->db->last_query();exit;

    if ($result->num_rows > 0) {
        return $result->row();
    }
    return false;
}

//----------------------------------------------------------------------------------
/**
 * check already candidate in pipline
 *
 * This function Gets data from job_order table
 *
 * @access    public
 * @return    object
 */

function candidate_pipeline($job_order_id = null, $candidate_id = null)
{
    $CI = &get_instance();
    $data = array('job_order_id' => $job_order_id);
    if ($candidate_id) {
        $data['candidate_id'] = $candidate_id;
    }

    $query = $CI->db->get_where("job_order_activity", $data);
    //echo $CI->db->last_query();exit;
    $result = $query->result();

    if ($query->num_rows()) {
        return $result;
    } else {
        return false;
    }
}

function getAllpermission($controller = null)
{
    $CI = &get_instance();
    $CI->db->where("controller", $controller);
    $CI->db->order_by("controller", "asc");
    $CI->db->where('is_super', 0);
    $query = $CI->db->get("controllers_info");
    return $query->result();

}

function getOtherPermission($title = '')
{
    $title = strtolower($title);
    $arr = array();
    if ($title == 'candidate') {
        $arr = array("view_resume" => "View Resume", "download_resume" => "Download");
    } else
    if ($title == 'user') {
        $arr = array("permission" => "Permission", "status" => "Status");
    } else
    if ($title == 'group') {
        $arr = array("permission" => "Permission");
    }
    return $arr;
}

function static_flash($response = 'success', $message = '')
{
    echo '<div class="row-fluid"><div class="span12"><div class="alert alert-' . $response . '">
			  <strong>' . ucfirst($response) . ': </strong> ' . $message . '</div></div></div>';
}

///////////////////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/**
 * @function name dashboard_total_jobs
 * purpose to to get list of dashboard total jobs
 * @created date  28 OCT 2014
 * @created by    Nitish Janterparia
 */

function dashboard_total_jobs($type = 'yearly', $user_list = null, $year = null, $month = null, $day = null,
    $date = array()) {
	if(!empty(cache_opration('get','dashboard_total_jobs_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_jobs_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{
		//pr($date);exit;
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}
		//echo $start_date;
		//   echo $end_date;exit;
		$site_id = currentuserinfo()->site_id;
		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$else_date_join = null;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$list = "job_order.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_assign_list.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_assign_list.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_assign_list.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_assign_list.`modified_time`)";
		}

		/////////////////this mysql query will find the result for sales department//////////////////////
		$sql = "select count(job_order_id) as total,p.date_fields as date_field from (select k.* from (SELECT job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $list $whr AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id,k.date_fields) as p where p.status!='3' group by date_field";

		$query = $CI->db->query($sql);
		//pr($query->result_array());exit;
		//echo $CI->db->last_query();exit;

		$list = array();
		$arr = array();

		if ($query->num_rows() > 0) {

			$result = $query->result_array();
		} else {
			if (!empty($user_list)) {
				/////////////////this mysql query will find the result for recruitment department//////////////////////
				$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
				$sql = " SELECT count(distinct job_order_assign_list.job_order_id) as total,$elsemonth  FROM (`job_order_assign_list`) join

				($join) lj on (lj.job_order_id=job_order_assign_list.job_order_id AND lj.date_fields=$else_date_join)

				WHERE `assign_user_id` IN ($user_list) AND $elsewhr AND `site_id` = '$site_id' GROUP BY `date_field`

				";
				$query = $CI->db->query($sql);
				$result = $query->result_array();

			}
		}
		// echo $CI->db->last_query();
		if (!empty($result)) {
			// pr($result);exit;
			foreach ($result as $k => $v) {
				$d = $v['date_field'];
				$t = $v['total'];
				$arr[$d] = $t;

			}
			$list['total'] = $arr;
			//pr($list);exit;
			cache_opration('set','dashboard_total_jobs_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		} else {
			$list['total'] = null;
			cache_opration('set','dashboard_total_jobs_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
	}

}

/**
 * @function name dashboard_joborder
 * purpose to get result for pipeline,salesreject,interview,offered,interview reject, etc...
 * @created date  28 OCT 2014
 * @created by    Nitish Janterparia
 */
function dashboard_joborder($type = 'yearly', $user_list = null, $year = null, $month = null, $day = null,
    $date = array()) {
    //pr($user_list);exit;

    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $whr = null;
    $elsewhr = null;
    $list = null;
    $elselist = null;
    $userList = null;
    $else_date_join = null;
    $site_id = currentuserinfo()->site_id;
    if ($user_list != null) {
        $user_list = implode(",", $user_list);
        $userList = "job_order.added_by IN ($user_list) AND ";
        $elselist = "job_order_activity.added_by IN ($user_list) AND ";
    }

    if ($type == 'yearly') {
        $date_field = "month(job_order_history.`created_time`) as date_fields";
        $whr .= "year(job_order_history.`created_time`) = '$year'";
        $elsemonth = "month(`modified_time`) as date_field";
        $elsewhr .= "year(`modified_time`) = '$year'";
        $else_date_join = "month(job_order_activity.`modified_time`)";
    } elseif ($type == 'monthly') {
        $date_field = "day(job_order_history.`created_time`) as date_fields";
        $whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
        $elsemonth = "day(`modified_time`) as date_field";
        $elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
        $else_date_join = "day(job_order_activity.`modified_time`)";
    } elseif ($type == 'weekly') {
        $date_field = "day(job_order_history.`created_time`) as date_fields";
        $whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
        $elsemonth = "day(`modified_time`) as date_field";
        $elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
        $else_date_join = "day(job_order_activity.`modified_time`)";
    } elseif ($type == 'daily') {
        $date_field = "day(job_order_history.`created_time`) as date_fields";
        $whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
        $elsemonth = "day(`modified_time`) as date_field";
        $elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
        $else_date_join = "day(job_order_activity.`modified_time`)";
    }

    ///////////this mysql query find the result for sales department//////////////
    $join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
    $sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.id) as total,$elsemonth  FROM (`job_order_activity`) join

            ($join) lj on (lj.job_order_id=job_order_activity.job_order_id)

            WHERE job_order_activity.`is_added` = '0'  AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY `status_id`, date_field ORDER BY `status_id`

            ";
    $query = $CI->db->query($sql);
    // pr($query->result());exit;

    $list = array();
    if ($query->num_rows() > 0) {

        $result = $query->result();
    } else {
        ///////////this mysql query find the result for recruitment department//////////////
        $join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
        $sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.id) as total,$elsemonth  FROM (`job_order_activity`) join

            ($join) lj on (lj.job_order_id=job_order_activity.job_order_id)

            WHERE  job_order_activity.`is_added` = '0' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY `status_id`, date_field ORDER BY `status_id`

            ";
        $query = $CI->db->query($sql);
        //echo $CI->db->last_query();
        $result = $query->result();
    }

    // echo $CI->db->last_query();
    if (!empty($result)) {
        foreach ($result as $key => $value) {
            if (!array_key_exists($value->status_id, $list)) {
                $list[$value->status_id][$value->date_field] = $value->total;

            } else {
                $list[$value->status_id][$value->date_field] = $value->total;
            }
        }
        return $list;
    }
    return $list;
}






/**
 * @function name dashboard_submittal
 * purpose to to get list of  total submittals on particular  job
 * @created date  28 OCT 2014
 * @created by    Nitish Janterparia
 */
function dashboard_submittal($type = 'yearly', $user_list = null, $year = null, $month = null, $day = null,
    $date = array()) {
	if(!empty(cache_opration('get','dashboard_submittal_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_submittal_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		/////////////////this mysql query used to find the result for sales department////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
		$query = $CI->db->query($sql);
		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			/////////////////this mysql query used to find the result for recruitment department////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
			$query = $CI->db->query($sql);
			//echo $CI->db->last_query();
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			return $list;
		}
		return $list;
	}

}

function dashboard_vendor($type = 'yearly', $user_list = null, $year = null, $month = null, $day = null,
    $date = array()) {

    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    if ($type == 'yearly') {
        $CI->db->select('status,count(id) as total, month(created_time) as date_fields');
        $CI->db->where("year(created_time) = '$year'");
        $CI->db->group_by('month(created_time)');
    } elseif ($type == 'monthly') {
        $CI->db->select('status,count(id) as total, day(created_time) as date_fields');
        $CI->db->where("year(created_time) = '$year' AND month(created_time) = '$month' ");
        $CI->db->group_by('day(created_time)');
    } elseif ($type == 'weekly') {
        $CI->db->select('status,count(id) as total, day(created_time) as date_fields');
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
        $CI->db->group_by('day(created_time)');
    } elseif ($type == 'daily') {
        $CI->db->select('status,count(id) as total, day(created_time) as date_fields');
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
        $CI->db->group_by('day(created_time)');
    }
    $CI->db->where("site_id", currentuserinfo()->site_id);

    $CI->db->group_by('status');

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
    $query = $CI->db->get("vendor");

    $list = array();
    if ($query->num_rows() > 0) {
        foreach ($query->result() as $key => $value) {
            if (!array_key_exists($value->status, $list)) {
                $list[$value->status][$value->date_fields] = $value->total;

            } else {
                $list[$value->status][$value->date_fields] = $value->total;
            }
        }
        return $list;
    }
    return $list;
}

function dashboard_company_contact($type = 'yearly', $user_list = null, $year = null, $month = null,
    $day = null, $date = array()) {

    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $CI->db->select('status,count(id) as total');
    if ($type == 'yearly') {
        $CI->db->where("year(created_time) = '$year'");
    } elseif ($type == 'monthly') {
        $CI->db->where("year(created_time) = '$year' AND month(created_time) = '$month' ");
    } elseif ($type == 'weekly') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    } elseif ($type == 'daily') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    }
    //$CI->db->where("site_id", '1');
    $CI->db->group_by('status');

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
	
    $query = $CI->db->get("companies_contact");
		//echo $CI->db->last_query();die;
    return $query->result();
}

function dashboard_client_list($type = 'yearly', $user_list = null, $year = null, $month = null,
    $day = null, $date = array()) {

    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $CI->db->select('status,count(id) as total');
    if ($type == 'yearly') {
        $CI->db->where("year(created_time) = '$year'");
    } elseif ($type == 'monthly') {
        $CI->db->where("year(created_time) = '$year' AND month(created_time) = '$month' ");
    } elseif ($type == 'weekly') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    } elseif ($type == 'daily') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    }
    //$CI->db->where("site_id", '1');
    $CI->db->group_by('status');

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
	
    $query = $CI->db->get("companies");
		//echo $CI->db->last_query();die;
    return $query->result();
}

function dashboard_supplier_india_list($type = 'yearly', $user_list = null, $year = null, $month = null,
    $day = null, $date = array()) {

    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $CI->db->select('count(id) as total');
    if ($type == 'yearly') {
        $CI->db->where("year(created_time) = '$year'");
    } elseif ($type == 'monthly') {
        $CI->db->where("year(created_time) = '$year' AND month(created_time) = '$month' ");
    } elseif ($type == 'weekly') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    } elseif ($type == 'daily') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    }
    //$CI->db->where("site_id", '1');
    //$CI->db->group_by('status');

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
	
    $query = $CI->db->get("supplier_ind");
		//echo $CI->db->last_query();die;
    return $query->result();
}

function dashboard_supplier_china_list($type = 'yearly', $user_list = null, $year = null, $month = null,
    $day = null, $date = array()) {

    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $CI->db->select('count(id) as total');
    if ($type == 'yearly') {
        $CI->db->where("year(created_time) = '$year'");
    } elseif ($type == 'monthly') {
        $CI->db->where("year(created_time) = '$year' AND month(created_time) = '$month' ");
    } elseif ($type == 'weekly') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    } elseif ($type == 'daily') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    }
    //$CI->db->where("site_id", '1');
    //$CI->db->group_by('status');

    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
	
    $query = $CI->db->get("supplier_china");
		//echo $CI->db->last_query();die;
    return $query->result();
}

function dashboard_candidate($type = 'yearly', $user_list = null, $year = null, $month = null, $day = null,
    $date = array()) {
    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $CI->db->where("site_id", currentuserinfo()->site_id);

    $CI->db->select('is_refine,count(id) as total');
    if ($type == 'yearly') {
        $CI->db->where("year(created_time) = '$year'");
    } elseif ($type == 'monthly') {
        $CI->db->where("year(created_time) = '$year' AND month(created_time) = '$month' ");
    } elseif ($type == 'weekly') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    } elseif ($type == 'daily') {
        $CI->db->where("(date(`created_time`)  BETWEEN '$start_date' AND '$end_date')");
    }
    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
    $CI->db->group_by('is_refine');
    $query = $CI->db->get("candidate");

    return $query->result();
}

function dashboard_pending_job_activity($type = 'yearly', $user_list = null, $year = null, $month = null,
    $day = null, $date = array()) {
    $start_date = date('Y-m-d', strtotime('-7 day'));
    $end_date = date('Y-m-d');
    if (is_null($year)) {
        $year = date('Y');
    }

    if (is_null($month)) {
        $month = date('m');
    }

    if (count($date) > 0) {
        $start_date = $date[0];
        $end_date = end($date);
    }

    $CI = &get_instance();
    $CI->db->select("count(id) as rows");
    if ($type == 'yearly') {
        $CI->db->where("year(modified_time) = '$year'");
    } elseif ($type == 'monthly') {
        $CI->db->where("year(modified_time) = '$year' AND month(modified_time) = '$month' ");
    } elseif ($type == 'weekly') {
        $CI->db->where("(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')");
    } elseif ($type == 'daily') {
        $CI->db->where("(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')");
    }
    if ($user_list != null) {
        $CI->db->where_in("added_by", $user_list, false);
    }
    $CI->db->where("site_id", currentuserinfo()->site_id);
    $CI->db->where("is_added", "0");
    $CI->db->where("is_submitted", 1);
    $CI->db->where_in("status_id", array(
        1,
        2,
        5,
        6));
    $query = $CI->db->get("job_order_activity");
    if ($query->num_rows() > 0) {
        return $query->row()->rows;
    }

    return 0;
}

/**
 * @function name get_final_joborder_serviced
 * purpose to check job serviced or not
 * @created date  8 SEP 2014
 * @created by    Nitish Janterparia
 */

function get_final_joborder_serviced($type1 = null, $type2 = null, $user_list = null, $user_id = null,
    $report_type = null, $company = null, $contact = null) {
    $CI = &get_instance();

    $site_id = currentuserinfo()->site_id;

    $whr = null;
    $elsewhr = null;
    $userList = null;
    $elselist = null;
    if (($report_type == 1) && ($user_id != null)) {

        $userList = "AND job_order.added_by IN ($user_id)  ";
        $elselist = "AND job_order_activity.added_by IN ($user_id)  ";

    } else {
        if ($user_list != null) {
            $userList = "AND job_order.added_by IN ($user_list)  ";
            $elselist = " AND job_order_activity.added_by IN ($user_list) ";
        }
    }

    if ($type1 != null) {
        $from = date('Y-m-d', strtotime($type1));
        $whr .= "AND date(job_order_history.created_time) >= '$from'";
        $elsewhr .= "AND date(modified_time) >= '$from'";
    }
    if ($type2 != null) {
        $to = date('Y-m-d', strtotime($type2));
        $whr .= "AND date(job_order_history.created_time) <= '$to'";
        $elsewhr .= "AND date(modified_time) <= '$to'";
    }

    if ($company != null) {
        $whr .= "AND job_order.company_id='$company' ";
    }
    if ($contact != null) {
        $whr .= "AND job_order.contact_id='$contact'";
    }

    ///////////this mysql query used to find the result for sales department//////////////////////
    $join = "select p.job_order_id from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE  job_order_history.`site_id` = '$site_id'  $whr  $userList order by job_order_history.id desc ) as k group by k. job_order_id,k.date_field) as p where p.status!='3'";
    $sql = " SELECT distinct job_order_activity.job_order_id FROM (`job_order_activity`) join

            ($join) lj on lj.job_order_id=job_order_activity.job_order_id

            WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1'  $elsewhr AND job_order_activity.`site_id` = '$site_id'

            ";
    $query = $CI->db->query($sql);

    if ($query->num_rows() > 0) {

        $result = $query->num_rows();
    } else {
        /////////////this mysql query used to find the result of recruitment department if 1st query returns null/////////
        $join = "select p.job_order_id from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k.job_order_id,k.date_field) as p where p.status!='3'";
        $sql = " SELECT distinct job_order_activity.job_order_id FROM (`job_order_activity`) join

            ($join) lj on lj.job_order_id=job_order_activity.job_order_id

            WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1'  $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id'

            ";
        $query = $CI->db->query($sql);
        $result = $query->num_rows();
    }

    return $result;
}

/***************get job order assign data***************************/
if (!function_exists('assign_job_data')) {
    function assign_job_data($id = null, $last_assigned_id = null)
    {
        $CI = &get_instance();
        $CI->db->select('id,created_time');

        if ($last_assigned_id) {
            $CI->db->where('id > ', $last_assigned_id);
        }
        $query = $CI->db->get_where('job_order_assign_list', array('job_order_id' => $id));
        if ($id == '14246' && $last_assigned_id) {
            //echo $CI->db->last_query();exit;
        }
        $arr = array();
        if ($query->num_rows() > 0) {
            $result = $query->result();
            if ($query->num_rows() > 1) {
                $arr['status'] = 'yes';
            } else {
                $arr['status'] = 'no';
            }
            $arr['created_time'] = $result[0]->created_time;
            return $arr;
        }
        return false;

    }
}

/***************get job order assign data***************************/
if (!function_exists('last_assign_id')) {
    function last_assign_id($id = null, $is_serviced = false)
    {
        $CI = &get_instance();
        $CI->db->select('id,created_time,job_order_id');
        $CI->db->order_by('id', 'desc');
        $CI->db->limit(1);
        if (!$is_serviced) {
            $CI->db->where('date(created_time) != ', date('Y-m-d'));
        }
        $query = $CI->db->get_where('job_order_assign_list', array('job_order_id' => $id));

        // echo $CI->db->last_query();exit;

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;

    }
}

/***************get job order assign data***************************/
if (!function_exists('is_serviced_job')) {
    function is_serviced_job($id = null, $active_date = null)
    {
        $CI = &get_instance();
        $CI->db->select('created_time,status_id');
        $CI->db->where("(status_id='0' OR status_id='5')");
        $CI->db->where('job_order_id', $id);
        $CI->db->where('site_id', currentuserinfo()->site_id);
        $CI->db->where('date(created_time)', date("Y-m-d", strtotime($active_date)));
        $CI->db->group_by("job_order_id,status_id");
        $query = $CI->db->get("job_order_activity");
        return ($query->num_rows() > 0) ? $query->result() : '';
    }
}

/***************get job order assign data***************************/
if (!function_exists('last_service_id')) {
    function last_service_id($id = null)
    {
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->order_by('id', 'desc');
        $CI->db->limit(1);
        //$query = $CI->db->get_where('job_order_assign_list', array('job_order_id' => $id,'date(created_time) != ' => date('Y-m-d')));
        $query = $CI->db->get_where('job_order_activity', array('job_order_id' => $id,
            'date(created_time) != ' => date('Y-m-d')));
        //echo $CI->db->last_query();exit;

        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;

    }
}
/***************get job order Reactive state***************************/
if (!function_exists('is_reactive')) {
    function is_reactive($id = null)
    {
        $CI = &get_instance();
        $CI->db->select('id');
        $query = $CI->db->get_where('job_order', array('id' => $id, 'reactive >' => '0'));
        ///echo $CI->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return true;
        }
        return false;

    }
}

/**
 * @function name dashboard_total_serviced
 * purpose to check job serviced or not
 * @created date  28 OCT 2014
 * @created by    Nitish Janterparia
 */

function dashboard_total_sales_spares($type = 'yearly', $user_list = null, $year = null, $month = null,
    $date = array()) {
	/*if(!empty(cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{	
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
		$query = $CI->db->query($sql);

		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			///////////////this query to get result for recruitment deparmtent/////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
			$query = $CI->db->query($sql);
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	}*/
	
	$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = '1';
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			//pr($user_list);die;
			$userList = "added_by IN ($user_list) AND ";
			//$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(leads_sales_spares.`created_time`) as date_fields";
			$whr .= "year(leads_sales_spares.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(leads_sales_spares.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(leads_sales_spares.`created_time`) as date_fields";
			//pr($date_field);die;
			$whr .= "year(leads_sales_spares.`created_time`) = '$year' AND month(leads_sales_spares.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(leads_sales_spares.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(leads_sales_spares.`created_time`) as date_fields";
			$whr .= "(date(leads_sales_spares.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_sales_spares.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(leads_sales_spares.`created_time`) as date_fields";
			$whr .= "(date(leads_sales_spares.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_sales_spares.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
	
		$sql = " SELECT  leads_sales_spares.`lead_status`, count(leads_sales_spares.id) as total,$elsemonth  FROM (`leads_sales_spares`)WHERE  leads_sales_spares.`added_by` IN ('$user_list' ) GROUP BY date_field";
		//echo $sql;die;
		$query = $CI->db->query($sql);

		 //pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} 

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	
	
	

}

function dashboard_total_sales_governing($type = 'yearly', $user_list = null, $year = null, $month = null,
    $date = array()) {
	/*if(!empty(cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{	
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
		$query = $CI->db->query($sql);

		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			///////////////this query to get result for recruitment deparmtent/////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
			$query = $CI->db->query($sql);
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	}*/
	
	$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = '1';
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			//pr($user_list);die;
			$userList = "added_by IN ($user_list) AND ";
			//$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(leads_sales_governing.`created_time`) as date_fields";
			$whr .= "year(leads_sales_governing.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(leads_sales_governing.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(leads_sales_governing.`created_time`) as date_fields";
			//pr($date_field);die;
			$whr .= "year(leads_sales_governing.`created_time`) = '$year' AND month(leads_sales_governing.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(leads_sales_governing.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(leads_sales_governing.`created_time`) as date_fields";
			$whr .= "(date(leads_sales_governing.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_sales_governing.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(leads_sales_governing.`created_time`) as date_fields";
			$whr .= "(date(leads_sales_governing.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_sales_governing.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
	
		$sql = " SELECT  leads_sales_governing.`lead_status`, count(leads_sales_governing.id) as total,$elsemonth  FROM (`leads_sales_governing`)WHERE  leads_sales_governing.`added_by` IN ('$user_list' ) GROUP BY date_field";
		//echo $sql;die;
		$query = $CI->db->query($sql);

		 //pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} 

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	
	
	

}



function dashboard_total_sales_pcb($type = 'yearly', $user_list = null, $year = null, $month = null,
    $date = array()) {
	/*if(!empty(cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{	
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
		$query = $CI->db->query($sql);

		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			///////////////this query to get result for recruitment deparmtent/////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
			$query = $CI->db->query($sql);
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	}*/
	
	$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = '1';
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			//pr($user_list);die;
			$userList = "added_by IN ($user_list) AND ";
			//$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(leads_sales_pcb.`created_time`) as date_fields";
			$whr .= "year(leads_sales_pcb.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(leads_sales_pcb.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(leads_sales_pcb.`created_time`) as date_fields";
			//pr($date_field);die;
			$whr .= "year(leads_sales_pcb.`created_time`) = '$year' AND month(leads_sales_pcb.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(leads_sales_pcb.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(leads_sales_pcb.`created_time`) as date_fields";
			$whr .= "(date(leads_sales_pcb.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_sales_pcb.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(leads_sales_pcb.`created_time`) as date_fields";
			$whr .= "(date(leads_sales_pcb.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_sales_pcb.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
	
		$sql = " SELECT  leads_sales_pcb.`lead_status`, count(leads_sales_pcb.id) as total,$elsemonth  FROM (`leads_sales_pcb`)WHERE  leads_sales_pcb.`added_by` IN ('$user_list' ) GROUP BY date_field";
		//echo $sql;die;
		$query = $CI->db->query($sql);

		 //pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} 

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	
	
	

}

function dashboard_total_service_pcb($type = 'yearly', $user_list = null, $year = null, $month = null,
    $date = array()) {
	/*if(!empty(cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{	
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
		$query = $CI->db->query($sql);

		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			///////////////this query to get result for recruitment deparmtent/////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
			$query = $CI->db->query($sql);
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	}*/
	
	$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = '1';
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			//pr($user_list);die;
			$userList = "added_by IN ($user_list) AND ";
			//$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(leads_service_pcb.`created_time`) as date_fields";
			$whr .= "year(leads_service_pcb.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(leads_service_pcb.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(leads_service_pcb.`created_time`) as date_fields";
			//pr($date_field);die;
			$whr .= "year(leads_service_pcb.`created_time`) = '$year' AND month(leads_service_pcb.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(leads_service_pcb.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(leads_service_pcb.`created_time`) as date_fields";
			$whr .= "(date(leads_service_pcb.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_service_pcb.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(leads_service_pcb.`created_time`) as date_fields";
			$whr .= "(date(leads_service_pcb.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_service_pcb.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
	
		$sql = " SELECT  leads_service_pcb.`lead_status`, count(leads_service_pcb.id) as total,$elsemonth  FROM (`leads_service_pcb`)WHERE  leads_service_pcb.`added_by` IN ('$user_list' ) GROUP BY date_field";
		//echo $sql;die;
		$query = $CI->db->query($sql);

		 //pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} 

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	
	
	

}

function dashboard_total_service_automation($type = 'yearly', $user_list = null, $year = null, $month = null,
    $date = array()) {
	/*if(!empty(cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{	
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
		$query = $CI->db->query($sql);

		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			///////////////this query to get result for recruitment deparmtent/////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
			$query = $CI->db->query($sql);
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	}*/
	
	$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = '1';
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			//pr($user_list);die;
			$userList = "added_by IN ($user_list) AND ";
			//$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(leads_service_automation.`created_time`) as date_fields";
			$whr .= "year(leads_service_automation.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(leads_service_automation.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(leads_service_automation.`created_time`) as date_fields";
			//pr($date_field);die;
			$whr .= "year(leads_service_automation.`created_time`) = '$year' AND month(leads_service_automation.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(leads_service_automation.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(leads_service_automation.`created_time`) as date_fields";
			$whr .= "(date(leads_service_automation.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_service_automation.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(leads_service_automation.`created_time`) as date_fields";
			$whr .= "(date(leads_service_automation.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_service_automation.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
	
		$sql = " SELECT  leads_service_automation.`lead_status`, count(leads_service_automation.id) as total,$elsemonth  FROM (`leads_service_automation`)WHERE  leads_service_automation.`added_by` IN ('$user_list' ) GROUP BY date_field";
		//echo $sql;die;
		$query = $CI->db->query($sql);

		 //pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} 

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	
	
	

}

function dashboard_total_service_dcs($type = 'yearly', $user_list = null, $year = null, $month = null,
    $date = array()) {
	/*if(!empty(cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type)))
	{
		$result= cache_opration('get','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type);
		return $result;
	}
	else
	{	
		$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = currentuserinfo()->site_id;
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			$userList = "job_order.added_by IN ($user_list) AND ";
			$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(job_order_activity.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "year(job_order_history.`created_time`) = '$year' AND month(job_order_history.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(job_order_history.`created_time`) as date_fields";
			$whr .= "(date(job_order_history.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(job_order_activity.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
		$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr AND $userList  job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
		$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE  job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND  $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY date_field

				";
		$query = $CI->db->query($sql);

		// pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} else {
			///////////////this query to get result for recruitment deparmtent/////////////////
			$join = "select p.job_order_id,p.date_fields from (select k.* from (SELECT job_order_history.job_order_id,job_order_history.id,job_order_history.status,$date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $whr  AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id) as p where p.status!='3'";
			$sql = " SELECT job_order_activity.`status_id`, count(distinct job_order_activity.job_order_id) as total,$elsemonth  FROM (`job_order_activity`) join

				($join) lj on (lj.job_order_id=job_order_activity.job_order_id AND lj.date_fields=$else_date_join)

				WHERE job_order_activity.`is_added` = '0' AND job_order_activity.is_submitted='1' AND $elselist $elsewhr AND job_order_activity.`site_id` = '$site_id' GROUP BY  date_field

				";
			$query = $CI->db->query($sql);
			$result = $query->result();
		}

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	}*/
	
	$start_date = date('Y-m-d', strtotime('-7 day'));
		$end_date = date('Y-m-d');
		if (is_null($year)) {
			$year = date('Y');
		}

		if (is_null($month)) {
			$month = date('m');
		}

		if (count($date) > 0) {
			$start_date = $date[0];
			$end_date = end($date);
		}

		$CI = &get_instance();
		$whr = null;
		$elsewhr = null;
		$list = null;
		$elselist = null;
		$userList = null;
		$else_date_join = null;
		$site_id = '1';
		if ($user_list != null) {
			$user_list = implode(",", $user_list);
			//pr($user_list);die;
			$userList = "added_by IN ($user_list) AND ";
			//$elselist = "job_order_activity.added_by IN ($user_list) AND ";
		}

		if ($type == 'yearly') {
			$date_field = "month(leads_service_dcs.`created_time`) as date_fields";
			$whr .= "year(leads_service_dcs.`created_time`) = '$year'";
			$elsemonth = "month(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year'";
			$else_date_join = "month(leads_service_dcs.`modified_time`)";
		} elseif ($type == 'monthly') {
			$date_field = "day(leads_service_dcs.`created_time`) as date_fields";
			//pr($date_field);die;
			$whr .= "year(leads_service_dcs.`created_time`) = '$year' AND month(leads_service_dcs.`created_time`) = '$month' ";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "year(`modified_time`) = '$year' AND month(`modified_time`) = '$month' ";
			$else_date_join = "day(leads_service_dcs.`modified_time`)";
		} elseif ($type == 'weekly') {
			$date_field = "day(leads_service_dcs.`created_time`) as date_fields";
			$whr .= "(date(leads_service_dcs.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_service_dcs.`modified_time`)";
		} elseif ($type == 'daily') {
			$date_field = "day(leads_service_dcs.`created_time`) as date_fields";
			$whr .= "(date(leads_service_dcs.`created_time`)  BETWEEN '$start_date' AND '$end_date')";
			$elsemonth = "day(`modified_time`) as date_field";
			$elsewhr .= "(date(`modified_time`)  BETWEEN '$start_date' AND '$end_date')";
			$else_date_join = "day(leads_service_dcs.`modified_time`)";
		}

		///////////////this query to get result for sales deparmtent/////////////////
	
		$sql = " SELECT  leads_service_dcs.`lead_status`, count(leads_service_dcs.id) as total,$elsemonth  FROM (`leads_service_dcs`)WHERE  leads_service_dcs.`added_by` IN ('$user_list' ) GROUP BY date_field";
		//echo $sql;die;
		$query = $CI->db->query($sql);

		 //pr($query->result());exit;

		$list = array();
		if ($query->num_rows() > 0) {

			$result = $query->result();
		} 

		// echo $CI->db->last_query();exit;

		$list = array();
		if (!empty($result)) {
			foreach ($result as $key => $value) {
				$list[$value->date_field] = $value->total;
			}
			//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
			return $list;
		}
		//cache_opration('set','dashboard_total_serviced_'.currentuserinfo()->id.'_'.$type,$list);
		return $list;
	
	
	

}

/**
 * @function name get_final_joborder_seriviced_job
 * purpose to find the serviced job
 * @created date  28 OCT 2014
 * @created * by    Nitish Janterparia */
function get_final_joborder_seriviced_job($id = null, $sdate = null, $edate = null, $added_by = null, $report_type = 2)
{
    $CI = &get_instance();

    $CI->db->where("site_id", currentuserinfo()->site_id);
    if ($sdate != null) {
        $CI->db->where('date(modified_time) >=', $sdate);
    }

    if ($edate != null) {
        $CI->db->where('date(modified_time) <=', $edate);
    }
    //=================Added by Sumit on 27 may 2016===//
    if ($added_by != null && $report_type == 1) {
        $CI->db->where('added_by', $added_by);
    }
//=================Added by Sumit on 27 may 2016===//
    $CI->db->where("is_added", "0");
    $CI->db->where("job_order_id", $id);
    $CI->db->where("is_submitted", 1);
    $CI->db->group_by('job_order_id');
    $query = $CI->db->get("job_order_activity");
    //echo $CI->db->last_query();
    if ($query->num_rows() > 0) {
        return $query->num_rows();
    } else {
        return 0;
    }

}

function get_final_joborder_seriviced_job_new($id = null, $sdate = null, $edate = null, $user_list = null,
	$user_type = null, $report_type = null) {
	$CI = &get_instance();
	$user_list = explode(",", $user_list);

	$start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
	$end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
	$active_jobs = get_active_jobs($start_date, $end_date);
	$check = job_check();

	$CI->db->select('date(created_time) as date_field,job_order_id');
	$CI->db->where("site_id", currentuserinfo()->site_id);
	$CI->db->where('date(created_time) >=', $start_date);
	$CI->db->where('date(created_time) <=', $end_date);
	$CI->db->where("is_added", '0');
	$CI->db->where("job_order_id", $id);
	$CI->db->where("is_submitted", '1');
	(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) :
		'';
	$CI->db->group_by("job_order_id,date(created_time)");
	$query = $CI->db->get("job_order_activity");
	//  echo $CI->db->last_query();die;
	$result = $query->result();
	if (!empty($result)
		) {
			foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
				foreach ($active_jobs as $x => $y) {
					if ($x == $v->date_field) {
						$temp_arr = array();
						foreach ($y as $p => $q) {
							foreach ($q as $t) {
								$temp_arr[] = $t;
							}
						}
						if (!in_array($v->job_order_id, $temp_arr)
							) {
								unset($result[$k]);
							}
					}
				}
			}
		}
		unset($active_jobs);

	return count($result);
}

//=============get_final_joborder_seriviced_job_report==// 
	function get_final_joborder_seriviced_job_report($id = null, $sdate = null, $edate = null, $user_list = null,
		$user_type = null, $report_type = null) {
		$CI = &get_instance();
		$user_list = explode(",", $user_list);

		$start_date = $sdate != null ? date('Y-m-d', strtotime($sdate)) : date('Y-m-d');
		$end_date = $edate != null ? date('Y-m-d', strtotime($edate)) : date('Y-m-d');
		$active_jobs = get_active_jobs($start_date, $end_date);
		$check = job_check();

		$CI->db->select('date(created_time) as date_field,job_order_id');
		$CI->db->where("site_id", 2);
		$CI->db->where('date(created_time) >=', $start_date);
		$CI->db->where('date(created_time) <=', $end_date);
		$CI->db->where("is_added", '0');
		$CI->db->where("job_order_id", $id);
		$CI->db->where("is_submitted", '1');
		(!in_array($user_type, $check) || $report_type == '1') ? $CI->db->where_in("added_by", $user_list) :
			'';
		$CI->db->group_by("job_order_id,date(created_time)");
		$query = $CI->db->get("job_order_activity");
		//  echo $CI->db->last_query();die;
		$result = $query->result();
		if (!empty($result)
			) {
				foreach ($result as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
					foreach ($active_jobs as $x => $y) {
						if ($x == $v->date_field) {
							$temp_arr = array();
							foreach ($y as $p => $q) {
								foreach ($q as $t) {
									$temp_arr[] = $t;
								}
							}
							if (!in_array($v->job_order_id, $temp_arr)
								) {
									unset($result[$k]);
								}
						}
					}
				}
			}
			unset($active_jobs);

		return count($result);
	}

/**
 * Options for pagination limit
 * @access    public
 */

if (!function_exists('_recordSelect')) {
    function _recordSelect()
    {
        $data = array(
            '10' => 10,
            '25' => 25,
            '50' => 50,
            '100' => 100);
        return $data;
    }

}

/**
 * @function name get_job_modified_date
 * purpose to get modified date of any job
 * @created date  28 DEC 2014
 * @created * by    Nitish Janterparia */
function get_job_modified_date($id = null)
{
    $CI = &get_instance();

    $CI->db->select('modified_time');
    $CI->db->where("id", $id);
    $query = $CI->db->get("job_order");
    if ($query->num_rows() > 0) {
        return $query->row();
    }

}

function get_last_job_order_recruiter($id = null, $sdate = null, $edate = null)
{
    $CI = &get_instance();
    $CI->db->select("users.first_name,users.last_name");
    $CI->db->join('users', "users.id=job_order_assign_list.assign_user_id", 'left');
    $CI->db->where("job_order_assign_list.site_id", currentuserinfo()->site_id);
    if ($sdate != null) {
        $CI->db->where('date(job_order_assign_list.modified_time) >=', $sdate);
    }

    if ($edate != null) {
        $CI->db->where('date(job_order_assign_list.modified_time) <=', $edate);
    }

    $CI->db->where("job_order_assign_list.job_order_id", $id);
    $CI->db->limit("1");
    $CI->db->order_by('job_order_assign_list.id', 'desc');
    $query = $CI->db->get("job_order_assign_list");
    //echo '<br><br><br>';
    //echo $CI->db->last_query();exit;
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return 0;
    }

}

function getCandidateInfo($userId = null)
{
    $CI = &get_instance();
    $CI->db->select("candidate.*");
    $CI->db->where('site_id', currentuserinfo()->site_id);
    $CI->db->where('id', $userId);
    $query = $CI->db->get("candidate");
    if ($query->num_rows() > 0) {
        return $query->row();
    } else {
        return 0;
    }

}

function scr_payment_term($id = null)
{
    $term = array(
        "1" => "7 days",
        "2" => "15 days",
        "3" => "30 days",
        "4" => "45 days",
        "5" => "60 days",
        "6" => "75 days",
        "7" => "90 days");
    if (!empty($id)) {
        return $term[$id];
    } else {
        return $term;
    }

}

function scr_client_invoice($id = null)
{
    $term = array(
        "1" => "7 days",
        "2" => "15 days",
        "3" => "30 days",
        "4" => "45 days",
        "5" => "60 days",
        "6" => "90 days");
    if (!empty($id)) {
        return $term[$id];
    } else {
        return $term;
    }

}

/**
 *
 * function to fetch email id  from string
 * /
 * ***/
if (!function_exists('remove_email_address')) {
    function remove_email_address($string)
    {
        $re_string = array();

        foreach (preg_split('/\s/', strip_tags($string)) as $token) {
            $rplc_array = array(
                ',',
                '+',
                '-',
                ' ',
                '(',
                ')',
                '"',
                '{',
                '}',
                '[',
                ']',
                'mailto:',
                ':');

            $token = strtolower($token);
            $token = str_replace($rplc_array, ' ', $token);

            $tokens_arr = explode(" ", trim($token));
            $token = $tokens_arr[0];

            $email = trim(filter_var(filter_var($token, FILTER_SANITIZE_EMAIL), FILTER_VALIDATE_EMAIL));
            if ($email == false) {
                $re_string[] = $token;
            }
        }
        if (!empty($re_string)) {
            return implode($re_string, " ");
        } else {
            return '';
        }

    }
}

if (!function_exists('_sendEmail')) {
    function _sendEmail($email_data)
    {
        $CI = &get_instance();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = true;
        $CI->email->set_mailtype("html");
        $CI->email->initialize($config);
		pr($CI->email);die;
        if (!empty($email_data['sender_name'])) {
            $sender_name = $email_data['sender_name'];
        } else {
            $sender_name = "";
        }

        $CI->email->from($email_data['from'], ucwords($sender_name));
        $CI->email->to($email_data['to']);
        if (!empty($email_data['cc'])) {
            $CI->email->cc($email_data['cc']);
        }
        if (!empty($email_data['bcc'])) {
            $CI->email->bcc($email_data['bcc']);
        }
        if (!empty($email_data['file'])) {
            $CI->email->attach($email_data['file']);
        }
        $CI->email->subject(ucfirst($email_data['subject']));

        if (!empty($email_data['view'])) ////////////////////check if want to add view page///////
        {
            $data['result'] = $email_data['message'];
            $msg = $CI->load->view($email_data['view'], $data, true);
        } else {
            $msg = $email_data['message'];
        }

        $CI->email->message($msg);
        $CI->email->send();
    }

}

/**
 *
 * function to fetch email id  from string
 * /
 * ***/
if (!function_exists('custom_encryption')) {
    function custom_encryption($string, $key, $action)
    {
        if ($action == 'encrypt') {
            return base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $string, MCRYPT_MODE_CBC, md5(md5
                ($key))));
        } elseif ($action == 'decrypt') {
            return rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($string), MCRYPT_MODE_CBC,
                md5(md5($key))), "\0");
        }

    }
}

if (!function_exists('send_submission_mail')) {
    function send_submission_mail($from = null, $to = null, $name = null, $subject, $message, $file_path = null,
        $cc_mail = null) {

        $message = str_replace("</p>", "</p> \n", $message);

        $info = currentuserinfo();
        $from_name = $info->first_name . " " . $info->last_name . "(Tekshapers)";

        require APPPATH . "third_party/PHPMailer-master/class.phpmailer.php";

        $msg = $message;
        $mail = new PHPMailer();
        //$mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = currentuserinfo()->email;
        $mail->Password = currentuserinfo()->email_password;
        $mail->SMTPSecure = 'ssl';

        $mail->From = $from;

        if ($cc_mail != null) {
            $ccEmails = explode(",", $cc_mail);
            if (!in_array($info->email, $ccEmails)) {
                $ccEmails[] = $info->email;
            }
            foreach ($ccEmails as $k => $v) {
                $mail->addCC($v);
            }

        } else {
            $mail->addCC($info->email);
        }

        $mail->FromName = $from_name;
        $mail->AddAddress("$to");
        $mail->IsHTML(true);
        $mail->Subject = "$subject";
        $mail->Body = $msg;

        foreach ($file_path as $k => $v) {
            $mail->addAttachment($v);
        }
        $send = $mail->Send();
        if (!$send) {
            echo '<p style="color:green;font-size:18px;">Submission Mail not send</p>';
        }

    }
}

if (!function_exists('send_resumecart_mail')) {
    function send_resumecart_mail($from = null, $to = null, $name = null, $subject, $message, $email_pass, $file_path = null,
        $cc_mail = null) {

        $message = str_replace("</p>", "</p> \n", $message);

        $info = currentuserinfo();
        $from_name = $info->first_name . " " . $info->last_name . "(Tekshapers)";

        require APPPATH . "third_party/PHPMailer-master/class.phpmailer.php";

        $msg = $message;
        $mail = new PHPMailer();
        //$mail->CharSet = 'UTF-8';
        $mail->IsHTML(true);
        $mail->IsSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = "smtp.gmail.com";
        $mail->Port = 465;
        $mail->SMTPAuth = true;
        $mail->Username = $from;
        $mail->Password = $email_pass;
        $mail->SMTPSecure = 'ssl';

        $mail->From = $from;

        if ($cc_mail != null) {
            $ccEmails = explode(",", $cc_mail);
            if (!in_array($info->email, $ccEmails)) {
                $ccEmails[] = $info->email;
            }
            foreach ($ccEmails as $k => $v) {
                $mail->addCC($v);
            }

        } else {
            $mail->addCC($info->email);
        }

        $mail->FromName = $from_name;
        $mail->AddAddress("$to");
        $mail->IsHTML(true);
        $mail->Subject = "$subject";
        $mail->Body = $msg;

        foreach ($file_path as $k => $v) {
            $mail->addAttachment($v);
        }
        $send = $mail->Send();
        if (!$send) {
            return true;
        }

    }
}

    if (!function_exists('get_job_owner')) {
        function get_job_owner($job_order_id)
        {
            $CI = &get_instance();
            $CI->db->select("users.*");
            $CI->db->join("users", "users.id=job_order.added_by");
            $CI->db->where("job_order.id", $job_order_id);
            $query = $CI->db->get("job_order");
            return $query->row();
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Get No of Unread Comments Of JOB ORDER
     *
     *
     *
     * @access    public
     * @return    int
     */
    if (!function_exists('get_no_of_unread_comments')) {
        function get_no_of_unread_comments($job_order_id)
        {
            $CI = &get_instance();
            $id = currentuserinfo()->id;
            $site_id = currentuserinfo()->site_id;
            $CI->db->select("job_discussion.*");
            $CI->db->where("job_id", $job_order_id);
            $CI->db->where("(FIND_IN_SET('$id',seen_by) = 0 OR seen_by IS NULL)");
            $query = $CI->db->get("job_discussion");
            $result = $query->result();
            // echo $CI->db->last_query();die;
            //pr($result);die;
            return count($result);
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Get No of Unread Comments Of User Request for add-on. more mail,resume and users.
     *
     *
     *
     * @access    public
     * @return    int
     */
    if (!function_exists('get_no_of_unread_comments_for_addon_request')) {
        function get_no_of_unread_comments_for_addon_request($addon_request_id)
        {
            $CI = &get_instance();
            $id = currentuserinfo()->id;
            $CI->db->select("user_request_comment.*");
            $CI->db->where("request_id", $addon_request_id);
            $CI->db->where("(FIND_IN_SET('$id',seen_by) = 0 OR seen_by IS NULL)");
            $query = $CI->db->get("user_request_comment");
            $result = $query->result();
            // echo $CI->db->last_query();die;
            //pr($result);die;
            return count($result);
        }
    }
    if (!function_exists('get_request_states_dropdown')) {
        function get_request_states_dropdown($comment_id)
        {
            $status_list = array(
                'pending' => 'Pending',
                'open' => 'Open',
                'close' => 'Close');
            $table_user_request = 'master_request';
            $CI = &get_instance();
            $CI->db->select("status");
            $CI->db->where("id", $comment_id);
            $query = $CI->db->get($table_user_request);
            $current_status = $query->row()->status;
            if ($current_status != 'pending') {
                unset($status_list['pending']);
            }
            $attr = 'id="request_status"';
            return form_dropdown('request_status', $status_list, $current_status, $attr);
        }
    }


if (!function_exists('get_job_date')) {
    function get_job_date($id = null)
    {
        $CI = &get_instance();
        $CI->db->select('created_time');
        $CI->db->where('job_order_id', $id);
        $CI->db->group_by("date(created_time)");
        $CI->db->order_by('id', 'desc');
        $CI->db->limit(1);
        $query = $CI->db->get("job_order_history");
        return $query->row()->created_time;

    }
}

if (!function_exists('_get_all_rms_in_hierarchy')) {
    function _get_all_rms_in_hierarchy($comp_id = null, $user_id = null)
    {
        $data = $dept_name = $desg_name = array();
        $CI = &get_instance();
        //echo 'working';die;

        $qury = $CI->db->order_by('id', 'asc')->select('id, first_name as f_name, last_name as l_name, parent_user_id as reporting_manager_id,profile_image as profile_pic, group_id as dept_id, status')->
            get_where('users', array('site_id' => currentuserinfo()->site_id, 'status' => 'active'));

        if ($qury->num_rows()) {
            $dpQry = $CI->db->select('id, name')->get_where('user_groups', array('site_id' => currentuserinfo()->
                    site_id)); //fetch all depts
            if ($dpQry->num_rows()) {
                foreach ($dpQry->result() as $rec) {
                    $dept_name[$rec->id] = $rec->name;
                }
            }

            foreach ($qury->result() as $rec) {

                $data['id'][] = $rec->id;
                $data['rm_id'][$rec->id] = $rec->reporting_manager_id;
                $data['name'][$rec->id] = $rec->f_name . ' ' . $rec->l_name;
                //    $data['empcode'][$rec->id] = $rec->emp_code;
                $data['profile_pic'][$rec->id] = $rec->profile_pic ? PUBLIC_URL . 'images/' . $rec->profile_pic :
                PUBLIC_URL . 'images/no_image.jpeg';

                $data['dept_name'][$rec->id] = $dept_name[$rec->dept_id];
                //    $data['desg_name'][$rec->id] = $desg_name[$rec->desg_id];
                //    $data['grade_level'][$rec->id] = $rec->grade_level;
                $data['status'][$rec->id] = $rec->status;

            }
        }
        //print '<pre>'; print_r($data);die;
        return $data;
    }
}

if (!function_exists('get_recruiter')) {
    function get_recruiter($id)
    {
        $CI = &get_instance();
        $CI->db->select('users.first_name,users.last_name');
        $CI->db->join("users", "users.id=job_order_assign_list.assign_user_id");
        $CI->db->where('job_order_id', $id);
        $CI->db->order_by('job_order_assign_list.id', 'desc');
        $CI->db->limit(1);
        $query = $CI->db->get("job_order_assign_list");
        return @$query->row()->first_name . " " . @$query->row()->last_name;

    }
}
if (!function_exists('_is_dice_erooki_candidate')) 
{
    function _is_dice_erooki_candidate($dice_id)
    {
        if($dice_id)
		{
			$CI = &get_instance();
			$qry=$CI->db->get_where('candidate',array('dice_id' => $dice_id));
			if($qry->num_rows())
			{
				$data=array();
				$data['er_email']=$qry->row()->email;
				$data['er_phone_home']=$qry->row()->phone_home;
				return $data;
			}
			else
			{
				return false;
			}
		}
		else
		{
			return false;
		}
    }
}

//===cache_file operation=======//
	
if (!function_exists('cache_opration'))
{

	function cache_opration($option='',$var='',$val='')
	{
		$CI = &get_instance();
		//CACHE_EXPIRE
		$CI->load->driver('Cache/drivers/cache_file', array('adapter' => 'apc', 'backup' => 'file'));
		if($option=='set'){
			$CI->cache_file->save($var,$val, CACHE_EXPIRE);
		}else if($option=='get'){
		   return $CI->cache_file->get($var); 
		}else if($option=='delete'){
		   return $CI->cache_file->delete($var); 
		}else{
			return false;
		}
		
	}
}
//===cache_file operation=======//

//===cache_file operation=======//
	
if (!function_exists('_get_contact_rating'))
{

	function _get_contact_rating($id='')
	{
		$CI = &get_instance();
		$qry=$CI->db->get_where('companies_contact',array('id' => $id));
		if($qry->num_rows())
		{
			if($qry->row()->rating>0)
			{
				return $qry->row()->rating;
			}
			else
			{
				return '0';
			}
		}
		else
		{
			return '0';
		}
		
	}
}
//===cache_file operation=======//
//=====Get All Active Job List====//
function get_active_jobs($start_date, $end_date) 
{
	$CI = &get_instance();
	$site_id = isset(currentuserinfo()->site_id) ? currentuserinfo()->site_id : 9;
	$CI->db->select("job_order_id,added_by,status,date(created_time) as date_field");
	$CI->db->where("site_id", $site_id);
	!empty($start_date) ? $CI->db->where("date(created_time) >=", $start_date) : '';
	!empty($end_date) ? $CI->db->where("date(created_time) <=", $end_date) : '';
	$query = $CI->db->get("job_order_history");
	//echo $CI->db->last_query();die;
	$result1 = $query->result();
	$inactive_jobs = array();
	foreach ($result1 as $k => $v) {
		($v->status == 3) ? $inactive_jobs[$v->date_field][] = $v->job_order_id : '';
	}

	foreach ($result1 as $k => $v) {
		foreach ($inactive_jobs as $kk => $vv) {
			if ($v->date_field == $kk) {
				if (in_array($v->job_order_id, $inactive_jobs[$kk])
					) {
						unset($result1[$k]);
					}
			}
		}
	}
	$return_arr = array();
	foreach ($result1 as $k => $v) {
		$return_arr[$v->date_field][$v->added_by][] = $v->job_order_id;
	}
	unset($result1);
	foreach ($return_arr as $date_field => $added_by) {
		foreach ($return_arr[$date_field] as $k => $v) {
			$return_arr[$date_field][$k] = array_unique($return_arr[$date_field][$k]);
		}
	}
	return $return_arr;
}

//=====Get All Active Job List====//
if (!function_exists('job_check')) {
	function job_check($id = null) {
		$id = 5905;
		$arr = array(
			'150',
			'151',
			'152',
			'153',
			'191',
			'198');
		/*$CI = &get_instance();
		$CI->db->select('modified_time');
		$CI->db->where("id", $id);
		$query = $CI->db->get("job_order");*/
		return $arr;
	}
}

function get_recruiter_data_new($id = null, $sdate = null, $edate = null, $rep_Recruiter="") {
	$CI = &get_instance();
	$CI->db->select('users.first_name,users.last_name');
	$CI->db->where('users.id', $rep_Recruiter);
	$CI->db->limit(1);
	$query = $CI->db->get("users");
	return @$query->row()->first_name . " " . @$query->row()->last_name;
}

if (!function_exists('_otherFieldsData')) {
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


if (!function_exists('get_all_dynamic_menu_left_sidebar')) {
    function get_all_dynamic_menu_left_sidebar() {
       
            $CI = &get_instance();
            $CI->db->select('*');
            $CI->db->from('inch_form');
            $CI->db->where('view_on_left', '1');
            $CI->db->where('status', '1');
            $CI->db->where('status', '1');
            $CI->db->where('is_deleted', '1');
            $CI->db->order_by('form_name', 'asc');
            $query = $CI->db->get();
            if ($query->num_rows()) {
                return $query->result();
            }
      
        return false;
    }
}

/**
 * date_time 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('date_time')) {
    function date_time() {
        date_default_timezone_set("Asia/Kolkata");
        return date('Y-m-d H:i:s');
    }
}

/**
 * _dateTime 
 * 
 * return default  timestamp
 *
 * @access	public
 */

if (!function_exists('_dateTime')) {
    function _dateTime() {
        //date_default_timezone_set("Asia/Kolkata");
        return date('Y-m-d H:i:s');
    }
}

// ------------------------------------------------------------------------



//==============Clear Post Data=================//
/**
 * Clear Posted Data 
 * 
 * Clear all posted data
 *
 * @access  public
 */ 
if(!function_exists('clearPostData')) {
    function clearPostData() {
        $data =array();
        foreach($_POST as $index=>$value) {
            $data[$index] = NULL;
        }
        $_POST = $data;
    }
}
//==============Close Clear Post Data=================//


function get_state_filters(){
        $CI=&get_instance();
        $CI->db->select('id,state_name');
        $CI->db->from('states');
        $CI->db->where('status','1');
        
        $CI->db->order_by('state_name','asc');
        $query=$CI->db->get();
       
        if($query->num_rows()){
            return $query->result();
        }
        return 0;
    }

    function get_city_filters(){
        $CI=&get_instance();
        $CI->db->select('id,city_name');
        $CI->db->from('cities');
        $CI->db->where('status','1');
        
        $CI->db->order_by('city_name','asc');
        $query=$CI->db->get();
       
        if($query->num_rows()){
            return $query->result();
        }
        return 0;
    }

function get_industry_type_filters(){
        $CI=&get_instance();
        $CI->db->select('id,name');
        $CI->db->from('industry');
        $CI->db->where('status','1');
        
        $CI->db->order_by('name','asc');
        $query=$CI->db->get();
       
        if($query->num_rows()){
            return $query->result();
        }
        return 0;
    }

    function get_department_filters(){
        $CI=&get_instance();
        $CI->db->select('id,name');
        $CI->db->from('department');
        $CI->db->where('status','1');
        
        $CI->db->order_by('name','asc');
        $query=$CI->db->get();
       
        if($query->num_rows()){
            return $query->result();
        }
        return 0;
    }
    function get_designation_filters(){
        $CI=&get_instance();
        $CI->db->select('id,name');
        $CI->db->from('designation');
        $CI->db->where('status','1');
        
        $CI->db->order_by('name','asc');
        $query=$CI->db->get();
       
        if($query->num_rows()){
            return $query->result();
        }
        return 0;
    }

    function get_dynamic_tbl_filters($table_name){
        $CI=&get_instance();
        $CI->db->select('form_id,name');
        $CI->db->from($table_name);
        $CI->db->where('status','1');
        
        $CI->db->order_by('name','asc');
        $query=$CI->db->get();
       
        if($query->num_rows()){
            return $query->result();
        }
        return 0;
    }

    function get_supplier_from_master($supplier_type = NULL)
    {
        $CI=&get_instance();

        if(!isset($supplier_type) || empty($supplier_type))
        {
            return false;
        }
        $CI->db->where("status","1");
        $CI->db->select("id,name as supplier_name, vendor_type");
        $CI->db->order_by("name","asc");
        if($supplier_type=='1')
        {
            $result = $CI->db->get('supplier_ind');
        }
        else
        {
            $result = $CI->db->get('supplier_china');
        }
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_enquiry_status_india_master()
    {
        $CI=&get_instance();
        $CI->db->where("status","1");
        // $CI->db->order_by("name","asc");
        $result = $CI->db->get("inch_enquiry_status_master");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_enquiry_status_china_master()
    {
        $CI=&get_instance();
        $CI->db->where("status","1");
        // $CI->db->order_by("name","asc");
        $result = $CI->db->get("inch_enquiry_china_status_master");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_order_status_india_master()
    {
        $CI=&get_instance();
        $CI->db->where("status","1");
        // $CI->db->order_by("name","asc");
        $result = $CI->db->get("inch_order_status_master");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_po_status()
    {
        $CI=&get_instance();
        $CI->db->where("status","1");
        // $CI->db->order_by("name","asc");
        $result = $CI->db->get("inch_po_status");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_order_status_china_master()
    {
        $CI=&get_instance();
        $CI->db->where("status","1");
        // $CI->db->order_by("name","asc");
        $result = $CI->db->get("inch_order_status_china_master");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_china_employee_master()
    {
        $CI=&get_instance();
        $CI->db->where_in("group_id",[31,32]);
        $CI->db->where('status','active');
        $CI->db->or_where("( FIND_IN_SET(extra_group_id, 31) OR FIND_IN_SET(extra_group_id, 32) )");
        // $CI->db->order_by("name","asc");
        $result = $CI->db->get("users");
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }

    function get_total_revision($enquiry_id=NULL)
    {
        $CI=&get_instance();
        $CI->db->select("revision");
        $CI->db->where("enquiry_id", $enquiry_id);
        // $CI->db->where("revision>",0, FALSE);
        // $CI->db->where("status",1);
        $CI->db->order_by("revision","ASC");
        $CI->db->group_by("revision");
        $result = $CI->db->get("inch_enquiry_revision");
        // echo $CI->db->last_query();die;
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    
    function get_supplier_po($order_id=NULL)
    {
        $CI=&get_instance();
        $CI->db->select("supplier_po,supplier_country");
        $CI->db->where("order_id", $order_id);
        $CI->db->where("supplier_po_seq>",0, FALSE);
        // $CI->db->where("status",1);
        $CI->db->order_by("supplier_po_seq","asc");
        $CI->db->group_by("supplier_po_seq");
        $result = $CI->db->get("inch_order_product");
        // echo $CI->db->last_query();die;
        if ($result->num_rows > 0) {
            return $result->result();
        } else {
            return false;
        }
    }
    
    function module_list_superAdmin()
    {
        $CI=&get_instance();
        $result = [];
        $CI->db->select('id,form_name,form_label,parent_id,module_type,module_title,module_name,module_controller,module_icon,order_by,status,is_deleted,action');
        $CI->db->where('status',1);
        $CI->db->where('is_deleted',1);
        $CI->db->where('view_on_left','1');
        $CI->db->where('parent_id',0);
        $CI->db->order_by('order_by',"ASC");
        $query =  $CI->db->get('inch_form');
        if($query->num_rows()>0)
        {
            $result = $query->result();
            // pr($result);die;
            foreach ($result as $key => $value) {
                
                $CI->db->select('id,form_name,form_label,parent_id,module_type,module_title,module_name,module_controller,module_icon,order_by,status,is_deleted,action');
                $CI->db->where('status',1);
                $CI->db->where('is_deleted',1);
                $CI->db->where('view_on_left','1');
                $CI->db->where('parent_id',$value->id);
                $CI->db->order_by('order_by',"ASC");
                $result[$key]->child_list =  $CI->db->get('inch_form')->result();
            }
        }
        // pr($result);die;
        return $result;
    }

    function module_list()
    {
        $CI     = &get_instance();
        $data   = [];
        $CI->db->select('id,form_name,form_label,parent_id,module_type,module_title,module_name,module_controller,module_icon,order_by,status,is_deleted,action');
        $CI->db->where('status',1);
        $CI->db->where('is_deleted',1);
        $CI->db->where('view_on_left','1');
        $CI->db->where('parent_id',0);
        $CI->db->order_by('order_by',"ASC");
        $query              =  $CI->db->get('inch_form');
        $permission_data    = permission_data();
        // pr($permission_data);die;
        if($query->num_rows()>0)
        {
            $result = $query->result();
            // pr($result);die;
            $indx = 0;
            foreach ($result as $key => $main_module) {

                $final_status = FALSE;
                $CI->db->select('id,form_name,form_label,parent_id,module_type,module_title,module_name,module_controller,module_icon,order_by,status,is_deleted,action');
                $CI->db->where('status',1);
                $CI->db->where('is_deleted',1);
                $CI->db->where('view_on_left','1');
                $CI->db->where('parent_id',$main_module->id);
                $CI->db->order_by('order_by',"ASC");
                $submdules =  $CI->db->get('inch_form')->result();

                // pr($main_module);die;
                // pr($submdules);
                if(isset($submdules) && !empty($submdules))
                {
                    $child_list = [];
                    foreach ($submdules as $submdule_key => $submodule) {
                        // pr($submodule);

                        $status         = FALSE;
                        $submodule_data = [];
                        if(isset($permission_data) && !empty($permission_data))
                        {
                            foreach ($permission_data as $perm_module_key => $perm_module) {

                                // pr($submodule);die;
                                // pr($perm_module);
                                /*echo "************************************<br>";
                                echo "module_name : ".$submodule->module_name."<br>";
                                echo "module_controller : ".$submodule->module_controller."<br>";
                                echo "module : ".$perm_module['module']."<br>";
                                echo "controller : ".$perm_module['module_controller']."<br>";*/
                                // die;
                                
                                if(!empty($submodule->module_name) && $submodule->module_name==$perm_module['module'] && !empty($submodule->module_controller) && $submodule->module_controller==$perm_module['controller'])
                                {
                                    if(count($perm_module)>2)
                                    {
                                        $status = TRUE;

                                        // pr($submodule);die;
                                        // echo "string";
                                        // $submodule_data = $submodule;
                                        // echo "************************************<br>";
                                        // echo "module_name : ".$submodule->module_name."<br>";
                                        // echo "module_controller : ".$submodule->module_controller."<br>";
                                        // echo "module : ".$perm_module['module']."<br>";
                                        // echo "controller : ".$perm_module['controller']."<br>";
                                        
                                    }
                                }
                            }
                        }

                        if($status)
                        {
                            $final_status = TRUE;
                            $child_list[] = $submodule;
                        }
                    }
                }

                if($final_status)
                {
                    // echo $indx."<br>";
                    $data[$indx]                = $main_module;
                    $data[$indx]->child_list    = $child_list;
                    $indx++;
                }
                // if($key==2)
                // {
                //     die;
                // }
            }
        }
        // pr($data);die;
        return $data;
    }

    function permission_data()
    {
        $CI = &get_instance();
        $permissions = [];
        $currentuserinfo    = currentuserinfo();
        $group_id           = @explode(",", $currentuserinfo->group_id);
        $extra_group_id     = @explode(",", $currentuserinfo->extra_group_id);
        $all_group          = array_merge($group_id, $extra_group_id);

        $CI->db->where_in('group_id' ,$all_group);
        $query = $CI->db->get("user_group_permissions");
        if($query->num_rows() > 0)
        {
            $result =  $query->result_array();
        }
        // pr($all_group);die;
        foreach ($result as $permission_key => $permission) {
            $prm_data = json_decode(stripslashes($permission['data']), TRUE); 
            foreach ($prm_data as $p_key => $module) {
                if(count($module)>2)
                {
                    $permissions[$p_key] = $module;
                }
            }
        }

        // pr($permissions);die;
        return $permissions;
    }

    if (!function_exists('get_uom_from_master')) {
        function get_uom_from_master()
        {
            $CI = &get_instance();
            $CI->db->select("*,name as unit_name");
            $CI->db->where('status','1');
            $CI->db->order_by("name","asc");
            $result = $CI->db->get('inch_unit_master');
            if ($result->num_rows > 0) {
                return $result->result();
            } else {
                return false;
            }
        }
    }

    if (!function_exists('get_hsncode_from_master')) {
        function get_hsncode_from_master()
        {
            $CI = &get_instance();
            $CI->db->where('status','1');
            $CI->db->select("*, name as hsn_name");
            $CI->db->order_by("name","ASC");
            $result = $CI->db->get('inch_hsn_code_master');
            if ($result->num_rows > 0) {
                return $result->result();
            } else {
                return false;
            }
        }
    }
    
    if (!function_exists('get_hsncode_from_master_china')) {
        function get_hsncode_from_master_china()
        {
            $CI = &get_instance();
            $CI->db->where('status','1');
            $CI->db->select("*,name as hsn_name");
            $CI->db->order_by("hsn_name","ASC");
            $result = $CI->db->get('inch_hsn_china_code_master');
            if ($result->num_rows > 0) {
                return $result->result();
            } else {
                return false;
            }
        }
    }
    if (!function_exists('get_supplier_type_from_master')) {
        function get_supplier_type_from_master($id = NULL, $country_id = NULL)
        {
            $CI = &get_instance();
            if($id)
            {
                $CI->db->where("id",$id);
            }
            if($country_id)
            {
                $CI->db->where("country",$country_id);
            }
            $CI->db->where('status','1');
            $CI->db->order_by("name","ASC");
            $result = $CI->db->get('supplier_vendor');
            if ($result->num_rows > 0) {
                return $result->result();
            } else {
                return false;
            }
        }
    }


    if (!function_exists('get_supplier_contract')) {
        function get_supplier_contract($id = NULL, $country_id = NULL)
        {
            $CI = &get_instance();
            if($country_id == '1')
            {
                $table = "supplier_ind_contact";
            }
            else
            {
                $table = "supplier_china_contact";
            }
            if($id)
            {
                $CI->db->where("supplier_id",$id);
            }
            $CI->db->where('status','1');
            $CI->db->order_by("name","ASC");
            $result = $CI->db->get($table);
            if ($result->num_rows > 0) {
                return $result->result();
            } else {
                return false;
            }
        }
    }

    
    /**
     * uri_segment
     * this function give url segment value
     * @param int 
     * @return string
     */
    if (!function_exists('uri_segment')) {

        function uri_segment($val) {
            $CI = &get_instance();
            return $CI->uri->segment($val);
        }

    }
    /* End of Function */

    function array_to_exl($header, $excellists, $download = "") {
        $num = 0;
        $data = NULL;
        if ($excellists != null) {
            foreach ($excellists as $row) {
                $num++;
                $line = $num . "\t";
                foreach ($row as $value) {
                    if (!isset($value) || trim($value) == "") {
                        $value = "\t";
                    } else {
                        $value = str_replace('"', '""', $value);
                        $value = '"' . $value . '"' . "\t";
                    }
                    $line .= $value;
                }
                $data .= trim($line) . "\n";
            }
            $data = str_replace("\r", "", $data);
            if (trim($data) == "") {
                $data = "\n(0)Records Found!\n";
            }
        }
        if ($download != "") {
            header('Content-Type: application/msexcel');
            header('Content-Disposition: attachement; filename="' . $download . '"');
            header("Pragma: no-cache");
            header("Expires: 0");
            print "$header\n$data";
        }
    }

    function getEmailArrayFromString($sString = '')
    {
        $sPattern = '/[\._\p{L}\p{M}\p{N}-]+@[\._\p{L}\p{M}\p{N}-]+/u';
        preg_match_all($sPattern, $sString, $aMatch);
        $aMatch = array_keys(array_flip(current($aMatch)));
        return $aMatch;
    }

    function get_child($user_id, $group_ids, $groups = NULL)
    {
        $CI = &get_instance();
        $child_user_ids = [];
        if(!empty(cache_opration('get','INCH_childUsers_'.$user_id)))
        {
            $result = cache_opration('get','INCH_childUsers_'.$user_id);
            return $result;
        }
        else
        {
            $CI->db->select('id');
            $CI->db->where_in('parent_group_id', $group_ids, FALSE);
            $result     = $CI->db->get('user_groups')->result_array();
            // pr($result);die;
            $new_ids    = array_column($result, 'id');
            if(isset($result) && !empty($result))
            {
                $groups .= implode(",", $new_ids).',';
                // echo $CI->db->last_query();
                return get_child($user_id, $new_ids, $groups);
            }
            if(isset($groups) && !empty($groups))
            {
                $groups = explode(',', $groups);
                $groups = array_filter($groups);

                $CI->db->select('id');
                $CI->db->where_in('group_id', $groups, FALSE);
                $result     = $CI->db->get('users')->result_array();
                $child_user_ids = array_column($result, 'id');
            }
            // $CI->session->set_userdata('child_user', $child_user_ids);
            cache_opration('set','INCH_childUsers_'.$user_id, [$child_user_ids]);
            return [$child_user_ids];
            // $child_list = $CI->session->userdata('child_user');
            // pr($child_list);die;
            // return $child_user_ids;
        }
    }

    function uploadDoc($file_arr, $folder_doc = './upload/temp_attachment/', $upload_file="upload_file") {
        
        $thisObj = &get_instance();
        if ($file_arr['name'] != '') {
            
            $file_name = time() . "-" . $file_arr['name'];
            ;
            if (!file_exists($folder_doc)) {
                mkdir($folder_doc, 0777, true);
            }
            $file_arr['name']           = $file_name;
            $config['upload_path']      = $folder_doc;
            $config['allowed_types']    = 'doc|docx|pdf|jpg|png|jpeg|xls|xlsx|gif';
            $config['max_size']         = '20000';
            $config['encrypt_name']     = false;
            $config['remove_spaces']    = true;
            $config['overwrite']        = false;
            $thisObj->load->library('upload');
            $thisObj->upload->initialize($config);
            $data = [];
            if (!$thisObj->upload->do_upload($upload_file))
            {
                $data['error'] = $thisObj->upload->display_errors();
            } 
            else
            {
                $data['success'] = $thisObj->upload->data();
            }
            // pr($data);
            return $data;
        }
    }
    
    if (!function_exists('get_smtp_user')) {

        function get_smtp_user($type = 'sales_spares_email', $category = 1)
        {

            $CI = &get_instance();
            if($type)$CI->db->where("type", $type);
            if($category)$CI->db->where("category", $category);
            return $CI->db->get('inch_emailsmtpuserpass')->row();
            
        }
    }

    if (!function_exists('update_smtp_user')) {

        function update_smtp_user($type='sales_spares_email', $category=1, $value=0)
        {
            $CI = &get_instance();
            return $CI->db->query("UPDATE inch_emailsmtpuserpass set is_sync = $value WHERE type = '".$type."' AND category = '".$category."'");
        }
    }

    