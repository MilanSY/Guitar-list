<?php

    if (!isset($_GET['id'])){
        header('Location: ./index.php?page=list');
        die();
    }
    else{
        if($_POST['method'] === "modifier"){
            foreach($data['guitars'][$_POST['id']] as $key => $detail){
                if ($key != "image"){
                    $data['guitars'][$_POST['id']][$key] = $_POST[$key];
                }
                else if ($key = 'image' && $_FILES["error"] == UPLOAD_ERR_OK)
                {
                    $uploads_dir = './assets/images/';
                    var_dump($_FILES);
                    $tmp_name = $_FILES["tmp_name"];
                    list($file_name, $file_extention) = explode(".",$_FILES["name"]);
                    $new_name = $data['guitars'][$_POST['id']]['nom'];
                    $alias_name =  explode(" ", $new_name);
                    $new_name = implode("-", $alias_name);
                    $destination = $uploads_dir . $new_name . "." . "png"; 
                    $data['guitars'][$_POST['id']]['image'] = $new_name . "." . "png";
                    var_dump(move_uploaded_file($tmp_name, $destination ));
                    if (move_uploaded_file($tmp_name, $destination )) {
                        $fileContents = file_get_contents($destination);
                        echo "ok17";
                    } else {
                        echo "Failed to move the file.";
                    }
                } 
            }
            $json = json_encode($data, JSON_PRETTY_PRINT);
            file_put_contents("includes/data/data.json",$json);
        }
        ?>

        <h1>Modifier la guitare</h1>
        <div class="modify">
            <form action="?page=modifier&id=<?= $_GET['id'] ?>" method="post" class="modify__form" enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?= $_GET['id']?>">
                <input type="hidden" name="method" id="method" value="modifier">
                <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
                    <div>
                        <p id="fichier_image_choisit"><?= $data['guitars'][$_GET['id']]['image'] ?></p>
                        <img src="./assets/images/svg/cloud.svg">
                    </div>
                    <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image"  name="fichier_image" hidden/>
                </label>
                <?php
                    foreach($data['guitars'][$_GET['id']] as $key => $detail){
                        if ($key != "image"){
                            ?>

                                <label for="<?= $key ?>"><h3> <?= $key ?> : </h3></label>
                                <input name="<?= $key ?>" id="<?= $key ?>" value="<?= htmlentities($detail) ?>" />

                            <?php
                        }
                    }
                ?>
 
                <button>envoyer</button>

            </form>
        </div>
        <script src="assets/scripts/modify.js"></script>

        <?php
    }