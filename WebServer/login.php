<?php

//dev env
header('Access-Control-Allow-Origin: *');

include('Db.php');
include('Response.php');

const USERNAME = $_POST['username'];
const PASSWORD = $_POST['password'];
$remember = $_POST['remember'];  # remember code

if (!(USERNAME && PASSWORD)) {
	exit('empty data');
	# JS Lint
}

$db = Db::getInstance();
$dbc = $db->connect();

$query = <<<EOF
	SELECT `username`,`password`
	FROM `user`
	WHERE `username` IS '{USERNAME}';
EOF;

$stme = $dbc->query($query);
# $stme PDO Statment

if ($stme) {
	$result = $stme->fetch();
	$psd = $result['password'];
	if ($psd == PASSWORD) {
		# success...
		setcookie('username', USERNAME, time()+(60*60*24));
		setcookie('password', PASSWORD, time()+600);
		setcookie('islogin', 'true', time()+(60*60*24));

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

