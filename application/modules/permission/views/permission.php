
   
						<div class="row">
						
                      <!-- <a href="<?=SITE_PATH?>user/group/add" class="btn btn-success pull-left btn-sm add-user-button" ><i class="ace-icon fa fa-plus"></i> ADD GROUP</a>-->
                      <!---------------------------------------grid goes here------------------------->
                      <div class="col-xs-12 col-sm-12 widget-container-col">
								<!-- #section:custom/widget-box -->
								<div class="widget-box">
									<div class="widget-header">
										<h5 class="widget-title">Permission Chart</h5>

										<!-- #section:custom/widget-box.toolbar -->
										<div class="widget-toolbar">
										<!--	<div class="widget-menu">
												<a href="#" data-action="settings" data-toggle="dropdown">
													<i class="ace-icon fa fa-bars"></i>
												</a>

												<ul class="dropdown-menu dropdown-menu-right dropdown-light-blue dropdown-caret dropdown-closer">
													<li>
														<a data-toggle="tab" href="#dropdown1">Option#1</a>
													</li>

													<li>
														<a data-toggle="tab" href="#dropdown2">Option#2</a>
													</li>
												</ul>
											</div>-->

											<a href="#" data-action="fullscreen" class="orange2">
												<i class="ace-icon fa fa-expand"></i>
											</a>

											<a href="#" data-action="reload">
												<i class="ace-icon fa fa-refresh"></i>
											</a>

											<a href="#" data-action="collapse">
												<i class="ace-icon fa fa-chevron-up"></i>
											</a>

											<a href="#" data-action="close">
												<i class="ace-icon fa fa-times"></i>
											</a>
										</div>

										<!-- /section:custom/widget-box.toolbar -->
									</div>
                                    <?php  $groups = getGroups();  //_pr($groups);exit;?>
									<div class="widget-body">
										<div class="widget-main">
											<table class="table table-striped table-bordered table-hover">
														<thead class="thin-border-bottom">
															<tr>
																<th>
																	<i class="ace-icon fa fa-apple"></i>
																	Modules
																</th>
                                                                <?php  foreach($groups as $k=>$v):  ?>
																<th>
																	<i class="ace-icon fa fa-user"></i>
                                                                    <?php echo $groups[$k]->name;  ?>
																</th>
																<?php  endforeach; ?>
															</tr>
														</thead>

														<tbody>
                                                        <?php
                                                         
                                                         $modules = _getModulesIds();
                                                         foreach($modules as $key=>$val):       
                                                        ?>
															<tr>
																<td class=""><?php echo $val;  ?></td>
                                                                <?php  foreach($groups as $k=>$v):   ?>
																<td>	
                                                                    <label><!-- Name is combination of module id and group id-->
                                                                        <?php 
                                                                            $accessibleModulesMArray = explode('_',$groups[$k]->accessible_modules);
                                                                            //_pr($accessibleModulesArray);
                                                                        ?>
                														<input name="" id="<?php echo $key.'_'.$groups[$k]->id;  ?>" <?php if(in_array($key,$accessibleModulesMArray)) { ?>checked="checked" <?php }  ?> class="ace ace-switch ace-switch-2" type="checkbox" />
                														<span class="lbl"></span>
													                </label>
                                                                </td>
                                                                <?php endforeach; ?>
																
															</tr>
                                                            <?php endforeach;   ?>

															
														</tbody>
													</table>
										</div>
									</div>
								</div>

								<!-- /section:custom/widget-box -->
						</div>
                        <!------------------------------------------------------------------------------->
                        
                        
                        
                        
                        
                        
                        
						</div><!-- /.row -->
                        
                        
<script>
      

 /************Ajax delete form for new field entry(Modules)*******/
 $(function(){
    $(document).on('change',".ace-switch",function(){
       var name = $(this).attr('id');
       var status = false;//if button is off
       if($(this).is(":checked")){//if button is on
           status = $(this).val();  
       }
       if(!name ){
           return false;
       }
       $.ajax({
           type: "POST",
           url: sitePath+"permission/save",
           data: token_name+"="+token_hash+"&name="+name+"&status="+status,
           beforeSend:function(){
                beforeAjaxResponse();
           },
           success: function(msg){ 
                 afterAjaxResponse();
            
           }
       });
       return false; 
    });
 });
 /*******************************************************/

</script>                        
                        
