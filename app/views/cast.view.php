<?php

class CastView{

  public function showList($cast){
    require './templates/lista.cast.phtml';
  }

  public function showForm($id = null,$error = null){
    require './templates/form.cast.phtml';
  }
}