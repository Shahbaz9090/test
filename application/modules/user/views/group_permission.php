<link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>css/bootstrap/permission.css" media="screen" />
<style>
.box .content {
    -moz-border-bottom-colors: none;
    -moz-border-left-colors: none;
    -moz-border-right-colors: none;
    -moz-border-top-colors: none;
    background-color: #fff;
    border-bottom-left-radius: 2px;
    border-bottom-right-radius: 2px;
    border-color: -moz-use-text-color #c4c4c4 #c4c4c4;
    border-image: none;
    border-right: 0 solid #c4c4c4;
    border-style: none solid solid;
    border-width: medium 0 0;
    padding: 0;
    position: relative;
}
.box.title{background-color: #01365e !important;}
.table th {
    background-color:#01365e !important;;
    border-top: 1px solid #dddddd;
    color: #fffff0;
    padding: 4px 8px;
    text-align: left;
    font-family: 'Open Sans',sans-serif; font-size:12px;
    
}
.table td {
    border-top: 1px solid #dddddd;
    color: #555;
    font-family: 'Open Sans',sans-serif;
    padding: 2px 5px; 
    text-align: left; font-size:12px;
}


.modal-footer {
  padding-top: 12px;
  padding-bottom: 14px;
  border-top-color: #e4e9ee;
  -webkit-box-shadow: none;
  box-shadow: none;
  background-color: #eff3f8;
}
body
{
    margin: 0;
}
</style>
<div class="row-fluid">
 	<div class="span12">         
   	<?php 
	if(isset($updated)){
		static_flash("success","Permission has been updated successfully.");
	}?>
	<div class="box">	
		<div class="title" style="position: fixed; z-index: 9999999; top: 0px;height: unset;padding-left: 0;width: 100%;">
            <h4 style="margin: 5px; padding: 5px;">
                <span>Group Permission Setting For -  <?=$group_data->name?></span>
                <!-- <button style="float:right" name="submit" type="reset" class="btn btn-danger">Reset</button> -->
                
            </h4>
            <table class="responsive table table-bordered" cellspacing="0" cellpadding="0" style="margin-bottom:0;">
                <thead>
                    <tr>
                        <th style="width: 279px;" rowspan="2">Title</th>
                        <th style="width: 30px;" rowspan="2">Add</th>
                        <th style="width: 30px;" colspan="2">View List</th>           
                        <th style="width:;" colspan="2">Edit</th>
                        <th style="width:;" colspan="2">Delete</th>
                        <th rowspan="2">Export</th>  
                        <th rowspan="2">Import</th> 
                        <th rowspan="2">Download</th> 
                        <th rowspan="2">Print</th>
                    </tr>
                    <tr>
                        <th>Own</th>
                        <th>All</th>
                        <th>Own</th>
                        <th>All</th>
                        <th>Own</th>
                        <th>All</th>
                    </tr>          
                </thead>
            </table>
		</div>

		<div class="content" style="margin-top: 86px">
		   	<?php echo form_open_multipart(current_url(),array('id'=>'site_form'));?>
            <button style="position: fixed; top: 4px; z-index: 9999999999999; right: 17px;" type="submit" class="btn btn-warning submit_btn">Submit</button>
		  	<table class="responsive table table-bordered" cellspacing="0" cellpadding="0">
			  	<!-- <thead>
                    <tr style="width: 100%">
                        <th rowspan="2">Title</th>
                        <th rowspan="2">Add</th>
                        <th colspan="2">View List</th>           
                        <th colspan="2">Edit</th>
                        <th colspan="2">Delete</th>
                        <th rowspan="2">Export</th>  
                        <th rowspan="2">Import</th> 
                        <th rowspan="2">Download</th> 
                        <th rowspan="2">Print</th>
                    </tr>
                    <tr style="width: 100%">
                        <th>Own</th>
                        <th>All</th>
                        <th>Own</th>
                        <th>All</th>
                        <th>Own</th>
                        <th>All</th>
                    </tr>          
                </thead> -->				  
				<?php 
				if(isset($methods) && !empty($methods)){
				foreach($methods as $k=>$method){

					$my_list	 	= [];
					$custom_action 	= [];
					$check_list 	= getAllpermission($method->controller);	
					if(isset($method->action) && !empty($method->action))
					{
	                    $check_list	= $method->action;
	                    $my_list	= explode(",", $check_list);
					}
					$index 			= $method->module_controller;
					if(isset($method->custom_action) && !empty($method->custom_action))
					{
						$custom_action2	= (array) json_decode($method->custom_action);
						$custom_action 	= array_combine(array_keys($custom_action2), array_values($custom_action2));
					}

					if($method->module_name != $method->module_controller)
					{
                        $index  = $method->module_name.'/'.$method->module_controller;
                    }
                    // pr($method);
		           	// $others=getOtherPermission($method->module_name);
                    //$actions = [103=>'Add',102=>'Edit',104=>'Delete',101=>'View',101=>'List Item',101=>'ajax_list_items',105=>'Export',211=>'Permission'];

                    if($method->action_type==1)
                    {?>
				       	
    				  	<tr>
    						<input type="hidden" name="name[]" value="<?=$index?>" />
    						<input type="hidden" name="<?=$index?>[controller]" value="<?=$method->module_controller?>" />
    						<input type="hidden" name="<?=$index?>[module]" value="<?=$method->module_name?>" />
    						<td style="width: 284px"><strong><?=$method->module_title?> (<?=$method->parent_name?>)</strong></td>
    						<td style="width: 35px;">
    							<?php
    								if(in_array(AT_ADD, $my_list)){
    							?>
    							<input type="checkbox" id="<?=str_replace("/","_",$index)?>_add" name="<?=$index?>[add]" value="<?=AT_ADD?>" <?php if(isset($permission_data[$index]['add'])){echo 'checked="true"';} ?>/>				
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td style="width: 30px">
    							<?php
    								if(in_array(AT_VIEW,$my_list)){
    							?>
    							<input type="checkbox" id="<?=str_replace("/","_",$index)?>_own_view" onclick="return uncheck('<?=str_replace("/","_",$index)?>','own_view','all_view')" name="<?=$index?>[own_view]" value="<?=AT_VIEW?>" <?php if(isset($permission_data[$index]['own_view'])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td style="width: 26px">
    							<?php
    								if(in_array("101",$my_list)){
    							?>
    							<input type="checkbox" id="<?=str_replace("/","_",$index)?>_all_view" onclick="return uncheck('<?=str_replace("/","_",$index)?>','all_view','own_view')" name="<?=$index?>[all_view]" value="<?=AT_VIEW?>" <?php if(isset($permission_data[$index]['all_view'])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>

    						<td style="width: 31px;">
    							<?php
    								if(in_array(AT_EDIT,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[own_edit]" id="<?=str_replace("/","_",$index)?>_own_edit" onclick="return uncheck('<?=str_replace("/","_",$index)?>','own_edit','all_edit')" value="<?=AT_EDIT?>" <?php if(isset($permission_data[$index]['own_edit'])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td style="width: 23px;">
    							<?php
    								if(in_array(AT_EDIT,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[all_edit]" id="<?=str_replace("/","_",$index)?>_all_edit" onclick="return uncheck('<?=str_replace("/","_",$index)?>','all_edit','own_edit')" value="<?=AT_EDIT?>" <?php if(isset($permission_data[$index]['all_edit'])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td style="width: 32px;">
    							<?php
    								if(in_array(AT_DELTE,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[own_delete]" id="<?=str_replace("/","_",$index)?>_own_delete" onclick="return uncheck('<?=str_replace("/","_",$index)?>','own_delete','all_delete')" value="<?=AT_DELTE?>" <?php if(isset($permission_data[$index]['own_delete'])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td style="width: 22px;">	
    							<?php
    								if(in_array(AT_DELTE,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[all_delete]" id="<?=str_replace("/","_",$index)?>_all_delete" onclick="return uncheck('<?=str_replace("/","_",$index)?>','all_delete','own_delete')" value="<?=AT_DELTE?>" <?php if(isset($permission_data[$index]['all_delete'])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>   
    						<td style="">
    							<?php
    								if(in_array(AT_EXPORT,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[export]" value="<?=AT_EXPORT?>" <?php if(isset($permission_data[$index]['export'])){ echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>

    						<td>
    							<?php
    								if(in_array(AT_IMPORT,$my_list)){
    							?>
    								<input type="checkbox" name="<?=$index?>[import]" value="<?=AT_IMPORT?>" <?php if(isset($permission_data[$index]['import'])){ echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>					
    						</td>
                            <td>
                                <?php
                                    if(in_array(AT_DOWNLOAD,$my_list)){
                                ?>
                                    <input type="checkbox" name="<?=$index?>[download]" value="<?=AT_DOWNLOAD?>" <?php if(isset($permission_data[$index]['download'])){ echo 'checked="true"';} ?> />
                                <?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>                  
                            </td>
                            <td>
                                <?php
                                    if(in_array(AT_PRINT,$my_list)){
                                ?>
                                    <input type="checkbox" name="<?=$index?>[print]" value="<?=AT_PRINT?>" <?php if(isset($permission_data[$index]['print'])){ echo 'checked="true"';} ?> />
                                <?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>                  
                            </td>
                            
    				  	</tr>
                  	<?php }else{ 
                  			$my_list = array_flip($custom_action);
                  			$index = $index.'_'.$method->id;
                  			// pr($my_list);die;
                  		?>
                  		<!-- Start Custom action -->
                  		<tr>
    						<input type="hidden" name="name[]" value="<?=$index?>" />
    						<input type="hidden" name="<?=$index?>[controller_duplicate]" value="<?=$method->module_controller?>" />
                            <input type="hidden" name="<?=$index?>[controller]" value="<?=$method->module_controller.'_'.$method->id?>" />
    						<input type="hidden" name="<?=$index?>[module]" value="<?=$method->module_name?>" />
    						<td><strong><?=$method->module_title." (".$method->parent_name.")"?></strong></td>
    						<td>
    							<?php
								if($key_name = in_array(AT_ADD, $my_list)){?>
								<input type="checkbox" id="<?=str_replace("/","_",$index)?>_add" name="<?=$index?>[<?php echo $custom_action[AT_ADD] ?>]" value="<?=AT_ADD?>" <?php if(isset($permission_data[$index][$custom_action[AT_ADD]])){echo 'checked="true"';} ?>/>				
								<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td>
    							<?php
    								if(in_array(AT_VIEW, $my_list)){
    							?>
    							<input type="checkbox" id="<?=str_replace("/","_",$index)?>_own_view" onclick="return uncheck('<?=str_replace("/","_",$index)?>','own_view','all_view')" name="<?=$index?>[own_<?php echo $custom_action[AT_VIEW] ?>]" value="<?=AT_VIEW?>" <?php if(isset($permission_data[$index]['own_'.$custom_action[AT_VIEW]])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td>
    							<?php
    								if(in_array(AT_VIEW, $my_list)){
    							?>
    							<input type="checkbox" id="<?=str_replace("/","_",$index)?>_all_view" onclick="return uncheck('<?=str_replace("/","_",$index)?>','all_view','own_view')" name="<?=$index?>[all_<?php echo $custom_action[AT_VIEW] ?>]" value="<?=AT_VIEW?>" <?php if(isset($permission_data[$index]['all_'.$custom_action[AT_VIEW]])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>

    						<td>
    							<?php
    								if(in_array(AT_EDIT,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[own_<?php echo $custom_action[AT_EDIT] ?>]" id="<?=str_replace("/","_",$index)?>_own_edit" onclick="return uncheck('<?=str_replace("/","_",$index)?>','own_edit','all_edit')" value="<?=AT_EDIT?>" <?php if(isset($permission_data[$index]['own_'.$custom_action[AT_EDIT]])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td>
    							<?php
    								if(in_array(AT_EDIT,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[all_<?php echo $custom_action[AT_EDIT] ?>]" id="<?=str_replace("/","_",$index)?>_all_edit" onclick="return uncheck('<?=str_replace("/","_",$index)?>','all_edit','own_edit')" value="<?=AT_EDIT?>" <?php if(isset($permission_data[$index]['all_'.$custom_action[AT_EDIT]])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td>
    							<?php
    								if(in_array(AT_DELTE,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[own_<?php echo $custom_action[AT_DELTE] ?>]" id="<?=str_replace("/","_",$index)?>_own_delete" onclick="return uncheck('<?=str_replace("/","_",$index)?>','own_delete','all_delete')" value="<?=AT_DELTE?>" <?php if(isset($permission_data[$index]['own_'.$custom_action[AT_DELTE]])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>
    						<td>	
    							<?php
    								if(in_array(AT_DELTE,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[all_<?php echo $custom_action[AT_DELTE] ?>]" id="<?=str_replace("/","_",$index)?>_all_delete" onclick="return uncheck('<?=str_replace("/","_",$index)?>','all_delete','own_delete')" value="<?=AT_DELTE?>" <?php if(isset($permission_data[$index]['all_'.$custom_action[AT_DELTE]])){echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>   
    						<td>
    							<?php
    								if(in_array(AT_EXPORT,$my_list)){
    							?>
    							<input type="checkbox" name="<?=$index?>[<?php echo $custom_action[AT_EXPORT] ?>]" value="<?=AT_EXPORT?>" <?php if(isset($permission_data[$index][$custom_action[AT_EXPORT]])){ echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>
    						</td>

    						<td>
    							<?php
    								if(in_array(AT_IMPORT,$my_list)){
    							?>
    								<input type="checkbox" name="<?=$index?>[<?php echo $custom_action[AT_IMPORT] ?>]" value="<?=AT_IMPORT?>" <?php if(isset($permission_data[$index][$custom_action[AT_IMPORT]])){ echo 'checked="true"';} ?> />
    							<?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>					
    						</td>
                            <td>
                                <?php
                                    if(in_array(AT_DOWNLOAD,$my_list)){
                                ?>
                                    <input type="checkbox" name="<?=$index?>[<?php echo $custom_action[AT_DOWNLOAD] ?>]" value="<?=AT_DOWNLOAD?>" <?php if(isset($permission_data[$index][$custom_action[AT_DOWNLOAD]])){ echo 'checked="true"';} ?> />
                                <?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>                  
                            </td>
                            <td>
                                <?php
                                    if(in_array(AT_PRINT,$my_list)){
                                ?>
                                    <input type="checkbox" name="<?=$index?>[<?php echo $custom_action[AT_PRINT] ?>]" value="<?=AT_PRINT?>" <?php if(isset($permission_data[$index][$custom_action[AT_DOWNLOAD]])){ echo 'checked="true"';} ?> />
                                <?php } else{ echo "<img src='".PUBLIC_URL."images/no_need.png' width='12px;'> "; } ?>                  
                            </td>
    				  	</tr>
                  		<!-- End Custom action -->
                  <?php } ?>
	      	<?php }} ?>
		  	</table>
			<div class="modal-footer">
				<div class="row-fluid"> 
					<div class="span12" style="margin-left:45%">   
					  <button name="submit" type="submit" class="btn btn-primary submit_btn">Submit</button>
				  	  <!-- <button name="submit" type="reset" class="btn btn-danger">Reset</button> -->
					</div>
				</div>
			</div>
		  	<?php echo form_close(); ?>
	 	</div>
	</div>
  	</div>
</div>

<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-1.8.3.js"></script>
<script type="text/javascript">
	function uncheck(title,actionName,opposite){
		if($('#'+title+"_"+actionName).attr('checked')) {
			$('#'+title+"_"+opposite).removeAttr("checked");
		}
	}
</script>
<script type="text/javascript">
	function submit_form(){
		// $('#site_form').submit();
        document.getElementById("site_form").submit();
	}
</script>