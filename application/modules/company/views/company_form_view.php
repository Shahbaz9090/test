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

		word-break: break-all;

	}

 label{

	 font-weight:600;

 }

 

 

 

 

 









.vertical-scroller {

	height: 200px;

	width: 1036px;

	overflow-y: scroll;

}

.boxes{

	float:left;

	width: 1010px;

	border: 0px solid black;

	margin-top:4px;

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

						<h3><?=lang('company_info')?></h3>

					</div>

				</div>

				<div class="form-row row-fluid">

					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="focusedInput"><?=lang('client_id')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								<?php if(!empty($result->client_id)){ ?>

								<p><?= ucwords($result->client_id); ?></p>

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

							<label class="form-label span4" for="focusedInput"><?=lang('name')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								<?php if(!empty($result->name)){ ?>

								<p><?= ucwords($result->name); ?></p>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

								</div>

							 </div>

						</div>

					</div>	

                    <div class="span6 ">

						<div class="row-fluid">

							<label class="form-label span4" for="focusedInput"><?=lang('industry_type')?></label>

							 <div class="row-fluid">

								<div class="span6 select_style_margin-left">  

								  

								  <?php if(!empty($result->industry_name)){ ?>

								<p><?= ucwords($result->industry_name); ?></p>

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

							<label class="form-label span4" for="focusedInput"><?=lang('company_address')?></label>

							 <div class="row-fluid">

								<div class="span6 ">  

								  

								  <?php if(!empty($result->company_address)){ ?>

								<p><?= ucwords($result->company_address); ?></p>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

							 </div>

						   </div>

						</div>

					</div>

					

					<?php //pr($country);die;?> 

					





					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('type_of_establishment')?></label>

							  <div class="row-fluid">

								<?php if(isset($client_type_establishment) && is_array($client_type_establishment)){

                                                foreach($client_type_establishment as $i_key => $i_val){

													if($result->type_of_establishment == $i_val->form_id){ ?>

														<p><?=$i_val->name;?></p>

                                            <?php   } } ?>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

							</div>

						</div>

						

						

					</div>	











					

                </div>

				



				<div class="form-row row-fluid">

					

                    <div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('country')?></label>

							  <div class="row-fluid">

								<div class="span6 select_style_margin-left">

								

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

					

					

                </div>

				

				<div class="form-row row-fluid">

					 <div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('state')?></label>

							  <div class="row-fluid">

								<div class="span6 select_style_margin-left">

									

									<?php if(!empty($result->state_name)){ ?>

								<p><?= ucwords($result->state_name); ?></p>

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

							<label class="form-label span4" for="normal"><?=lang('city')?></label>

							  <div class="row-fluid">

								<div class="span6 select_style_margin-left">

								

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

							<label class="form-label span4" for="normal"><?=lang('type_of_client')?></label>

							  <div class="row-fluid">

								<?php if(isset($type_of_client) && is_array($type_of_client)){

                                                foreach($type_of_client as $i_key => $i_val){

													if($result->type_of_client == $i_val->form_id){ ?>

														<p><?=$i_val->name;?></p>

                                          <?php     } } ?>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

							</div>

						</div>

						

						

					</div>

                </div>

				

				<div class="form-row row-fluid">

					<!--<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('fax')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								<input type="text" id="fax" value="<?php echo  @$result->fax; ?>" name="fax" class="col-xs-10 col-sm-6 pull-right" />

								</div>

							 </div>

						</div>

					</div>-->	

					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="focusedInput"><?=lang('pincode')?></label>

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

                   <div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('plant_established_year')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								

								

								<?php if(!empty($result->plant_established_year)){ ?>

								<p><?= ucwords($result->plant_established_year); ?></p>

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

							<label class="form-label span4" for="normal"><?=lang('cordinates')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								<?php if(!empty($result->cordinates)){ ?>

								<p><?= ucwords($result->cordinates); ?></p>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

								</div>

							 </div>

						</div>

					</div>

					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="focusedInput"><?=lang('website')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(!empty($result->website)){ ?>

								<p><?= ucwords($result->website); ?></p>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

								</div>

							 </div>

						</div>

					</div>

					<!--<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('referral_source')?><em>*</em></label>

							  <div class="row-fluid">

								<div class="span6 select_style_margin-left">

								

								<select name="referral_source[]" class="chosen-select nostyle" >

									<option value="">Select</option>

																	</select>

								</div>

							 </div>

						</div>

					</div>	-->





							

                   

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

								  <?php if(!empty($result->tax_pan)){ ?>

								<p><?= ucwords($result->tax_pan); ?></p>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

						

							 </div>

						   </div>

						</div>

					</div>

					

					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('cin')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								<?php if(!empty($result->tax_cin)){ ?>

								<p><?= ucwords($result->tax_cin); ?></p>

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

							<label class="form-label span4" for="normal"><?=lang('gst')?></label>

							 <div class="row-fluid">

								<div class="span6 ">  

								  <?php if(!empty($result->tax_gst)){ ?>

								<p><?= ucwords($result->tax_gst); ?></p>

								<?php }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

						

							 </div>

						   </div>

						</div>

					</div>

					

					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('tan')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								

								 <?php if(!empty($result->tax_tan)){ ?>

								<p><?= ucwords($result->tax_tan); ?></p>

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

						<h3><?=lang('common_data_info')?></h3>

					</div>

				</div>

				

				<?php if(!empty($result->lead_sales_pcb_common_plc)) { 

				

				foreach($result->lead_sales_pcb_common_plc as $val_plc){

				?>

				<div class="form-row row-fluid">

					<div class="span6">

						<div class="row-fluid">

						

							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('plc_dcs_make')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(isset($plc_dcs_make) && is_array($plc_dcs_make)){

                                                foreach($plc_dcs_make as $i_key => $i_val){

													if($val_plc->plc_dcs_make == $i_val->form_id){

														echo $i_val->name;

                                               } } ?>

                                <?php }else { ?>

								<p>-/-</p>

								 <?php } ?>

								</div>

							 </div>

							

						</div>

						

					</div>	

                    <div class="span6">

						<div class="row-fluid">

						

							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('plc_dcs_qty')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(!empty($val_plc->plc_dcs_qty)){?>

								<p><?=$val_plc->plc_dcs_qty; ?></p>

                                <?php }else { ?>

								<p>-/-</p>

								 <?php } ?>

								</div>

							 </div>

						

						</div>

					</div>

                </div>

				<?php }  } ?>	

				

				<?php if(!empty($result->lead_sales_pcb_common_actuator)) { 

				

				foreach($result->lead_sales_pcb_common_actuator as $val_actuator){

				?>

				<div class="form-row row-fluid">

					<div class="span6">

						<div class="row-fluid">

						

							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('actuator_make')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(isset($actuator_make) && is_array($actuator_make)){

                                                foreach($actuator_make as $i_key => $i_val){

													if($val_actuator->actuator_make == $i_val->form_id){

														echo $i_val->name;

                                               } } ?>

                                <?php }else { ?>

								<p>-/-</p>

								 <?php } ?>

								</div>

							 </div>

							

						</div>

						

					</div>	

                    <div class="span6">

						<div class="row-fluid">

						

							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('actuator_qty')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(!empty($val_actuator->actuator_qty)){?>

								<p><?=$val_actuator->actuator_qty; ?></p>

                                <?php }else { ?>

								<p>-/-</p>

								 <?php } ?>

								</div>

							 </div>

						

						</div>

					</div>

                </div>

				<?php }  } ?>	

				

				<?php if(!empty($result->lead_sales_pcb_common_vfd)) { 

				

				foreach($result->lead_sales_pcb_common_vfd as $val_vfd){

				?>

				<div class="form-row row-fluid">

					<div class="span6">

						<div class="row-fluid">

						

							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('vfd_make')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(isset($vfd_make) && is_array($vfd_make)){

                                                foreach($vfd_make as $i_key => $i_val){

													if($val_vfd->vfd_make == $i_val->form_id){

														echo $i_val->name;

                                               } } ?>

                                <?php }else { ?>

								<p>-/-</p>

								 <?php } ?>

								</div>

							 </div>

							

						</div>

						

					</div>	

                    <div class="span6">

						<div class="row-fluid">

						

							<label class="form-label span6" style="font-weight: 900;" for="normal"><?=lang('vfd_qty')?></label>

							  <div class="row-fluid">

								<div class="span6 ">

								<?php if(!empty($val_vfd->vfd_qty)){?>

								<p><?=$val_vfd->vfd_qty; ?></p>

                                <?php }else { ?>

								<p>-/-</p>

								 <?php } ?>

								</div>

							 </div>

						

						</div>

					</div>

                </div>

				<?php }  } ?>

				

				<div class="form-row row-fluid">

					<div class="form-actions">

						<h3><?=lang('documents')?></h3>

					</div>

				</div>

				<div class="form-row row-fluid">
			<?php if(!empty($document)){ ?>

				<?php  foreach($document as $key=>$val){ ?>

					<div class="span6">

						<div class="row-fluid">

							<label class="form-label span4" for="normal"><?=lang('doc_upload')?></label>

							 <div class="row-fluid">

								<div class="span6 ">  

								<?php if(!empty($val->filename)){ ?>

								<p><?= ucwords($val->filename); ?>

								<?php 

										if(isset($val->filename) && !empty($val->filename))

										{

											

												$ext = $val->filename;

												$ext = substr($ext, strripos($ext, '.')+1);

												if($ext=='jpg' || $ext=='jpeg' || $ext == 'png')

												{ ?>

													<a download href="<?=base_url('upload/company_doc/'.$val->filename)?>"><img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('upload/company_doc/'.$val->filename)?>"/></a>



												<?php } else{?>

													<a download href="<?=base_url('upload/company_doc/'.$val->filename)?>"><img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('assets/images/file_icon.png')?>"/></a>

												<?php }

											

										}  

								?></p>

								<?php   }else{ ?>

								<p><?="N/A"?></p>

								<?php } ?>

						<?php } ?>

							 </div>

						   </div>

						</div>

					</div>

				<?php } ?>

				</div>

				<div class="form-row row-fluid">

					<div class="form-actions">

						<h3><?=lang('doc_notes')?></h3>

					</div>

				</div>

				<?php if(!empty($notes)){   ?>

                    <div class="span12">

						<div class="row-fluid" >

							<div class="widget-box widget-color-blue">

									<div class="widget-header widget-header-small">

										<h5 class="widget-title bigger lighter">

											<!--<i class="ace-icon fa fa-rss"></i>Old Notes -->

										</h5>

									</div>

									<div class="widget-body vertical-scroller">

										<div class="widget-main">

											<div class="row-fluid">

												<div class="span12">

													<div class="widget-box transparent">

														<div class="widget-body">

															<div class="widget-main padding-8">

																<div  class="profile-feed my-scroll">

																	<?php if(isset($notes) && is_array($notes)){

																	foreach($notes as $i_key => $i_val){ ?>

																		<div class="boxes">

																			<p style="float:left"><b><?=ucwords($i_val->notes)?></b></p><br>

																			<p style="float:left">___________________________________________________________________________________________________________________________________________________________________________________________</p><br>

																		</div>

																		<?php //echo "</br>";

																		} }  ?>

																	</div>

																</div>

															</div>

														</div>

													</div>

												</div>

											</div>

										</div>

									</div>

							</div>

						</div>

					<?php } ?>

               

				

				<div class="center" style="margin-top:30px">

                <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>

                

            `	</div>

			</div>

		</div>

	</div>

</div>