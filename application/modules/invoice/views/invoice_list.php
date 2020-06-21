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
								<th>S.N</th>
								<th>Invoice No</th>
								<th>Product</th>
                                <th>From</th>
                                <th>To</th>
								<th>Date</th>
                                <th>Status</th>
								<th style="width: 60px;">Action</th>
						  	</tr>
						</thead>
						<tbody>
                            <tr>
                                <td>
                                    <input type="checkbox" value="" class="record_checkbox"/>
                                </td>
                                <td>1</td>
                                <td><a href="<?=$module_url.'/view/1'?>" class="">INV00025</a></td>
                                <td><span class="label label-info">50</span></td>
                                <td>Sales Spare</td>
                                <td>Sales Governing</td>
                                <td>10/10/2020</td>
                                <td><span class="label label-success">Created</span></td>
                                <td>
                                    <a href="<?=$module_url.'/view/1'?>" class=""> <i class="fa fa-eye"></i> </a> 
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="checkbox" value="" class="record_checkbox"/>
                                </td>
                                <td>2</td>
                                <td><a href="<?=$module_url.'/view/2'?>" class="">INV00026</a></td>
                                <td><span class="label label-info">50</span></td>
                                <td>Sales Spare</td>
                                <td>Sales Governing</td>
                                <td>10/10/2020</td>
                                <td><span class="label label-success">Created</span></td>
                                <td>
                                    <a href="<?=$module_url.'/view/2'?>" class=""> <i class="fa fa-eye"></i> </a> 
                                    
                                </td>
                            </tr>
                            
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


