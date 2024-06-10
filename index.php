<?php
    include_once("includes/functions/functions.php");
    include_once("includes/data/data.php");
    if (empty($_GET['page'])){
        $_GET['page']= "";
    }
    $include = match ($_GET["page"]){

        "ajouter" => "includes/pages/add.php",
 
        "modifier" => "includes/pages/modify.php",

        "details" => "includes/pages/details.php",

        "list" => "includes/pages/list.php",
        default => "includes/pages/list.php"

    };
    $header_title = match ($_GET["page"]){

        "ajouter" => "Ajouter une guitare",

        "modifier" => "Modifier la guitare",

        "details" => "Détails de la guitare",

        "list" => "Listes des Guitares",
        default => "Listes des Guitares"

    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../assets/css/style.css" />
    <title>Guitars List</title>
</head>
<body>
    <?php

    include_once("includes/template/header.php");

    include_once($include);

    ?>
</body>
</html>

