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
									
									<!-- /section:elements.form -->
									<div class="space-4"></div>
                                    
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Frist Name <em class="required_em">*</em></label>

										<div class="col-sm-9">
											<input type="text"  placeholder="First Name" class="col-xs-10 col-sm-8" name="first_name" value="<?=set_value('first_name',isset($update->first_name) ? ($update->first_name ? $update->first_name : '') : '');?>" required="" />
										</div>
									</div>
                                    
                                    	<div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Last Name <em class="required_em">*</em></label>

										<div class="col-sm-9">
											<input type="text"  placeholder="Last Name" class="col-xs-10 col-sm-8"  name="last_name" value="<?=set_value('last_name',isset($update->last_name) ? ($update->last_name ? $update->last_name : '') : '');?>" required="" />
										</div>
									</div>
                                    
                                    
                                    <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Email <em class="required_em">*</em></label>

										<div class="col-sm-9">
											<input type="email"  placeholder="Email" class="col-xs-10 col-sm-8"  required="" value="<?=@$update->email?>" <?php if(@$update->email) { ?> disabled="" <?php } ?> />
										</div>
									</div>

                                     <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Status <em class="required_em">*</em></label>

										<div class="col-sm-9">
											    <select  class="col-xs-10 col-sm-8 chosen-select" required="" name="status" >
																<option value="" >- Status -</option>
																<option value="1" <?php if(@$update->status=='active'){ ?>selected<?php } ?>>active</option>
																<option value="0" <?php if(@$update->status=='inactive'){ ?>selected<?php } ?>>inactive</option>
															
															</select>
										</div>
									</div>
                                    
                                     <div class="space-4"></div>
                                    	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Comment </label>

										<div class="col-sm-9">
											<textarea  placeholder="Comment" class="col-xs-10 col-sm-8" name="status_comment"><?=@$update->status_comment?></textarea>
										</div>
									</div>

                                     <div class="space-4"></div>


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