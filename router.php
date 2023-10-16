<?php

require_once './app/controllers/cap.controller.php';
require_once './app/controllers/cast.controller.php';
require_once './app/controllers/temp.controller.php';
require_once './app/controllers/auth.controller.php';
require_once './app/controllers/noPage.controller.php';

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
    case 'login':
        $controller = new AuthController();
        $controller->showLogin();
        break;

    case 'register':
        $controller = new AuthController();
        $controller->showRegister();
        break;
    
    case 'auth-login':
        $controller = new AuthController();
        $controller->authLogin();
        break;
    case 'auth-register':
        $controller = new AuthController();
        $controller->authRegister();
        break;
    case 'logout':
        $controller = new AuthController();
        $controller->logout();
        break;
    case 'list':
        $des = 'chapters';
        if(!empty($params[1])){
            $des = $params[1];
        }

        $controller;

        switch ($des) {
            case 'chapters':
                $controller = new CapController();
                break;
            case 'seasons':
                $controller = new TempController();
                break;
            
            default:
                $controller = new CapController();
                break;
        }

        $controller->showList();

        break;
    case 'add':
        $des = 'chapters';
        if(!empty($params[1])){
            $des = $params[1];
        }

        $controller;

        switch ($des) {
            case 'chapters':
                $controller = new CapController();
                $controller->addCapitulos();
                break;
            case 'seasons':
                $controller = new TempController();
                $controller->addTemporada();
                break;
            default:
                $controller = new CapController();
                $controller->addCapitulos();
                break;
        }
        break;
    

    default:
    $controller = new NoPageController();
    $controller->show404Page();
    break;
}