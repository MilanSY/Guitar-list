<header>
    <div>
        <button id="burger_menu"><img src="<?= $link ?>assets/images/svg/menu.svg"></button>
    </div>

    <div>
        <h1><?= $header_title ?></h1>
    </div>

    <div>
        <a href="<?= $right_path ?>"><button><?= $right_button ?></button></a>
    </div>
</header>
<div class="flex-side-bar" id="flex_side_bar">
    <div class="side-bar" id="side_bar">
        <div>
            <h1>Menu</h1>
            <button id="burger_menu_out"><img src="<?= $link ?>assets/images/svg/menu.svg"></button>
            </div>
        <div >
            <a href="<?= $link ?>home"><button>accueil</button></a>
            <a href="<?= $link ?>admin"><button>admin</button></a>
            <a href="<?= $link ?>deconnexion"><button>déconnexion</button></a>
        </div>
    </div>
    <div id="background_side_bar"></div>
</div>

<script src="./assets/scripts/header.js"></script>