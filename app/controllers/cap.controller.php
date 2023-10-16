<?php

require_once './app/models/cap.model.php';
require_once './app/models/cast.model.php';
require_once './app/models/temp.model.php';
require_once './app/views/cap.view.php';

class CapController {
   private $model;
   private $view;

   public function __construct(){
    
    $this->model = new CapModel();
    $this->view = new CapView();

   }

   public function showCapitulos(){
    
   $caps = $this->model->getCapitulos(); 
   $this->view->showCapitulos($caps);
   }

   public function addCapitulo(){
      $titulo = $_POST['titulo'];
      $descripcion = $_POST['descripcion'];
      $temporada = $_POST['temporada'];
      $cast = explode('/',$_POST['castHidden']);
      $id = explode('&',explode('=',$_POST['url'])[1])[0];

      



      if (empty($titulo) || empty($descripcion) || empty($temporada) || empty($id) || empty($cast[0])) {
         $this->showForm(null,'Complete todos los campos correctamente');
         return;
      }
      
      
      $boolean = $this->model->addCapitulos($id, $titulo,$descripcion,$temporada, $cast);
      
      if ($boolean) {
         header('Location: '. BASE_URL);
      } else {
         $this->showForm(null,'Error al cargar el capítulo (probablemente ya esté subido)');
         
      }
      }
   

   public function showList(){
      $caps = $this->model->getCapitulos(); 
      $this->view->showList($caps);
   }

   public function deleteCaptitulo($id){
      $this->model->deleteCapitulo($id);
      header('Location: '. BASE_URL);
   }

   public function editCaptitulo(){
      $id = $_POST['id'];
      $titulo = $_POST['titulo'];
      $descripcion = $_POST['descripcion'];
      $temporada = $_POST['temporada'];
      $cast = explode('/',$_POST['castHidden']);

      if (empty(end($cast))) {
         $cast = array_pop($cast);
      }

      $this->model->editCapitulo($id,$titulo,$descripcion,$temporada,$cast);
      header('Location: '. BASE_URL);
   }

   public function showVideoPlayer($id){
      $capData = $this->model->getCapituloData($id);
      $this->view->showVideoPlayer($capData);

   }

   public function showForm($id = null,$error = null){

      $capData = [];
      if (!is_null($id)) {
         $capData = $this->model->getCapituloData($id);
      }

      $castModel = new CastModel();
      $cast = $castModel->getCast();
      $tempModel = new TempModel();
      $temps = $tempModel->getTemporadas();

      $this->view->showForm($id, $error, $capData, $cast, $temps);

   }
}