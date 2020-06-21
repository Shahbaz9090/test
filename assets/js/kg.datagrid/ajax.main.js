 // alert();
  $(".all-checkbox").click(function(){
         if($(this).attr('checked') == "checked"){
             $("tbody").each(function(){
                 $("table td .checker span").attr('class',"checked");
                 $(".single-checkbox").attr("checked","checked");
             });
             showDelete(1);
         }else{
             $("tbody").each(function(){
                $("table td .checker span").removeAttr('class',"checked");
                $(".single-checkbox").removeAttr("checked","checked");
             });
             showDelete(0);
         }
			
        
  });
  
  $(".single-checkbox").click(function(){
         var chk_val = $(this).attr('alt');   
         var values = $("input:checkbox:checked[class*='single-checkbox']").map(function () {
                return this.value;
         }).get();
         if($("#span_"+chk_val).attr('class') == "checked"){
             $("#span_"+chk_val).removeAttr('class',"checked");
             if(values == ''){
                showDelete(0);  
             }
         }else{
             $("#span_"+chk_val).attr('class',"checked");
             showDelete(1);
         }
         
         $(".th-all-checkbox span").removeAttr('class',"checked");
         $(".all-checkbox").removeAttr('checked',"checked");
			
        
    });
    $(".order_by").click(function(){
        var order_by = $(this).attr('id');
        var order_by_hidden = $("#order_by").val();
        var order = $("#order").val();
       
        if(order_by == order_by_hidden){
            if(order == 'ASC'){
                 $("#order").val('DESC');
            }else{
                 $("#order").val('ASC');
            }
        }else{
            $("#order").val('ASC');
        }
        $("#order_by").val(order_by);
        changePagination(1);
        
    });	
 //   $(".delete").click(function(){
//        var id = $(this).attr("id");
//        alert(id);exit;
//        if(confirmSubmit()){
//            $.ajax({
//                url:sitePath+ controller + "/delete/"+id,
//                success:function(res){
//                    if(res){
//                      $("table tr[id='row_"+id+"']").remove();
//                    }else{
//                        alert("Error:Can't deleted");
//                    }
//                }
//            });
//        }
//       
//    });
    
    
    $(".in-process").click(function(){
        var id=$(this).attr("dir");
        $("#comment_id").val(id);
        var datastring = token_name+"="+token_hash+"&id="+id;
        $.ajax({
				type:"POST",
				data: datastring,
				url:sitePath+ controller+"/ajax_update_comment",
			    success: function(response){
					$("#commentt").val(response);
				}
		});	
    });
    
    /*$("#save_comment").click(function(){
        var id=$("#comment_id").val();
        var comment=$("#comment").val();	
     	var datastring = token_name+"="+token_hash+"&comment="+comment+"&id="+id;
        $.ajax({
				type:"POST",
				data: datastring,
				url:sitePath+ controller+"/ajax_update_comment/1",
				success: function(response){
                    $("#comment_td"+id).html(response);
                    $('#myModal').modal('toggle');
				}
		});
    });*/
    
    $(".create").click(function(){
        var id=$(this).attr('id');	
        //alert(id);exit;
        var val = confirm("Do you want to create this user?");
        if(val){
            var datastring = token_name+"="+token_hash+"&id="+id;
            $.ajax({
    				type:"POST",
    				data: datastring,
    				url:sitePath+ controller+"/ajax_create",
    				success: function(response){
                        $("#row-"+id).remove();
    				}
    		});
        }else{
            return false;
        }
     	
    });
    
     $(".view").click(function(){
        var id=$(this).attr('id');	
     	var datastring = token_name+"="+token_hash+"&id="+id;
        $.ajax({
				type:"POST",
				data: datastring,
				url:sitePath+ controller+"/ajax_view",
				success: function(response){
                    $("#view").html(response);
				}
		});
    });
    
$(document).ready(function(){//alert();

		///hide colus////////////////
		$("input:checkbox:not(:checked)").each(function() {
				var column = "table ." + $(this).attr("name");
				$(column).hide();
				});
                       
		/////////////////////////////////////


		
        var options = option_array;
		options = options.split(',');

		var cookie_data = $.cookie('cookie');
        //alert(cookie_data);
		if(cookie_data == null || cookie_data == ""){
			for(var i=0; i<=options.length;i++){
				$("."+options[i]).show();
				$("input[value = '"+options[i]+"']").attr('checked','checked');
				$("input[value = '"+options[i]+"']").parent('span').addClass('checked');
				}
		}else{
				var cookie_data = $.cookie('cookie').split(',');
				var diff = $(options).not(cookie_data).get();
				for(var i=0; i<=cookie_data.length;i++){
					$("."+cookie_data[i]).show();
					$("input[value = '"+cookie_data[i]+"']").attr('checked','checked');
					$("input[value = '"+cookie_data[i]+"']").parent('span').addClass('checked');

				}
		}
        ////////////////////////////////////////////////////////////////////////////////////
		
        //$("#no-customer").attr('colspan',cookie_data.length+2);alert();
        ///////////////////////////////////////////////////////////////////////////////////////
        
        
        $("input:checkbox").click(function(){
		    var values = $("input:checkbox:checked[class*='scheckbox']").map(function() {
    		return this.value;
        	}).get();
            var x= 100;
            if(values.length>7){
                x=x*values.length; 
                $("#table-box").css('overflow-x','scroll');
                $(".table").css('width',400+x+'px');
            }else{
                $("#table-box").css('overflow-x','auto');
                $(".table").css('width','100%');
                
            }
            if($(this).is(':checked')){
            $(this).parent('span').addClass('checked');
            }else{
                $(this).parent('span').removeClass('checked');
            }
    
    		$.cookie('cookie', values);
    		
    		var column = "table ." + $(this).attr("name");
    		$(column).toggle();
        });
        
        
		
		});
		
		
		$('#sn').click(function(){
			$('#checkbox_div').toggle();
		});
        
        
    //show hide checkbox div
    $(".table-close").click(function(){
        $("#checkbox_div").hide();
    });
    ///increase width if more than 7 attribute exists
$(function(){
     var values = $("input:checkbox:checked[class*='scheckbox']").map(function() {
	return this.value;
    }).get();
  var x= 100;
    //alert(values);
    if(values.length>7){
        x=x*values.length; 
        $("#table-box").css('overflow-x','scroll');
        $(".table").css('width',400+x+'px');
    }else{
        $("#table-box").css('overflow-x','auto');
        $(".table").css('width','100%');
        
    }  
});  
       
