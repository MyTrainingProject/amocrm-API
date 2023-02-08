<?php

require 'integration_key.php';
//require 'refresh.php';


$tokens = json_decode(file_get_contents('tokens.txt'), 1);
print_r($tokens);
$access_token = $tokens['access_token'];

//https://alexefilatov2012.amocrm.ru/api/v4/contacts/custom_fields
//https://alexefilatov2012.amocrm.ru/api/v4/contacts

$method = "/api/v4/contacts";

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
];

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
//curl_setopt($curl, CURLOPT_URL, "https://alexefilatov2012.amocrm.ru/api/v4/contacts");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($curl, CURLOPT_HEADER, false);
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$out = curl_exec($curl);
$response = json_decode($out, true);
print_r($response);


