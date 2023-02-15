<?php

require_once 'curl.php';
//GET - /api/v4/tasks
//POST POST /api/v4/tasks

function add_task($id)
{
    $subdomain = 'alexefilatov2012gmailcom';
    $method = '/api/v4/tasks';

    $tokens = json_decode(file_get_contents('tokens.txt'), 1);
    $access_token = $tokens['access_token'];

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];
    $time = time() + 3600;


    $data = [
        [
            "task_type_id" => 2803346,
            "text" => "Перезвонить",
            "entity_id" => $id,
            "entity_type" => "leads",
            "complete_till" => $time
        ]

    ];

    $out = curl($subdomain, $data, $headers, $method, 'POST');

    print_r($out);


}



