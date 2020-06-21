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

class Choose_company extends CI_Controller {
    var $table = "company";

    function __construct() {
        parent::__construct();
        isProtected();
        $this->load->model('company_mod');
    }

    public function index() {
        $data['page'] = 'company_list';
        $data['title'] = "Company List";
        $data['subTitle'] = "All Company";
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
        $result = $this->company_mod->get_dash_companies($limit, $offset, $text, $order_by, $order);
        $grid_cols = $this->grid_cols();
        foreach ($result['result'] as $k => $v) {
            //$companyData=json_decode($result['result'][$k]['company_data']);//_pr($invoiceData);
            foreach ($grid_cols as $key => $val) {
                 $result[$k][$val['name']] =$v[$val['name']];
                if($val['name']=='select'){
                    $result[$k][$val['name']] ='<input type="radio" value="'.$v['id'].'" class="selection" onchange="FuncToCall(this.value)" name="select">';
                }
            }
        }
        ////////////for grid cols///////////////////
        $result['grid_cols'] = $grid_cols;
        /////////////////////////////////////////

        echo json_encode($result);

    }

    function grid_cols() {
        $data[] = array(
            "display" => "Company Name",
            "name" => "company",
            "fetch_name" => "company",
            "sorting" => "no");
           $data[] = array(
            "display" => "Select",
            "name" => "select",
            "fetch_name" => "select",
            "sorting" => "no");   
            

        return $data;
    }


}
