function isNumberKey(obj,evt) {
	var val = obj.value;
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!(charCode > 47 && charCode < 58) || val.length >9)
        return false;

    return true;
}
function isNumberKeyDot(obj, evt) {
    var txt = obj.value;
    // alert(txt);
    var dotcontainer = txt.split('.');
    var charCode = (evt.which) ? evt.which : event.keyCode;
    //alert(event.keyCode);
    if (!(dotcontainer.length == 1 && charCode == 46) && charCode > 31 && (charCode < 48 || charCode > 57))
        return false;

    return true;
}
function isalphakey(obj,evt) {
	var val = obj.value;
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode >= 65 && charCode <= 90 ) || (charCode >= 97 && charCode <= 122 ) || (charCode==32))
        return true;

    return false;
} 
	function isNumberKey2(obj,evt) {
		var val = obj.value;
    var charCode = (evt.which) ? evt.which : event.keyCode;
    if (!(charCode > 47 && charCode < 58) || val.length ==2)
        return false;

    return true;
} 

/*ad posting form*/
