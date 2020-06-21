  <div class="row-fluid">
	<div class="span12">
		  <?php echo get_flashdata();?>
		<div class="box">
			<div class="title">
				<h4> <span>Password Setting</span></h4>
			</div>
			<div class="content">
                   <?php echo form_open(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>
				   <div class="form-row row-fluid">					
					<div class="span8">
						<div class="row-fluid">
							<label class="form-label span3" for="normal">Password<em>*</em></label>
							<input type="password" name="cpassword" id="cpassword" class="span5 required"/>	
						</div>
					</div>					
				</div>

				<div class="form-row row-fluid">					
					<div class="span8">
						<div class="row-fluid">
							<label class="form-label span3" for="normal">New Password<em>*</em></label>
							<input type="password" name="password" id="password" class="span5"/>										
						</div>
					</div>					
				</div>	
				
				<div class="form-row row-fluid">					
					<div class="span8">
						<div class="row-fluid">
							<label class="form-label span3" for="normal">Confirm Password<em>*</em></label>
							<input type="password"  name="confirm_password" id="passwordConfirm" class="span5"/>									
						</div>
					</div>					
				</div>

				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">
								<div class="span12 controls">
									<button class="btn btn-primary">Submit</button>
									<button class="btn btn-danger" name="reset" type="reset"><?=lang('reset');?></button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
		<!-- End .box -->
	</div>
	<!-- End .span12 -->
</div>       