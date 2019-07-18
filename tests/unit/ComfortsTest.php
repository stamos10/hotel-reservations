<?php

use \App\Models\Comforts;

class ComfortsTest extends \PHPUnit\Framework\TestCase{
    
public function test_comforts_array(){
    
$comforts = new Comforts();
$comforts->addComfort(' TV ');
$comforts->addComfort(' WI-FI');
$comforts->addComfort(' WI-FI');

$this->assertEquals($comforts->getComforts()[0], 'TV');
$this->assertEquals($comforts->getComforts()[1], 'WI-FI');
$this->assertEquals(sizeof($comforts->getComforts()), 2);
}
}
?>