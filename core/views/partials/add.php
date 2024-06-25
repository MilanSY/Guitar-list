

?>

<div class="modify">
    <form action="" method="post" class="modify__form" enctype="multipart/form-data">

        <?php
        if (!empty($_GET)) {
            if (isset($_GET['success'])) { ?>
                <p>Votre guitare a été envoyé avec succès</p>
        <?php }
        } ?>

        <input type="hidden" name="id" id="id" value="<?= get_next_id($guitars) ?>">
        <input type="hidden" name="method" id="method" value="ajouter">
        <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
            <div>
                <p id="fichier_image_choisit">choisir une image</p>
                <img src="./assets/images/svg/cloud.svg">
            </div>
            <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image" name="fichier_image" hidden />
        </label>
        <p class="errormsg" style="display: <?= $displays['image'] ?>"><?= $errors['image'] ?></p>

        <?php
        foreach ($values as $key => $detail) {
            if ($key != "image" && $key != "id") {
        ?>

                <label for="<?= $key ?>">
                    <h3> <?= $key ?> : </h3>
                </label>
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
