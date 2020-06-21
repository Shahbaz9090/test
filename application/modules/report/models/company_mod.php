<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * Cats Account Model 
 * @package		Rookie
 * @subpackage	Models
 * @category	Joborder 
 * @author		Ajit Rajput
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */

class Company_mod extends CI_Model {

    public $table = "job_order";
    public $groups = "user_groups";
    public $users = "users";
    public $company_table = "companies";
    public $company_contact = "companies_contact";
    public $type_table = "job_order_type";
    public $job_order_assign_table = "job_order_assign_list";
    public $job_order_type = "job_order_type";
    public $country = "countries";
    public $state = "regions";
    public $job_status = "job_status";
    public $job_status_view = "job_status_view";
    public $per_page = "per_page";
    public $job_order_activity = "job_order_activity";
    public $candidate_table = "candidate";


    /**
     * Constructor
     */
    function __construct() {
        parent::__construct();
    }

    function ajax_list($page = 1, $per_page = null) {

        $offset = ($page - 1) * $per_page;
        if ($page == 1) {
            $offset = 0;
        }
        $report_type = ($this->input->post('report_type')) ? $this->input->post('report_type') : 1;
        $user_id = ($this->input->post('user_type')) ? $this->input->post('user_type') : currentuserinfo()->id;

        $startDate = $this->input->post('start_date');
        $endDate = $this->input->post('end_date');
        $from = date('Y-m-d', strtotime($startDate));
        $to = date('Y-m-d', strtotime($endDate));
        $whr = null;
        $elsewhr = null;
        $elsejoin = null;
        $result = null;
        $total = null;
        $check_company = null;
        $else_check_company = null;

        $site_id = currentuserinfo()->site_id;

        if (($report_type == 1) && ($user_id != null)) {

            $list = "job_order.added_by IN ($user_id)  ";
            $elselist = "job_order_assign_list.`assign_user_id` IN ($user_id)  ";

        } else
            if (($report_type == 2) && ($user_id != '')) {
                $child_list = child_users($user_id);
                $child = $child_list['total_list'];
                $user_list = implode(",", $child);
                $list = "job_order.added_by IN ($user_list)  ";
                $elselist = "job_order_assign_list.`assign_user_id` IN ($user_list)  ";

            }


        if ($startDate != null) {
            $whr .= "AND date(job_order_history.created_time) >= '$from'";
            $elsewhr .= "AND date(job_order_assign_list.modified_time) >= '$from'";
        }
        if ($endDate != null) {
            $whr .= "AND date(job_order_history.created_time) <= '$to'";
            $elsewhr .= "AND date(job_order_assign_list.modified_time) <= '$to'";
        }
        $company_id = null;
        $contact_id = null;
        $company_id = $this->input->post("company");
        $contact_id = $this->input->post("contact");

        if ($company_id != null && $contact_id != null) {
            $check_company .= "WHERE jo.company_id='$company_id' AND  cc.id='$contact_id'";
            $else_check_company .= "AND jo.company_id='$company_id' AND  cc.id='$contact_id'";
        } else {
            if ($company_id != null) {
                $check_company .= "WHERE jo.company_id='$company_id'";
                $else_check_company .= "AND jo.company_id='$company_id'";
            }
            if ($contact_id != null) {
                $check_company .= "WHERE cc.id='$contact_id'";
                $else_check_company .= "AND cc.id='$contact_id'";
            }

        }

        $elsejoin .= " LEFT JOIN $this->company_table ct ON ct.id=jo.company_id";
        $elsejoin .= " LEFT JOIN $this->company_contact cc ON cc.id=jo.contact_id";
        $elsejoin .= " LEFT JOIN $this->job_order_activity joa ON jo.id=joa.job_order_id";
        $elsejoin .= " LEFT JOIN $this->users u ON u.id=jo.added_by";
        $select = "u.first_name,u.last_name,jo.title,jo.title,jo.openings,ct.name as company, jo.company_id as company_id,cc.name as contact";


        ////////this first query will check entry for sales department////////////
        $sql = "select job_order_id,p.date_fields as date_field from (select k.* from (SELECT job_order_id,job_order_history.id,job_order_history.status,date(job_order_history.`created_time`) as date_fields FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $list $whr AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id,k.date_fields) as p where p.status!='3' group by date_field";
        $sql = "
        select SQL_CALC_FOUND_ROWS p.* from (select k.job_order_id as job_id,k.created_time as modified_time,k.status,k.date_field,u.first_name,u.last_name,jo.title,jo.openings,ct.name as company, jo.company_id as company_id,cc.name as contact from (SELECT job_order_id,job_order_history.created_time,job_order_history.status,date(job_order_history.created_time) as date_field
         FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE
          $list $whr AND job_order_history.`site_id` = '$site_id'  order by job_order_history.id desc ) as k
          
          LEFT JOIN $this->table jo ON  jo.id=k.job_order_id $elsejoin $check_company
           group by k. job_order_id,k.date_field) as p where p.status!='3' limit $offset,$per_page
        ";
        $query = $this->db->query($sql);

        $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        if ($query->num_rows() > 0) {

            $total = $count_total->row()->count;
            $result = $query->result();
        } else {
            
                ////////////////////this query will checks the result for recuitement department if 1st query result is null///////////////

                $join1 = "select p.job_order_id,p.date_field from (select k.* from (SELECT job_order_id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k. job_order_id,k.date_field) as p where p.status!='3'";

                $sql1 = "
            SELECT SQL_CALC_FOUND_ROWS job_order_assign_list.job_order_id as job_id,date(job_order_assign_list.modified_time) as modified_time,$select FROM (`job_order_assign_list`) join
            ($join1) lj on

              lj.job_order_id=job_order_assign_list.job_order_id LEFT JOIN $this->table jo ON  jo.id=job_order_assign_list.job_order_id $elsejoin WHERE $elselist
              $elsewhr AND job_order_assign_list.`site_id` = '$site_id' $else_check_company group by job_order_assign_list.job_order_id
            ";

                $query1 = $this->db->query($sql1);
                // echo $this->db->last_query();exit;
                $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
                $total = $count_total->row()->count;
                $result = $query1->result();

        }

        $data['result'] = $result;

        $data["total"] = $total;
        $data["page"] = $page;
        return $data;
    }


    function default_company_report_list($page = 1) {
        $per_page = 20;
        $offset = 0;

        $report_type = 1;

        $user_id = currentuserinfo()->id;
        if (($report_type == 1) && ($user_id != null)) {
            // $this->db->where('job_order.added_by',$user_id);
            $this->db->where_in('job_order_activity.added_by', $user_id);
        }


        $this->db->select("SQL_CALC_FOUND_ROWS DISTINCT $this->table.id as job_id", false);
        $this->db->select("$this->company_table.name,$this->company_table.id as company_id,$this->users.first_name,$this->users.last_name,$this->table.modified_time,$this->company_contact.name as contact");
        $this->db->from("$this->table");

        $this->db->join("$this->company_table", "$this->company_table.id = $this->table.company_id", "LEFT");
        $this->db->join("$this->company_contact", "$this->company_contact.id = $this->table.contact_id",
            "LEFT");
        $this->db->join("$this->job_order_activity", "$this->table.id = $this->job_order_activity.job_order_id",
            "LEFT");
        $this->db->join("$this->users", "$this->users.id = $this->table.added_by", "$this->users.id = $this->job_order_assign_table.assign_user_id",
            "LEFT");

        $this->db->group_by("$this->table.id");
        filter_job_order_data($this->table);

        $this->db->order_by("$this->table.modified_time", "DESC");
        filter_job_order_data($this->job_order_activity);

        $this->db->limit($per_page, $offset);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;

        $data['result'] = $query->result();
        $tester = $query->result_array();

        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
        $data["page"] = $page;
        return $data;
    }

    function ajax_list_export_old($page = 0) {
        $report_type = $this->input->get_post('report_type');
        $user_id = $this->input->get_post('user_type');
		if(empty($user_id))
        {
            $user_id = currentuserinfo()->id;    
        }
		$smt_list=explode(',',$user_id);
        if (($report_type == 1) && ($user_id != null)) {
            $this->db->where('job_order_activity.added_by', $user_id);
        } else
            if (($report_type == 2) && ($user_id != '')) {
                $list = child_users($user_id)['total_list'];
                $this->db->where_in('job_order_activity.added_by', $list);
				$smt_list=$list;
            }

        $startDate = $this->input->get_post('start_date');
        if ($startDate != '') {
            $from = date('Y-m-d', strtotime($startDate));
            $this->db->where("job_order.modified_time >=", $from);
        }
        $endDate = $this->input->get_post('end_date');
        if ($endDate != '') {
            $to = date('Y-m-d', strtotime($endDate));
            $this->db->where("job_order.modified_time <= '$to' ");
        }
        $company_id = $this->input->get_post("company");

        if ($company_id != null) {
            $this->db->where("$this->table.company_id", $company_id);
        }


        $this->db->select("DISTINCT($this->table.id) as job_id,$this->company_table.name,$this->users.first_name,$this->users.last_name,$this->table.modified_time");
        $this->db->from("$this->table");

        $this->db->join("$this->company_table", "$this->company_table.id = $this->table.company_id", "LEFT");
        $this->db->join("$this->company_contact", "$this->company_contact.id = $this->table.contact_id",
            "LEFT");
        $this->db->join("$this->job_order_activity", "$this->table.id = $this->job_order_activity.job_order_id",
            "LEFT");
        $this->db->join("$this->users", "$this->users.id = $this->table.added_by", "$this->users.id = $this->job_order_assign_table.assign_user_id",
            "LEFT");

        $this->db->group_by("$this->table.id");
		//pr($smt_list); die;
        //filter_job_order_data($this->table,$smt_list);

        $this->db->order_by("$this->table.modified_time", "DESC"); //

        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        $data['result'] = $query->result_array();
        $tester = $query->result_array();


        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
        $data["page"] = $page;
		pr($data); die;
        return $data;
    }
	
	function ajax_list_export($page = 1) {
		
		$per_page=10000;
		$offset = ($page - 1) * $per_page;
        if ($page == 1) {
            $offset = 0;
        }
        $report_type = ($this->input->get_post('report_type')) ? $this->input->get_post('report_type') : 1;
        $user_id = ($this->input->get_post('user_type')) ? $this->input->get_post('user_type') : currentuserinfo()->id;

        $startDate = $this->input->get_post('start_date');
        $endDate = $this->input->get_post('end_date');
        $from = date('Y-m-d', strtotime($startDate));
        $to = date('Y-m-d', strtotime($endDate));
        $whr = null;
        $elsewhr = null;
        $elsejoin = null;
        $result = null;
        $total = null;
        $check_company = null;
        $else_check_company = null;

        $site_id = currentuserinfo()->site_id;

        if (($report_type == 1) && ($user_id != null)) {

            $list = "job_order.added_by IN ($user_id)  ";
            $elselist = "job_order_assign_list.`assign_user_id` IN ($user_id)  ";

        } else
            if (($report_type == 2) && ($user_id != '')) {
                $child_list = child_users($user_id);
                $child = $child_list['total_list'];
                $user_list = implode(",", $child);
                $list = "job_order.added_by IN ($user_list)  ";
                $elselist = "job_order_assign_list.`assign_user_id` IN ($user_list)  ";

            }


        if ($startDate != null) {
            $whr .= "AND date(job_order_history.created_time) >= '$from'";
            $elsewhr .= "AND date(job_order_assign_list.modified_time) >= '$from'";
        }
        if ($endDate != null) {
            $whr .= "AND date(job_order_history.created_time) <= '$to'";
            $elsewhr .= "AND date(job_order_assign_list.modified_time) <= '$to'";
        }
        $company_id = null;
        $contact_id = null;
        $company_id = $this->input->get_post("company");
        $contact_id = $this->input->get_post("contact");

        if ($company_id != null && $contact_id != null) {
            $check_company .= "WHERE jo.company_id='$company_id' AND  cc.id='$contact_id'";
            $else_check_company .= "AND jo.company_id='$company_id' AND  cc.id='$contact_id'";
        } else {
            if ($company_id != null) {
                $check_company .= "WHERE jo.company_id='$company_id'";
                $else_check_company .= "AND jo.company_id='$company_id'";
            }
            if ($contact_id != null) {
                $check_company .= "WHERE cc.id='$contact_id'";
                $else_check_company .= "AND cc.id='$contact_id'";
            }

        }

        $elsejoin .= " LEFT JOIN $this->company_table ct ON ct.id=jo.company_id";
        $elsejoin .= " LEFT JOIN $this->company_contact cc ON cc.id=jo.contact_id";
        $elsejoin .= " LEFT JOIN $this->job_order_activity joa ON jo.id=joa.job_order_id";
        $elsejoin .= " LEFT JOIN $this->users u ON u.id=jo.added_by";
        $select = "u.first_name,u.last_name,jo.title,jo.title,jo.openings,ct.name as company, jo.company_id as company_id,cc.name as contact";


        ////////this first query will check entry for sales department////////////
        $sql = "select job_order_id,p.date_fields as date_field from (select k.* from (SELECT job_order_id,job_order_history.id,job_order_history.status,date(job_order_history.`created_time`) as date_fields FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $list $whr AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id,k.date_fields) as p where p.status!='3' group by date_field";
        $sql = "
        select SQL_CALC_FOUND_ROWS p.* from (select k.job_order_id as job_id,k.created_time as modified_time,k.status,k.date_field,u.first_name,u.last_name,jo.title,jo.openings,ct.name as company, jo.company_id as company_id,cc.name as contact from (SELECT job_order_id,job_order_history.created_time,job_order_history.status,date(job_order_history.created_time) as date_field
         FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE
          $list $whr AND job_order_history.`site_id` = '$site_id'  order by job_order_history.id desc ) as k
          
          LEFT JOIN $this->table jo ON  jo.id=k.job_order_id $elsejoin $check_company
           group by k. job_order_id,k.date_field) as p where p.status!='3' limit $offset,$per_page
        ";
        $query = $this->db->query($sql);

        $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        if ($query->num_rows() > 0) {

            $total = $count_total->row()->count;
            $result = $query->result();
        } else {
            
                ////////////////////this query will checks the result for recuitement department if 1st query result is null///////////////

                $join1 = "select p.job_order_id,p.date_field from (select k.* from (SELECT job_order_id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k. job_order_id,k.date_field) as p where p.status!='3'";

                $sql1 = "
            SELECT SQL_CALC_FOUND_ROWS job_order_assign_list.job_order_id as job_id,date(job_order_assign_list.modified_time) as modified_time,$select FROM (`job_order_assign_list`) join
            ($join1) lj on

              lj.job_order_id=job_order_assign_list.job_order_id LEFT JOIN $this->table jo ON  jo.id=job_order_assign_list.job_order_id $elsejoin WHERE $elselist
              $elsewhr AND job_order_assign_list.`site_id` = '$site_id' $else_check_company group by job_order_assign_list.job_order_id
            ";

                $query1 = $this->db->query($sql1);
                 //echo $this->db->last_query();exit;
                $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
                $total = $count_total->row()->count;
                $result = $query1->result_array();

        }
		
        $data['result'] = $result;
		//pr($data); die;
        $data["total"] = $total;
        $data["page"] = $page;
		//pr($data); die;
        return $data;
    }

    function getCompany($userId = null) {
        if ($userId == null) {
            $child = json_decode($this->session->userdata("child_list"));
        } else {
            if ($userId == currentuserinfo()->id)
                $child = json_decode($this->session->userdata("child_list"));
            else
                $child = child_users($userId)['total_list'];
        }

        $this->db->distinct();
        $this->db->select("name");
        $this->db->select("company_id");
        $this->db->where_in("job_order.added_by", $child);
        $this->db->join("companies", "job_order.company_id = companies.id", "LEFT");
        $this->db->from("job_order");
        filter_data("job_order");
        $query = $this->db->get();
        return $query->result();
    }

    function getContact($company_id = null) {


        $this->db->where("$this->company_contact.company_id", $company_id);

        $this->db->order_by("name");
        $this->db->from("$this->company_contact");
        filter_data($this->company_contact);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;

        return $query->result();
    }


    public function get_activity_list($job_order_id = null, $company_id = null) {

        $this->db->select("$this->job_order_activity .* ");
        $this->db->select("CONCAT($this->users.first_name,' ',$this->users.last_name) as user_name", false);
        $this->db->select("$this->candidate_table.first_name as first_name,$this->candidate_table.id as candidate_id,$this->candidate_table.last_name as last_name,$this->candidate_table.city as city", false);

        $this->db->where(array("$this->job_order_activity.job_order_id" => "$job_order_id"));

        $this->db->from($this->job_order_activity);

        $this->db->join($this->users, "$this->users.id = $this->job_order_activity.added_by");
        $this->db->join($this->candidate_table, "$this->candidate_table.id = $this->job_order_activity.candidate_id");

        $query = $this->db->get();


        return $query->result();
    }


}
