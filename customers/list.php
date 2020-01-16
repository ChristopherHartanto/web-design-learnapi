<?php
header('Content-Type: application/json');

include dirname(dirname(__FILE__)).'/db/Db.class.php';

$db = new Db();

$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
$name = isset($_GET['name']) ? $_GET['name'] : '';

$sql_limit = '';
if (!empty($limit)) {
    $sql_limit = ' LIMIT 0,'.$limit;
}
$sql_name = '';
if (!empty($name)) {
    $sql_name = ' where name LIKE \'%'.$name.'%\' ';
}

$cust_list = $db->query('select * from customers '.$sql_name.' '.$sql_limit);

$arr = array();
$arr['info'] = 'success';
$arr['num'] = count($cust_list);
$arr['result'] = $cust_list;

echo json_encode($arr);