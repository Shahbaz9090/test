<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />
<?php
	 $child_list=json_decode($this->session->userdata('child_list'));
	 $list = child_users_with_name(currentuserinfo()->id);	 
	 $userList = array_flip($list['total_list']);
     natcasesort($userList);
	 
?>

<script type="text/javascript">	
$(function() {
		var dates = $( "#start_date, #end_date" ).datepicker({
			defaultDate: "+1w",			
			changeMonth: true,
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



<div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="title">
				<h4>
					 <span>Job Order Report Form</span>
				</h4>
			</div>
			<div class="content">
            <?php echo form_open("$base_url/data_list", array("id"=>"form"))  ?>
			<div style="background:white;min-height:70px;">			
				
				
				<div style="margin-bottom:15px;">				  
					<div style="margin-left: 45px;">
						From Date <input type="text" name="start_date" class="" id="start_date" style="margin-left:34px;" autocomplete="off"> 
					</div>
					<div style="margin-left: 385px; margin-top: -35px;">
						To Date <input type="text" name="end_date" id="end_date" autocomplete="off" style="margin-left:10px;"> 
					</div>
					
					<div style="margin-left:680px; margin-top: -30px;">
						Report Type <input type="radio" name="report_type" id="report_type" value="1">Self
						<input type="radio" name="report_type" id="report_type" value="2" checked >Team
					</div>				 
				</div>
				
				<div  class="row-fluid">
						<label style="margin-left:43px; float:left; width:100px" class="form-label" for="normal">Report By Users</label>
						<div  class="del span2" style="margin-left: 3px; width:217px;">						  
							<select name="user_type" id="user_type" class="nostyle select" >
								<option value="">Select</option>
								<?php foreach($userList as $key=>$value){?>
									<option value="<?=$key?>"><?=$value?></option>
								<?php }?>
							</select>
							</div>
							<div class="span4" style="margin-left:24px;">
                            List Type 
                            
                        <input type="radio" name="list_type" id="list_type" value="1" checked="true" />Detailed
						<input type="radio" name="list_type" id="list_type" value="2"  />Total
                            
                            								
							
						</div>
				</div>	
				<input type="hidden" name="default_user" id="default_user" value="<?=currentuserinfo()->id?>">
			
			
			


					   

			<div class="form-row row-fluid">
				<div class="span12">
					<div class="leftBox">    
                    <select id="box2View" multiple="multiple" class="multiple nostyle" name="datafields[]" style="width:317px;">
							<option value="job_order.title">Title</option>
							
							
							<!-- <?php
								$perm= _check_perm();
								if($perm==1){
							?>
								<option value="contact">Contact</option>
								<option value="company">Company</option>
							<?php
								}else{
									if((@$perm['company']['add'])||(@$perm['company']['all_view'])){
							?>
								<option value="contact">Contact</option>
								<option value="company">Company</option>
							<?php
									}
								}
							?> -->
							<option value="contact">Contact</option>
							<option value="company">Company</option>

							<option value="owner">Owner</option>
                            <option value="recruiter">Recruiter Name</option>							
							<option value="submitted">Submitted</option> 
                            <option value="serviced">Serviced Job</option>      
							<option value="pipeline">Pipeline</option>
							<option value="job_order.openings">Openings</option>
							<option value="job_order.modified_time">Post Date</option>
                            <option value="sceen_reject">Client Screen Reject</option>      
							<option value="interview">Interview</option>      
							<option value="interview_reject">Interview Reject</option>      
							<option value="no_contact">No Contact</option>      
							<option value="sales_reject">Sales Reject</option>      
							<option value="offered">Offered</option>      
							<option value="offered_decline">Offered Declined</option>      
							<option value="candidate_join">Candidate Join</option>      
							
							

						</select>
						<br/>
						<span id="box1Counter" class="count"></span>						
						<div class="dn">
							<select id="box1Storage" name="box1Storage" class="nostyle"></select>
						</div>
						
					</div>
						
					<div class="dualBtn">						
						<button id="to1" type="button" class="btn" ><i class="icon-chevron-right"></i></button>
					<!--	<button id="allTo2" type="button" class="btn" ><span class="icon12 iconic-icon-last"></span></button>-->
						<button id="to2" type="button" class="btn">
							<i class="icon-chevron-left"></i>
						</button>
					<!--	<button id="allTo1" type="button"class="btn marginT5" ><span class="icon12 iconic-icon-first"></span></button>		-->				
					</div>
						
					<div class="rightBox">
                                                                    
						<select id="box1View" multiple="multiple" class="multiple nostyle" ></select><br/>
						<span id="box2Counter" class="count"></span>						
						<div class="dn"><select id="box2Storage" class="nostyle"></select></div>
					</div>
                     
				</div> 
                
			</div>
			
			<div class="row-fluid">
				<div class="form-actions">
					<div class="span12 controls">
						<button type="button" class="btn btn-primary" onClick="return generateReport();">Search</button>
					</div>
				</div>					
			</div>


		  </form>			

			</div>
		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->
</div>

<span id="reload"></span>
<input type="hidden" id="page_offset" value="1" />
<input type="hidden" id="page_perpage" value="30" />

<input type="hidden" name="total_service" id="total_service" value="0"/>
<input type="hidden" name="total_pipe" id="total_pipe" value="0"/>
 <input type="hidden" name="total_sub1" id="total_sub" value="0"/>
 <input type="hidden" name="total_join1" id="total_join" value="0"/>
 <input type="hidden" name="total_screen_reject1" id="total_screen_reject" value="0"/>
 <input type="hidden" name="total_interview1" id="total_interview" value="0"/>
 <input type="hidden" name="total_interview_reject1" id="total_interview_reject" value="0"/>
 <input type="hidden" name="total_no_contact1" id="total_no_contact" value="0"/>
 <input type="hidden" name="total_offered1" id="total_offered" value="0"/>
 <input type="hidden" name="total_offered_decline1" id="total_offered_decline" value="0"/>
 <input type="hidden" name="total_sales_reject1" id="total_sales_reject" value="0"/>
 


<script type="text/javascript">
	function generateReport(offset,perpage){
	   //alert(offset+' ='+perpage);
	   if(! offset)
       {
        offset=1;
       }
      if(offset=='select')
      {
        offset=1;
      }
      if(! perpage)
       perpage=$("#page_perpage").val();
      
      
       
		var start_date=$('#start_date').val();
		var end_date=$('#end_date').val();
       
        var fields = [];
         var max_view_total=0;
        $('#box1View option').each(function() {
            var count_attr=$('#box1View option').length;
            if(count_attr >8)
            {
               max_view_total=1;
            }
           
            fields.push($(this).val());
        });
        
       	var user_type=$('#user_type').val();		
	
    	if(user_type==''){
			user_type=$('#default_user').val();
		}
		var report_type = $('input:radio[name=report_type]:checked').val();
        var list_type = $('input:radio[name=list_type]:checked').val();
        
       var getLoadedService=$("#total_service").val();
        var getLoadedPipeline=$("#total_pipe").val();
        var getLoadedSubmittal=$("#total_sub").val();
        var getLoadedJoin=$("#total_join").val();
        var getLoadedScReject=$("#total_screen_reject").val();
        var getLoadedInterview=$("#total_interview").val();
        var getLoadedInterviewReject=$("#total_interview_reject").val();
        var getLoadedNoContact=$("#total_no_contact").val();
        var getLoadedOffered=$("#total_offered").val();
        var getLoadedOfferedDecline=$("#total_offered_decline").val();
        var getLoadedSalesReject=$("#total_sales_reject").val();
        
		
		$.ajax({
			type:"post",
			data:token_name+"="+token_hash+"&start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&list_type="+list_type+"&fields="+fields
                     +"&getLoadedService="+getLoadedService+"&getLoadedPipeline="+getLoadedPipeline+"&getLoadedSubmittal="+getLoadedSubmittal+"&getLoadedJoin="+getLoadedJoin
                     +"&getLoadedScReject="+getLoadedScReject+"&getLoadedInterview="+getLoadedInterview+"&getLoadedInterviewReject="+getLoadedInterviewReject
                     +"&getLoadedNoContact="+getLoadedNoContact+"&getLoadedOffered="+getLoadedOffered+"&getLoadedOfferedDecline="+getLoadedOfferedDecline+"&getLoadedSalesReject="+getLoadedSalesReject+"&max_view_total="+max_view_total,
			url:"<?php echo SITE_PATH;?>report/job_order/data_list/"+offset+"/"+perpage,
			
			beforeSend : function(){					
			     beforeAjaxResponse();
            },
			success: function(res){
			     $("#page_offset").val(offset);
                 $("#page_perpage").val(perpage);
                 $('#replace').html(res);
                 afterAjaxResponse();
			}
		});
   }
   
   function loadgenerateReport(offset,perpage){
	   //alert(offset+' ='+perpage);
	   if(! offset)
       {
        offset=1;
       }
      if(offset=='select')
      {
        offset=$("#page_offset").val();
      }
      if(! perpage)
       perpage=$("#page_perpage").val();
      
      
       
		var start_date=$('#start_date').val();
		var end_date=$('#end_date').val();
       
        var fields = [];
        var max_view_total=0;
        $('#box1View option').each(function() {
            var count_attr=$('#box1View option').length;
            if(count_attr >8)
            {
               max_view_total=1;
            }
           
            fields.push($(this).val());
        });
        
       	var user_type=$('#user_type').val();		
	
    	if(user_type==''){
			user_type=$('#default_user').val();
		}
		var report_type = $('input:radio[name=report_type]:checked').val();
        var list_type = $('input:radio[name=list_type]:checked').val();
        
         var getLoadedService=$("#total_service1").val();
        var getLoadedPipeline=$("#total_pipe1").val();
        var getLoadedSubmittal=$("#total_sub1").val();
        var getLoadedJoin=$("#total_join1").val();
        var getLoadedScReject=$("#total_screen_reject1").val();
        var getLoadedInterview=$("#total_interview1").val();
        var getLoadedInterviewReject=$("#total_interview_reject1").val();
        var getLoadedNoContact=$("#total_no_contact1").val();
        var getLoadedOffered=$("#total_offered1").val();
        var getLoadedOfferedDecline=$("#total_offered_decline1").val();
        var getLoadedSalesReject=$("#total_sales_reject1").val();
        
        //store last value
        
        var getLoadedServiceLast=$("#last_total_service").val();
        var getLoadedPipelineLast=$("#last_total_pipe").val();
        var getLoadedSubmittalLast=$("#last_total_sub").val();
        var getLoadedJoinLast=$("#last_total_join").val();
        var getLoadedScRejectLast=$("#last_total_screen_reject").val();
        var getLoadedInterviewLast=$("#last_total_interview").val();
        var getLoadedInterviewRejectLast=$("#last_total_interview_reject").val();
        var getLoadedNoContactLast=$("#last_total_no_contact").val();
        var getLoadedOfferedLast=$("#last_total_offered").val();
        var getLoadedOfferedDeclineLast=$("#last_total_offered_decline").val();
        var getLoadedSalesRejectLast=$("#last_total_sales_reject").val();
        
        var prev_page=$("#prev_page").val();
		//alert(getLoadedPipelineLast);
		$.ajax({
			type:"post",
			data:token_name+"="+token_hash+"&start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&list_type="+list_type+"&fields="+fields
                     +"&getLoadedService="+getLoadedService+"&getLoadedPipeline="+getLoadedPipeline+"&getLoadedSubmittal="+getLoadedSubmittal+"&getLoadedJoin="+getLoadedJoin
                     +"&getLoadedScReject="+getLoadedScReject+"&getLoadedInterview="+getLoadedInterview+"&getLoadedInterviewReject="+getLoadedInterviewReject
                     +"&getLoadedNoContact="+getLoadedNoContact+"&getLoadedOffered="+getLoadedOffered+"&getLoadedOfferedDecline="+getLoadedOfferedDecline+"&getLoadedSalesReject="+getLoadedSalesReject
                      +"&getLoadedServiceLast="+getLoadedServiceLast+"&getLoadedPipelineLast="+getLoadedPipelineLast+"&getLoadedSubmittalLast="+getLoadedSubmittalLast+"&getLoadedJoinLast="+getLoadedJoinLast
                     +"&getLoadedScRejectLast="+getLoadedScRejectLast+"&getLoadedInterviewLast="+getLoadedInterviewLast+"&getLoadedInterviewRejectLast="+getLoadedInterviewRejectLast
                     +"&getLoadedNoContactLast="+getLoadedNoContactLast+"&getLoadedOfferedLast="+getLoadedOfferedLast+"&getLoadedOfferedDeclineLast="+getLoadedOfferedDeclineLast+"&getLoadedSalesRejectLast="+getLoadedSalesRejectLast+"&prev_page="+prev_page+"&max_view_total="+max_view_total,
			url:"<?php echo SITE_PATH;?>report/job_order/data_list/"+offset+"/"+perpage,
			
			beforeSend : function(){					
			  beforeAjaxResponse();
			},
				
			success: function(res){
			     $("#page_offset").val(offset);
                 $("#page_perpage").val(perpage);
			     $('#replace').html(res);
                 afterAjaxResponse();
			}
		});
   }
</script>


<div id="replace">
   <style>
table
{
border-collapse:collapse;
width:100%;
background:#fff;

}
table,td
{
border: 1px solid #ccc;
padding:3px;
text-align:left;
}

table,th
{
border: 1px solid #ccc;
padding:3px;
text-align:left;
height:25px;

}

.th{background:#365B85;color:#fff;}

.tableBg{ width:100%; height:100%;}

</style>
<?php 
   if($result){	
?>

<div class="row-fluid">

    <div class="span8">
		<button id="company_listing_export" type="button" class="btn-success"><?=lang('export')?></button>
    </div>
    
	<div class="span1">
		<select onchange="generateReport('select',this.value)">
			<?php
			   $resume=resume_per_page();
			   foreach($resume as  $key=>$val){
			?>
				<option value="<?=$val?>" <?php if($val==$limit){?> selected="true" <?php } ?> >
					<?=$val?>
				</option>   
			<?php }?>
		</select>
		
	</div>
	<div class="span3">
		<?php $this->load->view('pagination')?>
	</div>

</div>

<?php }?>

<div class="tableBg">
<table width="100%">
	<tr>
	   <th class="th" width="5%">S.No.</th>
	   <th class="th" width="5%">Job Id</th>
	 <!--   <th class="th" width="17%">Job Title</th>
	  <?php
			$perm= _check_perm();
			if($perm!=1){
				if((@$perm['company']['add'])||(@$perm['company']['all_view'])){
	   ?>
			   <th class="th" width="16%">Company</th>
			   <th class="th" width="13%">Contact</th>
	   <?php
				}
			}else{
		?>
			<th class="th" width="16%">Company</th>
			<th class="th" width="13%">Contact</th>
	   <?php } ?>

	   <th class="th" width="13%">Owner</th>
	   <th class="th" width="8%">Pipeline</th>
	   <th class="th" width="8%">Submittal</th>	   		
	   <th class="th" width="8%">Openings</th>	   		
	   <th class="th" width="8%">Post Date</th> -->
	</tr>

	<?php
	 $total_pipe=0;
     $total_sub =0;
	  if($result){		 
		foreach($result as $key=>$value){			
				$index=$key;
				$index++;
				$pipeline=get_final_joborder_pipeline($value->id);				
				$total_pipe+=$pipeline;
                $submittal=get_final_joborder_submittal($value->id);
				$total_sub+=$submittal;
	?>
		<tr class="msg_box" id="<?=$index?>">

		   <td width='5%'> <?=$index?></td>
		   <td width='5%'> <?=$value->id?></td>
		<!--   <td width='17%'> <?=$value->title?></td>
		   
		   

		   <?php
			
			if($perm!=1){
				if((@$perm['company']['add'])||(@$perm['company']['all_view'])){
		   ?>
				  <td width='16%'><a href="<?=$base_url.'/'.$value->id.'/'.$value->company_id?>"> <?=$value->company?></a></td>
				  <td width='13%'> <?=$value->contact?></td>
		   <?php
					}
				}else{
			?>
				<td width='16%'><a href="<?=$base_url.'/'.$value->id.'/'.$value->company_id?>"> <?=$value->company?></a></td>
				<td width='13%'> <?=$value->contact?></td>
		   <?php } ?>


		   <td width='13%'> <?=$value->first_name.' '.$value->last_name?></td>
		   <td width='7%'> <?=$pipeline?></td>
		   <td width='8%'> <?=get_final_joborder_submittal($value->id)?></td>
		   <td width='8%'> <?=$value->openings?></td>
		   <td width='8%'> <?=date("d/m/Y",strtotime($value->modified_time))?></td>-->

		</tr>
	 <?php
	     }
	 ?>

	<?php
		}else{
		echo "<tr>";
			//echo '<td colspan="7" style="border:1px #ccc solid; min-height:10px;width:1090px;padding:7px 7px 7px 435px; font-weight:bold;background:#fff;">'.lang('no_record').'</td>';
			echo '<td colspan="7" style="border:1px #ccc solid; min-height:10px;width:1090px;padding:7px 7px 7px 435px; font-weight:bold;background:#fff;">No Record</td>';
		echo "</tr>";
		}
    ?>

 </table>
 
</div> 

<script type="text/javascript">
	$(document).ready(function(){	
	   
       generateReport();
	
		$("#company_listing_export").click(function(){
            var start_date=$('#start_date').val();
			var end_date=$('#end_date').val();
			var company = $("#company").val();
			var user_type=$('#user_type').val();
			if(user_type==''){
				user_type=$('#default_user').val();
			}			
  	      
		  var report_type =$('input:radio[name=report_type]:checked').val();		
		  counter=0;
          location.href="<?php echo SITE_PATH;?>report/job_order/report_export/?start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&company="+company;
        });
		
	});
</script>

<!-- End Replace div-->
</div>
 
