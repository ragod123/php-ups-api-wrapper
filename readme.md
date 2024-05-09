
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
Create Shipment | Shipping Label
```php
<?php

use RahulGodiyal\PhpUpsApiWrapper\Entity\Address;
use RahulGodiyal\PhpUpsApiWrapper\Entity\BillShipper;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Dimensions;
use RahulGodiyal\PhpUpsApiWrapper\Entity\LabelImageFormat;
use RahulGodiyal\PhpUpsApiWrapper\Entity\LabelSpecification;
use RahulGodiyal\PhpUpsApiWrapper\Entity\LabelStockSize;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Package;
use RahulGodiyal\PhpUpsApiWrapper\Entity\PackageWeight;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Packaging;
use RahulGodiyal\PhpUpsApiWrapper\Entity\PaymentInformation;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Phone;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Request;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Service;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ShipFrom;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Shipment;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ShipmentCharge;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ShipmentRequest;
use RahulGodiyal\PhpUpsApiWrapper\Entity\Shipper;
use RahulGodiyal\PhpUpsApiWrapper\Entity\ShipTo;
use RahulGodiyal\PhpUpsApiWrapper\Entity\UnitOfMeasurement;
use RahulGodiyal\PhpUpsApiWrapper\Ship;

require_once('./vendor/autoload.php');

$client_id = "************************"; // UPS Client ID
$client_secret = "*****************************"; // UPS Client Secret

/********* Shipper **********/
$address = new Address();
$address->setAddressLines([
    "address line 1", // address line 1
    "address line 2" // address line 2 optional
]);
$address->setCity("Timonium");
$address->setStateProvinceCode("MD");
$address->setPostalCode("21093");
$address->setCountryCode("US");

$phone = new Phone();
$phone->setNumber("1115554758");
$phone->setExtension(""); // optional

$shipper = new Shipper();
$shipper->setName("Shipper Test");
$shipper->setAttentionName(""); // optional
$shipper->setTaxIdentificationNumber(""); // optional
$shipper->setPhone($phone);
$shipper->setShippingNumber("123456");
$shipper->setFaxNumber(""); // optional
$shipper->setAddress($address);
/********* End Shipper **********/

/************ ShipTo **********/
$address = new Address();
$address->setAddressLines(["address line 1"]);
$address->setCity("Timonium");
$address->setStateProvinceCode("MD");
$address->setPostalCode("21093");
$address->setCountryCode("US");

$phone = new Phone();
$phone->setNumber("1115554758");

$shipTo = new ShipTo();
$shipTo->setName("Shipper Test");
$shipTo->setAttentionName(""); // optional
$shipTo->setPhone($phone);
$shipTo->setAddress($address);
$shipTo->setResidential(""); // optional
/************ End ShipTo **********/

/************ ShipFrom **********/
$address = new Address();
$address->setAddressLines(["address line 1"]);
$address->setCity("Timonium");
$address->setStateProvinceCode("MD");
$address->setPostalCode("21093");
$address->setCountryCode("US");

$phone = new Phone();
$phone->setNumber("1115554758");

$shipFrom = new ShipFrom();
$shipFrom->setName("Shipper Test");
$shipFrom->setAttentionName(""); // optional
$shipFrom->setPhone($phone);
$shipFrom->setFaxNumber(""); // optional
$shipFrom->setAddress($address);
/************ End ShipFrom **********/

/************ PaymentInformation **********/
$billShipper = new BillShipper();
$billShipper->setAccountNumber("123456");

$shipmentCharge = new ShipmentCharge();
$shipmentCharge->setBillShipper($billShipper);

$paymentInformation = new PaymentInformation();
$paymentInformation->setShipmentCharge($shipmentCharge);
/************ End PaymentInformation **********/

/************ Service **********/
$service = new Service();
$service->setCode(Service::GROUND);
$service->setDescription("Ground"); // optional
/************ End Service **********/

/************ Package **********/
$packaging = new Packaging();
$packaging->setCode(Packaging::CUSTOMER_SUPPLIED_PACKAGE);
$packaging->setDescription("Ups Letter"); // optional

// Dimensions can be optional
$unitOfMeasurement = new UnitOfMeasurement(); 
$unitOfMeasurement->setCode(UnitOfMeasurement::INCHES);
$unitOfMeasurement->setDescription("Inches"); // optional

$dimensions = new Dimensions();
$dimensions->setUnitOfMeasurement($unitOfMeasurement);
$dimensions->setLength("10");
$dimensions->setWidth("30");
$dimensions->setHeight("45");
// End Dimensions

// Package Weight can be optional
$unitOfMeasurement = new UnitOfMeasurement();
$unitOfMeasurement->setCode(UnitOfMeasurement::POUNDS);
$unitOfMeasurement->setDescription("POUNDS"); // optional

$packageWeight = new PackageWeight();
$packageWeight->setUnitOfMeasurement($unitOfMeasurement);
$packageWeight->setWeight("5");
// End Package Weight

$package = new Package();
$package->setDescription(""); // optional
$package->setPackaging($packaging);
$package->setDimensions($dimensions); // optional
$package->setPackageWeight($packageWeight); // optional
/************ End Package **********/

/************ Shipment **********/
$shipment = new Shipment();
$shipment->setDescription("Ship WS test");
$shipment->setShipper($shipper);
$shipment->setShipTo($shipTo);
$shipment->setShipFrom($shipFrom);
$shipment->setPaymentInformation($paymentInformation);
$shipment->setService($service);
$shipment->setPackage($package);
/************ End Shipment **********/

/************ Label Specification **********/
$labelImageFormat = new LabelImageFormat();
$labelImageFormat->setCode(LabelImageFormat::GIF);
$labelImageFormat->setDescription("GIF"); // optional

$labelStockSize = new LabelStockSize();
$labelStockSize->setHeight(LabelStockSize::H_8);
$labelStockSize->setWidth(LabelStockSize::W_4);

$labelSpecification = new LabelSpecification();
$labelSpecification->setLabelImageFormat($labelImageFormat);
$labelSpecification->setLabelStockSize($labelStockSize);
$labelSpecification->setHttpUserAgent("Mozilla/4.5"); // optional
/************ End Label Specification **********/

/************ Shipment Request **********/
$shipmentRequest = new ShipmentRequest();
$shipmentRequest->setRequest(new Request);
$shipmentRequest->setShipment($shipment);
$shipmentRequest->setLabelSpecification($labelSpecification);
/************ End Shipment Request **********/

/************ Create Ship **********/
$ship = new Ship();
$ship->setShipmentRequest($shipmentRequest);
$ship->setOnlyLabel(true); // optional
// $ship->setMode('PROD'); // Optional | only used for prod
$shipRes = $ship->createShipment($client_id, $client_secret);
/************ End Create Ship **********/

echo '<pre>'; print_r($shipRes); echo '</pre>';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shipping Label</title>
</head>
<body>
    <img src="data:image/png;base64,<?= $shipRes['data']->GraphicImage ?>" alt="Shipping Label">

</body>
</html>

```

