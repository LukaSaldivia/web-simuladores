<?php

require_once './app/models/model.php';

class CapModel extends Model{


  function getCapitulos(){
    $query = $this->db->prepare('SELECT * FROM capitulos LEFT JOIN temporadas ON capitulos.temporada = temporadas.idtemp');
    $query->execute();

    $capitulos = $query->fetchAll(PDO::FETCH_OBJ);

    return $capitulos;

  }

  function addCapitulos($id,$nombre, $descripcion,$temporadaid,$cast){
    
    try{
    $query = $this->db->prepare('INSERT INTO `capitulos` (`idcap`, `nombrecap`, `descripcion`, `temporada`) VALUES ( ? , ? , ? , ?)');
    $query->execute([$id,$nombre,$descripcion,$temporadaid]);

    
    foreach($cast as $idCast){
      
      $query = $this->db->prepare('INSERT INTO `castXcapitulo` (`id_cast`, `id_capitulo`) VALUES ( ? , ? )');
      $query->execute([$idCast,$id]);
    }
    return true;
  }catch(PDOException $e){
    return null;
  }

  }

  function deleteCapitulo($id){
    $query = $this->db->prepare('DELETE FROM capitulos WHERE idcap = ?');
    $query->execute([$id]);
  }

  function editCapitulo($id, $titulo, $descripcion, $temporada, $cast){

    $query = $this->db->prepare('UPDATE capitulos SET nombrecap = ?, descripcion = ? , temporada = ? WHERE idcap = ?');
    $query->execute([$titulo, $descripcion, $temporada, $id]);

    $query = $this->db->prepare('DELETE FROM castXcapitulo WHERE id_capitulo = ?');
    $query->execute([$id]);

    foreach($cast as $idCast){
      $query = $this->db->prepare('INSERT INTO `castXcapitulo` (`id_cast`, `id_capitulo`) VALUES ( ? , ? )');
      $query->execute([$idCast,$id]);

    }


  }
  
  function getCapituloData($id) {
    $cast = $this->getCastFromCapitulo($id);
    $query = $this->db->prepare('SELECT * FROM capitulos LEFT JOIN temporadas ON temporada = idtemp WHERE idcap = ?');
    $query->execute([$id]);

    $cap = $query->fetchAll(PDO::FETCH_OBJ);

    return array(
      'cap' => $cap,
      'cast' => $cast,
    );

  }

  function getCastFromCapitulo($id) {
    $query = $this->db->prepare('SELECT cast.*
    FROM capitulos
    LEFT JOIN castxcapitulo ON capitulos.idcap = castxcapitulo.id_capitulo
    LEFT JOIN cast ON castxcapitulo.id_cast = cast.idcast
    WHERE capitulos.idcap = ?');

    $query->execute([$id]);

    $cast = $query->fetchAll(PDO::FETCH_OBJ);

    return $cast;


  }

}