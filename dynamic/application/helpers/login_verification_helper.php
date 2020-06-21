<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * login helper

 *

 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Login Verification
 * @company     GohrmInc
 * @since		Version 1.0
 */

 //====================================Verify company Login Permission=======================================//
/**
     * Get Permission Data by company
     * 
     * @access	public
     * @param   int - comapny
     */
if(!function_exists('_verify_company_login')) {
    function _verify_company_login() {
		$CI =& get_instance();
		if(!(isset($CI->session->userdata['companyinfo']))){
			//redirect(base_url('login'));
		} 
        $userinfo = $CI->session->userdata['userinfo'];
        if(isset($userinfo->login_type)){   
			//$allow_emp_method=array('company/dashboard/create_user','company/dashboard/all_user');
		//	echo $get_emp_method=$CI->uri->segment(1).'/'.$CI->uri->segment(2).'/'.$CI->uri->segment(3);
           // die;
           //if($userinfo->emp_type == 6 && in_array($get_emp_method,$allow_emp_method)) {
            //$userinfo->emp_type == 4 use for data entry operator//
			//if($userinfo->emp_type == 6 || $userinfo->emp_type == 3 || $userinfo->emp_type == 4) {
			 if($userinfo->emp_type != 1) {
				return true;
			}
			redirect(base_url('subcompany/employee'));
		}
		if($userinfo->is_super){
			redirect(base_url('dashboard'));
        }elseif($userinfo->p_id){
			redirect(base_url('subcompany/compmaster'));
		}
		if(isset($CI->session->userdata['activecomdata']) && !empty($CI->session->userdata['activecomdata']['active_company'])){
			redirect(base_url().'subcompany/compmaster');
		}
    }
}
//====================================Close Verify company Login Permission=======================================//

//===============================Verify Subcompany Login Permission=======================================//

    /**
     * Get Permission Data by Subcompany
     *
     * This function get Subcompany details
     * 
     * @access	public
     * @param   Subcompany Seession Details
     */     

if(!function_exists('_verify_subcompany_login')) {
	function _verify_subcompany_login($id = NULL) {
		$CI =& get_instance();
        $userinfo = $CI->session->userdata['userinfo'];
        if(isset($userinfo->is_super)){
			redirect(base_url('dashboard'));
        }
		if(!(isset($CI->session->userdata['activecomdata'])) && empty($CI->session->userdata['activecomdata']['active_company'])) {
			redirect(base_url().'company/dashboard');
		}
    }
}
//===============================Close Verify Subcompany Login Permission=======================================//
 /**
     * This function verifies Employee login
     * 
     * @access	public
     */     

if(!function_exists('_verify_employee_login')) {
	function _verify_employee_login($id = NULL) {
		$CI =& get_instance();
		$userinfo = $CI->session->userdata('userinfo');
		
		if(isset($CI->session->userdata['activecomdata']) || !empty($CI->session->userdata['activecomdata']['active_company'])) {
			//$CI->session->unset_userdata('activecomdata'); //Dont uncomment this Since the methods of Employee controller are being used inside Company`s Attendance controller.
		}
		
        if($userinfo  != '' && !empty($userinfo)){
			if(isset($userinfo->login_type)){
				return TRUE;
        	}
			else{ 
				redirect(base_url('company/dashboard'));	
			}
		}
		else{
			redirect(base_url('login'));	
		}
	}	
}

