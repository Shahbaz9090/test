
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
.fa_icon_pos{

    position: absolute;
    top: 8px;
    left: 431px;
}

.fa_icon_pos_minus{

    position: absolute;
    left: 433px;
    top: 10px;
}
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->

<div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang($action . "_title");?>
					</span>
				</h4>

			</div>
			<div class="content">

				<?php if (!empty($error_msg)) {?>
					<div class="alert alert-danger">
						<button class="close" data-dismiss="alert"></button>
						<span id="danger_msg"><?php echo $error_msg; ?></span>
					</div>
				<?php }?>
				<?php echo get_flashdata(); ?>

				<?php echo form_open_multipart(current_url(), array('id' => 'support_form', 'class' => 'form-horizontal')); ?>
				<div class="form-row row-fluid">
					<div class="form-actions">
						<h3><?=lang('add_column_form_module')?></h3>
					</div>
				</div>

				<!-- Database table structure -->
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('data_type')?><em>*</em></label>
						  	<div class="row-fluid">
								<div class="span6 select_style_margin-left">
									<select class="col-xs-10 col-sm-6 pull-right text data_type nostyle chosen-select" name="data_type" id="data_type">
									   <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
									   <option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option>
									   <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option>
									   <option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option>
									   <optgroup label="Numeric">
									      <option title="A 1-byte integer, signed range is -128 to 127, unsigned range is 0 to 255">TINYINT</option>
									      <option title="A 2-byte integer, signed range is -32,768 to 32,767, unsigned range is 0 to 65,535">SMALLINT</option>
									      <option title="A 3-byte integer, signed range is -8,388,608 to 8,388,607, unsigned range is 0 to 16,777,215">MEDIUMINT</option>
									      <option title="A 4-byte integer, signed range is -2,147,483,648 to 2,147,483,647, unsigned range is 0 to 4,294,967,295">INT</option>
									      <option title="An 8-byte integer, signed range is -9,223,372,036,854,775,808 to 9,223,372,036,854,775,807, unsigned range is 0 to 18,446,744,073,709,551,615">BIGINT</option>
									      <option disabled="disabled">-</option>
									      <option title="A fixed-point number (M, D) - the maximum number of digits (M) is 65 (default 10), the maximum number of decimals (D) is 30 (default 0)">DECIMAL</option>
									      <option title="A small floating-point number, allowable values are -3.402823466E+38 to -1.175494351E-38, 0, and 1.175494351E-38 to 3.402823466E+38">FLOAT</option>
									      <option title="A double-precision floating-point number, allowable values are -1.7976931348623157E+308 to -2.2250738585072014E-308, 0, and 2.2250738585072014E-308 to 1.7976931348623157E+308">DOUBLE</option>
									      <option title="Synonym for DOUBLE (exception: in REAL_AS_FLOAT SQL mode it is a synonym for FLOAT)">REAL</option>
									      
									   </optgroup>
									   <optgroup label="Date and time">
									      <option title="A date, supported range is 1000-01-01 to 9999-12-31">DATE</option>
									      <option title="A date and time combination, supported range is 1000-01-01 00:00:00 to 9999-12-31 23:59:59">DATETIME</option>
									      <option title="A timestamp, range is 1970-01-01 00:00:01 UTC to 2038-01-09 03:14:07 UTC, stored as the number of seconds since the epoch (1970-01-01 00:00:00 UTC)">TIMESTAMP</option>
									      <option title="A time, range is -838:59:59 to 838:59:59">TIME</option>
									      <option title="A year in four-digit (4, default) or two-digit (2) format, the allowable values are 70 (1970) to 69 (2069) or 1901 to 2155 and 0000">YEAR</option>
									   </optgroup>
									   <optgroup label="String">
									      <option title="A fixed-length (0-255, default 1) string that is always right-padded with spaces to the specified length when stored">CHAR</option>
									      <option title="A variable-length (0-65,535) string, the effective maximum length is subject to the maximum row size">VARCHAR</option>
									      <option disabled="disabled">-</option>
									      <option title="A TEXT column with a maximum length of 255 (2^8 - 1) characters, stored with a one-byte prefix indicating the length of the value in bytes">TINYTEXT</option>
									      <option title="A TEXT column with a maximum length of 65,535 (2^16 - 1) characters, stored with a two-byte prefix indicating the length of the value in bytes">TEXT</option>
									      <option title="A TEXT column with a maximum length of 16,777,215 (2^24 - 1) characters, stored with a three-byte prefix indicating the length of the value in bytes">MEDIUMTEXT</option>
									      <option title="A TEXT column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) characters, stored with a four-byte prefix indicating the length of the value in bytes">LONGTEXT</option>
									      <option disabled="disabled">-</option>
									      <option title="Similar to the CHAR type, but stores binary byte strings rather than non-binary character strings">BINARY</option>
									      <option title="Similar to the VARCHAR type, but stores binary byte strings rather than non-binary character strings">VARBINARY</option>
									      <option disabled="disabled">-</option>
									      <option title="A BLOB column with a maximum length of 255 (2^8 - 1) bytes, stored with a one-byte prefix indicating the length of the value">TINYBLOB</option>
									      <option title="A BLOB column with a maximum length of 16,777,215 (2^24 - 1) bytes, stored with a three-byte prefix indicating the length of the value">MEDIUMBLOB</option>
									      <option title="A BLOB column with a maximum length of 65,535 (2^16 - 1) bytes, stored with a two-byte prefix indicating the length of the value">BLOB</option>
									      <option title="A BLOB column with a maximum length of 4,294,967,295 or 4GiB (2^32 - 1) bytes, stored with a four-byte prefix indicating the length of the value">LONGBLOB</option>
									      <option disabled="disabled">-</option>
									      <option title="An enumeration, chosen from the list of up to 65,535 values or the special '' error value">ENUM</option>
									   </optgroup>
									   
									</select>
									
	                               	<span id="comapny_name_existance_error"></span>
	                               	<div class="error" id="error_field_label"><?php echo form_error('data_type'); ?></div>
								</div>
							</div>
						</div>
					</div>
                    <div class="span6 ">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput">(<?=lang('tbl_field_length')?>)</label>
							<div class="span6" style="margin-left: 0px;">
								<input type="text" name="field_length" id="field_length" class="col-xs-10 col-sm-6 pull-right" value="<?=set_value("field_length")?>">
                               	<span id="comapny_name_existance_error"></span>
                               	<div class="error" id="error_field_label"><?php echo form_error('field_label'); ?></div>
							</div>
						</div>
					</div>
                </div>
                <div class="form-row row-fluid">
                	<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('tbl_field_default_value')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">

								<input autocomplete="off" type="text" name="column_df_value" id="column_df_value" class="col-xs-10 col-sm-6 pull-right" placeholder="Column Default Value" value="<?=set_value("column_df_value")?>">
                               <span id="comapny_name_existance_error"></span>
                               <div class="error" id="error_field_label"><?php echo form_error('column_df_value'); ?></div>
								</div>
							 </div>
						</div>
					</div>
					
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('block_name')?></label>
						 	<div class="row-fluid">
								<div class="span6 select_style_margin-left">

								  	<select name="block_name" id="block_name" class="nostyle chosen-select">
										<!-- <option value="" >Select Block Name</option> -->
										<?php 
										if(!empty($blocks) && count($blocks)>0){
											foreach ($blocks as $key => $block) {?>
												<option value="<?php echo $block; ?>"><?php echo $block; ?></option>
										
										<?php }} else{?>
												<option value="default" >Default</option>
										<?php } ?>
									</select>
									<div class="error" id="error_block"><?php echo form_error('email'); ?></div>
							 	</div>
						   	</div>
						</div>
					</div>
                </div>
                <!-- Database table structure -->

                <div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('field_label')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">

								<input type="text" name="field_label" id="field_label" class="col-xs-10 col-sm-6 pull-right" value="<?=set_value("field_label")?>">
                               <span id="comapny_name_existance_error"></span>
                               <div class="error" id="error_field_label"><?php echo form_error('field_label'); ?></div>
								</div>
							 </div>
						</div>
					</div>
                    <div class="span6 ">
						<div class="row-fluid">
							<label class="form-label span12" for="focusedInput">(<?=lang('db_instruction_for_column_add_label')?>)<em>*</em></label>

						</div>
					</div>
                </div>
                

				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('field_name')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">

								<input type="text" name="field_name" id="field_name" class="col-xs-10 col-sm-6 pull-right" value="<?=set_value("field_name")?>">
                               <span id="comapny_name_existance_error"></span>
                               <div class="error" id="error_field_name"><?php echo form_error('field_name'); ?></div>
								</div>
							 </div>
						</div>
					</div>
                    <div class="span6 ">
						<div class="row-fluid">
							<label class="form-label span12" for="focusedInput">(<?=lang('db_instruction')?>)<em>*</em></label>

						</div>
					</div>
                </div>

				<div class="form-row row-fluid">
                 	<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('field_type')?><em>*</em></label>
						 	<div class="row-fluid">
								<div class="span6 select_style_margin-left">

								  	<select name="field_type" id="field_type" class="nostyle chosen-select" required="">
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
										<option value="date" >Date</option>
									</select>
									<div class="error" id="error_email"><?php echo form_error('email'); ?></div>
							 	</div>
						   	</div>
						</div>
					</div>

					<?php //pr($country);die;?>



					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('status')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
									<select name="status" class="nostyle chosen-select" id="status" >

										 <option value="1" >Active</option>
										<option value="2" >Inactive</option>
									</select>
								</div>
							 </div>
						</div>
					</div>
                </div>

				<div class="form-row row-fluid">
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('is_relation')?></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;" >

								<input type="checkbox" id="is_relation" name="is_relation" class="col-xs-10 col-sm-6 pull-right">

								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">
							&nbsp;
						</div>
					</div>
                </div>

                <!-- check relation from table -->
                <div class="form-row row-fluid is_relation_container" style="display: ;">
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('select_table')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								  	<select name="relation_table" id="relation_table" class="nostyle chosen-select">
										<option value="" >Select Table Name</option>
										
									</select>
									<div class="error" id="error_email"><?php echo form_error('email'); ?></div>
							 	</div>
						   	</div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('select_column')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left">
								  	<select name="relation_column" id="relation_column" class="nostyle chosen-select">
										<option value="" >Select Column Name</option>
										
									</select>
									<div class="error" id="error_email"><?php echo form_error('email'); ?></div>
							 	</div>
						   	</div>
						</div>
					</div>
                </div>
                <!-- check relation from table -->

				<div class="form-row row-fluid">
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('field_required')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;" >

								<input type="checkbox" id="field_required" name="field_required" class="col-xs-10 col-sm-6 pull-right">

								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('view_in_listing')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;">

								<input type="radio" id="radio5" name="view_on_left" value="1" checked>Yes
										<input type="radio" id="radio6" name="view_on_left" value="2" >No
								</div>
							 </div>
						</div>
					</div>
                </div>
                
				<div class="form-row row-fluid">

                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('field_unique')?></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;" >

								<input type="checkbox" id="field_unique" name="field_unique" class="col-xs-10 col-sm-6 pull-right">

								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid"></div>
					</div>

                </div>

				<div class="form-row row-fluid">

                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('field_default_value')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 "  >

								<input type="text" id="field_default_value" name="field_default_value" class="col-xs-10 col-sm-6 pull-right">

								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('view_in_mobile')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;">

								<input type="radio" id="radio5" name="view_in_mobile" value="1" checked>Yes
										<input type="radio" id="radio6" name="view_in_mobile" value="2" >No
								</div>
							 </div>
						</div>
					</div>
                </div>

				<div class="form-row row-fluid" id="checkbox_store" style="display:none;">

                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('field_by_default_checked')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 "  >

								<input type="checkbox" name="checkbox_default" id="checkbox_default" class="col-xs-10 col-sm-6 pull-right">

								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('store_val_checked')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;">

								<input type="text" name="checkbox_value" id="checkbox_value" class="col-xs-10 col-sm-6 pull-right">
								</div>
							 </div>
						</div>
					</div>
                </div>

				<div class="form-row row-fluid" id="choose_type" style="display:none;" >

                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('choose_select_type')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " data-repeater-item >

								<input type="radio" id="radio5" name="type" value="1" class="selectType" >Custom
								<input type="radio" id="radio5" name="type" value="2" class="selectType" >Link Tables


								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">

						</div>
					</div>
                </div>

				<div class="form-row row-fluid" id="value_diplay" style="display:;" >
					<div class="">
						<div class="span6">
							<div class="row-fluid">
								<label class="form-label span4" for="normal"><?=lang('value_display_val')?><em>*</em></label>
							  	<div class="row-fluid">
									<div class="span8" data-repeater-item >
										<input  type="text" name="display[]" class="span5 col-xs-4 col-sm-3 pull-right" style="float:left;"/>
										<input class=" span4 col-xs-4 col-sm-3 pull-right" type="text" name="value[]" />
										<a href="#" id="click_checkbox"><i class="fa fa-plus fa_icon_pos" aria-hidden="true"></i></a>

									</div>
							 	</div>
							</div>
						</div>

						<div class="span6">
							<div class="row-fluid">

							</div>

						</div>
					</div>
                </div>

				<div id="add_checkbox_more"></div>

				<div class="form-row row-fluid" id="linkTablelist"  style="display:none;">

                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('select_table')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 " data-repeater-item >
									<select name="table_name" id="table_name" class="nostyle">
										<option value="" >Select Field Type</option>
										<option value="country" >Country</option>
										<option value="state" >State</option>
										<option value="city" >City</option>
									</select>
								</div>
							 </div>
						</div>
					</div>

					<div class="span6">
						<div class="row-fluid">

						</div>

					</div>
                </div>

				<div class="form-row row-fluid" >
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions" style="text-align:center">
								<div class="span12 controls">

									<?php if ($action == 'view') {?>
									<button class="btn btn-info marginR10"
										href="<?=$base_url . '/edit/' . $result->id?>">
										<?=lang($action . '_button');?>
									</button>
									<?php } else {?>
									<button class="btn btn-info marginR10">
										<?=lang($action . '_button');?>
									</button>
									<?php }?>
								<!-- </a> -->

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
	$(".is_relation_container").hide();
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

		var str ='';
		str+='<div class="form-row row-fluid moreClumn" >';
		str+='<div >';
		str+='<div class="span6 ">';
		str+='<div class="row-fluid">';
		str+='<label class="form-label span4" for="normal"></label>';
		str+='<div class="row-fluid">';
		str+='<div class="span8 " data-repeater-item >';
		str+='<input  type="text" name="display[]" class="span5 col-xs-4 col-sm-3 pull-right" style="float:left;"/>';
		str+= '<input class=" span4 col-xs-4 col-sm-3 pull-right" type="text" name="value[]" />';
		str+= '<a href="#" class="removeColumnDiv" ><i class="fa fa-minus fa_icon_pos_minus" aria-hidden="true"></i></a>';
		str+='</div>';
		str+='</div>';
		str+='</div>';
		str+='</div>';
		str+='</div>';
		str+='</div>';

		$("#add_checkbox_more").append(str);
	});

	// remove column

	$("body").on("click",".removeColumnDiv",function(event){
		event.preventDefault();
		// console.log($(this).find('span6').parent());
		//$(this).parents().remove();
		 $(this).parentsUntil("div.moreClumn").remove();
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

$("#is_relation").change(function(){

	var is_checked = $(this).attr('checked');
	alert(is_checked);
	var token_value=$( "input[name='"+token_name+"']" ).val();
	if(is_checked=='checked')
	{
		$(".is_relation_container").show();
		$.ajax({
			url:'<?php echo base_url(); ?>form_module/get_table_list',
			type:"POST",
			dataType:'json',
			data: token_name+"="+token_value,
			success:function(result)
			{
				if(result.status==1)
				{
					
					$("#relation_table").html(result.data).trigger('chosen:updated');
				}
				else
				{
					// alert(data.message);
				}
			},
			error:function()
			{
				alert("Network error");
			}
		});
	}
	else
	{
		$(".is_relation_container").hide();
		$("#relation_table").html("<option value=''>Select Table Name</option>").trigger('chosen:updated');
		$("#relation_column").html("<option value=''>Select Column Name</option>").trigger('chosen:updated');
	}
});

$("#relation_table").change(function(){

	var is_checked = $("#is_relation").attr('checked');
	// alert(is_checked);
	var table_name = $("#relation_table").val();
	var token_value=$( "input[name='"+token_name+"']" ).val();
	if(is_checked=='checked' && table_name!='')
	{
		$.ajax({
			url:'<?php echo base_url(); ?>form_module/get_column_list',
			type:"POST",
			dataType:'json',
			data: token_name+"="+token_value+'&table_name='+table_name,
			success:function(result)
			{
				if(result.status==1)
				{
					$("#relation_column").html(result.data).trigger('chosen:updated');
				}
				else
				{
					// alert(data.message);
				}
			},
			error:function()
			{
				alert("Network error");
			}
		});
	}
	else
	{	
		$("#relation_column").html("<option value=''>Select Column Name</option>").trigger('chosen:updated');
	}
});

</script>
