<?php

require_once './app/models/model.php';

class TempModel extends Model{
    function getTemporadas(){
        $query = $this->db->prepare('SELECT nombretemp FROM temporadas');
        $query->execute();
        $capitulos = $query->fetchAll(PDO::FETCH_OBJ);

        return $capitulos;
    }

    function addTemporada($nombre){
        $query = $this->db->prepare('INSERT INTO temporadas (nombretemp) VALUES (?)');
        $query->execute([$nombre]);
    
        return $this->db->lastInsertId();
      }

    function deleteTemporadas($id){
        $query = $this->db->prepare('DELETE FROM temporadas WHERE idcap = ?');
        $query->execute([$id]);
      }
    
    function editTemporadas($id){
        $query = $this->db->prepare('UPDATE FROM temporadas WHERE idcap = ?');
        $query->execute([$id]);
    }

    public function getBySeasonName($name){
      $query = $this->db->prepare('SELECT * FROM temporadas WHERE nombretemp = ?');
      $query->execute([$name]);
      
      return $query->fetch(PDO::FETCH_OBJ);
  }
}