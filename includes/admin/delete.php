<?php
if(!isset($_GET['id'])){
    header("Location: ../home");
    die();
}

if($_GET['tab'] === 'incoming'){
    delete_from_incoming($_GET['id'], $incoming);
}
else if($_GET['tab'] === 'guitars'){
    delete_from_guitars($_GET['id'], $guitars);
}