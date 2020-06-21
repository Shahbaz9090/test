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

class Profile extends CI_Controller {

    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('user_mod');
    }

    public function index() {
        $user_info = currentuserinfo();
        $data['title'] = "User Profile";
        $data['subTitle'] = "User Profile Page";
        $data['page'] = 'user_profile';
        $data['row'] = get_user_data($user_info->id); //_pr($data['row']);
        $data['breadcrumb'] = array('Profile' => array(
                'link' => SITE_PATH . 'user/profile',
                'icon' => 'glyphicon  glyphicon-user',
                'status' => 'active'));

        _layout($data);
    }

    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * function add new User
     * 
     * @access	public
     */
    public function self_edit() {
        $user_id = currentUserID();
        if (isPostBack()) {
            $this->form_validation->set_rules('first_name', 'First Name', "trim|required");
            $this->form_validation->set_rules('last_name', 'Frist Name', "trim|required");
            $this->form_validation->set_rules('status', 'Status', "trim|required");
            if ($this->form_validation->run() == false) {
                $this->session->set_flashdata("Error", validation_errors());
            } else {
                $result = $this->user_mod->self_edit($user_id);
                if ($result) {
                    redirect(base_url() . "user/profile");
                }
            }
            redirect(base_url() . "user/self_edit");
        }
        $data['title'] = "User Edit Form";
        $data['subTitle'] = "Edit User Information";
        $data['page'] = 'user_self_edit';
        $data['update'] = get_user_data($user_id);

        $this->load->view('layout', $data);
    }
    
    public function view($id=null) {
        $data['title'] = "User Profile";
        $data['subTitle'] = "User Profile Page";
        $data['page'] = 'user_profile';
        $data['row'] = get_user_data($id); //_pr($data['row']);
        $data['is_edit'] = '';
        $data['breadcrumb'] = array('Profile' => array(
                'link' => SITE_PATH . 'user/profile',
                'icon' => 'glyphicon  glyphicon-user',
                'status' => 'active'));

        _layout($data);
    }

}


