<?php

require 'integration_key.php';
require 'curl.php';
require 'refresh.php';

$subdomain = 'alexefilatov2012'; //Поддомен аккаунта
$tokens = json_decode(file_get_contents($token_file), 1);

$access_token = $tokens['access_token'];
print_r($access_token);

$method = "/api/v4/leads/complex";

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
];

$name = $_POST['name'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];

$company = 'Название компании';

$date = date('d.m.Y / H:i:s');


$data =  [
    [
        'name' => "Заявка с сайта $date",
        'status_id '=> 54683314, // id колонки
        'pipeline_id' => 6384766, //  id воронки
        'price' => 10000,
        'responsible_user_id '=> 9174234,
        'custom_fields_values' => [
            [
                "field_id" => 1861851,
                "values" => [
                    [
                        "value" => $comment
                    ]
                ]
            ],
            [
                "field_id" => 1863831,
                "values" => [
                    [
                        "value" => 'Сайт'
                    ]
                ]

        ]
        ],

        "_embedded" => [
            'tags' => [
                'values' => [
                    "name" => "сайт",
                ]
            ],

            "contacts" => [
                [
                    "first_name" => $name,

                    "custom_fields_values" => [
                        [
                            "field_code" => "PHONE",
                            "values" => [
                                [
                                    "value" => $phone
                                ]
                            ]
                        ],
                    ]
                ]
            ],
        ]
    ]



];


curl($subdomain, $data, $headers, $method, 'POST');

