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
                                <!--Dyanmic fields---------------------------------->
                                <?php
                                if(isset($action) && $action=='edit'){
                                    $fields = _getField(1);
                                    //_pr($fields);
                                    //_pr($row);
                                foreach($fields as $key=>$val){
                                    $field = _tableAttribute($val->label);
                                    $fieldHtml = _getFieldHtml($val,$row->$field);
                                ?>
                                    
								<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $val->label  ?><?php if($val->field_required == 1){ ?><em class="required_em">*</em> <?php } ?></label>

										<div class="col-sm-9">
                                        <?php  
                                            echo $fieldHtml;
                                        ?>
                                       
										</div>
                                        
								</div>
                                <?php
                                   } }else{
                                    $fields = _getField(1);
                                    foreach($fields as $key=>$val){
                                    $fieldHtml = _getFieldHtml($val);
                                        
                                        ?>
                                     	<div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1"> <?php echo $val->label  ?><?php if($val->field_required == 1){ ?><em class="required_em">*</em> <?php } ?></label>

										<div class="col-sm-9">
                                        <?php  
                                            echo $fieldHtml;
                                        ?>
                                       
										</div>
                                        
								</div>   
                                        <?php
                                    }}
                                ?>
                               <!----------------------------------------------------->
                                    
                                    

								


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



							

							</div><!-- /.col -->
						</div><!-- /.row -->