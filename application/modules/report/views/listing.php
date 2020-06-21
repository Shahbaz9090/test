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
	$(document).ready(function(){
		 var counter=0;
		function last_msg_funtion() 
		{ 
		    var start_date=$('#start_date').val();
			var end_date=$('#end_date').val();
			var displayColumn = $.map($('#box1View option'), function(e) { return e.value; });
			var user_type=$('#user_type').val();		
			if(user_type==''){
				user_type=$('#default_user').val();
			}
			var report_type =$('input:radio[name=report_type]:checked').val();

		    counter++;
            var id=$(".msg_box:last").attr("id");
			$.ajax({				
				type:"POST",
				data:token_name+"="+token_hash+"&start_date="+start_date+"&end_date="+end_date+"&user_type="+user_type+"&report_type="+report_type+"&displayColumn="+displayColumn+"&counter="+counter,
				url: "<?php echo SITE_PATH;?>report/job_order/load/"+counter,
				/*beforeSend : function(){					
					  $('#show').html('<div style="min-height:50px;padding-left:400px;"><img src="<?php echo PUBLIC_URL;?>images/loaders/bar.gif" style="margin-top: 15px;" width="300px"></div>');					  
				},
				*/
				beforeSend : function(){					
				   $('#show').html('<div style="min-height:30px;padding-left:400px;"><img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif" style="margin-top: 15px;" width="80px"></div>');
						  
				},

				success: function(data){					
					if(data!= ""){						
						$("#message").before(data);			
					}else{
						$("#show").html('<div style="min-height: 30px; width: 313px; background:pink; margin-left: 284px; padding-left: 119px; border-radius: 3px ;padding-top: 8px;">No more records found.</div>');
						$("#show").fadeOut(10000);
					}
				}
			});
		};
		
		$(window).scroll(function(){
			if($(window).scrollTop() == $(document).height() - $(window).height()){
			   last_msg_funtion();
			}
		}); 
		
	});
</script>

<div class="tableBg">
<table width="100%">
	<tr>
	   <?php
		if($column_num < 1){
			$column_num=1;
		}

	    $eachColumn=(95)/$column_num;
	    if($column){
			  if($column['id']){
				echo '<th class="th" width="5%">Job Id</th>';
			  }
			  if(isset($column['title'])){				
				echo "<th class='th' width='$eachColumn%' >Title</th>";
			  }

			  if(isset($column['company'])){				
				echo "<th class='th' width='$eachColumn%' >Company</th>";
			  }
			  if(isset($column['contact'])){				
				echo "<th class='th' width='$eachColumn%' >Contact</th>";
			  }
			  if(isset($column['first_name'])){
				
				echo "<th class='th' width='$eachColumn%' >Owner</th>";
			  }
			  if(isset($column['name'])){				
				echo "<th class='th' width='$eachColumn%' >Contact</th>";
			  }

			  if(isset($column['pipeline'])){				
				echo "<th class='th' width='$eachColumn%' >Pipeline</th>";
			  }

			  if(isset($column['submitted'])){				 
				 echo "<th class='th' width='$eachColumn%' >Submittal</th>";
			  }

			  if(isset($column['openings'])){				 
				 echo "<th class='th' width='$eachColumn%' >Openings</th>";
			  }

			  if(isset($column['modified_time'])){				 
				 echo "<th class='th' width='$eachColumn%' >Post Date</th>";
			  }

	   ?>		
	</tr>

	<?php
	    
		foreach($result as $key=>$value){
				$index=$key;
				$index++;
	?>
		<tr class="msg_box" id="<?=$index?>">
			<?php
				if(isset($value->id)){
					echo "<td width='5%'> $value->id</td>";
				}	

				if(isset($value->title)){
					$title=str_replace('/',' / ',$value->title);
					echo "<td width='$eachColumn%'> $title</td>";
				}

				if(isset($value->company)){
					echo "<td width='$eachColumn%'> $value->company</td>";
				}
				if(isset($value->contact)){
					echo "<td width='$eachColumn%'> $value->contact</td>";
				}

				
				if(isset($value->first_name)){
					echo "<td width='$eachColumn%'> $value->first_name ". $value->last_name."</td>";
				}
								
				if(isset($value->pipeline)){					
					echo "<td width='$eachColumn%'> ".get_final_joborder_pipeline($value->id)."</td>";
				}

				if(isset($value->submitted)){
					echo "<td width='$eachColumn%'> ".get_final_joborder_submittal($value->id)."</td>";
				}

				if(isset($value->openings)){
					echo "<td width='$eachColumn%'> $value->openings</td>";
				}
				if(isset($value->modified_time)){
					echo "<td width='$eachColumn%'> ".date("d-m-Y",strtotime($value->modified_time))."</td>";
				}
		?>

		</tr>
	 <?php
	     }
	 ?>
	 </table>
	 <span id="message"> </span>
	 <span id="show"> </span>

	 
	 
 
	<?php
		}else{
			echo '<td style="border:1px #ccc solid; min-height:10px;width:1090px;padding:7px 7px 7px 435px; font-weight:bold;background:#fff;">No Record Found </td>';
		}
	?>
	</div>
	