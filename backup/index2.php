<?

//require '../contacts.php';

$array = [1, 2, 3, 4, 5,];
$array = ['88005553535'];
$result = (int)in_array('88005553535', $array, 1);
echo "hello" ;
echo $result;

get_phones();
echo (string)in_array($phone, get_phones());