<?php

use RahulGodiyal\PhpUpsApiWrapper\Tracking;

require_once('./vendor/autoload.php');

$client_id = "xxxxxxxxxxxxxxxx"; // UPS Client ID
$client_secret = "xxxxxxxxxxxxxxx"; // UPS Client Secret

$trackingRes = Tracking::setTrackingNumber("123456789")->fetch($client_id, $client_secret); // For Dev Api
$trackingRes = Tracking::setTrackingNumber("123456789")->setMode('PROD')->fetch($client_id, $client_secret); // For PROD Api

echo '<pre>'; print_r($trackingRes); echo '</pre>'; die();