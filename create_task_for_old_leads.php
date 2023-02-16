<?php
//require_once 'refresh.php';
//require_once 'integration_key.php';
require_once 'curl.php';
require_once 'tasks.php';

$subdomain = 'alexefilatov2012gmailcom'; //Поддомен аккаунта
$tokens = json_decode(file_get_contents('tokens.txt'), 1);

$access_token = $tokens['access_token'];

$method = "/api/v4/leads";

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
];

$out = curl($subdomain, null, $headers, $method, 'GET');
$response = json_decode($out, true);

$leads_array = $response['_embedded']['leads'];

foreach($leads_array as $value) {

    if ($value['closest_task_at'] == null) {
        $id = (int)$value['id'];
        add_task($id);
    }
}

