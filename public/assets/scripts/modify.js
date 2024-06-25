var btn_img = document.getElementById("fichier_image");
var txt_img = document.getElementById("fichier_image_choisit");

btn_img.addEventListener('change', function(){
    txt_img.textContent = btn_img.files[0].name;
});