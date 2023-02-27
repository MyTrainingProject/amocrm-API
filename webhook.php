<?php
require_once'curl.php';
require_once 'refresh.php';
require_once 'notes.php';
require_once 'tasks.php';
//tag "id":83291,"name":"Создана вручную"
//  "id":81749,"name":"сайт

//работа с вебхуком
//запись овтета запроса в файл webhook.txt




if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        //получение данных введенных в форму
        $data = json_decode(file_get_contents('form_vars.txt'), 1);
        $phone = (int)$data['phone'];
        $comment = $data['comment'];
        $name = $data['name'];
        $id = (int)$_POST['leads']['add'][0]['id'];



        if ($_POST['leads']['add'][0]['tags'][0]['id'] == 18775) {
            //   #Тег - "сайт"

            add_task($id); //добавление задачи
            $time = date('d.m.Y / H:i:s');
            if (file_get_contents('flag.txt') == 'true') {
                //добавление заметки
                add_notes($id, "Заявка с сайта $time\n Имя: $name\n Телефон: $phone\n Комментарий: $comment");
            }
        }

        if ($_POST['leads']['add'][0]['tags'][0]['id'] != 18775) {
            //   #Тег - "Создана вручную"

            $post_array = $_POST['leads']['add'][0];
            $data = [
                [
                    'id' => (int)$post_array['id'],

                    'custom_fields_values' => [
                        [
                            "field_id" => 543591,
                            "values" => [
                                [
                                    "value" => 'Создана вручную'
                                ]
                            ]

                        ]
                    ],

                    "_embedded" => [
                        'tags' => [
                            'values' => [
                                "id" => 18787,
                                "name" => 'Создана вручную',
                            ],
                        ]
                    ]
                ]
            ];


            $method = "/api/v4/leads";
            $subdomain = 'alexefilatov2012gmailcom';
            $tokens = json_decode(file_get_contents('tokens.txt'), 1);
            $access_token = $tokens['access_token'];
            $headers = [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $access_token,
            ];

            curl($subdomain, $data, $headers, $method, 'PATCH');


            $fh = fopen("webhook.txt", 'w') or die("Сбой открытия");
            $data = json_encode($_POST);
            fwrite($fh, $data . PHP_EOL);
            fclose($fh);

        }

}


echo "<br>";

