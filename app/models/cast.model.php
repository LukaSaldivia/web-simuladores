<?php

require_once './app/models/model.php';

class CastModel extends Model{


  function getCast(){
    $query = $this->db->prepare('SELECT * FROM cast ');
    $query->execute();

    $cast = $query->fetchAll(PDO::FETCH_OBJ);

    return $cast;

  }
}