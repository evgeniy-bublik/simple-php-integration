<?php
include('../Payone.php');

require_once 'config.php';

$personalData = array(
    "salutation" => "Herr",
    "title" => "Dr.",
    "firstname" => "Paul",
    "lastname" => "Neverpayer",
    "street" => "Fraunhoferstraße 2-4",
    "addressaddition" => "EG",
    "zip" => "24118",
    "city" => "Kiel",
    "country" => "DE",
    "email" => "paul.neverpayer@payone.de",
    "telephonenumber" => "043125968500",
    "birthday" => "19700204",
    "language" => "de",
    "gender" => "m",
    "ip" => "8.8.8.8"
);

$parameters = array(
    "request" => "authorization",
    "clearingtype" => "sb",             // sb for Online Bank Transfer
    "onlinebanktransfertype" => "BCT",  // BCT for Bancontact
    "bankcountry" => "BE",		// Bancontact is a Belgian payment method
    //"bankaccount" => "12345678",
    //"bankcode" => "88888888",
    //"iban" => "DE85123456782599100003",  // We don't need this for bancontact
    //"bic" => "TESTTEST",
    "amount" => "100000",
    'currency' => 'EUR',
    "reference" => uniqid(),
    "narrative_text" => "Just an order",
    "successurl" => "https://yourshop.de/payment/success?reference=your_unique_reference",
    "errorurl" => "https://yourshop.de/payment/error?reference=your_unique_reference",
    "backurl" => "https://yourshop.de/payment/back?reference=your_unique_reference",
);

$request = array_merge($defaults, $parameters, $personalData);
ksort($request);
print_r($request);
/**
 * This should return something like:
 * Array
 * (
 *   [status] => REDIRECT
 *   [redirecturl] => https://trusted.girogate.de/ti/dumbdummy?tx=XXXXXXXXX&rs=XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXcc85f42
 *   [txid] => 211111111
 *   [userid] => 9000000
 * )
 * please note that the redirecturl is likely to change in live mode.
 */
$response = Payone::sendRequest($request);
print_r($response);


