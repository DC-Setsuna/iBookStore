<?php 
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$db = Db::getInstance();
$dbc = $db->connect();

// $username = $_COOKIE['username'];
$username = $_GET['username'];
$action = $_GET['action'];

if ($action == 'add') {
	$book_id = $_GET['book_id'];
	$count = $_GET['count'];
	$query_check = <<<EOF
	SELECT * FROM `car`
	WHERE `username` = '{$username}'
	AND `book_id` = '{$book_id}';
EOF;
	$stme = $dbc->query($query_check);
	if ($stme) {
		$result = $stme->fetch();
		$nowcount = (int)$result['count'];
		$nowcount = $nowcount + $count;
		
		$query_update = <<<EOF
		UPDATE `car`
		SET `count` = '{$nowcount}'
		WHERE `username` = '{$username}'
		AND `book_id` = '{$book_id}';
EOF;

		$isSuccess = $dbc->exec($query_update);
		if ($isSuccess) {
			Response::show(200, 'add success');
		} else {
			Response::show(201, 'add error');
		}
	} else {
		$query_add = <<<EOF
			INSERT INTO `car`(`username`,`book_id`,`count`)
			VALUES('{$username}','{$book_id}','{$count}');
EOF;
			$isSuccess = $dbc->exec($query_add);
			if ($isSuccess) {
				Response::show(200, 'add success');
			} else {
				Response::show(201, 'add error');
			}
	}
}

if ($action == 'delete') {
	$id = $_GET['id']; //car id
	$query_delete = "DELETE FROM `car` WHERE `id` = '{$id}';";
	$isSuccess = $dbc->exec($query_delete);
	if ($isSuccess) {
		Response::show(200, 'delete success');
	} else {
		Response::show(201, 'delete error');
	}
}

if ($action == 'see') {
	$query_see = <<<EOF
	SELECT * FROM `car`
	WHERE `username` = '{$username}';
EOF;
	$stme = $dbc->query($query_see);
	$result = $stme->fetchAll(PDO::FETCH_ASSOC);
	Response::show(200, 'see success', $result);
}

//Response code 200 success
//Response code 201 error <error message>


