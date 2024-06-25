<div class="guitar-container">

    <?php foreach ($list as $key => $guitar) : ?>
        <div class="guitar">
            <img class="guitar__image" src="<?= $this->link ?>assets/images/guitars/<?= $imagePath . $guitar['image'] ?>" />
            <h2><?= $guitar['nom'] ?></h2>
            <a href="..<?= $details ?>/details?id=<?= $guitar['id'] ?>">
                <button>Voir en détails</button>
            </a>
        </div>
    <?php endforeach; ?>

</div>