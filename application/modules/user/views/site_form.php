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
					 <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>					 
			
			<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('name')?></label>
							<input type="text" class=" span7 required" name="name" value="<?=isset($result->name)?$result->name:'';?>" <?=$readonly?>/>
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('email')?></label>
							 <input type="text" class="span7 required email" name="email" value="<?=isset($result->email)?$result->email:'';?>" <?=$readonly?>/>
						</div>
					</div>
				</div>					
					
			<div class="form-row row-fluid">
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span4" for="normal"><?=lang('website')?><em>*</em></label>
					   <input type="text" name="website" value="<?=isset($result->website)?$result->website:'http://www.';?>" class="span7 required url" <?=$readonly?>/>
					</div>
				</div>
					
					
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span4" for="focusedInput"><?=lang('language')?><em>*</em></label>
						 <select name="language" class="required" <?php if($readonly){echo 'disabled="true"';} ?> >
							<option value="english" <?php if(isset($result->english) && $result->english =="english") { echo "selected"; } ?> >English</option>
						</select>
					</div>
				</div>
					
			</div>		
			
			
			
			<div class="form-row row-fluid">
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span4" for="normal"><?=lang('status')?><em>*</em></label>
					 <select name="status" class="required" <?php if($readonly){echo 'disabled="true"';} ?> >
						<option value="active" <?php if(isset($result->status) && $result->status =="active") { echo "selected";} ?> >Active</option>
						<option value="inactive" <?php if(isset($result->status) && $result->status =="inactive") { echo "selected";} ?> >Inactive</option>
						<option value="banned" <?php if(isset($result->status) && $result->status =="banned") { echo "selected";} ?> >Banned</option>
					</select>
					</div>
				</div>
					
					
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span4" for="focusedInput"><?=lang('status_comment')?></label>
				      <textarea name="status_comment" class="span7"><?=isset($result->status_comment)?$result->status_comment:'';?></textarea>
					</div>
				</div>
					
			</div>
			
			
				
				
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('description')?></label>
						     <textarea name="description" class="span7" <?=$readonly?>><?=isset($result->description)?$result->description:'';?></textarea>
						</div>
					</div>
				</div>                     
					 
				 <div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">
								<div class="span3"></div>
								<div class="span9 controls">

									<?php if($action == 'view') { ?>
									<button class="btn marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button class="btn marginR10">
										<?=lang($action.'_button');?>
									</button>
									<?php } ?>


									<button class="btn btn-danger" name="reset"><?=lang('reset');?></button>
								
                <a href="javascript: history.go(-1)" class="btn" style="margin-right:10px;"><span class="icon16 typ-icon-back"></span>Go back</a>
                
          
								</div>
							</div>
						</div>
					</div>

				</div>
                     
                    <?php echo form_close(); ?>
                    
            	</div>

		</div>		

	</div>
	
</div>
