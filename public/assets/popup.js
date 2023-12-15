function togglePopup()
{
    document.getElementById("popup-1").classList.toggle("active");
}

var error_popup =document.getElementById("error");
var e_close=document.getElementById("e_button");
var e_btn=document.getElementById("error_trigger");

e_btn.onclick =function(){
    error_popup.style.display="block";
}

e_close.onclick=function(){
    error_popup.style.display="none";
}
