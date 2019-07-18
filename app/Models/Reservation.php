<?php

namespace App\Models;

use App\Models\Interfaces\CRUDOperator;
use App\Models\Client;
use App\Models\Room;

class Reservation implements CRUDOperator{
    
    public $id;
    private $start_date;
    private $end_date;
    private $start_day;
    private $end_day;
    private $payment_id;
    public $timestamp; 
    private $client_email;
    private $client_surname;
    private $room_id;
    private $room_type;
    private $room_number;
    private $room_price;
    private $room_deposit;
    
    private $conn = null;
    public $table_name = "reservations";
    
    
    /* Constructors - Destructors */
    
    function __construct($conn){
        
        $this->conn = $conn;
    }
    
    function __destruct(){
        
        $this->conn = null;
    }
    
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
    
    public function setPaymentId($payment_id){
        
        $this->payment_id = $payment_id;
    }
    
    public function getPaymentId(){
        
        return $this->payment_id;
    }
    
     public function setRoomId($room_id) {
        
        $this->room_id = $room_id;
       
    }
    
    public function getRoomId() {
        
        return $this->room_id;
    }
    
    public function setRoomType($room_type) {
        
        $this->room_type = $room_type;
       
    }
    
    public function getRoomType() {
        
        return $this->room_type;
    }
    
    public function setRoomNumber($room_number) {
        
        $this->room_number = $room_number;
       
    }
    
    public function getRoomNumber() {
        
        return $this->room_number;
    }
    
    public function setRoomPrice($room_price) {
        
        $this->room_price = $room_price;
       
    }
    
    public function getRoomPrice() {
        
        return $this->room_price;
    }
    
    public function setRoomDeposit($room_deposit) {
        
        $this->room_deposit = $room_deposit;
       
    }
    
    public function getRoomDeposit() {
        
        return $this->room_deposit;
    }
    
    public function setClientEmail($client_email) {
        
        $this->client_email = $client_email;
       
    }
    
    public function getClientId() {
        
        return $this->client_email;
    }
    
    public function setClientSurname($client_surname) {
        
        $this->client_surname = $client_surname;
       
    }
    
    public function getClientSurname() {
        
        return $this->client_surname;
    }
    
    
    /* Database interaction CRUDOperator*/
    
    public function add(){
        
       $query = "INSERT INTO " . $this->table_name . " SET start_date=:start_date,
                                                             end_date=:end_date,
                                                             start_day=:start_day,
                                                             end_day=:end_day,
                                                             payment_id=:payment_id,
                                                             client_email=:client_email,
                                                             client_surname=:client_surname,
                                                             room_id=:room_id,
                                                             room_type=:room_type,
                                                             room_number=:room_number,
                                                             room_price=:room_price,
                                                             room_deposit=:room_deposit,
                                                             created=:created";
 
          $stmt = $this->conn->prepare($query);
 
          $this->timestamp = date('Y-m-d');
 
          $stmt->bindParam(":start_date", $this->start_date);
          $stmt->bindParam(":end_date", $this->end_date);
          $stmt->bindParam(":start_day", $this->start_day);
          $stmt->bindParam(":end_day", $this->end_day);
          $stmt->bindParam(":payment_id", $this->payment_id);
          $stmt->bindParam(":client_email", $this->client_email);
          $stmt->bindParam(":client_surname", $this->client_surname);
          $stmt->bindParam(":room_id", $this->room_id);
          $stmt->bindParam(":room_type", $this->room_type);
          $stmt->bindParam(":room_number", $this->room_number);
          $stmt->bindParam(":room_price", $this->room_price);
          $stmt->bindParam(":room_deposit", $this->room_deposit);
          $stmt->bindParam(":created", $this->timestamp);
 
          $stmt->execute(); 
    }
    
    public function update($id){
        
        $query = "UPDATE " . $this->table_name . " SET start_date=:start_date,
                                                             end_date=:end_date,
                                                             start_day=:start_day,
                                                             end_day=:end_day,
                                                             payment_id=:payment_id,
                                                             client_email=:client_email,
                                                             client_surname=:client_surname,
                                                             room_id=:room_id,
                                                             room_type=:room_type,
                                                             room_number=:room_number,
                                                             room_price=:room_price,
                                                             room_deposit=:room_deposit,
                                                             created=:created
                                                             WHERE id=:id";
 
          $stmt = $this->conn->prepare($query);
 
           $this->timestamp = date('Y-m-d');
 
          $stmt->bindParam(":start_date", $this->start_date);
          $stmt->bindParam(":end_date", $this->end_date);
          $stmt->bindParam(":start_day", $this->start_day);
          $stmt->bindParam(":end_day", $this->end_day);
          $stmt->bindParam(":payment_id", $this->payment_id);
          $stmt->bindParam(":client_email", $this->client_email);
          $stmt->bindParam(":client_surname", $this->client_surname);
          $stmt->bindParam(":room_id", $this->room_id);
          $stmt->bindParam(":room_type", $this->room_type);
          $stmt->bindParam(":room_number", $this->room_number);
          $stmt->bindParam(":room_price", $this->room_price);
          $stmt->bindParam(":room_deposit", $this->room_deposit);
          $stmt->bindParam(":created", $this->timestamp);
          $stmt->bindParam(":id", $id);
          $stmt->execute(); 
    }
    
    public function fetchAll(){
        
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
 
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
    
    public function fetchReservationsByDates($start_day, $end_day){
        
        $query = "SELECT 
                  r.id,
                  r.room_image,
                  r.room_number,
                  r.room_type,
                  r.room_price,
                  r.room_floor,
                  r.deposit,
                  r.vat,
                  re.room_number,
                  re.start_day,
                  re.end_day
                  FROM rooms r
                  LEFT JOIN
                  reservations re on r.room_number = re.room_number
                  WHERE (re.start_day < ? AND re.end_day <= ? 
                  OR re.start_day >= ? AND re.end_day > ?
                  )";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $start_day);
        $stmt->bindParam(2, $start_day);
        $stmt->bindParam(3, $end_day);
        $stmt->bindParam(4, $end_day);
        
        $stmt->execute();
        return $stmt;
    }
    
    public function fetchReservationsByDatesFree(){
        
        $query = "SELECT * FROM rooms WHERE status='Free'";
 
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    
    
    public function fetchReservationsByDatesAndType($start_day, $end_day, $type){
      
        $query = "SELECT
                  r.id,
                  r.room_image,
                  r.room_number,
                  r.room_type,
                  r.room_price,
                  r.room_floor,
                  r.deposit,
                  r.vat,
                  re.room_number,
                  re.start_day,
                  re.end_day
                  FROM rooms r
                  LEFT JOIN
                  reservations re on r.room_number = re.room_number
                  WHERE (re.start_day < ? AND re.end_day <= ? AND r.room_type = ?
                  OR re.start_day >= ? AND re.end_day > ? AND r.room_type = ?
                  )";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $start_day);
        $stmt->bindParam(2, $start_day);
        $stmt->bindParam(3, $type);
        $stmt->bindParam(4, $end_day);
        $stmt->bindParam(5, $end_day);
        $stmt->bindParam(6, $type);
        $stmt->execute();
        return $stmt;
       
    }
    
    public function fetchReservationsByDatesAndRoomTypeFree($type){
        
        $query = "SELECT * FROM rooms WHERE status='Free' AND room_type=?";
 
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $type);
        $stmt->execute();
        return $stmt;
    }
    
    public function delete($id){
        
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
     
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        
        $stmt->execute();
        
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

public function check_reservation_dates($start, $end, $season_start, $season_end){
    
    if($start < $season_start){
        return false;
    }
    
    if($end > $season_end){
        return false;
    }
    
    if($start > 350 && $start <= 365){
        if($end <= 15){
            return true;
        }
    }
    if($end - $start >= 0){
        return true;
    }
    return false;
}

private function check_price_in_limits($results, $price){
    
    $results_checked = $array();
    $results = json_decode($results);
    $room = null;
    foreach($results as $res){
    $room = unserialize($res->room);
    if($room->room_price <= $price){
        array_push($results_checked, $res);
    }
    }
     
     return json_encode($results_checked);
}

private function check_price_and_type_in_limits($results, $price, $type){
    
    /* Check price and type within limits implementation*/
     return json_encode($results);
}

}
?>