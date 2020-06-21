/*navbar js*/
$(document).ready(function(){
    $('.privacy_heading').click(function(){
        if($(this).children('P:last').text()=="-")
        {
            $(this).children('P:last').text('+')
        }
        else
        {
            $(this).children('P:last').text('-')
        }
        $(this).next().slideToggle();
    });
});
// Menubar scripting
function opennav()
{
    document.getElementById("mySlidenav").style.width="100%";
}
function closeNav()
{
    document.getElementById("mySlidenav").style.width="0";
}


// ad posting form js
/*$(document).ready(function(){
    function resetAll()
    {
        $("#mtldcb input").val('');
        $("#estate input").val('');
        $("#purpose").val('');
        $("#kefbsfph input").val('');
        $("#car input").val('');
        $("#car select").val('');
        $("#job input").val('');
        $("#job select").val('');
    }
    resetAll();
    $("#cat1").change(function(){
        var cat_val = $("#cat").val();
        if(cat_val=="1" || cat_val=="5"|| cat_val=="10" || cat_val=="2" || cat_val=="3" || cat_val=="4")
        {
            $("#mtldcb").show();
            $("#estate").hide();
            $("#kefbsfph").hide();
            $("#car").hide();
            $("#fuel").hide();
            $("#job").hide();
        }
        else if(cat_val=="19")
        {
            $("#estate").show();
            $("#mtldcb").hide();
            $("#kefbsfph").hide();
            $("#car").hide();
            $("#fuel").hide();
            $("#job").hide();
        }
        else if(cat_val=="12" || cat_val=="6" || cat_val=="11" || cat_val=="13" 
            || cat_val=="15" || cat_val=="16" || cat_val=="20")
        {
            $("#kefbsfph").show();
            $("#estate").hide();
            $("#mtldcb").hide();
            $("#car").hide();
            $("#fuel").hide();
            $("#job").hide();
        }
        else if(cat_val=="7")
        {
            $("#kefbsfph").hide();
            $("#estate").hide();
            $("#mtldcb").hide();
            $("#car").show();
            $("#fuel").show();
            $("#job").hide();
        }
        else if(cat_val=="8" || cat_val=="9")
        {
            $("#car").show();
            $("#kefbsfph").hide();
            $("#estate").hide();
            $("#mtldcb").hide();
            $("#fuel").hide();
            $("#job").hide();
        }
        else if(cat_val=="17")
        {
            $("#job").show();
            $("#kefbsfph").hide();
            $("#estate").hide();
            $("#mtldcb").hide();
            $("#car").hide();
            $("#fuel").hide();
        }
    });
});*/


function ad_posting_validate1()
{
    var state_name  = $("select[name='state_name']").val();
    var city_name   = $("select[name='city_name']").val();
    var locality    = $("input[name='locality']").val();
    var title       = $("input[name='title']").val();
    var cat_val     = $("select[name='cat']").val();
    var brand     	= $("select[name='brand']").val();
    var ad_images 	= $("input[name='ad_images[]']").val();
    if(title=="")
    {
        alert("Please Enter Title");
        return false;
    }
    else if(cat_val=="")
    {
        alert("Please Select Category");
        return false;
    }
    else if(brand=="")
    {
        alert("Please Select Sub Category");
        return false;
    }
    else if(cat_val=="1" || cat_val=="2" || cat_val=="3" || cat_val=="4" || cat_val=="5"|| cat_val=="10")
    {
        var mtldcb_price = $("input[name='mtldcb_price']").val();
        var mtldcb_model = $("input[name='mtldcb_model']").val();
        if(mtldcb_price=="")
        {
            alert("Please Enter Price");
            return false;
        }
        else if(mtldcb_model=="")
        {
            alert("Please Enter Model Name");
            return false;
        }
    }

    else if(cat_val=="19")
    {
        $("#estate").show();
        var realestate_purpose = $("select[name='realestate_purpose']").val();
        var realestate_size = $("input[name='realestate_size']").val();
        var realestate_rent = $("input[name='realestate_rent']").val();
        if(realestate_purpose=="")
        {
            alert("Please Enter Purpose");
            return false;
        }
        else if(realestate_size=="")
        {
            alert("Please Enter Size");
            return false;
        }
        else if(realestate_rent=="")
        {
            alert("Please Enter Price");
            return false;
        }
    }
    else if(cat_val=="12" || cat_val=="6" || cat_val=="11" || cat_val=="13" 
            || cat_val=="15" || cat_val=="16" || cat_val=="20")
    {
        var kefbsfph_price = $("input[name='kefbsfph_price']").val();
        if(kefbsfph_price=="")
        {
            alert("Please Enter Price");
            return false;
        }
    }
    else if(cat_val=="7")
    {
        var cbs_model = $("input[name='cbs_model']").val();
        var cbs_price = $("input[name='cbs_price']").val();
        var cbs_driven = $("input[name='cbs_driven']").val();
        var cbs_year = $("input[name='cbs_year']").val();
        var car_fuel = $("select[name='car_fuel']").val();
        if(cbs_model=="")
        {
            alert("Please Enter Model");
            return false;
        }
        else if(cbs_price=="")
        {
            alert("Please Enter Price");
            return false;
        }
        else if(cbs_driven=="")
        {
            alert("Please Enter Driven km");
            return false;
        }
        else if(cbs_year=="")
        {
            alert("Please Enter Model Year");
            return false;
        }
        else if(car_fuel=="")
        {
            alert("Please Enter Fuel Mode");
            return false;
        }

    }
    else if(cat_val=="8" || cat_val=="9")
    {
        var cbs_model = $("input[name='cbs_model']").val();
        var cbs_price = $("input[name='cbs_price']").val();
        var cbs_driven = $("input[name='cbs_driven']").val();
        var cbs_year = $("input[name='cbs_year']").val();
        if(cbs_model=="")
        {
            alert("Please Enter Model");
            return false;
        }
        else if(cbs_price=="")
        {
            alert("Please Enter Price");
            return false;
        }
        else if(cbs_driven=="")
        {
            alert("Please Enter Driven km");
            return false;
        }
        else if(cbs_year=="")
        {
            alert("Please Enter Model Year");
            return false;
        }
    }
    else if(cat_val=="17")
    {
        var job_income_type = $("select[name='job_income_type']").val();
        var job_position_type = $("select[name='job_position_type']").val();
        var job_salary_range = $("input[name='job_salary_range']").val();
        if(job_income_type=="")
        {
            alert("Please Select Income Type");
            return false;
        }
        else if(job_position_type=="")
        {
            alert("Please Select Posistion Type");
            return false;
        }
        else if(job_salary_range=="")
        {
            alert("Please Enter Salary Range");
            return false;
        }
    }
    else if(state_name=="")
    {
        alert("Please Select State Name");
        return false;
    }

    else if(city_name=="")
    {
        alert("Please Select City Name");
        return false;
    }

    else if(locality=="")
    {
        alert("Please Enter Landmark");
        return false;
    }
    else if(ad_images=="")
    {
        alert("Please Select Image");
        return false;
    }
    else if($('#accept_terms').prop('checked')!=true)
    {
        alert("Please check agreement");
        return false;
    }
    
}

function signup_validate()
{
    var regex = /^[a-zA-Z ]+$/;
    var patt3 = /^[a-z0-9](\.?[a-z0-9_-]){0,}@[a-z0-9-]+\.([a-z]{1,6}\.)?[a-z]{2,6}$/i;
    if($("#email").val()=="")
    {
        $("#error").text("Email required!");
        $("#email").focus();
        return false;
    }
    else if(!$("#email").val().match(patt3))
    {
        $("#error").text("Incorrect Email");
        $("#email").focus();
        return false;
    }
   else if($("#username").val()=="")
    {
        $("#username").focus();
        $("#error").text("User Name required");
        return false;
    }
    
    else if($("#contact1").val()=="")
    {
        $("#contact1").focus();
         $("#error").text("Contact1 required");
        return false;
    }
    else if($("#contact1").val().length!=10)
    {
        $("#contact1").focus();
        $("#error").text("Incorrect Mobile Number Lenght!")
        return false;
    }
    else if($("#contact1").val().slice(0,1)<6)
    {
        $("#contact1").focus();
        $("#error").text("Incorrect Mobile Number!");
        return false;
    }
    else if($("#password").val()=="")
    {
        $("#password").focus();
        return false;
    }
    else if($("#password").val().length<5)
    {
        $("#password").focus();
        $("#error").text("Password must be greater 5 characters");
        return false;
    } 
}


    var ifrtl = false;
    var dir = $("html").attr("dir");
    var direction = "left";

    if(dir == "rtl")  {
         ifrtl = true;
        // console.log(ifrtl);
         direction = "right";
        // console.log(direction)
    }else {
        // console.log(ifrtl);
        // console.log(direction)
    }
    var sidebarDirection = {};
    var sidebarDirectionClose = {};

    if(ifrtl) {
        sidebarDirection = { right: '-251px' };
        sidebarDirectionClose = { right: '0' };
    }
    else {
        sidebarDirection = { left: '-251px' };
        sidebarDirectionClose = { left: '0' };
     }  
     $(".filter-toggle").click(function () {
    $('.mobile-filter-sidebar')
        .prepend("<div class='closeFilter'>X</div>")
        .animate(sidebarDirectionClose, 250, "linear", function () {
        });
    $('.menu-overly-mask').addClass('is-visible');
});

$(".menu-overly-mask").click(function () {
    $(".mobile-filter-sidebar").animate(sidebarDirection, 250, "linear", function () {
    });
    $('.menu-overly-mask').removeClass('is-visible');
});


$(document).on('click', '.closeFilter', function () {
    $(".mobile-filter-sidebar").animate(sidebarDirection, 250, "linear", function () {
    });
    $('.menu-overly-mask').removeClass('is-visible');
});

$(".maxlist-more").click(function(){
    event.preventDefault();
    $(".maxlist-hidden").css('display','block');
    $(".maxlist-more").css("display","none")
    $(".maxlist-less").css("display","block")
});
$(".maxlist-less").click(function(){
    event.preventDefault();
    $(".maxlist-hidden").css('display','none');
    $(".maxlist-more").css("display","block")
    $(".maxlist-less").css("display","none")
});

