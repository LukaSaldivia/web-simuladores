<?php

require_once './app/models/temp.model.php';
require_once './app/views/temp.view.php';
require_once './app/helper/auth.helper.php';
class TempController{

    private $model;
    private $view;

    public function __construct(){
        $this->model = new TempModel();
        $this->view = new TempView();
   }

    public function addTemporada(){
        $nombre = $_POST['nombre'];
  
        if (empty($nombre)) {
           $this->view->showForm("Complete todos los campos");
           return;
         } else {
            $yaexiste = $this->model->getSeasonByName($nombre);
            if ($yaexiste) {
               $this->view->showForm(null,'Ya existe una temporada con ese nombre');
            } else {
               $this->model->addTemporada($nombre);
               header('Location: '. BASE_URL);

            }
        }
     }


    public function showList(){
        $temps = $this->model->getTemporadas(); 
        $this->view->showList($temps);
     }

     public function deleteTemporada($id){
        $this->model->deleteTemporada($id);
        header('Location: '. BASE_URL);
     }
  
     public function editTemporada(){
      $id = $_POST['id'];
      $nombre = $_POST['nombre'];

      if (empty($nombre)) {
         $this->view->showForm($id,'Complete todos los campos correctamente');
         return;
      }

      $this->model->editTemporada($id,$nombre);

        header('Location: '. BASE_URL);
     }

     public function showForm($id = null,$error = null){

      $temp = '';
      if (!is_null($id)) {
         $temp = $this->model->getSeasonById($id);
      }

      require './templates/form.temporada.phtml';
   }

}