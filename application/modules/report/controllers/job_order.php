<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter Company Controller
 *
 * @package		E-rookie
 * @subpackage	Controllers
 * @category	Job Order 
 * @author		Ajit Rajput
 * @website		http://www.tekshapers.com
 * @company     Tekshapers Inc
 * @since		Version 1.0
 */
 
class Job_order extends MY_Controller {   
    private $data = array();
    private $export_limit = NULL;
    private $delete_limit = NULL;
    /**
	 * Constructor
	 */ 
     
    function __construct()
    {
        parent::__construct();
        isProtected();
        $this->load->model('job_order_mod');
		$this->load->model('job_order/pipeline_mod');		
        $this->lang->load('job_order', get_site_language());	
               
        $this->data['head']['title']        = "Job Order";
        $this->data['readonly']             = NULL;
        $this->data['base_url']             = base_url("report/job_order");
        $this->export_limit                 = $this->config->item('export_limit');
        $this->delete_limit                 = $this->config->item('delete_limit');
        $this->table_name                   = "job_order";
		//$this->output->enable_profiler(TRUE); 
		
        

    }    
    

	function get_report(){
		$this->data['base_url']=base_url('report/job_order/report_view');		
		$this->data['main_content']="job_order_form";
		$result=$this->job_order_mod->default_job_order_report_list(1);
		
		$this->data['result']=$result['result'];
		$total_result=$result['total'];
		
		//pagination
        
        $this->load->library('pagination');
        $config["base_url"] = SITE_PATH . "/report/job_order/data_list";
        $config["per_page"] =  30;
        $config["uri_segment"] = 4;
        
        
        $config["total_rows"] = $result['total'];
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['page_offset'] = 1;
        $this->data['limit'] = 30;
        $this->data['total'] = $result['total'];
        
		$this->data['submodule'] = 'Job Order Report';

      	$this->load->view('page',$this->data);

	}

	function data_list($page=null, $perpage=null){ 
	   $fields=explode(',',$this->input->post('fields'));
         
        $list_type = $this->input->post('list_type');
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        
        $user_id=$this->input->post('user_type');
    	
		//$child_list=json_decode($this->session->userdata("child_list"));
        if(empty($user_id))
        {
        $list = child_users(currentuserinfo()->id);
        }
        else
        {
            $list = child_users($user_id);
        }
        $childList=$list['total_list'];
        $child_arr=array();
         foreach($childList as $k => $v) {
            array_push($child_arr, $v);
        }
        $child_list = implode(",",$child_arr);
		
        $data['user_list'] = $child_list;
        $data['user_id'] = $user_id;
        
        $data['report_type'] = $this->input->post('report_type');
		$data['user_type'] = $this->input->post('user_type');
        $data['fields'] = $fields;
       
		if($list_type == 1)
        {
            $result=$this->job_order_mod->ajax_list($page,$perpage);	
		
    		$data['base_url']=base_url('report/job_order/report_view');	
    		$data['result']=$result['result'];
    		
    		$total_result=$result['total'];
    		$data['page']=$result['page'];
    		
    	    //pagination
            
            $this->load->library('pagination');
            $config["base_url"] = SITE_PATH . "/report/job_order/data_list";
            $config["per_page"] = isset($perpage) ? $perpage : 30;
            $config["uri_segment"] = 4;
            $offset=$page; 
            
            if ($offset != null)
            {
                $limit = $perpage * ($offset - 1);
            }
    
            if ($offset == null)
            {
                $offset = 0;
            }
            
            $config["total_rows"] = $result['total'];
            $this->pagination->initialize($config);
            $data["links"] = $this->pagination->create_links();
            $data['page_offset'] = $offset;
            $data['limit'] = isset($perpage) ? $perpage : 30;
            $data['total'] = $result['total'];
            
            
            $data['search_attr'] = $this->input->post('fields');
            
            $data["last_in_pipeline"]=$this->input->post('getLoadedPipeline');
            $data["last_in_service"] = $this->input->post('getLoadedService');
            $data["last_in_submittal"]=$this->input->post('getLoadedSubmittal');
            $data["last_in_join"]=$this->input->post('getLoadedJoin');
            $data["last_in_screen_reject"]=$this->input->post('getLoadedScReject');
            $data["last_in_interview"]=$this->input->post('getLoadedInterview');
            $data["last_in_interview_reject"]=$this->input->post('getLoadedInterviewReject');
            $data["last_in_no_contact"]=$this->input->post('getLoadedNoContact');
            $data["last_in_offered"]=$this->input->post('getLoadedOffered');
            $data["last_in_offered_decline"]=$this->input->post('getLoadedOfferedDecline');
            $data["last_in_sales_reject"]=$this->input->post('getLoadedSalesReject');
             
             $data["last_in_service_last"] = $this->input->post('getLoadedServiceLast');
            $data["last_in_pipeline_last"]=$this->input->post('getLoadedPipelineLast');
            $data["last_in_submittal_last"]=$this->input->post('getLoadedSubmittalLast');
            $data["last_in_join_last"]=$this->input->post('getLoadedJoinLast');
            $data["last_in_screen_reject_last"]=$this->input->post('getLoadedScRejectLast');
            $data["last_in_interview_last"]=$this->input->post('getLoadedInterviewLast');
            $data["last_in_interview_reject_last"]=$this->input->post('getLoadedInterviewRejectLast');
            $data["last_in_no_contact_last"]=$this->input->post('getLoadedNoContactLast');
            $data["last_in_offered_last"]=$this->input->post('getLoadedOfferedLast');
            $data["last_in_offered_decline_last"]=$this->input->post('getLoadedOfferedDeclineLast');
            $data["last_in_sales_reject_last"]=$this->input->post('getLoadedSalesRejectLast');
            
            $prev_page = @$this->input->post('prev_page');
            if($prev_page)
            {
                $data["prev_page"]=$prev_page;
            }
            
            $data['total_limit'] = $perpage * ($offset);
            
            $data['max_view_total'] = @$this->input->post('max_view_total');
            
        }
        //pr($data); die;
        if($list_type == 1)
		$this->load->view('job_order_listing',$data);
        else
        $this->load->view('total_job_order_listing',$data);
        
		
	}
	
   

   function report_export(){
       $data = $this->job_order_mod->ajax_list_export();
       $start_date = $this->input->get("start_date");
       $end_date = $this->input->get("end_date");
       $start_date = (!empty($start_date)) ? date("Y-m-d",strtotime($start_date)) : date("Y-m-d");
       $end_date = (!empty($end_date)) ? date("Y-m-d",strtotime($end_date)) : date("Y-m-d");
       
       foreach($data['result'] as $key=>$value){
             $data['result'][$key]['recruiter']=get_recruiter($value['id']);
             $data['result'][$key]['Serviced Job']=get_final_joborder_seriviced_job($value['id'],$start_date,$end_date);
             $data['result'][$key]['pipeline']=get_final_joborder_pipeline($value['id'],$start_date,$end_date);
             $data['result'][$key]['submital']=get_final_joborder_submittal($value['id'],$start_date,$end_date);
             $data['result'][$key]['candidate_join']=get_final_joborder_data('11',$value['id'],$start_date,$end_date);
             $data['result'][$key]['screen_reject']=get_final_joborder_data('10',$value['id'],$start_date,$end_date);
             $data['result'][$key]['interview']=get_final_joborder_data('6',$value['id'],$start_date,$end_date);
             $data['result'][$key]['interview_reject']=get_final_joborder_data('3',$value['id'],$start_date,$end_date);
             $data['result'][$key]['no_contact']=get_final_joborder_data('1',$value['id'],$start_date,$end_date);
             $data['result'][$key]['offered']=get_final_joborder_data('7',$value['id'],$start_date,$end_date);
             $data['result'][$key]['offer_decline']=get_final_joborder_data('9',$value['id'],$start_date,$end_date);
             $data['result'][$key]['sales_reject']=get_final_joborder_data('2',$value['id'],$start_date,$end_date);
        
       }
       $headers=array('Job Order ID','First Name','Last Name','Job Title','Openings','Modified Time','Comapany Name','Company ID','Contact Person','Recruiter Name','Serviced Job','Pipe Line','Submittal','Candidate Join','Screen Reject','Interview','Interview Reject','No contact','Offered','Offer Decline','Sales Reject');
       array_to_csv($data['result'],"job_order_report.csv",$headers);
    }

	function report_view($jobId=null,$companyId=null){	
		$this->load->helper("text");
	   $result=$this->job_order_mod->get_activity_list($jobId,$companyId);
	   $this->data['result']=$result;

	   $views[] = "job_order_activity_listing";
       view_load($views,$this->data);
	}
      //-------------------------Function for pipeline and submittal----------------------------------------------------------
    
    function view($jobId = null, $companyId = null, $status = 0) {
        $this->load->helper("text");
        $result = $this->job_order_mod->get_activity_list($jobId, $companyId);
        
        $this->data['result'] = $result;
        
        //pr($result);exit;
        $this->data['status'] = $status;
        $this->data['job_order_id'] = $jobId;
        $views[] = "pipeline_activity_listing";
        view_load($views, $this->data);
    }
	
}
