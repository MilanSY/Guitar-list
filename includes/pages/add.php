<?php
    if (!empty($_POST)){
        if($_POST['method'] === "ajouter"){

            $errors=[
                "nom" => "",
                "image" => "",
                "couleur" => "",
                "forme" => "",
                "marque" => "",
                "bois" => ""
            ];
            $value=[
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
            
            

            foreach($_POST as $key => $value){
                if(isset($value)){
                    $values[$key] = "value='".$value."'";
                    if(!is_under_255($_POST[$key])){
                        $errors[$key] = "Ce champs ne peut pas dépassé les 255 caractères";
                        $displays[$key] = "block";
                    }
                }
            }



            foreach($guitars[$_POST['id']] as $key => $detail){
                if ($key != "image"){
                    $guitars[$_POST['id']][$key] = $_POST[$key];
                }
                else if ($key = 'image' && $_FILES["error"] == UPLOAD_ERR_OK)
                {
                    $uploads_dir = './assets/images/guitars/';
                    var_dump($_FILES);
                    $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                    list($file_name, $file_extention) = explode(".",$_FILES["name"]);
                    $new_name = "guitar-id-".$_POST['id'];
                    $destination = $uploads_dir . $new_name . "." . "png"; 
                    $guitars[$_POST['id']]['image'] = $new_name . "." . "png";
                    var_dump($destination);
                    if (move_uploaded_file($tmp_name, $destination )) {
                        $fileContents = file_get_contents($destination);
                    } else {
                        echo "Failed to move the file.";
                    }
                } 
            }
            $json = json_encode($guitars, JSON_PRETTY_PRINT);
            file_put_contents("includes/data/guitars.json",$json);
            header("Location: ./index.php?page=details&&id=".$_POST['id']);
        }
    }
        ?>

        <div class="modify">
            <form action="?page=add?>" method="post" class="modify__form" enctype="multipart/form-data">

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
                    foreach($guitars[$_GET['id']] as $key => $detail){
                        if ($key != "image"){
                            ?>

                                <label for="<?= $key ?>"><h3> <?= $key ?> : </h3></label>
                                <input name="<?= $key ?>" id="<?= $key ?>" value="<?= htmlentities($detail) ?>" />

                            <?php
                        }
                    }
                ?>
 
                <button>ajouter</button>

            </form>
        </div>

        <?php
    