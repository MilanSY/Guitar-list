<?php

if (!isset($_GET['id'])) {
    header('Location: ../home');
    die();
} else {

?>

    <div class="details-container">
        <div class="main">
            <img class="image" src="./assets/images/guitars/<?= get_guitar_by_id($_GET['id'], $guitars)['image'] ?>" />
            <h2><?= get_guitar_by_id($_GET['id'], $guitars)['nom'] ?></h2>
        </div>
        <div class="secondary">
            <div class="details">
                <?php
                foreach (get_guitar_by_id($_GET['id'], $guitars) as $key => $detail) {
                    if ($key != "image" && $key != "nom" && $key != "id") {
                ?>

                        <div class="details--flex">
                            <h3><?= $key ?></h3>
                            <p><?= $detail ?></p>
                        </div>

                <?php
                    }
                }
                ?>
            </div>
            <div class="button-flex">
                <?php
                if (!empty($_SESSION)) {
                    if ($_SESSION['role'] === 'admin') { ?>
                        <a href="../modifier?id=<?= $_GET['id'] ?>">
                            <button>modifier</button>
                        </a>
                <?php }
                } ?>
                <a href="../home">
                    <button>retour à la liste</button>
                </a>
            </div>
            <?php
            if (!empty($_SESSION)) {
                if ($_SESSION['role'] === 'admin') { ?>
                    <div class="button-flex">
                        <a href="../admin/supprimer?id=<?= $_GET['id'] ?>&tab=guitars">
                            <button>supprimer</button>
                        </a>
                    </div>
            <?php }
            } ?>
        </div>
    </div>

<?php
}
