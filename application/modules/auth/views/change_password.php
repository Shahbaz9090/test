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
                                    
                                     <?php 	if(@$this->session->flashdata('Error')!=''){
                                            echo "<span style='color:red'>".$this->session->flashdata("Error")."</span>";
                                            }
                                     ?> 

                                      <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Password <em class="required_em">*</em></label>

										<div class="col-sm-9">
											<input type="password"  placeholder="Password" class="col-xs-10 col-sm-8" name="password" required="" />
										</div>
									</div>
                                    
                                    
                                     <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> New Password <em class="required_em">*</em></label>

										<div class="col-sm-9">
											<input type="password" placeholder="New Password" class="col-xs-10 col-sm-8" name="new_password" required="" />
										</div>
                                      
									</div>
                                    
                                    <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Confirm Password <em class="required_em">*</em></label>

										<div class="col-sm-9">
											<input type="password" placeholder="Confirm Password" class="col-xs-10 col-sm-8" name="confirm_password" required="" />
										</div>

									</div>

							       <div class="clearfix form-actions">
										<div class="col-md-offset-3 col-md-9">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" type="reset">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Reset
											</button>
										</div>
									</div>
                                    
                                    <?php echo form_close();?>



								<hr />
								</form>

							

							</div><!-- /.col -->
						</div><!-- /.row -->