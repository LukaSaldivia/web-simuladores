<?php

require_once './app/models/cast.model.php';
require_once './app/views/cast.view.php';

class CastController{

    private $model;
    private $view;

    public function __construct(){
    
        $this->model = new CastModel();
        $this->view = new CastView();
    
    }

    public function showList(){
        $cast = $this->model->getCast(); 
        $this->view->showList($cast);
     }
     
     public function deleteCast($id){
        $this->model->deleteCast($id);
        header('Location: '. BASE_URL);
    }

    public function addCast(){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
  
        if (empty($nombre) || empty($apellido)) {
           $this->view->showForm("Complete todos los campos");
           return;
         } else {

               $this->model->addCast($nombre,$apellido);
               header('Location: '. BASE_URL);

        }
     }

     public function editCast(){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $id = $_POST['id'];
  
        if (empty($nombre) || empty($apellido)){
           $this->view->showForm($id,'Complete todos los campos correctamente');
           return;
        }
  
        $this->model->editCast($id,$nombre,$apellido);
  
          header('Location: '. BASE_URL);
       }

    public function showForm($id = null,$error = null){

        $cast = '';
        if (!is_null($id)) {
           $cast = $this->model->getCastById($id);
        }
  
        require './templates/form.cast.phtml';
     }

    
}