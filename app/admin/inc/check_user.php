<?php

require "../Models/Observer.php";
use App\Models\Observer;

$username = null;
session_start();
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
}

Observer::evaluate_user($username);

?>