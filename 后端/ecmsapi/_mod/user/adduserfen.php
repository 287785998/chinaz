<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

$data['userfen'] = $api->post('userfen' , '' , 'RepPostVar');
$data['userid'] = $api->post('userid' , '' , 'RepPostVar');

// $data = array(
//     'userfen' => $userfen
// );


// 更新用户副表
$updata = $api->load('db')->update('[!db.pre!]enewsmember' , ['userfen' => ['userfen + '.$data['userfen']]] , 'userid='.$data['userid']);  


// 构造输出结构
$result = [
    'code' => 1,
    'list' => $data
];

// 输出json数据
$api->json($result);

