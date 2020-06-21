<script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script>
<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />

<style type="text/css">

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
								  		// pr($result);die;
								  		foreach ($result as $module_key => $module) {?>
							  				<li class="dd-item" data-id="<?php echo $module->id ?>">
							  					<div class="dd-handle"><?php echo $module->module_name ?></div>
							  					<?php if($module->module_type==2){ ?>
							  					<span data-toggle="modal" data-target="#edit_module" onclick="return edit_module('<?= $module->id;?>','<?= $module->module_name;?>','<?= $module->module_controller;?>','<?= $module->parent_id;?>')" class="edit-btn"><i class="fa fa-edit"></i></span>
							  					<span onclick="return remove_module('<?= $module->id;?>')" class="delete-btn"><i class="icon-trash"></i></span>
							  					<?php } ?>
							  					<?php 
							  					if(isset($module->child_list) && !empty($module->child_list) && count($module->child_list)>0)
							  					{?>
							  						<ol class="dd-list">
								                        <?php 
								                        foreach ($module->child_list as $child_key => $child) {?>
											  				<li class="dd-item" data-id="<?php echo $child->id ?>">
											  					<div class="dd-handle"><?php echo $child->module_name ?></div>
											  					<?php if($child->module_type==2){ ?>
												  					<span data-toggle="modal" data-target="#edit_module" onclick="return edit_module('<?= $module->id;?>','<?= $module->module_name;?>','<?= $module->module_controller;?>','<?= $child->parent_id;?>')" class="edit-btn"><i class="fa fa-edit"></i></span>
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
							<button class="btn btn-info marginR10" id="save_changes">Save changes</button>
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
	<form  id="form-horizontal1" method="POST" action="<?=SITE_PATH?>form_module/module_list">
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
							<label class="span3"><h4 class="black">Any Parent</h4></label>
							<select name="parent_id" class="span5 nostyle" id="parent_id" >
								<option value='0'>No Parent</option>
								<?php 
						  		foreach ($result as $module_key => $module) {
						  			?>
					  					<option value="<?php echo $module->id ?>"><?php echo $module->module_name ?></option>
					  			<?php } ?>
							</select>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span3"><h4>Module Name</h4></label>
							<input type="text" name="module_name" class="span5" id="module_name" required="">
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span3"><h4>Controller Name</h4></label>
							<input type="text" name="module_controller" class="span5" id="module_controller" required="">
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
	<form  id="form-horizontal2" method="POST" action="<?=SITE_PATH?>form_module/module_list">
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
							<label class="span3"><h4 class="black">Any Parent</h4></label>
							<select name="parent_id" class="span5 nostyle" id="edit_parent_id" >
								<option value='0'>No Parent</option>
								<?php 
						  		foreach ($result as $module_key => $module) {
						  			?>
					  					<option value="<?php echo $module->id ?>"><?php echo $module->module_name ?></option>
					  			<?php } ?>
							</select>
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span3"><h4>Module Name</h4></label>
							<input type="hidden" name="module_id" id="edit_module_id" value="">
							<input type="text" name="module_name" class="span5" id="edit_module_name" required="">
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span3"><h4>Controller Name</h4></label>
							<input type="text" name="module_controller" class="span5" id="edit_module_controller" required="">
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/nestable/jquery.nestable.js"></script>
<script>

$(document).ready(function()
{

    var updateOutput = function(e)
    {
        var list   = e.length ? e : $(e.target);
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
    $('#nestable').nestable({
        group: 1
    });
    //.on('change', updateOutput);

    // output initial serialised data
    // updateOutput($('#nestable').data('output', $('#nestable-output')));
    

    $("#save_changes").click(function()
    {
    	var dataString = updateOutput($('#nestable').data('output', $('#nestable-output')));
    	// console.log(dataString);
    	// return false
    	if(dataString!=undefined && dataString!=null)
    	{
	    	$.ajax({
	        	url:'<?php echo base_url(); ?>form_module/reorder_module/',
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
						$("#block-name-msg").text(res.message);
					}
				},
				error:function(res)
				{
					alert("Network error");
				}
			});
    	}
    })

    $('#nestable-menu').on('click', function(e)
    {
        var target = $(e.target),
            action = target.data('action');
        if (action === 'expand-all') {
            $('.dd').nestable('expandAll');
        }
        if (action === 'collapse-all') {
            $('.dd').nestable('collapseAll');
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
			$.ajax({
				url:'<?php echo base_url(); ?>form_module/remove_module/',
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
						$("#remove_module_msg").text(res.message);
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
			$("#remove_module_msg").text("Module ID missing");
		}
	}
	else
	{
		return false;
	}
}

function edit_module(module_id,module_name,module_controller,parent_id)
{
	if(module_id!='' && module_id!=undefined && module_id!=null)
	{
		$("#edit_module_id").val(module_id);
		$("#edit_module_name").val(module_name);
		$("#edit_module_controller").val(module_controller);
		$("#edit_parent_id").val(parent_id);
	}
}

</script>