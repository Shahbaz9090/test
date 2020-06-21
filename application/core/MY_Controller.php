<?php if (!defined('BASEPATH')) {exit('No direct script access allowed'); }



class MY_Controller extends CI_Controller

{

    public $visible_list = array();

    public function __construct()

    {

        parent::__construct();

        $this->visible_list = $this->check_user_permission();

    }



    public function check_user_permission()

    {

        $uri                = current_uri();

        $module             = $this->router->fetch_module();

        $controller_name    = $this->router->fetch_class();

        $method_name        = $this->router->fetch_method();

        $bypass_permission  = $this->config->item('bypass_permission');

        $currentuserinfo    = currentuserinfo();

        $isPermitted 		= 0;

        /*echo "<br>".$uri;

		echo "<br>".$module;

		echo "<br>".$controller_name;

		echo "<br>".$method_name;*/

        /*Start check if admin is logged in*/

        if (isset($currentuserinfo->is_super) && $currentuserinfo->is_super == 1) {

            

            $isPermitted++;

            return TRUE;exit;

        }

        /*End Check if admin is logged in*/



        /*Start check if action set in bypass module*/

        if(!empty(cache_opration('get','bypass_permission')))

        {

            $bypass_status = 0;

            $bypass = cache_opration('get','bypass_permission');

            foreach ($bypass as $key => $value) {

                if($value['controller']==$controller_name && $value['method']==$method_name)

                {

                	$bypass_status++;

                    // echo "<h1>Mila</h1>";

                }

            }

            if($bypass_status>0)

            {

            	$isPermitted++;

            	return TRUE;exit;

            }

        }

        else

        {

        	$bypass_status = 0;

        	$bypass   = $this->db->select('controller,method')->get_where('inch_bypass_permission',['status'=>1])->result_array();

            cache_opration('set','bypass_permission', $bypass);

            foreach ($bypass as $key => $value) {

                if($value['controller']==$controller_name && $value['method']==$method_name)

                {

                    $bypass_status++;

                }

            }

            if($bypass_status>0)

            {

            	$isPermitted++;

            	return TRUE;exit;

            }

        }

        /*End check if action set in bypass module*/



        /*start check if action is comming from ajax request*/

        if($this->input->is_ajax_request())

        {

            if($method_name != 'delete_document' && $method_name != 'release_final_quotation' && $method_name != 'reply_on_ticket' && $method_name != 'bulk_email' && $method_name != 'transfer_client' && $method_name != 'ticket_logs' && $method_name != 'add_custom_cfit' && $method_name != 'edit_custom_cfit' && $method_name != 'add_insurance' && $method_name != 'edit_insurance' && $method_name != 'add_shipping' && $method_name != 'edit_shipping' && $method_name != 'add_custom_inch' && $method_name != 'eidt_custom_inch' && $method_name != 'add_handling' && $method_name != 'edit_handling' && $method_name != 'move_to_lot' && $method_name != 'add_more_email'  && $method_name != 'reply_on_lot_ticket'  && $method_name != 'reply_on_logistics_ticket' && $method_name != 'add_document' && $method_name != 'set_status' )

            {

            	$isPermitted++;

                return TRUE;exit;

            }

        }

        /*End check if action is comming from ajax request*/



        /*Start check is action set in config file for bypass*/

        if (isset($bypass_permission[$controller_name])) {

            $temp = $bypass_permission[$controller_name];

            $condition_for = TRUE;

            if (is_array($temp) && in_array($method_name, $temp)) {

                $this->session->set_userdata('permission', $condition_for);

                $isPermitted++;

                return $data;exit;

            }

            if ($temp === TRUE) {

                $this->session->set_userdata('permission', $condition_for);

                $isPermitted++;

                return $data;exit;

            }

        }

        /*End check is action set in config file for bypass*/



        /*Start check current user permission*/

        $data           = array();

        $current_uri    = array();

        if ($currentuserinfo->extra_group_id == "" || $currentuserinfo->extra_group_id == "group_name") {

            $group_id   = $currentuserinfo->group_id;

            $this->db->where('group_id', $group_id);

            $this->db->where('uri !=', '');

            $query      = $this->db->get('user_group_permissions');

            $row        = $query->row();

            if ($row) {

                $current_uri    = json_decode(stripslashes($row->uri));

                $data           = json_decode(stripslashes($row->data), TRUE);

            }

        } else {

            $group_id       = $currentuserinfo->group_id;

            $extra_group    = $currentuserinfo->extra_group_id . "," . $group_id;

            $extra_group_id = explode(",", $extra_group);

            $this->db->where_in('group_id', $extra_group_id);

            $query          = $this->db->get('user_group_permissions');

            $results        = $query->result_array();

            //pr($results);die;

            foreach ($results as $row) {

                $temp       = json_decode(stripslashes($row['data']), TRUE);

                $current    = json_decode(stripslashes($row['uri']));

                //pr($temp);die;

                foreach ($temp as $k => $v) {

                    if (array_key_exists($k, $data)) {

                        $data[$k] = array_merge($v, $data[$k]);

                    } else {

                        $data[$k] = $v;

                    }

                }

                foreach ($current as $k => $v) {

                    $current_uri[$k] = $v;

                }

            }

        }

        $myuri = (array) $current_uri;

        if(in_array($method_name, ['list_items','index','ajax_list_items','dynamic'])){$method_name = 'view';}

        if(in_array($method_name, ['dynamic_add','dynamic_delete','dynamic_edit','dynamic_view'])){$method_name = str_replace("dynamic_", "", $method_name);}

        

        $condition_for = array();

        $condition_for_tmp = array();

        if($controller_name=='form_module' && (uri_segment(2) == 'dynamic_edit' || uri_segment(2) == 'dynamic_view'))

        {

           	$controller_name = uri_segment(5);

        }

        elseif($controller_name=='form_module')

        {

           	$controller_name = uri_segment(3);

        }

        // $condition_for = $data[$controller_name];

        foreach ($data as $all_m_key => $all_mdl) {

            if(isset($all_mdl['controller_duplicate']) && !empty($all_mdl['controller_duplicate']) && $all_mdl['controller_duplicate'] == $controller_name && $all_mdl['module'] == $module)

            {

                $condition_for_tmp = array_merge($condition_for_tmp, $all_mdl);

            }

            elseif($all_mdl['controller'] == $controller_name  && $all_mdl['module'] == $module)

            {

                $condition_for_tmp = array_merge($condition_for_tmp, $all_mdl);

            }

        }



        // pr($condition_for_tmp);die;

        $check_by_code = $myuri[$controller_name.'/'.$method_name];



        if(array_key_exists($method_name, $condition_for_tmp) || array_key_exists('all_'.$method_name, $condition_for_tmp) || array_key_exists('own_'.$method_name, $condition_for_tmp))

        {

            $this->session->set_userdata('permission', $condition_for_tmp);

            $isPermitted++;

            return $data;exit;

        }

        /*End check current user permission*/



        /*Start for ajax requests get permission message as json*/

        if(($method_name == 'delete_document' || $method_name == 'release_final_quotation' || $method_name == 'reply_on_ticket' || $method_name == 'bulk_email' || $method_name == 'transfer_client' || $method_name == 'add_custom_cfit' || $method_name == 'edit_custom_cfit' || $method_name == 'add_insurance'|| $method_name == 'edit_insurance' || $method_name == 'add_shipping' || $method_name == 'edit_shipping' && $method_name == 'add_custom_inch' || $method_name == 'eidt_custom_inch' || $method_name == 'add_handling' || $method_name == 'edit_handling' || $method_name == 'move_to_lot' || $method_name == 'add_more_email' || $method_name == 'reply_on_lot_ticket' || $method_name == 'reply_on_logistics_ticket' || $method_name == 'add_document' || $method_name == 'set_status') && $this->input->is_ajax_request())

        {

        	$isPermitted++;

            echo json_encode(['status'=>'error','message'=>'You do not have permission of this module.']);die;

        }

        /*End for ajax requests get permission message as json*/

        //echo "<h1>Mail yaha aa gya</h1>";

        /*If user have no any permission of the current action then redirect to back*/



        // $_SERVER['PERM'] = 1;

        if($isPermitted === 0)

        {

	        set_flashdata('error', 'You do not have permission to access this module!');

	        return redirect($_SERVER['HTTP_REFERER'].'/?perm=1');

        }

    }



    public function SendEmail($subject = NULL, $body = NULL, $to = NULL, $cc = NULL, $bcc = NULL, $attrachments = NULL, $attrachments2 = NULL, $is_reply = NULL, $smtp = NULL)

    {

        // $this->load->library('Sendmail');

        $config['protocol']     = 'mail';

        $config['smtp_host']    = 'ssl://smtp.gmail.com';

        $config['smtp_port']    = '465';

        $config['smtp_user']    = 'developers.techbuddiesit@gmail.com';

        $config['smtp_pass']    = 'developers@1234';

        if(isset($smtp['smtp_host']) && $smtp['smtp_host'] && isset($smtp['smtp_port']) && $smtp['smtp_port'] && isset($smtp['smtp_user']) && $smtp['smtp_user'] && isset($smtp['smtp_pass']) && $smtp['smtp_pass'])

        {

            $config['smtp_host']    = $smtp['smtp_host'];

            $config['smtp_port']    = $smtp['smtp_port'];

            $config['smtp_user']    = $smtp['smtp_user'];

            $config['smtp_pass']    = $smtp['smtp_pass'];

        }



        $config['smtp_timeout'] = '7';

        $config['charset']      = 'utf-8';

        $config['newline']      = "\r\n";

        $config['mailtype']     = 'text'; // or html

        $config['validation']   = TRUE; // bool whether to validate email or not      

        $this->email->initialize($config);

        // pr($config);die;

        $this->email->from($config['smtp_user'], 'Inch Group');

        $this->email->reply_to($config['smtp_user'], 'Inch Group'); //User email submited in form

        $this->email->to($to);

        if(!empty($cc))

        {

            $this->email->cc($cc);

        }

        if(!empty($bcc))

        {

            $this->email->bcc($bcc);

        }

        if(!empty($attrachments))

        {

            if(is_array($attrachments) && count($attrachments)>0)

            {

                foreach ($attrachments as $key => $attrachment) {

                    $this->email->attach($attrachment);

                }

            }

            else

            {

                $this->email->attach($attrachments);

            }

        }

        if(!empty($attrachments2))

        {

            if(is_array($attrachments2) && count($attrachments2)>0)

            {

                foreach ($attrachments2 as $key => $attrachment2) {

                    $this->email->attach($attrachment2);

                }

            }

            else

            {

                $this->email->attach($attrachments2);

            }

        }

        

        $this->email->subject($subject);

        $this->email->set_mailtype("html");

        $this->email->message($body);

        if($status = $this->email->send())

        {

            return $status;

        }

        else

        {

            // echo ($this->email->print_debugger());die;

            return false;

        }

    }



}

