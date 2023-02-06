<?php

require 'curl.php';
$subdomain = 'alexefilatov2012'; //Поддомен аккаунта
$tokens = json_decode(file_get_contents('tokens.txt'), 1);
$access_token = $tokens['access_token'];

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


$method = "/api/v4/leads/complex";

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
];

curl($subdomain, $data, $headers, $method, 'POST');

//$curl = curl_init();
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
//curl_setopt($curl, CURLOPT_URL, "https://$subdomain.amocrm.ru".$method);
//curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
//curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
//curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
//curl_setopt($curl, CURLOPT_HEADER, false);
////curl_setopt($curl, CURLOPT_COOKIEFILE, 'amo/cookie.txt');
////curl_setopt($curl, CURLOPT_COOKIEJAR, 'amo/cookie.txt');
//curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
//$out = curl_exec($curl);
//print_r($out);
//$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
//$code = (int) $code;
//$errors = [
//    301 => 'Moved permanently.',
//    400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
//    401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
//    403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
//    404 => 'Not found.',
//    500 => 'Internal server error.',
//    502 => 'Bad gateway.',
//    503 => 'Service unavailable.'
//];
//
//if ($code < 200 || $code > 204) die( "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error') );
//

//http_redirect('https://alexefilatov2012.amocrm.ru/leads');