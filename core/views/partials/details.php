
<div class="details-container">
    <div class="main">
        <img class="image" src="<?= $link ?>assets/images/guitars/<?= $imagePath . $guitar['image'] ?>" />
        <h2><?= $guitar['nom'] ?></h2>
    </div>
    <div class="secondary">
        <div class="details">
            <?php
            foreach ($guitar as $key => $detail) :
                if ($key != "image" && $key != "nom" && $key != "id") : ?>

                    <div class="details--flex">
                        <h3><?= $key ?></h3>
                        <p><?= $detail ?></p>
                    </div>

            <?php endif;
            endforeach; ?>
        </div>
        <div class="button-flex">
            <?php if ($adminButton) : ?>
                <a href="../modifier?id=<?= $_GET['id'] ?>">
                    <button>modifier</button>
                </a>
            <?php endif ?>
            <a href="../home">
                <button>retour à la liste</button>
            </a>
        </div>
        <?php if ($adminButton) : ?>
            <div class="button-flex">
                <a href="../admin/supprimer?id=<?= $_GET['id'] ?>&tab=<?= $imagePath ?>">
                    <button>supprimer</button>
                </a>
                <?php if (!empty($imagePath)) : ?>
                    <a href="../admin/ajouter?id=<?= $_GET['id'] ?>">
                        <button>ajouter</button>
                    </a>
                <?php endif ?>
            </div>
        <?php endif ?>
    </div>
</div>