<?php
require "../admin/inc/check_user.php";
require "HandleReservations.php";

use \App\Controllers\HandleReservations;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$handler = new HandleReservations();
$handler->free_room($id); 
$response = 'Room is Available for booking';    
        
header("location: ../admin/view-reservations.php?message=" . $response);
?>