<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Site Model
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class User_mod extends CI_Model {

    //var $table = "site";
    var $user_table = "users";
    var $group_table = "user_groups";
    var $permission_table = "user_group_permissions";
    var $per_page = "per_page";
    var $master_customer_plan = "master_customer_plan";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function Add User
     * 
     * @access	public
     * @return	int or Boolean
     */

    

    function add() {
        $this->form_validation->set_rules('employee_id', lang('employee_id'), "trim|required|alphanumeric|is_unique[$this->user_table.employee_id]");
        $this->form_validation->set_rules('group_id', lang('group_name'), 'trim|required');
        $this->form_validation->set_rules('first_name', lang('first_name'), "trim|required");
        $this->form_validation->set_rules('last_name', lang('last_name'), "trim|required");
        $this->form_validation->set_rules('email', lang('email'), "trim|is_unique[$this->user_table.email]");
        $this->form_validation->set_rules('country[]', lang('country'), 'required');
        $this->form_validation->set_rules('state_comp[]', lang('state'), "trim|required");
        $this->form_validation->set_rules('city_comp[]', lang('city'), "trim|required");
        $this->form_validation->set_rules('password', lang('password'),
            'required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password|min_length[6]'),
            'required');
        $this->form_validation->set_rules('status', lang('status'), "trim|required");
        $this->form_validation->set_rules('mobile',lang('mobile'),"required|min_length[10]|max_length[10]|numeric|is_unique[$this->user_table.mobile]");
        $this->form_validation->set_rules('location', lang('location'), "trim|required");
        if ($this->form_validation->run() == false) {
            set_flashdata("error", validation_errors());
            return false;
        }


        ///////////////check customer's user creation limit /////////////////
        if (@currentuserinfo()->is_customer == "1") {
            if (is_user_limit() == false) {
                set_flashdata("error", "You have exceeds the user limit");
                return false;
            }

        }
        //////////////////////////////////////////////////////////////////////////////////////////
        
        ////////////////check users existence in main database////////////////////////////////////
        
        $check_existance=$this->check_user_existance($this->input->post('email', true));
        $check_existance=$this->check_mobile_existance($this->input->post('mobile', true));
       // $check_existance=$this->check_location_existance($this->input->post('location', true));
        $check_existance=$this->check_employee_id_existance($this->input->post('employee_id', true));
        if($check_existance == true)
        {
            set_flashdata("error", "Oops !! This user name taken by someone else.");
            return false;
        }
        //////////////////////////////////////////////////////////////////////////////////////////

         // pr($_POST);die;

        //$var =$this->input->post('location', true);
		//$re = implode(" => ",$var);
        $data['employee_id'] 		= 	$this->input->post('employee_id', true);
        $data['group_id'] 			= 	$this->input->post('group_id', true);
        $data['parent_group_id'] 	= 	$this->input->post('parent_group_id', true);
		$data['parent_user_id'] 	= 	$this->input->post('parent_user_id', true);
        $data['first_name'] 		= 	$this->input->post('first_name', true);
        $data['last_name'] 			= 	$this->input->post('last_name', true);
        $data['email'] 				= 	$this->input->post('email', true);
        $data['mobile'] 		    = 	$this->input->post('mobile', true);
        $data['password'] 			= 	md5($this->input->post('password', true));
        $data['country']            = 	@implode(",", $this->input->post('country', true));
        $data['status'] 			= 	$this->input->post('status', true);
        $data['location']			= 	$this->input->post('location', true);
        $data['state']              =   @implode(",", $this->input->post('state_comp', true));
        $data['city']               =   @implode(",", $this->input->post('city_comp', true));
        $data['status_comment'] 	= 	$this->input->post('status_comment', true);
        $data['ip_based'] 			= 	$this->input->post('ip_based', true);
        $data['site_id'] 			= 	currentuserinfo()->site_id;
        $data['added_by'] 			= 	currentuserinfo()->id;
        $data['last_ip'] 			= 	current_ip();
        $data['created_time'] 		= 	current_date();
		//pr($data);die;
        ///////////////insert user detail in to main database if added by customer/////////////////
        if (@currentuserinfo()->is_customer == "1") {
            insert_other_db(DEFAULT_DATABASE, $this->user_table, $data);
        }
        //////////////////////////////////////////////////////////////////////////////////////////

        $this->db->insert($this->user_table, $data);
        $id = $this->db->insert_id();

        add_report($id);
        set_flashdata("success", lang('success'));
        return $id;
    }


    // ------------------------------------------------------------------------

    /**
     * Get User
     *
     * This function Get User by User id
     * 
     * @access	public
     * @return	Object 
     */
    function get($id = null) {

        //filter_data($this->user_table);
		//$this->db->where('id', $id);
		//$query = $this->db->get($this->user_table);
		$this->db->where('id', $id);
		$query = $this->db->select('*');
		$this->db->from("users");
		$this->db->group_by("id");
        $query = $this->db->get();
        if($query->num_rows() > 0)
           return $query->row();
	

		//val = $this->user_table;
		
		//pr($query);die;
       // show_404();
    }


    // ------------------------------------------------------------------------

    /**
     * Get Groups
     *
     * This function Get All Groups
     * 
     * @access	public
     * @return	Object 
     */
    function get_groups($id = null) {
        $this->db->where("site_id", current_site_id());
		$this->db->where('status', 'active');
        $query = $this->db->get($this->group_table);
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    // ------------------------------------------------------------------------

    /**
     * Get Parent Groups
     *
     * This function Get parent group data
     * 
     * @access	public
     * @return	Object 
     */
    function get_parent_groups($id = null) {
        $this->db->where("site_id", current_site_id());
        $this->db->where_in("id", $id);
		$this->db->where('status', 'active');
        $query = $this->db->get($this->group_table);
        //echo $this->db->last_query();exit;
        return $query->result();
    }


    // ------------------------------------------------------------------------

    /**
     * View Groups
     *
     * This function View Users Groups
     * 
     * @access	public
     * @return	Object 
     */
    function view_groups($id = null) {
        if ($id != null) {
            $this->db->where("id", $id);
        }
		$this->db->where('status', 'active');
        $query = $this->db->get($this->group_table);
        return $query->row();
    }


    // ------------------------------------------------------------------------

    /**
     * Get Users
     *
     * This function Get All Groups
     * 
     * @access	public
     * @return	Object 
     */
    function get_users($group_id = null) {
        $this->db->where("id", $group_id);
        $group_parent = $this->db->get($this->group_table);
        //pr($group_parent->row());exit;
        $group_id_list = $group_parent->row()->parent_group_id;

        $this->db->where("group_id", $group_id_list);
        $this->db->where("status", "active");
        $this->db->where("site_id", currentuserinfo()->site_id);

        filter_data($this->user_table);
        $query = $this->db->get($this->user_table);
        return $query->result();
    }

    // ------------------------------------------------------------------------

    /**
     * Get Users
     *
     * This function Get Group users
     * 
     * @access	public
     * @return	Object 
     */
    function get_group_users($group_id = null) {

        $this->db->where("group_id", $group_id);
		//$this->db->where("(FIND_IN_SET('$group_id',extra_group_id) = 0 AND group_id = $group_id )   ");
        $this->db->where("status", "active");
        $this->db->where("site_id", currentuserinfo()->site_id);

        filter_data($this->user_table);
        $query = $this->db->get($this->user_table);
        return $query->result();
    }


    //----------------------------------------------------------------------------------
    /**
     * Update User
     *
     * This function User Status Update
     * 
     * @access	public
     * @return	int 
     */
    function user_status_update($id = null) {
        $this->form_validation->set_rules('status_comment', lang('status_comment'), "trim|required");
        if ($this->form_validation->run() == false) {
            return false;
        }
        $data['status'] = $this->input->post('status', true);
        $data['status_comment'] = $this->input->post('status_comment', true);
        $data['ip_based'] = $this->input->post('ip_based', true);
        filter_data($this->user_table);
        set_common_update_value();
        $this->db->where("id", $id);
        $this->db->update($this->user_table, $data);
        update_report($id);
        return true;
    }


    //----------------------------------------------------------------------------------
    /**
     * Update User
     *
     * This function Update User
     * 
     * @access	public
     * @return	int 
     */
    function update($id = null) {
        $this->form_validation->set_rules('group_id', lang('group_name'), 'trim|required');
        $this->form_validation->set_rules('first_name', lang('first_name'), "trim|required");
        $this->form_validation->set_rules('last_name', lang('last_name'), "trim|required");
        $this->form_validation->set_rules('email', lang('email'), "trim");
        $this->form_validation->set_rules('country[]', lang('country'), 'required');
        //$this->form_validation->set_rules('email_password', lang('email_password'), "trim|required");
        $this->form_validation->set_rules('status', lang('status'), "trim|required");
        $this->form_validation->set_rules('state_comp[]', lang('state'), "trim|required");
        $this->form_validation->set_rules('city_comp[]', lang('city'), "trim|required");
        $this->form_validation->set_rules('mobile',lang('password'),'required|min_length[10]|max_length[10]|numeric');
        $this->form_validation->set_rules('location', lang('location'), "trim|required");

        $password = $this->input->post('password', true);
        if ($password != "") {
            $this->form_validation->set_rules('password', lang('password'),
                'required|matches[confirm_password]|min_length[6]');
            $this->form_validation->set_rules('confirm_password', lang('confirm_password|min_length[6]'),
                'required');
            $data['password'] = md5($this->input->post('password', true));
        }


        if ($this->form_validation->run() == false) {
            set_flashdata("error", validation_errors());
            return false;
        }
        // pr($_POST);die;
		//$var =$this->input->post('location', true);
		//$re = implode(" => ",$var);
        //$data['employee_id'] 		= 	$this->input->post('employee_id', true);
        $data['group_id'] 			= 	$this->input->post('group_id', true);
        $data['parent_group_id'] 	= 	$this->input->post('parent_group_id', true);
		$data['parent_user_id'] 	= 	$this->input->post('parent_user_id', true);
        $data['first_name'] 		= 	$this->input->post('first_name', true);
        $data['last_name'] 			= 	$this->input->post('last_name', true);
        $data['email'] 				= 	$this->input->post('email', true);
        $data['mobile'] 			= 	$this->input->post('mobile', true);
        $data['location'] 			= 	$this->input->post('location', true);
        $data['country']            =   @implode(",", $this->input->post('country', true));
        $data['state']              =   @implode(",", $this->input->post('state_comp', true));
        $data['city']               =   @implode(",", $this->input->post('city_comp', true));
        $data['status'] 			= 	$this->input->post('status', true);
        $data['email_password']     =   $this->input->post('email_password',TRUE);
        $data['status_comment']     =   $this->input->post('status_comment', true);
        $data['ip_based']           =   $this->input->post('ip_based', true);
		
		// pr($data);die;
        filter_data($this->user_table);
        set_common_update_value();


        $this->db->where("id", $id);
        $r = $this->db->update($this->user_table, $data);
        update_report($id);

        if ($r)
            set_flashdata("success", lang('updated'));

        return $r;
    }


    // ------------------------------------------------------------------------

    /**
     * Get Ajax User
     *
     * This function Get User with Search and offset functions 
     * 
     * @access	public
     * @return	Object 
     */
    function ajax_list_items($text, $limit, $offset, $order_by = 'id', $order = 'desc', $candidate_arr = null) {
        $offset = ($offset - 1) * $limit;

        $this->db->limit($limit, $offset);

        $text = strtolower(trim($text));
        if ($text) {
            $this->db->like("LOWER(CONCAT($this->user_table.first_name,$this->user_table.last_name,$this->user_table.email,$this->user_table.mobile,$this->user_table.status,$this->user_table.employee_id,$this->group_table.name))",
                $text);
        }

        if ($order_by && $order)
            $this->db->order_by($order_by, $order);

        $this->db->select("SQL_CALC_FOUND_ROWS $this->user_table .*", false);
        $this->db->select("$this->group_table.name as group_name");
        //$this->db->select("$this->table.name as site_name");
        $this->db->from("$this->user_table");
        $this->db->join("$this->group_table", "$this->group_table.id = $this->user_table.group_id", "LEFT");
        //$this->db->join("$this->table", "$this->table.id = $this->user_table.site_id", "LEFT");


        filter_data($this->user_table);
        $query = $this->db->get();


        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
        return $data;
    }


    function get_flexigrid_cols() {
        if (currentuserinfo()->is_super_site) {
        $data[] = array(
                "display" => lang('site_name'),
                "name" => "site_name",
                "order_by" => "yes");
        }

        $data[] = array(
            "display" => lang('employee_id'),
            "name" => "employee_id",
            "order_by" => "yes");

        $data[] = array(
            "display" => lang('group_name'),
            "name" => "group_name",
            "order_by" => "yes");


        $data[] = array(
            "display" => lang('permission'),
            "name" => "permission",
            "order_by" => "no");


        $data[] = array(
            "display" => lang('first_name'),
            "name" => "first_name",
            "order_by" => "yes");
        $data[] = array(
            "display" => lang('last_name'),
            "name" => "last_name",
            "order_by" => "yes");
        $data[] = array(
            "display" => lang('email'),
            "name" => "email",
            "order_by" => "yes");
        $data[] = array(
            "display" => lang('mobile'),
            "name" => "mobile",
            "order_by" => "yes");
            /*$data[] = array(
                "display" => lang('location'),
                "name" => "location",
                "order_by" => "yes");*/
        $data[] = array(
            "display" => lang('status'),
            "name" => "status",
            "order_by" => "yes");
        return $data;
    }

    function profile_update($userid = null, $userdata) {

        $data = (array )$userdata;
        $where = "id = $userid";
        $str = $this->db->update_string($this->user_table, $data, $where);
        $query = $this->db->query($str);
        return $query;
    }

    function password_setting($password, $new_password) {
        $database=  INDIA_EROOKIE_DB;
        $userData = currentuserinfo();
        $email = $userData->email;
        $id = $userData->id;
        $query = $this->db->get_where($this->user_table, array('password' => $password, 'id' => $id));
        if ($query->num_rows === 1) {
            $data = array('password' => $new_password);
            $this->db->where('id', $id);
            $this->db->update($this->user_table, $data);
            $result_row = $query->row();
            if($userData->is_customer != 1){
                 $str = "UPDATE $database.users SET  `password` =  '$new_password' WHERE  `users`.`email` = '$email'";
                $query=mysql_query($str);//die;
            }
            return $result_row;
        } else {
            return false;
        }
    }
    /**
     * Update Signature
     * This function updates signature
     * @access	public
     * @return	object 
     */

    function getSign() {
        $data = $this->db->get("user_sign");
        return $data->row()->sign_field;

    }

    function update_signature($id = null) {
        $id = currentuserinfo()->id;
        $data = array(
            'designation' => $this->input->post("designation"),
            'phone_number' => $this->input->post("phone_number"),
            'cell_number' => $this->input->post("cell_number"),
            'fax_number' => $this->input->post("fax_number"),
            'company_name' => $this->input->post("company_name"),
            'certification' => $this->input->post("certification"),
            'company_url' => $this->input->post("company_url"),
            //'disclaimer'=>$this->input->post("message")
            );
			//pr($data);die;
        $this->db->where('id', $id);
        $r = $this->db->update($this->user_table, $data);
		return $r;
    }
	
    /**
     * Get Signature
     * This function gets signature
     * @access	public
     * @return	object 
     */

    function get_signature() {
        $userData = currentuserinfo();
        $id = $userData->id;
        $query = $this->db->get_where($this->user_table, array('id' => $id));
        if ($query->num_rows === 1) {
            return $query->row();
        } else {
            return false;
        }
    }

    //----------------------------------------------------------------------------------
    /**
     * Get  per page listing
     * This function get perpage record in flexigrid     
     * @access	public
     * @return	int 
     */

    function perPage($user_id) {
        $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2)."/".$this->uri->segment(3);
        $this->db->where("action", $controllerInfo);
        $this->db->where("user_id", $user_id);
        $query = $this->db->get($this->per_page);
        if ($query->num_rows > 0) {
            return $query->row()->records;
        } else {
            return false;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @function Name   update()
     * @purpose         to update a record 
     * @return			boolean
     * @created         2 May 2013
     */

    function update_perPage($array, $userId) {
        $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
        $where = "action = '$controllerInfo' AND user_id = $userId";
        $query = $this->db->update_string($this->per_page, $array, $where);
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * @function Name   update()
     * @purpose         to update a record 
     * @return			boolean
     * @created         2 May 2013
     */

    function insert_perPage($array) {
        $query = $this->db->insert_string($this->per_page, $array);
        $result = $this->db->query($query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @function Name   update()
     * @purpose         to update a record 
     * @return			boolean
     * @created         2 May 2013
     */
    function export() {
        $items = $this->input->get_post('items', true);
        $items_data = str_replace("row", "", $items);
        $items_data = explode(",", $items_data);

        $this->db->select("SQL_CALC_FOUND_ROWS $this->user_table .*", false);
        $this->db->select("$this->group_table.name as group_name");
        //$this->db->select("$this->table.name as site_name");
        $this->db->from("$this->user_table");
        $this->db->join("$this->group_table", "$this->group_table.id = $this->user_table.group_id", "LEFT");
        //$this->db->join("$this->table", "$this->table.id = $this->user_table.site_id", "LEFT");
        $this->db->where_in("$this->user_table.id", $items_data);
        filter_data($this->user_table);
        $query = $this->db->get();

        $data = $query->result_array();
        return $data;
    }

    /**
     * method list
     *
     * This function get all controller methods
     * 
     * @access	public
     * @return	array
     */
    function set_permission($user_id = null) {
        $group_name = explode(",", $this->input->post('group_name'));

        $group_id = "";
        if ($group_name != ""):
            foreach ($group_name as $row):
                if ($group_id)
                    $group_id .= ",";
                $group_id .= $row;
            endforeach;
        endif;

        $data['extra_group_id'] = $group_id;

        $this->db->where("id", $user_id);
        $r = $this->db->update("users", $data);
        $email = $this->db->get_where('users',['id'=>$user_id])->row()->email;
        // pr($gt_email);die;
        $gt_email=str_replace('@','_',$email);
        $gt_email=str_replace('.','_',$email);
        $result= cache_opration('delete','getUser_email_'.$gt_email);
        // $this->session->unset_userdata('userinfo');
        return true;

    }

    // ------------------------------------------------------------------------

    /**
     * method list
     *
     * This function get all controller methods
     * 
     * @access	public
     * @return	array
     */

    function get_permission($user_id = null) {
        $this->db->where("id", $user_id);
        $r = $this->db->get("users");

        return $r->row();
    }

    public function check_user_existance($email) {
        //$database=DEFAULT_DATABASE;
        // $email=mysql_real_escape_string($email);
        $query=$this->db->select('id')->from('users')->where('email',$email)->get();
        $count=$query->num_rows();  
        // echo $this->db->last_query();die;    
        if ($count > 0)
            return true;
    }

    public function check_mobile_existance($mobile) {
        //$database=DEFAULT_DATABASE;
        $query=$this->db->query("SELECT id FROM users WHERE mobile='$mobile'");
        $count=$query->num_rows();        
        //pr($mobile);die;
        if ($count > 0)
            return true;
    }
    /*public function check_location_existance($location) {
        $database=DEFAULT_DATABASE;
        $query=mysql_query("SELECT id FROM $database.users WHERE location='$location'");
        $count=mysql_num_rows($query); 
        //pr($location);die;       
        if ($count > 0)
            return true;
    }*/
    public function check_employee_id_existance($employee_id) {
        //$database=DEFAULT_DATABASE;
        $query=$this->db->query("SELECT id FROM users WHERE employee_id='$employee_id'");
        $count=$query->num_rows(); 
        if ($count > 0)
            return true;
    }

    public function get_total_user() {
        $this->db->select('id');
        $query = $this->db->get($this->user_table);
        return $query->num_rows();
    }
	
	function status_update($id  =NULL,$status)
    {
	
			
			if($status=='inactive')
			{
				$status ='active';
			}
			else
			{
				$status ='inactive';
			}
		$user_id= currentuserinfo()->id;
		

		foreach($this->session->userdata('child_list') as $row)		
		{
			$rows[]=str_replace("$user_id","", "$row");
			
		}
	
        //$this->db->where('site_id',current_site_id());
		$this->db->where('id',$id);

		$data['status']= $status;
        $r = $this->db->update($this->user_table,$data);  
		//echo $this->db->last_query();exit;

		         if($this->db->affected_rows()>=1)
				 	{
        				set_flashdata("success",lang('updated')); 
			
					}else{
						set_flashdata("error",lang('permisson'));
					}      
        return $r;
		
    }

    function fetch_city($state_id){
       
        // pr($state_id);die;
        // if(!empty($state_id)){
        //    $state_ids=explode(',',$state_id);
        // }
        $this->db->where('status', '1');
        $this->db->where_in('state_id', $state_id);
        $this->db->order_by('city_name', 'ASC');
        $query = $this->db->get('cities');
        // echo $this->db->last_query();die;
        if($query->num_rows()>0){
            return $query->result();
        }
        
    }

}
