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
    
   $caps = $this->model->getCapitulos(); 
   $this->view->showCapitulos($caps);
   }

   public function addCapitulos(){
      $titulo = $_POST['titulo'];
      $descripcion = $_POST['descripcion'];
      $temporada = $_POST['temporada'];

      if (empty($titulo) || empty($descripcion) || empty($temporada)) {
         // $this->view->showError("Complete todos los campos");
         return;

      $id = $this->model->addCapitulos($titulo,$descripcion,$temporada);

      if ($id) {
         header('Location: '. BASE_URL);
      } else {
         // $this->view->showError("Error al agregar el capitulo");
      }
      }
   }

   public function showList(){
      $caps = $this->model->getCapitulos(); 
      $this->view->showList($caps);
   }

   public function deleteCaptitulos($id){
      $this->model->deleteCapitulos($id);
      header('Location: '. BASE_URL);
   }

   public function editCaptitulos($id){
      $this->model->editCapitulos($id);
      header('Location: '. BASE_URL);
   }
}