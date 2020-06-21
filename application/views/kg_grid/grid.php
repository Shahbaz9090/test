
 

 <script type="text/javascript" src="<?=PUBLIC_URL?>js/dragtable.js"></script>

<link href="<?php echo base_url();?>assets/plugins/sumoselect/sumoselect.css" rel="stylesheet" />

<?php



/**

 *

 * to get the substr of any string without html tags

 *

 * **/



include 'grid_helper.php';



$this->lang->load('flexy_grid', get_site_language());



//$uri = $this->session->userdata("current_uri");

//$uri = str_replace("/list_items/","",$uri);

// pr($grid);die;

$uri = str_replace(SITE_PATH, "", $grid['base_url']);

$userinfo = currentuserinfo();

$permission = get_permissions_lists();



$add = false;

$delete = false;

$export = false;

$view = false;

$edit = false;

if($uri=='form_module')

{

   $uri = $uri.'/'.uri_segment(3);

}

//pr($permission);die;

//pr($dynamic_module_name);die;

foreach ($permission as $k => $v) {



    if ($v == AT_ADD && $uri . '/add' == $k) {

        $add = true;

    }



    if ($v == AT_DELTE && $uri . '/delete' == $k) {

        $delete = true;

    }



    if ($v == AT_EXPORT && $uri . '/export' == $k) {

        $export = true;

    }



    if ($v == AT_VIEW && $uri . '/view' == $k) {

        $view = true;

    }



    if ($v == AT_EDIT && $uri . '/edit' == $k) {

        $edit = true;

    }

	if($uri=='user/dice_group')

	{

		$add = true;

		$edit = true;

	}

}

?>

<link href="<?=PUBLIC_URL?>css/table.css" rel="stylesheet" type="text/css" />

<link href="<?=PUBLIC_URL?>css/main.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">

function performAction(className){

	

    if(className =='add_dynamic_column'){

		//alert('<?=$base_url?>/dynamic_add/1');

		//return false;

		var dynamic_module_name = "<?=$dynamic_module_name?>";

		var dynamic_module_id = "<?=$dynamic_module_id?>";

		//alert(dynamic_module_name);

		//return false;

        location.href='<?=$base_url?>/dynamic_add/'+dynamic_module_name+'/'+dynamic_module_id;

		

    }else if(className =='add_column'){

		//alert('<?=$base_url?>/add_column/1');

		//return false;

		var column_add_id = "<?=$column_add_id?>";

		

        location.href='<?=$base_url?>/add_column/'+column_add_id;

		

    }else if(className =='add'){

        location.href='<?=$base_url?>/add';

    }else{

        var listitems = '';



        $('.ischecked input[type="checkbox"]:checked').each(function(){

            listitems += $(this).val()+',';

        });

        var total_items = listitems.split(',');

        var arr_length = (total_items.length)-1;



        if(className =='export'){

            var text = $("#searchBox").val();



            var ajax_ids = $('#main_ids').val();

            var list_ids = '';

            //alert(listitems);return false;

            if(text!='' &&  listitems!=''){ 

                location.href='<?=$base_url?>/export/?items='+listitems;

            }else if(text!=''){ 

                location.href='<?=$base_url?>/export/?text='+text;

            }else if(listitems){ 

                location.href='<?=$base_url?>/export/?items='+listitems;

            }else{  

                location.href='<?=$base_url?>/export/?items='+list_ids;

            }

            /*if(arr_length > 0){

                if(confirm('<?=lang("fl_export")?> ' + arr_length + ' <?=lang("fl_export_items")?>'))

                {

                  location.href='<?=$base_url?>/export/?items='+listitems;

                }

            }else{

                alert('Please select atleast one record');

                return false;

            }*/



        }else if(className =='delete'){

			

			

			

			if(arr_length > 0){

				

				if(confirm('<?=lang("fl_delete")?> ' + arr_length + ' <?=lang("fl_export_items")?>'))

                {



                    $.ajax({

                       type: "POST",

					   url: "<?=$base_url?>/delete/",

                       data: token_name+"="+token_hash+"&items="+listitems,

                       success: function(data){

						   

						  alert("<?=lang('fl_delete_length_sucess')?>");

                          var page  = $("#page").val();

						  if(!page){

							page =1;

							}

                          changePagination(page);



                       }

                    });

                }

            }else{

                alert('Please select atleast one record');

                return false;

            }





        }

    }

}





</script>

<?php foreach($grid['result']['result']  as $key=>$val){

        $ids[] = $val->id;

}

$com_id = '';

if(isset($ids) && !empty($ids))

{

    $com_id = implode(',',$ids);

}

//pr($com_id);die;

 ?>

 <input type="hidden" name="com[]" id="com_id" value="<?=$com_id?>">

<?php

if (strtolower($this->uri->segment(1)) == 'job_order') {

    ?>

<script>

setInterval(function(){

   $("#searchForm").trigger('submit');

},300000);

</script>

<?php }?>



<?php

$page_offset = 1;

$limit = $grid['limit'];

$total = $grid['result']['total'];

$page = $page_offset;

$offset = 1;

$order_by = $grid['order_by'];

$total_cols = count($grid['cols']) + 2;

?>

 <style>

.table-bordered{

	margin-top: 0px;



}

th.label{

text-shadow:none;	

}

td.label{

	color:#333;

	font-weight:normal;

	text-shadow:none;

	background:transparent;

}

.table th, .table td {

padding:3px 8px;

line-height: 18px;

text-align: left !important;

vertical-align: top;

border-top: 1px solid #dddddd;

font-size: 12px;

}

.dataTables_paginate {

float: right;

text-align: right;

margin-top: 0px;

}

.box .dataTables_info {

margin-top: 0px;

margin-bottom: 15px;

color: #555555;

font-weight: normal;

}

.box .dataTables_filter {

margin-left: 19px;

}

.scheckbox {margin-right: 2px;}

.table th, .table td {

    border-top: 0 solid #000;

    font-size: 12px;

    line-height: 18px;

    padding: 3px 8px;

    text-align: left;

    vertical-align: top;

}



.order_by{

    cursor: pointer;

}

.dataTables_info{

    color: #555;

}





.green-row td{ background: rgb(178, 205, 180) !important;

border-bottom: 1px solid #B5B5B5 !important;

}

.orange-row td{background: rgb(250, 213, 133) !important;

border-bottom: 1px solid #B5B5B5 !important;

}







.SumoSelect {

    width: 53%;

}

.SumoSelect .CaptionCont.SelectBox.search {

    width: 100%;

    line-height: initial;

    float: left;

}

.SumoSelect > .CaptionCont > span.placeholder {

    color: #353535;

    font-style: normal;

    cursor: pointer;

    }

   .SumoSelect:focus > .CaptionCont, .SumoSelect:hover > .CaptionCont, .SumoSelect.open > .CaptionCont {

    box-shadow: 0 0 2px #c8cbce;

    border-color: #e4e6e8;

}

.SumoSelect > .CaptionCont {

    position: relative;

    border: 1px solid #e8e3e3;

    min-height: 14px;

    background-color: #fff;

    border-radius: 8px;

    margin: 0;

}

.SumoSelect.open .search-txt {

    display: inline-block;

    position: absolute;

    top: 0;

    left: 0;

    width: 100%;

    margin: 0;

    padding: 14px 7px;

}

.SumoSelect > .CaptionCont > label > i {

    background: url("<?=base_url()?>/assets/plugins/chosen/chosen-sprite.png") no-repeat 13px 2px;

    display: block;

    width: 100%;

    height: 100%;

}   



.SumoSelect.open > .optWrapper {

    top: 35px;

    display: block;

    width: 109%;

}

#assign_client_chosen{

    width: 286px;

}

 </style>

 <?=get_flashdata()?>

 <?php

//pr($grid);

?>

<input type="hidden" name="main_ids[]" id="main_ids" />

 <div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>

					<span class="icon16 brocco-icon-grid"></span> <span><?php echo $title; ?></span>



                  <?php

                    $uri = strtolower($this->uri->segment(1));

                    $uri2 = strtolower($this->uri->segment(2));

                    $uri3 = strtolower($this->uri->segment(3));

                    $uri_arr = array('demo', 'paid');





                    if($uri == 'opportunity' && $uri2 == "appointment") {

                    	

                    $this->load->view("calender");



                    }

                    if ($uri == 'form_module' && $uri2 == "dynamic") {

                        

						 ?>

                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $add):   ?><span class="grid-button" ><div class="fbutton"><div><span onclick="performAction('add_dynamic_column');" class="add"><span aria-hidden="true" class="cut-icon-plus-2 grid-list-icon"></span>Add </span></div></div></span>

                        <?php endif;?>



                    <?php }else if ($uri == 'form_module' && $uri2 == "view") {

                            if(isset($extra_btn) && !empty($extra_btn)){echo $extra_btn; }?>

                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $delete): ?>

                            <span class="grid-button" ><div class="fbutton"><div><span onclick="performAction('add_column');" class="add"><span aria-hidden="true" class="cut-icon-plus-2 grid-list-icon"></span>Add Column</span></div></div></span>

                        <?php endif;?>



                    <?php } elseif ( ($uri == 'customer' && in_array($uri2, $uri_arr)) || $uri != 'customer' && !$no_btn ) {

                        ?>

                    <span class="grid-button" ><?php if ($userinfo->is_super_site || $userinfo->is_super || $add): $uri12 = $this->uri->segment('1');  if($uri12!='enquiry_database' && $uri12!='qualified_lead' && $uri12!='disqualified_lead'){ ?><div class="fbutton"><div>	<span onclick="performAction('add');" class="add"><span aria-hidden="true"  class="cut-icon-plus-2 grid-list-icon"></span>Add</span></div></div><?php }?>

                     <?php if (($uri == 'customer' && in_array($uri2, $uri_arr)) && ($userinfo->is_super_site || $userinfo->is_super)) {?><div class="btnseparator"></div><div class="fbutton"><div>	<span class="show_history" data-toggle="modal" data-target="#logs_history" class="add"><span aria-hidden="true"  class="cut-icon-plus-2 grid-list-icon"></span>Logs History</span></div></div>



                    <?php }

                        endif;?><?php if ($userinfo->is_super_site || $userinfo->is_super || $delete): $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database' && $uri12!='qualified_lead' && $uri12!='disqualified_lead'){ ?><div class="btnseparator"></div><div class="fbutton"><div><span onclick="performAction('delete');" class="delete"><span aria-hidden="true" class="cut-icon-minus-2 grid-list-delete"></span>Delete</span></div></div><?php } ?>







                    <?php endif?>

					<?php if ($userinfo->is_super_site || $userinfo->is_super || $export): ?>

                    <?php $uri12 = $this->uri->segment('1'); if($uri12=='company' or $uri12=='supplier'or $uri12=='enquiry_database'){ ?>

                    <div class="btnseparator"></div>

					<div class="fbutton"><div><span onclick="performAction('export');" class="export"><span aria-hidden="true" class="entypo-icon-export grid-list-export"></span>Export</span></div>

					</div><?php } ?><?php endif?>

					<?php if (($uri2 == 'contact') && ($userinfo->is_super_site || $userinfo->is_super || $add)): ?>

								<div class="fbutton"><div>	<span onclick="assign_group();" class="add"><span aria-hidden="true"  class="cut-icon-plus-2 grid-list-icon"></span>Assign Group</span></div></div>



					<?php endif;?>

					<?php if (($uri12 == 'company' && $uri2!='contact') && ($userinfo->is_super_site || $userinfo->is_super || $add)): ?>

                                <div class="fbutton"><div>  <span onclick="client_transfer();" class="add"><span aria-hidden="true"  class="cut-icon-plus-2 grid-list-icon"></span>Client Transfer</span></div></div>



                    <?php endif;?>

                    </span>



                    <?php }?>

                    <?php if(isset($extra_btn) && !empty($extra_btn)){

                        foreach ($extra_btn as $key => $custom_btn) {

                            echo $custom_btn;

                        }

                    }?> 

                	<form action="" class="box-form right" style="margin-right: 7px; margin-top: 4px;">





                        <?php

                        //$notification = _domain_notification();

                        if (@$notification) {

                            ?>

                            <i title="Domain Notification" class="tip icon-warning-sign" style="cursor: pointer;" data-toggle="modal" data-target="#myModal2"></i>

                                <?php

                        }



                        ?>







    				</form>



        		</h4>



                <a class="minimize" href="#" style="display: none;">Minimize</a>



			</div>



			<div class="content">

             <div class="row-fluid">

               <div class="span9" >

                    <div>

                    <label>

                    <span style="float: left;">

                    <select size="1"  class="input-mini nostyle" id="records" style="padding-top: 2px;height: 24px;">

                        <?php $recordSelect = _recordSelect();

foreach ($recordSelect as $key => $value):

?>

                         <option value="<?=$key?>"><?=$value?></option>

                        <?php

endforeach;

?>

                    </select></span>  <span style="margin:2px 0 0 5px; float: left;color:#555555; font-family: inherit;">Records Per Page</span> </label>

                    </div>

                </div>

                <div class="span3">

                    <div class="dataTables_filter">

                    <label>

                        <form id="searchForm"  method="post" onsubmit="return false;">

                            <?php if ($uri != 'scr') {?>

                                <input type="text"  autocomplete="off" class="span12" style="width:229px;margin-top: 4px;" id="searchBox"  placeholder="<?php echo @$place_holder; ?>"/>

								<input type="hidden" id="table_name" value ="<?= $uri3 ?>" />

							<?php }?>



                        </form>

                    </label>

                    </div>

                </div>

              </div>

              <div>

              <?php if ($uri == 'scr' && $uri2 == "list_items") {?>

                                <select name="recruiter_manager" id="recruiter_manager">

                                    <option value="">Recruiter Manager</option>

                                    <?php if (!empty($grid['recruiter_manager_data'])) {if (@$_GET['recruitment_manager']) {$recruitment_manager = $_GET['recruitment_manager'];} else { $recruitment_manager = '';}?>

                                        <?php foreach ($grid['recruiter_manager_data'] as $rmd_key => $rmd_val) {?>

                                            <option value = "<?=$rmd_val->recruitment_manager_id?>" <?=($recruitment_manager == $rmd_val->recruitment_manager_id) ? "selected='selected'" : ""?>><?=$rmd_val->first_name . " " . $rmd_val->last_name?></option>

                                        <?php }?>

                                    <?php }?>

                                </select>

                                <select name="sales_manager" id="sales_manager">

                                    <option value="">Sales Manager</option>

                                    <?php if (!empty($grid['sales_manager_data'])) {if (@$_GET['sales_manager']) {$sales_manager = $_GET['sales_manager'];} else { $sales_manager = '';}?>

                                        <?php foreach ($grid['sales_manager_data'] as $sd_key => $sd_val) {?>

                                            <option value = "<?=$sd_val->sales_manager_id?>" <?=($sales_manager == $sd_val->sales_manager_id) ? "selected='selected'" : ""?>><?=$sd_val->first_name . " " . $sd_val->last_name?></option>

                                        <?php }?>

                                    <?php }?>

                                </select>

                                <select name="team_manager" id="team_manager">

                                    <option value="">Team Manager</option>

                                    <?php if (!empty($grid['team_manager_data'])) {if (@$_GET['team_manager']) {$team_manager = $_GET['team_manager'];} else { $team_manager = '';}?>

                                        <?php foreach ($grid['team_manager_data'] as $td_key => $td_val) {?>

                                            <option value = "<?=$td_val->team_manager_id?>" <?=($team_manager == $td_val->team_manager_id) ? "selected='selected'" : ""?>><?=$td_val->first_name . " " . $td_val->last_name?></option>

                                        <?php }?>

                                    <?php }?>

                                </select>

                                <select name="recruiter" id="recruiter">

                                    <option value="">Recruiter</option>

                                    <?php if (!empty($grid['recruiter_data'])) {if (@$_GET['recruiter']) {$recruiter = $_GET['recruiter'];} else { $recruiter = '';}?>

                                        <?php foreach ($grid['recruiter_data'] as $rd_key => $rd_val) {?>

                                            <option value = "<?=$rd_val->recruiter_id?>" <?=($recruiter == $rd_val->recruiter_id) ? "selected='selected'" : ""?>><?=$rd_val->first_name . " " . $rd_val->last_name?></option>

                                        <?php }?>

                                    <?php }?>

                                </select>

                            <?php }?>

              </div>

            <span id="ajax_replace">



                <div id="table-box">

				<table class="responsive table table-bordered draggable table-striped" id="dragdata1">

				   <thead>

					  <tr>

					  	<th id="sh" style="min-width: 50px;width:50px;vertical-align: middle;">SN.<span id="sn" style="cursor: pointer;"><i class="iconic-icon-cog" style="color:#555;float: right;margin-top:2px;"></i></span>

                        <div class="relative-table">



                         <div  id="checkbox_div" class="absolute-table" >

                              <span class="table-close">&times;</span>

                              <input type="checkbox" name="checkBox" value="checkBox" class="scheckbox" ><input type="checkbox" /><br/>

					            <?php

foreach ($grid['cols'] as $k => $v) {

    ?>

        						 <input type="checkbox" name="<?=$v['name']?>" value="<?=$v['name']?>" class="scheckbox " /><?=$v['display']?><br/>

        						<?php

}

?>

						</div>

                        </div></th>

                        <th id="all-checkbox" class="checkBox" style="min-width: 50px;width:50px;vertical-align: middle;"><input type="checkbox" class="all-checkbox" /></th>

                        <?php



foreach ($grid['cols'] as $k => $v) {  

    ?>

						<th style="vertical-align: middle;" id="<?=$v['name']?>" class="<?=$v['name']?> <?php if (isset($v['order_by']) && $v['order_by'] == 'yes') {?>order_by<?php }?>" ><?=ucwords($v['display'])?></th>

						<?php

}

?>

					<?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>

						<th style="min-width:70px ; vertical-align: middle;"><?='Action'?></th>

					<?php } ?>

					  </tr>

					</thead>

					<tbody>

						<?php

						

// pr($grid);exit;

if ($grid['result']['result']) {

    foreach ($grid['result']['result'] as $key => $val) { 


        ?>

							<tr id="row-<?=$val->id?>" <?php if (!empty($val->tr_color)) {?> class="<?=$val->tr_color?>" <?php }?>>

								<td><?=++$key?></td>

                                <?php  $uri12 = $this->uri->segment('1'); if($uri12=='enquiry_database'){ ?>

                                    <td class="checkBox ischecked"><input type="checkbox" class="single-checkbox1" id="single-checkbox-<?=$val->form_id?>" value="<?=$val->form_id?>" /></td>

                                <?php }else{ ?>

                                     <td class="checkBox ischecked"><input type="checkbox" class="single-checkbox1" id="single-checkbox-<?=$val->id?>" value="<?=$val->id?>" /></td>

                                <?php } ?>

								 <?php

foreach ($grid['cols'] as $k => $v) { 

            ?>

            <?php if(isset($action_tag_btn) && !empty($action_tag_btn) && $v['name']=='subject'){ ?>

						<td class="<?=$v['name']?>"><a href="<?=$grid['base_url'] . '/view/' . $val->id?>"><?=$val->{$v['name']};?></a></td>

                    <?php }else{?>


                        <td class="<?=$v['name']?>"><?=$val->{$v['name']};?></td>

                  <?php } ?>

						<?php

}

        ?>

 <?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>

								<td>

									<?php

$uri = strtolower($this->uri->segment(1));

        $uri2 = strtolower($this->uri->segment(2));

        $uri_arr = array('demo', 'paid');

        if ($uri == 'customer' && $uri2 != "requests") {

            if (!in_array($uri2, $uri_arr)) {

                ?>



                                   	<?php

if ($val->status == 0) {

                    ?>					

							

									<a title="Verify" data-toggle="modal" data-target="#myModal1" class="tip view" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

										 <a title="Create" rel="<?=$val->status?>" class="tip  create" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-hand-right"></i></a>

									<?php } else {?>

                                    <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                    <?php }?>

                                       <a title="Comment" dir="<?=$val->id?>" data-toggle="modal" data-target="#myModal" class="tip in-process" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-comment"></i></a>

                                       <?php if ($val->status != '1') {?>

								       <a title="Delete" class="tip delete-customer" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>

                                       <?php }?>

									

                                     <?php



            } else {?>

									

                                     <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

									

                                    <?php }} elseif ($uri == "scr") {?>

                                     <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                      <?php endif;?>

                                   <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): if($uri!='enquiry_database'  && $uri12!='qualified_lead' && $uri12!='disqualified_lead'){ ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                 <?php } ?>

								 <?php endif;?>

                                 <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                 <a title="Generate PDF" class="tip" href="<?=SITE_PATH?>scr/invoice_pdf/<?=$val->id?>" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-print"></i></a>

                                 <?php endif;?>



                                    <?php } elseif ($uri == "job_order") {?>

                                      <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                <?php endif;?>



                                <?php if ($userinfo->is_super_site || $userinfo->is_super || $add): ?>

                                 <a title="Generate SCR" rel="" class="tip view_scr_candidate"  <?php if (isset($val->link) && $val->link == "yes") {?> job_id="<?=$val->id?>" data-toggle="modal" data-target="#view-scr-candidate" <?php }?> style="cursor:pointer;" ><i class="icon-file"></i></a>

                                <?php endif;?>





                                    <?php } elseif ($uri == "candidate" && $uri2 == "list_items") {?>



                                      <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                <?php endif;?>



                                <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                 <a title="Add Comment" rel="" class="tip add_candidate_comment" style="cursor:pointer;" dir="<?=$val->id?>" data-toggle="modal" data-target="#add-candidate-comment"><i class="icon-comment"></i></a>

                                <?php endif;?>





                                   <?php } elseif ($uri == "vendor" && $uri2 == "list_items") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>



                                 <a title="edit" rel="" class="tip" <?php if (isset($val->is_edited) && $val->is_edited == 1) {?> href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;color:#000000" <?php } else {?>style="cursor:pointer;color:#9D9797 " <?php }?>  ><i class="fa fa-edit"></i></a>



                                <?php endif;?>







                                <?php } elseif ($uri == "vendor" && $uri2 == "list_items") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>



                                 <a title="edit" rel="" class="tip" <?php if (isset($val->is_edited) && $val->is_edited == 1) {?> href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;color:#000000" <?php } else {?>style="cursor:pointer;color:#9D9797 " <?php }?>  ><i class="fa fa-edit"></i></a>



                                <?php endif;?>







                                  <?php

} elseif ($uri == "customer" && $uri2 == "requests") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>



                                <?php endif;?>







                                <?php

}elseif ($uri == "form_module" && $uri2 == "dynamic") { 

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): 

										$key = $key-1;

									

									?>

                                  		  <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/dynamic_edit/' . $val->form_id ."/". $dynamic_module_id ."/" . $dynamic_module_name?>" style="cursor:pointer;" ><i class="fa fa-edit"></i></a>

										  

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/dynamic_view/' . $val->form_id ."/". $dynamic_module_id ."/" . $dynamic_module_name?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

										  

                                           <?php endif;?>   &nbsp;

                                        <?php //if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <!--<a title="Delete" rel="" class="tip delete-dynamic-value-requests" id="<?=$dynamic_module_id?>" data = "<?=$val->form_id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>-->



                                <?php //endif;?>







                                <?php

} elseif ($uri == "billing" && $uri2 == "requests") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>



                                <?php endif;?>

                                  <?php

                                    } elseif(isset($no_action_btn) && $no_action_btn=='yes') {

                                        if(isset($action_tag_btn) && $action_tag_btn)

                                        {?>

                                        <a onclick="$('#mail_id2').val('<?=$val->id?>');" data-toggle="modal" data-target="#add_tag_modal" rel="" class="tip" href="javascript:void(0)" style="cursor:pointer;" oldtitle="view" title="Add Tag" aria-describedby="ui-tooltip-1"><i class="icon-plus"></i></a>

                                        <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                    <?php }} else {?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                    <?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>

                          		    <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                <?php } ?>

                                   <?php endif;?> 

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                    <?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database' && $uri12!='disqualified_lead'){ ?>

                                    <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

									<?php } ?>



                                    <?php if($uri == "form_module" && $uri2 == "list_items") {?>

										<?php $uri12 = $this->uri->segment('1'); if($uri12!='enquiry_database'){ ?>

                                        <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>

									<?php } }?>

                                <?php endif;?>

								<?php }?>

								</td>

                            <?php } ?>

							</tr>

						<?php

}

}else if ($grid['forms']) { 

	$indx = 1;

    foreach ($grid['forms'] as $key => $val) {// pr($val) ;

        ?>

							<tr id="row-<?=$val->id?>" <?php if (!empty($val->tr_color)) {?> class="<?=$val->tr_color?>" <?php }?>>

								<?php if(isset($custom_edit) && !empty($custom_edit))

								{?>

									<td><?=$indx++?></td>

								<?php }else{ ?>

								<td><?=$key++?></td>

								<?php } ?>

                                <td class="checkBox ischecked"><input type="checkbox" class="single-checkbox1" id="single-checkbox-<?=$val->id?>" value="<?=$val->id?>" /></td>

								 <?php

foreach ($grid['cols'] as $k => $v) {	//pr( $v);

            ?>

						<td class="<?=$v['name']?>"><?=$val->{$v['name']};?></td>

						<?php

}

        ?>





								<td>

									<?php

$uri = strtolower($this->uri->segment(1));

        $uri2 = strtolower($this->uri->segment(2));

        $uri_arr = array('demo', 'paid');

        if ($uri == 'customer' && $uri2 != "requests") {

            if (!in_array($uri2, $uri_arr)) {

                ?>



                                   	<?php

if ($val->status == 0) { 

                    ?><a title="Verify" data-toggle="modal" data-target="#myModal1" class="tip view" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

										 <a title="Create" rel="<?=$val->status?>" class="tip  create" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-hand-right"></i></a>

									<?php } else { ?>

                                    <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                    <?php }?>

                                       <a title="Comment" dir="<?=$val->id?>" data-toggle="modal" data-target="#myModal" class="tip in-process" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-comment"></i></a>

                                       <?php if ($val->status != '1') {?>

								       <a title="Delete" class="tip delete-customer" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>

                                       <?php }?>



                                     <?php



            } else {?>



                                     <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>



                                    <?php }} elseif ($uri == "scr") {?>

                                     <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                      <?php endif;?>

                                   <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                 <?php endif;?>

                                 <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                 <a title="Generate PDF" class="tip" href="<?=SITE_PATH?>scr/invoice_pdf/<?=$val->id?>" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-print"></i></a>

                                 <?php endif;?>



                                    <?php } elseif ($uri == "job_order") {?>

                                      <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                <?php endif;?>



                                <?php if ($userinfo->is_super_site || $userinfo->is_super || $add): ?>

                                 <a title="Generate SCR" rel="" class="tip view_scr_candidate"  <?php if (isset($val->link) && $val->link == "yes") {?> job_id="<?=$val->id?>" data-toggle="modal" data-target="#view-scr-candidate" <?php }?> style="cursor:pointer;" ><i class="icon-file"></i></a>

                                <?php endif;?>





                                    <?php } elseif ($uri == "candidate" && $uri2 == "list_items") {?>



                                      <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>

                                <?php endif;?>



                                <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                 <a title="Add Comment" rel="" class="tip add_candidate_comment" style="cursor:pointer;" dir="<?=$val->id?>" data-toggle="modal" data-target="#add-candidate-comment"><i class="icon-comment"></i></a>

                                <?php endif;?>





                                   <?php } elseif ($uri == "vendor" && $uri2 == "list_items") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>



                                 <a title="edit" rel="" class="tip" <?php if (isset($val->is_edited) && $val->is_edited == 1) {?> href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;color:#000000" <?php } else {?>style="cursor:pointer;color:#9D9797 " <?php }?>  ><i class="fa fa-edit"></i></a>



                                <?php endif;?>







                                <?php } elseif ($uri == "vendor" && $uri2 == "list_items") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>



                                 <a title="edit" rel="" class="tip" <?php if (isset($val->is_edited) && $val->is_edited == 1) {?> href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;color:#000000" <?php } else {?>style="cursor:pointer;color:#9D9797 " <?php }?>  ><i class="fa fa-edit"></i></a>

										

                                <?php endif;?>







                                  <?php

} elseif ($uri == "customer" && $uri2 == "requests") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>



                                <?php endif;?>







                                <?php

}elseif ($uri == "form_module" && $uri2 == "view") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): 

                                        if(!isset($custom_edit) || empty($custom_edit))

                                        {

									      	$key = $key-1;

                                        }?>

                              		  <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit_column/' . $column_add_id."/". $key?>" style="cursor:pointer;" ><i class="fa fa-edit"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 	<a title="Delete" rel="" class="tip delete-user-requests" id="<?=$column_add_id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>



                                <?php endif;?>







                                <?php

} elseif ($uri == "billing" && $uri2 == "requests") {

            ?>

                                    <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		  <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="Delete" rel="" class="tip delete-user-requests" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>



                                <?php endif;?>











                                  <?php

} else {

            ?>

                                     <?php if ($userinfo->is_super_site || $userinfo->is_super || $view): ?>

                                  		 <a title="view" rel="" class="tip"  href="<?=$grid['base_url'] . '/view/' . $val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>

                                           <?php endif;?>   &nbsp;

                                        <?php if ($userinfo->is_super_site || $userinfo->is_super || $edit): ?>

                                 <a title="edit" rel="" class="tip"  href="<?=$grid['base_url'] . '/edit/' . $val->id?>" style="cursor:pointer;" ><i class="icon-edit"></i></a>



                                <?php endif;?>





									<?php

}?>







								</td>



							</tr>

						<?php

}

} else {

    ?>

						<tr><td colspan="10" colspan="<?=$total_cols?>">No data found.</td></tr>

						<?php

}

?>

					</tbody>

                 </table>

                 <div id="show_grid_bsy" style="display:none;position:absolute;top:0px;left:0px;height:100%;width:100%; background-color: #FFFAFA;opacity: 0.7;">

                 <img src="<?php echo PUBLIC_URL; ?>images/loaders/clock.gif" style="margin-top:17% ;margin-left:48%;" />

                 </div>

                 </div>





                 <div class="row-fluid">

                    <div class="span8">

                        <div class="dataTables_info" id="sample_1_info">

                        Showing <?php

if ($page_offset > 0) {

    echo ($limit * ($page_offset - 1)) + 1;

} else {

    echo 1;

}

?> to <?php

$next = null;

if ($page_offset < 1) {

    if ($limit > $total) {

        $next .= $total;

    } else {

        $next .= $limit;

    }

} elseif ($limit * $page_offset < $total) {

    $next .= ($limit * $page_offset);

} elseif (@$hiddenLimit > 0) {

    $next .= $total;

} else {

    $next .= $total;

}

echo $next;

?> of <?=$total?> entries</div>

                    </div>

                    <?php if ($total > $next) {?>

                    <div  class="span2"><span class="go-to-page">Go To Page</span>

                        <form onsubmit="changePagination(page.value);return false;" >

                            <input type="number" name="page" id="page" value="<?=$page_offset?>" min="1" max="<?=ceil($total / $limit)?>" style="width:40px; height:17px; float: right;padding:4px 5px;margin-top: 1px;" placeholder="Page"   />

                        </form>

                    </div>

                    <?php }?>

                    <div class="span2">

                         <?php

$data['page_offset'] = $page_offset;

$data['limit'] = $limit;

$data['total'] = $total;

$data['page'] = $page;

echo $this->load->view("kg_grid/ajax_pagination", $data);

?>

                    </div>



                </div>



                </span>

			</div>

		</div>

		<!-- End .box -->

	</div>

	<!-- End .span12 -->

</div>

<span id="reload"></span>





<!-- End .row-fluid -->



<!-- Modal -->

<div class="modal fade" id="assign_group" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Assign Group</h4>

      </div>

      <div class="modal-body" style="height:200px">



        <!---------------Table---------------->

        <div class="row-fluid">

            <span id="commentt"></span>

        </div>

        <div class="row-fluid">

          <div class="form-group">

            <label for="exampleInputEmail1">Assign Group</label>

            <!--<textarea style="width: 80%;" rows="4" id="comment_input" required=""></textarea>-->

			<select onchange="assign_group_input(this)" name="assign_group[]" id="assign_group_input" class="filter_multiselect_inch_esp_make nostyle"  multiple required >

				<option value="">Select Group</option>

				<?php if (!empty($user_groups)) {

					foreach ($user_groups as $ug_key => $ug_val) {?>

						<option value="<?=$ug_val->id?>"><?=$ug_val->name?></option>

				<?php }}?>

			</select>

				<script type="text/javascript">



                   jq('.filter_multiselect_inch_esp_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Assign Group'});
				
                     $('#assign_group')[0].sumo.reload(true);

                    

                </script>

          </div>

		  <div class="form-group">

            <label for="exampleInputEmail1">Assign User</label>

            <!--<textarea style="width: 80%;" rows="4" id="comment_input" required=""></textarea>-->

			<select name="assign_user[]" multiple id="assign_user" class="filter_multiselect_inch_esp_make nostyle" required>

				<option value="">Select User</option>

				<?php foreach($assign_user as $row): 

			?>

			<option value="<?=$row->id;?>" <?php if(isset($selected)){ echo $selected; } ?> ><?=ucfirst($row->name)?> </option>

			<?php endforeach; ?>

			</select>

			<script type="text/javascript">

					

                   jq('.filter_multiselect_inch_esp_make').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Assign User'});

				    $('#assign_user')[0].sumo.reload();

            </script>

			<input type="hidden" name="company_contact" value="">

          </div>

          <input type="hidden" value="" id="comment_id" />

        </div>



        <!---------------Table---------------->





      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="button" id="save_assign_group" class="btn btn-primary">Save</button>

      </div>

    </div>

  </div>

</div>

<script>



$('#save_assign_group').click(function(){

    var i = $('#assign_group_input').val();

    var j = $('#assign_user').val();

    if(i==null || i=='undefined' || i==''){ 

        alert("Please select assign group first");return false;

    }else{

        if(j==null || j=='undefined' || j==''){ 

            alert("Please select assign user first");return false;

        }

    }

});





function assign_group()

{

	var listitems = '';

	$('.ischecked input[type="checkbox"]:checked').each(function(){

		listitems += $(this).val()+',';

	});

	//alert(listitems);

	var total_items = listitems.split(',');

	var arr_length = (total_items.length)-1;

	if(arr_length>0){

		$("#assign_group").modal('show');

		$("input[name='company_contact']").val(listitems);

	}else{

		alert("Please select one rerord.");

		return false;

	}

}

function assign_group_input(obj){

		var all_id = [];

  			$(obj).each(function(i, v){

  				if($(this).val()!='')

  				{

  					all_id.push($(this).val());

  				}

  			});

		var all_users_id = [];

  			$("select[name='assign_user[]'] option:selected").each(function(i, v){

  				if($(this).val()!='')

  				{

  					all_users_id.push($(this).val());

  				}

  	});

			$.ajax({

				url:"<?=base_url('user_group/ajax_user/')?>",

				method:'POST',

				data:{token_name:token_hash,group_id:all_id,users_id:all_users_id},

				success:function(res){

					if(res!='')

					{

						$('#assign_user').html(res);

						$('#assign_user')[0].sumo.reload();



					}

					else

					{

						$('#assign_user').html('');

					}

				}

			});

}

$(document).on('click','#save_assign_group',function(){

	let assign_group = $("select[name='assign_group[]']").val();

	let assign_user = $("select[name='assign_user[]']").val();

	let company_contact = $("input[name='company_contact']").val();

	let error = true;

	if(assign_group == ''){

		error = false;

		alert('Please select group.');

		return false;

	}else{



	}

	if(assign_user == ''){

		error = false;

		alert('Please select user.');

		return false;

	}else{



	}

	if(error)

	{

		//alert("success");

		$.ajax({

			type:"POST",

			data: token_name+"="+token_hash+"&assign_group="+assign_group+"&assign_user="+assign_user+"&company_contact="+company_contact,

			url:"<?php echo base_url(); ?>company/contact/assign_group_user",

			success: function(data){

				if(data){

                   // alert(data);return false;

                    if(data=='true'){ 

                            $("#assign_group").modal('hide');

                            window.location.href= '<?=base_url()?>company/contact/list_items';

                        }else{

                            // var value = JSON.stringify(data);

                           var val = JSON.parse(data);

                           alert(val.message);

                            window.location.href= '<?=base_url()?>company/contact/list_items';

                        }

					

				}else{

					alert("Some error occured.");

				}

				//$("#comment_td"+id).html(response);

				//$('#myModal').modal('toggle');

				//$("#comment_input").val('');

			}

		});

	}

});

</script>



<div class="modal fade" id="client_transfer" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Client Transfer</h4>

      </div>

      <div class="modal-body" style="height:200px">



        <!---------------Table---------------->

        <div class="row-fluid">

            <span id="commentt"></span>

        </div>

        <div class="row-fluid">

          <div class="form-group">

            <label for="exampleInputEmail1">Assign Group</label>

            <!--<textarea style="width: 80%;" rows="4" id="comment_input" required=""></textarea>-->

            <select onchange="assign_group_client(this)" name="assign_group_client[]" id="assign_group_client" class="filter_multiselect_inch nostyle"  multiple>

                <?php if (!empty($user_groups)) {

                    foreach ($user_groups as $key => $val) {?>

                        <option value="<?=$val->id?>"><?=$val->name?></option>

                <?php }}?>

            </select>

                <script type="text/javascript">

                    

                   jq('.filter_multiselect_inch').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Assign Group'});

                    //$('#assign_group')[0].sumo.reload();

                </script>

          </div>

            <div class="row-fluid">

                <div class="span7">

                    <label for="exampleInputEmail1">Assign User</label> 

                    <div class=" ">  

              

                        <select name="assign_user_client" id="assign_client" class="chosen-select nostyle">

                            <option value="">Select User</option>

                            <?php foreach($assign_user as $row): 

                            ?>

                            <option value="<?=$row->id;?>" <?php if(isset($selected)){ echo $selected; } ?> ><?=ucfirst($row->name)?> </option>

                            <?php endforeach; ?>

                        </select>

                    </div>

                </div>

             <input type="hidden"  name="company" value="">   

            </div>

         </div> 



        <!---------------Table---------------->





      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="button" id="save_client_transfer" class="btn btn-primary">Save</button>

      </div>

    </div>

  </div>

</div>

<script type="text/javascript">

    function client_transfer()

    {

        var listitems = '';

        $('.ischecked input[type="checkbox"]:checked').each(function(){

            listitems += $(this).val()+',';

        });

        //alert(listitems);

        var total_items = listitems.split(',');

        var arr_length = (total_items.length)-1;

        if(arr_length>0){

            $("#client_transfer").modal('show');

            $("input[name='company']").val(listitems);

        }else{

            alert("Please select one rerord.");

            return false;

        }

    }

    

    function assign_group_client(obj){

            var all_id = [];

                $(obj).each(function(i, v){

                    if($(this).val()!='')

                    {

                        all_id.push($(this).val());

                    }

                });

            var all_users_id = [];

                $("select[name='assign_user_client'] option:selected").each(function(i, v){

                    if($(this).val()!='')

                    {

                        all_users_id.push($(this).val());

                    }

        });

                $.ajax({

                    url:"<?=base_url('user_group/ajax_user/')?>",

                    method:'POST',

                    data:{token_name:token_hash,group_id:all_id,users_id:all_users_id},

                    success:function(res){

                        if(res!='')

                        {

                            //alert(res);

                            $('#assign_client').html(res);

                            $('#assign_client').attr('selected', true);

                            $("#assign_client").trigger("chosen:updated");

                        }

                        else

                        {

                            $('#assign_client').html('');

                        }

                    }

                });

    }

    $(document).on('click','#save_client_transfer',function(){

        let assign_group = $("select[name='assign_group_client[]']").val();

        let assign_user = $("select[name='assign_user_client']").val();

        let company = $("input[name='company']").val();

        let error = true;

        if(assign_group == ''){

            error = false;

            alert('Please select group.');

            return false;

        }else{



        }

        if(assign_user == ''){

            error = false;

            alert('Please select user.');

            return false;

        }else{



        }

        if(error)

        {

            //alert("success");

            $.ajax({

                type:"POST",

                data: token_name+"="+token_hash+"&assign_group="+assign_group+"&assign_user="+assign_user+"&company="+company,

                url:"<?php echo base_url(); ?>company/transfer_client",

                success: function(data){

                    if(data){

                        if(data=='true'){ 

                            $("#client_transfer").modal('hide');

                            window.location.href= '<?=base_url()?>company/list_items';

                        }else{

                            // var value = JSON.stringify(data);

                           var val = JSON.parse(data);

                           alert(val.message);

                            window.location.href= '<?=base_url()?>company/list_items';

                        }

                        //window.location.href= '<?=base_url()?>company/list_items';

                    }else{

                        alert("Some error occured.");

                    }

                    //$("#comment_td"+id).html(response);

                    //$('#myModal').modal('toggle');

                    //$("#comment_input").val('');

                }

            });

        }

    });

</script>

<!-- Modal -->

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Comments</h4>

      </div>

      <div class="modal-body">



        <!---------------Table---------------->

        <div class="row-fluid">

            <span id="commentt"></span>

        </div>

        <div class="row-fluid">

          <div class="form-group">

            <label for="exampleInputEmail1">Type Comment</label>

            <textarea style="width: 80%;" rows="4" id="comment_input" required=""></textarea>

          </div>

          <input type="hidden" value="" id="comment_id" />

        </div>



        <!---------------Table---------------->





      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

        <button type="button" id="save_comment" class="btn btn-primary">Save</button>

      </div>

    </div>

  </div>

</div>



<!---Model-->





<!-- Modal -->

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">View Customer Information</h4>

      </div>

      <div class="modal-body">



        <!---------------Table---------------->



        <div class="row-fluid">

             <span id="view"></span>

        </div>



        <!---------------Table---------------->





      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default back-button" data-dismiss="modal" data-toggle="modal" data-target="#myModal2" style="display: none;">Back</button>

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>



<!--Model-->





<!-- Modal -->

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

  <div class="modal-dialog">

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>

        <h4 class="modal-title" id="myModalLabel">Same domain customers</h4>

      </div>

      <div class="modal-body">



        <!---------------Table---------------->



        <div class="row-fluid">





             <?php foreach ($notification as $key => $val) {?>

                <div  title="Click to expand <?=$val->Domain?>" class="tip domain_user row-fluid" id="<?=$val->id?>" dir="<?=$val->Domain?>" style="cursor: pointer;">

                    <div class="span6"><b><?php echo $val->Domain ?></b></div>

                    <div class="span6"><?php echo $val->Total ?></div>

                </div>

                <span   class="doamin_users<?=$val->id?> row-fluid" id="<?=$val->id?>" dir="<?=$val->Domain?>"></span>

                <input type="hidden" id="domain_hidden<?=$val->id?>" value="1" />



             <?php }?>



        </div>



        <!---------------Table---------------->





      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>

  </div>

</div>



<!--Model-->



<script>









    $(document).on('click','.in-process',function()

    {   var id=$(this).attr("dir");

        $("#comment_id").val(id);

        var datastring = token_name+"="+token_hash+"&id="+id;

        $.ajax({

				type:"POST",

				data: datastring,

				url:"<?php echo base_url(); ?>customer/ajax_update_comment",

			    success: function(response){

					$("#commentt").html(response);

				}

		});

    });



     $(document).on('click','#save_comment',function()

     {

        var id=$("#comment_id").val();

        var comment=$("#comment_input").val();

     	var datastring = token_name+"="+token_hash+"&comment="+comment+"&id="+id;

        $.ajax({

				type:"POST",

				data: datastring,

				url:"<?php echo base_url(); ?>customer/ajax_update_comment/1",

				success: function(response){

                    //$("#comment_td"+id).html(response);

                    $('#myModal').modal('toggle');

                    $("#comment_input").val('');

				}

		});

    });



  $(document).on('click','.create',function()

     {

        var id=$(this).attr('id');

        //alert(id);exit;

        var val = confirm("Do you want to create this user?");

        if(val){

           window.location="<?=$grid['base_url']?>/customers/add/"+id;

        }else{

            return false;

        }



    });



     $(document).on('click','.view',function()

     {

        var id=$(this).attr('id');

     	var datastring = token_name+"="+token_hash+"&id="+id;

        $.ajax({

				type:"POST",

				data: datastring,

				url:"<?php echo base_url(); ?>customer/ajax_view",

				success: function(response){

                    $("#view").html(response);

				}

		});

    });



     $(document).on('click','.delete-customer',function()

     {

        var id=$(this).attr('id');

        var val = confirm('Do you want to continue?');

        if(val){

           var datastring = token_name+"="+token_hash+"&id="+id;

           $.ajax({

    				type:"POST",

    				data: datastring,

    				url:"<?php echo base_url(); ?>customer/ajax_delete",

    				success: function(response){

                        $("#row-"+id).remove();

    				}

    	   });

        }else{

            return false;

        }



    });

	

	

	$(document).on('click','.delete-dynamic-value-requests',function()

     {

        var id=$(this).attr('id');

        var module_id=$(this).attr('data');

        var dynamic_module_name="<?=$dynamic_module_name?>";

        var val = confirm('Do you want to continue?');

        if(val){

           var datastring = token_name+"="+token_hash+"&id="+id+"&module_id="+module_id+"&dynamic_module_name="+dynamic_module_name ;

           $.ajax({

    				type:"POST",

    				data: datastring,

    				url:"<?php echo base_url(); ?>form_module/dynamic_delete",

    				success: function(response){

                        $("#row-"+id).remove();

						window.location.href ='' ;

    				}

    	   });

        }else{

            return false;

        }



    });

      $(document).on('click','.delete-request',function()

     {

        var id=$(this).attr('id');

        var val = confirm('Do you want to continue?');

        if(val){

           var datastring = token_name+"="+token_hash+"&items="+id;

		   alert(datastring);

		   return false;

           $.ajax({

    				type:"POST",

    				data: datastring,

    				url:"<?php echo $base_url; ?>/delete",

    				success: function(response){

                        $("#row-"+id).remove();

    				}

    	   });

        }else{

            return false;

        }



    });







     $(document).on('click','.delete-user-requests',function()

     {

        var id=$(this).attr('id');

        var val = confirm('Do you want to continue?');

        if(val){

           var datastring = token_name+"="+token_hash+"&items="+id;

           $.ajax({

    				type:"POST",

    				data: datastring,

    				url:"<?php echo $base_url; ?>/delete",

    				success: function(response){

                        $("#row-"+id).remove();

    				}

    	   });

        }else{

            return false;

        }



    });





    $(".domain_user").click(function(){

        var id=$(this).attr("id");

        var domain=$(this).attr("dir");

        var hidden = $("#domain_hidden"+id).val();

        if(hidden == 2){

            $(".doamin_users"+id).html('');

            $("#domain_hidden"+id).val('1');

            return false;

        }



        var datastring = token_name+"="+token_hash+"&id="+domain;

        $.ajax({

				type:"POST",

				data: datastring,

				url:"<?php echo base_url(); ?>customer/ajax_domain_user",

                beforeSend:function(){

                    $(".doamin_users"+id).html('<div style="height:30px;"><img src="<?php echo PUBLIC_URL; ?>images/loaders/ajax_preloader.gif"  width="20px"></div>');

                },

			    success: function(response){

					$(".doamin_users"+id).html(response);

					//$(".doamin_users"+id).removeClass('tip');

					$("#domain_hidden"+id).val('2');

                    $(".back-button").show();

				}

		});

    });



</script>



<input type="hidden" id="offset" value="<?=$offset?>" />

<input type="hidden" id="hiddenLimit" value="<?php echo (@!empty($_COOKIE['limit'])) ? @$_COOKIE['limit'] : '10'; ?>" />

<input type="hidden" id="order_by" value="<?=$order_by?>" />

<input type="hidden" id="order" value="<?='DESC'?>" />

<?php

$arr = array();

foreach ($grid['cols'] as $key => $val) {

    $arr[] = $val['name'];

}

$arr = implode(',', $arr);

?>

<script>

var baseUrl = "<?=$grid['base_url']?>";

var option_array = "<?=$arr?>";

</script>





<script type="text/javascript" src="<?=PUBLIC_URL?>js/kg.datagrid/main.js"></script>



<?php if ($uri == 'scr' && $uri2 == "list_items") {?>

<script>

    $(document).on('change','#recruiter_manager, #sales_manager, #team_manager, #recruiter',function(){

        let recruiter_manager   = $("#recruiter_manager").val();

        let sales_manager       = $("#sales_manager").val();

        let team_manager        = $("#team_manager").val();

        let recruiter           = $("#recruiter").val();



        let offset      =   $("#offset").val();

        let order_by    =   $("#order_by").val();

        let order       =   $("#order").val();



        var datastring = token_name+"="+token_hash+"&offset="+offset+"&order_by="+order_by+"&order="+order;

        datastring  += "&recruiter_manager="+recruiter_manager+"&sales_manager="+sales_manager+"&team_manager="+team_manager+"&recruiter="+recruiter;



        $.ajax({

				type:"POST",

				data: datastring,

                url: baseurl+"scr/ajax_list_items",

                success: function(response){
                    


                    $("#ajax_replace").html(response);

                },

                error:function(){



                }



		});

    });

</script>

<?php }?>

