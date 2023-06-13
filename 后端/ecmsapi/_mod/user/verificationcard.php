<?php
defined('ECMSAPI_MOD') or exit; // 防止直接仿问该接口文件

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

// 卡号
$card_no = $api->post('card_no' , '' , 'RepPostVar');
// 密码
$password = $api->post('password' , '' , 'RepPostVar');

// 验证卡号与密码是否为空
if($card_no === ''){
    $api->load('fun')->json(0 , '卡号不能为空');
}
if($password === ''){
    $api->load('fun')->json(0 , '密码不能为空');
}


// 定义查询条件 $map
$map = '1=1';


//卡号密码

	$map .= ' and card_no = '.$card_no;
	$map .= ' and password = '.$password;


// 验证卡号与密码是否匹配
$isok = $api->load('db')->one('[!db.pre!]enewscard' , '*' , $map);


// 若没有通过验证 返回错误信息
if(!$isok){
    $api->load('fun')->json(0 , '卡号或密码错误');
}else{
	$api->load('fun')->json(1 , $isok);
}

