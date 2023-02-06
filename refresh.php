<?php

require_once 'integration_key.php';
require_once 'curl.php';


$subdomain = 'alexefilatov2012'; //Поддомен аккаунта
$link = '/oauth2/access_token'; // URL  запроса

print_r($data);


$dataToken = file_get_contents($token_file);
$dataToken = json_decode($dataToken, true);

//обновление с поощью refresh токена access токена за 2 минуты до его  истечения
if ($dataToken["endTokenTime"] - 120  < time()) {

    $link = "https://$subdomain.amocrm.ru/oauth2/access_token";

//    $data = [
//        'client_id' => '',
//        'client_secret' => '',
//        'grant_type' => 'refresh_token',
//        'refresh_token' => $dataToken["refresh_token"],
//        'redirect_uri' => '',
//    ];

    $data = [
        'client_secret' => $client_secret,
        'client_id' => $client_id,
        'grant_type' => 'refresh_token',
        'refresh_token' => $dataToken['refresh_token'],
        'redirect_uri' => 'http://alexefml.beget.tech/refresh.php',
    ];

    $out = curl($subdomain, $data, $link, 'POST');

    $response = json_decode($out, true);
    print_r($response);

    $arrParamsAmo = [
        "access_token" => $response['access_token'],
        "refresh_token" => $response['refresh_token'],
        "token_type" => $response['token_type'],
        "expires_in" => $response['expires_in'],
        "endTokenTime" => $response['expires_in'] + time(),
    ];

    $arrParamsAmo = json_encode($arrParamsAmo);

    $f = fopen($token_file, 'w');
    fwrite($f, $arrParamsAmo);
    fclose($f);

    $access_token = $response['access_token'];
    $fl = fopen('log.txt', 'a');
    fwrite($fl, 'Токен был обновлен в ' . date('d.m.Y / H:i:s') . PHP_EOL);
} else {
    $access_token = $dataToken["access_token"];

}
