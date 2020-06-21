

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->
<style>
.error{
	color:red;
}
</style>
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
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('name')?><em>*</em>
								</label>
							</div>
							<?php $namess_text = set_value("name") == false ? @$result->name : set_value("name"); ?>
							<div class="span6">
								<input class=" " type="text" name="name" value="<?=$namess_text;?>" />
								
								<div class="error" id="error_field_label"><?php  echo form_error("name"); ?><?php echo $error_msg; ?></div>
								
							</div>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
							<div class="span4">
								<label class="form-label " for="normal"><?=lang('status')?><em>*</em>
								</label>
							</div>
							<div class="span6">
								<select name="status" id="status" class=" nostyle chosen-select" >
									<option value="1" <?= ($result->status == "1")?"selected='selected'":"" ?>>Active</option>
									<option value="0" <?= ($result->status == "0")?"selected='selected'":"" ?>>Inactive</option>
								</select>
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
									<button class="btn btn-info marginR10"
										href="<?=$base_url.'/edit/'.$result->id?>">
										<?=lang($action.'_button');?>
									</button>
									<?php }
		                  else { ?>
									<button class="btn btn-info marginR10">
										<?=lang($action.'_button');?>
									</button>
									<?php } ?>
</a>

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
<!-- End .row-fluid -->

