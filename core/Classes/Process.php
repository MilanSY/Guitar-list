<?php

namespace App\Classes;

use App\Classes\Database;

class Process
{
    public static function processList(int $paging, array $guitars)
    {
        if (empty($paging)) {
            $paging = "1";
        }
        if ($paging < 1) {
            $paging = "1";
        }
        if ($paging > count(Database::getPaging($guitars))) {
            $paging = count(Database::getPaging($guitars));
        }
        $list = Database::getPaging($guitars);
        $page = $list[$paging];

        if (!($paging <= 1)) {
            $leftButton = 'href="?paging=' . ($paging - 1) . '"';
        } else {
            $leftButton = "";
        }

        if (!($paging >= count(Database::getPaging($guitars)))) {
            $rightButton = 'href="?paging=' . ($paging + 1) . '"';
        } else {
            $rightButton = "";
        }


        $details = "/admin";
        $imagePath = "";
        if (explode('-', $guitars[0]['image'])[0] === 'incoming') {
            $imagePath = "incoming/";
            $details = "/admin";
        }

        return [
            $page,
            $leftButton,
            $rightButton,
            $list,
            $imagePath,
            $details
        ];
    }

    public static function processHeader(string $uri)
    {
        $title = match ($uri) {

            "/", "/home" => "Listes des Guitares",

            "/connexion" => "Se connecter",

            "/deconnexion" => "Déconnection",

            "/admin" =>  "Administration",

            "/ajouter" => "Ajouter",

            "/modifier" =>  "Modifier",

            "/details" => "Détails",

            default => "Listes des Guitares"
        };

        if (!isset($_SESSION['user'])) {
            $user = [];
        } else {
            $user = $_SESSION['user'];
        }

        if (empty($user)) {
            $adminButton = false;
            $connectButton = true;
            $user['name'] = "guest";
            $user['image'] = "guest";
        } else {
            $connectButton = false;
            if ($user['role'] === "admin") {
                $adminButton = true;
            } else {
                $adminButton = false;
            }
        }
        return [
            $adminButton,
            $connectButton,
            $title,
            $user['name'],
            $user['image']
        ];
    }

    public static function processShow(int|null $id, array $guitars)
    {
        if ($id === null) {
            header("Location: ../home");
        }

        $adminButton = false;

        if (!empty($_SESSION['user'])) {
            if ($_SESSION['user']['role'] === 'admin') {
                $adminButton = true;
            }
        }

        $imagePath = "";
        if (explode('-', $guitars[0]['image'])[0] === 'incoming') {
            $imagePath = "incoming/";
        }

        $guitar = Database::getGuitarById($id, $guitars);
        return [$guitar, $adminButton, $imagePath];
    }

    public static function processConnect(array $data = [])
    {
        $errors = [
            "email" => "",
            "password" => ""
        ];
        $values = [
            "email" => "",
            "password" => ""
        ];
        $display = [
            "email" => "none",
            "password" => "none"
        ];

        if (!empty($data)) {
            foreach ($data as $key => $value) {
                if ($key != "method") {
                    $values[$key] = strip_tags($value);
                }
            }
            if ($data['method'] === "connect") {
                foreach ($values as $key => $value) {
                    if (empty($value)) {
                        $errors[$key] = "Ce champs est obligatoire";
                        $display[$key] = "block";
                    }
                }
                if (empty_array($errors)) {
                    $users = Database::getUsers();
                    foreach ($users as $user) {
                        if ($user['email'] === $values['email'] && password_verify($values['password'], $user['password'])) {
                            $_SESSION['user'] = $user;
                            header("Location: ../home");
                        }
                    }
                    $errors['email'] = "Email ou mot de passe incorrect";
                    $display['email'] = "block";
                }
            }
        }

        return [$errors, $values, $display];
    }

    public static function processDisconnect()
    {

        session_start();
        session_destroy();

        header("Location: ../home");
    }

    public static function processDelete(int|null $id, string $tab)
    {
        if (!isset($_GET['id'])) {
            header("Location: ../home");
            die();
        }

        var_dump($_GET);
        if ($_GET['tab'] === "") {
            echo "guitars";
            Database::deleteGuitar($_GET['id']);
            header("Location: ../home");
        } else {
            echo "incoming";
            Database::deleteIncoming($_GET['id']);
            header("Location: ../admin");
        }
    }

    public static function processAdd(int $id)
    {
        $guitar = Database::getGuitarById($id, Database::getIncoming());
        $file_content = file_get_contents("./assets/images/guitars/incoming/" . $guitar['image']);
        $uploads_dir = './assets/images/guitars/';
        $new_name = "guitar-id-" . get_next_id(Database::getGuitars());
        $destination = $uploads_dir . $new_name . "." . "png";
        $guitar['image'] = $new_name . "." . "png";

        if (file_put_contents($destination, $file_content)) {
            $guitar['id'] = get_next_id(Database::getGuitars());
            if (Database::addGuitar($guitar)) {
                Database::deleteIncoming($id);
                header("Location: ../details?id=" . $guitar['id']);
            } else {
                echo "echec de l'envoi du fichier";
            }
        } else {
            echo "echec de l'envoi du fichier";
        }
    }

    public static function processRequest(array $data)
    {
        $errors = [
            "nom" => "",
            "image" => "",
            "couleur" => "",
            "forme" => "",
            "marque" => "",
            "bois" => ""
        ];
        $values = [
            "nom" => "",
            "image" => "",
            "couleur" => "",
            "forme" => "",
            "marque" => "",
            "bois" => ""
        ];
        $displays = [
            "nom" => "none",
            "image" => "none",
            "couleur" => "none",
            "forme" => "none",
            "marque" => "none",
            "bois" => "none"
        ];


        if (!empty($data)) {
            if ($data['method'] === "send") {
                foreach ($data as $key => $value) {
                    if (!empty($value) && $key != "method" && $key != "id") {
                        $values[$key] = strip_tags($value);
                        if (!is_under_255($data[$key])) {
                            $errors[$key] = "Ce champs ne peut pas dépassé les 255 caractères";
                            $displays[$key] = "block";
                        }
                    } else if ($key != "method" && $key != "id") {
                        $errors[$key] = "Ce champs est obligatoire";
                        $displays[$key] = "block";
                    }
                }
                if (isset($_SESSION['user'])) {
                    if (empty_array($errors) && $_SESSION['user']['role'] === 'admin') {
                        if (!empty($_FILES["fichier_image"]['name'])) {
                            $uploads_dir = './assets/images/guitars/';
                            $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                            $new_name = "guitar-id-" . get_next_id(Database::getGuitars());
                            $destination = $uploads_dir . $new_name . ".png";
                            $values['image'] = $new_name . ".png";
                            if (move_uploaded_file($tmp_name, $destination)) {
                                $values['id'] = get_next_id(Database::getGuitars());
                                if (Database::addGuitar($values)) {
                                    header("Location: ../details?id=" . $values['id']);
                                } else {
                                    $errors['image'] = "echec de l'envoi du fichier";
                                    $displays['image'] = "block";
                                }
                            } else {
                                $errors['image'] = "echec de l'envoi du fichier";
                                $displays['image'] = "block";
                            }
                        } else {
                            $errors['image'] = "l'image est obligatoire";
                            $displays['image'] = "block";
                        }
                    }
                } else if (empty_array($errors)) {
                    if (!empty($_FILES["fichier_image"]['name'])) {
                        $uploads_dir = './assets/images/guitars/incoming/';
                        $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                        $new_name = "incoming-id-" . get_next_id(Database::getIncoming());
                        $destination = $uploads_dir . $new_name . ".png";
                        $values['image'] = $new_name . ".png";
                        if (move_uploaded_file($tmp_name, $destination)) {
                            $values['id'] = get_next_id(Database::getIncoming());
                            if (Database::addIncoming($values)) {
                                header("Location: ../ajouter?success=1");
                            } else {
                                $errors['image'] = "echec de l'envoi du fichier";
                                $displays['image'] = "block";
                            }
                        } else {
                            $errors['image'] = "echec de l'envoi du fichier";
                            $displays['image'] = "block";
                        }
                    } else {
                        $errors['image'] = "l'image est obligatoire";
                        $displays['image'] = "block";
                    }
                }
            }
        }
        return [$errors, $values, $displays];
    }

    public static function processModify(int|null $id, array $data, string $type = "guitar")
    {
        if ($id === null) {
            header("Location: ../home");
            die();
        }

        if (isset($_SESSION['user'])) {
            if ($_SESSION['user']['role'] !== 'admin') {
                header('Location: ../home');
            }
        }

        if ($type === "guitar") {
            $guitar = Database::getGuitarById($id, Database::getGuitars());
        } else {
            $guitar = Database::getGuitarById($id, Database::getIncoming());
        }


        $errors = [
            "nom" => "",
            "image" => "",
            "couleur" => "",
            "forme" => "",
            "marque" => "",
            "bois" => ""
        ];
        $values = [
            "nom" => "",
            "image" => "",
            "couleur" => "",
            "forme" => "",
            "marque" => "",
            "bois" => ""
        ];
        $displays = [
            "nom" => "none",
            "image" => "none",
            "couleur" => "none",
            "forme" => "none",
            "marque" => "none",
            "bois" => "none"
        ];

        if (!empty($data)) {

            foreach ($data as $key => $value) {
                if ($key != "method") {
                    $values[$key] = strip_tags($value);
                }
            }
            if ($data['method'] === "send") {

                foreach ($data as $key => $value) {
                    if ($key === "image") {
                        
                    } else if (!empty($value)) {
                        if (!is_under_255($data[$key])) {
                            $errors[$key] = "Ce champs ne peut pas dépassé les 255 caractères";
                            $displays[$key] = "block";
                        }
                    } else {
                        $errors[$key] = "Ce champs est obligatoire";
                        $displays[$key] = "block";
                    }
                }
                $new_name = "guitar-id-" . $_GET['id'] . ".png";
                $values['image'] = $new_name;
                $values['id'] = $_GET['id'];
                var_dump($values);
                if (empty_array($errors) && $_SESSION['user']['role'] === 'admin') {
                    var_dump($_FILES);
                    if (!empty($_FILES["fichier_image"]['name'])) {
                        $uploads_dir = './assets/images/guitars/';
                        $tmp_name = $_FILES["fichier_image"]["tmp_name"];
                        $new_name = "guitar-id-" . $_GET['id'];
                        $destination = $uploads_dir . $new_name . ".png";
                        $values['image'] = $new_name . ".png";
                        if (move_uploaded_file($tmp_name, $destination)) {
                            if (Database::modifyGuitar($values)) {
                                header("Location: ../details?id=" . $values['id']);
                            } else {
                                $errors['image'] = "echec de l'envoi du fichier";
                                $displays['image'] = "block";
                            }
                        } else {
                            $errors['image'] = "echec de l'envoi du fichier";
                            $displays['image'] = "block";
                        }
                    } else {
                        if (Database::modifyGuitar($values)) {
                            header("Location: ../details?id=" . $values['id']);
                        } else {
                            $errors['image'] = "echec de l'envoi du fichier";
                            $displays['image'] = "block";
                        }
                    }
                }
            }
        } else {
            foreach ($guitar as $key => $value) {
                if ($key != "method" && $key != "id") {
                    $values[$key] = strip_tags($value);
                }
            }
        }
        $modify = 1;
        return [$errors, $values, $displays, $modify];
    }



}
