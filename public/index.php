<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include_once('../core/Classes/Autoloader.php');

include_once("../core/functions/functions.php");

use App\Classes\Router;


$router = new Router();
$content = $router->route();

echo $content;

?>

</body>

</html>