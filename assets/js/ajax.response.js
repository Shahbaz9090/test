	function beforeAjaxResponse(){
		//$(".black_overlay").show();
		//$('#reload').html('<div class="black_overlay"><div class="messageCenter"> <div class="loader-success"><div class="border_alert"><img src="'+baseurl+'assets/images/loaders/circleTickbox.gif" height="80" width="80" ></div></div></div>');
        //	$("#myProcessModal").modal('show');
            $(".ajax-process-modal").animate({top:"-2%"},300);;
           
	}

	function afterAjaxResponse(){
	//	$(".black_overlay").hide();
        //$("#myProcessModal").modal('hide');
      $(".ajax-process-modal").animate({top:"-10%"},300);;
	}