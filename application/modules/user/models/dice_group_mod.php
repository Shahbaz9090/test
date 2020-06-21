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

class Dice_group_mod extends CI_Model {

    var $table = "site";
    var $user_table = "users";
    var $group_table = "user_groups";
    var $permission_table = "user_group_permissions";
    var $per_page = "per_page";
    var $master_customer_plan = "master_customer_plan";
	var $dice_group_table	=	'dice_group';

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

        $this->form_validation->set_rules('group_name', 'Dice Group Name', 'trim|required');
        $this->form_validation->set_rules('dice_user_name', 'Dice User Name', "trim|required|is_unique[$this->dice_group_table.dice_user_name]");
        $this->form_validation->set_rules('password', 'Dice Password','required|matches[confirm_password]|min_length[6]');
        $this->form_validation->set_rules('confirm_password', lang('confirm_password|min_length[6]'),'required');
        $this->form_validation->set_rules('candidate[]', 'Candidate', "trim|required");
		$this->form_validation->set_rules('status', 'Status', "trim|required");
		//pr($_POST); die;
        if ($this->form_validation->run() == false) {
            set_flashdata("error", validation_errors());
            return false;
        }

        $data['group_name'] 		= 	$this->input->post('group_name', true);
        $data['dice_user_name'] 	= 	$this->input->post('dice_user_name', true);
		$data['password'] 			= 	$this->input->post('password', true);
		$candidate 					= 	$this->input->post('candidate', true);
		$data['candidate'] 			= 	isset($candidate) ? implode(',',$candidate) : '';
        $data['status'] 			= 	$this->input->post('status', true);
        $data['site_id'] 			= 	currentuserinfo()->site_id;
        $data['added_by'] 			= 	currentuserinfo()->id;
        $data['last_ip'] 			= 	current_ip();
        $data['created_time'] 		= 	current_date();
        $this->db->insert($this->dice_group_table, $data);
        $id = $this->db->insert_id();
		set_flashdata("success", lang('success'));
        return $id;
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
        $this->form_validation->set_rules('group_name', 'Dice Group Name', 'trim|required');
        $this->form_validation->set_rules('dice_user_name', 'Dice User Name', "trim|required");
        $this->form_validation->set_rules('candidate[]', 'Candidate', "trim|required");
		$this->form_validation->set_rules('status', 'Status', "trim|required");
		$password = $this->input->post('password', true);
        if ($password != "") {
            $this->form_validation->set_rules('password', 'Password','required|matches[confirm_password]|min_length[6]');
            $this->form_validation->set_rules('confirm_password', 'Confirm Password','required');
			$data['password'] 			= 	$this->input->post('password', true);
        }
		//pr($_POST); die;
        if ($this->form_validation->run() == false) {
            set_flashdata("error", validation_errors());
            return false;
        }

        $data['group_name'] 		= 	$this->input->post('group_name', true);
        $data['dice_user_name'] 	= 	$this->input->post('dice_user_name', true);
		$candidate 					= 	$this->input->post('candidate', true);
		$data['candidate'] 			= 	isset($candidate) ? implode(',',$candidate) : '';
        $data['status'] 			= 	$this->input->post('status', true);

        $this->db->where("id", $id);
        $r = $this->db->update($this->dice_group_table, $data);
        if ($r)
            set_flashdata("success", lang('updated'));

        return $r;
    }


    // ------------------------------------------------------------------------

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

        $this->db->where('id', $id);
        $query = $this->db->get($this->dice_group_table);
        //echo $this->db->last_query();exit;
        if ($query->num_rows() > 0)
            return $query->row();

        //show_404();
    }


    // ------------------------------------------------------------------------

    /**
     * Get Candidate
     *
     * This function Get All Candidate
     * 
     * @access	public
     * @return	Object 
     */
    function get_candidate($id = null) 
	{
        $query = $this->db->get_where('users',array('status' => 'active'));
		if($query->num_rows())
		{
			return $query->result();
		}
		else
		{
			return false;
		}
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
        if ($order_by && $order)
            $this->db->order_by($order_by, $order);

        $this->db->select("SQL_CALC_FOUND_ROWS $this->dice_group_table .*", false);
        $this->db->from("$this->dice_group_table");
        $query = $this->db->get();


        $data['result'] = $query->result();
        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $data["total"] = $query->row()->count;
        $data['offset'] = $offset;
        return $data;
    }


    function get_flexigrid_cols() {
        

        $data[] = array(
            "display" => lang('group_name'),
            "name" => "group_name",
            "order_by" => "yes");
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
        $this->db->where('id', $id);
        $this->db->update($this->user_table, $data);
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
        $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
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
        $this->db->select("$this->table.name as site_name");
        $this->db->from("$this->user_table");
        $this->db->join("$this->group_table", "$this->group_table.id = $this->user_table.group_id", "LEFT");
        $this->db->join("$this->table", "$this->table.id = $this->user_table.site_id", "LEFT");
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
        $database=DEFAULT_DATABASE;
        $email=mysql_real_escape_string($email);
        $query=mysql_query("SELECT id FROM $database.users WHERE email='$email'");
        $count=mysql_num_rows($query);        
        if ($count > 0)
            return true;
    }

    public function get_total_user() {
        $this->db->select('id');
        $query = $this->db->get($this->user_table);
        return $query->num_rows();
    }

}
