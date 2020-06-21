<?php
  $y = ($year) ? $year : 'Y';
  if($getcount){
		$userId=end($getcount);
  }else{
		$userId=$getUserId1;      
  }
  $user_list = child_users($userId)['total_list'];
  
  $searchUserList=childUsers($userId);
  asort($searchUserList);  	
  $verticalContent=$searchType;
  $search_data = $_POST;
   
  if($searchType=='monthly'){
		$month = new stdClass();
		$month->year  = $search_data['year'];
		$month->month = $search_data['month'];
		if(is_null($month->month) || ($month->month=='')){
			$month->month = date('m');
		}
	
		if($month->month == date('m'))
			$report_date = range(1,date('d'));
		else
			$report_date = range(1,date('t',mktime(0, 0, 0, $month->month, 1,$month->year)));

		$job_array = array(0=>array('monthly','Total Job','Serviced Job','Pipeline','Submittal','Candidate Join','Screen Reject','Sales reject','Interview','Interview Reject','Offered','Offered Declined'));
		
		$service_job_data  = dashboard_total_serviced('monthly',$user_list,$month->year,$month->month);
		$joborder_data     = dashboard_total_jobs('monthly',$user_list,$month->year,$month->month);
		$job_data          = $joborder_data['total'];
		$submittal         = dashboard_submittal('monthly',$user_list,$month->year,$month->month);	
		$jobactivity_data  = dashboard_joborder('monthly',$user_list,$month->year,$month->month);								 
		
		$pipeline           = array();
		$join               = array();
		$screen_reject		= array();
		$sale_reject        = array();
		$interview          = array();
		$interview_reject   = array();
		$offered            = array();
		$offer_decline      = array();

		if(array_key_exists(0,$jobactivity_data))
			$pipeline = $jobactivity_data[0];
		
		if(array_key_exists(2,$jobactivity_data))
			$sale_reject   = $jobactivity_data[2];

		if(array_key_exists(3,$jobactivity_data))
			$interview_reject   = $jobactivity_data[3];

		if(array_key_exists(6,$jobactivity_data))
			$interview   = $jobactivity_data[6];
		
		if(array_key_exists(7,$jobactivity_data))
			$offered   = $jobactivity_data[7];

		if(array_key_exists(9,$jobactivity_data))
			$offer_decline   = $jobactivity_data[9];

		if(array_key_exists(10,$jobactivity_data))
			$screen_reject   = $jobactivity_data[10];
		
		if(array_key_exists(11,$jobactivity_data))
			$join     = $jobactivity_data[11];
		
		$vendor_data  = dashboard_vendor('monthly',$user_list,$month->year,$month->month);
		$active      = array();
		$blacklist   = array();
		$inactive	 = array();
		if(array_key_exists('active',$vendor_data))
			$active = $vendor_data['active'];
		
		if(array_key_exists('inactive',$vendor_data))
			$inactive   = $vendor_data['inactive'];

		if(array_key_exists('blacklist',$vendor_data))
			$blacklist   = $vendor_data['blacklist'];

		$vendor_array = array(0=>array('monthly','Active','Inactive','Blacklist'));
		foreach($report_date as $key=>$value){									
			$job_array[] = array(
				0=> sprintf("%02s", $value),
				1=> isset($job_data[$value]) ? (int) $job_data[$value]: 0,
                2=> isset($service_job_data[$value]) ? (int) $service_job_data[$value]: 0,
				3=> isset($pipeline[$value]) ? (int) $pipeline[$value]: 0,
				4=> isset($submittal[$value]) ? (int) $submittal[$value]: 0,
				5=> isset($join[$value]) ? (int) $join[$value]: 0,
				6=> isset($screen_reject[$value]) ? (int) $screen_reject[$value]: 0,
				7=> isset($sale_reject[$value]) ? (int) $sale_reject[$value]: 0,
				8=> isset($interview[$value]) ? (int) $interview[$value]: 0,
				9=> isset($interview_reject[$value]) ? (int) $interview_reject[$value]: 0,
				10=> isset($offered[$value]) ? (int) $offered[$value]: 0,
				11=>isset($offer_decline[$value]) ? (int) $offer_decline[$value]: 0
			);
			$vendor_array[] = array(
				0=> sprintf("%02s", $value),
				1=> isset($active[$value]) ? (int) $active[$value]: 0,
				2=> isset($inactive[$value]) ? (int) $inactive[$value]: 0,
				3=> isset($blacklist[$value]) ? (int) $blacklist[$value]: 0											
			);
	   }
	   /* Company Contact Graph data */
	   $company_contact = dashboard_company_contact('monthly',$user_list,$month->year,$month->month);
	   $active_contact = 0;
	   $inactive_contact = 0;
	   $added_contact = 0;
	   foreach($company_contact as $key=>$value){
		   if($value->status == 0)
			   $inactive_contact = (int)$value->total;
		   if($value->status == 1)
			   $active_contact = (int)$value->total;									
	   }
	   $added_contact = $active_contact+$inactive_contact;
	   $contact_arr = array(array('Task','Total'),array('Added',$added_contact),array('Active',$active_contact),array('Inactive',$inactive_contact));
	   
	   /* Candidate Graph data */
	   $candidate = dashboard_candidate('monthly',$user_list,$month->year,$month->month);
	   $refine    = 0;
	   $un_refine = 0;							   
	   foreach($candidate as $key=>$value){
		   if($value->is_refine == 0)
			   $un_refine = (int)$value->total;
		   if($value->is_refine == 1)
			   $refine = (int)$value->total;									
	   }
	   $candidate_array =array(array('task','total'),array('Refine Added',$refine),array('Unrefine Added',$un_refine));
	   
	   /*  Job Order Status Graph*/							   
	   $pipeline_status   = 0;
	   $offered_status    = 0;
	   $submission_status = array_sum($submittal);
	   $pending_status    = (int) dashboard_pending_job_activity('monthly',$user_list,$month->year,$month->month);
	   if(array_key_exists(0,$jobactivity_data)){
		   $pipeline_status = array_sum($jobactivity_data[0]);
	   }
	   if(array_key_exists(7,$jobactivity_data)){
		   $offered_status  = array_sum($jobactivity_data[7]);
	   }
	   $active = isset($joborder_data['active']) ? array_sum($joborder_data['active']) :0;
	   $inactive = isset($joborder_data['inactive']) ? array_sum($joborder_data['inactive']) :0;
	   
	   $job_status_array  = array(array('task','total'),array('Offered',$offered_status),array('pending',$pending_status),array('Active',$active),array('Inactive',$inactive),array('Pipeline',$pipeline_status),array('Submittal',$submission_status));
	
  }else if($searchType=='yearly'){
	    $month = new stdClass();
		$month->year  = $search_data['year'];
		$month->month = $search_data['month'];
		
		if($month->year == date('Y'))
			$report_date = range(1,date('m'));
		else
			$report_date = range(1,date('m',mktime(0, 0, 0, 0, 1,$month->year)));
		
		$job_array = array(0=>array('yearly','Total Job','Serviced Job','Pipeline','Submittal','Candidate Join','Screen Reject','Sales reject','Interview','Interview Reject','Offered','Offered Declined'));
		
		$service_job_data  = dashboard_total_serviced('yearly',$user_list,$month->year,$month->month);
		$joborder_data     = dashboard_total_jobs('yearly',$user_list,$month->year,$month->month);
		$job_data          = $joborder_data['total'];
		$submittal         = dashboard_submittal('yearly',$user_list,$month->year,$month->month);	
		$jobactivity_data  = dashboard_joborder('yearly',$user_list,$month->year,$month->month);
		 
		
		$pipeline           = array();
		$join               = array();
		$screen_reject		= array();
		$sale_reject        = array();
		$interview          = array();
		$interview_reject   = array();
		$offered            = array();
		$offer_decline      = array();

		if(array_key_exists(0,$jobactivity_data))
			$pipeline = $jobactivity_data[0];
		
		if(array_key_exists(2,$jobactivity_data))
			$sale_reject   = $jobactivity_data[2];

		if(array_key_exists(3,$jobactivity_data))
			$interview_reject   = $jobactivity_data[3];

		if(array_key_exists(6,$jobactivity_data))
			$interview   = $jobactivity_data[6];
		
		if(array_key_exists(7,$jobactivity_data))
			$offered   = $jobactivity_data[7];

		if(array_key_exists(9,$jobactivity_data))
			$offer_decline   = $jobactivity_data[9];

		if(array_key_exists(10,$jobactivity_data))
			$screen_reject   = $jobactivity_data[10];
		
		if(array_key_exists(11,$jobactivity_data))
			$join     = $jobactivity_data[11];								
		

		
		$vendor_data  = dashboard_vendor('yearly',$user_list,$month->year,$month->month);
		$active      = array();
		$blacklist   = array();
		$inactive	 = array();
		if(array_key_exists('active',$vendor_data))
			$active = $vendor_data['active'];
		
		if(array_key_exists('inactive',$vendor_data))
			$inactive   = $vendor_data['inactive'];

		if(array_key_exists('blacklist',$vendor_data))
			$blacklist   = $vendor_data['blacklist'];

		$vendor_array = array(0=>array('yearly','Active','Inactive','Blacklist'));
		foreach($report_date as $key=>$value){									
			$job_array[] = array(
				0=> sprintf("%02s", $value),
				1=> isset($job_data[$value]) ? (int) $job_data[$value]: 0,
                2=> isset($service_job_data[$value]) ? (int) $service_job_data[$value]: 0,
				3=> isset($pipeline[$value]) ? (int) $pipeline[$value]: 0,
				4=> isset($submittal[$value]) ? (int) $submittal[$value]: 0,
				5=> isset($join[$value]) ? (int) $join[$value]: 0,
				6=> isset($screen_reject[$value]) ? (int) $screen_reject[$value]: 0,
				7=> isset($sale_reject[$value]) ? (int) $sale_reject[$value]: 0,
				8=> isset($interview[$value]) ? (int) $interview[$value]: 0,
				9=> isset($interview_reject[$value]) ? (int) $interview_reject[$value]: 0,
				10=> isset($offered[$value]) ? (int) $offered[$value]: 0,
				11=>isset($offer_decline[$value]) ? (int) $offer_decline[$value]: 0
			);
			$vendor_array[] = array(
				0=> sprintf("%02s", $value),
				1=> isset($active[$value]) ? (int) $active[$value]: 0,
				2=> isset($inactive[$value]) ? (int) $inactive[$value]: 0,
				3=> isset($blacklist[$value]) ? (int) $blacklist[$value]: 0											
			);
	   }							   
	   /* Company Contact Graph data */
	   $company_contact = dashboard_company_contact('yearly',$user_list,$month->year,$month->month);
	   $active_contact = 0;
	   $inactive_contact = 0;
	   $added_contact = 0;
	   foreach($company_contact as $key=>$value){
		   if($value->status == 0)
			   $inactive_contact = (int)$value->total;
		   if($value->status == 1)
			   $active_contact = (int)$value->total;									
	   }
	   $added_contact = $active_contact+$inactive_contact;
	   $contact_arr = array(array('Task','Total'),array('Added',$added_contact),array('Active',$active_contact),array('Inactive',$inactive_contact));
	   
	   /* Candidate Graph data */
	   $candidate = dashboard_candidate('yearly',$user_list,$month->year,$month->month);
	   $refine    = 0;
	   $un_refine = 0;							   
	   foreach($candidate as $key=>$value){
		   if($value->is_refine == 0)
			   $un_refine = (int)$value->total;
		   if($value->is_refine == 1)
			   $refine = (int)$value->total;									
	   }
	   $candidate_array =array(array('task','total'),array('Refine Added',$refine),array('Unrefine Added',$un_refine));
	   
	   /*  Job Order Status Graph*/							   
	   $pipeline_status   = 0;
	   $offered_status    = 0;
	   $submission_status = array_sum($submittal);
	   $pending_status    = (int) dashboard_pending_job_activity('yearly',$user_list,$month->year,$month->month);
	   if(array_key_exists(0,$jobactivity_data)){
		   $pipeline_status = array_sum($jobactivity_data[0]);
	   }
	   if(array_key_exists(7,$jobactivity_data)){
		   $offered_status  = array_sum($jobactivity_data[7]);
	   }
	   $active = isset($joborder_data['active']) ? array_sum($joborder_data['active']) :0;
	   $inactive = isset($joborder_data['inactive']) ? array_sum($joborder_data['inactive']) :0;
	   
	   $job_status_array  = array(array('task','total'),array('Offered',$offered_status),array('pending',$pending_status),array('Active',$active),array('Inactive',$inactive),array('Pipeline',$pipeline_status),array('Submittal',$submission_status));
	
  }else if($searchType=='weekly'){

	  
		$start_date = date('Y-m-d',strtotime($search_data['start_date']));
		$end_date = date('Y-m-d',strtotime($search_data['end_date']));

		$date1=date_create($start_date);
		$date2=date_create($end_date);
		$diff=date_diff($date1,$date2);
		$total_days =  $diff->format("%a");

		$start        = date('d',strtotime($search_data['start_date']));
		$end          = date('d',strtotime($search_data['end_date']));
		$start_date   = date('Y-m-d',strtotime($search_data['start_date']));
		$end_date     = date('Y-m-d',strtotime($search_data['end_date']));
		
		$report_date = array();

		if(date('m',strtotime($search_data['start_date']))!=date('m',strtotime($search_data['end_date']))){
			$last_date   = date('t',strtotime('-1 month'));
			for($i=$start;$i<=($start+$total_days);$i++){
				if($i <= $last_date){
					$report_date[] = $i;
				}else{
					$report_date[] = abs ($i-$last_date);
				}
			}
		}else{
			$report_date  = range($start,$end);
		}
		$date         = array($start_date,$end_date);

		$job_array = array(0=>array('weekly','Total Job','Serviced Job','Pipeline','Submittal','Candidate Join','Screen Reject','Sales reject','Interview','Interview Reject','Offered','Offered Declined'));
		
        $service_job_data  = dashboard_total_serviced('weekly',$user_list,null,null,null,$date);
		$joborder_data     = dashboard_total_jobs('weekly',$user_list,null,null,null,$date);
		
		$job_data          = $joborder_data['total'];
		$submittal         = dashboard_submittal('weekly',$user_list,null,null,null,$date);
		$jobactivity_data  = dashboard_joborder('weekly',$user_list,null,null,null,$date);
		
		
		$pipeline           = array();
		$join               = array();
		$screen_reject		= array();
		$sale_reject        = array();
		$interview          = array();
		$interview_reject   = array();
		$offered            = array();
		$offer_decline      = array();

		if(array_key_exists(0,$jobactivity_data))
			$pipeline = $jobactivity_data[0];
		
		if(array_key_exists(2,$jobactivity_data))
			$sale_reject   = $jobactivity_data[2];

		if(array_key_exists(3,$jobactivity_data))
			$interview_reject   = $jobactivity_data[3];

		if(array_key_exists(6,$jobactivity_data))
			$interview   = $jobactivity_data[6];
		
		if(array_key_exists(7,$jobactivity_data))
			$offered   = $jobactivity_data[7];

		if(array_key_exists(9,$jobactivity_data))
			$offer_decline   = $jobactivity_data[9];

		if(array_key_exists(10,$jobactivity_data))
			$screen_reject   = $jobactivity_data[10];
		
		if(array_key_exists(11,$jobactivity_data))
			$join     = $jobactivity_data[11];
		
		$vendor_data  = dashboard_vendor('weekly',$user_list,null,null,null,$date);
		$active      = array();
		$blacklist   = array();
		$inactive	 = array();
		if(array_key_exists('active',$vendor_data))
			$active = $vendor_data['active'];
		
		if(array_key_exists('inactive',$vendor_data))
			$inactive   = $vendor_data['inactive'];

		if(array_key_exists('blacklist',$vendor_data))
			$blacklist   = $vendor_data['blacklist'];

		$vendor_array = array(0=>array('weekly','Active','Inactive','Blacklist'));
		
		foreach($report_date as $key=>$value){
			$job_array[] = array(
				0=>  sprintf("%02s", $value),
				1=>  isset($job_data[$value]) ? (int) $job_data[$value]: 0,
                2=>  isset($service_job_data[$value]) ? (int) $service_job_data[$value]: 0,
				3=>  isset($pipeline[$value]) ? (int) $pipeline[$value]: 0,
				4=>  isset($submittal[$value]) ? (int) $submittal[$value]: 0,
				5=>  isset($join[$value]) ? (int) $join[$value]: 0,
				6=>  isset($screen_reject[$value]) ? (int) $screen_reject[$value]: 0,
				7=>  isset($sale_reject[$value]) ? (int) $sale_reject[$value]: 0,
				8=>  isset($interview[$value]) ? (int) $interview[$value]: 0,
				9=>  isset($interview_reject[$value]) ? (int) $interview_reject[$value]: 0,
				10=>  isset($offered[$value]) ? (int) $offered[$value]: 0,
				11=> isset($offer_decline[$value]) ? (int) $offer_decline[$value]: 0
			);
			$vendor_array[] = array(
				0=> sprintf("%02s", $value),
				1=> isset($active[$value]) ? (int) $active[$value]: 0,
				2=> isset($inactive[$value]) ? (int) $inactive[$value]: 0,
				3=> isset($blacklist[$value]) ? (int) $blacklist[$value]: 0											
			);									
		}

		/* Company Contact Graph data */
	   $company_contact = dashboard_company_contact('weekly',$user_list,null,null,null,$date);
	   $active_contact = 0;
	   $inactive_contact = 0;
	   $added_contact = 0;
	   foreach($company_contact as $key=>$value){
		   if($value->status == 0)
			   $inactive_contact = (int)$value->total;
		   if($value->status == 1)
			   $active_contact = (int)$value->total;									
	   }
	   $added_contact = $active_contact+$inactive_contact;
	   $contact_arr = array(array('Task','Total'),array('Added',$added_contact),array('Active',$active_contact),array('Inactive',$inactive_contact));
	   
	   /* Candidate Graph data */
	   $candidate = dashboard_candidate('weekly',$user_list,null,null,null,$date);
	   $refine    = 0;
	   $un_refine = 0;							   
	   foreach($candidate as $key=>$value){
		   if($value->is_refine == 0)
			   $un_refine = (int)$value->total;
		   if($value->is_refine == 1)
			   $refine = (int)$value->total;									
	   }
	   $candidate_array =array(array('task','total'),array('Refine Added',$refine),array('Unrefine Added',$un_refine));
	   
	   /*  Job Order Status Graph*/							   
	   $pipeline_status   = 0;
	   $offered_status    = 0;
	   $submission_status = array_sum($submittal);
	   $pending_status    = (int) dashboard_pending_job_activity('weekly',$user_list,null,null,null,$date);
	   if(array_key_exists(0,$jobactivity_data)){
		   $pipeline_status = array_sum($jobactivity_data[0]);
	   }
	   if(array_key_exists(7,$jobactivity_data)){
		   $offered_status  = array_sum($jobactivity_data[7]);
	   }
	   $active = isset($joborder_data['active']) ? array_sum($joborder_data['active']) :0;
	   $inactive = isset($joborder_data['inactive']) ? array_sum($joborder_data['inactive']) :0;
	   
	   $job_status_array  = array(array('task','total'),array('Offered',$offered_status),array('pending',$pending_status),array('Active',$active),array('Inactive',$inactive),array('Pipeline',$pipeline_status),array('Submittal',$submission_status));
   }else if($searchType=='daily'){
		
		$start_date = date('Y-m-d',strtotime($search_data['min_day']));
		$end_date = date('Y-m-d',strtotime($search_data['max_day']));

		$date1=date_create($start_date);
		$date2=date_create($end_date);
		$diff=date_diff($date1,$date2);
		$total_days =  $diff->format("%a");

		$start        = date('d',strtotime($search_data['min_day']));
		$end          = date('d',strtotime($search_data['max_day']));
		$start_date   = date('Y-m-d',strtotime($search_data['min_day']));
		$end_date     = date('Y-m-d',strtotime($search_data['max_day']));
		
		$report_date = array();

		if(date('m',strtotime($search_data['min_day']))!=date('m',strtotime($search_data['max_day']))){
			$last_date   = date('t',strtotime('-1 month'));
			for($i=$start;$i<=($start+$total_days);$i++){
				if($i <= $last_date){
					$report_date[] = $i;
				}else{
					$report_date[] = abs ($i-$last_date);
				}
			}
		}else{
			$report_date  = range($start,$end);
		}
		$date         = array($start_date,$end_date);

		//pr($date);
		//pr($report_date);
		//die;

		$job_array = array(0=>array('daily','Total Job','Serviced Job','Pipeline','Submittal','Candidate Join','Screen Reject','Sales reject','Interview','Interview Reject','Offered','Offered Declined'));
		
        $service_job_data  = dashboard_total_serviced('daily',$user_list,null,null,null,$date);
		$joborder_data     = dashboard_total_jobs('daily',$user_list,null,null,null,$date);
		
		$job_data          = $joborder_data['total'];
		$submittal         = dashboard_submittal('daily',$user_list,null,null,null,$date);
		$jobactivity_data  = dashboard_joborder('daily',$user_list,null,null,null,$date);
		
		
		$pipeline           = array();
		$join               = array();
		$screen_reject		= array();
		$sale_reject        = array();
		$interview          = array();
		$interview_reject   = array();
		$offered            = array();
		$offer_decline      = array();

		if(array_key_exists(0,$jobactivity_data))
			$pipeline = $jobactivity_data[0];
		
		if(array_key_exists(2,$jobactivity_data))
			$sale_reject   = $jobactivity_data[2];

		if(array_key_exists(3,$jobactivity_data))
			$interview_reject   = $jobactivity_data[3];

		if(array_key_exists(6,$jobactivity_data))
			$interview   = $jobactivity_data[6];
		
		if(array_key_exists(7,$jobactivity_data))
			$offered   = $jobactivity_data[7];

		if(array_key_exists(9,$jobactivity_data))
			$offer_decline   = $jobactivity_data[9];

		if(array_key_exists(10,$jobactivity_data))
			$screen_reject   = $jobactivity_data[10];
		
		if(array_key_exists(11,$jobactivity_data))
			$join     = $jobactivity_data[11];
		
		$vendor_data  = dashboard_vendor('daily',$user_list,null,null,null,$date);
		$active      = array();
		$blacklist   = array();
		$inactive	 = array();
		if(array_key_exists('active',$vendor_data))
			$active = $vendor_data['active'];
		
		if(array_key_exists('inactive',$vendor_data))
			$inactive   = $vendor_data['inactive'];

		if(array_key_exists('blacklist',$vendor_data))
			$blacklist   = $vendor_data['blacklist'];

		$vendor_array = array(0=>array('daily','Active','Inactive','Blacklist'));
		
		foreach($report_date as $key=>$value){
			$job_array[] = array(
				0=>  sprintf("%02s", $value),
				1=>  isset($job_data[$value]) ? (int) $job_data[$value]: 0,
                2=>  isset($service_job_data[$value]) ? (int) $service_job_data[$value]: 0,
				3=>  isset($pipeline[$value]) ? (int) $pipeline[$value]: 0,
				4=>  isset($submittal[$value]) ? (int) $submittal[$value]: 0,
				5=>  isset($join[$value]) ? (int) $join[$value]: 0,
				6=>  isset($screen_reject[$value]) ? (int) $screen_reject[$value]: 0,
				7=>  isset($sale_reject[$value]) ? (int) $sale_reject[$value]: 0,
				8=>  isset($interview[$value]) ? (int) $interview[$value]: 0,
				9=>  isset($interview_reject[$value]) ? (int) $interview_reject[$value]: 0,
				10=>  isset($offered[$value]) ? (int) $offered[$value]: 0,
				11=> isset($offer_decline[$value]) ? (int) $offer_decline[$value]: 0
			);
			$vendor_array[] = array(
				0=> sprintf("%02s", $value),
				1=> isset($active[$value]) ? (int) $active[$value]: 0,
				2=> isset($inactive[$value]) ? (int) $inactive[$value]: 0,
				3=> isset($blacklist[$value]) ? (int) $blacklist[$value]: 0											
			);									
		}

		/* Company Contact Graph data */
	   $company_contact = dashboard_company_contact('daily',$user_list,null,null,null,$date);
	   $active_contact = 0;
	   $inactive_contact = 0;
	   $added_contact = 0;
	   foreach($company_contact as $key=>$value){
		   if($value->status == 0)
			   $inactive_contact = (int)$value->total;
		   if($value->status == 1)
			   $active_contact = (int)$value->total;									
	   }
	   $added_contact = $active_contact+$inactive_contact;
	   $contact_arr = array(array('Task','Total'),array('Added',$added_contact),array('Active',$active_contact),array('Inactive',$inactive_contact));
	   
	   /* Candidate Graph data */
	   $candidate = dashboard_candidate('daily',$user_list,null,null,null,$date);
	   $refine    = 0;
	   $un_refine = 0;							   
	   foreach($candidate as $key=>$value){
		   if($value->is_refine == 0)
			   $un_refine = (int)$value->total;
		   if($value->is_refine == 1)
			   $refine = (int)$value->total;									
	   }
	   $candidate_array =array(array('task','total'),array('Refine Added',$refine),array('Unrefine Added',$un_refine));
	   
	   /*  Job Order Status Graph*/							   
	   $pipeline_status   = 0;
	   $offered_status    = 0;
	   $submission_status = array_sum($submittal);
	   $pending_status    = (int) dashboard_pending_job_activity('daily',$user_list,null,null,null,$date);
	   if(array_key_exists(0,$jobactivity_data)){
		   $pipeline_status = array_sum($jobactivity_data[0]);
	   }
	   if(array_key_exists(7,$jobactivity_data)){
		   $offered_status  = array_sum($jobactivity_data[7]);
	   }
	   $active = isset($joborder_data['active']) ? array_sum($joborder_data['active']) :0;
	   $inactive = isset($joborder_data['inactive']) ? array_sum($joborder_data['inactive']) :0;
	   
	   $job_status_array  = array(array('task','total'),array('Offered',$offered_status),array('pending',$pending_status),array('Active',$active),array('Inactive',$inactive),array('Pipeline',$pipeline_status),array('Submittal',$submission_status));
   }
?>
    
<script type="text/javascript" src="https://www.google.com/jsapi"></script>

  <form name="report" action="<?php echo base_url('dashboard').'/index'?>">
                <div class="title"><h4>Serach By User</h4></div>	
	       
		 <div class="content" style="margin-bottom: 13px;"  style="">
         
         		              
                
            	<div class="form-row row-fluid">
			
                    <div class="span12" id="report_by_users">
                    	   <?php
						   $sel=count($getcount);              
                           if($getcount){                   
                            
                              for($i=0;$i<$sel;$i++){
                                 $j=$i+1;
                                 if($i < ($sel-1)){
                                    $selected =$getcount[$j];
                                 }else{
                                    $selected="";
                                 }
                                 $selectedUser=childUsers($getcount[$i]);
								 asort($selectedUser);
                                 
                                if(($selectedUser!=null)||($sel==1)){
                          ?><div class="span2 del">
                            <select name="users_type" class="nostyle select" id="users_type" onchange="ajaxDashboard('',this.value)" <?php if($i < ($sel-1)){?> <?php }?>>
								<option value="">Select</option>
								<?php									
									foreach($selectedUser as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if($selected==$key){?> selected="selected" <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select></div>
                            
                        <?php 
                                }  
                                $selectedUser=array();
                            }
                        }
							?>	
					   
					</div>
                    
        	</div>
		
			</form>
           	
		</div>
                <!---------------------------------------------------------------------------------------------->
			 
				
	</form>
            
<?php
$atr = array('chart_list');
$chart_list = user_report_type_data($atr);
//pr(explode(',',$chart_list->chart_list));

$chart_report = _chart_report();
$chart_string = "";
$count = 0;
foreach($chart_report as $key=>$value){
    $chart_string .= $key;
    if($count < (count($chart_report)-1)){
        $chart_string .= ',';
    }
    $count++; 
}
$chart_list_array = explode(',',$chart_list->chart_list);
 if(in_array('job_order',$chart_list_array)){
?>           
   <div class="row-fluid">
		<div class="span12" style="margin-left:0px;" id="div1">
			 <script type="text/javascript">
				  $(document ).ready(function(){							  
					var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($job_array));?>);
		
					var options = {
					  title: 'Job Order Performance',
					  hAxis: {title: '<?=ucfirst($verticalContent)." Report"?>', titleTextStyle: {color: 'red'}}
					};
		
					var chart = new google.visualization.ColumnChart(document.getElementById('job_order_div_ajax'));
					chart.draw(data, options);
					
				  });
			  </script>

			<div class="box chart">
				<div class="title">
					<h4>
												<span>Job Order</span>
					</h4>
					<a href="#" class="minimize">Minimize</a>
				</div>
				<div class="content">
				   
					<div id="job_order_div_ajax" style="height: 350px;width:100%;"></div>

				</div>
			</div>                        
		</div>
</div>

<div class="row-fluid">
		<div class="span12" style="margin-left:0px;" id="div1">
			 
			<div class="box chart">
				<div class="title">
					<h4>
						<span>Notification Calender</span>
					</h4>
					<a href="#" class="minimize">Minimize</a>
				</div>
				<div class="content">
				   
					<div id="job_order_div_ajax" style="height: 350px;width:100%;"></div>

				</div>
			</div>                        
		</div>
</div>
 <?php
  }
  ?>
           
	<div class="row-fluid">	
    
    <?php
        //pr($chart_list);exit;
        foreach($chart_list_array as $key=>$value){ 
         
         if($value == 'company'){
    ?>					                        
				<div class="view_bg">
					<script type="text/javascript">
						  $(document ).ready(function(){							  
							var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($contact_arr));?>);
				
							var options = {
							  title: 'Company Performance',
							  hAxis: {title: '<?=ucfirst($verticalContent)." Report"?>', titleTextStyle: {color: 'red'}}
							};
				
							var chart = new google.visualization.PieChart(document.getElementById('company_div_ajax'));
							chart.draw(data, options);
							
						  });
					  </script>
					<div class="box chart">
						<div class="title">
							<h4>
																<span>Company Report</span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<div class="content">
						   <div id="company_div_ajax" style="height: 280px;width:100%;"></div>
						</div>
					</div>                        
				</div>
 <?php 
    }elseif($value == 'candidate'){
  ?>
				<div class="view_bg">
					<script type="text/javascript">
					 $(document ).ready(function(){
						var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($candidate_array));?>);

						var options = {
						  title: 'Candidate Performance'
						};

						var chart = new google.visualization.PieChart(document.getElementById('candidate_div_ajax'));
						chart.draw(data, options);
					  });
					</script>
					<div class="box chart">
						<div class="title">
							<h4>
																<span>Candidate Report</span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<div class="content">
						   <div id="candidate_div_ajax" style="height: 280px;width:100%;"></div>
						</div>

					</div><!-- End .box -->
				
				</div><!-- End .span6 -->
		  <?php }elseif($value == 'vendor'){  ?>                
				<div class="view_bg">						
					
					<script type="text/javascript">
						  $(document ).ready(function(){							  
							var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($vendor_array));?>);
				
							var options = {
							  title: 'Vendors Performance',
							  hAxis: {title: '<?=ucfirst($verticalContent)." Report"?>', titleTextStyle: {color: 'red'}}
							};
				
							var chart = new google.visualization.ColumnChart(document.getElementById('vendor_div_ajax'));
							chart.draw(data, options);
							
						  });
					  </script>
					<div class="box chart">
						<div class="title">
							<h4>
																<span>Vendor Report</span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<div class="content">
						   <div id="vendor_div_ajax" style="height: 280px;width:100%;"></div>
						</div>
						

					</div><!-- End .box -->
				
				</div><!-- End .span6 -->
                <?php
                    }elseif($value=='job_status'){
                ?>
				<div class="view_bg">
					<script type="text/javascript">
					 $(document).ready(function(){
						var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($job_status_array))?>);

						var options = {
						  title: 'Job Status'
						};
						
						var chart = new google.visualization.PieChart(document.getElementById('job_status_div'));
						chart.draw(data, options);
					  
					 });
					</script>

					<div class="box chart">

						<div class="title">

							<h4>
																<span>Job Status Report</span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<div class="content">
						   <div id="job_status_div" style="height:280px;width:100%;"></div>
						</div>
					</div>				
				</div>
              <?php  
              }}
              ?>
			</div><!-- End .row-fluid -->
		<!-- Page end here -->
	</div><!-- End contentwrapper -->
</div><!-- End #content -->
<input type="hidden" name="default_user" id="default_user" value="<?=$total_user_id?>"/>
<!--  End Ajax -->