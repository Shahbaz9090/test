<div class="popup_overlay">
  <div class="popup-mid-container" style="width:45%;"> 
	<span class="close_popup"><img src="<?=PUBLIC_URL?>images/popup.png" data-dismiss="modal" aria-hidden="true" style="cursor:pointer;width:36px;"/></span>
    <div class="demo">
      <div class="scroll normal" style="overflow-x:hidden;overflow-y:scroll;">
         <div style="clear:both; padding-right:5px;">
			<span id="success_response"></span>				
				<div class="span6" style="margin-left:0px;">  
					<?php
						if(isset($updated)){
					?>
						<div class="row-fluid">
            				<div class="span12">
								<div class="alert alert-success">
									<button data-dismiss="alert" class="close" type="button">&times</button>
									<strong>Success:  </strong>Permission has been updated successfully.
								</div>
							</div>
						</div>
					<?php
						}
					?>
					<div class="box">	
						<div class="title">
							<h4>
								
								<span>Set Permission For - <?=ucfirst($result->first_name).' '.ucfirst($result->last_name)?></span>
							</h4>
							<a href="#" class="minimize">Minimize</a>
						</div>
						<br/>
								
							 <?php     
								echo form_open(current_url()."/$user_id",array('id'=>'permission_form'));
								$permission_id = explode(",",$permission->extra_group_id);
								$count = 0;
								$counter=1;
								$class="permission_even_class";
								foreach($groups as $key=>$row){
								   if($row->is_super!=1 && $row->id!=$result->group_id){
									   if($counter%2==0){
										   if($class=="permission_odd_class"){
											   $class="permission_even_class";
										   }else{
											   $class="permission_odd_class";
										   }
									   }
									   $counter++;
									 
									    
									  
										   
							?>
								<div class="<?=$class?>">
									<div style="float:left;"><input type="checkbox" id="group_name" name="group_name"  value="<?=$row->id?>" <?php if(in_array($row->id,$permission_id)) echo 'checked="true"'; ?>  /></div>
									<label style="text-indent:10px;float:left;"><?=$row->name?></label>
								</div>
							<?php
									   }
								   }
							?>
							<div  style="width:100%;float:left;margin:10px 0 15%;clear:both;">
								<button name="submit" class="btn btn-primary marginL10" type="button" onClick="return setUserPermission(<?=$user_id?>)">Update</button>
								<span id="ajax_job_btn_assign"></span>
							</div>
							<?php echo form_close(); ?>

					</div><!-- End .box -->

				</div><!-- End .span12 -->
			
         </div>
      </div>
    </div>

  </div>
  
</div>
