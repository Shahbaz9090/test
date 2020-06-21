<style>
.form-actions {
    /*padding: 5px 20px 5px;*/
    margin-top: 30px;
    text-align: left;
    margin-bottom: 20px;
    background-color: #ecf3f7;
    border-top: 1px solid #e5e5e5;
    *: ;
    zoom: 1;
}
h3 {
    font-size: 18px;
    line-height: 10px;
    padding-left: 10px;
    padding-top: 7px;
}
.cke_chrome {
    margin-left: 0px;
}
.select_style_margin-left{
	width: 50%;
    margin-left: -7px;
}

.error_form{
  color:#f50707;
  font-size: 12px;
}
</style>
<!-- Build page from here: Usual with <div class="row-fluid"></div> -->

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
				
				<?php echo form_open_multipart('',array('id'=>'lead_form','class'=>'form-horizontal','role'=>'form','onsubmit'=>'return check_email_or_phone();'));?>
				<!------------ Contact data Info--------------->
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('contact_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6 ">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('name')?><em>*</em></label>
						<div class="row-fluid">
							<div class="span6 select_style_margin-left"> 
								<select name="supplier_name" id="name" class=" nostyle chosen-select"   >
											<option value="">Select</option>
											<?php if(isset($supplier) && is_array($supplier)){
															foreach($supplier as $i_key => $i_val){
													?>
													<?php $vendor_name = set_value('name') == false ? @$result->supplier_id : set_value('name');  ?>
													<option value="<?=$i_val->id;?>" <?= ($vendor_name == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->supplier_name); ?></option>
													<?php } }?>
																			</select>
										<span id="name_existance_error" class="error_form">
										<small class="error_form"><?php echo form_error('name'); ?><?php echo $error_msg; ?></small>

									</span>
								</div>
							</div>
						</div>
					</div>
				</div>
				
				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_mobile')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">
								
								<?php $mobile_no = set_value('company_contact_person_mobile') == false ? @$result->primary_phone : set_value('company_contact_person_mobile');  ?>
								<input type="text" value="<?php echo  $mobile_no; ?>" id="company_contact_person_phone" name="company_contact_person_phone" class="col-xs-10 col-sm-6 pull-right"   />
								
								<span id="company_contact_person_phone_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('company_contact_person_mobile'); ?><?php echo $error_msg; ?></small>

                               </span> 
								
								<div id="contact_name_list"></div> 
								</div>
							 </div>
						</div>
						
					</div>	
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_email_company')?></label>
							 <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">  
								  <input type="text" value="<?php echo  @$result->email_id; ?>" id="company_contact_email_company" name="company_contact_email_company" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
					<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								
								<?php $name = set_value('company_contact_person') == false ? @$result->name : set_value('company_contact_person');  ?>
								<input type="text" value="<?php echo  @$result->name; ?>" id="company_contact_person" name="company_contact_person" class="col-xs-10 col-sm-6 pull-right"   />
								<span id="company_contact_person_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('company_contact_person'); ?><?php echo $error_msg; ?></small>

                               </span>
								</div>
							 </div>
						</div>
						
					</div>
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('wechat')?></label>
							 <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">  
								  <input type="text" value="<?php echo  @$result->wechat; ?>" id="wechat" name="wechat" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>
				

				<div class="form-row row-fluid">
					<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_department')?></label>
							 <div class="row-fluid">
								<div class="span6 select_style_margin-left">  
								  <select name="department" class="nostyle chosen-select" id="department"  >
									<option value="">Select</option>
									 <?php  if(isset($department) && is_array($department)){
                                                    foreach($department as $i_key => $i_val){
                                               ?>
                                               <?php $department = set_value('company_contact_person_department') == false ? @$result->department : set_value('company_contact_person_department');  ?>
                                               <option value="<?=$i_val->id;?>" <?= ($department == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                                               <?php } }?>
																	</select>  
								<span id="department_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('company_contact_person_department'); ?><?php echo $error_msg; ?></small>

                               </span>
							 </div>
						   </div>
						</div>
						
					</div>	
                   <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('qq_id')?></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								
								<input type="text" id="qq_id" value="<?php echo  @$result->secondary_phone; ?>" name="qq_id" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>	
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_designation')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="designation" class="nostyle chosen-select" id="designation" >
									<option value="">Select</option>
									 <?php  if(isset($designation) && is_array($designation)){
                                                    foreach($designation as $i_key => $i_val){
                                               ?>
                                               <?php $designation = set_value('company_contact_person_designation') == false ? @$result->designation : set_value('company_contact_person_designation');  ?>
                                               <option value="<?=$i_val->id;?>" <?= ($designation == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                                               <?php } }?>
																	</select> 
								<span id="designation_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('company_contact_person_designation'); ?><?php echo $error_msg; ?></small>

                               </span>     
								</div>
							 </div>
						</div>
					</div>	
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_email')?></label>
							 <div class="row-fluid">
								<div class="span6" style="width: 250px;margin-left: 7px;">  
								  <input type="text" id="company_contact_email" value="<?php echo  @$result->personal_email; ?>" name="company_contact_email" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>  
				
				
				<div class="form-row row-fluid">
				<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_current_company_status')?></label>
							  <div class="row-fluid">
								<!--<div class="span6 select_style_margin-left">-->
								<div class="span6" style="width: 250px;margin-left: 7px;">
								<input type="text" name="company_contact_person_current_company_status" id="company_contact_person_current_company_status" class="col-xs-10 col-sm-6 pull-right" value="<?=$result->current_working?>" />
								<!--<select name="company_contact_person_current_company_status" class="nostyle" id="company_contact_person_current_company_status">
									<option value="">Select </option>
									<option value="current" <?= ($result->current_working == "current")?"selected='selected'":"" ?>>Working </option>
									<option value="left" <?= ($result->current_working == "left")?"selected='selected'":"" ?>>Left </option>
																	</select>-->
								</div>
							 </div>
						</div>
					</div>	
				<div class="span6">
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_contact_person_personal_mobile')?></label>
							  <div class="row-fluid">
								<div class="span6 " style="width: 250px;margin-left: 7px;">
								
								<input type="text" id="company_contact_person_personal_mobile" value="<?php echo  @$result->secondary_phone; ?>" name="company_contact_person_personal_mobile" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
						
                   
                </div>
				
				<!--------------------End-Documents Upload Info------------------------->	
				
				
				<!------------ Custom Info-->
				
				<!--<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('custom_information')?></h3>
					</div>
				</div>
				<div id="add_more_common">+</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_machine')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								  <select name="type_of_machine" class="nostyle" id="type_of_machine">
									<option value="">Select </option>
																	</select>
								
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('number_of_machine')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								   <input type="text" id="number_of_machine" value="<?php echo  @$row->number_of_machine; ?>" name="number_of_machine" class="col-xs-10 col-sm-6 pull-right" />
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
					<div class="form-row row-fluid">
						
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('make_of_machine')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <select name="make_of_machine" class="nostyle" id="make_of_machine">
									<option value="">Select </option>
																	</select>
							 </div>
						   </div>
						</div>
					</div>


					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('make_of_controller')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<select name="make_of_controller" class="nostyle" id="make_of_controller">
									<option value="">Select </option>
																	</select>
								</div>
							 </div>
						</div>
					</div>	

                </div>
				

				
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('model_of_controller')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<select name="model_of_controller" class="nostyle" id="model_of_controller">
									<option value="">Select </option>
																	</select>
								</div>
							 </div>
						</div>
					</div>	
                    
                </div>-->
				

				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions" style="text-align:center">								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button type="submit" onclick="return validate()" class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button type="submit" onclick="return validate()" class="btn btn-info marginR10">
										<?=lang($action.'_button');?>
									</button>
									<?php } ?>
</a>

									<button class="btn btn-danger" type="reset" name="reset"><?=lang('reset');?></button>
									<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
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
<script>
function checkuploadDocData(){
status = 0;
status_name = 0;
status_company_contact_person_phone = 0;
status_company_contact_person = 0;
status_department = 0;
status_designation = 0;


//status_text_contents = 0;

 
 var name = $("#name").val();
 var company_contact_person_phone = $("#company_contact_person_phone").val();
 var company_contact_person = $("#company_contact_person").val();
var department = $("#department").val();
 var designation = $("#designation").val();
 
  if(name==''){
	status_name = 0;
	$("#name_existance_error").html('Vendor Name/供应商名称 is required');
	}else{ 
	status_name = 1;
	 $("#name_existance_error").html('');
    }
  if(company_contact_person_phone==''){
	status_company_contact_person_phone = 0;
	$("#company_contact_person_phone_existance_error").html('Mobile No. is required');
  }else{
	status_company_contact_person_phone = 1;
	 $("#company_contact_person_phone_existance_error").html('');
  } if(company_contact_person==''){
	status_company_contact_person = 0;
	$("#company_contact_person_existance_error").html('Name is required');
  }else{
	  status_company_contact_person = 1;
	  $("#company_contact_person_existance_error").html('');
  }
  if(department==''){
	status_department = 0;
	$("#department_existance_error").html('Department is required');
  }else{
	status_department = 1;
	 $("#department_existance_error").html('');
  }

  if(designation==''){

	status_designation = 0;
	$("#designation_existance_error").html('Designation is required');
  }else{
	  status_designation=1;
	  $("#designation_existance_error").html('');
  }



if(status_name == 1 && status_company_contact_person_phone == 1 && status_company_contact_person == 1 && status_department ==1 && status_designation ==1 ){
	  status =1;
	}else{
	  status = 0;
	}
	
return status;

}



  function validate()
  {
	  var error =0;
	  var uploaddoc_status = checkuploadDocData();

		if(uploaddoc_status==1 )
		  {
			error =1;
		  }
		  else
		  {
			error =0;
		  }   
		  
		  
        if(error){
            return true;
        }else{
          return false;
        }
}
</script>
