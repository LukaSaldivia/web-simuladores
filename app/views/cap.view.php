<?php

class CapView{
  public function showCapitulos($caps){
    require './templates/landing.phtml';
  }

  public function showList($caps){
    require './templates/lista.capitulos.phtml';
  }
  
  public function showVideoPlayer($data){
    require './templates/videoplayer.phtml';
  }

  public function showForm($id = null, $error = null, $capData, $cast, $temps){
    require './templates/form.capitulo.phtml';
  }


}