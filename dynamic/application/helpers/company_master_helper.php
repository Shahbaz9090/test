<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Company Master Information helper

 *

 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	master information
 * @company     GohrmInc
 * @since		Version 1.0
 */

 //====================================Sumit=======================================//
 //=====================================Close Employee basic details====================================//
/*** Get employee basic Details
     * 
     * @access	public
     * @param   int - Comp id & User id
     * @return	array - mixed
     */
	if(!function_exists('_get_employee_existence')) {
		function _get_employee_existence($emp_id=NULL,$user_id=NULL,$comp_id=NULL,$FILDATA=FALSE){
			$CI =& get_instance();
			if($FILDATA){
				$CI->db->select('id, emp_code, f_name, l_name, salutation, email_id, profile_pic, cat_id, dept_id, desg_id, grade_id, location, emp_type, probation_period, join_date, is_period_extendable, emp_extend_days, emp_extend_remarks, confirm_date, confirm_letter, reign_date, status');
				$CI->db->where('id',$emp_id);
				$CI->db->where('c_id',$comp_id);
				$qury=$CI->db->get('company_employee');
				$data=$qury->row();
				return $data;
			}else{
				$CI->db->select('status');
				$CI->db->where('id',$emp_id);
				$CI->db->where('c_id',$comp_id);
				$CI->db->where('user_id',$user_id);
				$qury=$CI->db->get('company_employee')->row();
				if($qury){
					return $qury->status;
				}else{
					return false;
				}
			}
		}
	}		
//=====================To get the flow details against that Leave Request================================================//
 if(!function_exists('_appr_flow_details')) {  
   function _appr_flow_details($comp_id = NULL, $user_id = NULL, $emp_id = NULL, $flow_id = NULL, $dept_id = NULL){
		$data = array();
		$CI = & get_instance();
		$qry = $CI->db->get_where('setup_approval_flow', array('id' => $flow_id, "comp_id" => $comp_id, "user_id" => $user_id, 'status != ' => 0), 1);   	
		if($qry->num_rows())
		{
			$info = $qry->row();	
			$data['approval_mode'] = $info->approval_mode;					
			$data['approve_rm'] = $info->approve_rm;					
			$data['approve_hr'] = $info->approve_hr;	
			$data['informing_auth'] = $info->informing_auth;									
			$data['next_rm'] = $info->next_rm;
			$data['all_rms'] = $info->all_rms;
			$data['top_senior'] = $info->top_senior;
		}
   		return $data;
   }
 }
//====================================Get All Emps with their Reporting Managers=======================================//					
	if(!function_exists('_get_all_rms')) {
		function _get_all_rms($comp_id=NULL, $user_id=NULL){
			$data = array();
			$CI =& get_instance();
			$qury = $CI->db->select('id, emp_code, f_name, l_name, salutation, reporting_manager_id, email_id, cat_id, dept_id, desg_id, grade_id, location, join_date, reign_date, emp_type, status')->where_not_in('status', array(0, 4))->get_where('company_employee', array('c_id' => $comp_id, 'user_id' => $user_id));
			if($qury->num_rows())
			{
				foreach($qury->result() as $rec)
				{
					$data['id'][] = $rec->id;
					$data['rm_id'][$rec->id] = $rec->reporting_manager_id;			
					$data['name'][$rec->id] = $rec->f_name.' '.$rec->l_name;			
					$data['dept_id'][$rec->dept_id][$rec->grade_id][] = $rec->id;	
					$data['emp_type'][$rec->id] = $rec->emp_type;		
					$data['email_id'][$rec->id] = $rec->email_id;		
				}
			}
			return $data;
		}
	}
//====================================Get All Emps with their Reporting Managers=======================================//					
	if(!function_exists('_getAuthorisedEmps')) {
		function _getAuthorisedEmps($comp_id=NULL, $user_id=NULL, $emp_type=NULL){
			$data = array();
			$CI =& get_instance();
			if($emp_type)
			{
				$qury = $CI->db->select('id, emp_code, f_name, l_name, salutation, reporting_manager_id, email_id, cat_id, dept_id, desg_id, grade_id, location, join_date, reign_date, emp_type, status')->where_not_in('status', array(0, 4))->get_where('company_employee', array('c_id' => $comp_id, 'user_id' => $user_id, 'emp_type' => $emp_type));
				
				if($qury->num_rows())
				{
					foreach($qury->result() as $rec)
					{
						$data[] = $rec->id;
						//$data['name'][$rec->id] = $rec->f_name.' '.$rec->l_name;			
						//$data['rm_id'][$rec->id] = $rec->reporting_manager_id;			
						//$data['dept_id'][$rec->dept_id][$rec->grade_id][] = $rec->id;			
					}
				}
			}
			return $data;
		}
	}
//====================================Get All Emps with their Reporting Managers=======================================//					
	if(!function_exists('_get_all_gradeLevels')) {
		function _get_all_gradeLevels($comp_id=NULL, $user_id=NULL){
			$data = array();
			$CI =& get_instance();
			$qury = $CI->db->order_by('level')->select('id, grade_name, level')->get_where('grade_master', array('comp_id' => $comp_id, 'user_id' => $user_id, 'status != ' => 0));
			if($qury->num_rows())
			{
				foreach($qury->result() as $rec)
				{
					$data['grade_id'][] = $rec->id;
					$data['grade_level'][$rec->id] = $rec->level;			
				}
			}
			return $data;
		}
	}
//====================================Get All Emps with their Reporting Managers=======================================//					
	if(!function_exists('_get_all_rms_in_hierarchy')) {
		function _get_all_rms_in_hierarchy($comp_id=NULL, $user_id=NULL){
			$data = $dept_name = $desg_name = array();
			$CI =& get_instance();
			$qury = $CI->db->order_by('id', 'asc')->select('id, emp_code, f_name, l_name, reporting_manager_id, profile_pic, salutation, dept_id, desg_id, grade_level, status')->get_where('company_employee', array('c_id' => $comp_id, 'user_id' => $user_id, 'status != ' => 0));
			if($qury->num_rows())
			{
				$dpQry = $CI->db->select('id, dept_name')->get_where('company_department_master', array('c_id' => $comp_id, 'user_id' => $user_id));//fetch all depts	
				if($dpQry->num_rows())
				{
					foreach($dpQry->result() as $rec)
					{
						$dept_name[$rec->id] = $rec->dept_name;			
					}
				}
				$dsQry = $CI->db->select('id, desg_name')->get_where('company_designation_master', array('c_id' => $comp_id, 'user_id' => $user_id));//fetch all designations	
				if($dsQry->num_rows())
				{
					foreach($dsQry->result() as $rec)
					{
						$desg_name[$rec->id] = $rec->desg_name;			
					}
				}
				foreach($qury->result() as $rec)
				{
					if($rec->status == 4)
					{
						$chRmqury = $CI->db->select('id')->get_where('company_employee', array('c_id' => $comp_id, 'user_id' => $user_id, 'reporting_manager_id' => $rec->id, 'status !=' => '4'));			
						if($chRmqury->num_rows())
						{
							$data['id'][] = $rec->id;
							$data['rm_id'][$rec->id] = $rec->reporting_manager_id;			
							$data['name'][$rec->id] = $rec->f_name.' '.$rec->l_name;			
							$data['empcode'][$rec->id] = $rec->emp_code;			
							$data['profile_pic'][$rec->id] = $rec->profile_pic ? base_url().'bucket/images/company/employee_pics/'.$rec->profile_pic : ($rec->salutation == 1 ? base_url().'bucket/images/company/men_default.jpg' : base_url().'bucket/images/company/women_default.jpg');			
							$data['dept_name'][$rec->id] = $dept_name[$rec->dept_id];
							$data['desg_name'][$rec->id] = $desg_name[$rec->desg_id];	
							$data['grade_level'][$rec->id] = $rec->grade_level;		
							$data['status'][$rec->id] = $rec->status;				
						}
					}
					else
					{	
						$data['id'][] = $rec->id;
						$data['rm_id'][$rec->id] = $rec->reporting_manager_id;			
						$data['name'][$rec->id] = $rec->f_name.' '.$rec->l_name;			
						$data['empcode'][$rec->id] = $rec->emp_code;			
						$data['profile_pic'][$rec->id] = $rec->profile_pic ? base_url().'bucket/images/company/employee_pics/'.$rec->profile_pic : ($rec->salutation == 1 ? base_url().'bucket/images/company/men_default.jpg' : base_url().'bucket/images/company/women_default.jpg');			
						$data['dept_name'][$rec->id] = $dept_name[$rec->dept_id];
						$data['desg_name'][$rec->id] = $desg_name[$rec->desg_id];	
						$data['grade_level'][$rec->id] = $rec->grade_level;		
						$data['status'][$rec->id] = $rec->status;		
					}
				}
			}
			return $data;
		}
	}
//====================================Get All Emps with their Reporting Managers=======================================//					
	if(!function_exists('_get_all_rms_in_hierarchy_tree')) {
		function _get_all_rms_in_hierarchy_tree($comp_id=NULL, $user_id=NULL){
			$data = $dept_name = $desg_name = array();
			$CI =& get_instance();
			$qury = $CI->db->order_by('id', 'asc')->select('id, emp_code, f_name, l_name, reporting_manager_id, profile_pic, salutation, dept_id, desg_id, grade_level, status')->where_not_in('status', array(0, 4))->get_where('company_employee', array('c_id' => $comp_id, 'user_id' => $user_id));
			if($qury->num_rows())
			{
				$dpQry = $CI->db->select('id, dept_name')->get_where('company_department_master', array('c_id' => $comp_id, 'user_id' => $user_id));//fetch all depts	
				if($dpQry->num_rows())
				{
					foreach($dpQry->result() as $rec)
					{
						$dept_name[$rec->id] = $rec->dept_name;			
					}
				}
				$dsQry = $CI->db->select('id, desg_name')->get_where('company_designation_master', array('c_id' => $comp_id, 'user_id' => $user_id));//fetch all designations	
				if($dsQry->num_rows())
				{
					foreach($dsQry->result() as $rec)
					{
						$desg_name[$rec->id] = $rec->desg_name;			
					}
				}
				foreach($qury->result() as $rec)
				{
					$data['id'][] = $rec->id;
					$data['rm_id'][$rec->id] = $rec->reporting_manager_id;			
					$data['name'][$rec->id] = $rec->f_name.' '.$rec->l_name;			
					$data['empcode'][$rec->id] = $rec->emp_code;			
					$data['profile_pic'][$rec->id] = $rec->profile_pic ? base_url().'bucket/images/company/employee_pics/'.$rec->profile_pic : ($rec->salutation == 1 ? base_url().'bucket/images/company/men_default.jpg' : base_url().'bucket/images/company/women_default.jpg');			
					$data['dept_name'][$rec->id] = isset($dept_name[$rec->dept_id])?$dept_name[$rec->dept_id]:'';
					$data['desg_name'][$rec->id] = isset($desg_name[$rec->desg_id])?$desg_name[$rec->desg_id]:'';	
					$data['grade_level'][$rec->id] = $rec->grade_level;		
					$data['status'][$rec->id] = $rec->status;		
				}
			}
			return $data;
		}
	}
//=======================================================================================================================//				
	if(!function_exists('_get_pastemployee_existence')) {
		function _get_pastemployee_existence($emp_id=NULL,$user_id=NULL,$comp_id=NULL,$FILDATA=FALSE){
			$CI =& get_instance();
			$CI->db->select('id,emp_code,f_name,l_name,email_id,cat_id,probation_period,join_date,is_period_extendable,emp_extend_days,emp_extend_remarks,confirm_date,confirm_letter');
			$CI->db->where('id',$emp_id);
			$CI->db->where('c_id',$comp_id);
			$CI->db->where('status', '4');
			if($FILDATA){
				$qury=$CI->db->get('company_employee');
				$data=$qury->row();
				return $data;
			}else{
				$CI->db->where('user_id',$user_id);
				$CI->db->from('company_employee');
				$total = $CI->db->count_all_results();
				if($total){
					return true;

				}else{
					return false;
				}
			}

		}
	}
//=========================Employee Delegate list===============================================//
    function _getDeligatedEmpOfRm($comp_id=NULL, $user_id=NULL, $sdate = null){
        $data = array();
        $CI = & get_instance();
		$qry = $CI->db->select('id,delg_from,delg_to,delg_by,from_date,to_date,remarks')->get_where("ess_delegate_responsibility", array("comp_id" => $comp_id, "user_id" => $user_id, 'from_date <= ' => $sdate, 'to_date >=' => $sdate, 'status' => '1'));
		//echo $CI->db->last_query();
		if($qry->num_rows()) 
		{	//pr($qry->result());
			foreach($qry->result() as $rec)
			{
				$data['rmid'][] = $rec->delg_from; 
				$data[$rec->delg_from] = $rec->delg_to; 
				
			}		
		}
		//pr($data);
	return $data;
}
//====================================Close company statutory Master Details=======================================//
//=====================================Close Employee basic details====================================//
//====================================company statutory Master Details=======================================//
/**
     * Get statutory Master Details
     * 
     * @access	public
     * @param   int - Comp id & User id
     * @return	array - mixed
     */
	if(!function_exists('_statutory_master_details')) {
		function _statutory_master_details(){
			$CI =& get_instance();
			$comp_id = $CI->session->userdata['activecomdata']['active_id'];
			$user_id = $CI->session->userdata['activecomdata']['active_uid'];
			$CI->db->select('id,comp_esic,comp_pf,pf_stacode,pf_ctycode,pf_compcode,pf_empcode');
			$CI->db->where('comp_id',$comp_id);
			$CI->db->where('user_id',$user_id);
			$result=$CI->db->get('company_statutory');
			return $result->row();
		}
	}
//====================================Close company statutory Master Details=======================================//
//====================================company Asset Master Details=======================================//
/**
     * Get Asset Master Details
     * 
     * @access	public
     * @param   int - Comp id & User id
     * @return	array - mixed
     */
	if(!function_exists('_asset_master_details')) {
		function _asset_master_details($user_id=NULL,$comp_id=NULL){
			if(!empty($comp_id) && !empty($user_id)) {
				$CI =& get_instance();
				$CI->db->select('id,asset_name');
				$CI->db->where('comp_id',$comp_id);
				$CI->db->where('user_id',$user_id);
				$CI->db->where('status', '1');
				$result=$CI->db->get('assetmaster');
				return $result->result();
			}
			return false;
		}
	}
//====================================Close company statutory Master Details=======================================//
	//====================================Company rang details=======================================//
/**
     * Get rang Master Details
     * 
     * @access	public
     * @param   int - range id
     * @return	array - mixed
     */
	if(!function_exists('_get_rang_details')) {
		function _get_rang_details($rang_id=NULL){
			$CI =& get_instance();
			if($rang_id != null)
			{
				$qry = $CI->db->get_where('emp_slab_range', array('id' => $rang_id));
				if($qry->num_rows() > 0)
				{	
					return $qry->row()->from_range.'-'.$qry->row()->to_range;
				}
			}
			else
			{
				return null;
			}
		}
	}
//====================================Close Company rang details=======================================//
//====================================Company BillingPeriod details=======================================//
/**
     * Get rang Master Details
     * 
     * @access	public
     * @param   int - range id
     * @return	array - mixed
     */
	if(!function_exists('_get_Billing_Period_val')) {
		function _get_Billing_Period_val($bp_id=NULL){
			$CI =& get_instance();
			if($bp_id != null)
			{
				$CI->db->select('billing_period');
				$qry = $CI->db->get_where('billing_period', array('id' => $bp_id));
				if($qry->num_rows() > 0)
				{	
					$billing_period=$qry->row()->billing_period;
					switch($billing_period){
						case 1 : $billing_period = "Monthly";
						break;
						case 2 : $billing_period = "Quarterly";
						break;
						case 3 : $billing_period = "Six Monthly";
						break;
						case 4 : $billing_period = "Yearly";
						break;
					} 
					return $billing_period;
				}
			}
			else
			{
				return 'Monthly';
			}
		}
	}
//====================================Close Company BillingPeriod details=======================================//
//====================================Employee Asset Name=======================================//
/**
     * Get Asset Master Details
     * 
     * @access	public
     * @param   int - asset id
	 * @return	array - mixed
     */
	if(!function_exists('_Get_Asset_name')) {
		function _Get_Asset_name($asset_id=NULL){
			$CI =& get_instance();
			if($asset_id != null)
			{
				$qry = $CI->db->get_where('assetmaster', array('id' => $asset_id));
				if($qry->num_rows() > 0)
				{	
					return $qry->row()->asset_name;
				}
			}
			else
			{
				return null;
			}
		}
	}
//=====================================Close Employee Asset Name====================================//
//====================================Employee Asset Name=======================================//
/**
     * Get Asset Master existence
     * 
     * @access	public
     * @param   int - asset id
	 * @return	array - mixed
     */
	if(!function_exists('_Get_Asset_existence')) {
		function _Get_Asset_existence($asset_id=NULL,$c_id=NULL,$user_id=NULL){
			$CI =& get_instance();
			if($asset_id && $c_id && $user_id){
				$CI->db->where('id',$asset_id);
				$CI->db->where('comp_id',$c_id);
				$CI->db->where('user_id',$user_id);
				$CI->db->from('assetmaster');
				$total = $CI->db->count_all_results();
				if($total){
					return true;

				}else{
					return false;
				}
			} else{
				return null;
			}
		}
	}
//=====================================Close Employee Asset Name====================================//
//============================Active and Inactive Employee List=================================//
	/** Added by::: Sumit :::
* Calculates all Employee List
* Against given company and user id.
* @param string $uri The URI path
* _getall_EMPLOYEE_LIST()
* @return if company or employee is login
*/
if ( ! function_exists('_getall_EMPLOYEE_LIST')) {
    function _getall_EMPLOYEE_LIST($c_id=NULL,$u_id=NULL,$active=FALSE,$inactive=FALSE,$past=FALSE,$tot=FALSE,$allempdata=FALSE,$s_id=FALSE) {
		if(!empty($c_id) && !empty($u_id)) {
			$CI =& get_instance();
			if($active) {
				$CI->db->where('c_id',$c_id);
				$CI->db->where('user_id',$u_id);
				$CI->db->where('status !=','4');
				$CI->db->from('company_employee');
				$total = $CI->db->count_all_results();
				return $total;

			}
			if($inactive) {
				$CI->db->where('c_id',$c_id);
				$CI->db->where('user_id',$u_id);
				$CI->db->where('status','0');
				$CI->db->from('company_employee');
				$total = $CI->db->count_all_results();
				return $total;
			}
			if($past){
				$CI->db->where('c_id',$c_id);
				$CI->db->where('user_id',$u_id);
				$CI->db->where('status','4');
				$CI->db->from('company_employee');
				$total = $CI->db->count_all_results();
				return $total;
			}
			if($tot){
				$CI->db->where('user_id',$u_id);
				$CI->db->from('company_employee');
				$total = $CI->db->count_all_results();
				return $total;
			}
			if($allempdata && $s_id){
				$CI->db->select('id,comp_id');
				$com_subcomdata=$CI->db->get_where("users",array("s_id"=>$s_id, "status"=>1))->result_array();
				$total=0;
				foreach($com_subcomdata as $keys => $valus){
					$CI->db->where('c_id',$valus['comp_id']);
					$CI->db->where('user_id',$valus['id']);
					$CI->db->where('status !=','4');
					$CI->db->from('company_employee');
					$total = $total + $CI->db->count_all_results();
				}
				return $total;
			}
			return FALSE;
		}
		return FALSE;
	}
}
//========================Close Active And Inactive Employee List===============================//
//=============================Get Compnay Registered Address=========================================//
	if ( ! function_exists('_Get_comp_Registered_Addr')) {
		function _Get_comp_Registered_Addr($c_id=NULL,$u_id=NULL) {
			if(!empty($c_id) && !empty($u_id)) {
				$CI =& get_instance();
				$CI->db->select('id,address,state,city');
				$regaddrs=$CI->db->get_where("company_location",array("comp_id"=>$c_id, "user_id"=>$u_id, "off_type" => "Registered Office", "status"=>1));
				if($regaddrs->num_rows()){
					$regaddr=$regaddrs->row();
					$addr=$regaddr->address;
					$sta=ucfirst($CI->db->select('name')->where(array('id'=>$regaddr->state))->get('location')->row()->name);
					$cit=ucfirst($CI->db->select('name')->where(array('id'=>$regaddr->city))->get('location')->row()->name);
					$coml_add=$addr;
					if(!empty($sta)){
						$coml_add=$coml_add.','.$sta;
					} 
					if(!empty($cit)){
						$coml_add=$coml_add.','.$cit;
					}
					return $coml_add;
				}
				
				
			}
			return false;
		}
	}
//======================-==Close Company Registered Address==========================================//
//===================valid email==================================================//
/** Added by::: Sumit :::
* check valid Email id
* Against user input.
* @param string $uri The URI path
* _is_valid_email()
* @return if company or employee is login
*/
	if ( ! function_exists('_is_valid_email')) {
		function _is_valid_email($email=NULL) {
			if($email) {
				if(preg_match("/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/", $email)){
					return true;
				} else {
					return false;
				}
				
			}
			return false;
		}
	}
//==================Close Valid Email============================================//
//===================valid date from csv==================================================//
/** Added by::: Sumit :::
* check valid date
* Against user input.
* @param string $uri The URI path
* _is_valid_date()
* @return if company or employee is login
*/
	if ( ! function_exists('_is_valid_date')) {
		function _is_valid_date($value=NULL,$format = 'dd/mm/yyyy') {
			if(strlen($value) >= 6 && strlen($format) == 10){ 
				$separator_only = str_replace(array('m','d','y'),'', $format);
				$separator = $separator_only[0]; // separator is first character
				if($separator && strlen($separator_only) == 2){ 
					// make regex 
					$regexp = str_replace('mm', '(0?[1-9]|1[0-2])', $format);
					$regexp = str_replace('dd', '(0?[1-9]|[1-2][0-9]|3[0-1])', $regexp); 
					$regexp = str_replace('yyyy', '(19|20)?[0-9][0-9]', $regexp); 
					$regexp = str_replace($separator, "\\" . $separator, $regexp);
					if($regexp != $value && preg_match('/'.$regexp.'\z/', $value)){
						// check date 
						/*$arr=explode($separator,$value);
						$day=$arr[0]; 
						$month=$arr[1]; 
						$year=$arr[2]; 
						if(@checkdate($month, $day, $year))*/
						return true; 
					}
				} 
			} 
			return false; 
		}
	}
//==================Close Valid Email============================================//
//===================valid Pan Account No==================================================//
/** Added by::: Sumit :::
* check valid pan
* Against user input.
* @param string $uri The URI path
* _Get_Validpan_acno()
* @return if company or employee is login
*/
	if ( ! function_exists('_Get_Validpan_acno')) {
		function _Get_Validpan_acno($pan=NULL) {
			if($pan) {
				$lenpan=strlen($pan);
				if($lenpan>='10' && $lenpan<'11'){
					$firstval=substr($pan, 0, 5);
					if(preg_match("/^[a-zA-Z]+$/i",$firstval)){
						$secondval=substr($pan, 5, -1);
						if(is_numeric($secondval)){
							$latval=substr($pan, -1, 1);
							if(preg_match("/^[a-zA-Z]$/", $latval)){
								return true;
							} else {
								return false;
							}
						} else {
							return false;
						}
					} else {
						return false;
					}
				}
			}
			return false;
		}
	}
//==================Close valid Pan Account No============================================//
//===================valid Pan Account No==================================================//
/** Added by::: Sumit :::
* check valid Addhar
* Against user input.
* @param string $uri The URI path
* _Get_validaadhar_no()
* @return if company or employee is login
*/
	if ( ! function_exists('_Get_validaadhar_no')) {
		function _Get_validaadhar_no($aadharno=NULL) {
			if($aadharno) {
				$lenaadhr=strlen($aadharno);
				if($lenaadhr>='12' && $lenaadhr<'13'){
					if(is_numeric($aadharno)){
					   return true;
					}
                    return false;
				}
			}
			return false;
		}
	}
//==================Close valid Pan Account No============================================//
//===================Bank List==================================================//
/** Added by::: Sumit :::
* Bank List
* Against comp id and user id.
* @param string $uri The URI path
* _comp_bank_list()
* @return if company or employee is login
*/
	if ( ! function_exists('_comp_bank_list')) {
		function _comp_bank_list($comp_id=NULL,$user_id=NULL) {
			if(!empty($comp_id) && !empty($user_id)) {
				$CI =& get_instance();
				$CI->db->select('bank_name,id');
				$banklist=$CI->db->get_where("company_bank_details",array("user_id"=>$user_id,"comp_id"=>$comp_id,"status"=>'1'))->result_array();
                return $banklist;
			}
			return false;
		}
	}
//==================Close Bank List============================================//
//===================company Bank List==================================================//
/** Added by::: Sumit :::
* Bank List
* Against comp id and user id.
* @param string $uri The URI path
* _comp_salary_bank_list()
* @return if company or employee is login
*/
	if ( ! function_exists('_comp_salary_bank_list')) {
		function _comp_salary_bank_list($comp_id=NULL,$user_id=NULL) {
			if(!empty($comp_id) && !empty($user_id)) {
				$CI =& get_instance();
				$CI->db->select('id,bankname');
				$banklist=$CI->db->get_where("bank_list",array("status"=>'1'))->result_array();
                return $banklist;
			}
			return false;
		}
	}
//==================Close company Bank List============================================//
//===================Valid Rows==================================================//
/** Added by::: Sumit :::
* Valid Rows
* Against comp id and user id.
* @param string $uri The URI path
* _is_valid_employee_rows()
* @return if company or employee is login
*/
	if ( ! function_exists('_is_valid_employee_rows')) {
		function _is_valid_employee_rows($comp_id=NULL,$user_id=NULL,$fieldcode=NULL,$fields=NULL,$tabln=NULL) {
			if(!empty($comp_id) && !empty($user_id) && !empty($fieldcode) && !empty($fields) && !empty($tabln)) {
				$CI =& get_instance();
				$CI->db->where($fields,$fieldcode);
				if($fields!='email_id') {
					$CI->db->where('c_id',$comp_id);
					$CI->db->where('user_id',$user_id);
				}
				$CI->db->from($tabln);
				$total = $CI->db->count_all_results();
				if($total){
					return true;
				} else {
					return false;
				}
			}
			return false;
		}
	}
//==================Close Valid Rows============================================//
//===================Non Probation category list===============================//
/** Added by::: Sumit :::
* Non Probation category
* Against comp id and user id.
* @param string $uri The URI path
* _is_non_probation_cat_list()
* @return if company or employee non probation cat list
*/
	if ( ! function_exists('_is_non_probation_cat_list')) {
		function _is_non_probation_cat_list($comp_id=NULL,$user_id=NULL) {
			$data=array();
			if(!empty($comp_id) && !empty($user_id)) {
				$CI =& get_instance();
				$CI->db->select('id,cat_name');
				$catg=$CI->db->get_where("company_category_master",array("user_id"=>$user_id,"c_id"=>$comp_id,"status"=>1))->result();
				$data['category'] = array();
				foreach($catg as $row) {
					$CI->db->where('cat_id', $row->id);
					$CI->db->where('prob_period >=', '1');
					$CI->db->from('company_probation_policy');
					$total = $CI->db->count_all_results();
					if(!$total){
						$data['category'][$row->id] = $row->cat_name;
					}
				}
				return $data;
			}	
		}
	}
//===================Close Non Probation category list===============================//
//=================company and Subcompany data=====================================//
/** Added by::: Sumit :::
* company and sub company data
* Against comp id and user id.
* @param string $uri The URI path
* _is_com_subcomp_info()
* @return if company and subcompany info*/
	if ( ! function_exists('_is_com_subcomp_info')) {
		function _is_com_subcomp_info($s_id=NULL, $acid=NULL, $auser_id=NULL) {
			$data=array();
			if(!empty($s_id) && !empty($acid) && !empty($auser_id)) {
				$CI =& get_instance();
				$CI->db->select('id,comp_id');
				$childcomp=$CI->db->get_where("users",array("s_id" => $s_id, "comp_id !=" => $acid, "id !=" => $auser_id, "status" => 'active'))->result_array();
				if(!empty($childcomp)) {
					$i=0;
					foreach($childcomp as $result){
						$userid=$result['id'];
						$comp_id=$result['comp_id'];
						$CI->db->select('id,p_id,comp_name,user_id');
						$childcname=$CI->db->get_where("company_registration",array("id" => $comp_id, "user_id" => $userid, "status" => '1'));
						if($childcname->num_rows())
						{						
							$childcname = $childcname->row();
							$data[$i]['user_id']=$childcname->user_id;
							$data[$i]['comp_id']=$childcname->id;
							$data[$i]['actve_cnam']='subcompany';
							if($childcname->p_id){
								$data[$i]['actve_cnam']='company';
							}
							$data[$i]['comp_name']=$childcname->comp_name;
							$i++;
						}
					}
				}
			}
			return $data;
		}
	}
//=================Close Company and Subcompany data=====================================//
//====================name againt id=======================================//
	/** Added by::: Sumit :::
* given table row data
* Against comp id and user id.
* @param string $uri The URI path
* _is_valid_name_againid()
* @return if comp name against ID*/
	if ( ! function_exists('_is_valid_name_againid')) {
		function _is_valid_name_againid($cid=NULL, $table=NULL, $fields=NULL) {
			if(!is_null($cid) && !empty($table)) {
				if($table=='user'){
					$CI =& get_instance();
					$comp_name = null;
					$cid_arr = explode(",",$cid);
					foreach($cid_arr as $keys => $vals){
						$CI->db->select($fields);
						$childcomp=$CI->db->get_where($table,array("user_id" => $vals, "status" => 1))->row();
						if(!empty($childcomp)) {
							$comp_name .= '<p>'.$childcomp->$fields.'</p>';
						}
					}
				} else {
					$CI =& get_instance();
					$comp_name = null;
					$cid_arr = explode(",",$cid);
					foreach($cid_arr as $keys => $vals){
						$CI->db->select($fields);
						$childcomp=$CI->db->get_where($table,array("user_id" => $vals, "status" => '1'))->row();
						if(!empty($childcomp)) {
							$comp_name .= $childcomp->$fields;
						}
					}
				}
				
				return $comp_name;
			}
			 return false;
		}
	}
//=================Close Name Against Id====================================//
//=================Rows information data=====================================//
/** Added by::: Sumit :::
* given table row data
* Against comp id and user id.
* @param string $uri The URI path
* _is_tbl_rowdata()
* @return if company and subcompany info*/
	if ( ! function_exists('_is_tbl_rowdata')) {
		function _is_tbl_rowdata($c_id=NULL, $user_id=NULL, $table=NULL, $fields=NULL) {
			$data=array();
            $CI =& get_instance();
            mysql_select_db($CI->db->database);
			if(!empty($c_id) && !empty($user_id) && !empty($table) && !empty($fields)) {
				$CI->db->select($fields);
				$childcomp=$CI->db->get_where($table,array("comp_id" => $c_id, "user_id" => $user_id, "status" => '1'))->row();
				if(!empty($childcomp)) {
					return $childcomp->$fields;
				}
			}
			 return false;
		}
	}
//=================Close Rows information data=====================================//
//================Multiple get catnm desgnm deptnm loca list====================//
if ( ! function_exists('_multiget_catnm_desgnm_deptnm')) { 
	function _multiget_catnm_desgnm_deptnm($id=NULL,$param=NULL) {
		if(!empty($id)) {
			$CI =& get_instance();
			if($param=='cat') {
				$id =  explode(',',$id);
				$list='';
				foreach($id as $val) {
					$data=$CI->db->select('cat_name')->where(array('id'=>$val, 'status' => 1))->get('company_category_master')->row();
					$list .=ucfirst($data->cat_name).',';
				}
				$datalist = substr_replace($list, "", -1);
				return $datalist;
				
			} else if ($param=='dept') {
				$id =  explode(',',$id);
				$list='';
				foreach($id as $val) {
					$data=$CI->db->select('dept_name')->where(array('id'=>$val, 'status' => 1))->get('company_department_master')->row();
					$list .=ucfirst($data->dept_name).',';
				}
				$datalist = substr_replace($list, "", -1);
				return $datalist;
			} else if($param=='desg') {
				$id =  explode(',',$id);
				$list='';
				foreach($id as $val) {
					$data=$CI->db->select('desg_name')->where(array('id'=>$val, 'status' => 1))->get('company_designation_master')->row();
					$list .=ucfirst($data->desg_name).',';
				}
				$datalist = substr_replace($list, "", -1);
				return $datalist;
			} else if($param=='grade') {
				$id =  explode(',',$id);
				$list='';
				foreach($id as $val) {
					$data=$CI->db->select('grade_name,level')->where(array('id'=>$val, 'status' => 1))->get('grade_master')->row();
					$list .=ucfirst($data->grade_name).',';
				}
				$datalist = substr_replace($list, "", -1);
				return $datalist;
			} else if($param=='loc') {
				$id =  explode(',',$id);
				$list='';
				foreach($id as $val){
					$data=$CI->db->select('loc_name')->where(array('id'=>$val, 'status' => 1))->get('company_location')->row();
					$list .=ucfirst($data->loc_name).',';
				}
				$datalist = substr_replace($list, "", -1);
				return $datalist;
			}
			else if($param=='relg') {
				$id =  explode(',',$id);
				$list='';
				$relg_array=array('1' => 'Hindu', '2' => 'Muslim', '3' => 'Christian');
				foreach($id as $val){
					
					$list .=ucfirst($relg_array[$val]).',';
				}
				$datalist = substr_replace($list, "", -1);
				return $datalist;
			}
		}
		return FALSE;
	}  
}
//================Multiple get catnm desgnm deptnm loca list====================//

//==========================Monthly Holidays list=================================//
/* Calculates all Holiday list 
* Against given company and user id and employee
* @param string $uri The URI path
* _monthly_holidays()
* @return if company or employee is login
*/
if ( ! function_exists('_monthly_holidays')) {
    function _monthly_holidays($c_id=NULL, $u_id=NULL, $todate=FALSE, $empid=FALSE, $location=FALSE, $cat_id=FALSE, $dept_id=FALSE, $desg_id=FALSE) {
		$data=array();
		if(!empty($c_id) && !empty($u_id) && !empty($todate)) {
			$CI =& get_instance();
			$CI->db->select('id,hm_location');
			$todate_arr=explode('-',$todate);
			$exp_yy='-'.$todate_arr[1].'-'.$todate_arr[2];
			$week=week_of_month($todate);
			$day_list=date('N',strtotime($todate));
			/*$isholiday=$CI->db->get_where("company_holidays_master",array("comp_id"=>$c_id, "user_id"=>$u_id, "hm_type" => '1', "hm_date" => $todate,  "status"=>1));*/
			$CI->db->where(array('comp_id'=>$c_id, 'user_id' => $u_id, 'hm_type' => '1',  'status' => '1'))->where("((`hm_date` = '$todate')")->or_where("(`periodicity_holiday` = '1' AND day(`hm_date`) = '$todate_arr[2]' and MONTH(`hm_date`) = '$todate_arr[1]')")->or_where("(`periodicity_holiday` = '2' and	`month` = '$todate_arr[1]' and `week_list` = '$week' and `day_list` = '$day_list'))");
            $isholiday = $CI->db->get("company_holidays_master");
			//echo $CI->db->last_query(); exit;
			if($isholiday->num_rows() > 0) {
				//$CI->db->select('id,is_half_day');
				/*$is_compholiday=$CI->db->get_where("company_holidays_master",array("comp_id"=>$c_id, "user_id"=>$u_id, "hm_type" => '1', "hm_date" => $todate, "hm_is_app" => '1',  "status"=>1));*/
				$CI->db->select('id,is_half_day');
				$CI->db->where(array('comp_id'=>$c_id, 'user_id' => $u_id, 'hm_type' => '1', 'hm_is_app' => '1', 'status' => '1'))->where("((`hm_date` = '$todate')")->or_where("(`periodicity_holiday` = '1' AND day(`hm_date`) = '$todate_arr[2]' and MONTH(`hm_date`) = '$todate_arr[1]')")->or_where("(`periodicity_holiday` = '2' and	`month` = '$todate_arr[1]' and `week_list` = '$week' and `day_list` = '$day_list'))");
				$is_compholiday = $CI->db->get("company_holidays_master");
                //echo $CI->db->last_query(); exit;
				if($is_compholiday->num_rows() > 0) {
					if($is_compholiday->row()->is_half_day){
						return 2;
					} else {
						return 1;
					}
				}
				else {
					$CI->db->select('hm_group,cat,dept,desg,relg,is_half_day');
					$CI->db->where("FIND_IN_SET('$location',hm_location) !=", 0);
					/*$is_empholiday=$CI->db->get_where("company_holidays_master",array("comp_id"=>$c_id, "user_id"=>$u_id, "hm_type" => '1', "hm_date" => $todate, "hm_is_app" => '2',  "status"=>1))->row();*/
					$CI->db->where(array('comp_id'=>$c_id, 'user_id' => $u_id, 'hm_type' => '1', 'hm_is_app' => '2', 'status' => '1'))->where("((`hm_date` = '$todate')")->or_where("(`periodicity_holiday` = '1' AND day(`hm_date`) = '$todate_arr[2]' and MONTH(`hm_date`) = '$todate_arr[1]')")->or_where("(`periodicity_holiday` = '2' and	`month` = '$todate_arr[1]' and `week_list` = '$week' and `day_list` = '$day_list'))");
					$is_empholiday = $CI->db->get("company_holidays_master")->row();
					
					if($is_empholiday) {
						if($is_empholiday->hm_group){
							if($is_empholiday->hm_group==1){
								if(isset($is_empholiday->cat) && !empty($is_empholiday->cat)){
									$empcat = explode(',', $is_empholiday->cat);
									if(in_array($cat_id,$empcat)){
										if($is_empholiday->is_half_day){
											return 2;
										} else {
											return 1;
										}
									} else {
										return false;
									}
								} else {
									if($is_empholiday->is_half_day){
											return 2;
										} else {
											return 1;
										}
								}

							} else if($is_empholiday->hm_group==2){
								if(isset($is_empholiday->dept) && !empty($is_empholiday->dept)){
									$empdpt = explode(',', $is_empholiday->dept);
									if(in_array($dept_id,$empdpt)){
										if($is_empholiday->is_half_day){
											return 2;
										} else {
											return 1;
										}
									} else {
										return false;
									}
								} else {
									if($is_empholiday->is_half_day) {
										return 2;
									} else {
										return 1;
									}
								}

							} else if($is_empholiday->hm_group==3){
								if(isset($is_empholiday->desg) && !empty($is_empholiday->desg)){
									$empdsg = explode(',', $is_empholiday->desg);
									if(in_array($desg_id,$empdsg)){
										if($is_empholiday->is_half_day) {
											return 2;
										} else {
											return 1;
										}
									} else {
										return false;
									}
								} else {
									if($is_empholiday->is_half_day) {
										return 2;
									} else {
										return 1;
									}
								}


							} else if($is_empholiday->hm_group==4){
								$CI->db->select('religion');
								$isemp_relg=$CI->db->get_where("emp_personal_details",array("comp_id"=>$c_id, "user_id"=>$u_id, "emp_id" => $empid, "status"=>1))->row();
								if($isemp_relg->religion){
									$emprelg = explode(',', $is_empholiday->relg);
									if(in_array($isemp_relg->religion,$emprelg)){
										if($is_empholiday->is_half_day) {
											return 2;
										} else {
											return 1;
										}
									}
								} else{
									return false;
								}
							}
						} else {
							if($is_empholiday->is_half_day){
								return 2;
							} else {
								return 1;
							}
						}
					} else {
						return false;
					}
				}
			}
			else{
				return false;
			}
			
		}
		return false;
	}
 }

//===============================Week Of Month===================================//
	function week_of_month($date) {
		$date_parts = explode('-', $date);
		$year=$date_parts[0];
		$month=$date_parts[1];
		$day=$date_parts[2];
		return ceil(($day + date("w",mktime(0,0,0,$month,1,$year)))/7);
	}

//==========================Close Week Of Month=====================================//

//========================find Week of the month=================================//
function _day_from_date($date = null)
{
	return date('d', strtotime($date));
}
//========================frequency of the day by passing only date not having month & year=================================//
function _frequency_of_day($date = null)
{
	if($date >= 1 && $date < 8)
	{
		$frequency = 1;
	}
	elseif($date >= 8 && $date < 15)
	{
		$frequency = 2;
	}
	elseif($date >= 15 && $date < 22)
	{
		$frequency = 3;
	}
	elseif($date >= 22 && $date < 29)
	{
		$frequency = 4;
	}
	else
	{
		$frequency = 5;
	}
	return $frequency; 
}
//========================find Week of the month=================================//
function _week_of_month($date = null)
{
	$firstDateOfMnth = substr($date, 0, -2).'01';
	$fdayOfWeek = date('w', strtotime($firstDateOfMnth));
	$remDays = 7 - $fdayOfWeek;
	$firstWeekEndDate = $fdayOfWeek == 0 ? 7 : $remDays;
	
	$date = substr($date, 8, 10);
	
	if($date >= 1 AND $date <= $firstWeekEndDate){
		$frequency = 1;
	} else if($date > $firstWeekEndDate AND $date <= ($firstWeekEndDate + 7)){
		$frequency = 2;
	} else if($date > ($firstWeekEndDate + 7) AND $date <= ($firstWeekEndDate + 14)){
		$frequency = 3;
	} else if($date > ($firstWeekEndDate + 14) AND $date <= ($firstWeekEndDate + 21)){
		$frequency = 4;
	} else {
		$frequency = 5;
	}
	return $frequency; //which week of the month	
}
//========================close find Week of the month=================================//

//========================Close Monthly Holidays list=================================//

//==========================Fetch Weekoff Setup type From Attendance Settings=================================//
if ( ! function_exists('_weekOffSetupType')) {
    function _weekOffSetupType($comp_id=NULL, $user_id=NULL, $location_id=NULL) {
		$data=array();
		$CI =& get_instance();
		$leavfor=$CI->db->select('weekoffs_common')->where_in('location_id', array(0, $location_id))->get_where("attendance_settings", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
	   if($leavfor->num_rows()){
			return $leavfor->row()->weekoffs_common;
		}
		return 0;
	}
}
//==========================Fetch Weekoff Setup type to show in Attendance=================================//
if ( ! function_exists('_weekOffSetupTypeAuto')) {
    function _weekOffSetupTypeAuto($comp_id=NULL, $user_id=NULL) {
		$data=array();
		$CI =& get_instance();
		$leavfor=$CI->db->select('location_id, weekoffs_common')->get_where("attendance_settings", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
	   if($leavfor->num_rows())
	   {
			foreach($leavfor->result() as $rec)
			{
				$data[$rec->location_id] = $rec->weekoffs_common; 	
			}
		}
		return $data;
	}
}
//==========================Weekoff list=================================//
/* Calculates all Weekoff list 
* Against given company and user id and employee
* @param string $uri The URI path
* _is_weekoff()
* @return if company or employee is login
*/
if ( ! function_exists('_is_weekoff')) {
    function _is_weekoff($comp_id=NULL, $user_id=NULL, $day_names=FALSE, $frequency=FALSE, $location_id=FALSE, $cat_id=FALSE, $dept_id=FALSE, $desg_id=FALSE, $weekOffSetupType = null) {
		$data=array();
		if(!empty($comp_id) && !empty($user_id) && !empty($day_names) && !empty($frequency)) 
		{
			$CI =& get_instance();
			
			$CI->db->select('type');
			$CI->db->where_in('location_id', array(0, $location_id));	
			switch($weekOffSetupType)
			{
				case 1 : $CI->db->where_in('cat_id', array(0, $cat_id));
				break;
				case 2 : $CI->db->where_in('dept_id', array(0, $dept_id));
				break;
				case 3 : $CI->db->where_in('desg_id', array(0, $desg_id));
				break;
				case 4 : $CI->db->where('cat_id', '');
						 $CI->db->where('dept_id', '');	
						 $CI->db->where('desg_id', '');
				break;
			}
			
			$is_compweekoff=$CI->db->get_where("weekoffs_setup",array("emp_id"=> 0, "comp_id"=>$comp_id, "user_id"=>$user_id, "day_names" => $day_names, "frequency" => $frequency, "status"=>1));
			//echo $CI->db->last_query().'we='.$weekOffSetupType.'<br>';			
			if($is_compweekoff->num_rows()) 
			{ 
				return $is_compweekoff->row()->type;
			}
		}
		return false;
	}
 }
//----------------------------------------------------------------------------------//
function _getAllWeekoffs($comp_id, $user_id){  
	$data = array();
	$CI = &get_instance();
	$qry = $CI->db->get_where('weekoffs_setup', array('comp_id' => $comp_id, 'user_id' => $user_id, 'status' => '1', 'emp_id' => 0));	
	if($qry->num_rows())
	{
		$i = 0;
		foreach($qry->result() as $rec)
		{
			if($rec->cat_id == '' && $rec->dept_id == '' && $rec->desg_id == '')
			{
				$data['location_id'][$rec->location_id][$rec->day_names][$rec->frequency] = $rec->type;		
			}
			else
			{
				if($rec->cat_id != '')
				{
					$data['cat_id'][$rec->location_id][$rec->cat_id][$rec->day_names][$rec->frequency] = $rec->type;
				}
				if($rec->dept_id != '')
				{
					$data['dept_id'][$rec->location_id][$rec->dept_id][$rec->day_names][$rec->frequency] = $rec->type;
				}
				if($rec->desg_id != '')
				{
					$data['desg_id'][$rec->location_id][$rec->desg_id][$rec->day_names][$rec->frequency] = $rec->type;
				}
			}
		}
	}
	//pr($data); 
	return $data;
}
//----------------------------------------------------------------------------------//
function _getAllWeekoffsAuto($comp_id, $user_id){  
	$data = array();
	$CI = &get_instance();
	$qry = $CI->db->get_where('weekoffs_setup', array('comp_id' => $comp_id, 'user_id' => $user_id, 'status' => '1'));	
	if($qry->num_rows())
	{
		$i = 0;
		$data['emp_id'] = array();
		foreach($qry->result() as $rec)
		{
			if($rec->emp_id)
			{
				if(!is_null($rec->effective_date))
				{
					$data['emp_id'][$rec->emp_id][$rec->effective_date] = $rec->type;		
				}
				else
				{
					$data['emp_id'][$rec->emp_id][$rec->day_names][$rec->frequency] = $rec->type;				
				}
			}
			
			if($rec->cat_id == '' && $rec->dept_id == '' && $rec->desg_id == '')
			{
				$data['location_id'][$rec->location_id][$rec->day_names][$rec->frequency] = $rec->type;		
			}
			else
			{
				if($rec->cat_id != '')
				{
					$data['cat_id'][$rec->location_id][$rec->cat_id][$rec->day_names][$rec->frequency] = $rec->type;
				}
				if($rec->dept_id != '')
				{
					$data['dept_id'][$rec->location_id][$rec->dept_id][$rec->day_names][$rec->frequency] = $rec->type;
				}
				if($rec->desg_id != '')
				{
					$data['desg_id'][$rec->location_id][$rec->desg_id][$rec->day_names][$rec->frequency] = $rec->type;
				}
			}
		}
	}
	//pr($data); 
	return $data;
}
//========================fetch Marked Attendance=================================//
 function _getMarkedLeaveOnDate($comp_id=NULL, $user_id=NULL, $emp_id = null, $att_date = null){
		
		$CI = &get_instance();
		$lvs = $CI->db->select('balance, leave_id')->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'att_date' => $att_date, 'type' => 0, 'status !='=>0));
		$data['lrows'] = $lvs->num_rows();
		if($data['lrows'])
		{
			/*$info = $lvs->row();
			if($info->balance == 1)
			{
				$data['leave_id'] = $info->leave_id;
			}
			else
			{
				$data['leave_id'] = $info->leave_id;
				$i = 0;
				foreach($lvs->result() as $rec)
				{
					if($i)
					{
						if($data['leave_id'] != $rec->leave_id)
						{
							$data['leave_id'] = null;
						}		
					}
					$i++;
				}
				if($i == 1)
				{
					$data['leave_id'] = null;
				}	
			}*/
			$data['balance'] = 0;
			foreach($lvs->result() as $rec)
			{
				$data['balance'] += $rec->balance;
			}
		}
		return $data;
}
//========================fetch Marked Attendance=================================//
 function _getMarkedAttendanceInEdit($comp_id=NULL, $user_id=NULL, $emp_id = null, $att_date = null, $dateVal, $dtclr, $showclr, $show, $topHalf, $bottomHalf, $isAutomated = false){
		
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'att_date' => $att_date, 'status !='=>0));
		$data['lrows'] = $lvs->num_rows();
		$pre = null;
		if($data['lrows'])
		{
			$info = $lvs->row();
			$data['balance'] = $info->balance;
			$data['is_weekoff'] = $info->is_weekoff;
			$data['half_holiday'] = $info->half_holiday;
			$data['type'] = $info->type;
			$data['is_adjusted'] = $info->is_adjusted;
			//$show = (($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0) || $data['type']) ? 'P' : 'A';
			
			if($isAutomated)
			{
				$show = 'A';
				$txtcolor = '#fff';	
				if($data['is_adjusted'])// if leave has been adjusted through late comings n early leavings during processing then 1st that leave will be showing with the leave color on that date with P 
				{
					$show = 'P';	
				}
				else
				{
					if(($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0) || $data['type'])//in case of half day leave or compoff wrking, check if the emp was present on that date
					{
						$checkAttQry = $CI->db->select('id')->get_where("auto_emp_attendance", array('emp_id' => $emp_id, 'created_date' => $att_date,  'parent_id' => 0, 'status' => 1));
						if($checkAttQry->num_rows()) //check if the emp was present on that date, In case of compoff wrking Emp will always be present in automated otherwise the default(weekoff or holiday will be showing)
						{	
							$show = $data['type'] ? 'CW' : 'P';
						}
						$txtcolor = '#555555';	
					}	
				}
			}
			else //Manual Attendance
			{
				$show =  $data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0 ? 'P' : 'A';
				
				if($data['type'])
				{
					$show = 'CW';
				}	
			}
			
			$cls = 'mark-half-1';
			$pre = '<div class="weekdate weekhover">
						<span class="GridRelative">';
			$i = 0;
			foreach($lvs->result() as $rec)
			{
				if($rec->leave_id)
				{
					$lqry =  $CI->db->select('color_code')->get_where('setup_leave_policy', array('id' => $rec->leave_id, "comp_id" => $comp_id, "user_id" => $user_id))->row();
					$clrcd = $lqry->color_code;
				}
				else
				{
					$clrcd = '#666666';
				}
				if($i == 1)
				{
					$cls = 'mark-half-2';
				}
				$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.'; color:#fff;"></div>';
				$i++;
			}
				if($i == 1)
				{
					//$clrcd = ($data['balance'] == 1) ? $clrcd : 'white';
					if($data['balance'] == 1)
					{
						$clrcd = $clrcd;
						$showclr = 'white';
					}
					else
					{
						$clrcd = 'white';
						$showclr = 'black';
					}
					
					if($data['half_holiday'] == 2)
					{
						$clrcd = '#006600';
						$showclr = 'black';
					}
					$pre .= '<div class="mark-half-2" style="background:'.$clrcd.';"></div>';
				}
				elseif($i == 2)
				{
					$showclr = 'white';
				}
				$pre .= '<span class="mark-absolute">
							<a href="#" style="color:white;" data-id="deleteLeaveId" data-value="'.$att_date.'">'.$dateVal.'<span class="play1">Remove </span></a>
						</span>
						<span class="mark-absolute-w" style="color:'.$showclr.'">'.$show.'</span>
					   </span>
					</div>';
		}
		else
		{
			$pre .= '<div class="weekdate weekhover"><span class="GridRelative"><div class="mark-half-1" style="background:'.$topHalf.'"></div><div class="mark-half-2" style="background:'.$bottomHalf.'"></div><span class="mark-absolute" style="color:'.$dtclr.'">'.$dateVal.'</span><span class="mark-absolute-w" style="color:'.$showclr.'">'.$show.'</span></span></div>';
		}
		return $pre;      
}
//========================fetch Marked Attendance=================================//
function _getAllLeavePolicies($comp_id=NULL, $user_id=NULL){
		$data = array();
		$CI = &get_instance();
		$lqry = $CI->db->select('id, short_name, color_code')->get_where('setup_leave_policy', array("comp_id" => $comp_id, "user_id" => $user_id)); 	
		if($lqry->num_rows())
		{
			foreach($lqry->result() as $rec)
			{
				$data['short_name'][$rec->id] = $rec->short_name; 		
				$data['color_code'][$rec->id] = $rec->color_code; 		
			}
		}
	return $data;	
}	
//========================fetch Marked Attendance=================================//
 function _getMarkedAttendance($comp_id=NULL, $user_id=NULL, $emp_id = null, $att_date = null, $compAllLeavePolicies = array(), $isAutomated = false){
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'att_date' => $att_date, 'status !='=>0));
		$data['lrows'] = $lvs->num_rows();
		$pre = null;
		if($data['lrows'])
		{
			$info = $lvs->row();
			$data['balance'] = $info->balance;
			$data['is_weekoff'] = $info->is_weekoff;
			$data['half_holiday'] = $info->half_holiday;
			$data['type'] = $info->type;
			$data['is_adjusted'] = $info->is_adjusted;
			
			$show = 'A';
			$txtcolor = '#fff';	
			if($isAutomated)
			{
				if($data['is_adjusted'])// if leave has been adjusted through late comings n early leavings during processing then 1st that leave will be showing with the leave color on that date with P
				{
					$show = 'P';
				}
				else
				{
					if(($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0) || $data['type'])//in case of half day leave or compoff wrking, check if the emp was present on that date
					{
						$checkAttQry = $CI->db->select('id')->get_where("auto_emp_attendance", array('emp_id' => $emp_id, 'created_date' => $att_date,  'parent_id' => 0, 'status' => 1));
						if($checkAttQry->num_rows()) //check if the emp was present on that date
						{	
							$show = 'P';
						}
						$txtcolor = '#555555';	
					}	
				}
			}
			else //Manual Attendance
			{
				$show = ($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0) || $data['type'] ? 'P' : 'A';		
			}
			
			$cls = 'half-full-top';
			$pre = '<span><div class="GridRelativeAttendance">
						<div class="half-full-absolute" style="cursor:pointer; color:'.$txtcolor.'">'.$show.'</div>';
			$i = 0;
			foreach($lvs->result() as $rec)
			{
				if($rec->leave_id)
				{
					$clrcd = $compAllLeavePolicies['color_code'][$rec->leave_id];
				}
				else
				{
					$clrcd = '#666666';
				}
				if($i == 1)
				{
					$cls = 'half-full-bottom';
				}
				$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.';"></div>';
				$i++;
			}
				if($i == 1)
				{
					$clrcd = ($data['balance'] == 1) ? $clrcd : '#e6e6e6';
					if($data['half_holiday'] == 2)
					{
						$clrcd = '#006600';
					}
					$pre .= '<div class="half-full-bottom" style="background:'.$clrcd.'; color:#fff;"></div>';
				}
						
				$pre .= '</div></span>';
		}
		return $pre;      
}
//========================fetch Marked Attendance in Manual=================================//
 function _getMarkedAttendanceManual($comp_id=NULL, $user_id=NULL, $year = null, $month = null, $compAllLeavePolicies = array()){
		$data1 = $data = array();
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'month(att_date)' => $month, 'year(att_date)' => $year, 'status !='=>0)); //fetches the leaves of all the emps for that month
		$data1['lrows'] = $lvs->num_rows(); 
		if($data1['lrows'])
		{
			foreach($lvs->result() AS $lrec)
			{
				$data['emp_id'][] = $lrec->emp_id;
				$data[$lrec->emp_id]['att_date'][] = $lrec->att_date;
				$data[$lrec->emp_id]['leave_id'][$lrec->att_date][] = $lrec->leave_id;	
				$data[$lrec->emp_id]['balance'][$lrec->att_date][$lrec->leave_id] = $lrec->balance;	
				$data[$lrec->emp_id]['is_weekoff'][$lrec->att_date][$lrec->leave_id] = $lrec->is_weekoff;	
				$data[$lrec->emp_id]['half_holiday'][$lrec->att_date][$lrec->leave_id] = $lrec->half_holiday;	
				$data[$lrec->emp_id]['type'][$lrec->att_date][$lrec->leave_id] = $lrec->type;	
			}
			$data['emp_id'] = array_unique($data['emp_id']);
			foreach($data['emp_id'] AS $empid)
			{
				foreach($data[$empid]['att_date'] AS $attdate)
				{	
					$show = ((sizeof($data[$empid]['leave_id'][$attdate]) == 1 && $data[$empid]['balance'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0.5 && $data[$empid]['is_weekoff'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0 && $data[$empid]['half_holiday'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0) || $data[$empid]['type'][$attdate][$data[$empid]['leave_id'][$attdate][0]]) ? 'P' : 'A';
					$cls = 'half-full-top';
					$pre = '<span><div class="GridRelativeAttendance">
								<div class="half-full-absolute" style="cursor:pointer;">'.$show.'</div>';
					$i = 0;
					foreach($data[$empid]['leave_id'][$attdate]  as $lid)
					{
						$clrcd = $lid ? $compAllLeavePolicies['color_code'][$lid] : '#666666';
						
						if($i == 1)
						{
							$cls = 'half-full-bottom';
						}
						$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.'; color:#fff;"></div>';
						$i++;
					}
						if($i == 1)
						{
							$clrcd = ($data[$empid]['balance'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 1) ? $clrcd : '#e6e6e6';
							if($data[$empid]['half_holiday'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 2)
							{
								$clrcd = '#006600';
							}
							$pre .= '<div class="half-full-bottom" style="background:'.$clrcd.'; color:#fff;"></div>';
						}
						$pre .= '</div></span>';
					$data1['lDiv'][$empid][$attdate] = $pre;
				}
			}
		}
		//pr($data1); 
		return $data1;      
}
//========================fetch Marked Attendance=================================//
 function _getMarkedAttendanceAuto($comp_id=NULL, $user_id=NULL, $year = null, $month = null, $compAllLeavePolicies = array()){
		$data1 = $data = array();
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'month(att_date)' => $month, 'year(att_date)' => $year, 'status !='=>0)); //fetches the leaves of all the emps for that month
		$data1['lrows'] = $lvs->num_rows(); 
		if($data1['lrows'])
		{
			foreach($lvs->result() AS $lrec)
			{
				$data['emp_id'][] = $lrec->emp_id;
				$data[$lrec->emp_id]['att_date'][] = $lrec->att_date;
				$data[$lrec->emp_id]['leave_id'][$lrec->att_date][] = $lrec->leave_id;	
				$data[$lrec->emp_id]['balance'][$lrec->att_date][$lrec->leave_id] = $lrec->balance;	
				$data[$lrec->emp_id]['is_weekoff'][$lrec->att_date][$lrec->leave_id] = $lrec->is_weekoff;	
				$data[$lrec->emp_id]['half_holiday'][$lrec->att_date][$lrec->leave_id] = $lrec->half_holiday;	
				$data[$lrec->emp_id]['type'][$lrec->att_date][$lrec->leave_id] = $lrec->type;	
				$data[$lrec->emp_id]['is_adjusted'][$lrec->att_date] = $lrec->is_adjusted;	
			}
			$data['emp_id'] = array_unique($data['emp_id']);
			foreach($data['emp_id'] AS $empid)
			{
				foreach($data[$empid]['att_date'] AS $attdate)
				{	
					$txtcolor = '#fff';		
					$show = 'A';
					if($data[$empid]['is_adjusted'][$attdate] == 1)// if leave has been adjusted through late comings n early leavings during processing then 1st that leave will be showing with the leave color on that date with P
					{
						$show = 'P';
					}
					else
					{
						if((sizeof($data[$empid]['leave_id'][$attdate]) == 1 && $data[$empid]['balance'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0.5 && $data[$empid]['is_weekoff'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0 && $data[$empid]['half_holiday'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0) || $data[$empid]['type'][$attdate][$data[$empid]['leave_id'][$attdate][0]]) //in case of half day leave or compoff wrking, check if the emp was present on that date
						{
							$checkAttQry = $CI->db->select('id')->get_where("auto_emp_attendance", array('emp_id' => $empid, 'created_date' => $attdate,  'parent_id' => 0, 'status' => 1));
							if($checkAttQry->num_rows()) //check if the emp was present on that date
							{	
								$show = 'P';
							}
							$txtcolor = $data[$empid]['type'][$attdate][$data[$empid]['leave_id'][$attdate][0]] ? '#fff' : '#555555';		
						}
					}
					
					$cls = 'half-full-top';
					$pre = '<span><div class="GridRelativeAttendance">
								<div class="half-full-absolute" style="cursor:pointer; color:'.$txtcolor.';">'.$show.'</div>';
					$i = 0;
					foreach($data[$empid]['leave_id'][$attdate]  as $lid)
					{
						$clrcd = $lid ? $compAllLeavePolicies['color_code'][$lid] : '#666666';
						
						if($i == 1)
						{
							$cls = 'half-full-bottom';
						}
						$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.';"></div>';
						$i++;
					}
						if($i == 1)
						{
							$clrcd = ($data[$empid]['balance'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 1) ? $clrcd : '#e6e6e6';
							if($data[$empid]['half_holiday'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 2)
							{
								$clrcd = '#006600';
							}
							$pre .= '<div class="half-full-bottom" style="background:'.$clrcd.'; color:#fff;"></div>';
						}
						$pre .= '</div></span>';
					$data1['lDiv'][$empid][$attdate] = $pre;
				}
			}
		}
		//pr($data1); 
		return $data1;      
}
//=============================Employee marke Attendance=========================================//
if(!function_exists('_getMarkedEmpAttendanceAuto')) {
    function _getMarkedEmpAttendanceAuto($comp_id=NULL, $user_id=NULL, $emp_id = null, $year = null, $month = null, $compAllLeavePolicies = array()){
    		$data1 = $data = array();
    		$CI = &get_instance();
    		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'month(att_date)' => $month, 'year(att_date)' => $year, 'status !='=>0)); //fetches the leaves of all the emps for that month
    		$data1['lrows'] = $lvs->num_rows(); 
    		if($data1['lrows'])
    		{
    			foreach($lvs->result() AS $lrec)
    			{
    				$data['emp_id'][] = $lrec->emp_id;
    				$data[$lrec->emp_id]['att_date'][] = $lrec->att_date;
    				$data[$lrec->emp_id]['leave_id'][$lrec->att_date][] = $lrec->leave_id;	
    				$data[$lrec->emp_id]['balance'][$lrec->att_date][$lrec->leave_id] = $lrec->balance;	
    				$data[$lrec->emp_id]['is_weekoff'][$lrec->att_date][$lrec->leave_id] = $lrec->is_weekoff;	
    				$data[$lrec->emp_id]['half_holiday'][$lrec->att_date][$lrec->leave_id] = $lrec->half_holiday;	
    				$data[$lrec->emp_id]['type'][$lrec->att_date][$lrec->leave_id] = $lrec->type;	
    				$data[$lrec->emp_id]['is_adjusted'][$lrec->att_date] = $lrec->is_adjusted;	
    			}
    			$data['emp_id'] = array_unique($data['emp_id']);
    			foreach($data['emp_id'] AS $empid)
    			{
    				foreach($data[$empid]['att_date'] AS $attdate)
    				{	
    					$txtcolor = '#fff';		
    					$show = 'A';
    					if($data[$empid]['is_adjusted'][$attdate] == 1)// if leave has been adjusted through late comings n early leavings during processing then 1st that leave will be showing with the leave color on that date with P
    					{
    						$show = 'P';
    					}
    					else
    					{
    						if((sizeof($data[$empid]['leave_id'][$attdate]) == 1 && $data[$empid]['balance'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0.5 && $data[$empid]['is_weekoff'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0 && $data[$empid]['half_holiday'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 0) || $data[$empid]['type'][$attdate][$data[$empid]['leave_id'][$attdate][0]]) //in case of half day leave or compoff wrking, check if the emp was present on that date
    						{
    							$checkAttQry = $CI->db->select('id')->get_where("auto_emp_attendance", array('emp_id' => $empid, 'created_date' => $attdate,  'parent_id' => 0, 'status' => 1));
    							if($checkAttQry->num_rows()) //check if the emp was present on that date
    							{	
    								$show = 'P';
    							}
    							$txtcolor = $data[$empid]['type'][$attdate][$data[$empid]['leave_id'][$attdate][0]] ? '#fff' : '#555555';		
    						}
    					}
    					
    					$cls = 'half-full-top';
    					$pre = '<span><div class="GridRelativeAttendance">
    								<div class="half-full-absolute" style="cursor:pointer; color:'.$txtcolor.';">'.$show.'</div>';
    					$i = 0;
    					foreach($data[$empid]['leave_id'][$attdate]  as $lid)
    					{
    						$clrcd = $lid ? $compAllLeavePolicies['color_code'][$lid] : '#666666';
    						
    						if($i == 1)
    						{
    							$cls = 'half-full-bottom';
    						}
    						$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.';"></div>';
    						$i++;
    					}
    						if($i == 1)
    						{
    							$clrcd = ($data[$empid]['balance'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 1) ? $clrcd : '#e6e6e6';
    							if($data[$empid]['half_holiday'][$attdate][$data[$empid]['leave_id'][$attdate][0]] == 2)
    							{
    								$clrcd = '#006600';
    							}
    							$pre .= '<div class="half-full-bottom" style="background:'.$clrcd.'; color:#fff;"></div>';
    						}
    						$pre .= '</div></span>';
    					$data1['lDiv'][$empid][$attdate] = $pre;
    				}
    			}
    		}
    		//pr($data1); 
    		return $data1;      
    }
}
//=============================Employee marke Attendance=========================================// 
//========================fetch Marked Attendance=================================//
 function _getMarkedAttendanceAutoOLD($comp_id=NULL, $user_id=NULL, $emp_id = null, $year = null, $month = null, $compAllLeavePolicies = array()){
		$data1 = $data = array();
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'month(att_date)' => $month, 'year(att_date)' => $year, 'status !='=>0));
		$data['lrows'] = $lvs->num_rows(); 
		if($data['lrows'])
		{
			foreach($lvs->result() AS $lrec)
			{
				$data['att_date'][] = $lrec->att_date;
				$data['leave_id'][$lrec->att_date][] = $lrec->leave_id;	
				$data['balance'][$lrec->att_date][$lrec->leave_id] = $lrec->balance;	
				$data['is_weekoff'][$lrec->att_date][$lrec->leave_id] = $lrec->is_weekoff;	
				$data['half_holiday'][$lrec->att_date][$lrec->leave_id] = $lrec->half_holiday;	
				$data['type'][$lrec->att_date][$lrec->leave_id] = $lrec->type;	
			}
			//pr($data);	
			foreach($data['att_date'] AS $attdate)
			{	
				$show = ((sizeof($data['leave_id'][$attdate]) == 1 && $data['balance'][$attdate][$data['leave_id'][$attdate][0]] == 0.5 && $data['is_weekoff'][$attdate][$data['leave_id'][$attdate][0]] == 0 && $data['half_holiday'][$attdate][$data['leave_id'][$attdate][0]] == 0) || $data['type'][$attdate][$data['leave_id'][$attdate][0]]) ? 'P' : 'A';
				$cls = 'half-full-top';
				$pre = '<span><div class="GridRelative">
							<div class="half-full-absolute" style="cursor:pointer;">'.$show.'</div>';
				$i = 0;
				foreach($data['leave_id'][$attdate]  as $lid)
				{
					$clrcd = $lid ? $compAllLeavePolicies['color_code'][$lid] : '#666666';
					
					if($i == 1)
					{
						$cls = 'half-full-bottom';
					}
					$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.'; color:#fff;"></div>';
					$i++;
				}
					if($i == 1)
					{
						$clrcd = ($data['balance'][$attdate][$data['leave_id'][$attdate][0]] == 1) ? $clrcd : '#e6e6e6';
						if($data['half_holiday'][$attdate][$data['leave_id'][$attdate][0]] == 2)
						{
							$clrcd = '#006600';
						}
						$pre .= '<div class="half-full-bottom" style="background:'.$clrcd.'; color:#fff;"></div>';
					}
					$pre .= '</div></span>';
				$data1['lDiv'][$attdate] = $pre;
			}
		}
		//pr($data1);
		return $data1;      
}
//========================Calculate Marked Attendance Balance while processing=================================//
function _getApprovalFlow($comp_id=NULL, $user_id=NULL, $type=NULL, $id = null, $showAll = FALSE){
		$CI = &get_instance();
		if($id || $showAll)
		{
			if($id)
			{
				$par = array("comp_id" => $comp_id, "user_id" => $user_id, 'type' => $type, 'id' => $id, 'status != '=>0);
			}
			
			if($showAll)
			{
				$par = array("comp_id" => $comp_id, "user_id" => $user_id, 'type' => $type, 'status != '=>0);
			}
			
			$lvs = $CI->db->get_where("setup_approval_flow", $par);
			if($lvs->num_rows())
			{
				if($id)
				{
					return $lvs->row();
				}
				if($showAll)
				{
					return $lvs->result();
				}
			}
		}
		return;
}
//========================Calculate Marked Attendance Balance while processing=================================//
function _checkAttendanceIsClosed($comp_id=NULL, $user_id=NULL, $emp_id=NULL, $month=NULL, $year=NULL){
		$CI = &get_instance();
		$lvs = $CI->db->select('status')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'month' => $month, 'year' => $year, 'status != '=>0));
		return $status = $lvs->num_rows() ? $lvs->row()->status : 0;
}
//========================Calculate Marked Attendance Balance while processing=================================//
 function _getMarkedAttendanceBalance($comp_id=NULL, $user_id=NULL, $emp_id = null, $att_date = null, $pl, $ul, $cw, $cmpl, $presents, $woffs, $hdays){
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'att_date' => $att_date, 'status != '=>0));
		$data['lrows'] = $lvs->num_rows();
		$pre = null;
		if($data['lrows'])
		{
			$data['att_date'] = $att_date;
			$info = $lvs->row();
			$data['balance'] = $info->balance;
			$data['is_weekoff'] = $info->is_weekoff;
			$data['half_holiday'] = $info->half_holiday;
			$data['type'] = $info->type;
			$data['countPL'] = array();
			$data['countCW'] = array();
			$data['countCMPL'] = array();
			$data['countUL'] = array();
			$data['pl'] = $pl;
			$data['ul'] = $ul;
			$data['cw'] = $cw;
			$data['cmpl'] = $cmpl;
			$data['presents'] = $presents;
			$data['woffs'] = $woffs;
			$data['hdays'] = $hdays;
			
			$i = 0;
			foreach($lvs->result() as $rec)
			{
				if($rec->leave_id)
				{
					$lqry =  $CI->db->select('leave_cat')->get_where('setup_leave_policy', array('id' => $rec->leave_id, "comp_id" => $comp_id, "user_id" => $user_id, 'status != ' => 0))->row();
					if($lqry->leave_cat != 8) //not compOff
					{
						$data['countPL'][$rec->leave_id][$i] = $rec->balance;
						$data['pl'] += $rec->balance;
					}
					else
					{
						if($rec->type) //compOff wrking
						{
							$data['countCW'][$rec->leave_id][$i] = $rec->balance;
							$data['cw'] += $rec->balance;
							if($rec->half_holiday)
							{
								$data['hdays'] += $rec->half_holiday == 2 ? 0.5 : 1;
							}
							if($rec->is_weekoff)
							{
								$data['woffs'] += $rec->is_weekoff == 2 ? 0.5 : 1;
								$data['presents'] += $rec->is_weekoff == 2 ? 0.5 : 0; //in case of halfday weekoff if halfday compoff wrking is there, make the emp present for halfday.
							}
						}
						else //compoff leave
						{
							$data['countCMPL'][$rec->leave_id][$i] = $rec->balance;		
							$data['cmpl'] += $rec->balance;
						}
					}
				}
				else //UL
				{
					$data['countUL'][$rec->leave_id][$i] = $rec->balance;
					$data['ul'] += $rec->balance;
				}
				
				if(!$rec->type) //not compOff wrking
				{
					$data['presents'] += ($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0) ? 0.5 : 0;
					$data['hdays'] += $data['half_holiday'] == 2 ? 0.5 : 0;
					//$data['woffs'] += $data['is_weekoff'] == 2 ? 0.5 : 0; // this cant be added since in case of halfday weekoff, fullday leave is being taken.
				}
				
				$i++;
			}			
		}
		//pr($data);		
		return $data;  		    
}
//========================Calculate Marked Attendance Balance while processing Automated Attendance=================================//
 function _getMarkedAttendanceBalanceAuto($comp_id=NULL, $user_id=NULL, $emp_id = null, $att_date = null, $pl, $ul, $cw, $cmpl, $presents, $woffs, $hdays){
		$CI = &get_instance();
		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'att_date' => $att_date, 'status != '=>0));
		$data['lrows'] = $lvs->num_rows();
		$pre = null;
		if($data['lrows'])
		{
			$data['att_date'] = $att_date;
			$info = $lvs->row();
			$data['balance'] = $info->balance;
			$data['is_weekoff'] = $info->is_weekoff;
			$data['half_holiday'] = $info->half_holiday;
			$data['type'] = $info->type;
			$data['countPL'] = array();
			$data['countCW'] = array();
			$data['countCMPL'] = array();
			$data['countUL'] = array();
			$data['pl'] = $pl;
			$data['ul'] = $ul;
			$data['cw'] = $cw;
			$data['cmpl'] = $cmpl;
			$data['presents'] = $presents;
			$data['woffs'] = $woffs;
			$data['hdays'] = $hdays;
			
			$i = 0;
			foreach($lvs->result() as $rec)
			{
				if($rec->leave_id)
				{
					$lqry =  $CI->db->select('leave_cat')->get_where('setup_leave_policy', array('id' => $rec->leave_id, "comp_id" => $comp_id, "user_id" => $user_id, 'status != ' => 0))->row();
					if($lqry->leave_cat != 8) //not compOff
					{
						$data['countPL'][$rec->leave_id][$i] = $rec->balance;
						$data['pl'] += $rec->balance;
					}
					else //compoff
					{
						if($rec->type) //compOff wrking
						{
							$data['countCW'][$rec->leave_id][$i] = $rec->balance;
							$data['cw'] += $rec->balance;
							if($rec->half_holiday)
							{
								$data['hdays'] += $rec->half_holiday == 2 ? 0.5 : 1;
							}
							if($rec->is_weekoff)
							{
								$data['woffs'] += $rec->is_weekoff == 2 ? 0.5 : 1;
								$data['presents'] += $rec->is_weekoff == 2 ? 0.5 : 0; //in case of halfday weekoff if halfday compoff wrking is there, make the emp present for halfday.
							}
						}
						else //compoff leave
						{
							$data['countCMPL'][$rec->leave_id][$i] = $rec->balance;		
							$data['cmpl'] += $rec->balance;
						}
					}
				}
				else //UL
				{
					$data['countUL'][$rec->leave_id][$i] = $rec->balance;
					$data['ul'] += $rec->balance;
				}
				
				if(!$rec->type) //not compOff wrking
				{
					if($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0) //if half day leave is there then check if emp was present in the other half day
					{
						$checkAttQry = $CI->db->select('id')->get_where("auto_emp_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'created_date' => $att_date,  'parent_id' => 0, 'status' => 1));
						if($checkAttQry->num_rows()) //check if the emp was present in the other half day
						{
							$data['presents'] += 0.5;
						}
						else // if no
						{
							$data['ul'] += 0.5;	
						}
					}
					
					$data['hdays'] += $data['half_holiday'] == 2 ? 0.5 : 0;
					//$data['woffs'] += $data['is_weekoff'] == 2 ? 0.5 : 0; // this cant be added since in case of halfday weekoff, fullday leave is being taken.
				}
				$i++;
			}			
		}
		//pr($data);		
		return $data;  		    
}
//=====================add Employee Attendance opening balance================================================//
  function _getAttendanceModEffectiveDate($comp_id=NULL, $user_id=NULL){
		$CI = &get_instance();
		//pr($CI->session->userdata('userinfo'));
		$pre = array();
		
		$checkParQry = $CI->db->select('p_id')->get_where("users", array("id" => $user_id, "comp_id"=>$comp_id, 'status' => 'active'), 1);
		if($checkParQry->num_rows())
		{
			$p_id = $checkParQry->row()->p_id;
			if($p_id)
			{
				$user_id = $p_id;	
			}
		}
		
		$cquery = $CI->db->select('module_effective_date')->get_where("company_pricing",array("user_id" => $user_id))->row();
		$compCreatedDate =  date('Y-m-d', strtotime($cquery->module_effective_date));
		$compCreatedMnth = date('m', strtotime($compCreatedDate)); 
		$compCreatedYr = date('Y', strtotime($compCreatedDate)); 
		return array('compCreatedMnth' => $compCreatedMnth, 'compCreatedYr' => $compCreatedYr);
}
//=====================add Employee Attendance opening balance================================================//
  function _checkProcessedAttendance($comp_id=NULL, $user_id=NULL){
		$CI = &get_instance();
	//return	array('month' => 8, 'year' => 2015, 'lastMonth' => 7, 'lastYear' => 2015, 'module_effective_date_mnth' => 8, 'module_effective_date_yr' => 2014);
		
		//pr($CI->session->userdata('userinfo'));
		$pre = array();
		$currentCompUserId = $user_id;
		$checkParQry = $CI->db->select('p_id')->get_where("users", array("id" => $user_id, "comp_id"=>$comp_id, 'status' => 'active'), 1);//to check whether its a child comp, if so then get the module_effective_date of its parent comp
		if($checkParQry->num_rows())
		{
			$p_id = $checkParQry->row()->p_id;
			if($p_id) //in case of child comp, get the user id of its parent comp 
			{
				$user_id = $p_id;	
			}
			$cquery = $CI->db->select('module_effective_date')->get_where("company_pricing",array("user_id" => $user_id))->row();
		}
		
		$compCreatedDate =  date('Y-m-d', strtotime($cquery->module_effective_date));
		$compCreatedMnth = date('m', strtotime($compCreatedDate)); 
		$compCreatedYr = date('Y', strtotime($compCreatedDate)); 
		$user_id = $currentCompUserId;	//change the user_id to the current comp`s user_id

		$empQry = $CI->db->select('id')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id, 'MONTH(join_date) <= ' => $compCreatedMnth, 'YEAR(join_date) <= ' => $compCreatedYr));
		//echo $CI->db->last_query(); die;
		if(!$empQry->num_rows())// case of No employee joined in the company`s creation month OR before that
		{
						   $CI->db->order_by('join_date');	
			$strtDateQry = $CI->db->select('id, join_date')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id), 1); //to get the month n year of the person who joined first of all
			//echo $CI->db->last_query(); 
			if($strtDateQry->num_rows())
			{
				$stdt = explode('-', $strtDateQry->row()->join_date);
				$compCreatedMnth = $stdt[1];
				$compCreatedYr = $stdt[0]; 
			}
			
			return $pre = array('month' => $compCreatedMnth, 'year' => $compCreatedYr, 'lastMonth' => 13, 'lastYear' => 1, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr); //returns the month n year of the person who joined first of all 
		}
		if($empQry->num_rows()) // case of Some employees joined in the company`s creation month OR before that
		{ 
			foreach($empQry->result() as $rec)
			{
				$alreadyExistsQry = $CI->db->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'month' => $compCreatedMnth, 'year' => $compCreatedYr,  'status' => 2)); 
				if($alreadyExistsQry->num_rows() == 0)
				{	//echo $rec->id.'<br>'; 
					//echo $compCreatedMnth.','. $compCreatedYr.'<br>';
					return $pre = array('month' => $compCreatedMnth, 'year' => $compCreatedYr, 'lastMonth' => 13, 'lastYear' => 1, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr); //attendance not been processed for module_effective_date.
				}
			}
						$CI->db->order_by('month', 'asc');
						$CI->db->order_by('year', 'asc');
				$getmQry = $CI->db->select('month, year')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id,  'status' => 1), 1); //get the month of the non-closed attendance if any
				if($getmQry->num_rows())
				{	
					$info = $getmQry->row();
					$lstmnth = $info->month; 
					$lstyr = $info->year;
					
					if($lstmnth == 1)
					{
						$lastYr = $lstyr - 1;
						$currmnth = $lstmnth;
						$lastMnth = 12;
						$currYr = $lstyr;
					}
					else
					{
						$currmnth = $lstmnth;
						$lastMnth = $lstmnth - 1;
						$lastYr = $lstyr;
						$currYr = $lstyr;
					} 
					//pr(array($nxtmnth, $nxtyr));
					return $pre = array('month' => $currmnth, 'year' => $currYr, 'lastMonth' => $lastMnth, 'lastYear' => $lastYr, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr);//some emps are left to be processed .
				}
				else //if no non-closed month is there, get the month of last closed attendance
				{
						$CI->db->order_by('year', 'desc');
						$CI->db->order_by('month', 'desc');
					$getmQry = $CI->db->select('month, year')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id,  'status' => 2), 1);
					if($getmQry->num_rows())
					{	
						$info = $getmQry->row();
						$lstmnth = $info->month;
						$lstyr = $info->year; 
						$lstmnth1 = $lstmnth < 10 ? str_pad($lstmnth, 2, '0', STR_PAD_LEFT) : $lstmnth;
						$lstJoinDate = $lstyr.'-'.$lstmnth1.'-31';
	
						//===========To check if all emps for $lstmnth have been processed or not================//
								$leftToProcessEpmsQry = $CI->db->select('id, join_date')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id, 'join_date <=' => $lstJoinDate)); 
								if($leftToProcessEpmsQry->num_rows())
								{
									foreach($leftToProcessEpmsQry->result() as $rec1)
									{ 
										$leftToProcessEpmsQry1 = $CI->db->select('month, year')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec1->id, 'month' => $lstmnth, 'year' => $lstyr)); //to get the emps who have not been even processed yet for $lstmnth
										
										if($leftToProcessEpmsQry1->num_rows() == 0)
										{//echo $rec1->id.','; 
											if($lstmnth == 1)
											{
												$nxtyr = $lstyr;
												$nxtmnth = $lstmnth;
												
												$lstmnth = 12;
												$lstyr = $lstyr - 1;
											}
											else
											{
												$nxtyr = $lstyr;
												$nxtmnth = $lstmnth;
												$lstmnth = $lstmnth - 1;
											}
											return $pre = array('month' => $nxtmnth, 'year' => $nxtyr , 'lastMonth' => $lstmnth, 'lastYear' => $lstyr, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr);	
										
										} 
									}//die;
								}
						//===========Ends To check if all emps for $lstmnth have been processed or not================//
							
							if($lstmnth == 12)
							{
								$nxtyr = $lstyr + 1;
								$nxtmnth = 1;
							}
							else
							{
								$nxtyr = $lstyr;
								$nxtmnth = $lstmnth + 1;
							} 
							//pr(array($nxtmnth, $nxtyr)); die;
							return $pre = array('month' => $nxtmnth, 'year' => $nxtyr , 'lastMonth' => $lstmnth, 'lastYear' => $lstyr, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr);
					}
				}
		}
		else
		{
			return $pre;
		}
}
//=============make Attendance Balance for next month(add by sumit on 7th nov 2016)=======//
	function _newcheckProcessedAttendance($comp_id=NULL, $user_id=NULL)
	{
		$CI = &get_instance();
		$pre = array();
		$currentCompUserId = $user_id;
		$checkParQry = $CI->db->select('p_id')->get_where("users", array("id" => $user_id, "comp_id"=>$comp_id, 'status' => 'active'), 1);//to check whether its a child comp, if so then get the module_effective_date of its parent comp
		if($checkParQry->num_rows())
		{
			$p_id = $checkParQry->row()->p_id;
			if($p_id) //in case of child comp, get the user id of its parent comp 
			{
				$user_id = $p_id;	
			}
			$cquery = $CI->db->select('module_effective_date')->get_where("company_pricing",array("user_id" => $user_id))->row();
		}
		$compCreatedDate =  date('Y-m-d', strtotime($cquery->module_effective_date));
		$compCreatedMnth = date('m', strtotime($compCreatedDate)); 
		$compCreatedYr = date('Y', strtotime($compCreatedDate)); 
		$user_id = $currentCompUserId;	//change the user_id to the current comp`s user_id

		$empQry = $CI->db->select('id')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id, 'MONTH(join_date) <= ' => $compCreatedMnth, 'YEAR(join_date) <= ' => $compCreatedYr));
		//echo $CI->db->last_query(); die;
		if(!$empQry->num_rows())// case of No employee joined in the company`s creation month OR before that
		{
			$CI->db->order_by('join_date');	
			$strtDateQry = $CI->db->select('id, join_date')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id), 1); //to get the month n year of the person who joined first of all
			//echo $CI->db->last_query(); 
			if($strtDateQry->num_rows())
			{
				$stdt = explode('-', $strtDateQry->row()->join_date);
				$compCreatedMnth = $stdt[1];
				$compCreatedYr = $stdt[0]; 
			}
			return $pre = array('month' => $compCreatedMnth, 'year' => $compCreatedYr, 'lastMonth' => 13, 'lastYear' => 1, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr); //returns the month n year of the person who joined first of all 
		}
		if($empQry->num_rows()) // case of Some employees joined in the company`s creation month OR before that
		{ 
			foreach($empQry->result() as $rec)
			{
				$alreadyExistsQry = $CI->db->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'month' => $compCreatedMnth, 'year' => $compCreatedYr,  'status' => 2)); 
				if($alreadyExistsQry->num_rows() == 0)
				{	//echo $rec->id.'<br>'; 
					//echo $compCreatedMnth.','. $compCreatedYr.'<br>';
					return $pre = array('month' => $compCreatedMnth, 'year' => $compCreatedYr, 'lastMonth' => 13, 'lastYear' => 1, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr); //attendance not been processed for module_effective_date.
				}
			}
			$CI->db->order_by('month', 'asc');
			$CI->db->order_by('year', 'asc');
			$getmQry = $CI->db->select('month, year')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id,  'status' => 1), 1); //get the month of the non-closed attendance if any
			if($getmQry->num_rows())
			{	
				$info = $getmQry->row();
				$lstmnth = $info->month; 
				$lstyr = $info->year;
				/* if($lstmnth == 1)
				{
					$lastYr = $lstyr - 1;
					$currmnth = $lstmnth;
					$lastMnth = 12;
					$currYr = $lstyr;
				}
				else
				{
					$currmnth = $lstmnth;
					$lastMnth = $lstmnth - 1;
					$lastYr = $lstyr;
					$currYr = $lstyr;
				} */ 
				
				if($lstmnth == 12)
				{
					$lastYr = $lstyr;
					$currmnth = 1;
					$lastMnth = $lstmnth;
					$currYr = $lstyr + 1;
				}
				else
				{
					$currmnth = $lstmnth+1;
					$lastMnth = $lstmnth;
					$lastYr = $lstyr;
					$currYr = $lstyr;
				}

				//pr(array($nxtmnth, $nxtyr));
				return $pre = array('month' => $currmnth, 'year' => $currYr, 'lastMonth' => $lastMnth, 'lastYear' => $lastYr, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr);//some emps are left to be processed .
			}
			else //if no non-closed month is there, get the month of last closed attendance
			{
				$CI->db->order_by('year', 'desc');
				$CI->db->order_by('month', 'desc');
				$getmQry = $CI->db->select('month, year')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id,  'status' => 2), 1);
				if($getmQry->num_rows())
				{	
					$info = $getmQry->row();
					$lstmnth = $info->month;
					$lstyr = $info->year; 
					$lstmnth1 = $lstmnth < 10 ? str_pad($lstmnth, 2, '0', STR_PAD_LEFT) : $lstmnth;
					$lstJoinDate = $lstyr.'-'.$lstmnth1.'-31';
					//===========To check if all emps for $lstmnth have been processed or not================//
					/* $leftToProcessEpmsQry = $CI->db->select('id, join_date')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id, 'join_date <=' => $lstJoinDate)); 
					if($leftToProcessEpmsQry->num_rows())
					{
						foreach($leftToProcessEpmsQry->result() as $rec1)
						{ 
							$leftToProcessEpmsQry1 = $CI->db->select('month, year')->get_where("process_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec1->id, 'month' => $lstmnth, 'year' => $lstyr)); //to get the emps who have not been even processed yet for $lstmnth
							if($leftToProcessEpmsQry1->num_rows() == 0)
							{//echo $rec1->id.','; 
								if($lstmnth == 1)
								{
									$nxtyr = $lstyr;
									$nxtmnth = $lstmnth;
												
									$lstmnth = 12;
									$lstyr = $lstyr - 1;
								}
								else
								{
									$nxtyr = $lstyr;
									$nxtmnth = $lstmnth;
									$lstmnth = $lstmnth - 1;
								}
								return $pre = array('month' => $nxtmnth, 'year' => $nxtyr , 'lastMonth' => $lstmnth, 'lastYear' => $lstyr, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr);	
										
							} 
						}//die;
					} */
					//===========Ends To check if all emps for $lstmnth have been processed or not================//
					if($lstmnth == 12)
					{
						$nxtyr = $lstyr + 1;
						$nxtmnth = 1;
					}
					else
					{
						$nxtyr = $lstyr;
						$nxtmnth = $lstmnth + 1;
					} 
					//pr(array($nxtmnth, $nxtyr)); die;
					return $pre = array('month' => $nxtmnth, 'year' => $nxtyr , 'lastMonth' => $lstmnth, 'lastYear' => $lstyr, 'module_effective_date_mnth' => $compCreatedMnth, 'module_effective_date_yr' => $compCreatedYr);
				}
			}
		}
		else
		{
			return $pre;
		}
	}
//=============Close make Attendance Balance for next month(add by sumit on 7th nov 2016)=======//
//=====================add Employee Attendance opening balance================================================//
  function _addAttendanceLeavesBalance($comp_id=NULL, $user_id=NULL, $nxtMnthYr = NULL){
		$CI = &get_instance();

		$probCatsArr = array();
		$probCatsQry = $CI->db->select('cat_id')->get_where('company_probation_policy', array('c_id'=>$comp_id, 'user_id' => $user_id, 'status != ' => 0));
		if($probCatsQry->num_rows())
		{
			foreach($probCatsQry->result() as $prec)
			{
				$probCatsArr[] = $prec->cat_id; //for new joiners
			}
		}
		
		$assignedLType = 0;
		$leavforQry = $CI->db->select('policy_common')->get_where("leave_settings", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
		if($leavforQry->num_rows())
		{
			$assignedLType = $leavforQry->row()->policy_common;
		}
		
		$join_date_shouldbe = $nxtMnthYr['year'].'-'.$nxtMnthYr['month'].'-31'; 
			
		$empQry = $CI->db->select('id, cat_id, dept_id, desg_id, grade_id, join_date')->where_not_in('status', array('0','3','4'))->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id, 'join_date <= ' => $join_date_shouldbe));
		if($empQry->num_rows())
		{ 
			foreach($empQry->result() as $rec)
			{
				switch($assignedLType)
				{
					case 1 : $cddc_code = $rec->cat_id;
					break;
					case 2 : $cddc_code = $rec->dept_id;
					break;
					case 3 : $cddc_code = $rec->desg_id;
					break;
					case 4 : $cddc_code = $rec->grade_id;
					break;
					default : $cddc_code = 0;
					break;
				}

				$where=array('comp_id'=>$comp_id, 'user_id' => $user_id, 'white_list_emp' => $rec->id, 'status !=' => 0);
				$mQry=$CI->db->get_where('company_assign_leave', $where);
				//pr($result); die;
				if($mQry->num_rows() == 0)
				{
					$where=array('comp_id'=>$comp_id, 'user_id' => $user_id, 'leave_for' => $assignedLType, 'cddc_code' => $cddc_code, 'status !=' => 0);
					$mQry = $CI->db->get_where('company_assign_leave', $where);
				}
				//pr($mQry->result()); die; //NOTE : The Balances for ML/MRL/PRL will not be added as per the concept.
				$i = $j = 0;
				foreach($mQry->result() as $rec1) //fetch all assigned leaves
				{
					$alreadyExistsQry = $CI->db->get_where("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'month' => $nxtMnthYr['month'], 'year' => $nxtMnthYr['year'],  'status !=' => 0));
					if($alreadyExistsQry->num_rows() == 0) //check balance doesnt nt alredy exist for next month
					{	
						$balQry = $CI->db->select('rest_bal')->get_where("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'month' => $nxtMnthYr['lastMonth'], 'year' => $nxtMnthYr['lastYear'], 'status !=' => 0));
						//echo $CI->db->last_query().',,,';
						$restBal = 0;
						if($balQry->num_rows()) 
						{
							$lastCloseYrMnth = $rec1->close_year == 1 ? 12 : 3; //month of calender and financial year
							
							if($nxtMnthYr['lastMonth'] == $lastCloseYrMnth)
							{
								if($rec1->carry)//leaves getting forwarded to next year
								{
									$restBal = $balQry->row()->rest_bal; 
								}
							}
							else
							{
								$restBal = $balQry->row()->rest_bal; 
							}
						}						
						
							/*pr($nxtMnthYr);
							echo $rec->id.'<br>';					
							echo $rec1->leave_id.'<br>'; die;*/
												
						if($nxtMnthYr['module_effective_date_mnth'] == $nxtMnthYr['month'] && $nxtMnthYr['module_effective_date_yr'] == $nxtMnthYr['year'])//to add past leaves to emps , ADD Credited Balance
						{
							$crQry = $CI->db->select('no_leaves')->get_where("emp_cf_leaves", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'status !=' => 0)); //  CREDIT PAST LEAVES
							if($crQry->num_rows())
							{ 
								$restBal += $crQry->row()->no_leaves; // Credited Balance
							}
						}
						//echo $restBal.',';
						
						$currMnthBalance = 0; 
						if($rec1->monthly_setup) //individual month setup
						{ //echo $rec1->leaves_permm; die;
							$mnthBalance = explode(',', $rec1->leaves_permm);
							$j = 0;
							foreach($mnthBalance as $mnthBalance1)
							{
								$mnthBalance2 = explode('-', $mnthBalance1);
								//pr($mnthBalance2); die;
								//if($nxtMnthYr['month'] == $mnthBalance2[1] && $nxtMnthYr['year'] == $mnthBalance2[0])
								if($nxtMnthYr['month'] == $mnthBalance2[1])
								{ 	//pr($mnthBalance2); die;
									//echo $mnthBalance2[1].',';
									//echo $postdata['month'].',';
									$currMnthBalance = $mnthBalance2[2]; 
								}
							}
							
						}
						else //common for all months
						{
							if(!in_array($rec1->leave_cat, array(5,6,7,8)))
							{
								$mnthBalance = explode('-', $rec1->leaves_permm);
								//if($nxtMnthYr['year'] == $mnthBalance[0])
								//{
									$currMnthBalance = $mnthBalance[1];
								//}
							}
						}
						
						//echo $rec->id.'=>'. $currMnthBalance.','; //die;
						$openingBal = 0;
						$lvs = $CI->db->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $rec1->leave_id, 'status !='=>0));
						if($lvs->num_rows() > 0)
						{
							$info = $lvs->row();
							
							if(date('m', strtotime($rec->join_date)) == $nxtMnthYr['month'] && date('Y', strtotime($rec->join_date)) == $nxtMnthYr['year']) //check leaves prorated for new emp
							{ 
								if($info->same_rule_prob && !empty($probCatsArr) && in_array($rec->cat_id, $probCatsArr)) //case of same_rule_prob
								{
									$joinDateEmp = date('d', strtotime($rec->join_date));
									if($joinDateEmp >= $info->half_credit_from && $joinDateEmp <= $info->half_credit_to)
									{
										$currMnthBalance = $currMnthBalance / 2;
										$openingBal = $restBal + $currMnthBalance;
									}
									elseif($joinDateEmp >= $info->noleave_joined_after)
									{
										$openingBal  = $restBal + 0; //$currMnthBalance will be 0.
									}
									else
									{
										$openingBal = $restBal + $currMnthBalance;
									}
								}
								else
								{
									if($info->mid_month_join)
									{
										if($info->applicable_for_id == 0 || $info->applicable_for_id == $rec->cat_id)
										{
											$joinDateEmp = date('d', strtotime($rec->join_date));
											if($joinDateEmp >= $info->half_credit_from && $joinDateEmp <= $info->half_credit_to)
											{
												$currMnthBalance = $currMnthBalance / 2;
												$openingBal = $restBal + $currMnthBalance;
											}
											elseif($joinDateEmp >= $info->noleave_joined_after)
											{
												$openingBal  = $restBal + 0; //$currMnthBalance will be 0.
											}
											else
											{
												$openingBal = $restBal + $currMnthBalance;
											}	
										}
										else
										{
											$openingBal = $restBal + $currMnthBalance;
										}
									}
									else
									{
										$openingBal = $restBal + $currMnthBalance;
									}		
								}
							}
							else
							{
								$openingBal = $restBal + $currMnthBalance;
							}
							$newRestBal = $openingBal;
							
							$runQry = true;
							if(in_array($rec->cat_id, $probCatsArr))
							{
								if(!$info->eligible_probemp)//checks if the leave is eligible for probationary emps
								{
									$runQry = false;	
								}	
							}
							
							if($runQry)
							{
								$insertBalQry = $CI->db->insert("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'month' => $nxtMnthYr['month'], 'year' => $nxtMnthYr['year'], 'opening_bal' => $openingBal, 'availed_bal' => 0, 'applied_bal' => 0, 'rest_bal' => $newRestBal, 'created_date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s'), 'status' => 1));
								if($insertBalQry)
								{
									$i++;
								}
								else
								{ 
									$j++; //echo $CI->db->last_query().',,,,,,,,,';
								}					
							}
						}
					}//end of if($alreadyExistsQry->num_rows() == 0)
				}// end foreach leaves
			} //die; //emp foreach()
			//echo 'Inserted Records : '.$i.'<br>Not Inserted Records : '.$j;
		}
	return true;
}

function _newaddAttendanceLeavesBalance($comp_id=NULL, $user_id=NULL, $nxtMnthYr = NULL, $attnd_yr=NULL, $attnd_mnth=NULL)
{
	$CI = &get_instance();
	$probCatsArr = array();
	$probCatsQry = $CI->db->select('cat_id')->get_where('company_probation_policy', array('c_id'=>$comp_id, 'user_id' => $user_id, 'status != ' => 0));
	if($probCatsQry->num_rows())
	{
		foreach($probCatsQry->result() as $prec)
		{
			$probCatsArr[] = $prec->cat_id; //for new joiners
		}
	}
	$assignedLType = 0;
	$leavforQry = $CI->db->select('policy_common')->get_where("leave_settings", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
	if($leavforQry->num_rows())
	{
		$assignedLType = $leavforQry->row()->policy_common;
	}
	$join_date_shouldbe = $nxtMnthYr['year'].'-'.$nxtMnthYr['month'].'-31';
	$chk_join_date_shouldbe = $nxtMnthYr['year'].'-'.$nxtMnthYr['month'].'-01';
	$emp_reign_date=$attnd_yr.'-'.$attnd_mnth.'-31';
	$CI->db->where("(`reign_date` IS NULL");
	$CI->db->or_where("`reign_date` >= '$emp_reign_date')");
	$empQry = $CI->db->select('id, cat_id, dept_id, desg_id, grade_id, join_date')->get_where("company_employee", array("c_id" => $comp_id, "user_id" => $user_id, 'join_date <= ' => $join_date_shouldbe));
	//echo $CI->db->last_query(); die;
	if($empQry->num_rows())
	{ 
		//pr($empQry->result()); die;
		foreach($empQry->result() as $rec)
		{
			if($rec->join_date<$chk_join_date_shouldbe)
			{
				$attndqry=$CI->db->get_where('process_attendance', array('year' => $nxtMnthYr['lastYear'], 'month' => $nxtMnthYr['lastMonth'], 'emp_id' => $rec->id, 'status' => 2));
				if($attndqry->num_rows()==0)
				{
					//break;   // comment by sumit on 6-12-2016 for continue loop 
					continue;
				}
			}
			$prcsattndqry=$CI->db->get_where('process_attendance', array('year' => $attnd_yr, 'month' => $attnd_mnth, 'emp_id' => $rec->id, 'status' => 2));
			//echo $CI->db->last_query();
			if($prcsattndqry->num_rows())
			{
				switch($assignedLType)
				{
					case 1 : $cddc_code = $rec->cat_id;
					break;
					case 2 : $cddc_code = $rec->dept_id;
					break;
					case 3 : $cddc_code = $rec->desg_id;
					break;
					case 4 : $cddc_code = $rec->grade_id;
					break;
					default : $cddc_code = 0;
					break;
				}
				$where=array('comp_id'=>$comp_id, 'user_id' => $user_id, 'white_list_emp' => $rec->id, 'status !=' => 0);
				$mQry=$CI->db->get_where('company_assign_leave', $where);
				//pr($result); die;
				if($mQry->num_rows() == 0)
				{
					$where=array('comp_id'=>$comp_id, 'user_id' => $user_id, 'leave_for' => $assignedLType, 'cddc_code' => $cddc_code, 'status !=' => 0);
					$mQry = $CI->db->get_where('company_assign_leave', $where);
				}
				//pr($mQry->result()); die; //NOTE : The Balances for ML/MRL/PRL will not be added as per the concept.
				$i = $j = 0;
				foreach($mQry->result() as $rec1) //fetch all assigned leaves
				{
					$alreadyExistsQry = $CI->db->get_where("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'month' => $nxtMnthYr['month'], 'year' => $nxtMnthYr['year'],  'status !=' => 0));
					if($alreadyExistsQry->num_rows() == 0) //check balance doesnt nt alredy exist for next month
					{	
						$balQry = $CI->db->select('rest_bal')->get_where("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'month' => $nxtMnthYr['lastMonth'], 'year' => $nxtMnthYr['lastYear'], 'status !=' => 0));
						//echo $CI->db->last_query().',,,';
						$restBal = 0;
						if($balQry->num_rows()) 
						{
							$lastCloseYrMnth = $rec1->close_year == 1 ? 12 : 3; //month of calender and financial year
							if($nxtMnthYr['lastMonth'] == $lastCloseYrMnth)
							{
								if($rec1->carry)//leaves getting forwarded to next year
								{
									$restBal = $balQry->row()->rest_bal; 
								}
							}
							else
							{
								$restBal = $balQry->row()->rest_bal; 
							}
						}						
							
						/*pr($nxtMnthYr);
						echo $rec->id.'<br>';					
						echo $rec1->leave_id.'<br>'; die;*/
													
						if($nxtMnthYr['module_effective_date_mnth'] == $nxtMnthYr['month'] && $nxtMnthYr['module_effective_date_yr'] == $nxtMnthYr['year'])//to add past leaves to emps , ADD Credited Balance
						{
							$crQry = $CI->db->select('no_leaves')->get_where("emp_cf_leaves", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'status !=' => 0)); //  CREDIT PAST LEAVES
							if($crQry->num_rows())
							{ 
								$restBal += $crQry->row()->no_leaves; // Credited Balance
							}
						}
						//echo $restBal.',';
						$currMnthBalance = 0; 
						if($rec1->monthly_setup) //individual month setup
						{ //echo $rec1->leaves_permm; die;
							$mnthBalance = explode(',', $rec1->leaves_permm);
							$j = 0;
							foreach($mnthBalance as $mnthBalance1)
							{
								$mnthBalance2 = explode('-', $mnthBalance1);
								//pr($mnthBalance2); die;
								//if($nxtMnthYr['month'] == $mnthBalance2[1] && $nxtMnthYr['year'] == $mnthBalance2[0])
								if($nxtMnthYr['month'] == $mnthBalance2[1])
								{ 	
									//pr($mnthBalance2); die;
									//echo $mnthBalance2[1].',';
									//echo $postdata['month'].',';
									$currMnthBalance = $mnthBalance2[2]; 
								}
							}	
						}
						else //common for all months
						{
							if(!in_array($rec1->leave_cat, array(5,6,7,8)))
							{
								$mnthBalance = explode('-', $rec1->leaves_permm);
								//if($nxtMnthYr['year'] == $mnthBalance[0])
								//{
									$currMnthBalance = $mnthBalance[1];
								//}
								}
						}
						//====added by code for OT for softelnetworks.com by sumit==//
						if($comp_id=='101' && $rec1->leave_id==5 && $rec1->leave_cat==9)
						{
							$emp_ot_bal_qry=$CI->db->select('overtime_days')->get_where('emp_overtime_days', array('year' => $attnd_yr, 'month' => $attnd_mnth, 'emp_id' => $rec->id));
							if($emp_ot_bal_qry->num_rows())
							{
								$currMnthBalance=$emp_ot_bal_qry->row()->overtime_days;
							}
						}
						//====added by code for OT for softelnetworks.com by sumit==//
						//echo $rec->id.'=>'. $currMnthBalance.','; //die;
						$openingBal = 0;
						$lvs = $CI->db->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $rec1->leave_id, 'status !='=>0));
						if($lvs->num_rows() > 0)
						{
							$info = $lvs->row();
							if(date('m', strtotime($rec->join_date)) == $nxtMnthYr['month'] && date('Y', strtotime($rec->join_date)) == $nxtMnthYr['year']) //check leaves prorated for new emp
							{ 
								if($info->same_rule_prob && !empty($probCatsArr) && in_array($rec->cat_id, $probCatsArr)) //case of same_rule_prob
								{
									$joinDateEmp = date('d', strtotime($rec->join_date));
									if($joinDateEmp >= $info->half_credit_from && $joinDateEmp <= $info->half_credit_to)
									{
										$currMnthBalance = $currMnthBalance / 2;
										$openingBal = $restBal + $currMnthBalance;
									}
									elseif($joinDateEmp >= $info->noleave_joined_after)
									{
										$openingBal  = $restBal + 0; //$currMnthBalance will be 0.
									}
									else
									{
										$openingBal = $restBal + $currMnthBalance;
									}
								}
								else
								{
									if($info->mid_month_join)
									{
										if($info->applicable_for_id == 0 || $info->applicable_for_id == $rec->cat_id)
										{
											$joinDateEmp = date('d', strtotime($rec->join_date));
											if($joinDateEmp >= $info->half_credit_from && $joinDateEmp <= $info->half_credit_to)
											{
												$currMnthBalance = $currMnthBalance / 2;
												$openingBal = $restBal + $currMnthBalance;
											}
											elseif($joinDateEmp >= $info->noleave_joined_after)
											{
												$openingBal  = $restBal + 0; //$currMnthBalance will be 0.
											}
											else
											{
												$openingBal = $restBal + $currMnthBalance;
											}	
										}
										else
										{
											$openingBal = $restBal + $currMnthBalance;
										}
									}
									else
									{
										$openingBal = $restBal + $currMnthBalance;
									}		
								}
							}
							else
							{
								$openingBal = $restBal + $currMnthBalance;
							}
							$newRestBal = $openingBal;
							$runQry = true;
							if(in_array($rec->cat_id, $probCatsArr))
							{
								if(!$info->eligible_probemp)//checks if the leave is eligible for probationary emps
								{
									$runQry = false;	
								}	
							}
							if($runQry)
							{
								$insertBalQry = $CI->db->insert("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $rec->id, 'leave_id' => $rec1->leave_id, 'month' => $nxtMnthYr['month'], 'year' => $nxtMnthYr['year'], 'opening_bal' => $openingBal, 'availed_bal' => 0, 'applied_bal' => 0, 'rest_bal' => $newRestBal, 'created_date' => date('Y-m-d H:i:s'), 'modified_date' => date('Y-m-d H:i:s'), 'status' => 1));
								if($insertBalQry)
								{
									$i++;
								}
								else
								{ 
									$j++; //echo $CI->db->last_query().',,,,,,,,,';
								}					
							}
						}
					}//end of if($alreadyExistsQry->num_rows() == 0)
				}// end foreach leaves
			}
		} //die; //emp foreach()
		//echo 'Inserted Records : '.$i.'<br>Not Inserted Records : '.$j;
	}
	return true;
}
//=====================cLOSE Employee Attendance opening balance================================================//

//=========================Employee Cf Leave===================================//
/** Added by::: Sumit :::
* Calculates all Carry Forward Leave 
* Against given company and user id and Employee Id.
* @param string $uri The URI path
* _Emp_cf_leave()
* @return if company or employee is login
*/
	if ( ! function_exists('_Emp_cf_leave')) {
		function _Emp_cf_leave($comp_id=NULL,$user_id=NULL,$emp_id=FALSE,$leave_id=FALSE) {
			$data=array();
			if(!empty($comp_id) && !empty($user_id)) {
				$CI =& get_instance();
				if(!empty($emp_id) && !empty($leave_id)) {
					$CI->db->select('no_leaves');
					$noleave=$CI->db->get_where("emp_cf_leaves",array('comp_id'=>$comp_id, 'user_id' => $user_id, 'emp_id' => $emp_id, 'leave_id' => $leave_id, 'status' => 1),1);
					if($noleave->num_rows()){
						return $noleave->row()->no_leaves;
					} else {
						return false;
					}
				} else {
					$CI->db->select('no_leaves');
					$noleave=$CI->db->get_where("emp_cf_leaves",array('comp_id'=>$comp_id, 'user_id' => $user_id, 'status' => 1),1);
					if($noleave->num_rows()){
						return true;
					} else {
						return false;
					}
				}
				
			}
		}
	}

//========================Close Employee Cf Leave==============================//

//===============================Employee rotat Shift =============================//
/** Added by::: $umit :::
* Calculates all rotat Shift 
* Against given company and user id and Employee.
* @param string $uri The URI path
* _emp_rotat_shift()
* @return if company or employee is login
*/

if ( ! function_exists('_emp_rotat_shift')) {
    function _emp_rotat_shift($comp_id=NULL,$user_id=NULL,$effective_from=FALSE,$emp_id=FALSE) {
		$data=array();
		$data['empty']=true;
		if($comp_id && $user_id && $effective_from && $emp_id){
			$CI =& get_instance();
			$CI->db->select('id,shift_id,remarks,is_published,is_wh');
			$data['shift']=$CI->db->get_where("emp_assign_shift",array("user_id" => $user_id, "comp_id" => $comp_id, "emp_id" => $emp_id, "effective_from" => $effective_from, "status" => 1, 'shift_id !=' => 0, 'shift_type' => 2 ))->result();
			if($data['shift']){
				$data['empty']=false;
			}
		}
		//pr($data); die;
		return $data;
	}
}

//==============================Close Employee Rotat Shift=========================//

//========================Employee manage shift=============================//
/** Added by::: $umit :::
* Manage Add Shift 
* Against given company and user id and Employee.
* @param string $uri The URI path
* _employee_manage_shift()
* @return if company or employee is login
*/

if ( ! function_exists('_employee_manage_shift')) {
    function _employee_manage_shift($comp_id=NULL,$user_id=NULL,$emp_id=FALSE,$row_date=FALSE,$shift_id=FALSE) {
		$data=array();
		$data['empty']=true;
		if($comp_id && $user_id && $emp_id && $row_date && $shift_id){
			$CI =& get_instance();
			$CI->db->select('id,sft_name,sft_code,in_time,is_next_day,out_time');
			$all_shift=$CI->db->get_where("company_shift_master",array("user_id" => $user_id, "comp_id" => $comp_id, "status !=" => 0))->result();
			if(isset($all_shift) && !empty($all_shift)){
                foreach($all_shift as $result) {
					$data['shift_master'][$result->id] = $result->sft_name;
                    $data['shift_intime'][$result->id] = $result->in_time;
                    $data['shift_outtime'][$result->id] = $result->out_time;
                    $data['is_next_day'][$result->id] = $result->is_next_day;
				}
            }
			$asgn_shift = $CI->db->select('shift_id')->get_where("emp_assign_shift",array("comp_id"=>$comp_id, "user_id"=>$user_id, "emp_id" => $emp_id, "effective_from" => date("Y-m-d",$row_date), 'status !='=>0, 'shift_id !=' => 0))->result();
			//echo $CI->db->last_query(); exit;
			if(strtotime($data['shift_intime'][$shift_id])>strtotime($data['shift_outtime'][$shift_id])){

					$next_row_date=strtotime('+1 days', $row_date );
					$next_asgn_shift = $CI->db->select('shift_id')->get_where("emp_assign_shift",array("comp_id"=>$comp_id, "user_id"=>$user_id, "emp_id" => $emp_id, "effective_from" => date("Y-m-d",$next_row_date), 'status !='=>0, 'shift_id !=' => 0))->result();

					if(isset($next_asgn_shift) && !empty($next_asgn_shift)){
						foreach($next_asgn_shift as $val){
							
							if(strtotime($data['shift_intime'][$val->shift_id])<strtotime($data['shift_outtime'][$val->shift_id])){
								
								/*$intime_1=strtotime($data['shift_intime'][$val->shift_id]);
								$outtime_1=strtotime($data['shift_outtime'][$val->shift_id]);
								$intime_2=strtotime($data['shift_intime'][$shift_id]);
								$outtime_2=strtotime($data['shift_outtime'][$shift_id]);

								$intime1=(date("H:i:s",$intime_1));
								//echo "<br>";
								$outtime1=(date("H:i:s",$outtime_1));
								///echo "<br>";
								$intime2=(date("H:i:s",$intime_2));
								//echo "<br>";
								$outtime2=(date("H:i:s",$outtime_2));
								//exit;*/
								$intime1=$data['shift_intime'][$val->shift_id];
								$outtime1=$data['shift_outtime'][$val->shift_id];
								$intime2=$data['shift_intime'][$shift_id];
								$outtime2=$data['shift_outtime'][$shift_id];
								if(($outtime2>$intime1 && $outtime2<$outtime1)) {
									return true;
								}

							}
						}
					}
				} else {
					$prev_row_date=strtotime('-1 days', $row_date );
					$prev_asgn_shift = $CI->db->select('shift_id')->get_where("emp_assign_shift",array("comp_id"=>$comp_id, "user_id"=>$user_id, "emp_id" => $emp_id, "effective_from" => date("Y-m-d",$prev_row_date), 'status !='=>0, 'shift_id !=' => 0))->result();

					if(isset($prev_asgn_shift) && !empty($prev_asgn_shift)){
					foreach($prev_asgn_shift as $val){
						if(strtotime($data['shift_intime'][$val->shift_id])>strtotime($data['shift_outtime'][$val->shift_id])) {
							
							$intime_1=$data['shift_intime'][$val->shift_id];
							//echo "<br>";
							//$intime_1=strtotime($data['shift_intime'][$val->shift_id]);
							$outtime_1=$data['shift_outtime'][$val->shift_id];
							//echo "<br>";
							//$outtime_1=strtotime($data['shift_outtime'][$val->shift_id]);
							$intime_2=$data['shift_intime'][$shift_id];
							//echo "<br>";
							//$intime_2=strtotime($data['shift_intime'][$shift_id]);
							$outtime_2=$data['shift_outtime'][$shift_id];
							//echo "<br>";
							//$outtime_2=strtotime($data['shift_outtime'][$shift_id]);

							/*echo $intime1=(date("H:i:s",$intime_1));
							echo "<br>";
							echo $outtime1=(date("H:i:s",$outtime_1));
							echo "<br>";
							echo $intime2=(date("H:i:s",$intime_2));
							echo "<br>";
							echo $outtime2=(date("H:i:s",$outtime_2));
							exit;*/
							if(($outtime_1>$intime_2 && $outtime_1<$outtime_2)){
								return true;
							}
						}
					}
				}
			}
			if(isset($asgn_shift) && !empty($asgn_shift)){
				foreach($asgn_shift as $val){

					if(strtotime($data['shift_intime'][$val->shift_id])>strtotime($data['shift_outtime'][$val->shift_id]) && strtotime($data['shift_intime'][$shift_id])>strtotime($data['shift_outtime'][$shift_id])) {
						$intime1=$data['shift_intime'][$val->shift_id];
						$outtime1=$data['shift_outtime'][$val->shift_id];
						$outtime11="23:00:00";
						$more_time1=_shift_difference($outtime11,$outtime1);
						
						
						$intime2=$data['shift_intime'][$shift_id];
						$outtime21=$data['shift_outtime'][$shift_id];
						$outtime22="23:00:00";
						$more_time2=_shift_difference($outtime22,$outtime21);
						if($more_time1>$more_time2){
							$more_time=$more_time1;
						}else {
							$more_time=$more_time2;
						}

						$intime_1=strtotime($intime1) - strtotime($more_time);
						$outtime_1=strtotime($outtime1) - strtotime($more_time);

						$intime_2=strtotime($intime2) - strtotime($more_time);
						$outtime_2=strtotime($outtime21) - strtotime($more_time);

					} else if(strtotime($data['shift_intime'][$val->shift_id])>strtotime($data['shift_outtime'][$val->shift_id]) && strtotime($data['shift_intime'][$shift_id])<strtotime($data['shift_outtime'][$shift_id])) {
						$intime1=$data['shift_intime'][$val->shift_id];
						$outtime1=$data['shift_outtime'][$val->shift_id];
						$outtime11="23:00:00";
						$more_time=_shift_difference($outtime11,$outtime1);
						$intime_1=strtotime($intime1) - strtotime($more_time);
						$outtime_1=strtotime($outtime1) - strtotime($more_time);

						$intime2=$data['shift_intime'][$shift_id];
						$outtime21=$data['shift_outtime'][$shift_id];
						$intime_2=strtotime($intime2) - strtotime($more_time);
						$outtime_2=strtotime($outtime21) - strtotime($more_time);

						
					} else if(strtotime($data['shift_intime'][$val->shift_id])<strtotime($data['shift_outtime'][$val->shift_id]) && strtotime($data['shift_intime'][$shift_id])>strtotime($data['shift_outtime'][$shift_id])) {
						
						$intime1=$data['shift_intime'][$val->shift_id];
						$outtime1=$data['shift_outtime'][$val->shift_id];

						$intime21=$data['shift_intime'][$shift_id];
						$outtime21=$data['shift_outtime'][$shift_id];
						$outtime22="23:00:00";
						$more_time=_shift_difference($outtime22,$outtime21);

						$intime_1=strtotime($intime1) - strtotime($more_time);
						$outtime_1=strtotime($outtime1) - strtotime($more_time);

						$intime_2=strtotime($intime21) - strtotime($more_time);
						$outtime_2=strtotime($outtime21) - strtotime($more_time);

					} else {
						$intime_1=strtotime($data['shift_intime'][$val->shift_id]);
						$outtime_1=strtotime($data['shift_outtime'][$val->shift_id]);
						$intime_2=strtotime($data['shift_intime'][$shift_id]);
						$outtime_2=strtotime($data['shift_outtime'][$shift_id]);
					}
					$intime1=(date("H:i:s",$intime_1));
					//echo "<br>";
					$outtime1=(date("H:i:s",$outtime_1));
					//echo "<br>";
					$intime2=(date("H:i:s",$intime_2));
					//echo "<br>";
					$outtime2=(date("H:i:s",$outtime_2));
					//exit;
					if((($intime2>$intime1 && $intime2<$outtime1) || ($outtime2>$intime1 && $outtime2<$outtime1)) || ( ($intime1>$intime2 && $intime1<$outtime2) || ($outtime1>$intime2 && $outtime1<$outtime2) )){
						return true;
					}
				}
			}

		}
		return false;
	}
}

//=======================Close Employee manage shift=========================//

//===============================Employee rotat Shift difference =============================//
/**	Added by::: $umit :::
     * Calculate Employee Shift Difference
     * This function for Calculate Employee Shift Difference
     * @access	public
     * @return	html data
     */	

if ( ! function_exists('_shift_difference')) {
    function _shift_difference($dtime=NULL,$atime=NULL) {
		$data=array();
		$data['empty']=true;
		if($dtime && $atime){
			$nextDay=$dtime>$atime?1:0;
			$dep=EXPLODE(':',$dtime);
			$arr=EXPLODE(':',$atime);
			$diff=ABS(MKTIME($dep[0],$dep[1],0,DATE('n'),DATE('j'),DATE('y'))-MKTIME($arr[0],$arr[1],0,DATE('n'),DATE('j')+$nextDay,DATE('y')));
			$hours=FLOOR($diff/(60*60));
			$mins=FLOOR(($diff-($hours*60*60))/(60));
			$secs=FLOOR(($diff-(($hours*60*60)+($mins*60))));
			IF(STRLEN($hours)<2){$hours="0".$hours;}
			IF(STRLEN($mins)<2){$mins="0".$mins;}
			IF(STRLEN($secs)<2){$secs="0".$secs;}
			return $hours.':'.$mins.':'.$secs;
		}
		
		return $false;
	}
}

//==============================Close Employee rotat Shift difference=========================//

//==========================Weekoff list=================================//
/* Calculates all Weekoff list 
* Against given emp && company and user id and employee
* @param string $uri The URI path
* _is_weekoff()
* @return if company or employee is login
*/
if ( ! function_exists('_is_emp_weekoff')) {
    function _is_emp_weekoff($comp_id=NULL, $user_id=NULL, $day_names=FALSE, $frequency=FALSE, $location_id=FALSE, $cat_id=FALSE, $dept_id=FALSE, $desg_id=FALSE, $weekOffSetupType,$week_date=FALSE,$emp_id=FALSE) {
		$data = array();
		if(!empty($comp_id) && !empty($user_id) && !empty($day_names) && !empty($frequency)) 
		{
			$CI =& get_instance();
			$is_empweekoff = $CI->db->select('id, type')->get_where("weekoffs_setup",array("emp_id"=> $emp_id, "comp_id"=>$comp_id, "user_id"=>$user_id, "effective_date" => $week_date, "status"=>1));
			if($is_empweekoff->num_rows()){
				return $is_empweekoff->row()->type;
			}
			
			$is_empweekoff = $CI->db->select('id, type')->get_where("weekoffs_setup",array("emp_id"=> $emp_id, "comp_id"=>$comp_id, "user_id"=>$user_id, "day_names" => $day_names, "frequency" => $frequency, "status"=>1));
			if($is_empweekoff->num_rows()){
				return $is_empweekoff->row()->type;
			}
		
			$CI->db->select('type');
			$CI->db->where_in('location_id', array(0, $location_id));	
			switch($weekOffSetupType)
			{
				case 1 : $CI->db->where_in('cat_id', array(0, $cat_id));
				break;
				case 2 : $CI->db->where_in('dept_id', array(0, $dept_id));
				break;
				case 3 : $CI->db->where_in('desg_id', array(0, $desg_id));
				break;
				case 4 : $CI->db->where('cat_id', '');
						 $CI->db->where('dept_id', '');	
						 $CI->db->where('desg_id', '');
				break;
			}
			
			$is_compweekoff=$CI->db->get_where("weekoffs_setup",array("emp_id"=> 0, "comp_id"=>$comp_id, "user_id"=>$user_id, "day_names" => $day_names, "frequency" => $frequency, "status"=>1));
			//echo $CI->db->last_query(); exit;
			if($is_compweekoff->num_rows()) 
			{ 
				return $is_compweekoff->row()->type;
			}
		}
		return false;
	}
 }

//========================Close Weekoff list=================================//
/* Calculates all working hours 
* Against given emp && company and user id and employee
* @param string $uri The URI path
* _tot_emp_working_hours()
* @return if working hours or shift is login
*/
if ( ! function_exists('_tot_emp_working_hours')) {
    function _tot_emp_working_hours($comp_id=NULL, $user_id=NULL, $emp_id=FALSE, $start_date=FALSE, $end_date=FALSE) {
		$data=array();
		$emp_arr=array();
		if(!empty($comp_id) && !empty($user_id) && !empty($emp_id) && !empty($start_date) && !empty($end_date)) 
		{
			$data=array();
			$CI =& get_instance();
			$tot_work_shift=$CI->db->select('shift_id')->get_where("emp_assign_shift",array("emp_id"=> $emp_id, "comp_id"=>$comp_id, "user_id"=>$user_id, "effective_from >=" => $start_date, "effective_from <=" => $end_date,  "status"=>1, "shift_id !=" => '0' ));
			//echo $CI->db->last_query(); exit;
			$shift_time='';
			$emp_arr['empty']=true;
			if($tot_work_shift->num_rows()){
				$emp_arr['empty']=false;
				$CI->db->select('id,sft_code,in_time,out_time');
				$all_shift=$CI->db->get_where("company_shift_master",array("user_id" => $user_id, "comp_id" => $comp_id, "status !=" => 0))->result();
				if(isset($all_shift) && !empty($all_shift)){
					foreach($all_shift as $result) {
						$data['shift_intime'][$result->id] = $result->in_time;
						$data['shift_outtime'][$result->id] = $result->out_time;
					}
				}

				$tot_shift=$tot_work_shift->result();
				//pr($tot_shift); die;
				foreach($tot_shift as $res){
					$in_time=$data['shift_intime'][$res->shift_id];
					$out_time=$data['shift_outtime'][$res->shift_id];
					$shift_time +=_shift_difference($in_time,$out_time);
				}
			}
			$emp_arr['tot_shift']=$tot_work_shift->num_rows();
			$emp_arr['tot_work_hours']=$shift_time;
			return $emp_arr;
		}
		return false;
	}
 }
//=======================employee working hours==================================//
	
//=====================Close Employee working hours=============================//

//=====================Holidays name=============================================//
	/** Added by::: $umit :::
	* Holidays Name 
	* Against given company and user id.
	* @param string $uri The URI path
	* _holidays_name()
	* @return if company or employee is login
	*/
	if ( ! function_exists('_holidays_name')) {
		function _holidays_name($comp_id=NULL,$user_id=NULL,$date=FALSE) {
			if($comp_id && $user_id && $date){
				$todate_arr=explode('-',$date);
				$exp_yy='-'.$todate_arr[1].'-'.$todate_arr[2];
				$week=week_of_month($date);
				$day_list=date('N',strtotime($date));
				$CI =& get_instance();
				$data=$CI->db->select('hm_name')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id, 'hm_type' => '1',  'status' => '1'))->where("((`hm_date` = '$date')")->or_where("(`periodicity_holiday` = '1' AND DATE(`hm_date`) = '$todate_arr[2]' and MONTH(`hm_date`) = '$todate_arr[1]')")->or_where("(`periodicity_holiday` = '2' and	`month` = '$todate_arr[1]' and `week_list` = '$week' and `day_list` = '$day_list'))")->get('company_holidays_master')->row();
				return ucfirst($data->hm_name);
			}
			return false;
		}
	}


//===================Close Holidays Name========================================//
//=======================Employee Leave Balance=============================//
/** Added by::: $umit :::
* Calculates all Leave Balance
* Against given company and user id and Emp ID.
* @param string $uri The URI path
* _getall_emp_leave_balance()
* @return if company or employee is login
*/

if ( ! function_exists('_getall_emp_leave_balance')) {
	 function _getall_emp_leave_balance($comp_id=NULL,$user_id=NULL,$emp_id=NULL,$leave_id=NULL,$month=NULL,$year=NULL,$prev_month=NULL,$param=NULL) {
		 $data=array();
		 if(!empty($comp_id) && !empty($user_id) && !empty($emp_id) && !empty($month) && !empty($year)) {
			$CI =& get_instance();
			//================Balance C/F======================//
			if($param=='cf'){
				if($prev_month==2 && $leave_id!=0){
					$data=$CI->db->select('no_leaves')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'leave_id' =>$leave_id, 'status' => '1'))->get('emp_cf_leaves');
					if($data->num_rows() >0){
						$res=$data->row();
						return  $res->no_leaves;
					} else {
						return '0.00';
					}
					
				} else {
					$cfdate=$year.'-'.$month.'-01';
					$pre_cfdate = date('Y-m-d', strtotime('-1 months', strtotime ($cfdate)));
					$pre_cfdate_arr=explode('-',$pre_cfdate);
					$yr=$pre_cfdate_arr[0];
					$mnt=$pre_cfdate_arr[1];
					$data=$CI->db->select('rest_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'leave_id' =>$leave_id, 'year' => $yr, 'month' => $mnt, 'status' => '1'))->get('emp_attendance_balance');
					if($data->num_rows() >0){
						$res=$data->row();
						return  $res->rest_bal;
					} else {
						return '0.00';
					}
				}
			}
			//================Balance C/F======================//
			//================Leave Credit======================//
			else if($param=='lc'){
				if($prev_month==2 &&  $leave_id!=0){
					$data=$CI->db->select('no_leaves')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'leave_id' =>$leave_id, 'status' => '1'))->get('emp_cf_leaves');
					if($data->num_rows() >0){
						$res=$data->row();
						$rest_bal=$res->no_leaves;
					} else {
						$rest_bal='0.00';
					}
					
				} else {
					$cfdate=$year.'-'.$month.'-01';
					$pre_cfdate = date('Y-m-d', strtotime('-1 months', strtotime ($cfdate)));
					$pre_cfdate_arr=explode('-',$pre_cfdate);
					$yr=$pre_cfdate_arr[0];
					$mnt=$pre_cfdate_arr[1];
					$data=$CI->db->select('rest_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'leave_id' =>$leave_id, 'year' => $yr, 'month' => $mnt, 'status' => '1'))->get('emp_attendance_balance');
					if($data->num_rows() >0){
						$res=$data->row();
						$rest_bal=$res->rest_bal;
					} else {
						$rest_bal='0.00';
					}
				}
				$open_bal_qry=$CI->db->select('opening_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'leave_id' =>$leave_id, 'status' => '1'))->get('emp_attendance_balance');
				if($open_bal_qry->num_rows() >0){
					$res_open_bal=$open_bal_qry->row();
					$open_bal=$res_open_bal->opening_bal;
				} else {
					$open_bal='0.00';
				}
				return $open_bal-$rest_bal;
			}
			//================Leave Credit======================//
			//================Opening Balance======================//
			else if($param=='ob'){
				$open_bal_qry=$CI->db->select('opening_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'leave_id' =>$leave_id, 'status' => '1'))->get('emp_attendance_balance');
				if($open_bal_qry->num_rows() >0){
					$res_open_bal=$open_bal_qry->row();
					$open_bal=$res_open_bal->opening_bal;
				} else {
					$open_bal='0.00';
				}
				return $open_bal;
			}
			//================Opening Balance======================//
			//================Availed======================//
			else if($param=='ab'){
				$availed_bal_qry=$CI->db->select('availed_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'status' => '1','leave_id' =>$leave_id))->get('emp_attendance_balance');
				if($availed_bal_qry->num_rows() >0){
					$res_avail_bal=$availed_bal_qry->row();
					$avail_bal=$res_avail_bal->availed_bal;
				} else {
					$avail_bal='0.00';
				}
				return $avail_bal;
			}
			//================Availed======================//
			//================Closing Balance======================//
			else if($param=='cb'){
				if($leave_id!=0){
					$close_bal_qry=$CI->db->select('rest_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'status' => '1','leave_id' =>$leave_id))->get('emp_attendance_balance');
					if($close_bal_qry->num_rows() >0){
						$res_close_bal=$close_bal_qry->row();
						$close_bal=$res_close_bal->rest_bal;
					} else {
						$close_bal='0.00';
					}
					return $close_bal;
				} else {
					return '0.00';
				}
			}
			//================Closing Balance======================//

		 }
	 }	
}

//=======================Close Employee Leave Balance=============================//

//=======================Employee Total Leave Balance=============================//
/** Added by::: $umit :::
* Calculates Employee Total Leave Balance
* Against given company and user id and Emp ID.
* @param string $uri The URI path
* _get_totalemp_leave_balance()
* @return if company or employee is login
*/

if ( ! function_exists('_get_totalemp_leave_balance')) {
	 function _get_totalemp_leave_balance($comp_id=NULL,$user_id=NULL,$emp_id=NULL,$month=NULL,$year=NULL,$prev_month=NULL,$param=NULL) {
		 $data=array();
		 if(!empty($comp_id) && !empty($user_id) && !empty($emp_id) && !empty($month) && !empty($year)) {
			$CI =& get_instance();
			$lvs=$CI->db->select('id')->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0))->result();
			if(!empty($lvs)){
				$leave_id=array();
				foreach($lvs as $lvs_list){
					$leave_id[]=$lvs_list->id;
				}
				//================Balance C/F======================//
				if($param=='cf'){
					if($prev_month==2){
						$data=$CI->db->select('no_leaves')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_cf_leaves');
						if($data->num_rows() >0){
							$res=$data->result();
							//pr($res); die;
							$leave_bal=0;
							foreach($res as $bal){
								$leave_bal+= $bal->no_leaves;								
							}
							return $leave_bal;
						} else {
							return '0.00';
						}
						
					} else {
						$cfdate=$year.'-'.$month.'-01';
						$pre_cfdate = date('Y-m-d', strtotime('-1 months', strtotime ($cfdate)));
						$pre_cfdate_arr=explode('-',$pre_cfdate);
						$yr=$pre_cfdate_arr[0];
						$mnt=$pre_cfdate_arr[1];
						$data=$CI->db->select('rest_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $yr, 'month' => $mnt, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_attendance_balance');
						if($data->num_rows() >0){
							$res=$data->result();
							$leave_bal=0;
							foreach($res as $bal){
								$leave_bal+= $bal->rest_bal;								
							}
							return $leave_bal;
						} else {
							return '0.00';
						}
					}
				}
				//================Balance C/F======================//
				//================Leave Credit======================//
				else if($param=='lc'){
					if($prev_month==2){
						$data=$CI->db->select('no_leaves')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_cf_leaves');
						if($data->num_rows() >0){
							$res=$data->result();
							$leave_bal=0;
							foreach($res as $bal){
								$leave_bal+= $bal->no_leaves;								
							}
							$tot_rest_bal=$leave_bal;
						} else {
							$tot_rest_bal='0.00';
						}
						
					} else {
						$cfdate=$year.'-'.$month.'-01';
						$pre_cfdate = date('Y-m-d', strtotime('-1 months', strtotime ($cfdate)));
						$pre_cfdate_arr=explode('-',$pre_cfdate);
						$yr=$pre_cfdate_arr[0];
						$mnt=$pre_cfdate_arr[1];
						$data=$CI->db->select('rest_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $yr, 'month' => $mnt, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_attendance_balance');
						if($data->num_rows() >0){
							$res=$data->result();
							$leave_bal=0;
							foreach($res as $bal){
								$leave_bal+= $bal->rest_bal;								
							}
							$tot_rest_bal=$leave_bal;
						} else {
							$tot_rest_bal='0.00';
						}
					}
					$open_bal_qry=$CI->db->select('opening_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_attendance_balance');
					//echo $CI->db->last_query(); exit;
					if($open_bal_qry->num_rows() >0){
						$res_open_bal=$open_bal_qry->result();
						$tot_open_bal=0;
						foreach($res_open_bal as $open_bal){
							$tot_open_bal+= $open_bal->opening_bal;								
						}
						
					} else {
						$tot_open_bal='0.00';
					}
					
					return $tot_open_bal-$tot_rest_bal;
				}
				//================Leave Credit======================//
				//================Opening Balance======================//
			else if($param=='ob'){
				$open_bal_qry=$CI->db->select('opening_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_attendance_balance');
				//echo $CI->db->last_query(); exit;
				if($open_bal_qry->num_rows() >0){
					$res_open_bal=$open_bal_qry->result();
					$tot_open_bal=0;
					foreach($res_open_bal as $open_bal){
						$tot_open_bal+= $open_bal->opening_bal;								
					}
					
				} else {
					$tot_open_bal='0.00';
				}
				return $tot_open_bal;
			}
			//================Opening Balance======================//
			//================Availed======================//
			else if($param=='ab'){
				$availed_bal_qry=$CI->db->select('availed_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_attendance_balance');
				if($availed_bal_qry->num_rows() >0){
					$res_avail_bal=$availed_bal_qry->result();
					$tot_avail_bal=0;
					foreach($res_avail_bal as $avail_bal){
						$tot_avail_bal+= $avail_bal->availed_bal;								
					}
				} else {
					$tot_avail_bal='0.00';
				}
				return $tot_avail_bal;
			}
			//================Availed======================//
			//================Closing Balance======================//
			else if($param=='cb'){
				$close_bal_qry=$CI->db->select('rest_bal')->where(array('comp_id'=>$comp_id, 'user_id' => $user_id,'emp_id' => $emp_id, 'year' => $year, 'month' => $month, 'status' => '1'))->where_in('leave_id',$leave_id)->get('emp_attendance_balance');
				if($close_bal_qry->num_rows() >0){
					$res_close_bal=$close_bal_qry->result();
					$tot_close_bal=0;
					foreach($res_close_bal as $close_bal){
						$tot_close_bal+= $close_bal->rest_bal;								
					}
				} else {
					$tot_close_bal='0.00';
				}
				return $tot_close_bal;
			}
			//================Closing Balance======================//
			}
		 }
	 }	
}

//=======================Close Employee Total Leave Balance=============================//

//============================Employee Attendance Process=============================//

	/** Added by::: $sumit :::
	* Employee Attendance process or not 
	* Against given company and user id and emp ID.
	* @param string $uri The URI path
	* _is_employee_attendance_process()
	* @return if company or employee is login
	*/
	if ( ! function_exists('_is_employee_attendance_process')) {
		function _is_employee_attendance_process($comp_id=NULL,$user_id=NULL,$emp_id=FALSE) {
			if($comp_id && $user_id && $emp_id){
				$CI =& get_instance();
				$CI->db->where(array('comp_id'=>$comp_id,'user_id'=>$user_id,'emp_id'=>$emp_id));
				$CI->db->from('process_attendance');
				$total = $CI->db->count_all_results();
				if($total){
					return true;
				}
			}
			return false;
		}
	}

//=========================Employee Attandance process=================================//

//==========================Get Employee Attendence View===========================//
/** Added by::: $sumit :::
	* Employee attendence view 
	* Against given company and user id and emp ID.
	* string $uri The URI path
	* _get_emp_attendence_view()
	*  if company or employee is login
	*/
	if ( ! function_exists('_get_emp_attendence_view')) {
    	function _get_emp_attendence_view($comp_id=NULL, $user_id=NULL, $emp_id = null, $att_date = null, $dateVal, $dtclr, $showclr, $show, $topHalf, $bottomHalf){
    		$original_td_middle="";
            $original_td_top="";
    		$CI = &get_instance();
    		$lvs = $CI->db->get_where("update_attendance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'att_date' => $att_date, 'status !='=>0));
    		$data['lrows'] = $lvs->num_rows();
    		$pre = null;
    		if($data['lrows'])
    		{
    			$info = $lvs->row();
    			$data['balance'] = $info->balance;
    			$data['is_weekoff'] = $info->is_weekoff;
    			$data['half_holiday'] = $info->half_holiday;
    			$data['type'] = $info->type;
    			
    			if($data['lrows'] == 1 && $data['balance'] == 0.5 && $data['is_weekoff'] == 0 && $data['half_holiday'] == 0)
    			{
    				$show =  'Present';
                    $showclr = '#555';
    			}
    			else
    			{
    				$show = 'Absent(UL)';
                    $showclr = '#2F4F4F';
    			}
    			
    			if($data['type'])
    			{
    				$show = 'Compoff Working';
                    $showclr = 'black';
    			}
    			
    			$cls = 'mark-half-11';
    			$pre = '<div class="week-cla-light-gray"><div class="schedule-1">';
    			$i = 0;
    			foreach($lvs->result() as $rec)
    			{
    				if($rec->leave_id)
    				{
    					$lqry =  $CI->db->select('color_code,short_name')->get_where('setup_leave_policy', array('id' => $rec->leave_id, "comp_id" => $comp_id, "user_id" => $user_id))->row();
    					//$clrcd = $lqry->color_code; 
						$clrcd = '';
						$show = 'Absent('.$lqry->short_name.')';
                        $showclr = $lqry->color_code;

    				}
    				else
    				{
    					$clrcd = '#666666';
    				}
    				if($i == 1)
    				{
    					$cls = 'mark-half-22';
    				}
    				$pre .= '<div class="'.$cls.'" style="background:'.$clrcd.'; color:#fff;"></div>';
    				$i++;
    			}
    				if($i == 1)
    				{
    					//$clrcd = ($data['balance'] == 1) ? $clrcd : 'white';
    					if($data['balance'] == 1)
    					{
    						$clrcd = $clrcd;
    						//$showclr = 'white';
							//$showclr = 'black';
    					}
    					else
    					{
    						$clrcd = 'white';
    						//$showclr = 'black';
    					}
    					
    					if($data['half_holiday'] == 2)
    					{
    						$clrcd = '#006600';
    						//$showclr = 'black';
    					}
    					$pre .= '<div class="mark-half-22" style="background:'.$clrcd.';"></div>';
    				}
    				elseif($i == 2)
    				{
    					//$showclr = 'white';
						//$showclr = 'black';
    				}
    				$pre .= '<samp class="schedule"><span class="schedule-shiftTop">'.$dateVal.'</span></samp><span style="color:'.$showclr.'">'.$show.'</span>
    					</div></div>';
    		}
    		else
    		{
    		  $pre .='<div class="week-cla-light-gray"><div class="schedule-1"><div class="mark-half-11" style="background:'.$topHalf.'"></div><div class="mark-half-22" style="background:'.$bottomHalf.'"></div> <samp class="schedule"> <span class="schedule-shiftTop">'.$dateVal.'</span> </samp> <span style="color:'.$showclr.'">'.$show.'</span></span></div></div>';
            }
    		return $pre;
    	}
    }
//=======================Close EMployee Attaendence View============================//

//==================Company Logo Details=======================================//
/** Added by::: $sumit :::
	* Company logo
	* Against given company and user id .
	* string $uri The URI path
	* _is_company_logo_details()
	*  if company or employee is login
	*/
	if ( ! function_exists('_is_company_logo_details')) {
    	function _is_company_details($comp_id=NULL, $user_id=NULL){
			$CI =& get_instance();
			if($CI->db->database!='tekhrm_central') {
			 mysql_select_db($CI->db->database); //added by sumit on 23 dec 15
                //$CI->db = $CI->load->database($CI->db->database, TRUE);
            }
			$data=array();
			$data['logo'] = PUBLIC_URL.'images/tekhrm-logo.png';
			$data['website']='';
			
			$clogo=$CI->db->select('comp_logo,comp_website')->get_where("company_basic_details",array('comp_id' => $comp_id, 'user_id' => $user_id, 'status'=>'1'));
			//echo $CI->db->database; 
			//echo $CI->db->last_query(); die;
			if($clogo->num_rows()){ 
				$logo_det=$clogo->row();
				$data['logo'] = PUBLIC_URL.'images/company/'.$logo_det->comp_logo;
				$data['website'] = $logo_det->comp_website;
			
			}
			$qry1=$CI->db->select('comp_name, phone,country, state, city,address')->get_where("company_registration", array("id" => $comp_id, 'status !=' => 0));
			if($qry1->num_rows()){
				$comp_detl=$qry1->row();
				$data['comp_name']=$comp_detl->comp_name;
				$data['phone']=$comp_detl->phone;
				$data['country']=isset($comp_detl->country) && !empty($comp_detl->country) ? $CI->db->get_where('location',array('id' => $comp_detl->country),1)->row()->name : '';
				$data['state']=isset($comp_detl->state) && !empty($comp_detl->state) ? $CI->db->get_where('location',array('id' => $comp_detl->state),1)->row()->name : '';
				$data['city']=isset($comp_detl->city) && !empty($comp_detl->city) ? $CI->db->get_where('location',array('id' => $comp_detl->city),1)->row()->name : '';
				$data['address']=$comp_detl->address;
			}
			return $data;
		}

	}
//========================Close Company Logo Details=============================//

//=====================employee prev month balance or not==========================//
/** Added by::: $sumit :::
	* Company logo
	* Against given company and user id .
	* string $uri The URI path
	* _is_company_logo_details()
	*  if company or employee is login
	*/
	if ( ! function_exists('_is_employee_prev_month')) {
		function _is_employee_prev_month($emp_id=NULL,$c_id=NULL,$user_id=FALSE,$join_date=FALSE,$pyear=FALSE,$pmonth=FALSE) {
			if($emp_id && $c_id && $user_id && $join_date){
                $CI =& get_instance();
				$process_query=$CI->db->select('year,month')->order_by('id', 'Asc')->get_where("emp_attendance_balance",array("comp_id" => $c_id, 'user_id' => $user_id, 'emp_id' => $emp_id),1)->row();
				$process_date='0000-00-00';
                if($process_query){
                    $process_month=$process_query->month < 10 ? "0$process_query->month"  : $process_query->month;
                    $process_date=$process_query->year.'-'.$process_month.'-01';
                }
				$process_start=$process_date;
                if($join_date>$process_date) {
                   $process_start=$join_date;
                }
				$start_date=explode('-',$process_start);
                $start_yr=$start_date['0'];
				$process_query1=$CI->db->select('module_effective_date,mod_id')->get_where("company_pricing",array("c_id" => $c_id, 'user_id' => $user_id));
                
                $start_mnt='';                
                if($process_query1->num_rows()){
                    $mod_process_date=$process_query1->row()->module_effective_date;
                    $mod_ym=explode('-',$mod_process_date);
                    $start_mnt=$mod_ym['1'];
                }
				if($pyear==$start_yr && $pmonth==$start_mnt){
					return 2;
				}
			}
            return 1;
		}
		
	}


//=====================Close employee prev month balance or not==========================//

//====================================Close Sumit=======================================//

//====================================Shashank=======================================//

/** Added by::: $hashank :::
* Calculates all categories , all Departments And all Designation 
* Against given company and user id.
* @param string $uri The URI path
* _getall_CAT_DESG_DEPT()
* @return if company or employee is login
*/
if ( ! function_exists('_getall_CAT_DESG_DEPT')) {
    function _getall_CAT_DESG_DEPT($c_id=NULL,$u_id=NULL,$CATG=FALSE,$DESG=FALSE,$DEPT=FALSE,$GRADE=FALSE,$loc=FALSE) {
		$data=array();
		if(!empty($c_id) && !empty($u_id)) {
			$CI =& get_instance();
			if($CATG) {
				$CI->db->select('id,cat_name');
				$catg=$CI->db->order_by('cat_name Asc')->get_where("company_category_master",array("user_id"=>$u_id,"c_id"=>$c_id,"status"=>1))->result();
				$data['category'] = array();
				foreach($catg as $row) {
					$data['category'][$row->id] = $row->cat_name;
				}
			}
			if($DESG) {
				$CI->db->select('id,desg_name');
				$desg=$CI->db->order_by('desg_name Asc')->get_where("company_designation_master",array("user_id"=>$u_id,"c_id"=>$c_id,"status"=>1))->result();
				$data['designation'] = array();
				foreach($desg as $row) {
					$data['designation'][$row->id] = $row->desg_name;
				}
			}
			if($DEPT) {
				$CI->db->select('id,dept_name');
				$dept=$CI->db->order_by('dept_name Asc')->get_where("company_department_master",array("user_id"=>$u_id,"c_id"=>$c_id,"status"=>1))->result();
				$data['department'] = array();
				foreach($dept as $row) {
					$data['department'][$row->id] = $row->dept_name;
				}
			}
			if($GRADE) {
				$CI->db->select('id,grade_name,level');
				$grd=$CI->db->order_by('grade_name Asc')->get_where("grade_master",array("user_id"=>$u_id,"comp_id"=>$c_id,"status"=>1))->result();
				$data['grade'] = array();
				foreach($grd as $row) {
					$data['grade'][$row->id] = $row->grade_name.'&nbsp;(Level '.$row->level.')';
				}
			}
            if($loc){
                $CI->db->select('id,loc_name');
				$loc=$CI->db->order_by('loc_name Asc')->get_where("company_location",array("user_id"=>$u_id,"comp_id"=>$c_id,"status"=>1))->result();
				$data['loc'] = array();
				foreach($loc as $row) {
					$data['loc'][$row->id] = $row->loc_name;
				}
            }
			return $data;
		}
		return FALSE;
	}
 }

/* Added by::: $hashank ::: */
/* all_location
 * @param	String of all location as array (Int) key
 * @return	String
 */

if ( ! function_exists('_get_locBYcompany')) { 
	function _get_locBYcompany($c_id=NULL,$u_id=NULL,$param=FALSE) {
		if(!empty($c_id) && !empty($u_id)) {
			$CI =& get_instance();
			($param) ? ($CI->db->select('id,loc_name,city,state,off_type')) : ($CI->db->select('id,loc_name'));
            $CI->db->order_by('loc_name');
			$CI->db->where('user_id',$u_id);
			$CI->db->where('comp_id',$c_id);
			$qury=$CI->db->get('company_location');
            if($qury->num_rows()){
                return $qury->result();
            }
		}
		return FALSE;
	}  
}

/* Added by::: $hashank ::: */
/* Get Department name Designation name and category name by their id
 * @param	String of cat/dept/desg as long (String) key
 * @return	String
 */

if ( ! function_exists('_get_catnm_desgnm_deptnm')) { 
	function _get_catnm_desgnm_deptnm($id=NULL,$param=NULL) {
		if(!empty($id)) {
			$CI =& get_instance();
			if($param=='cat') {
				$data=$CI->db->select('cat_name')->where(array('id'=>$id, 'status' => 1))->get('company_category_master')->row();
				return ucfirst($data->cat_name);
			} else if ($param=='dept') {
				$data=$CI->db->select('dept_name')->where(array('id'=>$id, 'status' => 1))->get('company_department_master')->row();
				return ucfirst($data->dept_name);
			} else if($param=='desg') {
				$data=$CI->db->select('desg_name')->where(array('id'=>$id, 'status' => 1))->get('company_designation_master')->row();
				return ucfirst($data->desg_name);
			} else if($param=='grade') {
				$data=$CI->db->select('grade_name,level')->where(array('id'=>$id, 'status' => 1))->get('grade_master')->row();
				return ucfirst($data->grade_name.'&nbsp;(Level '.$data->level.')');
			} else if($param=='loc') {
				$data=$CI->db->select('loc_name')->where(array('id'=>$id, 'status' => 1))->get('company_location')->row();
				return ucfirst($data->loc_name);
			}
		} else if($param=='loc' && $id==0) {
			return 'All';
		}
		return FALSE;
	}  
}

/* Added by::: $hashank ::: */
/* Function to get profile image of user
 * @param	return User name/profile pic/employee code
 * @param	return default image/NULL profile/Null employee code for no user
 * @return	String
 */

if ( ! function_exists('employee_profile_detail')) { 
	function employee_profile_detail($c_id=NULL,$u_id=NULL,$emp_id=FALSE) {
		if(!empty($c_id) && !empty($u_id)) {
			$CI =& get_instance();
			if($emp_id) {
				$data=$CI->db->select('emp_code,salutation,f_name,l_name,profile_pic')->where(array('id'=>$emp_id,'c_id'=>$c_id,'user_id'=>$u_id))->get('company_employee')->row();
				if(!empty($data)) {
					if(is_null($data->profile_pic)) {
						$data->profile_pic = PUBLIC_URL.'images/company/profile_default.jpg';
						if($data->salutation==1) {
							$data->profile_pic = PUBLIC_URL.'images/company/men_default.jpg';
						} elseif(!empty($data->salutation)) {
							$data->profile_pic = PUBLIC_URL.'images/company/women_default.jpg';
						}
					} else {
						$data->profile_pic = PUBLIC_URL.'images/company/employee_pics/'.$data->profile_pic;
					}
				} else {
					$data = new StdClass();
					$data->emp_code = $data->f_name = $data->l_name = NULL;
					$data->profile_pic = PUBLIC_URL.'images/company/profile_default.jpg';
				}
				return $data;
			} else {
				$data = new StdClass();
				$data->emp_code = substr(trim($CI->session->userdata['activecomdata']['company']), 0, 3).'*****';
				$data->f_name = 'New';
				$data->l_name = 'Employee';
				$data->profile_pic = PUBLIC_URL.'images/company/profile_default.jpg';
				return $data;
			}
		}
		return FALSE;
	}  
}


//====================================Shashank Ends=======================================//

if(!function_exists('getAllStates')) {
    function getAllStates($name = NULL, $par1 = NULL, $par2 = NULL)
	{ 
        $dropdown = '<select name="'.$name.'" id="'.$name.'" style="margin-bottom:0;" onchange="getCities(this.value, '.$par1.')">
					  <option value="">Select</option>
					  <option value="1" ';
	  	if($par2 == 1) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Andra Pradesh</option>
					  <option value="2"';
		if($par2 == 2) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Arunachal Pradesh</option>
					  <option value="3"';
		if($par2 == 3) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Assam</option>
					  <option value="4"';
		if($par2 == 4) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Bihar</option>
					  <option value="5"';
		if($par2 == 5) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Chhattisgarh</option>
					  <option value="6"';
		if($par2 == 6) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Goa</option>
					  <option value="7"';
		if($par2 == 7) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Gujarat</option>
					  <option value="8"';
		if($par2 == 8) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Haryana</option>
					  <option value="9"';
		if($par2 == 9) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Himachal Pradesh</option>
					  <option value="10"';
		if($par2 == 10) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Jammu and Kashmir</option>
					  <option value="11"';
		if($par2 == 11) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Jharkhand</option>
					  <option value="12"';
		if($par2 == 12) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Karnataka</option>
					  <option value="13"';
		if($par2 == 13) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Kerala</option>
					  <option value="14"';
		if($par2 == 14) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Madya Pradesh</option>
					  <option value="15"';
		if($par2 == 15) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Maharashtra</option>
					  <option value="16"';
		if($par2 == 16) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Manipur</option>
					  <option value="17"';
		if($par2 == 17) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Meghalaya</option>
					  <option value="18"';
		if($par2 == 18) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Mizoram</option>
					  <option value="19"';
		if($par2 == 19) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Nagaland</option>
					  <option value="20"';
		if($par2 == 20) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Orissa</option>
					  <option value="21"';
		if($par2 == 21) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Punjab</option>
					  <option value="22"';
		if($par2 == 22) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Rajasthan</option>
					  <option value="23"';
		if($par2 == 23) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Sikkim</option>
					  <option value="24"';
		if($par2 == 24) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Tamil Nadu</option>
					  <option value="25"';
		if($par2 == 25) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Tripura</option>
					  <option value="26"';
		if($par2 == 26) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Uttaranchal</option>
					  <option value="27" ';
		if($par2 == 27) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Uttar Pradesh</option>
					  <option value="28"';
		if($par2 == 28) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>West Bengal</option>
					  <option value="29"';
		if($par2 == 29) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Union Territories</option>
					  <option value="30"';
		if($par2 == 30) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Andaman and Nicobar Islands</option>
					  <option value="31"';
		if($par2 == 31) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Chandigarh</option>
					  <option value="32"';
		if($par2 == 32) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Dadar and Nagar Haveli</option>
					  <option value="33"';
		if($par2 == 33) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Daman and Diu</option>
					  <option value="34"';
		if($par2 == 34) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Delhi</option>
					  <option value="35"';
		if($par2 == 35) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Lakshadeep</option>
					  <option value="36"';
		if($par2 == 36) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Pondicherry</option>
						<option value="1477"';
		if($par2 == 1477) 
		{
			$dropdown .= 'selected';
		}
		$dropdown .= '>Uttarakhand</option>			
					</select>';
		return $dropdown;
	}
}

//=====================Employee Leave List================================================//
 function _getEmpLeaves($comp_id=NULL, $user_id=NULL, $emp_id = NULL, $assignedLType = null, $cddgId = null, $emp_cat_id = null){
        $CI = &get_instance(); 
		$data=array();	
		if($comp_id && $user_id)
		{
			$probCatsArr = array();
			$probCatsQry = $CI->db->select('cat_id')->get_where('company_probation_policy', array('c_id'=>$comp_id, 'user_id' => $user_id, 'status != ' => 0));
			if($probCatsQry->num_rows())
			{
				foreach($probCatsQry->result() as $prec)
				{
					$probCatsArr[] = $prec->cat_id; //for new joiners
				}
			}
			
			$where=array('comp_id'=>$comp_id, 'user_id' => $user_id, 'white_list_emp' => $emp_id);
            
			$mQry=$CI->db->get_where('company_assign_leave', $where);
            //pr($result); die;
			if($mQry->num_rows() == 0)
			{
				$where = array('comp_id'=>$comp_id, 'user_id' => $user_id, 'leave_for' => $assignedLType, 'cddc_code' => $cddgId);
				
				$mQry = $CI->db->get_where('company_assign_leave', $where);
            }
			
			//pr($mQry->result()); 
			//die;
			$i=0;
			foreach($mQry->result() as $rec)
			{
				$lvs=$CI->db->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $rec->leave_id, 'status !='=>0));
				if($lvs->num_rows())
				{
					$info = $lvs->row();
					//pr($info);
					$runQry = true;
					if(!empty($probCatsArr))
					{
						if(in_array($emp_cat_id, $probCatsArr))
						{
							if(!$info->eligible_probemp)//checks if the leave is eligible for probationary emps
							{
								$runQry = false;	
							}
							if($comp_id=='30')//checks if the company Gohrmand employee in probation then leave count 0 added by sumit on 24 oct 2016
							{
								$runQry = false;	
							}
						}
					}
					if($runQry)
					{
						$data[$i]['leave_id'] = $info->id;
						$data[$i]['leave_cat'] = $info->leave_cat;
						$data[$i]['leave_name'] = ucwords($info->leave_name);
						$data[$i]['short_name'] = $info->short_name;
						$data[$i]['color_code'] = $info->color_code;
						$data[$i]['halfday_allowed'] = $info->halfday_allowed;
						$data[$i]['canbe_clubbed'] = $info->canbe_clubbed; 
						$data[$i]['clubbed_with'] = $rec->clubwith_id;
						$data[$i]['clubLeave'] = $rec->clubwith_id ? $CI->db->select('leave_name')->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $rec->clubwith_id, 'status !='=>0))->row()->leave_name : '';
						$i++;
					}
				}
			}
			//pr($data);
            return $data;
        }
    }

//=====================Employee Leave List================================================//
 function _getLeavesDetailsByLid($comp_id=NULL, $user_id=NULL, $leave_id = null){
        $CI = &get_instance(); 
		$data=array();
		if($leave_id)
		{
			$lvs=$CI->db->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $leave_id, 'status !='=>0));
			if($lvs->num_rows())
			{
				$info = $lvs->row();
				$data['leave_id'] = $info->id;
				$data['leave_cat'] = $info->leave_cat;
				$data['leave_name'] = $info->leave_name;
				$data['short_name'] = $info->short_name;
				$data['color_code'] = $info->color_code;
				$data['halfday_allowed'] = $info->halfday_allowed;
				$data['canbe_clubbed'] = $info->canbe_clubbed; 
				$data['clubbed_with'] = $info->clubbed_with;
				$data['clubLeave'] = $info->clubbed_with ? $CI->db->select('leave_name')->get_where("setup_leave_policy", array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $info->clubbed_with, 'status !='=>0))->row()->leave_name : '';
			}
		}
	return $data;		
}
//=====================Employee Leave List================================================//
 function _isOpeningBalMade($comp_id, $user_id, $emp_id, $leave_id, $smonth, $syear){
        $CI = &get_instance(); 
		$data=array();
		$lvs=$CI->db->get_where("emp_attendance_balance", array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'leave_id' => $leave_id, 'month' => $smonth, 'year' => $syear, 'status !=' => 0));
		if($lvs->num_rows())
		{
			$info = $lvs->row();
			$data['opening_bal'] = $info->opening_bal;
			$data['availed_bal'] = $info->availed_bal;
			$data['rest_bal'] = $info->rest_bal;
		}	
 	return $data;
 }
//=====================Employee Leave List================================================//
 function _getCompanyDetails($comp_id){
        $CI = &get_instance(); 
		$data=array();
		$qry1=$CI->db->select('comp_name, phone, state, country')->get_where("company_registration", array("id" => $comp_id, 'status !=' => 0));
		if($qry1->num_rows())
		{
			$qry2=$CI->db->select('comp_logo, comp_website')->get_where("company_basic_details", array("comp_id" => $comp_id, 'status !=' => 0));
			$data = array('cnameData' => $qry1->row(), 'clogoData' => $qry2->row());
		}	
		//pr($data);
 	return $data;
 }
/*------------------------------------------------------------------------------*//// 
 if ( ! function_exists('_getShiftByDateInReq')) {
    function _getShiftByDateInReq($comp_id = NULL, $user_id = NULL, $emp_id = NULL, $date = NULL, $changeShift = 0) {
		$data=array();
		$CI =& get_instance(); 
		if(!$changeShift)
		{
			$qry1 = $CI->db->select('shift_id, is_inshift, sft_name, sft_code, in_time, out_time, is_next_day')->from('auto_emp_attendance as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.comp_id" => $comp_id, "tbl2.user_id" => $user_id, 'tbl2.emp_id' => $emp_id,  'parent_id' => 0, 'tbl2.created_date' => $date, 'tbl2.status !='=>0))->get();
			if($qry1->num_rows()) //(a row is there)emp clocked into that shift
			{ 
				$data['hasClockedIn'] = 1;
				foreach($qry1->result() as $rec1)
				{
					$data['shift_id'][] = $rec1->shift_id;
					$data['sft_name'][$rec1->shift_id] = $rec1->sft_name;
					$data['in_time'][$rec1->shift_id] = $rec1->in_time;
					$data['out_time'][$rec1->shift_id] = $rec1->out_time;
					$data['is_next_day'][$rec1->shift_id] = $rec1->is_next_day;
				}
			}
			else //Shift was assigned but emp didnt clock into that shift
			{
				$CI->session->userdata['userinfo']->shift_type == 1 ? $CI->db->where("tbl2.effective_from <= ", $date) : $CI->db->where("tbl2.effective_from", $date);
				
				$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, "tbl2.status" => 1))->get(); 
				//echo $CI->db->last_query();
				if($dataQ->num_rows()) 
				{
					$data['hasClockedIn'] = 0;
					foreach($dataQ->result() as $rec1)
					{
						$data['shift_id'][] = $rec1->shift_id;
						$data['sft_name'][$rec1->shift_id] = $rec1->sft_name;
						$data['in_time'][$rec1->shift_id] = $rec1->in_time;
						$data['out_time'][$rec1->shift_id] = $rec1->out_time;
						$data['is_next_day'][$rec1->shift_id] = $rec1->is_next_day;
					}					
				}
			}
		}
		else //Shift was not assigned 
		{
			$dataQ = $CI->db->select('id, sft_name, sft_code, in_time, out_time, is_next_day')->get_where('company_shift_master', array("user_id" => $user_id, "comp_id" => $comp_id, "status" => 1));
			if($dataQ->num_rows()) 
			{	
				$data['hasClockedIn'] = 0;
				foreach($dataQ->result() as $rec1)
				{
					$data['shift_id'][] = $rec1->id;
					$data['sft_name'][$rec1->id] = $rec1->sft_name;
					$data['in_time'][$rec1->id] = $rec1->in_time;
					$data['out_time'][$rec1->id] = $rec1->out_time;
					$data['is_next_day'][$rec1->id] = $rec1->is_next_day;
				}	
			}
		}
		return $data;
	}
 }
/*------------------------------------------------------------------------------*//// 
 if ( ! function_exists('_getShiftByDate')) {
    function _getShiftByDate($comp_id=NULL, $user_id=NULL, $emp_id=FALSE, $date=FALSE) {
		$data=array();
		$CI =& get_instance(); 
		$predate = date('Y-m-d', strtotime($date) - 86400); //1 day before
		$currTm = date('H:i:s'); //24 hr format
		$lastTs = strtotime('23:59:59');
		$startTs = strtotime('00:00:00');
		$currTs = strtotime($currTm); //OR time();

		if($CI->session->userdata['userinfo']->shift_type == 1)
		{
			$CI->db->where("tbl2.effective_from <= ", $predate);
		}
		else
		{ 
			$CI->db->where("tbl2.effective_from", $predate);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, 'tbl1.is_next_day' => 1, "tbl2.status" => 1))->get(); 
		if($dataQ->num_rows()) //if NIGHT shift is there coming from prev date in current date, 1st fetch that shift
		{ 
			$nsinfo = $dataQ->row();
			$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $nsinfo->shift_id, 'parent_id' => 0, 'created_date' => $predate, 'status !='=>0));		
			if($qry1->num_rows()) //(a row is there)either emp has clocked into that night shift
			{ 
				$info = $qry1->row();
				if($info->is_inshift == 1)
				{
					return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 1);
				}
			}
			else
			{ 
				if($currTs < strtotime($nsinfo->out_time))
				{
					return array('shift_id' => $nsinfo->shift_id, 'is_onbreak' => 0, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
				}
			}	
		}
		//if no NIGHT shift is there coming from prev date in current date, then fetch all current day shifts.
		if($CI->session->userdata['userinfo']->shift_type == 1)
		{
			$CI->db->where("tbl2.effective_from <= ", $date);
		}
		else
		{
			$CI->db->where("tbl2.effective_from", $date);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, "tbl2.status" => 1))->get();	
		//echo $CI->db->last_query();  
		if($dataQ->num_rows())
		{ 
			//pr($dataQ->result()); die;
			foreach($dataQ->result() as $rec)
			{ 
				$inTs = strtotime($rec->in_time);
				$outTs = strtotime($rec->out_time);
				if($rec->is_next_day)//night shift
				{
						$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));	
						//echo $CI->db->last_query(); die;
						if($qry1->num_rows() == 0) //check previous date`s shift
						{
							$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $predate, 'status !='=>0));		
						}
						if($qry1->num_rows()) //(a row is there)either emp has clocked into this shift or clocked out.
						{ 
							$info = $qry1->row();
							if($info->is_inshift == 1)//if emp has not clocked out the prev date`s shift
							{
								return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 1);
							}
							else//if emp has clocked out the prev date`s shift, current date`s night shift will be shown
							{
								if(($currTs >= $inTs && $currTs <= $lastTs) || ($currTs >= $startTs && $currTs < $outTs))//in next day to enable the emp to clockin before the out time of shift.
								{
									return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
								}	
							} 	
						}
						else //The emp has not clocked into the shift yet.
						{
							if(($currTs >= $inTs && $currTs <= $lastTs) || ($currTs >= $startTs && $currTs < $outTs))//in next day to enable the emp to clockin before the out time of shift.
							{
								return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
							}
						}
				}
				else //day shift
				{ 
					if(strtotime($rec->in_time) <= $currTs)
					{
						$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));	
						if($qry1->num_rows()) //either emp has clocked into this shift or clocked out.
						{ 
							$info = $qry1->row();
							if($info->is_inshift == 1)
							{ 
								return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 0);
							}	
						}
						else //The emp has not clocked into the shift yet.
						{
							$inTs = strtotime($rec->in_time);
							$outTs = strtotime($rec->out_time);
							if($outTs > $currTs) //to enable the emp to clockin before the out time of shift.
							{ 
								return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 0);
							}
						}
					}
				}
			}
		}
		return array();
	}
}

//=========================Sumit Function===========================//
if ( ! function_exists('_getShiftByDatedate')) {
    function _getShiftByDatedate($comp_id=NULL, $user_id=NULL, $emp_id=FALSE, $date=FALSE) {
		$data=array();
		$CI =& get_instance(); 
		$predate = date('Y-m-d', strtotime($date) - 86400); //1 day before
		$currTm = date('H:i:s'); //24 hr format
		$lastTs = strtotime('23:59:59');
		$startTs = strtotime('00:00:00');
		$currTs = strtotime($currTm); //OR time();
        $nxtshftlastTs = strtotime('14:00:00');
        if($CI->session->userdata['userinfo']->shift_type == 1)
		{
			$CI->db->where("tbl2.effective_from <= ", $predate);
		}
		else
		{ 
			$CI->db->where("tbl2.effective_from", $predate);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, 'tbl1.is_next_day' => 1, "tbl2.status" => 1))->get(); 
		if($dataQ->num_rows()) //if NIGHT shift is there coming from prev date in current date, 1st fetch that shift
		{ 
		  
			$nsinfo = $dataQ->row();
			$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $nsinfo->shift_id, 'parent_id' => 0, 'created_date' => $predate, 'status !='=>0));		
			if($qry1->num_rows()) //(a row is there)either emp has clocked into that night shift
			{ 
			 
				$info = $qry1->row();
				if($info->is_inshift == 1 && strtotime($currTm)<=$nxtshftlastTs)
				{
				    
					return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 1);
				}
			}
			else
			{
   			  
				if($currTs < strtotime($nsinfo->out_time))
				{
					return array('shift_id' => $nsinfo->shift_id, 'is_onbreak' => 0, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
				}
			}	
		}
        
        //==============New code for same date if shift not clock out=================//
        if($CI->session->userdata['userinfo']->shift_type == 1)
		{
			$CI->db->where("tbl2.effective_from <= ", $date);
		}
		else
		{ 
			$CI->db->where("tbl2.effective_from", $date);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, 'tbl1.is_next_day' => 0, "tbl2.status" => 1))->get(); 
		//echo $CI->db->last_query(); exit;
        if($dataQ->num_rows()) //if day shift not clock out yet now 12nd fetch that shift
		{ 
		  
			$nsinfo = $dataQ->row();
			$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $nsinfo->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));		
			//echo $CI->db->last_query(); exit; 
            if($qry1->num_rows()) //(a row is there)either emp has clocked into that night shift
			{ 
			 
				$info = $qry1->row();
				if($info->is_inshift == 1 && strtotime($currTm)<=$lastTs)
				{
				    
					return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 0);
				}
			}
			
		}
        //==============New code for same date if shift not clock out=================//
        
		//if no NIGHT shift is there coming from prev date in current date, then fetch all current day shifts.
		if($CI->session->userdata['userinfo']->shift_type == 1)
		{
            $CI->db->order_by('tbl2.effective_from','Desc');
            $CI->db->order_by('tbl2.id','Desc');
			$CI->db->where("tbl2.effective_from <= ", $date);
		}
		else
		{
			$CI->db->where("tbl2.effective_from", $date);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, "tbl2.status" => 1))->get();	
		//echo $CI->db->last_query();  
		if($dataQ->num_rows())
		{ 
			//pr($dataQ->result()); die;
			foreach($dataQ->result() as $rec)
			{ 
			 
				$inTs = strtotime($rec->in_time);
				$outTs = strtotime($rec->out_time);
				if($rec->is_next_day)//night shift
				{
				   
						$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));	
						//echo $CI->db->last_query(); die;
						$chkvar='0';
                        if($qry1->num_rows() == 0) //check previous date`s shift
						{
						  $chkvar=1;
							$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $predate, 'status !='=>0));		
						}
						if($qry1->num_rows()) //(a row is there)either emp has clocked into this shift or clocked out.
						{ 
						  
							$info = $qry1->row();
							if($info->is_inshift == 1 && ($chkvar==1 && strtotime($currTm)<=$nxtshftlastTs || $chkvar==0) )//if emp has not clocked out the prev date`s shift
							{
								return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 1);
							}
							else//if emp has clocked out the prev date`s shift, current date`s night shift will be shown
							{
							    if(($currTs >= $inTs && $currTs <= $lastTs) || ($currTs >= $startTs && $currTs < $outTs))//in next day to enable the emp to clockin before the out time of shift.
								{
									return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
								} 
                                if(($inTs >= $currTs && $currTs <= $lastTs) || ( ($outTs >= $currTs) && ($currTs >= $startTs))){
                                    return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
                                }	
							} 	
						}
						else //The emp has not clocked into the shift yet.
						{
						  
						  //============Check by sumit===//
							if(($currTs >= $inTs && $currTs <= $lastTs) || ($currTs >= $startTs && $currTs < $outTs))//in next day to enable the emp to clockin before the out time of shift.
							{
								return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
							}
                            if(($inTs >= $currTs && $currTs <= $lastTs) || ( ($outTs >= $currTs) && ($currTs >= $startTs))){
                                return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
                            }
						}
				}
				else //day shift
				{ 
				    
				    $qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift, emp_in_time, emp_out_time')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));
					//echo $CI->db->last_query(); exit;
                    if(strtotime($rec->in_time) <= $currTs)
					{	
					   //echo '1'; die;
						if($qry1->num_rows()) //either emp has clocked into this shift or clocked out.
						{ 
							$info = $qry1->row();
							if($info->is_inshift == 1)
							{ 
								return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 0);
							}	
						}
						else //The emp has not clocked into the shift yet.
						{
							$inTs = strtotime($rec->in_time);
							$outTs = strtotime($rec->out_time);
							if($outTs > $currTs) //to enable the emp to clockin before the out time of shift.
							{ 
								return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 0);
							}
						}
					}
                    if(strtotime($rec->in_time) >= $currTs && strtotime($rec->out_time) >= $currTs){
                        if($qry1->num_rows()) //either emp has clocked into this shift or clocked out.
    					{ 
    					   
    						$info = $qry1->row();
                            if($info->is_inshift == 2) {
                                return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 2, 'parent_id' => $info->id, 'is_next_day' => 0);
    						}
                            if($info->is_inshift == 3) {
                                return array('shift_id' => $rec->shift_id, 'is_onbreak' => '0', 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 3, 'parent_id' => $info->id, 'is_next_day' => 0);
    						}
                            if($info->is_inshift == 1)
    						{ 
    							return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 0);
    						}
    					}
                         //echo '2'; die;
                        return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 0);
                    }
                    if($qry1->num_rows()) //either emp has clocked into this shift or clocked out.
					{ 
					   //echo '3'; die;
						$info = $qry1->row();
                        if($info->is_inshift == 2) {
                            return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 2, 'parent_id' => $info->id, 'is_next_day' => 0);
						}
                        if($info->is_inshift == 3) {
                            return array('shift_id' => $rec->shift_id, 'is_onbreak' => '0', 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 3, 'parent_id' => $info->id, 'is_next_day' => 0);
						}
                        if($info->is_inshift == 1)
						{ 
							return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 0);
						}
					}
                    
				}
                if($CI->session->userdata['userinfo']->shift_type == 1){
                    return array();
                                    
                }                                
			}
		}
		return array();
	}
}
if ( ! function_exists('_clockinbutttombefor')) {
    function _clockinbutttombefor($comp_id=NULL, $user_id=NULL, $emp_id=FALSE, $shift_time = null) {
        	$CI =& get_instance();
            $emploc=$CI->db->select('location')->get_where('company_employee', array('c_id' => $comp_id, 'user_id' => $user_id, 'id' => $emp_id ));
            $clock_in_before='0';
            if($emploc->num_rows()){
                $emplc=$emploc->row()->location;
                $attenqry=$CI->db->select('clock_in_before')->get_where('attendance_settings', array('comp_id' => $comp_id, 'user_id' => $user_id, 'location_id' => $emplc));
                if($attenqry->num_rows()){
                    $clock_in_before=$attenqry->row()->clock_in_before;
                } else {
                    $attenqry=$CI->db->select('clock_in_before')->get_where('attendance_settings', array('comp_id' => $comp_id, 'user_id' => $user_id, 'location_id' => '0'));
                    if($attenqry->num_rows()){
                        $clock_in_before=$attenqry->row()->clock_in_before;
                    }
                }
            } else {
                $attenqry=$CI->db->select('clock_in_before')->get_where('attendance_settings', array('comp_id' => $comp_id, 'user_id' => $user_id, 'location_id' => '0'));
                if($attenqry->num_rows()){
                    $clock_in_before=$attenqry->row()->clock_in_before;
                }
            }
            //echo $clock_in_before; exit;
            if($clock_in_before=='0'){
                return $shift_time;
            } else {
                $clock_in_before=explode(':',$clock_in_before);
                $time_seconds = $clock_in_before[0] * 3600 + $clock_in_before[1] * 60;
                $time= strtotime($shift_time);
                $livetime = date('H:i:s',$time - $time_seconds); // 16:00:00
                return $livetime; die;
            
            }
    }
}
//==================================================================//
/*------------------------------------------------------------------------------*//// 
 if ( ! function_exists('_getShiftByDateInRtl')) {
    function _getShiftByDateInRtl($comp_id=NULL, $user_id=NULL, $emp_id=FALSE, $date=FALSE, $shift_type = null) {
		$data=array();
		$CI =& get_instance(); 
		$predate = date('Y-m-d', strtotime($date) - 86400); //1 day before
		$currTm = date('H:i:s'); //24 hr format
		$lastTs = strtotime('23:59:59');
		$startTs = strtotime('00:00:00');
		$currTs = strtotime(date('H:i:s')); //OR time();

		if($shift_type == 1)//fixed shift
		{
			$CI->db->where("tbl2.effective_from <= ", $predate);
		}
		else
		{ 
			$CI->db->where("tbl2.effective_from", $predate);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, 'tbl1.is_next_day' => 1, "tbl2.status" => 1))->get(); 
		if($dataQ->num_rows()) //if NIGHT shift is there coming from prev date in current date, 1st fetch that shift
		{ 
			$nsinfo = $dataQ->row();
			$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $nsinfo->shift_id, 'parent_id' => 0, 'created_date' => $predate, 'status !='=>0));		
			if($qry1->num_rows()) //(a row is there)either emp has clocked into that night shift
			{ 
				$info = $qry1->row();
				if($info->is_inshift == 1)
				{
					return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 1);
				}
			}
			else
			{ 
				if($currTs < strtotime($nsinfo->out_time))
				{
					return array('shift_id' => $nsinfo->shift_id, 'is_onbreak' => 0, 'in_time' => $nsinfo->in_time, 'out_time' => $nsinfo->out_time, 'is_break_time' => $nsinfo->is_break_time, 'break_time' => $nsinfo->break_time, 'is_ex_break_time' => $nsinfo->is_ex_break_time, 'working_hours' => $nsinfo->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
				}
			}	
		}
		//if no NIGHT shift is there coming from prev date in current date, then fetch all current day shifts.
		if($shift_type == 1)
		{
            $CI->db->order_by("tbl2.effective_from", 'Desc');
			$CI->db->where("tbl2.effective_from <= ", $date);
		}
		else
		{
			$CI->db->where("tbl2.effective_from", $date);
		}
		$dataQ = $CI->db->select('tbl2.shift_id, sft_name, sft_code, in_time, out_time, is_next_day, is_break_time, break_time, is_ex_break_time, working_hours')->from('emp_assign_shift as tbl2')->join('company_shift_master  as tbl1', 'tbl2.shift_id = tbl1.id')->where(array("tbl2.user_id" => $user_id, "tbl2.comp_id" => $comp_id, "tbl2.emp_id" => $emp_id, "tbl2.status" => 1))->get();	
		//echo $CI->db->last_query();  
		if($dataQ->num_rows())
		{ 
			//pr($dataQ->result()); //die;
			foreach($dataQ->result() as $rec)
			{ 
				$inTs = strtotime($rec->in_time);
				$outTs = strtotime($rec->out_time);
				if($rec->is_next_day)//night shift
				{
						$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));	
						//echo $CI->db->last_query(); die;
						if($qry1->num_rows() == 0) //check previous date`s shift
						{
							$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $predate, 'status !='=>0));		
						}
						if($qry1->num_rows()) //(a row is there)either emp has clocked into this shift or clocked out.
						{ 
							$info = $qry1->row();
							if($info->is_inshift == 1)//if emp has not clocked out the prev date`s shift
							{
								return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 1);
							}
							else//if emp has clocked out the prev date`s shift, current date`s night shift will be shown
							{
								if(($currTs >= $inTs && $currTs <= $lastTs) || ($currTs >= $startTs && $currTs < $outTs))//in next day to enable the emp to clockin before the out time of shift.
								{
									return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
								}	
							} 	
						}
						else //The emp has not clocked into the shift yet.
						{
							if(($currTs >= $inTs && $currTs <= $lastTs) || ($currTs >= $startTs && $currTs < $outTs))//in next day to enable the emp to clockin before the out time of shift.
							{
								return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 1);
							}
						}
				}
				else //day shift
				{ 
					//if(strtotime($rec->in_time) <= $currTs)
					//{
						$qry1 = $CI->db->select('id, shift_id, is_onbreak, is_inshift')->get_where('auto_emp_attendance', array("comp_id" => $comp_id, "user_id" => $user_id, 'emp_id' => $emp_id, 'shift_id' => $rec->shift_id, 'parent_id' => 0, 'created_date' => $date, 'status !='=>0));	
						if($qry1->num_rows()) //either emp has clocked into this shift or clocked out.
						{ 
							$info = $qry1->row();
							//if($info->is_inshift == 1)
							//{ 
								return array('shift_id' => $info->shift_id, 'is_onbreak' => $info->is_onbreak, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 1, 'parent_id' => $info->id, 'is_next_day' => 0);
							//}	
						}
						else //The emp has not clocked into the shift yet.
						{
							$inTs = strtotime($rec->in_time);
							$outTs = strtotime($rec->out_time);
							//if($outTs > $currTs) //to enable the emp to clockin before the out time of shift.
							//{
								return array('shift_id' => $rec->shift_id, 'is_onbreak' => 0, 'in_time' => $rec->in_time, 'out_time' => $rec->out_time, 'is_break_time' => $rec->is_break_time, 'break_time' => $rec->break_time, 'is_ex_break_time' => $rec->is_ex_break_time, 'working_hours' => $rec->working_hours, 'hasClockedIn' => 0, 'parent_id' => 0, 'is_next_day' => 0);
							//}
						}
					//}
				}
			}
		}
		return array();
	}
}
//===========================================================//
if ( ! function_exists('_attPolicySetupType')) {
    function _attPolicySetupType($comp_id=NULL, $user_id=NULL, $location_id=NULL) {
		$data=array();
		if(!empty($comp_id) && !empty($user_id)) 
		{
			$CI =& get_instance();
			$leavfor=$CI->db->select('policy_common')->where_in('location_id', array(0, $location_id))->get_where("attendance_settings", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
            if($leavfor->num_rows()){
                return $leavfor->row()->policy_common;
            }
		}
		return 0;
	}
}
//===========================================================//
if ( ! function_exists('_getAttendPolicy')) {
    function _getAttendPolicy($comp_id=NULL, $user_id=NULL, $emp_id=NULL) {
		if(!empty($comp_id) && !empty($user_id)) 
		{
			$CI =& get_instance();
            $CI->db->where("(`whitelist_employee` IS NULL");
            $CI->db->or_where("`whitelist_employee` = '$emp_id')");
			$leavfor=$CI->db->get_where("sv_attendance_policy", array("c_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
			//echo $CI->db->last_query(); die;
            if($leavfor->num_rows() >= 1)
            {
                return $leavfor->row();
			}
            else
			{
				$empData = _get_employee_existence($emp_id,$user_id,$comp_id,$FILDATA=true);
				$polcType = _attPolicySetupType($comp_id, $user_id, $empData->location);
				$leavfor=$CI->db->get_where("sv_attendance_policy", array("c_id" => $comp_id, "user_id" => $user_id, 'applicable_for' => $polcType, 'status !='=>0));
				if($leavfor->num_rows())
				{
					return $leavfor->row(); 
				}
			}
		}
		return false;
	}
}
//=============================================================================================//
function _getEmpAttendanceMonthly($comp_id, $user_id, $postdata = array())
{
	$data = array();
	$CI = & get_instance();
	$qry = $CI->db->order_by('created_date')->select('id, created_date')->get_where('auto_emp_attendance', array('comp_id' => $comp_id, 'user_id' => $user_id, 'emp_id' => $postdata['emp_id'], 'parent_id' => 0, 'month(created_date)' => $postdata['month'], 'year(created_date)' => $postdata['year'], 'status' => 1, 'is_inshift' => '2'));
	if($qry->num_rows())
	{	
		foreach($qry->result() as $rec)
		{
			$data[] = $rec->created_date;			
		}
	}
	return $data;
}
//============================Employee Leave Data======================//
if(!function_exists('_getEmpMonthlyLeave')) 
{
    function _getEmpMonthlyLeave($comp_id, $user_id, $postdata = array())
    {
    	$data = array();
    	$CI = & get_instance();
    	$pdqry = $CI->db->group_by('emp_id')->select("emp_id,sum( case when leave_id = 0 then balance else 0 end ) as unpaid_balance, sum( case when leave_id != '0'
                 then balance else 0 end ) as paid_balance")->get_where('update_attendance', array('comp_id' => $comp_id, 'user_id' => $user_id, 'month(att_date)' => $postdata['month'], 'year(att_date)' => $postdata['year'], 'status' => 1));
        if($pdqry->num_rows())
    	{	
            foreach($pdqry->result() as $rows)
            {
                $data[$rows->emp_id]['emp_paid_leave']=$rows->paid_balance;
                $data[$rows->emp_id]['emp_unpaid_leave']=$rows->unpaid_balance;
            } 
    	}
        return $data;
    }
}
//=========================Close Employee Leave Data===================//
//============================Employee Leave Data======================//
if(!function_exists('_getEmpMonthlyLateworking')) 
{
    function _getEmpMonthlyLateworking($comp_id, $user_id, $postdata = array())
    {
    	$data = array();
    	$CI = & get_instance();
    	$pdqry = $CI->db->group_by('emp_id')->select("emp_id,sum( case when morn_late_by >= '00:01:00.000000' then 1 else 0 end ) as emp_late, SEC_TO_TIME(sum( case when working_hours is not null
                 then TIME_TO_SEC(working_hours) else 0 end )) as emp_working_hours")->get_where('auto_emp_attendance', array('comp_id' => $comp_id, 'user_id' => $user_id, 'parent_id' => 0, 'month(created_date)' => $postdata['month'], 'year(created_date)' => $postdata['year'], 'status' => 1));
        if($pdqry->num_rows())
    	{	
            foreach($pdqry->result() as $rows)
            {
                $data[$rows->emp_id]['emp_late']=$rows->emp_late;
                $data[$rows->emp_id]['emp_working_hours']=$rows->emp_working_hours;
            } 
    	}
        return $data;
    }
}
//=========================Close Employee Leave Data===================//
//=============================================================================================//
function _getEmpLateEarlyMonthly($comp_id, $user_id, $emp_id = null, $month = null, $year = null, $policy = array())
{
	$data = $data['morn_late_by_dates'] = $data['eve_early_by_dates'] = array();
	$CI = & get_instance();
		
	$policy->late_rule_applied ? $CI->db->where("(`morn_late_by` >  '$policy->late_hrs'") : $CI->db->where("(`morn_late_by` > '00:00:00'");	
	
	$policy->el_rule_applied ? $CI->db->or_where("`eve_early_by` >  '$policy->el_hrs')") : $CI->db->or_where("`eve_early_by` > '00:00:00')");	
	
	$qry = $CI->db->order_by('created_date')->select('id, created_date, morn_late_by, eve_early_by, is_approved')->get_where('auto_emp_attendance', array('comp_id' => $comp_id, 'user_id' => $user_id, 'emp_id' => $emp_id, 'parent_id' => 0, 'month(created_date)' => $month, 'year(created_date)' => $year, 'status' => 1));
	//echo $CI->db->last_query(); //die;
	if($qry->num_rows())
	{	
		//pr($qry->result());
		foreach($qry->result() as $rec)
		{
			/*if($rec->morn_late_by != '00:00:00')
			{
				$data['morn_late_by_ids'][] = $rec->id;
				$data['morn_late_by_dates'][] = $rec->created_date;
				$data['morn_late_by'][$rec->created_date][] = $rec->morn_late_by; 	
			}
			if($rec->eve_early_by != '00:00:00')
			{
				$data['eve_early_by_ids'][] = $rec->id;
				$data['eve_early_by_dates'][] = $rec->created_date;
				$data['eve_early_by'][$rec->created_date][] = $rec->eve_early_by; 	
			}*/
			if($rec->morn_late_by != '00:00:00' && $rec->morn_late_by > $policy->late_hrs)
			{
				$data['morn_late_by_ids'][] = $rec->id;
				$data['morn_late_by_dates'][$rec->id] = $rec->created_date;
				$data['morn_late_by'][$rec->id] = $rec->morn_late_by; 	
				$data['is_approved_morn'][$rec->id] = preg_match('/1/', $rec->is_approved) ? true : false;
				$data['is_approved'][$rec->id] = $rec->is_approved; 	
			}
			if($rec->eve_early_by != '00:00:00' && $rec->eve_early_by > $policy->el_hrs)
			{
				$data['eve_early_by_ids'][] = $rec->id;
				$data['eve_early_by_dates'][$rec->id] = $rec->created_date;
				$data['eve_early_by'][$rec->id] = $rec->eve_early_by; 	
				$data['is_approved_eve'][$rec->id] = preg_match('/2/', $rec->is_approved) ? true : false;
				$data['is_approved'][$rec->id] = $rec->is_approved; 	
			}
		}
	}
	//pr($data);
	return $data;
}
//=============================================================================================//
function _getEmpOvertime($comp_id, $user_id, $emp_id = null, $month = null, $year = null, $policy = array())
{
	$data = $data['morn_late_by_dates'] = $data['eve_early_by_dates'] = array();
	$CI = & get_instance();
	if($policy->ot_rule_applied)
	{
		$ot_time_duration = '00:'.$policy->ot_time_duration.':00';
		$CI->db->where("overtime > ",  $ot_time_duration); 
	}
	else
	{
		$ot_time_duration = '00:00:00';	
		$CI->db->where("overtime > ",  $ot_time_duration); 
	}
	
	$qry = $CI->db->order_by('created_date')->select('id, created_date, overtime, effective_overtime, is_approved')->get_where('auto_emp_attendance', array('comp_id' => $comp_id, 'user_id' => $user_id, 'emp_id' => $emp_id, 'parent_id' => 0, 'month(created_date)' => $month, 'year(created_date)' => $year, 'status' => 1));
	//echo $CI->db->last_query(); die;
	if($qry->num_rows())
	{	
		//pr($qry->result()); 
		foreach($qry->result() as $rec)
		{
			if($rec->overtime != '00:00:00')
			{
				$data['overtime_ids'][] = $rec->id;
				$data['overtime_dates'][$rec->id] = $rec->created_date;
				$data['overtime_by'][$rec->id] = $rec->overtime; 	
				$data['effovertime_by'][$rec->id] = $rec->effective_overtime; 	
				$data['is_approved_check'][$rec->id] = preg_match('/3/', $rec->is_approved) ? true : false;
				$data['is_approved'][$rec->id] = $rec->is_approved; 	
			}
		}
	}
	//pr($data);
	return $data;
}
/*------------------------------------------------------------------------------*/ 
function _get_site_id($user_id = null)
{
	if(!is_null($user_id)) 
	{
		$CI = & get_instance();
		$qry = $CI->db->select('s_id')->get_where('users', array('id' => $user_id)); 	
		if($qry->num_rows())
			return $qry->row()->s_id;		
		return false;
	}
}
/*------------------------------------------------------------------------------*/ 
function _getAllSiteIds() //94bb5609631949992bccd4a898f0a81c
{
		$CI = &get_instance();
	    /*$allSiteIds = array();  //old code
		$allSiteIdsQry = $CI->db->get_where('site', array('status' => 'active'));
		if($allSiteIdsQry->num_rows())
		{
			foreach($allSiteIdsQry->result() as $rec): 
					$allSiteIds[] = $rec->id;
			endforeach;
			sdata_get($allSiteIds);
		}*/  
        if($CI->session->userdata('db_details')) //new code
    	{
    		$db_details = $CI->session->userdata('db_details');
        	if($db_details['db_siteid'])
    		{
    					$allSiteIds[] = $db_details['db_siteid'];
                        $CI->session->set_userdata('all_site_ids', $allSiteIds);
    		}
        }
}
/*------------------------------------------------------------------------------*/ 
/*------------------------------------------closes AShutosh------------------------------------*/
//===========================Get Employee total working()============================//
/*** Get Employee total working
     * 
     * @access	public
     * @param   int - Comp id, User id, Emp id, Shift type 
     * @return	array - mixed
     */
	if(!function_exists('_getemployeeworkinghorse')) {
		function _getemployeeworkinghorse($comp_id=NULL, $user_id=NULL, $emp_id=NULL, $todyDate=NULL){
            if($comp_id && $user_id && $emp_id && $todyDate){
        	   $data=array();
        	   $CI =& get_instance();
                $tot_work_shift=$CI->db->order_by('effective_from','Desc')->order_by('id','Desc')->select('shift_id')->get_where("emp_assign_shift",array("emp_id"=> $emp_id, "comp_id"=>$comp_id, "user_id"=>$user_id, "effective_from <=" => $todyDate,  "status"=>1, "shift_id !=" => '0' ),1);
                $shift_time='00:00:00';
                if($tot_work_shift->num_rows()){
                	$CI->db->select('id,sft_code,in_time,out_time');
                	$all_shift=$CI->db->get_where("company_shift_master",array("user_id" => $user_id, "comp_id" => $comp_id, "status !=" => 0))->result();
                	if(isset($all_shift) && !empty($all_shift)){
                		foreach($all_shift as $result) {
                			$data['shift_intime'][$result->id] = $result->in_time;
                			$data['shift_outtime'][$result->id] = $result->out_time;
                		}
                	}
                
                	$tot_shift=$tot_work_shift->result();
                	//pr($tot_shift); die;
                	foreach($tot_shift as $res){
                		$in_time=$data['shift_intime'][$res->shift_id];
                		$out_time=$data['shift_outtime'][$res->shift_id];
                		$calcshifttime =_shift_difference($in_time,$out_time);
                        $shift_time=_sum_the_time($shift_time,$calcshifttime);
                	}
                }
                return $shift_time;
			}
            return 0;
		}
	}
//==========================Close Get Employee total working()============================//
//======================Sum Two TIME=========================//
    if(!function_exists('_sum_the_time')) 
    {
        function _sum_the_time($time1, $time2) {
          $times = array($time1, $time2);
          $seconds = 0;
          foreach ($times as $time)
          {
            list($hour,$minute,$second) = explode(':', $time);
            $seconds += $hour*3600;
            $seconds += $minute*60;
            $seconds += $second;
          }
          $hours = floor($seconds/3600);
          $seconds -= $hours*3600;
          $minutes  = floor($seconds/60);
          $seconds -= $minutes*60;
          if($seconds < 9)
          {
          $seconds = "0".$seconds;
          }
          if($minutes < 9)
          {
          $minutes = "0".$minutes;
          }
            if($hours < 9)
          {
          $hours = "0".$hours;
          }
          return "{$hours}:{$minutes}:{$seconds}";
        }
    }
//======================Sum Two TIME=========================//
//=====================================get Shift Data  InDownloadAttendance====================================//
/*** Employee Attendance Details
     * 
     * @access	public
     * @param   int - Comp id, User id, Employee ID,month,Year
     * @return	array - mixed
     */
	if(!function_exists('_getShiftDataInMarkAttendance')) 
    {
		function _getShiftDataInMarkAttendance($comp_id=NULL, $user_id=NULL, $emp_id=NULL, $year=NULL, $month=NULL)
        {
            $data = $data['id'] = $data['created_date'] = $data['emp_in_time'] = $data['emp_out_time'] = $data['morn_late_by'] = $data['eve_early_by'] = $data['working_hours'] = $data['overtime'] = array();
            if($comp_id && $user_id && $emp_id && $year && $month)
            {
                $CI =& get_instance();
                $qry = $CI->db->order_by('created_date')->select('id, emp_in_time, emp_out_time, morn_late_by, eve_early_by, working_hours, short_hours, overtime, is_inshift, created_date')->get_where('auto_emp_attendance', array('comp_id' => $comp_id, 'user_id' => $user_id, 'emp_id' => $emp_id, 'parent_id' => 0, 'month(created_date)' => $month, 'year(created_date)' => $year, 'status' => 1));
            	if($qry->num_rows())
            	{	
            		foreach($qry->result() as $rec)
            		{
            			$data['id'][] = $rec->id;
            			$data['created_date'][$rec->id] = $rec->created_date;			
            			$data['emp_in_time'][$rec->created_date][] = $rec->emp_in_time;			
            			$data['emp_out_time'][$rec->created_date][] = $rec->emp_out_time;			
            			$data['morn_late_by'][$rec->created_date][] = $rec->morn_late_by;			
            			$data['eve_early_by'][$rec->created_date][] = $rec->eve_early_by;			
            			$data['working_hours'][$rec->created_date][] = $rec->working_hours;			
            			$data['overtime'][$rec->created_date][] = $rec->overtime;
                        $data['short_hours'][$rec->created_date][]=$rec->short_hours;
                        $data['is_inshift'][$rec->created_date][]=$rec->is_inshift;
            		}
            	}
            }
            return $data;
        }
    }
//=====================================get Shift Data  InDownloadAttendance====================================//
//========================To get the flow details against that Job Request=================================//
function _getJobApprovalFlow($comp_id=NULL, $user_id=NULL, $id = null, $showAll = FALSE){
		$CI = &get_instance();
		if($id || $showAll)
		{
			if($id)
			{
				$par = array("comp_id" => $comp_id, "user_id" => $user_id, 'id' => $id, 'status != '=>0);
			}
			
			if($showAll)
			{
				$par = array("comp_id" => $comp_id, "user_id" => $user_id, 'status != '=>0);
			}
			
			$lvs = $CI->db->get_where("setup_job_approval_flow", $par);
			if($lvs->num_rows())
			{
				if($id)
				{
					return $lvs->row();
				}
				if($showAll)
				{
					return $lvs->result();
				}
			}
		}
		return;
}
//========================To get the flow details against that Job Request=================================//
//=====================To get the flow details against that Job Request================================================//
 if(!function_exists('_appr_job_flow_details')) {  
   function _appr_job_flow_details($comp_id = NULL, $user_id = NULL, $emp_id = NULL, $flow_id = NULL, $dept_id = NULL){
		$data = array();
		$CI = & get_instance();
		$qry = $CI->db->get_where('setup_job_approval_flow', array('id' => $flow_id, "comp_id" => $comp_id, "user_id" => $user_id, 'status != ' => 0), 1);   	
		if($qry->num_rows())
		{
			$info = $qry->row();	
			$data['approval_mode'] = $info->approval_mode;					
			$data['approve_rm'] = $info->approve_rm;					
			$data['approve_hr'] = $info->approve_hr;	
			$data['informing_auth'] = $info->approval_mode;									
			$data['next_rm'] = $info->next_rm;
			$data['all_rms'] = $info->all_rms;
			$data['top_senior'] = $info->top_senior;
		}
   		return $data;
   }
 }
 //=====================To get the flow details against that Job Request================================================//
  //=====================To get the flow details against that Expenses Request=========================//
 if(!function_exists('_appr_expenses_flow_details')) {  
   function _appr_expenses_flow_details($comp_id = NULL, $user_id = NULL, $emp_id = NULL, $flow_id = NULL, $dept_id = NULL){
		$data = array();
		$CI = & get_instance();
		$qry = $CI->db->get_where('expenses_approval_flow', array('id' => $flow_id, "comp_id" => $comp_id, "user_id" => $user_id, 'status != ' => 0), 1);   	
		if($qry->num_rows())
		{
			$info = $qry->row();	
			$data['approval_mode'] = $info->approval_mode;					
			$data['approve_rm'] = $info->approve_rm;					
			$data['approve_hr'] = $info->approve_hr;	
			$data['payroll_operator']=$info->payroll_operator	;
			$data['informing_auth'] = $info->approval_mode;									
			$data['next_rm'] = $info->next_rm;
			$data['all_rms'] = $info->all_rms;
			$data['top_senior'] = $info->top_senior;
		}
   		return $data;
   }
 }
 
 //=====================To get the flow details against that Expenses Request========================//
 //=====================================Start Employee basic details without using comp_id and user_id====================================//
/*** Get employee basic Details
     * 
     * @access	public
     * @param   int - Comp id & User id
     * @return	array - mixed
     */
	if(!function_exists('_employee_details')) {
		function _employee_details($emp_id=NULL){
			$CI =& get_instance();
		
				$CI->db->select('id, emp_code, f_name, l_name, salutation, email_id, profile_pic, cat_id, dept_id, desg_id, grade_id, location, emp_type, probation_period, join_date, is_period_extendable, emp_extend_days, emp_extend_remarks, confirm_date, confirm_letter, reign_date, status');
				$CI->db->where('id',$emp_id);
				$qury=$CI->db->get('company_employee');
				$data=$qury->row();
				return $data;
			
		}
	}		
//=====================close Employee basic details without using comp_id and user_id================================================//

//==================tabel info ===================//
/**
 * _get_table_details
 * 
 * return table colom value
 *
 * @access	public
 */
if (!function_exists('_get_table_details')) {

    function _get_table_details($field_id = NULL, $match_field = NULL, $table = NULL, $return_field = NULL, $return_result = false) {
        if ($field_id && $match_field && $table) {
            $CI = &get_instance();
            $qry = $CI->db->select($return_field)->get_where($table, array($match_field => $field_id));
            if ($qry->num_rows()) {
                if ($return_result) {
                    return $qry->result();
                } else {
                    if (strpos($return_field, ',')) {
                        return $qry->row();
                    } else {
                        return ucwords($qry->row()->$return_field);
                    }
                }
            }
            return false;
        }
    }

}
//================Close table info================//