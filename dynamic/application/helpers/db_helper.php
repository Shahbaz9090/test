<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**

 * Database helper

 *

 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db
 * @company     GohrmInc
 * @since		Version 1.0
 */

 // ------------------------------------------------------------------------



/**
* Set Common insert value
*
* @access	public
*/ 

if(!function_exists('set_common_insert_value')) {
	function set_common_insert_value() {
		$CI =& get_instance();
		$CI->db->set('site_id',currentuserinfo()->site_id);          
        $CI->db->set('added_by',currentuserinfo()->id);          
        $CI->db->set('last_ip',current_ip());          
        $CI->db->set('created_time',current_date());          
	}
}


// ------------------------------------------------------------------------
/**

 * Set Common update value

 *

 * @access	public

 */ 

if(!function_exists('set_common_update_value')) {
	function set_common_update_value() {
		$CI =& get_instance();
		$CI->db->set('last_ip',current_ip());          
		$CI->db->set('modified_time',current_date());          
	}
}

// ------------------------------------------------------------------------



/**

 * Filter Content By Site Id 

 * 

 * Filter Content BY Current Site ID

 *

 * @access	public

 */ 

if(!function_exists('filter_by_site_id')) {
	function filter_by_site_id($key = 'site_id') {
		$CI =& get_instance();
		$site_id = current_site_id();
		if($site_id != 1)
			$CI->db->where($key,$site_id);
	}
}

// ------------------------------------------------------------------------
/**

 * Filter Data According to permission 

 * 

 * @access	public

 */ 

if(!function_exists('filter_data')) {
	function filter_data($table = NULL) {
		$CI =& get_instance();        
		$userinfo = currentuserinfo();
		$site_colum = "site_id";
		$user_colum = "added_by";
		if($table != NULL) {
			$site_colum = "$table.site_id";
			$user_colum = "$table.added_by";
		}
		$permission = $CI->session->userdata("permission");
		if(!$userinfo->is_super_site && AT_VIEW == $permission['code'] && $permission['type'] == 'own_view') {
			//$CI->db->where($user_colum,$userinfo->id,FALSE);
			$user_list  =  $CI->session->userdata("child_list");
			$CI->db->where_in($user_colum,$user_list,FALSE);
		}
		if(!$userinfo->is_super_site && AT_EDIT == $permission['code'] && $permission['type'] == 'own_edit') {
			// $CI->db->where($user_colum,$userinfo->id,FALSE);
			$CI->db->where_in($user_colum,$user_list,FALSE);
		}
		//Filter by site id         
		if(!$userinfo->is_super_site)
			$CI->db->where($site_colum,$userinfo->site_id,FALSE);
		}
}

// ------------------------------------------------------------------------

function get_table_fld($table=NULL) {
	if(!empty($table)) {
		$_this = & get_Instance();
		$sql = "show columns from $table ";
		$res  = $_this->db->query($sql);
		$rows = $res->result();
		foreach($rows as $r){
			$fld[] = $r->Field;
		}
		$fld = implode(';',$fld);
		return ($fld);	
	}
}

// ------------------------------------------------------------------------

function make_array_key($str=NULL) {
	if(!empty($str)) {
		$ar = array();
		$key = explode(';',$str);
		foreach($key as $k) {
			$t = array($k=>'');
			$ar = array_merge($ar,$t);
		}
		return $ar;
	}
}

// ------------------------------------------------------------------------

function post2data($str) {
	$_this = & get_Instance();
	$key = explode(';',$str);
	foreach($key as $k){
		if($_this->input->post($k)=='' ) continue;
		$data[$k] = ltrim(rtrim($_this->input->post($k)));
	}
	return $data;
}

// ------------------------------------------------------------------------

function store_data($table,& $data,$id) {
	$_this = & get_Instance();
	$result=0;
	if($_this->input->post($id)==''){
		if($_this->db->insert($table,$data)) {
			//$data[$id] = mysql_insert_id();
			$result = mysql_insert_id();
		}		
	} else {
		$_this->db->where($id,$_this->input->post($id));
		if($_this->db->update($table,$data)) //update($table = '', $set = NULL, $where = NULL, $limit = NULL)
			$result = $_this->input->post($id);
	}
	return $result;
}

/* Added by::: $hashank ::: */
/* _MY_Report_Manager
 * @param	String of employes reporing manager (Int) key
 * @return	String
 */

if ( ! function_exists('_MY_Report_Manager')) { 
	function _MY_Report_Manager($id=null,$as_string=FALSE) {
		$CI =& get_instance();
		$CI->db->select('salutation,f_name,l_name');
		$CI->db->where('id',$id);
		$result=$CI->db->get('company_employee')->row();
		if($as_string){
			$salntype=array('1'=>'Mr.','2'=>'Mrs.','3'=>'Miss');
			return $salntype[$result->salutation].'&nbsp;'.ucfirst($result->f_name).'&nbsp;'.$result->l_name;
		} else {
			return $result;
		}
	}  
}

