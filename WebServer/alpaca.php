<?php
//dev env
header('Access-Control-Allow-Origin: *');
error_reporting(E_ERROR | E_WARNING | E_PARSE);

include('Response.php');

$data = array(
    "nodes" => array(
        array(
            "id" => "1",  //唯一数字
            "label" => "managerA",    //节点下方显示的文本信息
            "title" => "message1: **<br>message2: **",     //详细信息列表，HTML格式，
            "group" => "manager",   //节点分组信息
            "value" => "30"         //节点大小，最小为20(seller)，每级向上递增5
        ),
        array(
            "id" => "2",
            "label" => "sellerA",
            "title" => "message1: **<br>message2: **",
            "group" => "seller",
            "value" => "20"
        ),
        array(
            "id" => "3",
            "label" => "sellerB",
            "title" => "message1: **<br>message2: **",
            "group" => "seller",
            "value" => "20"
        ),
        array(
            "id" => "4",
            "label" => "sellerC",
            "title" => "message1: **<br>message2: **",
            "group" => "seller",
            "value" => "20"
        ),
        array(
            "id" => "5",
            "label" => "sellerD",
            "title" => "message1: **<br>message2: **",
            "group" => "seller",
            "value" => "20"
        ),
        array(
            "id" => "6",
            "label" => "sellerE",
            "title" => "message1: **<br>message2: **",
            "group" => "seller",
            "value" => "20"
        )
    ),
    "edges" => array(
        array(
            "from" => "1",  
            "to" => "2",
            "label" => "manage" // 关系名称
        ),
        array(
            "from" => "1",
            "to" => "3"
        ),
        array(
            "from" => "1",
            "to" => "4"
        ),
        array(
            "from" => "1",
            "to" => "5"
        ),
        array(
            "from" => "1",
            "to" => "6"
        )
    ),
    "datas" => array(
        
    )
);
Response::show(200, 'success', $data);