<?php

$config = parse_ini_file("../../../config.ini", true);
 
$servername = $config['Database']['server'];
$database = $config['Database']['database_name'];
$username = $config['Database']['username'];
$password = $config['Database']['password'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE TABLE IF NOT EXISTS " . $database . ".stats (
    id INT AUTO_INCREMENT PRIMARY KEY,
    visited VARCHAR(20) NULL
    )";

    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
    $conn = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

usleep(300);

try {
     $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE TABLE IF NOT EXISTS " . $database . ".themes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    theme VARCHAR(20) NULL,
    created DATE NULL
    )";

    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
    $conn = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

usleep(300);


try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE TABLE IF NOT EXISTS " . $database . ".rooms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    start_date VARCHAR(80) NULL,
    end_date VARCHAR(80) NULL,
    start_day INT NULL,
    end_day  INT NULL,
    room_number VARCHAR(50) NULL,
    room_floor VARCHAR(50) NULL,
    room_type VARCHAR(50) NULL,
    room_price FLOAT NULL,
    room_image VARCHAR(255) NULL,
    beds INT NULL,
    rooms INT NULL,
    vat INT NULL,
    deposit FLOAT NULL,
    status VARCHAR(50) NULL,
    created DATE NULL
    )";

    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
    $conn = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

usleep(300);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE TABLE IF NOT EXISTS " . $database . ".clients (
    firstname VARCHAR(80) NULL,
    surname VARCHAR(80) NULL,
    email VARCHAR(150) NOT NULL PRIMARY KEY,
    username  VARCHAR(100) NOT NULL,
    phone VARCHAR(50) NOT NULL,
    keep_data BOOLEAN NULL,
    room_id INT NOT NULL,
    room_number VARCHAR(80) NOT NULL,
    created DATE NULL,
    FOREIGN KEY fk_rooom(room_id)
    REFERENCES " . $database . ".rooms(id)
    )";

    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
    $conn = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

usleep(300);

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "CREATE TABLE IF NOT EXISTS " . $database . ".reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    start_date VARCHAR(80) NULL,
    end_date VARCHAR(80) NULL,
    start_day INT NULL,
    end_day  INT NULL,
    payment_id VARCHAR(200) NULL,
    room_id INT NOT NULL,
    room_type VARCHAR(100) NULL,
    room_number VARCHAR(100) NULL,
    room_price FLOAT NULL,
    room_deposit FLOAT NULL,
    client_email VARCHAR(150) NOT NULL,
    client_surname VARCHAR(100) NULL,
    created DATE NULL,
    FOREIGN KEY fk_room(room_id)
    REFERENCES " . $database . ".rooms(id),
    FOREIGN KEY fk_email(client_email)
    REFERENCES " . $database . ".clients(email)
    )";

    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
    $conn = null;
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }

usleep(300);

?>