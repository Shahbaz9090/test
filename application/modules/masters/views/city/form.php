

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
								<?php $namess_text_country = set_value("country_name") == false ? @$result->country_id : set_value("country_name"); ?>
									<div class=" select_style_margin-left">
										<input type="hidden" name="input_city_id" id="input_city_id" value="<?=@$result->id?>" >
										<select name="country_name" class="nostyle chosen-select" onChange="fetch_state(this.value);" >
											<option value="">Select</option>
											<?php if(isset($country) && is_array($country)){
												foreach($country as $i_key => $i_val){
												?>
                                               <option value="<?=$i_val->id;?>" <?= ($namess_text_country == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->country_name; ?></option>
                                               <?php } }?>
											</select>
											<div class="error" id="error_field_label"><?php  echo form_error("country_name"); ?></div>
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
							<div class="row-fluid">
								<div class="span6">
								<?php $namess_text_state = set_value("state_name") == false ? @$result->state_id : set_value("state_name"); ?>
										<div class=" select_style_margin-left">
											<select name="state_name" class="nostyle chosen-select" id="state_comp" onChange="fetch_city(this.value);" >
												<option value="">Select</option>
													<?php if(isset($state) && is_array($state)){
																foreach($state as $i_key => $i_val){
																?>
															<option value="<?=$i_val->id;?>" <?= ($namess_text_state == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->state_name; ?></option>
													<?php } }?>
											</select>
											<div class="error" id="error_field_label"><?php  echo form_error("state_name"); ?></div>

												<input type="hidden" name="input_country" id="input_country_id"  value="<?=isset($result->country_id)?$result->country_id:'';?>"  />
												<input type="hidden" name="input_state"  id="input_state_id" value="<?=isset($result->state_id)?$result->state_id:'';?>"  />


										</div>
								</div>
									
							</div>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('city_name')?><em>*</em></label> 
							</div>
							<?php $namess_text = set_value("city_name") == false ? @$result->city_name : set_value("city_name"); ?>
							<div class="span6" style="margin-left:0px;">
								<input class=" " type="text" name="city_name" id="city_name_id" value="<?=$namess_text;?>"  />
							<!--<span id="city_name_existance_error"></span>-->
							<div class="error" id="error_field_label"><?php  echo form_error("city_name"); ?><?php echo $error_msg; ?></div>
							</div>
							
							
						</div>
					</div>
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
				</div>



				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button  type="submit"  class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button  type="submit"  class="btn btn-info marginR10">
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
		// get the state from country_name
	function fetch_state(id){
		$("#input_country_id").val(id);
		if(id!=''){
			$.ajax({
						url:"<?php echo base_url();?>masters/city/fetch_state_according_country",
                        method:"GET",
                        data:{id:id},
						success:function(data)
						{
                            //alert(country_id);
                           // alert(data);false;
							$('#state_comp').html(data);
							$('#state_comp').trigger("chosen:updated");

						}
					});	
				}
				else
				{
					//$('#state_comp').append('<option value="">select country first</option>');
					$('#state_comp').trigger("chosen:updated");
				}
		
	}







	
</script>


<script type="text/javascript">

	function fetch_city(id){
		$("#input_state_id").val(id);
	}
	function checkUniquenesss(name){

		
			
		var state_name_existance='';
	
		$("#city_name_existance_error").html("");
	    
	    
	    var country_id = $("#input_country_id").val();
	    var state_id = $("#input_state_id").val();
	    var city_id = $("#input_city_id").val();
	   
		var status = 0;
	    var action="<?=SITE_PATH?>masters/city/checkNameExistence";
	    var str=token_name+"="+token_hash+"&name="+name+"&country_id="+country_id+"&state_id="+state_id+"&city_id="+city_id;
    	$.ajax({

    		url: action,
    		method:"POST",
    		data:str,
    		async:false,
	        success: function(data){
				if(data=="1")
		        {
		        	$("#city_name_existance_error").html('<label for="client_id" generated="true" class="error" style="display:block !important">Oops !! This City is Alreday Exists.</label>');
		        	status = 0;
		        }
		        else
		        {
		        	$("#city_name_existance_error").html('');
		           	status = 1;
		        }
			}
    	});
    	return status;
	}

	function validate()
	{
		 return true;
		var city_name=$("#city_name_id").val();
		var status = checkUniqueness(city_name);
		if(status)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	$("#city_name_id").blur(function(){
		var city_name = $(this).val();
		checkUniqueness(city_name);
	});

</script>