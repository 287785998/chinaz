<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

// 加载一个user核心内 方便后面的调用
$userapi = $api->load('user');

// 获取用户名并用RepPostVar函数过滤	
$username = $api->post('username' , '' , 'RepPostVar');
// 获取用户密码并用RepPostVar函数过滤
$password = $api->post('password' , '' , 'RepPostVar');
// 获取用户第二次输入的密码并用RepPostVar函数过滤
$password2 = $api->post('password2' , '' , 'RepPostVar');
//默认审核通过
$checked = $api->post('checked' , 1 , 'RepPostVar');
// 获取是否开启验证码 并用intval函数过滤
$checkcode = $api->post('checkcode' , 0 , 'intval');

$email = $api->post('email');

// 如果开启了验证码 先验证验证码是否正确 此步骤与登陆相同（除了验证码参数不一样）
if($checkcode){
    // 获取验证码并用RepPostVar函数过滤
    $code = $api->post('code' , '' , 'RepPostVar');
    // 验证码为空直接返回错误提示
    if($code === ''){
        $api->load('fun')->json(0 , '验证码不能为空');
    }
    // 用user类中的code方法 验证验证码是否正确 第一个参数填写login 表示当前验证的是登陆验证码
    $isok = $userapi->code('register' , $code); // $isok 将返回数字 -1 0 1 分别代表 -1超时 0失败 1成功
    // 若没有通过验证将返回错误提示
    if($isok !== 1){
        $api->load('fun')->json(0 , $isok < 0 ? '验证码超时' : '验证码不正确');
    }
    $userapi->code('register'); // 清理掉验证码
}

// 验证用户名与密码是否为空
if($username === ''){
    $api->load('fun')->json(0 , '用户名不能为空');
}
if($password === ''){
    $api->load('fun')->json(0 , '密码不能为空');
}
if($password !== $password2){
    $api->load('fun')->json(0 , '两次输入的密码不一致');
}

// 开始注册用户

// 定义要写入数据库的字段信息
// 注册时不没有传入checked 字段，将默认使用系统设置的状态
$data = [
    'username' => $username,
    'password' => $password,
    'checked' => $checked,
    'email' => $email
];

// 写入数据 写入成功后返回用户id
$userid  = $userapi->insert($data);

if(false === $userid){
    // 注册失败 返回错误信息
    $api->load('fun')->json(0 , $userapi->getError());
}

// 根据实际情况 选择 注册成功后 是否将用户设置为登陆状态

$isok = $userapi->setSession($userid);

if(false === $isok){
    // 设置失败后返回错误信息
    $api->load('fun')->json(0 , $userapi->getError());
}else{
    // 设置成功后 获取用户数据
    $user = $userapi->one($userid);

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
    $user = [
        'token' => res['jwt'],
        'username' => $user['username'],
        'userid' => $user['userid'],
        'groupid' => $user['groupid'],
        'email' => $user['email'],
        'wxopenid' => $user['wxopenid'],
    ];
    // 输入json数据
    $api->load('fun')->json(1 , $user);
}