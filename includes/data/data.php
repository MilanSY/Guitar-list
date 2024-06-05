<?php

session_start();
session_destroy();


$json = file_get_contents("includes/data/data.json");
$data = json_decode($json, true);