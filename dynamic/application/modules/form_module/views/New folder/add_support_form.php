<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

<style>
.radio-inline .radio{padding-top:0px !important;}
</style>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
<?php //pr($result);die;?>
	<div class="page-content">
		<!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->
		<!-- BEGIN PAGE HEADER-->
		<!-- BEGIN PAGE HEAD -->
		<div class="page-head">
		</div>
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ul class="page-breadcrumb breadcrumb">
			<?php if(isset($header['bread_cum']))
			{ 
				print_r($header['bread_cum']); 
			} ?>
		</ul>
		<!-- END PAGE BREADCRUMB -->
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div id="content">
			<div class="row ">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption">
								Support Form
							</div>
						</div>
						<div class="portlet-body">
							<?php if(!empty($error_msg)) { ?>
								<div class="alert alert-danger">
									<button class="close" data-dismiss="alert"></button>
									<span id="danger_msg"><?php echo $error_msg; ?></span>
								</div>
							<?php } ?>
							<?php echo form_open_multipart('', 'method="post" class="form-horizontal" id="support_form" '); ?>		
								<div class="row">   
									<div class="form-group">
										<div class="col-md-12">
											<label for="firstName" class="col-md-2 control-label">Dynamic Form<em>*</em></label>
											<div class="col-md-10">
												<label class="radio-inline">
													<input type="radio" name="dynamic_from" id="dynamic_from1" value="1" <?php if(isset($_POST['dynamic_from']) && $_POST['dynamic_from']==1) { echo 'checked="checked"'; } else if(isset($result->dynamic_from) && $result->dynamic_from==1) { echo 'checked="checked"';  } else { } ?>>Add URL
												</label>
												<label class="radio-inline">
													<input type="radio" name="dynamic_from" id="dynamic_from2" value="2" <?php if(isset($_POST['dynamic_from']) && $_POST['dynamic_from']==2) { echo 'checked="checked"'; } else if(isset($result->dynamic_from) && $result->dynamic_from==2) { echo 'checked="checked"';  } else { } ?>>Create Dynamic Form
												</label>
											</div>
										</div>
									</div>
								</div>
								<?php
								if(isset($_POST['dynamic_from']) && $_POST['dynamic_from']==1) 
								{
									$dyn_style='style="display:block"';
								}
								else if(isset($result->dynamic_from) && $result->dynamic_from==1) 
								{
									$dyn_style='style="display:block"';
								}
								else
								{
									$dyn_style='style="display:none"';
								}
								
								// for dynamic form
								if(isset($_POST['dynamic_from']) && $_POST['dynamic_from']==2) 
								{
									$dyn_style2 = 'style="display:block"';
								}
								else if(isset($result->dynamic_from) && $result->dynamic_from==2) 
								{
									$dyn_style2 = 'style="display:block"';
								}
								else
								{
									$dyn_style2 = 'style="display:none"';
								}
								?>
								<div class="row" id="dynamic_url_div" <?php echo $dyn_style; ?>>
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-12">
												<label for="age" class="col-md-4 control-label">URL<em>*</em></label>
												<div class="col-md-8">
													<select name="dynamic_url" id="dynamic_url" class="form-control" required="">
														<option value="1" <?php if(isset($_POST['dynamic_url']) && $_POST['dynamic_url']==1) { echo 'selected="selected"'; } else if(isset($result->dynamic_url) && $result->dynamic_url==1) { echo 'selected="selected"';  } else { } ?>>Volunteer Registration</option>
														<option value="2" <?php if(isset($_POST['dynamic_url']) && $_POST['dynamic_url']==2) { echo 'selected="selected"'; } else if(isset($result->dynamic_url) && $result->dynamic_url==2) { echo 'selected="selected"';  } else { } ?>>Viglang Vivah</option>
														<option value="3" <?php if(isset($_POST['dynamic_url']) && $_POST['dynamic_url']==3) { echo 'selected="selected"'; } else if(isset($result->dynamic_url) && $result->dynamic_url==3) { echo 'selected="selected"';  } else { } ?>>Request for Donation Box</option>
														<option value="4" <?php if(isset($_POST['dynamic_url']) && $_POST['dynamic_url']==4) { echo 'selected="selected"'; } else if(isset($result->dynamic_url) && $result->dynamic_url==4) { echo 'selected="selected"';  } else { } ?>>Open Branch In City</option>
													</select>
													<div class="error" id="error_dynamic_url"><?php echo form_error('dynamic_url');?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										
									</div>
								</div>
								<div class="row" id="dynamic_url_div2" <?php echo $dyn_style2; ?>>
									<div class="col-md-6">
										<div class="form-group">
											<div class="col-md-12">
												<label for="age" class="col-md-4 control-label">Form Name<em>*</em></label>
												<div class="col-md-8">
													<input type="hidden" name="form_id" value="<?php  if(isset($result->form_id) && !empty(isset($result->form_id))) { echo $result->form_id;  }  ?>">
													<input class="form-control" type="text" name="form_name" id="form_name" value="<?php if(isset($_POST['form_name'])) { echo $_POST['form_name']; } else if(isset($result->form_name)) { echo $result->form_name;  }  ?>">
													<div class="error" id="error_form_name"><?php echo form_error('form_name');?></div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-12 text-center margin-sm-form">
											<input type="submit" name="submit" value="Save" class="btn blue"/>
											<?php if(!empty($result->form_id) && ($result->dynamic_from == 2)){ ?>
											<a href="<?php echo base_url(); ?>support_form/dynamic_form/<?php echo ID_encode($result->form_id); ?>"><input type="button" name="reset" value="Next" class="btn btn-default"/></a>
											
											<?php } else{ ?>
											<a href="<?php echo base_url(); ?>support"><input type="button" name="reset" value="Cancel" class="btn btn-default"/></a>
											<?php }  ?>
										</div>
									</div>
								</div>
									
							<?php echo form_close(); ?>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>
<script>


$("#form_name").on("keydown", function (e) {
    return e.which !== 32;
});




$("#support_form").validate({
	rules:{
			dynamic_from:{
				required: true
			},
			dynamic_url:{
				required : function () {
					return $("[name='dynamic_from']:checked")==1;
					}
			},
		}
});

$(document).on('click', "input[name='dynamic_from']", function(){
	$('#dynamic_url_div').hide();
	$('#dynamic_url_div2').hide();
	if(this.value!="")
	{
		if(this.value==1)
		{
			$('#dynamic_url_div').show();
		}
		else
		{
			$('#dynamic_url_div2').show();
		}
	}
});
</script>