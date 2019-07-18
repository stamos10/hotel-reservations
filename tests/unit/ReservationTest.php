<?php

use \App\Models\Connection;
use \App\Models\Reservation;
use \App\Models\ReservationFactory;
use \App\Models\Room;
use \App\Models\Client;

class ReservationTest extends \PHPUnit\Framework\TestCase{
    
public function test_start_day(){

$reservation = ReservationFactory::create();

$reservation->setStartDay('24/02/2019');
$this->assertEquals($reservation->getStartDay(), 55);
}

public function test_end_day(){

$reservation = ReservationFactory::create();

$reservation->setEndDay('27/02/2019');
$this->assertEquals($reservation->getEndDay(), 58);
}

public function test_start_smaller_than_end(){

$reservation = ReservationFactory::create();    
$reservation->setStartDay('24/02/2019');
$reservation->setEndDay('27/02/2019');
$this->assertEquals($reservation->check_reservation_dates($reservation->getStartDay(),
                                                          $reservation->getEndDay()), true);
}
    
}

?>