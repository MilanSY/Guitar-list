<?php

namespace App\Classes;

class Database
{
    public static function getGuitars()
    {
        $json = file_get_contents(__DIR__ . "/../database/guitars.json");
        return json_decode($json, true);
    }

    public static function getUsers()
    {
        $json = file_get_contents(__DIR__ . "../database/users.json");
        return json_decode($json, true);
    }

    public static function getIncoming()
    {
        $json = file_get_contents(__DIR__ . "../database/incoming.json");
        return json_decode($json, true);
    }

    public static function addGuitar(array $guitar)
    {
        $guitars = Database::getGuitars();
        $guitars[] = $guitar;
        $json = json_encode($guitars, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "../database/guitars.json", $json);
    }

    public static function modifyGuitar(array $guitar)
    {
        $guitars = Database::getGuitars();
        $key = get_key_by_id($guitar['id'], $guitars);
        $guitars[$key] = $guitar;
        $json = json_encode($guitars, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "../database/guitars.json", $json);
    }

    public static function deleteGuitar(int $id)
    {
        $guitars = Database::getGuitars();
        unlink("../../assets/images/guitars/" . $guitars[get_key_by_id($id, $guitars)]['image']);
        unset($guitars[get_key_by_id($id, $guitars)]);
        $json = json_encode($guitars, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "../database/guitars.json", $json);
    }

    public static function addIncoming(array $incoming)
    {
        $incoming_list = Database::getIncoming();
        $incoming_list[] = $incoming;
        $json = json_encode($incoming_list, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "../database/incoming.json", $json);
    }

    public static function modifyIncoming(array $incoming)
    {
        $incoming_list = Database::getIncoming();
        $key = get_key_by_id($incoming['id'], $incoming_list);
        $incoming_list[$key] = $incoming;
        $json = json_encode($incoming_list, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "../database/incoming.json", $json);
    }

    public static function deleteIncoming(int $id)
    {
        $incoming_list = Database::getIncoming();
        unlink("../../assets/images/guitars/incoming/" . $incoming_list[get_key_by_id($id, $incoming_list)]['image']);
        unset($incoming_list[get_key_by_id($id, $incoming_list)]);
        $json = json_encode($incoming_list, JSON_PRETTY_PRINT);
        file_put_contents(__DIR__ . "../database/incoming.json", $json);
    }

    public static function getPagingGuitars()
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
