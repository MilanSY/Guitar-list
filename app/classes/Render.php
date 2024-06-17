<?php

namespace App\Classes;

class Render
{
    public static function renderList(array $list)
    {
    ?>
        <div class="guitar-container">

            <?php
            foreach ($list as $key => $guitar) {
            ?>

                <div class="guitar">
                    <img class="guitar__image" src="./assets/images/guitars/<?= $guitar['image'] ?>" />
                    <h2><?= $guitar['nom'] ?></h2>
                    <a href="/details?id=<?= $guitar['id'] ?>">
                        <button>Voir en détails</button>
                    </a>
                </div>

            <?php } ?>

        </div>
    <?php
    }

    public static function renderPaging(string $leftButton, string $rightButton)
    {
    ?>
        <div class="paging">

            <a <?= $leftButton ?>><button>
                    < </button></a>
            <?php
            foreach (Database::getPagingGuitars() as $key => $tab) {
            ?>

                <a href="?paging=<?= $key ?>">
                    <button <?php if ($key == $_GET['paging']) {
                                echo 'style="background-color:#208253;"';
                            } ?>>
                        <?= $key ?>
                    </button>
                </a>

            <?php } ?>
            <a <?= $rightButton ?>><button> > </button></a>

        </div>
<?php
    }

    public static function renderHeader(string $title, string|null $userRole)
    {
        global $link;
        

        ?>
        <?php if (empty($_SESSION)){?>
            <a href="<?= $left_path ?>"><button><?= $left_button ?></button></a>
        <?php }else{ ?>
            <div class="connected">
                <img src="<?= $link ?>assets/images/users/<?= $_SESSION["image"] ?>">
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
    
        
        <h1><?= $title ?></h1>
        <a href="<?= $right_path ?>"><button><?= $right_button ?></button></a>
        <?php
    }
}
