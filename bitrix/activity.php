<?php
require_once '../bitrix/curl.php';


function create_activity($id)
{
    $url = 'https://b24-rxbifg.bitrix24.ru/rest/1/5anlxpknwfvdaf8h/crm.activity.add.json';
    //$time = time() + 3600;
    $start_date = date();
    $date = strtotime("+1 hour");

    $data = http_build_query([
        'fields' => [
            "OWNER_TYPE_ID" => 2, //из метода crm.enum.ownertype: 2 - тип "сделка"
            "OWNER_ID" => $id, //id сделки
            "TYPE_ID" => 2, //из метода crm.enum.activitytype
            "START_DATE" => $start_date,

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

   curl($url, $data);

}
