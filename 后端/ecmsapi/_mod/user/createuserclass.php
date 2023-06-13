<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}


$data['classname'] = $api->post('classname');


$api->load('db')->insert('[!db.pre!]enewsuserclass' , $data);

// 构造输出结构
$result = [
    'code' => 1,
];

// 输出json数据
$api->json($result);

