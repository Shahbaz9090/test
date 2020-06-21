<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_admin/plugins/sumoselect/sumoselect.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_admin/plugins/summernote/summernote.css">
<script src="<?=base_url()?>assets_admin/plugins/summernote/summernote.min.js"></script>
<script src="<?=base_url()?>assets_admin/js/plugins/bootstrap-datepicker.min.js"></script>
<script src="<?=base_url()?>assets_admin/plugins/sumoselect/jquery.sumoselect.min.js"></script>

<style>
.radio-inline .radio{padding-top:0px !important;}
.form-actions {
    text-align: left;
    margin-bottom: 20px;
    background-color: #ecf3f7;
    border-top: 1px solid #e5e5e5;
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
.select-all
{
	height: 30px !important;
}
.select-all label
{
	width: 100%;
    display: block;
    line-height: 11px;
}
</style>
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
    		          	<form class="form-horizontal" method="post" action="<?=base_url($controller.'/add_column/'.$form_id)?>" enctype="multipart/form-data">
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Data Type <em>*</em></label>
    				                  	<div class="elem-group">
    										<select class="form-control form-control-sm " required name="data_type" id="data_type">
    											<option value="">Selct data type</option>
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
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<div class="form-group">
    				                  	<label class="control-label">(Length/Values) <em>*</em></label>
    					                <div class="elem-group">
    										<input autocomplete="off" type="text" name="field_length" id="field_length" class="form-control form-control-sm" value="<?=set_value("field_length")?>">
    		                               	<span id="comapny_name_existance_error"></span>
    		                               	<div class="error" id="error_field_label"><?php echo form_error('field_label'); ?></div>
    									</div>
    								</div>
    								<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Default Value <em>*</em></label>
    				                  	<div class="elem-group">
    										<input autocomplete="off" type="text" name="column_df_value" id="column_df_value" class="form-control form-control-sm" placeholder="Column Default Value" value="<?=set_value("column_df_value")?>">
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('column_df_value') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<div class="form-group">
    				                  	<label class="control-label">Block Name <em>*</em></label>
    					                <div class="elem-group">
    										<select name="block_name" id="block_name" class="form-control form-control-sm ">
    										<?php 
    										if(!empty($blocks) && count($blocks)>0){
    											foreach ($blocks as $key => $block) {?>
    												<option value="<?php echo $block; ?>"><?php echo $block; ?></option>
    										
    										<?php }} else{?>
    												<option value="default" >Default</option>
    										<?php } ?>
    									</select>
    									</div>
    								</div>
    								<div class="text-danger message--error"><?php echo form_error('block_name') ?></div>
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Field Label <em>*</em></label>
    				                  	<div class="elem-group">
    										<input autocomplete="off" required type="text" name="field_label" id="field_label" class="form-control form-control-sm" value="<?=set_value("field_label")?>">
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('field_label') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<p>(The name of the field as it will displayto the user)*</p>
    								
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Field Name <em>*</em></label>
    				                  	<div class="elem-group">
    										<input oninput="this.value=this.value.replace(/[^a-z0-9_]/,'')" autocomplete="off" required type="text" name="field_name" id="field_name" class="form-control form-control-sm" value="<?=set_value("field_name")?>">
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<p>(The database meta value for the table name.it must be unique and contain no space ( underscore are ok))*</p>
    								<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Field Type <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="field_type" id="field_type" class="form-control form-control-sm " required>
    											<option value="" >Select Field Type</option>
    											<option value="text" >text</option>
    											<option value="email" >email</option>
    											<option value="textarea" >textarea</option>
    											<option value="texteditor" >texteditor</option>
    											<option value="checkbox" >checkbox</option>
    											<option value="multiple_checkbox" >multiple checkbox</option>
    											<option value="select" >select( dropdown)</option>
    											<option value="multiple_select" >multiple select</option>
    											<option value="radio" >radio group</option>
    											<option value="password" >password</option>
    											<option value="image" >image</option>
    											<option value="file" >file</option>
    											<option value="multiplefile" >multiplefile</option>
    											<option value="url" >url</option>
    											<option value="hidden" >hidden</option>
    											<option value="date" >Date</option>
    											<option value="time" >Time</option>
    											<option value="number" >Number</option>
    										</select>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<div class="form-group">
    				                  	<label class="control-label">Status <em>*</em></label>
    					                <div class="elem-group">
    										<select name="status" class="form-control form-control-sm  " id="status" >
    										 	<option value="1" >Active</option>
    											<option value="2" >Inactive</option>
    										</select>
    									</div>
    								</div>
    								<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    			              	</div>
    		                </div>
    		                <!-- enable extension -->
    		                <div class="row is_extension_enable" id="is_extension_enable" style="display: none;">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Select Extension</label>
    				                  	<div class="elem-group">
    										<select multiple="" name="allowed_extension[]" id="allowed_extension" class="form-control form-control-sm multiSelect">
    											
    											
    										</select>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('allowed_extension') ?></div>
    				            </div>
    			                <div class="col-md-6">&nbsp;</div>
    		                </div>
    		                <!-- enable extension -->

    		                <!-- date restriction -->
    		                <!-- <div class="row is_date_restriction" id="is_date_restriction" style="display: none;">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Select Extension <em>*</em></label>
    				                  	<div class="elem-group">
    										<select multiple="" name="allowed_extension[]" id="allowed_extension" class="form-control form-control-sm multiSelect">
    											<option value="all" >ALL</option>
    											
    										</select>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('allowed_extension') ?></div>
    				            </div>
    			                <div class="col-md-6">&nbsp;</div>
    		                </div> -->
    		                <!-- date restriction -->
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Readonly </label>
    				                  	<div class="elem-group">
    				                  		<div class="animated-checkbox">
    							              	<label>
    							                	<input type="checkbox" id="is_readonly" name="is_readonly" class="form-control form-control-sm checkbox-align">
    							                	<span class="label-text"></span>
    							              	</label>
    							            </div>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('is_readonly') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	&nbsp;
    								
    			              	</div>
    		                </div>

    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Relation </label>
    				                  	<div class="elem-group">
    				                  		<div class="animated-checkbox">
    							              	<label>
    							                	<input type="checkbox" id="is_relation" name="is_relation" class="form-control form-control-sm checkbox-align">
    							                	<span class="label-text"></span>
    							              	</label>
    							            </div>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('is_relation') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	&nbsp;
    								
    			              	</div>
    		                </div>
    		                
    		                <div class="row is_relation_container" style="display: none;">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Select Table <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="relation_table" id="relation_table" class="form-control form-control-sm  1">
    											<option value="" >Select Table Name</option>
    											
    										</select>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<div class="form-group">
    				                  	<label class="control-label">Select Column <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="relation_column" id="relation_column" class="form-control form-control-sm  1">
    											<option value="" >Select Column Name</option>
    											
    										</select>
    				                  	</div>
    				                </div>
    								
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Required</label>
    				                  	<div class="elem-group">
    				                  		<div class="animated-checkbox">
    							              	<label>
    							                	<input type="checkbox" id="field_required" name="field_required" class="form-control form-control-sm checkbox-align">
    							                	<span class="label-text"></span>
    							              	</label>
    							            </div>
    										
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<div class="form-group">
    				                  	<label class="control-label">Show On List View <em>*</em></label>
    				                  	<div class="elem-group">
    										<div class="animated-radio-button">
    					                  		<label>
    								              	<input type="radio" name="view_on_left" value="1" checked>
    								                <span class="label-text">Yes</span>
    							              	</label>
    							              	<label>
    								               <input type="radio" name="view_on_left" value="2" >
    								                <span class="label-text">No</span>
    							              	</label>
    				                  		</div>
    				                  	</div>
    				                </div>
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Is Unique </label>
    				                  	<div class="elem-group">
    				                  		<div class="animated-checkbox">
    							              	<label>
    							                	<input type="checkbox" id="field_unique" name="field_unique" class="form-control form-control-sm checkbox-align">
    							                	<span class="label-text"></span>
    							              	</label>
    							            </div>
    										
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('form_name') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	&nbsp;
    			              	</div>
    		                </div>
    		                
    		                <div class="row">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Default Value Set </label>
    				                  	<div class="elem-group">
    										<input autocomplete="off" type="text" id="field_default_value" name="field_default_value" class="form-control form-control-sm" value="<?php echo set_value('field_default_value') ?>">
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('field_default_value') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	<div class="form-group">
    				                  	<label class="control-label">View On Mobile <em>*</em></label>
    				                  	<div class="elem-group">
    										<div class="animated-radio-button">
    					                  		<label>
    								                <input type="radio" name="view_in_mobile" value="1" checked>
    								                <span class="label-text">Yes</span>
    							              	</label>
    							              	<label>
    								               <input type="radio" name="view_in_mobile" value="2" >
    								                <span class="label-text">No</span>
    							              	</label>
    				                  		</div>
    				                  	</div>
    				                </div>
    				                <div class="text-danger message--error"><?php echo form_error('view_in_mobile') ?></div>
    			              	</div>
    		                </div>

    		                <div class="row choose_select_type" id="choose_type" style="display: none;">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Choose Select Type <em>*</em></label>
    				                  	<div class="elem-group">
    										<div class="animated-radio-button">
    					                  		<label>
    								                <input type="radio" name="type" value="1" class="selectType" >
    								                <span class="label-text">Custom</span>
    							              	</label>
    							              	<label>
    								               <input type="radio" name="type" value="2" class="selectType link_table" >
    								                <span class="label-text">Link Tables</span>
    							              	</label>
    							              	<label>
    								               <input type="radio" name="type" value="3" class="selectType link_dependent" >
    								                <span class="label-text">Dependent</span>
    							              	</label>
    				                  		</div>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('field_default_value') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	&nbsp;
    			              	</div>
    		                </div>

    		                <div class="row value_diplay" id="value_diplay" style="display: none;">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Value(Display|value) <em>*</em></label>
    				                  	<div class="elem-group">
    										<input autocomplete="off" style="display: inline-block;" type="text" name="display[]" class="form-control col-sm-5"/>&nbsp;&nbsp;&nbsp;
    										<input autocomplete="off" style="display: inline-block;" class="form-control col-sm-5" type="text" name="value[]" />
    										&nbsp;&nbsp;
    										&nbsp;&nbsp;

    										<a href="javascript:void(0)" id="click_checkbox"><i class="fa fa-plus" aria-hidden="true"></i></a>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('field_default_value') ?></div>
    				            </div>
    			                <div class="col-md-6">
    			                	&nbsp;
    			              	</div>
    		                </div>
    		                <div id="add_checkbox_more"></div>
    		                
    		                <div class="row select_db_table_container" id="linkTablelist" style="display: none;">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Select Table <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="select_db_table" id="select_db_table" class="form-control form-control-sm  1">
    											<option value="" >Select Table Name</option>
    											
    										</select>
    				                  	</div>
    				                </div>
    			                  	<div class="text-danger message--error"><?php echo form_error('select_db_table') ?></div>
    				            </div>
    			                <div class="col-md-6">
    				                <div class="form-group">
    				                  	<label class="control-label">Select Column For Value <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="select_db_column_value" id="select_db_column_value" class="form-control form-control-sm  1">
    											<option value="" >Select Column Name</option>
    											
    										</select>
    				                  	</div>
    				                  	<div class="text-danger message--error"><?php echo form_error('select_db_column') ?></div>
    				                </div>
    				                <div class="form-group">
    				                  	<label class="control-label">Select Column For Label <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="select_db_column_label" id="select_db_column_label" class="form-control form-control-sm  1">
    											<option value="" >Select Column Name</option>
    											
    										</select>
    				                  	</div>
    				                  	<div class="text-danger message--error"><?php echo form_error('select_db_column') ?></div>
    				                </div>
    			              	</div>
    		                </div>

    		                <div class="row dependent_container" id="dependent_detail" style="display:none">
    		                	<div class="col-md-6">
    		                		<div class="form-group">
    				                  	<label class="control-label">Select Table <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="dependent_table" id="dependent_table" class="form-control form-control-sm  1">
    											<option value="" >Select Table Name</option>
    											
    										</select>
    				                  	</div>
    			                  		<div class="text-danger message--error"><?php echo form_error('dependent_table') ?></div>
    				                </div>
    				                <div class="form-group">
    				                  	<label class="control-label" title="This is the field which is use for change event to reflect this field value.">Select Event Field <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="dependent_field" id="dependent_field" class="form-control form-control-sm  1">
    											<option value="" >Select Field Name</option>
    											
    										</select>
    				                  	</div>
    			                  		<div class="text-danger message--error"><?php echo form_error('dependent_field') ?></div>
    				                </div>
    				                
    				            </div>
    			                <div class="col-md-6">
    				                <div class="form-group">
    				                  	<label class="control-label">Select Column For Label <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="dependent_column_label" id="dependent_column_label" class="form-control form-control-sm  1">
    											<option value="" >Select Column Name</option>
    											
    										</select>
    				                  	</div>
    				                  	<div class="text-danger message--error"><?php echo form_error('dependent_column_label') ?></div>
    				                </div>
    				                <div class="form-group">
    				                  	<label class="control-label">Select Column For Value <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="dependent_column_value" id="dependent_column_value" class="form-control form-control-sm  1">
    											<option value="" >Select Column Name</option>
    											
    										</select>
    				                  	</div>
    				                  	<div class="text-danger message--error"><?php echo form_error('dependent_column_value') ?></div>
    				                </div>
    				                <div class="form-group">
    				                  	<label class="control-label">Select Condition Column <em>*</em></label>
    				                  	<div class="elem-group">
    										<select name="dependent_condition_column" id="dependent_condition_column" class="form-control form-control-sm  1">
    											<option value="" >Select Column Name</option>
    											
    										</select>
    				                  	</div>
    				                  	<div class="text-danger message--error"><?php echo form_error('dependent_condition_column') ?></div>
    				                </div>
    			              	</div>
    		                </div>

    		                <div class="tile-footer text-center">
    		                  	<button class="btn btn-primary" type="submit" name=""><i class="fa fa-fw fa-lg fa-check-circle"></i>Save Changes</button>&nbsp;
    		                  	<a class="btn btn-warning" href="<?=current_url()?>"><i class="fa fa-fw fa-lg fa-undo"></i>Reset</a>&nbsp;
    		                  	<a href="javascript: history.go(-1)" class="btn btn-secondary" ><i class="fa fa-fw fa-lg fa-angle-left"></i>Go Back</a>
    		                </div>
    	              	</form>
    	            </div>
              	</div>
            </div>
        </div>
    </main>

<script>
$(document).ready(function(){

	var frm_name = "<?=$result->form_name?>";
	$('.multiSelect').SumoSelect({ selectAll: true, placeholder: 'Select Extension' });

	// add more option
	$("#click_checkbox").click(function(e){
		e.preventDefault();
		var str ='';
		str = '<div class="row value_diplay removeable-div"> <div class="col-md-6"> <div class="form-group"><label class="control-label">&nbsp;</label><div class="elem-group"> <input autocomplete="off" style="display: inline-block;" type="text" name="display[]" class="form-control col-sm-5"/>&nbsp;&nbsp;&nbsp;<input autocomplete="off" style="display: inline-block;" class="form-control col-sm-5" type="text" name="value[]" /> &nbsp;&nbsp; &nbsp;&nbsp;  <a href="javascript:void(0)" class="removeColumnDiv"><i class="fa fa-minus" aria-hidden="true"></i></a></div> </div> <div class="text-danger message--error"></div> </div> <div class="col-md-6"> &nbsp; </div> </div>';

		$("#add_checkbox_more").append(str);
	});

	// remove column
	$("body").on("click",".removeColumnDiv",function(event){
		event.preventDefault();
		$(this).parents(".removeable-div:first").remove();
	});

	// filed type select
	$(".selectType").click(function()
	{
	 	if($(this).val() == 1){
			$("#value_diplay").show();
			$("#linkTablelist").hide();
			$("#dependent_detail").hide();
		}
		else if($(this).val() == 2){
			$("#linkTablelist").show();
			$(".value_diplay").hide();
			$("#dependent_detail").hide();
			$.ajax({
				url:'<?php echo base_url(); ?>form_module/get_table_list',
				type:"POST",
				dataType:'json',
				data: token_name+"="+token_value,
				success:function(result)
				{
					if(result.status==1)
					{
						// $("#relation_table").html(result.data).trigger('chosen:updated');
						$("#select_db_table").html(result.data);
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
		else if($(this).val() == 3){
			$(".value_diplay").hide();
			$("#linkTablelist").hide();
			$("#dependent_detail").show();
			$.ajax({
				url:'<?php echo base_url(); ?>form_module/get_table_list',
				type:"POST",
				dataType:'json',
				data: token_name+"="+token_value,
				success:function(result)
				{
					if(result.status==1)
					{
						// $("#relation_table").html(result.data).trigger('chosen:updated');
						$("#dependent_table").html(result.data);
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

			$.ajax({
				url:'<?php echo base_url(); ?>form_module/get_column_list_by_frm',
				type:"POST",
				dataType:'json',
				data: token_name+"="+token_value+"&frm_name="+frm_name,
				success:function(result)
				{
					if(result.status==1)
					{
						$("#dependent_field").html(result.data);
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
	});

	$("#field_type").change(function(){

		if($(this).val() == 'checkbox' || $(this).val() == 'multiple_checkbox' || $(this).val() == 'radio')
		{
			$("#linkTablelist").hide();
			$("#value_diplay").show();
			$("#image_store").hide();
			$("#file_store").hide();
			$("#is_extension_enable").hide();
			$("#choose_type").hide();
			$("#dependent_detail").hide();
		}
		else if( $(this).val() == 'select' || $(this).val() == 'multiple_select'){
			$("#choose_type").show();
			$("#is_extension_enable").hide();
			$("#value_diplay").hide();
			$("#dependent_detail").show();
		}
		else if($(this).val() == 'image')
		{
			$("#linkTablelist").hide();
			$("#value_diplay").hide();
			$("#choose_type").hide();
			$('input[name="file_value"]').attr('disabled',false);
			$("#is_extension_enable").hide();
			$("#image_store").show();
			$("#dependent_detail").hide();
		}
		else if($(this).val() == 'file' || $(this).val() == 'multiplefile')
		{
			$("#is_extension_enable").show();
			$("#linkTablelist").hide();
			$("#value_diplay").hide();
			$('input[name="file_value"]').attr('disabled',false);
			$("#file_store").show();
			$("#dependent_detail").hide();
			$.ajax({
				url:'<?php echo base_url(); ?>form_module/get_extension_list',
				type:"POST",
				dataType:'json',
				data: token_name+"="+token_value,
				success:function(result)
				{
					if(result.status==1)
					{
						// $("#relation_table").html(result.data).trigger('chosen:updated');
						$("#allowed_extension").html(result.data);
						$('#allowed_extension')[0].sumo.reload();
					}
					else
					{
						alert(data.message);
					}
				},
				error:function()
				{
					alert("Network error");
				}
			});

		}
		else{
			$("#linkTablelist").hide();
			$("#is_extension_enable").hide();
			$("#value_diplay").hide();
			$("#choose_type").hide();
			$("#dependent_detail").hide();
		}
	});
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
	var is_checked = $(this).prop('checked');
	
	if(is_checked)
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
					// $("#relation_table").html(result.data).trigger('chosen:updated');
					$("#relation_table").html(result.data);
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
		// alert('unchecked');
		$(".is_relation_container").hide();
		$("#relation_table").html("<option value=''>Select Table Name</option>");
		$("#relation_column").html("<option value=''>Select Column Name</option>");
	}
});


$("#relation_table").change(function(){

	var is_checked = $("#is_relation").prop('checked');
	// alert(is_checked);
	var table_name = $("#relation_table").val();
	if(is_checked && table_name!='')
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
					// $("#relation_column").html(result.data).trigger('chosen:updated');
					$("#relation_column").html(result.data);
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

$("#select_db_table").change(function(){

	var is_checked = $(".link_table").prop('checked');
	var table_name = $("#select_db_table").val();
	if(is_checked && table_name!='')
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
					// $("#select_db_column_label").html(result.data).trigger('chosen:updated');
					$("#select_db_column_label").html(result.data);
					$("#select_db_column_value").html(result.data);
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
		$("#select_db_column_label").html("<option value=''>Select Column Name</option>");
	}
});

$("#dependent_table").change(function(){

	var is_checked = $(".link_dependent").prop('checked');
	var table_name = $("#dependent_table").val();
	if(is_checked && table_name!='')
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
					// $("#dependent_column_label").html(result.data).trigger('chosen:updated');
					$("#dependent_column_label").html(result.data);
					$("#dependent_column_value").html(result.data);
					$("#dependent_condition_column").html(result.data);
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
		$("#dependent_column_label").html("<option value=''>Select Column Name</option>");
		$("#dependent_column_value").html("<option value=''>Select Column Name</option>");
		$("#dependent_condition_column").html("<option value=''>Select Column Name</option>");
	}
});
</script>
