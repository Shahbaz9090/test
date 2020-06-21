<script src="<?php echo base_url(); ?>assets/js/date-time/moment.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.js"></script>
<link href="<?php echo base_url();?>assets/css/daterangepicker.css" rel="stylesheet" />
<script src="<?php echo base_url(); ?>assets/js/date-time/daterangepicker.js"></script>
<script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/bootstrap-datetimepicker.js"></script>
<script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/bootstrap-timepicker.js"></script>
<style>
.SumoSelect {
    width: 90%;
}
.SumoSelect .CaptionCont.SelectBox.search {
    width: 100%;
    line-height: 19px;
    float: left;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #6f6d6d;
    font-style: normal;
    cursor: pointer;
}
.SumoSelect:focus > .CaptionCont, .SumoSelect:hover > .CaptionCont, .SumoSelect.open > .CaptionCont {
    box-shadow: 0 0 2px #c8cbce;
    border-color: #e4e6e8;
}
.SumoSelect>.optWrapper>.options li label {
	margin-bottom: 0px;
}
.SumoSelect > .CaptionCont {
    position: relative;
    border: 1px solid #e8e3e3;
    min-height: 19px;
    background-color: #fff;
    border-radius: 4px;
    margin: 0;
}

.SumoSelect > .CaptionCont > span {
    color: #555;
    font-size: .9em;
}
.SumoSelect > .CaptionCont > label > i {
    background: url(<?=base_url('assets/plugins/chosen/chosen-sprite.png')?>) no-repeat 13px 2px;
    display: block;
    width: 100%;
    height: 100%;
}
.SumoSelect.open .search-txt {
    padding: 12px 8px;
}
.SumoSelect.open>.optWrapper {
    top: 35px;
    display: block;
    width: 107%;
}
.SumoSelect > .optWrapper > .options li.opt {
    padding: 2px 2px;
    
}
.SumoSelect > .optWrapper.multiple > .options li.opt span i, .SumoSelect .select-all > span i {
   
    width: 10px;
    height: 10px;
}
.SumoSelect > .optWrapper > .options::-webkit-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-moz-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-ms-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-o-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::scrollbar {
    width: 3px;
}
.SelectBox {
    padding: 2px 5px;
}
/******************************/

.dataTables_filter {
	color: #fff;
    float: left;
    border-radius: 64px;
    background: linear-gradient(#304349, #304349);
    border-radius: 5px;
}
.box .dataTables_filter {
    margin-left: 0px;
}
.hoverStrict:hover.hoverStrict td,.hoverStrict th{
	background-color:#f997c4 !important;
}
div.uploader {
   margin-right: 200px;
}

.daterangepicker.dropdown-menu{
	width: 900px;
    margin-left: -204px;
    margin-top: 3px;
}

.daterangepicker.opensright .ranges, .daterangepicker.opensright .calendar, .daterangepicker.openscenter .ranges, .daterangepicker.openscenter .calendar{
	width: 234px;
	margin-left: 61px;
}
.daterangepicker .calendar-date{
	    margin-left: -62px;
}
</style>
<div class="row-fluid">
	<div class="span12">
	 	<?php echo get_flashdata();?>
       <div class="box">
            <div class="title">
                <h4>
                	<span id="list_by left" style="float: left;padding-right: 10px;"><span class="icon16 brocco-icon-grid"></span>Activity Report</span>
                	
					<!--<span style="float:right; margin-right: 40px;" aria-hidden="true" class="entypo-icon-export grid-list-export">  Export</span>-->
					<button style="float:right; margin-right: 40px;" class="btn btn-goback" id="sms" onclick="export_data()">Export</button>
					<div class="clearfix"></div>
				</h4>
			</div>

			<div class="content">
				<div class="content">
				<form id="searchData" method="post" onsubmit="return false;">
					<div class="span4"></div>
					<div class="span8">
						<div class="span3">
							<select name="modules" id="modules" class="nostyle chosen-select">
								<option value="" >All Moduels</option>
								<?php
								$modules	= module_list_superAdmin();
									foreach($modules as $key=>$val){ ?>
									<?php $data = $_GET['modules']; ?>
									<option value="<?php echo $val->module_name; ?>" <?php if($data==$val->module_name){echo "selected";}?>><?php echo $val->module_title; ?></option>
								<?php } ?>
							</select>
							
						</div>
						<div class="span3">
							<select name="action_data" id="action_data" class="nostyle chosen-select">
								<option value="" >All Action</option>
								<?php  foreach($action_data as $key=>$val){ ?>
									<?php $data = $_GET['action']; ?>
									<option value="<?php echo $key; ?>" <?php if($data==$key){echo "selected";}?>><?php echo $val; ?></option>
								<?php } ?>
							</select>
							
						</div>
						<div class="span4">
							<input class="form-control date-range-picker date-picker-small active" autocomplete="off" type="text" name="duration" value="<?=isset($_GET['date_range']) && !empty($_GET['date_range'])?$_GET['date_range']:''?>" id="id-date-range-picker-1" placeholder="Date Range">
						</div>
						<div class="span1" style="margin-left:unset;">
							<button class="btn btn-info marginR10" name="search" type="submit"><i class="fa fa-search"></i></button>
						</div>
						<div class="span1" style="margin-left:unset;">
							<button type="reset" id="reset" class="btn btn-danger" name="Reset" value="Reset" onclick="window.location.href='<?=$module_link?>'" ><i class="fa fa-refresh"></i></button>
						</div>
					</div>
				</form>
			    <span id="ajax_replace">
					<table class="responsive table table-bordered">
						<thead>
						  	<tr>
							    <th  class="ch" width="3%">
									<input type="checkbox" name="allCheckbox" value="all" class="checkall">
								</th>
								<th>S.N</th>
								<th>Module</th>
								<th>Action</th>
								<th>Added By</th>
								<th>Date</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if(isset($data_list) && !empty($data_list)){
							$i = 1; 
							//pr($data_list);die;
							foreach($data_list as $i_key => $row){ ?>
						  	<?php if($row->release_email == '1'){ ?> 
							<tr style="background:#f997c4;" class="hoverStrict" >
							<?php }else{
						      	echo "<tr>";
							}?>
                            
								<td>
									<input type="checkbox" name="subCheck" value="<?=$row->id?>" class="record_checkbox"/>
								</td>
								<td ><?=++$total_pages?></td>
								<td style="text-align: left;"><?=ucwords(str_replace("/", " > ", $row->uri)) ?></td>
								<td style="text-align: left;">
								<?php if($row->action=='103') // add
                                { ?>
                                   <a target="_blank" href="<?php echo base_url(str_replace("add", '', $row->uri).'view/'.$row->action_id) ?>">Add</a>
                                    
                                <?php }elseif($row->action=='101') // view
                                { ?>
                                    <a target="_blank" href="<?php echo base_url($row->uri) ?>">View</a>
                                <?php }elseif($row->action=='102') // edit
                                { ?>
                                    <a target="_blank" href="<?php echo base_url(str_replace("edit", 'view', $row->uri)) ?>">Edit</a>
                                <?php }elseif($row->action=='104') // delete
                                { ?>
                                    <a no-href="javascript:void()">Delete</a>
                                <?php }elseif($row->action=='105') // export
                                { ?>
                                    <a no-href="javascript:void()">Export</a>
                                <?php } ?>
								</td>
								<td style="text-align: left;"><?=$row->first_name.' '.$row->last_name;?></td>
								<td style="text-align: left;"><?=$row->created_time?></td>
							</tr>
							<?php }
							}else{
								echo "<tr><td style='color:red;text-align:center' colspan='13'>No data found</td></tr>";
							}?>
						</tbody>
	                </table>
					<div class="span8" style="float:right;margin-top: 20px; margin-right: -23px;" >
						<ul class="pagination" style="float: right; width:207px; margin-right: 7px;"><?=$pagination_link?></ul>
					</div>
					<input type="hidden" name="select_list" id="select_list" value="0">
				</span>
          	</div>
      	</div><!-- End .box -->
  	</div><!-- End .span12 -->
</div><!-- End .row-fluid -->

<span id="reload"></span>

<div class="modal fade" id="compose_email" tabindex="-1" role="dialog"  style="width:750px;" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-lg">
		<div class="modal-content">
		  	<?php echo form_open_multipart($base_url."/compose_email/".$msg_type,array('class'=>'form-horizontal','role'=>'form','id'=>'reply_mail'));?>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">New Email</h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				  <div class="span12">
					<div class="span12" style="width:700px;">
					  	<div class="row-fluid"> 
						   	<div class="span2">
						   		<b>To</b>
						   	</div> 
						   	<div class="span10"> 
						   		<input value="" style="width: 90%" type="text" name="to" class="form-control">
						   	</div><br>
					   	</div>
					   	<div class="row-fluid"> 
						   	<div class="span2">
						   		<b>Cc</b>
						   	</div> 
					   	
						   	<div class="span10"> 
						   		<input style="width: 90%" type="text" name="cc" class="form-control">
						   	</div><br>
					   </div>
					   <div class="row-fluid"> 
						   	<div class="span2">
						   		<b>Bcc</b>
						   	</div> 
						   	<div class="span10"> 
						   		<input style="width: 90%" type="text" name="bcc" class="form-control">
						   	</div>
					   	</div>
					   	<div class="row-fluid"> 
						   	<div class="span2">
						   		<b>Subject</b>
						   	</div> 
						   	<div class="span10"> 
						   		<input style="width: 90%" type="text" name="subject" value="" class="form-control">
						   	</div>
					   	</div><br>
					   	
					   	<div class="row-fluid"> 
						   	<div class="span12">   
								<input type="hidden" name="mail_id" value=""/>
							  	<textarea  name="body" id="mail_content"  class="ckeditor"></textarea>
						   	</div>   
						</div>
					</div>
					</div>
			  	</div>       
			</div>
			<div class="modal-footer">
				<div class="row-fluid"> 
					<div class="span12">   
					   	<button type="submit" name="compose_email_btn" id="compose_email_btn" class="btn btn-primary pull-left">Send</button>
                        <button type="submit" name="save_draft" id="save_draft" class="btn btn-danger pull-left">Save as Draft</button>
					   	<button class="btn btn-default pull-right" data-dismiss="modal">Close</button>
					  	<i class="fa fa-paperclip" title="Insert Attachment"></i> <input title="Add Attachment" type="file" name="attachment[]" multiple="" class="btn btn-primary pull-left">
					  
					</div>
				</div>
			</div>
			<?php echo form_close();?> 
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css')?>">
<script src="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js')?>"></script>
<style type="text/css">
.bootstrap-tagsinput
{
	width: 92%;
}
</style>
<div class="modal fade" id="add_tag_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  	<div class="modal-dialog modal-sm">
		<div class="modal-content">
		  	<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
				<h4 class="modal-title" id="myModalLabel">Tags for email Searching</h4>
		  	</div>
		  	<div class="modal-body">
				<div class="row-fluid">
				  	<div class="span12">
						<form class="form-horizontal" method="POST" id="mail_tags" role="form" action="<?=($base_url."/add_mail_tags/")?>">
							<div class="span12">
							  	<div class="row-fluid"> 
								   	<div class="span2">
								   		<b>Enter Tags</b>
								   	</div> 
								   	<div class="span10" id="tagsinput_div"> 
								   		<input type="text" type="text" name="tags" id="tags-input" class="form-control" data-role="tagsinput" value="" >
										</div>
								   	<div class="span10"> 
								   		<small style="color: red"><b>Note:</b>Use comma(,) to add more.</small>
								   	</div>
							   	</div><br>
							   	
								<div class="row-fluid"> 
									<input type="hidden" id="mail_id2" name="mail_id" value="">
									<input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
								    <div class="span12" style="text-align: center;">   
									  <button id="submit_tags" class="btn btn-primary text-center">Save</button>&nbsp;&nbsp;&nbsp;
									  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
								   </div>
							  	</div>
							  	<hr>
						  	</div>
						</form>
				 	</div>
			  	</div>       
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$(document).ready(function(){
	// $("#tags-input").tagsinput('form');
	var module_url 	= '<?=($base_url)?>';
	var msg_type 	= '<?=($msg_type)?>';
	jq('#email_tag').SumoSelect({search: true, searchText: 'Search here.',placeholder:'Select Action'});

	$(".sync_mail_btn").click(function(){
		beforeAjaxResponse();
	});
	//===========================Check all==================//
	$('.checkall').change(function(){
	    // alert($(this).is(':checked'))
	    if($(this).is(':checked')){
	        
	        $('.record_checkbox').prop('checked','checked');
	        $('.record_checkbox').parent().addClass('checked');
	    }
	    else
	    {
	        $('.record_checkbox').prop('checked',false);
	        $('.record_checkbox').parent().removeClass('checked');
	    }
		
	});
 	
	$('#add_tag_modal').on('shown.bs.modal', function (event) {

		var mail_id = $("#mail_id2").val();
		//alert(mail_id);return false;
		if(mail_id!=undefined && mail_id!=null && mail_id!='')
		{
		 	$.ajax({
	            url:module_url+'/get_mail_list',
	            type:"POST",
	            dataType:'json',
	            data: token_name+"="+token_hash+"&mail_id="+mail_id,
	            beforeSend:function()
	            {
	            	beforeAjaxResponse();
	            },
	            success:function(res)
	            {
	            	afterAjaxResponse();
	                if(res.status==1)
	                {
	                	if(res.data)
	                	{
	            			$("#tagsinput_div").html('<input type="text" type="text" name="tags" id="tags-input" class="form-control" data-role="tagsinput" value="'+res.data+'" >');
	                	}
	                	else
	                	{
	                		$("#tagsinput_div").html('<input type="text" type="text" name="tags" id="tags-input" class="form-control" data-role="tagsinput" value="" >');
	                	}
	                }
	                else
	                {
	                	$("#tagsinput_div").html('<input type="text" type="text" name="tags" id="tags-input" class="form-control" data-role="tagsinput" value="" >');
	                }
	                $("#tags-input").tagsinput('refresh');
	            },
	            error:function()
	            {
	            	afterAjaxResponse();
                	alert("Network error.");
	            }
	        });
		}
		else
		{
			alert("Something went wrong!");
		}
	});

	$("#searchData").submit(function() {
		//alert(msg_type);return false;
		var modules = $("#modules").val();
		var date_range = $("#id-date-range-picker-1").val();

		var action 	= $("#action_data").val();
		//alert(status);
		if(action==null || action==undefined)
		{
			action = '';
		}
		
		window.location.href =  module_url+"/list_items?date_range="+date_range+"&action="+action+"&modules="+modules;
		
	});

    $(".all_delete_mail_btn").click(function(){
        if(confirm("Are you sure to delete record"))
        {
            var delRow = new Array();
            $('.record_checkbox').each(function(i){
                if($(this).is(':checked')){
                    // alert($(this).val());
                    delRow.push($(this).val());  
                }                               
            });
            // console.log(module_url);
            // return false;
            if(delRow.length>0)
            {
                $.ajax({
                    type:"POST",
                    url: module_url+'/delete_records/',
                    data:token_name+'='+token_hash+'&delRow='+delRow,
                    dataType:'json',
                    beforeSend : function(){
                        beforeAjaxResponse();
                    },
                    success: function(result) {
                        afterAjaxResponse();
                        if(result.status==1)
                        {
                            window.location.reload();  
                        }
                    },
                    error:function(xhr,status)
                    {
                        afterAjaxResponse();
                        alert("Network error.");
                    }
                });
            }
            else
            {

                alert("Please select at least one record!");
                return false;
            }
        }
        else
        {
            // return false;
        }
    });
});


</script>
<script>
$('.date-range-picker').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	});
    $('.date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
	
</script>

<script>
	var module_url 	= '<?=($base_url)?>';
	function export_data(){
			var val = [];
			$("input[name='subCheck']:checked").each(function(i){
			  val[i] = $(this).val();
			});
			var checkbox_id = val;
			//alert(checkbox_id);return false;
			var modules = $('#modules').val();
			var action = $('#action_data').val();
			var date_range = $("#id-date-range-picker-1").val();
			if(checkbox_id!='' && checkbox_id!=null && checkbox_id!='undefined'){
				location.href= module_url+"/export/?checkbox_id="+checkbox_id;
			}else{
				location.href= module_url+"/export/?date_range="+date_range+"&action="+action+"&modules="+modules;
			}
	};
</script>