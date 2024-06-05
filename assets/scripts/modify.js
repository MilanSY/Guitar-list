var btn_exo = document.getElementById("fichier_exercice");
var txt_exo = document.getElementById("fichier_exercice_choisit");

btn_exo.addEventListener('change', function(){
    txt_exo.textContent = btn_exo.files[0].name;
});