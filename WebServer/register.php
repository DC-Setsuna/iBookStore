<?php
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$USERNAME = $_GET['username'];
$PASSWORD = $_GET['password'];


$db = Db::getInstance();
$dbc = $db->connect();

$query_username = <<<EOF
	SELECT COUNT(*)
	FROM `user`
	WHERE `username` = '{$USERNAME}'
EOF;

$stme = $dbc->query($query_username);
$existence = $stme->fetch();
$existence = (int)$existence[0];
if ($existence) {
	Response::show(201, 'Username is existence');
}

$query_adduser = <<<EOF
	INSERT INTO `user`(`username`,`password`)
	VALUES('{$USERNAME}','{$PASSWORD}');
EOF;

$isSuccess = $dbc->exec($query_adduser);
if ($isSuccess) {
	$query_id = <<<EOF
		SELECT `id` FROM `user`
		WHERE `username` = '{$USERNAME}';
EOF;
	$userId = $dbc->query($query_id);
	$userId = $userId->fetch(PDO::FETCH_ASSOC);
	Response::show(200, 'Success', $userId);
} else {
	Response::show(202, 'Insert Error');
}