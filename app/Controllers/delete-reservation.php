<?php
require "../admin/inc/check_user.php";
require "HandleReservations.php";

use \App\Controllers\HandleReservations;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

if(isset($_GET['room'])){
    $room = $_GET['room'];
}

$handler = new HandleReservations();
$handler->delete_reservation($id);
$handler->free_room($room);
$response = 'Action completed succesfully';    
        
header("location: ../admin/view-reservations.php?message=" . $response);
?>