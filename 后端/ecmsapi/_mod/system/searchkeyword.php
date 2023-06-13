<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;



// 专题列表
$list = $api->load('db')->select('[!db.pre!]enewssearch' , '*' , '1' , '100,1' , 'searchid desc');

foreach($list as $i=>$v){
    // 将时间戳转成 2020-12-11 17:15:10 格式
    $list[$i]['searchtime'] = date('Y-m-d' , $v['searchtime']);
}

// 构造输出结构
$result = [
    'code' => 1,
    'list' => $list
];

// 输出json数据
$api->json($result);