<?php

    if (empty($_POST)){
        header('Location: ./index.php?page=list');
        die();
    }
    else{
        ?>

        <h1>Modifier la guitare</h1>
        <div class="modify">
            <form action="?page=details" method="post" class="modify__form" enctype="multipart/form-data">

                <input type="hidden" name="id" id="id" value="<?= $_POST['id']?>">
                <input type="hidden" name="method" id="method" value="modifier">
                <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
                    <div>
                        <p id="fichier_image_choisit"><?= $values["fichier_image"] ?></p>
                        <img src="./assets/icons/upload_cloud.svg">
                    </div>
                    <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image"  name="fichier_image" hidden/>
                </label>
                <?php
                    foreach($_SESSION['guitars'][$_POST['id']] as $key => $detail){
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