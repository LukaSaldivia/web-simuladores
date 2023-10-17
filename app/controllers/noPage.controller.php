<?php

require_once './app/views/404.view.php';

class NoPageController{

  private $view;

  public function __construct(){
    $this->view = new NoPageView();
  }

  public function show404Page() {
    $this->view->show404Page();
  }
}