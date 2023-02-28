<?php
require_once '../bitrix/curl.php';

$data = json_decode(file_get_contents('webhook.txt'), 1);
print_r($data);

$id = $data['data']['FIELDS']['ID']; // получение id из свежесозданной сделки
print_r($id);

$url = 'https://b24-rxbifg.bitrix24.ru/rest/1/5anlxpknwfvdaf8h/crm.activity.add.json';
//$time = time() + 3600;
$date = date('d.m.Y / H + 1:i:s');

$data = http_build_query([
    'fields' => [
        "OWNER_TYPE_ID" => 2, //из метода crm.enum.ownertype: 2 - тип "сделка"
        "OWNER_ID" => $id, //id сделки
        "TYPE_ID" => 2, //из метода crm.enum.activitytype
        "END_TIME" => $date,
        "SUBJECT" => "Перезвонить",
        "DESCRIPTION" => "Перезвонить",
        "COMMUNICATIONS" => [
            [
                'VALUE' => '8888'
            ]

        ],
    ],
    'params' => ['REGISTER_SONET_EVENT' => "Y"]
]);

print_r(curl($url, $data));
