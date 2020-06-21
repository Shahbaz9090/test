<!-- BEGIN CONTENT -->
<script src="<?php echo base_url().'assets/admin/layout/scripts/common_functions.js'?>"></script>
<div class="page-content-wrapper">
	<div class="page-content">
		<div class="page-head">
            
		</div>
		<!-- END PAGE HEAD -->
		<!-- BEGIN PAGE BREADCRUMB -->
		<ol class="page-breadcrumb breadcrumb">
			<?php if(isset($header['bread_cum']))
			{ 
				print_r($header['bread_cum']); 
			} ?>
		</ol>
		<!-- END PAGE BREADCRUMB -->
		<!-- END PAGE HEADER-->
		<!-- BEGIN PAGE CONTENT-->
		<div id="content">
			<div class="row ">
				<div class="col-md-12">
					<!-- BEGIN SAMPLE FORM PORTLET-->
					<div class="portlet box yellow">
						<div class="portlet-title">
							<div class="caption" style="width: 100%;">
								List Suppost
								<span style="float: right; margin-right: 10px;" >
									<div class="icon-bg pull-left btn btn-success btn-sm"><a class="color-white" href="<?php echo base_url();?>form_module/add"><i class="fa fa-plus-circle"></i> Add</a></div>
									
								</span>  
							</div>
						</div>
						<div class="portlet-body">
							<div><?php echo get_flashmsg(); ?></div>
							<?php echo form_open('', 'method="post"'); ?>
								<div class="row">
									<div class="col-md-6">
										<div class="show-left">Show</div>
										<div class="col-md-3">
											<select class="form-control" id="perpage" name="perpage">
												<option value="10">10</option>
												<option value="20">20</option>
												<option value="30">30</option>
												<option value="50">50</option>
												<option value="100">100</option>
												<option value="1">All</option>
											</select>
										</div>
										<div class="show-right">Rows</div>
									</div>
                                    <div class="col-md-6">
										<div class="col-md-5 pull-right">
										<input type="text" name="search" id="search" class="form-control" placeholder="Search" /> </div>
                                    </div>
								</div>
							<?php echo form_close();  ?>
							<div class="row">   
								<div class="col-md-12">
									<div class="table-responsive confirms margin-sm-top" id="gridlisting">
										<!-- async hit comes here -->
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- END SAMPLE FORM PORTLET-->
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT-->
	</div>
</div>
<!-- END CONTENT -->
