<style>
	p{
		line-height:30px;
	}
	label{
	 font-weight:600;
 }
</style>  
<div class="row-fluid">

	<div class="span10">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang($action."_title");?>
					</span>
				</h4>

			</div>
			<div class="content">

					<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('group_name')?></label>
							  <?php if(!empty($groups->name)){ ?>
								<p><?= ucwords($groups->name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('parent_user')?></label>
							 <div class="row-fluid">
								<div class="span6">  
								  <?php if(!empty($result->parent_user)){ ?>
								<p><?php $parent_user=getUser($result->parent_user_id);
									echo $parent_user->first_name.' '.$parent_user->last_name;?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
							 </div>
						   </div>
						</div>
					</div>
                </div>
				

				<?php //pr($result);die; ?>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('employee_id')?></label>
						<?php if(!empty($result->employee_id)){ ?>
								<p><?= ucwords($result->employee_id); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				<!--</div>
				<div class="form-row row-fluid">-->
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('first_name')?></label>
							<?php if(!empty($result->first_name)){ ?>
								<p><?= ucwords($result->first_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('last_name')?></label>
						 <?php if(!empty($result->last_name)){ ?>
								<p><?= ucwords($result->last_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				<!--</div>
				<div class="form-row row-fluid">-->
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('email')?></label>
							<?php if(!empty($result->email)){ ?>
								<p><?= ucwords($result->email); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('mobile')?></label>
						  <?php if(!empty($result->mobile)){ ?>
								<p><?= ucwords($result->mobile); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('status')?></label>
						<?php if(!empty($result->status)){ ?>
								<p><?= ucwords($result->status); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
				</div>
					
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('state')?></label>
						      <?php if(!empty($result->state)){ ?>
								<?php if(!empty($result->city)){
					      		if(isset($state) && is_array($state)){
								foreach($state as $i_key => $i_val){
									if($result->state == $i_val->id)
									{?>
										<p><?= ucwords($i_val->state_name); ?></p>
									<?php } } }?>
							<?php }else{ ?>
							<p><?="N/A"?></p>
							<?php } ?>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('city')?></label>
					      	<?php if(!empty($result->city)){
					      		if(isset($city) && is_array($city)){
								foreach($city as $i_key => $i_val){
									if($result->city == $i_val->id)
									{?>
										<p><?= ucwords($i_val->city_name); ?></p>
									<?php } } }?>
							<?php }else{ ?>
							<p><?="N/A"?></p>
							<?php } ?>
						</div>
					</div>
					
				</div>
				<div class="form-row row-fluid">
					
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('status_comment')?></label>
						      <?php if(!empty($result->status_comment)){ ?>
								<p><?= ucwords($result->status_comment); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>


					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('country')?></label>
						      <?php if(!empty($result->country)){ ?>
						      	<?php $country = explode(',',$result->country);?>
								<p><?= in_array(1, $country)?'India':'' ?><?= in_array(2, $country) && count($country)==2?',China':(in_array(2, $country)?'China':'') ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
				</div>
				
				<div class="center" style="margin-top:30px">
					<a href="javascript: history.back()" class="btn" style="margin-right:10px;"><span class="icon16 typ-icon-back"></span>Go back</a>
				</div>
				
					
				</div>
				

			</div>

		</div>
		<!-- End .box -->

	</div>
<!-- End .row-fluid -->

        