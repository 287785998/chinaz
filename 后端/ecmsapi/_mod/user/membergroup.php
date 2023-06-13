<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;  

$list = $api->load('db')->select('[!db.pre!]enewsmembergroup' , '*' , '1' , '10,1' , 'groupid desc');

// 构造输出结构
$result = [
    'code' => 1,
    'list' => $list
];

// 输出json数据
$api->json($result);