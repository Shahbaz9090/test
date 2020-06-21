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
			
			
				<?php echo get_flashdata();?>
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('contact_info')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('name')?></label>
							  <div class="row-fluid">
								<div class="span6 ">
								<?php if(!empty($result->supplier_name)){ ?>
								<p><?= ucwords($result->supplier_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							 </div>
						</div>
					</div>	
                </div>
				
				
				
				<!---contact information----------->
				
				
						
				
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
                </div>
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

