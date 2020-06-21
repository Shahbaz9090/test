<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * User Controller
 *
 * @package		User
 * @subpackage	User
 * @category	User 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Dice_group extends MY_Controller {
    private $data = array();
    private $export_limit = null;
    private $delete_limit = null;
    function __construct() {
        parent::__construct();
        isProtected();
        //pr(currentuserinfo());die;
        $this->load->model('dice_group_mod');
        $this->lang->load('dice_group', get_site_language());
        $this->data['head']['title'] = "Dice Group";
        $this->data['readonly'] = null;
        $this->data['base_url'] = base_url("user/dice_group");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name = "dice_group";

        $this->data['module'] = 'Dice_group';
        $this->data['module_link'] = base_url("user") . "/list_items";
    }
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * function add new User
     * 
     * @access	public
     * @return	html data
     */
    public function add() {
        if (isPostBack()) {
            $id = $this->dice_group_mod->add();
            if ($id) 
			{
                redirect($this->data['base_url'] . "/list_items/");
            } else 
			{
                redirect($this->data['base_url'] . "/add/");
            }
        }
        ///////////////check customer's user creation limit /////////////////
        if (@currentuserinfo()->is_customer == "1") {
            if (is_user_limit() == false) {
                $this->data['user_exceed']=1;
            }
        }
        //////////////////////////////////////////////////////////////////////////////////////////
        
        $this->data['candidate'] = $this->dice_group_mod->get_candidate();
        $this->data['action'] = "add";
        $views[] = "dice/user_form";

        $this->data['submodule'] = "Add User";
        view_load($views, $this->data);
    }
    // ------------------------------------------------------------------------
    /**
     * View
     *
     * This function View User Detail
     * 
     * @access	public
     * @param   int - User Id
     * @return	html data
     */
    public function view($id = null) {
        $result = $this->dice_group_mod->get($id);
        $this->data['result'] = $result;
        $users = $this->dice_group_mod->get_users($result->group_id);
        $this->data['users'] = $users;
        $this->data['readonly'] = 'readonly="true"';
        $this->data['action'] = "view";
        $views[] = "user_view";
        $this->data['groups'] = $this->dice_group_mod->view_groups($result->group_id);

        $this->data['submodule'] = "View User";
        view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------
    /**
     * Edit
     *
     * This function Edit User Details
     * 
     * @access	public
     * @param   int - User Id
     * @return	html data
     */
    public function edit($id = null) {
        if (isPostBack()) {
            $result = $this->dice_group_mod->update($id);
            if ($result) {
                redirect($this->data['base_url'] . "/list_items/");
            } else {
                redirect($this->data['base_url'] . "/edit/");
            }


        }
		$this->data['result'] = $this->dice_group_mod->get($id);
        $this->data['candidate'] = $this->dice_group_mod->get_candidate();
        $this->data['action'] = "edit";
        $views[] = "dice/user_form";

        $this->data['submodule'] = "Edit User";
        view_load($views, $this->data);
    }

    // ------------------------------------------------------------------------
    /**
     * list items
     *
     * This function display all User list
     * 
     * @access	public
     * @return	html data
     */
    public function list_items() {
        $views[] = "dice/user_list";
        $this->data['title'] = lang('list_title');
        $this->data['place_holder'] = "Enter Filter terms here";
        $this->data['action'] = "list";

        $this->data['grid']['cols'] = $this->dice_group_mod->get_flexigrid_cols();

        $this->data['grid']['base_url'] = $this->data['base_url'];
        $this->data['grid']['export_limit'] = $this->export_limit;
        $this->data['grid']['delete_limit'] = $this->delete_limit;

        //check session offset
        if ($this->session->flashdata('offset')) {
            $this->data["offset"] = $this->session->flashdata('offset');
        } else {
            $this->data["offset"] = 1;
        }
        $text = $this->input->post('text');
        $limit = @$_COOKIE['limit'] ? @$_COOKIE['limit'] : '10';
        $offset = 1;
        $order_by = 'id';
        $order = 'desc';
        $result = $this->dice_group_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        $data1 = array();
        foreach ($result['result'] as $row) {
            $row->permission = '<a href="#" data-toggle="modal" data-target="#commonModel" onClick="return getUserPermission(' .
                $row->id . ')">Set Group Permission</a>';
            $row->status = '<a style="cursor:pointer;" data-toggle="modal" id="status' . $row->id .
                '" data-target="#commonModel" onClick="return getUserStatus(' . $row->id . ')" >' . $row->status .
                '</a>';
            $data1[] = $row;
        }

        if ($data1 != null) {
            $data['result'] = $data1;
        }
        $this->data['grid']['result'] = $result;
        $this->data['grid']["page_offset"] = 1;
        $this->data['grid']["limit"] = $limit;
        $this->data['grid']["order_by"] = 'id';
        //pr($this->data['grid']);exit;
        $this->data['submodule'] = 'Candidate List';
        view_load($views, $this->data);

    }

    // ------------------------------------------------------------------------
    /**
     * Ajax list items
     *
     * This function display all User list
     * 
     * @access	public
     * @return	html data
     */

    public function ajax_list_items($limit = 10) {
        //pr($_POST);
        $user = currentuserinfo();
        $perPage = $this->dice_group_mod->perPage($user->id);

        if ($perPage) {
        } else {
            $controllerInfo = $this->uri->segment(1) . "/" . $this->uri->segment(2);
            $pageArr = array(
                'action' => $controllerInfo,
                'records' => $this->input->get_post('rp', true),
                'user_id' => $user->id);
            $this->candidate_mod->insert_perPage($pageArr);
        }


        if ($this->input->post("order_by")) {
            $order_by = $this->input->post("order_by");
        } else {
            $order_by = 'id';
        }
        if ($this->input->post("order")) {
            $order = $this->input->post("order");
        } else {
            $order = 'desc';
        }
        $offset = $this->input->post("offset");
        if (!$offset) {
            $offset = 1;
        }
        if (!$limit) {
            $limit = 10;
        }
        if ($this->input->post("limit")) {
            $limit = $this->input->post("limit");
            $this->data["hiddenLimit"] = $limit;
        }
        if ($this->input->post('text')) {
            $text = $this->input->post('text');
        } else {
            $text = null;
        }

        $data = $this->dice_group_mod->ajax_list_items($text, $limit, $offset, $order_by, $order);
        $data1 = array();
        foreach ($data['result'] as $row) {
            $row->permission = '<a href="#" data-toggle="modal" data-target="#commonModel" onClick="return getUserPermission(' .
                $row->id . ')">Set Group Permission</a>';
            $row->status = '<a style="cursor:pointer;" data-toggle="modal" id="status' . $row->id .
                '" data-target="#commonModel" onClick="return getUserStatus(' . $row->id . ')" >' . $row->status .
                '</a>';
            $data1[] = $row;

        }
        if ($data1 != null) {
            $data['result'] = $data1;
        }
        $data['grid']['total'] = $data['total'];
        $data['grid']['cols'] = $this->dice_group_mod->get_flexigrid_cols();
        $data['grid']['result'] = $data['result'];
        $data['grid']["page_offset"] = $offset;
        $data['grid']["limit"] = $limit;
        $data['grid']["base_url"] = $this->data['base_url'];

        //pr($data);exit;
        $this->load->view('kg_grid/ajax_grid', $data);

    }


    // ------------------------------------------------------------------------

    /**
     * Export items
     *
     * This function display Export by id
     * 
     * @access	public
     * @return	html data
     */

    public function export() {
        $data = $this->dice_group_mod->export();
        $headers = array();
        foreach ($data[0] as $k => $v) {
            $headers[] = $k;
        }
        array_to_csv($data, "users.csv", $headers);
    }


    // ------------------------------------------------------------------------

    /**
     * delete items
     *
     * This function display delete by id
     * 
     * @access	public
     * @return	html data
     */

    public function delete() {

        $items = $this->input->get_post('items', true);
        $items_data = str_replace("row", "", $items);
        $items_data = explode(",", $items_data);

        $this->db->where_in("id", $items_data);
        filter_data();
        $this->db->delete($this->table_name);

    }


    // ------------------------------------------------------------------------
    /**
     * Get Users by Group_id
     *
     * This function user status 
     * @access	public
     * @return	html data
     */
    public function status($user_id = null) {
        if ($user_id == null) {
            $user_id = $this->input->post("id", true);
        }
        $check_submitted = $this->input->post("is_submitted", true);
        if ($check_submitted == 1) {
            if (isPostBack()) {
                $result = $this->dice_group_mod->user_status_update($user_id);
                if ($result) {
                    $this->data["updated"] = true;
                    echo $result_status = $this->dice_group_mod->get($user_id)->status;
                } else {
                    $this->data["error"] = true;
                    $this->data['result'] = $this->dice_group_mod->get($user_id);
                    $views[] = "user_status_update";
                    $this->load->view('user_status', $this->data);
                }
            }
        } else {
            $this->data['result'] = $this->dice_group_mod->get($user_id);
            $views[] = "user_status_update";
            $this->load->view('user_status', $this->data);
        }

    }

    //------------------------------------------------------------------------
    /**
     * Get Users by Group_id
     *
     * This function display all users by Group_id
     * 
     * @access	public
     * @return	html data
     */

    public function get_users($group_id = null) {

        $users = $this->dice_group_mod->get_users($group_id);

        if (count($users) > 0)
            echo '<option value=""><--Select Users--></option>';
        else
            echo '<option value=""><--No User--></option>';

        foreach ($users as $row) {
            echo '<option value="' . $row->id . '">' . $row->first_name . '  ' . $row->last_name . '</option>';

        }


    }

    //------------------------------------------------------------------------
    /**
     * Get group users by Group_id
     *
     * This function display all users by Group_id
     * 
     * @access	public
     * @return	html data
     */

    public function get_group_users($group_id = null) {

        $users = $this->dice_group_mod->get_group_users($group_id);
        pr($users);

        if (count($users) > 0)
            echo '<option value=""><--Select Users--></option>';
        else
            echo '<option value=""><--No User--></option>';

        foreach ($users as $row) {
            echo '<option value="' . $row->id . '">' . $row->first_name . '  ' . $row->last_name . '</option>';

        }


    }

    //------------------------------------------------------------------------
    /**
     * Get Users by Group_id
     *
     * This function display all users by Group_id
     * 
     * @access	public
     * @return	html data
     */

    public function get_parent_group($group_id = null) {

        $users = getParentGroup($group_id);

        $users_reverse = array_reverse($users);

        if (count($users) > 0)
            echo '<option value=""><--Select Group--></option>';
        else
            echo '<option value=""><--No Group--></option>';

        foreach ($users_reverse as $row) {
            if ($row != 0) {
                $name = $this->dice_group_mod->view_groups($row);
                echo '<option value="' . $name->id . '">' . $name->name . '</option>';
            }


        }


    }


    // ------------------------------------------------------------------------

    /**
     * Get USers by Group_id
     *
     * This function display all users by Group_id
     * 
     * @access	public
     * @return	html data
     */
    public function set_permission($user_id = null) {
        if ($this->input->post("id", true) != null) {
            $user_id = $this->input->post("id", true);
        }

        $check_submitted = $this->input->post("is_submitted", true);
        if ($check_submitted == 1) {
            if (isPostBack()) {
                if ($this->dice_group_mod->set_permission($user_id))
                    $data['updated'] = true;
            }
        }

        $data['result'] = $this->dice_group_mod->get($user_id);
        $data['permission'] = $this->dice_group_mod->get_permission($user_id);
        $data['user_id'] = $user_id;
        $data['groups'] = $this->dice_group_mod->get_groups();
        $this->load->view("user_permission", $data);
    }

    function profile_setting() {
        $userData = currentuserinfo();
        $userId = $userData->id;
        $this->data['result'] = $this->dice_group_mod->get($userId);
        if (isPostBack()) {

            $this->load->library('upload');
            if (!empty($_FILES['profile_image']['name'])) {
                $config['upload_path'] = "./assets/images/";
                $config['allowed_types'] = 'doc|docx|gif|jpg|png|GIF|JPG|PNG|JPEG|jpeg';
                $config['max_size'] = '0';
                $config['max_width'] = '0';
                $config['max_height'] = '0';
                $config['remove_spaces'] = true;
                $this->upload->initialize($config);
                if ($this->upload->do_upload('profile_image')) {
                    $this->upload->display_errors('<p>', '</p>');
                    $data = array('upload_data' => $this->upload->data());
                    $data = $this->upload->data();
                }
                $image = $_FILES['profile_image']['name'];
            } else {
                $image = $this->input->post('hidden_profile_image');
            }
            $updatedArr = array(
                "first_name" => $this->input->post("first_name"),
                "last_name" => $this->input->post("last_name"),
                "profile_image" => $image);


            $update = $this->dice_group_mod->profile_update($userId, $updatedArr);
            if ($update) {
                $profile = $this->session->userdata("userinfo");
                $profile->profile_image = $image;
                $profile->first_name = $this->input->post("first_name");
                $profile->last_name = $this->input->post("last_name");
                $this->session->set_userdata("userinfo", $profile);
                $this->session->set_flashdata("success", "Your profile has been updated successfully");
                redirect(current_url());
            }
        }
        $views[] = "profile_setting";
        $data['title'] = "Edit Profile";
        $this->data['curl'] = $this->data['base_url'];
        view_load($views, $this->data);
    }

    function password_setting() {
        if (isPostBack()) {
            $password = md5($this->input->post('cpassword', true));
            $new_password = md5($this->input->post('password', true));
            $updateData = $this->dice_group_mod->password_setting($password, $new_password);
            if ($updateData) {
                set_flashdata('success', 'Your passowrd has been updated successfully.');
                redirect('dashboard');
            } else {
                set_flashdata('error', 'Your current passowrd is wrong');
                redirect('user/password_setting');
            }
        }
        $views[] = "password_setting";
        $data['title'] = "Password Setting";
        $this->data['curl'] = $this->data['base_url'];
        view_load($views, $this->data);
    }


    function signature() {
        $get_sign = $this->dice_group_mod->get_signature();
        if (isPostBack()) {
            $updateData = $this->dice_group_mod->update_signature();
            if ($updateData) {
                $this->session->set_flashdata('success', 'Your Signature has been updated successfully.');
                redirect('user/signature');
            } else {
                $this->session->set_flashdata('error', 'Your Signature could not updated');
                redirect('user/signature');
            }
        }
        $views[] = "signature";
        $data['title'] = "Signature";
        $this->data['sign'] = $this->dice_group_mod->getSign();
        $this->data['result'] = $get_sign;
        $this->data['curl'] = $this->data['base_url'];
        view_load($views, $this->data);
    }

    public function checkEmailExistence() {
        is_ajax_request();
        $email = $this->input->post('email', true);
        $result = $this->dice_group_mod->check_user_existance($email);
        if ($result == true)
            echo true;
    }
    
     public function hierarchy($emp_id = 7){
        $data['submodule'] = "My Team";
        if ($this->input->is_ajax_request()) {
			$data['emp_id'] = currentuserinfo()->id;
			//$data['ajax_heirarchy'] = $this->empmaster_mod->searchmychild_heirarchy($this->comp_id, $this->user_id, $emp_id);
			//clearPostData();
			$views[] = "heirarchy_structure/empHierarchyAjx";
			//ajax_layout($views,$data);
			$this->load->view('heirarchy_structure/empHierarchyAjx', $data);
		}
		else
		{
			//$data['emp_id'] = $emp_id;
			$data['title'] = "Hierarchy Tree";
			$data['bCrmb_func'] = "Heirarchy Tree";
			$views[] = "heirarchy_structure/empHierarchy"; 
			$data['title'] = "Hierarchy Structure";
			$data['bCrmb_func'] = "Hierarchy Structure";
			view_load($views,$data);
		}
    }


}
