<?php
defined('ECMSAPI_MOD') or exit; // 防止直接仿问该接口文件

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

$data['userid'] = $api->post('userid');
$data['password'] = $api->post('password');


// $user = $api->load('user')->one($data['userid']);  // 获取用户信息
$user = $api->load('db')->one('[!db.pre!]enewsmember' , '*' , 'userid='.$data['userid']);
// print_r($user);

if($user){
    // 用户存在时进行修改操作
    $passwd = $api->load('user')->createPassword($data['password'] , $user['salt']);
    $api->load('db')->update('[!db.pre!]enewsmember' , ['password' => $passwd] , 'userid='.$user['userid']); //修改密码
    
    // print_r($passwd);
	
	// 构造输出结构
	$result = [
		'code' => 1,
		'list' => $data
	];

	// 输出json数据
	$api->json($result);
}else{
  // 用户不存在的处理
	$api->load('fun')->json(0 , '修改失败');
}



