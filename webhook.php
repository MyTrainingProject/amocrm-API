<?php
require_once'curl.php';
require_once 'refresh.php';
require_once 'notes.php';
require_once 'tasks.php';
//tag "id":83291,"name":"Создана вручную"
//  "id":81749,"name":"сайт

//работа с вебхуком
//запись овтета запроса в файл webhook.txt


if ($_SERVER['REQUEST_METHOD'] === 'POST' and $_POST['leads']['add'][0]['tags'][0]['id'] != 18775) {
//   #Тег - "Создана вручную"
//    post_notes($id, "Какой-то текст");
    $id = (int)$_POST['leads']['add'][0]['id'];

    add_task($id);
    add_notes($id, "Создана вручную");

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
//else if ($_POST['leads']['add'][0]['tags'][0]['id'] == 18775) {
//    $id = (int)['leads']['add'][0]['id'];
//    post_notes($id, "Какой-то текст");
//
//
//}

echo "<br>";

