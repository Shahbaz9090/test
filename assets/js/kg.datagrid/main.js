/**
 *Function delete
 *event on delete icone individuly placed on every row of record
 *desc Delete records from a given controller function
 *desc Either delete rows or given error if found server error
 *
*/  
//$(".delete").click(function() {
//	var id = $(this).attr("id");
//	if (confirmSubmit()) {
//		$.ajax({
//			url: baseUrl  +"/delete/" + id,
//			success: function(res) {
//				if (res) {
//					$("table tr[id='row_" + id + "']").remove();
//				} else {
//					alert("Error:Can't deleted");
//				}
//			}
//		});
//	}
//
//});

/**
 *Function delete
 *event on delete button placed on top right of grid
 *desc Delete records from a given controller function
 *desc Either delete rows or given error if found server error
 *
*/  
//$("#deleteAll").click(function() {
//	var values = $("input:checkbox:checked[class*='single-checkbox']").map(function() {
//		return this.value;
//	}).get();
//	if (confirmSubmit()) {
//		$.ajax({
//			type: 'post',
//			data: token_name + "=" + token_hash + "&id=" + values,
//			url: baseUrl + controller+"/delete/",
//			success: function(res) {
//				if (res) {
//					//for (var i = 0; i < values.length; i++) {
//					//	$("table tr[id='row_" + values[i] + "']").remove();
//					//}
//                    var offset = $("#offset").val();
//                    changePagination(offset);
//				} else {
//					alert("Error:Can't deleted");
//				}
//			}
//		});
//	}
//
//});
    
/**
 *Function confirmSubmit
 *
 *desc ask for confirmation
 *return boolean
 *
*/      
    
function confirmSubmit() {
	var val = confirm("Do you realy want to continue..??");
	if (val) {
		return true;
	}
	return false;
}

/**
 *Function Search
 *event search from search input
 *desc get value from search input and call changePagination function
 *
*/     
$("#searchForm").submit(function() {
    var text = $("#searchBox").val();
    var table_name = $("#table_name").val();
	changePagination(1,'',text,2,'',table_name);
    return false;
    
});

/**
 *Function changePagination
 *event on pagination tabs , per page drop down, search input, go to page
 *desc generate ajax request for given controller function, gets response from sever
 *return html content (whole grid table)
*/      
function changePagination(offset, order_by, text) {
	//alert();
  	var limit = $("#hiddenLimit").val();
	var order_by = $("#order_by").val();
	var order = $("#order").val();
	if (!limit) {
		limit = '';
	}
    if (!text) {
		text = $("#searchBox").val();
	}
    if (!table_name) {
		table_name = $("#table_name").val();
	}
	if (!order_by) {
		order_by = '';
	}
	
	var val = $("#searchBox").val();
	var table_name = $("#table_name").val();
	$.ajax({
		data: token_name + "=" + token_hash + "&offset=" + offset + "&text=" + val + "&table_name=" + table_name + "&order_by=" + order_by + "&order=" + order+ "&text=" + text,
		type: "post",
		url: baseUrl +"/ajax_list_items/" + limit + '/1',
		beforeSend: function() {
			beforeGridResponse();
            $("#ajax_replace table tr td").css('background','#FAFAFA');
		},
		success: function(data) {
			
			$("#ajax_replace").html(data);
            $("#offset").val(offset);
            afterGridResponse();
		},
        error: function(data,xhr) {
            afterGridResponse();
            alert('Sorry! I  could not perform your command.');
        }
	});
}

/**
 *Function records
 *event on per page drop down
 *desc generate ajax request for given controller function, gets response from sever
 *return html content (whole grid table)
*/      
$(function(){
    $("#records").on('change', function() {
	var order = $("#order").val();
	var limit = $(this).val();
	var val = $("#searchBox").val();
	var table_name = $("#table_name").val();
	var order_by = $("#order_by").val();
    //SAVE TO COOKIE
    $.cookie('limit', limit);
    //////////////////////
	$.ajax({
		data: token_name + "=" + token_hash + "&limit=" + limit + "&text=" + val + "&order_by=" + order_by + "&order=" + order + "&table_name=" + table_name,
		type: "post",
		url: baseUrl +"/ajax_list_items/" + limit + '/1',
		beforeSend: function() {
			$("#ajax_replace table tr td").css('background','#FAFAFA');           
            beforeGridResponse();
          	},
		success: function(data) {
			$("#hiddenLimit").val(limit);
			$("#ajax_replace").html(data);
			afterGridResponse(); 
         },
        error: function(data,xhr) {
            afterGridResponse();
            alert('Sorry! I  could not perform your command.');
        }
	});
});

})    

/**
 *Function all-checkbox
 *event on all-checkbox checkbox  
 *desc checks all check box of shown page
 *return null
*/ 

$(".all-checkbox").click(function() {
	if ($(this).attr('checked') == "checked") {
		$("tbody").each(function() {
			$("table td .checker span").attr('class', "checked");
			$(".single-checkbox1").attr("checked", "checked");
		});
		showDelete(1);
	} else {
		$("tbody").each(function() {
			$("table td .checker span").removeAttr('class', "checked");
			$(".single-checkbox1").removeAttr("checked", "checked");
		});
		showDelete(0);
	}


});

/**
 *Function all-checkbox
 *event on all-checkbox checkbox  
 *desc checks all check box of shown page
 *return null
*/ 

$(".single-checkbox").click(function() {
	$(".th-all-checkbox span").removeAttr('class', "checked");
	$(".all-checkbox").removeAttr('checked', "checked");

	var values = $("input:checkbox:checked[class*='single-checkbox']").map(function() {
		return this.value;
	}).get();
	if ($(this).attr('checked') == "checked" || values != '') {
		showDelete(1);
	} else {
		showDelete(0);
	}
});
    
/**
 *Function order by
 *event on order by th  
 *desc sort by column name
 *return html
*/    
$(".order_by").click(function() {
	var order_by = $(this).attr('id');
	var order_by_hidden = $("#order_by").val();
	var order = $("#order").val();

	if (order_by == order_by_hidden) {
		if (order == 'ASC') {
			$("#order").val('DESC');

		} else {
			$("#order").val('ASC');
		}
	} else {

	}
	$("#order_by").val(order_by);
	changePagination(1);

});

/**
 *Function order by
 *event on order by th  
 *desc sort by column name
 *return html
*/   
    
function showDelete(val) {
	if (val == 1) {
		$("#delete-export").show();
	} else {
		$("#delete-export").hide();
	}
}
/**
 *Function order by
 *event on order by th  
 *desc sort by column name
 *return html
*/       
    
//redirect from edit if session offset is set

$(function() {
    if(offset){
        //changePagination(offset);    
    }
    
});

/**
 *Function order by
 *event on order by th  
 *desc code for grid , view column which are checked
 *return html
*/   

$(document).ready(function(){
    
    //getting limit values frrom cookie
    var limit = $.cookie('limit');
    $("select option").filter(function() {
        //may want to use $.trim in here
        return $(this).text() == limit; 
    }).prop('selected', true);
    
   
    
    ///////////////////////////////////

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
    
    
    
});
    
$("input:checkbox:not(:checked)").each(function() {
       var values = $("input:checkbox:checked[class*='scheckbox']").map(function() {
    	return this.value;
    }).get();
    var x= 100;
    // alert(values);
    if(values.length>7){
        x=x*values.length; 
        $("#table-box").css('overflow-x','scroll');
        $(".table").css('width',400+x+'px');
    }else{
        $("#table-box").css('overflow-x','auto');
        $(".table").css('width','100%');
        
    }
    var column = "table ." + $(this).attr("name");
    $(column).hide();
});
		
		


//show hide checkbox div
$(".table-close").click(function(){
    $("#checkbox_div").hide();
});


   $('#sn').click(function(){
			$('#checkbox_div').toggle();
		});
        
        
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
    
    $.cookie('cookie', values);
    
    var column = "table ." + $(this).attr("name");
    
      $(column).toggle();
});


	function afterGridResponse(){
         $("#show_grid_bsy").hide();
	}

	function beforeGridResponse(){
		  $("#show_grid_bsy").show();
	}
    
    
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