var btn_session = document.getElementById("btn_session");
var div_session = document.getElementById("div_session");

btn_session.addEventListener("click",function(){
    if (div_session.style.display === "none"){
        div_session.style.display = "flex";
        div_session.style.animation = "appear 0.5s";
    }
    else{
        div_session.style.animation = "disappear 0.5s";
        setTimeout(function(){
            div_session.style.display = "none";
        },500)
    }
});