<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//    print_r($_POST);
    $post_array = $_POST;
    $fp = fopen('webhook.txt', 'w');
    $data = json_encode($post_array);
    fwrite($fp, $data);
    fclose($fp);
}
