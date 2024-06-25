<header>
    <div>
        <button id="burger_menu"><img src="<?= $this->link ?>assets/images/svg/menu.svg"></button>
    </div>

    <div>
        <h1><?= $title ?></h1>
    </div>

    <div>

    </div>
</header>

<div class="flex-side-bar" id="flex_side_bar">
    <div class="side-bar" id="side_bar">
        <div class="side-bar__head">
            <h1>mENu</h1>
            <button id="burger_menu_out"><img src="<?= $this->link ?>assets/images/svg/menu.svg"></button>
        </div>
        <div class="side-bar__menu">
            <a href="../home">
                <button class="cta">
                    <span class="hover-button"> Accueil </span>
                </button>
            </a>
            <a href="../ajouter">
                <button class="cta">
                    <span class="hover-button"> Ajouter </span>
                </button>
            </a>
            <?php if ($adminButton) : ?>
                <a href="../admin">
                    <button class="cta">
                        <span class="hover-button"> Administration </span>
                    </button>
                </a>
            <?php endif;
            if ($connectButton) : ?>
                <a href="../connexion">
                    <button class="cta">
                        <span class="hover-button"> connexion </span>
                    </button>
                </a>
            <?php else : ?>
                <a href="../deconnexion">
                    <button class="cta">
                        <span class="hover-button"> déconnexion </span>
                    </button>
                </a>
            <?php endif; ?>
        </div>
    </div>
    <div id="background_side_bar"></div>
</div>

<script src="<?= $this->link ?>assets/scripts/header.js"></script>