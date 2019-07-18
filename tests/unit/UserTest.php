<?php

use \App\Models\Connection;
use App\Models\User;

class UserTest extends \PHPUnit\Framework\TestCase{
    
public function test_username(){
    
$conn = new Connection();
$user = new User($conn);
$user->setUsername(" stamos10@otenet.gr ");
$this->assertEquals($user->getUsername(), "stamos10@otenet.gr");
}

public function test_password_length(){

$conn = new Connection();
$user = new User($conn);
$user->setPass("12345678"); 
$this->assertGreaterThan(7,strlen($user->getPass()));    
}

public function test_password_null_if_smaller_than_required(){

$conn = new Connection();
$user = new User($conn);
$user->setPass("123458");
$this->assertEquals($user->getPass(), null);     
}
    
}

?>