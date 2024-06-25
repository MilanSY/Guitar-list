

<div class="modify">
    <form action="#" method="post">
        <input type="hidden" name="method" value="connect" />
        <label for="email">email</label>
        <input type="email" name="email" id="email" value="<?= $values['email'] ?>" />
        <p class="errormsg" style="display: <?= $display['email'] ?>"><?= $errors['email'] ?></p>
        <label for="password">mot de passe</label>
        <input type="password" name="password" id="password" value="<?= $values['password'] ?>" />
        <p class="errormsg" style="display: <?= $display['password'] ?>"><?= $errors['password'] ?></p>
        <button>se connecter</button>
    </form>
</div>