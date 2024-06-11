
<?php
    if(empty($_GET['paging'])){
        $_GET['paging'] = "1";
    }
    $list = $paging[$_GET['paging']];

    if($_GET['paging'] < 1){
        $_GET['paging'] = "1";
    }
    if($_GET['paging'] > count($paging)){
        $_GET['paging'] = count($paging);
    }
?>

<div class="guitar-container">

    <?php

    foreach($list as $key => $guitar){
    ?>

        <div class="guitar">
            <img class="guitar__image" src="./assets/images/guitars/<?= $guitar['image']?>"/>
            <h2><?= $guitar['nom']?></h2>
            <a href="/details?id=<?= $key+3*intval($_GET['paging']-1) ?>">
                <button>Voir en détails</button>
            </a>
        </div>
    
    <?php } ?>
    

</div>

<div class="paging">
    <?php
    if(!($_GET['paging'] <= 1)){ 
    ?>
        <a href="?paging=<?= $_GET['paging']-1 ?>"><button><</button></a>
    <?php }
    foreach($paging as $key => $tab){ 
    ?>

        <a href="?paging=<?= $key ?>"><button ><?= $key ?></button></a>

    <?php }
    if (!($_GET['paging'] >= count($paging))){
    ?>
        <a href="?paging=<?= $_GET['paging']+1 ?>"><button>></button></a>
    <?php } ?>
</div>