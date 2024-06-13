<?php

namespace App\Data;


$json = file_get_contents("includes/data/guitars.json");
$guitars = json_decode($json, true);

$json = file_get_contents("includes/data/users.json");
$users = json_decode($json, true);

$json = file_get_contents("includes/data/incoming.json");
$incoming = json_decode($json, true);

$paging = [];
$paging_incoming = [];

$paging = create_paging($guitars, $paging);
$paging_incoming = create_paging($incoming, $paging_incoming);