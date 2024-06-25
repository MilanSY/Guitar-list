var burger_menu = document.getElementById("burger_menu");
var burger_menu_out = document.getElementById("burger_menu_out");
var side_bar = document.getElementById("flex_side_bar");
var background_side_bar = document.getElementById("background_side_bar");

burger_menu.addEventListener("click",openNav);

burger_menu_out.addEventListener("click",closeNav);

background_side_bar.addEventListener("click",closeNav);

function openNav() {
    side_bar.style.marginLeft = "0px";
    side_bar.style.width = "100%";
    background_side_bar.style.display = "block";

}

function closeNav() {
    side_bar.style.marginLeft = "-350px";
    side_bar.style.width = "fit-content";
    background_side_bar.style.display = "none";
}
