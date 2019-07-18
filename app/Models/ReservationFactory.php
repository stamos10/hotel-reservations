<?php

namespace App\Models;

use \App\Models\Connection;

class ReservationFactory {
    
    public static function create(){
        
        $conn = new Connection();
        $con = $conn->getConnection();
        return new Reservation($con);
    }
}


?>