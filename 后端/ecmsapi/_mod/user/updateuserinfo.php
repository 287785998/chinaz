<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

// $data = array(
//     'truename' => $truename
// );

$datas['userid'] = $api->post('userid' , '' , 'RepPostVar');
$data['truename'] = $api->post('truename' , '' , 'RepPostVar');
$data['oicq'] = $api->post('oicq' , '' , 'RepPostVar');
$data['msn'] = $api->post('msn' , '' , 'RepPostVar');
$data['mycall'] = $api->post('mycall' , '' , 'RepPostVar');
$data['phone'] = $api->post('phone' , '' , 'RepPostVar');
$data['address'] = $api->post('address' , '' , 'RepPostVar');
$data['userpic'] = $api->post('userpic');
$data['saytext'] = $api->post('saytext' , '' , 'RepPostVar');
// var_dump($datas['userid']);
// 更新用户副表
// $api->load('db')->update('[!db.pre!]enewsmemberadd' , $data , 'userid='.$datas['userid']);
$isok = $api->load('db')->update('[!db.pre!]enewsmemberadd' , $data , $datas['userid']);


if($isok){
// 构造输出结构
$result = [
    'code' => 1,
    'list' => $data
];

// 输出json数据
$api->json($result);  
}else{
    $api->load('fun')->json(0 , '修改失败');
}



