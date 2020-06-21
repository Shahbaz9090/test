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
	 $perm= _check_perm();
     $column_num=count($fields);
		if($column_num < 1){
			$column_num=1;
		}
        //pr($fields);    
        //$column = $fields;
	    $eachColumn=(90)/$column_num;
	  if($result){
          echo '<table width="100%">';	
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
		  $sn=(($counter)*20);
          $index=($counter)*20;
		  foreach($result as $key=>$value){
			    $sn++;
				$index++;
				$pipeline=get_final_joborder_pipeline($value->id);
				$total_pipe+=$pipeline;
                $submittal=get_final_joborder_submittal($value->id);
				$total_sub+=$submittal;
                $candidate_join=get_final_joborder_data('11',$value->id);
                $total_join+=$candidate_join;
                $candidate_screen_reject=get_final_joborder_data('10',$value->id);
                $total_screen_reject+=$candidate_screen_reject;
                $candidate_interview=get_final_joborder_data('6',$value->id);
                $total_interview+=$candidate_interview;
                $candidate_interview_reject=get_final_joborder_data('3',$value->id);
                $total_interview_reject+=$candidate_interview_reject;
                $candidate_no_contact=get_final_joborder_data('1',$value->id);
                $total_no_contact+=$candidate_no_contact;
                $candidate_offered=get_final_joborder_data('7',$value->id);
                $total_offered+=$candidate_offered;
                $candidate_offered_decline=get_final_joborder_data('9',$value->id);
                $total_offered_decline+=$candidate_offered_decline;
                $candidate_sales_reject=get_final_joborder_data('2',$value->id);
                $total_sales_reject+=$candidate_sales_reject;
                
	?>
		<tr class="msg_box" id="<?=$index?>">
          <td width='5%'> <?=$index?></td>
			<?php
			  echo "<td width='5%'> $value->id</td>";
			     
			     	if(in_array("job_order.title",$fields)){
					$title=str_replace('/',' / ',$value->title);
					echo "<td width='17%'> $title</td>";
				}
        
				if($perm!=1){
					if((@$perm['company']['add'])||(@$perm['company']['all_view'])){
						if(in_array("company",$fields)){
						   echo "<td width='16%'><a href='$base_url/$value->id/$value->company_id'>  $value->company</a></td>";
						}
					   
						if(in_array("contact",$fields)){
							echo "<td width='13%'> $value->contact</td>";
						}
					}
				}else{
					if(in_array("company",$fields)){
						echo "<td width='16%'><a href='$base_url/$value->id/$value->company_id'>  $value->company</a></td>";
					}
				   
					if(in_array("contact",$fields)){
						echo "<td width='13%'> $value->contact</td>";
					}
				}


                if(in_array("owner",$fields)){
					echo "<td width='13%'> $value->first_name ". $value->last_name."</td>";
				}
				
			
								
				if(in_array("pipeline",$fields)){					
					echo "<td width='8%'> ".get_final_joborder_pipeline($value->id)."</td>";
				}

				if(in_array("submitted",$fields)){
					echo "<td width='8%'> ".get_final_joborder_submittal($value->id)."</td>";
				}

				if(in_array("job_order.openings",$fields)){
					echo "<td width='8%'> $value->openings</td>";
				}
				if(in_array("job_order.modified_time",$fields)){
					echo "<td width='8%'> ".date("d-m-Y",strtotime($value->modified_time))."</td>";
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
	    }
	 ?>	 
	 <input type="hidden" name="total_pipe2" id="total_pipe<?=$counter?>" value="<?=$total_pipe?>" />
     <input type="hidden" name="total_sub2" id="total_sub<?=$counter?>" value="<?=$total_sub?>" />
     <input type="hidden" name="total_join2" id="total_join<?=$counter?>" value="<?=$total_join?>" />
     <input type="hidden" name="total_screen_reject2" id="total_screen_reject<?=$counter?>" value="<?=$total_screen_reject?>" />
     <input type="hidden" name="total_interview2" id="total_interview<?=$counter?>" value="<?=$total_interview?>" />
     <input type="hidden" name="total_interview_reject2" id="total_interview_reject<?=$counter?>" value="<?=$total_interview_reject?>" />
     <input type="hidden" name="total_no_contact2" id="total_no_contact<?=$counter?>" value="<?=$total_no_contact?>" />
     <input type="hidden" name="total_offered12" id="total_offered<?=$counter?>" value="<?=$total_offered?>" />
     <input type="hidden" name="total_offered_decline2" id="total_offered_decline<?=$counter?>" value="<?=$total_offered_decline?>" />
     <input type="hidden" name="total_sales_reject2" id="total_sales_reject<?=$counter?>" value="<?=$total_sales_reject?>" />
     
     
	 <input type="hidden" name="page_num" id="page_num<?=$counter?>" value="<?=$loadmore?>" />
	<?php 
		echo '</table>';
		}else{
	?>
		<div style="color:red;text-align:center;padding:10px;" id="fadeable"><span style="background: none repeat scroll 0 0 pink;  border: 1px solid graytext;  color: #835967;  font-weight: bold;  padding: 8px 50px; text-decoration: none;"><!-- <?=lang('no_more_record')?> -->No more record</span></div>
	<?php }?>
  
</div>


