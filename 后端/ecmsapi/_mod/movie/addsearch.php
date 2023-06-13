<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}


$raw_post_data = file_get_contents('php://input');
$arr = json_decode($raw_post_data,true);


// $raw_post_data = file_get_contents('php://input');
// $arr = json_decode($raw_post_data,true);

// // 获取并用RepPostVar函数过滤
// $data['tbname'] = $arr['tbname'];
// $data['classid'] = $arr['classid'];
// $data['keyboard'] = $arr['keyboard'];
// $data['searchclass'] = $arr['searchclass'];
// $data['searchtime'] = time();
// $keyboard = $arr['keyboard'];




// 获取用户名并用RepPostVar函数过滤
$data['tbname'] = $api->post('tbname' , 'movie');
$data['classid'] = $api->post('classid');
$data['keyboard'] = $api->post('keyboard');
$data['searchclass'] = $api->post('searchclass' , 'title');
// $data['andsql'] = $api->post('andsql');
$data['searchtime'] = time();


$api->load('db')->insert('[!db.pre!]enewssearch' , $data); 

// 构造输出结构
$result = [
    'code' => 1,
    'list' => $data
];

// 输出json数据
$api->json($result);

