<?php
require "../admin/inc/check_user.php";
require "HandleConfiguration.php";

use \App\Controllers\HandleConfiguration;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}

$handler = new HandleConfiguration();
$handler->delete_room($id); 
$response = 'Action completed succesfully';    
        
header("location: ../admin/rooms.php?message=" . $response);
?>