<script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script>

<?php
$atr = array('chart_list');

$chart_list = user_report_type_data($atr);
//pr($chart_list);die;
//pr(explode(',',$chart_list->chart_list));die;
$chart_report = @_chart_report();

$chart_string = "";
$count = 0;
if($chart_report){
foreach($chart_report as $key=>$value){
	$chart_string .= $key;
	if($count < (count($chart_report)-1)){
		$chart_string .= ',';
	}
	$count++; 
}
}

$dynamic_year=array();
for($i=date("Y");$i>=2012;$i--)
{
	$dynamic_year[]=$i;
}

?>  

<script>

  $(function() {
	 $( "#sortable1, #sortable2" ).sortable({
	  connectWith: ".connectedSortable"
	}).disableSelection();
	$("#save_drag").click(function(){
		var arr = [];
		$("#sortable2 li").each(function(){
				var selected = $(this).attr('data-id');
				arr.push(selected);
				
		});
		///////////////////Inserting to database/////////////////////
		$.ajax({
			type:"POST",
			data:token_name+"="+token_hash+"&arr="+arr,			
			url:"<?php echo SITE_PATH;?>dashboard/set_dashboard_report/1",
			success: function(data){	
				ajaxRtypeDashboard();
			}
		}); 
		/////////////////////////////////////////////////////////////// 
		////////////////////show hide div/////////////////////////////
		
		var arr1 = [];
		$("#sortable1 li").each(function(){
			var selected = $(this).attr('data-id');
			arr1.push(selected);
			
		});
		
		
		//hide 
		for(var i=0 ; i<arr1.length; i++){
			//alert(arr[i]);
			$("#"+arr1[i]).hide();
		}
		/////////////////////////////////////////////////////////////////
		
	});
	
	
  });
</script>
<style>
  #sortable1, #sortable2 {
	border: 0px solid #eee;
	min-height: 20px;
	list-style-type: none;
	margin: 0;
	padding: 5px 0 0 0;
	margin-right: 0px;
	color: #000000;
  }
  #sortable1 li, #sortable2 li {
	margin: 0;
	padding: 5px;
	font-size: 12px;
  }
  #sortable1 li:hover, #sortable2 li:hover{
	background: #fff;
	color: #000000;
	cursor: pointer;
  }
  </style>


<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />
	<?php
		if($this->session->flashdata("success")){
	?> 
	 <div class="grid_10">
		<div class="alert alert-success" style="margin-top: 64px; padding-left: 15px;">
			<?php echo $this->session->flashdata("success");?>
		</div>
	</div>
			
	<?php	
		}
		 $userId=currentuserinfo()->id;
		 $atr = array('search_type','year','month','day');
		 $searchData=user_report_type_data_ymd($atr); 
		 //pr($searchData);die;
		 $searchType = isset($searchData->search_type)?$searchData->search_type:"yearly";                 
		
		 $user_list=json_decode($this->session->userdata('child_list')); 
		 //pr($user_list);exit;
		 $user_list = child_users($userId)['total_list'];
		 //pr($user_list); die;
		 $searchUserList=childUsers($userId);
		 asort($searchUserList);

		 $day = (isset($searchData->day)) ? @$searchData->day : 0;		 
		 $max_date = date("m/d/Y");
		 $min_date = date("m/d/Y",strtotime("-$day day")); 
		 $current=date("m/d/Y",strtotime('today')); 									
		 $prevs=date("m/d/Y",strtotime('monday this week')); 
		 $week = $prevs.' - '.$current;
  ?>
<input type="hidden" value="<?=$searchType?>" id="search_type" />
<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="row-fluid" id="setting" style="display: none;">
			<div class="title" >
				<h4>
					<span class="icon16 brocco-icon-grid"></span> <span>Settings</span>
				</h4>

			</div>
	
		 <div class="content" style="margin-bottom: 13px;"  style="color: #999;">
		
		 
			<div class="alert alert-info" id="pt_report_type_success" style="display: none; margin-top: 5px;">
			
				 <button type="button" class="close"  onclick="$('#pt_report_type_success').hide();" >&times;</button>
			 Your preferance has been set successfully.
			</div>
			
			<div class="row-fluid">
				<div class="span12">
					<p>Reporting Period Settings</p>
					<hr style="margin: 0;" />
				</div>
			
			</div>
			
			<div class="row-fluid" style=" margin-top: 5px;" id="pt_report_type_div">
			<div class="span12">
			<div class="row-fluid">
				<div class="span2 del">						
					<select name="report_type" id="report_type_select" class="nostyle select">	
					<?php
							//$reportType=array('yearly','monthly','weekly','daily');
							$reportType=array('yearly','monthly');
							//$reportType=array('yearly');
							foreach($reportType as $key=>$value){
						?>
							<option value="<?=$value?>"  <?php if($searchType=="$value"){?> selected <?php }?>><?=ucfirst($value)?></option>
						<?php }?>
					</select>	
						
				</div>
				<div class="span2 del" style="display: none;" id="year_div" >
								<select name="report_type" id="year_select" class="nostyle select">	
								 <option value="<?=date("Y")?>">Select Year</option>							
								<?php
									foreach($dynamic_year as $key=>$value){
								?>
									<option value="<?=$value?>"  <?php if(@$searchData->year==$value){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
						</select>	
				</div>
				<!--<div class="span2 del" style="display: none;" id="month_div">
								<select name="report_type" id="month_select" class="nostyle select">
								 <option value="">Select Month</option>								
								<?php
									$reportType=list_month();
									foreach($reportType as $key=>$value){
								?>
									<option value="<?=$key?>"  <?php if(@$searchData->month==$key){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
						</select>
				</div>
			   
				<div class="span2 del" style="display: none;" id="date_div">
						<select name="report_type"  id="date_select" class="nostyle select">	
							<?php
								$reportType=top_dash_date();
								foreach($reportType as $key=>$value){
							?>
								<option value="<?=$key?>"  <?php if(@$searchData->day==$key){?> selected <?php }?>><?=ucfirst($value)?></option>
							<?php }?>
						</select>
				</div>-->
				<div class="span2">					
							<button class="btn btn-info" id="save_button">Save</button>	
				</div>
				
			</div>
			</div></div>
			
			
			<br />
			<div class="row-fluid">
				<div class="span12">
					<p>Dashboard Chart Settings</p>
					<hr style="margin: 0;" />
					<p>Customise your Dashboard by using drag & drop option</p>
					<br />
				</div>
			
			</div>
			
			<div class="row-fluid">
				<div class="span12">
					<div class="row-fluid">
						<div class="span2">
						   <div class="avalable-top">Avalable Chart List</div><div class="avalable-bottom"><ul id="sortable1" class="connectedSortable">
							   <?php $chart_list_array = @explode(',', $chart_list->chart_list); //pr($chart_list_array);exit;
									$index=0;foreach($chart_report as $key=>$value){ ?>
								   <?php if(!@in_array($key,$chart_list_array)){?> <li  data-id="<?=$key?>"><?php echo $value; ?></li><?php  }?>
								<?php $index++; }  ?> 
						   </ul></div>
						</div>
						<div class="span2">
						<div class="avalable-top">Dashboard Chart List</div><div class="avalable-bottom">
							<ul id="sortable2" class="connectedSortable">
								<?php $chart_list_array = @explode(',', $chart_list->chart_list);

									if(count(array_filter($chart_list_array))>0){
									$index=0;
									foreach($chart_list_array as $key=>$value){
								?>
									<li  data-id="<?=@$value?>"><?php echo @$chart_report[$value]; ?></li>
								<?php $index++; } } ?>
							</ul></div>
						</div>
					</div>
				   
				</div>
			</div><br />
			<div class="row-fluid">
						<div class="span12">
							<button type="button" class="btn btn-info" id="save_drag">save</button>
						</div>
			</div>
			<hr style="margin: 5px;" />
			<div class="row-fluid">
				<div class="span12">
					<p>Note:</p>
					<p>For multiple selected use ctrl</p>
					<p>Set the position of charts by changing its order (moving up/down) in dashboard list)</p>
					<br />
				</div>
			
			</div>
			
		</div>
		</div>
		
		<!--Search -->
		<div class="row-fluid" id="search" style="display: none;">
			<div class="title" >
				<h4>
					<span class="icon16 brocco-icon-grid"></span> <span>Search</span>
				</h4>

			</div>
	
		 <div class="content" style="margin-bottom: 13px;"  style="">
		 
		 
		   
		   
			<form name="report" action="<?php echo base_url('dashboard').'/index'?>">
				<div class="form-row row-fluid">
					<div class="span2">
						<div class="report-type">Report Type </div>
						<div class="report-type  del">							
							<select name="report_type" class="nostyle select"  id="tmp_report_type_select" class="nostyle" >								
								<?php
									$reportType=array('yearly','monthly','weekly','daily');
									//$reportType=array('yearly');
									foreach($reportType as $key=>$value){
								?>
									<option value="<?=$value?>"  <?php if($searchType==$value){?> selected="true" <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>	
							
						</div>
					</div>
					<div class="span2" style="display: none;" id="tmp_year_div">
						<div class="report-type">Year </div>
						<div class="report-type del">							
							<select name="" id="tmp_year_select" class="nostyle select">	
								 <option value="<?=date("Y")?>">Select</option>							
								<?php
									foreach($dynamic_year as $key=>$value){
								?>
								 <option value="<?=$value?>"  <?php if(@$searchData->year==$value){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>	
							
						</div>
					</div>
					<div class="span2" style="display: none;" id="tmp_month_div">
							<div class="report-type">Month </div>
							<div class="report-type del">							
								   <select name="" id="tmp_month_select" class="nostyle select">
									 <option value="">Select</option>								
									<?php
										$reportType=list_month();
										foreach($reportType as $key=>$value){
									?>
										<option value="<?=$key?>"  <?php if(@$searchData->month==$key){?> selected <?php }?>><?=ucfirst($value)?></option>
									<?php }?>
								   </select>	
								
							</div>
					</div>
					<div class="span2" style="display: none;" id="tmp_week_div">
							<div class="report-type">Week</div>
							<div class="report-type">							
								<input type="text" id="week_input" class="week-picker " value="<?=@$week?>" />
								<input type="hidden" id="startDate" value="<?=@$prevs?>" />
								<input type="hidden" id="endDate" value="<?=@$current?>" />
							</div>
					</div>
				   
					<div class="span2" style="display: none;" id="tmp_mindate_div">
							<div class="report-type">Start Date</div>
							<div class="report-type">
							
							<input type="text" id="start_date" class="span12" value="<?=@$min_date?>" />		
							<script type="text/javascript">	
								$(function() {
										var dates = $( "#start_date, #end_date" ).datepicker({
											defaultDate: "+1w",			
											changeMonth: true,
											minDate: -6 ,
											maxDate: 0  ,
											numberOfMonths: 1,
											onSelect: function( selectedDate ) {
												var option = this.id == "start_date" ? "minDate" : "maxDate"+1,
													instance = $( this ).data( "datepicker" ),
													date = $.datepicker.parseDate(
														instance.settings.dateFormat ||
														$.datepicker._defaults.dateFormat,
														selectedDate, instance.settings );
												dates.not( this ).datepicker( "option", option, date );
											}
										  
										});
								});
							</script>
					
									
							</div>
					</div>
					
					<div class="span2" style="display: none;" id="tmp_maxdate_div">
							<div class="report-type">End Date</div>
							<div class="report-type">
							
							<input type="text" id="end_date" class="span12" value="<?=@$max_date?>"/>		
								
							</div>
					</div>
					   
					<div class="span2" id="search_button_div">
						<div class="report-type"><a class="btn btn-info mt17" onclick="ajaxRtypeDashboard()">Search</a></div>                  
					</div>
						
				</div>                
				
			
		
			
		</div>
		<!--------------------->
	  <span id="report_by_users">
	<div class="title"><h4>Serach By User</h4></div>	
		   
		 <div class="content" style="margin-bottom: 13px;"  style="">
		 
		 
		   
		   
							  
				
				<div class="form-row row-fluid">
			
					<div class="span2">
						<div class="del">
							<select name="users_type1" id="users_type1" onchange="ajaxDashboard(report_type.value,this.value)" class="nostyle select">
								<option value="">Select</option>
								<?php									
									foreach($searchUserList as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if(isset($getUserId1)&&($getUserId1==$key)){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>
						  
							<?php if(isset($searchUserList1)&&($searchUserList1!=null)){?>
							<select name="users_type2" onchange="this.form.submit()">
								<option value="">Select</option>
								<?php									
									foreach($searchUserList1 as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if(isset($getUserId2)&&($getUserId2==$key)){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>
							<?php }?>

							<?php if(isset($searchUserList2)&&($searchUserList2!=null)&&isset($searchUserList1)){?>
							<select name="users_type3" onchange="this.form.submit()">
								<option value="">Select</option>
								<?php									
									foreach($searchUserList2 as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if(isset($getUserId3)&&($getUserId3==$key)){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>
							<?php }?>

							<?php if(isset($searchUserList3)&&($searchUserList3!=null)&&isset($searchUserList2)&&isset($searchUserList1)){?>
							<select name="users_type4" onchange="this.form.submit()">
								<option value="">Select</option>
								<?php									
									foreach($searchUserList3 as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if(isset($getUserId4)&&($getUserId4==$key)){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>
							<?php }?>

							<?php if(isset($searchUserList4)&&($searchUserList4!=null)&&isset($searchUserList3)&&isset($searchUserList2)){?>
							<select name="users_type5" onchange="this.form.submit()">
								<option value="">Select</option>
								<?php									
									foreach($searchUserList4 as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if(isset($getUserId5)&&($getUserId5==$key)){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>
							<?php }?>

							<?php if(isset($searchUserList5)&&($searchUserList5!=null)&&isset($searchUserList4)&&isset($searchUserList3)&&isset($searchUserList2)){?>
							<select name="users_type6" onchange="this.form.submit()">
								<option value="">Select</option>
								<?php									
									foreach($searchUserList5 as $key=>$value){
								?>
									<option value="<?=$key?>" <?php if(isset($getUserId6)&&($getUserId6==$key)){?> selected <?php }?>><?=ucfirst($value)?></option>
								<?php }?>
							</select>
							<?php }?>
							
							
						</div>
					
					</div>
					
			</div>
		
			</form>
			
		</div>
		
		</span>  
		<!----------------------->
		
		</div>
		<!--  -->
		<!-- serch by user-->
		
		<!-- -->
		<span id="reload"></span>
		 <span id="replace_div">
			<input type="hidden" name="default_user" id="default_user" value="<?=$userId?>"/>
						<?php
						   $verticalContent=$searchType;
						   $today=date("Y-m-d");
  ///////////////////////////////////////  Yearly Report ////////////////////////////////////////////////////////
						   //pr($verticalContent);
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
								//pr($contact_arr);die;
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
					 <div class="row-fluid">                      
					
						<div class="span12" style="margin-left:0px;" id="job_order">
						<script type="text/javascript">
						
							  google.load("visualization", "1", {packages:["corechart"]});
							  google.setOnLoadCallback(drawChart);
							  function drawChart() {							  
								var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($job_array))?>);
									//console.log(data);		
								var options = {
								  title: 'Installation Base',
								  hAxis: {title: '<?=ucfirst($verticalContent)." Report"?>', titleTextStyle: {color: 'red'}}
								};

								var chart = new google.visualization.ColumnChart(document.getElementById('job_order_div'));
								chart.draw(data, options);
							  }
							</script>

							<div class="box chart">
								<div class="title">
									<h4>
																				<span>Installation Base</span>
									</h4>
									<a href="#" class="minimize">Minimize</a>
								</div>
								<div class="content">
								   
									<div id="job_order_div" style="height:350px;width:100%;"></div>

								</div>
							</div>                        
						</div>						                        
					   

					</div><!-- End .row-fluid -->          

					<div class="row-fluid">
					<?php
					   // pr($chart_list);
						foreach($chart_list_array as $key=>$value){ 
						 
						 if($value == 'client_contact'){
					?>
					 <div class="view_bg"  id="company">
					   
							<script type="text/javascript">
							  google.load("visualization", "1", {packages:["corechart"]});
							  google.setOnLoadCallback(drawChart);
							  function drawChart() {
								var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($contact_arr))?>);
									
								var options = {
								  title: ' '
								};

								var chart = new google.visualization.PieChart(document.getElementById('company_div'));
								chart.draw(data, options);
							  }
							</script>

							<div class="box chart">

								<div class="title">

									<h4>
																				<span>Client Contact</span>
									</h4>
									<a href="#" class="minimize">Minimize</a>
								</div>
								<div class="content">
								   <div id="company_div" style="height: 280px;width:100%;"></div>
								</div>

							</div>
						
						</div>
						<?php 
						}elseif($value == 'client'){
						?>
						<div class="view_bg" id="candidate">
							
							<script type="text/javascript">
							  google.load("visualization", "1", {packages:["corechart"]});
							  google.setOnLoadCallback(drawChart);
							  function drawChart() {
								var data = google.visualization.arrayToDataTable(
									<?php print_r(json_encode($client_arr))?>);

								var options = {
								  title: ''
								};

								var chart = new google.visualization.PieChart(document.getElementById('candidate_div'));
								chart.draw(data, options);
							  }
							</script>
							<div class="box chart">
								<div class="title">
									<h4>
																				<span>Client </span>
									</h4>
									<a href="#" class="minimize">Minimize</a>
								</div>
								<div class="content">
								   <div id="candidate_div" style="height: 280px;width:100%;"></div>
								</div>

							</div><!-- End .box -->
						
						</div><!-- End .span6 -->
					   <?php }elseif($value == 'supplier_india'){  ?>
						<div class="view_bg" id="vendor">
							<script type="text/javascript">
							  google.load("visualization", "1", {packages:["corechart"]});
							  google.setOnLoadCallback(drawChart);
							  function drawChart() {							  
								var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($supplier_india_arr));?>);

								var options = {
								  title: '',
								  hAxis: {title: '<?=ucfirst($verticalContent)." Report"?>', titleTextStyle: {color: 'red'}}
								};

								var chart = new google.visualization.ColumnChart(document.getElementById('vendor_div'));
								chart.draw(data, options);
							  }
							</script>
							<div class="box chart">
								<div class="title">
									<h4>
																				<span>Supplier India</span>
									</h4>
									<a href="#" class="minimize">Minimize</a>
								</div>
								<div class="content">
								   <div id="vendor_div" style="height: 280px;width:100%;"></div>
								</div>
								

							</div><!-- End .box -->
						
						</div><!-- End .span6 -->
						<?php
						}elseif($value=='supplier_china'){
						?>
						<div class="view_bg" id="job_status">
					   
							<script type="text/javascript">
							  google.load("visualization", "1", {packages:["corechart"]});
							  google.setOnLoadCallback(drawChart);
							  function drawChart() {
								var data = google.visualization.arrayToDataTable(<?php print_r(json_encode($supplier_china_arr))?>);

								var options = {
								  title: '',
								  hAxis: {title: '<?=ucfirst($verticalContent)." Report"?>', titleTextStyle: {color: 'red'}}
								};

								var chart = new google.visualization.ColumnChart(document.getElementById('job_status_div'));
								chart.draw(data, options);
							  }
							</script>

							<div class="box chart">

								<div class="title">

									<h4>
																				<span>Supplier China</span>
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
					
<!------------------------------Calender----------------------------------------->

<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<style>
.dropdown-menu {
	z-index: 2147483647 !important;
}

/*!
 * FullCalendar v2.1.1 Stylesheet
 * Docs & License: http://arshaw.com/fullcalendar/
 * (c) 2013 Adam Shaw
 */


.fc {
	direction: ltr;
	text-align: left;
}

.fc-rtl {
	text-align: right;
}

body .fc { /* extra precedence to overcome jqui */
	font-size: 1em;
}


/* Colors
--------------------------------------------------------------------------------------------------*/

.fc-unthemed th,
.fc-unthemed td,
.fc-unthemed hr,
.fc-unthemed thead,
.fc-unthemed tbody,
.fc-unthemed .fc-row,
.fc-unthemed .fc-popover {
	border-color: #ddd;
}

.fc-unthemed .fc-popover {
	background-color: #fff;
}

.fc-unthemed hr,
.fc-unthemed .fc-popover .fc-header {
	background: #eee;
}

.fc-unthemed .fc-popover .fc-header .fc-close {
	color: #666;
}

.fc-unthemed .fc-today {
	background: #fcf8e3;
}

.fc-highlight { /* when user is selecting cells */
	background: #bce8f1;
	opacity: .3;
	filter: alpha(opacity=30); /* for IE */
}


/* Icons (inline elements with styled text that mock arrow icons)
--------------------------------------------------------------------------------------------------*/

.fc-icon {
	display: inline-block;
	font-size: 2em;
	line-height: .5em;
	height: .5em; /* will make the total height 1em */
	font-family: "Courier New", Courier, monospace;
}

.fc-icon-left-single-arrow:after {
	content: "\02039";
	font-weight: bold;
}

.fc-icon-right-single-arrow:after {
	content: "\0203A";
	font-weight: bold;
}

.fc-icon-left-double-arrow:after {
	content: "\000AB";
}

.fc-icon-right-double-arrow:after {
	content: "\000BB";
}

.fc-icon-x:after {
	content: "\000D7";
}


/* Buttons (styled <button> tags, normalized to work cross-browser)
--------------------------------------------------------------------------------------------------*/

.fc button {
	/* force height to include the border and padding */
	-moz-box-sizing: border-box;
	-webkit-box-sizing: border-box;
	box-sizing: border-box;

	/* dimensions */
	margin: 0;
	height: 2.1em;
	padding: 0 .6em;

	/* text & cursor */
	font-size: 1em; /* normalize */
	white-space: nowrap;
	cursor: pointer;
}

/* Firefox has an annoying inner border */
.fc button::-moz-focus-inner { margin: 0; padding: 0; }
	
.fc-state-default { /* non-theme */
	border: 1px solid;
}

.fc-state-default.fc-corner-left { /* non-theme */
	border-top-left-radius: 4px;
	border-bottom-left-radius: 4px;
}

.fc-state-default.fc-corner-right { /* non-theme */
	border-top-right-radius: 4px;
	border-bottom-right-radius: 4px;
}

/* icons in buttons */

.fc button .fc-icon { /* non-theme */
	position: relative;
	top: .05em; /* seems to be a good adjustment across browsers */
	margin: 0 .1em;
}
	
/*
  button states
  borrowed from twitter bootstrap (http://twitter.github.com/bootstrap/)
*/

.fc-state-default {
	background-color: #f5f5f5;
	background-image: -moz-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -webkit-gradient(linear, 0 0, 0 100%, from(#ffffff), to(#e6e6e6));
	background-image: -webkit-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: -o-linear-gradient(top, #ffffff, #e6e6e6);
	background-image: linear-gradient(to bottom, #ffffff, #e6e6e6);
	background-repeat: repeat-x;
	border-color: #e6e6e6 #e6e6e6 #bfbfbf;
	border-color: rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.1) rgba(0, 0, 0, 0.25);
	color: #333;
	text-shadow: 0 1px 1px rgba(255, 255, 255, 0.75);
	box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.2), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.fc-state-hover,
.fc-state-down,
.fc-state-active,
.fc-state-disabled {
	color: #333333;
	background-color: #e6e6e6;
}

.fc-state-hover {
	color: #333333;
	text-decoration: none;
	background-position: 0 -15px;
	-webkit-transition: background-position 0.1s linear;
	   -moz-transition: background-position 0.1s linear;
		 -o-transition: background-position 0.1s linear;
			transition: background-position 0.1s linear;
}

.fc-state-down,
.fc-state-active {
	background-color: #cccccc;
	background-image: none;
	box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.15), 0 1px 2px rgba(0, 0, 0, 0.05);
}

.fc-state-disabled {
	cursor: default;
	background-image: none;
	opacity: 0.65;
	filter: alpha(opacity=65);
	box-shadow: none;
}


/* Buttons Groups
--------------------------------------------------------------------------------------------------*/

.fc-button-group {
	display: inline-block;
}

/*
every button that is not first in a button group should scootch over one pixel and cover the
previous button's border...
*/

.fc .fc-button-group > * { /* extra precedence b/c buttons have margin set to zero */
	float: left;
	margin: 0 0 0 -1px;
}

.fc .fc-button-group > :first-child { /* same */
	margin-left: 0;
}


/* Popover
--------------------------------------------------------------------------------------------------*/

.fc-popover {
	position: absolute;
	box-shadow: 0 2px 6px rgba(0,0,0,.15);
}

.fc-popover .fc-header {
	padding: 2px 4px;
}

.fc-popover .fc-header .fc-title {
	margin: 0 2px;
}

.fc-popover .fc-header .fc-close {
	cursor: pointer;
}

.fc-ltr .fc-popover .fc-header .fc-title,
.fc-rtl .fc-popover .fc-header .fc-close {
	float: left;
}

.fc-rtl .fc-popover .fc-header .fc-title,
.fc-ltr .fc-popover .fc-header .fc-close {
	float: right;
}

/* unthemed */

.fc-unthemed .fc-popover {
	border-width: 1px;
	border-style: solid;
}

.fc-unthemed .fc-popover .fc-header .fc-close {
	font-size: 25px;
	margin-top: 4px;
}

/* jqui themed */

.fc-popover > .ui-widget-header + .ui-widget-content {
	border-top: 0; /* where they meet, let the header have the border */
}


/* Misc Reusable Components
--------------------------------------------------------------------------------------------------*/

.fc hr {
	height: 0;
	margin: 0;
	padding: 0 0 2px; /* height is unreliable across browsers, so use padding */
	border-style: solid;
	border-width: 1px 0;
}

.fc-clear {
	clear: both;
}

.fc-bg,
.fc-highlight-skeleton,
.fc-helper-skeleton {
	/* these element should always cling to top-left/right corners */
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
}

.fc-bg {
	bottom: 0; /* strech bg to bottom edge */
}

.fc-bg table {
	height: 100%; /* strech bg to bottom edge */
}


/* Tables
--------------------------------------------------------------------------------------------------*/

.fc table {
	width: 100%;
	table-layout: fixed;
	border-collapse: collapse;
	border-spacing: 0;
	font-size: 1em; /* normalize cross-browser */
}

.fc th {
	text-align: center;
}

.fc th,
.fc td {
	border-style: solid;
	border-width: 1px;
	padding: 0;
	vertical-align: top;
}

.fc td.fc-today {
	border-style: double; /* overcome neighboring borders */
}


/* Fake Table Rows
--------------------------------------------------------------------------------------------------*/

.fc .fc-row { /* extra precedence to overcome themes w/ .ui-widget-content forcing a 1px border */
	/* no visible border by default. but make available if need be (scrollbar width compensation) */
	border-style: solid;
	border-width: 0;
}

.fc-row table {
	/* don't put left/right border on anything within a fake row.
	   the outer tbody will worry about this */
	border-left: 0 hidden transparent;
	border-right: 0 hidden transparent;

	/* no bottom borders on rows */
	border-bottom: 0 hidden transparent; 
}

.fc-row:first-child table {
	border-top: 0 hidden transparent; /* no top border on first row */
}


/* Day Row (used within the header and the DayGrid)
--------------------------------------------------------------------------------------------------*/

.fc-row {
	position: relative;
}

.fc-row .fc-bg {
	z-index: 1;
}

/* highlighting cells */

.fc-row .fc-highlight-skeleton {
	z-index: 2;
	bottom: 0; /* stretch skeleton to bottom of row */
}

.fc-row .fc-highlight-skeleton table {
	height: 100%; /* stretch skeleton to bottom of row */
}

.fc-row .fc-highlight-skeleton td {
	border-color: transparent;
}

/*
row content (which contains day/week numbers and events) as well as "helper" (which contains
temporary rendered events).
*/

.fc-row .fc-content-skeleton {
	position: relative;
	z-index: 3;
	padding-bottom: 2px; /* matches the space above the events */
}

.fc-row .fc-helper-skeleton {
	z-index: 4;
}

.fc-row .fc-content-skeleton td,
.fc-row .fc-helper-skeleton td {
	/* see-through to the background below */
	background: none; /* in case <td>s are globally styled */
	border-color: transparent;

	/* don't put a border between events and/or the day number */
	border-bottom: 0;
}

.fc-row .fc-content-skeleton tbody td, /* cells with events inside (so NOT the day number cell) */
.fc-row .fc-helper-skeleton tbody td {
	/* don't put a border between event cells */
	border-top: 0;
}


/* Scrolling Container
--------------------------------------------------------------------------------------------------*/

.fc-scroller { /* this class goes on elements for guaranteed vertical scrollbars */
	overflow-y: scroll;
	overflow-x: hidden;
}

.fc-scroller > * { /* we expect an immediate inner element */
	position: relative; /* re-scope all positions */
	width: 100%; /* hack to force re-sizing this inner element when scrollbars appear/disappear */
	overflow: hidden; /* don't let negative margins or absolute positioning create further scroll */
}


/* Global Event Styles
--------------------------------------------------------------------------------------------------*/

.fc-event {
	position: relative; /* for resize handle and other inner positioning */
	display: block; /* make the <a> tag block */
	font-size: .85em;
	line-height: 1.3;
	border-radius: 3px;
	border: 1px solid #3a87ad; /* default BORDER color */
	background-color: #3a87ad; /* default BACKGROUND color */
	font-weight: normal; /* undo jqui's ui-widget-header bold */
}

/* overpower some of bootstrap's and jqui's styles on <a> tags */
.fc-event,
.fc-event:hover,
.ui-widget .fc-event {
	color: #fff; /* default TEXT color */
	text-decoration: none; /* if <a> has an href */
}

.fc-event[href],
.fc-event.fc-draggable {
	cursor: pointer; /* give events with links and draggable events a hand mouse pointer */
}


/* DayGrid events
----------------------------------------------------------------------------------------------------
We use the full "fc-day-grid-event" class instead of using descendants because the event won't
be a descendant of the grid when it is being dragged.
*/

.fc-day-grid-event {
	margin: 1px 2px 0; /* spacing between events and edges */
	padding: 0 1px;
}

/* events that are continuing to/from another week. kill rounded corners and butt up against edge */

.fc-ltr .fc-day-grid-event.fc-not-start,
.fc-rtl .fc-day-grid-event.fc-not-end {
	margin-left: 0;
	border-left-width: 0;
	padding-left: 1px; /* replace the border with padding */
	border-top-left-radius: 0;
	border-bottom-left-radius: 0;
}

.fc-ltr .fc-day-grid-event.fc-not-end,
.fc-rtl .fc-day-grid-event.fc-not-start {
	margin-right: 0;
	border-right-width: 0;
	padding-right: 1px; /* replace the border with padding */
	border-top-right-radius: 0;
	border-bottom-right-radius: 0;
}

.fc-day-grid-event > .fc-content { /* force events to be one-line tall */
	white-space: nowrap;
	overflow: hidden;
}

.fc-day-grid-event .fc-time {
	font-weight: bold;
}

/* resize handle (outside of fc-content, so can go outside of bounds) */

.fc-day-grid-event .fc-resizer {
	position: absolute;
	top: 0;
	bottom: 0;
	width: 7px;
}

.fc-ltr .fc-day-grid-event .fc-resizer {
	right: -3px;
	cursor: e-resize;
}

.fc-rtl .fc-day-grid-event .fc-resizer {
	left: -3px;
	cursor: w-resize;
}


/* Event Limiting
--------------------------------------------------------------------------------------------------*/

/* "more" link that represents hidden events */

a.fc-more {
	margin: 1px 3px;
	font-size: .85em;
	cursor: pointer;
	text-decoration: none;
}

a.fc-more:hover {
	text-decoration: underline;
}

.fc-limited { /* rows and cells that are hidden because of a "more" link */
	display: none;
}

/* popover that appears when "more" link is clicked */

.fc-day-grid .fc-row {
	z-index: 1; /* make the "more" popover one higher than this */
}

.fc-more-popover {
	z-index: 2;
	width: 220px;
}

.fc-more-popover .fc-event-container {
	padding: 10px;
}

/* Toolbar
--------------------------------------------------------------------------------------------------*/

.fc-toolbar {
	text-align: center;
	margin-bottom: 1em;
}

.fc-toolbar .fc-left {
	float: left;
}

.fc-toolbar .fc-right {
	float: right;
}

.fc-toolbar .fc-center {
	display: inline-block;
}

/* the things within each left/right/center section */
.fc .fc-toolbar > * > * { /* extra precedence to override button border margins */
	float: left;
	margin-left: .75em;
}

/* the first thing within each left/center/right section */
.fc .fc-toolbar > * > :first-child { /* extra precedence to override button border margins */
	margin-left: 0;
}
	
/* title text */

.fc-toolbar h2 {
	margin: 0;
}

/* button layering (for border precedence) */

.fc-toolbar button {
	position: relative;
}

.fc-toolbar .fc-state-hover,
.fc-toolbar .ui-state-hover {
	z-index: 2;
}
	
.fc-toolbar .fc-state-down {
	z-index: 3;
}

.fc-toolbar .fc-state-active,
.fc-toolbar .ui-state-active {
	z-index: 4;
}

.fc-toolbar button:focus {
	z-index: 5;
}


/* View Structure
--------------------------------------------------------------------------------------------------*/

/* undo twitter bootstrap's box-sizing rules. normalizes positioning techniques */
/* don't do this for the toolbar because we'll want bootstrap to style those buttons as some pt */
.fc-view-container *,
.fc-view-container *:before,
.fc-view-container *:after {
	-webkit-box-sizing: content-box;
	   -moz-box-sizing: content-box;
			box-sizing: content-box;
}

.fc-view, /* scope positioning and z-index's for everything within the view */
.fc-view > table { /* so dragged elements can be above the view's main element */
	position: relative;
	z-index: 1;
}

/* BasicView
--------------------------------------------------------------------------------------------------*/

/* day row structure */

.fc-basicWeek-view .fc-content-skeleton,
.fc-basicDay-view .fc-content-skeleton {
	/* we are sure there are no day numbers in these views, so... */
	padding-top: 1px; /* add a pixel to make sure there are 2px padding above events */
	padding-bottom: 1em; /* ensure a space at bottom of cell for user selecting/clicking */
}

.fc-basic-view tbody .fc-row {
	min-height: 4em; /* ensure that all rows are at least this tall */
}

/* a "rigid" row will take up a constant amount of height because content-skeleton is absolute */

.fc-row.fc-rigid {
	overflow: hidden;
}

.fc-row.fc-rigid .fc-content-skeleton {
	position: absolute;
	top: 0;
	left: 0;
	right: 0;
}

/* week and day number styling */

.fc-basic-view .fc-week-number,
.fc-basic-view .fc-day-number {
	padding: 0 2px;
}

.fc-basic-view td.fc-week-number span,
.fc-basic-view td.fc-day-number {
	padding-top: 2px;
	padding-bottom: 2px;
}

.fc-basic-view .fc-week-number {
	text-align: center;
}

.fc-basic-view .fc-week-number span {
	/* work around the way we do column resizing and ensure a minimum width */
	display: inline-block;
	min-width: 1.25em;
}

.fc-ltr .fc-basic-view .fc-day-number {
	text-align: right;
}

.fc-rtl .fc-basic-view .fc-day-number {
	text-align: left;
}

.fc-day-number.fc-other-month {
	opacity: 0.3;
	filter: alpha(opacity=30); /* for IE */
	/* opacity with small font can sometimes look too faded
	   might want to set the 'color' property instead
	   making day-numbers bold also fixes the problem */
}

/* AgendaView all-day area
--------------------------------------------------------------------------------------------------*/

.fc-agenda-view .fc-day-grid {
	position: relative;
	z-index: 2; /* so the "more.." popover will be over the time grid */
}

.fc-agenda-view .fc-day-grid .fc-row {
	min-height: 3em; /* all-day section will never get shorter than this */
}

.fc-agenda-view .fc-day-grid .fc-row .fc-content-skeleton {
	padding-top: 1px; /* add a pixel to make sure there are 2px padding above events */
	padding-bottom: 1em; /* give space underneath events for clicking/selecting days */
}


/* TimeGrid axis running down the side (for both the all-day area and the slot area)
--------------------------------------------------------------------------------------------------*/

.fc .fc-axis { /* .fc to overcome default cell styles */
	vertical-align: middle;
	padding: 0 4px;
	white-space: nowrap;
}

.fc-ltr .fc-axis {
	text-align: right;
}

.fc-rtl .fc-axis {
	text-align: left;
}

.ui-widget td.fc-axis {
	font-weight: normal; /* overcome jqui theme making it bold */
}


/* TimeGrid Structure
--------------------------------------------------------------------------------------------------*/

.fc-time-grid-container, /* so scroll container's z-index is below all-day */
.fc-time-grid { /* so slats/bg/content/etc positions get scoped within here */
	position: relative;
	z-index: 1;
}

.fc-time-grid {
	min-height: 100%; /* so if height setting is 'auto', .fc-bg stretches to fill height */
}

.fc-time-grid table { /* don't put outer borders on slats/bg/content/etc */
	border: 0 hidden transparent;
}

.fc-time-grid > .fc-bg {
	z-index: 1;
}

.fc-time-grid .fc-slats,
.fc-time-grid > hr { /* the <hr> AgendaView injects when grid is shorter than scroller */
	position: relative;
	z-index: 2;
}

.fc-time-grid .fc-highlight-skeleton {
	z-index: 3;
}

.fc-time-grid .fc-content-skeleton {
	position: absolute;
	z-index: 4;
	top: 0;
	left: 0;
	right: 0;
}

.fc-time-grid > .fc-helper-skeleton {
	z-index: 5;
}


/* TimeGrid Slats (lines that run horizontally)
--------------------------------------------------------------------------------------------------*/

.fc-slats td {
	height: 1.5em;
	border-bottom: 0; /* each cell is responsible for its top border */
}

.fc-slats .fc-minor td {
	border-top-style: dotted;
}

.fc-slats .ui-widget-content { /* for jqui theme */
	background: none; /* see through to fc-bg */
}


/* TimeGrid Highlighting Slots
--------------------------------------------------------------------------------------------------*/

.fc-time-grid .fc-highlight-container { /* a div within a cell within the fc-highlight-skeleton */
	position: relative; /* scopes the left/right of the fc-highlight to be in the column */
}

.fc-time-grid .fc-highlight {
	position: absolute;
	left: 0;
	right: 0;
	/* top and bottom will be in by JS */
}


/* TimeGrid Event Containment
--------------------------------------------------------------------------------------------------*/

.fc-time-grid .fc-event-container { /* a div within a cell within the fc-content-skeleton */
	position: relative;
}

.fc-ltr .fc-time-grid .fc-event-container { /* space on the sides of events for LTR (default) */
	margin: 0 2.5% 0 2px;
}

.fc-rtl .fc-time-grid .fc-event-container { /* space on the sides of events for RTL */
	margin: 0 2px 0 2.5%;
}

.fc-time-grid .fc-event {
	position: absolute;
	z-index: 1; /* scope inner z-index's */
}


/* TimeGrid Event Styling
----------------------------------------------------------------------------------------------------
We use the full "fc-time-grid-event" class instead of using descendants because the event won't
be a descendant of the grid when it is being dragged.
*/

.fc-time-grid-event.fc-not-start { /* events that are continuing from another day */
	/* replace space made by the top border with padding */
	border-top-width: 0;
	padding-top: 1px;

	/* remove top rounded corners */
	border-top-left-radius: 0;
	border-top-right-radius: 0;
}

.fc-time-grid-event.fc-not-end {
	/* replace space made by the top border with padding */
	border-bottom-width: 0;
	padding-bottom: 1px;

	/* remove bottom rounded corners */
	border-bottom-left-radius: 0;
	border-bottom-right-radius: 0;
}

.fc-time-grid-event {
	overflow: hidden; /* don't let the bg flow over rounded corners */
}

.fc-time-grid-event > .fc-content { /* contains the time and title, but no bg and resizer */
	position: relative;
	z-index: 2; /* above the bg */
}

.fc-time-grid-event .fc-time,
.fc-time-grid-event .fc-title {
	padding: 0 1px;
}

.fc-time-grid-event .fc-time {
	font-size: .85em;
	white-space: nowrap;
}

.fc-time-grid-event .fc-bg {
	z-index: 1;
	background: #fff;
	opacity: .25;
	filter: alpha(opacity=25); /* for IE */
}

/* short mode, where time and title are on the same line */

.fc-time-grid-event.fc-short .fc-content {
	/* don't wrap to second line (now that contents will be inline) */
	white-space: nowrap;
}

.fc-time-grid-event.fc-short .fc-time,
.fc-time-grid-event.fc-short .fc-title {
	/* put the time and title on the same line */
	display: inline-block;
	vertical-align: top;
}

.fc-time-grid-event.fc-short .fc-time span {
	display: none; /* don't display the full time text... */
}

.fc-time-grid-event.fc-short .fc-time:before {
	content: attr(data-start); /* ...instead, display only the start time */
}

.fc-time-grid-event.fc-short .fc-time:after {
	content: "\000A0-\000A0"; /* seperate with a dash, wrapped in nbsp's */
}

.fc-time-grid-event.fc-short .fc-title {
	font-size: .85em; /* make the title text the same size as the time */
	padding: 0; /* undo padding from above */
}

/* resizer */

.fc-time-grid-event .fc-resizer {
	position: absolute;
	z-index: 3; /* above content */
	left: 0;
	right: 0;
	bottom: 0;
	height: 8px;
	overflow: hidden;
	line-height: 8px;
	font-size: 11px;
	font-family: monospace;
	text-align: center;
	cursor: s-resize;
}

.fc-time-grid-event .fc-resizer:after {
	content: "=";
}




.bootstrap-timepicker {
  position: relative;
}
.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu {
  left: auto;
  right: 0;
}
.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu:before {
  left: auto;
  right: 12px;
}
.bootstrap-timepicker.pull-right .bootstrap-timepicker-widget.dropdown-menu:after {
  left: auto;
  right: 13px;
}
.bootstrap-timepicker .add-on {
  cursor: pointer;
}
.bootstrap-timepicker .add-on i {
  display: inline-block;
  width: 16px;
  height: 16px;
}
.bootstrap-timepicker-widget.dropdown-menu {
  padding: 4px;
}
.bootstrap-timepicker-widget.dropdown-menu.open {
  display: inline-block;
}
.bootstrap-timepicker-widget.dropdown-menu:before {
  border-bottom: 7px solid rgba(0, 0, 0, 0.2);
  border-left: 7px solid transparent;
  border-right: 7px solid transparent;
  content: "";
  display: inline-block;
  position: absolute;
}
.bootstrap-timepicker-widget.dropdown-menu:after {
  border-bottom: 6px solid #FFFFFF;
  border-left: 6px solid transparent;
  border-right: 6px solid transparent;
  content: "";
  display: inline-block;
  position: absolute;
}
.bootstrap-timepicker-widget.timepicker-orient-left:before {
  left: 6px;
}
.bootstrap-timepicker-widget.timepicker-orient-left:after {
  left: 7px;
}
.bootstrap-timepicker-widget.timepicker-orient-right:before {
  right: 6px;
}
.bootstrap-timepicker-widget.timepicker-orient-right:after {
  right: 7px;
}
.bootstrap-timepicker-widget.timepicker-orient-top:before {
  top: -7px;
}
.bootstrap-timepicker-widget.timepicker-orient-top:after {
  top: -6px;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:before {
  bottom: -7px;
  border-bottom: 0;
  border-top: 7px solid #999;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:after {
  bottom: -6px;
  border-bottom: 0;
  border-top: 6px solid #ffffff;
}
.bootstrap-timepicker-widget a.btn,
.bootstrap-timepicker-widget input {
  border-radius: 4px;
}
.bootstrap-timepicker-widget table {
  width: 100%;
  margin: 0;
}
.bootstrap-timepicker-widget table td {
  text-align: center;
  height: 30px;
  margin: 0;
  padding: 2px;
}
.bootstrap-timepicker-widget table td:not(.separator) {
  min-width: 30px;
}
.bootstrap-timepicker-widget table td span {
  width: 100%;
}
.bootstrap-timepicker-widget table td a {
  border: 1px transparent solid;
  width: 100%;
  display: inline-block;
  margin: 0;
  padding: 8px 0;
  outline: 0;
  color: #333;
}
.bootstrap-timepicker-widget table td a:hover {
  text-decoration: none;
  background-color: #eee;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  border-color: #ddd;
}
.bootstrap-timepicker-widget table td a i {
  margin-top: 2px;
  font-size: 18px;
}
.bootstrap-timepicker-widget table td input {
  width: 25px;
  margin: 0;
  text-align: center;
}
.bootstrap-timepicker-widget .modal-content {
  padding: 4px;
}
@media (min-width: 767px) {
  .bootstrap-timepicker-widget.modal {
	width: 200px;
	margin-left: -100px;
  }
}
@media (max-width: 767px) {
  .bootstrap-timepicker {
	width: 100%;
  }
  .bootstrap-timepicker .dropdown-menu {
	width: 100%;
  }
}



.input-group.date .input-group-addon {
  cursor: pointer;
}
.datepicker td,
.daterangepicker td,
.datepicker th,
.daterangepicker th {
  border-radius: 0 !important;
  font-size: 13px;
}
.datepicker td.active,
.daterangepicker td.active,
.datepicker td.active:hover,
.daterangepicker td.active:hover {
  background: #2283c5 !important;
}
.datepicker td.active.disabled,
.daterangepicker td.active.disabled,
.datepicker td.active.disabled:hover,
.daterangepicker td.active.disabled:hover {
  background: #8b9aa3 !important;
}
.datepicker td,
.datepicker th {
  min-width: 32px;
}
.datepicker-dropdown.datepicker-orient-bottom:after,
.datepicker-dropdown.datepicker-orient-bottom:before {
  top: auto;
}
.daterangepicker .calendar-date {
  border-radius: 0;
}
.datepicker-months .month,
.datepicker-years .year {
  border-radius: 0 !important;
}
.datepicker-months .month.active,
.datepicker-years .year.active,
.datepicker-months .month.active:hover,
.datepicker-years .year.active:hover,
.datepicker-months .month.active:focus,
.datepicker-years .year.active:focus,
.datepicker-months .month.active:active,
.datepicker-years .year.active:active {
  background-image: none !important;
  background-color: #2283c5 !important;
}
.bootstrap-timepicker-widget table td input {
  width: 32px;
}
.well .datepicker table tr td.day:hover {
  background-color: #7d8893;
  color: #FFF;
}
.bootstrap-timepicker-widget table td a:hover {
  border-radius: 0;
}
.daterangepicker.opensleft:before,
.daterangepicker.opensright:before {
  -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
}
.daterangepicker.opensleft:after,
.daterangepicker.opensright:after {
  -moz-border-bottom-colors: #fff;
}
.datepicker-dropdown:before {
  -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
}
.datepicker-dropdown:after {
  -moz-border-bottom-colors: #fff;
}
.datepicker-dropdown.datepicker-orient-bottom:before {
  -moz-border-top-colors: #999;
}
.datepicker-dropdown.datepicker-orient-bottom:after {
  -moz-border-top-colors: #FFF;
}
.bootstrap-timepicker-widget.dropdown-menu:before {
  -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
}
.bootstrap-timepicker-widget.dropdown-menu:after {
  -moz-border-bottom-colors: #FFF;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:before {
  -moz-border-top-colors: #999;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:after {
  -moz-border-top-colors: #FFF;
}
.bootstrap-datetimepicker-widget [class=btn] {
  border-width: 0 !important;
  background-color: transparent !important;
  color: #7399b8 !important;
  text-shadow: none !important;
}
.bootstrap-datetimepicker-widget [class=btn]:hover {
  color: #1B6AAA !important;
}
.bootstrap-datetimepicker-widget .btn.btn-primary {
  border-width: 3px !important;
}
.bootstrap-datetimepicker-widget .picker-switch {
  margin-bottom: 2px;
}
.bootstrap-datetimepicker-widget .picker-switch .btn {
  width: 90% !important;
  background-color: #EEE !important;
  color: #478fca !important;
  font-size: 16px;
}
.bootstrap-datetimepicker-widget .picker-switch .btn:hover {
  background-color: #e3edf5 !important;
}
.bootstrap-datetimepicker-widget td span {
  border-radius: 0;
}
.bootstrap-datetimepicker-widget .timepicker-hour,
.bootstrap-datetimepicker-widget .timepicker-minute,
.bootstrap-datetimepicker-widget .timepicker-second {
  color: #555 !important;
}





.datepicker td,
.daterangepicker td,
.datepicker th,
.daterangepicker th {
  border-radius: 0 !important;
  font-size: 13px;
}
.datepicker td.active,
.daterangepicker td.active,
.datepicker td.active:hover,
.daterangepicker td.active:hover {
  background: #2283c5 !important;
}
.datepicker td.active.disabled,
.daterangepicker td.active.disabled,
.datepicker td.active.disabled:hover,
.daterangepicker td.active.disabled:hover {
  background: #8b9aa3 !important;
}
.datepicker td,
.datepicker th {
  min-width: 32px;
}
.datepicker-dropdown.datepicker-orient-bottom:after,
.datepicker-dropdown.datepicker-orient-bottom:before {
  top: auto;
}
.daterangepicker .calendar-date {
  border-radius: 0;
}
.datepicker-months .month,
.datepicker-years .year {
  border-radius: 0 !important;
}
.datepicker-months .month.active,
.datepicker-years .year.active,
.datepicker-months .month.active:hover,
.datepicker-years .year.active:hover,
.datepicker-months .month.active:focus,
.datepicker-years .year.active:focus,
.datepicker-months .month.active:active,
.datepicker-years .year.active:active {
  background-image: none !important;
  background-color: #2283c5 !important;
}
.bootstrap-timepicker-widget table td input {
  width: 32px;
}
.well .datepicker table tr td.day:hover {
  background-color: #7d8893;
  color: #FFF;
}
.bootstrap-timepicker-widget table td a:hover {
  border-radius: 0;
}
.daterangepicker.opensleft:before,
.daterangepicker.opensright:before {
  -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
}
.daterangepicker.opensleft:after,
.daterangepicker.opensright:after {
  -moz-border-bottom-colors: #fff;
}
.datepicker-dropdown:before {
  -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
}
.datepicker-dropdown:after {
  -moz-border-bottom-colors: #fff;
}
.datepicker-dropdown.datepicker-orient-bottom:before {
  -moz-border-top-colors: #999;
}
.datepicker-dropdown.datepicker-orient-bottom:after {
  -moz-border-top-colors: #FFF;
}
.bootstrap-timepicker-widget.dropdown-menu:before {
  -moz-border-bottom-colors: rgba(0, 0, 0, 0.2);
}
.bootstrap-timepicker-widget.dropdown-menu:after {
  -moz-border-bottom-colors: #FFF;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:before {
  -moz-border-top-colors: #999;
}
.bootstrap-timepicker-widget.timepicker-orient-bottom:after {
  -moz-border-top-colors: #FFF;
}
.bootstrap-datetimepicker-widget [class=btn] {
  border-width: 0 !important;
  background-color: transparent !important;
  color: #7399b8 !important;
  text-shadow: none !important;
}
.bootstrap-datetimepicker-widget [class=btn]:hover {
  color: #1B6AAA !important;
}
.bootstrap-datetimepicker-widget .btn.btn-primary {
  border-width: 3px !important;
}
.bootstrap-datetimepicker-widget .picker-switch {
  margin-bottom: 2px;
}
.bootstrap-datetimepicker-widget .picker-switch .btn {
  width: 90% !important;
  background-color: #EEE !important;
  color: #478fca !important;
  font-size: 16px;
}
.bootstrap-datetimepicker-widget .picker-switch .btn:hover {
  background-color: #e3edf5 !important;
}
.bootstrap-datetimepicker-widget td span {
  border-radius: 0;
}
.bootstrap-datetimepicker-widget .timepicker-hour,
.bootstrap-datetimepicker-widget .timepicker-minute,
.bootstrap-datetimepicker-widget .timepicker-second {
  color: #555 !important;
}















.form-group select,
.form-group textarea,
.form-group input[type="text"],
.form-group input[type="password"],
.form-group input[type="datetime"],
.form-group input[type="datetime-local"],
.form-group input[type="date"],
.form-group input[type="month"],
.form-group input[type="time"],
.form-group input[type="week"],
.form-group input[type="number"],
.form-group input[type="email"],
.form-group input[type="url"],
.form-group input[type="search"],
.form-group input[type="tel"],
.form-group input[type="color"] {
  background: #FFF;
}
.form-group.has-success input,
.form-group.has-success select,
.form-group.has-success textarea {
  border-color: #9cc573;
  color: #8bad4c;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.form-group.has-success input:focus,
.form-group.has-success select:focus,
.form-group.has-success textarea:focus {
  -webkit-box-shadow: 0px 0px 0px 2px rgba(130, 188, 58, 0.3);
  box-shadow: 0px 0px 0px 2px rgba(130, 188, 58, 0.3);
  color: #6f8a3c;
  border-color: #779c52;
  background-color: #f4f9f0;
}
.form-group.has-success input:focus + .ace-icon,
.form-group.has-success select:focus + .ace-icon,
.form-group.has-success textarea:focus + .ace-icon {
  color: #8bad4c;
}
.form-group.has-success .ace-icon {
  color: #8bad4c;
}
.form-group.has-success .btn .ace-icon {
  color: inherit;
}
.form-group.has-success .control-label,
.form-group.has-success .help-block,
.form-group.has-success .help-inline {
  color: #7ba065;
}
.form-group.has-info input,
.form-group.has-info select,
.form-group.has-info textarea {
  border-color: #72aec2;
  color: #4b89aa;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.form-group.has-info input:focus,
.form-group.has-info select:focus,
.form-group.has-info textarea:focus {
  -webkit-box-shadow: 0px 0px 0px 2px rgba(58, 120, 188, 0.3);
  box-shadow: 0px 0px 0px 2px rgba(58, 120, 188, 0.3);
  color: #3b6c87;
  border-color: #488ea5;
  background-color: #f1f7f9;
}
.form-group.has-info input:focus + .ace-icon,
.form-group.has-info select:focus + .ace-icon,
.form-group.has-info textarea:focus + .ace-icon {
  color: #4b89aa;
}
.form-group.has-info .ace-icon {
  color: #4b89aa;
}
.form-group.has-info .btn .ace-icon {
  color: inherit;
}
.form-group.has-info .control-label,
.form-group.has-info .help-block,
.form-group.has-info .help-inline {
  color: #657ba0;
}
.form-group.has-error input,
.form-group.has-error select,
.form-group.has-error textarea {
  border-color: #f2a696;
  color: #d68273;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.form-group.has-error input:focus,
.form-group.has-error select:focus,
.form-group.has-error textarea:focus {
  -webkit-box-shadow: 0px 0px 0px 2px rgba(219, 137, 120, 0.3);
  box-shadow: 0px 0px 0px 2px rgba(219, 137, 120, 0.3);
  color: #ca5f4c;
  border-color: #d77b68;
  background-color: #fef9f8;
}
.form-group.has-error input:focus + .ace-icon,
.form-group.has-error select:focus + .ace-icon,
.form-group.has-error textarea:focus + .ace-icon {
  color: #d68273;
}
.form-group.has-error .ace-icon {
  color: #d68273;
}
.form-group.has-error .btn .ace-icon {
  color: inherit;
}
.form-group.has-error .control-label,
.form-group.has-error .help-block,
.form-group.has-error .help-inline {
  color: #d16e6c;
}
.form-group.has-warning input,
.form-group.has-warning select,
.form-group.has-warning textarea {
  border-color: #e3c94c;
  color: #d3bd50;
  -webkit-box-shadow: none;
  box-shadow: none;
}
.form-group.has-warning input:focus,
.form-group.has-warning select:focus,
.form-group.has-warning textarea:focus {
  -webkit-box-shadow: 0px 0px 0px 2px rgba(216, 188, 65, 0.3);
  box-shadow: 0px 0px 0px 2px rgba(216, 188, 65, 0.3);
  color: #c0a830;
  border-color: #d5b630;
  background-color: #fdfbf3;
}
.form-group.has-warning input:focus + .ace-icon,
.form-group.has-warning select:focus + .ace-icon,
.form-group.has-warning textarea:focus + .ace-icon {
  color: #d3bd50;
}
.form-group.has-warning .ace-icon {
  color: #d3bd50;
}
.form-group.has-warning .btn .ace-icon {
  color: inherit;
}
.form-group.has-warning .control-label,
.form-group.has-warning .help-block,
.form-group.has-warning .help-inline {
  color: #d19d59;
}
.form-group input[disabled],
.form-group input:disabled {
  color: #848484 !important;
  background-color: #eeeeee !important;
}

@media only screen and (max-width: 767px) {
  .help-inline,
  .input-icon + .help-inline {
	padding-left: 0;
	display: block !important;
  }
}
</style>
					 <div class="row-fluid">                      
					
						<div class="span12" style="margin-left:0px;" id="notification">
						

							<div class="box chart">
								<div class="title">
									<h4>
									<span>Set Notification</span>
									</h4>
									<a href="#" class="minimize">Minimize</a>
								</div>
								<div class="content">
								   
									<div class="row" style="margin-left:20px;">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="row">
									<div class="col-sm-12">
										<div class="space"></div>
											<a href="<?=base_url('/opportunity/appointment')?>" class="btn btn-danger pull-right" style="margin-left: 5px;">Add Event</a>
										<!-- #section:plugins/data-time.calendar -->
										<div id="calendar"></div>
										<!-- /section:plugins/data-time.calendar -->
									</div>

								<!--	<div class="col-sm-3">
										<div class="widget-box transparent">
											<div class="widget-header">
												<h4>Draggable events</h4>
											</div>

											<div class="widget-body">
												<div class="widget-main no-padding">
													<div id="external-events">
														<div class="external-event label-grey ui-draggable ui-draggable-handle" data-class="label-grey" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 1
														</div>

														<div class="external-event label-success ui-draggable ui-draggable-handle" data-class="label-success" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 2
														</div>

														<div class="external-event label-danger ui-draggable ui-draggable-handle" data-class="label-danger" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 3
														</div>

														<div class="external-event label-purple ui-draggable ui-draggable-handle" data-class="label-purple" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 4
														</div>

														<div class="external-event label-yellow ui-draggable ui-draggable-handle" data-class="label-yellow" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 5
														</div>

														<div class="external-event label-pink ui-draggable ui-draggable-handle" data-class="label-pink" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 6
														</div>

														<div class="external-event label-info ui-draggable ui-draggable-handle" data-class="label-info" style="position: relative;">
															<i class="ace-icon fa fa-arrows"></i>
															My Event 7
														</div>

														<label>
															<input type="checkbox" class="ace ace-checkbox" id="drop-remove">
															<span class="lbl"> Remove after drop</span>
														</label>
													</div>
												</div>
											</div>
										</div>
									</div>-->
								</div>

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div>
						
						
						<script>
function tConvert (time) {
	// Check correct time format and split into components
  time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
  //alert("dinkd");false;
  if (time.length > 1) { // If time format correct
	time = time.slice (1);  // Remove full string match value
	
	time[5] = +time[0] < 12 ? 'a' : 'p'; // Set AM/PM
	time[0] = +time[0] % 12 || 12; // Adjust hours
  }
  return time.join (''); // return adjusted time or original string
}
  
$(function(){
   /* initialize the calendar
	-----------------------------------------------------------------*/

	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	var val = '<?=$result?>';
	//var convert = JSON.stringify(val);
	//alert(str);
	if(val){
		var jobj =	JSON.parse(val);
		//alert(jobj);
	   
	}else{
		jobj = null;
	}
	//alert(jobj);false;
	var calendar = $('#calendar').fullCalendar({
		//isRTL: true,
		 buttonHtml: {
			prev: '<i class="ace-icon fa fa-chevron-left"></i>',
			next: '<i class="ace-icon fa fa-chevron-right"></i>'
		},
	
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},
		events: jobj
		,
		editable: true,
		droppable: true, // this allows things to be dropped onto the calendar !!!
		eventClick: function(calEvent, jsEvent, view) {
			console.log(calEvent);
			var notification = "";
			if(calEvent.notification_type == 1)
			{
				notification = "Apppointment";
			}
			else if(calEvent.notification_type == 2)
			{
				notification = "Follow Ups";
			}
			else if(calEvent.notification_type == 3)
			{
				notification = "Reminder";
			}

			if(calEvent.added_by == null)
			{
				added_by = "---";
			}
			else
			{
				added_by = calEvent.added_by;
			}
			var modal='<div class="modal fade">\
						  <div class="modal-dialog">\
						   <div class="modal-content">\
						   <div class="modal-header"><button type="button" class="bootbox-close-button close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">NOTIFICATION DETAILS</h4></div>\
							 <div class="modal-body"><div class="bootbox-body">\
							<div class="row-fluid">\
							  <form class="form-horizontal">\
								<div class="row-fluid">\
								 <div class="form-group">\
								  <label for="name" class="form-label span2" control-label"="">Type:</label>\
										<div class="row-fluid">\
										  <div class="span6 select_style_margin-left">\
											  <span>'+notification+'</span>\
										  </div>\
									  </div>\
									</div>\
							  </div>\
							<div class="row-fluid">\
						   <div class="form-group">   \
							  <label for="name" class="form-label span2" control-label"="">Title:</label>\
									<span>'+calEvent.title+'</span>\
						   </div>\
					  </div>\
										<div class="row-fluid">\
									   <div class="form-group">\
										<label for="name" class="form-label span2">Description:</label>\
										<span>'+calEvent.description+'</span>\
									   </div>\
									 </div>\
								   <div class="row-fluid">\
									  <div class="form-group" style="margin-top: 5px;">\
									   <label for="name" class="form-label span2">Time :</label>\
											<span>'+moment(calEvent.start).format('DD/MM/YYYY  h:mm:ss a')+'</span>\
											   </div>\
										</div>\
							<div class="row-fluid">\
									  <div class="form-group" style="margin-top: 5px;">\
									   <label for="name" class="form-label span2">Created At :</label>\
											<span>'+moment(calEvent.created).format('DD/MM/YYYY  h:mm:ss a')+'</span>\
											   </div>\
										</div>\
						<div class="row-fluid">\
									  <div class="form-group" style="margin-top: 5px;">\
									   <label for="name" class="form-label span2">Added By:</label>\
											<span>'+added_by+'</span>\
											   </div>\
										</div>\
								  <div class="row-fluid">\
							</div>\
						   </form>\
						   </div>\
						   </div>\
						   </div>\
						   <div class="modal-footer" style="text-align:center;">\
							<button type="button" class="btn btn-sm" data-dismiss="modal"><i class="ace-icon fa fa-times"></i> Close </button>\
						 </div>\
						   </form>\
						   </div>\
						   </div>\
						</div>';
			var modal = $(modal).appendTo('body');
			modal.find('form').on('submit', function(ev){
				ev.preventDefault();
				update_appointment($('#appointmentId').val(),$(this).find("input[type=text]").val());
				calEvent.title = $(this).find("input[type=text]").val();
				calendar.fullCalendar('updateEvent', calEvent);
				modal.modal("hide");
			});
			modal.find('button[data-action=delete]').on('click', function() {
				if(calEvent.id){
				   deleteAppointment(calEvent.id);
				}  
				calendar.fullCalendar('removeEvents' , function(ev){
					return (ev._id == calEvent._id);
				})
				modal.modal("hide");
			});
			
			modal.modal('show').on('hidden', function(){
				modal.remove();
			});


			//console.log(calEvent.id);
			//console.log(jsEvent);
			//console.log(view);

			// change the border color just for fun
			//$(this).css('border-color', 'red');

		}
	});
 
});




</script>
<!-- page specific plugin scripts -->
<!--<script src="<?php  echo SITE_PATH  ?>assets/js/jquery-ui.custom.js"></script>-->
<script src="<?php  echo SITE_PATH  ?>assets/js/jquery.ui.touch-punch.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/date-time/moment.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/fullcalendar.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/bootbox.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/date-time/bootstrap-timepicker.js"></script>
<script src="<?php  echo SITE_PATH  ?>assets/js/ace.js"></script>


								</div>
							</div>                        
						</div>						                        
					   

					</div><!-- End .row-fluid -->  
					
				<!-- Page end here -->
				
			</div><!-- End contentwrapper -->

		</div><!-- End #content -->
		
	   
		
		<!--  Start Ajax -->
 <script type="text/javascript">
	function ajaxDashboard(report_type,user_type){
		if(user_type == ''){
			return false;
		}            
		var logged_user=$("#default_user").val();
		if(!user_type){
		  user_type= $("#default_user").val(); 
		}
		if(! report_type)
			report_type = $("#tmp_report_type_select").val(); 
		
		//condition of report type with options
		var year = '';
		if(report_type == 'yearly'){
			year = $("#tmp_year_select").val(); 
		}
		var month = '';
		if(report_type == 'monthly'){
			year = $("#tmp_year_select").val(); 
			month = $("#tmp_month_select").val(); 
		}
		var start_date = '';
		var end_date = '';
		if(report_type == 'weekly'){
		   start_date = $("#startDate").val();
		   end_date = $("#endDate").val();
		}
		var min_day = '';
		var max_day = '';
		if(report_type == 'daily'){
			min_day = $("#start_date").val();
			max_day = $("#end_date").val();  
		}
		$.ajax({
			type:"POST",			
			data:token_name+"="+token_hash+"&user="+logged_user+"&year="+year+"&month="+month+"&min_day="+min_day+"&max_day="+max_day+"&start_date="+start_date+"&end_date="+end_date,
			url:"<?php echo SITE_PATH;?>dashboard/ajax_dashboard/"+report_type+"/"+user_type,
			
			beforeSend : function(){					
			 beforeAjaxResponse();
			},
			success: function(res){	
			 $("#report_by_users").hide();
			 //$("#search_button_div").removeProp("class");
			 $("#replace_div").html(res);
			 afterAjaxResponse();
			}			
		}); 
			
  }
		  
   function ajaxRtypeDashboard(report_type,user_type){ 
		var logged_user=$("#default_user").val();
		if((!user_type)||(user_type=='undefined')){
		  user_type = $("#default_user").val();  
		}		
		report_type = $("#tmp_report_type_select").val(); 
		var year = '';
		if(report_type == 'yearly'){
			var year = $("#tmp_year_select").val(); 
		}
		var month = '';
		if(report_type == 'monthly'){
			year = $("#tmp_year_select").val(); 
			month = $("#tmp_month_select").val(); 
		}
		var start_date = '';
		var end_date = '';
		if(report_type == 'weekly'){
		   start_date = $("#startDate").val();
		   end_date = $("#endDate").val();
		}	  
		var min_day = '';
		var max_day = '';
		if(report_type == 'daily'){
			min_day = $("#start_date").val();
			max_day = $("#end_date").val();  
		}
		$.ajax({
			type:"POST",
			data:token_name+"="+token_hash+"&user="+logged_user+"&year="+year+"&month="+month+"&min_day="+min_day+"&max_day="+max_day+"&start_date="+start_date+"&end_date="+end_date,			
			url:"<?php echo SITE_PATH;?>dashboard/ajax_user_dashboard/"+report_type+"/"+user_type,
			beforeSend : function(){					
			  beforeAjaxResponse();		  
			},
			success: function(res){	
			   $("#report_by_users").hide();
			   //$("#search_button_div").removeProp("class");
			   $("#replace_div").html(res);
			   afterAjaxResponse();
			}			
		}); 
		
	}
  
  //permanent select type
   $( document ).ready(function() {
		var report_type = $("#search_type").val();
		if(report_type == 'yearly'){
			$("#tmp_year_div").show();
		}
		if(report_type == 'monthly'){
			$("#tmp_year_div").show();
			$("#tmp_month_div").show();               
		}
		if(report_type == 'weekly'){
			 $("#tmp_week_div").show();			
		}
		if(report_type == 'daily'){
			$("#tmp_mindate_div").show();
			$("#tmp_maxdate_div").show();
		}
	});  
		
	$("#report_type_select").change(function(){
		var report_type = $("#report_type_select").val();
		if(report_type == 'yearly'){
			$("#year_div").show();
			$("#month_div").hide();
			$("#week_div").hide();
			$("#date_div").hide();
			$("#month_select").val('');
			$("#week_select").val('');
			$("#date_div").val('');
			
		}
		if(report_type == 'monthly'){
			$("#year_div").show();
			$("#month_div").show();
			$("#week_div").hide();
			$("#date_div").hide();
			$("#week_select").val('');
			$("#date_div").val('');
		}
		if(report_type == 'weekly'){
			$("#year_div").hide();
			$("#month_div").hide();
			$("#date_div").hide();
			$("#month_select").val('');
			$("#week_select").val('');
			$("#date_div").val('');
		}
		if(report_type == 'daily'){
			$("#year_div").hide();
			$("#month_div").hide();
			$("#week_div").hide();
			$("#date_div").hide();			
			$("#date_div").show();			
			$("#month_select").val('');
			$("#week_select").val('');			
		}	
	});
		
		
	$("#save_button").click(function(){
		var year = $("#year_select").val();
		var month = $("#month_select").val();
		var week = 1;
		var day = $("#date_select").val();
		var search_type = $("#report_type_select").val();
			$.ajax({
			type:"POST",
			data:token_name+"="+token_hash+"&search_type="+search_type+"&year="+year+"&month="+month+"&day="+day,			
			url:"<?php echo SITE_PATH;?>dashboard/set_dashboard_report/",
			success: function(data){				    
				//$('#pt_report_type_div').hide();
				$('#report_type_show').show();
				$('#report_type_hide').hide(); 
				$('#pt_report_type_success').slideDown();
				//setInterval(function(){  $('#pt_report_type_success').slideUp(); }, 3000);
				
			}			
		});            
	});
   //permanent select type        
		$("#tmp_report_type_select").change(function(){
			var report_type = $("#tmp_report_type_select").val();
		 
			if(report_type == 'yearly')
			{
				$("#tmp_year_div").show();
				$("#tmp_month_div").hide();
				$("#tmp_week_div").hide();
				$("#tmp_mindate_div").hide();
				$("#tmp_maxdate_div").hide();
				
				$("#tmp_month_select").val('');
				$("#tmp_week_select").val('');
			   
				
			}
			if(report_type == 'monthly')
			{
				$("#tmp_year_div").show();
				$("#tmp_month_div").show();
				$("#tmp_week_div").hide();
				$("#tmp_mindate_div").hide();
				$("#tmp_maxdate_div").hide();
			}
			if(report_type == 'weekly')
			{
				$("#tmp_year_div").hide();
				$("#tmp_month_div").hide();
				$("#tmp_week_div").show();
				$("#tmp_mindate_div").hide();
				$("#tmp_maxdate_div").hide();
			}
			
			if(report_type == 'daily')
			{
				$("#tmp_year_div").hide();
				$("#tmp_month_div").hide();
				$("#tmp_week_div").hide();
				
				$("#tmp_mindate_div").show();
				$("#tmp_maxdate_div").show();
			}
			
		});
	   
	$("#report_type_show").click(function(){
		var report_type = $("#search_type").val();
		if(report_type == 'yearly'){
			$("#year_div").show();
		}
		if(report_type == 'monthly'){
			$("#year_div").show();
			$("#month_div").show();
		}                
		if(report_type == 'daily'){
			$("#date_div").show();
		}
		$('#pt_report_type_div').slideDown();
		$('#report_type_show').hide();
		$('#report_type_hide').show(); 
		$('#pt_report_type_success').hide();
	});
	
	$("#report_type_hide").click(function(){
	   $('#pt_report_type_div').slideUp();
	   $('#report_type_show').show();
	   $('#report_type_hide').hide(); 
	});
	

   </script>
  </span>

 </div>

 <script type="text/javascript">
$(function() {
	var startDate;
	var endDate;
	
	var selectCurrentWeek = function() {
		window.setTimeout(function () {
			$('.week-picker').find('.ui-datepicker-current-day a').addClass('ui-state-active')
		}, 1);
	}
	
	$('.week-picker').datepicker( {
		showOtherMonths: true,
		selectOtherMonths: true,
		onSelect: function(dateText, inst) { 
			var date = $(this).datepicker('getDate');
			startDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay());
			endDate = new Date(date.getFullYear(), date.getMonth(), date.getDate() - date.getDay() + 6);
			var dateFormat = inst.settings.dateFormat || $.datepicker._defaults.dateFormat;
			$('#startDate').val($.datepicker.formatDate( dateFormat, startDate, inst.settings ));
			$('#endDate').val($.datepicker.formatDate( dateFormat, endDate, inst.settings ));
			$('#week_input').val($.datepicker.formatDate( dateFormat, startDate, inst.settings )+ ' - ' + $.datepicker.formatDate( dateFormat, endDate, inst.settings ));
		   
			selectCurrentWeek();
		},
		beforeShowDay: function(date) {
			var cssClass = '';
			if(date >= startDate && date <= endDate)
				cssClass = 'ui-datepicker-current-day';
			return [true, cssClass];
		},
		onChangeMonthYear: function(year, month, inst) {
			selectCurrentWeek();
		}
	});
	$('.week-picker .ui-datepicker-calendar tr').live('mousemove', function() { $(this).find('td a').addClass('ui-state-hover'); });
	$('.week-picker .ui-datepicker-calendar tr').live('mouseleave', function() { $(this).find('td a').removeClass('ui-state-hover'); });
});
</script>

 <!-- Week Calender ends--> 
<script>
  $(function(){
	
	$(".erookie-setting").click(function(){
			   $("#setting").slideToggle(); 
	}); 
  });  
  
</script>      
	 
<script>

$(function(){
	
	//hide
	var arr1 = "<?php  echo $chart_string; ?>";
	arr1 = arr1.split(",");
	for(var i=0 ; i<arr1.length; i++){
				//alert(arr[i]);
				$("#"+arr1[i]).hide();
	}
	
	
	//show 
	var left = 0;
	var arr = "<?php  echo $chart_list->chart_list; ?>";
	arr = arr.split(",");
	
	for(var i=0 ; i<arr.length; i++){
		//alert(arr[i]);
		$("#"+arr[i]).show();
		if(arr[i] != 'job_order'){
			//$("#"+arr[i]).css('position','absolute');
			//$("#"+arr[i]).css('margin-left',left+'%');
			//left = left + 34;
		}
	}
	
	
});



</script>     
  

