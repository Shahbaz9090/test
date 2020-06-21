
   <div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span>Edit Signature</span>
				</h4>

			</div>
            <?php //pr($message->signature); ?>
			<div class="content">			
				   <?php echo get_flashdata();?>                
                   <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">First Name</label>
							<input type="text" class="span6 required" name="first_name" value="<?=isset($result->first_name)?$result->first_name:'';?>" readonly />
							  
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput">Last Name</label>
							<input type="text" class="span6 required" name="last_name" value="<?=isset($result->last_name)?$result->last_name:'';?>" readonly/>
							
						</div>
					</div>
				</div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Designation</label>
							<input type="text" class="span6 required" name="designation" value="<?=isset($result->designation)?$result->designation:'';?>" />							  
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput">Phone Number</label>
							<input type="text" class="span6" name="phone_number" value="<?=isset($result->phone_number)?$result->phone_number:'';?>" />
							
						</div>
					</div>
				</div>

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Cell</label>
							<input type="text" class="span6" name="cell_number" value="<?=isset($result->cell_number)?$result->cell_number:'';?>" />
							  
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput">Fax</label>
							<input type="text" class="span6 required" name="fax_number" value="<?=isset($result->fax_number)?$result->fax_number:'';?>" />
							
						</div>
					</div>
				</div>

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Email</label>
							<input type="text" class="span6 required" name="email" value="<?=isset($result->email)?$result->email:'';?>" readonly/>
							  
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput">Company Name</label>
							<input type="text" class="span6 required" name="company_name" value="<?=isset($result->company_name)?$result->company_name:'';?>"/>
							
						</div>
					</div>
				</div>

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal">Certification</label>
							<input type="text" class="span6 required" name="certification" value="<?=isset($result->certification)?$result->certification:'';?>" />
							  
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput">Company Url</label>
							<input type="text" class="span6 required" name="company_url" value="<?=isset($result->company_url)?$result->company_url:'';?>" />
							
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">					
					<div class="span11">
						<div class="row-fluid">
							<label class="form-label span2" for="focusedInput">Disclaimer</label>
							<div class="span10">
								 <textarea name="message" class="tinymce span12" disabled="true">
									<?=$sign?>
								</textarea> 
							</div>
						</div>
					</div>					
				</div>	
				



				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">
								<div class="span12 controls">
									<button class="btn btn-info marginR10" type="submit">Submit</button>
									<button class="btn btn-danger" type="reset" id="reset_button"><?=lang('reset');?></button>
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
<script>

$( document ).ready(function() {
	$("#.mceIframeContainer").keypress(function(event) {	
		alert();
		if( event.which < 0){
		}else{
			event.preventDefault();
		}
	});
	// //mceContentBody .mceIframeContainer #mce_0_ifr

  $("#reset_button").click(function(){

    $( "input[value='message']" ).text('gh');
  }); 
  
  
});


</script>  
        