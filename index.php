<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

require_once("./app/classes/Autoloader.php");

use App\Classes\Autoloader;
use App\Controllers\PostController;

Autoloader::register();
Autoloader::autoload('PostController', './app/controllers');
Autoloader::autoload('Database');
Autoloader::autoload('Form');

include_once("includes/functions/functions.php");

$uri = parse_url($_SERVER["REQUEST_URI"])["path"];

$path = explode("/", $uri);
if (isset($path[2])) {
    $link = "../";
} else {
    $link = "./";
}
$uri = "/" . $path[1];


$left_button = "connexion";
$left_path = "../connexion";
$right_button = "ajouter";
$right_path = "../ajouter";

if (!isset($_GET['paging'])) {
    $_GET['paging'] = 1;
}


include_once("includes/template/head.php");

switch ($uri) {

    case "/":
        $header_title = "Listes des Guitares";
        PostController::index($_GET['paging']);
        break;

    case "/home":
        $header_title = "Listes des Guitares";
        PostController::index($_GET['paging']);
        break;

    case "/connexion":
        $include = "includes/pages/login.php";
        $header_title = "Se connecter";
        $left_button = "accueil";
        $left_path = "../home";
        break;

    case "/deconnexion":
        $include = "includes/pages/logout.php";
        $header_title = "Déconnection";
        break;

    case "/admin":
        $include = "includes/admin/admin.php";
        $header_title = "Administration";
        break;

    case "/ajouter":
        $include = "includes/pages/add.php";
        $header_title = "Ajouter une guitare";
        $right_button = "accueil";
        $right_path = "../home";
        break;

    case "/modifier":
        $include = "includes/pages/modify.php";
        $header_title = "Modifier la guitare";
        $right_button = "accueil";
        $right_path = "../home";
        break;

    case "/details":
        $include = "includes/pages/details.php";
        $header_title = "Détails de la guitare";
        break;

    default:
        $header_title = "Listes des Guitares";
        PostController::index($_GET['paging']);
        break;
};


?>


<body>
    <?php
    include_once("includes/template/header.php");

    include_once($include);
    ?>
</body>

</html>