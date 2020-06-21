<style>
p{
		line-height:30px;
		word-break: break-all;
	}
 label{
	 font-weight:600;
 }
</style>
<div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang($action."_title");?>
					</span>
				</h4>

			</div>
			<div class="content">
			
			
				<?php echo get_flashdata();?>
			
			
			<div class="form-row row-fluid">
			<div class="span6 ">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('company_name')?></label>
						<!--<input type="text" class="span7 required " name="company_name" value="<?=isset($result->company_name)?$result->company_name:'';?>" <?=$readonly?>/>-->
						
						<?php if(!empty($result->company_name)){ ?>
								<p><?= ucwords($result->company_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				
					
					
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span5" for="focusedInput"><?=lang('name')?></label>
				    <?php if(!empty($result->name)){ ?>
								<p><?= ucwords($result->name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
					<?php } ?>
					</div>
				</div>
					
				</div>
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
					  <label class="form-label span4" for="focusedInput"><?=lang('department')?></label>
					 <?php if(!empty($result->department_name)){ ?>
								<p><?= ucwords($result->department_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>  
									<?php } ?>
							
					</div>
				</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="focusedInput"><?=lang('designation')?></label>
							<?php if(!empty($result->designation_name)){ ?>
								<p><?= ucwords($result->designation_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p> 
							<?php } ?>								
						</div>
					</div>
					
				</div>
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
					  <label class="form-label span4" for="normal"><?=lang('email')?></label>
					  <?php if(!empty($result->email_id)){ ?>
								<p><?= ucwords($result->email_id); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
					</div>
				</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="normal"><?=lang('primary_phone')?></label>
							
								<?php if(!empty($result->primary_phone)){ ?>
								<p><?= ucwords($result->primary_phone); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>	
					</div>
					
				</div>
				
				
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
					  <label class="form-label span4" for="focusedInput"><?=lang('previous_company')?></label>
					  <?php if(!empty($result->previous_company)){ ?>
								<p><?= ucwords($result->previous_company); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
					</div>
				</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="focusedInput"><?=lang('personal_mobile_number')?></label>
							<?php if(!empty($result->secondary_phone)){ ?>
								<p><?= ucwords($result->secondary_phone); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
				</div>
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('personal_email')?></label>
							<?php if(!empty($result->personal_email)){ ?>
								<p><?= ucwords($result->personal_email); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="focusedInput"><?=lang('company_status')?></label>
						<?php if(!empty($result->vendor_data)){ ?>
								<p><?php if($result->company_status=='current'){ echo "Working"; }
								if($result->company_status=='left'){ echo "Left"; }
								?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
				</div>
				
				
				
				
				
				
				
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('notes')?></label>
							<?php if(!empty($result->notes)){ ?>
								<p><?= ucwords($result->notes); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="focusedInput"><?=lang('hot_contact')?></label>
							  <?php if(!empty($result->vendor_data)){ ?>
								<p><?php
							if($result->hot_contact){
								echo 'Yes';
							}else{
								echo 'No';
							}
						?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				</div>
				
				  <div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('hot_contact')?></label>
							  <?php if(!empty($result->vendor_data)){ ?>
								<p><?php
							if($result->hot_contact==1){
								echo $result->hot_contact_comment;
							}
								?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>			
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="normal"><?='Rating'?></label>
							<div class="row-fluid">
								<div class="span6">
									<?php if(!empty($result->rating)){ ?>
								<p><?= ucwords($result->rating); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
					
		           </div>
                            
                          
                            
                            
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('assign_group')?></label>
							<?php 
									$user_groups_name_arr =array();
									if(!empty($user_groups)){
											$main_group_arr = explode(',',$result->group_id);
										foreach($user_groups as $gp_val){ 
											if(in_array($gp_val->id,$main_group_arr)){
													$gp_name = $gp_val->group_name;
													array_push($user_groups_name_arr,$gp_name);
											}
											
											 
											
										}
										
											$user_groups_names = implode(',',$user_groups_name_arr);
									}?>

									

							<?php if(!empty($user_groups_names)){ ?>
								<p style="margin-left:166px;"><?= $user_groups_names; ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span5" for="focusedInput"><?=lang('assign_user')?></label> 
							<div class="row-fluid">
								<div class="span6">
								<?php 
									$user_groups_name_arr =array();
									if(!empty($assign_user)){
											$main_group_arr = explode(',',$result->assign_users);
										foreach($assign_user as $gp_val){ 
											if(in_array($gp_val->id,$main_group_arr)){
													$gp_name = ucwords($gp_val->first_name." ".$gp_val->last_name);
													array_push($user_groups_name_arr,$gp_name);
											}
											
											 
											
										}
										
											$user_groups_names = implode(',',$user_groups_name_arr);
									}?>
								<?php if(!empty($user_groups_names)){ ?>
								<p><?= $user_groups_names; ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								 </div>
							 </div>
						</div>
					</div>
					
				</div>
				
				<div class="center" style="margin-top:30px">
                <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
                
            `	</div>
					
				<?php echo form_close(); ?>

			</div>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>
