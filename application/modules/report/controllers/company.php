<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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

class Company extends MY_Controller
{
    private $data = array();
    private $export_limit = null;
    private $delete_limit = null;

    /**
     * Constructor
     */

    function __construct()
    {
        parent::__construct();
        isProtected();
        $this->load->model('company_mod');
        $this->lang->load('report', get_site_language());

        $this->data['head']['title'] = "Company Report";
        $this->data['readonly'] = null;
        $this->data['base_url'] = base_url("report/company");
        $this->export_limit = $this->config->item('export_limit');
        $this->delete_limit = $this->config->item('delete_limit');
        $this->table_name = "job_order";
    }

    function list_items()
    {
        $this->data['base_url'] = base_url('report/company/view');
        $this->data['main_content'] = "company_form";
        $this->data['company'] = $this->company_mod->getCompany();

        $result = $this->company_mod->ajax_list(1,30);

        $this->data['result'] = $result['result'];
        $total_result = $result['total'];

        //pagination

        $this->load->library('pagination');
        $config["base_url"] = SITE_PATH . "/report/company/ajax_list_items";
        $config["per_page"] = isset($perpage) ? $perpage : 30;
        $config["uri_segment"] = 4;


        $config["total_rows"] = $result['total'];
        $this->pagination->initialize($config);
        $this->data["links"] = $this->pagination->create_links();
        $this->data['page_offset'] = 1;
        $this->data['limit'] = 30;
        $this->data['total'] = $result['total'];
        $this->data['submodule'] = 'Company Report';

        $this->load->view('page', $this->data);

    }

    function ajax_list_items($page = null, $perpage = null)
    { //pr($_POST);exit;
    
        $data['start_date'] = $this->input->post('start_date');
        $data['end_date'] = $this->input->post('end_date');
        
        $user_id=$this->input->post('user_type');
    	
		$list = child_users($user_id)['total_list'];		
		
        $data['user_list'] = implode(",",$list);
        
        $data['user_id'] = $user_id;
        
        $data['report_type'] = $this->input->post('report_type');
        $data['company'] = $this->input->post('company');
        $data['contact'] = $this->input->post('contact');
        
        
        $list_type = $this->input->post('list_type');
        
        if($list_type == 1)
        {
            $result = $this->company_mod->ajax_list($page, $perpage);

            $data['base_url'] = base_url('report/company/view');
            $data['result'] = $result['result'];
          
            $total_result = $result['total'];
            $data['page'] = $result['page'];
            
            //pagination
    
            $this->load->library('pagination');
            $config["base_url"] = SITE_PATH . "/report/job_order/ajax_list_items";
            $config["per_page"] = isset($perpage) ? $perpage : 30;
            $config["uri_segment"] = 4;
            $offset = $page;
    
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
         
    
             $data["last_in_service"] = $this->input->post('getLoadedService');
            $data["last_in_pipeline"] = $this->input->post('getLoadedPipeline');
            $data["last_in_submittal"] = $this->input->post('getLoadedSubmittal');
            $data["last_in_join"] = $this->input->post('getLoadedJoin');
            $data["last_in_screen_reject"] = $this->input->post('getLoadedScReject');
            $data["last_in_interview"] = $this->input->post('getLoadedInterview');
            $data["last_in_interview_reject"] = $this->input->post('getLoadedInterviewReject');
            $data["last_in_no_contact"] = $this->input->post('getLoadedNoContact');
            $data["last_in_offered"] = $this->input->post('getLoadedOffered');
            $data["last_in_offered_decline"] = $this->input->post('getLoadedOfferedDecline');
            $data["last_in_sales_reject"] = $this->input->post('getLoadedSalesReject');
    
            $data["last_in_pipeline_last"] = $this->input->post('getLoadedPipelineLast');
             $data["last_in_service_last"] = $this->input->post('getLoadedServiceLast');
            $data["last_in_submittal_last"] = $this->input->post('getLoadedSubmittalLast');
            $data["last_in_join_last"] = $this->input->post('getLoadedJoinLast');
            $data["last_in_screen_reject_last"] = $this->input->post('getLoadedScRejectLast');
            $data["last_in_interview_last"] = $this->input->post('getLoadedInterviewLast');
            $data["last_in_interview_reject_last"] = $this->input->post('getLoadedInterviewRejectLast');
            $data["last_in_no_contact_last"] = $this->input->post('getLoadedNoContactLast');
            $data["last_in_offered_last"] = $this->input->post('getLoadedOfferedLast');
            $data["last_in_offered_decline_last"] = $this->input->post('getLoadedOfferedDeclineLast');
            $data["last_in_sales_reject_last"] = $this->input->post('getLoadedSalesRejectLast');
    
            @$prev_page = $this->input->post('prev_page');
            if ($prev_page)
            {
                $data["prev_page"] = $prev_page;
            }
    
            $data['total_limit'] = $perpage * ($offset);
            
        }
        
        if($list_type == 1)
        $this->load->view('company_listing', $data);
        else
        $this->load->view('total_company_listing', $data);
    }

 

    function export()
    {
        //pr($_REQUEST);die;
        $data = $this->company_mod->ajax_list_export();
        foreach ($data['result'] as $key => $value)
        {
            $data['result'][$key]['pipeline'] = get_final_joborder_pipeline($value['job_id']);
            $data['result'][$key]['submital'] = get_final_joborder_submittal($value['job_id']);

        }
        array_to_csv($data['result'], "company_report.csv");
    }

    function view($jobId = null, $companyId = null)
    {
        $this->load->helper("text");
        $result = $this->company_mod->get_activity_list($jobId, $companyId);
        $this->data['result'] = $result;

        //pr($result);die;

        $views[] = "company_activity_listing";
        view_load($views, $this->data);
    }

    function users_company($userId)
    {
        $result = $this->company_mod->getCompany($userId);
        if ($result)
        {
            $opt = '<option value=""> Select Company</option>';
            foreach ($result as $key => $value)
            {
                $opt .= "<option value='$value->company_id'> $value->name </option>";
            }
        } else
        {
            $opt = "<option value=''> No Company</option>";
        }
        echo $opt;

    }

    function users_contact($company_id)
    {
        $result = $this->company_mod->getContact($company_id);
        if ($result)
        {
            $opt = '<option value=""> Select Coontact</option>';
            foreach ($result as $key => $value)
            {
                $opt .= "<option value='$value->id'> $value->name </option>";
            }
        } else
        {
            $opt = "<option value=''> No Contact</option>";
        }
        echo $opt;
    }

}
