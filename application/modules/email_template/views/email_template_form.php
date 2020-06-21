<style>
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
.help-block{
	color:red;
	width: 140px;
    padding-left: 159px;
    margin-top: 30px !important;
    line-height: 1;
    margin-bottom: 1px !important;
    position: absolute;
	
}
.input-bottom-15{
	margin-bottom:15px !important;
}

.input-bottom-5{
	margin-bottom:11px !important;
}

.input-top-15{
	margin-top:15px !important;
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
			
			
				<?php echo get_flashdata();?>
				
				<?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal client_add_form')); ?>
				
				<!------------ Document Upload Info-------------------->
				
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('email_template')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('category')?><em>*</em></label>
							  <select name="category" id="category" class="span6 nostyle chosen-select" required>
									<option value="">Select</option>
									 <?php  if(isset($category) && is_array($category)){
                                                    foreach($category as $i_key => $i_val){
                                               ?>
                                               <option value="<?=$i_val->form_id;?>" <?= ($result->category == $i_val->form_id)?"selected='selected'":"" ?>><?=ucwords($i_val->name); ?></option>
                                    <?php } }?>
								</select>
						</div>
					</div>	
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('name')?><em>*</em></label>
							  <input type="text" class="span6 required" name="name" value="<?=isset($result->name)?$result->name:'';?>" />
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('doc_notes')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
									<textarea  name="notes" class="ckeditor"><?=@$result->notes;?></textarea>
								</div>
							 </div>
						</div>
					</div>	
                    
                </div>
				

				
               
				
			<!--------------------End-Documents Upload Info------------------------->	

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
<!--<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-1.9.1.min.js"></script>-->
 
<!--<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.multiselect.js"></script> -->
<script>
/*$(function () {
        $('select[multiple].multiple').multiselect({
            columns: 2,
            placeholder: 'Industry Type',
            search: true,
            searchOptions: {
                'default': 'Search...'
            },
            selectAll: false
        });
	});*/
	
	
	// get the state from country_name
	function fetch_state(id){
		//alert(id);
		if(id!=''){
			$.ajax({
						url:"<?php echo base_url();?>company/fetch_state_according_country",
                        method:"GET",
                        data:{id:id},
						success:function(data)
						{
                            //alert(country_id);
                           // alert(data);false;
						    //console.log(data);
							if(data=='<option value="">No state found</option>'){
								//alert();
								$('#state_comp').html(data);
								$('#city_comp').html('<option value="">Select</option>');
								$('#state_comp').trigger("chosen:updated");
								$('#city_comp').trigger("chosen:updated");
							}else{
							$('#state_comp').html(data);
							$('#state_comp').trigger("chosen:updated");
							}

						}
					});	
				}
				else
				{
					//$('#state_comp').append('<option value="">select country first</option>');
					$('#state_comp').trigger("chosen:updated");
				}
		
	}
	// get the city from state_name
	function fetch_city(id){
		
		if(id!=''){
			$.ajax({
				url:"<?php echo base_url();?>company/fetch_city_according_country",
	            method:"GET",
	            data:{id:id},
				success:function(data)
				{
	                //alert(id);
	                //alert(data);false;
					$('#city_comp').html(data);
					$('#city_comp').trigger("chosen:updated");

				}
			});	
		}
		else
		{
			//$('#city_comp').append('<option value="">select country first</option>');
			$('#city_comp').trigger("chosen:updated");
		}
		
	}
	
$("#company").blur(function(){
	$("#comapny_name_existance_error").html("");
        company_existance="";
    var name=$(this).val();
	//alert(name);false;
    var action="<?=SITE_PATH?>company/checkCompanyExistence";
    var str=token_name+"="+token_hash+"&name="+name;
    $.post(action,str,function(data){
        //alert(data);
		if(data=="1")
        {
            var error='<label for="comapny_name" generated="true" class="error">Oops !! This company has been taken by someone else.</label>';
            $("#comapny_name_existance_error").html(error);
            company_existance="yes";
        }
        else
        {
            $("#comapny_name_existance_error").html("");
            company_existance="";
        }
    });
});


$("#client_id").blur(function(){
	client_id_existance='';
	$("#client_id_existance_error").html("");
    var client_id=$(this).val();
	//alert(client_id);false;
    var action="<?=SITE_PATH?>company/checkClientIdExistence";
    var str=token_name+"="+token_hash+"&client_id="+client_id;
    $.post(action,str,function(data){
        //alert(data);
		if(data=="1")
        {
            var error='<label for="client_id" generated="true" class="error">Oops !! This client id has been taken by someone else.</label>';
            $("#client_id_existance_error").html(error);
           client_id_existance="yes";
        }
        else
        {
            $("#client_id_existance_error").html("");
            client_id_existance="";
        }
    });
});

$(".client_add_form").submit(function(){
	var client_id=$("#client_id").val();
	var company_id=$("#company").val();
   if(client_id_existance=="yes" && client_id!='')
   {
        var error='<label for="client_id" generated="true" class="error" style="display:block !important">Oops !! This client id has been taken by someone else.</label>';
        $("#client_id_existance_error").html(error);
        return false;
   }
   
   if(company_existance=="yes" && company_id!='')
   {
        var error='<label for="comapny_name" generated="true" class="error" style="display:block !important">Oops !! This company has been taken by someone else.</label>';
        $("#comapny_name_existance_error").html(error);
        return false;
   } 
});

</script>
<script>
var method = "<?php echo $this->uri->segment(3);?>";

if(method == "add"){
var count = 0 ;

$(document).on('click','.minus_plc',function(){
	var open_block	= $("input[name='open_plc_varient_count']").val();
	var current_block = $(this).attr('data');
	
	if(count == 0){
		
		console.log(count)
		 alert("Not Deleted.");
	}else{
		count--;
		$("#plc_varient_"+current_block).remove();
		
	}
});
	$(document).on('click','.add_plc',function(){
		
		
		var th = $(this);
		var open_block	= $("input[name='open_plc_varient_count']").val();
		
		/*check either all open block are filled*/
		var error = true;
		$("select[name='data[common][plc_dcs_make][]']").each(function(){
			//alert($(this).val());
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		$("input[name='data[common][plc_dcs_qty][]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		
		open_block_next = parseInt(open_block) + 1;
		if(error == true)
		{	
			count++;
			//alert("menu_varient_"+open_block_next);
			//alert("data="'+open_block_next+'"");
			//$(".minus_aisehiplc").addClass('hide');
			//$("#plc_varient_1").find(".minus_plc").removeClass('hide');
			//$("#plc_varient_1").find(".add_plc").addClass('hide');
			//$("#menu_varient_"+open_block_next).find(".minus").removeClass('hide');
			//$("#plc_varient_"+open_block_next).find(".add_plc").addClass('hide');
			//$("#plc_varient_"+open_block_next).find("a.minus_plc[data='" + open_block_next + "']").removeClass('hide');
			//$("#menu_varient_"+open_block_next").find("a[data-slide='" + open_block_next + "']").removeClass('hide');
			//if($("#menu_varient_"+open_block_next").find("a[data='" + open_block_next + "']").hasClass('hide')){
				//alert();
			//}
			//$(".minus[data='"+open_block_next+"']").removeClass('activeBirds');
			//$(".minus_plc").removeClass('hide');
			//$(".add_plc").addClass('hide');
			var str = '';
			//str += '<div class="row" id="menu_varient_' + open_block_next + '">';
			str += '<div id="plc_varient_'+ open_block_next+ '">';
			
			str +=			'<div class="form-row row-fluid">';
			str +=			'<div class="span6">';
			str +=			'<div class="row-fluid">';
			str +=			'<label class="form-label span4" for="normal"><?=lang("plc_dcs_make")?><em>*</em></label>';
			str +=			'<div class="row-fluid">';
			str +=			'<div class="span6 select_style_margin-left">';
			$('.chosen-select').chosen();
			$(".chosen-select").trigger("chosen:updated");
			
			str +=				'<select name="data[common][plc_dcs_make][]" id="plc_dcs_make_'+ open_block_next +'" class="nostyle chosen-select">';
			str +=				'<option value="">Select</option>';
            str +=              '<?php if(isset($plc_dcs_make) && is_array($plc_dcs_make)){ foreach($plc_dcs_make as $i_key => $i_val){ ?>';
			str +=              '<option value="<?=$i_val->form_id;?>"><?=$i_val->name; ?></option>';
            str +=              '<?php } }?>';
			str +=				'</select>';
			
			
			
			
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'<div class="span6">';
			str +=		'<div class="row-fluid">';
			str +=		'<label class="form-label span4" for="normal"><?=lang("plc_dcs_qty")?></label>';
			str +=		'<div class="row-fluid">';
			str +=		'<div class="span6 input-bottom-15">  ';
			str +=			'<input type="text"  name="data[common][plc_dcs_qty][]" id="plc_dcs_qty_'+ open_block_next +'" value="" class="col-xs-10 col-sm-6 pull-right " >';
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="add_plc"><i class="fa fa-plus" style="color:#45bd41;position: absolute;top: 8px;right:78px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="minus_plc "><i class="fa fa-minus " style="color:#c8202d;position: absolute;top: 8px;right: 54px;"></i></a>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			
			
			str +='</div>';
			//alert(str);
			$("input[name='open_plc_varient_count']").val(open_block_next);
			$("#plc_varient").append(str);	
		}else{
			//alert("ddd");
		}
	});
	
}else{
	
	
	
var count = $("input[name='open_plc_varient_count']").val();
$(document).on('click','.minus_plc',function(){
	var open_block	= $("input[name='open_plc_varient_count']").val();
	var current_block = $(this).attr('data');
	
	
	if(count <= 1){
		
		console.log(count)
		 alert("Not Deleted.");
	}else{
		count--;
		$("#plc_varient_"+current_block).remove();
		
	}
});
	$(document).on('click','.add_plc',function(){
		
		
		var th = $(this);
		var open_block	= $("input[name='open_plc_varient_count']").val();
		
		/*check either all open block are filled*/
		var error = true;
		$("select[name='data[common][plc_dcs_make][]']").each(function(){
			//alert($(this).val());
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		$("input[name='data[common][plc_dcs_qty][]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		
		open_block_next = parseInt(open_block) + 1;
		if(error == true)
		{	
			count++;
			
			//alert("menu_varient_"+open_block_next);
			//alert("data="'+open_block_next+'"");
			//$(".minus_aisehiplc").addClass('hide');
			//$("#plc_varient_1").find(".minus_plc").removeClass('hide');
			//$("#plc_varient_1").find(".add_plc").addClass('hide');
			//$("#menu_varient_"+open_block_next).find(".minus").removeClass('hide');
			//$("#plc_varient_"+open_block_next).find(".add_plc").addClass('hide');
			//$("#plc_varient_"+open_block_next).find("a.minus_plc[data='" + open_block_next + "']").removeClass('hide');
			//$("#menu_varient_"+open_block_next").find("a[data-slide='" + open_block_next + "']").removeClass('hide');
	//if($("#menu_varient_"+open_block_next").find("a[data='" + open_block_next + "']").hasClass('hide')){
				//alert();
			//}
			//$(".minus[data='"+open_block_next+"']").removeClass('activeBirds');
			//$(".minus_plc").removeClass('hide');
			//$(".add_plc").addClass('hide');
			var str = '';
			//str += '<div class="row" id="menu_varient_' + open_block_next + '">';
			str += '<div id="plc_varient_'+ open_block_next+ '">';
			str +='<input type="hidden" name="plc_varient_all_ids[]" value="">';
			str +=			'<div class="form-row row-fluid">';
			str +=			'<div class="span6">';
			str +=			'<div class="row-fluid">';
			str +=			'<label class="form-label span4" for="normal"><?=lang("plc_dcs_make")?><em>*</em></label>';
			str +=			'<div class="row-fluid">';
			str +=			'<div class="span6  select_style_margin-left">';
			$('.chosen-select').chosen();
			$(".chosen-select").trigger("chosen:updated");
			
			str +=				'<select name="data[common][plc_dcs_make][]" id="plc_dcs_make_'+ open_block_next +'" class="nostyle chosen-select">';
			str +=				'<option value="">Select</option>';
            str +=              '<?php if(isset($plc_dcs_make) && is_array($plc_dcs_make)){ foreach($plc_dcs_make as $i_key => $i_val){ ?>';
			str +=              '<option value="<?=$i_val->form_id;?>"><?=$i_val->name; ?></option>';
            str +=              '<?php } }?>';
			str +=				'</select>';
			
			
			
			
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'<div class="span6">';
			str +=		'<div class="row-fluid">';
			str +=		'<label class="form-label span4" for="normal"><?=lang("plc_dcs_qty")?></label>';
			str +=		'<div class="row-fluid">';
			str +=		'<div class="span6 input-bottom-15">  ';
			str +=			'<input type="text"  name="data[common][plc_dcs_qty][]" id="plc_dcs_qty_'+ open_block_next +'" value="" class="col-xs-10 col-sm-6 pull-right " >';
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="add_plc"><i class="fa fa-plus" style="color:#45bd41;position: absolute;top: 8px;right:78px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="minus_plc "><i class="fa fa-minus " style="color:#c8202d;position: absolute;top: 8px;right: 54px;"></i></a>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			
			
			str +='</div>';
			//alert(str);
			$("input[name='open_plc_varient_count']").val(open_block_next);
			$("#plc_varient").append(str);	
		}else{
			//alert("ddd");
		}
	});
	
	
	
}


	
if(method == "add"){
var count1 = 0 ;

$(document).on('click','.minus_actuator',function(){
	var open_block	= $("input[name='open_actuator_varient_count']").val();
	var current_block = $(this).attr('data');
	
	
	if(count1 == 0){
		
		console.log(count)
		 alert("Not Deleted.");
	}else{
		count1--;
		$("#actuator_varient_"+current_block).remove();
		
	}
});
	$(document).on('click','.add_actuator',function(){
		
		
		var th = $(this);
		var open_block	= $("input[name='open_actuator_varient_count']").val();
		
		/*check either all open block are filled*/
		var error = true;
		$("select[name='data[common][actuator_make][]']").each(function(){
			//alert($(this).val());
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		$("input[name='data[common][actuator_qty][]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		
		open_block_next = parseInt(open_block) + 1;
		if(error == true)
		{	
			count1++;
			//alert("menu_varient_"+open_block_next);
			//alert("data="'+open_block_next+'"");
			//$(".minus_aisehiplc").addClass('hide');
			//$("#plc_varient_1").find(".minus_plc").removeClass('hide');
			//$("#plc_varient_1").find(".add_plc").addClass('hide');
			//$("#menu_varient_"+open_block_next).find(".minus").removeClass('hide');
			//$("#plc_varient_"+open_block_next).find(".add_plc").addClass('hide');
			//$("#plc_varient_"+open_block_next).find("a.minus_plc[data='" + open_block_next + "']").removeClass('hide');
			//$("#menu_varient_"+open_block_next").find("a[data-slide='" + open_block_next + "']").removeClass('hide');
	//if($("#menu_varient_"+open_block_next").find("a[data='" + open_block_next + "']").hasClass('hide')){
				//alert();
			//}
			//$(".minus[data='"+open_block_next+"']").removeClass('activeBirds');
			//$(".minus_plc").removeClass('hide');
			//$(".add_plc").addClass('hide');
			var str = '';
			//str += '<div class="row" id="menu_varient_' + open_block_next + '">';
			str += '<div id="actuator_varient_'+ open_block_next+ '">';
			
			str +=			'<div class="form-row row-fluid">';
			str +=			'<div class="span6">';
			str +=			'<div class="row-fluid">';
			str +=			'<label class="form-label span4" for="normal"><?=lang("actuator_make")?><em>*</em></label>';
			str +=			'<div class="row-fluid">';
			str +=			'<div class="span6  select_style_margin-left">';
			$('.chosen-select').chosen();
			$(".chosen-select").trigger("chosen:updated");
			
			str +=				'<select name="data[common][actuator_make][]" id="actuator_make_'+ open_block_next +'" class="nostyle chosen-select">';
			str +=				'<option value="">Select</option>';
            str +=              '<?php if(isset($actuator_make) && is_array($actuator_make)){ foreach($actuator_make as $i_key => $i_val){ ?>';
			str +=              '<option value="<?=$i_val->form_id;?>" ><?=$i_val->name; ?></option>';
            str +=              '<?php } }?>';
			str +=				'</select>';
			
			
			
			
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'<div class="span6">';
			str +=		'<div class="row-fluid">';
			str +=		'<label class="form-label span4" for="normal"><?=lang("actuator_qty")?></label>';
			str +=		'<div class="row-fluid">';
			str +=		'<div class="span6 input-bottom-15">  ';
			str +=			'<input type="text"  name="data[common][actuator_qty][]" id="actuator_qty_'+ open_block_next +'" value="" class="col-xs-10 col-sm-6 pull-right " >';
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="add_actuator"><i class="fa fa-plus" style="color:#45bd41;position: absolute;top: 8px;right:78px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="minus_actuator "><i class="fa fa-minus " style="color:#c8202d;position: absolute;top: 8px;right: 54px;"></i></a>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			
			
			str +='</div>';
			//alert(str);
			$("input[name='open_actuator_varient_count']").val(open_block_next);
			$("#actuator_varient").append(str);	
		}else{
			//alert("ddd");
		}
	});
	
}else{
	
	
	
var count1 = $("input[name='open_actuator_varient_count']").val();
$(document).on('click','.minus_actuator',function(){
	var open_block	= $("input[name='open_actuator_varient_count']").val();
	var current_block = $(this).attr('data');
	
	
	if(count1 <= 1){
		
		console.log(count)
		 alert("Not Deleted.");
	}else{
		count1--;
		$("#actuator_varient_"+current_block).remove();
		
	}
});
	$(document).on('click','.add_actuator',function(){
		
		
		var th = $(this);
		var open_block	= $("input[name='open_actuator_varient_count']").val();
		
		/*check either all open block are filled*/
		var error = true;
		$("select[name='data[common][actuator_make][]']").each(function(){
			//alert($(this).val());
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		$("input[name='data[common][actuator_qty][]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		
		open_block_next = parseInt(open_block) + 1;
		if(error == true)
		{	
			count1++;
			
			//alert("menu_varient_"+open_block_next);
			//alert("data="'+open_block_next+'"");
			//$(".minus_aisehiplc").addClass('hide');
			//$("#plc_varient_1").find(".minus_plc").removeClass('hide');
			//$("#plc_varient_1").find(".add_plc").addClass('hide');
			//$("#menu_varient_"+open_block_next).find(".minus").removeClass('hide');
			//$("#plc_varient_"+open_block_next).find(".add_plc").addClass('hide');
			//$("#plc_varient_"+open_block_next).find("a.minus_plc[data='" + open_block_next + "']").removeClass('hide');
			//$("#menu_varient_"+open_block_next").find("a[data-slide='" + open_block_next + "']").removeClass('hide');
	//if($("#menu_varient_"+open_block_next").find("a[data='" + open_block_next + "']").hasClass('hide')){
				//alert();
			//}
			//$(".minus[data='"+open_block_next+"']").removeClass('activeBirds');
			//$(".minus_plc").removeClass('hide');
			//$(".add_plc").addClass('hide');
			var str = '';
			//str += '<div class="row" id="menu_varient_' + open_block_next + '">';
			str += '<div id="actuator_varient_'+ open_block_next+ '">';
			str +='<input type="hidden" name="actuator_varient_all_ids[]" value="">';
			str +=			'<div class="form-row row-fluid">';
			str +=			'<div class="span6">';
			str +=			'<div class="row-fluid">';
			str +=			'<label class="form-label span4" for="normal"><?=lang("actuator_make")?><em>*</em></label>';
			str +=			'<div class="row-fluid">';
			str +=			'<div class="span6 select_style_margin-left">';
			$('.chosen-select').chosen();
			$(".chosen-select").trigger("chosen:updated");
			
			str +=				'<select name="data[common][actuator_make][]" id="actuator_make_'+ open_block_next +'" class="nostyle chosen-select">';
			str +=				'<option value="">Select</option>';
            str +=              '<?php if(isset($actuator_make) && is_array($actuator_make)){ foreach($actuator_make as $i_key => $i_val){ ?>';
			str +=              '<option value="<?=$i_val->form_id;?>" ><?=$i_val->name; ?></option>';
            str +=              '<?php } }?>';
			str +=				'</select>';
			
			
			
			
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'<div class="span6">';
			str +=		'<div class="row-fluid">';
			str +=		'<label class="form-label span4" for="normal"><?=lang("actuator_qty")?></label>';
			str +=		'<div class="row-fluid">';
			str +=		'<div class="span6 input-bottom-15">  ';
			str +=			'<input type="text"  name="data[common][actuator_qty][]" id="actuator_qty_'+ open_block_next +'" value="" class="col-xs-10 col-sm-6 pull-right " >';
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="add_actuator"><i class="fa fa-plus" style="color:#45bd41;position: absolute;top: 8px;right:78px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="minus_actuator "><i class="fa fa-minus " style="color:#c8202d;position: absolute;top: 8px;right: 54px;"></i></a>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			
			
			str +='</div>';
			//alert(str);
			$("input[name='open_actuator_varient_count']").val(open_block_next);
			$("#actuator_varient").append(str);	
		}else{
			//alert("ddd");
		}
	});
	
	
	
}	
	
	
	
	
	
	//  ######################### VFD REPEAT BLOCK #############
	
	
if(method == "add"){
var count2 = 0 ;

$(document).on('click','.minus_vfd',function(){
	var open_block	= $("input[name='open_vfd_varient_count']").val();
	var current_block = $(this).attr('data');
	
	
	if(count2 == 0){
		
		console.log(count)
		 alert("Not Deleted.");
	}else{
		count2--;
		$("#vfd_varient_"+current_block).remove();
		
	}
});
	$(document).on('click','.add_vfd',function(){
		
		
		var th = $(this);
		var open_block	= $("input[name='open_vfd_varient_count']").val();
		
		/*check either all open block are filled*/
		var error = true;
		$("select[name='data[common][vfd_make][]']").each(function(){
			//alert($(this).val());
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		$("input[name='data[common][vfd_qty][]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		
		open_block_next = parseInt(open_block) + 1;
		if(error == true)
		{	
			count2++;
			//alert("menu_varient_"+open_block_next);
			//alert("data="'+open_block_next+'"");
			//$(".minus_aisehiplc").addClass('hide');
			//$("#plc_varient_1").find(".minus_plc").removeClass('hide');
			//$("#plc_varient_1").find(".add_plc").addClass('hide');
			//$("#menu_varient_"+open_block_next).find(".minus").removeClass('hide');
			//$("#plc_varient_"+open_block_next).find(".add_plc").addClass('hide');
			//$("#plc_varient_"+open_block_next).find("a.minus_plc[data='" + open_block_next + "']").removeClass('hide');
			//$("#menu_varient_"+open_block_next").find("a[data-slide='" + open_block_next + "']").removeClass('hide');
	//if($("#menu_varient_"+open_block_next").find("a[data='" + open_block_next + "']").hasClass('hide')){
				//alert();
			//}
			//$(".minus[data='"+open_block_next+"']").removeClass('activeBirds');
			//$(".minus_plc").removeClass('hide');
			//$(".add_plc").addClass('hide');
			var str = '';
			//str += '<div class="row" id="menu_varient_' + open_block_next + '">';
			str += '<div id="vfd_varient_'+ open_block_next+ '">';
			str +='<input type="hidden" name="vfd_varient_all_ids[]" value="">';
			str +=			'<div class="form-row row-fluid">';
			str +=			'<div class="span6">';
			str +=			'<div class="row-fluid">';
			str +=			'<label class="form-label span4" for="normal"><?=lang("vfd_make")?><em>*</em></label>';
			str +=			'<div class="row-fluid">';
			str +=			'<div class="span6 select_style_margin-left ">';
			$('.chosen-select').chosen();
			$(".chosen-select").trigger("chosen:updated");
			
			str +=				'<select name="data[common][vfd_make][]" id="vfd_make_'+ open_block_next +'" class="nostyle chosen-select">';
			sstr +=				'<option value="">Select</option>';
            str +=              '<?php if(isset($vfd_make) && is_array($vfd_make)){ foreach($vfd_make as $i_key => $i_val){ ?>';
			str +=              '<option value="<?=$i_val->form_id;?>" ><?=$i_val->name; ?></option>';
            str +=              '<?php } }?>';
			str +=				'</select>';
			
			
			
			
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'<div class="span6">';
			str +=		'<div class="row-fluid">';
			str +=		'<label class="form-label span4" for="normal"><?=lang("vfd_qty")?></label>';
			str +=		'<div class="row-fluid">';
			str +=		'<div class="span6 input-bottom-15">  ';
			str +=			'<input type="text"  name="data[common][vfd_qty][]" id="vfd_qty_'+ open_block_next +'" value="" class="col-xs-10 col-sm-6 pull-right " >';
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="add_vfd"><i class="fa fa-plus" style="color:#45bd41;position: absolute;top: 8px;right:78px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="minus_vfd "><i class="fa fa-minus " style="color:#c8202d;position: absolute;top: 8px;right: 54px;"></i></a>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			
			
			str +='</div>';
			//alert(str);
			$("input[name='open_vfd_varient_count']").val(open_block_next);
			$("#vfd_varient").append(str);	
		}else{
			//alert("ddd");
		}
	});
	
}else{
	
	
	
var count2 = $("input[name='open_vfd_varient_count']").val();
$(document).on('click','.minus_vfd',function(){
	var open_block	= $("input[name='open_vfd_varient_count']").val();
	var current_block = $(this).attr('data');
	
	
	if(count2 <= 1){
		
		console.log(count2)
		 alert("Not Deleted.");
	}else{
		count2--;
		$("#vfd_varient_"+current_block).remove();
		
	}
});
	$(document).on('click','.add_vfd',function(){
		
		
		var th = $(this);
		var open_block	= $("input[name='open_vfd_varient_count']").val();
		
		/*check either all open block are filled*/
		var error = true;
		$("select[name='data[common][vfd_make][]']").each(function(){
			//alert($(this).val());
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		$("input[name='data[common][vfd_qty][]']").each(function(){
			if($(this).val() == ''){
				error = false;
				$(this).parent().next('p').html('This field is required');
			}else{
				$(this).parent().next('p').html('');
			}
		});
		
		
		open_block_next = parseInt(open_block) + 1;
		if(error == true)
		{	
			count2++;
			
			//alert("menu_varient_"+open_block_next);
			//alert("data="'+open_block_next+'"");
			//$(".minus_aisehiplc").addClass('hide');
			//$("#plc_varient_1").find(".minus_plc").removeClass('hide');
			//$("#plc_varient_1").find(".add_plc").addClass('hide');
			//$("#menu_varient_"+open_block_next).find(".minus").removeClass('hide');
			//$("#plc_varient_"+open_block_next).find(".add_plc").addClass('hide');
			//$("#plc_varient_"+open_block_next).find("a.minus_plc[data='" + open_block_next + "']").removeClass('hide');
			//$("#menu_varient_"+open_block_next").find("a[data-slide='" + open_block_next + "']").removeClass('hide');
	//if($("#menu_varient_"+open_block_next").find("a[data='" + open_block_next + "']").hasClass('hide')){
				//alert();
			//}
			//$(".minus[data='"+open_block_next+"']").removeClass('activeBirds');
			//$(".minus_plc").removeClass('hide');
			//$(".add_plc").addClass('hide');
			var str = '';
			//str += '<div class="row" id="menu_varient_' + open_block_next + '">';
			str += '<div id="vfd_varient_'+ open_block_next+ '">';
			
			str +=			'<div class="form-row row-fluid">';
			str +=			'<div class="span6">';
			str +=			'<div class="row-fluid">';
			str +=			'<label class="form-label span4" for="normal"><?=lang("vfd_make")?><em>*</em></label>';
			str +=			'<div class="row-fluid">';
			str +=			'<div class="span6 ">';
			$('.chosen-select').chosen();
			$(".chosen-select").trigger("chosen:updated");
			
			str +=				'<select name="data[common][vfd_make][]" id="vfd_make_'+ open_block_next +'" class="nostyle chosen-select">';
			str +=				'<option value="">Select</option>';
            str +=              '<?php if(isset($vfd_make) && is_array($vfd_make)){ foreach($vfd_make as $i_key => $i_val){ ?>';
			str +=              '<option value="<?=$i_val->form_id;?>" ><?=$i_val->name; ?></option>';
            str +=              '<?php } }?>';
			str +=				'</select>';
			
			
			
			
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'</div>';
			str +=		'<div class="span6">';
			str +=		'<div class="row-fluid">';
			str +=		'<label class="form-label span4" for="normal"><?=lang("vfd_qty")?></label>';
			str +=		'<div class="row-fluid">';
			str +=		'<div class="span6">  ';
			str +=			'<input type="text"  name="data[common][vfd_qty][]" id="vfd_qty_'+ open_block_next +'" value="" class="col-xs-10 col-sm-6 pull-right input-bottom-15" >';
			str +=		'</div>';
			str +=			'<p class="help-block"></p>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="add_vfd"><i class="fa fa-plus" style="color:#45bd41;position: absolute;top: 8px;right:78px;"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;';
			
			str +=				'<a href="javascript:void(0);" data="'+open_block_next+'" class="minus_vfd "><i class="fa fa-minus " style="color:#c8202d;position: absolute;top: 8px;right: 54px;"></i></a>';
			str +=		'</div>';
			str +=		'</div>';
			
			
			
			
			
			str +='</div>';
			//alert(str);
			$("input[name='open_vfd_varient_count']").val(open_block_next);
			$("#vfd_varient").append(str);	
		}else{
			//alert("ddd");
		}
	});
	
}


$("input[name='document[]']").change(function(){
	
	var th		= $("input[name='document[]']");
	var flag 	= false;
	$(".document_previews").html('');
	$.each(th[0].files, function (i, file) {
		
		var file_name = file.name;
		var ext = file_name.split('.').pop();
		console.log(ext);
		var allowedExtensions = /(<?=set_file_extension();?>)$/i;
		//alert(allowedExtensions);return false;
		//var allowedExtensions = /(\.js|\.php|\.html|\.sql)$/i;
    	if(allowedExtensions.exec(file_name))
    	{
			if(ext=='jpg' || ext=='png')
			{
	            var reader = new FileReader();
	            reader.onload = function(e) {
	                $(".document_previews").append('<img style="height:20px;width:30px;padding-right:3px" src="'+e.target.result+'"/>');
	            };
	            reader.readAsDataURL(file);
			}
			else
			{
				$(".document_previews").append('<img style="height:20px;width:30px;padding-right:3px" src="<?=base_url('assets/images/file_icon.png')?>"/>');
			}
			
			//Image preview
		}else{

			flag = true;
		}
	});
	if(flag==true)
	{
		alert('Please upload file having extensions <?=check_file_extension()?> only');
		$("input[name='document[]']").val('');
		return false;
	}
});
</script>