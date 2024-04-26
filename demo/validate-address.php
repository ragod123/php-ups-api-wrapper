<?php

use RahulGodiyal\PhpUpsApiWrapper\AddressValidation;

require_once('./vendor/autoload.php');

$client_id = "xxxxxxxxxxxxxx";
$client_secret = "xxxxxxxxxxxxxxxx";

$address = [
    "AddressLine" => [
        "785 GODDARD CT"
    ],
    "PoliticalDivision2" => "ALPHARATTA",
    "PoliticalDivision1" => "CA",
    "PostcodePrimaryLow" => "30005",
    "CountryCode" => "US"
];

echo '<pre>';
print_r(AddressValidation::setAddress($address)->validate($client_id, $client_secret));
echo '</pre>';
die();
