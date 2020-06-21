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

class Permission_mod extends CI_Model {

    var $table = "user_groups";

    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    //------------------------------------------------------------------------

    /**
     * save
     *
     * This function save permission module id into group table
     * 
     * @access	public
     * @return	int or Boolean
     */
    public function save() {
        _pr($_POST);
        // exit;
        $ModuleGroupId = $this->input->post('name');
        $status = $this->input->post('status');
        $ModuleGroupIdArray = explode('_', $ModuleGroupId);
        $ModuleId = $ModuleGroupIdArray[0];
        $groupId = $ModuleGroupIdArray[1];

        //if status is on
        if ($status) {
            //retrive data from group table
            $groupData = $this->db->get_where($this->table, array('id' => $groupId));
            //_pr($groupData->row());exit;
            $groupDataResult = $groupData->row();
            $accessibleModules = $groupDataResult->accessible_modules;
            $updateModuleId = $ModuleId;
            if ($accessibleModules != null) {
                $accessibleModules = explode('_', $accessibleModules);
                if ($status == 'on') {
                    if (!in_array($ModuleId, $accessibleModules)) {
                        $accessibleModules[] = $ModuleId;
                    }
                } else {
                    if (in_array($ModuleId, $accessibleModules)) {
                        if (($key = array_search($ModuleId, $accessibleModules)) !== false) {
                            unset($accessibleModules[$key]);
                        }
                    }
                }
                $updateModuleId = implode('_', $accessibleModules);
            } else {
                $updateModuleId = $ModuleId; //first element updated
            }

            $this->db->where('id', $groupId);
            $this->db->set('accessible_modules', $updateModuleId);
            $this->db->update($this->table);
        }
        return ($this->db->affected_rows()) ? true : false;

    }

    /**
     * getModule
     *
     * This function gets 
     * 
     * @access	public
     * @return	int or Boolean
     */
    public function getModule() {
        _pr($_POST);
        exit;
        $ModuleGroupId = $this->input->post('name');
        $status = $this->input->post('status');
        $ModuleGroupIdArray = explode('_', $ModuleGroupId);
        $ModuleId = $ModuleGroupIdArray[0];
        $groupId = $ModuleGroupIdArray[1];

        //if status is on
        if ($status) {
            $updateModuleId = $ModuleId;
            $this->db->where('id', $groupId);
            $this->db->set('accessible_modules', $updateModuleId);
            $this->db->update($this->table);
        }
        return ($this->db->affected_rows()) ? true : false;

    }

}
