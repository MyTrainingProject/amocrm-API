<?php

require_once '../bitrix/curl.php';
$name = $_POST['name'];
$phone = $_POST['phone'];
$comment = $_POST['comment'];

$date = date('d.m.Y / H:i:s');

$data = http_build_query([
  'fields' => [
      'TITLE' => "Заявка с сайта $date",
      'NAME' => $name,
      'COMMENTS' => $comment,
      'SOURCE_ID' => 'UC_RRQRAK',
//      'SOURCE_DESCRIPTION' => 'Сайт',

      'PHONE' =>
          [
              [
                  'VALUE' => $phone,
              ]
          ],
  ],
    'params' => ['REGISTER_SONET_EVENT' => "Y"]
]);

$fh = fopen('variables.txt', 'w');

fwrite($fh, $data);
fclose($fh);

$key ='https://b24-rxbifg.bitrix24.ru/rest/1/rurm2ggldnwcsxsl/';

$url = "$key./crm.lead.add.json";

curl($url, $data);

//print_r(json_decode(file_get_contents('variables.txt'), 1));

