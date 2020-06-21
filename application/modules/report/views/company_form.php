<?php    
	

	 $child_list=json_decode($this->session->userdata('child_list'));
	 $list = child_users_with_name(currentuserinfo()->id);	 
	 $userList = array_flip($list['total_list']);
	 natcasesort($userList);
?>
<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="test.js"></script>
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
					 <span>Company Report Form</span>
				</h4>
			</div>
			<div class="content">
                <?php echo form_open("$base_url/data_list", array("id" => "form")) ?>
				  
				  <div class="row-fluid">					 
					 <div class="span4">
						    <label class="span3">From Date</label>
							<input type="text" name="start_date" class="span8" id="start_date" autocomplete="off"> 
					 </div>
					 <div class="span4">
						<label class="span3">To Date</label>
						<input type="text" name="end_date" id="end_date" class="span8" autocomplete="off">
					 </div>
					 
					<div class="span4">
						<label class="span3">Type</label>
							<input type="radio" name="report_type" id="report_type" value="1"  checked />
							Self
                            <input type="radio" name="report_type" id="report_type" value="2" />
						    Team
						
					</div>

				 </div>

				 <div class="row-fluid">
					<div class="span4">
						<label class="span3">Users</label>
						<div class="span8 del" style="margin-left:0px;" >
						<select name="user_type" id="user_type" onChange="return changecompany(this.value);" class="nostyle select" >
							<option value="">Select User</option>
							<?php foreach($userList as $key=>$value){?>
								<option value="<?=$key?>"><?=$value?></option>
							<?php }?>
						</select>
						</div>
					</div>

				

					<div class="span4">
						<label class="span3" style="width:77px;">Company</label>
						<div class="span8 del" style="margin-left:0px;">
						<select id="company" name="company" onChange="return changecontact(this.value);" class="nostyle select">							
							 <option value="">Select Company</option>
							 <?php
								foreach($company as $key=>$value){
							 ?>
									<option value="<?=$value->company_id?>"><?=$value->name?></option>
							 <?php }?>

						</select>
						</div>
					</div> 

					<div class="span4">
						<label class="span3">Contact</label>
						<div class="span8 del" style="margin-left:0px;">
						<select id="contact" name="contact" class="nostyle select">							
							 <option value="">Select Contact</option>							 
						</select>
						</div>
					</div> 

					
				</div>
                
                
				 <div class="form-row row-fluid">
					<div class="span4">   
                           <label class="span3">List Type :</label>
                            
                        <input type="radio" name="list_type" id="list_type" value="1" checked="true" />Detailed
						<input type="radio" name="list_type" id="list_type" value="2"  />Total
                     </div>
					
					

				 </div>

				 <div class="row-fluid">
					<div class="form-actions">
						<div class="span12 controls">
							<input type="hidden" name="default_user" id="default_user" value="<?=currentuserinfo()->id?>">
							<button type="button" class="btn btn-info" onClick="return generateReport();">Search</button>
						</div>
					</div>					
				</div>


            </form>
		</div>
    </div>
  </div>
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
function changecontact(id){
		$.ajax({
			type:"post",
            data:token_name+"="+token_hash,
			url:"<?php echo SITE_PATH;?>report/company/users_contact/"+id,
			
			beforeSend : function(){					
			   $('#contact').html('<div style="min-height:30px;padding-left:400px;"><img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin-top: 15px;" width="20px"></div>');
			},
			success: function(res){
				$('#uniform-contact span').text('Select Contact');
				$('#contact').html(res);
			}
		});
}
  function changecompany(id){
	   $.ajax({
			type:"post",
            data:token_name+"="+token_hash,
			url:"<?php echo SITE_PATH;?>report/company/users_company/"+id,
			
			beforeSend : function(){					
			   $('#company').html('<div style="min-height:30px;padding-left:400px;"><img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin-top: 15px;" width="20px"></div>');
			},
			success: function(res){
				$('#uniform-company span').text('Select Company');
				$('#uniform-contact span').text('Select Contact');
				$('#company').html(res);
			}
		});
  }
	function generateReport(offset,perpage){
	   
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
		
		//var displayColumn = $.map($('#box1View option'), function(e) { return e.value; });//get list of all items whether selected or not

		//var displayColumn=$('#box1View').val(); //get list of all selected items

		var user_type=$('#user_type').val();		
		var company=$('#company').val();		

		var contact=$('#contact').val();		
		
		if(user_type==''){
			user_type=$('#default_user').val();
		}
		var report_type =$('input:radio[name=report_type]:checked').val();
         var list_type = $('input:radio[name=list_type]:checked').val();
        
        var getLoadedPipeline=$("#total_pipe").val();
         var getLoadedService=$("#total_service").val();
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
			data:token_name+"="+token_hash+"&start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&company="+company+"&contact="+contact+"&list_type="+list_type+"&getLoadedService="+getLoadedService+"&getLoadedPipeline="+getLoadedPipeline+"&getLoadedSubmittal="+getLoadedSubmittal+"&getLoadedJoin="+getLoadedJoin
                     +"&getLoadedScReject="+getLoadedScReject+"&getLoadedInterview="+getLoadedInterview+"&getLoadedInterviewReject="+getLoadedInterviewReject
                     +"&getLoadedNoContact="+getLoadedNoContact+"&getLoadedOffered="+getLoadedOffered+"&getLoadedOfferedDecline="+getLoadedOfferedDecline+"&getLoadedSalesReject="+getLoadedSalesReject,
			url:"<?php echo SITE_PATH;?>report/company/ajax_list_items/"+offset+"/"+perpage,
			
			beforeSend : function(){					
			  beforeAjaxResponse();
			},
			success: function(res){
                 $("#page_perpage").val(perpage);
                 $("#page_offset").val(offset);
                 $('#replace').html(res);
                 afterAjaxResponse();
			}
		});
   }
   
   	function loadgenerateReport(offset,perpage){
	   
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
		
		//var displayColumn = $.map($('#box1View option'), function(e) { return e.value; });//get list of all items whether selected or not

		//var displayColumn=$('#box1View').val(); //get list of all selected items

		var user_type=$('#user_type').val();		
		var company=$('#company').val();		

		var contact=$('#contact').val();		
		
		if(user_type==''){
			user_type=$('#default_user').val();
		}
		var report_type =$('input:radio[name=report_type]:checked').val();
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
        

		$.ajax({
			type:"post",
			data:token_name+"="+token_hash+"&start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&company="+company+"&contact="+contact+"&list_type="+list_type+"&getLoadedService="+getLoadedService+"&getLoadedPipeline="+getLoadedPipeline+"&getLoadedSubmittal="+getLoadedSubmittal+"&getLoadedJoin="+getLoadedJoin
                     +"&getLoadedScReject="+getLoadedScReject+"&getLoadedInterview="+getLoadedInterview+"&getLoadedInterviewReject="+getLoadedInterviewReject
                     +"&getLoadedNoContact="+getLoadedNoContact+"&getLoadedOffered="+getLoadedOffered+"&getLoadedOfferedDecline="+getLoadedOfferedDecline+"&getLoadedSalesReject="+getLoadedSalesReject
                      +"&getLoadedServiceLast="+getLoadedServiceLast+"&getLoadedPipelineLast="+getLoadedPipelineLast+"&getLoadedSubmittalLast="+getLoadedSubmittalLast+"&getLoadedJoinLast="+getLoadedJoinLast
                     +"&getLoadedScRejectLast="+getLoadedScRejectLast+"&getLoadedInterviewLast="+getLoadedInterviewLast+"&getLoadedInterviewRejectLast="+getLoadedInterviewRejectLast
                     +"&getLoadedNoContactLast="+getLoadedNoContactLast+"&getLoadedOfferedLast="+getLoadedOfferedLast+"&getLoadedOfferedDeclineLast="+getLoadedOfferedDeclineLast+"&getLoadedSalesRejectLast="+getLoadedSalesRejectLast+"&prev_page="+prev_page,
			url:"<?php echo SITE_PATH;?>report/company/ajax_list_items/"+offset+"/"+perpage,
			
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

    <div class="span7">
		<button id="company_listing_export" type="button" class="btn-success"><?=lang('company_export')?></button></button>
    </div>
    <div class="span3 del">
		<select class="select nostyle" onchange="generateReport('select',this.value)">
		<?php
							   $resume=resume_per_page();
							   foreach($resume as  $key=>$val){
							?>
								<option value="<?=$val?>" <?php if($val==$limit){?> selected="true" <?php } ?> >
									<?=$val?>
								</option>   
		<?php }?>
		</select>
		<?php
			$this->load->view('pagination');
		?>
    </div>

</div>

<?php }?>

<div class="tableBg">
<table width="100%">
	<tr >
	   <th class="th" style="width: 7%;">
			<a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Job Order Id">Job Id</a>
	   </th>
	   <th class="th" style="width: 10%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Company">Company</a></th>

	   <th class="th" style="width: 10%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Contact">Contact</a></th>

	   <th class="th" style="width: 10%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="User Name">User Name</a></th>
	   <th class="th" style="width: 8%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Activity Date">Date</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Serviced Job">S.J</a></th>
	   <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Pipeline">Pipe</a></th>
	   <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Submittal">Sub</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Join">Join</a></th>
	   <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Screen Reject">Sc. R.</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Interview">IW</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Interview Reject">I. R.</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="No Contact">No C.</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Offered">Offer</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Offered Declined">O. D.</a></th>
       <th class="th" style="width: 5%;" ><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Sales Reject">S.Rj.</a></th>
     </tr>      

	<?php
     $total_service=0;
	 $total_pipe=0;
     $total_sub =0;
     $total_join=0;
     $total_screen_reject=0;
     $total_interview=0;
     $total_interview_reject=0;
     $total_no_contact=0;
     $total_offered=0;
     $total_offered_decline=0;
     $total_sales_reject=0;
	  if($result){		 
		foreach($result as $key=>$value){			
				$index=$key;
				$index++;
				$pipeline=get_final_joborder_pipeline($value->job_id);
				$total_pipe+=$pipeline;
                $submittal=get_final_joborder_submittal($value->job_id);
				$total_sub+=$submittal;
                $check_serviced = $pipeline+$submittal;
                $serviced = ($check_serviced>0)? 1:0;
                $total_service+= $serviced;
                $candidate_join=get_final_joborder_data('11',$value->job_id);
                $total_join+=$candidate_join;
                $candidate_screen_reject=get_final_joborder_data('10',$value->job_id);
                $total_screen_reject+=$candidate_screen_reject;
                $candidate_interview=get_final_joborder_data('6',$value->job_id);
                $total_interview+=$candidate_interview;
                $candidate_interview_reject=get_final_joborder_data('3',$value->job_id);
                $total_interview_reject+=$candidate_interview_reject;
                $candidate_no_contact=get_final_joborder_data('1',$value->job_id);
                $total_no_contact+=$candidate_no_contact;
                $candidate_offered=get_final_joborder_data('7',$value->job_id);
                $total_offered+=$candidate_offered;
                $candidate_offered_decline=get_final_joborder_data('9',$value->job_id);
                $total_offered_decline+=$candidate_offered_decline;
                $candidate_sales_reject=get_final_joborder_data('2',$value->job_id);
                $total_sales_reject+=$candidate_sales_reject;
	?>
	
		<tr class="msg_box" id="<?=$index?>">
		  <!--
 <td width='6%'> <?=$index?></td>
-->
		   <td width='7%'> <?=$value->job_id?></td>
		   <td width='13%'><a href="<?=$base_url.'/'.$value->job_id.'/'.$value->company_id?>"> <?=$value->company?></a></td>
		   <td width='10%'>  <?=$value->contact?> </td>

		   <td width='10%'> <?=$value->first_name.' '.$value->last_name?></td>

		   <td width='8%'> <?=date("d/m/Y",strtotime($value->modified_time))?></td>
           <td width='5%'> <?=$serviced?></td>
		   <td width='5%'> <?=$pipeline?></td>
		   <td width='5%'> <?=get_final_joborder_submittal($value->job_id)?></td>
           <td width="5%"><?=$candidate_join?></td>
    	   <td  width="5%"><?=$candidate_screen_reject?></td>
           <td  width="5%"><?=$candidate_interview?></td>
           <td  width="5%"><?=$candidate_interview_reject?></td>
           <td  width="5%"><?=$candidate_no_contact?></td>
           <td  width="5%"><?=$candidate_offered?></td>
           <td  width="5%"><?=$candidate_offered_decline?></td>
           <td  width="5%"><?=$candidate_sales_reject?></td>
		</tr>
	 <?php
	     }
	 ?>

	<?php
		}else{
		echo "<tr>";
			echo '<td colspan="7" style="border:1px #ccc solid; min-height:10px;width:1090px;padding:7px 7px 7px 435px; font-weight:bold;background:#fff;">'.lang('no_record').'</td>';
		echo "</tr>";
		}
    ?>

 </table>
 
</div> 


 <table>
 <tr >
		   <td style="width: 45%; text-align: center; font-weight: bold;">Total</td>
           <td style="width: 5%;font-weight: bold;"> <span id="total_pipe_span"><?=$total_service?></span></td>
		   <td style="width: 5%;font-weight: bold;"> <span id="total_pipe_span"><?=$total_pipe?></span></td>
		   <td style="width: 5%;font-weight: bold;"><span id="total_sub_span"><?=$total_sub?></span></td>
           <td style="width: 5%;font-weight: bold;"><span id="total_join_span"><?=$total_join?></span></td>
    	   <td  style="width: 5%;font-weight: bold;"><span id="total_screen_reject_span"><?=$total_screen_reject?></span></td>
           <td  style="width: 5%;font-weight: bold;"><span id="total_interview_span"><?=$total_interview?></span></td>
           <td  style="width: 5%;font-weight: bold;"><span id="total_interview_reject_span"><?=$total_interview_reject?></span></td>
           <td  style="width: 5%;font-weight: bold;"><span id="total_no_contact_span"><?=$total_no_contact?></td>
           <td  style="width: 5%;font-weight: bold;"><span id="total_offered_span"><?=$total_offered?></span></td>
           <td  style="width: 5%;font-weight: bold;"><span id="total_offered_decline_span"><?=$total_offered_decline?></span></td>
             <td  style="width: 5%;font-weight: bold;"><span id="total_sales_reject_span"><?=$total_sales_reject?></span></td>
           
		</tr>
        </table>
        
 
<script type="text/javascript">
$(document).ready(function(){
	
            generateReport();

		$("#company_listing_export").click(function(){
            var start_date=$('#start_date').val();
			var end_date=$('#end_date').val();
			var company = $("#company").val();
			var contact = $("#contact").val();
			var user_type=$('#user_type').val();
			if(user_type==''){
				user_type=$('#default_user').val();
			}			
  	      
		  var report_type =$('input:radio[name=report_type]:checked').val();		
		  counter=0;
          location.href="<?php echo SITE_PATH;?>report/company/export/?start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&company="+company+"&contact="+contact;
        });


	  });
</script>

<!-- End Replace div-->
</div>