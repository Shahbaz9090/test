<button class="btn btn-info" type="button" style="margin-bottom:5px;" data-toggle="modal" data-target="#locationModel" onClick="return companyLocation();"><span class="icon16 entypo-icon-info-circle white"></span>Add</button>
<table class="responsive table table-bordered">
	<thead>
	  <tr>
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