<?php 
//dev env
header('Access-Control-Allow-Origin: *');
header("Content-type: text/html; charset=utf-8");
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Db.php');
include('Response.php');

$db = Db::getInstance();
$dbc = $db -> connect();

$keyword = $_GET['keyword'];
$_class = $_GET['cls'] ? $_GET['cls'] : 'all';
// $author = $_GET['author'];

if (!$keyword) {
    exit;
}
if ($_class == 'all') {
    $query_search = <<<EOF
        SELECT * FROM `book`
        WHERE `book_title` LIKE '%{$keyword}%'
        OR `book_author` LIKE '%{$keyword}%';    
EOF;
    $stme = $dbc -> query($query_search);
    $result = $stme -> fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        // str_replace($keyword, '<span style="color:red;">'.$keyword.'</span>',$result);
        // print_r($result);
        foreach ($result as $key => $value) {
            // echo $value['book_title'];
            $result[$key]['book_title'] = str_replace($keyword, '<span style="color:red;">'.$keyword.'</span>',$value['book_title']);
            $result[$key]['book_author'] = str_replace($keyword, '<span style="color:red;">'.$keyword.'</span>',$value['book_author']);
            // print_r($result);
        }
        Response::show(200, 'search success', $result);
    } else {
        Resounse::show(201, 'result inexistent');
    }
} else {
    $query_search = <<<EOF
    SELECT * FROM `book`
    WHERE (`book_title` LIKE '%{$keyword}%'
    OR `book_author` LIKE '%{$keyword}%')
    AND `book_class` = '{$_class}';    
EOF;
    $stme = $dbc -> query($query_search);
    $result = $stme -> fetchAll(PDO::FETCH_ASSOC);
    if ($result) {
        foreach ($result as $key => $value) {
            $result[$key]['book_title'] = str_replace($keyword, '<span style="color:red;">'.$keyword.'</span>',$value['book_title']);
            $result[$key]['book_author'] = str_replace($keyword, '<span style="color:red;">'.$keyword.'</span>',$value['book_author']);
        }
        Response::show(200, 'search success', $result);
    } else {
        Resounse::show(201, 'result inexistent');
    }
}