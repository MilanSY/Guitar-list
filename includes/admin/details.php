<?php
if (!isset($_GET['id']) ){
        header('Location: ../home');
        die();
    }
    else{
        
        ?>

        <div class="details-container">
            <div class="main">
                <img class="image" src="<?= $link ?>assets/images/guitars/incoming/<?= get_guitar_by_id($_GET['id'], $incoming)['image'] ?>"/>
                <h2><?= get_guitar_by_id($_GET['id'], $incoming)['nom']?></h2>
            </div>
            <div class="secondary">
                <div class="details">
                    <?php
                        foreach(get_guitar_by_id($_GET['id'], $incoming) as $key => $detail){
                            if ($key != "image" && $key != "nom" && $key != "id"){
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
                    <a href="../admin/modifier?id=<?= $_GET['id'] ?>">
                        <button>modifier</button>
                    </a>
                    <a href="../admin">
                        <button>retour à la liste</button>
                    </a>
                </div>
                <div class="button-flex">
                    <a href="../admin/ajouter?id=<?= $_GET['id'] ?>">
                        <button>ajouter</button>
                    </a>
                    <a href="../admin/supprimer?id=<?= $_GET['id'] ?>&tab=incoming">
                        <button>supprimer</button>
                    </a>
                </div>
            </div>
        </div>

<?php
    }