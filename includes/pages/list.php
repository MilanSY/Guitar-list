


<div class="guitar-container">

    <?php

    foreach($guitars as $key => $guitar){
    ?>

    <div class="guitar">
        <img class="guitar__image" src="./assets/images/guitars/<?= $guitar['image']?>"/>
        <h2><?= $guitar['nom']?></h2>
        <a href="/details/<?= $key ?>">
            <button>Voir en détails</button>
        </a>
    </div>

    <?php } ?>

</div>