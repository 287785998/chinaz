<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}


// 获取用户名并用RepPostVar函数过滤
$data['userid'] = $api->post('userid' , '' , 'RepPostVar');
$data['classid'] = $api->post('classid' , '' , 'RepPostVar');
$data['username'] = $api->post('username' , '' , 'RepPostVar');
$data['cardfen'] = $api->post('cardfen' , '' , 'RepPostVar');
$data['title'] = $api->post('title');
$data['truetime'] = time();


// 更新用户副表
$api->load('db')->insert('[!db.pre!]enewsdownrecord' , $data);

// 构造输出结构
$result = [
    'code' => 1,
    'list' => $data
];

// 输出json数据
$api->json($result);

