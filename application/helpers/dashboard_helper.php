<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**

 * Database helper
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Db * @author		Punit Kumar
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc 
 * @since		Version 1.0
 */
//------------------------------------------------------------------------------
if (!function_exists('_totalLeads')) {
    function _totalLeads($status = null, $user = null, $duration = null) {
        if($user){
            $assigndLeads = _assignToData($user);   
        }
        if ($status == 'unassigned' || $status == 'working') {        
            $lead_array = getAssignLead();
        }        
        if ($status == 'won' || $status == 'archieved') {
            $invoicedleads = _getInvoicedLeads();
        }
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->from('leads');
        if ($status == 'lead') {
            $CI->db->where("lead_status", '0');
        } elseif ($status == 'archieved_lead') {
            $CI->db->where("lead_status", '1');
        } elseif ($status == 'unassigned') {
            if ($lead_array) {
                $CI->db->where_not_in("id", $lead_array);
            }
            $CI->db->where('lead_status', '2');
        } else
            if ($status == 'working') {
                if ($lead_array) {
                    $CI->db->where_in("id", $lead_array);
                } else {
                    $CI->db->where("id", '');
                }
                $CI->db->where('lead_status', '2');
            } else
                if ($status == 'won') {
                    if ($invoicedleads) {
                        $CI->db->where('lead_status', '3');
                        $CI->db->where_not_in('id', $invoicedleads);
                    } else {
                        $CI->db->where('lead_status', '3'); //set result null
                    }
                } else
                    if ($status == 'archieved') {
                        if ($invoicedleads) {
                            $CI->db->where('lead_status', '3');
                            $CI->db->where_in('id', $invoicedleads);
                        } else {
                            $CI->db->where('id', '0'); //set result null
                        }
                    } else
                        if ($status == 'lost') {
                            $CI->db->where('lead_status', '4');
                        }
        if (isset($assigndLeads) && !empty($assigndLeads)) {
            foreach ($assigndLeads as $k => $v) {
                $arr[] = $v->lead_id;
            }
            $assignLeadStr = implode(',', $arr);
        }                
        if (is_array($user)) {
            if(isset($assignLeadStr)){
                $user=implode(',',$user);
                $CI->db->where("(added_by IN ($user) OR id IN ($assignLeadStr))");   
            }else{
                $CI->db->where_in('added_by', $user);
            }
        } else if ($user) {
                if(isset($assignLeadStr)){
                    $CI->db->where("(added_by=$user OR id IN ($assignLeadStr))");   
                }else{
                    $CI->db->where('added_by', $user);
                }
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $CI->db->where('`modified` >=', $duration['start']);
            $CI->db->where('`modified` <=', $duration['end']);
        }
        $result = $CI->db->get(); //echo $CI->db->last_query();die;
        //echo $result->num_rows();//die;
        return $result->num_rows();
    }
}


//------------------------------------------------------------------------------
if (!function_exists('_totalRecords')) {
    function _totalRecords($table = null, $user = null, $duration = null,$type = null) {
		
        $CI = &get_instance();
        $CI->db->select("$table.id");
        $CI->db->from($table);
        $CI->db->join("leads", "leads.id=$table.lead_id", 'left');
		if($type!= ''){
			$CI->db->where("$table.for_whom", $type);
		}
        if (is_array($user)) {
            $CI->db->where_in('leads.added_by', $user);
        } else
            if ($user) {
                $CI->db->where('leads.added_by', $user);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $CI->db->where("$table.`modified` >=", $duration['start']);
            $CI->db->where("$table.`modified` <=", $duration['end']);
        }
        $query = $CI->db->get();
        return $query->num_rows();
    }
}
//------------------------------------------------------------------------------
if (!function_exists('_getOpportunities')) {
    function _getOpportunities($status = null, $user = null, $duration = null) {
        if($user){
            $assigndLeads = _assignToData($user);   
        }
        if ($status == 'unassigned') { 
            $lead_array = getAssignLead();
        }
        if ($status == 'won') {
            $invoicedleads = _getInvoicedLeads();
        }
        $CI = &get_instance();
        $CI->db->select('leads.id,leads.display_id,leads.lead_type,added_by,leads.company_name,leads.company_contact,leads.assigned_telemarketer,leads.created,assign_leads.assigned_to');
        $CI->db->from('leads');
        $CI->db->join('assign_leads', 'assign_leads.lead_id=leads.id', 'left');
        //$CI->db->join('users', 'users.id=leads.added_by', 'left');
        if ($status == 'unassigned') {
            $CI->db->where('lead_status', '2');
            if ($lead_array) {
                $CI->db->where_not_in("leads.id", $lead_array);
            }
        } else
            if ($status == 'won') {
                $CI->db->where('lead_status', '3');
                if ($invoicedleads) {
                    $CI->db->where_not_in('leads.id', $invoicedleads);
                }
            }
            
        if (isset($assigndLeads) && !empty($assigndLeads)) {
            foreach ($assigndLeads as $k => $v) {
                $arr[] = $v->lead_id;
            }
            $assignLeadStr = implode(',', $arr);
        }   
         
        if (is_array($user)) {
            if(isset($assignLeadStr)){
                $user=implode(',',$user);
                $CI->db->where("(added_by IN ($user) OR leads.id IN ($assignLeadStr))");   
            }else{
                $CI->db->where_in('added_by', $user);
            }
        } else
            if ($user) {
                if(isset($assignLeadStr)){
                    $CI->db->where("(added_by=$user OR leads.id IN ($assignLeadStr))");   
                }else{
                    $CI->db->where('added_by', $user);
                }
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $CI->db->where("leads.`modified` >=", $duration['start']);
            $CI->db->where("leads.`modified` <=", $duration['end']);
        }
        $CI->db->limit(10);
        $CI->db->order_by('leads.`modified`', 'desc');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->result();
            if (_isSalesManager()) {
                foreach ($result as $k => $v) {
                    if (($v->lead_type == '2' && $v->added_by != _userId())) {
                        unset($result[$k]);
                    }
                }
            }
            return $result;
        }
        return false;
    }
}

if (!function_exists('_totalLeadsByGroup')) {
    function _totalLeadsByGroup($group_id = null, $status = null, $duration = null) {
        $CI = &get_instance();
        $CI->db->select('leads.id');
        $CI->db->from('leads');
        $CI->db->join('users', 'users.id=leads.added_by', 'left');
        $CI->db->where('users.group_id', $group_id);
        if ($status == 'lead') {
            $whr = "(`leads`.`lead_status`='0' OR `leads`.`lead_status`='1')";
            $CI->db->where($whr);
        } else
            if ($status == 'opportunity') {
                $whr = "(`leads`.`lead_status`!='0' AND `leads`.`lead_status`!='1')";
                $CI->db->where($whr);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $CI->db->where("leads.`modified` >=", $duration['start']);
            $CI->db->where("leads.`modified` <=", $duration['end']);
        }
        $query = $CI->db->get();
        return $query->num_rows();
    }
}

if (!function_exists('_totalTasks')) {
    function _totalTasks($user = null, $duration = null) {
        $CI = &get_instance();
        $CI->db->select('id');
        $CI->db->from('tasks');
        if (is_array($user)) {
            $CI->db->where_in('added_by', $user);
        } else
            if ($user) {
                $CI->db->where('added_by', $user);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $CI->db->where("`modified` >=", $duration['start']);
            $CI->db->where("`modified` <=", $duration['end']);
        }
        $query = $CI->db->get();
        return $query->num_rows();
    }
}

if (!function_exists('_rangeToDate')) {
    function _rangeToDate($duration = null) {
        $array = explode('-', $duration);
        $data['start'] = date('Y-m-d H:i:s', strtotime($array[0]));
        $data['end'] = date('Y-m-d H:i:s', strtotime($array[1].' 23:59:59'));
        return $data;
    }
}

if (!function_exists('_saleRecords')) {
    function _saleRecords($user = null, $duration = null) {
        $group=null;
        if (is_array($user)) {
            $group=@get_user_data($user[0])->group_id;
        }else if($user){
            $group=@get_user_data($user)->group_id;
        }
        $CI = &get_instance();
        $CI->db->select('invoices.*,leads.assigned_telemarketer,assign_leads.assigned_to');
        $CI->db->from('invoices');
        $CI->db->join('leads', 'leads.id=invoices.lead_id', '');
        $CI->db->join('assign_leads', 'assign_leads.lead_id=invoices.lead_id', 'left');
        if (is_array($user)) {
            $user=implode(",",$user);
            $where_in="(`leads`.`assigned_telemarketer` IN($user) OR `assign_leads`.`assigned_to` IN($user))";
            //$CI->db->where_in('leads.assigned_telemarketer', $user);
            //$CI->db->or_where_in('assign_leads.assigned_to', $user);
            $CI->db->where($where_in);
        } else if ($user) {
                $where="(`leads`.`assigned_telemarketer`=$user OR `assign_leads`.`assigned_to`=$user)";
                //$CI->db->where('(leads.assigned_telemarketer', $user);
                //$CI->db->or_where('assign_leads.assigned_to)', $user);
                $CI->db->where($where);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $start=$duration['start'];
            $end=$duration['end'];
            $where="(`invoices`.`created` >= '$start' AND `invoices`.`created` <= '$end')";
            //$CI->db->where("`invoices.created` >=", $duration['start']);
            //$CI->db->where("`invoices.created` <=", $duration['end']);
            $CI->db->where($where);
        }
        $CI->db->order_by('invoices.created', 'ASC');
        $query = $CI->db->get();
        //echo $CI->db->last_query();
        if ($query->num_rows()) {
            $result = $query->result();
            $lastCreated = "";
            $sp_commission = "";
            $tm_commission = "";
            if($group==2){
               $str = "[['Day','Tele Marketer'],";
            }else if($group==3){
               $str = "[['Day', 'Sales Person'],"; 
            }else{
               $str = "[['Day', 'Sales Person', 'Tele Marketer'],"; 
            }
            $arr = array();
            foreach ($result as $row) {
                $invoice_data = json_decode($row->data);
                //_pr($invoice_data);die;
                $created = date('Y-m-d',strtotime($row->created));
                if ($lastCreated == $created) {
                    $sp_commission += $invoice_data->sp_commission;
                    $tm_commission += $invoice_data->tm_commission;
                } else {
                    $sp_commission = $invoice_data->sp_commission;
                    $tm_commission = $invoice_data->tm_commission;
                }
                if($group==2){
                   $arr[$created] = array('tm'=>$tm_commission);   
                }else if($group==3){
                   $arr[$created] = array('sp'=>$sp_commission); 
                }else{
                   $arr[$created] = array('sp'=>$sp_commission,'tm'=>$tm_commission); 
                }
                $lastCreated = $created;
            }
            $val_sp="";
            $val_tm="";
            foreach($arr as $key=>$val){
                if(isset($val['sp'])){
                    $val_sp="," . $val['sp'];
                }
                if(isset($val['tm'])){
                    $val_tm="," . $val['tm'];
                }
                $str .= "['" . date('d-M', strtotime($key))."'" .$val_sp.$val_tm."],";
            }
            $str=rtrim($str,',');
                
            $str .= "]";
            return $str;
        }
        return "[['Day', 'Sales Person', 'Tele Marketer'],[0,0,0]]";
    }
}

//---------------------------------------------------------------------------------------
if (!function_exists('_saleRecordsAjax')) {
    function _saleRecordsAjax($user = null, $duration = null) {
        $group=null;
        $inputUser=array();
        if (is_array($user)) {
            $group=@get_user_data($user[0])->group_id;
            $inputUser=$user;
        }else if($user){
            $group=@get_user_data($user)->group_id;
            $inputUser=array($user);
        }
        $CI = &get_instance();
        $CI->db->select('invoices.*,leads.assigned_telemarketer,assign_leads.assigned_to');
        $CI->db->from('invoices');
        $CI->db->join('leads', 'leads.id=invoices.lead_id', '');
        $CI->db->join('assign_leads', 'assign_leads.lead_id=invoices.lead_id', 'left');
        if (is_array($user)) {
            $userStr=implode(",",$user);
            $where_in="(`leads`.`assigned_telemarketer` IN($userStr) OR `assign_leads`.`assigned_to` IN($userStr))";
            $CI->db->where($where_in);
        } else if ($user) {
                $where="(`leads`.`assigned_telemarketer`=$user OR `assign_leads`.`assigned_to`=$user)";
                $CI->db->where($where);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $start=$duration['start'];
            $end=$duration['end'];
            $where="(`invoices`.`created` >= '$start' AND `invoices`.`created` <= '$end')";
            $CI->db->where($where);
        }
        $CI->db->order_by('invoices.created', 'ASC');
        $query = $CI->db->get();
        if ($query->num_rows()) {
            $result = $query->result();
            $lastCreated = "";
            $sp_commission = "";
            $tm_commission = "";
            $arr = array();
            $lastTM="";
            foreach ($result as $row) {
                $invoice_data = json_decode($row->data);
                $created = date('Y-m-d',strtotime($row->created));
                $currTM = $row->assigned_telemarketer;
                $currSP = $row->assigned_to;
                if ($lastCreated == $created) {
                    if($lastTM == $currTM){
                        $tm_commission += $invoice_data->tm_commission;
                    }else{
                        $tm_commission = $invoice_data->tm_commission;
                    }
                    if($lastSP == $currSP){
                        $sp_commission += $invoice_data->sp_commission;
                    }else{
                        $sp_commission = $invoice_data->sp_commission;   
                    }                    
                } else {
                    $sp_commission = $invoice_data->sp_commission;
                    $tm_commission = $invoice_data->tm_commission;
                }
                if($group==2){
                   $arr[$created][$currTM] = $tm_commission;   
                }else if($group==3){
                   $arr[$created][$currSP] = $sp_commission; 
                }else{
                   //$arr[$created] = array($currTM=>$tm_commission,$currSP=>$sp_commission); 
                }
                $lastCreated = $created;
                $lastTM = $currTM;
                $lastSP = $currSP;
                
            }
            $userList="";
            foreach($inputUser as $inputv){
                $userList .="'".get_user_data($inputv)->name."',";
            }
            $userList=rtrim($userList,",");
            $str = "[['Day',".$userList."],";
            $val_tm="";
            foreach($arr as $key=>$val){
                foreach($inputUser as $v){
                    if(array_key_exists ($v , $val )){
                        $val_tm .=$val[$v].",";
                    }else{
                        $val_tm .=0 .",";
                    }
                }
                $val_tm=rtrim($val_tm,",");
                $str .= "['" . date('d-M', strtotime($key))."'," .$val_tm."],";
                $val_tm=" ";
            }
            $str=rtrim($str,',');
                
            $str .= "]";
            return $str;
        }
        return "[['Day', 'Sales Person', 'Tele Marketer'],[0,0,0]]";
    }
}
//-----------------------------------------------Company Performance-----------------------------
if (!function_exists('_companyPerformance')) {
    function _companyPerformance($user = null, $duration = null) {
        $companyList=_companyList();
        if($companyList){
        $companyStr="";
        foreach($companyList as $company){
            $companyStr .="'".$company."',";
        }
        $companyStr=rtrim($companyStr,",");
        $str = "[['Day',".$companyStr."],";
        
        $CI = &get_instance();
        $CI->db->select('invoices.*');
        $CI->db->from('invoices');
        //$CI->db->join('leads', 'leads.id=invoices.lead_id', '');
        //$CI->db->join('company', 'company.id=leads.company_name', 'left');
        if (is_array($user)) {
            $user=implode(",",$user);
            //$where_in="(`leads`.`assigned_telemarketer` IN($user) OR `assign_leads`.`assigned_to` IN($user))";
            //$CI->db->where($where_in);
        } else if ($user) {
                //$where="(`leads`.`assigned_telemarketer`=$user OR `assign_leads`.`assigned_to`=$user)";
                //$CI->db->where($where);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $start=$duration['start'];
            $end=$duration['end'];
            $where="(`invoices`.`created` >= '$start' AND `invoices`.`created` <= '$end')";
            $CI->db->where($where);
        }
        $CI->db->order_by('invoices.created', 'ASC');
        $query = $CI->db->get();
        //echo $CI->db->last_query();
        if ($query->num_rows()) {
            $grand_total="";
            $lastCreated = "";
            $lastCompany="";
            $arr = array();
            $result = $query->result();
            foreach ($result as $row) {
                $invoice_data = json_decode($row->data);
                $created = date('Y-m-d',strtotime($row->created));
                $companyId=$invoice_data->company;
                $total=$invoice_data->received+$invoice_data->balance;
                if ($lastCreated == $created) {
                    if($lastCompany == $companyId){
                        $grand_total += $total;   
                    }else{
                        $grand_total = $total;
                    }
                } else {
                    $grand_total = $total;
                }
                $arr[$created][$companyId] = $grand_total;  
                $lastCreated = $created;
                $lastCompany = $companyId;
            }
            //_pr($arr);
            foreach($arr as $key=>$val){
                $val_cmp="";
                foreach($companyList as $k=>$v){
                    if(array_key_exists ($k , $val )){
                        $val_cmp .=$val[$k].",";
                    }else{
                        $val_cmp .=0 .",";
                    }
                }
                $val_cmp=rtrim($val_cmp,",");
                $str .= "['" . date('d-M', strtotime($key))."'," .$val_cmp."],";
            }
            $str=rtrim($str,',');
                
            $str .= "]";
            return $str;
            
        }
        }
        return "[['Day', 'No Company Found!'],[0,0]]";;
    }
    
//---------------------------------------------------------------------------------------------
    function _companyData($company=null){
        //$companyList=_companyList();
        $companyName=fieldByCondition("company",array("id"=>$company),"company")->company;
        $companyStr="";
        $companyStr ="'".$companyName."'";
        $str = "[['Day',".$companyStr."],";
        
        $CI = &get_instance();
        $CI->db->select('invoices.*');
        $CI->db->from('invoices');
        //$CI->db->join('leads', 'leads.id=invoices.lead_id', '');
        //$CI->db->join('company', 'company.id=leads.company_name', 'left');
        if (is_array($user)) {
            $user=implode(",",$user);
            //$where_in="(`leads`.`assigned_telemarketer` IN($user) OR `assign_leads`.`assigned_to` IN($user))";
            //$CI->db->where($where_in);
        } else if ($user) {
                //$where="(`leads`.`assigned_telemarketer`=$user OR `assign_leads`.`assigned_to`=$user)";
                //$CI->db->where($where);
            }
        if ($duration) {
            $duration = _rangeToDate($duration);
            $start=$duration['start'];
            $end=$duration['end'];
            $where="(`invoices`.`created` >= '$start' AND `invoices`.`created` <= '$end')";
            $CI->db->where($where);
        }
        if($company){
           $CI->db->like('data','"company":"'.$company.'"');   
        }
        $CI->db->order_by('invoices.created', 'ASC');
        $query = $CI->db->get();
        //echo $CI->db->last_query();
        if ($query->num_rows()) {
            $grand_total="";
            $lastCreated = "";
            $lastCompany="";
            $arr = array();
            $result = $query->result();
            foreach ($result as $row) {
                $invoice_data = json_decode($row->data);
                $created = date('Y-m-d',strtotime($row->created));
                $companyId=$invoice_data->company;
                $total=$invoice_data->received+$invoice_data->balance;
                if ($lastCreated == $created) {
                    if($lastCompany == $companyId){
                        $grand_total += $total;   
                    }else{
                        $grand_total = $total;
                    }
                } else {
                    $grand_total = $total;
                }
                $arr[$created][$companyId] = $grand_total;  
                $lastCreated = $created;
                $lastCompany = $companyId;
            }
            //_pr($arr);
            foreach($arr as $key=>$val){
                $val_cmp="";
                /*foreach($companyList as $k=>$v){
                    if(array_key_exists ($k , $val )){
                        $val_cmp .=$val[$k].",";
                    }else{
                        $val_cmp .=0 .",";
                    }
                    
                }*/
                if($val[$company]){
                    $val_cmp =$val[$company];    
                }else{
                    $val_cmp=0;
                }
                $val_cmp =$val[$company];
                //$val_cmp=rtrim($val_cmp,",");
                $str .= "['" . date('d-M', strtotime($key))."'," .$val_cmp."],";
            }
            $str=rtrim($str,',');
                
            $str .= "]";
            return $str;
            
        }
        return "[['Day', $companyStr],[0,0]]";
    }    
}

//----------------------------------------------------------------------
/**
 * @function _getCompanyReport
 * @purpose List company data
 * @created 25 Mar 2015
 */
if (!function_exists('_getCompanyReport')) { 
    function _getCompanyReport(){
		$CI = &get_instance();
	}
}

//----------------------------------------------------------------------
/**
 * @function _activeLeadsReport
 * @purpose List lead data
 * @created 13 Mar 2015
 */
if (!function_exists('_activeLeadOppReport')) { 
    function _activeLeadOppReport($status = null,$user = null, $duration = null){
            $CI = &get_instance();
            if($user){
                $assigndLeads = _assignToData($user);   
            }
            $lead_array = getAssignLead();
            $invoicedleads = _getInvoicedLeads();
            $CI = &get_instance();
			
			if($status == 'lead'){
				$CI->db->select('leads.id,display_id,company_name,lead_type,added_by,assigned_telemarketer,leads.created');
				$CI->db->from('leads');
			}else if($status == 'working'){
				$CI->db->select('leads.id,display_id,company_name,lead_type,added_by,assigned_telemarketer,leads.created,assign_leads.assigned_to,users.first_name AS ASSIGN_TO_FIRST_NAME,users.last_name AS ASSIGN_TO_LAST_NAME');
				$CI->db->join('assign_leads','assign_leads.lead_id=leads.id');
				$CI->db->join('users','users.id=assign_leads.assigned_to');
				$CI->db->from('leads');
			}else{
				$CI->db->select('leads.id,display_id,company_name,lead_type,added_by,assigned_telemarketer,leads.created,assign_leads.assigned_to,users.first_name AS ASSIGN_TO_FIRST_NAME,users.last_name AS ASSIGN_TO_LAST_NAME');
				$CI->db->join('assign_leads','assign_leads.lead_id=leads.id');
				$CI->db->join('users','users.id=assign_leads.assigned_to');
				$CI->db->from('leads');
			}
            if ($status == 'lead') {
                $CI->db->where("lead_status", '0');
            } elseif ($status == 'archieved_lead') {
                $CI->db->where("lead_status", '1');
            } elseif ($status == 'unassigned') {
                if ($lead_array) {
                    $CI->db->where_not_in("leads.id", $lead_array);
                }
                $CI->db->where('lead_status', '2');
            } else
                if ($status == 'working') {
                    if ($lead_array) {
                        $CI->db->where_in("leads.id", $lead_array);
                    } else {
                        $CI->db->where("leads.id", '');
                    }
                    $CI->db->where('lead_status', '2');
                } else
                    if ($status == 'won') {
                        if ($invoicedleads) {
                            $CI->db->where('lead_status', '3');
                            $CI->db->where_not_in('leads.id', $invoicedleads);
                        } else {
                            $CI->db->where('lead_status', '3'); //set result null
                        }
                    } else
                        if ($status == 'archieved') {
                            if ($invoicedleads) {
                                $CI->db->where('lead_status', '3');
                                $CI->db->where_in('leads.id', $invoicedleads);
                            } else {
                                $CI->db->where('leads.id', '0'); //set result null
                            }
                        } else
                            if ($status == 'lost') {
                                $CI->db->where('lead_status', '4');
                            }
            if (isset($assigndLeads) && !empty($assigndLeads)) {
                foreach ($assigndLeads as $k => $v) {
                    $arr[] = $v->lead_id;
                }
                $assignLeadStr = implode(',', $arr);
            }                
            if (is_array($user)) {                
                if(isset($assignLeadStr)){
                    $user=implode(',',$user);
                    $CI->db->where("(added_by IN ($user) OR leads.id IN ($assignLeadStr))");   
                }else{
                    $CI->db->where_in('added_by', $user);
                }
            } else if ($user) {
                    if(isset($assignLeadStr)){
                        $CI->db->where("(added_by=$user OR leads.id IN ($assignLeadStr))");   
                    }else{
                        $CI->db->where('added_by', $user);
                    }
                }
            if ($duration) {
                $duration = _rangeToDate($duration);
                $CI->db->where('`leads.modified` >=', $duration['start']);
                $CI->db->where('`leads.modified` <=', $duration['end']);
            }
            $CI->db->limit(10);
            $CI->db->order_by('leads.modified','desc');
            $query = $CI->db->get();
			//echo $CI->db->last_query();die;
            if($query->num_rows()){
                $result=$query->result();
                return json_encode($result);
            }
            return false;
    }
}





//----------------------------------------------------------------------
/**
 * @function _activeLeadsReport
 * @purpose List lead data
 * @created 13 Mar 2015
 */
if (!function_exists('_activeLeadOppReportByCompany')) { 
    function _activeLeadOppReportByCompany($status = null,$company_name){
            $CI = &get_instance();
            $lead_array = getAssignLead();
            $CI = &get_instance();
            $CI->db->select('id,display_id,company_name,lead_type,added_by,assigned_telemarketer,created');
            $CI->db->from('leads');
			$CI->db->where("company_name", $company_name);
            if ($status == 'lead') {
                $CI->db->where("lead_status", '0');
            }else if ($status == 'working') {
                if ($lead_array) {
                    $CI->db->where_in("id", $lead_array);
                } else {
                    $CI->db->where("id", '');
                }
                $CI->db->where('lead_status', '2');
            }                 
            $CI->db->order_by('modified','desc');
            $query = $CI->db->get();
            if($query->num_rows()){
                $result=$query->result();
                return json_encode($result);
            }
            return false;
    }
}

if (!function_exists('_activeOppReportTask')) { 
    function _activeOppReportTask($lead_id=null){
		$CI = &get_instance();
		$CI->db->select('lead_id,task_name,duration,reminder');
		$CI->db->from('tasks');
		$CI->db->where('lead_id',$lead_id);
		$query = $CI->db->get();
		if($query->num_rows()>0){			
			return $query->result();
		} else {
			return false;
		}
	}
}

if (!function_exists('_activeLeadSalesReport')) { 
    function _activeLeadSalesReport($status = null,$user = null, $duration = null,$from,$to){
            $CI = &get_instance();
            if($user){
                $assigndLeads = _assignToData($user);   
            }
            $lead_array = getAssignLead();
            $invoicedleads = _getInvoicedLeads();
            $CI = &get_instance();
            $CI->db->select('id,display_id,company_name,lead_type,added_by,assigned_telemarketer,created');
            $CI->db->from('leads');
			$CI->db->where('created >=', $from);
            $CI->db->where('created <=', $to);
            if ($status == 'lead') {
                $CI->db->where("lead_status", '0');
            } elseif ($status == 'archieved_lead') {
                $CI->db->where("lead_status", '1');
            } elseif ($status == 'unassigned') {
                if ($lead_array) {
                    $CI->db->where_not_in("id", $lead_array);
                }
                $CI->db->where('lead_status', '2');
            } else
                if ($status == 'working') {
                    if ($lead_array) {
                        $CI->db->where_in("id", $lead_array);
                    } else {
                        $CI->db->where("id", '');
                    }
                    $CI->db->where('lead_status', '2');
                } else
                    if ($status == 'won') {
                        if ($invoicedleads) {
                            $CI->db->where('lead_status', '3');
                            $CI->db->where_not_in('id', $invoicedleads);
                        } else {
                            $CI->db->where('lead_status', '3'); //set result null
                        }
                    } else
                        if ($status == 'archieved') {
                            if ($invoicedleads) {
                                $CI->db->where('lead_status', '3');
                                $CI->db->where_in('id', $invoicedleads);
                            } else {
                                $CI->db->where('id', '0'); //set result null
                            }
                        } else
                            if ($status == 'lost') {
                                $CI->db->where('lead_status', '4');
                            }
            if (isset($assigndLeads) && !empty($assigndLeads)) {
                foreach ($assigndLeads as $k => $v) {
                    $arr[] = $v->lead_id;
                }
                $assignLeadStr = implode(',', $arr);
            }                
            if (is_array($user)) {                
                if(isset($assignLeadStr)){
                    $user=implode(',',$user);
                    $CI->db->where("(added_by IN ($user) OR id IN ($assignLeadStr))");   
                }else{
                    $CI->db->where_in('added_by', $user);
                }
            } else if ($user) {
                    if(isset($assignLeadStr)){
                        $CI->db->where("(added_by=$user OR id IN ($assignLeadStr))");   
                    }else{
                        $CI->db->where('added_by', $user);
                    }
                }
            if ($duration) {
                $duration = _rangeToDate($duration);
                $CI->db->where('`modified` >=', $duration['start']);
                $CI->db->where('`modified` <=', $duration['end']);
            }
            $CI->db->order_by('modified','desc');
            $query = $CI->db->get();
            if($query->num_rows()){
                $result=$query->result();
                return $result;
            }
            return false;
    }
    
    function latest_company(){
        $CI=&get_instance();
        $CI->db->select('id');
        $CI->db->from('company');
        if(_isTaleMarketer() || _isSalesPerson()){
            $CI->db->where('added_by',_userId());
        }
        $CI->db->limit(1);
        $CI->db->order_by('modified','desc');
        $query=$CI->db->get();
        if($query->num_rows()){
            return $query->row()->id;
        }
        return 0;
    }
}
