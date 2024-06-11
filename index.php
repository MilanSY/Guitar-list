<?php
    include_once("includes/functions/functions.php");
    include_once("includes/data/data.php");

    $uri=parse_url($_SERVER["REQUEST_URI"])["path"];

    switch ($uri){
        
        case "/":
            $include = "includes/pages/list.php";
            $header_title = "Listes des Guitares";
            break;

        case "/home":
            $include = "includes/pages/list.php";
            $header_title = "Listes des Guitares";
            break;

        case "/connexion":
            $include = "includes/pages/login.php";
            $header_title = "Se connecter";
            break;

        case "/ajouter":
            $include = "includes/pages/add.php";
            $header_title = "Ajouter une guitare";
            break;
 
        case "/modifier":
            $include = "includes/pages/modify.php";
            $header_title = "Modifier la guitare";
            break;

        case "/details":
            $include = "includes/pages/details.php";
            $header_title = "Détails de la guitare";
            break;

        default:
            $include = "";
            $header_title = "Listes des Guitares";
            break;
    };


    include_once("includes/template/head.php");
?>


<body>
    <?php
    include_once("includes/template/header.php");

    include_once($include);

    ?>
</body>
</html>

