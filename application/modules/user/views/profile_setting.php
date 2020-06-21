     <div class="row-fluid">
	<div class="span12">

		<div class="box">

		<div class="title">
				<h4> <span>Profile Setting</span></h4>
			</div>
			<div class="content">			
				   <?php echo get_flashdata();?>                
                   <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>			

				<div class="form-row row-fluid">					
					<div class="span7">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">First Name<em>*</em></label>
							<input type="text" class="span6 required" name="first_name" id="first_name" value="<?=isset($result->first_name)?$result->first_name:""?>"/>
						</div>
					</div>					
				</div>			
				
				
				<div class="form-row row-fluid">					
					<div class="span7">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Last Name<em>*</em></label>
							<input type="text" class="span6 required" name="last_name" id="last_name" value="<?=isset($result->last_name)?$result->last_name:""?>"/>
						</div>
					</div>					
				</div>	
				
				<div class="form-row row-fluid">					
					<div class="span7">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Email</label>
							<input type="text" class="span6 required" name="email" id="email" value="<?=isset($result->email)?$result->email:""?>" readonly/>
						</div>
					</div>					
				</div>	

				<div class="form-row row-fluid">					
					<div class="span7">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Profile Image</label>
							<input type="file" class="span6" name="profile_image" id="profile_image"/>
                            <?php
                                if(empty($result->profile_image)){
                                    $result->profile_image="no_image.jpeg";
                                }
                            ?>
							<img src="<?php echo PUBLIC_URL.'images/'.$result->profile_image;?>" alt="" class="image" width="70" height="70"/> 
						</div>
					</div>					
				</div>				
				
				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">
								<div class="span12 controls">
									
									<?php
									   if($result->profile_image){
									?>
										<input type="hidden" class="span6" name="hidden_profile_image" id="hidden_profile_image" value="<?php if(!empty($result->profile_image)){echo $result->profile_image;}else{ echo "no_image.jpg";}?>"/>
									<?php }?>

									<button class="btn btn-primary">Submit</button>
									<button class="btn btn-danger" type="reset" name="reset"><?=lang('reset');?></button>
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
        