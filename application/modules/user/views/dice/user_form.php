  <script type="text/javascript">
  var email_existance="";
        jQuery(document).ready(function ($)
         {
           $('#group').change(function()
             {
                var group_id =$(this).val();
                $.get('<?=$base_url?>/get_users/'+group_id, function(data) 
                {
                    $('#users').html(data);                  
                });
            });
            
            $('#group').change(function()
             {
                var group_id =$(this).val();
                $.get('<?=$base_url?>/get_parent_group/'+group_id, function(data) 
                {
                    $('#parent_group').html(data);                  
                });
            });
            
             $('#parent_group').change(function()
             {
                var group_id =$(this).val();
                $.get('<?=$base_url?>/get_group_users/'+group_id, function(data) 
                {
                    $('#users').html(data);                  
                });
            });
        });
 </script>
 
 <div class="row-fluid">
	<div class="span12">
		<div class="box">
			<div class="title">
				<h4>
					 <span><?=lang($action."_title");?></span>
				</h4>
			</div>
            
            
			<div class="content">
            
            <?=get_flashdata()?>
          
               <?php echo form_open_multipart(current_url(),array('id'=>'form-validate','class'=>'form-horizontal user_add_form')); ?>
			   
				
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal">Dice Group Name<em>*</em></label>
							<input type="text" class="span6 required" name="group_name" value="<?=isset($result->group_name)?$result->group_name:'';?>" <?=$readonly?>/>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput">Dice User Name<em>*</em></label>
						 <input type="text" class="span6 required" name="dice_user_name" value="<?=isset($result->dice_user_name)?$result->dice_user_name:'';?>" <?=$readonly?>/>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput">Dice Password<em>*</em></label>
						  <input type="password" class="span6 <?php if(!isset($result->password)){echo "required";}?>" name="password" minlength="6"  <?=$readonly?> id="password"/>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal"><?=lang('confirm_password')?><?php if(!isset($result->password)){echo "<em>*</em>";}?></label>
						   <input type="password" class="span6 <?php if(!isset($result->password)){echo "required";}?>" name="confirm_password" minlength="6"  <?=$readonly?> id="confirm_password"/>
						</div>
					</div>
				</div>
				<div class="form-row row-fluid">
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="normal">Candidate</label>
						<select name="candidate[]" id="candidate" class="form-control multiple" multiple="true">
							<?php
							if (isset($candidate) && !empty($candidate)) 
							{
								$candidate_arr = isset($result->candidate) ? explode(',', $result->candidate) : array();
								foreach ($candidate as $ctrow) 
								{ ?>
									<option value="<?php echo $ctrow->id; ?>" <?php if (isset($_POST['candidate']) && in_array($_POST['candidate'], $ctrow->id)) {
									echo 'selected="selected"';
									} 
									else if (isset($candidate_arr) && in_array($ctrow->id, $candidate_arr)) 
									{
										echo 'selected="selected"';
									} 
									else 
									{
				
									} ?>><?php echo $ctrow->first_name.' '.$ctrow->last_name; ?></option>
							<?php } } ?>
						</select>
						</div>
					</div>
					<div class="span6">
						<div class="row-fluid">
						<label class="form-label span4" for="focusedInput"><?=lang('status')?><em>*</em></label>
						   
						  <div class="row-fluid">
							  <div class="span6 del"> 
									<select name="status" class="nostyle required" <?php if($readonly){echo 'disabled="true"';} ?> >
										<option value="active" <?php if(isset($result->status) && $result->status =="active") { echo "selected";} ?> >Active</option>
										<option value="inactive" <?php if(isset($result->status) && $result->status =="inactive") { echo "selected";} ?> >Inactive</option>
									</select>
							   </div>
						  </div> 
						</div>
					</div>
				</div>
                <div class="form-row row-fluid">
					<div class="span12">
						<div class="row-fluid">
							<div class="form-actions">								
								<div class="span12 controls">
								  <?php if($action == 'view'){ ?>
									<button class="btn btn-info" href="<?=$base_url.'/edit/'.$result->id?>"> <?=lang($action.'_button');?></button>
									<?php }else { ?>
										<button class="btn btn-info"><?=lang($action.'_button');?></button>
									<?php } ?>
									<button class="btn btn-danger marginR10" name="reset" type="reset"><?=lang('reset');?></button>
									<a href="javascript: history.go(-1)" class="btn btn-goback"><span class="icon16 typ-icon-back"></span>Go back</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>                     
            </div>
		</div>
		<!-- End .box -->
	</div>
	<!-- End .span12 -->
</div>
<!-- End .row-fluid -->
<script type="text/javascript" src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<link href="<?php echo base_url(); ?>assets/multiselect/jquery.multiselect.css" type="text/css" rel="stylesheet" />

<script type="text/javascript" src="<?php echo base_url(); ?>assets/multiselect/jquery.multiselect.js"></script>

<script>
$("#email_id").blur(function(){
    var email=$(this).val();
    var action="<?=SITE_PATH?>user/checkEmailExistence";
    var str=token_name+"="+token_hash+"&email="+email;
    $.post(action,str,function(data){
        if(data=="1")
        {
            var error='<label for="email" generated="true" class="error">Oops !! This user name has been taken by someone else.</label>';
            $("#email_existance_error").html(error);
            email_existance="yes";
        }
        else
        {
            $("#email_existance_error").html("");
            email_existance="";
        }
    });
});

$(".user_add_form").submit(function(){
   if(email_existance=="yes")
   {
        var error='<label for="email" generated="true" class="error" style="display:block !important">Oops !! This user name has been taken by someone else.</label>';
        $("#email_existance_error").html(error);
        return false;
   } 
});
</script>
<script>
    $(function () {
        $('select[multiple].multiple').multiselect({
            columns: 2,
            placeholder: 'Select Candidate',
            search: true,
            searchOptions: {
                'default': 'Search Candidate'
            },
            selectAll: true
        });

    });
</script>