<?php


//$name = $_POST['name'];
//$phone = $_POST['phone'];
//$comment = $_POST['comment'];

//$date = date('d.m.Y / H:i:s');

$post_array = [
    "fields" => [
        'TITLE' => "Новый контакт",

        'PHONE' =>
            [
                [
                    'VALUE' => '88005553535',
                    'VALUE_TYPE' => 'WORK',
                ],
            ],

    ],

    'params' => ['REGISTER_SONET_EVENT' => "Y"]
];

$fh = fopen('variables.txt', 'w');

$data = json_encode($post_array['fields']);
fwrite($fh, $data);
fclose($fh);

$key = 'https://b24-rxbifg.bitrix24.ru/rest/1/f6fp6b3wemvkzcf4/';
$url = "$key./crm.lead.add.contact.add";

$curl = curl_init();
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
$out = curl_exec($curl);
print_r($out);
$code = curl_getinfo($curl, CURLINFO_HTTP_CODE);

print_r(json_decode(file_get_contents('variables.txt'), 1));

