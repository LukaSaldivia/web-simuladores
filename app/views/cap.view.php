<?php

class CapView{
  public function showCapitulos(){
    require './templates/landing.phtml';
  }

  public function showList($caps){
    require './templates/lista.capitulos.phtml';
  }


}