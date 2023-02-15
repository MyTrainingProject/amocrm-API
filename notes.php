<?php

require_once 'curl.php';
//GET - https://alexefilatov2012.amocrm.ru//api/v4/leads/6446979/notes
//POST /api/v4/{entity_type}/{entity_id}/notes
function add_notes($id, $text) {

    $subdomain = 'alexefilatov2012gmailcom';
    $method = '/api/v4/leads/notes';

    $tokens = json_decode(file_get_contents('tokens.txt'), 1);
    $access_token = $tokens['access_token'];

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];

    $data = [
        [
            "entity_id" => $id,
            "note_type" => "common",
            "params" => [
                "text" => $text,
            ]
        ]
    ];

    $out = curl($subdomain, $data, $headers, $method, 'POST');
//$out = curl($subdomain, $data, $headers, $method, 'GET');

    print_r($out);
}

//post_notes(1069085, "текст");

