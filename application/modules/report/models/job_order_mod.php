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

class Job_order_mod extends CI_Model {

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

    public $candidate_table = "candidate";
    public $job_order_activity = "job_order_activity";
    public $job_order_history = "job_order_history";

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
        $report_type = $this->input->post('report_type');
        $user_id = $this->input->post('user_type');

        $startDate = $this->input->post('start_date');
        $endDate = $this->input->post('end_date');
        $company_id = $this->input->post('company');
        $site_id = currentuserinfo()->site_id;
		$user_list = set_child_users_new($user_id);
        $user_list = ($report_type == 1) && ($user_id != null) ? array($user_id) : (!empty($user_list) ? $user_list :
            array(currentuserinfo()->site_id));

        $start_date = $startDate != null ? date('Y-m-d', strtotime($startDate)) : date('Y-m-d');

        $end_date = $endDate != null ? date('Y-m-d', strtotime($endDate)) : date('Y-m-d');


        $active_jobs = get_active_jobs($start_date, $end_date);


        ///////////////////fetch added jobs between particular dates //////////////////////////////
        $result1 = $active_jobs;
        $date_arr = array();


        for ($i = strtotime($start_date); $i <= strtotime($end_date); $i += 86400) {
            $date_arr[] = date("Y-m-d", $i);
        }

        foreach ($date_arr as $k => $v) {
            foreach ($active_jobs as $p) {
                foreach ($p as $kk => $vv) {
                    if (!in_array($kk, $user_list)) {
                        unset($result1[$v][$kk]);
                    }
                }
            }
        }

        $job_ids = array();
        foreach ($result1 as $k => $v) {
            foreach ($v as $kk => $vv) {
                foreach ($vv as $vvv) {
                    $job_ids[] = $vvv;
                }
            }
        }
        ////////////////////////////////////////////////////////////////////////////////////////


        ///////////////////fetch assigned job between particular dates //////////////////////////////
        $this->db->select("job_order_id,assign_user_id,date(modified_time) as date_field");
        $this->db->where_in("assign_user_id", $user_list);
        !empty($start_date) ? $this->db->where("date(modified_time) >=", $start_date) : '';
        !empty($end_date) ? $this->db->where("date(modified_time) <=", $end_date) : '';
        $query = $this->db->get("job_order_assign_list");

        $result2 = $query->result();
		//echo $this->db->last_query(); die;
		//pr($result2); die;
        foreach ($result2 as $k => $v) { ////////foreach to remove inactive jobs from fetched result2
            foreach ($active_jobs as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (!in_array($v->job_order_id, $temp_arr)) {
                        unset($result2[$k]);
                    }
                }
            }
        }
		
        /** foreach ($result2 as $k => $v) { ////////remove job duplicay between result 1 and result 2
         * foreach ($result1 as $x => $y) {
         * if ($x == $v->date_field) {
         * $temp_arr = array();
         * foreach ($y as $p => $q) {
         * foreach ($q as $t) {
         * $temp_arr[] = $t;
         * }
         * }
         * if (in_array($v->job_order_id, $temp_arr)) {
         * unset($result2[$k]);
         * }
         * }
         * }
         * }
         **/
        $result_arr = array();
        foreach ($result2 as $k => $v) { ////////remove job duplicay between result 1 and result 2
            foreach ($result1 as $x => $y) {
                if ($x == $v->date_field) {
                    $temp_arr = array();
                    foreach ($y as $p => $q) {
                        foreach ($q as $t) {
                            $temp_arr[] = $t;
                        }
                    }
                    if (in_array($v->job_order_id, $temp_arr)) {
                        unset($result2[$k]);
                    } else {
                        $result_arr[] = $v->job_order_id;
                    }
                }
            }
        }
        $result_arr = array_unique($result_arr);
        unset($active_jobs);
        unset($result1);

        foreach ($result2 as $key => $v) { //////////to get all job ids
            $job_ids[] = $v->job_order_id;
        }
        unset($result2);
        $job_ids = array_merge($result_arr,$job_ids);
		//pr($job_ids); die;
        /*$this->db->select("SQL_CALC_FOUND_ROWS $this->table.id, $this->users.first_name,$this->users.last_name,$this->table.title,$this->table.reactive,$this->table.openings,
        $this->table.company_id as company_id,$this->company_table.name as company, $this->company_contact.name as contact,$this->table.activity_time as modified_time", false);

        $this->db->join($this->users, "$this->users.id=$this->table.added_by", 'left');
        $this->db->join($this->company_table, "$this->company_table.id=$this->table.company_id", 'left');
        $this->db->join($this->company_contact, "$this->company_contact.id=$this->table.contact_id", 'left');
        if (empty($job_ids)) {
            !empty($start_date) ? $this->db->where("date($this->table.modified_time) >=", $start_date) : '';
            !empty($end_date) ? $this->db->where("date($this->table.modified_time) <=", $end_date) : '';
        }
        if (isset($company_id) && !empty($company_id) && $company_id != null) {
            $this->db->where("$this->table.company_id",$company_id);
        }
        !empty($job_ids) ? $this->db->where_in("$this->table.id", $job_ids) : $this->db->where_in("$this->table.id",
            '');
		$this->db->order_by('modified_time', 'Desc');  //added by sumit on 21-11-2018==//
        $this->db->limit($per_page, $offset);
        $query = $this->db->get($this->table);*/
		
		$this->db->select("SQL_CALC_FOUND_ROWS $this->table.id, $this->users.first_name,$this->users.last_name,$this->table.title,$this->table.reactive,$this->table.openings,
        $this->table.company_id as company_id,$this->company_table.name as company, $this->company_contact.name as contact,job_order_assign_list.modified_time as modified_time,job_order_assign_list.assign_user_id,job_order_assign_list.id as jobsid", false);
		
		$this->db->join($this->table, "$this->table.id=job_order_assign_list.job_order_id", 'left');
		$this->db->join($this->users, "$this->users.id=$this->table.added_by", 'left');
        $this->db->join($this->company_table, "$this->company_table.id=$this->table.company_id", 'left');
        $this->db->join($this->company_contact, "$this->company_contact.id=$this->table.contact_id", 'left');
		
		if (isset($company_id) && !empty($company_id) && $company_id != null) {
            $this->db->where("$this->table.company_id",$company_id);
        }
        !empty($job_ids) ? $this->db->where_in("job_order_assign_list.job_order_id", $job_ids) : $this->db->where_in("job_order_assign_list.id",
            '');
		!empty($start_date) ? $this->db->where("date(job_order_assign_list.modified_time) >=", $start_date) : '';
        !empty($end_date) ? $this->db->where("date(job_order_assign_list.modified_time) <=", $end_date) : '';
		$this->db->where("job_order_assign_list.assigned",'1');
		
		$this->db->where_in("job_order_assign_list.assign_user_id", $user_list);
		$this->db->order_by('job_order_assign_list.modified_time', 'Asc');  //added by sumit on 21-11-2018==//
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('job_order_assign_list');
		//echo $this->db->last_query(); die; 
		
		/*$this->db->select("SQL_CALC_FOUND_ROWS $this->table.id, $this->table.title,$this->table.reactive,$this->table.openings,
        $this->table.company_id as company_id,job_order_assign_list.modified_time as modified_time,job_order_assign_list.assign_user_id,job_order_assign_list.id as jobsid", false);
		$this->db->join($this->table, "$this->table.id=job_order_assign_list.job_order_id", 'left');
		$this->db->where_in("job_order_assign_list.assign_user_id", $user_list);
		!empty($start_date) ? $this->db->where("date(job_order_assign_list.modified_time) >=", $start_date) : '';
        !empty($end_date) ? $this->db->where("date(job_order_assign_list.modified_time) <=", $end_date) : '';
		$this->db->where("job_order_assign_list.assigned",'1');
		$this->db->order_by('job_order_assign_list.job_order_id', 'Asc');  //added by sumit on 21-11-2018==//
        $this->db->limit($per_page, $offset);
        $query = $this->db->get('job_order_assign_list');
		echo $this->db->last_query(); die;*/
		
        $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        $result = $query->result();
		
		//pr($result); die;
        if (!empty($result)) {
            foreach ($result as $k => $v) {
                $result[$k]->recruiter = get_recruiter($v->id);
            }
        }

        $data['result'] = $result;

        $data["total"] = $count_total->row()->count;
        $data["page"] = $page;
		//pr($data); die;
        return $data;
    }
	
    function ajax_list_old($page = 1, $per_page = null) {

        $offset = ($page - 1) * $per_page;
        if ($page == 1) {
            $offset = 0;
        }
        $report_type = $this->input->post('report_type');
        $user_id = $this->input->post('user_type');

        $startDate = $this->input->post('start_date');
        $endDate = $this->input->post('end_date');
        $from = date('Y-m-d', strtotime($startDate));
        $to = date('Y-m-d', strtotime($endDate));
        $whr = null;
        $elsewhr = null;
        $elsejoin = null;
        $result=null;
        $total=null;

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

        $elsejoin .= " LEFT JOIN $this->company_table ct ON ct.id=jo.company_id";
        $elsejoin .= " LEFT JOIN $this->company_contact cc ON cc.id=jo.contact_id";
        $elsejoin .= " LEFT JOIN $this->job_order_activity joa ON jo.id=joa.job_order_id";
        $elsejoin .= " LEFT JOIN $this->users u ON u.id=jo.added_by";
        $select = "u.first_name,u.last_name,jo.title,jo.title,jo.openings,ct.name as company, jo.company_id as company_id,cc.name as contact";


        //////////////////this first mysql query returns result for sales department////////////////////
        $sql = "select job_order_id,p.date_fields as date_field from (select k.* from (SELECT job_order_id,job_order_history.id,job_order_history.status,date(job_order_history.`created_time`) as date_fields FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE $list $whr AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k group by k. job_order_id,k.date_fields) as p where p.status!='3' group by date_field";
        $sql = "
        select SQL_CALC_FOUND_ROWS p.* from (select k.job_order_id as id,k.created_time as modified_time,k.status,k.date_field,u.first_name,u.last_name,jo.title,jo.openings,ct.name as company, jo.company_id as company_id,cc.name as contact from (SELECT job_order_id,job_order_history.created_time,job_order_history.status,date(job_order_history.created_time) as date_field
         FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE
          $list $whr AND job_order_history.`site_id` = '$site_id' order by job_order_history.id desc ) as k
          
          LEFT JOIN $this->table jo ON  jo.id=k.job_order_id $elsejoin
           group by k. job_order_id,k.date_field) as p where p.status!='3' limit $offset,$per_page
        ";
        $query = $this->db->query($sql);
       // echo $this->db->last_query();die;

        $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');

        if ($query->num_rows() > 0) {

            $total = $count_total->row()->count;
            $result = $query->result();
        } else {
           
                
                //////////////////this first mysql query returns result for recruitment  department if first query returns null////////////////////
                $join1 = "select p.job_order_id,p.date_field from (select k.* from (SELECT job_order_id,job_order_history.status,date(job_order_history.created_time) as date_field FROM (`job_order_history`) join job_order on job_order.id=job_order_history.job_order_id WHERE job_order_history.`site_id` = '$site_id' $whr order by job_order_history.id desc ) as k group by k. job_order_id,k.date_field) as p where p.status!='3'";

                /*$sql1 = "
            SELECT SQL_CALC_FOUND_ROWS job_order_assign_list.job_order_id as id,date(job_order_assign_list.modified_time) as modified_time,$select FROM (`job_order_assign_list`) join
            ($join1) lj on

              lj.job_order_id=job_order_assign_list.job_order_id LEFT JOIN $this->table jo ON  jo.id=job_order_assign_list.job_order_id $elsejoin WHERE $elselist
              $elsewhr AND job_order_assign_list.`site_id` = '$site_id' group by job_order_assign_list.job_order_id
            ";*/
            //==Add By sumit On 27 may 2016===//
            $sql1 = "
            SELECT SQL_CALC_FOUND_ROWS job_order_assign_list.job_order_id as id,job_order_assign_list.assign_user_id,date(job_order_assign_list.modified_time) as modified_time,$select FROM (`job_order_assign_list`) join
            ($join1) lj on

              lj.job_order_id=job_order_assign_list.job_order_id LEFT JOIN $this->table jo ON  jo.id=job_order_assign_list.job_order_id $elsejoin WHERE $elselist
              $elsewhr AND job_order_assign_list.`site_id` = '$site_id' group by job_order_assign_list.job_order_id
            ";
            //===Add By sumit On 27 may 2016===//
                $query1 = $this->db->query($sql1);
                //echo $this->db->last_query();exit;
                 $count_total = $this->db->query('SELECT FOUND_ROWS() AS `count`');
               $total = $count_total->row()->count;
                $result = $query1->result();

        }
         
        $data['result'] = $result;

        $data["total"] = $total;
        $data["page"] = $page;
        return $data;
    }

    function default_job_order_report_list($page = 0) {

        $report_type = 2;
        $user_id = currentuserinfo()->id;

        if (($report_type == 1) && ($user_id != null)) {
            $this->db->where('job_order_activity.added_by', $user_id);
            //$this->db->or_where('job_order.added_by',$user_id);
        } else
            if (($report_type == 2) && ($user_id != null)) {
                $child = json_decode($this->session->userdata("child_list"));
                //$this->db->where_in('job_order.added_by',$child);
                $this->db->where_in('job_order_activity.added_by', $child);
            }

        $this->db->select("SQL_CALC_FOUND_ROWS $this->table.id", false);
        $this->db->select("$this->users.first_name,$this->users.last_name,$this->table.title,$this->table.openings,$this->table.modified_time");

        $this->db->select("companies.name as company, companies.id as company_id");
        $this->db->select("companies_contact.name as contact");

        $this->db->from("$this->table");

        $this->db->join("$this->company_table", "$this->company_table.id = $this->table.company_id", "LEFT");
        $this->db->join("$this->company_contact", "$this->company_contact.id = $this->table.contact_id",
            "LEFT");
        $this->db->join("$this->job_order_activity", "$this->table.id = $this->job_order_activity.job_order_id",
            "LEFT");

        $this->db->join("$this->users", "$this->users.id = $this->table.added_by");

        $this->db->group_by("$this->table.id");

        $this->db->order_by("$this->table.id DESC");
        $this->db->limit(20);
        $query = $this->db->get();


        $data['result'] = $query->result();


        /*
        $tester = $query->result_array();
        $data['column']=0;
        
        if($query->num_rows > 0){
        for($i=1;$i<=1;$i++){
        $data['column'] = $tester[$i];
        }
        }
        */

        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
        $data["page"] = $page;

        return $data;
    }


    function ajax_list_export($page = 0) {
    
        $report_type = $this->input->get("report_type");
        $start_date = $this->input->get("start_date");
        $end_date = $this->input->get("end_date");
        $user_id = $this->input->get("user_type");
        
        if(empty($user_id))
        {
            $user_id = currentuserinfo()->id;    
        }        

        if (($report_type == 1) && ($user_id != null)) {
            $this->db->where("$this->job_order_activity.added_by", $user_id);
            //$this->db->or_where("$this->job_order.added_by",$user_id);
        } else
            if (($report_type == 2) && ($user_id != null)) {
                //$child = json_decode($this->session->userdata("child_list"));
                $child = child_users($user_id)['total_list'];

                //$this->db->where_in('job_order.added_by',$list);
                $this->db->where_in('job_order_activity.added_by', $child);
            }

        $this->db->select("SQL_CALC_FOUND_ROWS $this->table.id", false);
        $this->db->select("$this->users.first_name,$this->users.last_name,$this->table.title,$this->table.openings,$this->table.modified_time");

        $this->db->select("companies.name as company, companies.id as company_id");
        $this->db->select("companies_contact.name as contact");

        $this->db->from("$this->table");


        $this->db->join("$this->company_table", "$this->company_table.id = $this->table.company_id", "LEFT");
        $this->db->join("$this->company_contact", "$this->company_contact.id = $this->table.contact_id",
            "LEFT");
        $this->db->join("$this->job_order_activity", "$this->table.id = $this->job_order_activity.job_order_id",
            "LEFT");
        $this->db->join("$this->users", "$this->users.id = $this->table.added_by", "$this->users.id = $this->job_order_assign_table.assign_user_id",
            "LEFT");
            
        (!empty($start_date)) ? $this->db->where("$this->table.modified_time >=",date("Y-m-d",strtotime($start_date))) : '';
        if(!empty($end_date))
        {
            $this->db->where("$this->table.modified_time <=",date("Y-m-d",strtotime($end_date))); 
        }
        else
        {
            $this->db->where("$this->table.modified_time <=",date("Y-m-d", time()));
        }
         
        
        

        $this->db->group_by("$this->table.id");

        $this->db->order_by("$this->table.id DESC");
        //$this->db->limit(20);
        $query = $this->db->get();
     //   echo $this->db->last_query();die;

        $data['result'] = $query->result_array();

        $query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
        $data["page"] = $page;
        return $data;
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
