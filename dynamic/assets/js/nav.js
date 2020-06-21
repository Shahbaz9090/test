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


