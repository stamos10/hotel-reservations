<?php

use \App\Models\Connection;
use \App\Models\Client;
use \App\Models\Room;
use \App\Models\Reservation;
use \App\Models\ReservationFactory;
use \App\Models\ClientFactory;

class ClientTest extends \PHPUnit\Framework\TestCase{
   
public function test_that_can_set_client_email(){
 
 $client = ClientFactory::create(null, null);
 $client->setEmail('  stamos10@otenet.gr ');
 $this->assertEquals($client->getEmail(), 'stamos10@otenet.gr');
}

public function test_set_room(){
 
 $conn = new Connection();
 $con = $conn->getConnection();
 $client = ClientFactory::create();
 $room = new Room($con, null, null, null);
 $client->setRoomId(1);
 $this->assertEquals($client->getRoomId(), 1);
}

public function test_set_reservation(){
 
 $conn = new Connection();
 $con = $conn->getConnection();
 $client = ClientFactory::create();
 $room = new Room($con, null, null, null);
 $client->setRoomNumber(101);
 $this->assertEquals($client->getRoomNumber(), 101);
}
 
    
}


?>