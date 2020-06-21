<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Database helper
 *
 * @package   CodeIgniter
 * @subpackage  Helpers
 * @category  Db * @author    Kumar Gaurav
 * @website   http://www.tekshapers.com
 * @company     Tekshapers Inc 
 * @since   Version 1.0
 */
// ------------------------------------------------------------------------

if (!function_exists('set_common_insert_value')) {
    function set_common_insert_value() {
        $CI = &get_instance();
       // $CI->db->set('site_id', currentuserinfo()->site_id);
        $CI->db->set('added_by', currentuserinfo()->id);
        $CI->db->set('last_ip', current_ip());
        $CI->db->set('created_time', current_date());
    $CI->db->set('modified_time', current_date());
    }
}

if(!function_exists('set_common_insert_value2')) {
  function set_common_insert_value2() {
    $CI =& get_instance();
        $CI->db->set('added_by',currentuserinfo()->id);          
        $CI->db->set('last_ip',current_ip());          
  }
}
// ------------------------------------------------------------------------
/**

 * Set Common update value
 * @access  public
 */
if (!function_exists('set_common_update_value')) {
    function set_common_update_value() {
        $CI = &get_instance();

        $CI->db->set('last_ip', current_ip());
        $CI->db->set('added_by',currentuserinfo()->id);       
    }
}

if(!function_exists('set_common_update_value2')) {
  function set_common_update_value2() {
    $CI =& get_instance();
    $CI->db->set('last_ip',current_ip());          
    $CI->db->set('updated_by',currentuserinfo()->id);       
  }
}

// ------------------------------------------------------------------------

/**
 * Filter Content By Site Id 
 * Filter Content BY Current Site ID
 * @access  public
 */
if (!function_exists('filter_by_site_id')) {
    function filter_by_site_id($key = 'site_id') {
        $CI = &get_instance();
        $site_id = current_site_id();
        if ($site_id != 1)
            $CI->db->where($key, $site_id);
    }
}
// ------------------------------------------------------------------------

/**
 * Filter Data According to permission
 * @access  public
 */
if (!function_exists('__filter_data')) {
    function __filter_data($table = null) {
        $CI = &get_instance();
        $userinfo = currentuserinfo();
    //pr($userinfo);die;
        $site_colum = "site_id";
        $user_colum = "added_by";
    //pr($table);die;
        if ($table != null) {
            $site_colum = "$table.site_id";
            $user_colum = "$table.added_by";
        }


        $permission = $CI->session->userdata("permission");
	//pr($permission);
     /// pr($userinfo);die;

        if ((!$userinfo->is_super==1) && isset($permission['own_view']) && (@$permission['all_view'] !=
            101)) {

            $user_list = json_decode($CI->session->userdata("child_list"));
			//pr($user_list);die;
			
            $CI->db->where_in($user_colum, $user_list, false);
        }

        if ((!$userinfo->is_super==1) && isset($permission['own_edit']) && (@$permission['all_edit'] !=
            102)) {
				
            $user_list = json_decode($CI->session->userdata("child_list"));
			//pr($user_list);die;
            $CI->db->where_in($user_colum, $user_list, false);

        }

        //Filter by site id

        /*if (!$userinfo->is_super_site)
            $CI->db->where($site_colum, $userinfo->site_id, false);*/

    }

}

if (!function_exists('filter_data')) {
    function filter_data($table = NULL, $extra = NULL) {
        $CI = &get_instance();
        $userinfo = currentuserinfo();
        $child_list = get_child($userinfo->id, [$userinfo->group_id]);
        $child_list = @$child_list[0];
        $site_colum = "site_id";
        $user_colum = "added_by";
        $child_list[] = $userinfo->id;
        // pr($child_list);die;
        if ($table != null) {
            $site_colum = "$table.site_id";
            $user_colum = "$table.added_by";
        }

        $permission = $CI->session->userdata("permission");

	   	// pr($permission);die;
        // pr($userinfo);die;

        if(!$userinfo->is_super==1)
        {
        	if(isset($permission['all_view']) && !empty($permission['all_view']) && !empty($child_list))
        	{
        		// $CI->db->where_in($user_colum, $child_list, FALSE);
                $CI->db->where(" ( ".$user_colum." IN (".implode(",", $child_list).") ".$extra." ) ", NULL, FALSE);
        	}
        	elseif(isset($permission['own_view']) && !empty($permission['own_view']))
        	{
        		$CI->db->where(" ( ".$user_colum." IN (".$userinfo->id.") ".$extra." ) ", NULL, FALSE);
        	}
        }
    }

}

if (!function_exists('filter_data_for_dashboard')) {
    function filter_data_for_dashboard($table = NULL, $extra = NULL) {
        $CI = &get_instance();
        $userinfo = currentuserinfo();
        $child_list = get_child($userinfo->id, [$userinfo->group_id]);
        $child_list = @$child_list[0];
        $site_colum = "site_id";
        $user_colum = "added_by";
        $child_list[] = $userinfo->id;
        // pr($child_list);die;
        if ($table != null) {
            $site_colum = "$table.site_id";
            $user_colum = "$table.added_by";
        }
        if(!$userinfo->is_super==1)
        {
            $CI->db->where(" ( ".$user_colum." IN (".implode(",", $child_list).") ".$extra." ) ", NULL, FALSE);
        }
    }

}

/*This function check permission for edit and delete for user*/
function check_own_all_permission($id, $table,$assigned_users = null)
{
    $CI                 = &get_instance();
    $method_name        = $CI->router->fetch_method();
    $own_all_array      = $CI->session->userdata('permission');
    if($method_name == 'edit')
    {
        $perm_type      = @array_key_exists('all_edit',$own_all_array)?TRUE:FALSE;
    }
    elseif($method_name == 'delete')
    {
        $perm_type      = @array_key_exists('all_delete',$own_all_array)?TRUE:FALSE;
    }
    $userinfo           = currentuserinfo();
    if (isset($userinfo->is_super)) {
        if ($userinfo->is_super == 1 ) {
            return TRUE;
        }
    }
    $status         = false;
    $child_list     = get_child($userinfo->id, [$userinfo->group_id]);
    $child_list     = @$child_list[0];

    $child_list[]   = $userinfo->id;
    $CI->db->select('added_by')->from($table)->where($id);
    $query          = $CI->db->get();
    if($query->num_rows() > 0)
    {
        $added_by = $query->row()->added_by;
        //=========check whether enquiry added by heirarchy or by himself==========//
        if($perm_type)
        {
            if(in_array($added_by,$child_list))
            {
                $status = TRUE;
            }
            //===========check for assigned users================//
            if(!empty($assigned_users))
            {
                foreach ($assigned_users as $assigned_users)
                {
                    if(in_array($assigned_users,$child_list))
                    {
                        $status = TRUE;
                    }
                }
                
            }
            //===========check for assigned users================//
        }
        else
        {
            if($added_by == $userinfo->id)
            {
                $status = TRUE;
            }
            //===========check for assigned users================//
            if(!empty($assigned_users))
            {
                foreach ($assigned_users as $assigned_users)
                {
                    if($assigned_users == $userinfo->id)
                    {
                        $status = TRUE;
                    }
                }
                
            }
            //===========check for assigned users================//
        }
        //=========check whether enquiry added by heirarchy or by himself==========//
    }
    return $status;
}

/**
 * @function _contactById
 * @purpose fetch company contact by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_contactPersonById')) {
    function _contactPersonById($id = null) {
		
        $CI = &get_instance();
        $CI->db->select('name');
        $CI->db->from('companies_contact');
        $CI->db->where('id', $id);
        $query = $CI->db->get();
		
        if ($query->num_rows()) {
			$names = ucwords($query->row()->name);
            return $names;
        }
        return false;
    }
}
// ------------------------------------------------------------------------


/**
 * @function _priority
 * @purpose lists  priority values
 * @created 7Jan2014
 */

if (!function_exists('_priority')) {
    function _priority($date = null) {
        $arr = array(
            '1' => 'Low',
            '2' => 'Medium ',
            '3' => 'High');
        return $arr;
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
 * @function _getLeadStatus
 * @purpose gets status of Lead by id
 * @created 19Dec2014
 */

if (!function_exists('_getLeadStatus')) {
    function _getLeadStatus($leadStatus = null) {
    //echo $leadStatus;die;
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
 * @function _companyNameById
 * @purpose fetch company name by id 
 * @created 6 Jan 2014
 */
if (!function_exists('_companyNameById')) {
    function _companyNameById($id = null) {
        $CI = &get_instance();
        $CI->db->select('name');
        $CI->db->from('companies');
        $CI->db->where('id', $id);
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->row();
            $companyName = ucwords($result->name);
            return $companyName;
        }
        return false;
    }
}

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
//----------------------------------------------------------------------



if (!function_exists('currentUserID')) {
    function currentUserID() {
        $CI = &get_instance();
        return $CI->session->userdata("userinfo")->id;
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
/**

 * Filter Data According to permission 

 * 

 * @access  public

 */

if (!function_exists('filter_job_order_data')) {

    function filter_job_order_data($table = null,$smt_list=array()) {

        $CI = &get_instance();

        $userinfo = currentuserinfo();

        $site_colum = "site_id";

        $user_colum = "added_by";

        if ($table != null) {

            $site_colum = "$table.site_id";

            $user_colum = "$table.assign_user_id";

        }


        $permission = $CI->session->userdata("permission");

        if ((!$userinfo->is_super_site) && isset($permission['own_view']) && (@$permission['all_view'] !=
            101)) {
            $user_list = json_decode($CI->session->userdata("child_list"));
            if(isset($user_list) && !empty($user_list))
      {
        $user_list=$user_list;
      }
      else
      {
        $user_list=$smt_list;
      }
      $userlist = implode(",", $user_list);
            $CI->db->where("($table.added_by IN ($userlist) OR $user_colum IN ($userlist) )", null, false);

        }


        if ((!$userinfo->is_super_site) && isset($permission['own_edit']) && (@$permission['all_edit'] !=
            102)) {
            $user_list = json_decode($CI->session->userdata("child_list"));
            if(isset($user_list) && !empty($user_list))
      {
        $user_list=$user_list;
      }
      else
      {
        $user_list=$smt_list;
      }
      $userlist = implode(",", $user_list);

            $CI->db->where("($table.added_by IN ($userlist) OR $user_colum IN ($userlist) )", null, false);

        }


        //Filter by site id

        if (!$userinfo->is_super_site)
            $CI->db->where($site_colum, $userinfo->site_id, false);

    }


}


// ------------------------------------------------------------------------


/**

 * Filter Data According to permission

 *

 * @access  public

 */
if (!function_exists('add_report')) {

    function add_report($id = null) {
        $CI = &get_instance();
        $uri = $CI->uri->uri_string();
		//pr($uri);die;
        $CI->db->set('site_id', currentuserinfo()->site_id);
        $CI->db->set('added_by', currentuserinfo()->id);
        $CI->db->set('last_ip', current_ip());
        $CI->db->set('created_time', current_date());
        $CI->db->set('uri', $uri);
        $CI->db->set('action', AT_ADD);
        $CI->db->set('action_id', "$id");
		//pr($id);die;
        if($id != 'images'){
			$CI->db->insert("report");
		}
        
		

    }

}

if (!function_exists('update_report')) {

    function update_report($id = null) {
        $CI = &get_instance();
        $uri = $CI->uri->uri_string();

        $CI->db->set('site_id', currentuserinfo()->site_id);
        $CI->db->set('added_by', currentuserinfo()->id);
        $CI->db->set('last_ip', current_ip());
        $CI->db->set('created_time', current_date());
        $CI->db->set('uri', $uri);
        $CI->db->set('action', AT_EDIT);
        $CI->db->set('action_id', "$id");
        if($id != 'images'){
			$CI->db->insert("report");
		}


    }

}

if (!function_exists('view_report')) {

    function view_report($id = null) {
        $CI = &get_instance();
        $uri = $CI->uri->uri_string();

        $CI->db->set('site_id', currentuserinfo()->site_id);
        $CI->db->set('added_by', currentuserinfo()->id);
        $CI->db->set('last_ip', current_ip());
        $CI->db->set('created_time', current_date());
        $CI->db->set('uri', $uri);
        $CI->db->set('action', AT_VIEW);
        $CI->db->set('action_id', "$id");
        if($id != 'images'){
			$CI->db->insert("report");
		}


    }

}


if (!function_exists('delete_report')) {

    function delete_report($id = array()) {
        $CI = &get_instance();
        $uri = $CI->uri->uri_string();

        $id = implode(",", $id);

        $CI->db->set('site_id', currentuserinfo()->site_id);
        $CI->db->set('added_by', currentuserinfo()->id);
        $CI->db->set('last_ip', current_ip());
        $CI->db->set('created_time', current_date());
        $CI->db->set('uri', $uri);
        $CI->db->set('action', AT_DELTE);
        $CI->db->set('action_id', "$id");
        $CI->db->insert("report");


    }

}


if (!function_exists('export_report')) {

    function export_report($id = array()) {
        $CI = &get_instance();
        $uri = $CI->uri->uri_string();

        $id = implode(",", $id);

        $CI->db->set('site_id', currentuserinfo()->site_id);
        $CI->db->set('added_by', currentuserinfo()->id);
        $CI->db->set('last_ip', current_ip());
        $CI->db->set('created_time', current_date());
        $CI->db->set('uri', $uri);
        $CI->db->set('action', AT_EXPORT);
        $CI->db->set('action_id', "$id");
        $CI->db->insert("report");


    }

}


/**
 * 
 * function to create seperate database of each customer
 * @created on : 27th janauary 2015
 * @by - Nitish Janterparia
 * **/


if (!function_exists('create_customer_database')) {

    function create_customer_database($id) {
        $db_name = "erookie_$id";
        mysql_query("CREATE DATABASE $db_name");

        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0',
  `added_by` int(11) DEFAULT '0',
  `last_ip` varchar(15) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `candidate_id` int(11) NOT NULL DEFAULT '0',
  `text` longtext NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_size` float NOT NULL,
  PRIMARY KEY (`id`),
  FULLTEXT KEY `text` (`text`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
                        
CREATE TABLE IF NOT EXISTS $db_name.`attachment_resume` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `type` varchar(200) NOT NULL,
  `size` varchar(400) NOT NULL,
  `resume` longblob NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`candidate` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `is_refine` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `resume_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `total_year` float NOT NULL,
  `recent_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `middle_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `phone_home` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_cell` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_work` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `education` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `designation` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `notice_period` int(11) NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `country_id` int(5) NOT NULL,
  `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `zip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contract_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `key_skills` text COLLATE utf8_unicode_ci,
  `can_relocate` int(1) NOT NULL DEFAULT '0',
  `date_available` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `unique_code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `is_verified` enum('0','1') COLLATE utf8_unicode_ci NOT NULL COMMENT '0=>yes,1=>no',
  `candidate_pwd` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_first_name` (`first_name`),
  KEY `IDX_phone_home` (`phone_home`),
  KEY `IDX_phone_cell` (`phone_cell`),
  KEY `IDX_phone_work` (`phone_work`),
  KEY `IDX_key_skills` (`key_skills`(255)),
  KEY `IDX_site_first_last_modified` (`site_id`,`first_name`),
  KEY `IDX_site_id_email_1_2` (`site_id`),
  KEY `education` (`education`),
  KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`candidate_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        
        CREATE TABLE IF NOT EXISTS $db_name.`candidate_send_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_ip` varchar(20) NOT NULL,
  `recievers_id` varchar(20000) NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`cart_email_to_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `recievers_id` text NOT NULL,
  `created_time` datetime NOT NULL,
  `total_mail` varchar(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`cities` (
  `cityID` mediumint(6) NOT NULL DEFAULT '0',
  `cityName` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shortCity` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `regionID` smallint(8) DEFAULT NULL,
  `countryID` smallint(9) DEFAULT NULL,
  PRIMARY KEY (`cityID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`cities` (`cityID`, `cityName`, `shortCity`, `regionID`, `countryID`) VALUES
(0, 'New York City', 'NYC', 33, 1),
(1, ' Birmingham', 'Bir', 1, 1),
(2, ' Hoover', 'Hoo', 1, 1),
(4, 'Madison', 'Mad', 1, 1),
(5, 'Montgomery', 'Mon', 1, 1),
(6, 'Dothan', 'Dot', 1, 1),
(7, 'Gadsden', 'Gad', 1, 1),
(8, 'Decatur', 'Dec', 1, 1),
(9, 'Florence', 'Flo', 1, 1),
(10, 'Huntsville', 'Hun', 1, 1),
(11, 'Auburn', 'Aub', 1, 1),
(12, 'Bessemer', 'Bes', 1, 1),
(13, 'Tuscaloosa', 'Tus', 1, 1),
(14, 'Vestavia Hills', 'Ves', 1, 1),
(15, 'Phenix City', 'Phe', 1, 1),
(16, 'Mobile', 'Mob', 1, 1),
(17, ' Anchorage', 'Anch', 2, 1),
(18, ' Wasilla', 'Wasi', 2, 1),
(19, ' Bethel', 'Beth', 2, 1),
(20, ' Juneau', 'June', 2, 1),
(21, ' Kenai', 'Wasi', 2, 1),
(22, ' Kodiak', 'Wasi', 2, 1),
(23, ' Fairbanks', 'Wasi', 2, 1),
(24, ' Ketchikan', 'Wasi', 2, 1),
(25, ' Sterling', 'Wasi', 2, 1),
(26, ' College', 'Wasi', 2, 1),
(27, ' Palmer', 'Wasi', 2, 1),
(28, ' Barrow', 'Barr', 2, 1),
(29, ' Sitka', 'Wasi', 2, 1),
(30, ' Homer', 'Wasi', 2, 1),
(31, ' Soldotna', 'Wasi', 2, 1),
(32, ' \r\nPhoenix', 'Phoe', 3, 1),
(33, ' \r\nTucson', 'Tucs', 3, 1),
(34, ' \r\nMesa', 'Mesa', 3, 1),
(35, ' \r\nGlendale', 'Glen', 3, 1),
(36, ' \r\nChandler', 'Chan', 3, 1),
(37, ' \r\nScottsdale', 'Phoe', 3, 1),
(38, ' \r\nGilbert', 'Phoe', 3, 1),
(39, ' \r\nTempe', 'Phoe', 3, 1),
(40, ' \r\nPeoria', 'Phoe', 3, 1),
(41, ' \r\nYuma', 'Phoe', 3, 1),
(42, ' \r\nCasas Adobes', 'Phoe', 3, 1),
(43, ' \r\nCatalina Foothills', 'Phoe', 3, 1),
(44, ' \r\nAvondale', 'Phoe', 3, 1),
(45, ' \r\nSurprise', 'Phoe', 3, 1),
(46, ' \r\nFlagstaff', 'Phoe', 3, 1),
(47, ' \r\nLittle Rock', 'Litt', 4, 1),
(48, ' \r\nSpringdale', 'Sprin', 4, 1),
(49, ' \r\nTexarkana', 'Phoe', 4, 1),
(50, ' \r\nFort Smith', 'Fort', 4, 1),
(51, ' \r\nPine Bluff', 'Pine', 4, 1),
(52, ' \r\nBentonville', 'Bent', 4, 1),
(53, ' \r\nFayetteville', 'Faye', 4, 1),
(54, ' \r\nConvay', 'Conv', 4, 1),
(55, ' \r\nJacksonville', 'Jack', 4, 1),
(56, ' \r\nNorth Little Rock', 'Nort', 4, 1),
(57, ' \r\nRogers', 'Roge', 4, 1),
(58, ' \r\nWest Memphis', 'West', 4, 1),
(59, ' \r\nJonesboro', 'Jone', 4, 1),
(60, ' \r\nHot Springs', 'Hot', 4, 1),
(61, ' \r\nRusellville', 'Ruse', 4, 1),
(62, ' \r\nLos Angeles', 'Los', 5, 1),
(63, ' \r\nSacramento', 'Los', 5, 1),
(64, ' \r\nRiverside', 'Los', 5, 1),
(65, ' \r\nSan Diego', 'Los', 5, 1),
(66, ' \r\nFresno', 'Los', 5, 1),
(67, ' \r\nBakersfield', 'Los', 5, 1),
(68, ' \r\nSan Jose', 'Los', 5, 1),
(69, ' \r\nOakland', 'Los', 5, 1),
(70, ' \r\nStockton', 'Los', 5, 1),
(71, ' \r\nSan Francisco', 'Los', 5, 1),
(72, ' \r\nSanta Ana', 'Los', 5, 1),
(73, ' \r\nModesto', 'Los', 5, 1),
(74, ' \r\nLong Beach', 'Los', 5, 1),
(75, ' \r\nAnaheim', 'Los', 5, 1),
(76, ' \r\nChula Vista', 'Los', 5, 1),
(77, ' \r\nDenver', 'Denv', 6, 1),
(78, ' \r\nThornton', 'Denv', 6, 1),
(79, ' \r\nCentennial', 'Denv', 6, 1),
(80, ' \r\nColorado Spring', 'Denv', 6, 1),
(81, ' \r\nPueblo', 'Denv', 6, 1),
(82, ' \r\nBoulder', 'Denv', 6, 1),
(83, ' \r\nAurora', 'Denv', 6, 1),
(84, ' \r\nWestminster', 'Denv', 6, 1),
(85, ' \r\nGreeley', 'Denv', 6, 1),
(86, ' \r\nLakewood', 'Denv', 6, 1),
(87, ' \r\nArvada', 'Denv', 6, 1),
(88, ' \r\nLongmont', 'Denv', 6, 1),
(89, ' \r\nFort COllins', 'Denv', 6, 1),
(90, ' \r\nHighlands Ranch', 'Denv', 6, 1),
(91, ' \r\nLove Land', 'Denv', 6, 1),
(92, ' \r\nBridgeport', 'Brid', 7, 1),
(93, ' \r\nNorwalk', 'Brid', 7, 1),
(94, ' \r\nBristol', 'Brid', 7, 1),
(95, ' \r\nNew Haven', 'Brid', 7, 1),
(96, ' \r\nDanbury', 'Brid', 7, 1),
(97, ' \r\nHamden', 'Brid', 7, 1),
(98, ' \r\nHartford', 'Brid', 7, 1),
(99, ' \r\nNew Britain', 'Brid', 7, 1),
(100, ' \r\nMeriden', 'Brid', 7, 1),
(101, ' \r\nStemford', 'Brid', 7, 1),
(102, ' \r\nWest Hartford', 'Brid', 7, 1),
(103, ' \r\nFairfield', 'Brid', 7, 1),
(104, ' \r\nWaterbury', 'Brid', 7, 1),
(105, ' \r\nGreenwich', 'Brid', 7, 1),
(106, ' \r\nWest Haven', 'Brid', 7, 1),
(107, ' \r\nWilmington', 'Wilm', 8, 1),
(108, ' \r\nClaymont', 'Wilm', 8, 1),
(109, ' \r\nSmyrna', 'Wilm', 8, 1),
(110, ' \r\nDover', 'Wilm', 8, 1),
(111, ' \r\nWilmington Manor', 'Wilm', 8, 1),
(112, ' \r\nEdgemoor', 'Wilm', 8, 1),
(113, ' \r\nNewark', 'Wilm', 8, 1),
(114, ' \r\nMilford', 'Wilm', 8, 1),
(115, ' \r\nElsemere', 'Wilm', 8, 1),
(116, ' \r\nPike Creek', 'Wilm', 8, 1),
(117, ' \r\nSeaford', 'Wilm', 8, 1),
(118, ' \r\nGeorge Town', 'Wilm', 8, 1),
(119, ' \r\nBrook Side', 'Wilm', 8, 1),
(120, ' \r\nMiddletown', 'Wilm', 8, 1),
(121, ' \r\nNew Castle', 'Wilm', 8, 1),
(122, 'Washington,DC', 'Wash', 9, 1),
(123, 'Jacksonville', 'Jackf', 10, 1),
(124, 'Orlando', 'Jackf', 10, 1),
(125, 'Coral Springs', 'Jackf', 10, 1),
(126, 'Miami', 'Jackf', 10, 1),
(127, 'Fort Lauderdale', 'Jackf', 10, 1),
(128, 'Cape Coral', 'Jackf', 10, 1),
(129, 'Tampa', 'Jackf', 10, 1),
(130, 'Pembroke Pines', 'Jackf', 10, 1),
(131, 'Gainesville', 'Jackf', 10, 1),
(132, 'Saint Petersburg', 'Jackf', 10, 1),
(133, 'Tallahassee', 'Jackf', 10, 1),
(134, 'Port Saint Lucie', 'Jackf', 10, 1),
(135, 'Hialeah', 'Jackf', 10, 1),
(136, 'Hollywood', 'Jackf', 10, 1),
(137, 'Miramar', 'Jackf', 10, 1),
(138, 'Atlanta', 'Atl', 11, 1),
(139, 'Macon', 'Atl', 11, 1),
(140, 'Smyrna', 'Atl', 11, 1),
(141, 'Augusta', 'Atl', 11, 1),
(142, 'Roswell', 'Atl', 11, 1),
(143, 'Valdosta', 'Atl', 11, 1),
(144, 'Columbus', 'Atl', 11, 1),
(145, 'Albany', 'Atl', 11, 1),
(146, 'North Atlanta', 'Atl', 11, 1),
(147, 'Savannah', 'Atl', 11, 1),
(148, 'Marietta', 'Atl', 11, 1),
(149, 'Redan', 'Atl', 11, 1),
(150, 'Sandy Springs', 'Atl', 11, 1),
(151, 'Warner Robins', 'Atl', 11, 1),
(152, 'Dunwoody', 'Atl', 11, 1),
(153, 'Honolulu', 'Hono', 12, 1),
(154, 'Pearl City', 'Hono', 12, 1),
(155, 'Wahiawa', 'Hono', 12, 1),
(156, 'Hilo', 'Hono', 12, 1),
(157, 'Waimalu', 'Hono', 12, 1),
(158, 'Makakilo City', 'Hono', 12, 1),
(159, 'Kailua', 'Hono', 12, 1),
(160, 'Mililani Town', 'Hono', 12, 1),
(161, 'Ewa Beach', 'Hono', 12, 1),
(162, 'Kaneohe', 'Hono', 12, 1),
(163, 'Kahului', 'Hono', 12, 1),
(164, 'Wailuku', 'Hono', 12, 1),
(165, 'Wahipahu', 'Hono', 12, 1),
(166, 'Kihei', 'Hono', 12, 1),
(167, 'Nanakuli', 'Hono', 12, 1),
(168, 'Boise', 'Hono', 13, 1),
(169, 'Twin Falls', 'Hono', 13, 1),
(170, 'Moscow', 'Hono', 13, 1),
(171, 'Nampa', 'Hono', 13, 1),
(172, 'Caldwell', 'Hono', 13, 1),
(173, 'Idaho Falls', 'Hono', 13, 1),
(174, 'Lewiston', 'Hono', 13, 1),
(175, 'Hayden', 'Hono', 13, 1),
(176, 'Pocatello', 'Hono', 13, 1),
(177, 'Rexberg', 'Hono', 13, 1),
(178, 'Kuna', 'Hono', 13, 1),
(179, 'Meridian', 'Hono', 13, 1),
(180, 'Eagle', 'Hono', 13, 1),
(181, 'Post Falls', 'Hono', 13, 1),
(182, 'Garden City', 'Hono', 13, 1),
(183, 'Chicago', 'Chic', 14, 1),
(184, 'Springfield', 'Chic', 14, 1),
(185, 'Decatur', 'Chic', 14, 1),
(186, 'Aurora', 'Chic', 14, 1),
(187, 'Peoria', 'Chic', 14, 1),
(188, 'Champaign', 'Chic', 14, 1),
(189, 'Rockford', 'Chic', 14, 1),
(190, 'Elgin', 'Chic', 14, 1),
(191, 'Evanstone', 'Chic', 14, 1),
(192, 'Naperville', 'Chic', 14, 1),
(193, 'Waukegan', 'Chic', 14, 1),
(194, 'Arlington Heights', 'Chic', 14, 1),
(195, 'Joliet', 'Chic', 14, 1),
(196, 'Cicero', 'Chic', 14, 1),
(197, 'Schaumburg', 'Chic', 14, 1),
(198, 'Indianapolis', 'Indi', 15, 1),
(199, 'Gary', 'Indi', 15, 1),
(200, 'Anderson', 'Indi', 15, 1),
(201, 'Fort Wayne', 'Indi', 15, 1),
(202, 'Carmel', 'Indi', 15, 1),
(203, 'Terri Haute', 'Indi', 15, 1),
(204, 'Bloomington', 'Indi', 15, 1),
(205, 'Hammond', 'Indi', 15, 1),
(206, 'Fishers', 'Indi', 15, 1),
(207, 'Evansville', 'Indi', 15, 1),
(208, 'Muncie', 'Indi', 15, 1),
(209, 'Elkhart', 'Indi', 15, 1),
(210, 'South Bend', 'Indi', 15, 1),
(211, 'Lafayette', 'Indi', 15, 1),
(212, 'Mishawaka', 'Indi', 15, 1),
(213, 'Des Moines', 'Des', 16, 1),
(214, 'Iowa City', 'Indi', 16, 1),
(215, 'Cedar Falls', 'Indi', 16, 1),
(216, 'Cedar Rapids', 'Indi', 16, 1),
(217, 'Council Bluffs', 'Indi', 16, 1),
(218, 'Ankeny', 'Indi', 16, 1),
(219, 'Davenport', 'Indi', 16, 1),
(220, 'Dubuque', 'Indi', 16, 1),
(221, 'Urban Dale', 'Indi', 16, 1),
(222, 'Sioux City', 'Indi', 16, 1),
(223, 'Ames', 'Indi', 16, 1),
(224, 'Battendorf', 'Indi', 16, 1),
(225, 'Waterloo', 'Indi', 16, 1),
(226, 'West Des Moines', 'Indi', 16, 1),
(227, 'Marion', 'Indi', 16, 1),
(228, 'Wichita', 'Wich', 17, 1),
(229, 'Lawrence', 'Wich', 17, 1),
(230, 'Hutchinson', 'Wich', 17, 1),
(231, 'Overland Park ', 'Wich', 17, 1),
(232, 'Shawnee', 'Wich', 17, 1),
(233, 'Leavenworth', 'Wich', 17, 1),
(234, 'Kansas', 'Wich', 17, 1),
(235, 'Salina', 'Wich', 17, 1),
(236, 'Leawood', 'Wich', 17, 1),
(237, 'Topeka', 'Wich', 17, 1),
(238, 'Manhattan', 'Wich', 17, 1),
(239, 'Emporia', 'Wich', 17, 1),
(240, 'Olathe', 'Wich', 17, 1),
(241, 'Lenexa', 'Wich', 17, 1),
(242, 'Garden City', 'Wich', 17, 1),
(243, 'Lexington-Fayette', 'Wich', 18, 1),
(244, 'Richmond', 'Wich', 18, 1),
(245, 'Florence', 'Wich', 18, 1),
(246, 'Louisville', 'Wich', 18, 1),
(247, 'Hopkinsville', 'Wich', 18, 1),
(248, 'Paducah', 'Wich', 18, 1),
(249, 'Owensboro', 'Wich', 18, 1),
(250, 'Henderson', 'Wich', 18, 1),
(251, 'Nicholasville', 'Wich', 18, 1),
(252, 'Bowling Green', 'Wich', 18, 1),
(253, 'Frankfort', 'Wich', 18, 1),
(254, 'Elizabethtown', 'Wich', 18, 1),
(255, 'Covington', 'Wich', 18, 1),
(256, 'Jeffersontown', 'Wich', 18, 1),
(257, 'Valley Station', 'Wich', 18, 1),
(258, 'New Orleans', 'New', 19, 1),
(259, 'Lake Charles', 'New', 19, 1),
(260, 'Marrero', 'New', 19, 1),
(261, 'Baton Rogue', 'New', 19, 1),
(262, 'Kenner', 'New', 19, 1),
(263, 'New Iberia', 'New', 19, 1),
(264, 'Shreveport', 'New', 19, 1),
(265, 'Bossier City', 'New', 19, 1),
(266, 'Houma', 'New', 19, 1),
(267, 'Metairie', 'New', 19, 1),
(268, 'Monroe', 'New', 19, 1),
(269, 'Chalmette', 'New', 19, 1),
(270, 'Laffayette', 'New', 19, 1),
(271, 'Alexandria', 'New', 19, 1),
(272, 'Laplace', 'New', 19, 1),
(273, 'Portland', 'Port', 20, 1),
(274, 'Brunswick', 'Port', 20, 1),
(275, 'Augusta', 'Port', 20, 1),
(276, 'Lewiston', 'Port', 20, 1),
(277, 'South Portland', 'Port', 20, 1),
(278, 'Saco', 'Port', 20, 1),
(279, 'Bangor', 'Port', 20, 1),
(280, 'Auburn', 'Port', 20, 1),
(281, 'Westbrook', 'Port', 20, 1),
(282, 'Scarborough', 'Port', 20, 1),
(283, 'Gorham', 'Port', 20, 1),
(284, 'Waterville', 'Port', 20, 1),
(285, 'Sanford', 'Port', 20, 1),
(286, 'Biddeford', 'Port', 20, 1),
(287, 'Kennebunk', 'Port', 20, 1),
(288, 'Baltimore', 'Balti', 21, 1),
(289, 'Dundalk', 'Balti', 21, 1),
(290, 'Towson', 'Balti', 21, 1),
(291, 'Columbia', 'Balti', 21, 1),
(292, 'Rockville', 'Balti', 21, 1),
(293, 'Aspen Hill', 'Balti', 21, 1),
(294, 'Silverspring', 'Balti', 21, 1),
(295, 'Gaithersburg', 'Balti', 21, 1),
(296, 'Bethesda', 'Balti', 21, 1),
(297, 'Ellicot City', 'Balti', 21, 1),
(298, 'Frederick', 'Balti', 21, 1),
(299, 'Potomac', 'Balti', 21, 1),
(300, 'Germantown', 'Balti', 21, 1),
(301, 'Bowie', 'Balti', 21, 1),
(302, 'North Bethesda', 'Balti', 21, 1),
(303, 'Boston', 'Bost', 22, 1),
(304, 'Brockton', 'Bost', 22, 1),
(305, 'Quincy', 'Bost', 22, 1),
(306, 'Worcester', 'Bost', 22, 1),
(307, 'New Bedford', 'Bost', 22, 1),
(308, 'Newton', 'Bost', 22, 1),
(309, 'Springfield', 'Bost', 22, 1),
(310, 'Fall River', 'Bost', 22, 1),
(311, 'Somerville', 'Bost', 22, 1),
(312, 'Lowell', 'Bost', 22, 1),
(313, 'Plymouth', 'Bost', 22, 1),
(314, 'Lawrence', 'Bost', 22, 1),
(315, 'Cambridge', 'Bost', 22, 1),
(316, 'Lynn', 'Bost', 22, 1),
(317, 'Fahrmingham', 'Bost', 22, 1),
(318, 'Detroit', 'Det', 23, 1),
(319, 'Flint', 'Det', 23, 1),
(320, 'Westland', 'Det', 23, 1),
(321, 'Grand Rapids', 'Det', 23, 1),
(322, 'Ann Arbor', 'Det', 23, 1),
(323, 'Troy', 'Det', 23, 1),
(324, 'Warren', 'Det', 23, 1),
(325, 'Livonia', 'Det', 23, 1),
(326, 'Farmington Hills', 'Det', 23, 1),
(327, 'Sterling Heights', 'Det', 23, 1),
(328, 'Dearborn', 'Det', 23, 1),
(329, 'Southfield', 'Det', 23, 1),
(330, 'Lansing', 'Det', 23, 1),
(331, 'Canton', 'Det', 23, 1),
(332, 'Waterford', 'Det', 23, 1),
(333, 'Minneapolis', 'Minn', 24, 1),
(334, 'Plymouth', 'Minn', 24, 1),
(335, 'Maple Grove', 'Minn', 24, 1),
(336, 'Saint Paul', 'Minn', 24, 1),
(337, 'Brooklyn Park', 'Minn', 24, 1),
(338, 'Burnsville', 'Minn', 24, 1),
(339, 'Rochester', 'Minn', 24, 1),
(340, 'Eagan', 'Minn', 24, 1),
(341, 'Saint Cloud', 'Minn', 24, 1),
(342, 'Duluth', 'Minn', 24, 1),
(343, 'Eden Prairie', 'Minn', 24, 1),
(344, 'Bloomington', 'Minn', 24, 1),
(345, 'Coon Rapids', 'Minn', 24, 1),
(346, 'Lakeville', 'Minn', 24, 1),
(347, 'Blaine', 'Minn', 24, 1),
(348, 'Jackson', 'Jack', 25, 1),
(349, 'Southaven', 'Jack', 25, 1),
(350, 'Pascagoula', 'Jack', 25, 1),
(351, 'Gulfport', 'Jack', 25, 1),
(352, 'Greenville', 'Jack', 25, 1),
(353, 'Gautier', 'Jack', 25, 1),
(354, 'Hattiesburg', 'Jack', 25, 1),
(355, 'Tupelo', 'Jack', 25, 1),
(356, 'Clinton', 'Jack', 25, 1),
(357, 'Biloxi', 'Jack', 25, 1),
(358, 'Olive Branch', 'Jack', 25, 1),
(359, 'Columbus', 'Jack', 25, 1),
(360, 'Meridian', 'Jack', 25, 1),
(361, 'Vicksburg', 'Jack', 25, 1),
(362, 'Starkville', 'Jack', 25, 1),
(363, 'Kansas City', 'Kansa', 26, 1),
(364, 'Saint Joseph', 'Kansa', 26, 1),
(365, 'Chesterfield', 'Kansa', 26, 1),
(366, 'Saint Louis', 'Kansa', 26, 1),
(367, 'Saint Charles', 'Kansa', 26, 1),
(368, 'Joplin', 'Kansa', 26, 1),
(369, 'Springfield', 'Kansa', 26, 1),
(370, 'Saint Peters', 'Kansa', 26, 1),
(371, 'University City', 'Kansa', 26, 1),
(372, 'Independence', 'Kansa', 26, 1),
(373, 'Florissant', 'Kansa', 26, 1),
(374, 'Oakville', 'Kansa', 26, 1),
(375, 'Columbia', 'Kansa', 26, 1),
(376, 'Blue Springs', 'Kansa', 26, 1),
(377, 'Cape Girardeau', 'Kansa', 26, 1),
(378, 'Billings', 'Bill', 27, 1),
(379, 'Helena', 'Bill', 27, 1),
(380, 'Belgrade', 'Bill', 27, 1),
(381, 'Missoula', 'Bill', 27, 1),
(382, 'Kalispell', 'Bill', 27, 1),
(383, 'Livingston', 'Bill', 27, 1),
(384, 'Great Falls', 'Bill', 27, 1),
(385, 'Havre', 'Bill', 27, 1),
(386, 'Whitefish', 'Bill', 27, 1),
(387, 'Bozeman', 'Bill', 27, 1),
(388, 'Anaconda', 'Bill', 27, 1),
(389, 'Laurel', 'Bill', 27, 1),
(390, 'Butte', 'Bill', 27, 1),
(391, 'Miles City', 'Bill', 27, 1),
(392, 'Lewistown', 'Bill', 27, 1),
(393, 'Omaha', 'Omah', 28, 1),
(394, 'Fremont', 'Omah', 28, 1),
(395, 'Papillion', 'Omah', 28, 1),
(396, 'Lincoln', 'Omah', 28, 1),
(397, 'North Platte', 'Omah', 28, 1),
(398, 'La Vista', 'Omah', 28, 1),
(399, 'Bellevue', 'Omah', 28, 1),
(400, 'Norfolk', 'Omah', 28, 1),
(401, 'Scottsbluff', 'Omah', 28, 1),
(402, 'Grand Island', 'Omah', 28, 1),
(403, 'Hastings', 'Omah', 28, 1),
(404, 'Beatrice', 'Omah', 28, 1),
(405, 'Kearney', 'Omah', 28, 1),
(406, 'Columbus', 'Omah', 28, 1),
(407, 'South Sioux City', 'Omah', 28, 1),
(408, 'Las Vegas', 'Lasv', 29, 1),
(409, 'North Las Vegas', 'Lasv', 29, 1),
(410, 'Winchester', 'Lasv', 29, 1),
(411, 'Henderson', 'Lasv', 29, 1),
(412, 'Spring Valley', 'Lasv', 29, 1),
(413, 'Sun Valley', 'Lasv', 29, 1),
(414, 'Paradise', 'Lasv', 29, 1),
(415, 'Sparks', 'Lasv', 29, 1),
(416, 'Elko', 'Lasv', 29, 1),
(417, 'Reno', 'Lasv', 29, 1),
(418, 'Carson City', 'Lasv', 29, 1),
(419, 'Boulder City', 'Lasv', 29, 1),
(420, 'Sunrise Manor', 'Lasv', 29, 1),
(421, 'Pahrump', 'Lasv', 29, 1),
(422, 'Fernley', 'Lasv', 29, 1),
(423, 'Manchester', 'Manch', 30, 1),
(424, 'Salem', 'Manch', 30, 1),
(425, 'Keene', 'Manch', 30, 1),
(426, 'Nashua', 'Manch', 30, 1),
(427, 'Dover', 'Manch', 30, 1),
(428, 'Bedford', 'Manch', 30, 1),
(429, 'Concord', 'Manch', 30, 1),
(430, 'Merrimack', 'Manch', 30, 1),
(431, 'Portsmouth', 'Manch', 30, 1),
(432, 'Derry', 'Manch', 30, 1),
(433, 'Hudson', 'Manch', 30, 1),
(434, 'Goffstown', 'Manch', 30, 1),
(435, 'Rochester', 'Manch', 30, 1),
(436, 'Londonderry', 'Manch', 30, 1),
(437, 'Luconia', 'Manch', 30, 1),
(438, 'Newark', 'Newark', 31, 1),
(439, 'Edison', 'Newark', 31, 1),
(440, 'Passaic', 'Newark', 31, 1),
(441, 'Jersey City', 'Newark', 31, 1),
(442, 'Trenton', 'Newark', 31, 1),
(443, 'East Orange', 'Newark', 31, 1),
(444, 'Paterson', 'Newark', 31, 1),
(445, 'Camden', 'Newark', 31, 1),
(446, 'Union City', 'Newark', 31, 1),
(447, 'Elizabeth', 'Newark', 31, 1),
(448, 'Clifton', 'Newark', 31, 1),
(449, 'North Bergen', 'Newark', 31, 1),
(450, 'Toms River', 'Newark', 31, 1),
(451, 'Cherry Hill', 'Newark', 31, 1),
(452, 'Irvington', 'Newark', 31, 1),
(453, 'Albuquerque', 'Albu', 32, 1),
(454, 'Farmington', 'Albu', 32, 1),
(455, 'Carlsbad', 'Albu', 32, 1),
(456, 'Las Cruces', 'Albu', 32, 1),
(457, 'South Valley', 'Albu', 32, 1),
(458, 'Gallup', 'Albu', 32, 1),
(459, 'Santa Fe', 'Albu', 32, 1),
(460, 'Alamogordo', 'Albu', 32, 1),
(461, 'Deming', 'Albu', 32, 1),
(462, 'Rio Rancho', 'Albu', 32, 1),
(463, 'Clovis', 'Albu', 32, 1),
(464, 'Sunland Park', 'Albu', 32, 1),
(465, 'Roswell', 'Albu', 32, 1),
(466, 'Hobbs', 'Albu', 32, 1),
(467, 'Las Vegas', 'Albu', 32, 1),
(468, 'Hoboken', 'Hobo', 33, 1),
(469, 'Guttenberg', 'Hobo', 33, 1),
(470, 'Cliffside Park', 'Hobo', 33, 1),
(471, 'Jersey City', 'Hobo', 33, 1),
(472, 'Secaucus', 'Hobo', 33, 1),
(473, 'Edgewater', 'Hobo', 33, 1),
(474, 'Weehawken', 'Hobo', 33, 1),
(475, 'North Bergen', 'Hobo', 33, 1),
(476, 'Harrison', 'Hobo', 33, 1),
(477, 'Union City', 'Hobo', 33, 1),
(478, 'Bayonne', 'Hobo', 33, 1),
(479, 'Kearny', 'Hobo', 33, 1),
(480, 'West New York', 'Hobo', 33, 1),
(481, 'Fairview', 'Hobo', 33, 1),
(482, 'Ridgefield', 'Hobo', 33, 1),
(483, 'Charlotte', 'Charl', 34, 1),
(484, 'Fayetteville', 'Charl', 34, 1),
(485, 'Greenville', 'Charl', 34, 1),
(486, 'Raly', 'Charl', 34, 1),
(487, 'Carey', 'Charl', 34, 1),
(488, 'Asheville', 'Charl', 34, 1),
(489, 'Greensboro', 'Charl', 34, 1),
(490, 'High Point', 'Charl', 34, 1),
(491, 'Jacksonville', 'Charl', 34, 1),
(492, 'Durham', 'Charl', 34, 1),
(493, 'Wilmington', 'Charl', 34, 1),
(494, 'Gastonia', 'Charl', 34, 1),
(495, 'Winston-Salem', 'Charl', 34, 1),
(496, 'Concord', 'Charl', 34, 1),
(497, 'Rocky Mount', 'Charl', 34, 1),
(498, 'Fargo', 'West Fargo', 35, 1),
(499, 'West Fargo', 'West Fargo', 35, 1),
(500, 'Wahpeton', 'West Fargo', 35, 1),
(501, 'Bismarck', 'West Fargo', 35, 1),
(502, 'Mandans', 'West Fargo', 35, 1),
(503, 'Devils Lake', 'West Fargo', 35, 1),
(504, 'Grand Fork', 'West Fargo', 35, 1),
(505, 'Dickinson', 'West Fargo', 35, 1),
(506, 'Minot', 'West Fargo', 35, 1),
(507, 'Jamestown', 'West Fargo', 35, 1),
(508, 'Grafton', 'West Fargo', 35, 1),
(509, 'Williston', 'West Fargo', 35, 1),
(510, 'Valley City', 'West Fargo', 35, 1),
(511, 'Columbus', 'Colum', 36, 1),
(512, 'Dayton', 'Colum', 36, 1),
(513, 'Springfield', 'Colum', 36, 1),
(514, 'Cleveland', 'Colum', 36, 1),
(515, 'Parma', 'Colum', 36, 1),
(516, 'Hamilton', 'Colum', 36, 1),
(517, 'Toledo', 'Colum', 36, 1),
(518, 'Canton', 'Colum', 36, 1),
(519, 'Kettering', 'Colum', 36, 1),
(520, 'Cincinnati', 'Colum', 36, 1),
(521, 'Youngstown', 'Colum', 36, 1),
(522, 'Elyria', 'Colum', 36, 1),
(523, 'Akron', 'Colum', 36, 1),
(524, 'Lorain', 'Colum', 36, 1),
(525, 'Middletown', 'Colum', 36, 1),
(526, 'Oklahoma City', '', 37, 1),
(527, 'Edmond', 'Edm', 37, 1),
(528, 'Muskogee', 'Musk', 37, 1),
(529, 'Tulsa', 'Edm', 37, 1),
(530, 'Midwest City', 'Edm', 37, 1),
(531, 'Bartlesville', 'Edm', 37, 1),
(532, 'Norman', 'Edm', 37, 1),
(533, 'Moore', 'Edm', 37, 1),
(534, 'Shawnee', 'Edm', 37, 1),
(535, 'Lawton', 'Edm', 37, 1),
(536, 'Enid', 'Edm', 37, 1),
(537, 'Ponca City', 'Edm', 37, 1),
(538, 'Broken Arrow', 'Edm', 37, 1),
(539, 'Stillwater', 'Edm', 37, 1),
(540, 'Ardmore', 'Edm', 37, 1),
(541, 'Portland', 'Port', 38, 1),
(542, 'Hillsboro', 'Port', 38, 1),
(543, 'Tigard', 'Port', 38, 1),
(544, 'Salem', 'Port', 38, 1),
(545, 'Medford', 'Port', 38, 1),
(546, 'Aloha', 'Port', 38, 1),
(547, 'Eugene', 'Port', 38, 1),
(548, 'Bend', 'Port', 38, 1),
(549, 'Albany', 'Port', 38, 1),
(550, 'Gresham', 'Port', 38, 1),
(551, 'Springfield', 'Port', 38, 1),
(552, 'Lake Oswego', 'Port', 38, 1),
(553, 'Beaverton', 'Port', 38, 1),
(554, 'Corvellis', 'Port', 38, 1),
(555, 'Keizer', 'Port', 38, 1),
(556, 'Philadelphia', 'Phil', 39, 1),
(557, 'Bethlehem', 'Phil', 39, 1),
(558, 'Altoona', 'Phil', 39, 1),
(559, 'Pittsburgh', 'Phil', 39, 1),
(560, 'Scranton', 'Phil', 39, 1),
(561, 'State College', 'Phil', 39, 1),
(562, 'Allen Town', 'Phil', 39, 1),
(563, 'Lancaster', 'Phil', 39, 1),
(564, 'Wilkes-Barre', 'Phil', 39, 1),
(565, 'Erie', 'Phil', 39, 1),
(566, 'Levittown', 'Phil', 39, 1),
(567, 'York', 'Phil', 39, 1),
(568, 'Reading', 'Phil', 39, 1),
(569, 'Harrisburgh', 'Phil', 39, 1),
(570, 'Chester', 'Phil', 39, 1),
(571, 'Providence', 'Prov', 40, 1),
(572, 'Woonsocket', 'Prov', 40, 1),
(573, 'Westerly', 'Prov', 40, 1),
(574, 'Warwick', 'Prov', 40, 1),
(575, 'Coventry', 'Prov', 40, 1),
(576, 'Newport', 'Prov', 40, 1),
(577, 'Cranston', 'Prov', 40, 1),
(578, 'Cumberland', 'Prov', 40, 1),
(579, 'Bristol', 'Prov', 40, 1),
(580, 'Pawtucket', 'Prov', 40, 1),
(581, 'North Providence', 'Prov', 40, 1),
(582, 'Smithfield', 'Prov', 40, 1),
(583, 'East Providence', 'Prov', 40, 1),
(584, 'West Warwick', 'Prov', 40, 1),
(585, 'Central Falls', 'Prov', 40, 1),
(586, 'Columbia', 'Colu', 41, 1),
(587, 'Greenville', 'Colu', 41, 1),
(588, 'Goose Creek', 'Colu', 41, 1),
(589, 'Charleston', 'Colu', 41, 1),
(590, 'Summerville', 'Colu', 41, 1),
(591, 'Florence', 'Colu', 41, 1),
(592, 'North Charleston', 'Colu', 41, 1),
(593, 'Sumter', 'Colu', 41, 1),
(594, 'Aiken', 'Colu', 41, 1),
(595, 'Rock Hill', 'Colu', 41, 1),
(596, 'Spartanburg', 'Colu', 41, 1),
(597, 'Anderson', 'Colu', 41, 1),
(598, 'Mount Pleasant', 'Colu', 41, 1),
(599, 'Hilton Head Island', 'Colu', 41, 1),
(600, 'Myrtle Beach', 'Colu', 41, 1),
(601, 'Sioux Falls', 'Siou', 42, 1),
(602, 'Mitchell', 'Siou', 42, 1),
(603, 'Spearfish', 'Siou', 42, 1),
(604, 'Rapid City', 'Siou', 42, 1),
(605, 'Pierre', 'Siou', 42, 1),
(606, 'Rapid Valley', 'Siou', 42, 1),
(607, 'Aberdeen', 'Siou', 42, 1),
(608, 'Yankton', 'Siou', 42, 1),
(609, 'Brandon', 'Siou', 42, 1),
(610, 'Watertown', 'Siou', 42, 1),
(611, 'Huron', 'Siou', 42, 1),
(612, 'Sturgis', 'Siou', 42, 1),
(613, 'Brookings', 'Siou', 42, 1),
(614, 'Vermillion', 'Siou', 42, 1),
(615, 'Madison', 'Siou', 42, 1),
(616, 'Memphis', 'Memp', 43, 1),
(617, 'Murfreesboro', 'Memp', 43, 1),
(618, 'Kingport', 'Memp', 43, 1),
(619, 'Nashville', 'Memp', 43, 1),
(620, 'Jackson', 'Memp', 43, 1),
(621, 'Bartlett', 'Memp', 43, 1),
(622, 'Knoxville', 'Memp', 43, 1),
(623, 'Johnson City', 'Memp', 43, 1),
(624, 'Collierville', 'Memp', 43, 1),
(625, 'Chattanooga', 'Memp', 43, 1),
(626, 'Franklin', 'Memp', 43, 1),
(627, 'Cleveland', 'Memp', 43, 1),
(628, 'Clarksville', 'Memp', 43, 1),
(629, 'Hendersonville', 'Memp', 43, 1),
(630, 'Germantown', 'Memp', 43, 1),
(631, 'Houston', 'Hous', 44, 1),
(632, 'El Paso', 'Hous', 44, 1),
(633, 'Lubbock', 'Hous', 44, 1),
(634, 'San Antonio', 'Hous', 44, 1),
(635, 'Arlingtom', 'Hous', 44, 1),
(636, 'Laredo', 'Hous', 44, 1),
(637, 'Dallas', 'Hous', 44, 1),
(638, 'Corpus Christi', 'Hous', 44, 1),
(639, 'Irving', 'Hous', 44, 1),
(640, 'Austin', 'Hous', 44, 1),
(641, 'Plano', 'Hous', 44, 1),
(642, 'Amarillo', 'Hous', 44, 1),
(643, 'Fort Worth', 'Hous', 44, 1),
(644, 'Garland', 'Hous', 44, 1),
(645, 'Brownsville', 'Hous', 44, 1),
(646, 'Salt Lake City', 'Salt', 45, 1),
(647, 'Sandy', 'Salt', 45, 1),
(648, 'Murray', 'Salt', 45, 1),
(649, 'West Valley City', 'Salt', 45, 1),
(650, 'Ogden', 'Salt', 45, 1),
(651, 'Logan', 'Salt', 45, 1),
(652, 'Provo', 'Salt', 45, 1),
(653, 'Layton', 'Salt', 45, 1),
(654, 'Bountiful', 'Salt', 45, 1),
(655, 'West Jordan', 'Salt', 45, 1),
(656, 'Saint George', 'Salt', 45, 1),
(657, 'South Jordan', 'Salt', 45, 1),
(658, 'Orem', 'Salt', 45, 1),
(659, 'Taylorsville', 'Salt', 45, 1),
(660, 'Roy', 'Salt', 45, 1),
(661, 'Burlington', 'Burl', 46, 1),
(662, 'Brattleboro', 'Burl', 46, 1),
(663, 'Williston', 'Burl', 46, 1),
(664, 'Bennington', 'Burl', 46, 1),
(665, 'Springfield', 'Burl', 46, 1),
(666, 'Montpelier', 'Burl', 46, 1),
(667, 'Colchester', 'Burl', 46, 1),
(668, 'Hartford', 'Burl', 46, 1),
(669, 'Saint Johnsbury', 'Burl', 46, 1),
(670, 'South Burlington', 'Burl', 46, 1),
(671, 'Barre', 'Burl', 46, 1),
(672, 'Saint Albans', 'Burl', 46, 1),
(673, 'Rutland', 'Burl', 46, 1),
(674, 'Middlebury', 'Burl', 46, 1),
(675, 'Jericho', 'Burl', 46, 1),
(676, 'Virginia Beach', 'Virg', 47, 1),
(677, 'Newport News', 'Virg', 47, 1),
(678, 'Suffolk', 'Virg', 47, 1),
(679, 'Norfolk', 'Virg', 47, 1),
(680, 'Hampton', 'Virg', 47, 1),
(681, 'Lynchburg', 'Virg', 47, 1),
(682, 'Chesapeake', 'Virg', 47, 1),
(683, 'Alexandria', 'Virg', 47, 1),
(684, 'Centreville', 'Virg', 47, 1),
(685, 'Richmond', 'Virg', 47, 1),
(686, 'Portsmouth', 'Virg', 47, 1),
(687, 'Dale City', 'Virg', 47, 1),
(688, 'Arlington', 'Virg', 47, 1),
(689, 'Roanoke', 'Virg', 47, 1),
(690, 'Reston', 'Virg', 47, 1),
(691, 'Seattle', 'Seat', 48, 1),
(692, 'Everett', 'Seat', 48, 1),
(693, 'Kennewick', 'Seat', 48, 1),
(694, 'Spokane', 'Seat', 48, 1),
(695, 'Yakima', 'Seat', 48, 1),
(696, 'Lakewoood', 'Seat', 48, 1),
(697, 'Tacoma', 'Seat', 48, 1),
(698, 'Kent', 'Seat', 48, 1),
(699, 'Renton', 'Seat', 48, 1),
(700, 'Vancouver', 'Seat', 48, 1),
(701, 'Federal Way', 'Seat', 48, 1),
(702, 'Shoreline', 'Seat', 48, 1),
(703, 'Bellevue', 'Seat', 48, 1),
(704, 'Bellingham', 'Seat', 48, 1),
(705, 'Redmond', 'Seat', 48, 1),
(706, 'Charleston', 'Charl', 49, 1),
(707, 'Weirton', 'Charl', 49, 1),
(708, 'South Charleston', 'Charl', 49, 1),
(709, 'Huntington', 'Charl', 49, 1),
(710, 'Fairmont', 'Charl', 49, 1),
(711, 'Saint Albans', 'Charl', 49, 1),
(712, 'Parkersburg', 'Charl', 49, 1),
(713, 'Beckley', 'Charl', 49, 1),
(714, 'Bluefield', 'Charl', 49, 1),
(715, 'Wheeling', 'Charl', 49, 1),
(716, 'Clarksburg', 'Charl', 49, 1),
(717, 'Vienna', 'Charl', 49, 1),
(718, 'Morgantown', 'Charl', 49, 1),
(719, 'Martinsburg', 'Charl', 49, 1),
(720, 'Cross Lanes', 'Charl', 49, 1),
(721, 'Milwaukee', 'Milw', 50, 1),
(722, 'Appleton', 'Milw', 50, 1),
(723, 'West Allis', 'Milw', 50, 1),
(724, 'Madison', 'Milw', 50, 1),
(725, 'Waukesha', 'Milw', 50, 1),
(726, 'La Crosse', 'Milw', 50, 1),
(727, 'Green Bay', 'Milw', 50, 1),
(728, 'Oshkosh', 'Milw', 50, 1),
(729, 'Sheboygan', 'Milw', 50, 1),
(730, 'Kenosha', 'Milw', 50, 1),
(731, 'Eau Claire', 'Milw', 50, 1),
(732, 'Wauwatosa', 'Milw', 50, 1),
(733, 'Racine', 'Milw', 50, 1),
(734, 'Janesville', 'Milw', 50, 1),
(735, 'Fond du Lac', 'Milw', 50, 1),
(736, 'Cheyenne', 'Chey', 51, 1),
(737, 'Sheridan', 'Chey', 51, 1),
(738, 'Jackson', 'Chey', 51, 1),
(739, 'Casper', 'Chey', 51, 1),
(740, 'Green River', 'Chey', 51, 1),
(741, 'Rawlins', 'Chey', 51, 1),
(742, 'Laramie', 'Chey', 51, 1),
(743, 'Evanston', 'Chey', 51, 1),
(744, 'Lander', 'Chey', 51, 1),
(745, 'Gillette', 'Chey', 51, 1),
(746, 'Riverton', 'Chey', 51, 1),
(747, 'Torrington', 'Chey', 51, 1),
(748, 'Rock Springs', 'Chey', 51, 1),
(749, 'Cody', 'Chey', 51, 1),
(750, 'Douglas', 'Chey', 51, 1),
(40034, 'Acme', 'Acme', 52, 2),
(40395, 'Sointula', 'Sointula', 53, 2),
(40396, 'Sooke', 'Sooke', 53, 2),
(40397, 'Sorrento', 'Sorrento', 53, 2),
(40398, 'Squamish', 'Squamish', 53, 2),
(40399, 'Stephen', 'Stephen', 53, 2),
(40400, 'Stewart', 'Stewart', 53, 2),
(40401, 'Sturdies Bay', 'SturdiesBay', 53, 2),
(40402, 'Summerland', 'Summerland', 53, 2),
(40403, 'Surrey', 'Surrey', 53, 2),
(40404, 'Tahsis', 'Tahsis', 53, 2),
(40405, 'Tappen', 'Tappen', 53, 2),
(40406, 'Taylor', 'Taylor', 53, 2),
(40407, 'Telegraph Creek', 'TelegraphCreek', 53, 2),
(40408, 'Terrace', 'Terrace', 53, 2),
(40409, 'Tlell', 'Tlell', 53, 2),
(40410, 'Tofino', 'Tofino', 53, 2),
(40411, 'Trail', 'Trail', 53, 2),
(40412, 'Tsawwassen', 'Tsawwassen', 53, 2),
(40413, 'Ucluelet', 'Ucluelet', 53, 2),
(40414, 'Union Bay', 'UnionBay', 53, 2),
(40415, 'Valemount', 'Valemount', 53, 2),
(40416, 'Vancouver', 'Vancouver', 53, 2),
(40417, 'Vanderhoof', 'Vanderhoof', 53, 2),
(40418, 'Vernon', 'Vernon', 53, 2),
(40419, 'Victoria', 'Victoria', 53, 2),
(45804, 'Salzburg', 'Salzburg', NULL, 46),
(45805, 'Innsbruck', 'Innsbruck', NULL, 46),
(45806, 'Klagenfurt am W+Ârthersee', 'KlagenfurtamWorthersee', NULL, 46),
(45807, 'Villach', 'Villach', NULL, 46),
(60158, 'Laughton', 'Laughton', 65, 95),
(60159, 'Leamington', 'Leamington', 65, 95),
(60160, 'Leeds', 'Leeds', 65, 95),
(60161, 'Leek', 'Leek', 65, 95),
(60162, 'Leicester', 'Leicester', 65, 95),
(60163, 'Leigh', 'Leigh', 65, 95),
(60164, 'Letchworth', 'Letchworth', 65, 95),
(60165, 'Lewes', 'Lewes', 65, 95),
(60166, 'Leyland', 'Leyland', 65, 95),
(60167, 'Lichfield', 'Lichfield', 65, 95),
(60168, 'Lincoln', 'Lincoln', 65, 95),
(60169, 'Little Chalfont', 'LittleChalfont', 65, 95),
(60170, 'Liverpool', 'Liverpool', 65, 95),
(60171, 'London', 'London', 65, 95),
(60172, 'Loughborough', 'Loughborough', 65, 95),
(60173, 'Louth', 'Louth', 65, 95),
(60174, 'Lowestoft', 'Lowestoft', 65, 95),
(60175, 'Luton', 'Luton', 65, 95),
(60292, 'Kabul', 'Kabul', 2, 97),
(60293, 'Kandah-ür', 'Kandahar', 2, 97),
(60294, 'Maz-ür-e Shar-½f', 'Mazar-eSharif', 2, 97),
(60295, 'Her-üt', 'Herat', 2, 97),
(60296, 'Jal-ül-üb-üd', 'Jalalabad', 2, 97),
(60297, 'Kunduz', 'Kunduz', 2, 97),
(60298, 'Ghazni', 'Ghazni', 2, 97),
(60299, 'Balkh', 'Balkh', 2, 97),
(60300, 'Baghl-ün', 'Baghlan', 2, 97),
(60301, 'Gard-ôz', 'Gardez', 2, 97),
(64999, '*Tokyo', 'Tokyo', 2, 111),
(65000, 'Yokohama-shi', 'Yokohama-shi', 2, 111),
(65001, '+îsaka-shi', 'Osaka-shi', 2, 111),
(65002, 'Nagoya-shi', 'Nagoya-shi', 2, 111),
(65003, 'Sapporo-shi', 'Sapporo-shi', 2, 111),
(65004, 'K+ìbe-shi', 'Kobe-shi', 2, 111),
(65005, 'Kyoto', 'Kyoto', 2, 111),
(65006, 'Fukuoka-shi', 'Fukuoka-shi', 2, 111),
(65007, 'Kawasaki', 'Kawasaki', 2, 111),
(65008, 'Saitama', 'Saitama', 2, 111),
(65009, 'Paramus', 'PA', 31, 1),
(65010, 'Foster City', 'FC', 5, 1),
(65011, 'Menomonee Falls', 'MF', 50, 1),
(65012, 'Rochester', 'RC', 33, 1),
(65013, 'Radnor', 'Ra', 39, 1),
(65014, 'Piscataway', 'PC', 31, 1),
(65015, 'Somerset', 'SS', 31, 1),
(65016, 'Alpharetta', 'AP', 11, 1),
(65017, 'King of Prussia', 'kin', 39, 1),
(65018, 'Camp Hill', 'cam', 39, 1);

        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `name` varchar(250) NOT NULL,
  `website` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`companies_contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `primary_phone` varchar(15) DEFAULT NULL,
  `ext` int(10) NOT NULL,
  `secondary_phone` varchar(15) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fax_num` varchar(20) DEFAULT NULL,
  `address` longtext,
  `city` varchar(25) NOT NULL,
  `state` int(11) NOT NULL,
  `country_id` int(4) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `hot_contact` int(1) NOT NULL DEFAULT '0',
  `hot_contact_comment` varchar(250) NOT NULL,
  `key_technologies` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `campany_doc` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
           CREATE TABLE IF NOT EXISTS $db_name.`companies_contact_doc` (
  `companies_contact_id` int(11) NOT NULL,
  `doc_file` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`company_areas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `country_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`continents` (
  `continentID` smallint(11) NOT NULL DEFAULT '0',
  `continentName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`continentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`continents` (`continentID`, `continentName`) VALUES
(1, 'North America'),
(2, 'South America'),
(3, 'Europe'),
(4, 'Asia'),
(5, 'Africa'),
(6, 'Australia & Oceania');

        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`controllers_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(50) DEFAULT NULL,
  `module` varchar(30) NOT NULL,
  `controller` varchar(25) DEFAULT NULL,
  `method` varchar(25) DEFAULT NULL,
  `action` int(3) NOT NULL,
  `is_super` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        INSERT INTO $db_name.`controllers_info` (`id`, `title`, `module`, `controller`, `method`, `action`, `is_super`) VALUES
(1, 'Company', 'company', 'company', 'add', 103, 0),
(2, 'Company', 'company', 'company', 'view', 101, 0),
(3, 'Company', 'company', 'company', 'edit', 102, 0),
(4, 'Company', 'company', 'company', 'list_items', 101, 0),
(5, 'Company', 'company', 'company', 'ajax_list_items', 101, 0),
(6, 'Company', 'company', 'company', 'export', 105, 0),
(7, 'Company', 'company', 'company', 'delete', 104, 0),
(8, 'Company Contact', 'company', 'contact', 'add', 103, 0),
(9, 'Company Contact', 'company', 'contact', 'view', 101, 0),
(10, 'Company Contact', 'company', 'contact', 'edit', 102, 0),
(11, 'Company Contact', 'company', 'contact', 'list_items', 101, 0),
(12, 'Company Contact', 'company', 'contact', 'ajax_list_items', 101, 0),
(13, 'Company Contact', 'company', 'contact', 'export', 105, 0),
(14, 'Company Contact', 'company', 'contact', 'delete', 104, 0),
(15, 'Company Contact', 'company', 'contact', 'status', 103, 0),
(16, 'Site', 'user', 'site', 'add', 103, 1),
(17, 'Site', 'user', 'site', 'edit', 102, 1),
(18, 'Site', 'user', 'site', 'view', 101, 1),
(19, 'Site', 'user', 'site', 'list_items', 101, 1),
(20, 'Site', 'user', 'site', 'ajax_list_items', 101, 1),
(21, 'Site', 'user', 'site', 'export', 105, 1),
(22, 'Site', 'user', 'site', 'delete', 104, 1),
(23, 'User', 'user', 'user', 'add', 103, 0),
(24, 'User', 'user', 'user', 'edit', 102, 0),
(25, 'User', 'user', 'user', 'view', 101, 0),
(26, 'User', 'user', 'user', 'list_items', 101, 0),
(27, 'User', 'user', 'user', 'ajax_list_items', 101, 0),
(28, 'User', 'user', 'user', 'export', 105, 0),
(29, 'User', 'user', 'user', 'delete', 104, 0),
(30, 'User', 'user', 'user', 'permission', 211, 0),
(31, 'User', 'user', 'user', 'status', 103, 0),
(32, 'Group', 'user', 'group', 'add', 103, 0),
(33, 'Group', 'user', 'group', 'edit', 102, 0),
(34, 'Group', 'user', 'group', 'view', 101, 0),
(35, 'Group', 'user', 'group', 'list_items', 101, 0),
(36, 'Group', 'user', 'group', 'ajax_list_items', 101, 0),
(37, 'Group', 'user', 'group', 'export', 105, 0),
(38, 'Group', 'user', 'group', 'delete', 104, 0),
(39, 'Group', 'user', 'group', 'permission', 211, 0),
(40, 'Candidate', 'candidate', 'candidate', 'add', 103, 0),
(41, 'Candidate', 'candidate', 'candidate', 'view', 101, 0),
(42, 'Candidate', 'candidate', 'candidate', 'edit', 102, 0),
(43, 'Candidate', 'candidate', 'candidate', 'list_items', 101, 0),
(44, 'Candidate', 'candidate', 'candidate', 'ajax_list_items', 101, 0),
(46, 'Candidate', 'candidate', 'candidate', 'export', 105, 0),
(47, 'Candidate', 'candidate', 'candidate', 'delete', 104, 0),
(48, 'Candidate', 'candidate', 'candidate', 'download_resume', 233, 0),
(49, 'Candidate', 'candidate', 'candidate', 'temp_resume', 101, 0),
(50, 'Candidate', 'candidate', 'candidate', 'view_resume', 222, 0),
(51, 'Job Order', 'job_order', 'job_order', 'add', 103, 0),
(52, 'Job Order', 'job_order', 'job_order', 'view', 101, 0),
(53, 'Job Order', 'job_order', 'job_order', 'edit', 102, 0),
(54, 'Job Order', 'job_order', 'job_order', 'list_items', 101, 0),
(55, 'Job Order', 'job_order', 'job_order', 'ajax_list_items', 101, 0),
(56, 'Job Order', 'job_order', 'job_order', 'export', 105, 0),
(57, 'Job Order', 'job_order', 'job_order', 'delete', 104, 0),
(58, 'Job Order', 'job_order', 'job_order', 'ajax_users', 101, 0),
(59, 'Job Order', 'job_order', 'job_order', 'ajax_contact', 101, 0),
(60, 'Job Order', 'job_order', 'job_order', 'status', 103, 0),
(61, 'Job Order Pipeline', 'job_order', 'pipeline', 'add', 103, 0),
(62, 'Job Order Pipeline', 'job_order', 'pipeline', 'list_items', 101, 0),
(63, 'Job Order Pipeline', 'job_order', 'pipeline', 'edit', 101, 0),
(64, 'Job Order Pipeline', 'job_order', 'pipeline', 'view', 101, 0),
(65, 'Job Order Assign', 'job_order', 'assign_job', 'add', 103, 0),
(66, 'Vendor', 'vendor', 'vendor', 'ajax_list_items', 101, 0),
(67, 'Vendor', 'vendor', 'vendor', 'add', 103, 0),
(68, 'Vendor', 'vendor', 'vendor', 'view', 101, 0),
(69, 'Vendor', 'vendor', 'vendor', 'edit', 102, 0),
(70, 'Vendor', 'vendor', 'vendor', 'list_items', 101, 0),
(71, 'Vendor', 'vendor', 'vendor', 'export', 105, 0),
(72, 'Vendor', 'vendor', 'vendor', 'delete', 104, 0),
(73, 'Vendor Blacklist', 'vendor', 'blacklist', 'ajax_list_items', 101, 0),
(74, 'Vendor Blacklist', 'vendor', 'blacklist', 'view', 101, 0),
(75, 'Vendor Blacklist', 'vendor', 'blacklist', 'edit', 102, 0),
(76, 'Vendor Blacklist', 'vendor', 'blacklist', 'list_items', 101, 0),
(77, 'Vendor Blacklist', 'vendor', 'blacklist', 'export', 105, 0),
(78, 'Vendor Blacklist', 'vendor', 'blacklist', 'delete', 104, 0),
(79, 'Training', 'training', 'training', 'ajax_list_items', 101, 0),
(80, 'Training', 'training', 'training', 'add', 103, 0),
(81, 'Training', 'training', 'training', 'view', 101, 0),
(82, 'Training', 'training', 'training', 'edit', 102, 0),
(83, 'Training', 'training', 'training', 'list_items', 101, 0),
(84, 'Training', 'training', 'training', 'export', 105, 0),
(85, 'Training', 'training', 'training', 'delete', 104, 0),
(86, 'Training Category', 'training', 'category', 'ajax_list_items', 101, 0),
(87, 'Training Category', 'training', 'category', 'add', 103, 0),
(88, 'Training Category', 'training', 'category', 'view', 101, 0),
(89, 'Training Category', 'training', 'category', 'edit', 102, 0),
(90, 'Training Category', 'training', 'category', 'list_items', 101, 0),
(91, 'Training Category', 'training', 'category', 'export', 105, 0),
(92, 'Training Category', 'training', 'category', 'delete', 104, 0),
(93, 'User Authorization', 'user', 'authorisation', 'view', 101, 0),
(94, 'User Authorization', 'user', 'authorisation', 'ajax_list_items', 101, 0),
(95, 'User Authorization', 'user', 'authorisation', 'list_items', 101, 0),
(96, 'User Authorization', 'user', 'authorisation', 'edit', 102, 0),
(97, 'Company Report', 'report', 'company', 'list_items', 101, 0),
(98, 'Company Report', 'report', 'company', 'ajax_list_items', 101, 0),
(99, 'Company Report', 'report', 'company', 'view', 101, 0),
(100, 'Company Report', 'report', 'company', 'export', 105, 0),
(101, 'SCR', 'scr', 'scr', 'list_items', 101, 0),
(102, 'SCR', 'scr', 'scr', 'view', 101, 0),
(103, 'SCR', 'scr', 'scr', 'edit', 102, 0),
(104, 'SCR', 'scr', 'scr', 'delete', 104, 0),
(105, 'SCR', 'scr', 'scr', 'add', 103, 0),
(106, 'SCR', 'scr', 'scr', 'ajax_list_items', 101, 0);

        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`countries` (
  `country_id` smallint(9) NOT NULL DEFAULT '0',
  `country_name` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short_country` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `continent_id` smallint(11) DEFAULT NULL,
  `dial_code` smallint(8) DEFAULT NULL,
  PRIMARY KEY (`country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`countries` (`country_id`, `country_name`, `short_country`, `continent_id`, `dial_code`) VALUES
(1, 'United States', 'US', 1, 1),
(2, 'Canada', 'Canada', 1, 1),
(3, 'Bahamas', 'Bahamas', 1, 242),
(4, 'Barbados', 'Barbados', 1, 246),
(5, 'Belize', 'Belize', 1, 501),
(6, 'Bermuda', 'Bermuda', 1, 441),
(7, 'British Virgin Islands', 'BVI', 1, 284),
(8, 'Cayman Islands', 'CaymanIsl', 1, 345),
(9, 'Costa Rica', 'CostaRica', 1, 506),
(10, 'Cuba', 'Cuba', 1, 53),
(11, 'Dominica', 'Dominica', 1, 767),
(12, 'Dominican Republic', 'DominicanRep', 1, 809),
(13, 'El Salvador', 'ElSalvador', 1, 503),
(14, 'Greenland', 'Greenland', 1, 299),
(15, 'Grenada', 'Grenada', 1, 473),
(16, 'Guadeloupe', 'Guadeloupe', 1, 590),
(17, 'Guatemala', 'Guatemala', 1, 502),
(18, 'Haiti', 'Haiti', 1, 509),
(19, 'Honduras', 'Honduras', 1, 503),
(20, 'Jamaica', 'Jamaica', 1, 876),
(21, 'Martinique', 'Martinique', 1, 596),
(22, 'Mexico', 'Mexico', 1, 52),
(23, 'Montserrat', 'Montserrat', 1, 664),
(24, 'Nicaragua', 'Nicaragua', 1, 505),
(25, 'Panama', 'Panama', 1, 507),
(26, 'Puerto Rico', 'PuertoRico', 1, 787),
(27, 'Trinidad and Tobago', 'Trinidad-Tobago', 1, 868),
(28, 'United States Virgin Islands', 'USVI', 1, 340),
(29, 'Argentina', 'Argentina', 2, 54),
(30, 'Bolivia', 'Bolivia', 2, 591),
(31, 'Brazil', 'Brazil', 2, 55),
(32, 'Chile', 'Chile', 2, 56),
(33, 'Colombia', 'Colombia', 2, 57),
(34, 'Ecuador', 'Ecuador', 2, 593),
(35, 'Falkland Islands', 'FalklandIsl', 2, 500),
(36, 'French Guiana', 'FrenchGuiana', 2, 594),
(37, 'Guyana', 'Guyana', 2, 592),
(38, 'Paraguay', 'Paraguay', 2, 595),
(39, 'Peru', 'Peru', 2, 51),
(40, 'Suriname', 'Suriname', 2, 597),
(41, 'Uruguay', 'Uruguay', 2, 598),
(42, 'Venezuela', 'Venezuela', 2, 58),
(43, 'Albania', 'Albania', 3, 355),
(44, 'Andorra', 'Andorra', 3, 376),
(45, 'Armenia', 'Armenia', 3, 374),
(46, 'Austria', 'Austria', 3, 43),
(47, 'Azerbaijan', 'Azerbaijan', 3, 994),
(48, 'Belarus', 'Belarus', 3, 375),
(49, 'Belgium', 'Belgium', 3, 32),
(50, 'Bosnia and Herzegovina', 'Bosnia-Herzegovina', 3, 387),
(51, 'Bulgaria', 'Bulgaria', 3, 359),
(52, 'Croatia', 'Croatia', 3, 385),
(53, 'Cyprus', 'Cyprus', 3, 357),
(54, 'Czech Republic', 'CzechRep', 3, 420),
(55, 'Denmark', 'Denmark', 3, 45),
(56, 'Estonia', 'Estonia', 3, 372),
(57, 'Finland', 'Finland', 3, 358),
(58, 'France', 'France', 3, 33),
(59, 'Georgia', 'Georgia', 3, 995),
(60, 'Germany', 'Germany', 3, 49),
(61, 'Gibraltar', 'Gibraltar', 3, 350),
(62, 'Greece', 'Greece', 3, 30),
(63, 'Guernsey', 'Guernsey', 3, 44),
(64, 'Hungary', 'Hungary', 3, 36),
(65, 'Iceland', 'Iceland', 3, 354),
(66, 'Ireland', 'Ireland', 3, 353),
(67, 'Isle of Man', 'IsleofMan', 3, 44),
(68, 'Italy', 'Italy', 3, 39),
(69, 'Jersey', 'Jersey', 3, 44),
(70, 'Kosovo', 'Kosovo', 3, 381),
(71, 'Latvia', 'Latvia', 3, 371),
(72, 'Liechtenstein', 'Liechtenstein', 3, 423),
(73, 'Lithuania', 'Lithuania', 3, 370),
(74, 'Luxembourg', 'Luxembourg', 3, 352),
(75, 'Macedonia', 'Macedonia', 3, 389),
(76, 'Malta', 'Malta', 3, 356),
(77, 'Moldova', 'Moldova', 3, 373),
(78, 'Monaco', 'Monaco', 3, 377),
(79, 'Montenegro', 'Montenegro', 3, 381),
(80, 'Netherlands', 'Netherlands', 3, 31),
(81, 'Norway', 'Norway', 3, 47),
(82, 'Poland', 'Poland', 3, 48),
(83, 'Portugal', 'Portugal', 3, 351),
(84, 'Romania', 'Romania', 3, 40),
(85, 'Russia', 'Russia', 3, 7),
(86, 'San Marino', 'SanMarino', 3, 378),
(87, 'Serbia', 'Serbia', 3, 381),
(88, 'Slovakia', 'Slovakia', 3, 421),
(89, 'Slovenia', 'Slovenia', 3, 386),
(90, 'Spain', 'Spain', 3, 34),
(91, 'Sweden', 'Sweden', 3, 46),
(92, 'Switzerland', 'Switzerland', 3, 41),
(93, 'Turkey', 'Turkey', 3, 90),
(94, 'Ukraine', 'Ukraine', 3, 380),
(95, 'United Kingdom', 'UK', 3, 44),
(96, 'Vatican City', 'Vatican', 3, 39),
(97, 'Afghanistan', 'Afghanistan', 4, 93),
(98, 'Bahrain', 'Bahrain', 4, 973),
(99, 'Bangladesh', 'Bangladesh', 4, 880),
(100, 'Bhutan', 'Bhutan', 4, 975),
(101, 'Brunei', 'Brunei', 4, 673),
(102, 'Cambodia', 'Cambodia', 4, 855),
(103, 'China', 'China', 4, 86),
(104, 'East Timor', 'EastTimor', 4, 670),
(105, 'Hong Kong', 'HongKong', 4, 852),
(106, 'India', 'India', 4, 91),
(107, 'Indonesia', 'Indonesia', 4, 62),
(108, 'Iran', 'Iran', 4, 98),
(109, 'Iraq', 'Iraq', 4, 964),
(110, 'Israel', 'Israel', 4, 972),
(111, 'Japan', 'Japan', 4, 81),
(112, 'Jordan', 'Jordan', 4, 962),
(113, 'Kazakhstan', 'Kazakhstan', 4, 7),
(114, 'Kuwait', 'Kuwait', 4, 965),
(115, 'Kyrgyzstan', 'Kyrgyzstan', 4, 996),
(116, 'Laos', 'Laos', 4, 856),
(117, 'Lebanon', 'Lebanon', 4, 961),
(118, 'Macau', 'Macau', 4, 853),
(119, 'Malaysia', 'Malaysia', 4, 60),
(120, 'Maldives', 'Maldives', 4, 960),
(121, 'Mongolia', 'Mongolia', 4, 976),
(122, 'Myanmar (Burma)', 'Myanmar(Burma)', 4, 95),
(123, 'Nepal', 'Nepal', 4, 977),
(124, 'North Korea', 'NorthKorea', 4, 850),
(125, 'Oman', 'Oman', 4, 968),
(126, 'Pakistan', 'Pakistan', 4, 92),
(127, 'Philippines', 'Philippines', 4, 63),
(128, 'Qatar', 'Qatar', 4, 974),
(129, 'Saudi Arabia', 'SaudiArabia', 4, 966),
(130, 'Singapore', 'Singapore', 4, 65),
(131, 'South Korea', 'SouthKorea', 4, 82),
(132, 'Sri Lanka', 'SriLanka', 4, 94),
(133, 'Syria', 'Syria', 4, 963),
(134, 'Taiwan', 'Taiwan', 4, 886),
(135, 'Tajikistan', 'Tajikistan', 4, 992),
(136, 'Thailand', 'Thailand', 4, 66),
(137, 'Turkmenistan', 'Turkmenistan', 4, 993),
(138, 'United Arab Emirates', 'UAE', 4, 971),
(139, 'Uzbekistan', 'Uzbekistan', 4, 998),
(140, 'Vietnam', 'Vietnam', 4, 84),
(141, 'Yemen', 'Yemen', 4, 967),
(142, 'Algeria', 'Algeria', 5, 213),
(143, 'Angola', 'Angola', 5, 244),
(144, 'Benin', 'Benin', 5, 229),
(145, 'Botswana', 'Botswana', 5, 267),
(146, 'Burkina Faso', 'BurkinaFaso', 5, 226),
(147, 'Burundi', 'Burundi', 5, 257),
(148, 'Cameroon', 'Cameroon', 5, 237),
(149, 'Cape Verde', 'CapeVerde', 5, 238),
(150, 'Central African Republic', 'CentralAfricanRep', 5, 236),
(151, 'Chad', 'Chad', 5, 235),
(152, 'Congo-Brazzaville', 'Congo-Brazzaville', 5, 242),
(153, 'Congo-Kinshasa', 'Congo-Kinshasa', 5, 242),
(154, 'Djibouti', 'Djibouti', 5, 253),
(155, 'Egypt', 'Egypt', 5, 20),
(156, 'Equatorial Guinea', 'EquatorialGuinea', 5, 240),
(157, 'Eritrea', 'Eritrea', 5, 291),
(158, 'Ethiopia', 'Ethiopia', 5, 251),
(159, 'Gabon', 'Gabon', 5, 241),
(160, 'Gambia', 'Gambia', 5, 220),
(161, 'Ghana', 'Ghana', 5, 233),
(162, 'Guinea', 'Guinea', 5, 224),
(163, 'Guinea-Bissau', 'Guinea-Bissau', 5, 245),
(164, 'Ivory Coast', 'IvoryCoast', 5, 225),
(165, 'Kenya', 'Kenya', 5, 254),
(166, 'Lesotho', 'Lesotho', 5, 266),
(167, 'Liberia', 'Liberia', 5, 231),
(168, 'Libya', 'Libya', 5, 218),
(169, 'Madagascar', 'Madagascar', 5, 261),
(170, 'Malawi', 'Malawi', 5, 265),
(171, 'Mali', 'Mali', 5, 223),
(172, 'Mauritania', 'Mauritania', 5, 222),
(173, 'Mauritius', 'Mauritius', 5, 230),
(174, 'Morocco', 'Morocco', 5, 212),
(175, 'Mozambique', 'Mozambique', 5, 258),
(176, 'Namibia', 'Namibia', 5, 264),
(177, 'Niger', 'Niger', 5, 227),
(178, 'Nigeria', 'Nigeria', 5, 234),
(179, 'Reunion', 'Reunion', 5, 262),
(180, 'Rwanda', 'Rwanda', 5, 250),
(181, 'Sao Tome and Principe', 'SaoTome-Principe', 5, 239),
(182, 'Senegal', 'Senegal', 5, 221),
(183, 'Seychelles', 'Seychelles', 5, 248),
(184, 'Sierra Leone', 'SierraLeone', 5, 232),
(185, 'Somalia', 'Somalia', 5, 252),
(186, 'South Africa', 'SouthAfrica', 5, 27),
(187, 'Sudan', 'Sudan', 5, 249),
(188, 'Swaziland', 'Swaziland', 5, 268),
(189, 'Tanzania', 'Tanzania', 5, 255),
(190, 'Togo', 'Togo', 5, 228),
(191, 'Tunisia', 'Tunisia', 5, 216),
(192, 'Uganda', 'Uganda', 5, 256),
(193, 'Western Sahara', 'WesternSahara', 5, 212),
(194, 'Zambia', 'Zambia', 5, 260),
(195, 'Zimbabwe', 'Zimbabwe', 5, 263),
(196, 'Australia', 'Australia', 6, 61),
(197, 'New Zealand', 'NewZealand', 6, 64),
(198, 'Fiji', 'Fiji', 6, 679),
(199, 'French Polynesia', 'FrenchPolynesia', 6, 689),
(200, 'Guam', 'Guam', 6, 671),
(201, 'Kiribati', 'Kiribati', 6, 686),
(202, 'Marshall Islands', 'MarshallIsl', 6, 692),
(203, 'Micronesia', 'Micronesia', 6, 691),
(204, 'Nauru', 'Nauru', 6, 674),
(205, 'New Caledonia', 'NewCaledonia', 6, 687),
(206, 'Papua New Guinea', 'PapuaNewGuinea', 6, 675),
(207, 'Samoa', 'Samoa', 6, 684),
(208, 'Solomon Islands', 'SolomonIsl', 6, 677),
(209, 'Tonga', 'Tonga', 6, 676),
(210, 'Tuvalu', 'Tuvalu', 6, 688),
(211, 'Vanuatu', 'Vanuatu', 6, 678),
(212, 'Wallis and Futuna', 'Wallis-Futuna', 6, 681);
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `education_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name. `education` (`id`, `education_name`, `status`) VALUES
(1, 'No Preferences', '1'),
(2, 'Military Service', '1'),
(3, 'Vocational School', '1'),
(4, 'High School', '1'),
(5, 'Associate', '1'),
(6, 'Pre-Bachelors', '1'),
(7, 'Bachelors', '1'),
(8, 'Post-Bachelors,Pre-Masters', '1'),
(9, 'MBA', '1'),
(10, 'Masters', '1'),
(11, 'Post-Masters,Pre-Doctrate', '1'),
(12, 'Doctrate', '1');

        ");

        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`email_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `recievers_id` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`flexigrid` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model_name` varchar(255) NOT NULL,
  `column` varchar(256) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`inactive_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `last_ip` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("

        CREATE TABLE IF NOT EXISTS $db_name.`job_discussion` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `job_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `site_id` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `job_title` varchar(300) NOT NULL,
          `comment` text NOT NULL,
          `seen_by` text,
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("

CREATE TABLE IF NOT EXISTS $db_name.`job_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reactive` int(11) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `activity_time` datetime NOT NULL,
  `company_id` int(11) NOT NULL,
  `duration` varchar(64) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `title` varchar(64) NOT NULL,
  `start_date` datetime DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `max_rate` int(11) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `salary` int(11) NOT NULL,
  `openings` int(11) NOT NULL,
  `company_job_id` int(11) NOT NULL,
  `is_hot` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `erookie_public` tinyint(4) NOT NULL,
  `description` text NOT NULL,
  `key` varchar(255) NOT NULL,
  `third_party` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `status_view` int(11) NOT NULL DEFAULT '0',
  `notification` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`job_ordertemp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `company_id` int(11) NOT NULL,
  `duration` varchar(64) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `type` varchar(64) NOT NULL,
  `title` varchar(64) NOT NULL,
  `start_date` datetime NOT NULL,
  `department_id` int(11) NOT NULL,
  `max_rate` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL,
  `state` int(11) NOT NULL,
  `city` varchar(25) NOT NULL,
  `salary` int(11) NOT NULL,
  `openings` int(11) NOT NULL,
  `company_job_id` int(11) NOT NULL,
  `is_hot` int(1) NOT NULL DEFAULT '0',
  `public` int(1) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `key` varchar(255) NOT NULL,
  `third_party` varchar(255) NOT NULL,
  `notes` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `status_view` int(11) NOT NULL DEFAULT '0',
  `activity_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`job_order_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_added` enum('0','1') NOT NULL DEFAULT '0',
  `reactive_number` int(11) NOT NULL,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `job_order_id` int(11) NOT NULL DEFAULT '0',
  `candidate_id` int(11) NOT NULL DEFAULT '0',
  `status_id` int(11) NOT NULL DEFAULT '0',
  `is_submitted` varchar(100) NOT NULL,
  `activity_type` varchar(30) NOT NULL,
  `source` int(44) NOT NULL,
  `emp_email` varchar(255) NOT NULL,
  `buying_rates` varchar(255) NOT NULL,
  `notes` varchar(250) NOT NULL,
  `interview_Date` datetime NOT NULL,
  `time_zone` varchar(255) NOT NULL,
  `interview_type` int(10) NOT NULL,
  `interview_comment` varchar(250) NOT NULL,
  `Comment` longtext NOT NULL,
  `offered_date` datetime NOT NULL,
  `rate_margin` int(10) NOT NULL,
  `client_rate` int(10) NOT NULL DEFAULT '0',
  `is_public` int(1) NOT NULL DEFAULT '0',
  `Hours` int(11) NOT NULL,
  `Mint` int(11) NOT NULL,
  `attachment` varchar(200) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_id` (`job_order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());

        mysql_query("
          
CREATE TABLE IF NOT EXISTS $db_name.`job_order_activity_status_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `sort_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`job_order_activity_status_type` (`id`, `name`, `sort_by`) VALUES
(1, 'No Contact', 7),
(2, 'Sales Reject', 1),
(3, 'Interview Reject ', 6),
(5, 'Submitted', 2),
(6, 'Interview', 4),
(7, 'Offered', 8),
(9, 'Offered Declined', 9),
(10, 'Client Screen Reject', 3),
(11, 'Candidate Join', 10);
        ") or die(mysql_error());


        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`job_order_assign_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `assign_user_id` int(11) NOT NULL,
  `assigned` enum('0','1') NOT NULL DEFAULT '0',
  `job_order_id` int(11) NOT NULL,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
  `status_comment` varchar(250) NOT NULL,
  `showcase` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `job_order_id` (`job_order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
          CREATE TABLE IF NOT EXISTS $db_name.`job_order_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` varchar(200) NOT NULL,
  `job_order_id` varchar(200) NOT NULL,
  `assign_group` int(11) NOT NULL,
  `assign_user` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `job_order_id` (`job_order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`job_order_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());
        
        mysql_query("
         INSERT INTO $db_name.`job_order_type` (`id`, `name`) VALUES
        (1, 'Contact'),
        (2, 'Contact to hire'),
        (3, 'Full time');
        ") or die(mysql_error());
        
        


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`job_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_status` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_Query("
        INSERT INTO $db_name.`job_status` (`id`, `job_status`) VALUES
(1, 'Submitted feed back panding'),
(2, 'Interview feed back panding'),
(3, 'Inactive'),
(0, 'Active');

        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`job_status_view` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `job_status_view` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`job_status_view` (`id`, `job_status_view`) VALUES
(1, 'Postion on hold'),
(2, 'Client not respond'),
(3, 'Candidate offered'),
(4, 'Postion Dead'),
(5, 'Candidate Join');
        ") or die(mysql_error());


        mysql_query("
         
CREATE TABLE IF NOT EXISTS $db_name.`newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`outer_candidate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `last_ip` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`per_page` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `records` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`pipeline_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` varchar(50) NOT NULL,
  `added_by` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `job_order_id` varchar(50) NOT NULL,
  `candidate_id` varchar(50) NOT NULL,
  `status_id` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`regions` (
  `id` smallint(8) NOT NULL DEFAULT '0',
  `name` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shortRegion` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_id` smallint(9) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`regions` (`id`, `name`, `shortRegion`, `country_id`) VALUES
(1, 'Alabama', 'AL', 1),
(2, 'Alaska', 'AK', 1),
(3, 'Arizona', 'AZ', 1),
(4, 'Arkansas', 'AR', 1),
(5, 'California', 'CA', 1),
(6, 'Colorado', 'CO', 1),
(7, 'Connecticut', 'CT', 1),
(8, 'Delaware', 'DE', 1),
(9, 'District of Columbia', 'DC', 1),
(10, 'Florida', 'FL', 1),
(11, 'Georgia', 'GA', 1),
(12, 'Hawaii', 'HI', 1),
(13, 'Idaho', 'ID', 1),
(14, 'Illinois', 'IL', 1),
(15, 'Indiana', 'IN', 1),
(16, 'Iowa', 'IA', 1),
(17, 'Kansas', 'KS', 1),
(18, 'Kentucky', 'KY', 1),
(19, 'Louisiana', 'LA', 1),
(20, 'Maine', 'ME', 1),
(21, 'Maryland', 'MD', 1),
(22, 'Massachusetts', 'MA', 1),
(23, 'Michigan', 'MI', 1),
(24, 'Minnesota', 'MN', 1),
(25, 'Mississippi', 'MS', 1),
(26, 'Missouri', 'MO', 1),
(27, 'Montana', 'MT', 1),
(28, 'Nebraska', 'NE', 1),
(29, 'Nevada', 'NV', 1),
(30, 'New Hampshire', 'NH', 1),
(31, 'New Jersey', 'NJ', 1),
(32, 'New Mexico', 'NM', 1),
(33, 'New York', 'NY', 1),
(34, 'North Carolina', 'NC', 1),
(35, 'North Dakota', 'ND', 1),
(36, 'Ohio', 'OH', 1),
(37, 'Oklahoma', 'OK', 1),
(38, 'Oregon', 'OR', 1),
(39, 'Pennsylvania', 'PA', 1),
(40, 'Rhode Island', 'RI', 1),
(41, 'South Carolina', 'SC', 1),
(42, 'South Dakota', 'SD', 1),
(43, 'Tennessee', 'TN', 1),
(44, 'Texas', 'TX', 1),
(45, 'Utah', 'UT', 1),
(46, 'Vermont', 'VT', 1),
(47, 'Virginia', 'VA', 1),
(48, 'Washington', 'WA', 1),
(49, 'West Virginia', 'WV', 1),
(50, 'Wisconsin', 'WI', 1),
(51, 'Wyoming', 'WY', 1),
(52, 'Alberta', 'AB', 2),
(53, 'British Columbia', 'BC', 2),
(54, 'Manitoba', 'MB', 2),
(55, 'New Brunswick', 'NB', 2),
(56, 'Newfoundland and Labrador', 'NL', 2),
(57, 'Northwest Territories', 'NT', 2),
(58, 'Nova Scotia', 'NS', 2),
(59, 'Nunavut', 'NU', 2),
(60, 'Ontario', 'ON', 2),
(61, 'Prince Edward Island', 'PE', 2),
(62, 'Quebec', 'QC', 2),
(63, 'Saskatchewan', 'SK', 2),
(64, 'Yukon', 'YT', 2),
(65, 'England', 'England', 95),
(66, 'Northern Ireland', 'NorthernIreland', 95),
(67, 'Scotland', 'Scottland', 95),
(68, 'Wales', 'Wales', 95);
        ") or die(mysql_error());

        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `uri` varchar(50) NOT NULL,
  `action` int(5) NOT NULL,
  `action_id` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`resume` (
  `user_id` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `resume` longblob NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`scr_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `job_order_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `data` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
    ") or die(mysql_error());

        mysql_query("
    CREATE TABLE IF NOT EXISTS $db_name.`site` (
  `id` int(3) NOT NULL,
  `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User Id',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `name` varchar(60) NOT NULL,
  `email` varchar(50) NOT NULL,
  `description` varchar(200) NOT NULL,
  `website` varchar(60) NOT NULL,
  `language` varchar(200) NOT NULL,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
  `status_comment` varchar(250) NOT NULL,
  `is_super` int(1) NOT NULL DEFAULT '0',
  `is_customer` enum('0','1') NOT NULL,
  `customer_id` int(11) NOT NULL,
  `account_type` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
    ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`site_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `table_name` varchar(64) NOT NULL,
  `row_id` int(11) NOT NULL,
  `action` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
         CREATE TABLE IF NOT EXISTS $db_name.`source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`source` (`id`, `name`) VALUES
(1, 'CORP2CORP'),
(2, 'DICE'),
(3, 'MONSTER'),
(4, 'THIRDPARTY'),
(5, '1099'),
(6, 'W2');
        ") or die(mysql_error());


        mysql_query("
         
CREATE TABLE IF NOT EXISTS $db_name.`temp_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) DEFAULT '0',
  `added_by` int(11) DEFAULT '0',
  `last_ip` varchar(15) DEFAULT NULL,
  `created_time` datetime DEFAULT NULL,
  `modified_time` datetime DEFAULT NULL,
  `candidate_id` int(11) NOT NULL DEFAULT '0',
  `text` longtext NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `file_size` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`time_zone` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());
        mysql_query("
        INSERT INTO $db_name.`time_zone` (`id`, `name`) VALUES
(1, 'EST'),
(2, 'CST'),
(3, 'MST'),
(4, 'PST'),
(5, 'IST');
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`tmp_email_to_send` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(20) NOT NULL,
  `recievers_id` text NOT NULL,
  `subject` text NOT NULL,
  `message` text NOT NULL,
  `created_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`training` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tr_category_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `name` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        
CREATE TABLE IF NOT EXISTS $db_name.`training_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `added_by` int(11) NOT NULL,
  `site_id` int(11) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) COLLATE utf8_bin NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `group_id` int(11) NOT NULL DEFAULT '0',
  `extra_group_id` varchar(100) COLLATE utf8_bin NOT NULL,
  `ip_based` text COLLATE utf8_bin NOT NULL,
  `parent_user_id` int(11) NOT NULL DEFAULT '0',
  `first_name` varchar(16) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(16) COLLATE utf8_bin NOT NULL,
  `profile_image` varchar(250) COLLATE utf8_bin NOT NULL,
  `password` varchar(200) COLLATE utf8_bin NOT NULL,
   `email_password` varchar(200) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('active','inactive','banned') COLLATE utf8_bin NOT NULL DEFAULT 'inactive',
  `status_comment` varchar(250) COLLATE utf8_bin NOT NULL,
  `designation` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone_number` varchar(25) COLLATE utf8_bin NOT NULL,
  `cell_number` varchar(25) COLLATE utf8_bin NOT NULL,
  `fax_number` varchar(25) COLLATE utf8_bin NOT NULL,
  `company_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `certification` varchar(255) COLLATE utf8_bin NOT NULL,
  `company_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `disclaimer` text COLLATE utf8_bin NOT NULL,
  `static_ip` varchar(20) COLLATE utf8_bin NOT NULL,
  `login_type` enum('0','1','2','3') COLLATE utf8_bin NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        
CREATE TABLE IF NOT EXISTS $db_name.`user_groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `name` varchar(25) NOT NULL,
  `parent_group_id` int(2) NOT NULL DEFAULT '0',
  `description` varchar(250) NOT NULL,
  `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
  `is_super` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_group_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `uri` text NOT NULL,
  `data` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_interview_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `interview` int(11) NOT NULL,
  `int_duration` int(11) NOT NULL,
  `int_achievement` varchar(25) NOT NULL,
  `int_achieve_duration` int(11) NOT NULL,
  `int_mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_report_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(4) NOT NULL,
  `user_id` int(11) NOT NULL,
  `search_type` varchar(20) NOT NULL,
  `year` int(11) NOT NULL,
  `month` varchar(4) NOT NULL,
  `day` int(4) NOT NULL,
  `chart_list` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_send_mail_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `send_mail_max_limit` int(11) NOT NULL,
  `send_mail_target` int(11) NOT NULL,
  `send_mail_duration` int(11) NOT NULL,
  `send_mail_achievement` varchar(25) NOT NULL,
  `send_mail_achieve_duration` int(11) NOT NULL,
  `send_mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_sign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `sign_field` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_submission_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL,
  `added_by` int(11) NOT NULL,
  `last_ip` varchar(15) NOT NULL,
  `user_id` int(11) NOT NULL,
  `submission` int(11) NOT NULL,
  `sub_duration` int(11) NOT NULL,
  `sub_achievement` varchar(25) NOT NULL,
  `sub_achieve_duration` int(11) NOT NULL,
  `sub_mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
  `created_time` datetime NOT NULL,
  `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`vendor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `company_name` varchar(250) DEFAULT NULL,
  `company_website` varchar(250) NOT NULL,
  `email_id` varchar(100) DEFAULT NULL,
  `primary_phone` varchar(15) DEFAULT NULL,
  `secondary_phone` varchar(15) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `fax_num` varchar(20) DEFAULT NULL,
  `address` longtext,
  `city` varchar(25) NOT NULL,
  `state` varchar(25) NOT NULL,
  `country_id` int(4) NOT NULL,
  `postal_code` varchar(10) NOT NULL,
  `MSA` int(1) NOT NULL DEFAULT '0',
  `msa_upload` varchar(400) NOT NULL,
  `NCA` int(250) NOT NULL DEFAULT '0',
  `key_technologies` longtext NOT NULL,
  `notes` longtext NOT NULL,
  `status` varchar(250) NOT NULL,
  `federal` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        
CREATE TABLE IF NOT EXISTS $db_name.`vendor_companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `site_id` int(11) NOT NULL DEFAULT '0',
  `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
  `last_ip` varchar(15) NOT NULL,
  `created_time` datetime NOT NULL,
  `modified_time` datetime NOT NULL,
  `name` varchar(250) NOT NULL,
  `website` varchar(250) NOT NULL,
  `status` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`vendor_doc` (
  `vendor_id` int(11) NOT NULL,
  `doc_file` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`vendor_doc_nsa` (
  `vendor_id` int(11) NOT NULL,
  `doc_file` varchar(250) NOT NULL,
  `file_name` varchar(250) NOT NULL,
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`file_id`),
  UNIQUE KEY `file_id` (`file_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;

        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`visa_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `visa_type` varchar(255) NOT NULL,
  UNIQUE KEY `visa_type` (`visa_type`),
  UNIQUE KEY `visa_type_2` (`visa_type`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`visa_type` (`id`, `visa_type`) VALUES
(1, 'H1 B'),
(2, 'OPT'),
(3, 'L1'),
(4, 'L2EAD'),
(5, 'GCEAD'),
(6, 'GC'),
(7, 'USC'),
(8, 'Canada Citizen '),
(9, 'E1');

        ") or die(mysql_error());


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`work_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0 ;
        ") or die(mysql_error());

        mysql_query("
        INSERT INTO $db_name.`work_status` (`id`, `name`) VALUES
(1, 'Corp to Corp'),
(2, 'W2'),
(3, 'Full time'),
(4, '1099');
        ") or die(mysql_error());
    }

}

/**
 * function to insert data to created database for other database
 * @created on : 27 january 2015
 * @by - Nitish Janterparia
 *  **/


if (!function_exists('insert_other_db')) {
    function insert_other_db($db_name, $table, $data) {
        $insert_in = array();
        $values = array();
        foreach ($data as $k => $v) {
            $insert_in[] = "`" . $k . "`";
            $values[] = "'" . mysql_real_escape_string($v) . "'";
        }
        $insert_in = implode(",", $insert_in);
        $values = implode(",", $values);
        //echo "INSERT INTO $db_name.$table ($insert_in) values($values)";die;
        mysql_query("INSERT INTO $db_name.$table ($insert_in) values($values)") or die(mysql_error());
        return mysql_insert_id();
    }

}

/**
 * function to insert data to created database for other database
 * @created on : 27 january 2015
 * @by - Nitish Janterparia
 *  **/


if (!function_exists('update_other_db')) {
    function update_other_db($db_name, $table, $data, $where) {
        $values = array();
        foreach ($data as $k => $v) {
            $values[] = "`$k`='" . mysql_real_escape_string($v) . "'";
        }
        $values = implode(",", $values);

        mysql_query("UPDATE $db_name.$table SET $values WHERE $where") or die(mysql_error());
        return true;
    }

}


/**
 * function to select data to created database for other database
 * @created on : 27 january 2015
 * @by - Nitish Janterparia
 *  **/


if (!function_exists('select_other_db')) {
    function select_other_db($data) {
        if (!empty($data['select'])) {
            $select = implode(",", $data['select']);
        } else {
            $select = "*";
        }

        if (!empty($data['condition'])) {
            $condition = array();
            foreach ($data['condition'] as $k => $v) {
                $condition[] = "`" . $k . "`" . "=" . "'" . mysql_real_escape_string($v) . "'";
            }
            $where = " where " . implode(" AND ", $condition);
        } else {
            $where = "";
        }

        if (!empty($data['custom_condition'])) {
            $cus_condition = $data['custom_condition'];
            $custom_condition = " where $cus_condition ";
        } else {
            $custom_condition = "";
        }

        if (!empty($data['join'])) {
            $data_join = $data['join'];
            $join = " $data_join ";
        } else {
            $join = "";
        }

        if (!empty($data['limit'])) {
            $limit = " limit " . $data['limit'];
        } else {
            $limit = "";
        }

        if (!empty($data['order_by'])) {
            $order_by = " order_by " . $data['order_by'];
        } else {
            $order_by = "";
        }

        $db_name = $data['database'];
        $table = $data['table'];
        // echo "SELECT $select FROM $db_name.$table $join $where $custom_condition $order_by $limit";die;
        $query = mysql_query("SELECT $select FROM $db_name.$table $join $where $order_by $limit") or die(mysql_error
            ());
        $result = mysql_fetch_assoc($query);
        if (!empty($result))
            return $result;
    }

}


// ------------------------------------------------------------------------

/**
 * filter vendor data according to job permission
 * @access  public
 */
if (!function_exists('filter_vendor_data')) {
    function filter_vendor_data($table = null) {
        $CI = &get_instance();
        $userinfo = currentuserinfo();

        $site_colum = "site_id";
        $user_colum = "added_by";

        if ($table != null) {
            $site_colum = "$table.site_id";
            $user_colum = "$table.added_by";
        }


        $permission = $CI->session->userdata("permission");


        if ((!$userinfo->is_super_site) && isset($permission['own_view']) && (@$permission['all_view'] !=
            101)) {

            $user_list = json_decode($CI->session->userdata("child_list"));
            $CI->db->where_in($user_colum, $user_list, false);
        }

        //Filter by site id

        if (!$userinfo->is_super_site)
            $CI->db->where($site_colum, $userinfo->site_id, false);

    }

}
// ------------------------------------------------------------------------


/**
 * 
 * function to create seperate database of each customer
 * @created on : 27th janauary 2015
 * @by - Nitish Janterparia
 * **/


if (!function_exists('create_indiancustomer_database')) {

    function create_indiancustomer_database($id) {

        $db_name = "india_erookie_$id";
        mysql_query("CREATE DATABASE $db_name");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`attachments` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) DEFAULT '0',
          `added_by` int(11) DEFAULT '0',
          `last_ip` varchar(15) DEFAULT NULL,
          `created_time` datetime DEFAULT NULL,
          `modified_time` datetime DEFAULT NULL,
          `candidate_id` int(11) NOT NULL DEFAULT '0',
          `text` longtext NOT NULL,
          `file_name` varchar(100) NOT NULL,
          `file_size` float NOT NULL,
          PRIMARY KEY (`id`),
          FULLTEXT KEY `text` (`text`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`candidate` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `is_refine` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL,
          `last_ip` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `resume_title` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
          `total_year` float NOT NULL,
          `exp_year` int(11) NOT NULL,
          `exp_month` int(11) NOT NULL,
          `recent_client` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
          `first_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
          `middle_name` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
          `last_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
          `email` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `website` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
          `phone_home` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
          `phone_cell` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
          `phone_work` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
          `education` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
          `designation` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
          `notice_period` int(11) NOT NULL,
          `address` text COLLATE utf8_unicode_ci,
          `country_id` int(5) NOT NULL,
          `city` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
          `state` int(11) DEFAULT NULL,
          `zip` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
          `contract_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
          `key_skills` text COLLATE utf8_unicode_ci,
          `can_relocate` int(1) NOT NULL DEFAULT '0',
          `date_available` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
          `source` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
          `notes` text COLLATE utf8_unicode_ci NOT NULL,
          `noitce_period_type` int(4) NOT NULL,
          `current_location` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
          `present_salary_lac` int(10) NOT NULL,
          `present_salary_thu` int(5) NOT NULL,
          `expected_salary_lac` int(5) NOT NULL,
          `expected_salary_thu` int(5) NOT NULL,
          `dob` date NOT NULL,
          `can_relocate_area` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
          `ug_education` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          `ug_college` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          `ug_from` date NOT NULL,
          `ug_to` date NOT NULL,
          `education_type` int(4) NOT NULL,
          `pg_education` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          `pg_college` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          `pg_from` date NOT NULL,
          `pg_to` date NOT NULL,
          `other` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
          PRIMARY KEY (`id`),
          KEY `IDX_first_name` (`first_name`),
          KEY `IDX_phone_home` (`phone_home`),
          KEY `IDX_phone_cell` (`phone_cell`),
          KEY `IDX_phone_work` (`phone_work`),
          KEY `IDX_key_skills` (`key_skills`(255)),
          KEY `IDX_site_first_last_modified` (`site_id`,`first_name`),
          KEY `IDX_site_id_email_1_2` (`site_id`),
          KEY `education` (`education`),
          KEY `added_by` (`added_by`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
        ");


        mysql_query("
            CREATE TABLE IF NOT EXISTS $db_name.`candidate_send_mail` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `added_by` int(11) NOT NULL,
              `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `last_ip` varchar(20) NOT NULL,
              `recievers_id` varchar(20000) NOT NULL,
              `subject` varchar(100) NOT NULL,
              `message` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`cart_email_to_send` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `added_by` int(11) NOT NULL,
              `last_ip` varchar(20) NOT NULL,
              `recievers_id` text NOT NULL,
              `created_time` datetime NOT NULL,
              `total_mail` varchar(11) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("        
                
        CREATE TABLE IF NOT EXISTS $db_name.`cities` (
          `cityID` mediumint(6) NOT NULL DEFAULT '0',
          `cityName` varchar(70) COLLATE utf8_unicode_ci DEFAULT NULL,
          `shortCity` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
          `regionID` smallint(8) DEFAULT NULL,
          `countryID` smallint(9) DEFAULT NULL,
          PRIMARY KEY (`cityID`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;        
        ");

        mysql_query("
        INSERT INTO $db_name.`cities` (`cityID`, `cityName`, `shortCity`, `regionID`, `countryID`) VALUES
            (1, ' Birmingham', 'Bir', 1, 1),
            (2, ' Hoover', 'Hoo', 1, 1),
            (4, 'Madison', 'Mad', 1, 1),
            (5, 'Montgomery', 'Mon', 1, 1),
            (6, 'Dothan', 'Dot', 1, 1),
            (7, 'Gadsden', 'Gad', 1, 1),
            (8, 'Decatur', 'Dec', 1, 1),
            (9, 'Florence', 'Flo', 1, 1),
            (10, 'Huntsville', 'Hun', 1, 1),
            (11, 'Auburn', 'Aub', 1, 1),
            (12, 'Bessemer', 'Bes', 1, 1),
            (13, 'Tuscaloosa', 'Tus', 1, 1),
            (14, 'Vestavia Hills', 'Ves', 1, 1),
            (15, 'Phenix City', 'Phe', 1, 1),
            (16, 'Mobile', 'Mob', 1, 1),
            (17, ' Anchorage', 'Anch', 2, 1),
            (18, ' Wasilla', 'Wasi', 2, 1),
            (19, ' Bethel', 'Beth', 2, 1),
            (20, ' Juneau', 'June', 2, 1),
            (21, ' Kenai', 'Wasi', 2, 1),
            (22, ' Kodiak', 'Wasi', 2, 1),
            (23, ' Fairbanks', 'Wasi', 2, 1),
            (24, ' Ketchikan', 'Wasi', 2, 1),
            (25, ' Sterling', 'Wasi', 2, 1),
            (26, ' College', 'Wasi', 2, 1),
            (27, ' Palmer', 'Wasi', 2, 1),
            (28, ' Barrow', 'Barr', 2, 1),
            (29, ' Sitka', 'Wasi', 2, 1),
            (30, ' Homer', 'Wasi', 2, 1),
            (31, ' Soldotna', 'Wasi', 2, 1),
            (32, ' \r\nPhoenix', 'Phoe', 3, 1),
            (33, ' \r\nTucson', 'Tucs', 3, 1),
            (34, ' \r\nMesa', 'Mesa', 3, 1),
            (35, ' \r\nGlendale', 'Glen', 3, 1),
            (36, ' \r\nChandler', 'Chan', 3, 1),
            (37, ' \r\nScottsdale', 'Phoe', 3, 1),
            (38, ' \r\nGilbert', 'Phoe', 3, 1),
            (39, ' \r\nTempe', 'Phoe', 3, 1),
            (40, ' \r\nPeoria', 'Phoe', 3, 1),
            (41, ' \r\nYuma', 'Phoe', 3, 1),
            (42, ' \r\nCasas Adobes', 'Phoe', 3, 1),
            (43, ' \r\nCatalina Foothills', 'Phoe', 3, 1),
            (44, ' \r\nAvondale', 'Phoe', 3, 1),
            (45, ' \r\nSurprise', 'Phoe', 3, 1),
            (46, ' \r\nFlagstaff', 'Phoe', 3, 1),
            (47, ' \r\nLittle Rock', 'Litt', 4, 1),
            (48, ' \r\nSpringdale', 'Sprin', 4, 1),
            (49, ' \r\nTexarkana', 'Phoe', 4, 1),
            (50, ' \r\nFort Smith', 'Fort', 4, 1),
            (51, ' \r\nPine Bluff', 'Pine', 4, 1),
            (52, ' \r\nBentonville', 'Bent', 4, 1),
            (53, ' \r\nFayetteville', 'Faye', 4, 1),
            (54, ' \r\nConvay', 'Conv', 4, 1),
            (55, ' \r\nJacksonville', 'Jack', 4, 1),
            (56, ' \r\nNorth Little Rock', 'Nort', 4, 1),
            (57, ' \r\nRogers', 'Roge', 4, 1),
            (58, ' \r\nWest Memphis', 'West', 4, 1),
            (59, ' \r\nJonesboro', 'Jone', 4, 1),
            (60, ' \r\nHot Springs', 'Hot', 4, 1),
            (61, ' \r\nRusellville', 'Ruse', 4, 1),
            (62, ' \r\nLos Angeles', 'Los', 5, 1),
            (63, ' \r\nSacramento', 'Los', 5, 1),
            (64, ' \r\nRiverside', 'Los', 5, 1),
            (65, ' \r\nSan Diego', 'Los', 5, 1),
            (66, ' \r\nFresno', 'Los', 5, 1),
            (67, ' \r\nBakersfield', 'Los', 5, 1),
            (68, ' \r\nSan Jose', 'Los', 5, 1),
            (69, ' \r\nOakland', 'Los', 5, 1),
            (70, ' \r\nStockton', 'Los', 5, 1),
            (71, ' \r\nSan Francisco', 'Los', 5, 1),
            (72, ' \r\nSanta Ana', 'Los', 5, 1),
            (73, ' \r\nModesto', 'Los', 5, 1),
            (74, ' \r\nLong Beach', 'Los', 5, 1),
            (75, ' \r\nAnaheim', 'Los', 5, 1),
            (76, ' \r\nChula Vista', 'Los', 5, 1),
            (77, ' \r\nDenver', 'Denv', 6, 1),
            (78, ' \r\nThornton', 'Denv', 6, 1),
            (79, ' \r\nCentennial', 'Denv', 6, 1),
            (80, ' \r\nColorado Spring', 'Denv', 6, 1),
            (81, ' \r\nPueblo', 'Denv', 6, 1),
            (82, ' \r\nBoulder', 'Denv', 6, 1),
            (83, ' \r\nAurora', 'Denv', 6, 1),
            (84, ' \r\nWestminster', 'Denv', 6, 1),
            (85, ' \r\nGreeley', 'Denv', 6, 1),
            (86, ' \r\nLakewood', 'Denv', 6, 1),
            (87, ' \r\nArvada', 'Denv', 6, 1),
            (88, ' \r\nLongmont', 'Denv', 6, 1),
            (89, ' \r\nFort COllins', 'Denv', 6, 1),
            (90, ' \r\nHighlands Ranch', 'Denv', 6, 1),
            (91, ' \r\nLove Land', 'Denv', 6, 1),
            (92, ' \r\nBridgeport', 'Brid', 7, 1),
            (93, ' \r\nNorwalk', 'Brid', 7, 1),
            (94, ' \r\nBristol', 'Brid', 7, 1),
            (95, ' \r\nNew Haven', 'Brid', 7, 1),
            (96, ' \r\nDanbury', 'Brid', 7, 1),
            (97, ' \r\nHamden', 'Brid', 7, 1),
            (98, ' \r\nHartford', 'Brid', 7, 1),
            (99, ' \r\nNew Britain', 'Brid', 7, 1),
            (100, ' \r\nMeriden', 'Brid', 7, 1),
            (101, ' \r\nStemford', 'Brid', 7, 1),
            (102, ' \r\nWest Hartford', 'Brid', 7, 1),
            (103, ' \r\nFairfield', 'Brid', 7, 1),
            (104, ' \r\nWaterbury', 'Brid', 7, 1),
            (105, ' \r\nGreenwich', 'Brid', 7, 1),
            (106, ' \r\nWest Haven', 'Brid', 7, 1),
            (107, ' \r\nWilmington', 'Wilm', 8, 1),
            (108, ' \r\nClaymont', 'Wilm', 8, 1),
            (109, ' \r\nSmyrna', 'Wilm', 8, 1),
            (110, ' \r\nDover', 'Wilm', 8, 1),
            (111, ' \r\nWilmington Manor', 'Wilm', 8, 1),
            (112, ' \r\nEdgemoor', 'Wilm', 8, 1),
            (113, ' \r\nNewark', 'Wilm', 8, 1),
            (114, ' \r\nMilford', 'Wilm', 8, 1),
            (115, ' \r\nElsemere', 'Wilm', 8, 1),
            (116, ' \r\nPike Creek', 'Wilm', 8, 1),
            (117, ' \r\nSeaford', 'Wilm', 8, 1),
            (118, ' \r\nGeorge Town', 'Wilm', 8, 1),
            (119, ' \r\nBrook Side', 'Wilm', 8, 1),
            (120, ' \r\nMiddletown', 'Wilm', 8, 1),
            (121, ' \r\nNew Castle', 'Wilm', 8, 1),
            (122, 'Washington,DC', 'Wash', 9, 1),
            (123, 'Jacksonville', 'Jackf', 10, 1),
            (124, 'Orlando', 'Jackf', 10, 1),
            (125, 'Coral Springs', 'Jackf', 10, 1),
            (126, 'Miami', 'Jackf', 10, 1),
            (127, 'Fort Lauderdale', 'Jackf', 10, 1),
            (128, 'Cape Coral', 'Jackf', 10, 1),
            (129, 'Tampa', 'Jackf', 10, 1),
            (130, 'Pembroke Pines', 'Jackf', 10, 1),
            (131, 'Gainesville', 'Jackf', 10, 1),
            (132, 'Saint Petersburg', 'Jackf', 10, 1),
            (133, 'Tallahassee', 'Jackf', 10, 1),
            (134, 'Port Saint Lucie', 'Jackf', 10, 1),
            (135, 'Hialeah', 'Jackf', 10, 1),
            (136, 'Hollywood', 'Jackf', 10, 1),
            (137, 'Miramar', 'Jackf', 10, 1),
            (138, 'Atlanta', 'Atl', 11, 1),
            (139, 'Macon', 'Atl', 11, 1),
            (140, 'Smyrna', 'Atl', 11, 1),
            (141, 'Augusta', 'Atl', 11, 1),
            (142, 'Roswell', 'Atl', 11, 1),
            (143, 'Valdosta', 'Atl', 11, 1),
            (144, 'Columbus', 'Atl', 11, 1),
            (145, 'Albany', 'Atl', 11, 1),
            (146, 'North Atlanta', 'Atl', 11, 1),
            (147, 'Savannah', 'Atl', 11, 1),
            (148, 'Marietta', 'Atl', 11, 1),
            (149, 'Redan', 'Atl', 11, 1),
            (150, 'Sandy Springs', 'Atl', 11, 1),
            (151, 'Warner Robins', 'Atl', 11, 1),
            (152, 'Dunwoody', 'Atl', 11, 1),
            (153, 'Honolulu', 'Hono', 12, 1),
            (154, 'Pearl City', 'Hono', 12, 1),
            (155, 'Wahiawa', 'Hono', 12, 1),
            (156, 'Hilo', 'Hono', 12, 1),
            (157, 'Waimalu', 'Hono', 12, 1),
            (158, 'Makakilo City', 'Hono', 12, 1),
            (159, 'Kailua', 'Hono', 12, 1),
            (160, 'Mililani Town', 'Hono', 12, 1),
            (161, 'Ewa Beach', 'Hono', 12, 1),
            (162, 'Kaneohe', 'Hono', 12, 1),
            (163, 'Kahului', 'Hono', 12, 1),
            (164, 'Wailuku', 'Hono', 12, 1),
            (165, 'Wahipahu', 'Hono', 12, 1),
            (166, 'Kihei', 'Hono', 12, 1),
            (167, 'Nanakuli', 'Hono', 12, 1),
            (168, 'Boise', 'Hono', 13, 1),
            (169, 'Twin Falls', 'Hono', 13, 1),
            (170, 'Moscow', 'Hono', 13, 1),
            (171, 'Nampa', 'Hono', 13, 1),
            (172, 'Caldwell', 'Hono', 13, 1),
            (173, 'Idaho Falls', 'Hono', 13, 1),
            (174, 'Lewiston', 'Hono', 13, 1),
            (175, 'Hayden', 'Hono', 13, 1),
            (176, 'Pocatello', 'Hono', 13, 1),
            (177, 'Rexberg', 'Hono', 13, 1),
            (178, 'Kuna', 'Hono', 13, 1),
            (179, 'Meridian', 'Hono', 13, 1),
            (180, 'Eagle', 'Hono', 13, 1),
            (181, 'Post Falls', 'Hono', 13, 1),
            (182, 'Garden City', 'Hono', 13, 1),
            (183, 'Chicago', 'Chic', 14, 1),
            (184, 'Springfield', 'Chic', 14, 1),
            (185, 'Decatur', 'Chic', 14, 1),
            (186, 'Aurora', 'Chic', 14, 1),
            (187, 'Peoria', 'Chic', 14, 1),
            (188, 'Champaign', 'Chic', 14, 1),
            (189, 'Rockford', 'Chic', 14, 1),
            (190, 'Elgin', 'Chic', 14, 1),
            (191, 'Evanstone', 'Chic', 14, 1),
            (192, 'Naperville', 'Chic', 14, 1),
            (193, 'Waukegan', 'Chic', 14, 1),
            (194, 'Arlington Heights', 'Chic', 14, 1),
            (195, 'Joliet', 'Chic', 14, 1),
            (196, 'Cicero', 'Chic', 14, 1),
            (197, 'Schaumburg', 'Chic', 14, 1),
            (198, 'Indianapolis', 'Indi', 15, 1),
            (199, 'Gary', 'Indi', 15, 1),
            (200, 'Anderson', 'Indi', 15, 1),
            (201, 'Fort Wayne', 'Indi', 15, 1),
            (202, 'Carmel', 'Indi', 15, 1),
            (203, 'Terri Haute', 'Indi', 15, 1),
            (204, 'Bloomington', 'Indi', 15, 1),
            (205, 'Hammond', 'Indi', 15, 1),
            (206, 'Fishers', 'Indi', 15, 1),
            (207, 'Evansville', 'Indi', 15, 1),
            (208, 'Muncie', 'Indi', 15, 1),
            (209, 'Elkhart', 'Indi', 15, 1),
            (210, 'South Bend', 'Indi', 15, 1),
            (211, 'Lafayette', 'Indi', 15, 1),
            (212, 'Mishawaka', 'Indi', 15, 1),
            (213, 'Des Moines', 'Des', 16, 1),
            (214, 'Iowa City', 'Indi', 16, 1),
            (215, 'Cedar Falls', 'Indi', 16, 1),
            (216, 'Cedar Rapids', 'Indi', 16, 1),
            (217, 'Council Bluffs', 'Indi', 16, 1),
            (218, 'Ankeny', 'Indi', 16, 1),
            (219, 'Davenport', 'Indi', 16, 1),
            (220, 'Dubuque', 'Indi', 16, 1),
            (221, 'Urban Dale', 'Indi', 16, 1),
            (222, 'Sioux City', 'Indi', 16, 1),
            (223, 'Ames', 'Indi', 16, 1),
            (224, 'Battendorf', 'Indi', 16, 1),
            (225, 'Waterloo', 'Indi', 16, 1),
            (226, 'West Des Moines', 'Indi', 16, 1),
            (227, 'Marion', 'Indi', 16, 1),
            (228, 'Wichita', 'Wich', 17, 1),
            (229, 'Lawrence', 'Wich', 17, 1),
            (230, 'Hutchinson', 'Wich', 17, 1),
            (231, 'Overland Park ', 'Wich', 17, 1),
            (232, 'Shawnee', 'Wich', 17, 1),
            (233, 'Leavenworth', 'Wich', 17, 1),
            (234, 'Kansas', 'Wich', 17, 1),
            (235, 'Salina', 'Wich', 17, 1),
            (236, 'Leawood', 'Wich', 17, 1),
            (237, 'Topeka', 'Wich', 17, 1),
            (238, 'Manhattan', 'Wich', 17, 1),
            (239, 'Emporia', 'Wich', 17, 1),
            (240, 'Olathe', 'Wich', 17, 1),
            (241, 'Lenexa', 'Wich', 17, 1),
            (242, 'Garden City', 'Wich', 17, 1),
            (243, 'Lexington-Fayette', 'Wich', 18, 1),
            (244, 'Richmond', 'Wich', 18, 1),
            (245, 'Florence', 'Wich', 18, 1),
            (246, 'Louisville', 'Wich', 18, 1),
            (247, 'Hopkinsville', 'Wich', 18, 1),
            (248, 'Paducah', 'Wich', 18, 1),
            (249, 'Owensboro', 'Wich', 18, 1),
            (250, 'Henderson', 'Wich', 18, 1),
            (251, 'Nicholasville', 'Wich', 18, 1),
            (252, 'Bowling Green', 'Wich', 18, 1),
            (253, 'Frankfort', 'Wich', 18, 1),
            (254, 'Elizabethtown', 'Wich', 18, 1),
            (255, 'Covington', 'Wich', 18, 1),
            (256, 'Jeffersontown', 'Wich', 18, 1),
            (257, 'Valley Station', 'Wich', 18, 1),
            (258, 'New Orleans', 'New', 19, 1),
            (259, 'Lake Charles', 'New', 19, 1),
            (260, 'Marrero', 'New', 19, 1),
            (261, 'Baton Rogue', 'New', 19, 1),
            (262, 'Kenner', 'New', 19, 1),
            (263, 'New Iberia', 'New', 19, 1),
            (264, 'Shreveport', 'New', 19, 1),
            (265, 'Bossier City', 'New', 19, 1),
            (266, 'Houma', 'New', 19, 1),
            (267, 'Metairie', 'New', 19, 1),
            (268, 'Monroe', 'New', 19, 1),
            (269, 'Chalmette', 'New', 19, 1),
            (270, 'Laffayette', 'New', 19, 1),
            (271, 'Alexandria', 'New', 19, 1),
            (272, 'Laplace', 'New', 19, 1),
            (273, 'Portland', 'Port', 20, 1),
            (274, 'Brunswick', 'Port', 20, 1),
            (275, 'Augusta', 'Port', 20, 1),
            (276, 'Lewiston', 'Port', 20, 1),
            (277, 'South Portland', 'Port', 20, 1),
            (278, 'Saco', 'Port', 20, 1),
            (279, 'Bangor', 'Port', 20, 1),
            (280, 'Auburn', 'Port', 20, 1),
            (281, 'Westbrook', 'Port', 20, 1),
            (282, 'Scarborough', 'Port', 20, 1),
            (283, 'Gorham', 'Port', 20, 1),
            (284, 'Waterville', 'Port', 20, 1),
            (285, 'Sanford', 'Port', 20, 1),
            (286, 'Biddeford', 'Port', 20, 1),
            (287, 'Kennebunk', 'Port', 20, 1),
            (288, 'Baltimore', 'Balti', 21, 1),
            (289, 'Dundalk', 'Balti', 21, 1),
            (290, 'Towson', 'Balti', 21, 1),
            (291, 'Columbia', 'Balti', 21, 1),
            (292, 'Rockville', 'Balti', 21, 1),
            (293, 'Aspen Hill', 'Balti', 21, 1),
            (294, 'Silverspring', 'Balti', 21, 1),
            (295, 'Gaithersburg', 'Balti', 21, 1),
            (296, 'Bethesda', 'Balti', 21, 1),
            (297, 'Ellicot City', 'Balti', 21, 1),
            (298, 'Frederick', 'Balti', 21, 1),
            (299, 'Potomac', 'Balti', 21, 1),
            (300, 'Germantown', 'Balti', 21, 1),
            (301, 'Bowie', 'Balti', 21, 1),
            (302, 'North Bethesda', 'Balti', 21, 1),
            (303, 'Boston', 'Bost', 22, 1),
            (304, 'Brockton', 'Bost', 22, 1),
            (305, 'Quincy', 'Bost', 22, 1),
            (306, 'Worcester', 'Bost', 22, 1),
            (307, 'New Bedford', 'Bost', 22, 1),
            (308, 'Newton', 'Bost', 22, 1),
            (309, 'Springfield', 'Bost', 22, 1),
            (310, 'Fall River', 'Bost', 22, 1),
            (311, 'Somerville', 'Bost', 22, 1),
            (312, 'Lowell', 'Bost', 22, 1),
            (313, 'Plymouth', 'Bost', 22, 1),
            (314, 'Lawrence', 'Bost', 22, 1),
            (315, 'Cambridge', 'Bost', 22, 1),
            (316, 'Lynn', 'Bost', 22, 1),
            (317, 'Fahrmingham', 'Bost', 22, 1),
            (318, 'Detroit', 'Det', 23, 1),
            (319, 'Flint', 'Det', 23, 1),
            (320, 'Westland', 'Det', 23, 1),
            (321, 'Grand Rapids', 'Det', 23, 1),
            (322, 'Ann Arbor', 'Det', 23, 1),
            (323, 'Troy', 'Det', 23, 1),
            (324, 'Warren', 'Det', 23, 1),
            (325, 'Livonia', 'Det', 23, 1),
            (326, 'Farmington Hills', 'Det', 23, 1),
            (327, 'Sterling Heights', 'Det', 23, 1),
            (328, 'Dearborn', 'Det', 23, 1),
            (329, 'Southfield', 'Det', 23, 1),
            (330, 'Lansing', 'Det', 23, 1),
            (331, 'Canton', 'Det', 23, 1),
            (332, 'Waterford', 'Det', 23, 1),
            (333, 'Minneapolis', 'Minn', 24, 1),
            (334, 'Plymouth', 'Minn', 24, 1),
            (335, 'Maple Grove', 'Minn', 24, 1),
            (336, 'Saint Paul', 'Minn', 24, 1),
            (337, 'Brooklyn Park', 'Minn', 24, 1),
            (338, 'Burnsville', 'Minn', 24, 1),
            (339, 'Rochester', 'Minn', 24, 1),
            (340, 'Eagan', 'Minn', 24, 1),
            (341, 'Saint Cloud', 'Minn', 24, 1),
            (342, 'Duluth', 'Minn', 24, 1),
            (343, 'Eden Prairie', 'Minn', 24, 1),
            (344, 'Bloomington', 'Minn', 24, 1),
            (345, 'Coon Rapids', 'Minn', 24, 1),
            (346, 'Lakeville', 'Minn', 24, 1),
            (347, 'Blaine', 'Minn', 24, 1),
            (348, 'Jackson', 'Jack', 25, 1),
            (349, 'Southaven', 'Jack', 25, 1),
            (350, 'Pascagoula', 'Jack', 25, 1),
            (351, 'Gulfport', 'Jack', 25, 1),
            (352, 'Greenville', 'Jack', 25, 1),
            (353, 'Gautier', 'Jack', 25, 1),
            (354, 'Hattiesburg', 'Jack', 25, 1),
            (355, 'Tupelo', 'Jack', 25, 1),
            (356, 'Clinton', 'Jack', 25, 1),
            (357, 'Biloxi', 'Jack', 25, 1),
            (358, 'Olive Branch', 'Jack', 25, 1),
            (359, 'Columbus', 'Jack', 25, 1),
            (360, 'Meridian', 'Jack', 25, 1),
            (361, 'Vicksburg', 'Jack', 25, 1),
            (362, 'Starkville', 'Jack', 25, 1),
            (363, 'Kansas City', 'Kansa', 26, 1),
            (364, 'Saint Joseph', 'Kansa', 26, 1),
            (365, 'Chesterfield', 'Kansa', 26, 1),
            (366, 'Saint Louis', 'Kansa', 26, 1),
            (367, 'Saint Charles', 'Kansa', 26, 1),
            (368, 'Joplin', 'Kansa', 26, 1),
            (369, 'Springfield', 'Kansa', 26, 1),
            (370, 'Saint Peters', 'Kansa', 26, 1),
            (371, 'University City', 'Kansa', 26, 1),
            (372, 'Independence', 'Kansa', 26, 1),
            (373, 'Florissant', 'Kansa', 26, 1),
            (374, 'Oakville', 'Kansa', 26, 1),
            (375, 'Columbia', 'Kansa', 26, 1),
            (376, 'Blue Springs', 'Kansa', 26, 1),
            (377, 'Cape Girardeau', 'Kansa', 26, 1),
            (378, 'Billings', 'Bill', 27, 1),
            (379, 'Helena', 'Bill', 27, 1),
            (380, 'Belgrade', 'Bill', 27, 1),
            (381, 'Missoula', 'Bill', 27, 1),
            (382, 'Kalispell', 'Bill', 27, 1),
            (383, 'Livingston', 'Bill', 27, 1),
            (384, 'Great Falls', 'Bill', 27, 1),
            (385, 'Havre', 'Bill', 27, 1),
            (386, 'Whitefish', 'Bill', 27, 1),
            (387, 'Bozeman', 'Bill', 27, 1),
            (388, 'Anaconda', 'Bill', 27, 1),
            (389, 'Laurel', 'Bill', 27, 1),
            (390, 'Butte', 'Bill', 27, 1),
            (391, 'Miles City', 'Bill', 27, 1),
            (392, 'Lewistown', 'Bill', 27, 1),
            (393, 'Omaha', 'Omah', 28, 1),
            (394, 'Fremont', 'Omah', 28, 1),
            (395, 'Papillion', 'Omah', 28, 1),
            (396, 'Lincoln', 'Omah', 28, 1),
            (397, 'North Platte', 'Omah', 28, 1),
            (398, 'La Vista', 'Omah', 28, 1),
            (399, 'Bellevue', 'Omah', 28, 1),
            (400, 'Norfolk', 'Omah', 28, 1),
            (401, 'Scottsbluff', 'Omah', 28, 1),
            (402, 'Grand Island', 'Omah', 28, 1),
            (403, 'Hastings', 'Omah', 28, 1),
            (404, 'Beatrice', 'Omah', 28, 1),
            (405, 'Kearney', 'Omah', 28, 1),
            (406, 'Columbus', 'Omah', 28, 1),
            (407, 'South Sioux City', 'Omah', 28, 1),
            (408, 'Las Vegas', 'Lasv', 29, 1),
            (409, 'North Las Vegas', 'Lasv', 29, 1),
            (410, 'Winchester', 'Lasv', 29, 1),
            (411, 'Henderson', 'Lasv', 29, 1),
            (412, 'Spring Valley', 'Lasv', 29, 1),
            (413, 'Sun Valley', 'Lasv', 29, 1),
            (414, 'Paradise', 'Lasv', 29, 1),
            (415, 'Sparks', 'Lasv', 29, 1),
            (416, 'Elko', 'Lasv', 29, 1),
            (417, 'Reno', 'Lasv', 29, 1),
            (418, 'Carson City', 'Lasv', 29, 1),
            (419, 'Boulder City', 'Lasv', 29, 1),
            (420, 'Sunrise Manor', 'Lasv', 29, 1),
            (421, 'Pahrump', 'Lasv', 29, 1),
            (422, 'Fernley', 'Lasv', 29, 1),
            (423, 'Manchester', 'Manch', 30, 1),
            (424, 'Salem', 'Manch', 30, 1),
            (425, 'Keene', 'Manch', 30, 1),
            (426, 'Nashua', 'Manch', 30, 1),
            (427, 'Dover', 'Manch', 30, 1),
            (428, 'Bedford', 'Manch', 30, 1),
            (429, 'Concord', 'Manch', 30, 1),
            (430, 'Merrimack', 'Manch', 30, 1),
            (431, 'Portsmouth', 'Manch', 30, 1),
            (432, 'Derry', 'Manch', 30, 1),
            (433, 'Hudson', 'Manch', 30, 1),
            (434, 'Goffstown', 'Manch', 30, 1),
            (435, 'Rochester', 'Manch', 30, 1),
            (436, 'Londonderry', 'Manch', 30, 1),
            (437, 'Luconia', 'Manch', 30, 1),
            (438, 'Newark', 'Newark', 31, 1),
            (439, 'Edison', 'Newark', 31, 1),
            (440, 'Passaic', 'Newark', 31, 1),
            (441, 'Jersey City', 'Newark', 31, 1),
            (442, 'Trenton', 'Newark', 31, 1),
            (443, 'East Orange', 'Newark', 31, 1),
            (444, 'Paterson', 'Newark', 31, 1),
            (445, 'Camden', 'Newark', 31, 1),
            (446, 'Union City', 'Newark', 31, 1),
            (447, 'Elizabeth', 'Newark', 31, 1),
            (448, 'Clifton', 'Newark', 31, 1),
            (449, 'North Bergen', 'Newark', 31, 1),
            (450, 'Toms River', 'Newark', 31, 1),
            (451, 'Cherry Hill', 'Newark', 31, 1),
            (452, 'Irvington', 'Newark', 31, 1),
            (453, 'Albuquerque', 'Albu', 32, 1),
            (454, 'Farmington', 'Albu', 32, 1),
            (455, 'Carlsbad', 'Albu', 32, 1),
            (456, 'Las Cruces', 'Albu', 32, 1),
            (457, 'South Valley', 'Albu', 32, 1),
            (458, 'Gallup', 'Albu', 32, 1),
            (459, 'Santa Fe', 'Albu', 32, 1),
            (460, 'Alamogordo', 'Albu', 32, 1),
            (461, 'Deming', 'Albu', 32, 1),
            (462, 'Rio Rancho', 'Albu', 32, 1),
            (463, 'Clovis', 'Albu', 32, 1),
            (464, 'Sunland Park', 'Albu', 32, 1),
            (465, 'Roswell', 'Albu', 32, 1),
            (466, 'Hobbs', 'Albu', 32, 1),
            (467, 'Las Vegas', 'Albu', 32, 1),
            (468, 'Hoboken', 'Hobo', 33, 1),
            (469, 'Guttenberg', 'Hobo', 33, 1),
            (470, 'Cliffside Park', 'Hobo', 33, 1),
            (471, 'Jersey City', 'Hobo', 33, 1),
            (472, 'Secaucus', 'Hobo', 33, 1),
            (473, 'Edgewater', 'Hobo', 33, 1),
            (474, 'Weehawken', 'Hobo', 33, 1),
            (475, 'North Bergen', 'Hobo', 33, 1),
            (476, 'Harrison', 'Hobo', 33, 1),
            (477, 'Union City', 'Hobo', 33, 1),
            (478, 'Bayonne', 'Hobo', 33, 1),
            (479, 'Kearny', 'Hobo', 33, 1),
            (480, 'West New York', 'Hobo', 33, 1),
            (481, 'Fairview', 'Hobo', 33, 1),
            (482, 'Ridgefield', 'Hobo', 33, 1),
            (483, 'Charlotte', 'Charl', 34, 1),
            (484, 'Fayetteville', 'Charl', 34, 1),
            (485, 'Greenville', 'Charl', 34, 1),
            (486, 'Raly', 'Charl', 34, 1),
            (487, 'Carey', 'Charl', 34, 1),
            (488, 'Asheville', 'Charl', 34, 1),
            (489, 'Greensboro', 'Charl', 34, 1),
            (490, 'High Point', 'Charl', 34, 1),
            (491, 'Jacksonville', 'Charl', 34, 1),
            (492, 'Durham', 'Charl', 34, 1),
            (493, 'Wilmington', 'Charl', 34, 1),
            (494, 'Gastonia', 'Charl', 34, 1),
            (495, 'Winston-Salem', 'Charl', 34, 1),
            (496, 'Concord', 'Charl', 34, 1),
            (497, 'Rocky Mount', 'Charl', 34, 1),
            (498, 'Fargo', 'West Fargo', 35, 1),
            (499, 'West Fargo', 'West Fargo', 35, 1),
            (500, 'Wahpeton', 'West Fargo', 35, 1),
            (501, 'Bismarck', 'West Fargo', 35, 1),
            (502, 'Mandans', 'West Fargo', 35, 1),
            (503, 'Devils Lake', 'West Fargo', 35, 1),
            (504, 'Grand Fork', 'West Fargo', 35, 1),
            (505, 'Dickinson', 'West Fargo', 35, 1),
            (506, 'Minot', 'West Fargo', 35, 1),
            (507, 'Jamestown', 'West Fargo', 35, 1),
            (508, 'Grafton', 'West Fargo', 35, 1),
            (509, 'Williston', 'West Fargo', 35, 1),
            (510, 'Valley City', 'West Fargo', 35, 1),
            (511, 'Columbus', 'Colum', 36, 1),
            (512, 'Dayton', 'Colum', 36, 1),
            (513, 'Springfield', 'Colum', 36, 1),
            (514, 'Cleveland', 'Colum', 36, 1),
            (515, 'Parma', 'Colum', 36, 1),
            (516, 'Hamilton', 'Colum', 36, 1),
            (517, 'Toledo', 'Colum', 36, 1),
            (518, 'Canton', 'Colum', 36, 1),
            (519, 'Kettering', 'Colum', 36, 1),
            (520, 'Cincinnati', 'Colum', 36, 1),
            (521, 'Youngstown', 'Colum', 36, 1),
            (522, 'Elyria', 'Colum', 36, 1),
            (523, 'Akron', 'Colum', 36, 1),
            (524, 'Lorain', 'Colum', 36, 1),
            (525, 'Middletown', 'Colum', 36, 1),
            (526, 'Oklahoma City', '', 37, 1),
            (527, 'Edmond', 'Edm', 37, 1),
            (528, 'Muskogee', 'Musk', 37, 1),
            (529, 'Tulsa', 'Edm', 37, 1),
            (530, 'Midwest City', 'Edm', 37, 1),
            (531, 'Bartlesville', 'Edm', 37, 1),
            (532, 'Norman', 'Edm', 37, 1),
            (533, 'Moore', 'Edm', 37, 1),
            (534, 'Shawnee', 'Edm', 37, 1),
            (535, 'Lawton', 'Edm', 37, 1),
            (536, 'Enid', 'Edm', 37, 1),
            (537, 'Ponca City', 'Edm', 37, 1),
            (538, 'Broken Arrow', 'Edm', 37, 1),
            (539, 'Stillwater', 'Edm', 37, 1),
            (540, 'Ardmore', 'Edm', 37, 1),
            (541, 'Portland', 'Port', 38, 1),
            (542, 'Hillsboro', 'Port', 38, 1),
            (543, 'Tigard', 'Port', 38, 1),
            (544, 'Salem', 'Port', 38, 1),
            (545, 'Medford', 'Port', 38, 1),
            (546, 'Aloha', 'Port', 38, 1),
            (547, 'Eugene', 'Port', 38, 1),
            (548, 'Bend', 'Port', 38, 1),
            (549, 'Albany', 'Port', 38, 1),
            (550, 'Gresham', 'Port', 38, 1),
            (551, 'Springfield', 'Port', 38, 1),
            (552, 'Lake Oswego', 'Port', 38, 1),
            (553, 'Beaverton', 'Port', 38, 1),
            (554, 'Corvellis', 'Port', 38, 1),
            (555, 'Keizer', 'Port', 38, 1),
            (556, 'Philadelphia', 'Phil', 39, 1),
            (557, 'Bethlehem', 'Phil', 39, 1),
            (558, 'Altoona', 'Phil', 39, 1),
            (559, 'Pittsburgh', 'Phil', 39, 1),
            (560, 'Scranton', 'Phil', 39, 1),
            (561, 'State College', 'Phil', 39, 1),
            (562, 'Allen Town', 'Phil', 39, 1),
            (563, 'Lancaster', 'Phil', 39, 1),
            (564, 'Wilkes-Barre', 'Phil', 39, 1),
            (565, 'Erie', 'Phil', 39, 1),
            (566, 'Levittown', 'Phil', 39, 1),
            (567, 'York', 'Phil', 39, 1),
            (568, 'Reading', 'Phil', 39, 1),
            (569, 'Harrisburgh', 'Phil', 39, 1),
            (570, 'Chester', 'Phil', 39, 1),
            (571, 'Providence', 'Prov', 40, 1),
            (572, 'Woonsocket', 'Prov', 40, 1),
            (573, 'Westerly', 'Prov', 40, 1),
            (574, 'Warwick', 'Prov', 40, 1),
            (575, 'Coventry', 'Prov', 40, 1),
            (576, 'Newport', 'Prov', 40, 1),
            (577, 'Cranston', 'Prov', 40, 1),
            (578, 'Cumberland', 'Prov', 40, 1),
            (579, 'Bristol', 'Prov', 40, 1),
            (580, 'Pawtucket', 'Prov', 40, 1),
            (581, 'North Providence', 'Prov', 40, 1),
            (582, 'Smithfield', 'Prov', 40, 1),
            (583, 'East Providence', 'Prov', 40, 1),
            (584, 'West Warwick', 'Prov', 40, 1),
            (585, 'Central Falls', 'Prov', 40, 1),
            (586, 'Columbia', 'Colu', 41, 1),
            (587, 'Greenville', 'Colu', 41, 1),
            (588, 'Goose Creek', 'Colu', 41, 1),
            (589, 'Charleston', 'Colu', 41, 1),
            (590, 'Summerville', 'Colu', 41, 1),
            (591, 'Florence', 'Colu', 41, 1),
            (592, 'North Charleston', 'Colu', 41, 1),
            (593, 'Sumter', 'Colu', 41, 1),
            (594, 'Aiken', 'Colu', 41, 1),
            (595, 'Rock Hill', 'Colu', 41, 1),
            (596, 'Spartanburg', 'Colu', 41, 1),
            (597, 'Anderson', 'Colu', 41, 1),
            (598, 'Mount Pleasant', 'Colu', 41, 1),
            (599, 'Hilton Head Island', 'Colu', 41, 1),
            (600, 'Myrtle Beach', 'Colu', 41, 1),
            (601, 'Sioux Falls', 'Siou', 42, 1),
            (602, 'Mitchell', 'Siou', 42, 1),
            (603, 'Spearfish', 'Siou', 42, 1),
            (604, 'Rapid City', 'Siou', 42, 1),
            (605, 'Pierre', 'Siou', 42, 1),
            (606, 'Rapid Valley', 'Siou', 42, 1),
            (607, 'Aberdeen', 'Siou', 42, 1),
            (608, 'Yankton', 'Siou', 42, 1),
            (609, 'Brandon', 'Siou', 42, 1),
            (610, 'Watertown', 'Siou', 42, 1),
            (611, 'Huron', 'Siou', 42, 1),
            (612, 'Sturgis', 'Siou', 42, 1),
            (613, 'Brookings', 'Siou', 42, 1),
            (614, 'Vermillion', 'Siou', 42, 1),
            (615, 'Madison', 'Siou', 42, 1),
            (616, 'Memphis', 'Memp', 43, 1),
            (617, 'Murfreesboro', 'Memp', 43, 1),
            (618, 'Kingport', 'Memp', 43, 1),
            (619, 'Nashville', 'Memp', 43, 1),
            (620, 'Jackson', 'Memp', 43, 1),
            (621, 'Bartlett', 'Memp', 43, 1),
            (622, 'Knoxville', 'Memp', 43, 1),
            (623, 'Johnson City', 'Memp', 43, 1),
            (624, 'Collierville', 'Memp', 43, 1),
            (625, 'Chattanooga', 'Memp', 43, 1),
            (626, 'Franklin', 'Memp', 43, 1),
            (627, 'Cleveland', 'Memp', 43, 1),
            (628, 'Clarksville', 'Memp', 43, 1),
            (629, 'Hendersonville', 'Memp', 43, 1),
            (630, 'Germantown', 'Memp', 43, 1),
            (631, 'Houston', 'Hous', 44, 1),
            (632, 'El Paso', 'Hous', 44, 1),
            (633, 'Lubbock', 'Hous', 44, 1),
            (634, 'San Antonio', 'Hous', 44, 1),
            (635, 'Arlingtom', 'Hous', 44, 1),
            (636, 'Laredo', 'Hous', 44, 1),
            (637, 'Dallas', 'Hous', 44, 1),
            (638, 'Corpus Christi', 'Hous', 44, 1),
            (639, 'Irving', 'Hous', 44, 1),
            (640, 'Austin', 'Hous', 44, 1),
            (641, 'Plano', 'Hous', 44, 1),
            (642, 'Amarillo', 'Hous', 44, 1),
            (643, 'Fort Worth', 'Hous', 44, 1),
            (644, 'Garland', 'Hous', 44, 1),
            (645, 'Brownsville', 'Hous', 44, 1),
            (646, 'Salt Lake City', 'Salt', 45, 1),
            (647, 'Sandy', 'Salt', 45, 1),
            (648, 'Murray', 'Salt', 45, 1),
            (649, 'West Valley City', 'Salt', 45, 1),
            (650, 'Ogden', 'Salt', 45, 1),
            (651, 'Logan', 'Salt', 45, 1),
            (652, 'Provo', 'Salt', 45, 1),
            (653, 'Layton', 'Salt', 45, 1),
            (654, 'Bountiful', 'Salt', 45, 1),
            (655, 'West Jordan', 'Salt', 45, 1),
            (656, 'Saint George', 'Salt', 45, 1),
            (657, 'South Jordan', 'Salt', 45, 1),
            (658, 'Orem', 'Salt', 45, 1),
            (659, 'Taylorsville', 'Salt', 45, 1),
            (660, 'Roy', 'Salt', 45, 1),
            (661, 'Burlington', 'Burl', 46, 1),
            (662, 'Brattleboro', 'Burl', 46, 1),
            (663, 'Williston', 'Burl', 46, 1),
            (664, 'Bennington', 'Burl', 46, 1),
            (665, 'Springfield', 'Burl', 46, 1),
            (666, 'Montpelier', 'Burl', 46, 1),
            (667, 'Colchester', 'Burl', 46, 1),
            (668, 'Hartford', 'Burl', 46, 1),
            (669, 'Saint Johnsbury', 'Burl', 46, 1),
            (670, 'South Burlington', 'Burl', 46, 1),
            (671, 'Barre', 'Burl', 46, 1),
            (672, 'Saint Albans', 'Burl', 46, 1),
            (673, 'Rutland', 'Burl', 46, 1),
            (674, 'Middlebury', 'Burl', 46, 1),
            (675, 'Jericho', 'Burl', 46, 1),
            (676, 'Virginia Beach', 'Virg', 47, 1),
            (677, 'Newport News', 'Virg', 47, 1),
            (678, 'Suffolk', 'Virg', 47, 1),
            (679, 'Norfolk', 'Virg', 47, 1),
            (680, 'Hampton', 'Virg', 47, 1),
            (681, 'Lynchburg', 'Virg', 47, 1),
            (682, 'Chesapeake', 'Virg', 47, 1),
            (683, 'Alexandria', 'Virg', 47, 1),
            (684, 'Centreville', 'Virg', 47, 1),
            (685, 'Richmond', 'Virg', 47, 1),
            (686, 'Portsmouth', 'Virg', 47, 1),
            (687, 'Dale City', 'Virg', 47, 1),
            (688, 'Arlington', 'Virg', 47, 1),
            (689, 'Roanoke', 'Virg', 47, 1),
            (690, 'Reston', 'Virg', 47, 1),
            (691, 'Seattle', 'Seat', 48, 1),
            (692, 'Everett', 'Seat', 48, 1),
            (693, 'Kennewick', 'Seat', 48, 1),
            (694, 'Spokane', 'Seat', 48, 1),
            (695, 'Yakima', 'Seat', 48, 1),
            (696, 'Lakewoood', 'Seat', 48, 1),
            (697, 'Tacoma', 'Seat', 48, 1),
            (698, 'Kent', 'Seat', 48, 1),
            (699, 'Renton', 'Seat', 48, 1),
            (700, 'Vancouver', 'Seat', 48, 1),
            (701, 'Federal Way', 'Seat', 48, 1),
            (702, 'Shoreline', 'Seat', 48, 1),
            (703, 'Bellevue', 'Seat', 48, 1),
            (704, 'Bellingham', 'Seat', 48, 1),
            (705, 'Redmond', 'Seat', 48, 1),
            (706, 'Charleston', 'Charl', 49, 1),
            (707, 'Weirton', 'Charl', 49, 1),
            (708, 'South Charleston', 'Charl', 49, 1),
            (709, 'Huntington', 'Charl', 49, 1),
            (710, 'Fairmont', 'Charl', 49, 1),
            (711, 'Saint Albans', 'Charl', 49, 1),
            (712, 'Parkersburg', 'Charl', 49, 1),
            (713, 'Beckley', 'Charl', 49, 1),
            (714, 'Bluefield', 'Charl', 49, 1),
            (715, 'Wheeling', 'Charl', 49, 1),
            (716, 'Clarksburg', 'Charl', 49, 1),
            (717, 'Vienna', 'Charl', 49, 1),
            (718, 'Morgantown', 'Charl', 49, 1),
            (719, 'Martinsburg', 'Charl', 49, 1),
            (720, 'Cross Lanes', 'Charl', 49, 1),
            (721, 'Milwaukee', 'Milw', 50, 1),
            (722, 'Appleton', 'Milw', 50, 1),
            (723, 'West Allis', 'Milw', 50, 1),
            (724, 'Madison', 'Milw', 50, 1),
            (725, 'Waukesha', 'Milw', 50, 1),
            (726, 'La Crosse', 'Milw', 50, 1),
            (727, 'Green Bay', 'Milw', 50, 1),
            (728, 'Oshkosh', 'Milw', 50, 1),
            (729, 'Sheboygan', 'Milw', 50, 1),
            (730, 'Kenosha', 'Milw', 50, 1),
            (731, 'Eau Claire', 'Milw', 50, 1),
            (732, 'Wauwatosa', 'Milw', 50, 1),
            (733, 'Racine', 'Milw', 50, 1),
            (734, 'Janesville', 'Milw', 50, 1),
            (735, 'Fond du Lac', 'Milw', 50, 1),
            (736, 'Cheyenne', 'Chey', 51, 1),
            (737, 'Sheridan', 'Chey', 51, 1),
            (738, 'Jackson', 'Chey', 51, 1),
            (739, 'Casper', 'Chey', 51, 1),
            (740, 'Green River', 'Chey', 51, 1),
            (741, 'Rawlins', 'Chey', 51, 1),
            (742, 'Laramie', 'Chey', 51, 1),
            (743, 'Evanston', 'Chey', 51, 1),
            (744, 'Lander', 'Chey', 51, 1),
            (745, 'Gillette', 'Chey', 51, 1),
            (746, 'Riverton', 'Chey', 51, 1),
            (747, 'Torrington', 'Chey', 51, 1),
            (748, 'Rock Springs', 'Chey', 51, 1),
            (749, 'Cody', 'Chey', 51, 1),
            (750, 'Douglas', 'Chey', 51, 1),
            (40034, 'Acme', 'Acme', 52, 2),
            (40395, 'Sointula', 'Sointula', 53, 2),
            (40396, 'Sooke', 'Sooke', 53, 2),
            (40397, 'Sorrento', 'Sorrento', 53, 2),
            (40398, 'Squamish', 'Squamish', 53, 2),
            (40399, 'Stephen', 'Stephen', 53, 2),
            (40400, 'Stewart', 'Stewart', 53, 2),
            (40401, 'Sturdies Bay', 'SturdiesBay', 53, 2),
            (40402, 'Summerland', 'Summerland', 53, 2),
            (40403, 'Surrey', 'Surrey', 53, 2),
            (40404, 'Tahsis', 'Tahsis', 53, 2),
            (40405, 'Tappen', 'Tappen', 53, 2),
            (40406, 'Taylor', 'Taylor', 53, 2),
            (40407, 'Telegraph Creek', 'TelegraphCreek', 53, 2),
            (40408, 'Terrace', 'Terrace', 53, 2),
            (40409, 'Tlell', 'Tlell', 53, 2),
            (40410, 'Tofino', 'Tofino', 53, 2),
            (40411, 'Trail', 'Trail', 53, 2),
            (40412, 'Tsawwassen', 'Tsawwassen', 53, 2),
            (40413, 'Ucluelet', 'Ucluelet', 53, 2),
            (40414, 'Union Bay', 'UnionBay', 53, 2),
            (40415, 'Valemount', 'Valemount', 53, 2),
            (40416, 'Vancouver', 'Vancouver', 53, 2),
            (40417, 'Vanderhoof', 'Vanderhoof', 53, 2),
            (40418, 'Vernon', 'Vernon', 53, 2),
            (40419, 'Victoria', 'Victoria', 53, 2),
            (45804, 'Salzburg', 'Salzburg', NULL, 46),
            (45805, 'Innsbruck', 'Innsbruck', NULL, 46),
            (45806, 'Klagenfurt am W+Ârthersee', 'KlagenfurtamWorthersee', NULL, 46),
            (45807, 'Villach', 'Villach', NULL, 46),
            (60158, 'Laughton', 'Laughton', 65, 95),
            (60159, 'Leamington', 'Leamington', 65, 95),
            (60160, 'Leeds', 'Leeds', 65, 95),
            (60161, 'Leek', 'Leek', 65, 95),
            (60162, 'Leicester', 'Leicester', 65, 95),
            (60163, 'Leigh', 'Leigh', 65, 95),
            (60164, 'Letchworth', 'Letchworth', 65, 95),
            (60165, 'Lewes', 'Lewes', 65, 95),
            (60166, 'Leyland', 'Leyland', 65, 95),
            (60167, 'Lichfield', 'Lichfield', 65, 95),
            (60168, 'Lincoln', 'Lincoln', 65, 95),
            (60169, 'Little Chalfont', 'LittleChalfont', 65, 95),
            (60170, 'Liverpool', 'Liverpool', 65, 95),
            (60171, 'London', 'London', 65, 95),
            (60172, 'Loughborough', 'Loughborough', 65, 95),
            (60173, 'Louth', 'Louth', 65, 95),
            (60174, 'Lowestoft', 'Lowestoft', 65, 95),
            (60175, 'Luton', 'Luton', 65, 95),
            (60292, 'Kabul', 'Kabul', 2, 97),
            (60293, 'Kandah-ür', 'Kandahar', 2, 97),
            (60294, 'Maz-ür-e Shar-½f', 'Mazar-eSharif', 2, 97),
            (60295, 'Her-üt', 'Herat', 2, 97),
            (60296, 'Jal-ül-üb-üd', 'Jalalabad', 2, 97),
            (60297, 'Kunduz', 'Kunduz', 2, 97),
            (60298, 'Ghazni', 'Ghazni', 2, 97),
            (60299, 'Balkh', 'Balkh', 2, 97),
            (60300, 'Baghl-ün', 'Baghlan', 2, 97),
            (60301, 'Gard-ôz', 'Gardez', 2, 97),
            (64999, '*Tokyo', 'Tokyo', 2, 111),
            (65000, 'Yokohama-shi', 'Yokohama-shi', 2, 111),
            (65001, '+îsaka-shi', 'Osaka-shi', 2, 111),
            (65002, 'Nagoya-shi', 'Nagoya-shi', 2, 111),
            (65003, 'Sapporo-shi', 'Sapporo-shi', 2, 111),
            (65004, 'K+ìbe-shi', 'Kobe-shi', 2, 111),
            (65005, 'Kyoto', 'Kyoto', 2, 111),
            (65006, 'Fukuoka-shi', 'Fukuoka-shi', 2, 111),
            (65007, 'Kawasaki', 'Kawasaki', 2, 111),
            (65008, 'Saitama', 'Saitama', 2, 111);

        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`companies` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
          `last_ip` varchar(15) NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `name` varchar(250) NOT NULL,
          `website` varchar(250) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        
        CREATE TABLE IF NOT EXISTS $db_name.`companies_contact` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
          `last_ip` varchar(15) NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `company_id` int(11) DEFAULT NULL,
          `email_id` varchar(100) DEFAULT NULL,
          `primary_phone` varchar(15) DEFAULT NULL,
          `ext` int(10) NOT NULL,
          `secondary_phone` varchar(15) DEFAULT NULL,
          `name` varchar(50) DEFAULT NULL,
          `fax_num` varchar(20) DEFAULT NULL,
          `address` longtext,
          `city` varchar(25) NOT NULL,
          `state` int(11) NOT NULL,
          `country_id` int(4) NOT NULL,
          `postal_code` varchar(10) NOT NULL,
          `hot_contact` int(1) NOT NULL DEFAULT '0',
          `hot_contact_comment` varchar(250) NOT NULL,
          `key_technologies` longtext NOT NULL,
          `notes` longtext NOT NULL,
          `status` int(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`company_areas` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `added_by` int(11) NOT NULL,
              `last_ip` varchar(20) NOT NULL,
              `country_id` int(11) NOT NULL,
              `area_name` varchar(255) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`continents` (
              `continentID` smallint(11) NOT NULL DEFAULT '0',
              `continentName` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
              PRIMARY KEY (`continentID`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ");

        mysql_query("
        INSERT INTO $db_name.`continents` (`continentID`, `continentName`) VALUES
            (1, 'North America'),
            (2, 'South America'),
            (3, 'Europe'),
            (4, 'Asia'),
            (5, 'Africa'),
            (6, 'Australia & Oceania');
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`controllers_info` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `title` varchar(50) DEFAULT NULL,
              `module` varchar(30) NOT NULL,
              `controller` varchar(25) DEFAULT NULL,
              `method` varchar(25) DEFAULT NULL,
              `action` int(3) NOT NULL,
              `is_super` int(1) NOT NULL DEFAULT '0',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`controllers_info` (`id`, `title`, `module`, `controller`, `method`, `action`, `is_super`) VALUES
(1, 'Company', 'company', 'company', 'add', 103, 0),
(2, 'Company', 'company', 'company', 'view', 101, 0),
(3, 'Company', 'company', 'company', 'edit', 102, 0),
(4, 'Company', 'company', 'company', 'list_items', 101, 0),
(5, 'Company', 'company', 'company', 'ajax_list_items', 101, 0),
(6, 'Company', 'company', 'company', 'export', 105, 0),
(7, 'Company', 'company', 'company', 'delete', 104, 0),
(8, 'Company Contact', 'company', 'contact', 'add', 103, 0),
(9, 'Company Contact', 'company', 'contact', 'view', 101, 0),
(10, 'Company Contact', 'company', 'contact', 'edit', 102, 0),
(11, 'Company Contact', 'company', 'contact', 'list_items', 101, 0),
(12, 'Company Contact', 'company', 'contact', 'ajax_list_items', 101, 0),
(13, 'Company Contact', 'company', 'contact', 'export', 105, 0),
(14, 'Company Contact', 'company', 'contact', 'delete', 104, 0),
(15, 'Site', 'user', 'site', 'add', 103, 1),
(16, 'Site', 'user', 'site', 'edit', 102, 1),
(17, 'Site', 'user', 'site', 'view', 101, 1),
(18, 'Site', 'user', 'site', 'list_items', 101, 1),
(19, 'Site', 'user', 'site', 'ajax_list_items', 101, 1),
(20, 'Site', 'user', 'site', 'export', 105, 1),
(21, 'Site', 'user', 'site', 'delete', 104, 1),
(22, 'User', 'user', 'user', 'add', 103, 0),
(23, 'User', 'user', 'user', 'edit', 102, 0),
(24, 'User', 'user', 'user', 'view', 101, 0),
(25, 'User', 'user', 'user', 'list_items', 101, 0),
(26, 'User', 'user', 'user', 'ajax_list_items', 101, 0),
(27, 'User', 'user', 'user', 'export', 105, 0),
(28, 'User', 'user', 'user', 'delete', 104, 0),
(29, 'Group', 'user', 'group', 'add', 103, 0),
(30, 'Group', 'user', 'group', 'edit', 102, 0),
(31, 'Group', 'user', 'group', 'view', 101, 0),
(32, 'Group', 'user', 'group', 'list_items', 101, 0),
(33, 'Group', 'user', 'group', 'ajax_list_items', 101, 0),
(34, 'Group', 'user', 'group', 'export', 105, 0),
(35, 'Group', 'user', 'group', 'delete', 104, 0),
(36, 'Group', 'user', 'group', 'permission', 102, 0),
(37, 'Candidate', 'candidate', 'candidate', 'add', 103, 0),
(38, 'Candidate', 'candidate', 'candidate', 'view', 101, 0),
(39, 'Candidate', 'candidate', 'candidate', 'edit', 102, 0),
(40, 'Candidate', 'candidate', 'candidate', 'list_items', 101, 0),
(41, 'Candidate', 'candidate', 'candidate', 'ajax_list_items', 101, 0),
(42, 'Candidate', 'candidate', 'candidate', 'export', 105, 0),
(43, 'Candidate', 'candidate', 'candidate', 'delete', 104, 0),
(44, 'Candidate', 'candidate', 'candidate', 'download_resume', 101, 0),
(45, 'Candidate', 'candidate', 'candidate', 'temp_resume', 101, 0),
(46, 'Job_order', 'job_order', 'job_order', 'add', 103, 0),
(47, 'Job_order', 'job_order', 'job_order', 'view', 101, 0),
(48, 'Job_order', 'job_order', 'job_order', 'edit', 102, 0),
(49, 'Job_order', 'job_order', 'job_order', 'list_items', 101, 0),
(50, 'Job_order', 'job_order', 'job_order', 'ajax_list_items', 101, 0),
(51, 'Job_order', 'job_order', 'job_order', 'export', 105, 0),
(52, 'Job_order', 'job_order', 'job_order', 'delete', 104, 0),
(53, 'Job_order', 'job_order', 'job_order', 'ajax_users', 101, 0),
(54, 'Job_order', 'job_order', 'job_order', 'ajax_contact', 101, 0),
(55, 'Job_order Pipeline', 'job_order', 'pipeline', 'add', 103, 0),
(56, 'Job_order Pipeline', 'job_order', 'pipeline', 'list_items', 101, 0),
(57, 'Job_order Pipeline', 'job_order', 'pipeline', 'activity', 101, 0),
(59, 'Job_order Assign', 'job_order', 'assign_job', 'add', 103, 0),
(60, 'Job_order Assign', 'job_order', 'assign_job', 'edit', 102, 0),
(61, 'Job_order Pipeline', 'job_order', 'assign_job', 'list_items', 101, 0),
(62, 'Job_order Pipeline', 'job_order', 'assign_job', 'ajax_list_items', 101, 0),
(63, 'vendor', 'vendor', 'vendor', 'ajax_list_items', 101, 0),
(64, 'vendor', 'vendor', 'vendor', 'add', 103, 0),
(65, 'vendor', 'vendor', 'vendor', 'view', 101, 0),
(66, 'vendor', 'vendor', 'vendor', 'edit', 102, 0),
(67, 'vendor', 'vendor', 'vendor', 'list_items', 101, 0),
(68, 'vendor', 'vendor', 'vendor', 'export', 105, 0),
(69, 'vendor', 'vendor', 'vendor', 'delete', 104, 0),
(70, 'job_order', 'job_order', 'job_order', 'status', 103, 0),
(71, 'activity', 'activity', 'activity', 'list_items', 101, 0),
(72, 'Blacklist Vendor', 'vendor', 'blacklist', 'ajax_list_items', 101, 0),
(73, 'Blacklist Vendor', 'vendor', 'blacklist', 'add', 103, 0),
(74, 'Blacklist Vendor', 'vendor', 'blacklist', 'view', 101, 0),
(75, 'Blacklist Vendor', 'vendor', 'blacklist', 'edit', 102, 0),
(76, 'Blacklist Vendor', 'vendor', 'blacklist', 'list_items', 101, 0),
(77, 'Blacklist Vendor', 'vendor', 'blacklist', 'export', 105, 0),
(78, 'Blacklist Vendor', 'vendor', 'blacklist', 'delete', 104, 0),
(79, 'Training', 'training', 'training', 'ajax_list_items', 101, 0),
(80, 'Training', 'training', 'training', 'add', 103, 0),
(81, 'Training', 'training', 'training', 'view', 101, 0),
(82, 'Training', 'training', 'training', 'edit', 102, 0),
(83, 'Training', 'training', 'training', 'list_items', 101, 0),
(84, 'Training', 'training', 'training', 'export', 105, 0),
(85, 'Training', 'training', 'training', 'delete', 104, 0),
(86, 'Training Category', 'training', 'category', 'ajax_list_items', 101, 0),
(87, 'Training Category', 'training', 'category', 'add', 103, 0),
(88, 'Training Category', 'training', 'category', 'view', 101, 0),
(89, 'Training Category', 'training', 'category', 'edit', 102, 0),
(90, 'Training Category', 'training', 'category', 'list_items', 101, 0),
(91, 'Training Category', 'training', 'category', 'export', 105, 0),
(92, 'Training Category', 'training', 'category', 'delete', 104, 0),
(100, 'User Authorization', 'user', 'authorisation', 'list_items', 101, 0),
(99, 'User Authorization', 'user', 'authorisation', 'ajax_list_items', 101, 0),
(96, 'Email Activity', 'activity', 'activity_email', 'list_items', 101, 0),
(97, 'Email Activity', 'activity', 'activity_email', 'view', 102, 0),
(98, 'Email Activity', 'activity', 'activity_email', 'delete', 104, 0),
(101, 'Upload Resume Report', 'activity', 'email_report', 'list_items', 101, 0),
(102, 'Upload Resume Report', 'activity', 'email_report', 'ajax_list_items', 101, 0);

        ");

        mysql_query("                    
            CREATE TABLE IF NOT EXISTS $db_name.`countries` (
              `country_id` smallint(9) NOT NULL DEFAULT '0',
              `country_name` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
              `short_country` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
              `continent_id` smallint(11) DEFAULT NULL,
              `dial_code` smallint(8) DEFAULT NULL,
              PRIMARY KEY (`country_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

        ");

        mysql_query("
        INSERT INTO $db_name.`countries` (`country_id`, `country_name`, `short_country`, `continent_id`, `dial_code`) VALUES
            (1, 'United States', 'US', 1, 1),
            (2, 'Canada', 'Canada', 1, 1),
            (3, 'Bahamas', 'Bahamas', 1, 242),
            (4, 'Barbados', 'Barbados', 1, 246),
            (5, 'Belize', 'Belize', 1, 501),
            (6, 'Bermuda', 'Bermuda', 1, 441),
            (7, 'British Virgin Islands', 'BVI', 1, 284),
            (8, 'Cayman Islands', 'CaymanIsl', 1, 345),
            (9, 'Costa Rica', 'CostaRica', 1, 506),
            (10, 'Cuba', 'Cuba', 1, 53),
            (11, 'Dominica', 'Dominica', 1, 767),
            (12, 'Dominican Republic', 'DominicanRep', 1, 809),
            (13, 'El Salvador', 'ElSalvador', 1, 503),
            (14, 'Greenland', 'Greenland', 1, 299),
            (15, 'Grenada', 'Grenada', 1, 473),
            (16, 'Guadeloupe', 'Guadeloupe', 1, 590),
            (17, 'Guatemala', 'Guatemala', 1, 502),
            (18, 'Haiti', 'Haiti', 1, 509),
            (19, 'Honduras', 'Honduras', 1, 503),
            (20, 'Jamaica', 'Jamaica', 1, 876),
            (21, 'Martinique', 'Martinique', 1, 596),
            (22, 'Mexico', 'Mexico', 1, 52),
            (23, 'Montserrat', 'Montserrat', 1, 664),
            (24, 'Nicaragua', 'Nicaragua', 1, 505),
            (25, 'Panama', 'Panama', 1, 507),
            (26, 'Puerto Rico', 'PuertoRico', 1, 787),
            (27, 'Trinidad and Tobago', 'Trinidad-Tobago', 1, 868),
            (28, 'United States Virgin Islands', 'USVI', 1, 340),
            (29, 'Argentina', 'Argentina', 2, 54),
            (30, 'Bolivia', 'Bolivia', 2, 591),
            (31, 'Brazil', 'Brazil', 2, 55),
            (32, 'Chile', 'Chile', 2, 56),
            (33, 'Colombia', 'Colombia', 2, 57),
            (34, 'Ecuador', 'Ecuador', 2, 593),
            (35, 'Falkland Islands', 'FalklandIsl', 2, 500),
            (36, 'French Guiana', 'FrenchGuiana', 2, 594),
            (37, 'Guyana', 'Guyana', 2, 592),
            (38, 'Paraguay', 'Paraguay', 2, 595),
            (39, 'Peru', 'Peru', 2, 51),
            (40, 'Suriname', 'Suriname', 2, 597),
            (41, 'Uruguay', 'Uruguay', 2, 598),
            (42, 'Venezuela', 'Venezuela', 2, 58),
            (43, 'Albania', 'Albania', 3, 355),
            (44, 'Andorra', 'Andorra', 3, 376),
            (45, 'Armenia', 'Armenia', 3, 374),
            (46, 'Austria', 'Austria', 3, 43),
            (47, 'Azerbaijan', 'Azerbaijan', 3, 994),
            (48, 'Belarus', 'Belarus', 3, 375),
            (49, 'Belgium', 'Belgium', 3, 32),
            (50, 'Bosnia and Herzegovina', 'Bosnia-Herzegovina', 3, 387),
            (51, 'Bulgaria', 'Bulgaria', 3, 359),
            (52, 'Croatia', 'Croatia', 3, 385),
            (53, 'Cyprus', 'Cyprus', 3, 357),
            (54, 'Czech Republic', 'CzechRep', 3, 420),
            (55, 'Denmark', 'Denmark', 3, 45),
            (56, 'Estonia', 'Estonia', 3, 372),
            (57, 'Finland', 'Finland', 3, 358),
            (58, 'France', 'France', 3, 33),
            (59, 'Georgia', 'Georgia', 3, 995),
            (60, 'Germany', 'Germany', 3, 49),
            (61, 'Gibraltar', 'Gibraltar', 3, 350),
            (62, 'Greece', 'Greece', 3, 30),
            (63, 'Guernsey', 'Guernsey', 3, 44),
            (64, 'Hungary', 'Hungary', 3, 36),
            (65, 'Iceland', 'Iceland', 3, 354),
            (66, 'Ireland', 'Ireland', 3, 353),
            (67, 'Isle of Man', 'IsleofMan', 3, 44),
            (68, 'Italy', 'Italy', 3, 39),
            (69, 'Jersey', 'Jersey', 3, 44),
            (70, 'Kosovo', 'Kosovo', 3, 381),
            (71, 'Latvia', 'Latvia', 3, 371),
            (72, 'Liechtenstein', 'Liechtenstein', 3, 423),
            (73, 'Lithuania', 'Lithuania', 3, 370),
            (74, 'Luxembourg', 'Luxembourg', 3, 352),
            (75, 'Macedonia', 'Macedonia', 3, 389),
            (76, 'Malta', 'Malta', 3, 356),
            (77, 'Moldova', 'Moldova', 3, 373),
            (78, 'Monaco', 'Monaco', 3, 377),
            (79, 'Montenegro', 'Montenegro', 3, 381),
            (80, 'Netherlands', 'Netherlands', 3, 31),
            (81, 'Norway', 'Norway', 3, 47),
            (82, 'Poland', 'Poland', 3, 48),
            (83, 'Portugal', 'Portugal', 3, 351),
            (84, 'Romania', 'Romania', 3, 40),
            (85, 'Russia', 'Russia', 3, 7),
            (86, 'San Marino', 'SanMarino', 3, 378),
            (87, 'Serbia', 'Serbia', 3, 381),
            (88, 'Slovakia', 'Slovakia', 3, 421),
            (89, 'Slovenia', 'Slovenia', 3, 386),
            (90, 'Spain', 'Spain', 3, 34),
            (91, 'Sweden', 'Sweden', 3, 46),
            (92, 'Switzerland', 'Switzerland', 3, 41),
            (93, 'Turkey', 'Turkey', 3, 90),
            (94, 'Ukraine', 'Ukraine', 3, 380),
            (95, 'United Kingdom', 'UK', 3, 44),
            (96, 'Vatican City', 'Vatican', 3, 39),
            (97, 'Afghanistan', 'Afghanistan', 4, 93),
            (98, 'Bahrain', 'Bahrain', 4, 973),
            (99, 'Bangladesh', 'Bangladesh', 4, 880),
            (100, 'Bhutan', 'Bhutan', 4, 975),
            (101, 'Brunei', 'Brunei', 4, 673),
            (102, 'Cambodia', 'Cambodia', 4, 855),
            (103, 'China', 'China', 4, 86),
            (104, 'East Timor', 'EastTimor', 4, 670),
            (105, 'Hong Kong', 'HongKong', 4, 852),
            (106, 'India', 'India', 4, 91),
            (107, 'Indonesia', 'Indonesia', 4, 62),
            (108, 'Iran', 'Iran', 4, 98),
            (109, 'Iraq', 'Iraq', 4, 964),
            (110, 'Israel', 'Israel', 4, 972),
            (111, 'Japan', 'Japan', 4, 81),
            (112, 'Jordan', 'Jordan', 4, 962),
            (113, 'Kazakhstan', 'Kazakhstan', 4, 7),
            (114, 'Kuwait', 'Kuwait', 4, 965),
            (115, 'Kyrgyzstan', 'Kyrgyzstan', 4, 996),
            (116, 'Laos', 'Laos', 4, 856),
            (117, 'Lebanon', 'Lebanon', 4, 961),
            (118, 'Macau', 'Macau', 4, 853),
            (119, 'Malaysia', 'Malaysia', 4, 60),
            (120, 'Maldives', 'Maldives', 4, 960),
            (121, 'Mongolia', 'Mongolia', 4, 976),
            (122, 'Myanmar (Burma)', 'Myanmar(Burma)', 4, 95),
            (123, 'Nepal', 'Nepal', 4, 977),
            (124, 'North Korea', 'NorthKorea', 4, 850),
            (125, 'Oman', 'Oman', 4, 968),
            (126, 'Pakistan', 'Pakistan', 4, 92),
            (127, 'Philippines', 'Philippines', 4, 63),
            (128, 'Qatar', 'Qatar', 4, 974),
            (129, 'Saudi Arabia', 'SaudiArabia', 4, 966),
            (130, 'Singapore', 'Singapore', 4, 65),
            (131, 'South Korea', 'SouthKorea', 4, 82),
            (132, 'Sri Lanka', 'SriLanka', 4, 94),
            (133, 'Syria', 'Syria', 4, 963),
            (134, 'Taiwan', 'Taiwan', 4, 886),
            (135, 'Tajikistan', 'Tajikistan', 4, 992),
            (136, 'Thailand', 'Thailand', 4, 66),
            (137, 'Turkmenistan', 'Turkmenistan', 4, 993),
            (138, 'United Arab Emirates', 'UAE', 4, 971),
            (139, 'Uzbekistan', 'Uzbekistan', 4, 998),
            (140, 'Vietnam', 'Vietnam', 4, 84),
            (141, 'Yemen', 'Yemen', 4, 967),
            (142, 'Algeria', 'Algeria', 5, 213),
            (143, 'Angola', 'Angola', 5, 244),
            (144, 'Benin', 'Benin', 5, 229),
            (145, 'Botswana', 'Botswana', 5, 267),
            (146, 'Burkina Faso', 'BurkinaFaso', 5, 226),
            (147, 'Burundi', 'Burundi', 5, 257),
            (148, 'Cameroon', 'Cameroon', 5, 237),
            (149, 'Cape Verde', 'CapeVerde', 5, 238),
            (150, 'Central African Republic', 'CentralAfricanRep', 5, 236),
            (151, 'Chad', 'Chad', 5, 235),
            (152, 'Congo-Brazzaville', 'Congo-Brazzaville', 5, 242),
            (153, 'Congo-Kinshasa', 'Congo-Kinshasa', 5, 242),
            (154, 'Djibouti', 'Djibouti', 5, 253),
            (155, 'Egypt', 'Egypt', 5, 20),
            (156, 'Equatorial Guinea', 'EquatorialGuinea', 5, 240),
            (157, 'Eritrea', 'Eritrea', 5, 291),
            (158, 'Ethiopia', 'Ethiopia', 5, 251),
            (159, 'Gabon', 'Gabon', 5, 241),
            (160, 'Gambia', 'Gambia', 5, 220),
            (161, 'Ghana', 'Ghana', 5, 233),
            (162, 'Guinea', 'Guinea', 5, 224),
            (163, 'Guinea-Bissau', 'Guinea-Bissau', 5, 245),
            (164, 'Ivory Coast', 'IvoryCoast', 5, 225),
            (165, 'Kenya', 'Kenya', 5, 254),
            (166, 'Lesotho', 'Lesotho', 5, 266),
            (167, 'Liberia', 'Liberia', 5, 231),
            (168, 'Libya', 'Libya', 5, 218),
            (169, 'Madagascar', 'Madagascar', 5, 261),
            (170, 'Malawi', 'Malawi', 5, 265),
            (171, 'Mali', 'Mali', 5, 223),
            (172, 'Mauritania', 'Mauritania', 5, 222),
            (173, 'Mauritius', 'Mauritius', 5, 230),
            (174, 'Morocco', 'Morocco', 5, 212),
            (175, 'Mozambique', 'Mozambique', 5, 258),
            (176, 'Namibia', 'Namibia', 5, 264),
            (177, 'Niger', 'Niger', 5, 227),
            (178, 'Nigeria', 'Nigeria', 5, 234),
            (179, 'Reunion', 'Reunion', 5, 262),
            (180, 'Rwanda', 'Rwanda', 5, 250),
            (181, 'Sao Tome and Principe', 'SaoTome-Principe', 5, 239),
            (182, 'Senegal', 'Senegal', 5, 221),
            (183, 'Seychelles', 'Seychelles', 5, 248),
            (184, 'Sierra Leone', 'SierraLeone', 5, 232),
            (185, 'Somalia', 'Somalia', 5, 252),
            (186, 'South Africa', 'SouthAfrica', 5, 27),
            (187, 'Sudan', 'Sudan', 5, 249),
            (188, 'Swaziland', 'Swaziland', 5, 268),
            (189, 'Tanzania', 'Tanzania', 5, 255),
            (190, 'Togo', 'Togo', 5, 228),
            (191, 'Tunisia', 'Tunisia', 5, 216),
            (192, 'Uganda', 'Uganda', 5, 256),
            (193, 'Western Sahara', 'WesternSahara', 5, 212),
            (194, 'Zambia', 'Zambia', 5, 260),
            (195, 'Zimbabwe', 'Zimbabwe', 5, 263),
            (196, 'Australia', 'Australia', 6, 61),
            (197, 'New Zealand', 'NewZealand', 6, 64),
            (198, 'Fiji', 'Fiji', 6, 679),
            (199, 'French Polynesia', 'FrenchPolynesia', 6, 689),
            (200, 'Guam', 'Guam', 6, 671),
            (201, 'Kiribati', 'Kiribati', 6, 686),
            (202, 'Marshall Islands', 'MarshallIsl', 6, 692),
            (203, 'Micronesia', 'Micronesia', 6, 691),
            (204, 'Nauru', 'Nauru', 6, 674),
            (205, 'New Caledonia', 'NewCaledonia', 6, 687),
            (206, 'Papua New Guinea', 'PapuaNewGuinea', 6, 675),
            (207, 'Samoa', 'Samoa', 6, 684),
            (208, 'Solomon Islands', 'SolomonIsl', 6, 677),
            (209, 'Tonga', 'Tonga', 6, 676),
            (210, 'Tuvalu', 'Tuvalu', 6, 688),
            (211, 'Vanuatu', 'Vanuatu', 6, 678),
            (212, 'Wallis and Futuna', 'Wallis-Futuna', 6, 681);

        ");

        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`education` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `education_name` varchar(255) NOT NULL,
              `status` enum('0','1') NOT NULL DEFAULT '1',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`email_history` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0',
              `last_ip` varchar(15) NOT NULL,
              `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `recievers_id` text NOT NULL,
              `subject` text NOT NULL,
              `message` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`flexigrid` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `model_name` varchar(255) NOT NULL,
              `column` varchar(256) NOT NULL,
              `user_id` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`inactive_email` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `candidate_id` int(11) NOT NULL,
              `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `last_ip` varchar(20) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        
        CREATE TABLE IF NOT EXISTS $db_name.`interviews_activity` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `last_ip` varchar(40) NOT NULL,
          `job_id` int(11) NOT NULL,
          `candidate_id` int(11) NOT NULL,
          `activity_id` int(11) NOT NULL,
          `is_schedule` enum('0','1') NOT NULL DEFAULT '1',
          `int_date` date NOT NULL,
          `int_hour` varchar(20) NOT NULL,
          `int_min` varchar(20) NOT NULL,
          `int_round` int(11) NOT NULL,
          `int_type` int(11) NOT NULL,
          `int_comment` text NOT NULL,
          `created_time` date NOT NULL,
          `modified_time` date NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`job_discussion` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `job_id` int(11) NOT NULL,
              `added_by` int(11) NOT NULL,
              `site_id` int(11) NOT NULL,
              `last_ip` varchar(15) NOT NULL,
              `job_title` varchar(300) NOT NULL,
              `comment` text NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `status` enum('0','1') NOT NULL DEFAULT '1',
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`job_order` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` datetime NOT NULL,
              `activity_time` datetime NOT NULL,
              `company_id` int(11) NOT NULL,
              `duration` varchar(64) NOT NULL,
              `contact_id` int(11) NOT NULL,
              `type` varchar(64) NOT NULL,
              `title` varchar(64) NOT NULL,
              `start_date` datetime DEFAULT NULL,
              `department_id` int(11) NOT NULL,
              `max_rate` varchar(50) NOT NULL,
              `country_id` int(11) NOT NULL,
              `state` int(11) NOT NULL,
              `city` varchar(25) NOT NULL,
              `salary` int(11) NOT NULL,
              `salary_lac` int(11) NOT NULL,
              `salary_thousend` int(11) NOT NULL,
              `openings` int(11) NOT NULL,
              `company_job_id` int(11) NOT NULL,
              `is_hot` int(1) NOT NULL DEFAULT '0',
              `public` int(1) NOT NULL DEFAULT '0',
              `erookie_public` tinyint(4) NOT NULL,
              `description` text NOT NULL,
              `key` varchar(255) NOT NULL,
              `third_party` varchar(255) NOT NULL,
              `notes` text NOT NULL,
              `status` int(11) NOT NULL DEFAULT '0',
              `status_view` int(11) NOT NULL DEFAULT '0',
              `notification` enum('0','1') NOT NULL DEFAULT '1',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
                    CREATE TABLE IF NOT EXISTS $db_name.`job_ordertemp` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `company_id` int(11) NOT NULL,
              `duration` varchar(64) NOT NULL,
              `contact_id` int(11) NOT NULL,
              `type` varchar(64) NOT NULL,
              `title` varchar(64) NOT NULL,
              `start_date` datetime NOT NULL,
              `department_id` int(11) NOT NULL,
              `max_rate` varchar(50) NOT NULL,
              `country_id` int(11) NOT NULL,
              `state` int(11) NOT NULL,
              `city` varchar(25) NOT NULL,
              `salary` int(11) NOT NULL,
              `openings` int(11) NOT NULL,
              `company_job_id` int(11) NOT NULL,
              `is_hot` int(1) NOT NULL DEFAULT '0',
              `public` int(1) NOT NULL DEFAULT '0',
              `description` text NOT NULL,
              `key` varchar(255) NOT NULL,
              `third_party` varchar(255) NOT NULL,
              `notes` text NOT NULL,
              `status` int(11) NOT NULL DEFAULT '0',
              `status_view` int(11) NOT NULL DEFAULT '0',
              `activity_time` datetime DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`job_order_activity` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `is_added` enum('0','1') NOT NULL DEFAULT '0',
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `job_order_id` int(11) NOT NULL DEFAULT '0',
              `candidate_id` int(11) NOT NULL DEFAULT '0',
              `status_id` int(11) NOT NULL DEFAULT '0',
              `is_submitted` varchar(100) NOT NULL,
              `activity_type` varchar(30) NOT NULL,
              `source` int(44) NOT NULL,
              `emp_email` varchar(255) NOT NULL,
              `buying_rates` varchar(255) NOT NULL,
              `notes` varchar(250) NOT NULL,
              `interview_Date` datetime NOT NULL,
              `time_zone` varchar(255) NOT NULL,
              `interview_type` int(10) NOT NULL,
              `interview_round` int(11) DEFAULT NULL,
              `interview_comment` varchar(250) NOT NULL,
              `Comment` longtext NOT NULL,
              `offered_date` datetime NOT NULL,
              `rate_margin` int(10) NOT NULL,
              `client_rate` int(10) NOT NULL DEFAULT '0',
              `is_public` int(1) NOT NULL DEFAULT '0',
              `Hours` int(11) NOT NULL,
              `Mint` int(11) NOT NULL,
              `attachment` varchar(200) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `job_order_id` (`job_order_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`job_order_activity_status_type` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(50) NOT NULL,
              `sort_code` int(11) NOT NULL,
              `sort_by` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`job_order_activity_status_type` (`id`, `name`, `sort_code`, `sort_by`) VALUES
        (1, 'No Contact', 1, 7),
        (2, 'Sales Reject', 6, 1),
        (3, 'Interview Reject ', 3, 6),
        (5, 'Submitted', 2, 2),
        (6, 'Interview', 4, 4),
        (7, 'Offered', 9, 8),
        (9, 'Offered Declined', 7, 9),
        (10, 'Client Screen Reject', 8, 3),
        (11, 'Candidate Join', 12, 10),
        (12, 'Interview Disappeared', 5, 5);

        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`job_order_assign_list` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `assign_user_id` int(11) NOT NULL,
              `assigned` enum('0','1') NOT NULL DEFAULT '0',
              `job_order_id` int(11) NOT NULL,
              `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
              `status_comment` varchar(250) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `job_order_id` (`job_order_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
            CREATE TABLE IF NOT EXISTS $db_name.`job_order_history` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `added_by` varchar(200) NOT NULL,
              `job_order_id` varchar(200) NOT NULL,
              `assign_group` int(11) NOT NULL,
              `assign_user` int(11) NOT NULL,
              `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `status` tinyint(4) NOT NULL,
              PRIMARY KEY (`id`),
              KEY `job_order_id` (`job_order_id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
            CREATE TABLE IF NOT EXISTS $db_name.`job_order_type` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(50) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");
        
          mysql_query("
            INSERT INTO $db_name.`job_order_type` (`id`, `name`) VALUES
            (1, 'Contract'),
            (2, 'Contact to hire'),
            (3, 'Full time');
        ");
        

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`job_status` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `job_status` varchar(250) NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `id` (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`job_status` (`id`, `job_status`) VALUES
        (1, 'Submitted feed back panding'),
        (2, 'Interview feed back panding'),
        (3, 'Inactive'),
        (0, 'Active');
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`job_status_view` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `job_status_view` varchar(250) NOT NULL,
          PRIMARY KEY (`id`),
          UNIQUE KEY `id` (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`job_status_view` (`id`, `job_status_view`) VALUES
        (1, 'Postion on hold'),
        (2, 'Client not respond'),
        (3, 'Candidate offered'),
        (4, 'Postion Dead'),
        (5, 'Candidate Join');

        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`location` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `p_id` varchar(20) NOT NULL,
              `name` varchar(255) NOT NULL,
              `location_type` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`location` (`id`, `p_id`, `name`, `location_type`) VALUES
            (1, '37', 'Andra Pradesh', 2),
            (2, '37', 'Arunachal Pradesh', 2),
            (3, '37', 'Assam', 2),
            (4, '37', 'Bihar', 2),
            (5, '37', 'Chhattisgarh', 2),
            (6, '37', 'Goa', 2),
            (7, '37', 'Gujarat', 2),
            (8, '37', 'Haryana', 2),
            (9, '37', 'Himachal Pradesh', 2),
            (10, '37', 'Jammu and Kashmir', 2),
            (11, '37', 'Jharkhand', 2),
            (12, '37', 'Karnataka', 2),
            (13, '37', 'Kerala', 2),
            (14, '37', 'Madya Pradesh', 2),
            (15, '37', 'Maharashtra', 2),
            (16, '37', 'Manipur', 2),
            (17, '37', 'Meghalaya', 2),
            (18, '37', 'Mizoram', 2),
            (19, '37', 'Nagaland', 2),
            (20, '37', 'Orissa', 2),
            (21, '37', 'Punjab', 2),
            (22, '37', 'Rajasthan', 2),
            (23, '37', 'Sikkim', 2),
            (24, '37', 'Tamil Nadu', 2),
            (25, '37', 'Tripura', 2),
            (26, '37', 'Uttaranchal', 2),
            (27, '37', 'Uttar Pradesh', 2),
            (28, '37', 'West Bengal', 2),
            (29, '37', 'Union Territories', 2),
            (30, '37', 'Andaman and Nicobar Islands', 2),
            (31, '37', 'Chandigarh', 2),
            (32, '37', 'Dadar and Nagar Haveli', 2),
            (33, '37', 'Daman and Diu', 2),
            (34, '37', 'Delhi', 2),
            (35, '37', 'Lakshadeep', 2),
            (36, '37', 'Pondicherry', 2),
            (37, '0', 'India', 1),
            (38, '0', 'United States', 1),
            (39, '0', 'Canada', 1),
            (40, '0', 'Bahamas', 1),
            (41, '0', 'Barbados', 1),
            (42, '0', 'Belize', 1),
            (43, '0', 'Bermuda', 1),
            (44, '0', 'British Virgin Islands', 1),
            (45, '0', 'Cayman Islands', 1),
            (46, '0', 'Costa Rica', 1),
            (47, '0', 'Cuba', 1),
            (48, '0', 'Dominica', 1),
            (49, '0', 'Dominican Republic', 1),
            (50, '0', 'El Salvador', 1),
            (51, '0', 'Greenland', 1),
            (52, '0', 'Grenada', 1),
            (53, '0', 'Guadeloupe', 1),
            (54, '0', 'Guatemala', 1),
            (55, '0', 'Haiti', 1),
            (56, '0', 'Honduras', 1),
            (57, '0', 'Jamaica', 1),
            (58, '0', 'Martinique', 1),
            (59, '0', 'Mexico', 1),
            (60, '0', 'Montserrat', 1),
            (61, '0', 'Nicaragua', 1),
            (62, '0', 'Panama', 1),
            (63, '0', 'Puerto Rico', 1),
            (64, '0', 'Trinidad and Tobago', 1),
            (65, '0', 'United States Virgin Islands', 1),
            (66, '0', 'Argentina', 1),
            (67, '0', 'Bolivia', 1),
            (68, '0', 'Brazil', 1),
            (69, '0', 'Chile', 1),
            (70, '0', 'Colombia', 1),
            (71, '0', 'Ecuador', 1),
            (72, '0', 'Falkland Islands', 1),
            (73, '0', 'French Guiana', 1),
            (74, '0', 'Guyana', 1),
            (75, '0', 'Paraguay', 1),
            (76, '0', 'Peru', 1),
            (77, '0', 'Suriname', 1),
            (78, '0', 'Uruguay', 1),
            (79, '0', 'Venezuela', 1),
            (80, '0', 'Albania', 1),
            (81, '0', 'Andorra', 1),
            (82, '0', 'Armenia', 1),
            (83, '0', 'Austria', 1),
            (84, '0', 'Azerbaijan', 1),
            (85, '0', 'Belarus', 1),
            (86, '0', 'Belgium', 1),
            (87, '0', 'Bosnia and Herzegovina', 1),
            (88, '0', 'Bulgaria', 1),
            (89, '0', 'Croatia', 1),
            (90, '0', 'Cyprus', 1),
            (91, '0', 'Czech Republic', 1),
            (92, '0', 'Denmark', 1),
            (93, '0', 'Estonia', 1),
            (94, '0', 'Finland', 1),
            (95, '0', 'France', 1),
            (96, '0', 'Georgia', 1),
            (97, '0', 'Germany', 1),
            (98, '0', 'Gibraltar', 1),
            (99, '0', 'Greece', 1),
            (100, '0', 'Guernsey', 1),
            (101, '0', 'Hungary', 1),
            (102, '0', 'Iceland', 1),
            (103, '0', 'Ireland', 1),
            (104, '0', 'Isle of Man', 1),
            (105, '0', 'Italy', 1),
            (106, '0', 'Jersey', 1),
            (107, '0', 'Kosovo', 1),
            (108, '0', 'Latvia', 1),
            (109, '0', 'Liechtenstein', 1),
            (110, '0', 'Lithuania', 1),
            (111, '0', 'Luxembourg', 1),
            (112, '0', 'Macedonia', 1),
            (113, '0', 'Malta', 1),
            (114, '0', 'Moldova', 1),
            (115, '0', 'Monaco', 1),
            (116, '0', 'Montenegro', 1),
            (117, '0', 'Netherlands', 1),
            (118, '0', 'Norway', 1),
            (119, '0', 'Poland', 1),
            (120, '0', 'Portugal', 1),
            (121, '0', 'Romania', 1),
            (122, '0', 'Russia', 1),
            (123, '0', 'San Marino', 1),
            (124, '0', 'Serbia', 1),
            (125, '0', 'Slovakia', 1),
            (126, '0', 'Slovenia', 1),
            (127, '0', 'Spain', 1),
            (128, '0', 'Sweden', 1),
            (129, '0', 'Switzerland', 1),
            (130, '0', 'Turkey', 1),
            (131, '0', 'Ukraine', 1),
            (132, '0', 'United Kingdom', 1),
            (133, '0', 'Vatican City', 1),
            (134, '0', 'Afghanistan', 1),
            (135, '0', 'Bahrain', 1),
            (136, '0', 'Bangladesh', 1),
            (137, '0', 'Bhutan', 1),
            (138, '0', 'Brunei', 1),
            (139, '0', 'Cambodia', 1),
            (140, '0', 'China', 1),
            (141, '0', 'East Timor', 1),
            (142, '0', 'Hong Kong', 1),
            (143, '0', 'Indonesia', 1),
            (144, '0', 'Iran', 1),
            (145, '0', 'Iraq', 1),
            (146, '0', 'Israel', 1),
            (147, '0', 'Japan', 1),
            (148, '0', 'Jordan', 1),
            (149, '0', 'Kazakhstan', 1),
            (150, '0', 'Kuwait', 1),
            (151, '0', 'Kyrgyzstan', 1),
            (152, '0', 'Laos', 1),
            (153, '0', 'Lebanon', 1),
            (154, '0', 'Macau', 1),
            (155, '0', 'Malaysia', 1),
            (156, '0', 'Maldives', 1),
            (157, '0', 'Mongolia', 1),
            (158, '0', 'Myanmar (Burma)', 1),
            (159, '0', 'Nepal', 1),
            (160, '0', 'North Korea', 1),
            (161, '0', 'Oman', 1),
            (162, '0', 'Pakistan', 1),
            (163, '0', 'Philippines', 1),
            (164, '0', 'Qatar', 1),
            (165, '0', 'Saudi Arabia', 1),
            (166, '0', 'Singapore', 1),
            (167, '0', 'South Korea', 1),
            (168, '0', 'Sri Lanka', 1),
            (169, '0', 'Syria', 1),
            (170, '0', 'Taiwan', 1),
            (171, '0', 'Tajikistan', 1),
            (172, '0', 'Thailand', 1),
            (173, '0', 'Turkmenistan', 1),
            (174, '0', 'United Arab Emirates', 1),
            (175, '0', 'Uzbekistan', 1),
            (176, '0', 'Vietnam', 1),
            (177, '0', 'Yemen', 1),
            (178, '0', 'Algeria', 1),
            (179, '0', 'Angola', 1),
            (180, '0', 'Benin', 1),
            (181, '0', 'Botswana', 1),
            (182, '0', 'Burkina Faso', 1),
            (183, '0', 'Burundi', 1),
            (184, '0', 'Cameroon', 1),
            (185, '0', 'Cape Verde', 1),
            (186, '0', 'Central African Republic', 1),
            (187, '0', 'Chad', 1),
            (188, '0', 'Congo-Brazzaville', 1),
            (189, '0', 'Congo-Kinshasa', 1),
            (190, '0', 'Djibouti', 1),
            (191, '0', 'Egypt', 1),
            (192, '0', 'Equatorial Guinea', 1),
            (193, '0', 'Eritrea', 1),
            (194, '0', 'Ethiopia', 1),
            (195, '0', 'Gabon', 1),
            (196, '0', 'Gambia', 1),
            (197, '0', 'Ghana', 1),
            (198, '0', 'Guinea', 1),
            (199, '0', 'Guinea-Bissau', 1),
            (200, '0', 'Ivory Coast', 1),
            (201, '0', 'Kenya', 1),
            (202, '0', 'Lesotho', 1),
            (203, '0', 'Liberia', 1),
            (204, '0', 'Libya', 1),
            (205, '0', 'Madagascar', 1),
            (206, '0', 'Malawi', 1),
            (207, '0', 'Mali', 1),
            (208, '0', 'Mauritania', 1),
            (209, '0', 'Mauritius', 1),
            (210, '0', 'Morocco', 1),
            (211, '0', 'Mozambique', 1),
            (212, '0', 'Namibia', 1),
            (213, '0', 'Niger', 1),
            (214, '0', 'Nigeria', 1),
            (215, '0', 'Reunion', 1),
            (216, '0', 'Rwanda', 1),
            (217, '0', 'Sao Tome and Principe', 1),
            (218, '0', 'Senegal', 1),
            (219, '0', 'Seychelles', 1),
            (220, '0', 'Sierra Leone', 1),
            (221, '0', 'Somalia', 1),
            (222, '0', 'South Africa', 1),
            (223, '0', 'Sudan', 1),
            (224, '0', 'Swaziland', 1),
            (225, '0', 'Tanzania', 1),
            (226, '0', 'Togo', 1),
            (227, '0', 'Tunisia', 1),
            (228, '0', 'Uganda', 1),
            (229, '0', 'Western Sahara', 1),
            (230, '0', 'Zambia', 1),
            (231, '0', 'Zimbabwe', 1),
            (232, '0', 'Australia', 1),
            (233, '0', 'New Zealand', 1),
            (234, '0', 'Fiji', 1),
            (235, '0', 'French Polynesia', 1),
            (236, '0', 'Guam', 1),
            (237, '0', 'Kiribati', 1),
            (238, '0', 'Marshall Islands', 1),
            (239, '0', 'Micronesia', 1),
            (240, '0', 'Nauru', 1),
            (241, '0', 'New Caledonia', 1),
            (242, '0', 'Papua New Guinea', 1),
            (243, '0', 'Samoa', 1),
            (244, '0', 'Solomon Islands', 1),
            (245, '0', 'Tonga', 1),
            (246, '0', 'Tuvalu', 1),
            (247, '0', 'Vanuatu', 1),
            (248, '0', 'Wallis and Futuna', 1),
            (249, '27', 'Agra', 3),
            (250, '27', 'Firozabad', 3),
            (251, '27', 'Mainpuri', 3),
            (252, '27', 'Mathura', 3),
            (253, '27', 'Aligarh', 3),
            (254, '27', 'Etah', 3),
            (255, '27', 'Hathras', 3),
            (256, '27', 'Kasganj', 3),
            (257, '27', 'Allahabad', 3),
            (258, '27', 'Fatehpur', 3),
            (259, '27', 'Kaushambi', 3),
            (260, '27', 'Pratapgarh', 3),
            (261, '27', 'Azamgarh', 3),
            (262, '27', 'Ballia', 3),
            (263, '27', 'Mau', 3),
            (264, '27', 'Badaun', 3),
            (265, '27', 'Bareilly', 3),
            (266, '27', 'Pilibhit', 3),
            (267, '27', 'Shahjahanpur', 3),
            (268, '27', 'Basti', 3),
            (269, '27', 'Sant Kabir Nagar', 3),
            (270, '27', 'Siddharthnagar', 3),
            (271, '27', 'Banda', 3),
            (272, '27', 'Chitrakoot', 3),
            (273, '27', 'Hamirpur', 3),
            (274, '27', 'Mahoba', 3),
            (275, '27', 'Bahraich', 3),
            (276, '27', 'Balarampur', 3),
            (277, '27', 'Gonda', 3),
            (278, '27', 'Shravasti', 3),
            (279, '27', 'Ambedkar Nagar', 3),
            (280, '27', 'Amethi', 3),
            (281, '27', 'Barabanki', 3),
            (282, '27', 'Faizabad', 3),
            (283, '27', 'Sultanpur', 3),
            (284, '27', 'Deoria', 3),
            (285, '27', 'Gorakhpur', 3),
            (286, '27', 'Kushinagar', 3),
            (287, '27', 'Maharajganj', 3),
            (288, '27', 'Jalaun', 3),
            (289, '27', 'Jhansi', 3),
            (290, '27', 'Lalitpur', 3),
            (291, '27', 'Auraiya', 3),
            (292, '27', 'Etawah', 3),
            (293, '27', 'Farrukhabad', 3),
            (294, '27', 'Kannauj', 3),
            (295, '27', 'Kanpur Dehat', 3),
            (296, '27', 'Kanpur Nagar', 3),
            (297, '27', 'Hardoi', 3),
            (298, '27', 'Lakhimpur Kheri', 3),
            (299, '27', 'Lucknow', 3),
            (300, '27', 'Raebareli', 3),
            (301, '27', 'Sitapur', 3),
            (302, '27', 'Unnao', 3),
            (303, '27', 'Bagpat', 3),
            (304, '27', 'Bulandshahr', 3),
            (305, '27', 'Gautam Buddha Nagar', 3),
            (306, '27', 'Ghaziabad', 3),
            (307, '27', 'Hapur', 3),
            (308, '27', 'Meerut', 3),
            (309, '27', 'Mirzapur', 3),
            (310, '27', 'Sant Ravidas Nagar', 3),
            (311, '27', 'Sonbhadra', 3),
            (312, '27', 'Amroha', 3),
            (313, '27', 'Bijnor', 3),
            (314, '27', 'Moradabad', 3),
            (315, '27', 'Rampur', 3),
            (316, '27', 'Sambhal', 3),
            (317, '27', 'Muzaffarnagar', 3),
            (318, '27', 'Shamli', 3),
            (319, '27', 'Saharanpur', 3),
            (320, '27', 'Chandauli', 3),
            (321, '27', 'Ghazipur', 3),
            (322, '27', 'Jaunpur', 3),
            (323, '27', 'Varanasi', 3),
            (324, '15', 'Mumbai', 3),
            (325, '28', 'Kolkata', 3),
            (326, '24', 'Chennai', 3),
            (327, '34', 'Delhi', 3),
            (328, '1', 'Adilabad', 3),
            (329, '1', 'Anantapur', 3),
            (330, '1', 'Chittoor', 3),
            (331, '1', 'East Godavari', 3),
            (332, '1', 'Guntur', 3),
            (333, '1', 'Hyderabad', 3),
            (334, '1', 'Cuddapah', 3),
            (335, '1', 'Karimnagar', 3),
            (336, '1', 'Khammam', 3),
            (337, '1', 'Krishna', 3),
            (338, '1', 'Kurnool', 3),
            (339, '1', 'Mahbubnagar', 3),
            (340, '1', 'Medak', 3),
            (341, '1', 'Nalgonda', 3),
            (342, '1', 'Nellore', 3),
            (343, '1', 'Nizamabad', 3),
            (344, '1', 'Prakasam', 3),
            (345, '1', 'Rangareddy', 3),
            (346, '1', 'Srikakulam', 3),
            (347, '1', 'Vishakhapatnam', 3),
            (348, '1', 'Vizianagaram', 3),
            (349, '1', 'Warangal', 3),
            (350, '1', 'West Godavari', 3),
            (351, '2', 'Anjaw', 3),
            (352, '2', 'Changlang', 3),
            (353, '2', 'East Kameng', 3),
            (354, '2', 'East Siang', 3),
            (355, '2', 'Lohit', 3),
            (356, '2', 'Lower Subansiri', 3),
            (357, '2', 'Papum Pare', 3),
            (358, '2', 'Tawang', 3),
            (359, '2', 'Tirap', 3),
            (360, '2', 'Lower Dibang Valley', 3),
            (361, '2', 'Upper Siang', 3),
            (362, '2', 'Upper Subansiri', 3),
            (363, '2', 'West Kameng', 3),
            (364, '2', 'West Siang', 3),
            (365, '2', 'Upper Dibang Valley', 3),
            (366, '2', 'Kurung Kumey', 3),
            (367, '34', 'Central Delhi', 3),
            (368, '34', 'North Delhi', 3),
            (369, '34', 'South Delhi', 3),
            (370, '34', 'East Delhi', 3),
            (371, '34', 'North East Delhi', 3),
            (372, '34', 'South West Delhi', 3),
            (373, '34', 'New Delhi', 3),
            (374, '34', 'North West Delhi', 3),
            (375, '34', 'West Delhi', 3),
            (376, '15', 'Ahmednagar', 3),
            (377, '15', 'Akola', 3),
            (378, '15', 'Amravati', 3),
            (379, '15', 'Aurangabad', 3),
            (380, '15', 'Beed', 3),
            (381, '15', 'Bhandara', 3),
            (382, '15', 'Buldhana', 3),
            (383, '15', 'Chandrapur', 3),
            (384, '15', 'Dhule', 3),
            (385, '15', 'Gadchirol', 3),
            (386, '15', 'Gondia', 3),
            (387, '15', 'Hingoli', 3),
            (388, '15', 'Jalgaon', 3),
            (389, '15', 'Jalna', 3),
            (390, '15', 'Kolhapur', 3),
            (391, '15', 'Latur', 3),
            (392, '15', 'Mumbai City', 3),
            (393, '15', 'Mumbai Suburban', 3),
            (394, '15', 'Nagpur', 3),
            (395, '15', 'Nanded', 3),
            (396, '15', 'Nandurbar', 3),
            (397, '15', 'Nashik', 3),
            (398, '15', 'Osmanabad', 3),
            (399, '15', 'Parbhani', 3),
            (400, '15', 'Pune', 3),
            (401, '15', 'Raigad', 3),
            (402, '15', 'Ratnagiri', 3),
            (403, '15', 'Sangli', 3),
            (404, '15', 'Satara', 3),
            (405, '15', 'Sindhudurg', 3),
            (406, '15', 'Solapur', 3),
            (407, '15', 'Thane', 3),
            (408, '15', 'Wardha', 3),
            (409, '15', 'Washim', 3),
            (410, '15', 'Yavatmal', 3),
            (411, '11', 'Garhwa', 3),
            (412, '11', 'Palamu', 3),
            (413, '11', 'Latehar', 3),
            (414, '11', 'Chatra', 3),
            (415, '11', 'Hazaribagh', 3),
            (416, '11', 'Koderma', 3),
            (417, '11', 'Giridih', 3),
            (418, '11', 'Ramgarh', 3),
            (419, '11', 'Bokaro', 3),
            (420, '11', 'Dhanbad', 3),
            (421, '11', 'Lohardaga', 3),
            (422, '11', 'Gumla', 3),
            (423, '11', 'Simdega', 3),
            (424, '11', 'Ranchi', 3),
            (425, '11', 'Khunti', 3),
            (426, '11', 'West Singhbhum', 3),
            (427, '11', 'Saraikela Kharsawan', 3),
            (428, '11', 'East Singhbhum', 3),
            (429, '11', 'Jamtara', 3),
            (430, '11', 'Jamtara', 3),
            (431, '11', 'Deoghar', 3),
            (432, '11', 'Dumka', 3),
            (433, '11', 'Pakur', 3),
            (434, '11', 'Godda', 3),
            (435, '11', 'Sahebganj', 3),
            (436, '6', 'Panaji', 3),
            (437, '6', 'Margao', 3),
            (438, '7', 'Ahmedabad', 3),
            (439, '7', 'Amreli', 3),
            (440, '7', 'Anand', 3),
            (441, '7', 'Aravalli', 3),
            (442, '7', 'Banaskantha', 3),
            (443, '7', 'Bharuch', 3),
            (444, '7', 'Bhavnagar', 3),
            (445, '7', 'Dahod', 3),
            (446, '7', 'Dang', 3),
            (447, '7', 'Gandhinagar', 3),
            (448, '7', 'Junagadh', 3),
            (449, '7', 'Kutch', 3),
            (450, '7', 'Kheda', 3),
            (451, '7', 'Mahisagar', 3),
            (452, '7', 'Mehsana', 3),
            (453, '7', 'Narmada', 3),
            (454, '7', 'Navsari', 3),
            (455, '7', 'Panchmahal', 3),
            (456, '7', 'Patan', 3),
            (457, '7', 'Porbandar', 3),
            (458, '7', 'Rajkot', 3),
            (459, '7', 'Sabarkantha', 3),
            (460, '7', 'Surat', 3),
            (461, '7', 'Surendranagar', 3),
            (462, '7', 'Tapi', 3),
            (463, '7', 'Vadodara', 3),
            (464, '7', 'Valsad', 3),
            (465, '8', 'Ambala', 3),
            (466, '8', 'Bhiwani', 3),
            (467, '8', 'Faridabad', 3),
            (468, '8', 'Fatehabad', 3),
            (469, '8', 'Gurgaon', 3),
            (470, '8', 'Hisar', 3),
            (471, '8', 'Jhajjar', 3),
            (472, '8', 'Jind', 3),
            (473, '8', 'Kaithal', 3),
            (474, '8', 'Karnal', 3),
            (475, '8', 'Kurukshetra', 3),
            (476, '8', 'Mahendragarh', 3),
            (477, '8', 'Mewat', 3),
            (478, '8', 'Palwal', 3),
            (479, '8', 'Panchkula', 3),
            (480, '8', 'Panipat', 3),
            (481, '8', 'Rewari', 3),
            (482, '8', 'Rohtak', 3),
            (483, '8', 'Sirsa', 3),
            (484, '8', 'Sonipat', 3),
            (485, '8', 'Yamuna Nagar', 3),
            (486, '3', 'Dispur', 3),
            (487, '3', 'Guwahati', 3),
            (488, '3', 'Tezpur', 3),
            (489, '4', 'Gaya', 3),
            (490, '4', 'Patna', 3),
            (491, '4', 'Vaishali', 3),
            (492, '4', 'Nalanda', 3),
            (493, '4', 'Rajgir', 3),
            (494, '9', 'Shimla', 3),
            (495, '9', 'Dharamsala', 3),
            (496, '9', 'Kullu', 3),
            (497, '9', 'Manali', 3),
            (498, '10', 'Gulmarg', 3),
            (499, '10', 'Jammu', 3),
            (500, '10', 'Pahalgam', 3),
            (501, '10', 'Ladakh', 3),
            (502, '10', 'Leh', 3),
            (503, '10', 'Srinagar', 3),
            (504, '12', 'Bangalore', 3),
            (505, '12', 'Hassan', 3),
            (506, '12', 'Mysore', 3),
            (507, '12', 'Hampi', 3),
            (508, '12', 'Mangalore', 3),
            (509, '12', 'Udupi', 3),
            (510, '13', 'Alleppey', 3),
            (511, '13', 'Kovalam', 3),
            (512, '13', 'Quilon', 3),
            (513, '13', 'Cochin', 3),
            (514, '13', 'Kozhikode', 3),
            (515, '13', 'Thekkady', 3),
            (516, '13', 'Kumarakom', 3),
            (517, '13', 'Munnar', 3),
            (518, '13', 'Trivandrum', 3),
            (519, '14', 'Bhopal', 3),
            (520, '14', 'Gwalior', 3),
            (521, '14', 'Khajuraho', 3),
            (522, '14', 'Indore', 3),
            (523, '14', 'Orchha', 3),
            (524, '14', 'Jabalpur', 3),
            (525, '14', 'Ujjain', 3),
            (526, '16', 'Imphal', 3),
            (527, '16', 'Senapati', 3),
            (528, '16', 'Ukhrul', 3),
            (529, '17', 'Shillong', 3),
            (530, '18', 'Aizawl', 3),
            (531, '19', 'Kohima', 3),
            (532, '20', 'Bhubaneswar', 3),
            (533, '20', 'Konark', 3),
            (534, '20', 'Puri', 3),
            (535, '20', 'Cuttack', 3),
            (536, '21', 'Amritsar', 3),
            (537, '21', 'Ludhiana', 3),
            (538, '21', 'Patiala', 3),
            (539, '21', 'Chandigarh', 3),
            (540, '22', 'Ajmer', 3),
            (541, '22', 'Jaipur', 3),
            (542, '22', 'Ranakpur', 3),
            (543, '22', 'Alwar', 3),
            (544, '22', 'Jaisalmer', 3),
            (545, '22', 'Shekhawati', 3),
            (546, '22', 'Bikaner', 3),
            (547, '22', 'Jodhpur', 3),
            (548, '22', 'Udaipur', 3),
            (549, '22', 'Bundi', 3),
            (550, '23', 'Gangtok', 3),
            (551, '24', 'Chennai', 3),
            (552, '24', 'Coimbatore', 3),
            (553, '24', 'Kanyakumari', 3),
            (554, '24', 'Kodaikanal', 3),
            (555, '24', 'Madurai', 3),
            (556, '24', 'Ooty', 3),
            (557, '24', 'Rameshwaram', 3),
            (558, '24', 'Thanjavur', 3),
            (559, '24', 'Trichy', 3),
            (560, '25', 'Agartala', 3),
            (561, '26', 'Dehradun', 3),
            (562, '26', 'Haridwar', 3),
            (563, '26', 'Nainital', 3),
            (564, '27', 'Rishikesh', 3),
            (565, '28', 'Burdwan', 3),
            (566, '28', 'Darjeeling', 3),
            (567, '28', 'Durgapur', 3),
            (568, '28', 'Kolkata', 3),
            (569, '28', 'Murshidabad', 3),
            (570, '30', 'North and Middle Andaman district', 3),
            (571, '30', 'South Andaman district', 3),
            (572, '30', 'Nicobar district', 3),
            (573, '31', 'Chandigarh', 3),
            (574, '32', 'Dadra and Nagar Haveli', 3),
            (575, '33', 'Daman', 3),
            (576, '33', 'Diu', 3),
            (577, '35', 'Lakshadweep', 3),
            (578, '36', 'Karaikal', 3),
            (579, '36', 'Mahe', 3),
            (580, '36', 'Pondicherry', 3),
            (581, '36', 'Yanam', 3),
            (582, '21', 'Mohali', 3),
            (583, '1', 'Tirupati', 3),
            (584, '1', 'Vijaywada', 3),
            (585, '5', 'Raipur', 3),
            (586, '5', 'Chattisgarh', 3);

        ");


        mysql_query("        
        CREATE TABLE IF NOT EXISTS $db_name.`newsletter` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `name` varchar(200) NOT NULL,
          `email` varchar(100) NOT NULL,
          `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` int(11) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`per_page` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` varchar(255) NOT NULL,
              `action` varchar(255) NOT NULL,
              `records` varchar(255) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`pipeline_history` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` varchar(50) NOT NULL,
              `added_by` varchar(50) NOT NULL,
              `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
              `modified_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
              `job_order_id` varchar(50) NOT NULL,
              `candidate_id` varchar(50) NOT NULL,
              `status_id` varchar(50) NOT NULL,
              `comment` text NOT NULL,
              `status` varchar(50) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`regions` (
              `id` smallint(8) NOT NULL DEFAULT '0',
              `name` varchar(35) COLLATE utf8_unicode_ci DEFAULT NULL,
              `shortRegion` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
              `country_id` smallint(9) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
        ");

        mysql_query("
        INSERT INTO $db_name.`regions` (`id`, `name`, `shortRegion`, `country_id`) VALUES
        (1, 'Alabama', 'AL', 1),
        (2, 'Alaska', 'AK', 1),
        (3, 'Arizona', 'AZ', 1),
        (4, 'Arkansas', 'AR', 1),
        (5, 'California', 'CA', 1),
        (6, 'Colorado', 'CO', 1),
        (7, 'Connecticut', 'CT', 1),
        (8, 'Delaware', 'DE', 1),
        (9, 'District of Columbia', 'DC', 1),
        (10, 'Florida', 'FL', 1),
        (11, 'Georgia', 'GA', 1),
        (12, 'Hawaii', 'HI', 1),
        (13, 'Idaho', 'ID', 1),
        (14, 'Illinois', 'IL', 1),
        (15, 'Indiana', 'IN', 1),
        (16, 'Iowa', 'IA', 1),
        (17, 'Kansas', 'KS', 1),
        (18, 'Kentucky', 'KY', 1),
        (19, 'Louisiana', 'LA', 1),
        (20, 'Maine', 'ME', 1),
        (21, 'Maryland', 'MD', 1),
        (22, 'Massachusetts', 'MA', 1),
        (23, 'Michigan', 'MI', 1),
        (24, 'Minnesota', 'MN', 1),
        (25, 'Mississippi', 'MS', 1),
        (26, 'Missouri', 'MO', 1),
        (27, 'Montana', 'MT', 1),
        (28, 'Nebraska', 'NE', 1),
        (29, 'Nevada', 'NV', 1),
        (30, 'New Hampshire', 'NH', 1),
        (31, 'New Jersey', 'NJ', 1),
        (32, 'New Mexico', 'NM', 1),
        (33, 'New York', 'NY', 1),
        (34, 'North Carolina', 'NC', 1),
        (35, 'North Dakota', 'ND', 1),
        (36, 'Ohio', 'OH', 1),
        (37, 'Oklahoma', 'OK', 1),
        (38, 'Oregon', 'OR', 1),
        (39, 'Pennsylvania', 'PA', 1),
        (40, 'Rhode Island', 'RI', 1),
        (41, 'South Carolina', 'SC', 1),
        (42, 'South Dakota', 'SD', 1),
        (43, 'Tennessee', 'TN', 1),
        (44, 'Texas', 'TX', 1),
        (45, 'Utah', 'UT', 1),
        (46, 'Vermont', 'VT', 1),
        (47, 'Virginia', 'VA', 1),
        (48, 'Washington', 'WA', 1),
        (49, 'West Virginia', 'WV', 1),
        (50, 'Wisconsin', 'WI', 1),
        (51, 'Wyoming', 'WY', 1),
        (52, 'Alberta', 'AB', 2),
        (53, 'British Columbia', 'BC', 2),
        (54, 'Manitoba', 'MB', 2),
        (55, 'New Brunswick', 'NB', 2),
        (56, 'Newfoundland and Labrador', 'NL', 2),
        (57, 'Northwest Territories', 'NT', 2),
        (58, 'Nova Scotia', 'NS', 2),
        (59, 'Nunavut', 'NU', 2),
        (60, 'Ontario', 'ON', 2),
        (61, 'Prince Edward Island', 'PE', 2),
        (62, 'Quebec', 'QC', 2),
        (63, 'Saskatchewan', 'SK', 2),
        (64, 'Yukon', 'YT', 2),
        (65, 'England', 'England', 95),
        (66, 'Northern Ireland', 'NorthernIreland', 95),
        (67, 'Scotland', 'Scottland', 95),
        (68, 'Wales', 'Wales', 95);

        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`report` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `added_by` int(11) NOT NULL,
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `uri` varchar(50) NOT NULL,
              `action` int(5) NOT NULL,
              `action_id` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`salary` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `salary` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`salary` (`id`, `salary`) VALUES
            (1, 0),
            (2, 1),
            (3, 2),
            (4, 3),
            (5, 4),
            (6, 5),
            (7, 6),
            (8, 7),
            (9, 8),
            (10, 9),
            (11, 10),
            (12, 11),
            (13, 12),
            (14, 13),
            (15, 14),
            (16, 15),
            (17, 16),
            (18, 17),
            (19, 18),
            (20, 19),
            (21, 20),
            (22, 21),
            (23, 22),
            (24, 23),
            (25, 24),
            (26, 25),
            (27, 26),
            (28, 27),
            (29, 28),
            (30, 29),
            (31, 30),
            (32, 31),
            (33, 32),
            (34, 33),
            (35, 34),
            (36, 35),
            (37, 36),
            (38, 37),
            (39, 38),
            (40, 39),
            (41, 40),
            (42, 41),
            (43, 42),
            (44, 43),
            (45, 44),
            (46, 45),
            (47, 46),
            (48, 47),
            (49, 48),
            (50, 49),
            (51, 50),
            (52, 51),
            (53, 52),
            (54, 53),
            (55, 54),
            (56, 55),
            (57, 56),
            (58, 57),
            (59, 58),
            (60, 59),
            (61, 60),
            (62, 61),
            (63, 62),
            (64, 63),
            (65, 64),
            (66, 65),
            (67, 66),
            (68, 67),
            (69, 68),
            (70, 69),
            (71, 70),
            (72, 71),
            (73, 72),
            (74, 73),
            (75, 74),
            (76, 75),
            (77, 76),
            (78, 77),
            (79, 78),
            (80, 79),
            (81, 80),
            (82, 81),
            (83, 82),
            (84, 83),
            (85, 84),
            (86, 85),
            (87, 86),
            (88, 87),
            (89, 88),
            (90, 89),
            (91, 90),
            (92, 91),
            (93, 92),
            (94, 93),
            (95, 94),
            (96, 95),
            (97, 96),
            (98, 97),
            (99, 98),
            (100, 99);

        ");


        mysql_query("
        
        CREATE TABLE IF NOT EXISTS $db_name.`site` (
              `id` int(3) NOT NULL,
              `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User Id',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` datetime NOT NULL,
              `name` varchar(60) NOT NULL,
              `email` varchar(50) NOT NULL,
              `description` varchar(200) NOT NULL,
              `website` varchar(60) NOT NULL,
              `language` varchar(200) NOT NULL,
              `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
              `status_comment` varchar(250) NOT NULL,
              `is_super` int(1) NOT NULL DEFAULT '0',
              `is_customer` enum('0','1') NOT NULL,
              `customer_id` int(11) NOT NULL,
              `account_type` tinyint(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`site_activity` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` datetime NOT NULL,
              `user_id` int(11) NOT NULL DEFAULT '0',
              `table_name` varchar(64) NOT NULL,
              `row_id` int(11) NOT NULL,
              `action` int(3) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`source` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(25) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`source` (`id`, `name`) VALUES
        (1, 'NAUKRI'),
        (2, 'MONSTER'),
        (3, 'HOT JOBS'),
        (4, 'THIRDPARTY'),
        (5, 'REFERAL'),
        (6, 'LINKED IN');

        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`temp_attachments` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) DEFAULT '0',
          `added_by` int(11) DEFAULT '0',
          `last_ip` varchar(15) DEFAULT NULL,
          `created_time` datetime DEFAULT NULL,
          `modified_time` datetime DEFAULT NULL,
          `candidate_id` int(11) NOT NULL DEFAULT '0',
          `text` longtext NOT NULL,
          `file_name` varchar(100) NOT NULL,
          `file_size` float NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`time_zone` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(25) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");

        mysql_query("
        INSERT INTO $db_name.`time_zone` (`id`, `name`) VALUES
        (1, 'EST'),
        (2, 'CST'),
        (3, 'MST'),
        (4, 'PST'),
        (5, 'IST');

        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`tmp_email_to_send` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `last_ip` varchar(20) NOT NULL,
          `recievers_id` text NOT NULL,
          `subject` text NOT NULL,
          `message` text NOT NULL,
          `created_time` datetime NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                    
        CREATE TABLE IF NOT EXISTS $db_name.`training` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `tr_category_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `site_id` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `name` varchar(255) NOT NULL,
          `title` varchar(255) NOT NULL,
          `description` text NOT NULL,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`training_category` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `added_by` int(11) NOT NULL,
          `site_id` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `category_name` varchar(255) NOT NULL,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0',
          `last_ip` varchar(15) COLLATE utf8_bin NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `group_id` int(11) NOT NULL DEFAULT '0',
          `extra_group_id` varchar(100) COLLATE utf8_bin NOT NULL,
          `ip_based` text COLLATE utf8_bin NOT NULL,
          `parent_user_id` int(11) NOT NULL DEFAULT '0',
          `first_name` varchar(16) COLLATE utf8_bin NOT NULL,
          `last_name` varchar(16) COLLATE utf8_bin NOT NULL,
          `profile_image` varchar(250) COLLATE utf8_bin NOT NULL,
          `password` varchar(200) COLLATE utf8_bin NOT NULL,
          `email` varchar(100) COLLATE utf8_bin NOT NULL,
          `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` enum('active','inactive','banned') COLLATE utf8_bin NOT NULL DEFAULT 'inactive',
          `status_comment` varchar(250) COLLATE utf8_bin NOT NULL,
          `designation` varchar(255) COLLATE utf8_bin NOT NULL,
          `phone_number` varchar(25) COLLATE utf8_bin NOT NULL,
          `cell_number` varchar(25) COLLATE utf8_bin NOT NULL,
          `fax_number` varchar(25) COLLATE utf8_bin NOT NULL,
          `company_name` varchar(255) COLLATE utf8_bin NOT NULL,
          `certification` varchar(255) COLLATE utf8_bin NOT NULL,
          `company_url` varchar(255) COLLATE utf8_bin NOT NULL,
          `disclaimer` text COLLATE utf8_bin NOT NULL,
          `static_ip` varchar(20) COLLATE utf8_bin NOT NULL,
          `login_type` enum('0','1','2','3') COLLATE utf8_bin NOT NULL DEFAULT '0',
          `dynamic_key` varchar(200) COLLATE utf8_bin DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`site_activity` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0',
          `last_ip` varchar(15) NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `user_id` int(11) NOT NULL DEFAULT '0',
          `table_name` varchar(64) NOT NULL,
          `row_id` int(11) NOT NULL,
          `action` int(3) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
                
        CREATE TABLE IF NOT EXISTS $db_name.`source` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `name` varchar(25) DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("        
        CREATE TABLE IF NOT EXISTS $db_name.`temp_attachments` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) DEFAULT '0',
          `added_by` int(11) DEFAULT '0',
          `last_ip` varchar(15) DEFAULT NULL,
          `created_time` datetime DEFAULT NULL,
          `modified_time` datetime DEFAULT NULL,
          `candidate_id` int(11) NOT NULL DEFAULT '0',
          `text` longtext NOT NULL,
          `file_name` varchar(100) NOT NULL,
          `file_size` float NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`time_zone` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(25) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;  
        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`tmp_email_to_send` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `last_ip` varchar(20) NOT NULL,
          `recievers_id` text NOT NULL,
          `subject` text NOT NULL,
          `message` text NOT NULL,
          `created_time` datetime NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`training` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `tr_category_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `site_id` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `name` varchar(255) NOT NULL,
          `title` varchar(255) NOT NULL,
          `description` text NOT NULL,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`training_category` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `added_by` int(11) NOT NULL,
          `site_id` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `category_name` varchar(255) NOT NULL,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`users` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0',
          `last_ip` varchar(15) COLLATE utf8_bin NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `group_id` int(11) NOT NULL DEFAULT '0',
          `extra_group_id` varchar(100) COLLATE utf8_bin NOT NULL,
          `ip_based` text COLLATE utf8_bin NOT NULL,
          `parent_user_id` int(11) NOT NULL DEFAULT '0',
          `first_name` varchar(16) COLLATE utf8_bin NOT NULL,
          `last_name` varchar(16) COLLATE utf8_bin NOT NULL,
          `profile_image` varchar(250) COLLATE utf8_bin NOT NULL,
          `password` varchar(200) COLLATE utf8_bin NOT NULL,
          `email` varchar(100) COLLATE utf8_bin NOT NULL,
          `last_login` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` enum('active','inactive','banned') COLLATE utf8_bin NOT NULL DEFAULT 'inactive',
          `status_comment` varchar(250) COLLATE utf8_bin NOT NULL,
          `designation` varchar(255) COLLATE utf8_bin NOT NULL,
          `phone_number` varchar(25) COLLATE utf8_bin NOT NULL,
          `cell_number` varchar(25) COLLATE utf8_bin NOT NULL,
          `fax_number` varchar(25) COLLATE utf8_bin NOT NULL,
          `company_name` varchar(255) COLLATE utf8_bin NOT NULL,
          `certification` varchar(255) COLLATE utf8_bin NOT NULL,
          `company_url` varchar(255) COLLATE utf8_bin NOT NULL,
          `disclaimer` text COLLATE utf8_bin NOT NULL,
          `static_ip` varchar(20) COLLATE utf8_bin NOT NULL,
          `login_type` enum('0','1','2','3') COLLATE utf8_bin NOT NULL DEFAULT '0',
          `dynamic_key` varchar(200) COLLATE utf8_bin DEFAULT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_groups` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0',
          `last_ip` varchar(15) NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `name` varchar(25) NOT NULL,
          `parent_group_id` int(2) NOT NULL DEFAULT '0',
          `description` varchar(250) NOT NULL,
          `status` enum('active','inactive','banned') NOT NULL DEFAULT 'inactive',
          `is_super` int(1) NOT NULL DEFAULT '0',
          PRIMARY KEY (`id`)
        ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_group_permissions` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `group_id` int(11) NOT NULL,
              `uri` text NOT NULL,
              `data` longtext NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_interview_setting` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `last_ip` int(11) NOT NULL,
          `user_id` int(11) NOT NULL,
          `interview` int(11) NOT NULL,
          `int_duration` int(11) NOT NULL,
          `int_achievement` varchar(25) NOT NULL,
          `int_achieve_duration` int(11) NOT NULL,
          `int_mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_report_type` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(4) NOT NULL,
          `user_id` int(11) NOT NULL,
          `search_type` varchar(20) NOT NULL,
          `year` int(11) NOT NULL,
          `month` varchar(4) NOT NULL,
          `day` int(4) NOT NULL,
          `chart_list` varchar(200) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_send_mail_setting` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `user_id` int(11) NOT NULL,
          `send_mail_max_limit` int(11) NOT NULL,
          `send_mail_target` int(11) NOT NULL,
          `send_mail_duration` int(11) NOT NULL,
          `send_mail_achievement` varchar(25) NOT NULL,
          `send_mail_achieve_duration` int(11) NOT NULL,
          `send_mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("        
            CREATE TABLE IF NOT EXISTS $db_name.`user_setting` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL,
              `added_by` int(11) NOT NULL,
              `last_ip` int(11) NOT NULL,
              `user_id` int(11) NOT NULL,
              `submission` int(11) NOT NULL,
              `min_achievement` varchar(25) NOT NULL,
              `mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
              `duration` int(11) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              `status` enum('0','1') NOT NULL DEFAULT '1',
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_sign` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user_id` int(11) NOT NULL,
              `sign_field` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`user_submission_setting` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL,
          `added_by` int(11) NOT NULL,
          `last_ip` varchar(15) NOT NULL,
          `user_id` int(11) NOT NULL,
          `submission` int(11) NOT NULL,
          `sub_duration` int(11) NOT NULL,
          `sub_achievement` varchar(25) NOT NULL,
          `sub_achieve_duration` int(11) NOT NULL,
          `sub_mail_deliever` enum('0','1') NOT NULL DEFAULT '1',
          `created_time` datetime NOT NULL,
          `modified_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
          `status` enum('0','1') NOT NULL DEFAULT '1',
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`vendor` (
          `id` int(11) NOT NULL AUTO_INCREMENT,
          `site_id` int(11) NOT NULL DEFAULT '0',
          `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
          `last_ip` varchar(15) NOT NULL,
          `created_time` datetime NOT NULL,
          `modified_time` datetime NOT NULL,
          `company_name` varchar(250) DEFAULT NULL,
          `company_website` varchar(250) NOT NULL,
          `email_id` varchar(100) DEFAULT NULL,
          `primary_phone` varchar(15) DEFAULT NULL,
          `secondary_phone` varchar(15) DEFAULT NULL,
          `name` varchar(50) DEFAULT NULL,
          `fax_num` varchar(20) DEFAULT NULL,
          `address` longtext,
          `city` varchar(25) NOT NULL,
          `state` varchar(25) NOT NULL,
          `country_id` int(4) NOT NULL,
          `postal_code` varchar(10) NOT NULL,
          `MSA` int(1) NOT NULL DEFAULT '0',
          `msa_upload` varchar(400) NOT NULL,
          `NCA` int(250) NOT NULL DEFAULT '0',
          `key_technologies` longtext NOT NULL,
          `notes` longtext NOT NULL,
          `status` varchar(250) NOT NULL,
          PRIMARY KEY (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`vendor_companies` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `site_id` int(11) NOT NULL DEFAULT '0',
              `added_by` int(11) NOT NULL DEFAULT '0' COMMENT 'User ID',
              `last_ip` varchar(15) NOT NULL,
              `created_time` datetime NOT NULL,
              `modified_time` datetime NOT NULL,
              `name` varchar(250) NOT NULL,
              `website` varchar(250) NOT NULL,
              `status` varchar(100) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");


        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`visa_type` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `visa_type` varchar(255) NOT NULL,
              UNIQUE KEY `visa_type` (`visa_type`),
              UNIQUE KEY `visa_type_2` (`visa_type`),
              UNIQUE KEY `id` (`id`)
            ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

        ");

        mysql_query("
        INSERT INTO $db_name.`visa_type` (`id`, `visa_type`) VALUES
        (1, 'H1 B'),
        (2, 'OPT'),
        (3, 'L1'),
        (4, 'L2EAD'),
        (5, 'GCEAD'),
        (6, 'GC'),
        (7, 'USC'),
        (8, 'Canada Citizen '),
        (9, 'E1');
        ");

        mysql_query("
        CREATE TABLE IF NOT EXISTS $db_name.`work_status` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `name` varchar(25) DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
        ");

        mysql_query("
        INSERT INTO $db_name.`work_status` (`id`, `name`) VALUES
            (1, 'Corp to Corp'),
            (2, 'W2'),
            (3, 'Full time'),
            (4, '1099');
        ");


    }
}
