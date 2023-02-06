<?php

require 'curl.php';

$subdomain = 'alexefilatov2012'; //Поддомен аккаунта
$link = '/oauth2/access_token'; // URL  запроса

$header = ['Content-Type:application/json'];

$data = [
    'client_secret' => 'o9Nss16E41TwGmRVwKaKF8W2QOaGJzdUabWagLm0kQRGKayqKDK36PHBYB8prNNQ',
    'client_id' => '9da06962-f3bc-4bb1-838e-fcd043914bf6',
    'grant_type' => 'authorization_code',
    'code' => 'def502008a4b3fbe03e065cc55db852a4c7ecff180c216647d9e3e6e09cb2848d96e6fb9ad9dcac6cfc97284705bac5083b749627a0c81516de02d32da81e209e5f7b09785f891a1250bb5d50995770fdc20fe1f80311d05c8c125e7aca2f40525a54e5356903b590adc7d9bb809a19c8160cf3ca0429c4fc3057acfab2eb2f771a9704bd0550f38e937e325406ae149935f8badad4e1cbb55cab300a48f17a7aca30e475387a00bd569f52237dda31f7e42ec9a4cdbf5a3075fcccfe5cf98f1fcc36ede67c82cd47152345635bfb62066e42bd680912c2d69c299706b31f3470d538c629a3b829ce92e0b25cdeebd028cb6c2cc6777578e25b60a94390e97a81ba8d042bec8f09f44e4e1a33c3535aedc29dcf8bac9b317f41079a069e30da17c0c06fce3f75581948baf8fe2849b3ad2a0c07023e8ebfe5431f71e53dde8b6fbbd79667e7bb161bb7665e35884b2beb34a14513ba4f3e74d12f6de961dda4edb808328d1c8390ba2406d0419f3be1d09bc4f32be0f77be72f34ce6c54d543675eb1197d21f12fd0de6eebdd3c102bfcfe211dcf89d8457f29025a2ed289ecc83c8b70c516a077c1e8e93ff26e1d5bbe3baadfc213c9730861a0c17d8cf3c1bbb128e70f430ffaf83370ea089f059c22134f54904eecfa08eb7cff61049c96f94307fa579d2a918a5958eb5cf22',
    'redirect_uri' => 'http://alexefml.beget.tech/authorization.php',
];

$token_file = 'tokens.txt';


$out = curl($subdomain, $data, $header, $link, 'POST');

$response = json_decode($out, true);
print_r($response);

//формирвоание массива для последующйе записи в файл с токенами tokenx.txt
$arrParamsAmo = [
    "access_token"  => $response['access_token'],
    "refresh_token" => $response['refresh_token'],
    "token_type"    => $response['token_type'],
    "expires_in"    => $response['expires_in'],
    "endTokenTime"  => $response['expires_in'] + time(),
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