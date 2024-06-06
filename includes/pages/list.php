
<header>
    <a><button>connexion</button></a>
    <h1>Listes des Guitares</h1>
    <a><button>ajouter</button></a>
</header>

<div class="guitar-container">

    <?php

    foreach($guitars as $key => $guitar){
    ?>

    <div class="guitar">
        <img class="guitar__image" src="./assets/images/guitars/<?= $guitar['image']?>"/>
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
        <form action="" method="get">
            <input type="hidden" name="page" id="page" value="details">
            <input type="hidden" name="id" id="id" value="<?= $key ?>">
            <button>Voir en détails</button>
        </form>
    </div>

    <?php } ?>

</div>