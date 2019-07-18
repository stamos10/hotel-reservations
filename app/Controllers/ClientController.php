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
require "../Models/User.php";

require "../../vendor/braintree/braintree_php/lib/Braintree.php";
require "../../vendor/braintree/braintree_php/lib/Braintree/CredentialsParser.php";
require "../../vendor/braintree/braintree_php/lib/Braintree/Configuration.php";
require "../../vendor/braintree/braintree_php/lib/Braintree/ClientToken.php";
use \Braintree;
use \Braintree\Configuration;
use \Braintree\Transaction;
use \Braintree\generate;
use \Braintree\sale;
use \Braintree\Test;
use \Braintree\ClientToken;


use App\Exceptions\ErrorException;
use App\Models\Connection;
use App\Controllers\Handler;
use App\Models\FormHandler;
use App\Models\Observer;
use App\Models\Room;
use App\Models\Client;
use App\Models\User;
use App\Models\Reservation;
use App\Models\ClientFactory;
use App\Models\ReservationFactory;

class ClientController extends Handler{
    

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
         array_push($data['data'], "");
        }
        }else{
         array_push($data['num'], 0);
         array_push($data['data'], "");
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

public function check_availability_winter(){
 
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

$config = parse_ini_file("../../config.ini", true);
 
$prop_a = $config['Payment']['environment'];
$prop_b = $config['Payment']['merchand'];
$prop_c = $config['Payment']['public'];
$prop_d = $config['Payment']['private'];

$status = "occupied";
$amount = 0;

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
$keep_data = "yes";
$validator = new FormHandler();

$conn = new Connection();
$con = $conn->getConnection();
$user = new User($con);

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

if(isset($_POST['amount'])){
$amount = $_POST['amount']; 
}

$verification = $_POST['payment_method_nonce'];

if($amount > 0){
        
\Braintree_Configuration::environment($prop_a);
\Braintree_Configuration::merchantId($prop_b);
\Braintree_Configuration::publicKey($prop_c);
\Braintree_Configuration::privateKey($prop_d);

 try{
        
        $result = \Braintree_Transaction::sale([
        'amount' => $amount,
        'paymentMethodNonce' => $verification,
	'customer' => [
        'firstName' => $firstname,
	'lastName' => $surname,
        
         ],
        'options' => [
        'submitForSettlement' => True
         ]
        ]);
        
 }catch(Exception $e){
 echo $e->getMessage();
 }

$payment_status = $result->success;
$payment_id = "Credit Card";

if(!$result->success){
 foreach($result->errors->deepAll() as $error) {
        $errorString .= $error->code . "-" . $error->message . "\n";
    }
header("location: ../client/welcome.php?error=" . $errorString);
exit();
}
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
$room->update_status($rm->id, $status);

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

$this->send_email($email, $payment_id, $start_date, $end_date, $deposit);

$response = 'Thank you very much for your Reservation';
header("location: ../client/welcome.php?message=" . $response);
}

}

public function make_reservation_winter(){

$config = parse_ini_file("../../config.ini", true);
 
$prop_a = $config['Payment']['environment'];
$prop_b = $config['Payment']['merchand'];
$prop_c = $config['Payment']['public'];
$prop_d = $config['Payment']['private'];

$status = "occupied";
$amount = 0;

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
$keep_data = "yes";
$validator = new FormHandler();

$conn = new Connection();
$con = $conn->getConnection();
$user = new User($con);

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

if(isset($_POST['amount'])){
$amount = $_POST['amount']; 
}

$verification = $_POST['payment_method_nonce'];

if($amount > 0){

\Braintree_Configuration::environment($prop_a);
\Braintree_Configuration::merchantId($prop_b);
\Braintree_Configuration::publicKey($prop_c);
\Braintree_Configuration::privateKey($prop_d);

 try{
        
        $result = \Braintree_Transaction::sale([
        'amount' => $amount,
        'paymentMethodNonce' => $verification,
	'customer' => [
        'firstName' => $firstname,
	'lastName' => $surname,
        
         ],
        'options' => [
        'submitForSettlement' => True
         ]
        ]);
        
 }catch(Exception $e){
 echo $e->getMessage();
 }

$payment_status = $result->success;
$payment_id = "Credit Card";

if(!$result->success){
 foreach($result->errors->deepAll() as $error) {
        $errorString .= $error->code . "-" . $error->message . "\n";
    }
header("location: ../client/welcome-2.php?error=" . $errorString);
exit();
}
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
$room->update_status($rm->id, $status);

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

$this->send_email($email, $payment_id, $start_date, $end_date, $deposit);

$response = 'Thank you very much for your Reservation';
header("location: ../client/welcome-2.php?message=" . $response);
}

}


public function fetch_reservations(){
 
$conn = new Connection();
$con = $conn->getConnection();
$reservation = new Reservation($con);
$data = $reservation->fetchAll();
return $data;
}

private function send_email($email, $payment_id, $start_date, $end_date, $deposit){
   
$from = "";
$today = date(DATE_RFC2822);
$date = date('Y-m-d', strtotime(str_replace('-', '/', $today)));

$msg = '<html><body style="padding:0;">
 
 <div style="width:100%;margin:30px 0;">
 <h2 style="color:#101010;font-size:16px;margin:20px 0;">Reservation Information</h2>
 <p style="color:#101010;font-size:14px;">Date: ' . $date . '</p>
 </div>
 <table style="width:100%;margin:30px 0;">
 <tr style="padding:10px;">
 <td style="width:60%;">Check In Date</td><td style="width:30%;">' . $start_date . '</td>
 </tr>
 <tr style="padding:10px;">
 <td style="width:60%;">Check Out Date</td><td style="width:30%;">' . $end_date . '</td>
 </tr>
 <tr style="padding:10px;">
 <td style="width:60%;">Amount of Deposit Paid</td><td style="width:30%;">' . $deposit . '</td>
 </tr>
 </table>
 <p style="color:#101010;font-size:14px;">Thank you very much for using Nodelook</p>
 </body></html>';
 
$headerFields = array('MIME-Version: 1.0', 'Content-Type: text/html;charset=utf-8');
$from = "info@systemsignite.gr"; 
$to = $email;
$subject = "Nodelook Reservation Information";
 
$headers = "From:" . $from;
$headers2 = "To:" . $to;
$headers = 'From: '.$from."\r\n".
'Reply-To: '.$from."\r\n" .
'X-Mailer: PHP/' . phpversion();

if($from != ""){
if($from != $to){
mail($to, '=?UTF-8?B?'. base64_encode($subject).'?=', $msg, $headers .implode("\r\n", $headerFields));
mail($from, '=?UTF-8?B?' . base64_encode($subject).'?=',$msg, $headers2. implode("\r\n", $headerFields));
}
}       
}
      
}

if(isset($_POST['submit'])){
$action = '0';
$handler = new ClientController();
if(isset($_POST['action'])){
    $action = $_POST['action'];    
}
if($action == '1-summer'){
$handler->check_availability();
}else if($action == '1-winter'){
$handler->check_availability_winter();
}else if($action == '2'){

}else if($action == '3-summer'){
$handler->make_reservation();
}else if($action == '3-winter'){
$handler->make_reservation_winter();
}else{
try{
throw new ErrorException;
}catch(ErrorException $e){
    echo $e->get_message();
}
}
}



?>