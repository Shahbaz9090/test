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
/*==================================When chenge the category ====================================*/
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
	/*==========================Mobiles Cameras Tablets Laptops Desktops and Bycycles========================*/
		if(cat_val=="Mobiles" || cat_val=="Cameras"|| cat_val=="Bicycles" || cat_val=="Tablets" || cat_val=="Laptops" || cat_val=="Desktops")
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
		if(cat_val=="Real Estates")
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
		if(cat_val=="Kitchens" || cat_val=="Electronics" || cat_val=="Furnitures" || cat_val=="Books" || cat_val=="Sports" 
			|| cat_val=="Fashions" || cat_val=="Pets" || cat_val=="Hobbies")
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
		if(cat_val=="Cars")
		{
			$("#car").show();
			$("#car select").attr("required","required");
			$("#car input").attr("required","required");
			$("#car_fuel").attr("disabled","disabled");
		}
		else if(cat_val=="Bikes" || cat_val=="Scooters")
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
		if(cat_val=="Jobs")
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