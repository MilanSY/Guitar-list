<?php
    $errors=[
        "nom" => "",
        "image" => "",
        "couleur" => "",
        "forme" => "",
        "marque" => "",
        "bois" => ""
    ];
    $values=[
        "nom" => "",
        "image" => "",
        "couleur" => "",
        "forme" => "",
        "marque" => "",
        "bois" => ""
    ];
    $display=[
        "nom" => "none",
        "image" => "none",
        "couleur" => "none",
        "forme" => "none",
        "marque" => "none",
        "bois" => "none"
    ];


    if (!empty($_POST)){
        if($_POST['method'] === "ajouter"){
            


            foreach($_POST as $key => $value){
                if(!empty($value) && $key != "method" && $key != "id"){
                    $values[$key] = htmlentities($value);
                    if(!is_under_255($_POST[$key])){
                        $errors[$key] = "Ce champs ne peut pas dépassé les 255 caractères";
                        $displays[$key] = "block";
                    }
                } 
                else if($key != "method" && $key != "id") 
                {
                    $errors[$key] = "Ce champs est obligatoire";
                    $displays[$key] = "block";
                }
            }


            if(empty_array($errors)){
                if ($_FILES["error"] == UPLOAD_ERR_OK && $_FILES['name'] != "0"){
                    $uploads_dir = './assets/images/guitars/';
                    $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                    list($file_name, $file_extention) = explode(".",$_FILES["name"]);
                    $new_name = "guitar-id-".$_POST['id'];
                    $destination = $uploads_dir . $new_name . "." . "png"; 
                    $values['image'] = $new_name . "." . "png";
                    if (move_uploaded_file($tmp_name, $destination )) {
                        $guitars[] = $values;
                        $json = json_encode($guitars, JSON_PRETTY_PRINT);
                        file_put_contents("includes/data/guitars.json",$json);
                        header("Location: ./index.php?page=details&&id=".$_POST['id']);
                    } else {
                        echo "Failed to move the file.";
                    }
                } 
            }
        }
    }
    
?>

<div class="modify">
    <form action="?page=ajouter" method="post" class="modify__form" enctype="multipart/form-data">

        <input type="hidden" name="id" id="id" value="<?= count($guitars)?>">
        <input type="hidden" name="method" id="method" value="ajouter">
        <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
            <div>
                <p id="fichier_image_choisit"><?= $guitars[$_GET['id']]['image'] ?></p>
                <img src="./assets/images/svg/cloud.svg">
            </div>
            <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image"  name="fichier_image" hidden/>
        </label>
        <?php
            foreach($values as $key => $detail){
                if ($key != "image" && $key != "id"){
                    ?>

                        <label for="<?= $key ?>"><h3> <?= $key ?> : </h3></label>
                        <input name="<?= $key ?>" id="<?= $key ?>" value="<?= $values[$key] ?>" />
                        <p class="errormsg" style="display: <?= $displays[$key] ?>"><?= $errors[$key] ?></p>

                    <?php
                }
            }
        ?>

        <button>ajouter</button>

    </form>
</div>
<script src="assets/scripts/modify.js"></script>
<?php
    