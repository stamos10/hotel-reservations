<?php

$config = parse_ini_file("../../../config.ini", true);
 
$servername = $config['Database']['server'];
$database = $config['Database']['database_name'];
$username = $config['Database']['username'];
$password = $config['Database']['password'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    }
catch(PDOException $e)
    {
 echo "Error: " . $e->getMessage();
    }


?>
