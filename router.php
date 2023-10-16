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
    case 'auth-chapter':
        $controller = new CapController();
        $controller->addCapitulo();
        break;
    case 'auth-season':
        $controller = new TempController();
        $controller->addTemporada();
        break;
    case 'auth-cast':
        $controller = new CastController();
        $controller->addCast();
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
                $controller->showList();
                break;
            case 'seasons':
                $controller = new TempController();
                $controller->showList();
                break;
            case 'cast':
                $controller = new CastController();
                $controller->showList();
                break;
            default:
            $controller = new NoPageController();
            $controller->show404Page();
            break;
        }


        break;
        
    case 'add':
        $des = 'chapter';
        if(!empty($params[1])){
            $des = $params[1];
        }

        $controller;

        switch ($des) {
            case 'chapter':
                $controller = new CapController();
                break;
            case 'season':
                $controller = new TempController();                   
                break;
            case 'cast':
                $controller = new CastController();
                break;
            default:
            $controller = new NoPageController();
            $controller->show404Page();
            break;
        }

        $controller->showForm();


        break;
          
    case 'edit':
        $des = 'chapter';
        if(!empty($params[1])){
            $des = $params[1];
        }

        $controller;

        switch ($des) {
            case 'chapter':
                $controller = new CapController();
                break;
            case 'season':
                $controller = new TempController();
                 break;
            case 'cast':
                $controller = new CastController();
                break;
            default:
            $controller = new NoPageController();
            $controller->show404Page();
            break;
        }

        $controller->showForm($params[2]);


        break;
                  
    case 'delete':
        $des = 'chapter';
        if(!empty($params[1])){
            $des = $params[1];
        }

        $controller;

        switch ($des) {
            case 'chapter':
                $controller = new CapController();
                $controller->deleteCaptitulo($params[2]);
            break;
            case 'season':
                $controller = new TempController();
                $controller->deleteTemporada($params[2]);
                break;
            case 'cast':
                $controller = new CastController();
                $controller->deleteCast($params[2]);
                break;
            default:
            $controller = new NoPageController();
            $controller->show404Page();
            break;
        }


        break;

    case 'view':
        $controller = new CapController();
        $controller->showVideoPlayer($params[1]);
        break;

    case 'edit-chapter':
        $controller = new CapController();
        $controller->editCaptitulo();
        break;
    case 'edit-season':
        $controller = new TempController();
        $controller->editTemporada();
        break;
    case 'edit-cast':
        $controller = new CastController();
        $controller->editCast();
        
        break;
    

    default:
    $controller = new NoPageController();
    $controller->show404Page();
    break;
}