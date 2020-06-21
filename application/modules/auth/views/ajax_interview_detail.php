<form  id="form-horizontal" method="post" action="">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header" style="10%">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h3 class="modal-title"><?=$result->job_order_id ?> - <?=$result->title?></h3>
				</div>
				<?php
					//pr($result);
				?>
				<div class="modal-body">
					<div class="row-fluid">						
						<div class="span12">
							<label class="span3"><strong>Job Title</strong></label>
							<div class="span9"><?=$result->title?></div>
						</div>						
					</div>
					<?php if($show_client){ ?>
						<div class="row-fluid">						
							<div class="span12">
								<label class="span3"><strong>Company Name</strong></label>
								<div class="span9"><?=$result->company_name?></div>
							</div>
						</div>
					<?php } ?>

					<?php if($show_client){ ?>
						<div class="row-fluid">						
							<div class="span12">
								<label class="span3"><strong>Client Name</strong></label>
								<div class="span9"><?=$result->contact_name?></div>
							</div>
						</div>
					<?php } ?>
					<div class="row-fluid">						
						<div class="span12">
							<label class="span3"><strong>Candidate Name</strong></label>
							<div class="span9"><?=$result->first_name." ".$result->last_name ?></div>
						</div>						
					</div>
					<div class="row-fluid">						
						<div class="span12">
							<label class="span3"><strong>Submitted By</strong></label>
							<div class="span9"><?=$result->user_fname." ".$result->user_lname?></div>
						</div>
					</div>

					<div class="row-fluid">						
						<div class="span12">
							<label class="span3"><strong>Interview Type</strong></label>
							<div class="span9">
								<?php
									$interviewType=array('1'=>'Tel','2'=>'F2F','3'=>'VC');
									foreach($interviewType as $k=>$v){
										if($k==$result->interview_type){
											echo $v;
										}
									}
								?>
							</div>
						</div>						
					</div>
					<div class="row-fluid">						
						<div class="span12">
							<label class="span3"><strong>Interview Date</strong></label>
							<div class="span9"><?=date("F d, Y",strtotime($result->interview_Date))?> <?=$result->Hours?>:<?=$result->Mint?> <?=viewTimeZone($result->time_zone)?></div>
						</div>
					</div>
					<div class="row-fluid">						
						<div class="span12">
							<label class="span3"><strong>Int. Comment</strong></label>
							<div class="span9"><?=$result->interview_comment?></div>
						</div>
					</div>

					

				</div>
				<div class="modal-footer" style="text-align: left;">
				   <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</form>