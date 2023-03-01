<?php

require_once '../bitrix/curl.php';
require_once '../bitrix/update_deal.php';
require_once '../bitrix/activity.php.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //запись  ответа от вебхука в отдельный фафл 'webhook.txt'
    $post_array = $_POST;
    $fp = fopen('webhook.txt', 'w');
    $data = json_encode($post_array);
    fwrite($fp, $data);
    fclose($fp);

    $url = 'https://b24-rxbifg.bitrix24.ru/rest/1/7dr0o7l2pvnw7l31/crm.deal.get.json';
    //вытягиваем id из свежесозданной сделки
    $webhook_array = json_decode(file_get_contents('webhook.txt'), 1);
    $id = $webhook_array['data']['FIELDS']['ID'];
    echo "$id.<br>";

    $data = http_build_query([
        'id' => $id,
    ]);
    //получение данных сделки
    $out = curl($url, $data);
    print_r($out);

    echo "<br><br>";
    //преобрвазоние json в массив
    $out_array = json_decode($out, 1);
    print_r($out_array);

    echo "<br><br>";

    if ($out_array['result']['SOURCE_ID'] == null) { //добавление в поле источник "Создана вручную"

        print_r("True");
        update_deal($id);



    }

    else {
        create_activity($id);
    } print_r($out_array['result']['SOURCE_ID']);

}
