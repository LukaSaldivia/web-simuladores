<?php

require_once './app/models/model.php';

class CapModel extends Model{


  function getCapitulos(){
    $query = $this->db->prepare('SELECT * FROM capitulos LEFT JOIN temporadas ON capitulos.temporada = temporadas.idtemp');
    $query->execute();

    $capitulos = $query->fetchAll(PDO::FETCH_OBJ);

    return $capitulos;

  }

  function addCapitulos($nombre, $descripcion,$temporadaid){
    $query = $this->db->prepare('INSERT INTO capitulos (nombrecap, descripcion, temporada) VALUES (?,?,?)');
    $query->execute([$nombre,$descripcion,$temporadaid]);

    return $this->db->lastInsertId();
  }

  function deleteCapitulos($id){
    $query = $this->db->prepare('DELETE FROM capitulos WHERE idcap = ?');
    $query->execute([$id]);
  }

  function editCapitulos($id){
    $query = $this->db->prepare('UPDATE FROM capitulos WHERE idcap = ?');
    $query->execute([$id]);
  }

}