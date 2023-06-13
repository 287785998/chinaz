<?php
defined('ECMSAPI_MOD') or exit;
header('Content-Type:application/json; charset=utf-8');

date_default_timezone_set("PRC");   //系统使用北京时间
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

define('KEY', '1gHuiop975cdashyex9Ud23ldsvm2Xq');

    $fun = $api->load('fun');

// var_dump($user);

$jwt = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
if($jwt){
    $jwt = str_replace("bearer","",$jwt);
    
    try {
        JWT::$leeway = 604800; //一星期
        $decoded = JWT::decode($jwt, KEY, ['HS256']);
        $arr = (array)$decoded;
        if ($arr['exp'] < time()) {
            $res['msg'] = '请重新登录';
        } else {
            $res['result'] = 'success';
            $res['info'] = $arr;
        }
    } catch(Exception $e) {
        $res['msg'] = 'Token验证失败,请重新登录';
    }
    
    $resault = $res["info"]['data'];
    $jsonArr = (array)$resault;
    $userids = $jsonArr['userid'];
//  var_dump($userids);
    //根据token查询当前用户信息
    // 当前用户基本信息
    $user = $api->load('db')->one('[!db.pre!]enewsmember' , '*' , 'userid='.$userids);
}else{
    // 从cookie获取用户信息
    $user = $api->load('user')->getSession();
}

//  var_dump($user['userid']);
//  var_dump($userids);
 
 if($user['userid']){
    $user = [
        'username' => $user['username'],
        'userid' => $user['userid'],
        'groupid' => $user['groupid'],
        'email' => $user['email'],
        'userfen' =>$user['userfen'],
        'money' => $user['money'],
        'wxopenid' => $user['wxopenid'],
    ];
    $api->load('fun')->json(1 , $user);
 }else if($user['userid'] && $userids && $userids != $user['userid']){
    $api->load('fun')->json(401 , 'token已过期!');
 }else{
     $api->load('fun')->json(0 , '未登陆!');
 }

