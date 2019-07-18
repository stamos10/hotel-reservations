<?php

require "config.php";

try {
    
    $query = "CREATE TABLE IF NOT EXISTS " . $database . ".users_storage (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    secret_t VARCHAR(255) NOT NULL
    )";

    
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $stmt->closeCursor();
    
    }
catch(PDOException $e)
    {
    echo $e->getMessage();
    }


?>