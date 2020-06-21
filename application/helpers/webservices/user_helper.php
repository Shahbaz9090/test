<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*****************function for get details with specific field*****************/

if (!function_exists('get_specific_data()')) {    
	function get_specific_data($fieldName,$tableName,$fieldData) {	  
	    $CI = &get_instance();
        $CI->db->select('id,group_id,first_name,last_name,email,password,status,status_comment,status_comment,created,modified,is_delete');
	    $CI->db->from($tableName);
	    $CI->db->where($fieldName,$fieldData);
	    $CI->db->limit(1);
	    $query = $CI->db->get();
	    if($query->num_rows()==1) {
		 return $query->result_array()[0];
	    } else {
		 return false;
	    }      
     }
}

/*****************function for get details with specific field*****************/

/*****************function for get other with specific field*****************/

if (!function_exists('_leadOthers')) {
    function _otherFieldsDataRecord($table=null,$field=null,$lead_id = null) {
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

/*****************function for get other with specific field*****************/

