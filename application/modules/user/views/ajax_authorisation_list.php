
				<table class="responsive table table-bordered">
					<thead>
					  <tr>
					    <td colspan="7">
							<button class="btn btn-primary" data-toggle="modal" data-target="#myModal" id="removeAll" style="display:none;">
								<span class="icon16 icomoon-icon-loop white"></span> Remove
							</button>
						</td>
					  </tr>
					  <tr>
					    <th  class="ch" width="3%">
							<input type="checkbox" name="allCheckbox" value="all" class="styled" id="allCheckbox" onClick="allCheck()" />
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
							//pr($result);
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
								echo $group->name;
							?>
						</td>
						<td>
							<div class="controls center">
							<button href="javascript://" id="single_<?=$rows->id?>" onClick="singleId(<?=$rows->id?>)" value="2" class="btn btn-info" data-toggle="modal" data-target="#myModal1"><span class="icon16 icomoon-icon-loop white"></span> Remove</button>
								
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
						echo $this->load->view("ajax_pagination_view",$data);
					?>
				 </div>