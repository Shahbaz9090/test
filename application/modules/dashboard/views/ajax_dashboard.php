<?php
	  $y = ($year) ? $year : 'Y';
	  $userId=$getUserId1;
	  $user_list = child_users($userId)['total_list'];
	  
	  $searchUserList=childUsers($userId);
	  asort($searchUserList);  	
	  $verticalContent=$searchType;
	  $search_data = $_POST;

	  //pr($user_list);

?>


<?php	

						   $verticalContent=$searchType;						   						   
                           
                           $today=date("Y-m-d");
  ///////////////////////////////////////  Yearly Report ////////////////////////////////////////////////////////
						   
						if($searchType=='yearly'){
				                $month = $searchData;								
								if(!isset($month->month)){
									$month = new stdClass();
									$month->month = date('m');
									$month->year  = date('Y');
								}
                                
                                if($month->year == date('Y'))
									$report_date = range(1,date('m'));
                                else
									$report_date = range(1,date('m',mktime(0, 0, 0, 0, 1,$month->year)));
								
								$job_array = array(0=>array('yearly','Sales Spares','Sales Governing','Sales PCB','Service Automation','Service DCS','Service PCB'));
								//pr($job_array);die;
								$sales_spares_data  = dashboard_total_sales_spares('yearly',$user_list,$month->year,$month->month);
								$sales_governing_data  = dashboard_total_sales_governing('yearly',$user_list,$month->year,$month->month);
								$sales_pcb_data  = dashboard_total_sales_pcb('yearly',$user_list,$month->year,$month->month);
								
								$service_automation_data  = dashboard_total_service_automation('yearly',$user_list,$month->year,$month->month);
								$service_dcs_data  = dashboard_total_service_dcs('yearly',$user_list,$month->year,$month->month);
								$service_pcb_data  = dashboard_total_service_pcb('yearly',$user_list,$month->year,$month->month);
								
									foreach($report_date as $key=>$value){								
									$job_array[] = array(
										0=> sprintf("%02s", $value),
										1=> isset($sales_spares_data[$value]) ? (int) $sales_spares_data[$value]: 0,
										2=> isset($sales_governing_data[$value]) ? (int) $sales_governing_data[$value]: 0,
										3=> isset($sales_pcb_data[$value]) ? (int) $sales_pcb_data[$value]: 0,
										
										4=> isset($service_automation_data[$value]) ? (int) $service_automation_data[$value]: 0,
										5=> isset($service_dcs_data[$value]) ? (int) $service_dcs_data[$value]: 0,
										6=> isset($service_pcb_data[$value]) ? (int) $service_pcb_data[$value]: 0,
										
									);
									
							   }
							   	
								
								
								
								 /* Company Contact Graph data */
							  $company_contact = dashboard_company_contact('yearly',$user_list,$month->year,$month->month);
							  //pr( $company_contact);die;
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
							   $contact_arr = array(array('Task','Total Client Contact'),array('Total Client Contact',$added_contact),array('Active Client Contact',$active_contact),array('Inactive Client Contact',$inactive_contact));
								
							   /*Client Graph data */
								$clients = dashboard_client_list('yearly',$user_list,$month->year,$month->month);
							  // pr($clients);die;
							   $active_contact = 0;
							   $inactive_contact = 0;
							   $added_contact = 0;
							   foreach($clients as $key=>$value){
								   if($value->status == 0)
									   $inactive_client = (int)$value->total;
								   if($value->status == 1)
									   $active_client = (int)$value->total;									
							   }
							   $added_client = $active_client+$inactive_client;
							   $client_arr = array(array('Task','Total'),array('Total Client',$added_client),array('Active Client',$active_client),array('Inactive Client',$inactive_client));
							   
							   /*Supplier India Graph data */
								$supplier_india = dashboard_supplier_india_list('yearly',$user_list,$month->year,$month->month);
							// pr($supplier_india);die;
							   $total_supplier_india = 0;
							   
							   $added_total_supplier_india = 0;
							   foreach($supplier_india as $key=>$value){
								   
									   $total_supplier_india = (int)$value->total;
								   								
							   }
							   $added_total_supplier_india = $total_supplier_india;
							   $supplier_india_arr = array(array('Task','Total Supplier India'),array('Total Supplier India',$added_total_supplier_india));
							   
							   /*Supplier China Graph data */
								$supplier_china = dashboard_supplier_china_list('yearly',$user_list,$month->year,$month->month);
							// pr($supplier_china);die;
							   $total_supplier_china = 0;
							   
							   $added_total_ssupplier_china = 0;
							   foreach($supplier_china as $key=>$value){
								   
									   $total_supplier_china = (int)$value->total;
								   								
							   }
							   $added_total_supplier_china = $total_supplier_china;
							   $supplier_china_arr = array(array('Task','Total Supplier China'),array('Total Supplier China',$added_total_supplier_china));
								
							///////////////////////////////// END Yearly  REPORT ////////////////////////////////////////////////////////////.  
						   }else if($searchType=='monthly'){
				                $month = $searchData;	
								if(!isset($month->month)){
									$month = new stdClass();
									$month->month = date('m');
									$month->year  = date('Y');
								}
								
                                if($month->month == date('m'))
									$report_date = range(1,date('d'));
                                else
									$report_date = range(1,date('t',mktime(0, 0, 0, $month->month, 1,$month->year)));
				
								$job_array = array(0=>array('monthly','Sales Spares','Sales Governing','Sales PCB','Service Automation','Service DCS','Service PCB'));
								//pr($job_array);die;
								$sales_spares_data  = dashboard_total_sales_spares('monthly',$user_list,$month->year,$month->month);
								$sales_governing_data  = dashboard_total_sales_governing('monthly',$user_list,$month->year,$month->month);
								$sales_pcb_data  = dashboard_total_sales_pcb('monthly',$user_list,$month->year,$month->month);
								
								$service_automation_data  = dashboard_total_service_automation('monthly',$user_list,$month->year,$month->month);
								$service_dcs_data  = dashboard_total_service_dcs('monthly',$user_list,$month->year,$month->month);
								$service_pcb_data  = dashboard_total_service_pcb('monthly',$user_list,$month->year,$month->month);
								
									foreach($report_date as $key=>$value){								
									$job_array[] = array(
										0=> sprintf("%02s", $value),
										1=> isset($sales_spares_data[$value]) ? (int) $sales_spares_data[$value]: 0,
										2=> isset($sales_governing_data[$value]) ? (int) $sales_governing_data[$value]: 0,
										3=> isset($sales_pcb_data[$value]) ? (int) $sales_pcb_data[$value]: 0,
										
										4=> isset($service_automation_data[$value]) ? (int) $service_automation_data[$value]: 0,
										5=> isset($service_dcs_data[$value]) ? (int) $service_dcs_data[$value]: 0,
										6=> isset($service_pcb_data[$value]) ? (int) $service_pcb_data[$value]: 0,
										
									);
									
							   }
								
								 /* Company Contact Graph data */
							   $company_contact = dashboard_company_contact('monthly',$user_list,$month->year,$month->month);
							   //pr($company_contact);die;
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
							   $contact_arr = array(array('Task','Total Client Contact'),array('Total Client Contact',$added_contact),array('Active Client Contact',$active_contact),array('Inactive Client Contact',$inactive_contact));
								//pr($contact_arr);die;
								
							   /*Client Graph data */
								$clients = dashboard_client_list('monthly',$user_list,$month->year,$month->month);
							  // pr($clients);die;
							   $active_contact = 0;
							   $inactive_contact = 0;
							   $added_contact = 0;
							   foreach($clients as $key=>$value){
								   if($value->status == 0)
									   $inactive_client = (int)$value->total;
								   if($value->status == 1)
									   $active_client = (int)$value->total;									
							   }
							   $added_client = $active_client+$inactive_client;
							   $client_arr = array(array('Task','Total'),array('Total Client',$added_client),array('Active Client',$active_client),array('Inactive Client',$inactive_client));
							   
							   
							   
							   /*Supplier India Graph data */
								$supplier_india = dashboard_supplier_india_list('monthly',$user_list,$month->year,$month->month);
							// pr($supplier_india);die;
							   $total_supplier_india = 0;
							   
							   $added_total_supplier_india = 0;
							   foreach($supplier_india as $key=>$value){
								   
									   $total_supplier_india = (int)$value->total;
								   								
							   }
							   $added_total_supplier_india = $total_supplier_india;
							   $supplier_india_arr = array(array('Task','Total Supplier India'),array('Total Supplier India',$added_total_supplier_india));
							   
							   /*Supplier China Graph data */
								$supplier_china = dashboard_supplier_china_list('monthly',$user_list,$month->year,$month->month);
							// pr($supplier_china);die;
							   $total_supplier_china = 0;
							   
							   $added_total_ssupplier_china = 0;
							   foreach($supplier_china as $key=>$value){
								   
									   $total_supplier_china = (int)$value->total;
								   								
							   }
							   $added_total_supplier_china = $total_supplier_china;
							   $supplier_china_arr = array(array('Task','Total Supplier China'),array('Total Supplier China',$added_total_supplier_china));
							  
							///////////////////////////////// END Yearly  REPORT ////////////////////////////////////////////////////////////. 
							   
							   
						   }else if($searchType=='weekly'){
				                $week_days = date('w');
								$day = date('d');
								$start = abs($day - $week_days)+1;
								$date = array();

								if($day < 6){
									$week_days = date('w');
									$last_date = date('t',strtotime('-1 month'));
									$report_date = array();
									$prev_month = abs($week_days-$day);
									$start = ($last_date-$prev_month)+1;
									
									for($i=$start;$i<=($start+$week_days)-1;$i++){
										if($i <= $last_date){											
											$report_date[] = $i;
										}else{
											$report_date[] = abs ($i-$last_date);
										}
									}
								}else{
									$report_date = range($start,$day);
								}
								
								$start = $report_date[0];
								$end = end($report_date);
									if(($start > 22 ) && ($end < 10)){
									$from_month = date('m',strtotime('-1 month'));
									$to_month = date('m');
									$date = array(
											date("Y-$from_month-$start"),
											date("Y-$to_month-$end")
										);
								}
								$job_array = array(0=>array('weekly','Sales Spares','Sales Governing','Sales PCB','Service Automation','Service DCS','Service PCB'));
								//pr($job_array);die;
								$sales_spares_data  = dashboard_total_sales_spares('weekly',$user_list,$month->year,$month->month);
								$sales_governing_data  = dashboard_total_sales_governing('weekly',$user_list,$month->year,$month->month);
								$sales_pcb_data  = dashboard_total_sales_pcb('weekly',$user_list,$month->year,$month->month);
								
								$service_automation_data  = dashboard_total_service_automation('weekly',$user_list,$month->year,$month->month);
								$service_dcs_data  = dashboard_total_service_dcs('weekly',$user_list,$month->year,$month->month);
								$service_pcb_data  = dashboard_total_service_pcb('weekly',$user_list,$month->year,$month->month);
								
									foreach($report_date as $key=>$value){								
									$job_array[] = array(
										0=> sprintf("%02s", $value),
										1=> isset($sales_spares_data[$value]) ? (int) $sales_spares_data[$value]: 0,
										2=> isset($sales_governing_data[$value]) ? (int) $sales_governing_data[$value]: 0,
										3=> isset($sales_pcb_data[$value]) ? (int) $sales_pcb_data[$value]: 0,
										
										4=> isset($service_automation_data[$value]) ? (int) $service_automation_data[$value]: 0,
										5=> isset($service_dcs_data[$value]) ? (int) $service_dcs_data[$value]: 0,
										6=> isset($service_pcb_data[$value]) ? (int) $service_pcb_data[$value]: 0,
										
									);
									
							   }
								
								 /* Company Contact Graph data */
							   $company_contact = dashboard_company_contact('weekly',$user_list,$month->year,$month->month);
							   //pr($company_contact);die;
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
							   $contact_arr = array(array('Task','Total Client Contact'),array('Total Client Contact',$added_contact),array('Active Client Contact',$active_contact),array('Inactive Client Contact',$inactive_contact));
								//pr($contact_arr);die;
								
							   /*Client Graph data */
								$clients = dashboard_client_list('weekly',$user_list,$month->year,$month->month);
							  // pr($clients);die;
							   $active_contact = 0;
							   $inactive_contact = 0;
							   $added_contact = 0;
							   foreach($clients as $key=>$value){
								   if($value->status == 0)
									   $inactive_client = (int)$value->total;
								   if($value->status == 1)
									   $active_client = (int)$value->total;									
							   }
							   $added_client = $active_client+$inactive_client;
							   $client_arr = array(array('Task','Total'),array('Total Client',$added_client),array('Active Client',$active_client),array('Inactive Client',$inactive_client));
							   
							   
							   
							   /*Supplier India Graph data */
								$supplier_india = dashboard_supplier_india_list('weekly',$user_list,$month->year,$month->month);
							// pr($supplier_india);die;
							   $total_supplier_india = 0;
							   
							   $added_total_supplier_india = 0;
							   foreach($supplier_india as $key=>$value){
								   
									   $total_supplier_india = (int)$value->total;
								   								
							   }
							   $added_total_supplier_india = $total_supplier_india;
							   $supplier_india_arr = array(array('Task','Total Supplier India'),array('Total Supplier India',$added_total_supplier_india));
							   
							   /*Supplier China Graph data */
								$supplier_china = dashboard_supplier_china_list('weekly',$user_list,$month->year,$month->month);
							// pr($supplier_china);die;
							   $total_supplier_china = 0;
							   
							   $added_total_ssupplier_china = 0;
							   foreach($supplier_china as $key=>$value){
								   
									   $total_supplier_china = (int)$value->total;
								   								
							   }
							   $added_total_supplier_china = $total_supplier_china;
							   $supplier_china_arr = array(array('Task','Total Supplier China'),array('Total Supplier China',$added_total_supplier_china));
							  
							///////////////////////////////// END Yearly  REPORT ////////////////////////////////////////////////////////////. 
							   
						   }else if($searchType=='daily'){
							    $month = $searchData;
								if(!isset($month->month)){
									$month = new stdClass();
									$month->month = date('m');
									$month->year  = date('Y');
									$month->day   = 0;
								}

								$from = new DateTime(date('Y-m-d H:i:s'));
								$to   = new DateTime(date('Y-m-d',strtotime("- $month->day day")));
								$diff = date_diff($from,$to);
								$total_days =  $diff->format("%a");

								$start_date  = date('Y-m-d',strtotime("-$month->day day"));
								$end_date    = date('Y-m-d');
								
								
								$report_date = array();
								for($i=0;$i<=($total_days);$i++){
									$report_date[]  = (int) date('d',strtotime("-$i day"));
								}
								$report_date = array_reverse($report_date);
								$date = array($start_date,$end_date);


								$job_array = array(0=>array('daily','Sales Spares','Sales Governing','Sales PCB','Service Automation','Service DCS','Service PCB'));
								//pr($job_array);die;
								$sales_spares_data  = dashboard_total_sales_spares('daily',$user_list,$month->year,$month->month);
								$sales_governing_data  = dashboard_total_sales_governing('daily',$user_list,$month->year,$month->month);
								$sales_pcb_data  = dashboard_total_sales_pcb('daily',$user_list,$month->year,$month->month);
								
								$service_automation_data  = dashboard_total_service_automation('daily',$user_list,$month->year,$month->month);
								$service_dcs_data  = dashboard_total_service_dcs('daily',$user_list,$month->year,$month->month);
								$service_pcb_data  = dashboard_total_service_pcb('daily',$user_list,$month->year,$month->month);
								
									foreach($report_date as $key=>$value){								
									$job_array[] = array(
										0=> sprintf("%02s", $value),
										1=> isset($sales_spares_data[$value]) ? (int) $sales_spares_data[$value]: 0,
										2=> isset($sales_governing_data[$value]) ? (int) $sales_governing_data[$value]: 0,
										3=> isset($sales_pcb_data[$value]) ? (int) $sales_pcb_data[$value]: 0,
										
										4=> isset($service_automation_data[$value]) ? (int) $service_automation_data[$value]: 0,
										5=> isset($service_dcs_data[$value]) ? (int) $service_dcs_data[$value]: 0,
										6=> isset($service_pcb_data[$value]) ? (int) $service_pcb_data[$value]: 0,
										
									);
									
							   }
								
								 /* Company Contact Graph data */
							   $company_contact = dashboard_company_contact('daily',$user_list,$month->year,$month->month);
							   //pr($company_contact);die;
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
							   $contact_arr = array(array('Task','Total Client Contact'),array('Total Client Contact',$added_contact),array('Active Client Contact',$active_contact),array('Inactive Client Contact',$inactive_contact));
								//pr($contact_arr);die;
								
							   /*Client Graph data */
								$clients = dashboard_client_list('daily',$user_list,$month->year,$month->month);
							  // pr($clients);die;
							   $active_contact = 0;
							   $inactive_contact = 0;
							   $added_contact = 0;
							   foreach($clients as $key=>$value){
								   if($value->status == 0)
									   $inactive_client = (int)$value->total;
								   if($value->status == 1)
									   $active_client = (int)$value->total;									
							   }
							   $added_client = $active_client+$inactive_client;
							   $client_arr = array(array('Task','Total'),array('Total Client',$added_client),array('Active Client',$active_client),array('Inactive Client',$inactive_client));
							   
							   
							   
							   /*Supplier India Graph data */
								$supplier_india = dashboard_supplier_india_list('daily',$user_list,$month->year,$month->month);
							// pr($supplier_india);die;
							   $total_supplier_india = 0;
							   
							   $added_total_supplier_india = 0;
							   foreach($supplier_india as $key=>$value){
								   
									   $total_supplier_india = (int)$value->total;
								   								
							   }
							   $added_total_supplier_india = $total_supplier_india;
							   $supplier_india_arr = array(array('Task','Total Supplier India'),array('Total Supplier India',$added_total_supplier_india));
							   
							   /*Supplier China Graph data */
								$supplier_china = dashboard_supplier_china_list('daily',$user_list,$month->year,$month->month);
							// pr($supplier_china);die;
							   $total_supplier_china = 0;
							   
							   $added_total_ssupplier_china = 0;
							   foreach($supplier_china as $key=>$value){
								   
									   $total_supplier_china = (int)$value->total;
								   								
							   }
							   $added_total_supplier_china = $total_supplier_china;
							   $supplier_china_arr = array(array('Task','Total Supplier China'),array('Total Supplier China',$added_total_supplier_china));
							  
							///////////////////////////////// END Yearly  REPORT ////////////////////////////////////////////////////////////.   
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
						if($selectedUser!=null){
				 ?><div class="span2 del">
                            <select name="users_type" class="nostyle select" id="users_type" onchange="ajaxDashboard('',this.value)" <?php if($i < ($sel-1)){?>  <?php }?>>
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
				  <input type="hidden" id="search_type" value="<?=$searchType?>" />
				  <input type="hidden" name="count_user" value="<?=$key?>" />
				  <input type="hidden" name="selected_user_<?=$key?>" value="<?=$key?>"  id="last_user1" />
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
			   $(document ).ready(function(){
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
				   <div id="job_status_div" style="height: 280px;width:100%;"></div>
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
        
        
        