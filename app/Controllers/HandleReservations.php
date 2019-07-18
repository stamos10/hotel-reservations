<?php

namespace App\Controllers;

require "../Exceptions/ErrorException.php";
require "Handler.php";
require "../Models/Connection.php";
require "../Models/Room.php";
require "../Models/Client.php";
require "../Models/Reservation.php";
require "../Models/FormHandler.php";
require "../Models/ClientFactory.php";
require "../Models/ReservationFactory.php";

use App\Exceptions\ErrorException;
use App\Models\Connection;
use App\Controllers\Handler;
use App\Models\FormHandler;
use App\Models\Observer;
use App\Models\Room;
use App\Models\Client;
use App\Models\Reservation;
use App\Models\ClientFactory;
use App\Models\ReservationFactory;

class HandleReservations extends Handler{
    

public function __construct(){
        
        
}
    
public function __destruct(){
        
        
}

public function check_availability(){
 
$validator = new FormHandler();
$conn = new Connection();
$con = $conn->getConnection();
$today = date(DATE_RFC2822);
$date = date('d-m-y');
$start_date = null;
$end_date = null;
$room_type = null;
$room_number = null;
$results = null;
$data = array();
$data['num'] = array();
$data['data'] = array();

        
        if(isset($_POST['start_date'])){
            $start_date = $_POST['start_date'];
        }
        
        if(isset($_POST['end_date'])){
            $end_date = $_POST['end_date'];
        }
        
        if(isset($_POST['room_type'])){
            $room_type = $validator->prepare_input($_POST['room_type']);
        }
        
        $room = new Room($con, null, null, null);
        $room->setRoomType($validator->prepare_input($room_type));
        $reservation = new Reservation($con);
        $reservation->setStartDay($validator->prepare_input($start_date));
        $reservation->setEndDay($validator->prepare_input($end_date));
        $reservation->setRoomType($room->getRoomType());
        $check_facility_open = json_decode($room->check_facility_open());
        $check = $reservation->check_reservation_dates($reservation->getStartDay(),
                                                       $reservation->getEndDay(),
                                                       $check_facility_open[0]->start_day,
                                                       $check_facility_open[0]->end_day);
        if($check == true){
        if($room_type != "any"){
        $results = $reservation->fetchReservationsByDatesAndType((int)$reservation->getStartDay(), (int)$reservation->getEndDay(), $room_type);
        $results_b = $reservation->fetchReservationsByDatesAndRoomTypeFree($room_type);
        }else{
        $results = $reservation->fetchReservationsByDates((int)$reservation->getStartDay(), (int)$reservation->getEndDay()); 
        $results_b = $reservation->fetchReservationsByDatesFree();
        }
        $num = $results->rowCount();
        $num_b = $results_b->rowCount();
        
        if($num > 0 || $num_b > 0){
         
        while($row = $results->fetch(\PDO::FETCH_ASSOC)){
         extract($row);
         $result_item = array('id' => $id,
                              'room_image' => $room_image,
                              'room_number' => $room_number,
                              'room_type' => $room_type,
                              'room_price' => $room_price,
                              'room_floor' => $room_floor,
                              'start_day' => $start_day,
                              'end_day' => $end_day
                             );
         
         array_push($data['data'], $result_item);
        }
        
        while($row_b = $results_b->fetch(\PDO::FETCH_ASSOC)){
         extract($row_b);
         $result_item_b = array('id' => $id,
                              'room_image' => $room_image,
                              'room_number' => $room_number,
                              'room_type' => $room_type,
                              'room_price' => $room_price,
                              'room_floor' => $room_floor,
                              'start_day' => $reservation->getStartDay(),
                              'end_day' => $reservation->getEndDay()
                              );
         
         array_push($data['data'], $result_item_b);
        }
        
        array_push($data['num'], (int)$num + (int)$num_b);
        }else{
         array_push($data['num'], 0);
         array_push($data['data'], "No Rooms found");
        }
        }else{
         array_push($data['num'], 0);
         array_push($data['data'], "Check In Date cannot be greater than Check Out Date");
        }
        
        $unique = 0;
        if(!empty($data['data'])){
        if($room_number != null){ 
        foreach($data['data'] as $key => $val){
        $unique = array_count_values(array_column($data['data'], 'room_number'))[$val['room_number']];
        if($unique > 1){
         unset($data['data'][$key]);
        }
        }
        }
        }
        echo json_encode($data);
        
}


public function fetch_data_for_reservation($room_number){

$conn = new Connection();
$con = $conn->getConnection();
$room = new Room($con, null, null, null);
$data = $room->fetchOneByRoom($room_number);
return $data;

}

public function make_reservation(){

$status = "occupied";
$deposit = 0;
$payment_id = "0"; 
$room_id = null;
$room_image = null;
$room_type = null;
$room_price = null;
$start_day = null;
$end_day = null;
$start_date = null;
$end_date = null;
$surname = null;
$firstname = null;
$email = null;
$phone = null;
$rooms = array();
$validator = new FormHandler();


if(isset($_POST['submit'])){

if(isset($_POST['rooms'])){
$rooms = $_POST['rooms']; 
}

$rooms = explode(",", $rooms);

if(isset($_POST['start_date'])){
$start_date = $_POST['start_date'];
$start_date = $validator->prepare_input($start_date);
}

if(isset($_POST['end_date'])){
$end_date = $_POST['end_date'];
$end_date = $validator->prepare_input($end_date);
}


if(isset($_POST['surname'])){
$surname = $_POST['surname'];
$surname = $validator->prepare_input($surname);
}

if(isset($_POST['firstname'])){
$firstname = $_POST['firstname']; 
$firstname = $validator->prepare_input($firstname);
}

if(isset($_POST['email'])){
$email = $_POST['email'];
$email = $validator->prepare_input($email);
$email = $validator->validate_email($email);
}

if(isset($_POST['phone'])){
$phone = $_POST['phone'];
$phone = $validator->prepare_input($phone);
$phone = $validator->validate_number($phone);
}

$ata = null;
$data_b = array();

foreach($rooms as $d){
if($d != "" || $d != null){
$ata = $this->fetch_data_for_reservation($d);
while($row = $ata->fetch(\PDO::FETCH_ASSOC)){
         extract($row);
         $result_item = array('id' => $id,
                              'room_number' => $room_number,
                              'room_type' => $room_type,
                              'room_price' => $room_price
                              );
         array_push($data_b, $result_item);
}
}
}
$dat = json_encode($data_b);
$dta = json_decode($dat);


foreach($dta as $rm){
$conn = new Connection();
$con = $conn->getConnection();
$room = new Room($con, null, null, null);
$room->update_status($rm->room_number, $status);

$client = new Client($con);
$client->setEmail($email);
$client->setUsername($email);
$client->setSurname($surname);
$client->setFirstname($firstname);
$client->setPhone($phone);
$client->setRoomId($rm->id);
$client->setRoomNumber($rm->room_number);
$result = $client->fetchClient($client->getEmail());
$num = $result->rowCount();
if($num == 0){
 $client->add();
}
$reservation = new Reservation($con);
$reservation->setStartDate($start_date);
$reservation->setStartDay($start_date);
$reservation->setEndDate($end_date);
$reservation->setEndDay($end_date);
$reservation->setPaymentId($payment_id);
$reservation->setClientEmail($email);
$reservation->setClientSurname($surname);
$reservation->setRoomId($rm->id);
$reservation->setRoomType($rm->room_type);
$reservation->setRoomNumber($rm->room_number);
$reservation->setRoomPrice($rm->room_price);
$reservation->setRoomDeposit($deposit);
$reservation->add();



}

}
$response = 'Action was completed succesfully';
header("location: ../admin/dashboard.php?message=" . $response);
}

public function fetch_reservations(){
 
$conn = new Connection();
$con = $conn->getConnection();
$reservation = new Reservation($con);
$data = $reservation->fetchAll();
return $data;
}

public function fetch_clients(){
 
$conn = new Connection();
$con = $conn->getConnection();
$client = new Client($con);
$data = $client->fetchAll();
return $data;
}

public function search_client($email){
 
$conn = new Connection();
$con = $conn->getConnection();
$client = new Client($con);
$data = $client->searchClient($email);
return $data;
}

public function free_room($id){
 
$status = "Free";
$conn = new Connection();
$con = $conn->getConnection();
$room = new Room($con);
$room->update_status($id, $status); 
}

public function delete_reservation($id){
        
        $conn = new Connection();
        $con = $conn->getConnection();
        $reservation = new Reservation($con);
        $reservation->delete($id);
}

public function delete_client($id){
        
        $conn = new Connection();
        $con = $conn->getConnection();
        $client = new Client($con);
        $client->delete($id);
}
    
    
}

if(isset($_POST['submit'])){
$action = '0';
$handler = new HandleReservations();
if(isset($_POST['action'])){
    $action = $_POST['action'];    
}
if($action == '1'){
$handler->check_availability();
}else if($action == '2'){

}else if($action == '3'){
$handler->make_reservation();
}else{
try{
throw new ErrorException;
}catch(ErrorException $e){
    echo $e->get_message();
}
}
}



?>