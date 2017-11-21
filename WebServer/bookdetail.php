<?php
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$bookid = $_GET['bookid'];
$db = Db::getInstance();
$dbc = $db->connect();

$query = <<<EOF
SELECT * FROM `book`
WHERE `id` = '{$bookid}'
EOF;

$stme = $dbc->query($query);

if ($stme) {
	$result = $stme->fetch();
	Response::show(200, 'success', $result);
} else {
	Response::show(201, 'query error');
}