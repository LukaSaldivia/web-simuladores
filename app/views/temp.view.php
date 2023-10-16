<?php

class TempView{
  public function showTemporadas(){
    require './templates/landing.phtml';
  }

  public function showList($caps){
    require './templates/lista.temporadas.phtml';
  }

  public function showRegister($error = null){
    require './templates/form.temporada.phtml';
  }

}