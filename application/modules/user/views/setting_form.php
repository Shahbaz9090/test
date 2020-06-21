<div class="popup_overlay">
  <div class="popup-mid-container"> 
	<span class="close_popup"><img src="<?=PUBLIC_URL?>images/popup.png" data-dismiss="modal" aria-hidden="true" style="cursor:pointer;width:36px;"/></span>
    <div class="demo">
      <div class="scroll normal">
         <div style="clear:both; padding-right:5px;">
			<span id="success_response"></span>				
				<div class="span12" style="margin-left:0px;">                            
					<div class="box">	
						<div class="title">
							<h4>
								
								<span>User Setting Panel</span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<div class="content">
							<table class="table table-bordered" width="100%">
								<thead>
								  <tr>
									<th >S. No.</th>
									<th>Max Limit</th>
									<th>Target</th>
									<th>Target Period</th>
									<th>Min. Achievement</th>
									<th>Achievement Period</th>
									<th>Mail Deliver</th>
									<th>Parent User</th>
									<th>Action</th>

								  </tr>
								</thead>
								<tbody>
									<?php
										//echo form_open(base_url(),array("id"=>"form-horizontal-submission"));
									?>
								  <tr>
									<td><strong>Submission</strong></td>
									<td><img src="<?=PUBLIC_URL?>images/no_need.png" width="28px;"></td>
									<td>
										<input type="text" class="span1 required" name="submission" id="submission" value="<?=isset($submission->submission) ? $submission->submission :""?>"/>
									</td>
									<td>
										<select class="span2" name="sub_duration" id="sub_duration">
											<option value="">Select</option>
											 <?php
												 $period=array("1"=>"Weekly","2"=>"By-Weekly","3"=>"Monthly","4"=>"Quarterly");
												 foreach($period as $key=>$value){
											 ?>
												<option value="<?=$key?>" <?php if($key==@$submission->sub_duration){?> selected="true" <?php }?>>
													<?=$value?>
												</option>
											 <?php }?>
										</select>
									</td>
									<td>
										<div class="input-append">
										    <input type="text" class="span1" name="sub_achievement" id="sub_achievement" value="<?=isset($submission->sub_achievement) ? $submission->sub_achievement :""?>"/> 
											<span class="add-on" style="margin-left:-4px;">%</span>
										</div>										
									</td>
									<td>
										<select class="span2" name="sub_achieve_duration" id="sub_achieve_duration">
											<option value="">Select</option>
											 <?php
												 $period=array("1"=>"Weekly","2"=>"By-Weekly","3"=>"Monthly","4"=>"Quarterly");
												 foreach($period as $key=>$value){
											 ?>
												<option value="<?=$key?>" <?php if($key==@$submission->sub_achieve_duration){?> selected="true" <?php }?>>
													<?=$value?>
												</option>
											 <?php }?>
										</select>
									</td>

									<td>
										<input type="radio" id="sub_mail_deliever" name="sub_mail_deliever" value="1" <?php if((@$submission->sub_mail_deliever==1)||!isset($submission->sub_mail_deliever)){?>checked="checked" <?php } ?>/>Yes
										
										<input type="radio" id="sub_mail_deliever" name="sub_mail_deliever" value="0" <?php if((@$submission->sub_mail_deliever==0)&& isset($submission->sub_mail_deliever)){?>checked="checked" <?php } ?> />No
									</td>
									<td>
										<select class="span2" name="user" id="user">
											<option value="">Select</option>
											 <option value="">One</option>								 
										</select>
									</td>
									
									<td>
										<input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>"/>
										<button class="btn btn-primary" onClick="return updateSubmissionSetting(<?=$user_id?>)">Update</button>
										<span id="ajax_sub_loader"></span>
									</td>
								  </tr>
								  <?php //echo form_close();?>
								  <tr>
									<td><strong>Interviews</strong></td>
									<td>
										<img src="<?=PUBLIC_URL?>images/no_need.png" width="28px;">
									</td>
									<td>
										<input type="text" class="span1" name="interview" id="interview" value="<?=isset($interviews->interview) ? $interviews->interview :""?>"/>
									</td>
									<td>
										<select class="span2" name="int_duration" id="int_duration">
											<option value="">Select</option>
											 <?php
												 $period=array("1"=>"Weekly","2"=>"By-Weekly","3"=>"Monthly","4"=>"Quarterly");
												 foreach($period as $key=>$value){
											 ?>
												<option value="<?=$key?>" <?php if($key==@$interviews->int_duration){?> selected="true" <?php }?>>
													<?=$value?>
												</option>
											 <?php }?>
										</select>
									</td>

									<td>
										<div class="input-append">
											<input type="text" class="span1" name="int_achievement" id="int_achievement" value="<?=isset($interviews->int_achievement) ? $interviews->int_achievement :""?>"/>
											<span class="add-on" style="margin-left:-4px;">%</span>
										</div>
									</td>
									<td>
										<select class="span2" name="int_achieve_duration" id="int_achieve_duration">
											<option value="">Select</option>
											 <?php
												 $period=array("1"=>"Weekly","2"=>"By-Weekly","3"=>"Monthly","4"=>"Quarterly");
												 foreach($period as $key=>$value){
											 ?>
												<option value="<?=$key?>" <?php if($key==@$interviews->int_achieve_duration){?> selected="true" <?php }?>>
													<?=$value?>
												</option>
											 <?php }?>
										</select>
									</td>

									<td>
										<input type="radio" id="int_mail_deliever" name="int_mail_deliever" value="1" <?php if((@$interviews->int_mail_deliever==1)||!isset($interviews->int_mail_deliever)){?>checked="checked" <?php } ?>/> Yes
										
										<input type="radio" id="int_mail_deliever" name="int_mail_deliever" value="0" <?php if((@$interviews->int_mail_deliever==0)&& isset($interviews->int_mail_deliever)){?>checked="checked" <?php } ?> />No
									</td>
									<td>
										<select class="span2" name="user" id="user">
											<option value="">Select</option>
											 <option value="">One</option>								 
										</select>
									</td>
									
									<td>
										<input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>"/>
										<button class="btn btn-primary" onClick="return updateInterviewSetting(<?=$user_id?>)">Update</button>
										<span id="ajax_int_loader"></span>
									</td>
								  </tr>

								   <tr>
									<td><strong>Send Mail</strong></td>
									<td>
										<input type="text" class="span1" name="send_mail_max_limit" id="send_mail_max_limit" value="<?=isset($mails->send_mail_max_limit) ? $mails->send_mail_max_limit :""?>"/>
									</td>

									<td>
										<input type="text" class="span1" name="send_mail_target" id="send_mail_target" value="<?=isset($mails->send_mail_target) ? $mails->send_mail_target :""?>"/>
									</td>
									<td>
										<select class="span2" name="send_mail_duration" id="send_mail_duration">
											<option value="">Select</option>
											 <?php
												 $period=array("1"=>"Weekly","2"=>"By-Weekly","3"=>"Monthly","4"=>"Quarterly");
												 foreach($period as $key=>$value){
											 ?>
												<option value="<?=$key?>" <?php if($key==@$mails->send_mail_duration){?> selected="true" <?php }?>>
													<?=$value?>
												</option>
											 <?php }?>
										</select>
									</td>
									<td>
										<div class="input-append">
											<input type="text" class="span1" name="send_mail_achievement" id="send_mail_achievement" value="<?=isset($mails->send_mail_achievement) ? $mails->send_mail_achievement :""?>"/>
											<span class="add-on" style="margin-left:-4px;">%</span>
										</div>
									</td>
									<td>
										<select class="span2" name="send_mail_achieve_duration" id="send_mail_achieve_duration">
											<option value="">Select</option>
											 <?php
												 $period=array("1"=>"Weekly","2"=>"By-Weekly","3"=>"Monthly","4"=>"Quarterly");
												 foreach($period as $key=>$value){
											 ?>
												<option value="<?=$key?>" <?php if($key==@$mails->send_mail_achieve_duration){?> selected="true" <?php }?>>
													<?=$value?>
												</option>
											 <?php }?>
										</select>
									</td>
									<td>
										<input type="radio" id="send_mail_deliever" name="send_mail_deliever" value="1" <?php if((@$mails->send_mail_deliever==1)||!isset($mails->send_mail_deliever)){?>checked="checked" <?php } ?>/> Yes
										
										<input type="radio" id="send_mail_deliever" name="send_mail_deliever" value="0" <?php if((@$mails->send_mail_deliever==0)&& isset($mails->send_mail_deliever)){?>checked="checked" <?php } ?> />No
									</td>
									<td>
										<select class="span2" name="user" id="user">
											<option value="">Select</option>
											 <option value="">One</option>								 
										</select>
									</td>
									
									<td>
										<input type="hidden" name="user_id" id="user_id" value="<?=$user_id?>"/>
										<button class="btn btn-primary" onClick="return updateSendMailSetting(<?=$user_id?>)">Update</button>
										<span id="ajax_send_mail_loader"></span>
									</td>
								  </tr>
								</tbody>
							</table>
						</div>

					</div><!-- End .box -->

				</div><!-- End .span12 -->
			
         </div>
      </div>
    </div>

  </div>
  
</div>
