<?php
    if(empty($_GET['paging'])){
        $_GET['paging'] = "1";
    }
    if($_GET['paging'] < 1){
        $_GET['paging'] = "1";
    }
    if($_GET['paging'] > count($paging_incoming)){
        $_GET['paging'] = count($paging_incoming);
    }
    $list = $paging_incoming[$_GET['paging']];

?>

<div class="guitar-container">

    <?php

    foreach($list as $key => $guitar){
    ?>

        <div class="guitar">
            <img class="guitar__image" src="<?= $link ?>assets/images/guitars/incoming/<?= $guitar['image']?>"/>
            <h2><?= $guitar['nom']?></h2>
            <a href="../admin/details?id=<?= $guitar['id'] ?>">
                <button>Voir en détails</button>
            </a>
        </div>
    
    <?php } ?>
    

</div>

<div class="paging">
    
    <a <?php if(!($_GET['paging'] <= 1)){?>href="?paging=<?= $_GET['paging']-1 ?>" <?php } ?>><button><</button></a>
    <?php 
    foreach($paging_incoming as $key => $tab){ 
    ?>

        <a href="?paging=<?= $key ?>">
            <button <?php if($key == $_GET['paging']){echo 'style="background-color:#208253;"';} ?> ><?= $key ?></button>
        </a>

    <?php }?>
    <a <?php if (!($_GET['paging'] >= count($paging_incoming))){ ?>href="?paging=<?= $_GET['paging']+1 ?>" <?php } ?>><button>></button></a>
    
</div>