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
                        
                            <div class="col-sm-12"><?=get_flashdata();?></div>
                            
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->

                                
								

<div  class="user-profile">
									

										<div class="col-xs-12 col-sm-12">
                                        
                                        <div class="col-sm-5">
                                        <div class="row">
                                        <div class="col-sm-1">
                                        <i class="glyphicon glyphicon-th-list" style="font-size: 35px;"></i>
                                         
                                         </div>
                                        <div class="col-sm-11 margin0px">
                                        <b><?=@$row->task_name?></b>
                                        <span class="row">
                                        <?php $user_data=get_user_data($row->added_by);?>
                                        <span class="designation_label">&nbsp;<?=$user_data->name;?></span>
                                        <span class="company_label"></span></span></div>
                                         </div>
                                           </div>
											

                                             
											</div>
											<div class="space-12"></div>

											<!-- #section:pages/profile.info -->
                                            <div class="row">
                                            <div class="col-sm-8">
											<div class="profile-user-info profile-user-info-striped">
                                             
												<div class="profile-info-row">
													<div class="profile-info-name">Industry Name</div>

													<div class="profile-info-value">
                                                    
														<span class="editable" >
                                                            <?php   
                                                               echo $row->name
                                                                
                                                            ?>
                                                        </span>
													</div>
												</div>
                                            
                                            	<div class="profile-info-row">
													<div class="profile-info-name">Created On</div>

													<div class="profile-info-value">
                                                    
														<span class="editable" >
                                                            <?php   
                                                            echo date("d/M/Y h:i A",strtotime($row->created));   
                                                            ?>
                                                        </span>
													</div>
												</div>
                                                <div class="profile-info-row">
													<div class="profile-info-name">Modified On</div>

													<div class="profile-info-value">
                                                    
														<span class="editable" >
                                                            <?php   
                                                            echo date("d/M/Y h:i A",strtotime($row->modified));   
                                                            ?>
                                                        </span>
													</div>
												</div>
                                            
											</div>
                                            
                                            
                                            <div class="space-12"></div>
                                        
                                            </div>
                                            <div class="col-sm-6">
											
                                            </div>
                                          </div>
                                        
										</div>
                                        <hr />
                                        <!--<div class="row-all">
                                            <div class="col-xs-12 col-sm-12 widget-container-col ui-sortable">
        										<div class="widget-box ui-sortable-handle">
        											<div class="widget-header">
        												<h5 class="widget-title smaller">With Label</h5>
        
        											</div>
        
        											<div class="widget-body">
        												<div class="widget-main padding-6">
                														
                														<div id="profile-feed-1" class="profile-feed ace-scroll" style="position: relative;">
                                                                        <div class="scroll-track scroll-active" style="display: block; height: 200px;"><div class="scroll-bar" style="height: 63px; top: 0px;"></div></div><div class="scroll-content" style="max-height: 200px;">
                                                                        <?php foreach($assignedToArray as $assigned_userID){
                                                                              $assignedUser=get_user_data($assigned_userID);
                                                                            ?>   
                                                                            <div id="product<?=$assignedUser->id?>">
                															<div class="profile-activity clearfix">
                																<div>
                																	<a class="user" href="<?=base_url("user/view/$assignedUser->id");?>" target="_blank"> <?=$assignedUser->name;?> </a>
                																	<?=$assignedUser->status_comment;?>
                																	
                
                																	<div class="time">
                																		<i class="ace-icon fa fa-clock-o bigger-110"></i>
                																		<?=$assignedUser->created;?>
                																	</div>
                																</div>
                
                																<div class="tools action-buttons">
                																	<a href="<?=base_url("user/view/$assignedUser->id");?>" class="blue" target="_blank"><i class="ace-icon fa fa-search-plus bigger-125"></i></a>
                																	<a href="javascript:void(0);" class="red" onclick="deleteProduct(<?=$row->id?>,<?=$assignedUser->id?>);"><i class="ace-icon fa fa-times bigger-125"></i></a>
                																</div> 
                															</div>
                                                                            </div>
                                                                            <?php } ?>  
                														</div> 
                                                                        </div>
                
                														
        												</div>
        											</div>
        										</div>
        									</div>
                                        </div>-->
        							</div><!-- /.col -->
        						</div><!-- /.row -->
                                 </div>
                              </div>    
                              
                              <div class="row" id="productDetail">
                                  
                              </div>   

                              </div>
                            </div>
                          </div>
                        </div>  
                        <script>
                            $(document).ready(function(){
                                $(document).on('submit','#comment_form',function(){
                                    var str=$(this).serialize();
                                    $.post("<?=base_url('task/addComment')?>",str,function(data){
                                        var jobj=JSON.parse(data);
                                        var strVar="";
                                        if(jobj){
                                            for(p in jobj){
                                                strVar += "                                                       <div class=\"profile-activity clearfix\">";
                                                strVar += "																<div>";
                                                strVar += "																	<a class=\"user\" href=\"\" target=\"_blank\"> "+jobj[p]['name']+" <\/a>";
                                                strVar += 																	jobj[p]['comment'];
                                                strVar += "																	<!--<a href=\"#\">Take a look<\/a>-->";
                                                strVar += "";
                                                strVar += "																	<div class=\"time\">";
                                                strVar += "																		<i class=\"ace-icon fa fa-clock-o bigger-110\"><\/i>";
                                                strVar +=                                                                        jobj[p]['created'];
                                                strVar += "																	<\/div>";
                                                strVar += "																<\/div>";
                                                strVar += "															<\/div>";   
                                            }   
                                        }
                                        $('#commentDiv').html(strVar);
                                        $('#message').val('');
                                    }); 
                                    return false;
                                });
                                $('#comment_form').trigger('submit');
                            });                        
                        </script>                                