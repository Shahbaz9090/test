
    <script>
    $(document).ready(function(){
        	$("#country").chosen().change(function(){
        	var c = this.value;
     	    $.get('<?=base_url("home")?>/ajax_state_chosen/'+c, function(data) 
            {
              $('#state_span').html(data);
              //change_city('');
              
                       
            });
        });
        
         $('.tokenfield').tokenfield();
    });
    </script>
    
    
 

        </div>
        
        
        
        
          <!--<div id="page-content">

	<div class="container">
        <div class="row">
<h2>Contact Us</h2>





</div>
</div>
    </div>-->    
        <div id="page-content" style="background-color: #F9FAFE;"><!-- start content -->
        <div class="row" style="background-color: #0069B6;color: #f1f2f6;padding: 9px;margin-bottom: 25px;" >
                <div class="title container" >
                				
                 <span>Hi! <?=$result->email?>, You can edit your Profile here</span>
                
                </div>
        </div>
			<div class="content-about ">
				
<div class="container">

<div class="row">

	<div class="col-md-12">

		<div class="box">

			
			<div class="content">
            
            <style>
            
           .form-label{ padding-left: 27px;
padding-top: 6px;font-weight: normal;
font-size: 13px; color:#353535;font-family:arial;
text-align: left;}
            
           .form-control2 {
	display:block;
	height:34px;
	padding:6px 12px; font-family:arial;
	font-size:13px;
	line-height:1.42857143;
	color:#353535;
	background-color:#fff;
	background-image:none;
	border:1px solid #ccc;
	border-radius:4px;
	-webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);
	box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075);
-webkit-transition:border-color ease-in-out .15s, box-shadow ease-in-out .15s;
transition:border-color ease-in-out .15s, box-shadow ease-in-out .15s
}
.form-control2:focus {
	border-color:#66afe9;
	outline:0;
	-webkit-box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6);
	box-shadow:inset 0 1px 1px rgba(0, 0, 0, .075), 0 0 8px rgba(102, 175, 233, .6)
}
.form-control2::-moz-placeholder {
color:#999;
opacity:1
}
.form-control2:-ms-input-placeholder {
color:#999
}
.form-control2::-webkit-input-placeholder {
color:#999
}
.form-control2[disabled], .form-control[readonly], fieldset[disabled] .form-control {
	cursor:not-allowed;
	background-color:#eee;
	opacity:1
}
textarea.form-control2 {
	height:auto
}
input[type=search] {
	-webkit-appearance:none
}
input[type=date] {
	line-height:34px
}

            </style>
            
	
<?php echo form_open_multipart('home/registration',array("class"=>"form-horizontal",'id'=>'registration_form')); ?>
			
<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="email">E-Mail<em>*</em></label>
<input type="email" class="form-control2 input-form col-md-7" placeholder="Email" name="email" value="<?=@$result->email?>" required="" disabled=""/>
</div>
</div>
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="resume_title">Resume Title<em>*</em></label>
<input type="text" class="form-control2 input-form col-md-7" name="resume_title" value="<?=@$result->reume_title?>" placeholder="Resume Title" required=""/>
</div>
</div>
</div>

<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="first_name">First Name<em>*</em></label>
<input type="text" class="form-control2 input-form col-md-7" name="first_name" value="<?=@$result->first_name?>" placeholder="First Name" required=""/>
</div>
</div>
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="middle_name">Middle Name</label>
<input type="text" class="form-control2 input-form col-md-7" name="middle_name" value="<?=@$result->middle_name?>" placeholder="Middle Name" />
</div>
</div>
</div>

<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="last_name">Last Name<em>*</em></label>
<input type="text" class="form-control2 input-form col-md-7" name="last_name" placeholder="<?=@$result->last_name?>" required=""/>
</div>
</div>
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="notice_period">Notice Period</label>
<select class="form-control2 input-form col-md-7" name="notice_period" class="nostyle">
<option value="">Select Notice Period</option>
			<?php
				$period=notice_period_list();
				foreach($period as $k=>$v){
			?>
				<option value="<?=$k?>" <?php if(@$result->notice_period==$v){ echo "selected" ;}?>><?=$v?>
		</option>
			<?php }?>     
</select>
</div>
</div>
</div>
		
<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="education">Education<em>*</em></label>
<select name="education" id="education" class="nostyle form-control2 input-form col-md-7" required="">								
<?php
		foreach($education as $k=>$v){
	?>
	<option value="<?=$v->id?>" <?php if(@$result->education==$v->id){ echo "selected" ;}?>><?=$v->education_name?>
</option>
	<?php }?>      

</select>
</div>
</div>
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="phone_cell">Cell Phone<em>*</em></label>
<input type="text" class="form-control2 input-form col-md-7" name="phone_cell" value="<?=@$result->phone_cell?>" placeholder="Cell Phone" required=""/>
</div>
</div>
</div>	

<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="country">Country<em>*</em></label>
<div class="col-md-7">
<div class="row">
<select name="country" id="country"  class="nostyle  chosen-select form-control2 input-form" required=""  >

<?php
   $country = getCountryList();
   if($country){
	 foreach($country as $state_row){
?>                                    
	<option value="<?=$state_row->country_id?>" <?php if(isset($result->country_id)&& $result->country_id ==$state_row->country_id){echo "selected";}?>><?=$state_row->country_name?></option>
<?php 
	}
  }
?>

</select>
</div></div>
</div>
</div>
<div class="col-md-6">
<div class="row" >

<label class="form-label col-md-5" for="state_span">State<em>*</em></label>
<div class="col-md-7">
<div class="row" id="state_span">
<select name="state"  onchange="change_city(this.value)" id="state" class="required nostyle chosen-select span6" <?php if(isset($readonly)){ echo "disabled='true'";} ?>>
							  <option value="">Select State</option>
								<?php foreach($state as $state_row):?>
								<option value="<?=$state_row->id?>" <?php  if(isset($result->state) && $result->state == $state_row->id){ echo "selected" ;}?> ><?=$state_row->name?></option>
								<?php endforeach; ?>
                            </select>
</div>
</div>
</div>
</div>


</div>
				
						
<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="city">City</label>
<div class="col-md-7">
<div class="row" id="city_span">
<select name="city" class="nostyle chosen-select span8"  id="city" <?php if(isset($readonly)){ echo "disabled='true'";} ?>>
                                <option value="">Select City</option>
                                <?php foreach($city as $city_row):?>
                                <option value="<?=$city_row->id?>" <?php if(isset($result->city) && $result->city==$city_row->id){ echo "selected" ;}?>>
									<?=$city_row->cityName?>
								</option>
                                <?php endforeach; ?>
                            </select>

</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="zip">Postal Code</label>
<input type="text" class="form-control2 input-form validate_input col-md-7" placeholder="Postal Code" name="zip" value="<?=@$result->zip?>" required=""/>
</div>
</div>
</div>	

<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="key_skills">Key Skills <small>(Comma separated)</small><em>*</em></label>
<div class="col-md-7">
<div class="row" >
<input type="text"  class="form-control2 input-form tokenfield" placeholder="Enter Skills" name="key_skills" value="<?=isset($result->key_skills)?$result->key_skills:'';?>" required="" />
</div>
</div>
</div>
</div>
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="relocate">Can Relocate</label>
<div class="col-md-6">
<p><input type="radio" name="relocate" value="male" <?php if(@$result->can_relocate==1){ echo "checked"; } ?>/>YES
<input type="radio" name="relocate" value="female" <?php if(@$result->can_relocate==0){ echo "checked"; } ?>/>NO
</p>				
</div>
</div>
</div>
</div>

<div class="form-group row">
<div class="col-md-6">
<div class="row">
<label class="form-label col-md-5" for="fileToUpload">Resume <small>(upload latest)</small></label>
<input type="file" class="form-control2 input-form col-md-7" name="fileToUpload"/>
</div>
</div>
</div>	


<div class="form-group row">
<div class="col-md-12">
<div class="row">
<label class="form-label col-md-12" for="resume_text">Resume Text</label>
<div class="col-md-12">
<div class="row"><textarea class="form-control2 input-form col-md-12" name="resume_text" id="resume_text" rows="25" cols="60" style="height:320px;background:white;" disabled="" class="uniform"> 
<?=$result->resume_text?>
</textarea>
</div>
</div>
</div>
</div>
</div>

<div class="form-group row">
<div class="col-md-12">
<div class="form-actions text-center">								
<button class="btn btn-info marginR10" id="disableDiv" type="submit">Update Profile</button> 
<a href="<?=SITE_PATH?>" class="btn btn-danger">Back to home</a> 
</div>

</div>
</div>


		
				</form>

		</div>
		<!-- End .box -->

	</div>
	<!-- End .span12 -->


</div>

                        </div>
</div>
     </div>
		</div><!-- CS -->
			<!-- end content -->
		</div>

	<script>
   
    $(function(){
        <?php if(empty($result->state)){ ?>
        	var c=$("#country").val();
        	$.get('<?=base_url("home")?>/ajax_state_chosen/'+c, function(data) 
            {
              $('#state_span').html(data);
              change_city('');
                       
            });
            <?php } ?>
            
      $("#registration_form").validate({ 
        // all rules and options,
        rules: {
            state:{
                required: true,
            }
        }
    });    
    });
    function change_city(val)
    {
        $.get('<?=base_url("home")?>/ajax_city_chosen/'+val, function(data){
                  $('#city_span').html(data);
        });
    }
    
    
    </script>
  