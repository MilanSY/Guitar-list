<?php
    include_once("includes/functions/functions.php");
    include_once("includes/data/data.php");
    if (empty($_GET['page'])){
        $_GET['page']= "";
    }

    switch ($_GET["page"]){

        case "connexion":
            $include = "includes/pages/login.php";
            $header_title = "Se connecter";
            break;

        case "ajouter":
            $include = "includes/pages/add.php";
            $header_title = "Ajouter une guitare";
            break;
 
        case "modifier":
            $include = "includes/pages/modify.php";
            $header_title = "Modifier la guitare";
            break;

        case "details":
            $include = "includes/pages/details.php";
            $header_title = "Détails de la guitare";
            break;

        case "list":
            $include = "includes/pages/list.php";
            $header_title = "Listes des Guitares";
            break;

        default:
            $include = "includes/pages/list.php";
            $header_title = "Listes des Guitares";
            break;
    };

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <title>Guitars List</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Forum&display=swap" rel="stylesheet"><link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap" rel="stylesheet">
</head>
<body>
    <?php

    include_once("includes/template/header.php");

    include_once($include);

    ?>
</body>
</html>

