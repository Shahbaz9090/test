<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>E-Rookie admin</title>
  
  
    <link href="<?=PUBLIC_URL?>css/bootstrap/bootstrap.css" rel="stylesheet" />
    <link href="<?=PUBLIC_URL?>css/bootstrap/bootstrap-responsive.css" rel="stylesheet" />
    <link href="<?=PUBLIC_URL?>css/supr-theme/jquery.ui.supr.css" rel="stylesheet" type="text/css"/>
    <link href="<?=PUBLIC_URL?>css/icons.css" rel="stylesheet" type="text/css" />
    <link href="<?=PUBLIC_URL?>plugins/uniform/uniform.default.css" type="text/css" rel="stylesheet" />

    <!-- Main stylesheets -->
    <link href="<?=PUBLIC_URL?>css/main.css" rel="stylesheet" type="text/css" /> 

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if lt IE 9]>
        <link type="text/css" href="<?=PUBLIC_URL?>css/ie.css" rel="stylesheet" />
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?=PUBLIC_URL?>images/apple-touch-icon-144-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?=PUBLIC_URL?>images/apple-touch-icon-114-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?=PUBLIC_URL?>images/apple-touch-icon-72-precomposed.png" />
    <link rel="apple-touch-icon-precomposed" href="<?=PUBLIC_URL?>images/apple-touch-icon-57-precomposed.png" />

    </head>
      
    <body class="loginPage">
    
    
    
    <?php echo form_open_multipart(current_url(),array('id'=>'login_form')); ?>

    <div class="container-fluid">

        <div id="header">

            <div class="row-fluid">

                <div class="navbar">
                    <div class="navbar-inner">
                      <div class="container">
                            <a class="brand" href="<?php echo SITE_PATH;?>">E-Rookie<span class="slogan">Admin</span></a>
                      </div>
                    </div><!-- /navbar-inner -->
                  </div><!-- /navbar -->
                

            </div><!-- End .row-fluid -->

        </div><!-- End #header -->

    </div><!-- End .container-fluid -->    

    <div class="container-fluid">
	
        <div class="loginContainer"> 
			<?php
			   $success=$this->session->flashdata("success");	
			   if($success){
			?>
			 <div style="color:green;padding:3px;border:1px forestgreen solid;">
				 <?=$success;?>
			  </div>
			<?php }?>
              <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal')); ?>
                <div class="form-row row-fluid">
                    <div class="span12">
                        <div class="row-fluid">
                            <label class="form-label span12" for="email">Enter Email Address:</label>
                            <input class="span12 required email" type="text" name="email" />
                            <span class="forgot" style="margin-right: 0px;"><a href="<?php echo base_url('auth/login')?>">Login</a></span>
                        </div>
                    </div>
                </div>
                <div class="form-row row-fluid">                       
                    <div class="span12">
                        <div class="row-fluid">
                            <div class="form-actions">
                            <div class="span12 controls">
                             <div class="error" style="color:red"><?=$error_msg?></div>							   
                                <button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 white"></span>Submit</button>
                            </div>					

                            </div>
                        </div>
                    </div> 
                </div>

            </form>
        </div>

    </div><!-- End .container-fluid -->

    <!-- Le javascript
    ================================================== -->
    <!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script> -->
	<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="<?=PUBLIC_URL?>js/bootstrap/bootstrap.js"></script>  
    <script type="text/javascript" src="<?=PUBLIC_URL?>plugins/uniform/jquery.uniform.min.js"></script>

     <script type="text/javascript">
        // document ready function
        $(document).ready(function() {
            $("input, textarea, select").not('.nostyle').uniform();
        });
    </script>
    
 
 
    </body>
</html>
