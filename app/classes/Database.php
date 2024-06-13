<?php
namespace App\Classes;

include_once ('../../includes/data/data.php');

class Database
{
    public static function getGuitars()
    {
        $json = file_get_contents("../../includes/data/guitars.json");
        return json_decode($json, true);
    }

    public static function getUsers()
    {
        $json = file_get_contents("../../includes/data/users.json");
        return json_decode($json, true);
    }

    public static function getIncoming()
    {
        $json = file_get_contents("../../includes/data/incoming.json");
        return json_decode($json, true);
    }

    public static function getPaging()
    {
        $paging = [];
        return create_paging(Database::getGuitars(), $paging);
    }

    public static function getPagingIncoming()
    {
        $paging_incoming = [];
        return create_paging(Database::getIncoming(), $paging_incoming);
    }
}