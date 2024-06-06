<?php

session_start();
session_destroy();


$json = file_get_contents("includes/data/guitars.json");
$guitars = json_decode($json, true);

$json = file_get_contents("includes/data/users.json");
$users = json_decode($json, true);
