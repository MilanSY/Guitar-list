var burger_menu = document.getElementById("burger_menu");
var burger_menu_out = document.getElementById("burger_menu_out");
var side_bar = document.getElementById("side_bar");

burger_menu.addEventListener("click",openNav);

burger_menu_out.addEventListener("click",closeNav);

function openNav() {
    side_bar.style.marginLeft = "0px";
}

function closeNav() {
    side_bar.style.marginLeft = "-350px";
}
