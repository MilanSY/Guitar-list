

<h1>Listes des Guitares</h1>
<div class="guitar-container">

    <?php

    foreach($_SESSION['guitars'] as $key => $guitar){
    ?>

    <div class="guitar">
        <img class="guitar__image" src="./assets/images/<?= $guitar['image']?>"/>
        <h2><?= $guitar['nom']?></h2>
        <div class="guitar__details">
            <div class="guitar__details--flex">
                <h3>Couleur</h3>
                <p><?= $guitar['couleur']?></p>
            </div>
            <div class="guitar__details--flex">
                <h3>Bois</h3>
                <p><?= $guitar['bois']?></p>
            </div>
            <div class="guitar__details--flex">
                <h3>Forme</h3>
                <p><?= $guitar['forme']?></p>
            </div>
            <div class="guitar__details--flex">
                <h3>Marque</h3>
                <p><?= $guitar['marque']?></p>
            </div>
        </div>
        <form action="?page=details" method="post">
            <input type="hidden" name="id" id="id" value="<?= $key ?>">
            <button>Voir en détails</button>
        </form>
    </div>

    <?php } ?>

</div>