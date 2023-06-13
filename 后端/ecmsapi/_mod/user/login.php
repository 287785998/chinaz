<?php
defined('ECMSAPI_MOD') or exit; // 防止直接仿问该接口文件
date_default_timezone_set("PRC");   //系统使用北京时间
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

define('KEY', '1gHuiop975cdashyex9Ud23ldsvm2Xq');

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}



// 获取用户名并用RepPostVar函数过滤
$username = $api->post('username' , '' , 'RepPostVar');
// 获取用户密码并用RepPostVar函数过滤
$password = $api->post('password' , '' , 'RepPostVar');
// 获取是否开启验证码 并用intval函数过滤
$checkcode = $api->post('checkcode' , 0 , 'intval');

// 如果开启了验证码 先验证验证码是否正确
if($checkcode){
    // 获取验证码并用RepPostVar函数过滤
    $code = $api->post('code' , '' , 'RepPostVar');
    // 验证码为空直接返回错误提示
    if($code === ''){
        $api->load('fun')->json(0 , '验证码不能为空');
    }
    // 用user类中的code方法 验证验证码是否正确 第一个参数填写login 表示当前验证的是登陆验证码
    $isok = $api->load('user')->code('login' , $code); // $isok 将返回数字 -1 0 1 分别代表 -1超时 0失败 1成功
    // 若没有通过验证将返回错误提示
    if($isok !== 1){
        $api->load('fun')->json(0 , $isok < 0 ? '验证码超时' : '验证码不正确');
    }
    $api->load('user')->code('login'); // 清理掉验证码
}

// 验证用户名与密码是否为空
if($username === ''){
    $api->load('fun')->json(0 , '用户名不能为空');
}
if($password === ''){
    $api->load('fun')->json(0 , '密码不能为空');
}

// 验证用户名与密码是否匹配
$isok = $api->load('user')->checkAccounts($username , $password);

// 若没有通过验证 返回错误信息
if(!$isok){
    $api->load('fun')->json(0 , $api->load('user')->getError());
}

// 通过所有验证后 将提交的用户设置为登陆状态
$isok = $api->load('user')->setSession($username);

if(false === $isok){
    // 设置失败后返回错误信息
    $api->load('fun')->json(0 , $api->load('user')->getError());
}else{
    // 设置成功后 获取用户数据
    $user = $api->load('user')->one($username);

    $nowtime = time();
    $token = [
        'iss' => 'http://app.lsrong.cn', //签发者
        'aud' => 'http://app.lsrong.cn', //jwt所面向的用户
        'iat' => $nowtime, //签发时间
        'nbf' => $nowtime + 10, //在什么时间之后该jwt才可用
        'exp' => $nowtime + 604800, //过期时间-10min
        'data' => [
            'userid' => $user['userid'],
            'username' => $user['username'],
        ]
    ];
    $jwt = JWT::encode($token, KEY);
    $res['result'] = 'success';
    $res['jwt'] = 'bearer'.$jwt;
    
    //token放入user
    $user = [
        'token' => $res['jwt'],
        'username' => $user['username'],
        'userid' => $user['userid'],
        'groupid' => $user['groupid'],
        'email' => $user['email'],
        'wxopenid' => $user['wxopenid'],
    ];
    $api->load('fun')->json(1 , $user);
}