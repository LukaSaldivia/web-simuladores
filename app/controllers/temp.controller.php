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

    public function showTemporadas(){
        $temps = $this->model->getTemporadas();
        $this->view->showTemporadas();
    }

    public function addTemporada(){
      if ($_POST) {
        $nombre = $_POST['season'];
  
        if (empty($nombre)) {
           $this->view->showRegister("Complete todos los campos");
           return;
         } else {
            $yaexiste = $this->model->getBySeasonName($nombre);
            if ($yaexiste) {
               $this->view->showRegister('Ya existe una temporada con ese nombre');
            } else {
               $this->model->addTemporada($nombre);
            }
        }
      }
     }


    public function showList(){
        $caps = $this->model->getTemporadas(); 
        $this->view->showList($caps);
     }

     public function deleteCaptitulos($id){
        $this->model->deleteTemporadas($id);
        header('Location: '. BASE_URL);
     }
  
     public function editTemporadas($id){
        $this->model->editTemporadas($id);
        header('Location: '. BASE_URL);
     }

}