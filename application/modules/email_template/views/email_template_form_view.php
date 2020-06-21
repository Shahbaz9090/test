<style>
	.form-actions {
    /*padding: 5px 20px 5px;*/
    margin-top: 30px;
    text-align: left;
    margin-bottom: 20px;
    background-color: #ecf3f7;
    border-top: 1px solid #e5e5e5;
    *: ;
    zoom: 1;
	}
	h3 {
    font-size: 18px;
    line-height: 10px;
    padding-left: 10px;
    padding-top: 7px;
}

	p{
		line-height:30px;
	}
 label{
	 font-weight:600;
 }
</style>

<!-- Build page from here: Usual with <div class="row-fluid"></div> -->

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
					<div class="form-actions">
						<h3><?=lang('email_template')?></h3>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('category')?><em>*</em></label>
							  <?php if(!empty($result->category_name)){ ?>
								<p><?= ucwords($result->category_name); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>	
					<div class="span6">
						<div class="row-fluid">
							<label class="form-label span4" for="normal"><?=lang('name')?><em>*</em></label>
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
							<label class="form-label span4" for="normal"><?=lang('doc_notes')?><em>*</em></label>
							 <?php if(!empty($result->notes)){ ?>
								<p><?= ucwords($result->notes); ?></p>
								<?php }else{ ?>
								<p><?="N/A"?></p>
								<?php } ?>
						</div>
					</div>	
                    
                </div>
				
				<div class="center" style="margin-top:30px">
                <a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
                
            `	</div>
			</div>
		</div>
	</div>
</div>