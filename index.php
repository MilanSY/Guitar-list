<?php
    
    session_start();

    if(!isset($_SESSION['guitars'])){
        include_once("includes/data/data.php");
    }

    $include = match ($_GET["page"]){

        "modifier" => "includes/pages/modify.php",

        "details" => "includes/pages/details.php",

        "list" => "includes/pages/list.php",
        default => "includes/pages/list.php"

    };
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css" />
    <title>Guitars List</title>
</head>
<body>
    <?php


    include_once($include);

    ?>
</body>
</html>

