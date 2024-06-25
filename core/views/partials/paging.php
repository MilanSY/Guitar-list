<div class="paging">
    <a <?= $leftButton ?>><button>
            < </button></a>

    <?php foreach ($pages as $key => $tab) : ?>

        <a href="?paging=<?= $key ?>"><button <?php if ($key == $_GET['paging']) : ?> style="background-color:#208253;" <?php endif; ?>><?= $key ?></button></a>
    <?php endforeach; ?>

    <a <?= $rightButton ?>><button> > </button></a>
</div>