<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * referral Controller
 *
 * @package		User
 * @subpackage	User
 * @category	User 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Referral extends CI_Controller {
    var $table = "referral_source";

    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('referral_mod');
    }

    public function index() {
        $this->list_items();
    }
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * function add new User
     * 
     * @access	public
     */
    public function add($lead_id = null) {
        //_pr($_POST);EXIT;
        if (isPostBack()) {
            $this->form_validation->set_rules('referral_name', 'Referral Source', 'trim|required');
            if ($this->form_validation->run() == false) {
                set_flashdata("error", validation_errors());
                redirect(base_url() . "masters/referral/add");
            }

            $name = $this->input->post('referral_name');
            $result = $this->referral_mod->add($name);
            if ($result) {
                set_flashdata("success", "Great !...Referral Source added Successfully");
                redirect(base_url() . "masters/referral/");
            }
        }
        $data['title'] = "Referral Source Add Form";
        $data['subTitle'] = "Fill Referral Source Information";
        $data['page'] = 'referral_form';
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
    public function edit($id = null) {

        if (empty($id)) {
            show_404();
            exit;
        }
        if (isPostBack()) {
            $this->form_validation->set_rules('referral_name', 'Referral Source', 'trim|required');
            if ($this->form_validation->run() == false) {
                set_flashdata("error", validation_errors());
                redirect(base_url() . "masters/referral/edit/".$id);
            }

            $update['name'] = $this->input->post('referral_name', true);
            $update['id']=$id;
            $result = $this->referral_mod->edit($update);
            if($result) {
                set_flashdata("success", "Great !...Referral Source edited Successfully");
                redirect(base_url() . "masters/referral/");
            }
        }
        $data['title'] = "Referral Source Edit Form";
        $data['subTitle'] = "Edit Referral Source Information";
        $data['page'] = 'referral_form';
        $data['action'] = "edit";
        $data['row'] = $this->common_mod->findFirst($this->table, array('id' => $id));

        _layout($data);
    }

    // ------------------------------------------------------------------------
    /**
     * view
     *
     * function add new User
     * 
     * @access	public
     */
    public function view($id = null) {

        if (empty($id)) {
            show_404();
            exit;
        }
        $data['title'] = "Referral Source";
        $data['subTitle'] = "View Referral Source Information";
        $data['page'] = 'view_referral';
        $data['row'] = $this->common_mod->findFirst($this->table, array('id' => $id));
        

        _layout($data);
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
        $data['page'] = 'referral_list';
        $data['title'] = "Referral Source";
        $data['subTitle'] = " All Referral Source Listing";

        _layout($data);
    }

    /**
     *getUsersList
     *
     * This function display all User list
     * 
     * @access	public
     * @return	html data
     */
    public function listGridData() {

        //////////////////for grid use/////////////////////////
        $page = $this->input->post('page');
        $limit = $this->input->post('change_limit');
        $text = $this->input->post('search_text');
        $order_by = $this->input->post('order_by');
        $order = $this->input->post('order');
        /////////////////////////////////////////////////
        $cur_page = $page;
        $page -= 1;
        $offset = $page * $limit;
        $result = $this->referral_mod->get_referral($limit, $offset, $text, $order_by, $order);
        $grid_cols = $this->referral_mod->grid_cols();
        //_pr($grid_cols);exit;
        foreach ($result['result'] as $k => $v) {
            foreach ($grid_cols as $key => $val) {
                $result[$k][$val['name']] = ucwords($v[$val['name']]);
                if($val['name']=='added_by'){
                   $result[$k][$val['name']] = get_user_data($v[$val['name']])->name;   
                }
                
                if($val['name']=='created'){
                   $result[$k][$val['name']] =date("d/M/Y h:i A",strtotime($v[$val['name']]));   
                }
                if($val['name']=='modified'){
                   $result[$k][$val['name']] =date("d/M/Y h:i A",strtotime($v[$val['name']]));   
                }
            }
        }
        //_pr($result);exit;

        ////////////for grid cols///////////////////
        $result['grid_cols'] = $grid_cols;
        /////////////////////////////////////////

        echo json_encode($result);

    }

    public function deleteGridRow() {

        $id = $this->input->post('delete_row');
        $this->referral_mod->delete_row($id);
    }

   
}
