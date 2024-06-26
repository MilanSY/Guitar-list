<?php
    
    if (!isset($_GET['id']) || $_SESSION['role'] !== 'admin'){
        header('Location: ../home');
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
    
    if (!empty($_POST)){

        foreach($_POST as $key => $value){
            if($key != "method"){
                $values[$key] = strip_tags($value);
            }
        }
        if($_POST['method'] === "modifier"){

            foreach($values as $key => $value){
                if ($key === "image"){
                    $new_name = "guitar-id-".$_GET['id'].".png";
                    $values[$key] = $new_name ;
                }
                else if(!empty($value)){
                    if(!is_under_255($_POST[$key])){
                        $errors[$key] = "Ce champs ne peut pas dépassé les 255 caractères";
                        $displays[$key] = "block";
                    }
                } 
                else 
                {
                    $errors[$key] = "Ce champs est obligatoire";
                    $displays[$key] = "block";
                }
            }
            if(empty_array($errors) && $_SESSION['role'] === 'admin'){
                if (!empty($_FILES ["fichier_image"]['name']))
                {
                    $uploads_dir = './assets/images/guitars/';
                    $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                    $new_name = "guitar-id-".$_GET['id'];
                    $destination = $uploads_dir . $new_name . "." . "png"; 
                    if (move_uploaded_file($tmp_name, $destination )) {
                        $fileContents = file_get_contents($destination);
                        $guitars[get_key_by_id($_GET['id'], $guitars)] = $values;
                        $json = json_encode($guitars, JSON_PRETTY_PRINT);
                        file_put_contents("includes/data/guitars.json",$json);
                        header("Location: ../details?id=".$_GET['id']);
                    } else {
                        $errors['image'] = "echec de l'envoi du fichier";
                        $displays['image'] = "block";
                    }
                }
                else{
                    $guitars[get_key_by_id($_GET['id'], $guitars)] = $values;
                    $json = json_encode($guitars, JSON_PRETTY_PRINT);
                    file_put_contents("includes/data/guitars.json",$json);
                    header("Location: ../details?id=".$_POST['id']);
                }
            }
        }
    }
    else
    {
        foreach($guitars[get_key_by_id($_GET['id'], $guitars)] as $key => $value){
            if($key != "method" && $key != "id"){
                $values[$key] = strip_tags($value);
            }
        }
    }
        ?>

        <div class="modify">
            <form action="?id=<?= ($_GET['id']) ?>" method="post" class="modify__form" enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?= $_GET['id']?>">
                <input type="hidden" name="method" id="method" value="modifier">
                <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
                    <div>
                        <p id="fichier_image_choisit"><?= $guitars[get_key_by_id($_GET['id'], $guitars)]['image'] ?></p>
                        <img src="./assets/images/svg/cloud.svg">
                    </div>
                    <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image"  name="fichier_image" hidden/>
                </label>
                <p class="errormsg" style="display: <?= $displays['image'] ?>"><?= $errors['image'] ?></p>
        
                <?php
                    foreach($values as $key => $detail){
                        if ($key != "image" && $key != "id"){
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
        <script src="./assets/scripts/modify.js"></script>
    