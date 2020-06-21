<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
 
class Setting_mod extends CI_Model {
    var $user_table = "users";
	var $user_sub_setting= "user_submission_setting";
	var $user_int_setting= "user_interview_setting";
	var $user_send_mail_setting = "user_send_mail_setting";
	var $per_page = "per_page";

    /**
	 * Constructor
	 */     
    function __construct()
    {
        parent::__construct();
    }    

	function list_items($offset=0,$perpage=20,$searh_keyword=null){
		$user=currentuserinfo();
		$site_id=$user->site_id;
		$this->db->select("SQL_CALC_FOUND_ROWS $this->user_table .*",FALSE);
		$this->db->where("site_id","$site_id");
        
		if($searh_keyword != null)
        {
            $this->db->like("concat(lower(first_name),lower(last_name),lower(email))",$searh_keyword);
        }
		$this->db->limit($perpage,$offset);
		$this->db->order_by("first_name");

		$queryData=$this->db->get($this->user_table);
		//echo $this->db->last_query();exit;
		$data["result"]=array();
		if($queryData->num_rows >0){
			$data["result"] = $queryData->result();
		}
		$query = $this->db->query('SELECT FOUND_ROWS() AS `count`');
        $data["total"] = $query->row()->count;
		return $data;
	}

	function get($id=null,$type="1"){
		$table=$this->user_sub_setting;
		if($type==1){
			$table=$this->user_sub_setting;
		}else if($type==2){
			$table=$this->user_int_setting;
		}else if($type==3){
			$table=$this->user_send_mail_setting;
		}

		$this->db->where("user_id",$id);
		$resultData=$this->db->get($table);
		
		if($resultData->num_rows > 0){
			return $resultData->row();
		}
	}
    
	function updateSubmission(){
		$this->form_validation->set_rules('submission', "Submission Target", 'trim|required|numeric');
		$this->form_validation->set_rules('sub_duration', "Target Period", "trim|required");
		$this->form_validation->set_rules('sub_achievement', "Min. Achievement", "trim|required|numeric");
		$this->form_validation->set_rules('sub_achieve_duration', "Achievement Period", "trim|required");
		
        $return["error"]=false;
		$return["response"]=false;
		if ($this->form_validation->run() == FALSE)
        {
			$return["error"]=validation_errors();
			$return["response"]=false;
			return $return;
        }

		$user_id=$this->input->post("user_id",true);
		
		$submission=$this->input->post("submission",true);
		$min_achievement=$this->input->post("sub_achievement",true);
		$mail_deliever=$this->input->post("sub_mail_deliever",true);
		$duration=$this->input->post("sub_duration",true);
		$sub_achieve_duration=$this->input->post("sub_achieve_duration",true);
		

		if($min_achievement >100){
			$return["error"]="Min achievement must be less than or eqaul to 100%.";
			$return["response"]=false;
			return $return;
		}

		if($user_id==''){
			$return["error"]="Invalid Request";
			$return["response"]=false;
			return $return;
		}
		$userinfo=currentuserinfo();
		$data=array(
			'site_id'=>$userinfo->site_id,
			'last_ip'=>$userinfo->last_ip,
			'added_by'=>$userinfo->added_by,
			'user_id'=>$user_id,
			'submission'=>$submission,
			'sub_duration'=>$duration,
			'sub_achievement'=>$min_achievement,
			'sub_achieve_duration'=>$sub_achieve_duration,
			'sub_mail_deliever'=>$mail_deliever,
			
		);

		$check=$this->db->get_where($this->user_sub_setting,array("user_id"=>$user_id));
		if($check->num_rows > 0){
			$this->db->where("$this->user_sub_setting.user_id",$user_id);
			$r = $this->db->update($this->user_sub_setting,$data);
			$return["response"]="2";
		}else{
			$r = $this->db->insert($this->user_sub_setting,$data);
			$return["response"]="1";
		}
		return $return;
    }

	function updateInterviews(){
		$this->form_validation->set_rules('interview', "Interview Target", 'trim|required|numeric');
		$this->form_validation->set_rules('int_duration', "Target Period", "trim|required");
		$this->form_validation->set_rules('int_achievement', "Min. Achievement", "trim|required|numeric");		
		$this->form_validation->set_rules('int_achieve_duration', "Achievement Period", "trim|required");

		$return["error"]=false;
		$return["response"]=false;
		if ($this->form_validation->run() == FALSE)
        {
			$return["error"]=validation_errors();
			$return["response"]=false;
			return $return;
        }

		$user_id=$this->input->post("user_id",true);
		
		$interview=$this->input->post("interview",true);
		$min_achievement=$this->input->post("int_achievement",true);
		$mail_deliever=$this->input->post("int_mail_deliever",true);
		$duration=$this->input->post("int_duration",true);
		$int_achieve_duration=$this->input->post("int_achieve_duration",true);

		if($user_id==''){
			$return["error"]="Invalid Request";
			$return["response"]=false;
			return $return;
		}

		if($min_achievement >100){
			$return["error"]="Min achievement must be less than or eqaul to 100%.";
			$return["response"]=false;
			return $return;
		}

		$userinfo=currentuserinfo();
		$data=array(
			'site_id'=>$userinfo->site_id,
			'last_ip'=>$userinfo->last_ip,
			'added_by'=>$userinfo->added_by,
			'user_id'=>$user_id,
			'interview'=>$interview,			
			'int_duration'=>$duration,
			'int_achievement'=>$min_achievement,
			'int_achieve_duration'=>$int_achieve_duration,
			'int_mail_deliever'=>$mail_deliever,
			
		);

		$check=$this->db->get_where($this->user_int_setting,array("user_id"=>$user_id));
		if($check->num_rows > 0){
			$this->db->where("$this->user_int_setting.user_id",$user_id);
			$r = $this->db->update($this->user_int_setting,$data);
			$return["response"]="2";
		}else{
			$r = $this->db->insert($this->user_int_setting,$data);
			$return["response"]="1";
		}
		return $return;
    }

	function updateSendMail(){		
		$this->form_validation->set_rules('send_mail_max_limit', "Max Limit", 'trim|required|numeric');
		$this->form_validation->set_rules('send_mail_target', "Send Mail Target", "trim|required|numeric");
		$this->form_validation->set_rules('send_mail_duration', "Target Period", "trim|required");
		$this->form_validation->set_rules('send_mail_achievement', "Min Achievement", "trim|required|numeric");
		$this->form_validation->set_rules('send_mail_achieve_duration', "Achievement Period", "trim|required");
        		
		$return["error"]=false;
		$return["response"]=false;
		if ($this->form_validation->run() == FALSE)
        {
			$return["error"]=validation_errors();
			$return["response"]=false;
			return $return;
        }
		$user_id=$this->input->post("user_id",true);
		
		$max_limit=$this->input->post("send_mail_max_limit",true);
		$send_mail_target=$this->input->post("send_mail_target",true);
		$send_mail_duration=$this->input->post("send_mail_duration",true);

		$send_mail_achievement=$this->input->post("send_mail_achievement",true);
		$send_mail_achieve_duration=$this->input->post("send_mail_achieve_duration",true);

		$send_mail_deliever=$this->input->post("send_mail_deliever",true);

		if($send_mail_achievement >100){
			$return["error"]="Min achievement must be less than or eqaul to 100%.";
			$return["response"]=false;
			return $return;
		}

		if($send_mail_target > $max_limit){
			$return["error"]="Target must be less than or eqaul to max limit.";
			$return["response"]=false;
			return $return;
		}

		if($user_id==''){
			$return["error"]="Invalid Request";
			$return["response"]=false;
			return $return;
		}
		$userinfo=currentuserinfo();
		$data=array(
			'site_id'=>$userinfo->site_id,
			'last_ip'=>$userinfo->last_ip,
			'added_by'=>$userinfo->added_by,
			'user_id'=>$user_id,
			'send_mail_max_limit'=>$max_limit,
			'send_mail_target'=>$send_mail_target,
			'send_mail_duration'=>$send_mail_duration,
			'send_mail_achievement'=>$send_mail_achievement,
			'send_mail_achieve_duration'=>$send_mail_achieve_duration,
			'send_mail_deliever'=>$send_mail_deliever
		);

		$check=$this->db->get_where($this->user_send_mail_setting,array("user_id"=>$user_id));
		if($check->num_rows > 0){
			$this->db->where("$this->user_send_mail_setting.user_id",$user_id);
			$r = $this->db->update($this->user_send_mail_setting,$data);
			$return["response"]="2";
		}else{
			$r = $this->db->insert($this->user_send_mail_setting,$data);
			$return["response"]="1";
		}
		return $return;
    }

}