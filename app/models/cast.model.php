<?php

require_once './app/models/model.php';

class CastModel extends Model{


  function getCast(){
    $query = $this->db->prepare('SELECT * FROM cast ');
    $query->execute();

    $cast = $query->fetchAll(PDO::FETCH_OBJ);

    return $cast;

  }

  function addCast($id,$nombre, $apellido){
    $query = $this->db->prepare('INSERT INTO cast (idcast, nombrecast, apellido) VALUES ( ? , ? , ?)');
    $query->execute([$id,$nombre,$apellido,]);

  }

  function editCast($id, $nombre, $apellido){
    $query = $this->db->prepare('UPDATE cast SET nombrecast = ?, apellido = ? WHERE idcast = ?');
    $query->execute([$nombre,$apellido,$id]);
  }

  function deleteCast($id){
    $query = $this->db->prepare('DELETE FROM cast WHERE idcast = ?');
    $query->execute([$id]);
  }

  public function getCastById($id){
    $query = $this->db->prepare('SELECT * FROM cast WHERE idcast = ?');
    $query->execute([$id]);
    
    return $query->fetch(PDO::FETCH_OBJ);
  }
  
}