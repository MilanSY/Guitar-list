<?php

session_start();


$json = file_get_contents("includes/data/guitars.json");
$guitars = json_decode($json, true);

$json = file_get_contents("includes/data/users.json");
$users = json_decode($json, true);

$paging = [];
$count = 0;
$tab = [];

foreach($guitars as $guitar){
    $tab[] = $guitar;
    $count++;
    if ($count === 3) {
        if(empty($paging)){
            $paging[1] = $tab;
            $tab =[];
            $count = 0;
        }
        else{
            $paging[] = $tab;
            $tab =[];
            $count = 0;
        }
    }
}
if ($count != 0){
    $paging[] = $tab;
}