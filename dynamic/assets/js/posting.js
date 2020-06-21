// Hide the ads`s div before select the ads category
$(document).ready(function(){
	$("#mtldcb,#estate,#price,#car,#job").hide();
	$("#mtldcb input").removeAttr("required");
	$("#estate select").removeAttr("required");
	$("#purpose").removeAttr("disabled");
	$("#estate input").removeAttr("required");
	$("#price input").removeAttr("required");
	$("#car input").removeAttr("required");
	$("#car select").removeAttr("required");
	$("#car_fuel").removeAttr("disabled");
	$("#job input").removeAttr("required");
	$("#job select").removeAttr("required");
	$("#job_p").removeAttr("disabled");
	$("#job_t").removeAttr("disabled");
/*===================When chenge the category ======================*/
	$("#cat").change(function(){
		var cat_val = $("#cat").val();
		$("#mtldcb input").val('');
		$("#estate input").val('');
		$("#purpose").change();
		$("#price input").val('');
		$("#car input").val('');
		// $("#car select").reset();
		$("#job input").val('');
		// $("#job select").reset();
	/*==========Mobiles Cameras Tablets Laptops Desktops and Bycycles==========*/
		if(cat_val=="1" || cat_val=="5"|| cat_val=="10" || cat_val=="2" || cat_val=="3" || cat_val=="4")
		{
			$("#mtldcb").show();
			$("#mtldcb input").attr("required","required");
			$("#title2").attr("value","");
		}
		else
		{
			$("#mtldcb").hide();
			$("#mtldcb input").removeAttr("required");
		}
	
	/*===============================================Real Estate========================================*/
		if(cat_val=="19")
		{
			$("#estate").show();
			$("#estate select").attr("required","required");
			$("#estate input").attr("required","required");
			$("#purpose").attr("disabled","disabled");
		}
		else
		{
			$("#estate").hide();
			$("#estate select").removeAttr("required");
			$("#estate input").removeAttr("required");
			$("#purpose").removeAttr("disabled");
		}
/*================Kitchens Electronics Furnitures Books Sports Fashions Hobbies Pets=================*/
		if(cat_val=="12" || cat_val=="6" || cat_val=="11" || cat_val=="13" 
			|| cat_val=="15" || cat_val=="16" || cat_val=="20")
		{
			$("#price").show();
			$("#price input").attr("required","required");
		}
		else
		{
			$("#price").hide();
			$("#price input").removeAttr("required");
		}
/*======================================Cars Bikes Sccoters(cbs)======================================*/
		if(cat_val=="7")
		{
			$("#car").show();
			$("#car select").attr("required","required");
			$("#car input").attr("required","required");
			$("#car_fuel").attr("disabled","disabled");
		}
		else if(cat_val=="8" || cat_val=="9")
		{
			$("#car").show();
			$("#car input").attr("required","required");
			$("#fuel").hide();
			$("#fuel select").removeAttr("required");
			$("#car_fuel").removeAttr("disabled");
		}
		else
		{
			$("#car").hide();	
			$("#car input").removeAttr("required");
			$("#car select").removeAttr("required");
			$("#fuel select").removeAttr("required");
			$("#car_fuel").removeAttr("disabled");
		}
/*==================================================Jobs============================================*/
		if(cat_val=="17")
		{
			$("#job").show();
			$("#job input").attr("required","required");
			$("#job select").attr("required","required");
			$("#job_p").attr("disabled","disabled");
			$("#job_t").attr("disabled","disabled");
		}
		else
		{
			$("#job").hide();
			$("#job input").removeAttr("required");
			$("#job select").removeAttr("required");
			$("#job_p").removeAttr("disabled");
			$("#job_t").removeAttr("disabled");
		}
});
/*======================================Rea Estate>> Purpose ===========================================*/
});