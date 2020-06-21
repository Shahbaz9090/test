<style>

</style>
<?php
//_pr($row);exit;

?>
						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
                                
                              
								
                                <?php echo form_open('',array('class'=>'form-horizontal','role'=>'form'));?>
								<!-- #section:elements.form -->
                                
                                
                                <!---------------------Static Fields Open-------------------------------->
                                <div class="row">
                                <div class="col-xs-12 col-sm-12">
                                <div class="widget-box widget-background">
											<div class="widget-header widget-header-flat widget-header-small">
												<h5 class="widget-title">Product Information</h5>
  											</div>

									<div class="widget-body widget-background">
									  <div class="row-fluid">
                                        <div class="panel-body">
                                             <div class="row">
                                              <div class="panel-width-50">
                                                <div class="">
                                                <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Facility Type <em class="required_em">*</em></label>
                                                    <select name="facility_type" class="col-xs-10 col-sm-6 pull-right" required='required'>
                                                       <option value="">Select</option>
                                                       <?php $facilityType=_facilityType();
                                                             foreach($facilityType as $k=>$val){
                                                       ?>
                                                       <option value="<?=$k;?>" <?php if(@$row->facility_type==$k){?> selected="selected" <? } ?>><?=$val;?></option>
                                                       <?php  } ?>
                                                    </select>
                                                </div>
                                              </div>
                                              <input type="hidden" name="p_id"/>
                                               <div class="panel-width-50">
                                                <div class="">
                                                <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Name<em class="required_em">*</em></label>
                                                     <input type="text" value="<?php echo  @$row->name; ?>" name="name" class="col-xs-10 col-sm-6 pull-right" required='required'/>
                                                </div>
                                              </div>
                                              </div>
                                              
                                             
                                              <div class="row">
                                              <div class="panel-width-50">
                                                <div class="">
                                                <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Remarks <em class="required_em">*</em></label>
                                                    <input type="text" value="<?php echo  @$row->remarks; ?>" name="remarks" class="col-xs-10 col-sm-6 pull-right" required='required'/>
                                                </div>
                                              </div>
                                               <div class="panel-width-50">
                                                <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Status <em class="required_em">*</em></label>
                                                    <select name="status" class="col-xs-10 col-sm-6 pull-right" required='required'>
                                                       <option value="">Select</option>
                                                       <?php $productStatus=_productStatus();
                                                             foreach($productStatus as $k=>$val){
                                                       ?>
                                                       <option value="<?=$k;?>" <?php if(@$row->status==$k){?> selected="selected" <? } ?>><?=$val;?></option>
                                                       <?php  } ?>
                                                    </select>
                                                </div>
                                              </div>
                                              
                                              <div class="row">
                                              <div class="panel-width-50">
                                                <div class="">
                                                
                                                </div>
                                              </div>
                                              </div>
                                     
                                          </div>
                                          
                                          </div>
                                         </div>
                                                    
                                      </div><!-- /.widget-main -->
										</div><!-- /.widget-body -->
                                        </div><!-- /.row-->
                                        <!---Pricing Information----------------->
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="widget-box widget-background">
        											<div class="widget-header widget-header-flat widget-header-small">
        												<h5 class="widget-title">Pricing Information</h5>
          											</div>
                                                   <div class="widget-body widget-background">
        										     <div class="panel-body">
                                                        <div class="row">
                                                          <div class="panel-width-50">
                                                            <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Currency <em class="required_em">*</em></label>
                                                            <select name="currency" class="col-xs-10 col-sm-6 pull-right" required='required'>
                                                               <option value="">Select</option>
                                                               <?php $currency=_currency();
                                                                     foreach($currency as $k=>$val){
                                                               ?>
                                                               <option value="<?=$k;?>" <?php if(@$row->currency==$k){?> selected="selected" <? } ?>><?=$val;?></option>
                                                               <?php  } ?>
                                                            </select>
                                                          </div>
                                                          <div class="panel-width-50">
                                                            <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Price <em class="required_em">*</em></label>
                                                                <input type="text" value="<?php echo  @$row->amount; ?>" name="amount" class="col-xs-10 col-sm-6 pull-right" required='required'/>
                                                          </div>
                                                        </div>
                                                       <!-- <div class="row">
                                                          <div class="panel-width-50">
                                                            <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Product Commission </label>
                                                            <input type="text" value="<?php echo  @$row->commission; ?>" name="commission" class="col-xs-10 col-sm-6 pull-right" required='required'/>
                                                          </div>
                                                          
                                                       </div>-->
                                                      
                                                      </div>
            										</div>
        										</div>
                                            </div>
                                        </div>
                                        <!----------------------------------------------->
                                        <!---Stock Information----------------->
                                       <!-- <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="widget-box widget-background">
        											<div class="widget-header widget-header-flat widget-header-small">
        												<h5 class="widget-title">Stock Information</h5>
          											</div>
                                                   <div class="widget-body widget-background">
        										     <div class="panel-body">
                                                        <div class="row">
                                                          <div class="panel-width-50">
                                                            <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Usage Unit <em class="required_em">*</em></label>
                                                            <select name="usage_unit" class="col-xs-10 col-sm-6 pull-right" required='required'>
                                                               <option value="">Select</option>
                                                               <?php $currency=_getProductUnit();
                                                                     foreach($currency as $k=>$val){
                                                               ?>
                                                               <option value="<?=$k;?>" <?php if(@$row->usage_unit==$k){?> selected="selected" <? } ?>><?=$val;?></option>
                                                               <?php  } ?>
                                                            </select>
                                                          </div>
                                                          <div class="panel-width-50">
                                                            <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Unit in Stock <em class="required_em">*</em></label>
                                                            <input type="text" value="<?php echo  (isset($row->unit_in_stock))?$row->unit_in_stock:'';  ?>" name="unit_in_stock" class="col-xs-10 col-sm-6 pull-right" required='required'/>
                                                          </div>
                                                        </div>
                                                       
                                                      </div>
            										</div>
        										</div>
                                            </div>
                                        </div>
                                        <!----------------------------------------------->
                                     
                                        <?php $fields = _getField(4,'1');
                                              if($fields){
                                        ?>
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="widget-box widget-background">
    											<div class="widget-header widget-header-flat widget-header-small">
    												<h5 class="widget-title">Custom Information</h5>
      											</div>
                                                <div class="widget-body widget-background">
        										    <div class="row-fluid">
                                                        <div class="row">
                                                         <div class="panel-body">
                                                            <div class="row-all">
                                                            <!--Dyanmic fields---------------------------------->
                                                            <?php
                                                            if(isset($action) && $action=='edit'){
                                                            $productOthers=_otherFieldsData('product_others','product_id',$row->id); 
                                                            foreach($fields as $key=>$val){
                                                                $field = _tableAttribute($val->label);
                                                                $fieldHtml = _getFieldHtml($val,$productOthers->$field);
                                                            ?>  
                                                            <?php if($key%2==0):  ?></div><div class="row-all"><?php endif;  ?>
                            								<div class="panel-width-50">
                                                             	<label class="control-label no-padding-right col-sm-5" for="form-field-1"><?php echo $val->label  ?><?php if($val->field_required == 1){ ?><em class="required_em">*</em> <?php } ?></label>
                        										<?php  
                                                                    echo $fieldHtml;
                                                                ?>
                                                            </div>
                                                            <?php
                                                            } }else{
                                                                foreach($fields as $key=>$val){
                                                                $fieldHtml = _getFieldHtml($val);
                                                                    
                                                            ?>
                                                            <?php if($key%2==0):  ?></div><div class="row-all"><?php endif;  ?>
                            							    <div class="panel-width-50">
                                                            	<label class="control-label no-padding-right col-sm-5" for="form-field-1"><?php echo $val->label  ?><?php if($val->field_required == 1){ ?><em class="required_em">*</em> <?php } ?></label>
                        										<?php  
                                                                    echo $fieldHtml;
                                                                ?>
                            										  
                                                            </div>
                                                            <?php
                                                            }};
                                                            ?>
                                                            </div><!--End row all-->
                                                           <!----------------------------------------------------->
                                                        <!--
                                                          <div class="panel-width-50">
                                                            <div class="">
                                                            <label class="control-label no-padding-right col-sm-5" for="form-field-1"> Contact Person Details</label>
                                                            <textarea  name="contact_person_details" class="col-xs-10 col-sm-6 pull-right"><?php echo  @$row->contact_person_details; ?></textarea>
                                                            </div>
                                                          </div>
                                                        ---------------------------------------->  
                                                          </div>
                                                        </div>
                                                    </div>		
    											</div><!-- /.widget-main -->
    
                       				   
    											</div><!-- /.widget-body -->
                                            </div>
                                        </div><!-- /.row-->   
                                        <?php } ?>    
                                    <!---------- Description---------------->
                                       
                                        
                                        <!--------------------------------------->    
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12">
                                                <div class="widget-box widget-background">
        											<div class="widget-header widget-header-flat widget-header-small">
        												<h5 class="widget-title">Product Detail</h5>
          											</div>
                                                   <div class="widget-body widget-background">
            										<div class="row-fluid">
                                                       <div class="row">
                                                         <div class="panel-body">
                                                           <div class="col-sm-12">
                                                               <label class="control-label no-padding-right col-sm-2" for="form-field-1"> Product Description</label>
                                                               <textarea  name="description" class="col-xs-10 col-sm-9 pull-right limited autosize-transition" rows="4"><?php echo  @$row->description; ?></textarea>
                                                           </div>
                                                          </div>
                                                       </div>
                                                     </div>
            										</div>
        										</div>
                                            </div>
                                        </div>
                                    
                                    <!--------------------------------------->    

                                    <div class="space-4"></div>
                                	<div class="clearfix form-actions">
										<div class="text-center">
											<button class="btn btn-info" type="submit">
												<i class="ace-icon fa fa-check bigger-110"></i>
												Submit
											</button>

											&nbsp; &nbsp; &nbsp;
											<button class="btn" onclick="goBack()">
												<i class="ace-icon fa fa-undo bigger-110"></i>
												Cancel
											</button>
										</div>
									</div>
                                    
                                    <?php echo form_close();?>



							

							</div><!-- /.col -->
						</div><!-- /.row -->
                        