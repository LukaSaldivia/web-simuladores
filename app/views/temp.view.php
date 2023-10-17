<?php

class TempView{


  public function showList($temps){
    require './templates/lista.temporadas.phtml';
  }

  public function showForm($id = null,$error = null){
    require './templates/form.temporada.phtml';
  }

}