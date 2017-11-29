<?php
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$db = Db::getInstance();
$dbc = $db -> connect();

$action = $_GET['action'];
$book_id = $_GET['book_id'];
$username = $_GET['username'];
$comment = $_GET['comment'];



if ($action == 'add') {
	$query_add = <<<EOF
	INSERT INTO `comment`(`book_id`,`username`,`comment`)
	VALUE('{$book_id}','{$username}','{$comment}');
EOF;
	
	$isSuccess = $dbc -> exec($query_add);
	if ($isSuccess) {
		Response::show(200, 'comment success');
	} else {
		Response::show(201, 'comment error');
	}
}

if ($action == 'see') {
	$query_see = <<<EOF
	SELECT * FROM `comment`
	WHERE `book_id` = '{$book_id}';
EOF;

	$stme = $dbc -> query($query_see);
	$result = $stme -> fetchAll(PDO::FETCH_ASSOC);

	Response::show(200, 'success', $result);
}