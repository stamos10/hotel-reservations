<?php

namespace App\Models;

use \App\Models\Room;
use \App\Models\Reservation;
use \App\Models\Interfaces\CRUDOperator;

class Client implements CRUDOperator{
    
    public $id;
    private $email;
    private $phone;
    private $surname;
    private $firstname;
    private $username;
    private $keep_data = 0;
    public $timestamp;
    private $room_id;
    private $room_number;
    private $conn = null;
    public $table_name = "clients";
    
    
    /* Constructors - Destructors */
    
    public function __construct($conn){
        
       $this->conn = $conn;
    }
    
    public function __destruct(){
        
        $this->conn = null;
    }
    
    
    /* Encapsulation */
    
    public function setEmail($email){
        
        $this->email = trim($email);
    }
    
    public function getEmail(){
        
        return $this->email;
    }
    
    public function setPhone($phone){
        
        $this->phone = trim($phone);
    }
    
    public function getPhone(){
        
        return $this->phone;
    }
    
    public function setSurname($surname){
        
        $this->surname = trim($surname);
    }
    
    public function getSurname(){
        
        return $this->surname;
    }
    
    public function setFirstname($firstname){
        
        $this->firstname = trim($firstname);
    }
    
    public function getFirstname(){
        
        return $this->firstname;
    }
    
    public function setUsername($username){
    
        $usernm = explode("@", trim($username));
        $random_number = rand(10, 99);
        $this->username = $usernm[0] . $random_number;
    }
    
    public function getUsername(){
        
        return $this->username;
    }
    
    public function setKeepData($keep_data){
        
        $this->keep_data = $keep_data;
    }
    
    public function getKeepData(){
        
        return $this->keep_data;
    }
    
    
    public function setRoomId($room_id){
        
        $this->room_id = $room_id;
    }
    
    public function getRoomId(){
        
        return $this->room_id;
    }
    
    public function setRoomNumber($room_number) {
        
        $this->room_number = $room_number;
    }
    
    public function getRoomNumber() {
        
        return $this->room_number;
    }
    
    
    
    /* Database interaction CRUDOperator*/
    
    public function add(){
        
         $query = "INSERT INTO " . $this->table_name . " SET firstname=:firstname,
                                                             surname=:surname,
                                                             email=:email,
                                                             username=:username,
                                                             phone=:phone,
                                                             keep_data=:keep_data,
                                                             room_id=:room_id,
                                                             room_number=:room_number,
                                                             created=:created";
 
          $stmt = $this->conn->prepare($query);
 
           $this->timestamp = date('Y-m-d');
 
          $stmt->bindParam(":firstname", $this->firstname);
          $stmt->bindParam(":surname", $this->surname);
          $stmt->bindParam(":email", $this->email);
          $stmt->bindParam(":username", $this->username);
          $stmt->bindParam(":phone", $this->phone);
          $stmt->bindParam(":keep_data", $this->keep_data);
          $stmt->bindParam(":room_id", $this->room_id);
          $stmt->bindParam(":room_number", $this->room_number);
          $stmt->bindParam(":created", $this->timestamp);
 
          $stmt->execute();
    }
    
    public function update($id){
    
        $query = "UPDATE " . $this->table_name . " SET firstname=:firstname,
                                                            surname=:surname,
                                                             email=:email,
                                                             username=:username,
                                                             phone=:phone,
                                                             keep_data=:keep_data,
                                                             room_id=:room_id,
                                                             room_number=:room_number,
                                                             created=:created 
                                                             WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);
 
         $this->timestamp = date('Y-m-d');
 
        $stmt->bindParam(":firstname", $this->firstname);
          $stmt->bindParam(":surname", $this->surname);
          $stmt->bindParam(":email", $this->email);
          $stmt->bindParam(":username", $this->username);
          $stmt->bindParam(":phone", $this->phone);
          $stmt->bindParam(":keep_data", $this->keep_data);
          $stmt->bindParam(":room_id", $this->room_id);
          $stmt->bindParam(":room_number", $this->room_number);
        $stmt->bindParam(":created", $this->timestamp);
        $stmt->bindParam(":id", $id);
        
        $stmt->execute();
       
    }
    
    public function fetchAll(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY surname ASC";
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
    
    public function fetchOne($email){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE email=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        
        return $stmt;
    }
    
     public function searchClient($email){
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE email=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
        
        return json_encode($results); 
    }
    
     public function fetchClient($email){
        
        $query = "SELECT surname, firstname, email, phone FROM " . $this->table_name . " WHERE email=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        
        return $stmt;
    }
    
    public function delete($id){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE email=?";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        
        $stmt->execute();
       
    }
}


?>