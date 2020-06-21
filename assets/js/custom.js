$( document ).ready(function(){	
	$("#allCheckbox").click(function () {		
		    if($("#allCheckbox").attr('checked') == "checked"){
				$(".chChildren").each(function () {
				      $("input[id*='subCheck']").attr('checked',"checked");
					  $(".checker span").attr('class',"checked");
					  $("#removeAll").show();
					   var values = $("input:checkbox:checked[id*='subCheck']").map(function () {
						  return this.value;
					   }).get();
					  $("#users_id").val(values);
				});
			}else{
				$(".chChildren").each(function () {	 
					  $("#users_id").val("");
					  $("input[id*='subCheck']").attr('checked',false);
					  $(".checker span").removeAttr('class',"checked");
					  $("#removeAll").hide();                      
				});
			}

	});

	$("#login_type , #login_type_single").on('change',function (){
		if(this.value==1){
			$("#static_ip_based").show();
			$("#static_ip_based_single").show();
			$("#ip_based").hide();
			$("#ip_based_single").hide();

		}else if(this.value==2){
			$("#ip_based").show();
			$("#ip_based_single").show();
			$("#static_ip_based").hide();
			$("#static_ip_based_single").hide();
		}else if(this.value==3){
			$("#ip_based").hide();
			$("#ip_based_single").hide();
			$("#static_ip_based").hide();
			$("#static_ip_based_single").hide();
		}else{
			alert("Please select valid authorization");
			return false;
		}
	});
	
	$("#button_type_0 ,#button_type_1 ,#button_type_2, #button_type_3 ").click(function () {
		var list_type= parseInt(this.value);
		$("#select_list").val(list_type);
		if(list_type==0){
			var moveable="<option value=''>Select</option><option value='1'>Network IP Based</option><option value='2'>System IP Based</option><option value='3'>Non IP Based</option>";
		}else if(list_type==1){
			var moveable="<option value=''>Select</option><option value='2'>System IP Based</option><option value='3'>Non IP Based</option>";
		}else if(list_type==2){
			var moveable="<option value=''>Select</option><option value='1'>Network IP Based</option><option value='3'>Non IP Based</option>";
		}else if(list_type==3){
			var moveable="<option value=''>Select</option><option value='1'>Network IP Based</option><option value='2'>System IP Based</option>";
		}else{
			var moveable="<option value=''>No Option</option>";
		}
		$(".btn-group button").each(function () {
			$("button").css("color","");
		});
		
		$("#button_type_"+list_type).css("color","#FF9900");
		

		$("#login_type").html(moveable);
		$("#login_type_single").html(moveable);
		$.ajax({
			   type:"POST",
			   data:token_name+"="+token_hash+"&login_type="+list_type+"&offset=0",
			   url: baseurl+"user/authorisation/ajax_list_items",
			   beforeSend : function(){
				  beforeAjaxResponse();
			   },
			   success:function(res){
				   afterAjaxResponse();
				   $("#ajax_replace").html(res);
			   }
		});
	});

	$("#submit_btn").click(function () {
		var login_type=$("#login_type").val();
		var multi_update='1';
		var users_id= $("#users_id").val();
		var static_ip= $("#static_ip").val();
		$("#ajax_loader").show();
		$("#ajax_loader").text("");
           $.ajax({
			   type:"POST",
			   data:token_name+"="+token_hash+"&login_type="+login_type+"&users_id="+users_id+"&static_ip="+static_ip,
			   url:baseurl+"user/authorisation/edit",
			   beforeSend : function(){
				  $("#submit_btn").prop("class","btn btn-primary disabled");	
		          $('#ajax_loader').html('<img src="'+baseurl+'assets/images/loaders/ajax_preloader.gif" height="25" width="25" > Processing...');
	           },
			   success:function(res){
				   var msg="";
				   $("#submit_btn").prop("class","btn btn-primary");	
				   $("#ajax_loader").fadeOut(500);
				   if(res==1){
					   msg="<font style='color:green;font-weight:bold;'>Records has been updated successfully.</font>";
					   $("#responseDiv").html(msg);
					   $("#redirectDiv").text("You will be redirecting in 5 seconds.");
					   window.setTimeout(function () {
							location.href = baseurl+"user/authorisation/list_items";
						}, 4000);
					   $("#redirectDiv").fadeOut(10000);

				   }else{
					   msg="<font style='color:red;font-weight:bold;'>"+res+"</font>";
					   $("#responseDiv").html(msg);
				   }
				   $("#responseDiv font p").fadeOut(10000);
			   }
		   });
	});

	$("#submit_btn_single").click(function () {
		var login_type=$("#login_type_single").val();
		var users_id= $("#unique_value").val();
		var static_ip= $("#static_ip_single").val();
		$("#ajax_loader_single").show();
		$("#ajax_loader_single").text("");
           $.ajax({
			   type:"POST",
			   data:token_name+"="+token_hash+"&login_type="+login_type+"&users_id="+users_id+"&static_ip="+static_ip,
			   url:baseurl+"user/authorisation/edit",
			   beforeSend : function(){
				  $("#submit_btn_single").prop("class","btn btn-primary disabled");	
		          $('#ajax_loader_single').html('<img src="'+baseurl+'assets/images/loaders/ajax_preloader.gif" height="25" width="25" > Processing...');
	           },
			   success:function(res){
				   var msg="";
				   $("#submit_btn_single").prop("class","btn btn-primary");	
				   $("#ajax_loader_single").fadeOut(500);
				   

				   if(res==1){
					   msg="<font style='color:green;font-weight:bold;'>Records has been updated successfully.</font>";
					   $("#responseDiv_single").html(msg);
					   $("#redirectDiv_single").text("You will be redirecting in 5 seconds.");
					   window.setTimeout(function () {
							location.href = baseurl+"user/authorisation/list_items";
						}, 4000);
					   $("#redirectDiv_single").fadeOut(10000);

				   }else{
					   msg="<font style='color:red;font-weight:bold;'>"+res+"</font>";
					   $("#responseDiv_single").html(msg);
				   }
				   $("#responseDiv_single font p").fadeOut(10000);
			   }
		   });
	});

});



	function allCheck(){		
		if($("#allCheckbox").attr('checked') == "checked"){
			$(".chChildren").each(function () {
				  $("input[id*='subCheck']").attr('checked',"checked");
				  $(".checker span").attr('class',"checked");
				  $("#removeAll").show();
				   var values = $("input:checkbox:checked[id*='subCheck']").map(function () {
					  return this.value;
				   }).get();
				  $("#users_id").val(values);
			});
		}else{
			$(".chChildren").each(function () {	 
				  $("#users_id").val("");
				  $("input[id*='subCheck']").attr('checked',false);
				  $(".checker span").removeAttr('class',"checked");
				  $("#removeAll").hide();                      
			});
		}
	}

	function chk(id){ 
			$("input[id*='allCheckbox']").attr('checked',false);
			$("#uniform-allCheckbox span").prop('class','');
			if($(".cdCheckbox_"+id).attr('checked') == "checked"){
			  var values = $("input:checkbox:checked[id*='subCheck']").map(function () {
              return this.value;
            }).get();
				$("#removeAll").show();
				$(".cdCheckbox_"+id).attr('checked',"checked");
                $("#users_id").val(values);
			}else{
			    var values = $("input:checkbox:checked[id*='subCheck']").map(function () {
                return this.value;
                }).get(); 
				var ln=parseInt(values.length);
				if(ln >0){
					 $("#removeAll").show();
				}else{
					$("#removeAll").hide();
				}
            
               $("#users_id").val(values);
               $(".cdCheckbox_"+id).removeAttr('checked',"checked");
			}
    }

	function singleId(id){
		$("#unique_value").val(id);
	}

	function changePagination(offset){
		var list_type=$("#select_list").val();
		$.ajax({
			data:token_name+"="+token_hash+"&login_type="+list_type+"&offset="+offset,
			type:"post",
			url: baseurl+"user/authorisation/ajax_list_items",
			beforeSend : function(){
				beforeAjaxResponse();
			},
			success: function(data){
				afterAjaxResponse();
				$("#ajax_replace").html(data);
			}
		});
	}  

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