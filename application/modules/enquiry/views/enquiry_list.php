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

$add        = false;

$delete     = false;

$export     = false;

$view       = false;

$edit       = false;



// pr($permission);die;

// pr($dynamic_module_name);die;

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

                         

						<div class="fbutton">

							<div>

								<a href="<?=$base_url?>/add" class="add"><span aria-hidden="true" class="cut-icon-plus-2 grid-list-icon"></span>Add</a>

							</div>

						</div>

                        

                         

                 		<div class="btnseparator"></div>

                 		<div class="fbutton">

                 			<div>

                 				<span onclick="return delete_record()" class="delete">

                 					<span aria-hidden="true" class="cut-icon-minus-2 grid-list-delete"></span>Delete

                 				</span>

                 			</div>

                 		</div>

                        

                        <div class="btnseparator"></div>

                        <div class="fbutton">

                            <div>

                                <span onclick="export_data()" class="export">

                                    <span aria-hidden="true" class="entypo-icon-export grid-list-export"></span>Export

                                </span>

                            </div>

                        </div>

                        

					</span>

                </h4>

				<a href="#" class="minimize">Minimize</a>

			</div>    

			<div class="content" >

	            <div class="row-fluid" style="padding: 7px 0px 0px 0px;" id="search1">

	                <div class="span5 dataTables_filter" style="float: right;">

	                    <form name="search_form" method="GET" action="<?=current_url()?>">

                            Unread chat Enquiry<input <?php echo isset($_GET['unread']) && $_GET['unread']==1?'checked':'' ?> type="checkbox" name="unread" value="1" onchange="search_form.submit()">

                            <input style="width: 190px;" type="text" placeholder="Search" name="search_keyword" value="<?=isset($_GET['search_keyword']) && !empty($_GET['search_keyword'])?$_GET['search_keyword']:''?>" /> 

                            <button type="button" style="margin-top: -10px;" class="btn btn-primary" onclick="window.location.href='<?=current_url()?>'"><i class="fa fa-refresh"></i></button>

                        </form>

	                </div>

	            </div>

				<span id="ajax_replace">

					<table class="responsive table table-bordered">

						<thead>

						  	<tr>

							    <th  class="ch" width="3%">

									<input type="checkbox" name="allCheckbox" value="all" class="checkall">

								</th>

								<th>S.N</th>

								<th>Action</th>
								<th>Enq. No.</th>

                                <?php if($is_india){ ?>

								<th>Client Name</th>

                                <?php } ?>

								<th>RFQ/PR No.</th>
                                <th>Internal Subject</th>

								<th>From Client</th>

								<th>Inch Engineer</th>

								<th>CFIT Engineer</th>

								<th>India Status</th>

                                <th>China Status</th>

								<th>Inch</th>

								<th>CFIT</th>

								<th>To Client</th>


						  	</tr>

						</thead>

						<tbody>

							<?php

							if(isset($data_list) && !empty($data_list)){

							$i = 1;

							foreach($data_list as $key => $row){?>

						  	<tr>

								<td>

									<input type="checkbox" name="subCheck" value="<?=$row->form_id?>" class="record_checkbox"/>

								</td>



								<td ><?=$i++?></td>
                                <td>

                                    <?php //if($view){ ?>

                                    <a href="<?=$base_url.'/view/'.$row->form_id?>" class="btn btn-xs btn-info"> <i class="fa fa-eye"></i> </a> 

                                    <?php //} ?>

                                    <?php //if($edit){ ?>

                                    <a href="<?=$base_url.'/edit/'.$row->form_id?>" class="btn btn-xs btn-success"> <i class="fa fa-pencil-square-o"></i> </a> 

                                    <?php // } ?>

                                    <?php //if($delete){ ?>    

                                    <a href="<?=$base_url.'/delete/'.$row->form_id?>"  class="btn btn-xs delete" onclick=" return confirm('Are you really want to delete?')"> <i class="fa fa-trash-o"></i> </a>

                                    <?php //} ?>

                                </td>
								<td style="text-align: left;"><a href="<?=$base_url.'/view/'.$row->form_id?>"><?=$row->enq_no?></a>

                                    <span class="chat-container"><i class="fa fa-comments-o fa-2x"></i><span class="chat-count"><?php echo isset($row->chat_count) && !empty($row->chat_count)?$row->chat_count:'0'?></span></span>

                                    

                                </td>

                                

                                <?php if($is_india){ ?>

								<td style="text-align: left;"><?=$row->client_name?></td>

                                <?php } ?>
                                <?php $pr_no = isset($row->rfq_pr_no)&& !empty($row->rfq_pr_no)?$row->rfq_pr_no:'---';?>
								<td style="text-align: left;" title="<?=$pr_no?>"><?=strlen($pr_no)>12?substr($pr_no,0,12).'...':$pr_no;?></td>
                                <td style="text-align: left;"><?=$row->internal_subject?></td>

								<td style="text-align: left;"><?php echo isset($row->from_client) && strtotime($row->from_client)>0?date('d/m/Y',strtotime($row->from_client)):'--/--/----' ?></td>

								<td style="text-align: left;"><?=$row->inch_name?></td>

								<td style="text-align: left;"><?=$row->cfit_name?></td>

                                

								<td style="text-align: left;"><span class="label label-info"><?=ucwords($row->status_name)?></span></td>

                                

                                <td style="text-align: left;"><span class="label label-info"><?=isset($row->china_status_name) && !empty($row->china_status_name)?ucwords($row->china_status_name):'N/A'?></span></td>

                                

                                <td style="text-align: left;"><?php echo isset($row->to_cfit) && strtotime($row->to_cfit)>0?date('d/m/Y',strtotime($row->to_cfit)):'--/--/----' ?></td>

								<td style="text-align: left;"><?php echo isset($row->from_cfit) && strtotime($row->from_cfit)>0?date('d/m/Y',strtotime($row->from_cfit)):'--/--/----' ?></td>

								<td style="text-align: left;"><?php echo isset($row->to_client) && strtotime($row->to_client)>0?date('d/m/Y',strtotime($row->to_client)):'--/--/----' ?></td>

								

						  	</tr>

						  	<?php }

							}else{

								echo "<tr><td style='color:red;text-align:center' colspan='13'>No enquiry found</td></tr>";

							}?>

						</tbody>

	                </table>

					<div class="span8" style="float:right;margin-top: 8px; margin-right: -23px;" >

						<ul class="pagination" style="float: right; width:172px;"><?=$pagination_link?></ul>

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



<script>

    var module_url  = '<?=($base_url)?>';

    function export_data(){

            var val = [];

            $("input[name='subCheck']:checked").each(function(i){

              val[i] = $(this).val();

            });

            var checkbox_id = val;

            //alert(checkbox_id);return false; 

            var search_keyword = $("input[name='search_keyword']").val();

            if(search_keyword!='' && search_keyword!=null && search_keyword!='undefined'){

                location.href= module_url+"/export?search_keyword="+search_keyword;

            }else{

                location.href= module_url+"/export/?checkbox_id="+checkbox_id;

            }

    };

    /*$('.pagination').click(function(){

            var val = [];

            $("input[name='subCheck']:checked").each(function(i){

              val[i] = $(this).val();

            });

            var checkbox_id = val;

            alert(checkbox_id);

            location.href= module_url+"/list-items/?checkbox_id="+checkbox_id;

    });*/

</script>

