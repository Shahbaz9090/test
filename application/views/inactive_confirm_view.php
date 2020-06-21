<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
		<title>E-rookie</title>
		<link type="text/css" rel="stylesheet" href="<?=PUBLIC_URL?>css/front/home.css"/>
		<link type="text/css" rel="stylesheet" href="<?=PUBLIC_URL?>css/front/mystyle.css"/>
		<link type="text/css" rel="stylesheet" href="<?=PUBLIC_URL?>css/front/responsive.css"/>
		<link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>css/front/style1.css" />
		<link rel="stylesheet" type="text/css" href="<?=PUBLIC_URL?>css/front/flexslider.css" />
	</head>
<body>
	<div class="main">
		<div class="wrapper">
			<!-------------------------------------------------Header-Start--------------------------->        
			<div class="header-left">
				<div class="logo"><a href="javascript:void(0)"><img src="<?=PUBLIC_URL?>images/logo.png"></a></div>
			</div>
			<div class="header-right">
				<div id="loginContainer">
					<?php 
					   $info=currentuserinfo();           
					   echo isset($info->id)? "<a href='javascript:void(0)' id='logoutButton'> <span> Welcome:  $info->first_name $info->last_name<div class='absoluteL'></div></span> </a>":'<a href="#" id="loginButton"><span> Click here to Login  <div class="absoluteL"></div></span></a>';
					 ?>
					<div style="clear:both"></div>
					<div id="loginBox">
						<?php echo form_open(current_url().'auth/login',array('id'=>'loginForm')); ?>
							<fieldset id="body">
								<fieldset>
									<label for="email">Email Address</label>
									<input type="text" name="email" id="email" class="required email"/>
								</fieldset>
								<fieldset>
									<label for="password">Password</label>
									<input type="password" name="password" id="password" />
								</fieldset>
								<input type="submit" id="login" value="Sign in" />   
							</fieldset>
							<span><a href="javascript://"  onClick="forget()">Forgot your password?</a></span>
						</form>
					</div>

					<div id="forgetBox" >
						<?php echo form_open(current_url().'auth/forget',array('id'=>'forgetForm')); ?>
							<fieldset id="body">
								<fieldset>
									<label for="email">Email Address</label>
									<input type="text" name="email_id" id="email_id" class="required email" />
								</fieldset>                            
								<input type="submit" id="login" value="Submit" />                            
							</fieldset>
							<span><a href="javascript://" onClick="login1()">Sign In?</a></span>
						</form>
					</div>

					<div id="logoutBox">         
						<form id="logoutForm">
							<fieldset id="body">
								<fieldset>
								 <?php
									if(isset($info->id)){
										$userData=currentUser(@$info->id);	
										$image=$userData->profile_image;
									}else{
										$image="no_image.jpeg";
									}
								?>
								<a href="dashboard"><img src="<?=PUBLIC_URL?>images/<?=$image?>" height="50"/></a>
								<span id="userName"><?=@$info->first_name." ".@$info->last_name?></span>
								</fieldset>
							</fieldset>
							<span><a href="dashboard" id="left">Dashboard</a> <a href="auth/logout" id="right">Logout</a></span>						
						</form>						
					</div>
				</div>
				<div  class="dropdown-menu"  id="user_account_div"   style="display: none;">
					<div class="LogClose" id="LogClose"><img src="<?=PUBLIC_URL?>images/dialog_close.ico" height="18" width="18" /></div>
					<div class="dropdown-caret right"> <span class="caret-outer"></span></div>
					<div class="FieldBg">
						<div class="FieldSetProfile-L">
							<div class="FieldSet">
								<?php
									if(isset($info->id)){
										$userData=currentUser(@$info->id);	
										$image=$userData->profile_image;
									}else{
										$image="no_image.jpeg";
									}
								?>
								<img src="<?=PUBLIC_URL?>images/<?=$image?>" height="40"/>
            				 </div>
						</div>
						<div class="FieldSetProfile-R">
							<div class="FieldSet">
								<b><?=@$info->first_name.' '.@$info->last_name?></b>
								<p><?=substr(@$info->email,0,24)?></p>
							</div>
						</div>
					</div>             
					<div class="FieldBg">
						<a href="dashboard">
							<input name="Sign in" type="button" value="Dashboard" id="Sign in" class="sign Field-L" />
						</a>   
						<a href="auth/logout"><input name="Sign in" type="button" value="Logout" id="Sign in" class="sign Field-R" /></a>
					</div>
				</div>
       
				<!--Account Box -->
				<div class="cl"></div>
        		<div class="navigation">
					<nav>
						<ul>
							<li><a href="javascript:void(0)">Home</a></li>
							<li><a href="javascript:void(0)">Solutions</a></li>
							<li><a href="javascript:void(0)">Services</a></li>
							<li><a href="javascript:void(0)">Pricing</a></li>
							<li><a href="javascript:void(0)">Resources</a></li>
							<li><a href="javascript:void(0)">Partners</a></li>
							<li><a href="javascript:void(0)">Enquiry</a></li>
						</ul>
					</nav><!-- end navi -->
				</div>
            <div class="header-right1">
				<select name="">
					<option>home</option> <option>home</option><option>home</option><option>home</option>
				</select>
			</div>
			<div class="cl"></div>            
         </div>
	<!-------------------------------------------------Header-End--------------------------->      		
      </div>
	  <div class="cl"></div>
	  <div class="gray"></div>

	
   
	<div class="cl"></div>  
	<!------------------------------------Mid-Container---------------------------->
	<div class="wrapper">
	  
  <div class="table-container">
  <div class="wrapper">
  
 <div style="padding:52px 0;float:left;width:100%;"> 
 <div style="width:14%;float:left;"><img src="<?=PUBLIC_URL?>images/confirm_image.png" width="100px" height="100px"/>  </div>
        <div style="width:86%;
float: left;
padding:34px 0;
font-size:24px;"> We got your request. You will no longer receive mail from us.</div>
<br /><a href="<?=SITE_PATH?>" style="color: #004080;">Back to home</a>
    </div>
   </div> 
  
  </div>
			
		</div>
		<div class="midcontainer-right">
	
	</div>
  </div>
 <div class="cl"></div>

<!-----------------------------Form------------------------------>
	<div class="wrapper">

 </div>
</div>
<!------------------------------------Mid-Container-End--------------------------->
</div>

<div class="footer-bg">
	<div class="wrapper">
		<div class="footer-box">
			<div class="footer"><h1>latest From The Blog</h1></div>
			<div class="cl"></div>
			<div class="footer"><p>We harmonize technique over technology to achieve the goals of user. </p>
				<p>We harmonize technique over technology to achieve the goals of user. We harmonize technique over technology to achieve the goals of user.</p>
				<p>We harmonize technique over technology to achieve the goals of user. </p>
			</div>
		</div>
		<div class="footer-box">
			<div class="footer"><h1>Follow Us</h1></div>
			<div class="footer-icon"><img src="<?=PUBLIC_URL?>images/rss-icon.png"/></div>
			<div class="footer-icon"><img src="<?=PUBLIC_URL?>images/twitter-icon.png"/></div>
			<div class="footer-icon"><img src="<?=PUBLIC_URL?>images/facebook-icon.png"/></div>
			<div class="footer-icon"><img src="<?=PUBLIC_URL?>images/youtube-icon.png"/></div>
			<div class="footer-icon"><img src="<?=PUBLIC_URL?>images/linked-in-icon.png"/></div>
		</div>
		<div class="footer-box">
			<div class="footer"><h1>Contact Us</h1></div>
			<div class="footer">
				<p>A-45, Sec-65 Noida, 201301, U.P
				India Off:- E-36/102, Vikas Marg
				New Delhi - 110092<br />
				
			</div>
		</div>
		<?php echo form_open(base_url()."newsletter/subscribe",array("id"=>"newsletter_form"))?>
			<div class="footer-box">
				<div class="footer"><h1>Join Our Newsletter</h1></div>
				<div class="footer"><p><strong>Name <em style="color:#ff0;">*</em></strong></p></div>
				<div style=" width:100%; float:left;"><input type="text" name="sub_name" id="sub_name" class="required" placeholder="Your Name"/></div>
				<div class="footer"><p><strong>Email Id<em style="color:#ff0;">*</em></strong></p></div>
				<div style=" width:100%;float:left;"><input type="text" name="sub_email" id="sub_email" placeholder="Your Email"/></div>
				<div class="cl"></div>
				<div style="margin-top:20px; cursor: pointer;" >
					<input type="image" style=" margin-left:45px;width: 60%; height: 25px; text-align: center; border: 0px;" src="<?=PUBLIC_URL?>images/submit-button.png" alt="Submit" />
				</div>
			</div>
		</form>
	   <div class="footerb"><p>Copyright &copy; 2013 E-Rookie.com</p></div>
	</div>
</div>
<!-- pop up Error Login -->

	 
<!-- pop up success news letter -->
	</body>
</html>

<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/jquery.validate.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/front/jquery.flexslider-min.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/front/login.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/front/wowslider.js"></script>
<script type="text/javascript" src="<?=PUBLIC_URL?>js/front/script.js"></script>
<script type="text/javascript">    
  $(document).ready(function() {
		$(window).load(function() {
			$('.flexslider').flexslider({
			   animation: "slide"
			});
		});
	});
</script>

<?php
	if(@$this->session->flashdata('Error')!=''){
?>
<div class="black_overlay">
	  <div class="messageCenter">
		<div class="alert-success" style="background: #FFB5B5;">
		<div class="border_alert"><br /><?php echo $this->session->flashdata("Error");?> </div>
		</div>
	 
		</div>
	  </div>
	</div>
	 <script type="text/javascript">
		function transition(){
			$(".black_overlay").hide();	  
		} 
		$(".black_overlay").show();
		setInterval(transition, 3000);
	 </script>  
	<?php  }  ?>
	<!-- pop up success news letter -->
	 <?php
		if(@$this->session->flashdata('success')!=''){
	 ?>
	<div class="black_overlay"  >
	  <div class="messageCenter">
		<div class="alert-success">
		<div class="border_alert"><br /><?php echo $this->session->flashdata("success");?> </div>
		</div>
	 
		</div>
	  </div>
	</div>
	  <script type="text/javascript">
		 function transition(){
			$(".black_overlay").hide();	  
		} 
		$(".black_overlay").show();
		setInterval(transition, 3000);
	  </script>    
	<?php }?>