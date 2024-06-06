<?php
    
    if (!isset($_GET['id'])){
        header('Location: ./index.php?page=list');
        die();
    }

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
    
    var_dump($_POST);
    if (!empty($_POST)){

        foreach($_POST as $key => $value){
            if($key != "method" && $key != "id"){
                $values[$key] = htmlspecialchars($value);
            }
        }
        if($_POST['method'] === "modifier"){

            foreach($values as $key => $value){
                if ($key === "image"){
                    $new_name = "guitar-id-".$_GET['id'].".png";
                    $values[$key] = $new_name ;
                }
                else if(!empty($value)){
                    $values[$key] = htmlentities($value);
                    if(!is_under_255($_POST[$key])){
                        $errors[$key] = "Ce champs ne peut pas dépassé les 255 caractères";
                        $displays[$key] = "block";
                    }
                } 
                else 
                {
                    $errors[$key] = "Ce champs est obligatoire";
                    $displays[$key] = "block";
                    var_dump($key);
                }
            }
            var_dump($errors);
            if(empty_array($errors)){
                var_dump($_FILES);
                if ($_FILES['name'] != "0")
                {
                    $uploads_dir = './assets/images/guitars/';
                    $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                    $new_name = "guitar-id-".$_GET['id'];
                    $destination = $uploads_dir . $new_name . "." . "png"; 
                    var_dump($destination);
                    if (move_uploaded_file($tmp_name, $destination )) {
                        $fileContents = file_get_contents($destination);
                        $guitars[$_GET['id']] = $values;
                        $json = json_encode($guitars, JSON_PRETTY_PRINT);
                        file_put_contents("includes/data/guitars.json",$json);
                        header("Location: ./index.php?page=details&&id=".$_GET['id']);
                    } else {
                        echo "Failed to move the file.";
                    }
                }
                else{
                    $guitars[$_GET['id']] = $values;
                    $json = json_encode($guitars, JSON_PRETTY_PRINT);
                    file_put_contents("includes/data/guitars.json",$json);
                    header("Location: ./index.php?page=details&&id=".$_POST['id']);
                }
            }
        }
    }
    else
    {
        foreach($guitars[$_GET['id']] as $key => $value){
            if($key != "method" && $key != "id"){
                $values[$key] = htmlspecialchars($value);
            }
        }
    }
        ?>

        <div class="modify">
            <form action="?page=modifier&id=<?= $_GET['id'] ?>" method="post" class="modify__form" enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?= $_GET['id']?>">
                <input type="hidden" name="method" id="method" value="modifier">
                <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
                    <div>
                        <p id="fichier_image_choisit"><?= $guitars[$_GET['id']]['image'] ?></p>
                        <img src="./assets/images/svg/cloud.svg">
                    </div>
                    <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image"  name="fichier_image" hidden/>
                </label>
                <?php
                    foreach($values as $key => $detail){
                        if ($key != "image"){
                            ?>

                                <label for="<?= $key ?>"><h3> <?= $key ?> : </h3></label>
                                <input name="<?= $key ?>" id="<?= $key ?>" value="<?= $detail ?>" />
                                <p class="errormsg" style="display: <?= $displays[$key] ?>"><?= $errors[$key] ?></p>

                            <?php
                        }
                    }
                ?>
 
                <button>envoyer</button>

            </form>
        </div>
        <script src="assets/scripts/modify.js"></script>

        <?php
    