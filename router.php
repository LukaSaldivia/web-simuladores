<?php

require_once './app/controllers/cap.controller.php';
require_once './app/controllers/cast.controller.php';
require_once './app/controllers/temp.controller.php';
require_once './app/controllers/user.controller.php';

define('BASE_URL', '//'.$_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['PHP_SELF']).'/');

$action = 'home'; // accion por defecto
if (!empty( $_GET['action'])) {
    $action = $_GET['action'];
}

$params = explode('/', $action);

switch ($params[0]) {
    case 'home':
        $controller = new CapController();
        $controller->showCapitulos();
        break;
    case 'mas':
        echo 'Hola';
        break;
    
    default:
        echo '404';
    break;
}