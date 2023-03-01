<?php

require_once '../bitrix/curl.php';

function get_contact($id)
{
    $url = 'https://b24-rxbifg.bitrix24.ru/rest/1/wecya41f4w92cmdu/crm.contact.get.json';

    $data = http_build_query([
        'id' => $id,
    ]);

    $out = curl($url, $data);
//    print_r($out);
    $out_array = json_decode($out, 1);
    print_r($out_array['PHONE']);
}

get_contact(1);