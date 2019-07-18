<?php

namespace App\Models;

class Connection{
  
 
    private $host;
    private $db_name;
    private $username;
    private $password;
    public $conn;
    

  
    public function __construct(){
       
        
    }
    
    public function __destruct(){
        
        
    }
  
    public function getConnection(){
  
        $this->conn = null;
        $config = parse_ini_file("../../config.ini", true);
        $this->host = $config['Database']['server'];
        $this->db_name = $config['Database']['database_name'];
        $this->username = $config['Database']['username'];
        $this->password = $config['Database']['password'];
  
        try{
            $this->conn = new \PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        }catch(\PDOException $exception){
            //echo "Connection error: " . $exception->getMessage();
        }
  
        return $this->conn;
    }
}
?>