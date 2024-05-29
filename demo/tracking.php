<?php

use RahulGodiyal\PhpUpsApiWrapper\Entity\TrackingQuery;
use RahulGodiyal\PhpUpsApiWrapper\Tracking;

require_once('./vendor/autoload.php');

$client_id = "******************************"; // UPS Client ID
$client_secret = "*****************************************"; // UPS Client Secret

/********* Tracking Query *********/
$query = new TrackingQuery(); // optional
$query->setLocale("en_US"); // optional
$query->setReturnSignature("false"); //optional
$query->setReturnMilestones("false"); //optional
$query->setReturnPOD("false"); //optional
/********* End Tracking Query *********/

$tracking = new Tracking();
$trackingRes = $tracking
    ->setQuery($query) // optional
    // ->setMode('PROD') // optional
    ->setTrackingNumber("123456789")->fetch($client_id, $client_secret);

echo '<pre>'; print_r($trackingRes); echo '</pre>'; die();
