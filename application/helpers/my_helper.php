<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * My helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db * @author		Kumar Gaurav(gaurav1@tekshapers.com)
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc 
 * @since		Version 1.0
 */
// ------------------------------------------------------------------------
// ------------------------------------------------------------------------
/**
 * @Function _layout
 * @purpose load layout page 
 * @created  2 dec 2014
 */
if (!function_exists('_layout')) {
    function _layout($data = null) {
        $CI = &get_instance();
        $CI->load->view('layout', $data);
    }
}

// ------------------------------------------------------------------------
/**
 * @Function _layout
 * @purpose load layout page 
 * @created  2 dec 2014
 */
if (!function_exists('_getModules')) {
    function _getModules($data = null) {
        $arr = array(
            '1' => 'Leads',
            /*  '2' => 'Opportunities',*/
            '3' => 'Tasks',
            '4' => 'Product & Services');
        return $arr;
    }
}

// ------------------------------------------------------------------------
/**
 * @Function _layout
 * @purpose load layout page 
 * @created  2 dec 2014
 */
if (!function_exists('_pr')) {
    function _pr($data = null) {
        echo '<pre>';
        print_r($data);
    }
}

// ------------------------------------------------------------------------
/**
 * @Function _getTable
 * @purpose get Table name from database
 * @created  3 dec 2014
 */
if (!function_exists('_getTable')) {
    function _getTable($id = null) {
        $arr = array(
            '1' => 'lead_others',
            /*  '2' => 'opportunities',*/
            '3' => 'task_others',
            '4' => 'product_others');
        foreach ($arr as $key => $val) {
            if ($key == $id) {
                return $val;
            }
        }
        return false;
    }
}

/**
 * @Function _ajaxLayout
 * @purpose load layout page 
 * @created  3 dec 2014
 */
if (!function_exists('_ajaxLayout')) {
    function _ajaxLayout($data = null) {
        $CI = &get_instance();
        $CI->load->view('ajax_layout', $data);
    }
}

/**
 * @Function _fieldTypes
 * @purpose get field types 
 * @created  3 dec 2014
 */
if (!function_exists('_fieldTypes')) {
    function _fieldTypes() {
        $arr = array(
            '1' => 'Text',
            '2' => 'Integer',
            '3' => 'Date',
            '4' => 'Text Area',
            '5' => 'Select Box',
            '6' => 'Multi Select Box',
            /*'7' => 'checkbox',
            '8' => 'Radio',*/
            '9' => 'float');
        return $arr;
    }
}

/**
 * @Function _getfieldType
 * @purpose get field types by id
 * @created  3 dec 2014
 */
if (!function_exists('_getfieldType')) {
    function _getfieldType($id = null) {
        $arr = _fieldTypes();
        foreach ($arr as $key => $val) {
            if ($key == $id) {
                return $val;
            }
        }
        return false;
    }
}

/**
 * @Function _fieldDatatype
 * @purpose get mysql datatype of field 
 * @created  3 dec 2014
 */
if (!function_exists('_fieldDatatype')) {
    function _fieldDatatype($field = null) {
        if ($field == 1 || $field == 5 || $field == 6 || $field == 7 || $field == 8) {
            $dataType = "varchar(100)";
        } else
            if ($field == 2) {
                $dataType = "int(40)";
            } else
                if ($field == 3) {
                    $dataType = "date";
                } else
                    if ($field == 9) {
                        $dataType = "float";
                    } else {
                        $dataType = "varchar(200)";
                    }
                    return $dataType;
    }
}

/**
 * @Function _getField
 * @purpose get mysql datatype of field 
 * @created  4 dec 2014
 */
if (!function_exists('_getField')) {
    function _getField($module = null, $is_dynamic = null) {
        $CI = &get_instance();
        if ($is_dynamic) {
            $CI->db->where('is_dynamic', $is_dynamic);
        }
        $cond = array('module' => $module);
        $CI->db->order_by('id', 'asc');
        $result = $CI->db->get_where('form_fields', $cond);
        //_pr($result->result());exit;
        if ($result->num_rows()) {
            return $result->result();
        }
        return false;

    }
}

/**
 * @Function _getFieldHtml
 * @purpose get html  of field 
 * @created  4 dec 2014
 */
if (!function_exists('_getFieldHtml')) {
    function _getFieldHtml($fieldData = null, $value = null) {
        $CI = &get_instance();
        //_pr($fieldData);exit;
        $name = _tableAttribute($fieldData->label);
        $name = 'data[other][' . $name . ']';
        $required = null;
        if (!$value) {
            $value = @$fieldData->default_value;
        }
        if ($fieldData->field_required == 1) {
            $required = "required='required'";
        }
        if ($fieldData->field_type == 1) {
            $html = '<input type="text" value="' . $value . '" name="' . $name . '" class="col-xs-10 col-sm-6 pull-right" ' . $required .
                '/>';
        } else
            if ($fieldData->field_type == 2) {
                $html = '<input type="number" value="' . $value . '" name="' . $name . '" class="col-xs-10 col-sm-6 pull-right" ' . $required .
                    '/>';
            } else
                if ($fieldData->field_type == 3) {
                    if ($value) {
                        $date = @date('Y-m-d', @strtotime($value));
                    } else {
                        $date = @date('Y-m-d');
                    }
                    $html = '<input type="date" value="' . $date . '" name="' . $name . '" class="col-xs-10 col-sm-6 pull-right" ' . $required .
                        '/>';
                } else
                    if ($fieldData->field_type == 4) {
                        $html = '<textarea  name="' . $name . '" class="col-xs-10 col-sm-6 pull-right" ' . $required . '>' . $value .
                            '</textarea>';
                    } else
                        if ($fieldData->field_type == 5 || $fieldData->field_type == 6) {
                            $multiselect = ''; //for multiple dropdown
                            $arr = null;
                            if ($fieldData->field_type == 6) {
                                $multiselect = 'multiple';
                                $arr = '';
                            }
                            $html = '<select name="' . $name . $arr . '" class="col-xs-10 col-sm-6 pull-right" ' . $required . ' ' . $multiselect .
                                '>';
                            //_pr($fieldData);exit;
                            $fields = explode(',', $fieldData->default_value);
                            $html .= '<option value="">Select</option>';
                            foreach ($fields as $key => $val) {
                                $selected = ($val == $value) ? 'Selected' : null;
                                $html .= '<option value="' . $val . '" ' . $selected . '>' . $val . '</option>';
                            }
                            $html .= '</select>';

                        } else
                            if ($fieldData->field_type == 7) {
                                $html = '<div class="checkbox">
													<label>
														<input value="yes" name="' . $name . '" type="checkbox" class="ace">
														<span class="lbl"> </span>
													</label>
												</div>';
                                //$html = '<input type="checkbox"  name="' . $name .
                                //  '" class="ace ace-checkbox-2" id="ace-settings-navbar" ' . $required . '>';
                            } else
                                if ($fieldData->field_type == 8) {
                                    $html = '<div class="checkbox">
													<label>
														<input name="' . $name . '" type="radio" class="ace">
														<span class="lbl">  </span>
													</label>
												</div>';
                                    //$html = '<input type="checkbox"  name="' . $name .
                                    //  '" class="ace ace-checkbox-2" id="ace-settings-navbar" ' . $required . '>';
                                } else
                                    if ($fieldData->field_type == 9) {
                                        $html = '<input type="number" step="0.01" value="' . $value . '" name="' . $name .
                                            '" class="col-xs-10 col-sm-6 pull-right" ' . $required . '/>';
                                    }
        return $html;
    }
}

/**
 * @Function _tableAttribute
 * @purpose get table attribute 
 * @created  4 dec 2014
 */
if (!function_exists('_tableAttribute')) {
    function _tableAttribute($label = null) {
        $label = strtolower($label);
        if (strpos($label, ' ')) {
            $label = str_replace(' ', '_', $label);
        }
        return $label;

    }
}

/**
 * @function getFieldTable
 * @purpose gets fields from tables(modules)
 * @created 3Dec2014
 */
if (!function_exists('_getFieldTable')) {
    function _getFieldTable($table = 'lead') {
        $query = mysql_query('SHOW COLUMNS FROM ' . $table) or die(mysql_error());
        $result = mysql_fetch_array($query);
        $arr = array();
        if (mysql_num_rows($query) > 0) {
            while ($row = mysql_fetch_assoc($query)) {
                //echo '<pre>';
                //print_r($row);
                $arr[] = $row['Field'];
            }
        }
        return $arr;
    }
}

/**
 * @function _defaultLeadFields
 * @purpose default array fields
 * @created 8Dec2014
 */
if (!function_exists('_defaultLeadFields')) {
    function _defaultLeadFields() {
        $arr = array(
            array(
                'field_type' => '1',
                'label' => 'Company Name',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Company Contact',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Referral Source',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Priority',
                'default_value' => '',
                'field_required' => 2),
            array(
                'field_type' => '1',
                'label' => 'Assigned Telemarketer',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Company Address',
                'default_value' => '',
                'field_required' => 2),
            array(
                'field_type' => '1',
                'label' => 'Website',
                'default_value' => '',
                'field_required' => 2),
            array(
                'field_type' => '1',
                'label' => 'Company Contact Person',
                'default_value' => '',
                'field_required' => 2),
            array(
                'field_type' => '4',
                'label' => 'Contact Person Details',
                'default_value' => '',
                'field_required' => 2),
            array(
                'field_type' => '3',
                'label' => 'Follow Up Date',
                'default_value' => date('Y-m-d'),
                'field_required' => 2),
            array(
                'field_type' => '1',
                'label' => 'Remarks',
                'default_value' => '',
                'field_required' => 2),
            array(
                'field_type' => '1',
                'label' => 'Reminders',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '4',
                'label' => 'Products and Services',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '5',
                'label' => 'Status',
                'default_value' => _leadStatus(),
                'field_required' => 1));
        return $arr;
    }
}

/**
 * @function _defaultOpportunityFields
 * @purpose default array fields
 * @created 8Dec2014
 */
if (!function_exists('_defaultOpportunityFields')) {
    function _defaultOpportunityFields() {
        $arr = array(array(
                'field_type' => '1',
                'label' => 'Opportunity Name',
                'default_value' => '',
                'field_required' => 1), array(
                'field_type' => '4',
                'label' => 'Description',
                'default_value' => '',
                'field_required' => 2));
        return $arr;
    }
}

/**
 * @function _defaultTaskFields
 * @purpose default fields of Task Form 
 * @created 8Dec2014
 */
if (!function_exists('_defaultTaskFields')) {
    function _defaultTaskFields() {
        $arr = array(
            array(
                'field_type' => '1',
                'label' => 'Task Name',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Duration',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Reminder',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '1',
                'label' => 'Description',
                'default_value' => '',
                'field_required' => 1),
            array(
                'field_type' => '4',
                'label' => 'Status',
                'default_value' => _taskStatus(),
                'field_required' => 1));
        return $arr;
    }
}

/**
 * @function __addLeadDefFields
 * @purpose gets fields from tables(modules)
 * @created 3Dec2014
 */
if (!function_exists('_addDefaultFields')) {
    function _addDefaultFields($field_arr = array()) {
        $CI = &get_instance();
        $data = $field_arr; //_pr($data);die;
        foreach ($data as $k => $row) {
            if (is_array($row)) {
                if (is_array($row['default_value'])) {
                    $row['default_value'] = array_filter($row['default_value']);
                }
                $row['module'] = $field_arr['module'];
                /////////////start transaction /////////////////
                $CI->db->trans_start();
                $CI->db->trans_begin();
                //alter existing table
                $tableName = _getTable($row['module']);
                $row['tableName'] = $tableName;
                //$alter = _alterFields($row);
                $alter = true;
                if ($alter) {
                    //save to fields table
                    $CI->common_mod->save('form_fields', $row);
                }
                $CI->db->trans_complete();
                /////////////////End Transaction///////////////
                /////////////////check if error occurs/////////
                if ($CI->db->trans_status() === false) {
                    $CI->db->trans_rollback();
                    return false;
                } else {
                    $CI->db->trans_commit();
                }
            }
        }
        return true;
    }
}

/**
 * @function _alterFields
 * @purpose alter fileds of existing tables  
 * @created 3Dec2014
 */
if (!function_exists('_alterFields')) {
    function _alterFields($tableData = array(), $status = "ADD") {
        $CI = &get_instance();
        //alter existing table
        //_pr($tableData);exit;

        $dataType = _fieldDatatype($tableData['field_type']);
        if ($status) {
            $label = strtolower($tableData['label']);
            if (strpos($label, ' ')) {
                $label = str_replace(' ', '_', $label);
            }
            if ($status == 'ADD') {
                $dataType = ' ' . $dataType;
            } else {
                $dataType = null;
            }
        }
        //_pr($tableData);die;
        $query = $CI->db->query('ALTER TABLE ' . $tableData['tableName'] . ' ' . $status . ' ' . $label . $dataType);

        return $query;
    }
}
/**
 * @function _checkDefaultFields
 * @purpose alter fileds of existing tables  
 * @created 3Dec2014
 */
if (!function_exists('_checkDefaultFields')) {
    function _checkDefaultFields($tableName = null, $module = 1) {
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->from($tableName);
        $CI->db->where('is_dynamic', '0');
        $CI->db->where('module', $module);
        $CI->db->limit(1);
        $query = $CI->db->get();
        return $query->num_rows;
    }
}

/**
 * @function _show404
 * @purpose Display error page
 * @created 9Dec2014
 */
if (!function_exists('_show404')) {
    function _show404() {
        $CI = &get_instance();
        $data['title'] = 'Error';
        $data['subTitle'] = 'Wrong Page';
        $data['page'] = 'error';
        _layout($data);
    }
}
/**
 * @function _leadStatus
 * @purpose List status of leads
 * @created 10Dec2014
 */
if (!function_exists('_leadStatus')) {
    function _leadStatus() {
        $arr = array('3' => 'Closed Won', '4' => 'Closed Lost','5'=>'Disqualified');
        return $arr;
    }
}

/**
 * @function _show404
 * @purpose Display error page
 * @created 9Dec2014
 */
if (!function_exists('_userByGroupId')) {
    function _userByGroupId($id = null) {
        $CI = &get_instance();
        //$CI->db->select("`id`, CONCAT(`first_name`,`last_name`) as `name` ");
        $cond = array('group_id' => $id);
        $CI->db->order_by('id', 'desc');
        $result = $CI->db->get_where('users', $cond); //echo $CI->db->last_query();die;
        return $result->result();
    }
}

/**
 * @function _userId
 * @purpose gets user id from session
 * @created 11Dec2014
 */
if (!function_exists('_userId')) {
    function _userId() {
        return currentuserinfo()->id;
    }
}

/**
 * @function _getModulesIds
 * @purpose gets modules name and id
 * @created 12Dec2014
 */
if (!function_exists('_getModulesIds')) {
    function _getModulesIds() {
        $arr = array(
            '1' => 'User',
            '2' => 'Form',
            '3' => 'Role & Permission',
            '4' => 'Lead',
            '5' => 'Opportunity',
            '6' => 'Tasks and Reminders',
            '7' => 'Products & Services',
            '8' => 'Invoice');
        return $arr;

    }
}

/**
 * @function _getModuleId
 * @purpose gets modules name and id
 * @created 12Dec2014
 */
if (!function_exists('_getModuleId')) {
    function _getModuleId($module = null) {
        $arr = array(
            '1' => 'user',
            '2' => 'form',
            '3' => 'permission',
            '4' => 'lead',
            '5' => 'opportunity',
            '6' => 'task',
            '7' => 'product',
            '8' => 'invoice');
        foreach ($arr as $key => $val) {
            if ($val == $module) {
                return $key;
            }
        }
        return false;
    }
}

/**
 * @function _modifeidDate
 * @purpose gets modules name and id
 * @created 12Dec2014
 */
if (!function_exists('_modifeidDate')) {
    function _modifeidDate() {

    }
}

/**
 * group data 
 * 
 * return default time zone date and time
 *
 * @access	public
 */

if (!function_exists('_assignToData')) {
    function _assignToData($assignToId = null) {
        $CI = &get_instance();
        if(is_array($assignToId)){
            $CI->db->where_in('assigned_to', $assignToId);
        }else{
            $CI->db->where('assigned_to', $assignToId);   
        }
        $query = $CI->db->get('assign_leads');
        if ($query->num_rows()) {
            return $query->result();
        }
        //_pr($query->result());exit;
        return false;
    }

}

/**
 * @function _getLeadStatus
 * @purpose gets status of Lead by id
 * @created 19Dec2014
 */

if (!function_exists('_getLeadStatus')) {
    function _getLeadStatus($leadStatus = null) {
        $CI = &get_instance();
        $arr = array(
            '0' => 'Initiated',
            '1' => 'Disqualified',
            '2' => 'Qualified',
            '3' => 'Closed Won',
            '4' => 'Lost');
        foreach ($arr as $key => $val) {
            if ($key == $leadStatus) {
                return $val;
            }
        }
        return false;
    }

}

/**
 * @function _getProductUnit
 * @purpose List Products Unit
 * @created 22Dec2014
 */

if (!function_exists('_getProductUnit')) {
    function _getProductUnit() {
        $CI = &get_instance();
        $arr = array(
            '1' => 'Box',
            '2' => 'Carton',
            '3' => 'Dozen',
            '4' => 'Each',
            '5' => 'Hours',
            '6' => 'Impressions',
            '7' => 'Lb',
            '8' => 'M',
            '9' => 'Pack',
            '10' => 'Pages',
            '11' => 'Pieces',
            '12' => 'Quantity',
            '13' => 'Reams',
            '14' => 'Sheet',
            '15' => 'Spiral Binder',
            '16' => 'Sq Ft');

        /*foreach ($arr as $key => $val) {
        if ($key == $leadStatus) {
        return $val;
        }
        }*/

        return $arr;
    }

}

/**
 * @function _isModuleActive
 * @purpose add active class to module
 * @created 29Dec2014
 */

if (!function_exists('_isModuleActive')) {
    function _isModuleActive($leftModule = null) {
        $CI = &get_instance();
        $segmentArray = $CI->uri->segment_array();
        $module = $segmentArray[1];
        if ($leftModule == $module) {
            echo 'active';
            return;
        }
        return false;

    }

}

/**
 * @function _isSubMenuActive
 * @purpose add active class to Sub Menu
 * @created 29Dec2014
 */

if (!function_exists('_isSubMenuActive')) {
    function _isSubMenuActive($menuUrl = array()) {
        $CI = &get_instance();
        $segmentArray = $CI->uri->segment_array();
        $segmentString = implode('/', $segmentArray);
        // _pr($segmentString);
        foreach ($menuUrl as $val) {
            if (strpos($val, 'edit') || strpos($val, 'view')) {
                // echo $val . '<br>';
                $newSegmentArray = $segmentArray;
                unset($newSegmentArray[count($segmentArray)]);
                $segmentString = implode('/', $newSegmentArray);
                //_pr($segmentString);
                //exit;
            }
            if ($val == $segmentString) {
                echo 'active';
                return;
            }

        }
        return false;

    }

}

/**
 * @function _getTaxes
 * @purpose get Taxes from database
 * @created 29Dec2014
 */

if (!function_exists('_getTaxes')) {
    function _getTaxes() {
        $CI = &get_instance();
        $CI->db->order_by('id', 'asc');
        $query = $CI->db->get('taxes');
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;

    }

}

/**
 * @function _paymentMode
 * @purpose Payment mode values
 * @created 31Dec2014
 */

if (!function_exists('_paymentMode')) {
    function _paymentMode() {
        $arr = array('1' => 'Cash', '2' => 'Cheque');
        return $arr;
    }

}

/**
 * @function _getReminder
 * @purpose list all reminders of currunt user's Lead
 * @created 5Jan2014
 */

if (!function_exists('_getReminder')) {
    function _getReminder() {
        $CI = &get_instance();
        //$CI->db->order_by('date(lead_reminder.reminder)', 'desc');
        //$CI->db->group_by('lead_reminder.modified');
        $CI->db->select('lead_reminder.*,lead_reminder.reminder as date,lead_reminder.reminder_description as description');
        $CI->db->join('leads', 'leads.id = lead_reminder.lead_id', 'LEFT');
        $CI->db->where('leads.added_by', currentUserID());
        $CI->db->or_where('leads.assigned_telemarketer', currentUserID());

        $CI->db->order_by('id', 'desc');
        $CI->db->limit('20');
        $query = $CI->db->get('lead_reminder');

        //echo $CI->db->last_query();exit;
        if ($query->num_rows()) {
            return _notificationType('reminder', $query->result());
        }
        return array();
    }
}

/**
 * @function _getFollowUp
 * @purpose list all reminders of currunt user's Lead
 * @created 5Jan2014
 */

if (!function_exists('_getFollowUp')) {
    function _getFollowUp() {
        $CI = &get_instance();
        //$CI->db->group_by('lead_reminder.modified');
        $CI->db->select('follow_ups.*,follow_ups.follow_up_date as date,follow_ups.remark as description');
        $CI->db->join('leads', 'leads.id = follow_ups.lead_id', 'LEFT');
        //$CI->db->join('lead_reminder','follow_ups.lead_id = lead_reminder.lead_id','LEFT');
        $CI->db->where('leads.added_by', currentUserID());
        $CI->db->or_where('leads.assigned_telemarketer', currentUserID());
        $query = $CI->db->get('follow_ups');
        $CI->db->order_by('id', 'desc');
        $CI->db->limit('20');
        //echo $CI->db->last_query();exit;
        if ($query->num_rows()) {
            return _notificationType('followup', $query->result());
        }
        return array();
    }

}

/**
 * @function _getNotificationTime
 * @purpose calculate time format for date heading of notification page
 * @created 6Jan2014
 */

if (!function_exists('_getNotificationTime')) {
    function _getNotificationTime($date = null) {
        $CI = &get_instance();
        $day = date('dmy', strtotime($date));
        $today = date('dmy');
        $yesterday = date('dmy', strtotime("-1 day"));
        $tomorrow = date('dmy', strtotime("+1 day"));

        if ($day == $today) {
            $text = "Today";
        } elseif ($day == $yesterday) {
            $text = "Yesterday";
        } elseif ($day == $tomorrow) {
            $text = "Tomorrow";
        } else {
            $text = date('d M Y', strtotime($date));
        }
        return $text;
    }

}

/**
 * @function _priority
 * @purpose lists  priority values
 * @created 7Jan2014
 */

if (!function_exists('_priority')) {
    function _priority($date = null) {
        $arr = array(
            '1' => 'Low',
            '2' => 'Medium ',
            '3' => 'High');
        return $arr;
    }

}

/**
 * @function _getNotification
 * @purpose gets all notification
 * @created 7Jan2014
 */

if (!function_exists('_getNotification')) {
    function _getNotification() {
        $followUps = _getFollowUp();
        $reminders = _getReminder();
        $appointment = _getAppointment();
        $task = _getTask();
        $assigned = _getAssignedLead();
        //_pr($task );exit;

        $arr = array_merge($followUps, $reminders, $appointment, $task, $assigned);
        //_pr($arr);

        foreach ($arr as $k => $v) {
            $date = strtotime($v->date);
            $arr[$k]->time = $date;
        }
        $list = array();
        foreach ($arr as $k => $v) {
            $list[$k] = $v->time;
        }
        //_pr($arr);exit;
        $newArr = array();
        foreach ($arr as $k => $v) {
            $maxs = array_keys($list, max($list));
            $max = $maxs[0];
            $newArr[] = $arr[$max];
            unset($list[$max]);
        }
        //_pr($newArr);exit;
        if (!empty($newArr)) {
            return $newArr;
        }

    }

}

/**
 * @function _getCountry
 * @purpose lists  all countries
 * @created 8Jan2014
 */

if (!function_exists('_getCountry')) {
    function _getCountry() {
        $CI = &get_instance();
        $CI->db->order_by('country_name', 'asc');
        $query = $CI->db->get('countries');
        if ($query->num_rows()) {
            return $query->result();
        }
        return false;
    }

}

/**
 * @function _getDisqualifyNote
 * @purpose lists  all countries
 * @created 8Jan2014
 */

if (!function_exists('_getDisqualifyNote')) {
    function _getDisqualifyNote($id = null) {
        $CI = &get_instance();
        $CI->db->where('lead_id', $id);
        $query = $CI->db->get('disqualify_leads');
        if ($query->num_rows()) {
            return $query->row();
        }
        return false;
    }

}

/**
 * @function _getAppointment
 * @purpose gets appointment list
 * @created 12Jan2014
 */

if (!function_exists('_getAppointment')) {
    function _getAppointment() {
        $CI = &get_instance();
        $CI->db->select('appointment.*,appointment.appointment_date as date,appointment.appointment_name as description');
        $CI->db->join('leads', 'leads.id = appointment.lead_id', 'LEFT');
        $CI->db->where('leads.added_by', currentUserID());
        $CI->db->or_where('leads.assigned_telemarketer', currentUserID());
        $CI->db->order_by('id', 'desc');
        $CI->db->limit('20');

        $query = $CI->db->get('appointment');
        if ($query->num_rows()) {
            return _notificationType('appointment', $query->result());
        }
        return array();
    }

}

/**
 * @function _getTask
 * @purpose gets Tasks list
 * @created 12Jan2014
 */

if (!function_exists('_getTask')) {
    function _getTask() {
        $CI = &get_instance();
        $CI->db->select('tasks.*,tasks.reminder as date,tasks.task_name as description');
        //$CI->db->join('leads', 'leads.id = tasks.lead_id', 'LEFT');
        $CI->db->join('assign_task', 'tasks.id = assign_task.task_id', 'LEFT');
        $CI->db->where('tasks.added_by', currentUserID());
        $CI->db->or_where('assign_task.assigned_to', currentUserID());
        $CI->db->order_by('id', 'desc');
        $CI->db->limit('20');
        $query = $CI->db->get('tasks');
        if ($query->num_rows()) {
            return _notificationType('task', $query->result());
        }
        return array();
    }

}

/**
 * @function _getAssignedLead
 * @purpose gets Assigned Lead Data
 * @created 12Jan2014
 */

if (!function_exists('_getAssignedLead')) {
    function _getAssignedLead() {
        $CI = &get_instance();
        $CI->db->select('assign_leads.*,assign_leads.modified as date');
        $CI->db->join('leads', 'leads.id = assign_leads.lead_id', 'LEFT');
        $CI->db->where('assign_leads.assigned_to', currentUserID());
        $CI->db->order_by('id', 'desc');
        $CI->db->limit('20');
        $query = $CI->db->get('assign_leads');
        //echo $CI->db->last_query();exit;
        if ($query->num_rows()) {
            $result = $query->result();
            //_pr($result);exit;
            foreach ($result as $key => $val) {
                $result[$key]->description = 'You have assigned for a Lead';
            }
            return _notificationType('assigned', $result);
        }
        return array();
    }
}

/**
 * @function _notificationType
 * @purpose adds notification type in result array
 * @created 12Jan2014
 */

if (!function_exists('_notificationType')) {
    function _notificationType($type = null, $result = array()) {
        if ($result) {
            foreach ($result as $k => $v) {
                $result[$k]->notification_type = $type;
            }
            return $result;
        }
        return false;
    }
}

/**
 * @function _websocket
 * @purpose send data to socket
 * @created 13Jan2014
 */

if (!function_exists('_websocket')) {
    function _websocket($data = array()) {
        $host = '127.0.0.1'; //where is the websocket server
        $port = 8000;
        $local = "http://127.0.0.1/"; //url where this script run
        //$data = array("name"=>"kumar Gaurav","message"=>"Awesome");

        $data = json_encode($data, true);

        $head = "GET / HTTP/1.1" . "\r\n" . "Upgrade: WebSocket" . "\r\n" . "Connection: Upgrade" . "\r\n" . "Origin: $local" .
            "\r\n" . "Host: $host" . "\r\n" . "Sec-WebSocket-Version: 13" . "\r\n" . "Sec-WebSocket-Key: asdasdaas76da7sd6asd6as7d" .
            "\r\n" . "Content-Length: " . strlen($data) . "\r\n" . "\r\n";
        //WebSocket handshake
        $sock = @fsockopen($host, $port, $errno, $errstr, 2);
        fwrite($sock, $head) or die('error:' . $errno . ':' . $errstr);
        $headers = fread($sock, 2000);
        fwrite($sock, hybi10Encode("$data")) or die('error:' . $errno . ':' . $errstr);
        $wsdata = fread($sock, 2000);
        fclose($sock);
        //echo $data;exit;

    }
}

/**
 * @function hybi10Decode
 * @purpose Decrypt Data
 * @created 14Jan2014
 */
if (!function_exists('hybi10Decode')) {
    function hybi10Decode($data) {
        $bytes = $data;
        $dataLength = '';
        $mask = '';
        $coded_data = '';
        $decodedData = '';
        $secondByte = sprintf('%08b', ord($bytes[1]));
        $masked = ($secondByte[0] == '1') ? true : false;
        $dataLength = ($masked === true) ? ord($bytes[1]) & 127 : ord($bytes[1]);

        if ($masked === true) {
            if ($dataLength === 126) {
                $mask = substr($bytes, 4, 4);
                $coded_data = substr($bytes, 8);
            } elseif ($dataLength === 127) {
                $mask = substr($bytes, 10, 4);
                $coded_data = substr($bytes, 14);
            } else {
                $mask = substr($bytes, 2, 4);
                $coded_data = substr($bytes, 6);
            }
            for ($i = 0; $i < strlen($coded_data); $i++) {
                $decodedData .= $coded_data[$i] ^ $mask[$i % 4];
            }
        } else {
            if ($dataLength === 126) {
                $decodedData = substr($bytes, 4);
            } elseif ($dataLength === 127) {
                $decodedData = substr($bytes, 10);
            } else {
                $decodedData = substr($bytes, 2);
            }
        }

        return $decodedData;
    }
}

/**
 * @function hybi10Encode
 * @purpose Encrypt Data
 * @created 14Jan2014
 */
if (!function_exists('hybi10Encode')) {
    function hybi10Encode($payload, $type = 'text', $masked = true) {
        $frameHead = array();
        $frame = '';
        $payloadLength = strlen($payload);

        switch ($type) {
            case 'text':
                // first byte indicates FIN, Text-Frame (10000001):
                $frameHead[0] = 129;
                break;

            case 'close':
                // first byte indicates FIN, Close Frame(10001000):
                $frameHead[0] = 136;
                break;

            case 'ping':
                // first byte indicates FIN, Ping frame (10001001):
                $frameHead[0] = 137;
                break;

            case 'pong':
                // first byte indicates FIN, Pong frame (10001010):
                $frameHead[0] = 138;
                break;
        }

        // set mask and payload length (using 1, 3 or 9 bytes)
        if ($payloadLength > 65535) {
            $payloadLengthBin = str_split(sprintf('%064b', $payloadLength), 8);
            $frameHead[1] = ($masked === true) ? 255 : 127;
            for ($i = 0; $i < 8; $i++) {
                $frameHead[$i + 2] = bindec($payloadLengthBin[$i]);
            }

            // most significant bit MUST be 0 (close connection if frame too big)
            if ($frameHead[2] > 127) {
                $this->close(1004);
                return false;
            }
        } elseif ($payloadLength > 125) {
            $payloadLengthBin = str_split(sprintf('%016b', $payloadLength), 8);
            $frameHead[1] = ($masked === true) ? 254 : 126;
            $frameHead[2] = bindec($payloadLengthBin[0]);
            $frameHead[3] = bindec($payloadLengthBin[1]);
        } else {
            $frameHead[1] = ($masked === true) ? $payloadLength + 128 : $payloadLength;
        }

        // convert frame-head to string:
        foreach (array_keys($frameHead) as $i) {
            $frameHead[$i] = chr($frameHead[$i]);
        }

        if ($masked === true) {
            // generate a random mask:
            $mask = array();
            for ($i = 0; $i < 4; $i++) {
                $mask[$i] = chr(rand(0, 255));
            }

            $frameHead = array_merge($frameHead, $mask);
        }
        $frame = implode('', $frameHead);
        // append payload to frame:
        for ($i = 0; $i < $payloadLength; $i++) {
            $frame .= ($masked === true) ? $payload[$i] ^ $mask[$i % 4] : $payload[$i];
        }

        return $frame;
    }
}

/**
 * @function _notificationTime
 * @purpose get time format of notification
 * @created 14Jan2014
 */

if (!function_exists('_notificationTime')) {
    function _notificationTime() {
        return date('h:i A d-M-y');
    }
}

/**
 * @function _getReminderDates
 * @purpose gets dates of all notification reminders
 * @created 15Jan2014
 */

if (!function_exists('_getReminderDates')) {
    function _getReminderDates() {
        $CI = &get_instance();
        //$CI->db->select('assign_leads.*,assign_leads.created as date');
        //$CI->db->where('assign_leads.assigned_to', currentUserID());

        $CI->db->join('assign_leads', 'leads.id = assign_leads.lead_id', 'LEFT');
        $CI->db->join('follow_ups', 'leads.id = follow_ups.lead_id', 'LEFT');
        // $CI->db->join('lead_reminder', 'leads.id = lead_reminder.lead_id', 'LEFT');
        $CI->db->join('tasks', 'leads.id = tasks.lead_id', 'LEFT');
        $CI->db->join('leads', 'leads.id = lead_reminder.lead_id', 'LEFT');

        $query = $CI->db->get('lead_reminder');
        echo $CI->db->last_query();
        exit;
        if ($query->num_rows()) {

        }
        return false;
    }
}

/**
 * @function _notifyUsers
 * @purpose gets users like lead creator and assigned to
 * @created 15Jan2014
 */

if (!function_exists('_notifyUsers')) {
    function _notifyUsers($id = null) {
        $CI = &get_instance();
        if ($id) {
            $CI->db->where('id', $id);
        }
        $CI->db->join('assign_leads', 'leads.id = assign_leads.lead_id', 'LEFT');
        $query = $CI->db->get('leads');
        if ($query->num_rows()) {
            return $query->row();

        }
        return false;
    }

}

/**
 * @function _lastNotificationTime
 * @purpose sets users current notification time and get's users last notifcation time
 * @created 20Jan2014
 */

if (!function_exists('_lastNotificationTime')) {
    function _lastNotificationTime($type = null) {
        $CI = &get_instance();
        $userId = currentUserID();
        if ($userId) {
            $CI->db->where('user_id', $userId);
        }
        $query = $CI->db->get('notification_times');
        //exit;
        if ($query->num_rows()) {
            $row = $query->row();
            if ($type) {
                $CI->db->where('user_id', $userId);
                $CI->db->set('time', time());
                $CI->db->update('notification_times');
            }
            return $row;
        } else {
            if ($type) {
                $CI->db->insert('notification_times', array('user_id' => $userId, 'time' => time()));
            }
        }
        return false;
    }

}


/**
 * @function _appointmentNotification
 * @purpose return appointment notificatiob time
 * @created 20Jan2014
 */

if (!function_exists('_appointmentNotificationTime')) {
    function _appointmentNotificationTime($date = null,$alert = null) {
        $timStamp=strtotime($date);
        if($alert==1){
            $notificationTime=$timStamp;
        }else if($alert==2){
            $notificationTime=$timStamp-(5*60);
        }else if($alert==3){
            $notificationTime=$timStamp-(15*60);
        }else if($alert==4){
            $notificationTime=$timStamp-(30*60);
        }else if($alert==5){
            $notificationTime=$timStamp-(1*60*60);
        }else if($alert==6){
            $notificationTime=$timStamp-(1*24*60*60);
        }else if($alert==7){
            $notificationTime=$timStamp-(7*24*60*60);
        }else{
            $notificationTime=$timStamp;
        }
        return $notificationTime;
    }

}
