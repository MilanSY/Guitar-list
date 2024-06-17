<?php

namespace App\Controllers;

use App\Classes\Render;
use App\Classes\Process;

class PostController
{
    public static function index(int $paging)
    {
        $list = Process::processList($paging, $leftButton, $rightButton);
        Render::renderList($list);
        Render::renderPaging($leftButton, $rightButton);
    }

    public static function header(string $title, string|null $userRole)
    {
        // Logique pour afficher le header
    }

    public function show($id)
    {
        // Logique pour afficher un article spécifique en fonction de l'ID
    }

    public function create()
    {
        // Logique pour afficher le formulaire de création d'un nouvel article
    }

    public function store()
    {
        // Logique pour enregistrer un nouvel article dans la base de données
    }

    public function edit($id)
    {
        // Logique pour afficher le formulaire d'édition d'un article existant en fonction de l'ID
    }

    public function update($id)
    {
        // Logique pour mettre à jour un article existant dans la base de données en fonction de l'ID
    }

    public function delete($id)
    {
        // Logique pour supprimer un article existant de la base de données en fonction de l'ID
    }
}
