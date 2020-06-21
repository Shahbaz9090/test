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

class Permission extends MY_Controller {

    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('permission_mod');
    }

    public function index() {
        $data['title'] = "Permission";
        $data['subTitle'] = "Manage Permission";
        $data['page'] = 'permission';
        $data['breadcrumb'] = array('Role & Permissions' => array(
                'link' => SITE_PATH . 'permission',
                'icon' => 'glyphicon  ',
                'status' => 'inactive'));
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
    public function save() {
        if (isPostBack()) {
            $success = $this->permission_mod->save();
            return ($success)? true : false;
        }
    }

}
