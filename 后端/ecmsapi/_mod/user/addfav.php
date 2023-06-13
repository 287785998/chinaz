<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}


//$raw_post_data = file_get_contents('php://input');
//$arr = json_decode($raw_post_data,true);


// 获取用户名并用RepPostVar函数过滤
$data['id'] = $api->post('id' , '' , 'RepPostVar');
$data['cid'] = $api->post('cid' , 0 , 'RepPostVar');
$data['classid'] = $api->post('classid' , '' , 'RepPostVar');
$data['username'] = $api->post('username' , '' , 'RepPostVar');
$data['userid'] = $api->post('userid' , '' , 'RepPostVar');
$data['favatime'] = $api->post('favatime');
// $data['favatime'] = date('Y-m-d h:i:s', time());


$api->load('db')->insert('[!db.pre!]enewsfava' , $data);

// 构造输出结构
$result = [
    'code' => 1,
];

// 输出json数据
$api->json($result);

