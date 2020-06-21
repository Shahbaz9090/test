<div class="grid_10" style="margin-left: 10px;">
 <?php echo get_flashdata();?>
</div>

<div class="row-fluid">
	<div class="span12">
		<?php echo get_flashdata();?>
		<div class="box">
			<div class="title">
				<h4>
					 <span>Set Location</span>
				</h4>
			</div>
			<div class="content">				
			   <span id="locationDiv">
			   <?php echo form_open_multipart(current_url(),array('id'=>'form')); ?>
				<div class="form-row row-fluid" id="ajax_location_refresh">
				 <button class="btn btn-info" type="button" style="margin-bottom:5px;" data-toggle="modal" data-target="#locationModel" onClick="return companyLocation('');"><span class="icon16 entypo-icon-info-circle white"></span>Add</button>
				 <table class="responsive table table-bordered">
				   <thead>
					  <tr>
					    <!-- <th  class="ch" width="3%">
							<input type="checkbox" name="allCheckbox" value="all" class="styled" id="allCheckbox"/>
						</th> -->
						<th width="7%">S.N</th>
						<th width="30%">Country</th>
						<th width="30%">Area Name</th>
						<th width="17%">Date</th>
						<th width="16%">Action</th>
					  </tr>
					 

					</thead>
					<tbody >
						<?php
						  if($company_locations){
							foreach($company_locations as $key=>$value){
						?>
							<tr>
								<!-- <td class="chChildren">
									<input type="checkbox" name="subCheck" id="subCheck_<?=$value->id?>" value="<?=$value->id?>"/>
								</td> -->
								<td><?=++$key?></td>
								<td>
									<?php
										if($value->country_id==1){
											echo "United State";
										}else{
											echo "India";
										}
									?>
								</td>						
								<td><?=$value->area_name?></td>
								<td><?=date("F d, Y",strtotime($value->modified_time))?></td>
								<td>
									<a href="javascript://" title="Edit Location" class="tip" data-toggle="modal" data-target="#locationModel" onClick="return companyLocation(<?=$value->id?>)"><i class="icon-pencil"></i></a>
									<a href="javascript://" title="Delete Location" class="tip" onClick="return deleteLocation(<?=$value->id?>)"><i class="icon-trash"></i></a>
								</td>
							</tr>
						<?php
							 }
						  }else{
						?>
						<tr><td colspan="5">No Location found.</td></tr>
						<?php
						  }
						?>
					</tbody>
                 </table>

				</div>
               <?php echo form_close(); ?>
			   </span>
            </div>
		</div>
		<!-- End .box -->
	</div>
	<!-- End .span12 -->
</div>
<!-- End .row-fluid -->
<span id="reload"></span>

<!-- Modal for Multiple Removal -->
	<div class="modal fade" id="locationModel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		 <?php echo form_open(base_url()."user/set_location",array("id"=>"form-horizontal")); ?>
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header" style="10%">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h3 class="modal-title">Set Company Location</h3>
					</div>
					<div class="modal-body">
						<div class="row-fluid">
							<span id="location_flash"></span>
							<div class="span12" id="ajax_location"></div>
						</div>
					</div>
					<div class="modal-footer" style="text-align: left;">
						<input type="hidden" name="list_item" id="list_item">
						<button class="btn btn-primary" type="button" onClick="return setCompanyLocation()">Submit</button>
						<span id="ajax_submit"></span>
					    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		<!-- </form> -->
	</div>
<!-- /.modal -->

<?php

function get_name($id=null,$type=null){
    if($type == 1){
        $table = "contactor";
    }else if($type==2){
        $table = "employee";
    }
    
    $CI->db->select('first_name, last_name');
    $CI->db->where('id' , $id);
    $query = $CI->db->get($table);
    if($query->num_rows()){
        return $query->row();
    }else{
        return false;
    }
    
}
