<?php

require_once '../bitrix/curl.php';
require_once '../bitrix/deal_list.php';
require_once '../bitrix/activity.php';

$url = 'https://b24-rxbifg.bitrix24.ru/rest/1/3av20ofp5h67piw4/crm.activity.list.json';

$out = curl($url, null);
$out_array = json_decode($out, 1);
$out_array = $out_array['result'];


print_r($out_array);
$id_array = [];

$lead_array = deal_list();

//формирование списка сделок, у которых есть задачи
foreach ($out_array as $value) {
    $id_array[] = $value['OWNER_ID'] ;
}

//создание задачи для сделок, у которых нету задач
foreach($lead_array as $value) {
    if (!in_array($value, $id_array)) {
        create_activity($value);
    }
}
print_r($id_array);

