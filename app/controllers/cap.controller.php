<?php

require_once './app/models/cap.model.php';
require_once './app/views/cap.view.php';

class CapController {
   private $model;
   private $view;

   public function __construct(){
    
    $this->model = new CapModel();
    $this->view = new CapView();

   }

   public function showCapitulos(){
    
    $this->view->showCapitulos();
   }
}