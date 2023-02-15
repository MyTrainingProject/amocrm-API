<?php



$form_vars = [
    'name' =>  $_POST['name'],
    'phone' => $_POST['phone'],
    'comment' => $_POST['comment']
];

$fh = fopen("form_vars.txt", 'w') or die("Сбой открытия");
$data = json_encode($form_vars);
fwrite($fh, $data);
fclose($fh);