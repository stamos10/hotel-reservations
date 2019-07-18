<?php

namespace App\Models;

require "Interfaces/CRUDOperator.php";

use \App\Models\Comforts;
use \App\Models\Interfaces\CRUDOperator;

class Room implements CRUDOperator{
    
    public $id;
    public $start_date;
    public $end_date;
    public $start_day;
    public $end_day;
    public $room_number;
    public $room_floor;
    private $room_type;
    private $room_price;
    private $room_image;
    private $no_of_beds;
    private $no_of_rooms;
    private $vat;
    private $deposit;
    private $status;
    public $timestamp;
    
    private $comforts = null;
    private $conn = null;
    public $table_name = "rooms";
    
    /* Constructors - Destructors */
    
    function __construct($conn, $room_type, $room_number, $room_floor){
        
        $this->conn = $conn;
        $this->room_type = $room_type;
        $this->room_number = $room_number;
        $this->room_floor = $room_floor;
    }
    
    function __destruct(){
        
        $this->conn = null;
    }
    
    /* Encapsulation */
    
     public function setStartDay($start_date){
       
        $start_day = $start_date;
        $start_day_b = explode("/", trim($start_day));
        $month_days = $this->getMonthTotal(trim($start_day_b[2]), trim($start_day_b[1]));
        $start_day = $month_days + $start_day_b[0];
        
        $this->start_day = $start_day;
    }
    
    public function getStartDay(){
        
        return $this->start_day;
    }
    
    public function setEndDay($end_date){
       
        $end_day = $end_date;
        $end_day_b = explode("/", trim($end_day));
        $month_days = $this->getMonthTotal(trim($end_day_b[2]), trim($end_day_b[1]));
        $end_day = $month_days + $end_day_b[0];
        
        $this->end_day = $end_day;
    }
    
    public function getEndDay(){
        
        return $this->end_day;
    }
    
    public function setStartDate($start_date){
        
        $this->start_date = $start_date;
    }
    
    public function getStartDate(){
        
        return $this->start_date;
    }
    
    public function setEndDate($end_date){
        
        $this->end_date = $end_date;
    }
    
    public function getEndDate(){
        
        return $this->end_date;
    }
    
    public function setRoomNumber($room_number){
        
      $this->room_number = trim($room_number);
    }
    
    public function getRoomNumber(){
        
    return $this->room_number;
    }
    
    public function setRoomFloor($room_floor){
        
      $this->room_floor = $room_floor;
    }
    
    public function getRoomFloor(){
        
    return $this->room_floor;
    }
    
     public function setRoomType($room_type){
        
      $this->room_type = trim($room_type);
    }
    
    public function getRoomType(){
        
    return $this->room_type;
    }
    
     public function setRoomPrice($room_price){
        
      $this->room_price = $room_price;
    }
    
    public function getRoomPrice(){
        
    return $this->room_price;
    }
    
     public function setRoomImage($room_image){
        
      $this->room_image = trim($room_image);
    }
    
    public function getRoomImage(){
        
    return $this->room_image;
    }
    
     public function setNoRooms($no_of_rooms){
        
      $this->no_of_rooms = $no_of_rooms;
    }
    
    public function getNoRooms(){
        
    return $this->no_of_rooms;
    }
    
    public function setNoBeds($no_of_beds){
        
      $this->no_of_beds = $no_of_beds;
    }
    
    public function getNoBeds(){
        
    return $this->no_of_beds;
    }
    
    public function setVat($vat){
        
        $this->vat = $vat;
    }
    
    public function getVat(){
        
        return $this->vat;
    }
    
    public function setDeposit($deposit){
        
        $this->deposit = $deposit;
    }
    
    public function getDeposit(){
        
        return $this->deposit;
    }
    
    public function setRoomStatus($status){
        
        $this->status = $status;
    }
    
    public function getRoomStatus(){
        
        return $this->status;
    }
    
    
    
    /* Database interaction CRUDOperator*/
    
    public function add(){
        
        $query = "INSERT INTO " . $this->table_name . " SET start_date=:start_date,
                                                             end_date=:end_date,
                                                             start_day=:start_day,
                                                             end_day=:end_day,
                                                             room_number=:room_number,
                                                             room_floor=:room_floor,
                                                             room_type=:room_type,
                                                             room_price=:room_price,
                                                             room_image=:room_image,
                                                             beds=:no_of_beds,
                                                             rooms=:no_of_rooms,
                                                             vat=:vat,
                                                             deposit=:deposit,
                                                             status=:status,
                                                             created=:created";
 
          $stmt = $this->conn->prepare($query);
 
          $this->timestamp = date('Y-m-d');
          
           $stmt->bindParam(":start_date", $this->start_date);
          $stmt->bindParam(":end_date", $this->end_date);
          $stmt->bindParam(":start_day", $this->start_day);
          $stmt->bindParam(":end_day", $this->end_day);
          $stmt->bindParam(":room_number", $this->room_number);
          $stmt->bindParam(":room_floor", $this->room_floor);
          $stmt->bindParam(":room_type", $this->room_type);
          $stmt->bindParam(":room_price", $this->room_price);
          $stmt->bindParam(":room_image", $this->room_image);
          $stmt->bindParam(":no_of_beds", $this->beds);
          $stmt->bindParam(":no_of_rooms", $this->rooms);
          $stmt->bindParam(":vat", $this->vat);
          $stmt->bindParam(":deposit", $this->deposit);
          $stmt->bindParam(":status", $this->status);
          $stmt->bindParam(":created", $this->timestamp);
 
          $stmt->execute();
    }
    
    public function update($id){
        
        $query = "UPDATE " . $this->table_name . " SET start_date=:start_date,
                                                             end_date=:end_date,
                                                             start_day=:start_day,
                                                             end_day=:end_day,
                                                             room_number=:room_number,
                                                             room_floor=:room_floor,
                                                             room_type=:room_type,
                                                             room_price=:room_price,
                                                             room_image=:room_image,
                                                             beds=:no_of_beds,
                                                             rooms=:no_of_rooms,
                                                             vat=:vat,
                                                             deposit=:deposit,
                                                             created=:created
                                                             WHERE id=:id";
 
          $stmt = $this->conn->prepare($query);
 
           $this->timestamp = date('Y-m-d');
 
           $stmt->bindParam(":start_date", $this->start_date);
          $stmt->bindParam(":end_date", $this->end_date);
          $stmt->bindParam(":start_day", $this->start_day);
          $stmt->bindParam(":end_day", $this->end_day);
          $stmt->bindParam(":room_number", $this->room_number);
          $stmt->bindParam(":room_floor", $this->room_floor);
          $stmt->bindParam(":room_type", $this->room_type);
          $stmt->bindParam(":room_price", $this->room_price);
          $stmt->bindParam(":room_image", $this->room_image);
          $stmt->bindParam(":no_of_beds", $this->beds);
          $stmt->bindParam(":no_of_rooms", $this->rooms);
          $stmt->bindParam(":vat", $this->vat);
          $stmt->bindParam(":deposit", $this->deposit);
          $stmt->bindParam(":created", $this->timestamp);
          $stmt->bindParam(":id", $id);
          
          $stmt->execute();
    }
    
    public function update_b($room_type){
        
        $query = "UPDATE " . $this->table_name . " SET start_date=:start_date,
                                                             end_date=:end_date,
                                                             start_day=:start_day,
                                                             end_day=:end_day,
                                                             room_price=:room_price,
                                                             room_image=:room_image,
                                                             beds=:no_of_beds,
                                                             rooms=:no_of_rooms,
                                                             vat=:vat,
                                                             deposit=:deposit,
                                                             created=:created
                                                             WHERE room_type=:room_type";
 
          $stmt = $this->conn->prepare($query);
 
           $this->timestamp = date('Y-m-d');
 
          $stmt->bindParam(":start_date", $this->start_date);
          $stmt->bindParam(":end_date", $this->end_date);
          $stmt->bindParam(":start_day", $this->start_day);
          $stmt->bindParam(":end_day", $this->end_day);
          $stmt->bindParam(":room_price", $this->room_price);
          $stmt->bindParam(":room_image", $this->room_image);
          $stmt->bindParam(":no_of_beds", $this->beds);
          $stmt->bindParam(":no_of_rooms", $this->rooms);
          $stmt->bindParam(":vat", $this->vat);
          $stmt->bindParam(":deposit", $this->deposit);
          $stmt->bindParam(":created", $this->timestamp);
          $stmt->bindParam(":room_type", $this->room_type);
          $stmt->execute();
    }
    
     public function update_c(){
        
        $query = "UPDATE " . $this->table_name . " SET start_date=:start_date,
                                                             end_date=:end_date,
                                                             start_day=:start_day,
                                                             end_day=:end_day,
                                                             room_price=:room_price,
                                                             room_image=:room_image,
                                                             beds=:no_of_beds,
                                                             rooms=:no_of_rooms,
                                                             vat=:vat,
                                                             deposit=:deposit,
                                                             created=:created";
 
          $stmt = $this->conn->prepare($query);

           $this->timestamp = date('Y-m-d');
 
          $stmt->bindParam(":start_date", $this->start_date);
          $stmt->bindParam(":end_date", $this->end_date);
          $stmt->bindParam(":start_day", $this->start_day);
          $stmt->bindParam(":end_day", $this->end_day);
          $stmt->bindParam(":room_price", $this->room_price);
          $stmt->bindParam(":room_image", $this->room_image);
          $stmt->bindParam(":no_of_beds", $this->beds);
          $stmt->bindParam(":no_of_rooms", $this->rooms);
          $stmt->bindParam(":vat", $this->vat);
          $stmt->bindParam(":deposit", $this->deposit);
          $stmt->bindParam(":created", $this->timestamp);
          
          $stmt->execute();
    }
    
    public function fetchAll(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id ASC";
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
       
        return json_encode($results);
    }
    
    public function fetchOne($id){
        
       $query = "SELECT * FROM " . $this->table_name . " WHERE id=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
        
        return json_encode($results); 
    }
    
     public function fetchOneByRoom($room_number){
        
       $query = "SELECT id, room_price, room_type, room_price, room_number, vat, deposit FROM " . $this->table_name . " WHERE room_number=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $room_number);
        $stmt->execute();
        
        return $stmt; 
    }
    
    public function delete($id){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        
        $stmt->execute();
       
    }
    
    public function add_first_step($room_type, $created, $image_url, $status){
        
        $query = "INSERT INTO " . $this->table_name . " (room_type, created, room_image, status) values (?, ?, ?, ?)";
 
          $stmt = $this->conn->prepare($query);
          
          $stmt->bindParam(1, $room_type);
          $stmt->bindParam(2, $created);
          $stmt->bindParam(3, $image_url);
          $stmt->bindParam(4, $status);
 
          $stmt->execute();
    }
    
    public function update_second_step($room_number, $room_floor, $id){
        
        $query = "UPDATE " . $this->table_name . " SET room_number=?, room_floor=? WHERE id=? ";
 
          $stmt = $this->conn->prepare($query);
          
          $stmt->bindParam(1, $room_number);
          $stmt->bindParam(2, $room_floor);
          $stmt->bindParam(3, $id);
 
          $stmt->execute();
    }
    
    public function update_status($id, $status){
        
        $query = "UPDATE " . $this->table_name . " SET status=? WHERE room_number=? ";
 
          $stmt = $this->conn->prepare($query);
          
          $stmt->bindParam(1, $status);
          $stmt->bindParam(2, $id); 
          $stmt->execute();
    }
    
    public function check_facility_open(){
        
       $query = "SELECT start_day, end_day FROM " . $this->table_name ;
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $stmt->closeCursor();
        
        return json_encode($results);  
    }
    
 private function getMonthTotal($year, $month){
        
        $num_days = 0;
        $num = 0;
        $total = 0;
        
        switch($month){
        case "01":
        $num_days = 0;
        break;
        case "02":
        $num_days = 31;
        break;
        case "03":
        $num_days = 59;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "04":
        $num_days = 90;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "05":
        $num_days = 120;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "06":
        $num_days = 151;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "07":
        $num_days = 181;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "08":
        $num_days = 212;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "09":
        $num_days = 243;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "10":
        $num_days = 273;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "11":
        $num_days = 304;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        case "12":
        $num_days = 334;
        $num_days = $this->check_disekto($num_days, $year);
        break;
        default:
        $num_days = 0;
        break;
        }
        
    if($year == "2019"){
        $num = 0;
    }else if($year == "2020"){
        $num = 0;
    }else if($year == "2021"){
        $num = 365;
    }else if($year == "2022"){
        $num = 730;
    }else if($year == "2023"){
        $num = 1095;
    }else if($year == "2024"){
        $num = 1460;
    }else if($year == "2025"){
        $num = 1825;
    }else if($year == "2026"){
        $num = 2190;
    }else if($year == "2027"){
        $num = 2555;
    }else if($year == "2028"){
        $num = 2920;
    }       
     
     $total = (int)$num_days + (int)$num;   
     return $total;
    }
    


private function check_disekto($days, $year){
     
     $disekta = array('2020', '2024', '2028', '2032', '2036', '2040', '2044', '2048',
                         '2052', '2056', '2060', '2064');
     
     foreach($disekta as $ds){
            if(trim($year == trim($ds))){
                $days += 1;
            }
        }
    return $days;
}

    
}


?>