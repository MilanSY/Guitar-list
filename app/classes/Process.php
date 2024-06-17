<?php

namespace App\Classes;

use App\Classes\Database;

class Process
{
    public static function processList(int $paging, string|null &$leftButton, string|null &$rightButton)
    {
        if (empty($paging)) {
            $paging = "1";
        }
        if ($paging < 1) {
            $paging = "1";
        }
        if ($paging > count(Database::getPagingGuitars())) {
            $paging = count(Database::getPagingGuitars());
        }
        $list = Database::getPagingGuitars()[$paging];

        if (!($paging <= 1)) {
            $leftButton = 'href=?paging=' . ($paging - 1) . "'";
        } else {
            $leftButton = "";
        }

        if (!($paging >= count(Database::getPagingGuitars()))) {
            $rightButton = 'herf=?paging="' . ($paging + 1) . "'";
        } else {
            $rightButton = "";
        }

        return $list;
    }

    public static function processHeader(string $title, string|null $userRole)
    {
        if ($userRole === "admin") {
            $left_path = "../admin";
            $left_button = "admin";
            $right_path = "../create";
            $right_button = "Créer un article";
        } else {
            $left_path = "../";
            $left_button = "Accueil";
            $right_path = "../admin";
            $right_button = "admin";
        }
    }
}
