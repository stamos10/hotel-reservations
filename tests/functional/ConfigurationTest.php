<?php

use \App\Models\Connection;
use \App\Models\Room;
use \App\Models\Client;
use \App\Models\Reservation;
use \App\Models\ReservationFactory;
use \App\Models\ClientFactory;

class Configuration extends \PHPUnit\Framework\TestCase{
   
private $http_request;

protected function setUp(){
 
$this->http_request = new GuzzleHttp\Client(['base_uri' => 'http://localhost/nodelook/app/admin/']); 
}


    
public function test_configuration_GET(){
    

$response = $this->http_request->request('GET', 'configuration.php');
$response_code = $response->getStatusCode();
$this->assertEquals($response_code, 200);
}

public function test_form_passes_post_data_to_reception(){

$this->http_request = new GuzzleHttp\Client(['base_uri' => 'http://localhost/nodelook/app/Controllers/']);
$params = array(["action" => "1",
                 "id" => "1"]);
 
$response = $this->http_request->request('POST', 'HandleConfiguration.php', 
                                        ['query' => $params, 'debug' => false]);
$body = $response->getBody();
$this->assertEquals($response->getStatusCode(), 200);

$data = json_decode($response->getBody(), true);
    
}

public function test_get_data__passed_to_reception(){

$this->http_request = new GuzzleHttp\Client(['base_uri' => 'http://localhost/nodelook/app/Controllers/']);
$query = array(["action" => "1",
                 "name=" => "Stamos"]);

$response = $this->http_request->request('GET', 'HandleConfiguration.php', 
                                          ['query' => $query, 'debug' => false]);

$data = json_decode($response->getBody());

$this->assertEquals($response->getStatusCode(), 200);
    
}






}

?>