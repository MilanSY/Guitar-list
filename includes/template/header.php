<header>
    <?php if (empty($_SESSION)){?>
        <a href="<?= $left_path ?>"><button><?= $left_button ?></button></a>
    <?php }else{ ?>
        <div class="connected">
            <img src="./assets/images/users/<?= $_SESSION["image"] ?>">
            <button id="btn_session"><?= $_SESSION['name'] ?></button>
            <div id="div_session">
                <a href="../deconnexion"><button>déconnexion</button></a>
                <?php
                if ($_SESSION["role"] === "admin"){ ?>
                    <a href="../admin"><button>admin</button></a>
                <?php } ?>
            </div>
        </div>
    <?php } ?>

    
    <h1><?= $header_title ?></h1>
    <a href="<?= $right_path ?>"><button><?= $right_button ?></button></a>
</header>
<?php
if (!empty($_SESSION)){?>
    <script src="./assets/scripts/header.js"></script>
<?php } ?>