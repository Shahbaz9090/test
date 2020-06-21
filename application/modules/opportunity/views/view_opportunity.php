<style>
em{
    color:red;
}
.profile-info-name {
    width:15%;
}
</style>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                               
                                           
								
                           <!--     <?php echo form_open('',array('class'=>'form-horizontal','role'=>'form'));?>
									
                                    <?php
                                    $fields = _getField(1);
                                    foreach($fields as $key=>$val){
                                    ?>
                                    
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $val->label  ?> : </label>
										<div class="col-sm-9 user-info-view">
                                        <?php $field = _tableAttribute($val->label);
                                              if($val->label == 'Status'){
                                                    echo $status;
                                                } else{ 
                                                    if ($field == 'assigned_telemarketer') { // for assign telemarketer value
                                                        echo get_user_data(@$row->$field)->first_name. ' ' .get_user_data(@$row->$field)->last_name;
                                                    }else{
                                                        echo ucwords(@$row->$field);
                                        
                                                }
                                            }
                                        
                                        ?>
										</div>
									</div>
                                    
                                    
									<div class="space-4"></div>
                                    <?php
                                    }
                                    ?>
                                    
                                    
                                    <?php echo form_close();?>  -->


                                 <div  class="user-profile">
									

										<div class="col-xs-12 col-sm-12">
                                        
                                        <div class="col-sm-8">
                                        <div class="row">
                                        <div class="col-sm-1">
                                        <i class="glyphicon glyphicon-th-list" style="font-size: 35px;"></i>
                                         
                                         </div>
                                        <div class="col-sm-11 margin0px">
                                        <b><?=@$row->company_name?></b>
                                        <span class="row">
                                        <span class="designation_label">&nbsp;<?=@$row->company_contact;?></span>
                                        <span class="company_label"></span></span></div>
                                         </div>
                                           </div>
											<div class="col-sm-4">
                                            <div class="btn-group"><a class="btn btn-default btn-sm" href="<?=base_url()?>opportunity/edit/<?=@$row->id;?>">Edit</a></div>
                                            <span class="btn btn-app btn-sm <?php if(@strtolower($row->status)=='active'){?>btn-yellow<?php }else{ ?>btn-pink <?php } ?>  no-hover" style="line-height: 0.5;">
													<span class="line-height-1 smaller-80"> <?php echo ucwords(@$row->status);?> </span>
												</span>
                                               <ul class="dropdown-menu pull-right" role="menu">
                                                 <li><a href="#">Action</a></li>
                                                  <li><a href="#">Another action</a></li>
                                                     <li class="divider"></li>
                                                        <li><a href="#">Separated link</a></li>
                                                          </ul>
                                               
                                               </div>

                                             
											</div>
                                            

											<div class="space-12"></div>

											<!-- #section:pages/profile.info -->
                                            <div class="row">
                                            <div class="col-sm-12">
											<div class="profile-user-info profile-user-info-striped">
                                              <?php
                                                $fields = _getField(1);
                                                foreach($fields as $key=>$val){
                                              ?>
												<div class="profile-info-row">
													<div class="profile-info-name"><?php echo $val->label;?></div>

													<div class="profile-info-value">
                                                    <?php $field = _tableAttribute($val->label); ?>
														<span class="editable" id="<?=$field;?>"><?php echo ucwords(@$row->$field);?></span>
													</div>
												</div>
                                                
                                               <?php
                                                }
                                               ?> 
											</div>
                                            </div>
                                           
                                            </div>
                                           
										</div>

							

							</div><!-- /.col -->
						</div><!-- /.row -->