<style>
em{
    color:red;
}
</style>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                               
                                           
								
                                <?php echo form_open('',array('class'=>'form-horizontal','role'=>'form'));?>
									<!-- #section:elements.form -->
									<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Group Name : </label>

										<div class="col-sm-9 user-info-view">
                                        <?php echo ucwords(@$update->group_name);?>
										</div>
									</div>
                                    
                                    
                                    

								

									<!-- /section:elements.form -->
									<div class="space-4"></div>
                                    
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Frist Name : </label>

										<div class="col-sm-9 user-info-view">
											<?php echo ucwords(@$update->first_name);?>
										</div>
									</div>
                                    
                                    	<div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name : </label>

										<div class="col-sm-9 user-info-view">
										<?php echo ucwords(@$update->last_name);?>
										</div>
									</div>
                                    
                                    
                                    <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email : </label>

										<div class="col-sm-9 user-info-view">
											<?php echo @$update->email;?>
										</div>
									</div>
                                    
                                      <div class="space-4"></div>
                                    	
                                    
                                    
                                    
                                    
                                    
                                     <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status : </label>

										<div class="col-sm-9 user-info-view">
											    <?php echo ucwords(@$update->status);?>
										</div>
									</div>
                                    
                                     <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comment : </label>

										<div class="col-sm-9  user-info-view">
											<?php echo ucwords(@$update->status_comment);?>
										</div>
									</div>

                                     <div class="space-4"></div>


							<div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<a class="btn btn-info" href="<?=SITE_PATH?>user/list_items">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Back
											</a>

											&nbsp; &nbsp; &nbsp;
											
										</div>
									</div>
                                    
                                    <?php echo form_close();?>


									</div>

								<hr />
								</form>

							

							</div><!-- /.col -->
						</div><!-- /.row -->