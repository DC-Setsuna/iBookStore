<?php 
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);
include('Db.php');
include('Response.php');

$db = Db::getInstance();
$dbc = $db->connect();

$request = $_GET['cls'];

if (!$request) {
	exit;
}

if ($request == 'all') {
	$query = <<<EOF
	SELECT `id`,`book_title`,`book_price`,`book_rate`,`img_url`
	FROM `book`
	ORDER BY `book_rate` DESC
	LIMIT 12
EOF;

} elseif ($request == 'editor') {
	# code...
	echo 'editor';
} else {
	$query = <<<EOF
	SELECT `id`,`book_title`,`book_price`,`book_rate`,`img_url`
	FROM `book` 
	WHERE `book_class` IS '{$request}' 
	ORDER BY `book_rate` DESC
	LIMIT 12;
EOF;
}

$stme = $dbc->query($query);
$result = $stme->fetchAll(PDO::FETCH_ASSOC);

Response::show(200, 'success', $result, 'json');