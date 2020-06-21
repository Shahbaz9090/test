<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Subscription Helper
 * @package		E-rookie
 * @subpackage	Helpers
 * @category	Subscription
 * @author		Nitish Janterparia
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
// ------------------------------------------------------------------------

/**
 * Function to get subscription's feature type
 *
 * @access	public
 */

if (!function_exists('_features_type')) {
    function _features_type() {
        //$CI =& get_instance();
        $data = array(
            "1" => "Free",
            "2" => "Paid",
            "3" => "Email",
            "4" => "Resume");
        return $data;
    }
}

/**
 * Function to get subscription's type
 *
 * @access	public
 */

if (!function_exists('_subscriptions_type')) {
    function _subscriptions_type($id = null) {
        $data = array(
            "1" => "Monthly",
            "2" => "Quarterly",
            "3" => "Half Yearly",
            "4" => "Yearly",
            "5" => "One Time");
        if (!empty($id))
            return $data[$id];
        else
            return $data;
    }
}


/**
 * Function to get features
 *
 * @access	public
 */
if (!function_exists('_get_features')) {
    function _get_features($id = null) {
        $CI = &get_instance();
        //$CI->db->select("id,feature_name,pricing_type,");
        $CI->db->where("id", $id);
        //$CI->db->where("status", "1");
        //$CI->db->where("is_locked", "1");
        $resource = $CI->db->get("master_addon_feature");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}

/**
 * Function to get support
 *
 * @access	public
 */
if (!function_exists('_get_support_service')) {
    function _get_support_service($id = null) {
        $CI = &get_instance();
        $CI->db->select("id,service_name,pricing_type");
        $CI->db->where("id", $id);
        //$CI->db->where("status", "1");
        //$CI->db->where("is_locked", "1");
        $resource = $CI->db->get("master_support_service");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}

/**
 * Function to get plan
 *
 * @access	public
 */
if (!function_exists('_get_plan')) {
    function _get_plan($id = null) {
        $CI = &get_instance();
        $CI->db->where("id", $id);
        $resource = $CI->db->get("master_plans");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}

/**
 * Function to get billing list
 *
 * @access	public
 */
if (!function_exists('_billing_list')) {
    function _billing_list($id = null) {
        $CI = &get_instance();
        $list = array(
            '1' => 'Monthly',
            '2' => 'Quarterly',
            '3' => 'Half Yearly',
            '4' => 'Yearly');
        return !empty($id) ? $list[$id] : $list;

    }
}

/**
 * Function to get discount type
 *
 * @access	public
 */
if (!function_exists('_discount_type')) {
    function _discount_type($id = null) {
        $list = array(
            '1' => 'On Total Amount',
            '2' => 'Extend Email',
            '3' => 'Extend Resume');
        return !empty($id) ? $list[$id] : $list;

    }
}


/**
 * Function to get addon_type
 *
 * @access	public
 */

if (!function_exists('_addOnType')) {
    function _addOnType($id = null) {
        //$CI =& get_instance();
        $data = array(
            "3" => "Extend Email Limit",
            "4" => "Extend Resume Limit",
            "5" => "Extend User Limit",
            "6" => "Other");
        if (!empty($id))
            return $data[$id];
        else
            return $data;
    }
}

/**
 * Function to get discount type
 *
 * @access	public
 */
if (!function_exists('_front_view_load')) {
    function _front_view_load($page = null, $data = null) {
        $CI = &get_instance();
        $CI->load->view('elements/front_header');
        if ($data) {
            $CI->load->view($page, $data);
        } else {
            $CI->load->view($page);
        }
        $CI->load->view('elements/front_footer');
    }
}

/**
 * Function to get features
 *
 * @access	public
 */
if (!function_exists('_get_features_by_slab')) {
    function _get_features_by_slab($id = null, $slab = null) {
        $CI = &get_instance();
        //$CI->db->select("id,feature_name,pricing_type,");
        $CI->db->where("p_id", $id);
        $CI->db->where("status", "1");
        $CI->db->where("is_locked", "1");
        $CI->db->where("slab_range", $slab);
        $resource = $CI->db->get("master_addon_feature");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}

/**
 * Options for pagination limit
 * @access	public 
 */

if (!function_exists('_recordSelect')) {
    function _recordSelect() {
        $data = array(
            '10' => 10,
            '25' => 25,
            '50' => 50,
            '100' => 100);
        return $data;
    }

}

/**
 * Options for pagination limit
 * @access	public 
 */

if (!function_exists('_ac_type')) {
    function _ac_type($type = null) {
        $data = array('1' => 'Demo', '2' => 'Paid');
        if (!empty($type)) {
            return $data[$type];
        } else {
            return $data;
        }
    }

}

/**
 * Options for pagination limit
 * @access	public 
 */

if (!function_exists('_customer_status')) {
    function _customer_status() {
        $data = array(
            '0' => 'New Request',
            '1' => 'Active',
            '2' => 'Inactive',
            '3' => 'Trash');
        return $data;
    }

}

/**
 * Function to get features
 *
 * @access	public
 */
if (!function_exists('_domain_notification')) {
    function _domain_notification() {
        $CI = &get_instance();
        $resource = $CI->db->query("SELECT id, SUBSTRING_INDEX(email, '@', -1) as Domain, count(*) as Total FROM master_customers GROUP BY Domain ORDER BY Total DESC");
        if ($resource->num_rows > 0) {
            return $resource->result();
        } else {
            return false;
        }
    }
}

/**
 * Function to get slab range byid
 *
 * @access	public
 */

if (!function_exists('_get_used_slab_range')) {
    function _get_used_slab_range($id = null) {
        $CI = &get_instance();
        $CI->db->select("id,from,to,price");
        $CI->db->where("id", $id);
        //$CI->db->where("status", "1");
        //$CI->db->where("is_locked", "0");
        $resource = $CI->db->get("master_slab_range");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}

/**
 * Function to get subscription's feature type
 *
 * @access	public
 */

if (!function_exists('_features_list')) {
    function _features_list() {
        //$CI =& get_instance();
        $data = array("1" => "Free", "2" => "Paid");
        return $data;
    }
}


/**
 * Function to get slab's data
 *
 * @access	public
 */

if (!function_exists('slab_data')) {
    function slab_data($id = null) {
        $CI = &get_instance();
        $CI->db->where('id', $id);
        $query = $CI->db->get('master_slab_range');
        return $query->row();
    }
}


/**
 * Function to get subscription's type
 *
 * @access	public
 */

if (!function_exists('support_subscriptions_type')) {
    function support_subscriptions_type() {
        $data = array(
            "1" => "Monthly",
            "2" => "Yearly",
            "3" => "One Time",
            "4" => "Hourly",
            "5" => "Userwise");
        return $data;
    }
}

/**
 * Function to get account type value
 *
 * @access	public
 */

if (!function_exists('customer_account_type')) {
    function customer_account_type($id = null) {
        $data = array("1" => "Demo Account Settings", "2" => "Paid Account Settings");
        if (!empty($id)) {
            return $data[$id];
        } else {
            return $data;
        }
    }
}

/**
 * Function to get master accounts details
 *
 * @access	public
 */

if (!function_exists('get_billing_account')) {
    function get_billing_account($account_type = null) {
        $CI = &get_instance();
        $CI->db->where('account_type', $account_type);
        $CI->db->limit(1);
        $CI->db->order_by('id', 'desc');
        $resource = $CI->db->get("master_accounts");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}


/**
 * Function to billing periods
 *
 * @access	public
 */

if (!function_exists('billing_period')) {
    function billing_period($id = null) {
        $data = array(
            "1" => "Monthly",
            "2" => "Quarterly",
            "3" => "Half Yearly",
            "4" => "Yearly");
        if (!empty($id)) {
            return $data[$id];
        } else {
            return $data;
        }
    }
}


/**
 * Function to get master accounts details
 *
 * @access	public
 */

if (!function_exists('get_account')) {
    function get_account($id = null) {
        $CI = &get_instance();
        $CI->db->where('id', $id);
        $resource = $CI->db->get("master_accounts");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}


/**
 * Function to get master accounts details
 *
 * @access	public
 */

if (!function_exists('get_customer_info')) {
    function get_customer_info($id = null) {
        $CI = &get_instance();
        $CI->db->select("master_customers.*, site.id as site_id");
        $CI->db->join('site', "site.customer_id=master_customers.id", 'left');
        $CI->db->where('master_customers.id', $id);
        $resource = $CI->db->get("master_customers");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}


/**
 * Function to get plan
 *
 * @access	public
 */
if (!function_exists('_get_all_plan')) {
    function _get_all_plan($condition = null) {
        $CI = &get_instance();
        $CI->db->select("id,plan_name");
        $CI->db->where("is_published", '1');
        if (!empty($condition)) {
            foreach ($condition as $k => $v) {
                $CI->db->where($k, $v);
            }
        }
        $resource = $CI->db->get("master_plans");
        if ($resource->num_rows > 0) {
            return $resource->result();
        } else {
            return false;
        }
    }
}


if (!function_exists('_ajax_layout')) {
    function _ajax_layout($ajax_view = null, $data) {
        $CI = &get_instance();
        $CI->load->view($ajax_view, $data);
        $CI->load->view("ajax_footer");
    }
}


if (!function_exists('billing_country')) {
    function billing_country() {
        $arr = array('1' => 'Us', '2' => 'India');
        return $arr;
    }
}


/**
 * Function to get plan
 *
 * @access	public
 */
if (!function_exists('_get_plan_by_id')) {
    function _get_plan_by_id($id) {
        $CI = &get_instance();
        //$CI->db->select("slab_range");
        $CI->db->where("id", $id);
        $resource = $CI->db->get("master_plans");
        if ($resource->num_rows > 0) {
            return $resource->row();
        } else {
            return false;
        }
    }
}

/**
 * Function to save all master logs history
 *
 * @access	public
 */
if (!function_exists('save_masters_hostory')) {
    function save_masters_hostory($type, $data, $action = null) {
        if (!empty($type) && !empty($data)) {
            $CI = &get_instance();
            $insert = array(
                'history_type' => $type,
                'added_by' => currentuserinfo()->id,
                'data' => json_encode($data),
                'action' => $action,
                'created' => current_date());

            $CI->db->insert("master_history", $insert);
        }
    }
}


/**
 * Function to check ajax request
 *
 * @access	public
 */
if (!function_exists('is_ajax_request')) {
    function is_ajax_request() {
        $CI = &get_instance();
        if (!$CI->input->is_ajax_request()) {
            show_error('No direct script access allowed');
            exit;
        }
    }
}

/**
 * Function to get plan
 *
 * @access	public
 */
if (!function_exists('_get_plan_by_type')) {
    function _get_plan_by_type($type = null, $country = null) {
        $CI = &get_instance();
        $CI->db->select("id,plan_name,country");
        if (!empty($type)) {
            $CI->db->where("ac_type", $type);
        }

        if (!empty($country)) {
            $CI->db->where("country", $country);
        }

        $resource = $CI->db->get("master_plans");
        if ($resource->num_rows > 0) {
            return $resource->result();
        } else {
            return false;
        }
    }
}
/**
 * get coount setting by type
 * @purpose to get last any paid or demo  account setting from effective date
 * **/
if (!function_exists('get_account_setting_by_type')) {
    function get_account_setting_by_type($type = null) {
        $CI = &get_instance();
        $current_date = date("Y-m-d", strtotime(current_date()));
        $CI->db->where("date(effective_date) <=", "'$current_date'", false);
        $CI->db->where("account_type", $type);
        $CI->db->limit(1);
        $CI->db->order_by('id', 'desc');
        $query = $CI->db->get("master_accounts");
        if ($query->num_rows > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
}
if (!function_exists('customer_country')) {
    function customer_country($id = null) {
        $arr = array('1' => 'United States', '2' => 'India');
        return $arr[$id];
    }
}

if (!function_exists('count_customer_users')) {
    function count_customer_users($site_id = null) {
        $CI = &get_instance();
        $CI->db->select("count(id) as total_user");
        $CI->db->where("site_id", $site_id);
        $query = $CI->db->get("users");
        return $query->row()->total_user;
    }
}

/**
 * Function to get subscription's type
 *
 * @access	public
 */

if (!function_exists('get_feature_subscription')) {
    function get_feature_subscription($id = null) {
        $data = array(
            "1" => "month",
            "2" => "year",
            "3" => "One Time");
        return $data[$id];
    }
}

/**
 * Function to get count total resume uploaded by customer
 *
 * @access	public
 */

if (!function_exists('count_uploaded_resume')) {
    function count_uploaded_resume($site_id = null) {
        $CI = &get_instance();
        $CI->db->select("count(id) as total_resume");
        $CI->db->where("site_id", $site_id);
        $query = $CI->db->get("candidate");
        return $query->row()->total_resume;
    }
}

/**
 * Function to get count total resume uploaded by customer
 *
 * @access	public
 */

if (!function_exists('count_sent_email')) {
    function count_sent_email($site_id = null) {
        $CI = &get_instance();
        $CI->db->select("count(id) as total_email");
        $CI->db->where("site_id", $site_id);
        $query = $CI->db->get("email_history");
        return $query->row()->total_email;
    }
}


/**
 * Function to get count total resume uploaded by customer
 *
 * @access	public
 */

if (!function_exists('get_my_plan')) {
    function get_my_plan() {
        $db_name = DEFAULT_DATABASE;
        $plan_table = "master_customer_plan";
        $cus_table = "master_customers";
        $site_id = currentuserinfo()->site_id;
        $myplan = "";

        $query = mysql_query("SELECT $plan_table.* FROM $db_name.$cus_table LEFT JOIN $db_name.$plan_table ON $db_name.$plan_table.id=$db_name.$cus_table.current_plan WHERE $cus_table.site_id='$site_id'");

        $result = array();
        while ($row = mysql_fetch_object($query)) {
            $result[] = $row;
        }

        if (!empty($result)) {
            $myplan = (array )decode_customer_plan((object)$result);
            return $myplan[0];
        }
    }
}

if (!function_exists('decode_customer_plan')) {
    function decode_customer_plan($data) {

        foreach ($data as $result) {
            $result->plan = json_decode($result->plan);
            $result->plan->slab_range = json_decode($result->plan->slab_range);
            if (!empty($result->plan->features)) {
                $result->plan->features = json_decode($result->plan->features);
                foreach ($result->plan->features as $fea_key => $fea_val) {
                    $fea_val->slab_range = json_decode($fea_val->slab_range);
                    $fea_val->addon_type = json_decode($fea_val->addon_type);
                    $fea_val->price = json_decode($fea_val->price);
                    $fea_val->total_email = json_decode($fea_val->total_email);
                    $fea_val->total_resume = json_decode($fea_val->total_resume);
                    $fea_val->subscription_type = json_decode($fea_val->subscription_type);
                }
            }

            if (!empty($result->plan->support)) {
                $result->plan->support = json_decode($result->plan->support);
                foreach ($result->plan->support as $sup_key => $sup_val) {
                    $sup_val->slab_range = json_decode($sup_val->slab_range);
                    $sup_val->addon_type = json_decode($sup_val->addon_type);
                    $sup_val->price = json_decode($sup_val->price);
                    $sup_val->subscription_type = json_decode($sup_val->subscription_type);
                }
            }
            $result->account_setting = json_decode($result->account_setting);
            $result->account_setting->reminder_data = json_decode($result->account_setting->reminder_data);
        }
        return $data;
    }
}


if (!function_exists('decode_master_plan')) {
    function decode_master_plan($result) {

        $result->slab_range = json_decode($result->slab_range);
        if (!empty($result->features)) {
            $result->features = json_decode($result->features);
            foreach ($result->features as $fea_key => $fea_val) {
                $fea_val->slab_range = json_decode($fea_val->slab_range);
                $fea_val->addon_type = json_decode($fea_val->addon_type);
                $fea_val->price = json_decode($fea_val->price);
                $fea_val->total_email = json_decode($fea_val->total_email);
                $fea_val->total_resume = json_decode($fea_val->total_resume);
                $fea_val->subscription_type = json_decode($fea_val->subscription_type);
            }
        }

        if (!empty($result->support)) {
            $result->support = json_decode($result->support);
            foreach ($result->support as $sup_key => $sup_val) {
                $sup_val->slab_range = json_decode($sup_val->slab_range);
                $sup_val->addon_type = json_decode($sup_val->addon_type);
                $sup_val->price = json_decode($sup_val->price);
                $sup_val->subscription_type = json_decode($sup_val->subscription_type);
            }
        }

        return $result;
    }
}


if (!function_exists('is_user_limit')) {
    function is_user_limit() {
        $get_plan = get_my_plan();

        $get_plan->addon = (!empty($get_plan->addon)) ? json_decode($get_plan->addon) : "";
        $addon_user = 0;
        if (!empty($get_plan->addon)) {
            foreach ($get_plan->addon as $key => $val) {
                $addon_user = ($val->addon_type == 5) ? ($addon_user + $val->extend_limit) : $addon_user;
            }

        }

        $total_users = count_customer_users(currentuserinfo()->site_id);
        if ($total_users >= ($get_plan->plan->slab_range->to + $addon_user))
            return false;
        else
            return true;

    }
}


if (!function_exists('is_resume_limit')) {
    function is_resume_limit() {
        $get_plan = get_my_plan();
        $get_plan->plan = expand_service_feature($get_plan->plan);
        $get_plan->addon = (!empty($get_plan->addon)) ? json_decode($get_plan->addon) : "";

        $resume_limit = 0;
        $subscription_type = "";
        $addon_resume_limit = 0;
        if(empty($get_plan->plan->features))
        {
            set_flashdata('error','You don\'t have features for this plan');
            redirect(base_url().'candidate/list_items');
        }
        
        foreach ($get_plan->plan->features as $key => $val) {
            if ($val->addon_type == 4) {
                $resume_limit = $resume_limit + $val->total_resume;
                $subscription_type = $val->subscription_type;
            }
        }
        
        if(empty($subscription_type))
        {
            set_flashdata('error','Your plan doesn\'t have add candidate feature');
            redirect(base_url().'candidate/list_items');
        }

        if (!empty($get_plan->addon)) {
            foreach ($get_plan->addon as $key => $val) {
                $addon_resume_limit = ($val->addon_type == 4) ? ($addon_resume_limit + $val->extend_limit) : $addon_resume_limit;
            }
        }

        $effective_from = date("Y-m-d", strtotime($get_plan->effective_from));
        $effective_upto = date("Y-m-d", strtotime($get_plan->effective_upto));

        if ($subscription_type == 1) {
            $from = date("Y-m-1", strtotime(current_date()));
            $to = date("Y-m-d", strtotime("last day of " . current_date()));
        } elseif($subscription_type == 2) {
            $addon_resume_limit = ($addon_resume_limit * 3);
            if ($get_plan->billing_period == 1 || $get_plan->billing_period == 2) {
                $from = $effective_from;
                $to = $effective_upto;
            } elseif($get_plan->billing_period == 3) {
                $date = date("Y-m-d", strtotime(current_date()));
                $alpha_date = date("Y-m-d", strtotime("last day of +2 months " . $effective_from));

                if ($date >= $effective_from && $date <= $alpha_date) {
                    $from = $effective_from;
                    $to = $alpha_date;
                } elseif($date > $alpha_date && $date <= $effective_upto) {
                    $from = date("Y-m-d", strtotime("+1 days " . $alpha_date));
                    $to = $effective_upto;
                }
            } elseif($get_plan->billing_period == 4) {
                $date = date("Y-m-d", strtotime(current_date()));
                $alpha_date = date("Y-m-d", strtotime("last day of +2 months " . $effective_from));
                $beta_date = date("Y-m-d", strtotime("last day of +3 months " . $alpha_date));
                $gamma_date = date("Y-m-d", strtotime("last day of +3 months " . $beta_date));

                if ($date >= $effective_from && $date <= $alpha_date) {
                    $from = $effective_from;
                    $to = $alpha_date;
                } elseif($date > $alpha_date && $date <= $beta_date) {
                    $from = date("Y-m-d", strtotime("+1 days " . $alpha_date));
                    $to = $beta_date;
                } elseif($date > $beta_date && $date <= $gamma_date) {
                    $from = date("Y-m-d", strtotime("+1 days " . $beta_date));
                    $to = $gamma_date;
                } elseif($date > $gamma_date && $date <= $effective_upto) {
                    $from = date("Y-m-d", strtotime("+1 days " . $gamma_date));
                    $to = $effective_upto;
                }

            }
        } elseif($subscription_type == 3) {
            $addon_resume_limit = ($addon_resume_limit * 6);
            if ($get_plan->billing_period == 1 || $get_plan->billing_period == 2 || $get_plan->billing_period ==
                3) {
                $from = $effective_from;
                $to = $effective_upto;
            } elseif($get_plan->billing_period == 4) {
                $date = date("Y-m-d", strtotime(current_date()));
                $alpha_date = date("Y-m-d", strtotime("last day of +5 months " . $effective_from));
                if ($date >= $effective_from && $date <= $alpha_date) {
                    $from = $effective_from;
                    $to = $alpha_date;
                } elseif($date > $alpha_date && $date <= $effective_from) {
                    $from = date("Y-m-d", strtotime("+1 days " . $alpha_date));
                    ;
                    $to = $effective_from;
                }
            }
        } elseif($subscription_type == 4) {
            $addon_resume_limit = ($addon_resume_limit * 12);
            $from = $effective_from;
            $to = $effective_upto;
        }

        $resume_limit = $resume_limit + $addon_resume_limit;
        $total_users = count_customer_resume($from, $to);

        if ($total_users > $resume_limit)
            return false;
        else
            return true;

    }
}


if (!function_exists('explore_service_feature')) {
    function expand_service_feature($result) {
        $final_feature = array();

        if (!empty($result->features)) {
            foreach ($result->features as $k => $v) {
                $feature['feature_name'] = $v->feature_name;
                foreach ($v->slab_range as $key => $val) {
                    if ($val->id == $result->slab_range->id) {
                        $slab_index = $key;
                    }
                }
                $feature['addon_type'] = $v->addon_type[$slab_index];
                $feature['price'] = $v->price[$slab_index];
                $feature['total_email'] = $v->total_email[$slab_index];
                $feature['total_resume'] = $v->total_resume[$slab_index];
                $feature['subscription_type'] = $v->subscription_type[$slab_index];
                $final_feature[] = (object)$feature;
            }
            $result->features = (object)$final_feature;
        }

        $final_support = array();

        if (!empty($result->support)) {
            foreach ($result->support as $k => $v) {
                $service['service_name'] = $v->service_name;
                foreach ($v->slab_range as $key => $val) {
                    if ($val->id == $result->slab_range->id) {
                        $slab_index = $key;
                    }
                }
                $service['addon_type'] = $v->addon_type[$slab_index];
                $service['price'] = $v->price[$slab_index];
                $service['subscription_type'] = $v->subscription_type[$slab_index];
                $final_support[] = (object)$service;
            }
            $result->support = (object)$final_support;
        }
        return $result;
    }
}


if (!function_exists('_getAddonByCondition')) {
    function _getAddonByCondition($condition = null) {
        $CI = &get_instance();
        if (!empty($condition)) {
            foreach ($condition as $k => $v) {
                $CI->db->where($k, $v);
            }
        }
        $CI->db->order_by('id', 'desc');
        $result = $CI->db->get('master_addon');
        if ($result->num_rows > 0) {
            return $result->result();
        }
        return false;
    }
}


if (!function_exists('_getAddonByIds')) {
    function _getAddonByIds($ids = null) {
        $CI = &get_instance();
        $CI->db->where_in('id', $ids, true);
        $CI->db->order_by('id', 'desc');
        $result = $CI->db->get('master_addon');
        if ($result->num_rows > 0) {
            return $result->result();
        }
        return false;
    }
}

if (!function_exists('money_formt')) {
    function money_formt($price = null) {
        return sprintf('%01.2f', $price);
    }
}

if (!function_exists('count_customer_resumes')) {
    function count_customer_resume($from, $to) {
        $CI = &get_instance();
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $site_id = currentuserinfo()->site_id;
        $CI->db->select("count(id) as total_resumes");
        $CI->db->where("site_id", $site_id);
        $CI->db->where("date(`created_time`) >=", $from);
        $CI->db->where("date(`created_time`) <=", $to);
        $query = $CI->db->get("candidate");
        return $query->row()->total_resumes;
    }
}


if (!function_exists('is_email_limit')) {
    function is_email_limit() {
        $get_plan = get_my_plan();
        $get_plan->plan = expand_service_feature($get_plan->plan);
        $get_plan->addon = (!empty($get_plan->addon)) ? json_decode($get_plan->addon) : "";

        $email_limit = 0;
        $subscription_type = "";
        $addon_email_limit = 0;

        foreach ($get_plan->plan->features as $key => $val) {
            if ($val->addon_type == 3) {
                $email_limit = $email_limit + $val->total_email;
                $subscription_type = $val->subscription_type;
            }
        }

        if (!empty($get_plan->addon)) {
            foreach ($get_plan->addon as $key => $val) {
                $addon_email_limit = ($val->addon_type == 3) ? ($addon_email_limit + $val->extend_limit) : $addon_email_limit;
            }
        }

        $effective_from = date("Y-m-d", strtotime($get_plan->effective_from));
        $effective_upto = date("Y-m-d", strtotime($get_plan->effective_upto));

        if ($subscription_type == 1) {
            $from = date("Y-m-1", strtotime(current_date()));
            $to = date("Y-m-d", strtotime("last day of " . current_date()));
        } elseif($subscription_type == 2) {
            $addon_email_limit = ($addon_email_limit * 3);
            if ($get_plan->billing_period == 1 || $get_plan->billing_period == 2) {
                $from = $effective_from;
                $to = $effective_upto;
            } elseif($get_plan->billing_period == 3) {
                $date = date("Y-m-d", strtotime(current_date()));
                $alpha_date = date("Y-m-d", strtotime("last day of +2 months " . $effective_from));

                if ($date >= $effective_from && $date <= $alpha_date) {
                    $from = $effective_from;
                    $to = $alpha_date;
                } elseif($date > $alpha_date && $date <= $effective_upto) {
                    $from = date("Y-m-d", strtotime("+1 days " . $alpha_date));
                    $to = $effective_upto;
                }
            } elseif($get_plan->billing_period == 4) {
                $date = date("Y-m-d", strtotime(current_date()));
                $alpha_date = date("Y-m-d", strtotime("last day of +2 months " . $effective_from));
                $beta_date = date("Y-m-d", strtotime("last day of +3 months " . $alpha_date));
                $gamma_date = date("Y-m-d", strtotime("last day of +3 months " . $beta_date));

                if ($date >= $effective_from && $date <= $alpha_date) {
                    $from = $effective_from;
                    $to = $alpha_date;
                } elseif($date > $alpha_date && $date <= $beta_date) {
                    $from = date("Y-m-d", strtotime("+1 days " . $alpha_date));
                    $to = $beta_date;
                } elseif($date > $beta_date && $date <= $gamma_date) {
                    $from = date("Y-m-d", strtotime("+1 days " . $beta_date));
                    $to = $gamma_date;
                } elseif($date > $gamma_date && $date <= $effective_upto) {
                    $from = date("Y-m-d", strtotime("+1 days " . $gamma_date));
                    $to = $effective_upto;
                }

            }
        } elseif($subscription_type == 3) {
            $addon_email_limit = ($addon_email_limit * 6);
            if ($get_plan->billing_period == 1 || $get_plan->billing_period == 2 || $get_plan->billing_period ==
                3) {
                $from = $effective_from;
                $to = $effective_upto;
            } elseif($get_plan->billing_period == 4) {
                $date = date("Y-m-d", strtotime(current_date()));
                $alpha_date = date("Y-m-d", strtotime("last day of +5 months " . $effective_from));
                if ($date >= $effective_from && $date <= $alpha_date) {
                    $from = $effective_from;
                    $to = $alpha_date;
                } elseif($date > $alpha_date && $date <= $effective_from) {
                    $from = date("Y-m-d", strtotime("+1 days " . $alpha_date));
                    ;
                    $to = $effective_from;
                }
            }
        } elseif($subscription_type == 4) {
            $addon_email_limit = ($addon_email_limit * 12);
            $from = $effective_from;
            $to = $effective_upto;
        }

        $email_limit = $email_limit + $addon_email_limit;
        $total_email_used = count_customer_email($from, $to);
        
        return ($email_limit - $total_email_used);
    }
}


if (!function_exists('count_customer_email')) {
    function count_customer_email($from, $to) {
        $CI = &get_instance();
        $from = date("Y-m-d", strtotime($from));
        $to = date("Y-m-d", strtotime($to));
        $site_id = currentuserinfo()->site_id;
        $CI->db->select("recievers_id");
        $CI->db->where("site_id", $site_id);
        $CI->db->where("date(`created_time`) >=", $from);
        $CI->db->where("date(`created_time`) <=", $to);
        $query = $CI->db->get("email_history");
        $result = $query->result();
        $count = 0;
        if (!empty($result)) {
            foreach ($result as $key => $val) {
                $ids = $val->recievers_id;
                $arr = explode(",", $ids);
                $count = $count + count($arr);
            }
        }
        return $count;
    }
  
}
//////

// ------------------------------------------------------------------------

/**
 * Function to get subscription's feature type
 *
 * @access	public
 */

if (!function_exists('get_customer_email_graph')) { 
    function get_customer_email_graph($year = 2015, $month = 1,$day_interval = 5) {
        $start_date= 1;
        $end_date = $day_interval;
        $count_mail_array = array();
        $array_count = 0;
        for(;$end_date <31;){
             $from = $year.'-'.$month.'-'.$start_date;
            //echo '<br>';
             $to = $year.'-'.($month).'-'.$end_date;
           // echo '<hr>';
             
            //echo 'mail =>'.count_customer_email_of_month($from,$to).'<hr>';
            if($array_count == 0)
                  $count_mail_array[$array_count] = count_customer_email_of_month($from,$to);
            else
                  $count_mail_array[$array_count] = $count_mail_array[$array_count-1] + count_customer_email_of_month($from,$to);
            $array_count++;
            $start_date += $day_interval;
            $end_date += $day_interval;
        }
       // print_r($count_mail_array);die;
        return $count_mail_array;
    }
    }
    if (!function_exists('count_customer_email_of_month')) { 
    function count_customer_email_of_month($from, $to) {
        $CI = &get_instance();
    
        $site_id = currentuserinfo()->site_id;
        // 
        /////////////////
        /*
        $database = DEFAULT_DATABASE;
        $sql = "SELECT `recievers_id` FROM ($database.email_history) WHERE  date(`created_time`) >= '$from' AND date(`created_time`) <= '$to' LIMIT 20";
        //echo $sql.'<br>';
        $result= mysql_query( $sql );
        //var_dump($result);
        $object_result = array();
        $count_row = 0;
        while($row = mysql_fetch_object($result))
        { 
            $object_result[] = @$row;
            $count_row++;
        }
        $result = $object_result;
        */
        ////////////////////////
        
        
        
        ////////////////////////////////////
        $CI->db->select("recievers_id");
        $CI->db->where("site_id", $site_id);
        $CI->db->where("date(`created_time`) >=", $from);
        $CI->db->where("date(`created_time`) <=", $to);
        $query = $CI->db->get("email_history");
        $result = $query->result();
        ////////////////////////////////////
        
        //echo $CI->db->last_query();
        //print '<pre>'; print_r($result);die;
        $count = 0;
        if (!empty($result)) {
            foreach ($result as $key => $val) { 
                $ids = $val->recievers_id; 
                $arr = explode(",", $ids);
                $count = $count + count($arr);
            }
        }
        return $count;
        }
    }
    
    
    
    if(!function_exists('get_customer_user_graph')) { 
        function get_customer_user_graph($year = 2015, $month = 1,$day_interval = 5) {
            $start_date= 1;
            $end_date = $day_interval;
            $count_user_array = array();
            $array_count = 0;
            for(;$end_date <31;){
                 $from = $year.'-'.$month.'-'.$start_date;
                //echo '<br>';
                 $to = $year.'-'.($month).'-'.$end_date;
               // echo '<hr>';
                 
                //echo 'mail =>'.count_customer_email_of_month($from,$to).'<hr>';
                if($array_count == 0)
                      $count_user_array[$array_count] = count_customer_user_of_month($from,$to);
                else
                      $count_user_array[$array_count] = $count_user_array[$array_count-1] + count_customer_user_of_month($from,$to);
                $array_count++;
                $start_date += $day_interval;
                $end_date += $day_interval;
            }
            //print_r($count_user_array);die;
            return $count_user_array;
         }
    }
    
    
    if (!function_exists('count_customer_user_of_month')) {
        function count_customer_user_of_month($from, $to) {
            $CI = &get_instance();
            $site_id = currentuserinfo()->site_id;
            ////////////////////////////////////////
            
            $database = DEFAULT_DATABASE;
            $sql = "SELECT count(id) as total_user FROM ($database.users) WHERE date(`created_time`) >= '$from' AND date(`created_time`) <= '$to' AND site_id = '$site_id'";
            //echo $sql.'<br>';
            $result= mysql_query( $sql );
            //var_dump($result);
            $row = mysql_fetch_object($result);
            $result = $row;

            ////////////////////////////////////////
            /*
            $CI->db->select("count(id) as total_user");
            $CI->db->where("site_id", $site_id);
            $query = $CI->db->get("users");
            echo $CI->db->last_query();
            $result = $query->row();
            */
            
            //print '<pre>';print_R($result);
            return $result->total_user;
        }
    }
    
    
    
    if(!function_exists('get_customer_resume_graph')) { 
        function get_customer_resume_graph($year = 2015, $month = 1,$day_interval = 5) {
            $start_date= 1;
            $end_date = $day_interval;
            $count_resume_array = array();
            $array_count = 0;
            for(;$end_date <31;){
                 $from = $year.'-'.$month.'-'.$start_date;
                //echo '<br>';
                 $to = $year.'-'.($month).'-'.$end_date;
               // echo '<hr>';
                 
                //echo 'mail =>'.count_customer_email_of_month($from,$to).'<hr>';
                if($array_count == 0)
                      $count_resume_array[$array_count] = count_customer_resume_of_month($from,$to);
                else
                      $count_resume_array[$array_count] = $count_resume_array[$array_count-1] + count_customer_resume_of_month($from,$to);
                $array_count++;
                $start_date += $day_interval;
                $end_date += $day_interval;
            }
            //print_r($count_resume_array);die;
            return $count_resume_array;
         }
    }
    
    

if (!function_exists('count_customer_resume_of_month')) {
        function count_customer_resume_of_month($from, $to) {
            $CI = &get_instance();
            $site_id = currentuserinfo()->site_id;
            ////////////////////////////////////////
            /*
            $database = DEFAULT_DATABASE;
            $sql = "SELECT count(id) as total_user FROM ($database.candidate) WHERE date(`created_time`) >= '$from' AND date(`created_time`) <= '$to'";
            //echo $sql.'<br>';
            $result= mysql_query( $sql );
            //var_dump($result);
            $row = mysql_fetch_object($result);
            $result = $row;
            */
            ////////////////////////////////////////
            
            $CI->db->select("count(id) as total_resumes");
            $CI->db->where("site_id", $site_id);
            $CI->db->where("date(`created_time`) >=", $from);
            $CI->db->where("date(`created_time`) <=", $to);
            $query = $CI->db->get("candidate");
            //echo $CI->db->last_query();
            $result = $query->row();
            
            
            //print '<pre>';print_R($result);
            return $result->total_resumes;
        }
    }
    
    
    if (!function_exists('year_dropdown')) {
        function year_dropdown($no_of_years = 20) {
              $current_year = date('Y');
              $dropdown = '';
              $dropdown .= '<select class="year_dropdown">';
              for($year_counter=0;$year_counter != $no_of_years ;$year_counter++ )
                 $dropdown .= '<option value="'.($current_year-$year_counter).'">'.($current_year-$year_counter).'</option>';
              $dropdown .= '</select>';
                return $dropdown;
            }
    }
     if (!function_exists('new_request_type_dropdown')) {
        function new_request_type_dropdown() {
              $dropdown = '';
              $dropdown .= '<select name="type" class="new_request_type_dropdown form-control">';
                 $dropdown .= '<option value="e-mail"> Need Extra E-mail </option>';
                 $dropdown .= '<option value="user"> Need Extra User</option>';
                 $dropdown .= '<option value="resume"> Need Extra Resumes</option>';
                 $dropdown .= '<option value="Support / Feedback"> Support / Feedback </option>';
              $dropdown .= '</select>';
                return $dropdown;
            }
    }
