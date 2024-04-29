
# RahulGodiyal\PhpUpsApiWrapper

Latest OAuth 2.0 Rest API Wrapper for UPS web services.




## Installation

Install with composer

```bash
  composer require rahul-godiyal/php-ups-api-wrapper
```
    
## Usage/Examples

UPS Address Validation
```php
<?php

use RahulGodiyal\PhpUpsApiWrapper\AddressValidation;

require_once('./vendor/autoload.php');

$client_id = "xxxxxxxxxxxxxxxx"; // UPS Client ID
$client_secret = "xxxxxxxxxxxxxxx"; // UPS Client Secret

// Address to be validated
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
print_r(AddressValidation::setAddress($address)->validate($client_id, $client_secret)); // For Dev Api
print_r(AddressValidation::setAddress($address)->setMode('PROD')->validate($client_id, $client_secret)); // For Prod Api
echo '</pre>';
die();

```

