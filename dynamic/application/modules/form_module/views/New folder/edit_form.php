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
					 <span><?=lang($action."_title");?>
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
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('add_column_form_module')?></h3>
					</div>
				</div>
				<?php if(isset($cols) && !empty($cols)){ $i=1;
					$iterat_arr =array();
						//pr($cols);
						$iterat_arr = $cols;
						//pr($iterat_arr);die;
					if($i<=count($iterat_arr)){
				?>
					
				<?php $k=1; foreach($cols as $key=>$cols){    ?>
						
					<div class="form-row row-fluid" id="<?=$i?>">
						<?php if($k<=count($iterat_arr)){ ?>
						
						<div class="span6" id ="<?=$key?>">
						<div class="row-fluid">
							<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
						<?php if($iterat_arr[$k]->type == 'input'){ ?>
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
								<input type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="field_label" value="<?php echo $result[$iterat_arr[$k]->name]; ?>" class="col-xs-10 col-sm-6 pull-right <?=$class_name_dynamic_unq;?>" <?=$class_name_dynamic;?>  >
                              
                               <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
								</div>
							 </div>
							 <?php } else if($iterat_arr[$k]->type == 'file'){ ?>
							 <div class="row-fluid">
								<div class="span6 ">
								
								<input type="file" name="<?php echo $iterat_arr[$k]->name ?>" id="field_label" value="" class="col-xs-10 col-sm-6 pull-right" >
                               
                               <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										<?php 
														$ext = pathinfo($result[$iterat_arr[$k]->name], PATHINFO_EXTENSION);
														if($ext=='jpg' || $ext =='png' || $ext =='jpeg' || $ext =='gif' ){ 
													?>
								</div>
							 </div>
							 
							 
							 <div class="row-fluid">
								<div class="span6 ">
								
								<img src="<?php  echo base_url() ?>uploads/dynamic_form/<?php echo $result[$iterat_arr[$k]->name]; ?>" width="50" height="50"></img>
								</div>
							 </div>
							 <?php } else if($ext=='pdf' || $ext =='doc' || $ext =='docx') { ?>
							 <div class="row-fluid">
								<div class="span6 ">
								
								<img src="<?php  echo base_url() ?>uploads/dynamic_form/<?php echo $result[$iterat_arr[$k]->name]; ?>" width="50" height="50"></img>
								</div>
							 </div>
							 <?php } } else if($iterat_arr[$k]->type == 'combo'){ ?>
													<?php $option = json_decode($iterat_arr[$k]->connector)->options; ?>
													
							<div class="row-fluid">
								<div class="span6 ">
								
								<select name="<?php echo $iterat_arr[$k]->name ?>" class="">
															<?php foreach($option as $opt){ ?>
															<option value="<?php echo $opt->value; ?>" ><?php echo $opt->text; ?></option>
															<?php } ?>
														</select>
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										
								</div>
							 </div>
							 
							 <?php } else if($iterat_arr[$k]->type == 'select'){ ?>
													<?php $option = $iterat_arr[$k]->options; ?>
													
							<div class="row-fluid">
								<div class="span6 ">
								
								<select name="<?php echo $iterat_arr[$k]->name ?>" class="form-control">
															<?php foreach($option as $opt){ ?>
															<option value="<?php echo $opt->value; ?>" ><?php echo $opt->text; ?></option>
															<?php } ?>
														</select>
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										
								</div>
							 </div>
							 
							 <?php } else if($iterat_arr[$k]->type == 'calendar'){  ?>
							 
							 <div class="row-fluid">
								<div class="span6 ">
								
								<input class="form-control calendarDate" type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="<?php echo $iterat_arr[$k]->name ?>" value="<?php echo $result[$iterat_arr[$k]->name]; ?>">
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										
								</div>
							 </div>
							 <?php }  ?>
							 
							 
							 
						</div>
					</div>
						<?php }$k++;?>
					<!------------------- secon div on right starts here-------------------->
                    <div class="span6" id ="<?=$key?>">
						<div class="row-fluid">
							<label for="age" class="form-label span4"><?php if($iterat_arr[$k]->type != 'password'){ echo $iterat_arr[$k]->label; } ?><em><?php if($iterat_arr[$k]->type != 'password' && $iterat_arr[$k]->required == 'true'){ echo "*"; } ?></em></label>
						<?php if($iterat_arr[$k]->type == 'input'){ ?>
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
								<input type="text" name="<?php echo $iterat_arr[$k]->name ?>" id="field_label" value="<?php echo $result[$iterat_arr[$k]->name]; ?>" class="col-xs-10 col-sm-6 pull-right <?=$class_name_dynamic_unq;?>" <?=$class_name_dynamic;?> >
                              
                               <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
								</div>
							 </div>
							<?php } else if($iterat_arr[$k]->type == 'file'){ ?>
							 <div class="row-fluid">
								<div class="span6 ">
								
								<input type="file" name="<?php echo $iterat_arr[$k]->name ?>" id="field_label" value="" class="col-xs-10 col-sm-6 pull-right" >
                               
                               <div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										<?php 
														$ext = pathinfo($result[$iterat_arr[$k]->name], PATHINFO_EXTENSION);
														if($ext=='jpg' || $ext =='png' || $ext =='jpeg' || $ext =='gif' ){ 
													?>
								</div>
							 </div>
							 
							 
							 <div class="row-fluid">
								<div class="span6 ">
								
								<img src="<?php  echo base_url() ?>uploads/dynamic_form/<?php echo $result[$iterat_arr[$k]->name]; ?>" width="50" height="50"></img>
								</div>
							 </div>
							 <?php } else if($ext=='pdf' || $ext =='doc' || $ext =='docx') { ?>
							 <div class="row-fluid">
								<div class="span6 ">
								
								<img src="<?php  echo base_url() ?>uploads/dynamic_form/<?php echo $result[$iterat_arr[$k]->name]; ?>" width="50" height="50"></img>
								</div>
							 </div>
							 <?php } } else if($iterat_arr[$k]->type == 'combo'){ ?>
													<?php $option = json_decode($iterat_arr[$k]->connector)->options; ?>
													
							<div class="row-fluid">
								<div class="span6 ">
								
								<select name="<?php echo $iterat_arr[$k]->name ?>" class="">
															<?php foreach($option as $opt){ ?>
															<option value="<?php echo $opt->value; ?>" <?=($opt->value==$result['status']?"selected=selected":'')?>><?php echo $opt->text; ?></option>
															<?php } ?>
														</select>
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										
								</div>
							 </div>
							 
							 <?php } else if($iterat_arr[$k]->type == 'select'){ ?>
													<?php $option = $iterat_arr[$k]->options; ?>
													
							<div class="row-fluid">
								<div class="span6 ">
								
								<select name="<?php echo $iterat_arr[$k]->name ?>" class="form-control">
															<?php foreach($option as $opt){ ?>
															<option value="<?php echo $opt->value; ?>" <?=($opt->value==$result['status']?"selected=selected":'')?>><?php echo $opt->text; ?></option>
															<?php } ?>
														</select>
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										
								</div>
							 </div>
							 
							 <?php } else if($iterat_arr[$k]->type == 'calendar'){ ?>
							 
							 <div class="row-fluid">
								<div class="span6 ">
								
								<input class="form-control calendarDate" type="text" name="<?php echo $cols->name ?>" id="field_label" value="<?php echo $result[$cols->name]; ?>">
														<div class="error" id="error_field_label"><?php echo form_error('field_label');?></div>
							   
										
								</div>
							 </div>
							 <?php }  ?>
							 
							 
							 
						</div>
					</div>	
					<?php ?>
                </div>
				
				<?php  $i++;$k++;
				
				}}} ?>
				
				
				
				
				
				
				
				
				
			


				<div class="form-row row-fluid" >
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions" style="text-align:center">								
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
			field_name:{
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
	error= true;
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
  
 
 if(array_input_name!=''){
  $.ajax({
			url:'<?php echo base_url(); ?>form_module/check_all_fields_unq',
			type:"POST",
			data: token_name+"="+token_hash+"&array_input_name="+array_input_name+"&array_input_type="+array_input_type+"&array_input_value="+array_input_value+"&action="+action+"&column_id="+column_id+"&module_id="+module_id,
			success:function(result)
			{
				console.log(JSON.parse(result));
				var not_unique = JSON.parse(result);
				
				if(not_unique!='' && not_unique.length!=0){
					error =true;
					
						for(var i=0;i<not_unique.length;i++){
							console.log(not_unique[i].id);
							console.log(not_unique[i].error);
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
 }else{
	error=false;
					$("div.error").html('');
					//alert(error);
					form.submit(); 
 }
		if(error == true){
        return false;
		}
    });
});  





/*$("form").submit(function( event ) {
	var error =false;
	event.preventDefault();
	
	$(".error").html();
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
			data: token_name+"="+token_hash+"&array_input_name="+array_input_name+"&array_input_type="+array_input_type+"&array_input_value="+array_input_value+"&action="+action+"&column_id="+column_id+"&module_id="+module_id,
			success:function(result)
			{
				console.log(JSON.parse(result));
				var not_unique = JSON.parse(result);
				
				if(not_unique.length!=0){
					error =true;
						for(var i=0;i<not_unique.length;i++){
							console.log(not_unique[i].id);
							console.log(not_unique[i].error);
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
						
						
				}
				
				alert(error);
				alert("ayaa");
				if(error == false){
					return true;
				}
				
				
				
				 //return true;
			}
		});
  
				
});*/
</script>
