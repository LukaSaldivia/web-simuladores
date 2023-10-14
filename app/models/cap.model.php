<?php

require_once './app/models/model.php';

class CapModel extends Model{


  function getCapitulos(){
    $query = $this->db->prepare('SELECT * FROM capitulos');
    $query->execute();

    $capitulos = $query->fetchAll(PDO::FETCH_OBJ);

    return $capitulos;

  }

}