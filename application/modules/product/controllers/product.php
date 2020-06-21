<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Lead Controller
 *
 * @package		User
 * @subpackage	User
 * @category	User 
 * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Product extends MY_Controller {
    var $table = "products";

    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('product_mod');
    }

    public function index() {
        redirect(base_url() . 'product/list_items');
    }
    // ------------------------------------------------------------------------
    /**
     * Add
     *
     * function add new User
     * 
     * @access	public
     */
    public function add($cat = null) {
        if (isPostBack()) {
            $data = $this->input->post(null, true);
            $othersData = $data['data']['other'];
            unset($data['data']);
            $this->db->trans_begin();
            $id = $this->product_mod->add($data);
            if ($id) {
                $othersData['product_id'] = $id;
                $this->product_mod->addOthers($othersData);
                
                ////////email product add details to user
                $currentuserinfo=currentuserinfo();
                $product_name=fieldByCondition("$this->table",array('id'=>$id),"name")->name;
                $content['data']=$data;
                $body=$this->load->view('email_product_detail',$content,true);
                $email_data['to'] = $currentuserinfo->email;
                $email_data['from'] = ADMIN_EMAIL;
                $email_data['sender_name'] = ADMIN_NAME;
                $email_data['subject'] = "Elitebiz Crm- Product/Service addition";
                $email_data['message'] = array(
                    'header' => "New Product/Service $product_name has been added by you!",
                    'body' => $body,
                    'button_content' => 'Click here to view',
                    'button_link' => base_url().'product/view/'.$id);
                _sendEmail($email_data);
                $hierarchy=usersByHierarchy();
                foreach($hierarchy as $user_id=>$user_email){
                    $email_data['to'] = $user_email;
                    $email_data['message']['header']="New Product/Service $product_name has been added by $currentuserinfo->name!";
                    _sendEmail($email_data);
                }
                //////////////////////////////////////////////
                
                set_flashdata("success", "Great..!! Product/Service added successfully.");
            } else {
                set_flashdata("error", "Product/Service can't be added because of some error.");
            }
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            if($cat){
                redirect(base_url() . "product/list_items/subproduct");
            }
            redirect(base_url() . "product/list_items");
        }
        $data['title'] = "Product/Service Form";
        $data['subTitle'] = "Add Product/Service";
        $data['page'] = 'product_form';
        if ($cat) {
            $data['page'] = 'subproduct_form';
        }
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
    public function edit($id = null, $cat = null) {
        if (isPostBack()) {
            $data = $this->input->post(null, true);
            $othersData = $data['data']['other'];
            unset($data['data']);
            $this->db->trans_begin();
            $data['id'] = $id;
            $result = $this->product_mod->edit($data);
            if ($result) {
                $othersData['product_id'] = $id;
                $this->product_mod->addOthers($othersData);
                set_flashdata("success", "Great..!! Product/Service updated successfully.");
            } else {
                set_flashdata("error", "Product/Service can't be updated because of some error.");
            }
            if ($this->db->trans_status() === false) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            redirect(base_url() . "product/list_items");
        }
        $data['title'] = "Product/Service Form";
        $data['subTitle'] = "Edit Product/Service";
        $data['page'] = 'product_form';

        $data['action'] = "edit";
        $data['row'] = $this->common_mod->findFirst($this->table, array('id' => $id));
        // _pr($data['row']);
        // exit;
        $isSupProduct = ($data['row']->p_id) ? true : false;
        if ($isSupProduct) {
            $data['page'] = 'subproduct_form';
        }
        if ($data['row']) {
            _layout($data);
        } else {
            _show404();
            return false;
        }
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

        $data['title'] = "Product/Service Information";
        $data['subTitle'] = "View Product/Service Information";
        $data['page'] = 'view_product';
        $data['module_name'] = 'lead';
        $data['row'] = $this->product_mod->getProductDetail($id);

        if ($data['row']) {
            _layout($data);
        } else {
            _show404();
            return false;
        }
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
    public function list_items($status = null) {
        $data['page'] = 'product_list';
        $data['title'] = "Facility List";
        $data['subTitle'] = "All Facility";
        $data['status'] = $status;
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

        //////////////////for grid use///////////////////
        $page = $this->input->post('page');
        $limit = $this->input->post('change_limit');
        $text = $this->input->post('search_text');
        $order_by = $this->input->post('order_by');
        $order = $this->input->post('order');
        $status = $this->input->post('dynamic');
        /////////////////////////////////////////////////


        $cur_page = $page;
        $page -= 1;
        $offset = $page * $limit;
        $result = $this->product_mod->get_products($limit, $offset, $text, $order_by, $order,
            $status);
        $grid_cols = $this->product_mod->grid_cols();
        //_pr($result);exit;
        foreach ($result['result'] as $k => $v) {
            foreach ($grid_cols as $key => $val) {
                $result[$k][$val['name']] = $v[$val['name']];
                if ($val['name'] == 'facility_type') {
                    $facilityType = _facilityType();
                    $result[$k][$val['name']] = $facilityType[$v[$val['name']]];
                }
                if ($val['name'] == 'status') {
                    $productStatus = _productStatus();
                    $result[$k][$val['name']] = $productStatus[$v[$val['name']]];
                }

            }
        }

        ////////////for grid cols///////////////////
        $result['grid_cols'] = $grid_cols;
        /////////////////////////////////////////

        echo json_encode($result);

    }

    public function deleteGridRow() {
        $ids = @rtrim($this->input->post('delete_row'), ",");
        $idArr = @explode(",", $ids);
        foreach ($idArr as $id) {
            $result=$this->product_mod->delete_row($id);
        }
        echo $result; 
    }

    //-------------------------------------------------------------------------------------------------------------
    public function ajaxProductService() {
        $result = $this->product_mod->getProductService();
        echo '<option value="">Select</option>';
        if ($result) {
            foreach ($result as $row) {
                echo '<option value="' . $row->id . '">' . $row->name . '</option>';
            }
        }
    }
    //-------------------------------------------------------------------------------------------------------------
    public function install() {
        $table = 'form_fields';
        $isDefaultExists = _checkDefaultFields($table, 4);
        if ($isDefaultExists) {
            $this->session->set_flashdata("Error", "Already Installed!");
        } else {
            $field_arr = _defaultProductFields();
            $field_arr['module'] = 4;
            $result = _addDefaultFields($field_arr);
            if ($result) {
                set_flashdata("success", "Product module installed successfully.");
            } else {
                set_flashdata("success",
                    "Product module can't be installed because of some error!.");
            }
        }
        redirect(base_url() . "form");
    }
    //------------------------------------------------------------------------------------------------------------
    /**
     * ajaxProductDetail
     *
     * function return product deatil in json format
     * 
     * @access	public
     */
    public function ajaxProductDetail() {
        $id = $this->input->post('product_id');
        $result = $this->product_mod->getProductDetail($id);
        if ($result) {
            echo json_encode($result);
        } else {
            echo '0';
        }
    }
    //------------------------------------------------------------------------------------------------------------
}
