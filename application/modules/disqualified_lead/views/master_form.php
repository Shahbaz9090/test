<input type="hidden" id="comp_id_for_contact" name="comp_id_for_contact">
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('name')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<input type="hidden" name="company_id" value="<?=$row->company_name?>">
								<input type="hidden" name="contact_id" value="<?=$row->company_contact?>">
								<?php $company_text = set_value('company_text') == false ? @$row->companys_name : set_value('company_text'); ?>
								<!--<input type="hidden" value="<?=$row->company_name?>">-->
								<input name="company_name" type="<?= ($this->uri->segment(2) == 'add')?"text":"hidden" ?>" class="col-xs-10 col-sm-6 pull-right" id="" value="<?php if(isset($company_id)){echo $company_id;}else if(@$row->company_name){ echo $row->company_name;}?>"/>
								 <input name="company_text" type="<?= ($this->uri->segment(2) == 'add')?"hidden":"text" ?>" id="company_text" class="col-xs-10 col-sm-6 pull-right" value="<?php echo $company_text ?>"   />
								 <span id="comapny_name_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('company_text'); ?></small>

                               </span>
								 <div id="company_name_list"></div> 
							    <input type="hidden" name="company_name_on_edit" id="company_name_on_edit" value="<?=$row->main_id?>">
								 <span id="company_name_existance_error" class="error_form">
                                 <small class="error_form"><?php echo form_error('name'); ?><?php echo $error_msg; ?></small>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6 ">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('industry_type')?></label>
							 <div class="row-fluid">
								<div class="span6 select_style_margin-left"> 
								  <select name="industry" class="nostyle chosen-select" data-placeholder="Select..." id="industry">
									<option value="">Select</option>
                                               <?php if(isset($industry) && is_array($industry)){
                                                    foreach($industry as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->id;?>" <?= ($row->comp_industry == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->name; ?></option>
                                               <?php } }?>

									</select>
									<span class="error_form" id="industry_error">

											<small class="error_form"><?php echo form_error('industry'); ?></small>
										</span>
							 </div>
						   </div>
						</div>
					</div>
                </div>
				
					<div class="form-row row-fluid">
					
                     <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('company_address')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  
								  
								  	<textarea name="company_address" id="company_address" class="col-xs-10 col-sm-6 pull-right"  ><?= $row->company_address;?></textarea>
									<span class="error_form" id="company_address_error">
									<small class="error_form"><?php echo form_error('company_address'); ?></small>
								</span>
								  
							 </div>
						   </div>
						</div>
					</div>
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_establishment')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="type_of_establishment" class="nostyle chosen-select"   id="type_of_establishment">
									<option value="">Select</option>
									<?php if(isset($client_type_establishment) && is_array($client_type_establishment)){
                                                    foreach($client_type_establishment as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->form_id;?>" <?= ($row->type_of_establishment == $i_val->form_id)?"selected='selected'":"" ?>><?=$i_val->name; ?></option>
                                               <?php } }?>
																	</select>
								<span class="error_form" id="type_of_establishment_error">
								<small class="error_form"><?php echo form_error('type_of_establishment'); ?></small>
								</span>
								</div>
							 </div>
						</div>
						
						
					</div>	
                </div>
				

				<div class="form-row row-fluid">
					
                    <div class="span6">
					
					
					<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('country')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="country" class="nostyle chosen-select" onChange="fetch_state(this.value);"  id="country">
									<option value="">Select</option>
									 <?php if(isset($country) && is_array($country)){
                                                    foreach($country as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->id;?>" <?= ($row->country == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->country_name; ?></option>
                                               <?php } }?>
								</select>
								<span class="error_form" id="country_error">
                                  <small class="error_form"><?php echo form_error('country'); ?></small>
                                </span>
								</div>
							 </div>
						</div>
						
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('city_code')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="city_code" value="<?php echo  @$row->city_code; ?>" name="city_code" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
					
					
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
							<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('state')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="state_comp" class="nostyle chosen-select" id="state_comp" onChange="fetch_city(this.value);">
								
								
								
								
								
									<option value="">Select</option>
									 <?php if(isset($state) && is_array($state)){
                                                    foreach($state as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->id;?>" <?= ($row->state_comp == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->state_name; ?></option>
                                               <?php } }?>
																	</select>
								<span class="error_form" id="state_error">
                    <small class="error_form"><?php echo form_error('state_comp'); ?></small>
                  </span>
								</div>
							 </div>
						</div>
					</div>	
                  <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('landline')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="landline" value="<?php echo  @$row->landline; ?>" name="landline" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
                </div>
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('city')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="city_comp" class="nostyle chosen-select"  id="city_comp">
									<option value="">Select</option>
									<?php if(isset($city) && is_array($city)){
                                                    foreach($city as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->id;?>" <?= ($row->city_comp == $i_val->id)?"selected='selected'":"" ?>><?=$i_val->city_name; ?></option>
                                               <?php } }?>
																	</select>
								<span class="error_form" id="city_error">
                 <small class="error_form"><?php echo form_error('city_comp'); ?></small>
               </span>
								</div>
							 </div>
						</div>
					</div>	
                   <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('type_of_client')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								
								<select name="type_of_client" class="nostyle chosen-select"   id="type_of_client">
									<option value="">Select</option>
									<?php if(isset($type_of_client) && is_array($type_of_client)){
                                                    foreach($type_of_client as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->form_id;?>" <?= ($row->type_of_client == $i_val->form_id)?"selected='selected'":"" ?>><?=$i_val->name; ?></option>
                                               <?php } }?>
																	</select>
								<span class="error_form" id="type_of_client_error">
                 <small class="error_form"><?php echo form_error('type_of_client'); ?></small>
               </span>
								</div>
							 </div>
						</div>
						
						
					</div>
                </div>
				
				<div class="form-row row-fluid">
						<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('pincode')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="pincode" value="<?php echo  @$row->pincode; ?>" name="pincode" class="col-xs-10 col-sm-6 pull-right" />
								<span class="error_form" id="pincode_error">
                 <small class="error_form"><?php echo form_error('pincode'); ?></small>
               </span>
								</div>
							 </div>
						</div>
					</div>
                   <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('plant_established_year')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								
								
								<!--<select name="plant_established_year" class="nostyle" >
									<option value="">Select</option>
																	</select>-->
																	<input type="text" id="plant_established_year" value="<?php echo  @$row->plant_established_year; ?>" name="plant_established_year" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
				  <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('cordinates')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="cordinates" value="<?php echo  @$row->cordinates; ?>" name="cordinates" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
				
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('website_address')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" id="website_address" value="<?php echo  @$row->website; ?>" name="website_address" class="col-xs-10 col-sm-6 pull-right" />
								</div>
							 </div>
						</div>
					</div>
					<!--<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('referral_source')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6">
								
								<select name="referral_source[]" class="chosen-select nostyle" >
									<option value="">Select</option>
																	</select>
								</div>
							 </div>
						</div>
					</div> -->	


							
                   
                </div>
				<!------------ Tax Info-->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('tax_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('pan')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <input type="text" value="<?php echo  @$row->tax_pan; ?>" id="pan" name="pan" class="col-xs-10 col-sm-6 pull-right"  />
								  
								  <span class="error_form" id="pan_error">
                  <small class="error_form"><?php echo form_error('pan'); ?></small>
                </span>
						
							 </div>
						   </div>
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('cin')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								 <input type="text" value="<?php echo  @$row->tax_cin; ?>" id="cin" name="cin" class="col-xs-10 col-sm-6 pull-right"  />
								 <span class="error_form" id="cin_error">
                  <small class="error_form"><?php echo form_error('cin'); ?></small>
                </span>
								</div>
							 </div>
						</div>
					</div>	
					
					
					
					
                </div>
				
				<div class="form-row row-fluid">
				
				
				  <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('gst')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <input type="text" value="<?php echo  @$row->tax_gst; ?>" id="gst" name="gst" class="col-xs-10 col-sm-6 pull-right"  />
								  
								  <span class="error_form" id="gst_error">
                  <small class="error_form"><?php echo form_error('gst'); ?></small>
                </span>
						
							 </div>
						   </div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('tan')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								 <input type="text" value="<?php echo  @$row->tax_tan; ?>" id="tan" name="tan" class="col-xs-10 col-sm-6 pull-right"  />
								  <span class="error_form" id="tan_error">
                 <small class="error_form"><?php echo form_error('tan'); ?></small>
               </span>
								</div>
							 </div>
						</div>
					</div>	
                  
                </div>
				
				

				
