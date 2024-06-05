<?php

    if (empty($_POST)){
        header('Location: ./index.php?page=list');
        die();
    }
    else{
        if($_POST['method'] === "modifier"){
            foreach($_SESSION['guitars'][$_POST['id']] as $key => $detail){
                if ($key != "image"){
                    $_SESSION['guitars'][$_POST['id']][$key] = $_POST[$key];
                }
            }
        }
        ?>
<h1>Détails de la guitare</h1>
<div class="details-container">
    <div class="main">
        <img class="image" src="./assets/images/<?= $_SESSION['guitars'][$_POST['id']]['image']?>"/>
        <h2><?= $_SESSION['guitars'][$_POST['id']]['nom']?></h2>
    </div>
    <div class="secondary">
        <div class="details">
            <div class="details--flex">
                <h3>Couleur</h3>
                <p><?= $_SESSION['guitars'][$_POST['id']]['couleur']?></p>
            </div>
            <div class="details--flex">
                <h3>Bois</h3>
                <p><?= $_SESSION['guitars'][$_POST['id']]['bois']?></p>
            </div>
            <div class="details--flex">
                <h3>Forme</h3>
                <p><?= $_SESSION['guitars'][$_POST['id']]['forme']?></p>
            </div>
            <div class="details--flex">
                <h3>Marque</h3>
                <p><?= $_SESSION['guitars'][$_POST['id']]['marque']?></p>
            </div>
        </div>
        <div class="button-flex">
            <form action="?page=modifier" method="post">
                <input type="hidden" name="id" id="id" value="<?= $_POST['id']?>">
                <button>modifier</button>
            </form>
            <form action="?page=list" method="post">
                <button>retour à la liste</button>
            </form>
        </div>
    </div>
</div>

<?php
    }