<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Cats Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Function
 * @company     GohrmInc
 * @since		Version 1.0
 */
 
// ------------------------------------------------------------------------

/**
 * Is RequestIsPost 
 * 
 * Check whether Request is POST type or not
 *
 * @access	public
 * @return	boolean
 */ 
if(!function_exists('RequestIsPost')) {
    function RequestIsPost() {
        if (strtoupper($_SERVER['REQUEST_METHOD']) == 'POST')
            return TRUE;
        else
            return FALSE;
    }
}

// ------------------------------------------------------------------------

/**
 * Is Current Site ID 
 * 
 * Get Current Site ID
 *
 * @access	public
 * @return	boolean
 */ 
if(!function_exists('current_site_id')) {
    function current_site_id() {
        $CI =& get_instance();
        $site_id = currentuserinfo()->site_id;
        return $site_id;
    }
}


// ------------------------------------------------------------------------

/**
 * Is ajxBoolProtected
 * Shashank modified
 * Check Resticted area or not
 *
 * @access	public
 * @return	boolean
 */
if(!function_exists('ajxBoolProtected')) {
    function ajxBoolProtected() {
        $CI =& get_instance();
        if(!$CI->session->userdata('isLogin')) {
            return FALSE;
        }
        else
            return TRUE;
    }
}
// ------------------------------------------------------------------------

/**
 * Is boolProtected 
 * Shashank modified
 * Check Resticted area or not
 *
 * @access	public
 * @return	boolean
 */
if(!function_exists('boolProtected')) {
    function boolProtected() {
        $CI =& get_instance();
        if(!$CI->session->userdata('isLogin')) {
            redirect(base_url('login'));
        }
        else
            return TRUE;
    }
}


// ------------------------------------------------------------------------

/**
 * Clear Posted Data 
 * 
 * Clear all posted data
 *
 * @access	public
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

// ------------------------------------------------------------------------

/**
 * Current User Info 
 * 
 * If user loged then returl current user info
 *
 * @access	public
 * @return	mixed	boolean or depends on what the array contains
 */ 
if(!function_exists('currentuserinfo')) {
    function currentuserinfo() {
        $CI =& get_instance();
        return $CI->session->userdata("userinfo");
    }
}
// ------------------------------------------------------------------------

/**
 * Last Access Url 
 * 
 * Get Last visited url
 *
 * @access	public
 * @return	string or boolean
 */ 
if(!function_exists('last_access_url')) {
    function last_access_url() {
        $CI =& get_instance();
        return $CI->session->userdata("last_access_url");
    }
}


// ------------------------------------------------------------------------

/**
 * view_layout
 * 
 * Display Page with header and footer file
 *
 * Example
 * $views[] = 'dashboard';
 * $views[] = 'mid_bar';
 * $data['title'] = "Dashboard";
 * load_display($views,$data); 
 * 
 * @access	public
 */ 
if(!function_exists('view_layout')) {
    function view_layout($views = array(),$data = array()) {
        $CI =& get_instance();
		$userinfo = $CI->session->userdata['userinfo'];
        // pr($userinfo);die;
        if($userinfo->p_id){
			redirect(base_url('company/compmaster'));
        }else if(!($userinfo->p_id) && !($userinfo->is_super)){
			redirect(base_url('company/dashboard'));
		}
        $CI->load->view("header", $data);
		$CI->load->view("left_menu/super/left", $data);
		$CI->load->view("breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("footer", $data);
    }
}

if(!function_exists('view_load')) {
    function view_load($views = array(),$data = array()) {
        $CI =& get_instance();
        $userinfo = $CI->session->userdata['userinfo'];
        // pr($userinfo);die;
        if($userinfo->p_id){
            redirect(base_url('company/compmaster'));
        }else if(!($userinfo->p_id) && !($userinfo->is_super)){
            redirect(base_url('company/dashboard'));
        }
        $CI->load->view("header", $data);
        $CI->load->view("left_menu/super/left", $data);
        $CI->load->view("breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
        $CI->load->view("globalScript", $data);
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
    function set_flashdata($type, $msg)
    {
        $CI = &get_instance();

        $CI->session->set_flashdata("flash_msg_type", $type);
        $CI->session->set_flashdata("flash_msg_text", $msg);
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
    function get_flashdata()
    {
        $CI = &get_instance();

        $type = $CI->session->flashdata("flash_msg_type");
        $text = $CI->session->flashdata("flash_msg_text");

        if (!$type) {
            return;
        }

        $temp = '<div class="row-fluid">
                            <div class="span12">
                            <div class="alert alert-' . $type . '">
                            <button data-dismiss="alert" class="close" type="button">×</button>
                            <strong>' . ucfirst($type) . '</strong> ' . $text . '
                            </div></div></div>';

        return $temp;
    }
}

// ------------------------------------------------------------------------

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


if(!function_exists('view_cmpny_esspanellayout')) {
    function view_cmpny_esspanellayout($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("esspanel/cmpny_ess_header", $data);
		$CI->load->view("esspanel/left_menu/left", $data);
		$CI->load->view("breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("footer", $data);
    }
}

/**
 * view_layout for Company
 * 
 * Display Page with header and footer file
 *
 * Example
 * $views[] = 'Compdashboard';
 * $views[] = 'mid_bar';
 * $data['title'] = "Compdashboard";
 * load_display($views,$data); 
 * 
 * @access	public
 */ 
if(!function_exists('view_companylayout')) {
    function view_companylayout($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("company/header", $data);
		$CI->load->view("company/left_menu/left", $data);
		$CI->load->view("breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("company/footer", $data);
    }
}


/**
 * view_layout for Subcompany
 * 
 * Display Page with header and footer file
 *
 * Example
 * $views[] = 'dashboard';
 * $views[] = 'mid_bar';
 * $data['title'] = "dashboard";
 * load_display($views,$data); 
 * 
 * @access	public
 */ 
if(!function_exists('view_subcompanylayout')) {
    function view_subcompanylayout($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("subcompany/header", $data);
		$CI->load->view("subcompany/left_menu/left", $data);
		$CI->load->view("subcompany/breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("subcompany/footer", $data);
    }
}

/**
 * view_compdashboard for Subcompany
 * 
 * Display Page with header and footer file
 *
 * Example
 * $views[] = 'dashboard';
 * $views[] = 'mid_bar';
 * $data['title'] = "dashboard";
 * load_display($views,$data); 
 * 
 * @access	public
 */ 
if(!function_exists('view_compdashboard')) {
    function view_compdashboard($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("subcompany/header", $data);
		//$CI->load->view("subcompany/left_menu/left", $data);
		//$CI->load->view("subcompany/breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("dashboardglobalScript", $data);
        $CI->load->view("subcompany/footer", $data);
    }
}


/**
 * view_layout for Employee Master in company 
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('view_emplayout')) {
    function view_emplayout($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("subcompany/header", $data);
		$CI->load->view("subcompany/left_menu/left", $data);
		$CI->load->view("subcompany/breadcrumb", $data);
        $CI->load->view("subcompany/headerEmployee", $data);
		foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("subcompany/footer", $data);
    }
}

/**
 * view_layout for Employee Master in company 
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('view_esspanellayout')) {
    function view_esspanellayout($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("esspanel/header", $data);
		$CI->load->view("esspanel/left_menu/left", $data);
		$CI->load->view("breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("footer", $data);
    }
}

/**
 * view_layout for Employee Master in company 
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('view_mypanellayout')) {
    function view_mypanellayout($views = array(),$data = array()) {
        $CI =& get_instance();
		$userinfo = $CI->session->userdata['userinfo'];
        $CI->load->view("mypanel/header", $data);
		if(!empty($userinfo) && ($userinfo->emp_type==1)){
			$CI->load->view("mypanel/left_menu/left", $data);
		} else if(!empty($userinfo) && ($userinfo->emp_type==2)){
			$CI->load->view("mypanel/left_menu/superleft", $data);
		} else if(!empty($userinfo) && ($userinfo->emp_type==3)){
			$CI->load->view("mypanel/left_menu/hrleft", $data);
		}else if(!empty($userinfo) && ($userinfo->emp_type==4)){
			$CI->load->view("mypanel/left_menu/operatorleft", $data);
		}else if(!empty($userinfo) && ($userinfo->emp_type==6)){
			//$CI->load->view("mypanel/left_menu/superleft", $data);
		}else {
		}
		
		$CI->load->view("breadcrumb", $data);
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("footer", $data);
    }
}
/**
 * ajax_layout
 * 
 * Display Page without header and footer file
 *
 * Example
 * $views[] = 'dashboard';
 * $views[] = 'mid_bar';
 * $data['title'] = "Dashboard";
 * load_display($views,$data); 
 * 
 * @access	public
 */ 
if(!function_exists('ajax_layout')) {
    function ajax_layout($views = array(),$data = array()) {
        $CI =& get_instance();
        foreach($views as $view) {
            $CI->load->view($view, $data);
        }
    }
}


// ------------------------------------------------------------------------


/**
 * view_layout for Employee Master in company 
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('view_ess_emplayout')) {
    function view_ess_emplayout($views = array(),$data = array()) {
        $CI =& get_instance();
        $CI->load->view("esspanel/header", $data);
		$CI->load->view("esspanel/left_menu/left", $data);
		$CI->load->view("breadcrumb", $data);
        $CI->load->view("esspanel/headerEmployee", $data);
		foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("globalScript", $data);
        $CI->load->view("subcompany/footer", $data);
    }
}

/**
 * Set Flash Data
 * 
 * Set Flash Data in Session Flashdata
 *
 * @access	public
 * @param   String - Message type value(info,success,warning,error)
 * @param   String - Text Message
 */ 
if(!function_exists('set_flashmsg')) {
    function set_flashmsg($type,$msg) {
        $CI =& get_instance();
        $CI->session->set_flashdata("flash_msg_type",$type);
        $CI->session->set_flashdata("flash_msg_text",$msg);
    }
}



// ------------------------------------------------------------------------

/**
 * Get Flash Data
 * 
 * Get Flash Data in Session Flashdata
 *
 * @access	public
 * @return  String
 */ 
if(!function_exists('get_flashmsg')) {
    function get_flashmsg() {
        $CI =& get_instance();
        $type = $CI->session->flashdata("flash_msg_type");
		//echo "<br>";
        $text = $CI->session->flashdata("flash_msg_text");
        if(!$type)
            return;
		/*$error = (strpos($type,'failure') !== false) ? ('background-color: #DA203D;') : ('');

		$temp = '<div class="row-fluid" id="flash_id"><div class="span12"><div class="inner-form-container"><div class="form-box-left" style="'.$error.'"><div class="black">'.ucfirst($type).'</div></div>
		<div class="form-box-right">
			<div class="cross-txt">'.$text.'</div>
			<div class="cross-img"><img id="flashcross_btn" src="'.PUBLIC_URL.'images/close.png" align="right" style="margin:0px 0px 0px 20px;cursor:pointer;"></div>
		</div>
		</div></div></div>';*/
		if(strpos($type,'failure') !== false || strpos($type,'error') !== false){
			$class='alert alert-danger';
		} else {
			$class='alert alert-success';
		}
		$temp = '<div class="row-fluid"><div class="'.$class.'" role="alert" id="flash_id"><button type="button" class="close" data-dismiss="alert" style="right: 0px;"><span class="sr-only"></span></button>'.$text.'</div></div>';
        return $temp;
    }
}

//================================Network IP function===========================//
if(!function_exists('getNetworkIp')) {
function getNetworkIp(){
		//check for shared internet/ISP IP
		if (!empty($_SERVER['HTTP_CLIENT_IP']) && validate_ip($_SERVER['HTTP_CLIENT_IP'])) {
			return $_SERVER['HTTP_CLIENT_IP'];
		}
		// check for IPs passing through proxies
		if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			// check if multiple ips exist in var
			if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',') !== false) {
				$iplist = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
				foreach ($iplist as $ip) {
					if (validate_ip($ip))
					return $ip;
				}
			}else{
				if(validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
				return $_SERVER['HTTP_X_FORWARDED_FOR'];
			}
		}
		if (!empty($_SERVER['HTTP_X_FORWARDED']) && validate_ip($_SERVER['HTTP_X_FORWARDED']))
		return $_SERVER['HTTP_X_FORWARDED'];

		if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
		return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];

		if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
		return $_SERVER['HTTP_FORWARDED_FOR'];

		if (!empty($_SERVER['HTTP_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_FORWARDED']))
		return $_SERVER['HTTP_FORWARDED'];

		// return unreliable ip since all else failed
		return $_SERVER['REMOTE_ADDR'];
	}
}
	function validate_ip($ip) 
	{
        if (strtolower($ip) === 'unknown')
            return false;
        // generate ipv4 network address
        $ip = ip2long($ip);
        // if the ip is set and not equivalent to 255.255.255.255
        if ($ip !== false && $ip !== -1) {
            // make sure to get unsigned long representation of ip
            // due to discrepancies between 32 and 64 bit OSes and
            // signed numbers (ints default to signed in PHP)
            $ip = sprintf('%u', $ip);
            // do private network range checking
            if ($ip >= 0 && $ip <= 50331647)
                return false;
            if ($ip >= 167772160 && $ip <= 184549375)
                return false;
            if ($ip >= 2130706432 && $ip <= 2147483647)
                return false;
            if ($ip >= 2851995648 && $ip <= 2852061183)
                return false;
            if ($ip >= 2886729728 && $ip <= 2887778303)
                return false;
            if ($ip >= 3221225984 && $ip <= 3221226239)
                return false;
            if ($ip >= 3232235520 && $ip <= 3232301055)
                return false;
            if ($ip >= 4294967040)
                return false;
        }
        return true;
    }
//==============================Close Network function=======================//

//==================Get System mac IP========================//
	function getMac(){
		//exec('netstat -ie', $result);
		//exec('netstat -p', $result);
		exec('netstat -e', $result);
  if(is_array($result)) {
    $iface = array();
    foreach($result as $key => $line) {
      if($key > 0) {
        $tmp = str_replace(" ", "", substr($line, 0, 10));
        if($tmp <> "") {
          $macpos = strpos($line, "HWaddr");
          if($macpos !== false) {
            $iface[] = array('iface' => $tmp, 'mac' => strtolower(substr($line, $macpos+7, 17)));
          }
        }
      }
    }
    return $iface[0]['mac'];
  } else {
    return "notfound";
  }
}
//==========================================//
/**
 * Lang
 *
 * Fetches a language variable and optionally outputs a form label
 *
 * @access	public
 * @param	string	the language key
 * @return	string
 */
if ( ! function_exists('lang')) {
	function lang($key) {
		$CI =& get_instance();
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
 * @param	string	- Table Name
 * @return	array - Filed list
 */
if ( ! function_exists('table_fields')) {
	function table_fields($table = NULL) {
        $CI =& get_instance();
        $fields = $CI->db->list_fields($table);
        $r = new stdClass;
        foreach($fields as $row) {
            $r->$row = NULL;
        } 
        return $r;
    }
}


// ------------------------------------------------------------------------

/**
 * Current Date And Time GB standards
 *
 * This function get Current Date And Time in Global meredian standards
 *
 * @param	
 * @return
 */
if ( ! function_exists('current_date')) {
	function current_date() {
        $dateFormat="Y-m-d H:i:s";
        $timeNdate=gmdate($dateFormat);
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
if ( ! function_exists('current_ip')) {
	function current_ip() {
        $current_ip =$_SERVER['REMOTE_ADDR'];
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
if ( ! function_exists('flexigrid_json')) {
	function flexigrid_json($data,$base_url,$page = 1) {
	    $userinfo = currentuserinfo();
    	$CI =& get_instance();
    	$uri = $CI->session->userdata("current_uri");
    	$uri = str_replace("/ajax_list_items/","",$uri);
    	 
    	$userinfo = currentuserinfo();
    	 
    	$permission =  get_permissions_lists();
    	 
    	
    	
    	$edit = FALSE;
    	$view = FALSE;
    	$add  = FALSE;
    	    	 
    	foreach($permission as $k =>$v)
    	{    		
    		if($v == AT_VIEW && $uri.'/view' == $k)
    			$view = TRUE;
    		if($v == AT_EDIT && $uri.'/edit' == $k)
    			$edit = TRUE;
    		if($v == AT_ADD && $uri.'/add' == $k)
    			$add = TRUE;
    	}
    	 
    	header("Content-type: application/json");
        $jsonData = array('page'=>$page,'total'=>$data['total'],'rows'=>array());
        
        $c = $data['offset'];
        foreach($data['result'] AS $row) {
            $c++;
            $cells = array();
            $cells['checkbox'] = '<input id="c_row'.$row->id.'" class="datacb single_checkbox" type="checkbox" value="'.$row->id.'"/>';
            $cells['sno'] = $c;
            foreach($row as $k=>$v) {
                $cells[$k] = $v;  
            }
            $temp = NULL;
            $pos = strpos($base_url, "reportmanagement/report");
            if ($pos == false) {
				if($userinfo->is_super_site || $userinfo->is_super || $view)
					$temp .= '<a href="'.$base_url."/view/".$row->id.'">View</a>';
				if($userinfo->is_super_site || $userinfo->is_super || $edit) {
					if($userinfo->is_super_site || $userinfo->is_super || $view)
					$checkarr=array('1','2','3');
							if(in_array($userinfo->group_id, $checkarr)) {
						  $temp .= ' | ';
						  $temp .= '<a href="'.$base_url."/edit/".$row->id.'" >Edit</a>';
						}
				}
            } else {
                $temp .= '<a href="'.$base_url."/view/".$row->id.'">report</a>';
            }
            if($temp != NULL)
            	$cells['actions'] = $temp;
			$entry = array('id'=>$row->id,
      		'cell'=>$cells
            );
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
if ( ! function_exists('list_table_fields')) {
	function list_table_fields($table) {
        $CI =& get_instance();
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
 * @access	public
 * @return  String
 */ 

function array_to_csv($array, $download = "") {
	if ($download != "") {	
		header('Content-Type: application/csv');
		header('Content-Disposition: attachement; filename="' . $download . '"');
	}		
	ob_start();
	$f = fopen('php://output', 'w') or show_error("Can't open php://output");
	$n = 0;		
	foreach ($array as $line) {
		$n++;
		if ( ! fputcsv($f, $line)) {
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
if ( ! function_exists('print_array')) {
    function print_array($data = array()) {
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
if ( ! function_exists('get_site_language')) {
    function get_site_language() {
		$CI =& get_instance();
		if($language = $CI->session->userdata('language'))
			return $language;
		else
			return "english";
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
if ( ! function_exists('current_uri')) {
    function current_uri() {
        $CI =& get_instance();
        $directory = $CI->router->fetch_directory();
        $directory = str_replace(array('../modules/','/controllers/'),'',$directory);
        $controller_name = $CI->router->fetch_class();
		$method_name = $CI->router->fetch_method();
        $uri = NULL;
        if($controller_name === $directory)
            $uri = $controller_name.'/'.$method_name;
        else
            $uri = $directory.'/'.$controller_name.'/'.$method_name;
            return $uri;
    }
    
}

//-------------------------------------------------------
/**
* Get Permission lists
*
* This function returns site permission from site table
*
* @return string
*/

if ( ! function_exists('get_permissions_lists')) {
	function get_permissions_lists() {
		$CI =& get_instance();
		$permission 	= array();
		$uri = $CI->session->userdata("current_uri");
		$uri = str_replace("/list_items/","",$uri);
		if(currentuserinfo()->extra_group_id=="") {
			$group_id      	= currentuserinfo()->group_id;
			$CI->db->where('group_id',$group_id);
			$CI->db->where('uri !=','');
			$query         = $CI->db->get('user_group_permissions');
			$row = $query->row();
			if ($row && $row->uri != '') {
				$permission  = json_decode(stripslashes($row->uri));				
			}
		} else {
			$group_id          = currentuserinfo()->group_id;
			$extra_group       = currentuserinfo()->extra_group_id.",".$group_id;
			$extra_group_id    = explode(",",$extra_group);
			$CI->db->where_in('group_id',$extra_group_id);
			$CI->db->where('uri !=','');
			$query  = $CI->db->get('user_group_permissions');
			$results           = $query->result();
			foreach($results as $row) {
				$temp = NULL;
				$temp  = json_decode(stripslashes($row->uri));
				foreach($temp as $k=>$v)
				{
					$permission[$k] = $v;
				}
				
			}
		}
	
		return $permission;
		
	}
}

//-------------------------------------------------------
/**
* Permission Denied
*
* This function used as deny object
*
* @return string
*/

if ( ! function_exists('permission_denied')) {
	function permission_denied() {
		$config =& get_config();
		//echo file_get_contents($config['base_url'] . 'error/permission_denied');
		redirect('error/permission_denied', 'location',"301");
	}
}


/**
 * getRealIpAddr* 
 * Display IP adsress if proxy or shared client
 *
 * Example
 * getRealIpAddr()
 * author :: sunnyv75
 * @access	public
 */ 
if(!function_exists('getRealIpAddr')) {
	 function getRealIpAddr() {
		  if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			  //check ip from share internet
			  $ip=$_SERVER['HTTP_CLIENT_IP'];
		  }
		  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			  //to check if ip is passed from proxy
			  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
		  }
		  else {
			  $ip=$_SERVER['REMOTE_ADDR'];
		  }
		  return $ip;
		}
 }

/** Added by::: Ajit Rajput :::
  *
  * Function: send_mail
  * @purpose: send mail to given email address
  * @return boolean TRUE if successful send, FALSE if not
 */
if (! function_exists('send_mail_old')) {
	function send_mail_old($email='',$subject="",$message="",$mail_cc=""){ 
		$CI =& get_instance(); 
		$CI->load->library('email');

		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$CI->email->initialize($config);
        
		
		$from="info@gohrm.com";
		$data['message']=$message;
		$CI->email->from($from);
		$CI->email->to($email);
		if($mail_cc){
			$CI->email->cc($mail_cc);
		}
		
		$CI->email->subject($subject);
		$CI->email->message($CI->load->view('email',$data,true));
		//$CI->email->message($message);
		if($CI->email->send())
			return true;
		return false;
	}
}

if (! function_exists('send_mail')) 
{
	function send_mail($email='',$subject="",$message="",$mail_cc="", $bccMailIds = 'test@gohrm.com', $from = '',$file = '',$data = '')
	{ 
		$CI = &get_instance();
        $CI->load->library('sendmail');
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
       /*  $mail->Username = "test.tekshapers@gmail.com";
        $mail->Password = "developer@tekshapers1";
        $mail->setFrom('test.tekshapers@gmail.com', 'SPD');  */
		
		$mail->Username = "test@gohrm.com";
        $mail->Password = "54321#";
        $mail->setFrom('test@gohrm.com', 'gohrm');
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
		//$mail->AddAddress('test@gohrm.com');
		if ($mail_cc) 
		{
			$mail->AddCC($mail_cc);
		}
		$bccsid=$CI->session->userdata['userinfo']->s_id;
        if(isset($bccsid) && $bccsid=='55'){
            $mail->AddBCC('test@gohrm.com,test@gohrm.com');
        } else {
		  $bccMailIds = $bccMailIds ? $bccMailIds.',test@gohrm.com' : 'test@gohrm.com';
          $mail->AddBCC($bccMailIds);
        }
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

if (! function_exists('sendMailWithMsg_old')) {
	function sendMailWithMsg_old($email='',$subject="",$message="",$mail_cc="", $bccMailIds = '', $from = ''){ 
		$CI =& get_instance(); 
		$CI->load->library('email');

		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$CI->email->initialize($config);
      	
		$from = $from ? $from : "info@gohrm.com";
		$data['message']=$message;
		$CI->email->from($from);
		$CI->email->to($email);
        $CI->email->to('test@gohrm.com');
		if($mail_cc){
			$CI->email->cc($mail_cc);
		}
        $bccsid=$CI->session->userdata['userinfo']->s_id;
        if(isset($bccsid) && $bccsid=='55'){
            //$CI->email->bcc('test@gohrm.com,punye@gohrm.com,test@gohrm.com');
        } else {
		  $bccMailIds = $bccMailIds ? $bccMailIds.',test@gohrm.com' : 'test@gohrm.com';
          $CI->email->bcc($bccMailIds);
        }

		
		$CI->email->subject($subject);
		//$CI->email->message($CI->load->view('email',$data,true));
		$CI->email->message($message);
		if($CI->email->send())
			return true;
		return false;
	}
}

if (! function_exists('sendMailWithMsg')) {
	function sendMailWithMsg($email='',$subject="",$message="",$mail_cc="", $bccMailIds = 'test@gohrm.com', $from = '',$file = '',$data = ''){ 
		$CI = &get_instance();
        $CI->load->library('sendmail');
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
       /*  $mail->Username = "test.tekshapers@gmail.com";
        $mail->Password = "developer@tekshapers1";
        $mail->setFrom('test.tekshapers@gmail.com', 'SPD');  */
		
		$mail->Username = "test@gohrm.com";
        $mail->Password = "54321#";
        $mail->setFrom('test@gohrm.com', 'gohrm');
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
		//$mail->AddAddress('test@gohrm.com');
		if ($mail_cc) 
		{
			$mail->AddCC($mail_cc);
		}
		$bccMailIds = isset($bccMailIds) ? $bccMailIds.',corphr@gohrm.com' : 'test@gohrm.com,corphr@gohrm.com';
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
			/*ob_start();
			$CI->email->print_debugger();
			$error = ob_end_clean();
			$errors[] = $error;
			pr($errors); die;*/
			return FALSE;
		} 
	}
}

if (! function_exists('sendMailloginMsg_old')) {
	function sendMailloginMsg_old($email='',$subject="",$message="",$mail_cc=""){ 
		$CI =& get_instance(); 
		$CI->load->library('email');

		$config['protocol'] = 'sendmail';
		$config['mailpath'] = '/usr/sbin/sendmail';
		$config['mailtype'] = 'html';
		$config['charset'] = 'iso-8859-1';
		$config['wordwrap'] = TRUE;
		$CI->email->initialize($config);
      	
		$from="info@gohrm.com";
		$data['message']=$message;
		$CI->email->from($from);
		$CI->email->to($email);
		if($mail_cc){
			$CI->email->cc($mail_cc);
		}
        $bccsid=$CI->session->userdata['userinfo']->s_id;
        if(isset($bccsid) && $bccsid=='55'){
            $CI->email->bcc('test@gohrm.com,punye@gohrm.com,test@gohrm.com');
        } else {
		  $CI->email->bcc('test@gohrm.com');
        }
		$CI->email->subject($subject);
		//$CI->email->message($CI->load->view('email',$data,true));
		$CI->email->message($message);
		if($CI->email->send())
			return true;
		return false;
	}
}

if (! function_exists('sendMailloginMsg')) {
	function sendMailloginMsg($email='',$subject="",$message="", $mail_cc="", $bccMailIds = '', $from = '' , $bccMailIds = 'test@gohrm.com', $from = '',$file = '',$data = ''){ 
		$CI = &get_instance();
        $CI->load->library('sendmail');
        $mail = new PHPMailer(); // create a new object
        $mail->IsSMTP(); // enable SMTP
        $mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
        $mail->SMTPAuth = true; // authentication enabled
        $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
        $mail->Host = "smtp.gmail.com";
        
        $mail->Port = 465; // or 587
        $mail->IsHTML(true);
       /*  $mail->Username = "test.tekshapers@gmail.com";
        $mail->Password = "developer@tekshapers1";
        $mail->setFrom('test.tekshapers@gmail.com', 'SPD');  */
		
		$mail->Username = "test@gohrm.com";
        $mail->Password = "54321#";
        $mail->setFrom('test@gohrm.com', 'gohrm');
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
		//$mail->AddAddress('test@gohrm.com');
		if ($mail_cc) 
		{
			$mail->AddCC($mail_cc);
		}
		$bccsid=$CI->session->userdata['userinfo']->s_id;
        if(isset($bccsid) && $bccsid=='55'){
            $mail->AddBCC('test@gohrm.com,test@gohrm.com');
        } else {
		  $bccMailIds = isset($bccMailIds) ? $bccMailIds : 'test@gohrm.com';
          $mail->AddBCC($bccMailIds);
        }
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
			/*ob_start();
			$CI->email->print_debugger();
			$error = ob_end_clean();
			$errors[] = $error;
			pr($errors); die;*/
			return FALSE;
		}
	}
}

/* printing records unanimouusly
 * @param	string	the result 
 * @return	string
 */
if ( ! function_exists('pr')) {
	function pr($data = array()) {
		echo '<pre>';
        print_r($data);
        echo '</pre>';
	}
}
/* Added by::: $hashank ::: */
/* ToDate
 * @param	string	the language key
 * @return	string
 */

if ( ! function_exists('ToDate')) {
	function ToDate($year=null,$month=null) {
		$yr = $year.'-01-01';
		$isLeap = date('L', strtotime($yr));
		$Leap_Month = (!$isLeap) ? (28) : (29);
		$Year_Mnth = array('01' => 31,'02' => $Leap_Month,'03' => 31,'04' => 30,'05' => 31,'06' => 30,'07' => 31,'08' => 31 ,'09' => 30 ,'10' => 31 ,'11' => 30 ,'12' =>31);
		$To_date = $year.'-'.$month.'-'.$Year_Mnth[$month];
		return $To_date;
	}
} 

if ( ! function_exists('YearList')) {

function YearList() {
	$cr_yr = date('Y');
	for($x=FIXED_YEAR;$x<=$cr_yr;$x++) {
	$YEAR[$x] = $x;
	}
	return $YEAR;
}

}
/* Added by::: $hashank ::: */
/* MonthDropdown
 * @param	returns months dropdown dynamically
 * @return	string
 */

if ( ! function_exists('MonthDropdown')) {
	function MonthDropdown($name="month1" , $clas="" , $dropdownid="" , $selected=null,$others=array()){
	   
        //$othera=array('onchange'=>'test(2);');
        
        if($others){
            foreach($others as $k=>$v){
                $dropdown = '<del><select style="margin-bottom:0;" name="'.$name.'" class="'.$clas.'" id="'.$dropdownid.'" '.$k.'="'.$v.'"> ';
            }
        }else{
            $dropdown = '<del><select style="margin-bottom:0;" name="'.$name.'" class="'.$clas.'" id="'.$dropdownid.'">';
        }
		
		$selected = is_null($selected) ? date('n', time()) : $selected;
        $dropdown .= '<option value="" >'."Select Month".'</option>';;
		for ($i = 1; $i <= 12; $i++) {
			$dropdown .= '<option value="'.str_pad($i, 2, "0", STR_PAD_LEFT).'"';
			if ($i == $selected) {
				$dropdown .= ' selected="selected"';
			}
			$Month = date("F", mktime(0, 0, 0, $i+1, 0, 0, -1));
			$dropdown .= '>'.$Month.'</option>';
		}
		$dropdown .= '</select></del>';
		return $dropdown;
	}

}
/* Added by::: $hashank ::: */
/* unique_sysId
 * @param	number (Int) key
 * @return	Unique Integer
 */

if ( ! function_exists('unique_sysId')) { 
	function unique_sysId($table=null,$u_id=FALSE) {  
		if(!empty($table)) {
			$CI =& get_instance();
			$net_emp = $CI->db->where('user_id',$u_id)->where('emp_code !=','')->from($table)->count_all_results();
			//if($result->num_rows()>0) {
			if(!empty($net_emp)) {
                //$sysID=$result->result();
                $sysID=	$net_emp+1;
            } else {
                $sysID=1;
            }
			return $sysID; 
		}
	}  
}
/* Added by::: $hashank ::: */
/* all_BlocK
 * @param	String of all blocks as array (Int) key
 * @return	String
 */

if ( ! function_exists('all_BlocK')) { 
	function all_BlocK() {
		$CI =& get_instance();
		$location= $CI->session->userdata['userinfo']->city;
		$CI->db->select('id,block_name');
		$CI->db->where('city',$location);
		$result=$CI->db->get('block');
		foreach($result->result_array() as $row) {
			$Block_List[$row['id']] = $row['block_name']; 
		}
		return $Block_List;
	}  
}

/* Added by::: Gohrm::: */
/* getFinancialYear
 * purpose  Function to get financial year
 * @param	Integer
 * @return	Array
 */

if(! function_exists('getFinancialYear')) { 
	function getFinancialYear($num=2){
		$current_month = date("j");
		$current_year=date("Y",strtotime("+1 year"));
		if($current_month < 4 ){
			$current_year=date("Y");
		}

		$previous_year=date("Y",mktime(0,0,0,0,0,$current_year));
		
		$current_year= ($current_year-$num);		
		$previous_year= ($previous_year-$num); 
		
		$financial_year=array();
		for($i=$num;$i>=1;$i--){
			$previous=($previous_year+$i);
			$current=($current_year+$i);
			$financial_year[$previous.'-'.$current]=$previous."-".$current;
		}
		return $financial_year;
	}
}

/* Added by::: $hashank ::: */
/* Get Financial year Drop down dynamically
 * usage:: _getFY('**DD name here**',null,null)
 * usage:: _getFY('**DD name here**',null,'2015',TRUE)
 * usage:: _getFY('**DD name here**','2017','2015',TRUE)
 * @param	name , (Val) key
 * @return	FY DD
 */

if ( ! function_exists('_getFY')) {
	function _getFY($name="fin_yr", $limit_yr=null, $selected=null, $_default=FALSE) {
		$dropdown = '<del><select name="'.$name.'" id="'.$name.'" style="margin-bottom:0;">';
		$dropdown .= '<option value="" >Select Financial Year</option>';
		$now_tm = date('Y', time());
		$selected = is_null($selected) ? $now_tm : $selected;
		$selected = ($_default) ? ('') : $selected;
		$limit_yr = is_null($limit_yr) ? $now_tm : $limit_yr;
		for ($i = DEFAULT_YEAR; $i <= $limit_yr; $i++) {
			$dropdown .= '<option value="'.$i."#".($i+1).'"';
		if ($i == $selected) {
			$dropdown .= ' selected="TRUE"';
		}
		$dropdown .= '>Financial year: '.$i."-".($i+1).'</option>';
		}
		$dropdown .= '</select></del>';
		return $dropdown;
	}

}

/**
 * Get Flash Data
 * 
 * Get Validation Error in Session Flashdata
 *
 * @access	public
 * @return  String
 */ 
if(!function_exists('get_validation_error'))
{
    function get_validation_error()
    {
        $CI =& get_instance();
                
        $type = $CI->session->flashdata("flash_msg_type");
        $text = $CI->session->flashdata("flash_msg_text");
        
        if(!$type)
            return;

		$temp='<div class="span12 columns" id="validate_error_id">
					<div class="alert alert-'.$type.'"> 
						<div class="cross-img" style="margin:0;">
							<img id="validate_error_btn" src="'.PUBLIC_URL.'images/close.png" align="right" style="cursor:pointer;">
						</div>
						<strong>'.ucfirst($type).'</strong> '.ucfirst($text).'
					</div>
			   </div>';        
        return $temp;
    }
}

/** Added by::: $hashank ::: 
  * Clears the cache for the specified path
  * @param string $uri The URI path
  * @return boolean TRUE if successful, FALSE if not
  */
if ( ! function_exists('clear_path_cache')) {
	function clear_path_cache($uri) {
        $CI =& get_instance();
		$path = $CI->config->item('cache_path');
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;
        $uri =	$CI->config->item('base_url').
		$CI->config->item('index_page').
		$uri;
		$cache_path .= md5($uri);
        return @unlink($cache_path);
    }
}
    
/** Added by::: $hashank :::
  *
  * Method:clear_all_cache
  * Clears all cache from the cache directory
  */
if ( ! function_exists('clear_all_cache')) {
	function clear_all_cache() {
        $CI =& get_instance(); 
		$path = $CI->config->item('cache_path');
        $cache_path = ($path == '') ? APPPATH.'cache/' : $path;
        $trans_path = opendir($cache_path);
		while (($file = readdir($trans_path))!== FALSE) {
            if ($file != '.htaccess' && $file != 'index.html') {
               @unlink($cache_path.'/'.$file);
            }
        }
		closedir($trans_path);
    }
}

/*****************************/
/** Added by::: Ranjeet :::
  *
  * Method:get data according to id from any table
  * Table and id is passed
  */
if(!function_exists('getwheredatas'))
{
      function getwheredatas($table,$whereid)
      {
        $res = '';
		$CI =& get_instance();
		$result=$CI->db->get_where($table,$whereid);
		if($result->num_rows >0){
			return $result->result();
		}else{
			//return false;
            return $res;
		   }	
        }
}
/* Added by::: $hashank ::: */
/* all_location
 * @param	String of all location as array (Int) key
 * @return	String
 */

if ( ! function_exists('get_location')) { 
	function get_location($id=null) {
		$CI =& get_instance();
		$CI->db->select('id,name');
		$CI->db->where('id',$id);
		$result=$CI->db->get('location');
		return $result->result();
	}  
}
/***********************************/

/** Added by::: Ranjeet :::
  *
  * Method:get data according to id from any table
  * Table and id is passed
  */
if(!function_exists('count_all_rows'))
{
      function count_all_rows($table,$whereid)
      {
        $res = '';
		$CI =& get_instance();
		$result=$CI->db->get_where($table,$whereid);
		if($result->num_rows >0){
			return $result->num_rows;
		}else{
            return $res;
		   }	
        }
}
/***************************************/
function getRange($id=null){
	$CI =& get_instance();
	$queryData=$CI->db->get_where("emp_slab_range",array("id"=>$id));	
	return $queryData->row();
}

/** Added by::: $hashank :::
* Checks whether who is LOGIN and redirects them accordingly
* @param string $uri The URI path
* _whoISin()
* @return if admin or company is login
*/
if ( ! function_exists('_WhoisIn_IDN')) {
    function _WhoisIn_IDN() { 
        echo "string";
        $CI =& get_instance();
		if($CI->session->userdata('isLogin')) {
           $userinfo = $CI->session->userdata('userinfo');
			if($userinfo != '' && !empty($userinfo)){
				if($userinfo->is_super) {
					redirect(base_url('dashboard'));
				} elseif (!($userinfo->p_id)) { 
					redirect(base_url('company/dashboard'));
				} else {
					redirect(base_url('company/compmaster'));
				}
         	}
		}
			redirect(base_url('login'));
       }
   }
   
/** Added by::: Ashutosh:::
* @param string $uri The URI path
* _whoISin()
* Checks if employee is login
*/
if ( ! function_exists('_employe_login')) {
    function _employe_login() {
        $CI =& get_instance();
		if($CI->session->userdata('isLogin')) {
           if(isset($CI->session->userdata['activecomdata']) || !empty($CI->session->userdata['activecomdata']['active_company'])) {
				$CI->session->unset_userdata('activecomdata');
			}
			
			$userinfo = $CI->session->userdata('userinfo');
		
			if($userinfo  != '' && !empty($userinfo)){
				if(isset($userinfo->login_type)){
					redirect(base_url('subcompany/employee'));	
				}
				else{
					redirect(base_url('company/dashboard'));	
				}
			}
		 }
			redirect(base_url('login'));
       }
        
   }   
   
/* Added by::: $hashank ::: */
/* all_location
 * @param	String of all location as array (Int) key
 * @return	String
 */

if ( ! function_exists('get_locdetails')) { 
	function get_locdetails($id=null) {
		$CI =& get_instance();
		$CI->db->select('name');
		$CI->db->where('id',$id);
		$result=$CI->db->get('location');
		return $result->row();
	}  
}
/* Added by::: sumit ::: */
/* unique array
 * @return	array
 */

if ( ! function_exists('get_uniquearray')) { 
	function get_uniquearray($data=null) {
		$result = array_map("unserialize", array_unique(array_map("serialize", $data)));
        foreach ($result as $key => $value){
			if (is_array($value)){
				$result[$key] = get_uniquearray($value);
			 }
        }
        return $result;
	}  
}
//----------------------------------------------//
/* To check modules` existence */

if ( ! function_exists('getModulesDetails')) { 
	function getModulesDetails($modName = null) {
		$CI =& get_instance();
		if($modName != null)
		{
			   $CI->db->like('mod_name', $modName);
			   $CI->db->where('status', 1);
			$qry = $CI->db->get('module_names');
		}
		else
		{
			$qry = $CI->db->get_where('module_names', array('status' => 1));
		}
		$modArr = '';
		$subModArr = '';
		if($qry->num_rows() > 0)
		{	
			$modArr = ($modName != null) ? $qry->row() : $qry->result();
			foreach($qry->result() as $rec)
			{
				if($rec->is_sub_module == 1)
				{
					$qry1 = $CI->db->get_where('module_names', array('parent_id' => $rec->id));
					if($qry1->num_rows() > 0)
					{
						$subModArr = $qry1->result();
					}
				}
			}
		}
		//pr(array('mod' => $modArr, 'subMod' => $subModArr));
		return array('mod' => $modArr, 'subMod' => $subModArr);
	}  
}
//----------------------------------------------//
/* To get modules` name*/

if ( ! function_exists('getModulesName')) { 
	function getModulesName($modId = null) {
		$CI =& get_instance();
		if($modId != null)
		{
			$qry = $CI->db->get_where('module_names', array('id' => $modId));
			if($qry->num_rows() > 0)
			{	
				return $qry->row()->mod_name;
			}
		}
		else
		{
			return null;
		}
	}  
}
/**
* Checks whether ADMIN is LOGIN and redirects them accordingly
* @param string $uri The URI path
* checkSuperAdmin()
* @return TRUE if admin is login
*/
if(!function_exists('checkSuperAdmin')) {
    function checkSuperAdmin()
	{
        $CI =& get_instance();
        //$userinfo = $CI->session->userdata['userinfo'];
		$userinfo = $CI->session->userdata('userinfo');
        if(($userinfo->is_super) && ($userinfo->site_id)) {
			return TRUE;
		} else {
			set_flashmsg('Permission denied failure','You cannot access this section.');
			redirect($CI->session->userdata("last_access_url"));
		}
	}
}
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

/* Added by::: $hashank ::: */
/* recursive_element
 * @param	returns the key of it’s associated value
 * usage: recursive_element("element", $my_things) !== FALSE where 
 * $my_things = multi_dimensional array()
 * @return	String
 */
if ( !function_exists('recursive_element')) {  
  function recursive_element($string,$MultiDms_arr) {  
    foreach($MultiDms_arr as $key=>$value) {  
      $current_key=$key;  
      if($string === $value   
        OR (is_array($value)   
          && recursive_element($string,$value) !== false)) {  
        return $current_key;  
      }  
    }  
    return false;  
  }  
}
/******Added by Ranjeet****************************************************/
function _day_of_date($date = null)
{
	return date('l', strtotime($date));
}
/***********************************************************/
function _dayno_from_date($date = null)
{
	return date('d', strtotime($date));
}

function _monthname_from_date($date = null)
{
	return date('F', strtotime($date));
}

function _yearno_from_date($date = null)
{
	return date('Y', strtotime($date));
}
/***************************************/
//=============================Get Compnay Registered Address=========================================//
	if ( ! function_exists('_Get_company_address')) {
		function _Get_company_address($c_id=NULL,$u_id=NULL) {
			if(!empty($c_id) && !empty($u_id)) {
				$CI =& get_instance();
				$CI->db->select('id,address,state,city');
				$regaddr=$CI->db->get_where("company_location",array("comp_id"=>$c_id, "user_id"=>$u_id, "off_type" => "Registered Office", "status"=>1))->row();
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
			return false;
		}
	}
//======================-==Close Company Registered Address==========================================//
 function gettabledate($table,$search=array())
{   
        $CI =& get_instance();
        $whereCondition = $search;
		$CI->db->where($whereCondition); 
		$query = $CI->db->get($table);
        //echo $CI->db->last_query();
        //die;
        $nodata="";
       	if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return $nodata;
        }
 }
 function getholidayname($table,$search=array())
{   
        $CI =& get_instance();
        $c_id=$search['comp_id'];
        $u_id=$search['user_id'];
        $todate=$search['hm_date'];
        $todate_arr=explode('-',$todate);
        $exp_yy='-'.$todate_arr[1].'-'.$todate_arr[2];
		$week=week_of_month($todate);
		$day_list=date('N',strtotime($todate));
        $CI->db->where(array('comp_id'=>$c_id, 'user_id' => $u_id, 'hm_type' => '1',  'status' => '1'))->where("((`hm_date` = '$todate')")->or_where("(`periodicity_holiday` = '1' AND day(`hm_date`) = '$todate_arr[2]' and MONTH(`hm_date`) = '$todate_arr[1]')")->or_where("(`periodicity_holiday` = '2' and	`month` = '$todate_arr[1]' and `week_list` = '$week' and `day_list` = '$day_list'))"); 
		$query = $CI->db->get($table);
        //echo $CI->db->last_query(); die;
        $nodata="";
       	if($query->num_rows()>0){
            return $query->result_array();
        }else{
            return $nodata;
        }
 }
 /*****************************************************************/
 function day_in_month($month, $year) 
{ 
// calculate number of days in a month 
return $month == 2 ? ($year % 4 ? 28 : ($year % 100 ? 29 : ($year % 400 ? 28 : 29))) : (($month - 1) % 7 % 2 ? 30 : 31); 
}

/*function calender_week_of_month1($date = null)
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
*/
function calender_week_of_month($date = null)
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
/**********************/
if ( ! function_exists('calender_is_emp_weekoff')) {
    function calender_is_emp_weekoff($comp_id=NULL, $user_id=NULL, $day_names=FALSE, $frequency=FALSE, $location_id=FALSE, $cat_id=FALSE, $dept_id=FALSE, $desg_id=FALSE, $weekOffSetupType,$week_date=FALSE,$emp_id=FALSE) {
		$data=array();
		if(!empty($comp_id) && !empty($user_id) && !empty($day_names) && !empty($frequency)) 
		{
			$CI =& get_instance();
			
			$is_empweekoff=$CI->db->get_where("weekoffs_setup",array("emp_id"=> $emp_id, "comp_id"=>$comp_id, "user_id"=>$user_id, "effective_date" => $week_date, "status"=>1));
			//echo $CI->db->last_query(); exit;
			if($is_empweekoff->num_rows()){
				return true;
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
			if($is_compweekoff->num_rows()) 
			{ 
				return $is_compweekoff->row()->type;
			}
		}
		return false;
	}
 }
 /**********************************/
 function week_OffSetupType($comp_id=NULL, $user_id=NULL){
    $CI =& get_instance();
        if($comp_id && $user_id){
            $leavfor=$CI->db->select('weekoffs_common')->get_where("attendance_settings", array("comp_id" => $comp_id, "user_id" => $user_id, 'status !='=>0));
            if($leavfor->num_rows()){
                return $leavfor->row()->weekoffs_common;
            }
        }
        return false;
    }
    /*******************************************/
    if ( ! function_exists('_monthly_holidays')) {
    function calender_monthly_holidays($c_id=NULL, $u_id=NULL, $todate=FALSE, $empid=FALSE, $location=FALSE, $cat_id=FALSE, $dept_id=FALSE, $desg_id=FALSE) {
		$data=array();
		if(!empty($c_id) && !empty($u_id) && !empty($todate)) {
			$CI =& get_instance();
			$CI->db->select('id,hm_location');
			$isholiday=$CI->db->get_where("company_holidays_master",array("comp_id"=>$c_id, "user_id"=>$u_id, "hm_type" => '1', "hm_date" => $todate,  "status"=>1));
			if($isholiday->num_rows() > 0) {
				$CI->db->select('id,is_half_day');
				$is_compholiday=$CI->db->get_where("company_holidays_master",array("comp_id"=>$c_id, "user_id"=>$u_id, "hm_type" => '1', "hm_date" => $todate, "hm_is_app" => '1',  "status"=>1));
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
					$is_empholiday=$CI->db->get_where("company_holidays_master",array("comp_id"=>$c_id, "user_id"=>$u_id, "hm_type" => '1', "hm_date" => $todate, "hm_is_app" => '2',  "status"=>1))->row();
					
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
		return FALSE;
	}
 }
 /*********************************************************/
 if ( ! function_exists('calender_emp_rotat_shift')) {    
    function calender_emp_rotat_shift($comp_id=NULL,$user_id=NULL,$effective_from=FALSE,$emp_id=FALSE) {
		$data=array();
		$data['empty']=true;
		if($comp_id && $user_id && $effective_from && $emp_id){
			$CI =& get_instance();
			$CI->db->select('id,shift_id,remarks,is_wh');
			$data['shift']=$CI->db->get_where("emp_assign_shift",array("user_id" => $user_id, "comp_id" => $comp_id, "emp_id" => $emp_id, "effective_from" => $effective_from, "status" => 1, 'shift_id !=' => 0,'shift_type' => 2,'is_published' => 1 ))->result();
			//echo $this->db->last_query();die;
            if($data['shift']){
				$data['empty']=false;
			}
		}
		//pr($data); die;
		return $data;
	}
}
/*******************************************************************/
function getshiftdata($shift_id)
{   
        $CI =& get_instance();
        $nodata="";
        $shift_master = $CI->db->select('id,sft_name,sft_code,in_time,is_next_day,out_time')->get_where("company_shift_master",array("comp_id"=>$CI->session->userdata('userinfo')->comp_id, "user_id"=>$CI->session->userdata('userinfo')->id, 'status !='=>0))->result_array();
                    if(isset($shift_master) && !empty($shift_master)){
                        return $shift_master;
                    }else{
                        return $nodata;
                    }
 }
//==========================================================//
/**
 * view_layout for FrontEnd
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('view_fronendlayout')) {
    function view_fronendlayout($views = array(), $data = array()) {
        $CI =& get_instance();
        $CI->load->view("header_front", $data);
		foreach($views as $view) {
            $CI->load->view($view, $data);
        }
		$CI->load->view("footer_front", $data);
    }
}

//=====================Get all State====================//
/**
 * get_all_location for FrontEnd
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('get_all_location')) {
    function get_all_location($loctype = array()) {
        $CI =& get_instance();
        $result=$CI->db->order_by('name', 'ASC')->get_where('location',array('location_type' => $loctype));
		return $result->result();
    }
}

//=====================Close Get all State====================//

//=================Captcha=========================================//
/**
 * getcaptchacode for FrontEnd
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
    function getcaptchacode(){
        $CI =& get_instance();
        $CI->load->helper('captcha');
        //$listAlpha ='0123456789';//abcdefghijklmnopqrstuvwxyz0123456789
        $listAlpha ='abcdefghijklmnopqrstuvwxyz0123456789';
        $numAlpha=5;
        $captcha=substr(str_shuffle($listAlpha),0,$numAlpha);
        /*$code_captcha = array(
                         'captcha' => $captcha
                        );
        $CI->session->set_userdata('codecaptcha',$code_captcha);*/
        $path = config_item('base_url').'bucket/images/company/captcha/';
        //$fontpath = config_item('base_url').'bucket/frontend/assets/fonts/TitilliumWeb-BoldItalic.ttf';
        $fontpath = 'bucket/frontend/assets/fonts/verdana.ttf';        
        $vals = array(
			'word'   => $captcha,
			'img_path' => './bucket/images/company/captcha/',
			'img_url' => $path,
            //'font_path'	 => 'c:/windows/fonts/verdana.ttf',
            'font_path'	 => $fontpath,
			'img_width'	 => '159',
			'img_height' => '32',
			'border' => 0,
			'expiration' => 1800
		);
        //pr($vals); die;    
        $get_captcha = create_captcha($vals); //pr($get_captcha); die;
        $CI->session->set_userdata('codecaptcha',$get_captcha['word']);
        return $get_captcha;
    }
//=================Close Captcha=========================================//
//=============central pf calculated on================================//
/**
 * get_all_location for FrontEnd
 * 
 * Display Page with header and footer file
 * @access	public
 */ 
if(!function_exists('get_pfcalculatedon')) {
    function get_pfcalculatedon() {
        $CI =& get_instance();
        $prvyr=date('Y');
        $nxtyr=date('Y')+1;
        if(date('m')>=1 && date('m')<=3){
            $prvyr=date('Y')-1;
            $nxtyr=date('Y');
        }
        $result=$CI->db->select('pf_on')->get_where('pf_data',array('financial_year' => $prvyr.'#'.$nxtyr));
		if($result->num_rows()){
		  return $result->row()->pf_on;
		} else {
		  $result2=$CI->db->order_by('id','Desc')->select('pf_on')->get_where('pf_data',array('financial_year !=' => ''));
          if($result2->num_rows()){
            return $result2->row()->pf_on;
          } else {
            return '15000';
          }
		}
    }
}

/*------------------------------------------------------------------------------*/ 
function sdata_get($sdata)
{
	foreach($sdata as $rec): 
		if($rec > 31)
			$sdata1[] = $rec;
	endforeach;
	$CI = & get_instance();
	$CI->session->set_userdata('all_site_ids', $sdata1);
}
function _get_document($emp_id,$comp_id,$user_id,$docs_id)
{
   
 if($comp_id && $user_id && $docs_id && $emp_id ){
 $CI = & get_instance();   
 $contqry=$CI->db->select('id')->get_where('employee_document',array('c_id' => $comp_id, 'user_id' => $user_id, 'emp_id' => $emp_id,'master_doc_id'=>$docs_id, 'status' => '1'));
 if($contqry->num_rows()>0){
    return 'yes';
 }
 else{
    return 'no';
 }

}
}
//=================check module permission of a company start================//
    function check_module_prmsn($module_name,$comp_id){
       $data['prmsn']=0;
       $CI = & get_instance();
       if($CI->session->userdata['userinfo']->s_id)
       { 
        $site_id=$CI->session->userdata['userinfo']->s_id;
       }
       mysql_select_db('tekhrm_central');
       error_reporting(E_ALL ^ E_DEPRECATED);
       //$CI->db->close();
      // $newdb=  $CI->load->database('tekhrm_central',TRUE);
      // $CI->db->initialize();
       $CI->db->where_in('status',array('1','2'));
       $checkcmp=$CI->db->select('*')->get_where('company_registration',array('id'=>$comp_id));  
       if($checkcmp->num_rows())
       {
             if(isset($checkcmp->row()->module_prmsn) && !empty($checkcmp->row()->module_prmsn))
             {
                    $prmsnarr=json_decode($checkcmp->row()->module_prmsn);
                    if(is_object($prmsnarr) && isset($prmsnarr->$module_name) && !empty($prmsnarr->$module_name) && $prmsnarr->$module_name==101 )
                    {
                        $data['prmsn']=1; 
                    }
             }
       } 
       mysql_select_db(DB_PREFIX.$site_id);
      // $CI->db->close(); 
      return $data;      
      }
//=================check module permission of a company close================// 
//==========Close central pf calculated on=============================//
//=============connect to central database==============
/*
 * connect_to_central_db 
 * To connect Central Db
 * @access	public
 * @author  GohrmINC
 * @return return DB Coonect
 */
    function connect_to_central_db()
    {
         $CI = &get_instance();
         $CI->load->database();
         $confignew['hostname'] = $CI->db->hostname;
         $confignew['username'] = $CI->db->username;
         $confignew['password'] = $CI->db->password;
         $confignew['database'] = DB_PREFIX.'central';
         $confignew['dbdriver'] = $CI->db->dbdriver;
         $confignew['dbprefix'] = $CI->db->dbprefix;
         $confignew['pconnect'] = TRUE;
         $confignew['db_debug'] = TRUE;
         $confignew['cache_on'] = FALSE;
         $confignew['cachedir'] = "";
         $confignew['char_set'] = "utf8";
         $confignew['dbcollat'] = "utf8_general_ci";
         $confignew['swap_pre'] = '';
         $confignew['autoinit'] = TRUE;
         $confignew['stricton'] = FALSE;
         return $confignew; 

         //$this->db = $this->load->database($confignew,TRUE);
    }
//=============================Connect to central db=======================// 
//=============================Connect to Particulart db=======================//    
    function connect_to_particular_db($s_id)
    {
        $CI = &get_instance();
        $CI->load->database();
        $confignew['hostname'] = $CI->db->hostname;
        $confignew['username'] = $CI->db->username;
        $confignew['password'] = $CI->db->password;
        $confignew['database'] = DB_PREFIX.$s_id;
        $confignew['dbdriver'] = $CI->db->dbdriver;
        $confignew['dbprefix'] = $CI->db->dbprefix;
$confignew['pconnect'] = TRUE;
        $confignew['db_debug'] = TRUE;
        $confignew['cache_on'] = FALSE;
        $confignew['cachedir'] = "";
        $confignew['char_set'] = "utf8";
        $confignew['dbcollat'] = "utf8_general_ci";
        $confignew['swap_pre'] = '';
        $confignew['autoinit'] = TRUE;
        $confignew['stricton'] = FALSE;
         
        $CI->load->dbutil();
        if ($CI->dbutil->database_exists($confignew['database']))
        {
            return $confignew;
        }
        else
        {
            echo "Not able to connect to database.";die;
        }
        //$this->db = $this->load->database($confignew,TRUE);
    }
//=============================Connect to Particulart db=======================//    
    function connect_to_particular_db_witout_die($s_id)
    {
        $CI = &get_instance();
        $CI->load->database();
        $confignew['hostname'] = $CI->db->hostname;
        $confignew['username'] = $CI->db->username;
        $confignew['password'] = $CI->db->password;
        $confignew['database'] = DB_PREFIX.$s_id;
        $confignew['dbdriver'] = $CI->db->dbdriver;
        $confignew['dbprefix'] = $CI->db->dbprefix;
        $confignew['pconnect'] = TRUE;
        $confignew['db_debug'] = TRUE;
        $confignew['cache_on'] = FALSE;
        $confignew['cachedir'] = "";
        $confignew['char_set'] = "utf8";
        $confignew['dbcollat'] = "utf8_general_ci";
        $confignew['swap_pre'] = '';
        $confignew['autoinit'] = TRUE;
        $confignew['stricton'] = FALSE;
        
        $CI->load->dbutil();
        if ($CI->dbutil->database_exists($confignew['database']))
        {
            return $confignew;
        }
        else
        {
            $confignew=array();
            return $confignew;
        }
        //$this->db = $this->load->database($confignew,TRUE);
    }

//==========Get Bank Name================//
function _get_bank_name($bank_id=NULL, $salary_mode=NULL)
{
	if($bank_id && $salary_mode)
	{
		$CI = &get_instance();
		if($salary_mode==1)
		{
			$qry=$CI->db->select('bank_name')->get_where('company_bank_details',array('id' => $bank_id));
			if($qry->num_rows())
			{
				return ucfirst($qry->row()->bank_name);
			}
			
		}
		else if($salary_mode==2 || $salary_mode==4)
		{
			$qry=$CI->db->select('bankname')->get_where('bank_list',array('id' => $bank_id));
			if($qry->num_rows())
			{
				return ucfirst($qry->row()->bankname);
			}
		}
	}
	else
	{
		return 'Not Available'; 
	}
}
//==========Get Bank Name================//

//================Custom Encode===================//
/**
 * ID_encode()
 * 
 * return Encoded value
 *
 * @access	public
 */
if (!function_exists('ID_encode')) {

    function ID_encode($id) {
        $encode_id = '';
        if ($id) {
            $encode_id = rand(1111, 9999) . (($id + 19)) . rand(1111, 9999);
        } else {
            $encode_id = '';
        }
        return $encode_id;
    }

}
//==============Close Custom Encode===============//
//=============Custom Decode Function=============//
/**
 * ID_decode()
 * 
 * return Decode value
 *
 * @access	public
 */
if (!function_exists('ID_decode')) {

    function ID_decode($encoded_id) {
        $id = '';
        if ($encoded_id) {
            $id = substr($encoded_id, 4, strlen($encoded_id) - 8);
            $id = $id - 19;
        } else {
            $id = '';
        }
        return $id;
    }

}

//===========Close Custom Decode Function=========//

if(!function_exists('custompaging'))
{
    function custompaging($cur_page,$no_of_paginations,$previous_btn,$next_btn,$first_btn,$last_btn)
    {
        $msg='';
        if ($cur_page >= 10)
        {
            $start_loop = $cur_page - 5;
            if ($no_of_paginations > $cur_page + 5)
            {
                $end_loop = $cur_page + 5;
            }
            else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 9)
            {
                $start_loop = $no_of_paginations - 9;
                $end_loop = $no_of_paginations;
            } 
            else
            {
                $end_loop = $no_of_paginations;
            }
        } 
        else 
        {
            $start_loop = 1;
            if ($no_of_paginations > 10)
                $end_loop = 10;
            else
                $end_loop = $no_of_paginations;
        }
        //===========view parts===========//
        $msg .= "<div class='text-right'style='margin-right:15px;'><div class='dataTables_paginate paging_simple_numbers'>
                    <ul class='pagination'>";
                    // FOR ENABLING THE FIRST BUTTON
                    if ($first_btn && $cur_page > 1)
                    {
                        $msg .= "<li p='1' class='paginate_button previous '>First</li>";
                    }
                    else if ($first_btn)
                    {
                        $msg .= "<li p='1' class='paginate_button previous disabled '>First</li>";
                    }
                    // FOR ENABLING THE PREVIOUS BUTTON
                    if ($previous_btn && $cur_page > 1)
                    {
                        $pre = $cur_page - 1;
                        $msg .= "<li p='$pre' class='paginate_button previous '><a href='#'><i class='fa fa-angle-left'></i></a></li>";
                    }
                    else if ($previous_btn)
                    {
                        $msg .= "<li class='paginate_button previous disabled'><a href='#'><i class='fa fa-angle-left'></i></a></li>";
                    }
                    for ($i = $start_loop; $i <= $end_loop; $i++)
                    {
                        if ($cur_page == $i)
                            $msg .= "<li p='$i'  class='paginate_button  active current'><a>{$i}</a></li>";
                        else
                            $msg .= "<li p='$i' class=' paginate_button  active'><a>{$i}</a></li>";
                    }

                    // TO ENABLE THE NEXT BUTTON
                    if ($next_btn && $cur_page < $no_of_paginations)
                    {
                        $nex = $cur_page + 1;
                        $msg .= "<li p='$nex' class='paginate_button next '><a href='#'><i class='fa fa-angle-right'></i></a></li>";
                    }
                    else if ($next_btn)
                    {
                        $msg .= "<li class='paginate_button next disabled '><a href='#'><i class='fa fa-angle-right'></i></a></li>";
                    }

                    // TO ENABLE THE END BUTTON
                    if ($last_btn && $cur_page < $no_of_paginations)
                    {
                        $msg .= "<li p='$no_of_paginations' class='active'>Last</li>";
                    } 
                    else if ($last_btn)
                    {
                        $msg .= "<li p='$no_of_paginations' class='inactive'>Last</li>";
                    }
                    $total_string = "<span class='totalfront pull-left' style='padding:20px 15px 0' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
                    $msg = $msg . "</ul>" . $total_string . "</div>";  // Content for pagination
return $msg;
         
    }
}