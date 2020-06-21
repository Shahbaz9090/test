<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Cats Auth Model 
 *
 * @package		Auth
 * @subpackage	Models
 * @category	Authentication * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Auth_mod extends CI_Model {

    var $user_table = "users";
    var $group_table = "user_groups";
    var $site_table = "site";
    var $permission_table = "user_group_permissions";
    var $customer_table = "master_customers";


    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    /**
     * Get usrnaeme by id
     *
     * This function get Username if exist
     * 
     * @access	public
     * @param   int - user id
     * @return	string or NULL
     */
    function get_username_by_id($id = null) {
        $this->db->select("username");
        $this->db->where("id", $id);
        $query = $this->db->get($this->user_table);
        if ($query->num_rows() > 0)
            return $query->row()->username;
        return null;
    }

    /**
     * Get Permission Data by group id
     * 
     * @access	public
     * @param   int - group id
     * @return	array - mixed
     */
    function get_permission_by_group_id($group_id = null) {
        $this->db->select("data");
        $this->db->where("group_id", $group_id);
        $query = $this->db->get($this->permission_table);

        $data = array();

        if ($query->num_rows() > 0) {
            $data = unserialize($query->row()->data);
        }
        return $data;
    }

    // ------------------------------------------------------------------------

    /**
     * Get User By Id
     *
     * This function get user details filtered by id
     * 
     * @access	public
     * @param   int - user id
     * @return	mixed Array 
     */
    function get_user_by_id($email = null) {
		$gt_email=str_replace('@','_',$email);
		$gt_email=str_replace('.','_',$email);
		
		if(!empty(cache_opration('get','getUser_email_'.$gt_email)) && '1'=='2')
		{
			$result= cache_opration('get','getUser_email_'.$gt_email);
			//pr($result);die;
			return $result;
		}
		else
		{
			//pr($gt_email);die;
			$this->db->select($this->user_table . ' .*'); //Select user table
			$this->db->select($this->group_table . '.name as group_name');
			$this->db->select($this->group_table . '.parent_group_id as parent_group_id');

			$this->db->select($this->group_table . '.is_super as is_super'); // select user group name
			$this->db->select($this->group_table . '.site_id'); // select user gourp site id
			//$this->db->select($this->site_table . '.is_super as is_super_site'); // select user gourp site id
			//$this->db->select($this->site_table . '.language'); // select user gourp site language
			//$this->db->select($this->site_table . '.is_customer'); /////to check is customer or not

			$this->db->from($this->user_table);
			$this->db->join($this->group_table, "$this->user_table.group_id = $this->group_table.id", "LEFT");
			//$this->db->join($this->site_table, "$this->site_table.id = $this->group_table.site_id", "LEFT");

			$this->db->where("$this->user_table.email", $email);
			$query = $this->db->get();
			//echo $this->db->last_query(); die;
			//echo $this->db->database; die;
			if ($query->num_rows() > 0) {
				$row = $query->row();
				//pr($row);die;
				//$row->parent_user = $this->get_name_by_id($row->id);
				//$row->permission  = $this->get_permission_by_group_id($row->group_id);
				cache_opration('set','getUser_email_'.$gt_email,$row);
				//pr($row); die;
				return $row;
			}
			return false;
		}
    }
      function get_org_user_by_id($email = null) {
        $database = DEFAULT_DATABASE;
        $table = 'users';                
        $sql = "SELECT * FROM $database.$table WHERE email= '$email'";
        $sql_result= mysql_query( $sql );
        $row = mysql_fetch_object($sql_result);
        if($row){
            //print_r($row);
            return $row->id;
            }
         else           
        return false;
    }


    // ------------------------------------------------------------------------

    /**
     * Get Group Users
     *
     * This function get all Group Users filtered by group_id
     * 
     * @access	public
     * @param   int - group id
     * @return	mixed Array 
     */
    function get_group_users($group_id = null) {
        $this->db->where('group_id', $group_id);
        $query = $this->db->get($this->table);

        return $query->results();
    }


    // ------------------------------------------------------------------------

    /**
     * Insert User
     *
     * This function insert user details
     * 
     * @access	public
     * @param   mixed Array
     * @return	int - id - primary key 
     */
    function insert_user($data = array()) {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }


    // ------------------------------------------------------------------------

    /**
     *
     * This function Encode password 
     * 
     * @access	public
     * @param   String   plain string
     * @return	String   encrypted string
     */
    public function encode_pwd($str = '') {
        $this->load->library('encrypt');
        $encrypted_pwd = $this->encrypt->encode($str);
        return $encrypted_pwd;
    }

    // ------------------------------------------------------------------------

    /**
     *
     * This function Decode encrypted password 
     * 
     * @access	public
     * @param   String   encrypted string
     * @return	String   plain string
     */
    public function decode_pwd($str = '') {
        $this->load->library('encrypt');
        $plaintext_string = $this->encrypt->decode($str);
        return $plaintext_string;
    }


    // ------------------------------------------------------------------------

    /**
     * Check Super Site
     *
     * This function check SuperSite
     * 
     * @access	public
     * @return	mixed Array 
     */

    function is_super_site() {

        $this->db->where('is_super', 1);
        $query = $this->db->get("site");

        if ($query->num_rows() > 0)
            return true;

        return false;
    }


    /**
     * forget
     *
     * This function set password and send verification mail
     * 
     * @access	public
     * @return	mixed Array 
     */

    function forget() {

        $this->form_validation->set_rules('email_id', 'Email', 'trim|required|email');
        $email = $this->input->post('email_id', true);

        if ($this->form_validation->run() == false) {
            $return['error_msg'] = validation_errors();
            $return['valid'] = false;
            return $return;
        }
        $this->db->select("$this->user_table.*");  //,$this->site_table.is_customer
        $this->db->from($this->user_table);
        //$this->db->join($this->site_table, "$this->user_table.site_id = $this->site_table.id");
        $this->db->where("$this->user_table.email", $email);
        $result = $this->db->get();
        //$this->db->where("email", $email);
        //$result = $this->db->get($this->user_table);
        //print '<pre>'; print_r($result->row());die;
        if ($result->num_rows > 0) {
            $userData = $result->row();

            $mail_password = random_string('alnum', 6);
            $username = $userData->first_name . ' ' . $userData->last_name;
            $password = md5($mail_password);
            
            $updateData = array('password' => $password);
            $this->db->where('id', $userData->id);
            $updatable = $this->db->update($this->user_table, $updateData);
             $database=  INDIA_EROOKIE_DB;
            if($userData->is_customer != 1){
                 $qry = "UPDATE $database.users SET  `password` =  '$password' WHERE  `users`.`email` = '$email'";
                 $query=mysql_query($qry);
            }
            
            if ($updatable) {

                
                $currentUrl = $_SERVER['HTTP_HOST'];
                $click = " <a href='$currentUrl'>$currentUrl</a>";

                $message = '';
                $message .= "<div style='font-size:16px;'><b>Hello " . $username . "</b>,</div>";
                $message .= '<br/><div>You have requested a new password for E-rookie.</div><br/><br/><div>Your Username : ' .
                    $email . "</div>" . '<br/><div>Password: ' . $mail_password . '<br/></div><br/><div>' . $click .
                    '</div>';

                //$this->load->library('email',$config);
                //$this->email->from(ADMIN_MAIL, 'Admin');
                //$this->email->to($email);
                //$this->email->subject('Forget Password');

                //$data['message'] = $message;
                //$this->email->message($this->load->view('email', $data, true));
                //$this->email->send();
                
                send_mail($email,'Your E-rookie Forget Password',$message);
                
                
                
            }
            $return['valid'] = true;
            return $return;
        }
        $return['error_msg'] = lang('error_email');
        $return['valid'] = false;
        return $return;
    }


    /**
     *
     * This function login authenticate 
     * 
     * @access	public
     * @param   String   plain string
     * @return	String   encrypted string
     */

    function login_authorize() {
        
        $this->form_validation->set_rules('email', 'Email', 'trim|required|email');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');

        $email = $this->input->post('email', true);
        $password = $this->input->post('password', true);

        if ($this->form_validation->run() == false) {
            $data['error_msg'] = validation_errors();
            $data['valid'] = false;
            return $data;
        }
        $this->db->select("$this->user_table.*",false);
        //$this->db->join($this->site_table, "$this->site_table.id=$this->user_table.site_id", 'left');
        /*$this->db->join($this->customer_table, "$this->customer_table.id=$this->site_table.customer_id",
            'left');*/

        $this->db->where("$this->user_table.email", $email);
        $query = $this->db->get($this->user_table);
		//echo $this->db->last_query();die;
        //$other_db['table'] = "users";
        //$other_db['database'] = INDIA_EROOKIE_DB;
        //$other_db['condition'] = array('email' => $email);
        //$india_erookie = select_other_db($other_db);
			//pr($query->num_rows());die;
       if($query->num_rows() == 1 ) {
            $row = $query->row();
			//pr($row);
            if ($row->site_status == 'inactive' && $row->is_customer == 1) {
                $data['error_msg'] = "Your Account has been Expired or Inactive.";
                $data['valid'] = false;
                return $data;
            }

            $ip_addr = array();

            if ($row->login_type == 1) {

                $network_ip = $this->getNetworkIp(); //$this->getNetworkIp(); Use if application is host outside the network

                $network_ip = trim($network_ip);
                $static_ip = explode(",", $row->static_ip);
                foreach ($static_ip as $staticIp) {
                    $static_ip_addr[] = trim($staticIp);
                }
                if (!in_array($network_ip, $static_ip_addr)) {
                    $data['error_msg'] = lang('network_error');
                    $data['valid'] = false;
                    return $data;
                }

            } else
                if ($row->login_type == 2) {
                    $system_ip = $_SERVER['REMOTE_ADDR'];
                    $ip_based_login = explode(",", $row->ip_based);
                    foreach ($ip_based_login as $systemIp)
                        $system_ip_addr[] = trim($systemIp);

                    if (!in_array($system_ip, $system_ip_addr)) {
                        $data['error_msg'] = lang('ip_error');
                        $data['valid'] = false;
                        return $data;
                    }
                }

            if (md5($password) === $row->password) {
                $this->session->set_userdata('dash_name', ucwords($row->first_name));
                

                /////////check is customer //////////////////////
                ///////////////////////for india customers/////////////////
                if ($row->is_customer == true && $row->country == '2') {
                    $this->session->set_userdata('login_type', 'india');
                    $dynamic_key = md5(time());
                    $database = "india_erookie_" . $row->site_id;
                    $temp_pwd = custom_encryption($dynamic_key, $dynamic_key, 'encrypt');

                    update_other_db($database, 'users', array('dynamic_key' => $dynamic_key), " email='" . $row->email .
                        "'");
                    $this->session->set_userdata("indiaerookie_user_id", $row->id);
                    $this->session->set_userdata("indiaerookie_first_name", $row->first_name);
                    $user_id = base64_encode(base64_encode(base64_encode($row->email)));
                    $db = base64_encode(base64_encode(base64_encode($database)));
                    $pwd = str_replace("/", "_", $temp_pwd);
                    redirect(INDIA_EROOKIE . "auth/check_login/$user_id/$pwd/$db");

                } elseif($row->is_customer == true && $row->country == '1') { //////////for us customers/////////
                    $db_name = "erookie_" . $row->site_id;
                    $this->session->set_userdata("db_name", $db_name);
                    if (!$this->load->database('custom', true)) {
                        show_error("Database Connection Error");
                        die;
                    }
                }
                ////////////////////////////////////////////////
                $this->session->set_userdata('login_type', 'us');
                 $user_info = $this->get_user_by_id($row->email);
                 //$user_info->org_id = $this->get_org_user_by_id($erookie->email);              
               
                unset($user_info->password);

                $user_info->last_login = strtotime('now');

                $user_info->name = $user_info->first_name . ' ' . $user_info->last_name;
				//pr($user_info);die;
                if ($user_info->status == "inactive") {
                    $data['error_msg'] = "Your account has been inactive.";
                    $data['valid'] = false;
                    return $data;
                }
                /**
                 * comment this update query to stop update last login on user's table
                 * @by- Nitish Janterparia
                 * @on - 6th nov 2014
                 * 
                 * else{				
                 * $current_date=date("Y-m-d g:i:s");
                 * $data = array("last_login" => $current_date);
                 * $where = "id = $row->id ";
                 * $this->db->update("users", $data, $where);

                 * }
                 **/

                $this->session->set_userdata("language", $user_info->language);
                $this->session->set_userdata("userinfo", $user_info);
                $this->session->set_userdata("isLogin", 'yes');
                // pr($user_info);die;
                child_users($user_info->id);
                //$this->session->set_userdata('child_list', json_encode($list['total_list']));
                get_child($user_info->id, [$user_info->group_id]);
                
                $groups = child_groups($user_info->parent_group_id);
                $this->session->set_userdata('group_list', json_encode($groups));

                $data['valid'] = true;
                return $data;
            }
        }  elseif($query->num_rows() == 2 ) {

            $result = $query->result();
            ///////////////////to check customer status////////////////////////////////////////////////////
            if (($result[0]->site_status == 'inactive' && $result[0]->is_customer == 1) && ($result[1]->
                site_status == 'inactive' && $result[1]->is_customer == 1)) {
                $data['error_msg'] = "Your Account has been Expired or Inactive.";
                $data['valid'] = false;
                return $data;
            }
            ////////////////////////////////////////////////////////////////////////////////////////////


            if ($result[0]->password === md5($password) && $result[1]->password === md5($password)) {

                $this->session->set_userdata('dash_name', ucwords($result[0]->first_name));

                $this->session->set_userdata("multi_customer", 'yes');
                $this->session->set_userdata('multiple_login', 'yes');

                ////////////us erookie customer login ///////////////////////////////////////////////////
                $erookie_data = ($result[0]->country == '1') ? $result[0] : ($result[1]->country == '1') ? $result[1] : show_404();
                if ($erookie_data->site_status == 'active') {
                    $db_name = "erookie_" . $erookie_data->site_id;
                    $this->session->set_userdata("db_name", $db_name);
                    if (!$this->load->database('custom', true)) {
                        show_error("Database Connection Error");
                        die;
                    }

                      
                   $user_info = $this->get_user_by_id($erookie_data->email);
                  //  $user_info->org_id = $this->get_org_user_by_id($erookie->email);
                    unset($user_info->password);

                    $user_info->last_login = strtotime('now');

                    $user_info->name = $user_info->first_name . ' ' . $user_info->last_name;

                    if ($user_info->status == "inactive") {
                        $data['error_msg'] = "Your account has been inactive.";
                        $data['valid'] = false;
                        return $data;
                    }

                    $this->session->set_userdata("language", $user_info->language);
                    $this->session->set_userdata("userinfo", $user_info);
                    $this->session->set_userdata("isLogin", 'yes');

                    $list = child_users($user_info->id);
                    $this->session->set_userdata('child_list', json_encode($list['total_list']));


                    $groups = child_groups($user_info->parent_group_id);
                    $this->session->set_userdata('group_list', json_encode($groups));

                } else {
                    $this->session->set_userdata('us_account_expired', 'yes');
                }


                ////////////////end of us customer login////////////////////////////////////////////////////////////////////


                

                
            }

        }


        $data['error_msg'] = lang('error_login');
        $data['valid'] = false;
        return $data;
    }
    /*
    function getIpUsingCurl() {
    
    $url="http://sayazionnoidaext.in/index.php/ip";
    $ch = curl_init();
    $timeout = 15;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
    }
    */


    function getNetworkIp() {
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
                    if ($this->validate_ip($ip))
                        return $ip;
                }
            } else {
                if ($this->validate_ip($_SERVER['HTTP_X_FORWARDED_FOR']))
                    return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_X_FORWARDED']))
            return $_SERVER['HTTP_X_FORWARDED'];

        if (!empty($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']) && $this->validate_ip($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
            return $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];

        if (!empty($_SERVER['HTTP_FORWARDED_FOR']) && $this->validate_ip($_SERVER['HTTP_FORWARDED_FOR']))
            return $_SERVER['HTTP_FORWARDED_FOR'];

        if (!empty($_SERVER['HTTP_FORWARDED']) && $this->validate_ip($_SERVER['HTTP_FORWARDED']))
            return $_SERVER['HTTP_FORWARDED'];

        // return unreliable ip since all else failed
        return $_SERVER['REMOTE_ADDR'];
    }

    function validate_ip($ip) {
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


    public function is_customer($site_id) {
        $this->db->select('is_customer');
        $this->db->where("id", $site_id);
        $query = $this->db->get($this->site_table);
        if ($query->num_rows() > 0)
            return $query->row();

    }


}
