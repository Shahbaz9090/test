        <?php  $this->load->view('elements/header'); ?>
		<!-- /section:basics/navbar.layout -->
		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

            <?php  $this->load->view('elements/left_sidebar'); ?>
			<!-- /section:basics/sidebar -->
			<div class="main-content">
				<!-- #section:basics/content.breadcrumbs -->
				<div class="breadcrumbs" id="breadcrumbs">
					<script type="text/javascript">
						try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
					</script>

					<ul class="breadcrumb">
                        <li>
							<i class="ace-icon fa fa-home home-icon"></i>
							<a href="<?=base_url('dashboard');?>">Home</a>
						</li>
                        <?php
                             if(isset($breadcrumb)):    
                             foreach($breadcrumb as $k=>$v):
                        ?>
						<li>
							<i class="ace-icon <?php  echo $v['icon'];  ?>"></i>
							<?php if($v['status'] == 'active') { ?><a href="<?php echo $v['link']  ?>"><?php echo $k;  ?></a><?php }else{ echo $k; }  ?>
						</li>
                        <?php endforeach; endif;   ?>
					</ul><!-- /.breadcrumb -->


					<!-- #section:basics/content.searchbox -->
					<!--<div class="nav-search" id="nav-search">
						<form class="form-search">
							<span class="input-icon">
								<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
								<i class="ace-icon fa fa-search nav-search-icon"></i>
							</span>
						</form>
					</div>--><!-- /.nav-search -->

					<!-- /section:basics/content.searchbox -->
				</div>

				<!-- /section:basics/content.breadcrumbs -->
				<div class="page-content">
                    	<!-- #section:settings.box -->
					<?php echo $this->load->view('elements/lower_header');  ?>
				    <?php   echo $this->load->view($page); ?>
				</div><!-- /.page-content -->
			</div><!-- /.main-content -->

<?php   $this->load->view('elements/footer');  ?>