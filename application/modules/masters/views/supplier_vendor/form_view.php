<style>
	p{
		line-height:30px;
	}
	label{
	 font-weight:600;
	}
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->

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
			
			
				<?php echo get_flashdata();?>
				
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('name')?></label>
						      <?php if(!empty($result->name)){ ?>
								<p><?= ucwords($result->name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
				</div>
					
				<div class="center" style="margin-top:30px">
                <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
                
            </div>
				

			</div>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>
<!-- End .row-fluid -->

