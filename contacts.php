<?php

require 'integration_key.php';
require 'curl.php';
require 'refresh.php'; //обновление Access токена

echo "contacts.php<br>" ;
    function get_phones()
    {

        $tokens = json_decode(file_get_contents('tokens.txt'), 1);
        //print_r($tokens);
        $access_token = $tokens['access_token'];
        //echo $access_token;
        $subdomain = 'alexefilatov2012';
        //https://alexefilatov2012.amocrm.ru/api/v4/contacts/custom_fields
        //https://alexefilatov2012.amocrm.ru/api/v4/contacts

        $method = "/api/v4/contacts";

        $headers = [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $access_token,
        ];


        $out = curl($subdomain, null, $headers, $method, 'GET');

        //print_r($out);

        $response = json_decode($out, true);
        //print_r($response);
        //[0]['custom_fields_values'];

        $contacts_array = $response['_embedded']['contacts'];
        $contacts_value = $response['_embedded']['contacts'][0]['custom_fields_values'][0]['values'][0]['value'];

        $phone_array = [];

        foreach ($contacts_array as $key => $value) {
            //    echo "$key  => $value  PHP_EOL";
            $phone_array[] = (string)$value['custom_fields_values'][0]['values'][0]['value'] . PHP_EOL;
        }

        print_r($phone_array);
        return $phone_array;
    }

//print_r((int)in_array(88005553535, get_phones()));