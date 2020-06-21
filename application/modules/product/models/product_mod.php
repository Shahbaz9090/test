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

class Product_mod extends CI_Model {

    var $table = "products";
    var $product_others = "product_others";
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
    function add($data=array()) {
        $data['added_by'] = _userId();
        $data['created'] = date('Y-m-d H:i:s');
        $data['modified'] = date('Y-m-d H:i:s');
        $this->db->insert($this->table, $data);
        $id = $this->db->insert_id();
        return $id;
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
    function edit($data=array()) {
        $id=$data['id'];unset($data['id']);
        $this->db->where('id', $id);
        $result=$this->db->update($this->table, $data);
        return $result;
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
    function get_products($limit = null, $offset = null, $text = null, $order_by = null, $order = null, $status = null) {

        $this->db->select("SQL_CALC_FOUND_ROWS $this->table.*", false);
        if (!empty($text)) {
            $text = strtolower($text);
            $this->db->like("LOWER(CONCAT(name,remarks))", $text);
        }
        $this->db->order_by($order_by, $order);

        $this->db->limit($limit, $offset);
         
        if (_isTaleMarketer() || _isSalesPerson()) { //talemarketer and sales person lists own or assigned data only
            $this->db->where('added_by', _userId());
        }
        
        if($status){
            $this->db->where('p_id !=',0);
        }else{
            $this->db->where('p_id',0);
        }

        $query = $this->db->get($this->table);
        $result['result'] = $query->result_array();

        $total_record = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $result['total_data'] = $total_record->row()->count;

        return $result;
    }

    function grid_cols() {
        $data[] = array(
        "display" => "Facility Type",
        "name" => "facility_type",
        "fetch_name" => "facility_type",
        "sorting" => "no");

        $data[] = array(
        "display" => "Name",
        "name" => "name",
        "fetch_name" => "name",
        "sorting" => "yes");

        $data[] = array(
        "display" => "Amount",
        "name" => "amount",
        "fetch_name" => "amount",
        "sorting" => "no");

        $data[] = array(
        "display" => "Status",
        "name" => "status",
        "fetch_name" => "status",
        "sorting" => "no");

        return $data;
    }

    function delete_row($id = null) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }
//----------------------------------------------------------------------
   function getProductService(){
       $facility_type=$this->input->post('facility_type');
       $this->db->select('id,name');
       $this->db->from($this->table);
       $this->db->where('facility_type',$facility_type);
       $this->db->where('p_id',0);
       $query=$this->db->get();
       if($query->num_rows()){
         return $query->result();
       }
       return false;
   }
//----------------------------------------------------------------------
   function getProductDetail($id=null){
       $this->db->select('*');
       $this->db->from($this->table);
       $this->db->where('id',$id);
       $query=$this->db->get();
       if($query->num_rows()){
         $row=$query->row();
         $facilityType=_facilityType();
         $productStatus=_productStatus();
         $currency=_currency();
         $row->facility_type=$facilityType[$row->facility_type];
         $row->status=$productStatus[$row->status];
         $row->currency=$currency[$row->currency];
         return $row;
       }
       return false;
   }
   
//-----------------------------------------------------------------------
 /**
     * addOthers
     *
     * This function save dynamic fields data of product form
     * 
     * @access	public
     * @return	TRUE or FALSE 
     */
    function addOthers($data=array()) {
        $productOthers=_otherFieldsData($this->product_others,'product_id',$data['product_id']);
        $data['modified']=_dateTime();
        if($productOthers){
           $this->db->where('product_id',$data['product_id']); 
           $this->db->update($this->product_others,$data); 
        }else{
           $data['created']=_dateTime(); 
           $this->db->insert($this->product_others,$data);   
        }
        return;
    }       
}
