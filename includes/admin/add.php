<?php
$guitar = $incoming[get_key_by_id($_GET['id'], $incoming)];
$file_content = file_get_contents("./assets/images/guitars/incoming/".$guitar['image']);

$uploads_dir = './assets/images/guitars/';
$new_name = "guitar-id-".get_next_id($guitars);
$destination = $uploads_dir . $new_name . "." . "png"; 
$guitar['image'] = $new_name . "." . "png";
if (file_put_contents($destination, $file_content)) {
    $guitar['id'] = get_next_id($guitars);
    $guitars[] = $guitar;
    $json = json_encode($guitars, JSON_PRETTY_PRINT);
    file_put_contents("includes/data/guitars.json",$json);
    header("Location: ../admin/supprimer?tab=incoming&id=".$_GET['id']);
} else {
    echo "echec de l'envoi du fichier";
}