<link rel="stylesheet" type="text/css" href="<?=base_url()?>assets_admin/plugins/sortable/sortable-theme-bootstrap.min.css">
<script src="<?=base_url()?>assets_admin/plugins/sortable/sortable.min.js"></script>
<!-- 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/css/sortable-theme-bootstrap.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/sortable/0.8.0/js/sortable.min.js"></script>
 -->
<style type="text/css">
	.elements ul {
	    list-style: none;
	    margin: 0;
	    padding: 0;
	}
	.block-wise
	{
	    border: 1px solid #aaa;
	}
	.block
	{
		background: #81868a;
		margin: 5px 0 0 -15px;
		padding: 3px 5px;
		color: white;
		width: 100%;
	    opacity: 0.9 !important;
	}
	#move_columns_dialog li {
    	background: #D3DCE3;
	    border: 1px solid #aaa;
	    color: #000;
	    font-weight: bold;
	    margin: .4em;
	    padding: .2em;
	    -webkit-border-radius: 2px;
	    -moz-border-radius: 2px;
	    border-radius: 2px;
	    cursor: move;
	    user-select: none;
	}
	.no-bg-color
	{
		background: #fff !important;
		border:none !important;
	}
	.sort-me
	{
		/*border:solid 1px #999;*/
	}
 	.ui-state-highlight,.placeholder 
 	{ 
 		height: 1.5em; line-height: 1.2em;background-color: #fffa90 !important; 
 	}
 	.modelLG.fade.in {

	    width: 900px;
	    left: calc(50% - 450px);
	    top:10%;
	    margin: unset;
	}
	.block_rename_wrapper
	{
		position: relative;
	}
	.block_rename
	{
		position: absolute;
		width: 250px;
		height: inherit;
		left: 100px;
		top: 0;
		font-size: unset !important;
	    padding: 0 5px !important;
	    margin: 0px !important;
	    border-radius: 0 !important;
	}
	
</style>
    <main class="app-content">
      	<?php $this->load->view("includes/breadcrumb"); ?>
        <?= get_flashdata(); ?>
        <div class="box">
    		<div class="title">
    			<h4><i class="fa fa-th"></i> <?php echo $page_heading ?></h4>
    		</div>

        	<div class="tile-footer search-container">
	            <div class="row">
	                <div class="col-md-8">
	                    &nbsp;
	                </div>
	                <div class="col-md-4">
	                    <a href="<?=base_url($controller)?>" class="btn btn-secondary"><i class="fa fa-fw fa-lg fa-angle-left"></i>Go Back</a>&nbsp;
	                    <a data-toggle="modal" data-target="#move_column" class="btn btn-info text-right" href="javascript:void(0)"><i class="fa fa-fw fa-lg fa-retweet"></i>Set Position</a>&nbsp;
	                    <a class="btn btn-info text-right" href="<?=base_url($controller.'/add_column/'.$form_id)?>"><i class="fa fa-fw fa-lg fa-plus"></i>Add Column</a>&nbsp;
	                </div>
	            </div>
	        </div>
        </div>
        <!-- <div class="line"></div> -->
      
      <div class="row">
        <div class="col-md-12">
          <div class="tile">
            
            <div class="tile-body">
              <table class="table table-hover table-bordered" id="sampleTable">
                <thead class="table-head">
                  <tr>
                    <th>Sr.No.</th>
                    <th>Field Name</th>
                    <th>Required</th>
                    <th>Default Value Set</th>
                    <th>Show On List View</th>
                    <th>View On Mobile</th>
                    <th>Status</th>
                    <th class="text-center">Action</th>
                  </tr>
                  
                </thead>
                <tbody>
                   <?php
                   if(count($data_list)){
                    $i=1;
                    foreach ($data_list as $id => $row){?>
                  <tr>
                    <td><?=$i?>.</td>
                    <td><?=ucwords($row->label)?></td>
                    <td><?=isset($row->required) && !empty($row->required)?$row->required:'false' ?></td>
                    <td></td>
                    <td><?=$row->view_on_left?></td>
                    <td><?=$row->view_on_left?></td>
                    <td><?=$row->status?></td>
                    <!-- <td><a onclick="return confirm('Do you realy want to change status?')" class="label <?=$row->status?'label-success':'label-danger'?>" href="<?=base_url('form_module/status/')?><?=$id?>/<?=$row->status?>"><?=$row->status?'Active':'Inactive'?></a></td> -->
                    <td class="text-center">
                    	<!-- <a href="<?=base_url('form_module/view/')?><?=$id?>"><i class="app-menu__icon fa fa-eye"></i></a> -->
                      <a href="<?=base_url('form_module/edit_column/'.$form_id.'/'.$id)?>"><i class="app-menu__icon fa fa-edit"></i></a>
                    	<a onclick="return confirm('Do you realy want to delete <?=$row->label?>?\n It can`t be restore.')" href="<?=base_url('form_module/delete_column/'.$form_id.'/'.$id)?>"><i class="app-menu__icon fa fa-trash"></i></a>
                    </td>
                  </tr>
                  <?php $i++; }}
                   else {?>
                    <tr><td colspan="8" style="color: red;text-align: center;font-size: .9em;">No record exist</td></tr>
                    <?php }?>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
      </div>
    </main>
<!-- Extra -->

<div style="" class="modelLG modal fade" id="move_column" tabindex="-1" role="dialog" aria-labelledby="myModalLabel11" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  	<div class="modal-header">
              	<h5 class="modal-title">Move Columns</h5>
              	<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
		  	<div class="modal-body">
				<div id="move_columns_dialog">
					<div class="row-fluid">
					  	<div class="span12">
					  		<p>Move the columns by dragging them up and down. <a href="javascript:void(0)"  data-toggle="modal" data-target="#add_block" class="add_block_model label label-success"><i class="fa fa-plus"></i> Add Block</a> <a href="javascript:void(0)" data-toggle="modal" data-target="#sort_block" class="sort_block_model open-model label label-success"><i class="fa fa-random"></i> Sort Block</a></p>
					  	</div>
				  	</div>
					<div class="row-fluid">
					  	<div class="">
				  			<div class="block-wise">
						  		<?php 
						  		if(count($move_columns) && !empty($move_columns)){
						  		foreach ($move_columns as $column_key => $column) {?>
				  					<ul id="sortable_<?=$column_key?>" class="sort-me elements move-column droptrue" data-block="<?=$column->block?>">
			  							<p class="block ui-state-disabled" title="Can not be sort or drag"><?php echo $column->block ?></p>
							  			<?php 
							  			if($column->elements>0){
							  			foreach ($column->elements as $elem_key => $elem) {
							  				?>
							  				<li class="ui-state-default" id='<?= json_encode($elem);?>'><?php echo $elem->label; ?></li>
							  			<?php }}?>
							  		</ul>
					  			<?php }}?>
				  			</div>
					  	</div>
				  	</div>       
			  	</div>       
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="moveColumnBtn">Save changes</button>
		        <button type="button" class="btn btn-secondary move_column_close_btn" data-dismiss="modal">Close</button>
	      	</div>
		</div>
	</div>
</div>

<div class="modelLG modal fade" id="sort_block" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  	
		  	<div class="modal-header">
              	<h5 class="modal-title">Move Blocks</h5>
              	<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
		  	<div class="modal-body">
				<div id="move_columns_dialog">
					<div class="row-fluid">
					  	<div class="span12">
					  		<p>Move the Block by dragging them up and down. <small style="color: red;" class="text-danger remove_block_msg"></small>
					  		</p>
					  	</div>
				  	</div>
					<div class="row-fluid">
					  	<div class="">
				  			<div class="block-wise">
			  					<ul class="sort-me elements move-block droptrue" data-block="<?=$column->block?>">
						  		<?php 
						  		if(count($move_columns) && !empty($move_columns)){
					  			foreach ($move_columns as $column_key => $column) {?>
					  				<li class="ui-state-default block_rename_wrapper" id='<?= $column_key;?>'><?php echo $column->block; ?> 
					  				<input oninput="this.value=this.value.replace(/[^0-9a-zA-Z_ ]/,'')" style="border-radius: 0 !important;display: none;" class="block_rename" type="text" name="block_name" value="<?=$column->block?>" data-oldName="<?=$column->block?>" data-indx="<?=$column_key?>">

					  				<?php if(count($move_columns)>1){ ?>
						  				<span onclick="return remove_block('<?= $column_key;?>')" style="color: red;text-align: right;cursor: pointer !important;float: right;margin-right: 5px;"><i class="fa fa-trash-o"></i></span>
					  				<?php } ?> 
					  					<span class="open_rename_input" style="color: green;text-align: right;cursor: pointer !important;float: right;margin-right: 15px;"><i class="fa fa-edit"></i></span>
						  			</li>
				  				<?php }}?>
						  		</ul>
				  			</div>
					  	</div>
				  	</div>       
			  	</div>       
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="moveBlockBtn">Save changes</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
		</div>
	</div>
</div>

<!-- Add block -->
<div class="modal fade" id="add_block" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  	
		  	<div class="modal-header">
              	<h5 class="modal-title">Add New Block</h5>
              	<button class="close" type="button" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
            </div>
		  	<div class="modal-body">
				<div class="row-fluid">
				  	<!-- <form> -->
		          	<div class="form-group" style="text-align: center;">
			            <label for="block-name" class="col-form-label">Enter Block Name:</label>
			            <input oninput="this.value=this.value.replace(/[^0-9a-zA-Z_ ]/,'')" type="text" class="form-control" id="block-name">
			            <p><small style="color: red;" class="text-danger" id="block-name-msg"></small></p>
		          	</div>
			        <!-- </form> -->
			  	</div>
			</div>
			<div class="modal-footer">
		        <button type="button" class="btn btn-primary" id="save-block-btn">Save changes</button>
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
	      	</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	var frm_id	= "<?=isset($form_id) && !empty($form_id)?$form_id:null?>";
	
	function remove_block(block_index)
	{
		if(confirm("Are you sure to delete this block.\n All Filed of this block will be lost permanently"))
		{
			event.preventDefault();
			
			if(block_index>=0 && frm_id!=null && frm_id!=undefined)
			{
				$.ajax({
					url:baseurl+'form_module/remove_block/',
					type:"POST",
					dataType:'json',
					data: "block_index="+block_index+'&frm_id='+frm_id,
					success:function(res)
					{
						// console.log(res.status);
						if(res.status==1)
						{
							window.location.reload();
						}
						else
						{
							$("#remove_block_msg").text(res.message);
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
				$("#remove_block_msg").text("Block ID missing");
			}
		}
		else
		{
			return false;
		}
	}
	
	$( function() {
		
		$(".open_rename_input").click(function(){
			var isShow = $(this).parent(".block_rename_wrapper").find("input[name='block_name']").css('display');
			if(isShow=='none')
			{
				$('.block_rename ').hide();
				$(this).parent(".block_rename_wrapper").find("input[name='block_name']").show();
				$(this).parent(".block_rename_wrapper").find("input[name='block_name']").focus();
				$('.remove_block_msg').text('Hit Enter to save changes');
			}
			else
			{
				$(this).parent(".block_rename_wrapper").find("input[name='block_name']").hide();
				$('.remove_block_msg').text('');
			}
		});

		$('.block_rename').on('keyup',function(e) {
			event.preventDefault();
		    var keycode = event.keyCode || event.which;
		    if(keycode == '13') {
		        // alert('You pressed a "enter" key in somewhere');
		        $('.block_rename ').hide();

		        var block_name 		= $(this).val();
		        var block_old_name 	= $(this).attr('data-oldName');
		        var block_index		= $(this).attr('data-indx');
		        if(block_name!=block_old_name)
		        {
		        	$.ajax({
						url:baseurl+'form_module/rename_block/',
						type:"POST",
						dataType:'json',
						data: "block_name="+block_name+"&block_index="+block_index+'&frm_id='+frm_id,
						success:function(res)
						{
							// console.log(res.status);
							if(res.status==1)
							{
								window.location.reload();
							}
							else
							{
								$("#block-name-msg").text(res.message);
							}
						},
						error:function()
						{
							alert("Network error");
						}
					});
		        }
		        // console.log(block_name);
		        // console.log(block_old_name);
		        // console.log(block_indx);
		    }
		    if(keycode == '27') {
		        $(".open_rename_input").trigger('click');
		    }
		    
		});

		$(".add_block_model, .sort_block_model").click(function(){
			$(".move_column_close_btn").trigger('click');
		});

		$("#save-block-btn").click(function(){
			event.preventDefault();
			var block_name = $("#block-name").val();

			if(block_name!='' && block_name!=null && block_name!=undefined && frm_id!='' && frm_id!=null && frm_id!=undefined )
			{
				$.ajax({
					url:baseurl+'form_module/add_block/',
					type:"POST",
					dataType:'json',
					data: "block_name="+block_name+'&frm_id='+frm_id,
					success:function(res)
					{
						// console.log(res.status);
						if(res.status==1)
						{
							window.location.reload();
						}
						else
						{
							$("#block-name-msg").text(res.message);
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
				$("#block-name-msg").text("Enter Block Name");
			}
		});

		/*Move column */
		var items = $( "ul.move-column" ).sortable({
			placeholder: "ui-state-highlight",
			items: "li:not(.ui-state-disabled)",
      		connectWith: "ul"
    	}).disableSelection();
		/*Move column */

		$(document).on('click','#moveColumnBtn',function(){

			var srt_data = {};
			$(".move-column").each(function(indx,value){
				var line_data 			= {};
				var b_name 				= $(this).attr("data-block");
				line_data.block_name 	= b_name;
				// line_data.block_data 	= $(this).find('li').attr('id')!=undefined ? $(this).find('li').attr('id') :'';
				line_data.block_data 	= JSON.stringify($(this).sortable('toArray'));
				srt_data[indx] 			= line_data;
			});

			var dataString  = JSON.stringify(srt_data);
			// console.log(dataString);
			// return false;

	        $.ajax({
	        	url:baseurl+'form_module/reorder_column/',
				type:"POST",
				cache: false,
				dataType:'json',
				data: 'frm_id='+frm_id+"&reorder_data="+dataString,
				success:function(res)
				{
					if(res.status==1)
					{
						window.location.reload();
					}
					else
					{
						$("#block-name-msg").text(res.message);
					}
				},
				error:function()
				{
					alert("Network error");
				}
			});
	    });

	    /*Move block */
		var items2 = $( "ul.move-block" ).sortable({
			placeholder: "ui-state-highlight",
			items2: "li:not(.ui-state-disabled)",
      		connectWith: "ul"
    	}).disableSelection();
		/*Move block */

		$(document).on('click','#moveBlockBtn',function(){
			
			var srt_data = items2.sortable('toArray');
			var dataString  = JSON.stringify(srt_data);

			// console.log(srt_data);
			// console.log(dataString);
			// return false;

	        $.ajax({
	        	url:baseurl+'form_module/reorder_block/',
				type:"POST",
				cache: false,
				dataType:'json',
				data: 'frm_id='+frm_id+"&reorder_block="+dataString,
				success:function(res)
				{
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
	    });
		
	});
</script>