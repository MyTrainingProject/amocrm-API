<?php

require 'integration_key.php';
require_once 'curl.php';
require 'refresh.php'; //обновление Access токена

echo "contacts.php<br>" ;
    function get_phones()
    {

        $tokens = json_decode(file_get_contents('tokens.txt'), 1);
        $access_token = $tokens['access_token'];

        $subdomain = 'alexefilatov2012gmailcom';


        $method = "/api/v4/contacts";

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token,
        ];


        $out = curl($subdomain, null, $headers, $method, 'GET');
        $response = json_decode($out, true);

        $contacts_array = $response['_embedded']['contacts'];
        $contacts_value = $response['_embedded']['contacts'][0]['custom_fields_values'][0]['values'][0]['value'];

        $phone_array = [];

        foreach ($contacts_array as $key => $value) {
            $phone_array[] = (string)$value['custom_fields_values'][0]['values'][0]['value'] . PHP_EOL;
        }

        print_r($phone_array);
        return $phone_array;
    }

