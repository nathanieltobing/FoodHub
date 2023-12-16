
var error_popup =document.getElementById("error");
var e_close=document.getElementById("e_button");
var buttons = document.getElementsByName("btnAdd");
var e_btn=document.getElementById("error_trigger");
let error = document.getElementById("hidden1");
console.log(buttons);
console.log(error.value);

window.onload=function(){ 
    for(var i=0;i<buttons.length;i++){
        buttons[i].onclick=function(){
            if(error.value == "1"){
                error_popup.style.display="block";
            }
        }
    }
}

e_close.onclick=function(){
    error_popup.style.display="none";
}
