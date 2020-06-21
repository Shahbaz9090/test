
			<div class="footer">
				<div class="footer-inner">
					<!-- #section:basics/footer -->
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">Tekshapers</span>
							 &copy; <?=date('Y');?>
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>

					<!-- /section:basics/footer -->
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

<!--------------------------------Websocket------------------------------------->
<?php  _ajaxLayout(array('page'=>'elements/socket'));  ?>

<script>
/*
$(function(){
    var notificationIndex = $("#notificationIndex").val();
    $(".notificationCount"+"<?php echo currentuserinfo()->id;  ?>").html(notificationIndex);//set notification count
    
    $('#notificationIcon').blur(function(){
        $(".notificationCount"+"<?php echo currentuserinfo()->id;  ?>").html(0);
        setNotification();//set notification time when user hits on notification icon
    });
    
    
});


function setNotification(){
    var str = token_name+'='+token_hash;
    $.ajax({
       type:"POST", 
       url:"<?=base_url()?>notification/setNotificationTime",
       data:str,
       success:function(data){
         
       } 
    });
}
*/
</script>

<!------------------------------------------------------------------------------>
	

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='<?php  echo SITE_PATH;  ?>assets/js/jquery1x.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='<?php  echo SITE_PATH;  ?>assets/js/jquery.mobile.custom.js'>"+"<"+"/script>");
		</script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/bootstrap.js"></script>

		<!-- ace scripts -->
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.scroller.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.colorpicker.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.fileinput.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.typeahead.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.wysiwyg.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.spinner.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.treeview.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.wizard.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/elements.aside.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.ajax-content.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.touch-drag.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.sidebar.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.sidebar-scroll-1.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.submenu-hover.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.widget-box.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.settings.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.settings-rtl.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.settings-skin.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.widget-on-reload.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/ace/ace.searchbox-autocomplete.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/chosen.jquery.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/x-editable/bootstrap-editable.js"></script>
		<script src="<?php  echo SITE_PATH;  ?>assets/js/x-editable/ace-editable.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/jquery.inputlimiter.1.3.1.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/jquery.autosize.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/moment.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/daterangepicker.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/bootstrap-datetimepicker.js"></script>
        <script src="<?php  echo SITE_PATH;  ?>assets/js/date-time/bootstrap-timepicker.js"></script>

        

<!-----------------------------------scroll ihn Panel------------------------------------->
<script>
$('.my-scroll').ace_scroll({
	height: '250px',
	mouseWheelLock: true,
	alwaysVisible : true
});
			
</script>

<!----------------------------------------------------------------------------------------->

<!----code for ajax loader--->
<script>

function beforeAjaxResponse(){
    $("#preLoader").show();
    $("#loader").show();
}

function afterAjaxResponse(){
    $("#preLoader").hide();
    $("#loader").hide();
}


$(document).ready(function(){
    $('textarea.limited').inputlimiter({
		remText: '%n character%s remaining...',
		limitText: 'max allowed : %n.'
	});
    $('textarea[class*=autosize]').autosize({append: "\n"});
    //to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
	$('.date-range-picker').daterangepicker({
		'applyClass' : 'btn-sm btn-success',
		'cancelClass' : 'btn-sm btn-default',
		locale: {
			applyLabel: 'Apply',
			cancelLabel: 'Cancel',
		}
	});
    $('.date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
		$(this).prev().focus();
	});
 
});
</script>
<!--------------------->



	</body>
</html>