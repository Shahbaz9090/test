<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Refferal Model
 *
 * @package		User
 * @subpackage	User
 * @category	User * @author		Kumar Gaurav
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Referral_mod extends CI_Model {

    var $table = "referral_source";
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
     * This function Add referrall
     * 
     * @access	public
     * @return	int or Boolean
     */
    function add($name) {
        $data = array(
            'name' => $name,
            'added_by' => currentuserinfo()->id,
            'created' => _dateTime(),
            'modified' => _dateTime());
        $this->db->insert($this->table, $data);
        $inserted_id = $this->db->insert_id();
        if ($inserted_id) {
            return $inserted_id;
        }
    }

    // ------------------------------------------------------------------------

    /**
     * Add
     *
     * This function edit referral
     * 
     * @access	public
     * @return	int or Boolean
     */
    function edit($data) {
        $dataArr = array('name' => $data['name'], 'modified' => _dateTime());
        $this->db->where('id', $data['id']);
        $result=$this->db->update($this->table, $data);
        return $result;
    }

  
    /**
     * Get referral
     *
     * This function Get All Groups
     * 
     * @access	public
     * @return	Object 
     */
    function get_referral($limit = null, $offset = null, $text = null, $order_by = null, $order = null) {

        $this->db->select("SQL_CALC_FOUND_ROWS  $this->table.*", false);
        if (!empty($text)) {
            $text = strtolower($text);
            //$this->db->like("LOWER(CONCAT(first_name,last_name,email,$this->group_table.name))",
            // $text);
        }

        $this->db->order_by($order_by, $order);

        $this->db->limit($limit, $offset);

        $query = $this->db->get($this->table);
        //echo $this->db->last_query();exit;
        $result['result'] = $query->result_array();

        $total_record = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $result['total_data'] = $total_record->row()->count;

        return $result;
    }

    function grid_cols() {


        $data[] = array(
            "display" => "Referral Source",
            "name" => "name",
            "fetch_name" => "name",
            "sorting" => "yes");
        $data[] = array(
            "display" => "Created By",
            "name" => "added_by",
            "fetch_name" => "added_by",
            "sorting" => "no");


        $data[] = array(
            "display" => "Created",
            "name" => "created",
            "fetch_name" => "created",
            "sorting" => "yes");

        $data[] = array(
            "display" => "Modified",
            "name" => "modified",
            "fetch_name" => "modified",
            "sorting" => "yes");

        return $data;
    }

    function delete_row($id = null) {
        $this->db->where('id', $id);
        $this->db->delete($this->table);
        if ($this->db->affected_rows() > 0) {
            return true;
        }
    }

  
}
