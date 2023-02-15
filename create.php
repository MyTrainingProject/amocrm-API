<?php

require 'integration_key.php';
//require 'curl.php';
require_once 'form_variables.php';
require_once 'contacts.php';

//print(get_phones());

$subdomain = 'alexefilatov2012gmailcom'; //Поддомен аккаунта
$tokens = json_decode(file_get_contents($token_file), 1);

$access_token = $tokens['access_token'];
//print_r($access_token);

$method = "/api/v4/leads/complex";

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $access_token,
];


$date = date('d.m.Y / H:i:s');

$data = json_decode(file_get_contents('form_vars.txt'), 1);
$phone = (int)$data['phone'];
$comment = $data['comment'];
$name = $data['name'];



if (in_array($phone, get_phones() )) {
//    set_flag();
    echo "<br>Телефон уже существует<br>";
//    print_r(get_phones());

    $fh = fopen('flag.txt', 'w');
    $fh = fwrite();
    fclose();

    $data =  [
        [
            'name' => "Заявка с сайта $date",
            'status_id '=> 55168394, // id колонки
            'pipeline_id' => 6461886, //  id воронки
            'price' => 10000,
            'responsible_user_id '=> 9254118,
            'custom_fields_values' => [
                [
                    "field_id" => 543493,
                    "values" => [
                        [
                            "value" => $comment
                        ]
                    ]
                ],
                [
                    "field_id" => 543591,
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

            ]
        ]
        ];
}
else {
    echo "<br>Телефон будет создан вместе с контактом<br>";
//    print_r(get_phones());

    $data =  [
        [
            'name' => "Заявка с сайта $date",
            'status_id '=> 55168394, // id колонки
            'pipeline_id' => 6461886, //  id воронки
            'price' => 10000,
            'responsible_user_id '=> 9254118,
            'custom_fields_values' => [
                [
                    "field_id" => 543493,
                    "values" => [
                        [
                            "value" => $comment
                        ]
                    ]
                ],
                [
                    "field_id" => 543591,
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

}

//
//$out = curl($subdomain, $data, $headers, $method, 'POST');
//print_r($out);


$out = curl($subdomain, $data, $headers, $method, 'POST');
print_r($out);