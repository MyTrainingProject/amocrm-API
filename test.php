<?php
require_once'curl.php';
require_once 'refresh.php';
require_once 'notes.php';
require_once 'tasks.php';

$id = 1182479;
//$id = (int)$id;
add_notes($id, 'Text');
add_task($id);


