<link href="<?=PUBLIC_URL?>css/table.css" rel="stylesheet" type="text/css" />
<link href="<?=PUBLIC_URL?>css/main.css" rel="stylesheet" type="text/css" />  
<?php
$page_offset = 1;
$limit=20;
$total=$flexigrid['result']['total'];
$page=1;
$offset=1;

?>
 <style>
.table-bordered{
	margin-top: 0px;
}
.table th, .table td {
padding:3px 8px;
line-height: 18px;
text-align: left;
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
 </style>
 <?=get_flashdata()?>
 <?php  
 //pr($flexigrid);
 ?>
 <div class="row-fluid">	
	<div class="span12">		
		<div class="box">			
			<div class="title">
				<h4>
					<span class="icon16 brocco-icon-grid"></span> <span>Customer List</span>
                    <span class="grid-button"><div class="fbutton"><div>	<span onclick="performAction('add');" class="add"><span aria-hidden="true" class="cut-icon-plus-2 grid-list-icon"></span>Add</span></div></div><div class="btnseparator"></div><div class="fbutton"><div><span onclick="performAction('delete');" class="delete"><span aria-hidden="true" class="cut-icon-minus-2 grid-list-delete"></span>Delete</span></div></div><div class="btnseparator"></div><div class="fbutton"><div><span onclick="performAction('export');" class="export"><span aria-hidden="true" class="entypo-icon-export grid-list-export"></span>Export</span></div></div></span>
                    
                	<form action="" class="box-form right" style="margin-right: 7px; margin-top: 4px;">
                    
                     
                        <?php
                            $notification = _domain_notification();
                            if($notification){
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
               <div class="span9">
                    <div>
                    <label>
                    <span style="float: left;">
                    <select size="1"  class="input-mini nostyle" id="records" style="padding-top: 2px;height: 24px;">
                        <?php $recordSelect = _recordSelect();
                               foreach($recordSelect as $key=>$value): 
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
                    <label><form id="searchForm"  method="post" onsubmit="return false;"><input type="text"  autocomplete="off" class="span12" style="width:229px;margin-top: 4px;" id="searchBox"  placeholder="Email / Name / Id / Doamin / Country"/></form></label>
                    </div>
                </div>
              </div>
            <span id="ajax_replace">
                                    
				<table class="responsive table table-bordered draggable table-striped" id="dragdata1">
				   <thead>
					  <tr>
					  	<th id="sh"><?=lang('sn')?> <span id="sn" style="cursor: pointer;"><i class="iconic-icon-cog" style="color:#555;float: right;margin-top:2px;"></i></span>
                        <div class="relative-table">
                        
                         <div  id="checkbox_div" class="absolute-table">
                              <span class="table-close">&times;</span>
                              <input type="checkbox" name="checkBox" value="checkBox" class="scheckbox" ><input type="checkbox" /><br/>
					          <input type="checkbox" name="id" value="id" class="scheckbox " ><?=lang('customer_id')?><br/>
							    <?php
                                foreach($flexigrid['cols'] as $k=>$v){
                                ?>
        						 <input type="checkbox" name="<?=$v['name']?>" value="<?=$v['name']?>" class="scheckbox " ><?=$v['display']?><br/>
        						<?php
                                }
                                ?>
						</div>
                        </div></th>
                        <th id="all-checkbox" class="checkBox"><input type="checkbox" class="all-checkbox" /></th>
                        <?php
                        foreach($flexigrid['cols'] as $k=>$v){
                        ?>
						<th id="<?=$v['name']?>" class="order_by <?=$v['name']?>"><?=$v['display']?></th>
						<?php
                        }
                        ?>
						<th style="width: 10%;"><?='action'?></th>
					  </tr>
					</thead>
					<tbody>
						<?php
                            //pr($flexigrid);exit;
						  if($flexigrid['result']['result']){
							foreach($flexigrid['result']['result'] as $key=>$val){
						?>
							<tr id="row-<?=$val->id?>">								
								<td><?=++$key?></td>
                                <td class="checkBox"><input type="checkbox" class="single-checkbox" id="single-checkbox-<?=$val->id?>" /></td>
								 <?php
                        foreach($flexigrid['cols'] as $k=>$v){
                        ?>
						<td class="<?=$v['name']?>"><?=word_limiter($val->$v['name'],3)?></td>
						<?php
                        }
                        ?>
								    

								<td>
									<a title="Verify" data-toggle="modal" data-target="#myModal1" class="tip view" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-eye-open"></i></a>
                                  		 <a title="Create" rel="" class="tip  create" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-hand-right"></i></a>
								
								         <a title="Create" rel="" class="tip create" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-hand-right"></i></a>
									
                                       <a title="In Process" dir="<?=$val->id?>" data-toggle="modal" data-target="#myModal" class="tip in-process" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-comment"></i></a>
								       <a title="Delete" class="tip delete-customer" id="<?=$val->id?>" style="cursor:pointer;" ><i class="icon-trash"></i></a>
								
								</td>
                                 
							</tr>
						<?php
							 }
						  }else{
						?>
						<tr><td colspan="10">No Customer found.</td></tr>
						<?php
						  }
						?>
					</tbody>
                 </table>
                 <div class="row-fluid">
                    <div class="span8">
                        <div class="dataTables_info" id="sample_1_info">
                        Showing <?php 
                        if($page_offset>0){
                             echo ($limit*($page_offset-1))+1; 
                        }else{
                            echo 1;
                        }
                        ?> to <?php 
                        if($page_offset<1){
                            if($limit > $total){
                                echo $total;
                            }else{
                                echo $limit;   
                            }
                        }elseif($limit*$page_offset < $total){
                            echo ($limit*$page_offset);
                        }elseif(@$hiddenLimit>0){
                            echo $total;
                        }else{
                            echo $total;
                        }
                        
                        ?> of <?=$total?> entries</div>
                    </div>
                    <div  class="span2"><span class="go-to-page">Go To Page</span>
                        <form onsubmit="changePagination(page.value);return false;">
                            <input type="number" name="page" value="<?=$page_offset?>" min="1" max="<?=ceil($total/$limit)?>" style="width:40px; height:17px; float: right;padding:4px 5px;margin-top: 1px;" placeholder="Page"   />
                        </form>
                    </div>
                    
                    <div class="span2">
                         <?php
        					$data['page_offset'] = $page_offset; 
        					$data['limit'] = $limit;
        				    $data['total'] = $total;
        				    $data['page'] = $page;
        					echo $this->load->view("kg_grid/ajax_pagination",$data);
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
            <span id="comment"></span>
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
             
             
             <?php foreach($notification as $key=>$val) { ?>
                <div  title="Click to expand <?=$val->Domain?>" class="tip domain_user row-fluid" id="<?=$val->id?>" dir="<?=$val->Domain?>" style="cursor: pointer;">
                    <div class="span6"><b><?php  echo $val->Domain ?></b></div>
                    <div class="span6"><?php  echo $val->Total ?></div>
                </div>
                <span   class="doamin_users<?=$val->id?> row-fluid" id="<?=$val->id?>" dir="<?=$val->Domain?>"></span>
                <input type="hidden" id="domain_hidden<?=$val->id?>" value="1" />
             <?php } ?>
             
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
    
    $(".in-process").click(function(){
        var id=$(this).attr("dir");
        $("#comment_id").val(id);
        var datastring = token_name+"="+token_hash+"&id="+id;
        $.ajax({
				type:"POST",
				data: datastring,
				url:"<?php echo base_url();?>customer/ajax_update_comment",
			    success: function(response){
					$("#comment").html(response);
				}
		});	
    });
    
    $("#save_comment").click(function(){
        var id=$("#comment_id").val();
        var comment=$("#comment_input").val();	
     	var datastring = token_name+"="+token_hash+"&comment="+comment+"&id="+id;
        $.ajax({
				type:"POST",
				data: datastring,
				url:"<?php echo base_url();?>customer/ajax_update_comment/1",
				success: function(response){
                    //$("#comment_td"+id).html(response);
                    $('#myModal').modal('toggle');
                    $("#comment_input").val('');
				}
		});
    });
    
    $(".create").click(function(){
        var id=$(this).attr('id');	
        //alert(id);exit;
        var val = confirm("Do you want to create this user?");
        if(val){
            var datastring = token_name+"="+token_hash+"&id="+id;
            $.ajax({
    				type:"POST",
    				data: datastring,
    				url:"<?php echo base_url();?>customer/ajax_create",
    				success: function(response){
                        $("#row-"+id).remove();
    				}
    		});
        }else{
            return false;
        }
     	
    });
    
     $(".view").click(function(){
        var id=$(this).attr('id');	
     	var datastring = token_name+"="+token_hash+"&id="+id;
        $.ajax({
				type:"POST",
				data: datastring,
				url:"<?php echo base_url();?>customer/ajax_view",
				success: function(response){
                    $("#view").html(response);
				}
		});
    });
    
    $(".delete-customer").click(function(){
        var id=$(this).attr('id');	
        var val = confirm('Do you want to continue?');
        if(val){
           var datastring = token_name+"="+token_hash+"&id="+id;
           $.ajax({
    				type:"POST",
    				data: datastring,
    				url:"<?php echo base_url();?>customer/ajax_delete",
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
				url:"<?php echo base_url();?>customer/ajax_domain_user",
                beforeSend:function(){
                    $(".doamin_users"+id).html('<div style="height:30px;"><img src="<?php echo PUBLIC_URL;?>images/loaders/ajax_preloader.gif"  width="20px"></div>');
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
<input type="hidden" id="hiddenLimit" value="<?=@$hiddenLimit?>" />
<input type="hidden" id="order_by" value="<?='id'?>" />
<input type="hidden" id="order" value="<?='DESC'?>" />

<script>
var controller = "<?=$controller?>";
var sitePath = "<?=SITE_PATH?>";
var option_array = "";

</script>


<script type="text/javascript" src="<?=PUBLIC_URL?>js/kg.datagrid/main.js"></script>
