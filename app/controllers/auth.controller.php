<?php
require_once './app/models/user.model.php';
require_once './app/views/auth.view.php';
require_once './app/helper/auth.helper.php';

class AuthController{
    private $model;
    private $view;
    function __construct(){
        $this->model = new UserModel();
        $this->view = new AuthView();
    }

    public function showLogin(){
        $this->view->showLogin();
    }
    public function showRegister(){
        $this->view->showRegister();
    }

    public function authLogin(){
        $username = $_POST['username'];
        $password = $_POST['password'];


        if (empty($username) || empty($password)){
            $this->view->showLogin("Complete todos los campos");
            return;
        }

        $user = $this->model->getByUsername($username);
        if ($user && password_verify($password, $user->password)) {
            AuthHelper::login($user);
            header('Location: ' . BASE_URL);
        } else {
            $this->view->showLogin('Usuario inválido');
        }

    }

    public function authRegister() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        if (empty($username) || empty($password)){
            $this->view->showRegister("Complete todos los campos");
            return;
        }else{
            // Los datos están completos
            if (strlen($username) < 8 || strlen($username) > 20) {
                $this->view->showRegister('El nombre de usuario debe tener entre 8 y 20 carácteres');
            }else{
                // El username está entre 8 y 20 caracteres
                $userOtro = $this->model->getByUsername($username);
                if($userOtro){
                    $this->view->showRegister('Ya existe un usuario con ese nombre');
                    
                }else{
                    // No hay otro usuario con ese username
                    $passwordHash = password_hash($password, PASSWORD_BCRYPT);
                    $this->model->addUser($username,$passwordHash);
                    $user = $this->model->getByUsername($username);
                    
                    AuthHelper::login($user);
                    header('Location: ' . BASE_URL);
                    
                    
                }
            }

        }

        
    }

    public function logout() {
        AuthHelper::logout();
        header('Location: ' . BASE_URL);    
    }

}