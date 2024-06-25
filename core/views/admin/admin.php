<?php

if ($_SESSION['role'] !== 'admin') {
    header("Location: ../home");
    die();
}

$url = parse_url($_SERVER["REQUEST_URI"])["path"];

if ($url === '/admin') {
    $url = "/admin/incoming";
}

switch ($url) {
    case "/admin/incoming":
        include_once("./includes/admin/demandes.php");
        break;
    case "/admin/details":
        include_once("./includes/admin/details.php");
        break;
    case "/admin/modifier":
        include_once("./includes/admin/modify.php");
        break;
    case "/admin/supprimer":
        include_once("./includes/admin/delete.php");
        break;
    case "/admin/ajouter":
        include_once("./includes/admin/add.php");
        break;
}
