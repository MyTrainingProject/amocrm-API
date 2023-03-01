<?php


require_once '../bitrix/curl.php';


function deal_list() {
    $url = 'https://b24-rxbifg.bitrix24.ru/rest/1/h0c3qmivkt092idw/crm.deal.list.json';

    $out = curl($url, null);
    $out_array = json_decode($out, 1);
    $out_array = $out_array['result'];

    print_r($out_array);
    $id_array = [];

    foreach ($out_array as $value) {
        $id_array[] = $value['ID'];
    }
    return $id_array;
}


