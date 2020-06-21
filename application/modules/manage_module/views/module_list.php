<!-- <script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script> -->
<!-- <link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" /> -->
<!-- <link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/sumoselect/sumoselect.min.css')?>"> -->
<!-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> -->
<!-- <script type="text/javascript" src="<?=base_url('assets/plugins/sumoselect/jquery.sumoselect.min.js')?>"></script> -->

<style type="text/css">
.SumoSelect
{
    width: 100%;
}
.cf:after { visibility: hidden; display: block; font-size: 0; content: " "; clear: both; height: 0; }

.nestable-lists { display: block; clear: both; padding: 30px; border: 0;  border: 1px solid #ddd; }
/**
 * Nestable
 */

.dd { position: relative; display: block; margin: 0; padding: 0;  list-style: none; font-size: 13px; line-height: 20px;}

.dd-list { display: block; position: relative; margin: 0; padding: 0; list-style: none; }
.dd-list .dd-list { padding-left: 30px; }
.dd-collapsed .dd-list { display: none; }

.dd-item,
.dd-empty,
.dd-placeholder { display: block; position: relative; margin: 0; padding: 0; min-height: 20px; font-size: 13px; line-height: 20px; }

.dd-handle { user-select: none; display: block; height: 30px; margin: 5px 0; padding: 5px 10px; color: #333; text-decoration: none; border: 1px solid #ccc;
    background: #D3DCE3;
    cursor: move !important; 
    /*background: #fafafa;
    background: -webkit-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:    -moz-linear-gradient(top, #fafafa 0%, #eee 100%);
    background:         linear-gradient(top, #fafafa 0%, #eee 100%);*/
    -webkit-border-radius: 3px;
            border-radius: 3px;
    box-sizing: border-box; -moz-box-sizing: border-box;
}
.dd-handle:hover {background: #aec9de; }

.dd-item > button { display: block; position: relative; cursor: pointer; float: left; width: 25px; height: 20px; margin: 5px 0; padding: 0; text-indent: 100%; white-space: nowrap; overflow: hidden; border: 0; background: transparent; font-size: 12px; line-height: 1; text-align: center; font-weight: bold; }
.dd-item > button:before { content: '+'; display: block; position: absolute; width: 100%; text-align: center; text-indent: 0; }
.dd-item > button[data-action="collapse"]:before { content: '-'; }

.dd-placeholder,
.dd-empty { margin: 5px 0; padding: 0; min-height: 30px; background: #f2fbff; border: 1px dashed #b6bcbf; box-sizing: border-box; -moz-box-sizing: border-box; }
.dd-empty { border: 1px dashed #bbb; min-height: 100px; background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                      -webkit-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:    -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                         -moz-linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-image:         linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff),
                              linear-gradient(45deg, #fff 25%, transparent 25%, transparent 75%, #fff 75%, #fff);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel { position: absolute; pointer-events: none; z-index: 9999; }
.dd-dragel > .dd-item .dd-handle { margin-top: 0; }
.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
            box-shadow: 2px 4px 6px 0 rgba(0,0,0,.1);
}
.edit-btn
{
	position: absolute;
	top: 10px;
	
	right: 20px !important;
	color: green;
	text-align: right;
	cursor: pointer !important;
	float: right;
	margin-right: 15px;
}
.adjust-btn
{
	position: absolute;
	top: 10px;
	right: 40px !important;
	color: black;
	text-align: right;
	cursor: pointer !important;
	float: right;
	margin-right: 15px;
}
.delete-btn
{
	position: absolute;
	top: 10px;
	color: red;
	text-align: right;
	cursor: pointer !important;
	float: right;
	margin-right: 15px;
	right: 0;
}
</style>

<div class="row-fluid">
	<div class="span12">
	 	<?php echo get_flashdata();?>
       	<div class="box">
            <div class="title">
                <h4>
					<span id="list_by">Module List</span>
					<div class="btn-group right" data-toggle="buttons-radio" style="padding-right:75px;top:-5px;">
						<button data-toggle="modal" data-target="#add_new_module" class="btn btn-info marginR10" id="add_new_module_btn"><span class="cut-icon-plus-2 grid-list-icon"></span> Add New Module</button>
					</div>
                </h4>
				<a href="#" class="minimize">Minimize</a>
			</div> 

			<div class="content noPad" >
	            <div class="row-fluid">
					<div class="form-actions" style="text-align:center">								
						<div class="span12 controls">
							<button class="btn btn-info marginR10" id="save_changes">Save changes</button>
							<button onclick="window.location.reload()" class="btn btn-danger" type="reset" name="reset">Reset</button>
							<a href="javascript: history.go(-1)" class="btn btn-goback"><span class="icon16 typ-icon-back"></span>Go back</a>
						</div>
					</div>
				</div>

				<span id="ajax_replace">
				 	<div id="move_columns_dialog">
						<div class="row-fluid">
						  	<div class="cf nestable-lists">
					  			<div class="dd" id="nestable">
						  			<ol class="blocks sort-me dd-list">
								  		<?php 
								  		 //pr($result);die;
								  		foreach ($result as $module_key => $module) {?>

							  					<li class="dd-item" data-id="<?php echo $module->id ?>">
							  					<div class="dd-handle"><?php echo $module->module_title ?></div>
							  					<?php if($module->module_type==2){ ?>
												<?php if($module->status=='1'){ ?>	
												<span title="inactive" class="adjust-btn inactive" data-id="<?= $module->id;?>"><i class="fa fa-adjust"></i></span>
												<?php }else{ ?>
												<span title="active" class="adjust-btn active" data-id="<?= $module->id;?>"><i class="fa fa-adjust"></i></span>
												<?php } ?>
												<span data-toggle="modal" data-target="#edit_module" onclick="return edit_module('<?= $module->id;?>','<?= $module->module_title;?>','<?= $module->module_name;?>','<?= $module->module_controller;?>','<?= $module->module_icon;?>','<?= $module->parent_id;?>','<?= $module->action;?>','<?= $module->extra_method;?>','<?= $module->view_on_left;?>','<?= $module->action_type;?>',this)" data-custom-module='<?=$module->custom_action?>' class="edit-btn"><i class="fa fa-edit"></i></span>
							  					<span onclick="return remove_module('<?= $module->id;?>')" class="delete-btn"><i class="icon-trash"></i></span>
							  					<?php } ?>
							  					<?php 
							  					if(isset($module->child_list) && !empty($module->child_list) && count($module->child_list)>0)
							  					{?>
							  						<ol class="dd-list">
								                        <?php 
								                        foreach ($module->child_list as $child_key => $child) {?>
											  				<li class="dd-item" data-id="<?php echo $child->id ?>">
											  					<div class="dd-handle"><?php echo $child->module_title ?></div>
											  					<?php if($child->module_type==2){ ?>
												  					<?php if($child->status=='1'){ ?>	
																	<span title="inactive" class="adjust-btn inactive" data-id="<?= $child->id;?>"><i class="fa fa-adjust"></i></span>
																	<?php }else{ ?>
																	<span title="active" class="adjust-btn active" data-id="<?= $child->id;?>"><i class="fa fa-adjust"></i></span>
																	<?php } ?>
																	<span data-toggle="modal" data-target="#edit_module" onclick="return edit_module('<?= $child->id;?>','<?= $child->module_title;?>','<?= $child->module_name;?>','<?= $child->module_controller;?>','<?= $child->module_icon;?>','<?= $child->parent_id;?>','<?= $child->action;?>','<?= $child->extra_method;?>','<?= $child->view_on_left;?>','<?= $child->action_type;?>',this)" data-custom-module='<?=$child->custom_action?>' class="edit-btn"><i class="fa fa-edit"></i></span>
												  					<span onclick="return remove_module('<?= $child->id;?>')" class="delete-btn"><i class="icon-trash"></i></span>
												  					<?php } ?>
											  				</li>
								                         <?php } ?>
								                    </ol>
							  					<?php } ?>
							  				</li>
						  				<?php }?>
						  			</ol>
					  			</div>
						  	</div>
				  			<input type="hidden" id="nestable-output">
					  	</div>  
			  		</div>
				</span>
		  		<div class="row-fluid">
					<div class="form-actions" style="text-align:center">								
						<div class="span12 controls">
							<button class="btn btn-info marginR10" id="save_changes2">Save changes</button>
							<button onclick="window.location.reload()" class="btn btn-danger" type="reset" name="reset">Reset</button>
							<a href="javascript: history.go(-1)" class="btn btn-goback"><span class="icon16 typ-icon-back"></span>Go back</a>
						</div>
					</div>
				</div>
          	</div>
      	</div><!-- End .box -->
  	</div><!-- End .span12 -->
</div><!-- End .row-fluid -->

<!-- Modal for Multiple Removal -->
<div class="modal fade" id="add_new_module" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form  id="form-horizontal1" method="POST" action="<?=SITE_PATH?>manage_module/module_list">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Add New Module</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span12" id="responseDiv">	
							<p><small id="remove_module_msg"></small> </p>	
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span4"><h4 class="black">Any Parent<em>*</em></h4></label>
							<select name="parent_id" class="span8 nostyle" id="parent_id" >
								<option value='0'>No Parent</option>
								<?php 
						  		foreach ($result as $module_key => $module) {
						  			?>
					  					<option value="<?php echo $module->id ?>"><?php echo $module->module_title ?></option>
					  			<?php } ?>
							</select>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span4"><h4>Module Title<em>*</em></h4></label>
							<input type="text" name="module_title" class="span8" id="module_title" required="">
						</div>
					</div>
					<div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4>Module Name<em>*</em></h4></label>
                            <input oninput="this.value=this.value.replace(/[^a-z_]/,'')" type="text" name="module_name" class="span8" id="module_name" required="">
                        </div>
                    </div>
                    <div class="row-fluid">
						<div class="span12">
							<label class="span4"><h4>Controller Name<em>*</em></h4></label>
							<input oninput="this.value=this.value.replace(/[^a-z_#]/,'')" type="text" name="module_controller" class="span8" id="module_controller" required="">
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4>Icon<em>*</em></h4></label>
                            <input type="text" name="module_icon" class="span8" id="module_controller" required="">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4>Extra method</h4></label>
                            <input type="text" name="extra_method" class="span8" id="add_extra_method" >
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4 class="black">View On Left<em>*</em></h4></label>
                            <select required="" name="view_on_left" class="span8 nostyle" id="add_view_on_left">
                                <option value='1'>Show</option>
                                <option value='2'>Hide</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4 class="black">Action Type<em>*</em></h4> </label>
                            <select required="" name="action_type" class="span8 nostyle" id="add_action_type">
                                <option value='1'>Default</option>
                                <option value='2'>Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid add-default-action">
                        <div class="span12">
                            <label class="span4"><h4 class="black">Action<em>*</em></h4></label>
                            <div class="span8" style="margin-left: 0;">
                                <select multiple="" name="add_action[]" class="span8 nostyle" id="add_action" >
                                    <option value='103'>Add</option>
                                    <option value='102'>Edit</option>
                                    <option value='104'>Delete</option>
                                    <option value='101'>View</option>
                                    <option value='109'>List</option>
                                    <option value='105'>Export</option>
                                    <option value='106'>Import</option>
                                    <option value='107'>Download</option>
                                    <option value='108'>Print</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="add-custom-action" style="display: none;">
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Add</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[103]" class="span8" id="add_custom_action_add" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Edit</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[102]" class="span8" id="add_custom_action_edit" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Delete</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[104]" class="span8" id="add_custom_action_delete" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action View</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[101]" class="span8" id="add_custom_action_view" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action List</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[109]" class="span8" id="add_custom_action_list" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Export</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[105]" class="span8" id="add_custom_action_export" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Import</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[106]" class="span8" id="add_custom_action_import" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Download</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[107]" class="span8" id="add_custom_action_download" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Print</h4></label>
                                <input type="text"  oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[108]" class="span8" id="add_custom_action_print" >
                            </div>
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				   <button type="submit" class="btn btn-primary" name="add_new_module">Submit</button>
				   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->

<!-- Modal for Multiple Removal -->
<div class="modal fade" id="edit_module" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form  id="form-horizontal2" method="POST" action="<?=SITE_PATH?>manage_module/module_list">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">Edit Module</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span12" id="responseDiv">	
							<p><small id="remove_module_msg"></small> </p>	
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span4"><h4 class="black">Any Parent</h4></label>
							<select name="parent_id" class="span8 nostyle" id="edit_parent_id" >
								<option value='0'>No Parent</option>
								<?php 
						  		foreach ($result as $module_key => $module) {
						  			?>
					  					<option value="<?php echo $module->id ?>"><?php echo $module->module_title ?></option>
					  			<?php } ?>
							</select>
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4>Module Title<em>*</em></h4></label>
                            <input type="text" name="module_title" class="span8" id="edit_module_title" required="">
                        </div>
                    </div>
                    
					<div class="row-fluid">
						<div class="span12">
							<label class="span4"><h4>Module Name<em>*</em></h4></label>
							<input type="hidden" name="module_id" id="edit_module_id" value="">
							<input type="text" name="module_name" class="span8" id="edit_module_name" required="">
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span4"><h4>Controller Name<em>*</em></h4></label>
							<input oninput="this.value=this.value.replace(/[^a-z_#]/,'')" type="text" name="module_controller" class="span8" id="edit_module_controller" required="">
						</div>
					</div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4>Icon<em>*</em></h4></label>
                            <input type="text" name="module_icon" class="span8" id="edit_module_icon" required="">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4>Extra method</h4></label>
                            <input type="text" name="extra_method" class="span8" id="edit_extra_method">
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4 class="black">View On Left<em>*</em></h4></label>
                            <select required="" name="view_on_left" class="span8 nostyle" id="edit_view_on_left">
                                <option value='1'>Show</option>
                                <option value='2'>Hide</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="span12">
                            <label class="span4"><h4 class="black">Action Type<em>*</em></h4> </label>
                            <select required="" name="action_type" class="span8 nostyle" id="edit_action_type">
                                <option value='1'>Default</option>
                                <option value='2'>Custom</option>
                            </select>
                        </div>
                    </div>
                    <div class="row-fluid edit-default-action">
                        <div class="span12">
                            <label class="span4"><h4 class="black">Action</h4></label>
                            <div class="span8" style="margin-left: 0;">
                                <select multiple="" name="edit_action[]" class="span8 nostyle" id="edit_action" >
                                    <option value='103'>Add</option>
                                    <option value='102'>Edit</option>
                                    <option value='104'>Delete</option>
                                    <option value='101'>View</option>
                                    <option value='109'>List</option>
                                    <option value='105'>Export</option>
                                    <option value='106'>Import</option>
                                    <option value='107'>Download</option>
                                    <option value='108'>Print</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="edit-custom-action" style="display: none;">
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Add</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[103]" class="span8" id="edit_custom_action_add" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Edit</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[102]" class="span8" id="edit_custom_action_edit" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Delete</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[104]" class="span8" id="edit_custom_action_delete" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action View</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[101]" class="span8" id="edit_custom_action_view" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action List</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[109]" class="span8" id="edit_custom_action_list" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Export</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[105]" class="span8" id="edit_custom_action_export" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Import</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[106]" class="span8" id="edit_custom_action_import" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Download</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[107]" class="span8" id="edit_custom_action_download" >
                            </div>
                        </div>
                        <div class="row-fluid">
                            <div class="span12">
                                <label class="span4"><h4>C. Action Print</h4></label>
                                <input type="text" oninput="this.value=this.value.replace(/[^a-zA-Z0-9_]/,'')" name="custom_action[108]" class="span8" id="edit_custom_action_print" >
                            </div>
                        </div>
                    </div>
				</div>

				<div class="modal-footer">
					<input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
				   <button type="submit" class="btn btn-primary" name="edit_module">Submit</button>
				   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->

<script src="http://localhost/inch-erp/assets/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/nestable/jquery.nestable.js"></script>
<script>

jq(document).ready(function () {
    jq("#add_action").SumoSelect({selectAll:true});
    jq("#edit_action").SumoSelect({selectAll:true});

    jq("#add_action_type").change(function(){

        if(jq(this).val()==1)
        {
            jq(".add-default-action").show();
            jq(".add-custom-action").hide();
        }
        else
        {
            jq(".add-default-action").hide();
            jq(".add-custom-action").show();
        }
    });

    jq("#edit_action_type").change(function(){
        
        if(jq(this).val()==1)
        {
            jq(".edit-default-action").show();
            jq(".edit-custom-action").hide();
        }
        else
        {
            jq(".edit-default-action").hide();
            jq(".edit-custom-action").show();
        }
    });
});

var nst = $.noConflict();
nst(document).ready(function(){
    var updateOutput = function(e)
    {
        var list   = e.length ? e : nst(e.target);
        var output = list.data('output');
        // console.log(output);
        if (window.JSON) {
            output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
        } else {
            output.val('JSON browser support required for this demo.');
        }
        return JSON.stringify(list.nestable('serialize'));
    };

    // activate Nestable for list 1
    nst('#nestable').nestable({
        group: 1
    });
    //.on('change', updateOutput);

    // output initial serialised data
    // updateOutput(nst('#nestable').data('output', nst('#nestable-output')));
    

    nst("#save_changes, #save_changes2").click(function()
    {
    	var dataString = updateOutput(nst('#nestable').data('output', nst('#nestable-output')));
    	// console.log(dataString);
    	// return false
    	if(dataString!=undefined && dataString!=null)
    	{
	    	nst.ajax({
	        	url:'<?php echo base_url(); ?>manage_module/reorder_module/',
				type:"POST",
				cache: false,
				dataType:'json',
				data: token_name+"="+token_hash+"&reorder_module="+dataString,
				beforeSend:function(res)
				{
					beforeAjaxResponse();
				},
				success:function(res)
				{
					afterAjaxResponse();
					if(res.status==1)
					{
						window.location.reload();
					}
					else
					{
						nst("#block-name-msg").text(res.message);
					}
				},
				error:function(res)
				{
					afterAjaxResponse();
					alert("Network error");
				}
			});
    	}
    })

    nst('#nestable-menu').on('click', function(e)
    {
        var target = nst(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            nst('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            nst('.dd').nestable('collapseAll');
        }
    });

});

function remove_module(module_id)
{
	if(confirm("Are you sure to delete this Module."))
	{
		event.preventDefault();
		
		if(module_id>=0)
		{
			nst.ajax({
				url:'<?php echo base_url(); ?>manage_module/remove_module/',
				type:"POST",
				dataType:'json',
				data: token_name+"="+token_hash+"&module_id="+module_id,
				success:function(res)
				{
					// console.log(res.status);
					if(res.status==1)
					{
						window.location.reload();
					}
					else
					{
						nst("#remove_module_msg").text(res.message);
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
			nst("#remove_module_msg").text("Module ID missing");
		}
	}
	else
	{
		return false;
	}
}

function edit_module(module_id, module_title, module_name, module_controller, module_icon, parent_id, action,extra_method, view_on_left,action_type, this1)
{
    // var res = action.split(",").map(Number);
    // console.log(typeof());
    var res = action.split(",");
	if(module_id!='' && module_id!=undefined && module_id!=null)
	{
		nst("#edit_module_id").val(module_id);
		nst("#edit_module_title").val(module_title);
        nst("#edit_module_name").val(module_name);
		nst("#edit_module_controller").val(module_controller);
        nst("#edit_module_icon").val(module_icon);
		nst("#edit_parent_id").val(parent_id);
        nst("#edit_extra_method").val(extra_method);
        nst("#edit_view_on_left").val(view_on_left);
        nst("#edit_action_type").val(action_type);
        // nst("#edit_action_type").trigger('change');
        if(action_type==1)
        {
            jq(".edit-default-action").show();
            jq(".edit-custom-action").hide();
        }
        else
        {
            jq(".edit-default-action").hide();
            jq(".edit-custom-action").show();
        }
        var custom_action   = nst(this1).attr('data-custom-module');
        JSON.parse(custom_action, (key, value) => {
            $("input[name='custom_action["+key+"]']").val(value);
        });

        nst("select[name='edit_action[]'] option").each(function(i, option_value){
            if(res.indexOf(option_value.value)>=0){
                nst(this).attr('selected','selected');
            }
            nst("select[name='edit_action[]']")[0].sumo.reload();
        });
	}
}

</script>
<script>
	var base_url = '<?=$base_url?>';
	$('.inactive').click(function (event) { 
		
		var id = $(this).attr('data-id');
		var status = '2';
		if (confirm('Are you sure you want to inactive this?')) {
			$.ajax({
				data:(token_name+'='+token_hash+'&status='+status+'&id='+id),
				type: "POST",
				url: base_url +"/inactive",
				success: function (data) {
					alert("Module Status Inactive Successfully");
					location.reload();
				}
			});
		}
	});
	
	$('.active').click(function (event) { 
		var id = $(this).attr('data-id');
		var status = '1';
		if (confirm('Are you sure you want to active this?')) {
			$.ajax({
				data:(token_name+'='+token_hash+'&status='+status+'&id='+id),
				type: "POST",
				url: base_url +"/inactive",
				success: function (data) {
					alert("Module Status Active Successfully");
					location.reload();
				}
			});
		}
	});
</script>