<div class="modify">

    <form action="<?php if (!empty($modify)) {
                        echo "../modifier?id=" . ($_GET['id']);
                    } ?>" method="post" class="modify__form" enctype="multipart/form-data">
        <?php
        if (!empty($_GET)) :
            if (isset($_GET['success'])) : ?>
                <p>Votre guitare a été envoyé avec succès</p>
        <?php endif;
        endif; ?>

        <input type="hidden" name="method" id="method" value="send">
        <label for="fichier_image">fichier image: (png, jpeg, jpg, webp)*<br>
            <div>
                <p id="fichier_image_choisit"><?php if (!empty($modify)) {
                                                    echo $values['image'];
                                                } ?></p>
                <img src="./assets/images/svg/cloud.svg">
            </div>
            <input type="file" accept="image/png, image/jpeg, image/jpg, image/webp" id="fichier_image" name="fichier_image" hidden />
        </label>
        <?php if (!empty($errors) && !empty($displays)) : ?>
            <p class="errormsg" style="display: <?= $displays['image'] ?>"><?= $errors['image'] ?></p>
        <?php endif; ?>
        <?php
        foreach ($values as $key => $detail) :
            if ($key != "image" && $key != "id") :
        ?>

                <label for="<?= $key ?>">
                    <h3> <?= $key ?> : </h3>
                </label>
                <input name="<?= $key ?>" id="<?= $key ?>" value="<?= $detail ?>" />
                <p class="errormsg" style="display: <?= $displays[$key] ?>"><?= $errors[$key] ?></p>

        <?php
            endif;
        endforeach;
        ?>

        <button>envoyer</button>

    </form>
</div>
<script src="./assets/scripts/modify.js"></script>