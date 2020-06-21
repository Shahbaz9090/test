<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

?>
<html>
<head>
<script type="text/javascript" src="<?php

echo base_url();

?>public/js/comman_form.js"></script>


<script type="text/javascript">
   $(document).ready(function(){
var url=window.parent.location;
$('#redirect').val(url);  
    
});
function setVisibility(id, visibility) {
document.getElementById(id).style.display = visibility;
}
</script>
<script>
function addupload(){
        var addControl = '<div id="formbase"><div id="field"></div>';
        addControl += ' <input type="file" name="file[]" class="imageupload" multiple=""></div>';
        $('#addupload').before(addControl); 
    
};

</script>
	 <style type="text/css">
body{
	margin: 0px;
	font-family: calibri, Verdana, Arial, sans-serif;
	color: #333;
}
#table {
	margin: auto;
	height: auto;
	width: 1000px;
	border: 1px solid #CCC;
	padding-bottom:10px;
}
.table_hedding {
	float: left;
	height: 25px;
	width: 990px;
	color: #FFF;
	padding-top: 5px;
	padding-left: 10px;
	font-size: 16px;
	margin-bottom: 10px;
	background-image: url(<?php

echo base_url();

?>/image/bg.jpg);
}

#formbase{
	float: left;
	height: auto;
	width: 490px;
	margin-bottom: 10px;
	margin-right:20px;
}
#field{
	float: left;
	height: 25px;
	width: 140px;
	padding-right: 10px;
    margin-left: 5px;
	text-align: left;
}
#field_set{
	float: left;
	height: 25px;
}
#field_set1{
	float: right;
	height: 25px;
}
.style {
	height: 23px;
	width: 300px;
	float: left;
}
.dashbord_form {
width:100%;
float:left;
margin-bottom:1%;
}
.dashbord_form_left {
width:70%;
margin:auto;
height: auto;

}
.dashbord_form_left_inner {
width:100%;
height: auto;
border: 1px solid #ccc;
float: left;
}
.dashbord_form_right {
width:24%;
margin:0 0 1% 1%;
float:left;
height:38px;
}
.dashbord_form_text {
width:20%;
float:left;
font-size:12px;
margin-right:1%;
}
.dashbord_form_fieldset {
width:70%;
float:left;
}
.req_err {
    
    padding-left: 5px;
    color: red;
 }
 #field
 {
	width: 125px !important;
 }
</style>
</head>
<body>
<?php

echo form_fieldset('Reply form');
$hidden = '';
echo form_open_multipart('mail/inbox_reply', 'method="post" id="replyForm"', $hidden);

?>
<input type="hidden" name="id" value="<?php

echo $reply['id'];

?>" readonly="readonly"/>
<div id="table">

<div class="table_hedding">Reply to customer</div>
<div class="dashbord_form">

<div class="dashbord_form_left" >
<div class="dashbord_form_left_inner">
<div id="error_div" style="padding: 10px; display: none; color: red; " >There is an error while saving your request. please try again.</div>
<br />
<div id="formbase">
<!--
<div id="formbase">
<div id="field">Name* </div>
<div id="field_set">
 <input type="text" name="name" id="name" value="<?php

echo $reply['name'];

?>" readonly="true" /><span id="reply_to_error"  class="req_err" ></span>
</div>
</div>
-->
<div id="formbase">
<div id="field">Email* </div>
<div id="field_set">
<?php if($reply['msg_type']== "inbox") { ?>
<input type="text" name="email" id="email" value="<?php echo $reply['from'];?>"  readonly="true" />
<?php } else {?>
<input type="text" name="email" id="email" value="<?php echo $reply['to'];?>"  readonly="true" />
<?php } ?>

<span id="reply_to_error"  class="req_err" ></span>
</div>
</div>
<div id="formbase">
<div id="field">Cc </div>
<div id="field_set">
<input type="text" name="cc_email" id="cc_email" value=""  />(Enter Email ID Separated by comma.)
</div>
</div>
</div>
<div id="formbase">
<div id="field">From </div>
<div id="field_set">
<input type="text" name="from" id="from" value=" <?php

echo $reply['email_id'];

?>" readonly="true"/>
</div>
</div>
<div id="formbase">
<div id="field">Subject </div>
<div id="field_set">
<input type="text" name="subject" id="subject" value="<?php

echo $reply['subject'];

?>" />
</div>
</div>
<div id="formbase">
<div id="field">Message*</div>

<textarea name="msg" id="msg" cols="40" rows="5" required=""></textarea><span id="phone_error"  class="req_err" ></span>

</div>


<!-------------------- for attachment ------------------>
<div id="formbase">
<div id="field">Attachment</div>

 	<input type="file" name="file[]" class="imageupload" multiple=""/>
   
</div>
<!-------------------- for attachment ------------------>
<div id="formbase">
<div id="field"></div>

 <a href="#" id="addupload" onclick="addupload();">Add another upload control</a>	
</div>
</div>
</div>
</div>
<input type="hidden" id="redirect" name="redirect" value="" />
<div id="formbase">
<div id="field"></div>
<div id="field_set1"><input type="submit" value="Reply" id="Reply" name="Reply"/></div>
</div>
</div>
<?php

echo form_close();
echo form_fieldset_close();

?>
</body>
</html>