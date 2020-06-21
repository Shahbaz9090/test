<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * login helper

 *

 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Seesion
 * @company     GohrmInc
 * @since		Version 1.0
 */

 //====================================Get Login user Permission=======================================//
/**
     * Get Permission Data by group id
     * 
     * @access	public
     * @param   int - group id
     * @return	array - mixed
     */
if(!function_exists('get_permission_by_group_id')) {
    function get_permission_by_group_id($group_id = NULL)
    {
		$CI =& get_instance();
        $CI->db->select("data");
        $CI->db->where("group_id",$group_id);
        $query = $CI->db->get('user_group_permissions');
        $data = array();
        if($query->num_rows() > 0)
        {
            $data = unserialize($query->row()->data);
        }
        return $data;
    }
}
//====================================Close Get Login user Permission=======================================//

//===============================Get Login user Information=======================================//

    /**
     * Get User By Id
     *
     * This function get user details filtered by id
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */     

if(!function_exists('get_user_by_id')) {
function get_user_by_id($id = NULL)
    {
		$CI =& get_instance();
        $CI->db->select('users'.' .*'); //Select user table
        $CI->db->select('user_groups'.'.name as group_name');
        $CI->db->select('user_groups'.'.is_super as is_super'); // select user group name
        $CI->db->select('user_groups'.'.site_id');   // select user gourp site id     
        $CI->db->select('site'.'.is_super as is_super_site');   // select user gourp site id     
        $CI->db->select('site'.'.language');   // select user gourp site language 
        
        $CI->db->from('users');
        $CI->db->join('user_groups', "users.group_id = user_groups.id","LEFT");
        $CI->db->join('site', "site.id = user_groups.site_id","LEFT");
                
        $CI->db->where("users.id",$id);
        $query = $CI->db->get();
		//echo $CI->db->last_query();die;
        if($query->num_rows() > 0)
        {
            $row = $query->row();
            $row->permission = get_permission_by_group_id($row->group_id);
            return $row;
        }
        return FALSE;
    }
}

//===============================Close Get Login user Information=======================================//

 //=================================Store Login Seeion===========================================//

/**
 * Store Session* 
 *
 * Example
 * strore session()
 * author :: tekshapers
 * @access	public
 */ 
if(!function_exists('_store_login_details')) {
	function _store_login_details($rowid=NULL) {
		$CI =& get_instance();
		$user_info =get_user_by_id($rowid);
       // print_r($user_info);exit;
		unset($user_info->password,$user_info->message,$user_info->message_status);
		//$user_info->last_login = strtotime('now');
		$user_info->name = $user_info->first_name.' '.$user_info->last_name;
        
              // get  employee id
             /*******Added by Ranjeet so that company owner can switch to ess panel***/
            $company_emaild=$user_info->email; 
            $emp_info = $CI->db->get_where("company_employee", array('email_id' => $company_emaild));            
            $empdetails=$emp_info->result_array();            
            foreach($empdetails as $rows){
                $user_info->emp_id=$rows['id'];
                $user_info->emp_type = $rows['emp_type'];
                $user_info->login_type = 'Owner';
                $user_info->shift_type = $rows['shift_type'];
				}            
            if($rows['emp_type']==6){
			$user_info->emp_link=base_url().'company/dashboard/';
			$user_info->emp_link_view='Go to Home';
		} else {
            $user_info->emp_link_view='';
		}
		
		$CI->session->set_userdata("whoIsLoggedIn", 1);//1->company, 2->employee.
		//pr($user_info);echo "<br/>";
        /************************************************************/
		$CI->session->set_userdata("language",$user_info->language);
		$CI->session->set_userdata("userinfo",$user_info);
		$CI->session->set_userdata("isLogin",TRUE);
		
        //pr($CI->session->userdata('userinfo'));die;
        
		if(!($user_info->p_id)){
			$uid=$user_info->id;
			$compid=$user_info->comp_id;
			$coquery =$CI->db->select('comp_name, smod_id')->from('company_registration as tbl1')->join('company_pricing as tbl2', 'tbl1.id = tbl2.c_id')->where(array("tbl1.id" => $compid))->get();
			if($coquery ->num_rows){
				$cores=$coquery->row();
				$smod_id = array();
				if($cores->smod_id)
				{
					$smod_id = explode(',', $cores->smod_id);	
				}
				$data['submod_id'] = $smod_id;
			}

			$CI->db->select('id,comp_id');
			$queryData=$CI->db->get_where("users",array("p_id"=>$uid));
			$result=$queryData->result_array();
			$rdata=array();
			foreach($result as $rows){
				$comp_id=$rows['comp_id'];
				$CI->db->select('comp_name');
				$compquery=$CI->db->get_where("company_registration",array("id"=>$comp_id));
				$cresult=$compquery->row();
				$rdata[$rows['id']]=$cresult->comp_name;
			}
			$data['active_comp']=$uid;
			$data['company_name']=$cores->comp_name;
			$data['tot_subcomp']=$rdata;
            
        
        //pr($data);die;
            
    		/*$emp_data->id = $emp_info->user_id;  //id of users tbl
    		$emp_data->first_name = $emp_info->f_name;
    		$emp_data->last_name = $emp_info->l_name;
    		$emp_data->emp_code = $emp_info->emp_code;
    		$emp_data->email = $emp_info->email_id;
    		$emp_data->status = $emp_info->status;		
    		$emp_data->comp_id = $emp_info->c_id;*/        
			$CI->session->set_userdata("companyinfo",$data);
		}
		return true;
	}
}

//=================================Store Login Seeion===========================================//

/**
 * Store Session* 
 *
 * Example
 * strore session()
 * author :: tekshapers
 * @access	public
 */ 
if(!function_exists('_employee_login_details')) {
	function _employee_login_details($emp_info = NULL) {
		$CI =& get_instance();
		if($emp_info)
		{
			$CI->session->set_userdata("isLogin",TRUE);
			$emp_data->emp_id = $emp_info->id;
			$emp_data->id = $emp_info->user_id;  //id of users tbl
			$emp_data->first_name = $emp_info->f_name;
			$emp_data->last_name = $emp_info->l_name;
			$emp_data->emp_code = $emp_info->emp_code;
			$emp_data->email = $emp_info->email_id;
			$emp_data->status = $emp_info->status;
			$emp_data->emp_type = $emp_info->emp_type;
			$emp_data->comp_id = $emp_info->c_id;
			$emp_data->login_type = 'employee';
			$emp_data->shift_type = $emp_info->shift_type;
			$emp_data->is_client_manager = $emp_info->is_client_manager;
			
			if($emp_info->emp_type==1){
				$emp_data->emp_link='';
				$emp_data->emp_link_view='Employee';
			} else if($emp_info->emp_type==2){
				$emp_data->emp_link=base_url().'subcompany/mypanel/';
				$emp_data->emp_link_view='Go to Super Panel';
			} else if($emp_info->emp_type==3){
				$emp_data->emp_link=base_url().'subcompany/mypanel/';
				$emp_data->emp_link_view='Go to HR Panel';
			} else if($emp_info->emp_type==4){
				$emp_data->emp_link=base_url().'subcompany/mypanel/';
				$emp_data->emp_link_view='Go to Operator Panel';
			} else if($emp_info->emp_type==5){
				$emp_data->emp_link=base_url().'subcompany/mypanel/';
				$emp_data->emp_link_view='Go to Operator Panel';
			} else if($emp_info->emp_type==6){
				$emp_data->emp_link=base_url().'subcompany/mypanel/';
				$emp_data->emp_link_view='Go to Super Panel';
			} else {
				$emp_data->emp_link_view='';
			}
			$emp_data->emp_access = zipped_res_code('decrypt',$emp_info->emp_access);
			$ell=date("Y-m-d h:i:s");
			if(isset($emp_info->last_login) && !empty($emp_info->last_login) && $emp_info->last_login!='0000-00-00 00:00:00') {
				$ell=$emp_info->last_login;
			}
			$emp_data->last_login = $ell;
			
			$CI->db->select('s_id,p_id');
			$userqry =$CI->db->get_where('users',array('id' => $emp_info->user_id, 'comp_id' => $emp_info->c_id))->row();
			if($userqry){
				$emp_data->s_id = $userqry->s_id;
			}
			$CI->session->set_userdata('userinfo', $emp_data);
			
			$data['active_comp']= $emp_info->user_id;
            if($userqry->p_id=='0'){
                $qry =$CI->db->select('comp_name, smod_id')->from('company_registration as tbl1')->join('company_pricing as tbl2', 'tbl1.id = tbl2.c_id')->where(array("tbl1.id" => $emp_info->c_id))->get();
                if($qry->num_rows > 0){
    				$info =$qry->row();
    				$data['company_name']=$info->comp_name;
    				$smod_id = array();
    				if($info->smod_id)
    				{
    					$smod_id = explode(',', $info->smod_id);	
    				}
    				$data['submod_id'] = $smod_id;
    			}
            } else {
                $compname=$CI->db->select('comp_name')->get_where('company_registration',array('id' => $emp_info->c_id),1)->row()->comp_name;
                $data['company_name']=$compname->comp_name;
                $qry=$CI->db->get_where('company_pricing',array('user_id' => $userqry->p_id));
                if($qry->num_rows > 0)
                {
                    $info =$qry->row();
                    $smod_id = array();
    				if($info->smod_id)
    				{
    					$smod_id = explode(',', $info->smod_id);	
    				}
    				$data['submod_id'] = $smod_id;
                }
            }
			
			//$data['tot_subcomp']=$rdata;
			$CI->session->set_userdata("companyinfo",$data);
			//pr($CI->session->userdata('userinfo'));
			$CI->session->set_userdata("whoIsLoggedIn", 2);//1->company, 2->employee.
			return true;
		}
	}
}
//==================================Close Store Login Seeion=======================================//
