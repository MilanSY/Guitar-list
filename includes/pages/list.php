


<div class="guitar-container">

    <?php

    foreach($guitars as $key => $guitar){
    ?>

    <div class="guitar">
        <img class="guitar__image" src="./assets/images/guitars/<?= $guitar['image']?>"/>
        <h2><?= $guitar['nom']?></h2>
        <form action="" method="get">
            <input type="hidden" name="page" id="page" value="details">
            <input type="hidden" name="id" id="id" value="<?= $key ?>">
            <button>Voir en détails</button>
        </form>
    </div>

    <?php } ?>

</div>