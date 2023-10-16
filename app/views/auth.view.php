<?php 

class AuthView{
    public function showLogin($error = null){
        require './templates/form.login.phtml';
    }

    public function showRegister($error = null){
        require './templates/form.register.phtml';
    }



}