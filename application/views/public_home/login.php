<div id="page-content">

<!--------------- start Login form ---------------------->

<div class="login_changes_overbg">
<div class="row title_bg">
<div class="title container">
<span>Hi! <?=$result->email?></span>
</div>
</div>
	  <div class="content-about ">
	       <div class="container">
		     <div class="row">
             
          <div class="col-md-5">
          <div class="row">
      <div class="login-border">
       <h4><span class="e-login">e-</span><span class="rooki_login">Rookie</span>- <span style="font-size: 17px;">Candidate Login</span></h4>  
       <?php echo form_open(SITE_PATH.'home/candidate');?>
        <div class="row mb10">
          <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
            <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/email-icon.jpg" width="42" height="36" /></div>
            <div class="form-group-new ">
              <input type="text" placeholder="Email/Login Id" class="form-control-1 input-form" name="email" disabled="" value="<?=$result->email?>" />
            </div>
          </div>
        </div>
        <div class="row mb10">
          <div class="col-md-12 form-border" style="margin-top:10px;margin-bottom:10px;">
            <div class="form-icon"><img src="<?=PUBLIC_HOME?>images/pass-icon.png" width="42" height="36" /></div>
             <div class="form-group-new ">
             <input type="hidden" value="<?=$id?>" name="candidate_id" />
             <input type="hidden" value="<?=$unique_code?>" name="unique_code" />
              <input type="password" placeholder="Password" class="form-control-1 input-form" name="password" required="" />
            </div>
          </div>
        </div>
     
      
        
        <div class="row mb10">
         <div class="col-md-12">
        <a href="#" class="forgot_pass">Forgot your Password?</a> 
          <div class="btn-boxs">
          <button class="btn btn-primary" type="submit">LOGIN</button>
      </div>
          </div>
        </div>
        
        <?php echo form_close();?>
        
        <div class="divider-horizontal"></div>
        
         <div class="row">
         <div class="col-md-12">
         Profile completion bar
        <div class="progress">
        
  <div class="progress-bar  progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width:<?=$percentage_bar?>%">
    <span class="sr-only">40% Complete (success)</span>
  </div>
</div>
         </div></div>
        
        </div>
        </div>
      </div>
      
      
     
      <div class="col-md-1">
      <div class="login-divider"></div>
     </div>
      
      <!---------------------------right-col----------------------------->
      
      <div class="col-md-6">
        <div class="form-right">
          <div class="row">
            <img src="<?=PUBLIC_HOME?>images/login_top.gif"/> 
             <img src="<?=PUBLIC_HOME?>images/login_rec.gif"/> 
            </div>
         
        
        </div>
      </div>
   
          </div>
          </div>
            	</div>
				
				</div><!-- CS -->
                
			<!------------------------------------ end Login form ----------------------------------->
            
            </div>