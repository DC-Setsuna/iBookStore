<?php
//dev env
// header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$USERNAME = $_GET['username'];
$PASSWORD = $_GET['password'];
$remember = $_GET['remember'];  # remember code

if (!($USERNAME && $PASSWORD)) {
	exit('empty data');
	# JS Lint
}

$db = Db::getInstance();
$dbc = $db->connect();

$query = <<<EOF
	SELECT `username`,`password`
	FROM `user`
	WHERE `username` = '{$USERNAME}';
EOF;

$stme = $dbc->query($query);
# $stme PDO Statment

if ($stme) {
	$result = $stme->fetch();
	$psd = $result['password'];
	if ($psd == $PASSWORD) {
		# success...
		if ($remember == 'true') {
			setcookie('username', $USERNAME, time()+(60*60*24));
			setcookie('password', $PASSWORD, time()+600);
			setcookie('islogin', 'true', time()+(60*60*24));
		} else {
			setcookie('username', $USERNAME, time()+(60*60*24));
		}
		Response::show(200, 'success');
	} else {
		# wrong...
		Response::show(202, 'Password is wrong');
	}
} else {
	# inexistence...
	Response::show(203, 'Username is inexistence');
}

# code => 200  login success
# code => 201  ...
# code => 202  password is wrong
# code => 203  username is inexistence

