  <style>
	.span6.select_style_margin-left{
		width: 50%;
		margin-left: -7px !important;
	}
	#ms-list-1{
		margin-left: 7px;
	}
	.ms-options-wrap > .ms-options {
    position: absolute;
    left: 152px !important;
    width: calc(100% - 812px) !important ;
    margin-top: 1px;
    margin-bottom: 20px;
    background: white;
    z-index: 2000;
    border: 1px solid #aaa;
    overflow: auto;
    margin: 0px 12px 0px 12px;
    visibility: hidden;
	}
	.ms-options-wrap > .ms-options > .ms-search input {
    
    height: 27px !important;
	}
	.ms-options-wrap > .ms-options > ul input[type="checkbox"] {
    
        left: -53px !important;
    
	}
    .SumoSelect {
        width: 100%;
    }
 </style>
  <script type="text/javascript">
  var email_existance="";
        jQuery(document).ready(function ($)
         {
           $('#group').change(function()
             {
                var group_id =$(this).val();
                $.get('<?=$base_url?>/get_users/'+group_id, function(data) 
                {
                    $('#users').html(data);  
					$('#users').trigger("chosen:updated");					
                });
            });
            
            $('#group').change(function()
             {
                var group_id =$(this).val();
                $.get('<?=$base_url?>/get_parent_group/'+group_id, function(data) 
                {
                    $('#parent_group').html(data);  
					$('#parent_group').trigger("chosen:updated");					
                });
            });
            
             $('#parent_group').change(function()
             {
                var group_id =$(this).val();
                $.get('<?=$base_url?>/get_group_users/'+group_id, function(data) 
                {
                    $('#users').html(data);   
					$('#users').trigger("chosen:updated");					
                });
            });
        });
		$.validator.setDefaults({ ignore: ":hidden:not(.chosen-select)" })
 </script>
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
					 <span><?=lang($action."_title");?></span>
				</h4>
			</div>
            
            
			<div class="content">
          <?php //pr($result);die;?>
            <?=get_flashdata()?>
            <?php if(!empty($user_exceed)) { ?>
            <div class="alert alert-warning">
                            <button data-dismiss="alert" class="close" type="button">&times;</button>
                            <strong>Warning</strong> You have exceeds the user limit.
                            </div>
                            <?php } ?>
               <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal user_add_form')); ?>
			   <div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('group_name')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								  <select name="group_id" class="nostyle chosen-select" id="group" <?php if(isset($readonly)){ echo "disabled='true'";}  ?> required="true" >
									<option value="">Select Group</option>
									<?php foreach ($groups as $row):?>
									<option value="<?=$row->id?>" <?php if(isset($result->group_id) && $result->group_id ==$row->id){ echo "selected";}?> >			      <?=$row->name?>
									</option>
									<?php endforeach; ?>
								  </select>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('parent_group')?></label>
							 <div class="row-fluid">
								<div class="span6">  
								  <select name="parent_group_id" class="nostyle chosen-select" id="parent_group" <?php if(isset($readonly)){ echo "disabled='true'";} ?>>
									<option value="">Select Group</option>
									<?php
									
									 foreach ($parent_group as $row):
									 
									 if($row != 0)
									 {
										$name = $this->user_mod->view_groups($row);
									 ?>
									<option value="<?=$name->id?>" <?php if(isset($result->parent_group_id) && $result->parent_group_id ==$name->id){ echo "selected";}?> >	
									<?=$name->name?>
									</option>
									<?php
									}
									 endforeach; ?>
								</select>
							 </div>
						   </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('parent_user')?></label>
							<div class="row-fluid">
								<div class="span6">  
									<select name="parent_user_id" id="users" class="nostyle chosen-select" <?php if(isset($readonly)){ echo "disabled='true'";} ?>>
									   <option value="0">Select Parent User</option>
									   
										<?php if(is_array($users)){ foreach ($users as $row):?>
										<option value="<?=$users->id?>" <?php if(isset($result->parent_user_id) && @$result->parent_user_id ==$users->id){ echo "selected";}?> ><?php echo $users->first_name." ".$users->last_name; ?></option>
										<?php endforeach;}else{?>
											<option value="<?=$users->id?>" <?php if(isset($result->parent_user_id) && @$result->parent_user_id ==$users->id){ echo "selected";}?> ><?php echo $users->first_name." ".$users->last_name; ?></option>
										<?php } ?>
									</select>
								</div>
							 </div>
						</div>
					</div>
				</div>

				<?php //pr($result);die; ?>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('employee_id')?><em>*</em></label>
						<?php if(empty($result->employee_id)) {?>
						   <input type="text" class="span6 " id="employee_id" name="employee_id" value="<?=isset($result->employee_id)?$result->employee_id:'';?>" <?=$readonly?>  required />
						   <span id="employee_id_existance_error"></span>
						<?php }else{ ?>
							<input type="text" class="span6 " id="employee_id" name="employee_id" value="<?=isset($result->employee_id)?$result->employee_id:'';?>" readonly <?=$readonly?> required  />
						<?php } ?>
						</div>
					</div>
				<!--</div>
				<div class="form-row row-fluid">-->
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('first_name')?><em>*</em></label>
							<input type="text" class="span6 " name="first_name" value="<?=isset($result->first_name)?$result->first_name:'';?>" <?=$readonly?> required />
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('last_name')?><em>*</em></label>
						 <input type="text" class="span6 " name="last_name" value="<?=isset($result->last_name)?$result->last_name:'';?>" <?=$readonly?> required />
						</div>
					</div>
				<!--</div>
				<div class="form-row row-fluid">-->
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('email')?><!--<em>*</em>--></label>
							 <input type="text" class="span6" name="email" id="email_id" value="<?=isset($result->email)?$result->email:'';?>" <?=$readonly?>/>
                             <span id="email_existance_error"></span>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('mobile')?><em>*</em></label>
						  <input oninput="this.value=this.value.replace(/[^0-9]/,'')" type="text" class="span6 <?php if(!isset($result->mobile)){echo "required";}?>" id="txtboxToFilter2" name="mobile" minlength="10" maxlength="10" id="mobile" value="<?=isset($result->mobile)?$result->mobile:'';?>" <?=$readonly?> required />
						  <span id="mobile_existance_error"></span>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('password')?><em>*</em></label>
						  <input type="password" class="span6 <?php if(!isset($result->password)){echo "required";}?>" name="password" minlength="6"  <?=$readonly?> id="password" required />
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('confirm_password')?><?php if(!isset($result->password)){echo "<em>*</em>";}?></label>
						   <input type="password" class="span6 <?php if(!isset($result->password)){echo "required";}?>" name="confirm_password" minlength="6"  <?=$readonly?> id="confirm_password" required />
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('status')?><em>*</em></label>
						   
						  <div class="row-fluid">
							  <div class="span6 del"> 
									<select name="status" class="nostyle required" <?php if($readonly){echo 'disabled="true"';} ?> >
										<option value="active" <?php if(isset($result->status) && $result->status =="active") { echo "selected";} ?> >Active</option>
										<option value="inactive" <?php if(isset($result->status) && $result->status =="inactive") { echo "selected";} ?> >Inactive</option>
										<!--<option value="banned" <?php if(isset($result->status) && $result->status =="banned") { echo "selected";} ?> >Banned</option>-->
									</select>
							   </div>
						  </div> 
						</div>
					</div>
				</div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('location')?><em>*</em></label>
							<input type="text" class="span6" name="location" id="location" value ="<?=isset($result->location)?$result->location:'';?>" required />
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('state')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
									<select multiple="" name="state_comp[]" class="nostyle" id="state_comp" onChange="fetch_city(this.value);" required>
										<option value="">Select</option>
											<?php 
											$state_ids = $result->state;
											$state_ids = explode(",", $state_ids);
											if(isset($state) && is_array($state)){
											foreach($state as $i_key => $i_val){
											?>
										   <option value="<?=$i_val->id;?>" <?= (in_array($i_val->id, $state_ids))?"selected='selected'":"" ?>><?=$i_val->state_name; ?></option>
										   <?php } }?>
									</select>
								</div>
							 </div>
						</div>
					</div>
					<script type="text/javascript">
						jq(document).ready(function(){
							//jq("select[name='state_comp[]']").SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select State'});
						})
					</script>
				</div>
									
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('city')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<select multiple name="city_comp[]" id="city_comp" class="nostyle" required>
									<option value="">Select</option>
									<?php
									$city_ids = $result->city;
									// pr($city_ids);
									$city_ids = explode(",", $city_ids);
									if(isset($city) && is_array($city)){
										foreach($city as $i_key => $i_val){
										?>
									   <option value="<?=$i_val->id;?>" <?= (in_array($i_val->id, $city_ids))?"selected='selected'":"" ?>><?=$i_val->city_name; ?></option>
									<?php } } ?>
									
								</select>
								</div>
							 </div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('status_comment')?></label>
					      	<textarea <?=$readonly?>  class="span6" name="status_comment"><?=isset($result->status_comment)?$result->status_comment:'';?></textarea>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('ip_based_login')?></label>
						    <textarea <?=$readonly?> class="span6" name="ip_based"><?=isset($result->ip_based)?$result->ip_based:'';?></textarea>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('country')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								<?php $country_ids = $result->country;
									// pr($city_ids);
									$country_ids = explode(",", $country_ids);?>
								  <select multiple="" name="country[]" class="nostyle" id="country" required>
                                    <option value="" disabled="">Select Country</option>
                                    <option value="1" <?= (in_array(1, $country_ids))?"selected='selected'":"" ?>>India</option>
                                    <option value="2" <?= (in_array(2, $country_ids))?"selected='selected'":"" ?>>China</option>
                                </select>
								</div>
							 </div>
						</div>
					</div>
				</div>
                <?php if(empty($user_exceed)){  ?>
				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">								
								<div class="span12 controls">
								  <?php if($action == 'view'){ ?>
									<button class="btn btn-info" href="<?=$base_url.'/edit/'.$result->id?>"> <?=lang($action.'_button');?></button>
									<?php }else { ?>
										<button class="btn btn-info"><?=lang($action.'_button');?></button>
									<?php } ?>
									<button class="btn btn-danger marginR10" name="reset" type="reset"><?=lang('reset');?></button>
									<a href="javascript: history.go(-1)" class="btn btn-goback"><span class="icon16 typ-icon-back"></span>Go back</a>
								</div>
							</div>
						</div>
					</div>
				</div>
                <?php } ?>
                 <?php echo form_close(); ?>                    
            </div>
		</div>
		<!-- End .box -->
	</div>
	<!-- End .span12 -->
</div>
<!-- End .row-fluid -->


<script>

jq(document).ready(function () {
    jq("#state_comp").SumoSelect({});
    jq("#city_comp").SumoSelect({});
    jq("#country").SumoSelect({});
});

$("#email_id").blur(function(){
    var email=$(this).val();
    var action="<?=SITE_PATH?>user/checkEmailExistence";
    var str=token_name+"="+token_hash+"&email="+email;
    $.post(action,str,function(data){
        if(data=="1")
        {
            var error='<label for="email" generated="true" class="error">Oops !! This user name has been taken by someone else.</label>';
            $("#email_existance_error").html(error);
            email_existance="yes";
        }
        else
        {
            $("#email_existance_error").html("");
            email_existance="";
        }
    });
});


$("#mobile").blur(function(){
    var mobile=$(this).val();
    var action="<?=SITE_PATH?>user/checkMobileExistence";
    var str=token_name+"="+token_hash+"&mobile="+mobile;
    $.post(action,str,function(data){
        //alert(data);
		if(data=="1")
        {
            var error='<label for="mobile" generated="true" class="error">Oops !! This mobile no. has been taken by someone else.</label>';
            $("#mobile_existance_error").html(error);
            email_existance="yes";
        }
        else
        {
            $("#mobile_existance_error").html("");
            email_existance="";
        }
    });
});

/*$("#location").blur(function(){
    var location=$(this).val();
    var action="<?=SITE_PATH?>user/checkLocationExistence";
    var str=token_name+"="+token_hash+"&location="+location;
    $.post(action,str,function(data){
        //alert(data);
		if(data=="1")
        {
            var error='<label for="location" generated="true" class="error">Oops !! This user name has been taken by someone else.</label>';
            $("#location_existance_error").html(error);
            email_existance="yes";
        }
        else
        {
            $("#location_existance_error").html("");
            email_existance="";
        }
    });
});*/

$("#employee_id").blur(function(){
    var employee_id=$(this).val();
	//alert(employee_id);false;
    var action="<?=SITE_PATH?>user/checkEmployeeIdExistence";
    var str=token_name+"="+token_hash+"&employee_id="+employee_id;
    $.post(action,str,function(data){
        //alert(data);
		if(data=="1")
        {
            var error='<label for="employee_id" generated="true" class="error">Oops !! This employee id has been taken by someone else.</label>';
            $("#employee_id_existance_error").html(error);
            email_existance="yes";
        }
        else
        {
            $("#employee_id_existance_error").html("");
            email_existance="";
        }
    });
});

$(".user_add_form").submit(function(){
   if(email_existance=="yes")
   {
        var error='<label for="email" generated="true" class="error" style="display:block !important">Oops !! This user name has been taken by someone else.</label>';
        $("#email_existance_error").html(error);
        return false;
   } 
});
</script>
<!--<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-1.9.1.min.js"></script>
 
<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.multiselect.js"></script>-->
<script>
/*$(function () {
        $('select[multiple].multiple').multiselect({
            columns: 2,
            placeholder: 'Location',
            search: true,
            searchOptions: {
                'default': 'Search...'
            },
            selectAll: false
        });
	});*/
</script>

<script>
$(document).ready(function() {
    $("#txtboxToFilter").keydown(function(event) {
        // Allow only backspace and delete
        if ( event.keyCode == 46 || event.keyCode == 8 ) {
            // let it happen, don't do anything
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.keyCode < 48 || event.keyCode > 57 ) {
                event.preventDefault(); 
            }   
        }
    });
});

function fetch_city(id){
	
	var state_ids = [];
	$("select[name='state_comp[]']").each(function(){
		state_ids.push($(this).val());
	});

	if(state_ids!='' && state_ids.length>0){
		$.ajax({
			url:"<?php echo base_url();?>user/fetch_city",
            method:"GET",
            data:{id:state_ids},
			success:function(data)
			{
                //alert(id);
                //alert(data);false;
				$('#city_comp').html(data);
                $("#city_comp")[0].sumo.reload();
				// $('#city_comp').trigger("chosen:updated");
			}
		});	
	}
	else
	{
		$('#city_comp').html('<option value="">Select</option>');
		// $('#city_comp').trigger("chosen:updated");
	}
}

</script>