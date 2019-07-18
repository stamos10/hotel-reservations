<?php

namespace App\Models;

class User {
    
    private $username;
    private $password;
    
    private $conn = null;
    public $table_name = "users_storage";
    
    function __construct($conn){
        
        $this->conn = $conn;
    }
    
    function __destruct(){
        
        $this->conn = null;
    }
    
    public function setUsername($username){
        
        $this->username = trim($username);
    }
    
    public function getUsername(){
        
        return $this->username;
    }

    public function setPass($password){
        
        $password = trim($password);
        if($this->check_password($password) == trim("Password is Ok")){
        
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->password = $password;
        }else{
            $message = urlencode("Password must be at least 8 characters");
            
            $this->password = null;
        }
        
    }
    
    public function getPass(){
        
        return $this->password;
    }
    
    private function check_password($pass){
        
        $message = null;
        $password = $pass;
        if (strlen($password) < 7){
            $message = "Password Too Small";
        }else{
             $message = "Password is Ok";
        }
        
        return $message;
    }
    
    public function add_user(){
        
      if($this->check_password($this->getPass()) != null){
        
       $query = "INSERT INTO " . $this->table_name . " SET username=:username,
                                                             secret_t=:secret_t";
 
          $stmt = $this->conn->prepare($query);
 
          $stmt->bindParam(":username", $this->username);
          $stmt->bindParam(":secret_t", $this->password);
 
          $stmt->execute();
      }
    }
    
    public function update_user($username, $password){
        
       $query = "UPDATE " . $this->table_name . " SET secret_t=?
                                                      WHERE username=?";
 
          $stmt = $this->conn->prepare($query);
 
          $stmt->bindParam(1, $password);
          $stmt->bindParam(2, $username);
          
          $stmt->execute(); 
    }
    
    public function fetch_user($username){
        
        $query = "SELECT username FROM " . $this->table_name . " WHERE username=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
       
        return $stmt;
    }
    
     public function fetch_user_b($username){
        
        $query = "SELECT username FROM " . $this->table_name . " WHERE username=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
    
    public function fetch_it($username){
        
        $query = "SELECT secret_t FROM " . $this->table_name . " WHERE username=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
    
    public function fetch_credentials(){
        
        $query = "SELECT prop_a, prop_b, prop_c FROM " . $this->table_name ;
 
        $stmt = $this->conn->prepare($query);
    
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
    
    
}


?>