<?php

namespace App\Classes;

use App\Classes\Database;
use App\Controllers\Controller;

class Router
{
    private string $uri;
    private string $url;
    private Controller $controller;

    public function __construct()
    {
        $uri = parse_url($_SERVER["REQUEST_URI"])["path"];
        $path = explode("/", $uri);
        $this->uri = "/" . $path[1];
        if (isset($path[2])) {
        $this->url = $this->uri . "/" . $path[2];
        } else {
            $this->url = $uri;
        }

        $link= "./"; 
        foreach ($path as $key => $value) {
            if ( $key > 1) {
                $link .= "../" ;
            }
        }
        $this->controller = new Controller($link);
        $this->controller->uri = $this->uri;
    }

    public function route()
    {
        if (!isset($_GET['paging'])) {
            $_GET['paging'] = 1;
        }
        switch ($this->uri) {

            case "/":
            case "/home":
                return $this->controller->index($_GET['paging']);
                break;

            case "/connexion":
                return $this->controller->connect($_POST);
                break;

            case "/deconnexion":
                return $this->controller->disconnect();
                break;

            case "/admin":
                return $this->adminRoute();
                break;

            case "/ajouter":
                return $this->controller->request($_POST);
                break;

            case "/modifier":
                return $this->controller->modify($_GET['id'], $_POST);
                break;

            case "/details":
                return $this->controller->show($_GET['id'], Database::getGuitars());
                break;

            default:
                return $this->controller->error404();
                break;
        };
    }

    public function adminRoute()
    {
        if ($_SESSION['user']['role'] != "admin") {
            return $this->controller->error404();
        }

        switch ($this->url) {
            case "/admin":
            case "/admin/incoming":
                return $this->controller->adminIndex($_GET['paging']);
                break;
            case "/admin/details":
                return $this->controller->show($_GET['id'], Database::getIncoming());
                break;
            case "/admin/modifier":
                return $this->controller->modify($_GET['id'], $_POST);
                break;
            case "/admin/supprimer":
                return $this->controller->delete($_GET['id'], $_GET['tab']);
                break;
            case "/admin/ajouter":
                return $this->controller->add($_GET['id']);
                break;
        }
    }
}
