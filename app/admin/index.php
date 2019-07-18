<?php

require "../Controllers/RouteGenerator.php";

use App\Controllers\RouteGenerator;


header("location: " . RouteGenerator::set_admin_redirect("dashboard.php"));    

?>