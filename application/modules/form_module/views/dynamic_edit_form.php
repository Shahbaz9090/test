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
						<h3><?=lang('add_form_module')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('name')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" name="form_name" id="form_name" class="col-xs-10 col-sm-6 pull-right" value="<?php echo $result->form_name ?>" >
                               <span id="comapny_name_existance_error"></span>
                               <div class="error" id="error_form_name"><?php echo form_error('form_name');?></div>
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
							<label class="form-label span4" for="focusedInput"><?=lang('form_label')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 ">
								
								<input type="text" name="form_label" id="form_label" class="col-xs-10 col-sm-6 pull-right" value="<?php echo $result->form_label ?>">
                              
                               <div class="error" id="error_form_label"><?php echo form_error('form_label');?></div>
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
							<label class="form-label span4" for="focusedInput"><?=lang('email_notify')?></label>
							 <div class="row-fluid">
								<div class="span6 ">  
								  
								  <input  type="text" name="email" value="<?php echo $result->email; ?>"  class="col-xs-10 col-sm-6 pull-right"  id="email">
														<div class="error" id="error_email"><?php echo form_error('email');?></div>
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
									
									 <option value="1" <?php if($result->status == 1){ echo "selected";} ?> >Active</option>
															<option value="2" <?php if($result->status == 2){ echo "selected";} ?> >Inactive</option>
																	</select>
								</div>
							 </div>
						</div>
						
						
					</div>	





					
                </div>
				

				<div class="form-row row-fluid">
					
                    <div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('view_in_left_menu')?><em>*</em></label>
							  <div class="row-fluid">
								<div class="span6 select_style_margin-left" style="margin-top:5px;">
								
								<input type="radio" id="radio5" name="view_on_left" <?php if($result->view_on_left == 1){ echo "checked";} ?> value="1" >Yes
										<input type="radio" id="radio6" name="view_on_left" <?php if($result->view_on_left == 2){ echo "checked";} ?> value="2" >No
								</div>
							 </div>
						</div>
					</div>
					
					
					
					
                </div>
				
				
				
				
				
			


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


	
	
$("#form_name").on("keydown", function (e) {
	 return e.which !== 32;
});


$("#support_form").validate({
	rules:{
			form_name:{
				required: true,
				alphanumeric: true
			},
			form_label:{
				required: true
			},
			status:{
				required: true
			},
		},
		message:{
			email:{
				email:'Please Enter Valid Email',
			}
			
		}
});


</script>
