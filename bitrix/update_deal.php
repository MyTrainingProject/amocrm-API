<?php
require_once '../bitrix/curl.php';

function update_deal($id)
{
    $url = 'https://b24-rxbifg.bitrix24.ru/rest/1/dslpwry9l03z7sgv/crm.deal.update.json';

    $data = http_build_query([
        'id' => $id,
        'fields' => [
                'SOURCE_ID' => 'UC_3T2RFW', //установка в поле источник значения "Создана вручную"
        ],
        'params' => ['REGISTER_SONET_EVENT' => "Y"]
]);

    curl($url, $data);
}
