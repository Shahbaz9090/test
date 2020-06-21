
        </div>
        
        
 
     
        
        <!-----------------plans goes here --------------------------------------------->
			<div class="container">
  
<!-- start content -->
<div id="page-content" style="overflow-x: hidden">

<div class="row-fluid"><div class="switch-form">
<?php echo form_open(); ?>

<div class="row-fluid">
<h4>Select Your Domain</h4></div>
<div class="row-fluid">
<div style="display: table;width:100%;background: url(../assets/images/world-map.png) no-repeat; background-position: center;">

<?php
if(@$this->session->userdata('india_account_expired')=='yes' && @$this->session->userdata('us_account_expired')!='yes')
{ ?>
<!-- for india -->
<div class="switch-from-left">
<h5>
<input type="radio" name="domain" value="2" disabled=""/> INDIA </h5>
<img src="<?=PUBLIC_URL?>images/india_flag.png" alt="" title="" width="50"/>
<br /><span style="color: red; font-size: 12px;">Expired Or Inactive</span>
</div>

<!-- for us -->
<div class="switch-from-right">
<h5>
<input type="radio" name="domain" checked="" value="1"/> USA </h5>
<img src="<?=PUBLIC_URL?>images/usa-flag.png" alt="" title="" width="50"/>
<br /><span style="color: red; font-size: 12px;">Expired Or Inactive</span>
</div>

<?php } 
elseif(@$this->session->userdata('india_account_expired')!='yes' && @$this->session->userdata('us_account_expired')=='yes')
{ ?>
<!-- for india -->
<div class="switch-from-left">
<h5>
<input type="radio" name="domain" value="2" checked=""/> INDIA </h5>
<img src="<?=PUBLIC_URL?>images/india_flag.png" alt="" title="" width="50"/>
</div>

<!-- for us -->
<div class="switch-from-right">
<h5>
<input type="radio" name="domain" disabled="" value="1"/> USA </h5>
<img src="<?=PUBLIC_URL?>images/usa-flag.png" alt="" title="" width="50"/>
<br /><span style="color: red; font-size: 12px;">Expired Or Inactive</span>
</div>

<?php }

elseif(@$this->session->userdata('india_account_expired')!='yes' && @$this->session->userdata('us_account_expired')!='yes')
{ ?>
<!-- for india -->
<div class="switch-from-left">
<h5>
<input type="radio" name="domain" value="2" checked=""/> INDIA </h5>
<img src="<?=PUBLIC_URL?>images/india_flag.png" alt="" title="" width="50"/>
</div>

<!-- for us -->
<div class="switch-from-right">
<h5>
<input type="radio" name="domain" value="1"/> USA </h5>
<img src="<?=PUBLIC_URL?>images/usa-flag.png" alt="" title="" width="50"/>
</div>

<?php } ?>




</div>



</div>
<div class="clearfix"></div>
<div class="text-center" style="border-top: 1px solid #ccc;">
<button class="btn btn-blue btn-sm" type="submit">Proceed</button>
</div>
</div>
<?php echo form_close(); ?>
</div>
<!-- end content -->



</div>
            
        <!----------------------- PLans ends here-------------------------------------->    
		</div><!-- CS -->
			<!-- end content -->
		</div>

