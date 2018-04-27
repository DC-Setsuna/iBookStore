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
	$result = $stme->fetch();
	// var_dump($ishave);
	// var_dump((bool)$stme);
	// print_r($stme);
	if ($result) {
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
			// echo "string";
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
	// print_r($result);
	foreach ($result as $key => $value) {
		// print_r($value);
		$book_id = $value['book_id'];
		$query_select = "SELECT * FROM `book` WHERE `id` = '{$book_id}'";
		$book_detail = $dbc->query($query_select)->fetch();
		$result[$key]['book_detail'] = $book_detail;
	}
	Response::show(200, 'see success', $result);
}

//Response code 200 success
//Response code 201 error <error message>


