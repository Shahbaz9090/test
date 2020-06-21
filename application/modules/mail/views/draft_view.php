<link rel="stylesheet" type="text/css" href="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.css')?>">
<script src="<?=base_url('assets/plugins/bootstrap-tagsinput-latest/src/bootstrap-tagsinput.js')?>"></script>

<style>
a
{
    text-decoration: none !important;
}
.bootstrap-tagsinput
{
    width: 89%;
    margin-bottom: 2px;
}

.button_height{
	height:25px;
}
.col-xs-2
{
	width: 16.666666%;
	float: left;
	padding: 2px;
}
.col-xs-2:after
{
	clear: both;
}
.attachemtn_container
{
	height: 145px;
	border: #999 solid 1px;
	overflow: hidden;
	position: relative;
}
.attachment-overlay
{
	position: absolute;
	height: 100%;
	top: 0;
	left: 0;
	width: 100%;
	background: rgb(245, 245, 245,.8);
	opacity: 0;
}
.btn-row
{
	position: absolute;
	bottom: 10px;
	left: 30%;
}
.btn-row .att-btn
{

	background: #626262;
	height: 24px !important;
	width: 30px !important;
	font-size: 15px;
	color: #fff;
	margin: 8px 0 10px 0;
	padding: 5px;

}
.attachemtn_container:hover .attachment-overlay
{
	opacity: 1;
}
.att-title
{
	overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    color: #777;
    font-size: 12px;
    font-weight: bold;
    line-height: 16px;
    margin-top: 8px;
    word-wrap: normal;
    padding: 3px;
}
.att-title-row,
.att-filesize-row
{
	padding: 5px;
}
.SumoSelect {
    width: 90%;
}
.SumoSelect .CaptionCont.SelectBox.search {
    width: 100%;
    line-height: 19px;
    float: left;
}
.SumoSelect > .CaptionCont > span.placeholder {
    color: #6f6d6d;
    font-style: normal;
    cursor: pointer;
}
.SumoSelect:focus > .CaptionCont, .SumoSelect:hover > .CaptionCont, .SumoSelect.open > .CaptionCont {
    box-shadow: 0 0 2px #c8cbce;
    border-color: #e4e6e8;
}
.SumoSelect>.optWrapper>.options li label {
	margin-bottom: 0px;
}
.SumoSelect > .CaptionCont {
    position: relative;
    border: 1px solid #e8e3e3;
    min-height: 19px;
    background-color: #fff;
    border-radius: 4px;
    margin: 0;
}

.SumoSelect > .CaptionCont > span {
    color: #555;
    font-size: .9em;
}
.SumoSelect > .CaptionCont > label > i {
    background: url(<?=base_url('assets/plugins/chosen/chosen-sprite.png')?>) no-repeat 13px 2px;
    display: block;
    width: 100%;
    height: 100%;
}
.SumoSelect.open .search-txt {
    padding: 12px 8px;
}
.SumoSelect.open>.optWrapper {
    top: 35px;
    display: block;
    width: 107%;
}
.SumoSelect > .optWrapper > .options li.opt {
    padding: 2px 2px;
    
}
.SumoSelect > .optWrapper.multiple > .options li.opt span i, .SumoSelect .select-all > span i {
   
    width: 10px;
    height: 10px;
}
.SumoSelect > .optWrapper > .options::-webkit-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-moz-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-ms-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::-o-scrollbar {
    width: 3px;
}
.SumoSelect > .optWrapper > .options::scrollbar {
    width: 3px;
}
.SelectBox {
    padding: 2px 5px;
}

div.uploader {
   margin-right: 200px;
}
.cke_chrome {
    margin-left: 0px;
    width: 666px;
}
.line
{
    border-bottom: 1px solid lightgray;
    margin-bottom: 10px;
}
</style>

<div class="row-fluid">
	<div class="span12">
		<?php echo get_flashdata();?>
	</div>
</div>

<div class="row-fluid">
	<div class="span12">
		<div class="span10">
			<div class="box">
				<div class="title">
					<h4><span>Draft List</span>
					</h4>
				</div>
					
				<div class="content">
					<div class="form-row row-fluid">
						<div class="span12">
							<div class="row-fluid">
								<form method="POST" enctype="multipart/form-data" class="form-horizontal" id="reply_mail" role="form" action="<?=$base_url.'/compose_email/'.$result->msg_type?>">
								  	<div class="row-fluid">
										<div class="span12">
										  	<div class="row-fluid"> 
											   	<div class="span2">
											   		<b>To</b>
											   	</div> 
											   	<div class="span10"> 
											   		<input data-role="tagsinput" value="<?php echo $result->to_email; ?>" style="width: 90%" type="text" name="to" class="form-control">
											   	</div><br>
										   	</div>
										   	<div class="row-fluid"> 
											   	<div class="span2">
											   		<b>Cc</b>
											   	</div> 
										   	
											   	<div class="span10"> 
											   		<input data-role="tagsinput" style="width: 90%" type="text" name="cc" class="form-control" value="<?=@$result->cc_email?>">
											   	</div><br>
										   </div>
										   <div class="row-fluid"> 
											   	<div class="span2">
											   		<b>Bcc</b>
											   	</div> 
											   	<div class="span10"> 
											   		<input data-role="tagsinput" style="width: 90%" type="text" name="bcc" class="form-control" value="<?=@$result->bcc_email?>">
											   	</div>
										   	</div>
										   	<div class="row-fluid"> 
											   	<div class="span2">
											   		<b>Subject</b>
											   	</div> 
											   	<div class="span10"> 
											   		<input type="hidden" name="<?=$this->config->item('csrf_token_name')?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
											   		<input type="hidden" name="is_already_draft" value="<?php echo $result->id ?>">
											   		<input style="width: 90%" type="text" name="subject" value="<?=@$result->subject?>" class="form-control">
											   	</div>
										   	</div><br>
										   	
										   	<div class="row-fluid"> 
										   		<div class="span2">&nbsp;</div>
											   	<div class="span10">   
													<input type="hidden" name="mail_id" value="<?=@$result->id?>"/>
												  	<textarea  name="body" id="mail_content"  class="ckeditor"><?=@$result->message?></textarea>
											   	</div>   
											</div>
											<!--Start mail thread -->
											<div class="form-row row-fluid">
												<div class="span12">
													<!-- Attachment -->
													<?php 
													if(is_array($attachments) && count(($attachments))>0 && !empty($attachments[0]['filename']))
													{
														echo "<hr>";
													}?>
													
													<div class="row-fluid">
														<?php 
														if(is_array($attachments) && count($attachments)>0 && !empty($attachments[0]['filename']))
														foreach ($attachments as $at_key => $attachment) {?>
															<div class="col-xs-2">
																<div class="attachemtn_container">
																	<div class="at-box">
																		<?php 
																			$path_parts  = pathinfo($attachment['filename']);
											                                $filetype    = $path_parts['extension'];
											                                if ($filetype == 'docx' || $filetype == 'doc' || $filetype == 'rtf')
											                                {?>
																				<a download="" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>">
																				<img style="width: 100%;height: 100%" src="<?=base_url('assets/img/word_icon.png')?>"></a>
											                                <?php } elseif ($filetype == 'pdf'){?>
																				<a download="" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>">
																				<img style="width: 100%;height: 100%" src="<?=base_url('assets/img/pdf_icon.png')?>"></a>
											                                <?php }elseif($filetype == 'png' || $filetype == 'jpeg' || $filetype == 'jpg' || $filetype == 'bmp' || $filetype == 'gif'){?>
																				<a download="" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>">
																				<img style="width: 100%" src="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>"></a>
																			<?php }else{ ?>
																				<a download="" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>">
																				<img style="width: 100%" src="<?=base_url('assets/img/file_icon.png')?>"></a>
																			<?php } ?>
																		<div class="att-title">
																			<span><?php echo $attachment['file_title']; ?></span>	
																			
																		</div>
																	</div>
																	<div class="attachment-overlay">
																		<div class="att-title-row">
																			<span><?php echo $attachment['file_title']; ?></span>	
																		</div>
																		<div class="att-filesize-row">
																			<span><?php echo ceil(filesize(FCPATH.'/upload/email_attachment/'.$attachment['filename'])/1024); ?> KB</span>	
																		</div>
																		<div class="btn-row">
																			<a download href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>" class="att-btn dwnl-btn"><i class="fa fa-download"></i></a>
																			<a target="_blank" href="<?=base_url('upload/email_attachment/'.$attachment['filename'])?>" class="att-btn view-btn"><i class="fa fa-eye"></i></a>
																		</div>
																	</div>
																</div>
															</div>
														<?php } ?>
													</div>
												</div>	
									        </div>
									  	</div>
									  	<div class="line">&nbsp;</div>
										<div class="span12">   
										  	<button name="send_email" class="btn btn-primary pull-left">Send</button>
										  	<button style="margin-left: 10px;" type="submit" name="save_draft" id="save_draft" class="btn btn-danger pull-left">Save as Draft</button>&nbsp;&nbsp;&nbsp;
										  	Attachment:  <input title="Add Attachment" type="file" name="attachment[]" multiple="" class="btn btn-primary pull-left">
									   </div>
								  	</div>
								</form>
					      	</div>	
			        	</div>  
					</div><!--content-->
				</div><!--box-->
			</div><!--span8-->
		</div>

	 	<div class="center" style="margin-top:30px">
			<a href="javascript: history.go(-1)" class="btn btn-goback" ><span class="icon16 typ-icon-back"></span>Go back</a>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function(){
		jq('#email_tag').SumoSelect({search: true, searchText: 'Enter here.',placeholder:'Select Email Tag'});
	});
	
	var base_url = '<?=$base_url?>';
	$('#release').click(function (event) {
		var id = "<?=$result->id?>";
		var release_email = '1';
		if (confirm('Are you sure you want to release this?')) {
			$.ajax({
				data:(token_name+'='+token_hash+'&release_email='+release_email+'&id='+id),
				type: "POST",
				url: base_url +"/release",
				success: function (data) {
					alert("Release Successfully");
					location.reload();
				}
			});
		}
	});
	
	var base_url = '<?=$base_url?>';
	$('#unrelease').click(function (event) {
		var id = "<?=$result->id?>";
		var release_email = '0';
		if (confirm('Are you sure you want to unrelease this?')) {
			$.ajax({
				data:(token_name+'='+token_hash+'&release_email='+release_email+'&id='+id),
				type: "POST",
				url: base_url +"/unrelease",
				success: function (data) {
					alert("Unrelease Successfully");
					location.reload();
				}
			});
		}
	});
</script>