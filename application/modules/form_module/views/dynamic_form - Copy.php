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
							<div class="caption" style="width: 100%;">
								Dynamic Form
								<!--<span style="float: right; margin-right: 10px;" >
									<div class="icon-bg pull-left btn btn-success btn-sm"><a class="color-white" href="#addColumn"><i class="fa fa-plus-circle"></i> Add Column</a></div>
									
								</span> --> 
							</div>
						</div>
						
						<div class="portlet-body">
						<div><?php echo get_flashmsg(); ?></div>
							<?php if(!empty($error_msg)) { ?>
								<div class="alert alert-danger">
									<button class="close" data-dismiss="alert"></button>
									<span id="danger_msg"><?php echo $error_msg; ?></span>
								</div>
							<?php } ?>
							
							<table class="table table-bordered">
								<thead>
									<tr>
										
										<th width="60">S. No.</th>
										<th width="">Column Name</th>
										<th width="">Required</th>
										<th width="140">Action </th>
									</tr>
								</thead>
								<tbody>
								<?php
								if (isset($forms) && !empty($forms[0]->list)) 
								{
									$i = 1;
									foreach ($forms[0]->list as $k => $row) 
									{ ?>
										
											<tr align="left" id="<?php echo $k; ?>">
												
												<td > <?php echo $i; ?> </td>
												<td > <?php echo $row->label; ?> </td>
												<td > <?php echo ($row->validate)?"True":"False"; ?> </td>
												
												<td>
													<a href="#"  class="btn btn-xs delete deleteColumn" data-id="<?php echo $k; ?>"> <i class="fa fa-trash-o"></i> </a>
												</td>
											</tr>
										
									<?php if((count($forms[0]->list)-1) == $i){ break; } $i++; }
								} 
								else 
								{ ?>
								</tbody>
									<tbody>
										<tr>
											<td colspan="7" align="center"> <strong>No Result Found </strong></td>
										</tr>
									</tbody>
								<?php } ?>
							</table>
							
						</div>
					</div>
					<div class="portlet box yellow" id="addColumn">
						<div class="portlet-title">
							<div class="caption">
								Add Column Form
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
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Field Label<em>*</em></label>
													<div class="col-md-8">
														<input class="form-control" type="text" name="field_label" id="field_label">
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													The name of the field as it will displayto the user
												</div>
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Field Name<em>*</em></label>
													<div class="col-md-8">
														<input class="form-control" type="text" name="field_name" id="field_name">
														<div class="error" id="error_field_name"><?php echo form_error('field_name');?></div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													The database meta value for the field.it must be unique and contain no space ( underscore are ok)
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Field Type<em>*</em></label>
													<div class="col-md-8">
														<select name="field_type" id="field_type" class="form-control">
															<option value="" >Select Field Type</option>
															<option value="text" >text</option>
															<option value="email" >email</option>
															<option value="textarea" >textarea</option>
															<option value="checkbox" >checkbox</option>
															<option value="multiple_checkbox" >multiple checkbox</option>
															<option value="select" >select( dropdown)</option>
															<option value="multiple_select" >multiple select</option>
															<option value="radio" >radio group</option>
															<option value="password" >password</option>
															<option value="image" >image</option>
															<option value="file" >file</option>
															<option value="url" >url</option>
															<option value="hidden" >hidden</option>
														
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Required</label>
													<div class="col-md-8">
														<input class="form-control" type="checkbox" name="field_required" id="field_required" >
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div id="checkbox_store" style="display:none;">
										<div class="form-group">
											<div class="col-md-6">
												<div class="form-group">
													<div class="col-md-12">
														<label for="age" class="col-md-4 control-label">By default checked</label>
														<div class="col-md-4">
															<input class="form-control" type="checkbox" name="checkbox_default" id="checkbox_default">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="form-group">
											<div class="col-md-6">
												<div class="form-group">
													<div class="col-md-12">
														<label for="age" class="col-md-4 control-label">Store value if checked<em>*</em></label>
														<div class="col-md-4">
															<input class="form-control" type="text" name="checkbox_value" id="checkbox_value">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group" id="choose_type" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Choose Select Type</label>
													<div class="col-md-8">
														<div class="form-group">
															<div class="col-md-10" data-repeater-list="group-a">
															  <div class="col-md-6" data-repeater-item>
																<input class="form-control selectType" type="radio" name="type" value="1" />Custome
																
															  </div>
															  <div class="col-md-6" data-repeater-item>
																<input class="form-control selectType" type="radio" name="type" value="2" />Link Tables
																
															  </div>
															</div>
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									<div class="form-group" id="value_diplay" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">value(Display|value)</label>
													<div class="col-md-8">
														<div class="form-group">
															<div class="col-md-10" data-repeater-list="group-a">
															  <div class="col-md-6" data-repeater-item>
																<input class="form-control" type="text" name="display[]" />
																
															  </div>
															  <div class="col-md-6" data-repeater-item>
																<input class="form-control" type="text" name="value[]" />
																
															  </div>
															</div>
															<div class="col-md-2">
															<a href="#" id="click_checkbox"><i class="fa fa-plus" aria-hidden="true"></i></a>
															</div>
														</div>
														<div id="add_checkbox_more">
															
														</div>
													</div>
													
												</div>
											</div>
										</div>
									</div>
									<div class="form-group" id="linkTablelist" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Select Table<em>*</em></label>
													<div class="col-md-8">
														<select name="table_name" id="table_name" class="form-control">
															<option value="" >Select Field Type</option>
															<option value="country" >Country</option>
															<option value="state" >State</option>
															<option value="city" >City</option>
															
														</select>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									
									<!--<div class="form-group" id="select_store" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">value(Display|value)</label>
													<div class="col-md-8">
														<textarea class="form-control" name="select_value" id="select_value" rows="10" cols="50" >
														
														Choise One|choise_one,
														Choise Two|choise_two,
														Choise Three|choise_three,
														</textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="form-group" id="multiple_select_store" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">value(Display|value)</label>
													<div class="col-md-8">
														<textarea class="form-control" name="multiple_select_value" id="multiple_select_value" rows="10" cols="50" >
														
														Choise One|choise_one,
														Choise Two|choise_two,
														Choise Three|choise_three,
														</textarea>
													</div>
												</div>
											</div>
										</div>
									</div>
									
									<div class="form-group" id="radio_store" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">value(Display|value)</label>
													<div class="col-md-8">
														<textarea class="form-control" name="radio_value" id="radio_value" rows="10" cols="50" >
														Choise One|choise_one,
														Choise Two|choise_two,
														Choise Three|choise_three,
														</textarea>
													</div>
												</div>
											</div>
										</div>
									</div>-->
									
									<div class="form-group" id="file_store" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Accept file types</label>
													<div class="col-md-8">
														<input class="form-control" type="text" name="file_value" >
														<span>Accept file types should be set like this: jpg,jpeg,png,gif</span>
													</div>
												</div>
											</div>
										</div>											
									</div>
									
									<div class="form-group" id="image_store" style="display:none;">
										<div class="col-md-6">
											<div class="form-group">
												<div class="col-md-12">
													<label for="age" class="col-md-4 control-label">Accept file types</label>
													<div class="col-md-8">
														<input class="form-control" type="text" name="image_value" >
														<span>Accept file types should be set like this: jpg,jpeg,png,gif</span>
													</div>
												</div>
											</div>
										</div>											
									</div>
									
								</div>
								
								
								
								
								<div class="form-group">
									<div class="col-md-12">
										<div class="col-md-12 text-center margin-sm-form">
											<input type="submit" name="submit" value="Save" class="btn blue"/>
											<a href="<?php echo base_url(); ?>support"><input type="button" name="reset" value="Cancel" class="btn btn-default"/></a>
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/css/sortable-theme-bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"></script>

<script>

$(document).ready(function(){
    $("table tbody").sortable({
         items: 'tr',
        stop : function(event, ui){
          //alert($(this).sortable('toArray'));
		  //console.log($(this).sortable('toArray'));
			var token_value=$( "input[name='"+token_name+"']" ).val();
			$.ajax({
				url:'<?php echo base_url(); ?>support_form/change_order/<?php echo ID_encode($result->id) ?>',
				type:"POST",
				data: token_name+"="+token_value+"&order="+$(this).sortable('toArray'),
				success:function(result)
				{
					
				}
			});
        }
    });
  $("table tbody").disableSelection();
});//ready



$(".deleteColumn").click(function(event){
	event.preventDefault();
	
	  var key = $(this).attr('data-id');
	  	  
	  var choice = confirm("Are you sure delete this column");

	  if (choice) {
	    var token_value=$( "input[name='"+token_name+"']" ).val();
		$.ajax({
			url:'<?php echo base_url(); ?>support_form/delete_column/<?php echo ID_encode($result->id) ?>',
			type:"POST",
			data: token_name+"="+token_value+"&key="+key,
			success:function(result)
			{
				if(result == 1)
				{
					location.reload();
				}
				else{
					location.reload();
				}
				
			}
		});
	  }
})
	



// add more option
$("#click_checkbox").click(function(e){
	e.preventDefault();
	var options = '<div class="form-group moreClumn"><div class="col-md-10" data-repeater-list="group-a"><div class="col-md-6" data-repeater-item><input class="form-control" type="text" name="display[]" value=""/></div><div class="col-md-6" data-repeater-item><input class="form-control" type="text" name="value[]" value=""/>  </div></div><div class="col-md-2 removeColumnDiv"><a href="#" clas=""><i class="fa fa-minus" aria-hidden="true"></i></a></div></div>';
	
	$("#add_checkbox_more").append(options);
});

// remove column

$("body").on("click",".removeColumnDiv",function(event){
	event.preventDefault();
	$(this).parent().remove();
});

// filed type select


	$(".selectType").click(function()
	{
		
		 if($(this).val() == 1){
			$("#value_diplay").show();
			$("#linkTablelist").hide();
		}
		else{
			$("#linkTablelist").show();
			$("#value_diplay").hide();
		} 
	});
	 
	
	
	$("#field_type").change(function(){
		
		if($(this).val() == 'checkbox' || $(this).val() == 'multiple_checkbox' || $(this).val() == 'radio')
		{
			$("#linkTablelist").hide();
			$("#value_diplay").show();
			$("#image_store").hide();
			$("#file_store").hide();
			$("#choose_type").hide();
		}
		else if( $(this).val() == 'select' || $(this).val() == 'multiple_select'){
			$("#choose_type").show();
			$("#value_diplay").hide();
		}
		else{
			$("#linkTablelist").hide();
			$("#value_diplay").hide();
			$("#choose_type").hide();
		}
		if($(this).val() == 'file')
		{
			$("#linkTablelist").hide();
			$("#value_diplay").hide();
			$('input[name="file_value"]').attr('disabled',false);
			$("#file_store").show();
			
		}
		if($(this).val() == 'image')
		{
			$("#linkTablelist").hide();
			$("#value_diplay").hide();
			$('input[name="file_value"]').attr('disabled',false);
			$("#image_store").show();
			
		}
		
		/* if($(this).val() == 'checkbox')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',false);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").hide();
			$("#file_store").hide();
			$("#radio_store").hide();
			$("#multiple_select_store").hide();
			$("#select_store").hide();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").show();
		}
		if($(this).val() == 'multiple_checkbox')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',false);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").hide();
			$("#file_store").hide();
			$("#radio_store").hide();
			$("#multiple_select_store").hide();
			$("#select_store").hide();
			$("#multiple_checkbox_store").show();
			$("#checkbox_store").hide();
		}
		if($(this).val() == 'select')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',false);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").hide();
			$("#file_store").hide();
			$("#radio_store").hide();
			$("#multiple_select_store").hide();
			$("#select_store").show();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").hide();
		}
		if($(this).val() == 'multiple_select')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',false);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").hide();
			$("#file_store").hide();
			$("#radio_store").hide();
			$("#multiple_select_store").show();
			$("#select_store").hide();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").hide();
		}
		if($(this).val() == 'radio')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',false);
			
			$("#image_store").hide();
			$("#file_store").hide();
			$("#radio_store").show();
			$("#multiple_select_store").hide();
			$("#select_store").hide();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").hide();
		}
		if($(this).val() == 'file')
		{
			$('input[name="file_value"]').attr('disabled',false);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").hide();
			$("#file_store").show();
			$("#radio_store").hide();
			$("#multiple_select_store").hide();
			$("#select_store").hide();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").hide();
		}
		if($(this).val() == 'image')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',false);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").show();
			$("#file_store").hide();
			$("#radio_store").hide();
			$("#multiple_select_store").hide();
			$("#select_store").hide();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").hide();
		}
		if($(this).val() == 'text' || $(this).val() == 'email' || $(this).val() == 'textarea' || $(this).val() == 'password' || $(this).val() == 'url' || $(this).val() == 'hidden')
		{
			$('input[name="file_value"]').attr('disabled',true);
			$('input[name="image_value"]').attr('disabled',true);
			$('input[name="checkbox_value"]').attr('disabled',true);
			$("#multiple_checkbox_value").attr('disabled',true);
			$("#select_value").attr('disabled',true);
			$("#multiple_select_value").attr('disabled',true);
			$("#radio_value").attr('disabled',true);
			
			$("#image_store").hide();
			$("#file_store").hide();
			$("#radio_store").hide();
			$("#multiple_select_store").hide();
			$("#select_store").hide();
			$("#multiple_checkbox_store").hide();
			$("#checkbox_store").hide();
		} */
		
	});

$("#field_name").on("keydown", function (e) {
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