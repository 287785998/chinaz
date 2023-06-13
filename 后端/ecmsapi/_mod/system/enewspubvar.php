<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;

// 获取参数 自动获取GET或POST参数
$id = $api->param('id' , 0 , 'intval');  // 模板变量ID


$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')


// 模板变量内容
$data = $api->load('db')->one('[!db.pre!]enewspubvar' , '*' , 'varid='.$id);

// 构造输出结构
$result = [
    'code' => 1,
    'data' => $data
];

// 输出json数据
$api->json($result);