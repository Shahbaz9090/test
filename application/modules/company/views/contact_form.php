<link href="<?php echo base_url();?>assets/plugins/sumoselect/sumoselect.css" rel="stylesheet" />
  
  	<script type="text/javascript">
  		function get_employee(obj)
  		{
  			var all_id = [];
  			$(obj).each(function(i, v){
  				if($(this).val()!='')
  				{
  					all_id.push($(this).val());
  				}
  			});

  			var all_users_id = [];
  			$("select[name='assign_user[]'] option:selected").each(function(i, v){
  				if($(this).val()!='')
  				{
  					all_users_id.push($(this).val());
  				}
  			});
  			
			// console.log(all_users_id);
			// return false;
			$.ajax({
				url:"<?=base_url('user_group/ajax_user/')?>",
				method:'POST',
				data:{token_name:token_hash,group_id:all_id,users_id:all_users_id},
				success:function(res){
					if(res!='')
					{
						$('#assign_user').html(res);
						$('#assign_user')[0].sumo.reload();

					}
					else
					{
						$('#assign_user').html('');
					}
				}
			});
            /*$.get('<?=base_url("user_group")?>/ajax_user/'+all_id, function(data){
                $('#assign_user').html(data);
            });*/
  		}

        $(document).ready(function($){
           $("#company_form").validate();
		   $("#hot_contact_row").slideToggle();          
		   	$('#is_ajax_email').keyup(function(){	
			    var id="<?=@$result->id?>";
                var email = $(this).val();
                if(isValidEmailAddress(email)){
                       $.ajax({
                           type: "POST",
                           url: '<?=$base_url?>/ajax_is_email',
                           data: token_name+"="+token_hash+"&email="+email+"&id="+id,
                           success: function(data){							   
							   var msg='';
							   if(data==1){
								   msg='<div class="email_not_validate">This email id already registered!</div>';
								   $("#email_status").html(msg);
							   }else{
								   $("#email_status").html(msg);
							   }                              
                           }
                       });
                 }                       
            });  

			$('#is_company_website').keyup(function(){
				  var email = $(this).val();
				   $.ajax({
					   type: "POST",
					   url: '<?=$base_url?>/ajax_is_website',
					   data: {email: email},
					   success: function(data){                               
						  $("#ajax_status").html(data);
					   }
				   });
            });

		
        $("#campany_doc").click(function(){
    	$("#campany_doc_file").toggle();
  	 });

        });
        
        function removeUpl(id,doc_file){	
            		$.ajax({
			   type: "POST",
			   data: token_name+"="+token_hash+"&doc_file="+doc_file,
			   url: '<?=$base_url?>/ajax_remove_doc/'+id,			  
			   success: function(data){    
				   $("#del_"+id).remove();			  
			   }
		   });
		   
	}
        
        
    </script> 
  
 
  <script type="text/javascript">
	 /* jQuery(document).ready(function ($) {
			var availableTags = [
			  <?php foreach($countries as $row):?>
				"<?php echo $row->country_name;?>",
			 <?php endforeach; ?>		
			];
			$( "#country" ).autocomplete({ 
				source: availableTags,
				select: function(event, ui) {

				  
					var c = ui.item.value;
				
					$.get('<?php echo base_url("country");?>/ajax_state/'+c, function(data) 
					{
					  $('#state').html(data);                  
					});
				}
			});
		});*/
</script>
<script>
  jQuery(document).ready(function ($) {
	
	var state = <?=count(@$state)?>;
    
    if(state == 0)
    {
         $.get('<?=base_url("country")?>/ajax_state_chosen/'+1, function(data) 
         {
              $('#state_span').html(data);
                       
         });
    }

	});
    
    
    function change_city(val)
    {
        $.get('<?=base_url("country")?>/ajax_city_chosen/'+val+'/span7', function(data){
                  $('#city_span').html(data);
        });
    }
    
    
</script>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->
<style>
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-style: normal;
    font-weight: normal;
    line-height: 1;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    font-size: 12px;
}
.error_form{
	color:#f50707;
}
.SumoSelect {
    width: 98%;
}
.SumoSelect .CaptionCont.SelectBox.search {
    width: 96%;
    line-height: initial;
    float: left;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #353535;
    font-style: normal;
    }
   .SumoSelect:focus > .CaptionCont, .SumoSelect:hover > .CaptionCont, .SumoSelect.open > .CaptionCont {
    box-shadow: 0 0 2px #c8cbce;
    border-color: #e4e6e8;
}
.SumoSelect > .CaptionCont {
    position: relative;
    border: 1px solid #e8e3e3;
    min-height: 14px;
    background-color: #fff;
    border-radius: 8px;
    margin: 0;
}
.SumoSelect.open .search-txt {
    display: inline-block;
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    margin: 0;
    padding: 14px 7px;
}
.SumoSelect > .CaptionCont > label > i {
    background: url("<?=base_url()?>/assets/plugins/chosen/chosen-sprite.png") no-repeat 13px 2px;
    display: block;
    width: 100%;
    height: 100%;
}
input[type='radio']
{
	width: unset;
}
.error_form{
  color:#f50707;
  font-size: 12px;
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
			
			
				<?php echo get_flashdata();  ?>
				
				<?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>
				
			

			<div class="form-row row-fluid">
					<div class="span5 ">
						<div class="row-fluid">
						<div class="span5">
							<label class="form-label " for="focusedInput"><?=lang('company_name')?><em>*</em>
							</label>
						</div>
						<div class="span7">
							<input type="hidden" name="contact_id_on_edit" id="contact_id_on_edit" value="<?=$result->company_id?>">
							<input type="hidden" name="id_on_edit" id="id_on_edit" value="<?=$result->contact_ids?>">
							<select name="company_name" id="company_name" class=" nostyle chosen-select" required>
									<option value="">Select</option>
									 <?php  if(isset($company) && is_array($company)){
                                                    foreach($company as $i_key => $i_val){
                                               ?>
                                               <?php $company_name = set_value('company_name') == false ? @$result->company_id : set_value('company_name'); 


                                                ?>
                                               <option value="<?=$i_val->id;?>" <?= ($company_name == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->company_name); ?></option>
                                               <?php } }?>
								</select>
								<span id="comapny_name_existance_error" class="error_form">
								<small class="error_form"><?php echo form_error('company_name'); ?></small>
								</span>
						</div>
						</div>
					</div>
				
					
					
				
					
				</div>

				<div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
							<div class="span5">
						  		<label class="form-label " for="focusedInput"><?=lang('salutation')?><em>*</em></label>
							</div>
							<div class="span7">
						  <select name="salutation" id="salutation" class=" nostyle chosen-select"  required>
							<option value="1">Mr.</option>
							<option value="2">Mrs.</option>
							<option value="3">Ms.</option>
						 </select>   
						<span id="salutation_error" class="error_form">
							<small class="error_form"><?php echo form_error('salutation'); ?></small>
						</span>
						</div>
					</div>
				</div>
				
					
					
				<div class="span7">
					<div class="row-fluid">
						<div class="span4">
							
							<label class="form-label " for="focusedInput"><?=lang('name')?><em>*</em></label>
						</div>

						<div class="span6" style="width: 293px;">
							
							<?php $name = set_value('name') == false ? @$result->name : set_value('name');  ?>
				    		<input type="text" class="" name="name" id="contact_name" value="<?= $name;?>" />
				    		<span id="contact_name_existance_error" class="error_form">
				   			 <small class="error_form"><?php echo form_error('name'); ?></small>
				   			</span>
						</div>
					</div>
				</div>
					
				</div>
				
				<div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
						<div class="span5">
							<label class="form-label " for="normal"><?=lang('primary_phone')?></label>
						</div>
						<div class="span7" style="width: 240px;">
							<?php $primary_phone = set_value('primary_phone') == false ? @$result->primary_phone : set_value('primary_phone'); ?>
							<input type="text" class=" " id="contact"  name="primary_phone"  maxlength="10" value="<?=$primary_phone;?>" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  />
							<!--<input type="text" class="span4 number" style="float:right;position: relative;bottom: 28px;"  name="ext"  value="<?=isset($result->ext)?$result->ext:'';?>" placeholder="Ext" />-->
							
							<span id="comapny_contact_existance_error" class="error_form">
								
								<small class="error_form"><?php echo form_error('primary_phone'); ?><?php echo $error_msg; ?></small> 
							</span>
						</div>
					</div>
				</div>
					
					<div class="span7">
						<div class="row-fluid">
							<div class="row-fluid">
								<div class="span4">
									
						  			<label class="form-label " for="normal"><?=lang('email')?></label>
								</div>
								<div class="span6" style="width: 293px;">
									
						 			 <?php $emails = set_value('emails') == false ? @$result->email_id : set_value('emails'); 


	                     			 ?>
						 		 	<input type="text" id="is_ajax_email" class="  " name="emails" value="<?=$emails;?>" /> <span id="email_error" class="error_form">
						  			<small class="error_form"><?php echo form_error('emails'); ?><?php echo $error_msg_email; ?></small> 
									
								</div>

						</div>
						</div>
						
					</div>
				
				</div>
				<div class="form-row row-fluid">
					<div class="span5">
					<div class="row-fluid">
						<div class="span5">
					  		<label class="form-label " for="focusedInput"><?=lang('department')?><em>*</em></label>
						</div>
						<div class="span7">
						  <select name="department" id="department" class=" nostyle chosen-select"  required>
									<option value="">Select</option>
										 <?php   if(isset($department) && is_array($department)){
	                                                    foreach($department as $i_key => $i_val){
	                                               ?>
	                                               <?php $department = set_value('department') == false ? @$result->department : set_value('department'); 


	                                                ?>
	                                               <option value="<?=$i_val->id;?>" <?= ($department == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
	                                               <?php } }?>
																		</select>   

								<span id="department_error" class="error_form">
											<small class="error_form"><?php echo form_error('department'); ?></small>
									

								</span>
						</div>
					</div>
				</div>
					
					
					<div class="span7">
						<div class="row-fluid">
							<div class="span4">
								
								<label class="form-label " for="focusedInput"><?=lang('designation')?><em>*</em></label>
							</div>
							<div class="span6">
								
									<select name="designation" id="designation" class=" nostyle chosen-select" required>
									<option value="">Select</option>
									 <?php  if(isset($designation) && is_array($designation)){
                                                    foreach($designation as $i_key => $i_val){
                                               ?>
                                                <?php $designation = set_value('designation') == false ? @$result->designation : set_value('designation'); 


                                                ?>
                                               <option value="<?=$i_val->id;?>" <?= ($designation == $i_val->id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                                               <?php } }?>
									</select>
									<span id="designation_error" class="error_form">   
									<small class="error_form"><?php echo form_error('designation'); ?></small> 
									</span>      
							</div>
						</div>
					</div>
					
				</div>
				
				
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span5">
					<div class="row-fluid">
						<div class="span5">
					  		<label class="form-label " for="focusedInput"><?=lang('previous_company')?><em>*</em></label>
						</div>

						<div class="span7" style="width: 240px;">
							
					  			<?php $previous_company = set_value('previous_company') == false ? @$result->previous_company : set_value('previous_company'); 


                      			?>
					  		<input type="text" id="previous_company"  class=" " name="previous_company" value="<?=$previous_company;?>" />   
								<span id="previous_company_error" class="error_form"> 
					  				<small class="error_form"><?php echo form_error('previous_company'); ?></small>                          

								</span>
						</div>
					</div>
				</div>
					
					
					<div class="span7">
						<div class="row-fluid">
							<div class="span4">
								
								<label class="form-label " for="focusedInput"><?=lang('personal_mobile_number')?></label>
							</div>
							<div class="span6" style="width: 293px;">
								
								<input type="text" class="number" oninput="this.value=this.value.replace(/[^0-9]/g,'');"  name="personal_mobile_number"  maxlength="10" value="<?=isset($result->secondary_phone)?$result->secondary_phone:'';?>" <?=$readonly?>/>
							</div>
						</div>
					</div>
					
				</div>
				
				
				<div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
							<div class="span5">
								
								<label class="form-label " for="normal"><?=lang('personal_email')?></label>
							</div>
							<div class="span7" style="width: 240px;">
								
								<input type="text" class=" "  name="personal_email" value="<?=isset($result->personal_email)?$result->personal_email:'';?>" <?=$readonly?>/>
							</div>
						</div>
					</div>
					
					
					<div class="span7">
						<div class="row-fluid">
							<div class="span4">
								
							<label class="form-label " for="focusedInput"><?=lang('company_status')?><em>*</em></label>
							</div>
							<div class="span6">
								
								<select name="company_status" id="company_status" class=" nostyle chosen-select" required>
									<?php $company_status = set_value('company_status') == false ? @$result->company_status : set_value('company_status'); 


		                                                ?>
										<option value="">Select</option>
										<option value="current" <?= ($company_status == "current")?"selected='selected'":"" ?>>Working</option>
										<option value="current" <?= ($company_status == "left")?"selected='selected'":"" ?>>Left</option>
							


                           </select>
                           <span id="company_status_error" class="error_form">
                           		<small class="error_form"><?php echo form_error('company_status'); ?></small>
                           	</span>
							</div>
						</div>
					</div>
					
				</div>
				
				
				
				
				
				
				
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
							<div class="span5">
								
							<label class="form-label " for="normal"><?=lang('notes')?></label>
							</div>
							<div class="span7" style="width: 240px;">
								
							<textarea name="notes" class=" elastic uniform" <?php if(isset($readonly)){ echo "disabled='true'";} ?> ><?=isset($result->notes)?$result->notes:'';?></textarea>
							</div>
						</div>
					</div>
					
					
					<div class="span7">
						<div class="row-fluid">
							<div class="span4">
								
							<label class="form-label " for="focusedInput"><?=lang('hot_contact')?></label>
							</div>
							<div class="">
								
							  <input type="checkbox"  name="hot_contact" id="hot_contact" value="1" <?php if(isset($result->hot_contact) && $result->hot_contact == 1){echo "checked"; } ?> <?php if(isset($readonly)){ echo "disabled='true'";} ?> onclick="return displayComent(this.value);"/>
							</div>
						</div>
					</div>
				</div>
				
				  <div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
							
						</div>
					</div>
                    
					<div class="span7" style="display:<?php if(isset($result->hot_contact) && $result->hot_contact == 1){echo "block"; }else{ echo 'none';} ?>" id="display">
						<div class="row-fluid">
							<div class="span4">
								
							<label class="form-label " for="normal"><?=lang('hot_contact_comment')?></label>
							</div>
							<textarea name="hot_contact_comment" style="margin-left: 213px;" class="span6 elastic uniform"<?php if(isset($readonly)){ echo "disabled='true'";} ?> ><?=isset($result->hot_contact_comment)?$result->hot_contact_comment:'';?></textarea>
						</div>
					</div>				
					
					
		                  </div>
                            
                           <!-- <div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
							<label class="form-label span5" for="normal"><?=lang('Contacter')?><em>*</em></label>
							  <input type="checkbox"  name="campany_doc"  id="campany_doc" value="1" <?php if(isset($result->campany_doc) && $result->campany_doc==1){echo "checked"; } ?>/></div>
					</div>
                    
					<div class="span7" >
						<div id="campany_doc_file" style="display:<?php if(isset($result->campany_doc) && $result->campany_doc ==1){ echo 'block';}else{echo 'none;';}?>">
								<div class="row-fluid">
									<label class="form-label span4" for="focusedInput">Upload</label>									
									  <input type="file" name="fileToUpload[]" id="fileToUpload[]" multiple />
								</div>

								<?php                                                                
										if(isset($result->campany_doc)&&($result->campany_doc==1)){											
											//pr($vendor_doc->file_name);
												foreach($campany_doc_file as $key=>$value){
												$backsilas='/';									  ?>
												<div style="border:1px #ccc solid;margin-left:27px;margin-bottom:5px;padding:2px;width:455px;" id="del_<?=$value->file_id?>">
													<a href="<?=base_url('Contacter_doc/').$backsilas.$value->doc_file;?>" target="_blank"/><?=$value->file_name;?></a>
													<span style="float:right"><a href="javascript:void(0);" onClick="removeUpl('<?=$value->file_id?>','<?=$value->doc_file?>')">Delete</a></span>
												</div>
									  <?php

												
											}
										}
									  ?>
							</div>
					</div>				
					
					
		                  </div>-->
                            
                            
				
				<div class="form-row row-fluid">
					<div class="span5">
						<div class="row-fluid">
							<div class="span5">
								
								<label class="form-label " for="normal"><?=lang('assign_group')?><em>*</em></label>
							</div>
							
								<div class="span7">
									<select onchange="get_employee(this)" name="assign_group[]" id="assign_group" class="assign_group_multiselect nostyle"  multiple>
									<?php 
										if(isset($result->group_id)){
									$group_id_arr =explode(',',$result->group_id);
									}
									
									?>
										<?php foreach($user_groups as $row):
											
												//$assign_group = set_value('assign_group[]') == false ? @$result->assign_group : set_value('assign_group[]'); 
												
												if(in_array($row->id,$group_id_arr)){
														$selected = "selected";
												}else{
													$selected='';
												}
											
											

											?>
										<option value="<?=$row->id;?>" <?php if(isset($selected)){ echo $selected; } ?> ><?=ucfirst($row->name)?> </option>
										<?php endforeach; ?>
									</select>
									<span id="assign_group_error" class="error_form">
                           		<small class="error_form"><?php echo form_error('assign_group'); ?></small>
                           	</span>
								</div>
							
						</div>
					</div>
					
					
					<div class="span7">
						<div class="row-fluid">
							<div class="span4">
								
								<label class="form-label " for="focusedInput"><?=lang('assign_user')?><em>*</em></label> 
							</div>
							<div class="row-fluid">
								<div class="span6 " style="margin-left: 18px;">
									<select name="assign_user[]" multiple id="assign_user" class="nostyle assign_group_multiselect"  <?php if($readonly != NULL)echo 'disabled="true"';?> >
										<!-- <option value="" >Select Employee</option> -->
										<?php 
                                        $assign_user_arr = [];
											if(isset($result->assign_users)){
												$assign_user_arr = explode(',',$result->assign_users);
												//pr($assign_user_arr);
											}?>
											<?php 
											foreach($assign_user as $row): 
												// pr($assign_user_arr);
												
												if(in_array($row->id,$assign_user_arr)){
													$selected = "selected";
												}else{
													$selected='';
												}?>
											<option value="<?=$row->id?>" <?php  if(isset($selected) ){ echo $selected ;}?> ><?=$row->first_name." ".$row->last_name?></option>
											<?php endforeach; ?>                                            
									</select>
									<span id="assign_user_error" class="error_form">
                           		<small class="error_form"><?php echo form_error('assign_user'); ?></small>
                           	</span>
								 </div>
							 </div>
						</div>
					</div>
					
				</div>
				
				<div class="form-row row-fluid">
					<div class="span5" style="margin-top:10px;">
						<div class="row-fluid">
							<div class="span5" >
								
								<label class="form-label " for="normal">Prioritize the client(1 to 5, 5 to max)<em>*</em></label>
							</div>
							<div class="row-fluid">
								<div class="span7" style="margin-left: 10px;">
										<?php $rating = set_value('rating') == false ? @$result->rating : set_value('rating'); 


                                                ?>
									<fieldset id='demo2' class="rating">
										<input class="stars " type="radio" id="star1" name="rating" value="1" <?php  if($rating == 1){ echo "checked" ; } ?> />
										1 <i class="fa fa-star" aria-hidden="true"></i>
										<input class="stars " type="radio" id="star2" name="rating" value="2" <?php  if($rating == 2){ echo "checked" ; } ?> />
										2 <i class="fa fa-star" aria-hidden="true"></i>
										<input class="stars " type="radio" id="star3" name="rating" value="3" <?php  if($rating == 3){ echo "checked" ; } ?> />
										3 <i class="fa fa-star" aria-hidden="true"></i>
										<input class="stars " type="radio" id="star4" name="rating" value="4" <?php  if($rating == 4){ echo "checked" ; } ?> />
										4 <i class="fa fa-star" aria-hidden="true"></i>
										<input class="stars" type="radio" id="star5" name="rating" value="5" <?php  if($rating == 5){ echo "checked" ; } ?> />
										5 <i class="fa fa-star" aria-hidden="true"></i>
									</fieldset>
									<span id="rating_error" class="error_form">
									<small class="error_form"><?php echo form_error('rating'); ?></small>
								</span>
								</div>
							</div>
						</div>
					</div>
					
					
					<div class="span7">
						
					</div>
					
				</div>

				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">
								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button type="submit" onclick="return validate()"  class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button type="submit" onclick="return validate()" class="btn btn-info marginR10">
									<?=lang($action.'_button');?>
									</button>
									<?php } ?>


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
<script type="text/javascript">
	
	function displayComent(id){		
		if($("#hot_contact").prop('checked') == true){				
			$('#display').show();
		}else{								
			
			$('#display').hide();
		}
	}
	
	$(document).ready(function() {
    $(".txtboxToFilter").keydown(function(event) {
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





function checkUniqueness(primary_phone){

		var client_id_existance='';
		//alert(client_id); return false;
		$("#comapny_contact_existance_error").html("");
	    
	    var contact_id=$("#company_name option:selected").val();
	    
	    var id=$("#id_on_edit").val();
	    //alert(id);
		//alert(id);
		var status = 0;
	    var action="<?=SITE_PATH?>company/contact/checkContactExistence";
	    var str=token_name+"="+token_hash+"&primary_phone="+primary_phone+"&contact_id="+contact_id+"&id="+id;
		//alert(str); return false;
    	$.ajax({

    		url: action,
    		method:"POST",
    		data:str,
    		async:false,
	        success: function(data){
				
				if(data=="1")
		        { 
		        	$("#comapny_contact_existance_error").html('<label for="comapny_name" generated="true" class="error">Oops !! This company contact has been taken by someone else.</label>');
		        	status = 0;
		        }
		        else
		        {
		        	$("#comapny_contact_existance_error").html('');
		           	status = 1;
		        }
			}
    	});

    	return status;
	}





function checkOtherData(){

  status = 0;
  
  status_company_name = 0;
  status_contact_name = 0;
  status_primary_phone = 0;
  status_department = 0;
  status_designation = 0;
  status_previous_company = 0;
  status_company_status = 0;
  status_assign_group = 0;
  status_rating = 0;
  
  
   
   var company_name = $("#company_name").val();
   var contact_name = $("#contact_name").val();
   var primary_phone = $("#contact").val();
   var department = $("#department").val();
   var designation = $("#designation").val();
   var previous_company = $("#previous_company").val();
   var company_status = $("#company_status").val();
   var assign_group = $("#assign_group").val();
   var assign_user = $("#assign_user").val();
   var email = $("#is_ajax_email").val();
   var rating = $("input[name='rating']:checked").val();
   
   //alert(assign_group);
   
  
    if(company_name==''){
      status_company_name = 0;
      $("#comapny_name_existance_error").html('Client Name is required');
    }else{
      status_company_name=1;
      $("#comapny_name_existance_error").html('');
    }


    if(contact_name==''){
      status_contact_name = 0;
      $("#contact_name_existance_error").html('Contact Name is required');
    }else{
      status_contact_name = 1;
       $("#contact_name_existance_error").html('');
    }
    if(primary_phone=='' && email == ''){
      status_primary_phone = 0;
      $("#comapny_contact_existance_error").html('Primary Phone or Email is required');
      $("#email_error").html('Primary Phone or Email is required');
    }else{
      status_primary_phone=1;
       $("#comapny_contact_existance_error").html('');
       $("#email_error").html('');
    }

    if(department==''){
      status_department = 0;
      $("#department_error").html('Department is required');
    }else{
      status_department=1;
       $("#department_error").html('');
    }if(designation==''){
      status_designation = 0;
      $("#designation_error").html('Designation is required');
    }else{
      status_designation=1;
       $("#designation_error").html('');
    }if(previous_company==''){
      status_previous_company = 0;
      $("#previous_company_error").html('Previous Company is required');
    }else{
      status_previous_company=1;
       $("#previous_company_error").html('');
    }if(company_status==''){
      status_company_status = 0;
      $("#company_status_error").html('Company Status is required');
    }else{
      status_company_status=1;
       $("#company_status_error").html('');
    }if(assign_group=='' || assign_group== null){
      status_assign_group = 0;
      $("#assign_group_error").html('Assign Group is required');
    }else{
     status_assign_group=1;
       $("#assign_group_error").html('');
    }if(assign_user=='' || assign_user== null){
      status_assign_user = 0;
      $("#assign_user_error").html('Assign User is required');
    }else{
     status_assign_user=1;
       $("#assign_user_error").html('');
    } if(rating=='' || rating==undefined){
      status_rating = 0;
      $("#rating_error").html('Rating is required');
    }else{
      status_rating=1;
       $("#rating_error").html('');
    } 



 if(status_company_name == 1 && status_primary_phone && status_contact_name == 1  && status_department == 1 && status_designation == 1 && status_previous_company == 1 && status_company_status == 1 && status_assign_group == 1 && status_assign_user == 1 && status_rating == 1  ){
        status =1;
      }else{
        status = 0;
      }
    
  return status;

}



	function validate()
	{

		var error =0;
		var phone=$("#contact").val();
		 var checkOtherDatas = checkOtherData();
    if(phone){
        var status = checkUniqueness(phone);
      
        if(status==1 )
        {
          error =1;
        }
        else
        {
          error =0;
        }
      }

      if(checkOtherDatas==1){
      	 error =1;
      }else
        {
          error =0;
        }

        if(error){
           // return true;
        }else{
          return false;
        }
        
    
		
	}

	$("#contact ").blur(function(){
		var phone = $(this).val();
		var contact_id=$("#company_name option:selected").val();
		
    if(phone && contact_id!=''){
      checkUniqueness(phone);
    }
		
	});




</script>
