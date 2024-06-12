
<?php

$errors=[
    "email" => "",
    "password" => ""
];

$display=[
    "email" => "none",
    "password" => "none"
];
if(!empty($_POST)){
    if (!empty($_POST['email'])){
        if(password_verify($_POST['password'], $users[$_POST['email']]['password'])){
            $_SESSION = $users[$_POST['email']];
            header("Location: ../home");
        }
        else
        {
            $errors['password'] = "email ou mot de passe incorrect";
            $displays['password'] = "block";
        }
    }
    else
    {
        $errors['email'] = "Ce champs est obligatoire";
        $displays['email'] = "block";
    }
}
?>



<div class="modify">
    <form action="#" method="post">
        <label for="email">email</label>
        <input type="email" name="email" id="email" />
        <p class="errormsg" style="display: <?= $displays['email'] ?>"><?= $errors['email'] ?></p>
        <label for="password">mot de passe</label>
        <input type="password" name="password" id="password" />
        <p class="errormsg" style="display: <?= $displays['password'] ?>"><?= $errors['password'] ?></p>
        <button>se connecter</button>
    </form>
</div>