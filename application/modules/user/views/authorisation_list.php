<script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script>
<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />


<div class="row-fluid">
	<div class="span12">
	 <?php echo get_flashdata();?>
       <div class="box">
            <div class="title">
                <h4>
                    
					<span id="list_by">Total Number Of Users</span>
					
                    <div class="btn-group right" data-toggle="buttons-radio" style="padding-right:75px;top:-5px;">
						<button class="btn btn-goback" id="button_type_0" value="0" style="color:#ffffff">Uncategoriesed</button>
						<button class="btn btn-goback" id="button_type_1" value="1">Network IP Based</button>
						<button class="btn btn-goback" id="button_type_2" value="2">System IP Based</button>
						<button class="btn btn-goback" id="button_type_3" value="3">Non IP Based</button>
					</div>

                </h4>
				<a href="#" class="minimize">Minimize</a>
			</div>    
			<div class="content noPad" >
            <div class="row-fluid" style="padding: 7px 0px 0px 0px;" id="search">
                <div class="span3" style="float: right;">
                    <input type="text" placeholder="search" id="search_keyword" />
                </div>
            </div>
				<span id="ajax_replace">
				<table class="responsive table table-bordered">
					<thead>
					  <tr  id="removeAll" style="display:none;">
					    <td colspan="7">
							<button class="btn btn-info" data-toggle="modal" data-target="#myModal">
								<span class="icon16 icomoon-icon-loop white"></span> Remove
							</button>
						</td>
					  </tr>
					  <tr>
					    <th  class="ch" width="3%">
							<input type="checkbox" name="allCheckbox" value="all" class="styled" id="allCheckbox"/>
						</th>
						<th width="6%">S.N</th>
						<th width="14%">Employee Id</th>
						<th width="14%">First Name</th>
						<th width="12%">Last Name</th>
						<th width="14%">Email</th>
						<th width="25%">Designation</th>
						<th width="12%">Action</th>
					  </tr>
					 

					</thead>
					<tbody>
					<?php
						if($result){
							foreach($result as $key=>$rows){
					?>
					  <tr>
						<td class="chChildren">
							<input type="checkbox" name="subCheck" value="<?=$rows->id?>" class="styled cdCheckbox_<?=$rows->id?>" id="subCheck" onclick="chk(<?=$rows->id?>)"/>
						</td>

						<td ><?=$key+1?></td>
						<td><?=$rows->employee_id?></td>
						<td><?=$rows->first_name?></td>
						<td><?=$rows->last_name?></td>
						<td><?=$rows->email?></td>
						<td>
							<?php
								$group=getAssignGroup($rows->group_id);
								echo @$group->name;
							?>
						</td>
						<td>
							<div class="controls center">
							
							<button href="javascript://" id="single_<?=$rows->id?>" onClick="singleId(<?=$rows->id?>)" value="2" class="btn btn-info" data-toggle="modal" data-target="#myModal1"><span class="icon16 icomoon-icon-loop white"></span> Authorize</button>
								
							</div>
						</td>
					  </tr>
					  <?php
							}
						}else{
							echo "<tr><td colspan='7'>No records found</td></tr>";
						}
					  ?>
					</tbody>
                 </table>
				 <div class="span8" style="float:right;margin-top: 8px; margin-right: -23px;" >
					<ul class="pagination" style="float: right;"><?=$links?></ul>
				 </div>

				</span>
				<input type="hidden" name="select_list" id="select_list" value="0">
              </div>
          </div><!-- End .box -->
      </div><!-- End .span12 -->
 </div><!-- End .row-fluid -->


<span id="reload"></span>

<!-- Modal for Multiple Removal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form  id="form-horizontal" method="post" action="<?=SITE_PATH?>user/authorisation/edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="10%">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title" >User Authorise Panel Setting</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span12" id="responseDiv">		
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span3" for="rec_subject"><h4 class="black">Login On</h4></label>
							<select name="login_type" class="span5 nostyle" id="login_type" >
								<option value=''>Select</option>
								<option value="1">Network IP Based</option>
								<option value="2">System IP Based</option>
								<option value="3">Non IP Based</option>
							</select>
						</div>
					</div>
					<div class="row-fluid" style="display:none;" id="static_ip_based">
						<div class="span12">
							<label class="span3" for="rec_subject"><h4>Network IP</h4></label>
							<input type="text" name="static_ip" class="span5" id="static_ip">
						</div>
					</div>
					<div class="row-fluid" style="display:none;" id="ip_based">
						<div class="span12">
							<label class="span3" for="rec_subject"><h4>System IP</h4></label>
							<input type="text" name="ip" class="span5" id="ip">
						</div>
					</div>
				</div>
				<div class="modal-footer" style="text-align: left;">
				   <input type="hidden" name="users_id" id="users_id" value="">
				   <input type="hidden" name="multi_update" id="multi_update" value="1">
				   <button type="button" class="btn btn-primary" id="submit_btn">Submit</button>
				   <span id="ajax_loader"></span>
				   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
				<span id="redirectDiv" style="padding-left:25px;color:green;font-weight:bold;"></span>  
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>
</div><!-- /.modal -->

<!-- Modal for Single Removal -->

<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<form  id="form-horizontal-mail" method="post" action="<?=SITE_PATH?>user/authorisation/edit">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="10%">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title">User Authorise Panel</h3>
				</div>
				<div class="modal-body">
					<div class="row-fluid">
						<div class="span12" id="responseDiv_single">		
						</div>
					</div>
					<div class="row-fluid">
						<div class="span12">
							<label class="span3" for="rec_subject"><h4>Login On</h4></label>
							<select name="login_type" class="span5 nostyle" id="login_type_single" >
								<option value=''>Select</option>
								<option value="1">Network IP Based</option>
								<option value="2">System IP Based</option>
								<option value="3">Non IP Based</option>
						  </select>
						</div>
					</div>
					<div class="row-fluid" style="display:none;" id="static_ip_based_single">
						<div class="span12">
							<label class="span3" for="rec_subject"><h4>Network IP</h4></label>
							<input type="text" name="static_ip" class="span5" id="static_ip_single">
						</div>
					</div>
					<div class="row-fluid" style="display:none;" id="ip_based_single">
						<div class="span12">
							<label class="span3" for="rec_subject"><h4>System IP</h4></label>
							<input type="text" name="ip" class="span5" id="ip_single">
						</div>
					</div>

				</div>
				<div class="modal-footer" style="text-align: left;">
				   <input type="hidden" name="unique_value" id="unique_value" value="">
				   <button type="button" class="btn btn-primary" id="submit_btn_single">Submit</button>
				   <span id="ajax_loader_single"></span>
				   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
				<span id="redirectDiv_single" style="padding-left:25px;color:green;font-weight:bold;"></span>  
			</div> <!-- /.modal-content -->
		</div> <!-- /.modal-dialog -->
	</form>
</div>

<!--Ajax search starts -->
<script>
    $( document ).ready(function() {
  // Handler for .ready() called.
    $("#search_keyword").keyup(function(){
        var keyword = $("#search_keyword").val();
        keyword = keyword.toLowerCase().replace(/\b[a-z]/g, function(letter) {
            return letter.toLowerCase();
        });
        var list_type=$("#select_list").val();
    	$.ajax({				
				data:token_name+"="+token_hash+"&keyword="+keyword+"&login_type="+list_type,
				type:"post",
				url: "<?php echo SITE_PATH;?>user/authorisation/ajax_list_items/",
				beforeSend : function(){					
				    //beforeAjaxResponse();
				},
				success: function(data){
				$("#ajax_replace").html(data);
                afterAjaxResponse();
				}
		});
    });
    
    });

</script>

<!--Ajax search starts -->


