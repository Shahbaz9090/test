<div class="popup_overlay">
  <div class="popup-mid-container" style="width:45%;"> 
	<span class="close_popup"><img src="<?=PUBLIC_URL?>images/popup.png" data-dismiss="modal" aria-hidden="true" style="cursor:pointer;width:36px;"/></span>
    <div class="demo">
      <div class="scroll normal" style="overflow-x:hidden;overflow-y:scroll;">
         <div style="clear:both; padding-right:5px;">
			<span id="success_response"></span>				
				<div class="span6" style="margin-left:0px;">  
					<span id="response_status"></span>
					<?php
					  if(isset($error)){
					?>
						<div class="row-fluid">
            				<div class="span12">
								<div class="alert alert-error">
									<button data-dismiss="alert" class="close" type="button">&times</button>
									<strong>Error  </strong>The status comment field is required.
								</div>
							</div>
						</div>
					<?php
						}
					?>
					<div class="box">	
						<div class="title">
							<h4>
								
								<span> User Status</span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<br/>
							<?php     
								echo form_open(current_url()."$result->id",array('id'=>'permission_form'));
							?>
								<div class="row-fluid"> 
									<div class="span9">
										<label class="span3"><strong><?=lang('status')?><em>*</em> :</strong></label>
										<?php
											$status=array("active"=>"Active","inactive"=>"Inactive","banned"=>"Banned");
										?>
										<select name="status" id="status" class="span5 required" <?php if($readonly){echo 'disabled="true"';} ?> >
											<?php
												foreach($status as $key=>$value){
											?>
											<option value="<?=$key?>" <?php if($result->status == $key){?> selected="true" <?php }?>>
												<?=$value?>
											</option>
											<?php } ?>
										</select>
									</div>
								 </div>

								<div class="row-fluid"> 
									<div class="span9">
										<label class="span3"><strong><?=lang('status_comment')?><em>*</em> :</strong></label>
										<textarea class="span9" id="status_comment" name="status_comment" rows="3"><?=isset($result->status_comment)?$result->status_comment:'';?></textarea>
									</div>
								</div>
							
							<div  style="width:100%;float:left;margin:10px 0 15%;clear:both;">
								<button name="submit" class="btn btn-primary marginL10" style="margin-left:18%;" type="button" onClick="return setUserStatus(<?=$result->id?>)">Update</button>
								<span id="ajax_status_btn_assign"></span>
							</div>
						<?php echo form_close(); ?>

					</div><!-- End .box -->
				</div><!-- End .span12 -->			
             </div>
         </div>
      </div>
    </div>  
</div>
