<?


$date = date('d.m.Y / H:i:s', $data);

$date = strtotime("+1 hour");
echo date('d.m.Y / H:i:s', $date);

