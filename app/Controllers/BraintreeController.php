<?php

require "../../vendor/braintree/braintree_php/lib/Braintree.php";
require "../../vendor/braintree/braintree_php/lib/Braintree/CredentialsParser.php";
require "../../vendor/braintree/braintree_php/lib/Braintree/Configuration.php";
require "../../vendor/braintree/braintree_php/lib/Braintree/ClientToken.php";
require "../Models/Connection.php";
require "../Models/User.php";


$conn = new App\Models\Connection();
$con = $conn->getConnection();
$user = new App\Models\User($con);
$config = parse_ini_file("../../config.ini", true);
 
$prop_a = $config['Payment']['environment'];
$prop_b = $config['Payment']['merchand'];
$prop_c = $config['Payment']['public'];
$prop_d = $config['Payment']['private'];

\Braintree_Configuration::environment($prop_a);
\Braintree_Configuration::merchantId($prop_b);
\Braintree_Configuration::publicKey($prop_c);
\Braintree_Configuration::privateKey($prop_d);

$token = array(
                    'success' => true,
                    'token' => \Braintree_ClientToken::generate()
                );

echo json_encode($token);
?>