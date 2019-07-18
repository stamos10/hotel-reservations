<?php

use \App\Models\Connection;
use \App\Models\Room;
use \App\Models\Comforts;

class RoomTest extends \PHPUnit\Framework\TestCase{
    
public function test_room_number(){
    
$conn = new Connection();
$room = new Room($conn, null, null, null);
$room->setRoomNumber('  501 ');
$this->assertEquals($room->getRoomNumber(), '501'); 
}



}
?>