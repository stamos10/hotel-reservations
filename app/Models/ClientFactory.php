<?php

namespace App\Models;

use \App\Models\Connection;

class ClientFactory {
    
    public static function create(){
        
        $conn = new Connection();
        $con = $conn->getConnection();
        return new Client($con);
    }
}


?>