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


<div class="tableBg">
<table width="100%">
<?php

$total_result = 1;
  if($total_result){	

?>	<tr>
	   <?php
       
            echo "<th class='th' width='8%' >Total Job</th>";
            
             if(in_array("serviced",$fields)){				
				echo "<th class='th' width='7%' >Serviced Job</th>";
			  }
	    	  if(in_array("pipeline",$fields)){				
				echo "<th class='th' width='7%' >Pipeline</th>";
			  }

			  if(in_array("submitted",$fields)){				 
				 echo "<th class='th' width='7%' >Submittal</th>";
			  }

		      if(in_array("candidate_join",$fields)){				
				echo "<th class='th' width='7%' >Candidate Join</th>";
			  }
              if(in_array("sceen_reject",$fields)){				
				echo "<th class='th' width='7%' >Client Screen Reject</th>";
			  }
              if(in_array("interview",$fields)){				
				echo "<th class='th' width='7%' >Interview</th>";
			  }
              if(in_array("interview_reject",$fields)){				
				echo "<th class='th' width='12%' >Interview Reject</th>";
			  }
              if(in_array("no_contact",$fields)){				
				echo "<th class='th' width='7%' >No Contact</th>";
			  }
              if(in_array("offered",$fields)){				
				echo "<th class='th' width='7%'>Offered</th>";
			  }
              if(in_array("offered_decline",$fields)){				
				echo "<th class='th' width='11%' >Offered Declined</th>";
			  }
              if(in_array("sales_reject",$fields)){				
				echo "<th class='th' width='8%' >Sales Reject</th>";
			  }
      
	   ?>		
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
     
     
     
     if($total_result){		
                  $serviced=get_final_joborder_serviced($start_date,$end_date,$user_list,$user_id,$report_type);
	              $pipeline=get_total_job_order_value(0,$start_date,$end_date,$user_list,$user_id,$report_type);
				  $submittal=get_total_job_order_value(5,$start_date,$end_date,$user_list,$user_id,$report_type);
  				  $candidate_join=get_total_job_order_value(11,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_screen_reject=get_total_job_order_value(10,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_interview=get_total_job_order_value(6,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_interview_reject=get_total_job_order_value(3,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_no_contact=get_total_job_order_value(1,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_offered=get_total_job_order_value(7,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_offered_decline=get_total_job_order_value(9,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $candidate_sales_reject=get_total_job_order_value(2,$start_date,$end_date,$user_list,$user_id,$report_type);
                  $user_list_array = explode(',',$user_list);
                  $total_job = job_order_data($end_date,$start_date,$user_list_array,$user_id,$report_type);
                  
	?>
		<tr class="msg_box" id="<?=$index?>">
         
			<?php
			
		      echo "<td width='8%'> $total_job</td>";
               if(in_array("serviced",$fields)){					
					echo "<td width='8%'>$serviced </td>";
				}
								
				if(in_array("pipeline",$fields)){					
					echo "<td width='8%'> $pipeline</td>";
				}

				if(in_array("submitted",$fields)){
					echo "<td width='8%'>$submittal </td>";
				}

			  if(in_array("candidate_join",$fields)){
					echo "<td width='8%'> ".$candidate_join."</td>";
				}
                if(in_array("sceen_reject",$fields)){
					echo "<td width='8%'> ".$candidate_screen_reject."</td>";
				}
                if(in_array("interview",$fields)){
					echo "<td width='8%'> ".$candidate_interview."</td>";
				}
                if(in_array("interview_reject",$fields)){
					echo "<td width='8%'> ".$candidate_interview_reject."</td>";
				}
                if(in_array("no_contact",$fields)){
					echo "<td width='8%'> ".$candidate_no_contact."</td>";
				}
                if(in_array("offered",$fields)){
					echo "<td width='8%'> ".$candidate_offered."</td>";
				}
                if(in_array("offered_decline",$fields)){
					echo "<td width='8%'> ".$candidate_offered_decline."</td>";
				}
                if(in_array("sales_reject",$fields)){
					echo "<td width='8%'> ".$candidate_sales_reject."</td>";
				}
		?>

		</tr>
	
	<?php
		}else{
		echo "<tr>";
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
	