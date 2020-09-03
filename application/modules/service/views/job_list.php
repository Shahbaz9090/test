<script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script>
<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.chat-container 
{
    position: relative;
}
.chat-count
{
    color: white !important;
    height: 10px !important;
    width: 10px !important;
    line-height: 10px !important;
    padding: 2px !important;
    border:1px solid #2bb541 !important;
    background: #2bb541 !important;
    border-radius: 100% !important;
    font-size: .8em;
    display: block;
    position: absolute;
    text-align: center !important;
    top: -7px;
    right: -16px;
}
</style>
<?php 
// echo $module_url;die;
$uri        = str_replace(SITE_PATH, "", $module_url);
$userinfo   = currentuserinfo();
$permission = get_permissions_lists();
$add        = FALSE;
$delete     = FALSE;
$export     = FALSE;
$view       = FALSE;
$edit       = FALSE;

// pr($userinfo->is_super);die;
//pr($dynamic_module_name);die;
if($userinfo->is_super==1)
{
    $add        = TRUE;
    $delete     = TRUE;
    $export     = TRUE;
    $view       = TRUE;
    $edit       = TRUE;
}
else
{
    foreach ($permission as $k => $v) {

        if ($v == AT_ADD && $uri . '/add' == $k) {
            $add = TRUE;
        }

        if ($v == AT_DELTE && $uri . '/delete' == $k) {
            $delete = TRUE;
        }

        if ($v == AT_EXPORT && $uri . '/export' == $k) {
            $export = TRUE;
        }

        if ($v == AT_VIEW && $uri . '/view' == $k) {
            $view = TRUE;
        }

        if ($v == AT_EDIT && $uri . '/edit' == $k) {
            $edit = TRUE;
        }
        if($uri=='user/dice_group')
        {
            $add = TRUE;
            $edit = TRUE;
        }
    }
}?>

<div class="row-fluid">
	<div class="span12">
	 	<?php echo get_flashdata();?>
       <div class="box">
            <div class="title">
                <h4>
                	<span class="icon16 brocco-icon-grid"></span>
					<span id="list_by"><?=$title?> List</span>
					<span class="grid-button">
                        <?php if($add){ ?>
						<div class="fbutton">
							<div>
								<a href="<?=$base_url?>/add" class="add"><span aria-hidden="true" class="cut-icon-plus-2 grid-list-icon"></span>Add</a>
							</div>
						</div>
                        <?php } ?>
                        <?php if($delete){ ?>
                 		<div class="btnseparator"></div>
                 		<div class="fbutton">
                 			<div>
                 				<span onclick="return delete_record()" class="delete">
                 					<span aria-hidden="true" class="cut-icon-minus-2 grid-list-delete"></span>Delete
                 				</span>
                 			</div>
                 		</div>
                        <?php } ?>
					</span>
                </h4>
				<a href="#" class="minimize">Minimize</a>
			</div>    
			<div class="content noPad" >
	            <div class="row-fluid" style="padding: 7px 0px 0px 0px;" id="search1">
	                <div class="span3 dataTables_filter" style="float: right;">
	                    <form name="search_form" method="GET" action="<?=current_url()?>">
                            <input style="width: 190px;" type="text" placeholder="Search" name="search_keyword" value="<?=isset($_GET['search_keyword']) && !empty($_GET['search_keyword'])?$_GET['search_keyword']:''?>" /> 
                            <button type="button" style="margin-top: -10px;" class="btn btn-primary" onclick="window.location.href='<?=current_url()?>'"><i class="fa fa-refresh"></i></button>
                        </form>
	                </div>
	            </div>
				<span id="ajax_replace">
					<table class="responsive table table-bordered">
						<thead>
						  	<tr>
							    <th class="ch" width="3%">
									<input type="checkbox" name="allCheckbox" value="all" class="checkall">
								</th>
								<th>Sr. No.</th>
                                <th>Job No.</th>
                                <th>Name Of Card</th>
                                <th>Engineer</th>
								<th>Reviewer</th>
								<th>Quality</th>
								<th>Lead</th>
								<!-- <th>Action</th> -->
                                <th>Date</th>
								<th>Operation Status</th>
                                <th>Engineer Status</th>
                                <th>Date</th>
                                <th>Input</th>
                                <th>Card Make</th>
                                <th>Card Model</th>
                                <th>Machine Make</th>
                                <th>Machine Model</th>
								<th style="width: 60px;">Action</th>
						  	</tr>
						</thead>
						<tbody>
							<?php
							if(isset($data_list) && !empty($data_list)){
							$i = 1;
							foreach($data_list as $key => $row){?>
						  	<tr style="background: <?php echo $row->total_product>$row->total_product_recieved?'#f7dba9':'lightgreen'; ?> ">
								<td>
									<input type="checkbox" value="<?=$row->form_id?>" class="record_checkbox"/>
								</td>

								<td ><?=$i++?></td>
                                <?php if($edit){ ?>
								<td style="text-align: left;"><a href="<?=$base_url.'/view/'.$row->form_id?>"><?=$row->inquiry_no.'-'.$row->job_sequence ?></a>
                                    <span class="chat-container"><i class="fa fa-comments-o fa-2x"></i><span class="chat-count"><?php echo isset($row->chat_count) && !empty($row->chat_count)?$row->chat_count:'0'?></span></span>
                                    
                                </td>
                                <?php }else{ ?>
                                    <td style="text-align: left;"><?=$row->inquiry_no.'-'.$row->job_sequence ?></td>
                                <?php } ?>
                                <td style="text-align: left;"><?=$row->card_name ?></td>
								<td style="text-align: left;"><?=ucwords($row->service_engineer)?></td>
                                <td style="text-align: left;"><?=ucwords($row->testing_engineer)?></td>
                                <td style="text-align: left;"><?=ucwords($row->quality_engineer)?></td>
                                <td style="text-align: left;"><?=ucwords($row->lead_engineer)?></td>
								
								<td style="text-align: left;"><?php echo isset($row->issue_date) && strtotime($row->issue_date)?date('d/m/Y',strtotime($row->issue_date)):'---' ?></td>
                                <td style="text-align: left;"><?php echo isset($row->issue_date) && strtotime($row->issue_date)?date('d/m/Y',strtotime($row->issue_date)):'---' ?></td>
								<td style="text-align: left;"><?=ucwords($row->sales_lead_name)?></td>
                                <td style="text-align: left;"><?=ucwords($row->service_lead_name)?></td>
                                <td style="text-align: left;">---</td>
                                <td style="text-align: left;">---</td>
                                <td style="text-align: left;">---</td>
                                <td style="text-align: left;">---</td>
                                <td style="text-align: left;"><?php echo $row->wo_received==1?'Yes':'No';?></td>
								<td>
                                    <?php if($view){ ?>
			                        <a href="<?=$base_url.'/view/'.$row->form_id?>" class=""> <i class="fa fa-eye"></i> </a> 
                                    <?php } ?>
                                    <?php if($edit){ ?>
			                        <a href="<?=$base_url.'/edit/'.$row->form_id?>" class=""> <i class="fa fa-pencil-square-o"></i> </a> 
                                    <?php } ?>
                                    <?php if($delete){ ?>    
									<a href="<?=$base_url.'/delete/'.$row->form_id?>"  class="" onclick=" return confirm('Are you really want to delete?')"> <i class="fa fa-trash-o"></i> </a>
                                    <?php } ?>
								</td>
						  	</tr>
						  	<?php }
							}else{
								echo "<tr><td style='color:red;text-align:center' colspan='18'>No record found</td></tr>";
							}?>
						</tbody>
	                </table>
					<div class="span8" style="float:right;margin-top: 8px; margin-right: -23px;" >
						<ul class="pagination" style="float: right;"><?=$pagination_link?></ul>
					</div>

				</span>
				<input type="hidden" name="select_list" id="select_list" value="0">
          	</div>
      	</div><!-- End .box -->
  	</div><!-- End .span12 -->
</div><!-- End .row-fluid -->

<span id="reload"></span>

<script type="text/javascript">
var module_url = '<?=$module_url?>';
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
//===========================CloseCheck all==================//

//==============Delete Loan List==========================//

function delete_record()
{
    if(confirm("Are you sure to delete record"))
    {
        var delRow = new Array();
        $('.record_checkbox').each(function(i){
            if($(this).is(':checked')){
            	// alert($(this).val());
                delRow.push($(this).val());  
            }                               
        });
        // console.log(delRow);
        // return false;
        if(delRow.length>=1)
        {
            $.ajax({
                type:"POST",
                // data:{delRow:delRow},
                data:(token_name+'='+token_hash+'&delRow='+delRow),
                url: module_url+'/delete_records/',
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
        return false;
    }
}
//============Close Delete Loan List======================//
</script>


