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
<script type="text/javascript">
    $(document).ready(function() {
        $('.tip').qtip({
                content: false,
                position: {
                my: 'bottom center',
                at: 'top center',
                viewport: $(window)
            },
            style: {
                classes: 'ui-tooltip-tipsy'
            }
        });
    });
</script>

<div class="tableBg">
<table width="100%">
<?php

$result = 1;
 if($result){ ?>
	<tr>
     <th class="th" style="width: 10%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Serviced Job">Serviced Job</a></th>
	   <th class="th" style="width: 8%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Pipeline">Pipeline</a></th>
	   <th class="th" style="width: 8%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Submittal">Submittal</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Join">Join</a></th>
	   <th class="th" style="width: 10%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Screen Reject">Screen Reject</a></th>
       <th class="th" style="width: 8%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Interview">Interview</a></th>
       <th class="th" style="width: 15%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Interview Reject">Interview Reject</a></th>
       <th class="th" style="width: 10%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="No Contact">No Contact</a></th>
       <th class="th" style="width: 8%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Offered">Offered</a></th>
       <th class="th" style="width: 13%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Offered Declined">Offered Declined</a></th>
       <th class="th" style="width: 10%;" ><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Sales Reject">S.Reject</a></th>
    </tr>      
     
	 
<?php } ?>

	<?php
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
     $index=1;
    
	  if($result){		
	              $serviced=get_final_joborder_serviced($start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
			      $pipeline=get_total_job_order_value(0,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
			      $submittal=get_total_job_order_value(5,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_join=get_total_job_order_value(11,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_screen_reject=get_total_job_order_value(10,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_interview=get_total_job_order_value(6,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_interview_reject=get_total_job_order_value(3,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_no_contact=get_total_job_order_value(1,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_offered=get_total_job_order_value(7,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_offered_decline=get_total_job_order_value(9,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
                  $candidate_sales_reject=get_total_job_order_value(2,$start_date,$end_date,$user_list,$user_id,$report_type,$company,$contact);
 
                
	?>
		<tr class="msg_box" id="<?=$index?>">
         <td><?=$serviced?></td>
		 <td style="width: 5%;"> <?=$pipeline?></td>
		 <td style="width: 5%;"> <?=$submittal?></td>
         <td style="width: 5%;"><?=$candidate_join?></td>
    	 <td  style="width: 5%;"><?=$candidate_screen_reject?></td>
         <td  style="width: 5%;"><?=$candidate_interview?></td>
         <td  style="width: 5%;"><?=$candidate_interview_reject?></td>
         <td  style="width: 5%;"><?=$candidate_no_contact?></td>
         <td  style="width: 5%;"><?=$candidate_offered?></td>
         <td  style="width: 5%;"><?=$candidate_offered_decline?></td>
         <td  style="width: 5%;"><?=$candidate_sales_reject?></td>
          
           

		</tr>
	
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
	