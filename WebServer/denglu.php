<?php

//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$db = Db::getInstance();
$dbc = $db -> connect();




// var_dump($stme);



$username = $_GET['username'];

$query = "SELECT * FROM `user` WHERE `username` = '{$username}'";

$stme = $dbc->query($query);

$result = $stme->fetch();



Response::show(200, 'success', $result);
// Response::show(200, 'success', $result, 'xml');