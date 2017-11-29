<?php 
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$db = Db::getInstance();
$dbc = $db->connect();

$query = <<<EOF
SELECT * FROM `book`

LIMIT 30
EOF;

$stem = $dbc -> query($query);
$result = $stem -> fetchAll(PDO::FETCH_ASSOC);

// Response::show(200, 'success');

Response::show(200, 'success', $result);