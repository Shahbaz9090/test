<style>
em{
    color:red;
}
.profile-info-name {
    width:15%;
}
</style>
<? $userinfo=currentuserinfo();?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

                                <?php echo form_open('',array('class'=>'form-horizontal','role'=>'form'));?>
									<!-- #section:elements.form -->
                                <!--    <?php
                                    $fields = _getField(1);_pr($row);
                                    foreach($fields as $key=>$val){
                                    ?>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $val->label  ?> : </label>
										<div class="col-sm-9 user-info-view">
                                        <?php $field = _tableAttribute($val->label);echo ucwords(@$row->$field);?>
										</div>
									</div>
                                    
                                    
									<div class="space-4"></div>
                                    <?php
                                    }
                                    ?>
                                    -->
                                    
                                    <?php echo form_close();?>



								

<div  class="user-profile">
									

										<div class="col-xs-12 col-sm-12">
                                        
                                        <div class="col-sm-5">
                                        <div class="row">
                                        <div class="col-sm-1">
                                        <i class="glyphicon glyphicon-th-list" style="font-size: 35px;"></i>
                                         
                                         </div>
                                        <div class="col-sm-11 margin0px">
                                        <b><?=@$row->name?></b>
                                        <span class="row">
                                        <span class="designation_label">&nbsp;<?=@$row->facility_type;?></span>
                                        <span class="company_label"></span></span></div>
                                         </div>
                                           </div>
											
                                             
											</div>
                                            

											<div class="space-12"></div>

											<!-- #section:pages/profile.info -->
                                            <div class="row">
                                            <div class="col-sm-12">
											<div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name">Facility Type</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->facility_type;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Name</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->name;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Currency</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->currency;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Amount</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->amount;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Commission</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->commission;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Description</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->description;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Remarks</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->remarks;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Status</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo $row->status;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Created</div>
													<div class="profile-info-value">
														<span class="editable" id="">
                                                            <?php   
                                                                echo formatDate($row->created);
                                                            ?>
                                                        </span>
													</div>
												</div>  
											</div>
                                            </div>
                                           <!-- <div class="col-sm-4 pull-right">
                                            <div class="panel panel-default">
                                              <div class="panel-body">
                                                <b>Activities</b>
                                                 </div>
                                                  </div>
                                                  
                                              <div class="panel panel-default">
                                              <div class="panel-body">
                                                <b>Updates</b>
                                                 </div>
                                                  </div>
                                            
                                               </div>-->
                                               
                                               
                                            </div>
                                            

											
										<!--	<div class="space-20"></div>

											<div class="widget-box transparent">
												<div class="widget-header widget-header-small">
													<h4 class="widget-title blue smaller">
														<i class="ace-icon fa fa-rss orange"></i>
														Other Information
													</h4>

												
												</div>

												<div class="widget-body">
                                                <div class="space-10"></div>
                                                <div class="profile-user-info profile-user-info-striped">
												<div class="profile-info-row">
													<div class="profile-info-name"> First Name </div>

													<div class="profile-info-value">
														<span class="editable" id="First Name">Gaurav</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Last Name </div>

													<div class="profile-info-value">
														<span class="editable" id="Last Name">Verma</span>
													</div>
												</div>
                                                
                                                 <div class="profile-info-row">
													<div class="profile-info-name">Primary Phone</div>

													<div class="profile-info-value">
														<span class="editable" id="Primary Phone"></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Company </div>

													<div class="profile-info-value">
														<span class="editable" id="Company"></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Lead Source </div>

													<div class="profile-info-value">
														<span class="editable" id="lead source"></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Primary Email </div>

													<div class="profile-info-value">
														<span class="editable" id="Primary Email"></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Website </div>

													<div class="profile-info-value">
														<span class="editable" id="Website"></span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Assigned To </div>

													<div class="profile-info-value">
														<span class="editable" id="Assigned to">Administrator</span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name"> City</div>

													<div class="profile-info-value">
														<span class="editable" id="City"></span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name"> Country </div>

													<div class="profile-info-value">
														<span class="editable" id="Country"></span>
													</div>
												</div>
                                                
                                                
											</div>
											        
												</div>
											</div>-->

											

											

										
										</div>
								

							

							</div><!-- /.col -->
						</div><!-- /.row -->
                        
                        <!---------------------Qualify Lead Modal------------------------->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Create Opportunity</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
							      <div class="col-xs-12">
                                  
                                  <?php echo form_open("lead/convert_lead/$row->id",array('class'=>'form-horizontal','role'=>'form'));?>
                                    <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Company Contact Person<em class="required_em">*</em> </label>
    									<div class="col-sm-8">
                                        <input type="text" name="company_contact_person" class="col-xs-10 col-sm-8" required='required' value="<?=@$row->company_contact_person;?>"/>                                       
    									</div>      
    								</div>   
                                    <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Contact Person Details<em class="required_em">*</em> </label>
    									<div class="col-sm-8">
                                        <textarea  name="contact_person_details" class="col-xs-10 col-sm-8" required='required'><?=@$row->contact_person_details;?></textarea>                                       
    									</div>  
    								</div>
                                 
                                 
                                 
                                   <!-- <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Assign to <em>*</em></label>
    									<div class="col-sm-8">
                                            <select name="assigned_to" class="col-xs-10 col-sm-8" required="required">
                                              <option value="">Select</option>
                                              <optgroup label="Group">
                                              <?php $group=get_groups();
                                                    foreach($group as $key=>$value){  
                                              ?>
                                              <option value="g_<?php echo $value->id;?>" ><?php echo $value->name;?></option>
                                              <?php } ?>
                                              </optgroup>
                                              <optgroup label="Users">
                                              <?php  $users=usersList();
                                                foreach($users as $key=>$value){  
                                              ?>
                                              <option value="u_<?php echo $value->id;?>" ><?php echo $value->first_name.' '.$value->last_name;?></option>
                                             <?php } ?>
                                             </optgroup>  
                                            </select>                                       
    									</div>      
                                   </div>-->
                                   	<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
										</div>
									</div>
                                   <? echo form_close();?>
                                   
                                 </div>
                              </div>       

                              </div>
                            </div>
                          </div>
                        </div>
                        <!------------------------------------------>         
                        
                        <!---------------------Assign Opportunity Modal------------------------->
                        <div class="modal fade" id="assignOppModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Create Opportunity</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
							      <div class="col-xs-12">
                                  
                                  <?php echo form_open("opportunity/assign_opportunity/$row->id",array('class'=>'form-horizontal','role'=>'form'));?>
                                    <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Company Contact Person<em class="required_em">*</em> </label>
    									<div class="col-sm-8">
                                        <input type="text" name="company_contact_person" class="col-xs-10 col-sm-8" required='required' value="<?=@$row->company_contact_person;?>"/>                                       
    									</div>      
    								</div>   
                                    <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Contact Person Details<em class="required_em">*</em> </label>
    									<div class="col-sm-8">
                                        <textarea  name="contact_person_details" class="col-xs-10 col-sm-8" required='required'><?=@$row->contact_person_details;?></textarea>                                       
    									</div>  
    								</div>
                                 
                                 
                                 
                                   <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Assign to <em>*</em></label>
    									<div class="col-sm-8">
                                            <select name="assigned_to" class="col-xs-10 col-sm-8" required="required">
                                              <option value="">Select</option>
                                              <optgroup label="My Self">
                                              <option value="<?php echo $userinfo->id;?>" ><?php echo $userinfo->name;?></option>
                                              </optgroup>
                                              <optgroup label="Sales Person">
                                              <?php  $users=usersList(SALES_PERSON);
                                                foreach($users as $key=>$value){  
                                              ?>
                                              <option value="<?php echo $value->id;?>" ><?php echo $value->name;?></option>
                                             <?php } ?>
                                             </optgroup>  
                                            </select>                                       
    									</div>      
                                   </div>
                                   	<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
										</div>
									</div>
                                   <? echo form_close();?>
                                   
                                 </div>
                              </div>       

                              </div>
                            </div>
                          </div>
                        </div>
                        <!------------------------------------------>  
                        <!---------------------Chage status Opportunity Modal------------------------->
                        <div class="modal fade" id="statusModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">Change Status</h4>
                              </div>
                              <div class="modal-body">
                                <div class="row">
							      <div class="col-xs-12">
                                  
                                  <?php echo form_open("opportunity/changeStatus/$row->id",array('class'=>'form-horizontal','role'=>'form'));?>
                                    <div class="form-group">
    									<label class="col-sm-4 control-label no-padding-right" for="form-field-1"> Status<em class="required_em">*</em> </label>
    									<div class="col-sm-8">
                                        <select name="status" class="col-xs-8 col-sm-8" required="required">
                                            <option value="">Select</option>
                                            <?php 
                                                $status = _leadStatus(); 
                                                  foreach($status as $k=>$v):
                                            ?>
                                                <option value="<?php echo $k  ?>"><?php echo $v  ?></option>
                                            <?php endforeach;  ?>
                                        </select>                                     
    									</div>      
    								</div>   
                                    
                                   	<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>
										</div>
									</div>
                                   <? echo form_close();?>
                                   
                                 </div>
                              </div>       

                              </div>
                            </div>
                          </div>
                        </div>
                        <!------------------------------------------>                   