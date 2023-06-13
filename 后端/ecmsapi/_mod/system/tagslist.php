<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;


// 专题列表
$list = $api->load('db')->select('[!db.pre!]enewstags' , '*' , '1' , '100,1' , 'tagid desc');

// 构造输出结构
$result = [
    'code' => 1,
    'list' => $list
];

// 输出json数据
$api->json($result);