<script type="text/javascript">        
	$(document).ready(function ()
	 {
		setupLeftMenu();
		$('.datatable').dataTable();
		setSidebarHeight();	
		
	 });
</script>

<div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang('company_pipeline_activity')?></span>
				</h4>

			</div>
			
		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->
</div>
                                                      
<div class="">
    <div class="box round first">                		
		<div class="block">                    
			<table class="data display datatable" id="example" >
			 <thead class="page">
				 <tr>
					<th width="5%">Id</th>
					<th width="17%">Candidate</th>							
					<th width="15%">Added By</th>
					<th width="13%">Status</th>
					<th width="13%">Last Activity</th>							
					<th width="12%">Location</th>
					<th width="25%">Comment</th>
				</tr>
			</thead>                    
			<tbody>		
			    <?php
				    if($result){
						foreach($result as $key=>$value){
							
				?>
				 <tr>
					<td><?=$key+1?></td>
					<td><?=character_limiter($value->first_name,20)?></td>
					<td><?=character_limiter($value->user_name,20)?></td>
					<td>
						<?php
							if($value->status_id=='0'){
								echo "Pipeline";									
							}else if($value->status_id=='1'){
								echo "No Contact";									
							}elseif($value->status_id=='2'){
								echo "Review Reject";									
							}elseif($value->status_id=='3'){
								echo "Interview Reject";									
							}elseif($value->status_id=='5'){
								echo "Submitted";								
							}elseif($value->status_id=='6'){
								echo "Interview";									
							}elseif($value->status_id=='7'){
								echo "Offered";									
							}elseif($value->status_id=='9'){
								echo "Offered Declined";									
							}elseif($value->status_id=='10'){
								echo "Client Screen reject";									
							}
					   ?>
					</td>
					<td><?=date("d/m/Y g:i a",strtotime($value->modified_time))?></td>
					<td><?=$value->city?></td>
					<td><?=character_limiter($value->Comment,30)?></td>
			     </tr>
				<?php 
						}
					}
				?>
				
			</tbody>		
		</table>                    
		</div>				
	</div>        
</div>

