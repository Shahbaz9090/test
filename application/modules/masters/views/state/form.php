

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
				
				<?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('country_name')?><em>*</em>
								</label>
							</div>
							 
							<div class="row-fluid">
								<div class="span6">
										<input type="hidden" name="input_country_id" id="input_country_id" value="<?=@$result->country_id?>" >
								<div class=" select_style_margin-left">
								<?php $namess_text_country = set_value("country") == false ? @$result->country_id : set_value("country"); ?>
									<select name="country" class="nostyle chosen-select" id="country_id" onChange="fetch_state(this.value);" >
										<option value="">Select</option>
											<?php if(isset($country) && is_array($country)){
													foreach($country as $i_key=>$i_val){
													?>
												<option value="<?=$i_val->id;?>" <?= ($namess_text_country == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->country_name; ?></option>
											<?php } }?>
									</select>
									<div class="error" id="error_field_label"><?php  echo form_error("country"); ?></div>
								</div>
								</div>
								
							 </div>
						</div>
					</div>
				<!--</div>

				<div class="form-row row-fluid">-->
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('state_name')?><em>*</em>
								</label> 
							</div>
							<div class="span6">
								<?php $namess_text = set_value("state_name") == false ? @$result->state_name : set_value("state_name"); ?>
								<input class="" type="text" name="state_name" id="state_name_idss" value="<?=$namess_text;?>"  />
							<!--<span id="state_name_existance_error"></span>-->
								<div class="error" id="error_field_label"><?php  echo form_error("state_name"); ?><?php echo $error_msg; ?></div>
							<input type="hidden" name="input_state_id" id="input_state_id" value="<?=@$result->id?>" >
							</div>
							
							 
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('status')?><em>*</em>
							</label>
							<select name="status" id="status" class="span6 nostyle chosen-select" required>
								<option value="1" <?= ($result->status == "1")?"selected='selected'":"" ?>>Active</option>
								<option value="0" <?= ($result->status == "0")?"selected='selected'":"" ?>>Inactive</option>
							</select>
						</div>
					</div>
				<div>
				<input type="hidden" name="country_id" value="<?=isset($result->country_id)?$result->country_id:'';?>" readonly <?=$readonly?> />

				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button   type="submit" onclick="return validate()" class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button  type="submit" onclick="return validate()" class="btn btn-info marginR10">
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

	function fetch_state (str){
		$("#input_country_id").val(str);
	}
	function checkUniqueness(name){

		var state_name_existance='';
	
		$("#state_name_existance_error").html("");
	    
	    
	    var country_id = $("#input_country_id").val();
	    var state_id = $("#input_state_id").val();
	   
		var status = 0;
	    var action="<?=SITE_PATH?>masters/state/checkNameExistence";
	    var str=token_name+"="+token_hash+"&name="+name+"&country_id="+country_id+"&state_id="+state_id;
    	$.ajax({

    		url: action,
    		method:"POST",
    		data:str,
    		async:false,
	        success: function(data){
				if(data=="1")
		        {
		        	$("#state_name_existance_error").html('<label for="client_id" generated="true" class="error" style="display:block !important">Oops !! This State is Alreday Exists.</label>');
		        	status = 0;
		        }
		        else
		        {
		        	$("#state_name_existance_error").html('');
		           	status = 1;
		        }
			}
    	});
    	return status;
	}

	function validate()
	{
		 //return true;
		var state_name=$("#state_name_id").val();
		var status = checkUniqueness(state_name);
		if(status)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	$("#state_name_id").blur(function(){
		var state_name = $(this).val();
		checkUniqueness(state_name);
	});

</script>