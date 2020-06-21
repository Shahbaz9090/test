  <script type="text/javascript">
        jQuery(document).ready(function ($) {
           $("#site_form").validate();           
        });
    </script>
    
  <div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang($action."_title");?>
					</span>
				</h4>

			</div>
			<div class="content">
                
                <?php echo get_flashdata();?>

                    <?php
						$readonly="";
						$disabled="";
						if(@$result->is_super==1){
							$readonly="readonly";
							$disabled="disabled";
						}
					?>
					 <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>
			
			<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('parent_group')?></label>
							<input type="text" class="small_medium required span8" name="name" value="<?=isset($result->name)?$result->name:'';?>" <?=$readonly?>/>
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('name')?><em>*</em></label>
							   
							   
							   <div class="row-fluid">
								<div class="span8 del">
								  <select name="parent_group_id" <?=$disabled?> class='nostyle'>
								   <option value="0">Select Parent Group</option>
									<?php foreach ($groups as $row):?>
									<option value="<?=$row->id?>" <?php if(isset($result->parent_group_id) && $result->parent_group_id ==$row->id){ echo "selected";}?> ><?php echo $row->name; ?></option>
									<?php endforeach; ?>
								  </select>
								</div>
							</div>
							   
							   
						</div>
					</div>
					
				</div>
			
					
					
					
			<div class="form-row row-fluid">
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span4" for="normal"><?=lang('description')?></label>
					    <textarea name="description" class="span8"  <?=$readonly?>><?=isset($result->description)?$result->description:'';?></textarea>
					</div>
				</div>
					
				<div class="span6">
					<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('status')?><em>*</em></label>
						<div class="row-fluid">
						  <div class="span8 del">
							<select name="status" class="required nostyle" <?php if($readonly){echo 'disabled="true"';} ?> <?=$disabled?> >
								<option value="active" <?php if(isset($result->status) && $result->status =="active") { echo "selected";} ?> >Active</option>
								<option value="inactive" <?php if(isset($result->status) && $result->status =="inactive") { echo "selected";} ?> >Inactive</option>
								<!--<option value="banned" <?php if(isset($result->status) && $result->status =="banned") { echo "selected";} ?> >Banned</option>-->
							</select>
						  </div>
					    </div>
					</div>
				</div>
					
			</div>		
			
			
				
				
						
                   
                     
					 
				<div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">								
								<div class="span12 controls">

									<?php if($action == 'view') { ?>
									<button class="btn btn-info "
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button class="btn btn-info">
										<?=lang($action.'_button');?>
									</button>
									<?php } ?>


									<button class="btn btn-danger" type="reset" name="reset"><?=lang('reset');?></button>
									<a href="javascript: history.go(-1)" class="btnbtn-goback" ><button class="btn btn-goback" name="reset" type="button">
									<span class="icon16 typ-icon-back"></span>Go back </button></a>                
          
								</div>
							</div>
						</div>
					</div>

				</div>
                     
                    <?php echo form_close(); ?>
                    
            	</div>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>
        