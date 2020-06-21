    <main class="app-content">
      	<?php $this->load->view("includes/breadcrumb"); ?>
      	<div class="box">
    		<div class="title">
    			<h4><i class="fa fa-th"></i> <?php echo $page_heading ?></h4>
    			
    		</div>
    	</div>
      <div class="row">
        <div class="col-md-12">
            <?= get_flashdata(); ?>
          	<div class="tile">
	            <div class="form-actions">
					<h3 class="form-actions-title"><?php echo $form_title ?></h3>
				</div>
	            <div class="tile-body">
		          	<form method="post" action="<?=base_url($controller.'/add/')?>" enctype="multipart/form-data">
		                <div class="row">
		                	<div class="col-md-6">
		                		<div class="form-group">
				                  	<label class="control-label">Form Name <em>*</em></label>
				                  	<div class="elem-group">
				                  		<input oninput="this.value=this.value.replace(/[^a-z0-9_]/,'')" class="form-control" autocomplete="off" type="text" name="form_name" value="<?=@set_value('form_name')?>">
				                  	</div>
				                </div>
			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
				            </div>
			                <div class="col-md-6">
				                <p>(The database meta value for the table name.it must be unique and contain no space ( underscore are ok))<em>*</em></p>
			              	</div>
		                </div>
		                <div class="row">
		                	<div class="col-md-6">
		                		<div class="form-group">
				                  	<label class="control-label">Form Label <em>*</em></label>
				                  	<div class="elem-group">
				                  		<input class="form-control" autocomplete="off" type="text" name="form_label" value="<?=@set_value('form_label')?>">
				                  	</div>
				                </div>
			                  	<div class="text-danger message--error"><?php echo form_error('form_label') ?></div>
				            </div>
			                <div class="col-md-6">
				                <p>(The name of the field as it will displayto the user)<em>*</em></p>
			              	</div>
		                </div>
		                <div class="row">
		                	<div class="col-md-6">
		                		<div class="form-group">
				                  	<label class="control-label">Email <em>*</em></label>
				                  	<div class="elem-group">
				                  		<input class="form-control" autocomplete="off" type="text" name="email" value="<?=@set_value('email')?>">
				                  </div>
				                </div>
			                  	<div class="text-danger message--error"><?php echo form_error('email') ?></div>
				            </div>
			                <div class="col-md-6">
				                <div class="form-group">
				                  	<label class="control-label">Status</label>
				                  	<div class="elem-group">
					                  	<select name="status" class="form-control chosen-select">
					                  		<option value="1">Active</option>
					                  		<option value="2">Inactive</option>
					                  	</select>
				                  	</div>
				                </div>
				              	<div class="text-danger message--error"><?php echo form_error('view_on_left') ?></div>
			              	</div>
		                </div>
		                <div class="row">
		                	
			                <div class="col-md-6">
				                <div class="form-group">
				                  	<label class="control-label">View On Menu</label>
				                  	<div class="elem-group">
				                  		<div class="animated-radio-button">
					                  		<label>
								                <input checked="" type="radio" name="view_on_left" value="1">
								                <span class="label-text">Active</span>
							              	</label>
							              	<label>
								               <input type="radio" name="view_on_left" value="0">
								                <span class="label-text">Inactive</span>
							              	</label>
				                  		</div>
				                  	</div>
				                </div>
				              	<div class="text-danger message--error"><?php echo form_error('view_on_left') ?></div>
			              	</div>

		                </div>
		                
		                <div class="tile-footer text-center">
		                  	<button class="btn btn-primary" type="submit" name="add_category"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;
		                  	<a class="btn btn-warning" href="<?=current_url()?>"><i class="fa fa-fw fa-lg fa-undo"></i>Reset</a>&nbsp;
		                  	<a href="javascript: history.go(-1)" class="btn btn-secondary" ><i class="fa fa-fw fa-lg fa-angle-left"></i>Go Back</a>
		                </div>
	              	</form>
	            </div>
          	</div>
        </div>
        <div class="col-md-6">
      </div>
    </main>
