<?php

require_once 'integration_key.php';
require_once 'curl.php';
//

//echo "refresh.php" . PHP_EOL;

//echo $token_file;
//$link = '/oauth2/access_token'; // URL  запроса

$subdomain = 'alexefilatov2012'; //Поддомен аккаунта
$dataToken = file_get_contents($token_file);
$dataToken = json_decode($dataToken, true);
//print_r($dataToken);
//echo "\n";
//echo time() ;


//print_r($refresh_token);

//обновление с поощью refresh токена access токена за 2 минуты до его  истечения
if ($dataToken["endTokenTime"] - 120  < time()) {

    $refresh_token = $dataToken['refresh_token'];
    $access_token = $dataToken['access_token'];

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];

    echo "If-branch";
    $link = '/oauth2/access_token';

    $data = [
        'client_secret' => $client_secret,
        'client_id' => $client_id,
        'grant_type' => 'refresh_token',
        'refresh_token' => $refresh_token,
        'redirect_uri'  => 'http://alexefml.beget.tech/authorization.php',
    ];

//    print_r($data);
    $out = curl($subdomain, $data, $headers, $link, 'POST');
echo "обновление токена<br>";
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
    fclose($fl);
} else {
    $access_token = $dataToken['access_token'];
//    echo "else-branch" . PHP_EOL;
    echo "Токен не нужно обновлять<br>";

}
//echo 'end refresh.php file';