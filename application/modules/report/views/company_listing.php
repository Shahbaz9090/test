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
	<button id="company_listing_export" type="button" class="btn-success"><?=lang('company_export')?></button>
</div>

<div class="span2 del">
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
    
	</div>
	<div class="span2">
	<?php $this->load->view('pagination')?>
</div>
</div>

<?php }?>
 
<div class="tableBg">

<?php
  if($result){	

?>
<table width="100%">
	<tr>
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
	   <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Client Screen Reject">Sc. R.</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Interview">IW</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Interview Reject">I. R.</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="No Contact">No C.</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Offered">Offer</a></th>
       <th class="th" style="width: 5%;"><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Candidate Offered Declined">O. D.</a></th>
       <th class="th" style="width: 5%;" ><a href="javascript:void(0);" class="tip" style="text-decoration:none;color:#fff;" title="Sales Reject">S.Rj.</a></th>
    </tr>      
     
	 
</table>


<?php  } ?>
	<?php
    
      if(! isset($prev_page))
      {
        @$prev_page = $prev;
      }
     
      $total_service=$last_in_service; 
      $total_sub=$last_in_submittal;	  
	  $total_pipe=$last_in_pipeline;
      $total_join=$last_in_join;
      $total_screen_reject=$last_in_screen_reject;
      $total_interview=$last_in_interview;
      $total_interview_reject=$last_in_interview_reject;
      $total_no_contact=$last_in_no_contact;
      $total_offered=$last_in_offered;
      $total_offered_decline=$last_in_offered_decline;
      $total_sales_reject=$last_in_sales_reject;
      
      //last total value store
      $total_service_last=$last_in_service_last;
      $total_sub_last=$last_in_submittal_last;	  
	  $total_pipe_last=$last_in_pipeline_last;
      $total_join_last=$last_in_join_last;
      $total_screen_reject_last=$last_in_screen_reject_last;
      $total_interview_last=$last_in_interview_last;
      $total_interview_reject_last=$last_in_interview_reject_last;
      $total_no_contact_last=$last_in_no_contact_last;
      $total_offered_last=$last_in_offered_last;
      $total_offered_decline_last=$last_in_offered_decline_last;
      $total_sales_reject_last=$last_in_sales_reject_last;
     
	  if($result){	
	   
       $diff_service=0;
	   $diff_pipe = 0;
       $diff_sub = 0;
       $diff_join = 0;
       $diff_sreject = 0;
       $diff_interview = 0;
       $diff_ireject = 0;
       $diff_ncontact = 0;
       $diff_offered = 0;
       $diff_ofdecline = 0;
       $diff_cslr = 0;
       
       if($start_date!=null){
        $start_date =date("Y-m-d",strtotime($start_date));
       }
       if($end_date!=null){
        $end_date =date("Y-m-d",strtotime($end_date));
       } 
       
		foreach($result as $key=>$value){
				$index=$key;
				$index++;
				$pipeline=get_final_joborder_pipeline($value->job_id,$start_date,$end_date);
			    $submittal=get_final_joborder_submittal($value->job_id,$start_date,$end_date);
                $serviced = get_final_joborder_seriviced_job($value->job_id,$start_date,$end_date);
                $current_serviced = $serviced;
			    $candidate_join=get_final_joborder_data('11',$value->job_id,$start_date,$end_date);
                $candidate_screen_reject=get_final_joborder_data('10',$value->job_id,$start_date,$end_date);
                $candidate_interview=get_final_joborder_data('6',$value->job_id,$start_date,$end_date);
                $candidate_interview_reject=get_final_joborder_data('3',$value->job_id,$start_date,$end_date);
                $candidate_no_contact=get_final_joborder_data('1',$value->job_id,$start_date,$end_date);
                $candidate_offered=get_final_joborder_data('7',$value->job_id,$start_date,$end_date);
                $candidate_offered_decline=get_final_joborder_data('9',$value->job_id,$start_date,$end_date);
                $candidate_sales_reject=get_final_joborder_data('2',$value->job_id,$start_date,$end_date);
                
                 if($page == ($prev_page+1))
                 {
                    $total_service+=$serviced;
                    $total_pipe+=$pipeline;
                    $total_sub+=$submittal;
                    $total_join+=$candidate_join;
                    $total_screen_reject+=$candidate_screen_reject;
                    $total_interview+=$candidate_interview;
                    $total_interview_reject+=$candidate_interview_reject;
                    $total_no_contact+=$candidate_no_contact;
                    $total_offered+=$candidate_offered;
                    $total_offered_decline+=$candidate_offered_decline;
                    $total_sales_reject+=$candidate_sales_reject;
                 } 
                  
                    $diff_service += $serviced;
                    $serviced = $diff_service;
                    $diff_pipe += $pipeline;
                    $pipeline = $diff_pipe;
                    $diff_sub += $submittal;
                    $submittal = $diff_sub;
                    $diff_join += $candidate_join;
                    $candidate_join = $diff_join;
                    $diff_sreject += $candidate_screen_reject;
                    $candidate_screen_reject = $diff_sreject;
                    $diff_interview += $candidate_interview;
                    $candidate_interview = $diff_interview;
                    $diff_ireject += $candidate_interview_reject;
                    $candidate_interview_reject = $diff_ireject;
                    $diff_ncontact += $candidate_no_contact;
                    $candidate_no_contact = $diff_ncontact;
                    $diff_offered += $candidate_offered;
                    $candidate_offered = $diff_offered;
                    $diff_ofdecline += $candidate_offered_decline;
                    $candidate_offered_decline = $diff_ofdecline;
                    $diff_cslr += $candidate_sales_reject;
                    $candidate_sales_reject += $diff_cslr;
                   
                
	?>
<table width="100%">
		<tr class="msg_box" id="<?=$index?>">
		   <td style="width: 7%;"> <?=$value->job_id?></td>
		   <td style="width: 10%;"><a href="<?=$base_url.'/'.$value->job_id.'/'.$value->company_id?>"> <?=$value->company?></a></td>
			
		   <td style="width: 10%;">  <?=$value->contact?> </td>
		   <td style="width: 10%;"> <?=$value->first_name.' '.$value->last_name?></td>

		   <td style="width: 8%;"> <?=date("d/m/Y",strtotime($value->modified_time))?></td>
           <td style="width: 5%;"> <?=$current_serviced?></td>
		   <td style="width: 5%;"> <?=get_final_joborder_pipeline($value->job_id,$start_date,$end_date)?></td>
		   <td style="width: 5%;"> <?=get_final_joborder_submittal($value->job_id,$start_date,$end_date)?></td>
           <td style="width: 5%;"><?=get_final_joborder_data('11',$value->job_id,$start_date,$end_date)?></td>
    	   <td  style="width: 5%;"><?=get_final_joborder_data('10',$value->job_id,$start_date,$end_date)?></td>
           <td  style="width: 5%;"><?=get_final_joborder_data('6',$value->job_id,$start_date,$end_date)?></td>
           <td  style="width: 5%;"><?=get_final_joborder_data('3',$value->job_id,$start_date,$end_date)?></td>
           <td  style="width: 5%;"><?=get_final_joborder_data('1',$value->job_id,$start_date,$end_date)?></td>
           <td  style="width: 5%;"><?=get_final_joborder_data('7',$value->job_id,$start_date,$end_date)?></td>
           <td  style="width: 5%;"><?=get_final_joborder_data('9',$value->job_id,$start_date,$end_date)?></td>
            <td  style="width: 5%;"><?=get_final_joborder_data('2',$value->job_id,$start_date,$end_date)?></td>
           
		</tr>

	 <?php
	     }
	 ?>
 </table>
 
 <?php
  if($page == ($prev_page-1))
  {
        $total_service =  $total_service - $total_service_last;
        $total_pipe =  $total_pipe - $total_pipe_last;
        $total_sub = $total_sub - $total_sub_last;
        $total_join = $total_join - $total_join_last;
        $total_screen_reject = $total_screen_reject - $total_screen_reject_last;
        $total_interview = $total_interview - $total_interview_last;
        $total_interview_reject = $total_interview_reject - $total_interview_reject_last;
        $total_no_contact = $total_no_contact - $total_no_contact_last;
        $total_offered = $total_offered - $total_offered_last;
        $total_offered_decline = $total_offered_decline - $total_offered_decline_last;
        $total_sales_reject = $total_sales_reject - $total_sales_reject_last;
  }
 ?>
 <table>
 
     <tr>
		   <td style="width: 45%; text-align: center; font-weight: bold;">Total</td>
            <td style="width: 5%;font-weight: bold;"> <span id="total_pipe_service"><?=$total_service?></span></td>
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
 
 <?php
		}else{
		echo "<table><tr>";
			echo '<td colspan="7" style="border:1px #ccc solid; min-height:10px;width:1090px;padding:7px 7px 7px 435px; font-weight:bold;background:#fff;">'.lang('no_record').'</td>';
		echo "</tr></table>";
		}
    ?>
 
</div> 
 
 <span id="responseData">
 </span>

 
 <div  id="ajax_change"></div>
  <input type="hidden" name="total_service1" id="total_service1" value="<?=$total_service?>"/>
 <input type="hidden" name="total_sub1" id="total_sub1" value="<?=$total_sub?>"/>
 <input type="hidden" name="total_pipe1" id="total_pipe1" value="<?=$total_pipe?>"/>
 <input type="hidden" name="total_join1" id="total_join1" value="<?=$total_join?>"/>
 <input type="hidden" name="total_screen_reject1" id="total_screen_reject1" value="<?=$total_screen_reject?>"/>
 <input type="hidden" name="total_interview1" id="total_interview1" value="<?=$total_interview?>"/>
 <input type="hidden" name="total_interview_reject1" id="total_interview_reject1" value="<?=$total_interview_reject?>"/>
 <input type="hidden" name="total_no_contact1" id="total_no_contact1" value="<?=$total_no_contact?>"/>
 <input type="hidden" name="total_offered1" id="total_offered1" value="<?=$total_offered?>"/>
 <input type="hidden" name="total_offered_decline1" id="total_offered_decline1" value="<?=$total_offered_decline?>"/>
 <input type="hidden" name="total_sales_reject1" id="total_sales_reject1" value="<?=$total_sales_reject?>"/>
 
  <input type="hidden" name="total_service" id="last_total_service" value="<?=@$serviced?>"/>
 <input type="hidden" name="total_pipe" id="last_total_pipe" value="<?=@$pipeline?>"/>
 <input type="hidden" name="total_sub1" id="last_total_sub" value="<?=@$submittal?>"/>
 <input type="hidden" name="total_join1" id="last_total_join" value="<?=@$candidate_join?>"/>
 <input type="hidden" name="total_screen_reject1" id="last_total_screen_reject" value="<?=@$candidate_screen_reject?>"/>
 <input type="hidden" name="total_interview1" id="last_total_interview" value="<?=@$candidate_interview?>"/>
 <input type="hidden" name="total_interview_reject1" id="last_total_interview_reject" value="<?=@$candidate_interview_reject?>"/>
 <input type="hidden" name="total_no_contact1" id="last_total_no_contact" value="<?=@$candidate_no_contact?>"/>
 <input type="hidden" name="total_offered1" id="last_total_offered" value="<?=@$candidate_offered?>"/>
 <input type="hidden" name="total_offered_decline1" id="last_total_offered_decline" value="<?=@$candidate_offered_decline?>"/>
 <input type="hidden" name="total_sales_reject1" id="last_total_sales_reject" value="<?=@$candidate_sales_reject?>"/>
 
 <input type="hidden" name="prev_page" id="prev_page"  value="<?=$page?>" />
 
<script type="text/javascript">

	$(document).ready(function(){
	

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
          location.href="<?php echo SITE_PATH;?>report/company/export/?start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&company="+company+"&contact"+contact;
        });

	  });
</script>

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