		<style>
			.vertical-scroller {
				  height: 100px;
				  width: 247px;
				  overflow-y: scroll;
			}
            .vertical-scroller2 {
                height: 600px;
                width: 247px;
                overflow-y: auto;
            }
			.boxes{
				  float:left;
				  width: 205px;
				  border: 0px solid black;
				  margin-top:4px;
				}
		</style>
											<!--<div class="row-fluid">
													<div class="span12">
														<div class="widget-box widget-color-blue">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title bigger lighter">
																	<i class="ace-icon fa fa-rss"></i>Disqualify Note 
																</h5>
															</div>
															<div class="widget-body vertical-scroller">
																<div class="widget-main">
																	<div class="row-fluid">
																		<div class="span12">
																			<div class="widget-box transparent">
																				<div class="widget-body">
																					<div class="widget-main padding-8">
																						<div  class="profile-feed my-scroll">
																							<?php if(isset($disqualified_notes) && is_array($disqualified_notes)){
																									foreach($disqualified_notes as $i_key => $i_val){
																										//pr($i_val);die;
																										if($result->main_id == $i_val->id){ //pr($i_val);die;?>
																										<div class="boxes">
																										<p style="float:left"><b><?=ucwords($i_val->disqualified_reason)?></b></p><br>
																										<p style="float:left">_________________________________</p>
																										</div>
																										<?php //echo "</br>";
																											} } }  ?>
																										
						
																						
																					
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
											    </div>
											</div>-->
											<?php   $notification=_get_notification_type();
													foreach($notification as $key=>$val){
										    ?>
												<div class="row-fluid">
													<div class="span12">
														<div class="widget-box widget-color-blue">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title bigger lighter">
																	<i class="ace-icon fa fa-rss"></i><?=$val->notification_type?>
																</h5>
															</div>
															<div class="widget-body vertical-scroller">
																<div class="widget-main">
																	<div class="row-fluid">
																		<div class="span12">
																			<div class="widget-box transparent">
																				<div class="widget-body">
																					<div class="widget-main padding-8">
																						<div  class="profile-feed my-scroll">
																							<?php if(isset($appoitment) && is_array($appoitment)){
																									foreach($appoitment as $i_key => $i_val){
																										//pr($i_val);die;
																										if($i_val->type == $val->form_id){ 
																										if($result->main_id == $i_val->lead_id){ //pr($i_val);die;?>
																									<div class="boxes">
																										
																										<p style="float:left"><b><?=ucwords($i_val->title)?></b></p><br>
																										<p style="float:right; color:blue;"><?=$i_val->start?></p><br>
																										<p style="float:left"><?=ucwords($i_val->description)?></p><br>
																										<p style="float:left">_________________________________</p>
																									</div>
																									<?php //echo "</br>";
																							 } } } }  ?>
																						
						
																						<!-- /section:pages/profile.feed -->
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
											    </div>
											</div>
												<?php } ?>
												<?php $main = strtolower($this->uri->segment(2)); ?>
												<!--------------------------------------Notes & Lost Reason-------------------------------------------->
												<div class="row-fluid">
												<!------------------------------------------------------------------------------------------------------>
												   <div class="span12">
														<div class="widget-box widget-color-blue">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title bigger lighter">
																	<i class="ace-icon fa fa-rss"></i>Notes
																</h5>
																<a data-toggle="modal" data-target="#addNoteModal" class="btn btn-xs btn-primary pull-right" style="cursor: pointer;"><i class="ace-icon glyphicon glyphicon-pencil"></i> Add</a>
															</div>
															<div class="widget-body vertical-scroller2">
																<div class="widget-main">
																	<div class="row-fluid">
																		<div class="span12">
																			<div class="widget-box transparent">
																				<div class="widget-body" >
																					<div class="widget-main padding-8">
																						<div  class="profile-feed my-scroll">
																							<?php if(isset($notes) && is_array($notes)){
																									foreach($notes as $i_key => $i_val){
																										//pr($i_val);die;
																										if($result->main_id == $i_val->lead_id){ //pr($i_val);die;?>
																										<div class="boxes">
																										
																										<p style="float:left"><b><?=ucwords($i_val->notes)?></b></p><br>
																										<p style="float:left">_________________________________</p>
																										</div>
																									<?php //echo "</br>";
																							} } }  ?>	
																						
						
																						<!-- /section:pages/profile.feed -->
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
															<!---------------------Add Note Modal------------------------->
															<div class="modal fade" id="addNoteModal" tabindex="-1" role="dialog"  style="width:700px;" aria-labelledby="myModalLabel" aria-hidden="true">
															  <div class="modal-dialog modal-sm">
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
																	<h4 class="modal-title" id="myModalLabel">Add Note</h4>
																  </div>
																  <div class="modal-body">
																	<div class="row-fluid">
																	  <div class="span12">
																		<?php echo form_open("lead/$main/addNote",array('class'=>'form-horizontal','role'=>'form','id'=>'addNote'));?>
																		<div class="span12" style="width:640px;">
																		<input type="hidden" name="lead_id" value="<?=@$result->main_id?>"/>
																		  <div class="row-fluid"> 
																		  
																		   <div class="span12">   
																			  <textarea  name="notes" id="addNote"  class="ckeditor"></textarea>
																		   </div>   
																		   
																		   <div class="span12"></div>
																		   <div class="span12">   
																			  <button id="submit_note" class="btn btn-primary pull-right">Submit</button>
																		   </div>
																		   
																		  </div>
																		  </div>
																		<?php echo form_close();?>
																	 </div>
																  </div>       

																  </div>
																</div>
															  </div>
															</div>
															<!------------------------------------------> 
														</div>
													 </div>
												</div> 
												<!------------------------------------------------------------------------------------------------------>
												<?php if($result->product!=null){ ?>
												<div class="row-fluid">
													<div class="span12">
														<div class="widget-box widget-color-blue">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title bigger lighter">
																	<i class="ace-icon fa fa-rss"></i>Product
																</h5>
															</div>
															<div class="widget-body vertical-scroller">
																<div class="widget-main">
																	<div class="row-fluid">
																		<div class="span12">
																			<div class="widget-box transparent">
																				<div class="widget-body">
																					<div class="widget-main padding-8">
																						<div  class="profile-feed my-scroll">
																										<div class="boxes">
																										<p style="float:left"><b><?=ucwords($result->product)?></b></p><br>
																										<p style="float:left">_________________________________</p>
																										</div>
																										
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
											    </div>
											</div>
											<?php } ?>
											<!---------------------------------------------------->
											<?php if($result->service!=null){ ?>
											<div class="row-fluid">
													<div class="span12">
														<div class="widget-box widget-color-blue">
															<div class="widget-header widget-header-small">
																<h5 class="widget-title bigger lighter">
																	<i class="ace-icon fa fa-rss"></i>Service
																</h5>
															</div>
															<div class="widget-body vertical-scroller">
																<div class="widget-main">
																	<div class="row-fluid">
																		<div class="span12">
																			<div class="widget-box transparent">
																				<div class="widget-body">
																					<div class="widget-main padding-8">
																						<div  class="profile-feed my-scroll">
																							
																										<div class="boxes">
																										<p style="float:left"><b><?=ucwords($result->service)?></b></p><br>
																										<p style="float:left">_________________________________</p>
																										</div>
																										
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>
											    </div>
											</div>
											<?php } ?>
															<!---------------------Assign Opportunity------------------------->
															<div class="modal fade" id="assignOppModal" tabindex="-1" role="dialog"  style="width:700px;" aria-labelledby="myModalLabel" aria-hidden="true">
															  <div class="modal-dialog modal-sm">
																<div class="modal-content">
																  <div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
																	<h4 class="modal-title" id="myModalLabel">Assign Opportunity</h4>
																  </div>
																  <div class="modal-body">
																	<div class="row-fluid">
																	  <div class="span12">
																		<?php echo form_open("qualified_lead/$main/assignopportunity",array('class'=>'form-horizontal','role'=>'form','id'=>'addservice'));?>
																		<div class="span12" style="width:640px;">
																		<input type="hidden" name="lead_id" value="<?=@$result->main_id?>"/>
																		  <div class="row-fluid"> 
																		  
																		   <div class="span12">   
																			  <label class="form-label span4" for="normal">Assign Department<em>*</em></label>
																			  <div class="row-fluid">
																					<div class="span6">
																						<select name="assign_group" id="assign_group" class="nostyle" style="margin-left:15px;">
																						<option value="">Select Deapartment</option>
																						<?php  foreach($user_groups as $row):?>
																						<option   value="<?=$row->id;?>" <?php if(isset($result->group_id) && $result->group_id ==$row->id){ echo "selected"; } ?> ><?=ucfirst($row->name)?> </option>
																						<?php endforeach; ?>
																						</select>
																					</div>
																			    </div>
																		   </div>   
																		   <div class="span12">   
																				<label class="form-label span4" for="normal">Assign Employee<em>*</em></label> 
																					<div class="row-fluid">
																						<div class="span6">
																							<select name="assign_user" id="assign_user" class="nostyle">
																								<option value="" >Select Employee</option>
																									<?php foreach($assign_user as $row):?>
																									<option value="<?=$row->id?>" <?php  if(isset($result->added_by) && $result->added_by == $row->id){ echo "selected" ;}?> ><?=$row->first_name." ".$row->last_name?></option>
																									<?php endforeach; ?>                                            
																							</select>
																						 </div>
																					 </div>
																			</div>  
																		   <div class="span12"></div>
																		   <div class="span12">   
																			  <button id="submit_note" class="btn btn-primary pull-right">Assign Opportunity</button>
																		   </div>
																		   
																		  </div>
																		  </div>
																		  
																		<?php echo form_close();?> 
																	 </div>
																  </div>       
																</div>
															</div>
														</div>
													 </div>
<script type="text/javascript">
        jQuery(document).ready(function($){
           $("#company_form").validate();
		   $("#hot_contact_row").slideToggle();          
           $('#assign_group').change(function(){			
                var group_id =$(this).val();
				
                $.get('<?=base_url("user_group")?>/ajax_user/'+group_id, function(data){
                    $('#assign_user').html(data);                  
                });
           });
		   
		   $('#is_ajax_email').keyup(function(){	
			    var id="<?=@$result->id?>";
                var email = $(this).val();
                if(isValidEmailAddress(email)){
                       $.ajax({
                           type: "POST",
                           url: '<?=$base_url?>/ajax_is_email',
                           data: token_name+"="+token_hash+"&email="+email+"&id="+id,
                           success: function(data){							   
							   var msg='';
							   if(data==1){
								   msg='<div class="email_not_validate">This email id already registered!</div>';
								   $("#email_status").html(msg);
							   }else{
								   $("#email_status").html(msg);
							   }                              
                           }
                       });
                 }                       
            });  

			$('#is_company_website').keyup(function(){
				  var email = $(this).val();
				   $.ajax({
					   type: "POST",
					   url: '<?=$base_url?>/ajax_is_website',
					   data: {email: email},
					   success: function(data){                               
						  $("#ajax_status").html(data);
					   }
				   });
            });

		
        $("#campany_doc").click(function(){
    	$("#campany_doc_file").toggle();
  	 });

        });
        
        function removeUpl(id,doc_file){	
            		$.ajax({
			   type: "POST",
			   data: token_name+"="+token_hash+"&doc_file="+doc_file,
			   url: '<?=$base_url?>/ajax_remove_doc/'+id,			  
			   success: function(data){    
				   $("#del_"+id).remove();			  
			   }
		   });
		   
	}
        
        
</script>

<script src="http://cdn.ckeditor.com/4.4.6/standard-all/ckeditor.js"></script>   