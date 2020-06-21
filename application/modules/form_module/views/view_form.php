<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel='stylesheet prefetch' href='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.css'>
<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

<style>
.radio-inline .radio{padding-top:0px !important;}
.form-actions {
/*padding: 5px 20px 5px;*/
margin-top: 30px;
text-align: left;
margin-bottom: 20px;
background-color: #ecf3f7;
border-top: 1px solid #e5e5e5;
*: ;
zoom: 1;
}
h3 {
font-size: 18px;
line-height: 10px;
padding-left: 10px;
padding-top: 7px;
}
.span6.select_style_margin-left{
width: 50%;
margin-left: -7px !important;
}
.tab_data {
padding: 10px 0;
margin: 0px 0 10px;
border: 1px solid #bdbdbd;
box-shadow: 0px 4px 9px 2px #949494;
}
.mt-10{
margin-top: 10px !important;
}
.ms-options-wrap > .ms-options {
position: absolute;
left: 689px !important;
width: calc(100% - 802px) !important ;
margin-top: 1px;
margin-bottom: 20px;
background: white;
z-index: 2000;
border: 1px solid #aaa;
overflow: auto;
margin: 0px 12px 0px 12px;
visibility: hidden;
}
.ms-options-wrap > .ms-options > .ms-search input {

height: 27px !important;
}
.ms-options-wrap > .ms-options > ul input[type="checkbox"] {

left: -53px !important;

}
.ms-options-wrap, .ms-options-wrap * {

border-radius: 5px;
line-height:12px;
margin-bottom:5px;

}
.error{
color:red;
}
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->

<div class="row-fluid">
<div class="span12">
<div class="box">
	<div class="title">

		<h4>
			 <span><?=$name->form_label?>
			</span>
		</h4>

	</div>
	<div class="content">
	
	<?php if(!empty($error_msg)) { ?>
		<div class="alert alert-danger">
			<button class="close" data-dismiss="alert"></button>
			<span id="danger_msg"><?php echo $error_msg; ?></span>
		</div>
	<?php } ?>
	<?php echo get_flashdata();?>
	
	<?php echo form_open_multipart(current_url(),array('id'=>'support_form','class'=>'form-horizontal')); ?>

	<?php 
	if(isset($form_data) && !empty($form_data) && count($form_data)>0){
		foreach($form_data as $block_key=>$frm_data){?>

			<!-- <div class="form-row row-fluid">
				<div class="form-actions">
					<h3><?=isset($frm_data->block) && strtolower($frm_data->block)=='default'?'Form':ucwords(strtolower($frm_data->block)) ?></h3>
				</div>
			</div> -->

			<?php 
			if(isset($frm_data->elements) && !empty($frm_data->elements) && count($frm_data->elements)>0){
				$iterat_arr = $frm_data->elements;
				$i=1;$k=0;
				
				foreach($frm_data->elements as $key=>$cols){?>
					<?php 
					if($key%2==0)
					{?>
					<div class="form-row row-fluid" id="<?=$i?>">
					<?php } ?>
								
						<?php if($iterat_arr[$k]->type == 'input'){ ?>

							<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
									<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
								  	<div class="row-fluid">
										<div class="span6 ">
											<?php 
											$ele = (array) $iterat_arr[$k];
											// pr($ele);
											$inp_type = $ele['data-input'];
											if($iterat_arr[$k]->required == 'true'){
												$class_name_dynamic='required';
											}else{
												$class_name_dynamic='';
											}?>
											<?php if($iterat_arr[$k]->unique == 'true'){
												$class_name_dynamic_unq='unique';
											}else{
												$class_name_dynamic_unq='';
											}?>
											<?php 
											if($inp_type=='textarea')
											{?>

											 	<?php echo $result[$iterat_arr[$k]->name]; ?>
											<?php } else{ ?>
											<?php echo $result[$iterat_arr[$k]->name]; ?>
				                          	<?php } ?>
					                       	<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
										</div>
								 	</div>
							 	</div>
							</div>

					 	<?php } else if($iterat_arr[$k]->type == 'password'){ ?>
					 		<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
									<label for="age" class="form-label span4"><?php echo $iterat_arr[$k]->label ?></label>
								  	<div class="row-fluid">
										<div class="span6 ">
											<?php if($iterat_arr[$k]->required == 'true'){
												$class_name_dynamic='required';
											}else{
												$class_name_dynamic='';
											}?>
											<?php if($iterat_arr[$k]->unique == 'true'){
												$class_name_dynamic_unq='unique';
											}else{
												$class_name_dynamic_unq='';
											}?>
											<?php echo $result[$iterat_arr[$k]->name]; ?>
				                          
					                       	<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
										</div>
								 	</div>
							 	</div>
							</div>
					 	<?php } else if($iterat_arr[$k]->type == 'file'){ ?>

					 		<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
							 		<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
								 	<div class="row-fluid">
										<div class="span6 ">
										
											<?php echo $result[$iterat_arr[$k]->name]; ?>
				                           
				                           	<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
									   
										</div>
								 	</div>
								</div>
							</div>

						<?php } else if($iterat_arr[$k]->type == 'label'){
							$option = $iterat_arr[$k]->list; ?>
							<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
									<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
														
									<div class="span6 select_style_margin-left" style="margin-top:5px;">
										<?php 

										foreach ($option as $option_key => $option_value) {?>
									        <div class="checker">
									            <span class="checked">
									                <?php echo $result[$iterat_arr[$k]->name]; ?>
									            </span>
									        </div><?=$option_value->label?>

										<?php }?>
								    </div>
								</div>
							</div>
						<?php } else if($iterat_arr[$k]->type == 'combo'){
							$option = json_decode($cols->connector)->options; ?>

							<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
									<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
														
									<div class="row-fluid">
										<div class="span6 ">
											<?php echo $result[$iterat_arr[$k]->name]; ?>
											<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
										</div>
								 	</div>
								</div>
							</div>
					 	<?php } else if($iterat_arr[$k]->type == 'select'){
							$option = $iterat_arr[$k]->options; ?>

							<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
									<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
														
									<div class="row-fluid">
										<div class="span6 ">
											<?php if(!empty($result[$iterat_arr[$k]->name])){?>
											<?php if($result[$iterat_arr[$k]->name]=='1'){ ?>
												<p><?php echo "Active" ?></p>
											<?php } else if($result[$iterat_arr[$k]->name]=='0') { ?>
												<p><?php echo "Inactive" ?></p>
											<?php }else{ ?>
											<p><?php echo $result[$iterat_arr[$k]->name]; ?></p>
											<?php } }?>
											<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
										</div>
								 	</div>
							 	</div>
						 	</div>
								 
					 	<?php } else if($iterat_arr[$k]->type == 'calendar'){ ?>

							<div class="span6" id ="<?=$key?>">
								<div class="row-fluid">
								 	<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
								 	<div class="row-fluid">
										<div class="span6 ">
											<?php echo $result[$iterat_arr[$k]->name]; ?>
											<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
										</div>
								 	</div>
								</div>
							</div>

				 		<?php }  ?>
				<?php 
				if($key%2!=0)
				{?>
		            </div>
				<?php } elseif(count($frm_data->elements)==$key+1){ ?>
					</div>
				<?php } ?>
			<?php $i++; $k++;
				}
			}
		}
	}?>
			
			<div class="form-row row-fluid" >
				<div class="span12">
					<div class="row-fluid">
						<div class="form-actions" style="text-align:center">								
							<div class="span12 controls">

								

								<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
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
<script type="text/javascript" src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/additional-methods.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/css/sortable-theme-bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"></script>

<script>

$(document).ready(function(){
//$( ".calendarDate" ).datepicker();

$(".calendarDate").datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    changeYear: true,
    constrainInput: false
});

});

$(document).ready(function(){
$("table tbody").sortable({
     items: 'tr',
    stop : function(event, ui){
      //alert($(this).sortable('toArray'));
	  //console.log($(this).sortable('toArray'));
		var token_value=$( "input[name='"+token_name+"']" ).val();
		$.ajax({
			url:'<?php echo base_url(); ?>support_form/change_order/<?php echo $result->id ?>',
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
		url:'<?php echo base_url(); ?>support_form/delete_column/<?php echo $result->id ?>',
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


$('#field_name').bind('cut copy paste', function (e) {
    e.preventDefault();
});



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

$('#field_name').bind('keyup', function (e) {
    // Filter non-digits from input value.
    if ($('#field_name').val().length == 0) {
        if (e.which == 32) { //space bar
            e.preventDefault();
        }
    } else {
        $(this).val($(this).val().replace(/[^A-Za-z_\s]/, ''))
    }
});


jQuery.validator.addMethod("noSpace", function(value, element) { 
  return value.indexOf(" ") < 0 && value != ""; 
}, "No space please and don't leave it empty");



$("#support_form").validate({
rules:{
		field_label:{
			required: true
		},
		form_label:{
			required: true,
			//alphanumeric: true
		},
		field_type:{
			required: true
		},
		"display[]":{
			 noSpace: true,
			required: true
		},
		"value[]":{
			 noSpace: true,
			required: true
		}
		
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

// check unique value or not 

$(document).ready(function() {
error = true;
$("form").submit(function() { 
    var form = this;
    var count_data = $("input.unique");
	var array_input_name =[];
	var array_input_type =[];
	var array_input_value =[];
	var action = "<?=$action;?>";
	var column_id = "<?=$result['form_id'];?>";
	var module_id = "<?=$table_id;?>";
  	$($("input.unique")).each(function(index,value){
		var input_name = count_data[index].name;
		var input_type = count_data[index].type;
		var input_val = count_data[index].value;

		array_input_name.push(input_name);
		array_input_type.push(input_type);
		array_input_value.push(input_val);
	});
	 
  	$.ajax({
		url:'<?php echo base_url(); ?>form_module/check_all_fields_unq',
		type:"POST",
		dataType:'json',
		data: token_name+"="+token_hash+"&array_input_name="+array_input_name+"&array_input_type="+array_input_type+"&array_input_value="+array_input_value+"&action="+action+"&column_id="+column_id+"&module_id="+module_id,
		success:function(res)
		{
			// console.log(JSON.parse(result));
			// var not_unique = JSON.parse(result);
			
			if(res.validation==1){
				error =true;
				var not_unique = res.data;
				for(var i=0;i<not_unique.length;i++){
					// console.log(not_unique[i].id);
					// console.log(not_unique[i].error);
					field_unq = not_unique[i].id;
					field_unq_error = not_unique[i].error;
					
					$($("input.unique")).each(function(index,value){
					  	//alert(index); 
					  	// Using $() to re-wrap the element.
					  	//$(testimonials[i]).text('a');
					  	var field_name = count_data[index].name;
						if(field_name ==field_unq){
							
							$("input[name=" + field_name + "]").next().html( field_unq_error );
						} 
					});
				}
			}else{
				error=false;
				$("div.error").html('');
				//alert(error);
				form.submit();
			}
		 	//return true;
		}
	});

    // always return false
	//alert(error);
	
	if(error == true){
    	return false;
	}
});
});  
</script>
