<?php

namespace App\Models;


class Theme{
    
 
private $conn = null;
public $theme;
public $timestamp;
public $table_name = "themes";
    
    /* Constructors - Destructors */
    
    function __construct($conn, $theme){
        
        $this->conn = $conn;
        $this->theme = $theme;
    }
    
    function __destruct(){
        
        $this->conn = null;
    }
    
    public function add_theme(){
        
        $query = "INSERT INTO " . $this->table_name . " SET theme=:theme,
                                                            created=:created";
 
          $stmt = $this->conn->prepare($query);
 
          $this->timestamp = date('Y-m-d');
          
          $stmt->bindParam(":theme", $this->theme);
          $stmt->bindParam(":created", $this->timestamp);
 
          $stmt->execute();
    }
    
    public function update_theme(){
        
        $query = "UPDATE " . $this->table_name . " SET theme=:theme,
                                                       created=:created";
 
          $stmt = $this->conn->prepare($query);
 
          $this->timestamp = date('Y-m-d');
          
          $stmt->bindParam(":theme", $this->theme);
          $stmt->bindParam(":created", $this->timestamp);
 
          $stmt->execute();
    }
    
    public function fetch_theme(){
        
        $query = "SELECT * FROM " . $this->table_name;
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
}