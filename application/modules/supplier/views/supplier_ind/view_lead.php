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

	p{
		line-height:30px;
	}
	label{
	 font-weight:600;
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
			
			
				<?php echo get_flashdata(); ?>
				
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('supplier_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('name')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->vendor_names)){ ?>
								<p><?= ucwords($result->vendor_names); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('vendor_type')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(isset($vendor) && is_array($vendor)){
                                                foreach($vendor as $i_key => $i_val){
													if($result->vendor_type == $i_val->id){
														echo $i_val->name;
                                               } } ?>
                               <?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>								
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('vendor_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->vendor_address)){ ?>
								<p><?= ucwords($result->vendor_address); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('factory_warehouse_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->factory_address)){ ?>
								<p><?= ucwords($result->factory_address); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('country')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->country_name)){ ?>
								<p><?= ucwords($result->country_name); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('state')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->state_name)){ ?>
								<p><?= ucwords($result->state_name); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('city')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->city_name)){ ?>
								<p><?= ucwords($result->city_name); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('pincode')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->pincode)){ ?>
								<p><?= ucwords($result->pincode); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('city_code')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->city_code)){ ?>
								<p><?= ucwords($result->city_code); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('landline')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->landline)){ ?>
								<p><?= ucwords($result->landline); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('plant_established_year')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->established_year)){ ?>
								<p><?= ucwords($result->established_year); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('type_of_establishment')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								
								<?php if(!empty($result->type_of_establishment)){ 
								
									 if(isset($sup_ind_type_establishment) && is_array($sup_ind_type_establishment)){
                                                    foreach($sup_ind_type_establishment as $i_key => $i_val){
														if($result->type_of_establishment == $i_val->form_id){
								
								?>
									 <p><?= ucwords($i_val->name); }}}?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								
								
								
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('website_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->website_address)){ ?>
								<p><?= ucwords($result->website_address); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('item_service_description')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->item_description)){ ?>
								<p><?=ucwords($result->item_description); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('tax_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('cin')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->cin_no)){ ?>
								<p><?= ucwords($result->cin_no); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('pan')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->pan_no)){ ?>
								<p><?=ucwords($result->pan_no); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('iec')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->iec_no)){ ?>
								<p><?= ucwords($result->iec_no); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('gst')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->gst_no)){ ?>
								<p><?=ucwords($result->gst_no); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('tds_section')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->tds_section)){ ?>
								<p><?= ucwords($result->tds_section); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('tds_age')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->tds_age)){ ?>
								<p><?=ucwords($result->tds_age); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('msme')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->msme)){ ?>
								<p><?php 
								if($result->msme=='1'){ echo "yes";}
								if($result->msme=='2'){ echo "no";}
								?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('msme_number')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->msme_number)){ ?>
								<p><?=ucwords($result->msme_number); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('bank_detail_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('bank_name')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->bank_name)){ 
								
									 if(isset($sup_india_bank_name) && is_array($sup_india_bank_name)){
                                                    foreach($sup_india_bank_name as $i_key => $i_val){
														if($result->bank_name == $i_val->form_id){
								
								?>
									 <p><?= ucwords($i_val->name); }}}?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('account_number')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->account_number)){ ?>
								<p><?=ucwords($result->account_number); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('type_of_account')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->account_type)){ ?>
								<p><?php 
								if($result->account_type=='1'){ echo "Current";}
								if($result->account_type=='2'){ echo "Saving";}
								if($result->account_type=='3'){ echo "OD";}
								if($result->account_type=='4'){ echo "CC";}
								?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('bank_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->bank_address)){ ?>
								<p><?=ucwords($result->bank_address); ?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('ifsc_code')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->ifsc_code)){ ?>
								<p><?=ucwords($result->ifsc_code);?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('other_bank_name')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								
								<?php if(!empty($result->other_bank_name)){ 
								
									 if(isset($sup_india_bank_name) && is_array($sup_india_bank_name)){
                                                    foreach($sup_india_bank_name as $i_key => $i_val){
														if($result->other_bank_name == $i_val->form_id){
								
								?>
									 <p><?= ucwords($i_val->name); }}}?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								
								
								
								</div>
							 </div>
						</div>
					</div>	
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('account_number')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->other_account_number)){ ?>
								<p><?=ucwords($result->other_account_number);?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('type_of_account')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->other_account_type)){ ?>
								<p><?php 
								if($result->other_account_type=='1'){ echo "Current";}
								if($result->other_account_type=='2'){ echo "Saving";}
								if($result->other_account_type=='3'){ echo "OD";}
								if($result->other_account_type=='4'){ echo "CC";}
								?></p>
                               <?php }else{ ?>
								<p><?="N/A"?>	</p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                </div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('bank_address')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->other_bank_address)){ ?>
								<p><?=ucwords($result->other_bank_address);?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>	
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('ifsc_code')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->other_ifsc_code)){ ?>
								<p><?=ucwords($result->other_ifsc_code);?></p>
                               <?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                </div>
				
				
				<!---contact information----------->
				<!--<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('contact_info')?></h3>
					</div>
				</div>
				
						
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_mobile')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->primary_phone)){?>
								<p><?= $result->primary_phone; ?></p>
                               <?php }else { ?>
							    <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_email_company')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->email_id)){?>
								<p><?= $result->email_id ?></p>
                               <?php }else { ?>
							    <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->name)){?>
								<p><?= $result->name ?></p>
                               <?php }else { ?>
							    <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                   <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_previous_company')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->previous_company)){?>
								<p><?= $result->previous_company; ?></p>
                               <?php }else { ?>
							    <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                </div>
					
				
				<div class="form-row row-fluid">
					  <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_department')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->department_name)){?>
								<p><?= $result->department_name ?></p>
                               <?php }else { ?>
							    <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_personal_mobile')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->secondary_phone)){?>
								<p><?=$result->secondary_phone; ?></p>
                                <?php }else { ?>
								<p>N/A</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                </div>
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_designation')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->designation_name)){?>
								<p><?=$result->designation_name; ?></p>
                                <?php }else { ?>
								<p>N/A</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_email')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->personal_email)){?>
								<p><?= $result->personal_email ?></p>
                               <?php }else { ?>
							   <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_other_info')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->notes)){?>
								<p><?=$result->notes; ?></p>
                                <?php }else { ?>
								<p>N/A</p>
								 <?php } ?>
								</div>
							 </div>
							
						</div>
						
					</div>	
                    <div class="span6">
						<div class="row-fluid">
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('company_contact_person_current_company_status')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->current_working)){?>
								<p><?php   if($result->current_working=='current'){ echo "Working"; }
																	if($result->current_working=='left'){ echo "Left"; }
															?></p>
                               <?php }else { ?>
							   <p>N/A</p>
							   <?php } ?>
								</div>
							 </div>
						
						</div>
					</div>
                </div>-->
				<div class="center" style="margin-top:30px;">
                <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
                
            </div>
				

			</div>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>
<!-- End .row-fluid -->

