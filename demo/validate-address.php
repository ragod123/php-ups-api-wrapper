<?php

use RahulGodiyal\PhpUpsApiWrapper\Entity\ValidateAddressQuery;
use RahulGodiyal\PhpUpsApiWrapper\ValidateAddress;

require_once('./vendor/autoload.php');

$client_id = "******************************"; // UPS Client ID
$client_secret = "*****************************************"; // UPS Client Secret


/********* Query *********/
$query = new ValidateAddressQuery(); // optional
$query->setRegionalRequestIndicator("False"); // optional
$query->setMaximumCandidateListSize("1"); //optional
/********* End Query *********/

/******** Set Address ********/
$validateAddress = new ValidateAddress();
$validateAddress->setQuery($query); // optional
$validateAddress->setAddressLines([
    "8001 S Orange Blossom Trl", // address line 1
    "SPACE K113iokio" // address line 2
]);
$validateAddress->setPoliticalDivision2("Orlando"); // City
$validateAddress->setPoliticalDivision1("FL"); // State Code
$validateAddress->setPostcodePrimaryLow("32809"); // Postal Code
$validateAddress->setCountryCode("US");
/******** End Set Address ********/

$validateAddress->setMode('PROD'); // optional

echo '<pre>';
print_r($validateAddress->validate($client_id, $client_secret));
echo '</pre>';
die();
