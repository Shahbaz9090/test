<div class="row-fluid">
	<div class="span10">
		<div class="box">
			<div class="title">
				<h4>
					 <span><?=lang($action."_title");?>
					</span>
				</h4>
			</div>
			
			<div class="content">
					<div class="view_bg">
					  <div class="view_left span3"><?=lang('name')?></div>
					  <div class="view_right span7"><?=isset($result->name)?$result->name:'';?></div>
					</div>
					
					<div class="view_bg">
					  <div class="view_left span2"><?=lang('email')?></div>
					  <div class="view_right span9"><?=isset($result->email)?$result->email:'';?></div>
					</div>
					
					
					
					<div class="view_bg">
					  <div class="view_left span3"><?=lang('website')?></div>
					  <div class="view_right span7"><?=isset($result->website)?$result->website:'';?></div>
					</div>
					
					<div class="view_bg">
					  <div class="view_left span2"><?=lang('language')?></div>
					  <div class="view_right span9"><?=isset($result->language)?$result->language:'';?></div>
					</div>
					
					<div class="view_bg">
					  <div class="view_left span3"><?=lang('status_comment')?></div>
					  <div class="view_right span7"> <?=isset($result->status_comment)?$result->status_comment:'';?></div>
					</div>
					
								
					
					
					
								
								  <div class="center">
                <a href="javascript: history.back()" class="btn" style="margin-right:10px;"><span class="icon16 typ-icon-back"></span>Go back</a>
                
            </div>
				
					
				</div>
				
				




				

			</div>

		</div>
		<!-- End .box -->

	</div>
<!-- End .row-fluid -->

        