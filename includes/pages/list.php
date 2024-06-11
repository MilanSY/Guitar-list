
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
    
    <a <?php if(!($_GET['paging'] <= 1)){?>href="?paging=<?= $_GET['paging']-1 ?>" <?php } ?>><button><</button></a>
    <?php 
    foreach($paging as $key => $tab){ 
    ?>

        <a href="?paging=<?= $key ?>">
            <button <?php if($key == $_GET['paging']){echo 'style="background-color:#208253;"';} ?> ><?= $key ?></button>
        </a>

    <?php }?>
    <a <?php if (!($_GET['paging'] >= count($paging))){ ?>href="?paging=<?= $_GET['paging']+1 ?>" <?php } ?>><button>></button></a>
    
</div>