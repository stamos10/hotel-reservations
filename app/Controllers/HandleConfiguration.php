<?php

namespace App\Controllers;

require "../Exceptions/ErrorException.php";
require "Handler.php";
require "../Models/Connection.php";
require "../Models/Room.php";
require "../Models/Reservation.php";
require "../Models/Client.php";
require "../Models/FormHandler.php";
require "../Models/Theme.php";

use \App\Exceptions\ErrorException;
use \App\Models\Connection;
use \App\Controllers\Handler;
use \App\Models\FormHandler;
use \App\Models\Observer;
use \App\Models\Room;
use \App\Models\Reservation;
use \App\Models\Client;
use \App\Models\Theme;

class HandleConfiguration extends Handler{
    
    
    public function __construct(){
        
        
    }
    
    public function __destruct(){
        
        
    }
    
    public function fetch_data(){
        
       $conn = new Connection();
       $con = $conn->getConnection();
       $room = new Room($con, null, null, null);
       $data = $room->fetchAll();
       return $data;
    }
    
    public function fetch_data_one($id){
        
       $conn = new Connection();
       $con = $conn->getConnection();
       $room = new Room($con, null, null, null);
       $data = $room->fetchOne($id);
       return $data;
    }
    
    public function insert_room(){
        
        $validator = new FormHandler();
        $conn = new Connection();
        $con = $conn->getConnection();
        $today = date(DATE_RFC2822);
        $date = date('Y-m-d');
        
        $room_number = "N/A";
        $room_floor = "N/A";
        $room_type = "N/A";
        $room_price = "N/A";
        $start_date = "N/A";
        $end_date = "N/A";
        $no_of_beds = "N/A";
        $no_of_rooms = "N/A";
        $room_image = "../images/room.jpg";
        $vat = 0;
        $deposit = 0;
        
        if(isset($_POST['room_number'])){
            $room_number = $_POST['room_number'];
        }
        
        if(isset($_POST['room_floor'])){
            $room_floor = $_POST['room_floor'];
        }

        if(isset($_POST['room_type'])){
            $room_type = $_POST['room_type'];
        }
        
        if(isset($_POST['room_price'])){
            $room_price = $_POST['room_price'];
        }
        
        if(isset($_POST['start_date'])){
            $start_date = $_POST['start_date'];
        }
        
        if(isset($_POST['end_date'])){
            $end_date = $_POST['end_date'];
        }
        
        if(isset($_POST['no_of_beds'])){
            $no_of_beds = $_POST['no_of_beds'];
        }
        
        if(isset($_POST['no_of_rooms'])){
            $no_of_rooms = $_POST['no_of_rooms'];
        }
        
        if(isset($_POST['vat'])){
            $vat = $_POST['vat'];
        }
        
         if(isset($_POST['deposit'])){
            $deposit = $_POST['deposit'];
        }
        
         if(isset($_POST['room_image'])){
            $room_image = $_POST['room_image'];
        }
        
         
        
        $room = new Room($con, null, null, null);
        $room->setRoomNumber($validator->prepare_input($room_number));
        $room->setRoomFloor($validator->prepare_input($room_floor));
        $room->setRoomType($validator->prepare_input($room_type));
        $room->setRoomPrice($validator->prepare_input($room_price));
        $room->setStartDate($validator->prepare_input($start_date));
        $room->setStartDay($validator->prepare_input($start_date));
        $room->setEndDate($validator->prepare_input($end_date));
        $room->setEndDay($validator->prepare_input($end_date));
        $room->setNoBeds($validator->prepare_input($no_of_beds));
        $room->setNoRooms($validator->prepare_input($no_of_rooms));
        $room->setRoomImage($room_image);
        $room->setVat($validator->validate_number($vat));
        $room->setDeposit($validator->validate_number($deposit));
        $room->setRoomStatus("Free");
        $room->add();
    
        $response = '<div class="alert alert-success" style="margin:30px 0;">Action completed succesfully</div>';    
    }
    
    public function update_room(){
        
        $validator = new FormHandler();
        $conn = new Connection();
        $con = $conn->getConnection();
        $today = date(DATE_RFC2822);
         $date = date('Y-m-d');
        
        $id = "";
        $room_number = "N/A";
        $room_floor = "N/A";
        $room_type = "N/A";
        $room_price = "N/A";
        $start_date = "N/A";
        $end_date = "N/A";
        $no_of_beds = "N/A";
        $no_of_rooms = "N/A";
        $room_image = "../images/room.jpg";
        $vat = 0;
        $deposit = 0;
        $selection = '0';
        
         if(isset($_POST['id'])){
            $id = $_POST['id'];
        }
        
        if(isset($_POST['room_number'])){
            $room_number = $_POST['room_number'];
        }
        
        if(isset($_POST['room_floor'])){
            $room_floor = $_POST['room_floor'];
        }

        if(isset($_POST['room_type'])){
            $room_type = $_POST['room_type'];
        }
        
        if(isset($_POST['room_price'])){
            $room_price = $_POST['room_price'];
        }
        
        if(isset($_POST['start_date'])){
            $start_date = $_POST['start_date'];
        }
        
        if(isset($_POST['end_date'])){
            $end_date = $_POST['end_date'];
        }
        
        if(isset($_POST['no_of_beds'])){
            $no_of_beds = $_POST['no_of_beds'];
        }
        
        if(isset($_POST['no_of_rooms'])){
            $no_of_rooms = $_POST['no_of_rooms'];
        }
        
        if(isset($_POST['vat'])){
            $vat = $_POST['vat'];
        }
        
         if(isset($_POST['deposit'])){
            $deposit = $_POST['deposit'];
        }
        
         if(isset($_POST['room_image'])){
            $room_image = $_POST['room_image'];
        }
        
        if(isset($_POST['selection'])){
            $selection = $_POST['selection'];
        }
        
         
        
        $room = new Room($con, null, null, null);
        $room->setRoomNumber($validator->prepare_input($room_number));
        $room->setRoomFloor($validator->prepare_input($room_floor));
        $room->setRoomType($validator->prepare_input($room_type));
        $room->setRoomPrice($validator->prepare_input($room_price));
        $room->setStartDate($validator->prepare_input($start_date));
        $room->setStartDay($validator->prepare_input($start_date));
        $room->setEndDate($validator->prepare_input($end_date));
        $room->setEndDay($validator->prepare_input($end_date));
        $room->setNoBeds($validator->prepare_input($no_of_beds));
        $room->setNoRooms($validator->prepare_input($no_of_rooms));
        $room->setRoomImage($room_image);
        $room->setVat($validator->validate_number($vat));
        $room->setDeposit($deposit);
        
        if($selection == '0'){
            $error = "Please select one of the three options";
        }else if($selection == '1'){
            $room->update($id);
        }else if($selection == '2'){
            $room->update_b($room->getRoomType());
        }else if($selection == '3'){
            $room->update_c();
        }else{
            $error = "Something went wrong! Please try again";
        }
        
        $this->insert_visited();
        
        $response = 'Action completed succesfully';    
        
        header("location: ../admin/rooms.php?message=" . $response);
    }
    
    public function insert_visited(){
        
$config = parse_ini_file("../../config.ini", true);
 
$servername = $config['Database']['server'];
$database = $config['Database']['database_name'];
$username = $config['Database']['username'];
$password = $config['Database']['password'];

try {
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$query_b = "INSERT INTO stats SET visited='yes'";
$stmt = $conn->prepare($query_b);
$stmt->execute();
$conn = null;
}
catch(\PDOException $e){
echo $e->getMessage();
}
}
    
public function check_visited(){
        
$config = parse_ini_file("../../config.ini", true);
 
$servername = $config['Database']['server'];
$database = $config['Database']['database_name'];
$username = $config['Database']['username'];
$password = $config['Database']['password'];

try {
$conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
$query = "SELECT * FROM stats";
$stmt = $conn->prepare($query);
$stmt->execute();
return $stmt;
$conn = null;
}
catch(\PDOException $e){
echo $e->getMessage();
}
}
    
    public function delete_room($id){
        
        $conn = new Connection();
        $con = $conn->getConnection();
        $room = new Room($con, null, null, null);
        $room->delete($id);
    }
    
    
    public function handle_request_step_1(){
        session_start();
       $one_bed = $_POST['one_beds'];
       $two_beds = $_POST['two_beds'];
       $three_beds = $_POST['three_beds'];
       $four_beds = $_POST['four_beds'];
       $studio = $_POST['studio'];
        $validator = new FormHandler();
        $conn = new Connection();
        $con = $conn->getConnection();
        $today = date(DATE_RFC2822);
        $date = date('Y-m-d');
        $one_bed = (int)$one_bed;
        $two_beds = (int)$two_beds;
        $three_beds = (int)$three_beds;
        $four_beds = (int)$four_beds;
        $studio = (int)$studio;
    
        if($one_bed > 0){
            for($i = 0; $i < $one_bed; $i++){
                
                $room = new Room($con, $one_bed, null, null);
                $room->setRoomType("One Bed");
                $room->setRoomStatus("Free");
                $room->add_first_step($room->getRoomType(), $date, "../images/room.jpg", $room->getRoomStatus());
            }
        }
        
         if($two_beds > 0){
            for($i = 0; $i < $two_beds; $i++){
                
                $room = new Room($con, $two_beds, null, null);
                $room->setRoomType("Two Beds");
                $room->setRoomStatus("Free");
                $room->add_first_step($room->getRoomType(), $date, "../images/room.jpg", $room->getRoomStatus());
            }
        }
        
        if($three_beds > 0){
            for($i = 0; $i < $three_beds; $i++){
                
                $room = new Room($con, $three_beds, null, null);
                $room->setRoomType("Three Beds");
                $room->setRoomStatus("Free");
                $room->add_first_step($room->getRoomType(), $date, "../images/room.jpg", $room->getRoomStatus());
            }
        }
        
        if($four_beds > 0){
            for($i = 0; $i < $four_beds; $i++){
                
                $room = new Room($con, $four_beds, null, null);
                $room->setRoomType("Four Beds");
                $room->setRoomStatus("Free");
                $room->add_first_step($room->getRoomType(), $date, "../images/room.jpg", $room->getRoomStatus());
            }
        }
        
        if($studio > 0){
            for($i = 0; $i < $studio; $i++){
                
                $room = new Room($con, $studio, null, null);
                $room->setRoomType("Studio");
                $room->setRoomStatus("Free");
                $room->add_first_step($room->getRoomType(), $date, "../images/room.jpg", $room->getRoomStatus());
            }
        }
        
$theme = new Theme($con, "summer");
$theme->theme = "summer";
$theme->add_theme();
  
        header("location: ../admin/configuration-step-2.php");
        
    }
    
    public function handle_request_step_2(){
        
        $validator = new FormHandler();
        $conn = new Connection();
        $con = $conn->getConnection();
        $today = date(DATE_RFC2822);
         $date = date('Y-m-d');
        
        $room_id = "N/A";
        $room_floor = "N/A";
        $room_number = "N/A";
        $room_type = "N/A";
        
        if(isset($_POST['room_id'])){
            $room_id = $_POST['room_id'];
        }
        
        if(isset($_POST['room_floor'])){
            $room_floor = $_POST['room_floor'];
        }

        if(isset($_POST['room_number'])){
            $room_number = $_POST['room_number'];
        }
        
        if(isset($_POST['room_type'])){
            $room_type = $_POST['room_type'];
        }
        
        $room = new Room($con, null, null, null);
        $room->id = $validator->prepare_input($room_id);
        $room->setRoomFloor($validator->prepare_input($room_floor));
        $room->setRoomNumber($validator->prepare_input($room_number));
        $room->setRoomType($validator->prepare_input($room_type));
        $room->update_second_step($room->getRoomNumber(), $room->getRoomFloor(), $room->id);

    }
    
public function update_theme(){

$theme_selected = null;
$conn = new Connection();
$con = $conn->getConnection();

if(isset($_POST['theme'])){
$theme_selected = $_POST['theme'];
}

if($theme_selected != null){
$theme = new Theme($con, $theme_selected);
$theme->theme = $theme_selected;
$theme->update_theme();
 $response = 'Action was completed succesfully';
header("location: ../admin/rooms.php?message=" . $response);
}

}
    
    
}


if(isset($_POST['submit'])){
$action = '0';
$handler = new HandleConfiguration();
if(isset($_POST['action'])){
    $action = $_POST['action'];    
}
if($action == '1'){
$handler->handle_request_step_1();
}else if($action == '2'){
$handler->handle_request_step_2();
}else if($action == '3'){
$handler->insert_room();
}else if($action == '4'){
$handler->update_room();
}else if($action == '5'){
$handler->update_theme();
}else{
try{
throw new ErrorException;
}catch(ErrorException $e){
    echo $e->get_message();
}
}
}

?>