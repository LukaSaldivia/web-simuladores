<?php

class CastView{
  public function showCast($cast){
    require './templates/landing.phtml';
  }

  public function showList($cast){
    require './templates/lista.cast.phtml';
  }

  public function showForm($id = null,$error = null){
    require './templates/form.cast.phtml';
  }
}