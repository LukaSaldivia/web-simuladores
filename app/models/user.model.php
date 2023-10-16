<?php 

class UserModel extends Model{


    public function getByUsername($username){
        $query = $this->db->prepare('SELECT * FROM usuarios WHERE username = ?');
        $query->execute([$username]);
        
        return $query->fetch(PDO::FETCH_OBJ);
    }
    
    public function addUser($username,$password){
        $query = $this->db->prepare('INSERT INTO usuarios (username, password) VALUES (?,?)');
        $query->execute([$username,$password]);
    }
}