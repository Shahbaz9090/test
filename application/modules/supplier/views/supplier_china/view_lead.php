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
					<!-- <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('vendor_data')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<?php if(!empty($result->vendor_data)){ ?>
								<p><?= ucwords($result->vendor_data); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div> -->
				
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('name')?></label>
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
                    <div class="span6 ">
                        <div class="row-fluid">
                            <label class="form-label span4" for="normal"><?=lang('vendor_type')?></label>
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
							<label class="form-label span4" for="normal"><?=lang('vendor_code')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<?php if(!empty($result->vendor_code)){ ?>
								<p><?= ucwords($result->vendor_code); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
                    <div class="span6">
                        <div class="row-fluid">
                            <label class="form-label span4" for="normal"><?=lang('vendor_address')?></label>
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
                </div>
				
				<div class="form-row row-fluid">
					
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('factory_warehouse_address')?></label>
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
                    <div class="span6">
                        <div class="row-fluid">
                            <label class="form-label span4" for="normal"><?=lang('state')?></label>
                              <div class="row-fluid">
                                <div class="span6">
                                
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
							<label class="form-label span4" for="normal"><?=lang('city')?></label>
							  <div class="row-fluid">
								<div class="span6">
								
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
                            <label class="form-label span4" for="normal"><?=lang('pincode')?></label>
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
							<label class="form-label span4" for="normal"><?=lang('city_code')?></label>
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
                            <label class="form-label span4" for="normal"><?=lang('landline')?></label>
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
							<label class="form-label span4" for="normal"><?=lang('website_address')?></label>
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
                    
				</div>
				
				<!------------ Tax Info-------->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('tax_info')?></h3>
					</div>
				</div>
				
				<div class="form-row row-fluid">
					 
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('tax_no')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<?php if(!empty($result->tax_no)){ ?>
								<p><?= ucwords($result->tax_no); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('bank_name')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<?php if(!empty($result->bank_name)){ 
								
									 if(isset($sup_china_bank_name) && is_array($sup_china_bank_name)){
                                                    foreach($sup_china_bank_name as $i_key => $i_val){
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
				</div>
				<div class="form-row row-fluid">
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('account_number')?></label>
							 <div class="row-fluid">
								<div class="span6">  
								  <?php if(!empty($result->account_number)){ ?>
								<p><?= ucwords($result->account_number); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
							 </div>
						   </div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('bank_address')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  <?php if(!empty($result->bank_address)){ ?>
								<p><?= ucwords($result->bank_address); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
							 </div>
						   </div>
						</div>
					</div>
                </div>

				<!---------------contact information------------------>
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
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('wechat')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->wechat)){?>
								<p><?= $result->wechat; ?></p>
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
						
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('qq_id')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->qq_id)){?>
								<p><?=$result->qq_id; ?></p>
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
								<p><?=$result->current_working?></p>
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

