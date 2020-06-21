

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->
<style>
.error{
	color:red;
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
				
				<?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal country_add_form')); ?>

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('country_name')?><em>*</em>
								</label> 
							</div>
							<div class="span6">
								<?php $namess_text = set_value("country_name") == false ? @$result->country_name : set_value("country_name"); ?>
								<input class=" " type="text" name="country_name" id="country_name_ids" value="<?=$namess_text;?>" <?=$readonly?> />

								<!--<span id="country_name_existance_error"></span>-->
								<input type="hidden" name="country_id_on_edit" id="country_id_on_edit" value="<?=@$result->id?>">
								<!-- <input type="hidden" name="check_flag" id="check_flag" value=""> -->
								<div class="error" id="error_field_label"><?php  echo form_error("country_name"); ?><?php echo $error_msg; ?></div>
							</div>
							
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('status')?><em>*</em>
								</label>
							</div>
							
							<div class="span6">
								<select name="status" id="status" class=" nostyle chosen-select" >
								<option value="1" <?= ($result->status == "1")?"selected='selected'":"" ?>>Active</option>
								<option value="0" <?= ($result->status == "0")?"selected='selected'":"" ?>>Inactive</option>
							</select>
							</div>
							
							
						</div>
					</div>
				</div>

				
				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button type="submit" class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button type="submit"  class="btn btn-info marginR10">
										<?=lang($action.'_button');?>
									</button>
									<?php } ?>
</a>

									<button class="btn btn-danger" type="reset" name="reset"><?=lang('reset');?></button>
									<a href="javascript: history.go(-1)" class="btnbtn-goback" ><button class="btn btn-goback" name="reset" type="button">
									<span class="icon16 typ-icon-back"></span>Go back </button></a>
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
<!-- End .row-fluid -->
<script type="text/javascript">
	function checkUniqueness(country_name){

		var country_name_existance='';
	
		$("#country_name_existance_error").html("");
	    
	    var country_id=$("#country_id_on_edit").val();
		var status = 0;
	    var action="<?=SITE_PATH?>masters/country/checkNameExistence";
	    var str=token_name+"="+token_hash+"&country_name="+country_name+"&country_id="+country_id;
    	$.ajax({

    		url: action,
    		method:"POST",
    		data:str,
    		async:false,
	        success: function(data){
				if(data=="1")
		        {
		        	$("#country_name_existance_error").html('<label for="client_id" generated="true" class="error" style="display:block !important">Oops !! This Country is Alreday Exists.</label>');
		        	status = 0;
		        }
		        else
		        {
		        	$("#country_name_existance_error").html('');
		           	status = 1;
		        }
			}
    	});
    	return status;
	}

	function validate()
	{
		// return true;
		var country_name=$("#country_name_id").val();
		var status = checkUniqueness(country_name);
		if(status)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	$("#country_name_id").blur(function(){
		var country_name = $(this).val();
		checkUniqueness(country_name);
	});

</script>