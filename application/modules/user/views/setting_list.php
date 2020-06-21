<script type="text/javascript" src="<?=PUBLIC_URL?>js/custom.js"></script>
<link href="<?=PUBLIC_URL?>css/custom.css" rel="stylesheet" type="text/css" />
<div class="row-fluid">
	<div class="span12">
	 <?php echo get_flashdata();?>
       <div class="box">
            <div class="title">
                <h4>
                    
					<span id="list_by">User Setting</span>
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
					  <!-- <tr>
					    <td colspan="7">
							<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="removeAll" style="display:none;">
								<span class="icon16 icomoon-icon-loop white"></span> Remove
							</button>
						</td>
					  </tr> -->
					  <tr>
					    <th class="ch" width="3%">
							<input type="checkbox" name="allCheckbox" value="all" class="styled" id="allCheckbox"/>
						</th>
						<th width="6%">S.N</th>
						<th width="14%">First Name</th>
						<th width="12%">Last Name</th>
						<th width="28%">Email</th>
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
								<a href="javascript://" title="Set Submission" class="tip" data-toggle="modal" data-target="#commonModel" onClick="return setTarget(<?=$rows->id?>)">Edit</a>
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

				 <div class="span8" style="float:right;margin-top: 8px; margin-right: -5px;" >
					<?php
						$data['page_offset'] = $page_offset; 
						$data['limit'] = $limit;
						$data['total'] = $total;
						$data['page'] = $page;
						echo $this->load->view("ajax_setting_pagination",$data);
					?>
				 </div>

				 <!-- <div class="span8" style="float:right;margin-top: 8px; margin-right: -23px;" >
					<ul class="pagination" style="float: right;"><?=$links?></ul>
				 </div> -->

				</span>
				<input type="hidden" name="select_list" id="select_list" value="0">
              </div>
          </div><!-- End .box -->
      </div><!-- End .span12 -->
 </div><!-- End .row-fluid -->
<span id="reload"></span>

<!--Ajax search starts -->
<script type="text/javascript">
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
				url: "<?php echo SITE_PATH;?>user/setting/ajax_list_items",
				beforeSend : function(){					
				    //beforeAjaxResponse();
				},
				success: function(data){
				$("#ajax_replace").html(data);
                afterAjaxResponse();
				}
		});
    });

	$("#form-horizontal-submission").validate({
				rules: {
					submission:"required",
					rec_message:"required"
				},
				messages: {
					submission: "Please enter mail subject",
					rec_message: {
						required: "Please enter your body of mail"
					}
				}
			});

    
    });


</script>

<!--Ajax search starts -->


