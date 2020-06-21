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

	<?php
	  if($result){
		   echo '<table width="100%">';
		  $total_pipe=$last_in_pipeline;
          $total_sub=$last_in_submittal;
          $total_join=$last_in_join;
          $total_screen_reject=$last_in_screen_reject;
          $total_interview=$last_in_interview;
          $total_interview_reject=$last_in_interview_reject;
          $total_no_contact=$last_in_no_contact;
          $total_offered=$last_in_offered;
          $total_offered_decline=$last_in_offered_decline;
          $total_sales_reject=$last_in_sales_reject;
		  $sn=(($counter)*20);
		foreach($result as $key=>$value){
			    $sn++;
				$index=$key;
				$index++;
				$pipeline=get_final_joborder_pipeline($value->job_id);
				$total_pipe+=$pipeline;
                $submittal=get_final_joborder_submittal($value->job_id);
				$total_sub+=$submittal;
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
 <td width='6%'> <?=$sn?></td>
-->
		   <td width='7%'> <?=$value->job_id?></td>
		   <td width='13%'><a href="<?=$base_url.'/'.$value->job_id.'/'.$value->company_id?>"> <?=$value->name?></a></td>
		   <td width='10%'> <?=$value->contact?></td>
		   <td width='10%'> <?=$value->first_name.' '.$value->last_name?></td>
		   <td width='10%'> <?=date("d/m/Y",strtotime($value->modified_time))?></td>
		   <td width='5%'> <?=$pipeline?></td>
		   <td width='5%'> <?=get_final_joborder_submittal($value->job_id)?></td>
           <td  width="5%"> <?=$candidate_join?></td>
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
     <input type="hidden" name="total_sub2" id="total_sub<?=$counter?>" value="<?=$total_sub?>"/>
	 <input type="hidden" name="total_pipe2" id="total_pipe<?=$counter?>" value="<?=$total_pipe?>"/>
     
     <input type="hidden" name="total_join2" id="total_join<?=$counter?>" value="<?=$total_join?>" />
     <input type="hidden" name="total_screen_reject2" id="total_screen_reject<?=$counter?>" value="<?=$total_screen_reject?>" />
     <input type="hidden" name="total_interview2" id="total_interview<?=$counter?>" value="<?=$total_interview?>" />
     <input type="hidden" name="total_interview_reject2" id="total_interview_reject<?=$counter?>" value="<?=$total_interview_reject?>" />
     <input type="hidden" name="total_no_contact2" id="total_no_contact<?=$counter?>" value="<?=$total_no_contact?>" />
     <input type="hidden" name="total_offered12" id="total_offered<?=$counter?>" value="<?=$total_offered?>" />
     <input type="hidden" name="total_offered_decline2" id="total_offered_decline<?=$counter?>" value="<?=$total_offered_decline?>" />
     <input type="hidden" name="total_sales_reject2" id="total_sales_reject<?=$counter?>" value="<?=$total_sales_reject?>" />
     
	 <input type="hidden" name="page_num" id="page_num<?=$counter?>" value="<?=$loadmore?>"/>
	<?php 
		echo '</table>';
		}else{
	?>
		<div style="color:red;text-align:center;padding:10px;" id="fadeable"><span style="background: none repeat scroll 0 0 pink;  border: 1px solid graytext;  color: #835967;  font-weight: bold;  padding: 8px 50px; text-decoration: none;"><?=lang('mo_more_record')?></span></div>
	<?php }?>
</div>