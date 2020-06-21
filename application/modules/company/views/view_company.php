<style>
em{
    color:red;
}
.profile-info-name {    width:25%;}
.equal-width{width: 100% !important;
text-align: left;}
</style>
<?php  
if(isset($row)){ 
   $companyData = json_decode($row->company_data);
   $contactsData = _companyContacts(@$row->id);
}
?>		
						
                        <div class="row">    
							<div class="col-xs-12">
                            <div class="row">
                                <div class="col-xs-12"><?=get_flashdata();?></div>
                            </div>

                                <div  class="user-profile">
									

										<div class="col-xs-12 col-sm-12">
                                        
                                        <div class="col-sm-5">
                                        <div class="row">
                                        <div class="col-sm-1">
                                        <i class="glyphicon glyphicon-th-list" style="font-size: 35px;"></i>
                                         
                                         </div>
                                        <div class="col-sm-11 margin0px">
                                        <b><?=@$companyData->name?></b>
                                        <span class="row">
                                        <span class="designation_label">&nbsp;<?=@$companyData->website;?></span>
                                        <span class="company_label"></span></span></div>
                                         </div>
                                           </div>
											<div class="col-sm-7">
                                            <span style="float: right;">                                           
                                               <ul class="dropdown-menu pull-right" role="menu">
                                                 <li><a href="#">Action</a></li>
                                                 <li><a href="#">Another action</a></li>
                                                 <li class="divider"></li>
                                                 <li><a href="#">Separated link</a></li>
                                               </ul>
                                               </span>
                                               </div>

                                             
											</div>
											<div class="space-12"></div>
                                            <h4>Company Information</h4>

											<!-- #section:pages/profile.info -->
                                            <div class="row">
                                            <div class="col-sm-12">
											<div class="profile-user-info profile-user-info-striped">

                                                <div class="profile-info-row">
													<div class="profile-info-name">Company Name</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo ucwords(@$companyData->name);
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Company Website</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$companyData->website;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Company Address</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo ucwords(@$companyData->address);
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Contact Number</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$companyData->contact;
                                                            ?>
                                                        </span>
													</div>
												</div>

											</div>
                                            </div>

										</div><!--end row-->
                                        <h4>Company Contacts</h4>
                                        <?php if(isset($contactsData)){
                                              foreach($contactsData as $k=>$contactData):
                                              $contactInfo=json_decode($contactData->contacts_data);
                                        ?>
                                        <div class="space-12"></div>

											<!-- #section:pages/profile.info -->
                                            <div class="row">
                                            <div class="col-sm-12">
											<div class="profile-user-info profile-user-info-striped">

                                                <div class="profile-info-row">
													<div class="profile-info-name">Company Contact Person</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo ucwords(@$contactInfo->contact_person);
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Contact Person Email</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->email;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Contact Person Phone </div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->phone;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Address</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->address;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name">PO Box</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->po_box;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name">City</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->city;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name">State </div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->state;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name">Postal Code</div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo @$contactInfo->postal_code;
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                
                                                <div class="profile-info-row">
													<div class="profile-info-name">Country </div>
													<div class="profile-info-value">
														<span class="editable">
                                                            <?php   
                                                                echo _countryNameById(@$contactInfo->country);
                                                            ?>
                                                        </span>
													</div>
												</div>

											</div>
                                            </div>

										</div><!--end row-->
                                    <?php 
                                         endforeach;
                                         }
                                    ?> 
           
                                </div>
                               </div>
                             </div>    
                             
                              <!------------------------------Lead and Opportunity starts-------------------->                            
                               <div class="row mt10">
                    
                             <!--------------------------------Lead Panel----------------------------------------->
                                                  <div class="col-sm-6">
                                                    <div class="widget-box widget-color-blue">
        											<div class="widget-header widget-header-small">
        												<h5 class="widget-title bigger lighter">
        													<i class="ace-icon fa fa-rss"></i>Leads
        												</h5>
                                                    	</div>
                                     	              <div class="widget-body">
        												<div class="widget-main">
        											         <div class="row">
                                                               	<div class="col-sm-12">
                                                                  <div class="widget-box transparent">
                        												<div class="widget-body">
                        													<div class="widget-main padding-8">
                        														<div  class="profile-feed my-scroll">
                                                                                 <?php $leadsResult=_leadsByCompany($row->id,'');
                                                                                 $archevedResult=_leadsByCompany($row->id,'archieved');
                                                                                 if($leadsResult || $archevedResult){ ?>
                                                                                 <?php foreach($leadsResult as $lead_row){ ?>   
                                                                                    <div id="lead<?=$lead_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("lead/view/$lead_row->id");?>" target="_blank"> <?='#'.$lead_row->display_id;?> </a>
                        																	Type : Lead 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($lead_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("lead/view/$lead_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("lead/edit/$lead_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																	<!--<a href="javascript:void(0);" class="red" onclick="deleteProduct(<?=$row->id?>,<?=$product->id?>);"><i class="ace-icon fa fa-times bigger-125"></i></a>-->
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?>  
                                                                                    <?php foreach($archevedResult as $archived_row){ ?>   
                                                                                    <div id="lead<?=$archived_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("lead/view/$archived_row->id");?>" target="_blank"> <?='#'.$archived_row->display_id;?> </a>
                        																	Type : Archived 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($archived_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("lead/view/$archived_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("lead/edit/$archived_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?>  
                                                                                    <?php }else{ ?> 
                                                                                      No Data Found!
                                                                                    <?php } ?>  
                                                                                </div>
                        
                        														<!-- /section:pages/profile.feed -->
                        													 </div>
                        												   </div>
                        											      </div>
                                                                        </div>
                                                                     </div>
                    											</div>
                    										</div>
                                                        </div>
                                                      </div>
                                                 <!------------------------------------------------------------------------------->
                                                 <!--------------------------------Opporyunity Panel----------------------------------------->
                                                  <div class="col-sm-6">
                                                    <div class="widget-box widget-color-blue">
        											<div class="widget-header widget-header-small">
        												<h5 class="widget-title bigger lighter">
        													<i class="ace-icon fa fa-rss"></i>Opportunities
        												</h5>
                                                    	</div>
                                     	              <div class="widget-body">
        												<div class="widget-main">
        											         <div class="row">
                                                               	<div class="col-sm-12">
                                                                  <div class="widget-box transparent">
                        												<div class="widget-body">
                        													<div class="widget-main padding-8">
                        														<div class="profile-feed my-scroll">
                                                                                 <?php 
                                                                                 $unassignedResult=_opportunityByCompany($row->id,'unassigned');
                                                                                 $workingResult=_opportunityByCompany($row->id,'working');
                                                                                 $wonResult=_opportunityByCompany($row->id,'won');
                                                                                 $wonarchivedResult=_opportunityByCompany($row->id,'archieved');
                                                                                 $lostResult=_opportunityByCompany($row->id,'lost');
                                                                                 if($unassignedResult || $workingResult || $wonResult || $wonarchivedResult || $lostResult){ ?>
                                                                                 <?php foreach($unassignedResult as $unassigned_row){ ?>   
                                                                                    <div id="lead<?=$unassigned_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("opportunity/view/$unassigned_row->id");?>" target="_blank"> <?='#'.$unassigned_row->display_id;?> </a>
                        																	Type : Unassigned Opportunity 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($unassigned_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("opportunity/view/$unassigned_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("opportunity/edit/$unassigned_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?>  
                                                                                    <?php foreach($workingResult as $working_row){ ?>   
                                                                                    <div id="lead<?=$working_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("opportunity/view/$working_row->id");?>" target="_blank"> <?='#'.$working_row->display_id;?> </a>
                        																	Type : Working Opportunity 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($working_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("opportunity/view/$working_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("opportunity/edit/$working_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?>  
                                                                                    <?php foreach($wonResult as $won_row){ ?>   
                                                                                    <div id="lead<?=$won_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("opportunity/view/$won_row->id");?>" target="_blank"> <?='#'.$won_row->display_id;?> </a>
                        																	Type : Unbilled(Closed Won) Opportunity 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($won_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("opportunity/view/$won_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("opportunity/edit/$won_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?>  
                                                                                    <?php foreach($wonarchivedResult as $wonarchived_row){ ?>   
                                                                                    <div id="lead<?=$wonarchived_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("opportunity/view/$wonarchived_row->id");?>" target="_blank"> <?='#'.$wonarchived_row->display_id;?> </a>
                        																	Type : Archived(Closed Won)  Opportunity 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($wonarchived_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("opportunity/view/$wonarchived_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("opportunity/edit/$wonarchived_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?> 
                                                                                    <?php foreach($lostResult as $lost_row){ ?>   
                                                                                    <div id="lead<?=$lost_row->id;?>">
                        															<div class="profile-activity clearfix">
                        																<div>
                        																	<a class="user" href="<?=base_url("opportunity/view/$lost_row->id");?>" target="_blank"> <?='#'.$lost_row->display_id;?> </a>
                        																	Type : Closed Lost Opportunity 
                        																	<div class="time">
                        																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                        																		<?=formatDate($lost_row->created);?>
                        																	</div>
                        																</div>
                        
                        																<div class="tools action-buttons">
                        																	<a href="<?=base_url("opportunity/view/$lost_row->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                        																	<a href="<?=base_url("opportunity/edit/$lost_row->id");?>" class="green" target="_blank"><i class="ace-icon fa fa-pencil bigger-125"></i></a>
                        																</div> 
                        															</div>
                                                                                    </div>
                                                                                    <?php } ?>  
                                                                                    <?php }else{ ?>
                                                                                     No Data Found !
                                                                                    <?php } ?>    
                                                                                </div>
                        
                        														<!-- /section:pages/profile.feed -->
                        													 </div>
                        												   </div>
                        											      </div>
                                                                        </div>
                                                                     </div>
                    											</div>
                    										</div>
                                                        </div>
                                                      </div>
                                                 <!-------------------------------------------------------------------------------> 
                                    </div>
                    <!---------------------------------------------------------------------------------->