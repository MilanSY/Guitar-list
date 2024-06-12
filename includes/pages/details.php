<?php

    if (!isset($_GET['id']) ){
        header('Location: ../home');
        die();
    }
    else{
        
        ?>

        <div class="details-container">
            <div class="main">
                <img class="image" src="./assets/images/guitars/<?= $guitars[$_GET['id']]['image']?>"/>
                <h2><?= $guitars[$_GET['id']]['nom']?></h2>
            </div>
            <div class="secondary">
                <div class="details">
                    <div class="details--flex">
                        <h3>Couleur</h3>
                        <p><?= $guitars[$_GET['id']]['couleur']?></p>
                    </div>
                    <div class="details--flex">
                        <h3>Bois</h3>
                        <p><?= $guitars[$_GET['id']]['bois']?></p>
                    </div>
                    <div class="details--flex">
                        <h3>Forme</h3>
                        <p><?= $guitars[$_GET['id']]['forme']?></p>
                    </div>
                    <div class="details--flex">
                        <h3>Marque</h3>
                        <p><?= $guitars[$_GET['id']]['marque']?></p>
                    </div>
                </div>
                <div class="button-flex">
                    <?php 
                    if (!empty($_SESSION)){
                    if($_SESSION['role'] === 'admin'){ ?>
                    <a href="../modifier?id=<?= $_GET['id']?>">
                        <button>modifier</button>
                    </a>
                    <?php }} ?>
                    <a href="../home">
                        <button>retour à la liste</button>
                    </a>
                </div>
            </div>
        </div>

<?php
    }