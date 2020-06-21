  <script type="text/javascript">
        jQuery(document).ready(function ($) {
           $("#site_form").validate();           
        });
    </script>
    <style>
	p{
		line-height:30px;
	}
	label{
	 font-weight:600;
 }
</style> 
  <div class="row-fluid">

	<div class="span12">

		<div class="box">

			<div class="title">

				<h4>
					 <span><?=lang($action."_title");?>
					</span>
				</h4>

			</div>
			<div class="content">
                
                <?php echo get_flashdata();?>

                    
			<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('parent_group')?></label>
							<div class="row-fluid">
								<div class="span6">
								  <?php if(!empty($groups->name)){ ?>
								<p><?= ucwords($groups->name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
								</div>
							</div>
						</div>
					</div>
					
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="focusedInput"><?=lang('name')?></label>
							   <?php if(!empty($result->name)){ ?>
								<p><?= ucwords($result->name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>
					
				</div>
			
					
					
					
			<div class="form-row row-fluid">
				<div class="span6">
					<div class="row-fluid">
					<label class="form-label span4" for="normal"><?=lang('description')?></label>
					    <?php if(!empty($result->description)){ ?>
								<p><?= ucwords($result->description); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
					</div>
				</div>
					
				<div class="span6">
					<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('status')?></label>
						<div class="row-fluid">
						  <div class="span6">
							<?php if(!empty($result->status)){ ?>
								<p><?= ucwords($result->status); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						  </div>
					    </div>
					</div>
				</div>
					
			</div>
				<div class="center" style="margin-top:30px">
					<a href="javascript: history.back()" class="btn" style="margin-right:10px;"><span class="icon16 typ-icon-back"></span>Go back</a> 
                </div>
				
					
				</div>
				
				




				

			</div>

		</div>
		<!-- End .box -->

	</div>
        