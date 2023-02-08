<?php

require 'integration_key.php';
require 'curl.php';

    //Поддомен аккаунта
    $link = '/oauth2/access_token'; // URL  запроса

    $header = ['Content-Type:application/json'];

$data = [
    'client_id'     => $client_id,
    'client_secret' => $client_secret,
    'grant_type'    => 'authorization_code',
    'code'          => $code,
    'redirect_uri'  => 'http://alexefml.beget.tech/authorization.php',
];


    $out = curl($subdomain, $data, $header, $link, 'POST');

    $response = json_decode($out, true);
    print_r($response);

//формирвоание массива для последующйе записи в файл с токенами tokenx.txt
    $arrParamsAmo = [
        "access_token" => $response['access_token'],
        "refresh_token" => $response['refresh_token'],
        "token_type" => $response['token_type'],
        "expires_in" => $response['expires_in'],
        "endTokenTime" => $response['expires_in'] + time(),
    ];
//запись в tokens.txt

    $arrParamsAmo = json_encode($arrParamsAmo);

    $f = fopen($token_file, 'w');
    fwrite($f, $arrParamsAmo);
    fclose($f);

//header('Location: index.html');

    $access_token = $response['access_token']; //Access токен
    $refresh_token = $response['refresh_token']; //Refresh токен
    $token_type = $response['token_type']; //Тип токена
    $expires_in = $response['expires_in']; //Через сколько действие токена истекает





?>