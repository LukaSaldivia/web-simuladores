<?php

require_once './app/models/model.php';

class TempModel extends Model{
    function getTemporadas(){
        $query = $this->db->prepare('SELECT * FROM temporadas');
        $query->execute();
        $temporadas = $query->fetchAll(PDO::FETCH_OBJ);

        return $temporadas;
    }

    function addTemporada($nombre){
        $query = $this->db->prepare('INSERT INTO temporadas (nombretemp) VALUES (?)');
        $query->execute([$nombre]);
    
        return $this->db->lastInsertId();
      }

    function deleteTemporada($id){
        $query = $this->db->prepare('DELETE FROM temporadas WHERE idtemp = ?');
        $query->execute([$id]);
      }
    
    function editTemporada($id, $nombre){
        $query = $this->db->prepare('UPDATE temporadas SET nombretemp = ? WHERE idtemp = ?');
        $query->execute([$nombre,$id]);
    }

    public function getSeasonByName($name){
      $query = $this->db->prepare('SELECT * FROM temporadas WHERE nombretemp = ?');
      $query->execute([$name]);
      
      return $query->fetch(PDO::FETCH_OBJ);
  }
  
    public function getSeasonById($id){
      $query = $this->db->prepare('SELECT * FROM temporadas WHERE idtemp = ?');
      $query->execute([$id]);
      
      return $query->fetch(PDO::FETCH_OBJ);
  }
  
}