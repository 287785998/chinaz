<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;



// 系统信息
// $data = $api->load('db')->select('[!db.pre!]enewspublic' , '*' , '1' , '100,1' , '');
$data = $api->load('db')->select('[!db.pre!]enewspublic' , 'newsurl,sitename,email,redodown,redoview,mhavedatedo,paymoneytofen,payminmoney,siteintro' , '1' , '100,1' , '');


// 构造输出结构
$result = [
    'code' => 1,
    'data' => $data
];

// 输出json数据
$api->json($result);