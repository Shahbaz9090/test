<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Database helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc 
 * @since		Version 1.0
 */
// ------------------------------------------------------------------------

if (!function_exists('isProtected')) {
    function isProtected() {
        $CI = &get_instance();
        if ($CI->session->userdata('isLogin') != "yes") {
            redirect(base_url('auth'));
        } else
            return true;
    }
}

if (!function_exists('isPostBack')) {
    function isPostBack() {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return true;
        else
            return false;
    }
}

/**
 * Current User Info 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('currentuserinfo')) {
    function currentuserinfo() {
        $CI = &get_instance();
        return $CI->session->userdata("userinfo");
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
 * get_user_data 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('get_user_data')) {
    function get_user_data($id = null) {
        $CI = &get_instance();
        $CI->db->select('users.*,CONCAT(users.first_name," ",users.last_name) as name,user_groups.name as group_name',false);
        $CI->db->where('users.id', $id);
        $CI->db->join('user_groups', 'user_groups.id=users.group_id');
        $CI->db->limit(1);
        $query = $CI->db->get('users');
        return $query->row();
    }
}

/**
 * group data 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('get_groups')) {
    function get_groups() {
        $CI = &get_instance();
        $CI->db->order_by('id', 'asc');
        $query = $CI->db->get('user_groups');
        return $query->result();
    }
}

/**
 * User Group 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('user_group')) {
    function user_group() {
        $CI = &get_instance();
        $CI->db->order_by('id', 'desc');
        $query = $CI->db->get('user_groups');
        return $query->result();
    }
}

/**
 * Current User Id 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('currentUserID')) {
    function currentUserID() {
        $CI = &get_instance();
        return $CI->session->userdata("userinfo")->id;
    }
}

/**
 * Current User Id 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('usersList')) {
    function usersList($type = null) {
        $CI = &get_instance();
        $CI->db->select("*,CONCAT(first_name,' ',last_name) as name", false);
        $CI->db->order_by('id', 'desc');
        if ($type) {
            $CI->db->where('group_id', $type);
        }
        $query = $CI->db->get('users');
        if ($query->num_rows) {
            return $query->result();
        }
        return false;
    }
}

/**
 * 
 * is super admin
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('_isSuperAdmin')) {
    function _isSuperAdmin() {
        $CI = &get_instance();
        $userInfo = currentuserinfo();
        return ($userInfo->group_id == 1) ? true : false;
    }
}

/**
 * 
 * _isTaleMarketer
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('_isTaleMarketer')) {
    function _isTaleMarketer() {
        $CI = &get_instance();
        $userInfo = currentuserinfo();
        return ($userInfo->group_id == 2) ? true : false;
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
 * 
 * _isSalesManager
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */
if (!function_exists('_isSalesManager')) {
    function _isSalesManager() {
        $CI = &get_instance();
        $userInfo = currentuserinfo();
        return ($userInfo->group_id == 4) ? true : false;
    }
}

/**
 * _getGroupData
 * 
 * return gets row of group table
 *
 * @access	public
 */

if (!function_exists('_getGroupData')) {
    function _getGroupData($id = null) {
        $CI = &get_instance();
        $CI->db->where('id', $id);
        $query = $CI->db->get('user_groups');
        return $query->row();
    }
}

/**
 * group data 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('getGroups')) {
    function getGroups() {
        $CI = &get_instance();
        $CI->db->order_by('id', 'asc');
        $CI->db->where('id != ', '1');
        $query = $CI->db->get('user_groups');
        return $query->result();
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
// ------------------------------------------------------------------------
/**
 * @Function _sendEmail
 * @purpose load layout page 
 * @created  6 dec 2014
 */
/*if (!function_exists('_sendEmail')) {
    function _sendEmail($email_data) {
        $CI = &get_instance();
        $config['protocol'] = 'sendmail';
        $config['mailpath'] = '/usr/sbin/sendmail';
        $config['charset'] = 'iso-8859-1';
        $config['wordwrap'] = true;
        $CI->email->set_mailtype("html");
        $CI->email->initialize($config);
        $CI->email->from($email_data['from'], ucwords($email_data['sender_name']));
        $CI->email->to($email_data['to']);
        if (!empty($email_data['cc'])) {
            $CI->email->cc($email_data['cc']);
        }
        if (!empty($email_data['bcc'])) {
            $CI->email->bcc($email_data['bcc']);
        }
        if(!empty($email_data['file']))
        {
            $CI->email->attach($email_data['file']);
        }
        $CI->email->subject(ucfirst($email_data['subject']));
        $data['message']=$email_data['message'];
        $msg=$CI->load->view('email_template/email',$data,true);
        $CI->email->message($msg);
        $CI->email->send();
        
    }
}*/

if (! function_exists('_sendEmail')) 
{
	function _sendEmail($email_data)
	{ 
		$CI = &get_instance();
//_pr($email_data);die;
 /*$email='',$subject="",$message="",$mail_cc="", $bccMailIds = 'priya1@tekshapers.com', $from = '',$file = '',$data = ''*/
$email = $email_data['to'];
$subject = $email_data['subject'];
$data1['message'] = $email_data['message'];

$message = $CI->load->view('email_template/email',$data1,true);


        $CI->load->library('sendmail');
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        
        $mail->Port = 587; //465
        $mail->IsHTML(true);
        /* $mail->Username = "test.tekshapers@gmail.com";
       $mail->Password = "developer@tekshapers1";
        $mail->setFrom('test.tekshapers@gmail.com', 'SPD'); */
		
		$mail->Username = "tekleads@tekshapers.com";
        $mail->Password = "tek##54321";
        $mail->setFrom('tekleads@tekshapers.com', 'Elitebiz');

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
//echo "send";
             return TRUE;
		}
		else
		{
//echo "not send";
			return FALSE;
		}
//die;
	}
}


/**
 * _userName
 * 
 * return user name
 *
 * @access	public
 */

if (!function_exists('_userName')) {
    function _userName($id = null) {
        $CI = &get_instance();
        $CI->db->select('CONCAT(users.first_name," ",users.last_name) as name',false);
        $CI->db->where('users.id', $id);
        $query = $CI->db->get('users');
        return $query->row()->name;
    }
}



