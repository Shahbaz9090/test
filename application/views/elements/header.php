<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title class="title<?php echo currentUserID(); ?>">Welcome - <?=get_user_data(currentUserID())->group_name;?></title>

		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/bootstrap.css" />
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/font-awesome.css" />
        <!-- Chosen Stylesheet -->
        <link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/chosen.css" />
        <!-- Chosen Stylesheet -->
        <!-- page specific plugin styles -->
        <link rel="stylesheet" href="<?php echo SITE_PATH;   ?>assets/css/jquery-ui.css" />

        <!-- Custom  Stylesheet -->
        <link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/style.css" />
        <!-- Chosen Stylesheet -->

		<!-- text fonts -->
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/ace-fonts.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/ace.css" class="ace-main-stylesheet" id="main-ace-style" />
        
        
        	<!-- custom css file -->
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/custom.css" />
        
        
        <!--------------Editable CSS--------------->
        <link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/bootstrap-editable.css" />


		<!--[if lte IE 9]>
			<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/ace-part2.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/ace-ie.css" />
		<![endif]-->
        
        <!-------------------- page specific plugin styles ---------------->
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/jquery-ui.custom.css" />
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/fullcalendar.css" />
        <!----------------------------------------------------------------->
        
        <link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/datepicker.css" />
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/daterangepicker.css" />
		<link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/bootstrap-datetimepicker.css" />


		<!-- ace settings handler -->
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace-extra.js"></script>

		<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/html5shiv.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/respond.js"></script>
		<![endif]-->
        	<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php  echo SITE_PATH;  ?>assets/js/jquery.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->
        
        <!--custom variables -------------->
        <script>
            var baseurl = '<?php echo base_url();?>';
            var sitePath = '<?php echo SITE_PATH ?>';
            var token_name = "<?=$this->config->item('csrf_token_name')?>";
            var token_hash = "<?php echo $this->security->get_csrf_hash(); ?>";
            //alert(baseurl);
            
            /********chosen*****************/
            $(function(){
                $('.chosen-select').chosen({allow_single_deselect:true});   
                
            });
            /*******************************/
        </script>
        
        
        <!--------------------------------->
        <link rel="stylesheet" href="<?php  echo SITE_PATH;  ?>assets/css/bootstrap-timepicker.css" />
     <!----------------this is reminder notification css--------------------->
	<style type="text/css">
	.alert-box {
		color:#555;
		border-radius:10px;
		font-family:Tahoma,Geneva,Arial,sans-serif;font-size:11px;
		padding:10px 36px;
		margin:10px;
		width: 36%;
        margin-left: 509px;
	}
	.alert-box span {
		font-weight:bold;
		text-transform:uppercase;
	}
	.notice {
		background:rgba(204, 96, 67, 0.28) url('<?=base_url();?>assets/images/notice.png') no-repeat 10px 50%;
		border:1px solid #8ed9f6;
		color:rgba(3, 18, 1, 0.56);
	}
	.cross{float:right;cursor:pointer;}
    </style>

	</head>

	<body class="no-skin">

		<!-- #section:basics/navbar.layout -->
		<div id="navbar" class="navbar navbar-default">
			<script type="text/javascript">
				try{ace.settings.check('navbar' , 'fixed')}catch(e){}
			</script>

			<div class="navbar-container" id="navbar-container">
				<!-- #section:basics/sidebar.mobile.toggle -->
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<!-- /section:basics/sidebar.mobile.toggle -->
				<div class="navbar-header pull-left">
					<!-- #section:basics/navbar.layout.brand -->
					<a href="<?=base_url('dashboard');?>" class="navbar-brand">
						<small>
							<img src="<?php echo SITE_PATH  ?>assets/img/logo2.png" height="20" />
							Tek Leads
						</small>
					</a>

					<!-- /section:basics/navbar.layout.brand -->

					<!-- #section:basics/navbar.toggle -->

					<!-- /section:basics/navbar.toggle -->
				</div>

				<!-- #section:basics/navbar.dropdown -->
				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">
						<!--<li class="grey">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-tasks"></i>
								<span class="badge badge-grey">4</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-check"></i>
									4 Tasks to complete
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Software Update</span>
													<span class="pull-right">65%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:65%" class="progress-bar"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Hardware Upgrade</span>
													<span class="pull-right">35%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:35%" class="progress-bar progress-bar-danger"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Unit Testing</span>
													<span class="pull-right">15%</span>
												</div>

												<div class="progress progress-mini">
													<div style="width:15%" class="progress-bar progress-bar-warning"></div>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">Bug Fixes</span>
													<span class="pull-right">90%</span>
												</div>

												<div class="progress progress-mini progress-striped active">
													<div style="width:90%" class="progress-bar progress-bar-success"></div>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See tasks with details
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>-->

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" id="notificationIcon" id="<?php echo currentUserID();   ?>" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important notificationCount<?php echo currentUserID(); ?>">
                                    0
                                
                                </span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-pink dropdown-menu dropdown-caret dropdown-close">
								
									<?php  _ajaxLayout(array('page'=>'notification/header_notification'));    ?>
								
							</ul>
						</li>
<!--
						<li class="green">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-envelope icon-animated-vertical"></i>
								<span class="badge badge-success">5</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-envelope-o"></i>
									5 Messages
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar">
										<li>
											<a href="#" class="clearfix">
												<img src="<?php  echo SITE_PATH;  ?>assets/avatars/avatar.png" class="msg-photo" alt="Alex's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Alex:</span>
														Ciao sociis natoque penatibus et auctor ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>a moment ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="<?php  echo SITE_PATH;  ?>assets/avatars/avatar3.png" class="msg-photo" alt="Susan's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Susan:</span>
														Vestibulum id ligula porta felis euismod ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>20 minutes ago</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="<?php  echo SITE_PATH;  ?>assets/avatars/avatar4.png" class="msg-photo" alt="Bob's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Bob:</span>
														Nullam quis risus eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>3:15 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="<?php  echo SITE_PATH;  ?>assets/avatars/avatar2.png" class="msg-photo" alt="Kate's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Kate:</span>
														Ciao sociis natoque eget urna mollis ornare ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>1:33 pm</span>
													</span>
												</span>
											</a>
										</li>

										<li>
											<a href="#" class="clearfix">
												<img src="<?php  echo SITE_PATH;  ?>assets/avatars/avatar5.png" class="msg-photo" alt="Fred's Avatar" />
												<span class="msg-body">
													<span class="msg-title">
														<span class="blue">Fred:</span>
														Vestibulum id penatibus et auctor  ...
													</span>

													<span class="msg-time">
														<i class="ace-icon fa fa-clock-o"></i>
														<span>10:09 am</span>
													</span>
												</span>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="ajax.html#page/inbox">
										See all messages
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>-->

						<!-- #section:basics/navbar.user_menu -->
						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">
								<img class="nav-user-photo" src="<?php  echo SITE_PATH;  ?>assets/avatars/user.jpg" alt="Jason's Photo" />
								<span class="user-info">
									<small>Welcome,</small>
									<?=ucwords(currentuserinfo()->first_name);?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="<?=SITE_PATH?>auth/change_password">
										<i class="ace-icon fa fa-cog"></i>
										Change Password
									</a>
								</li>

								<li>
									<a href="<?=SITE_PATH?>user/profile">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="<?=SITE_PATH?>auth/logout">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>

						<!-- /section:basics/navbar.user_menu -->
					</ul>
				</div>

				<!-- /section:basics/navbar.dropdown -->
			</div><!-- /.navbar-container -->
		</div>
<?php

$currUser = $userInfo = currentuserinfo();
//$currUser->id = '289';
$checkassignLead = checkassignLead($currUser->id);
if(!empty($checkassignLead)) {
$checkReminder = checkReminder();
//print_r($checkReminder);die;
$flag = 0;
$leadids = array();	
foreach($checkReminder as $data){
	//echo $data->lead_id;die;	
	$findAssignUser = assignUser($data->lead_id);
	if($findAssignUser->assigned_to==$currUser->id){
		$flag = 1;
		$leadids = $data->lead_id.'#';
	}
}
}
if($flag==1){
?>
		<div class="alert-box notice"><span>notice: </span>You have a reminder.Please click the right reminder icon to see details.<span class="cross" data="<?=@$leadids?>" id="cancel">&times;</span></div>
<?php } ?>
<script>
function goBack() {
    window.history.back()
}
</script>


<script>
function ajaxReminder(ids){
	//alert(ids);
	$.ajax({
	   type:"POST", 
	   url:"<?=base_url()?>dashboard/ajaxReminder/"+ids,
	   success:function(response){
		 //alert();
		 $(".alert-box").fadeOut("slow");
	   } 
	});
	return false;
}

$(function(){
$(document).on('click','#cancel',function(){
	var ids = $(this).attr("data");
	ajaxReminder(ids);
});              
});
</script>