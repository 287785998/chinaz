<?php
defined('ECMSAPI_MOD') or exit;
header('Content-Type:application/json; charset=utf-8');

date_default_timezone_set("PRC");   //系统使用北京时间
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

define('KEY', '1gHuiop975cdashyex9Ud23ldsvm2Xq');

$fun = $api->load('fun');

if(!$api->isPost()){
    // 非post提交，直接返回错误信息
    $api->load('fun')->json(0 , '非法提交');
}

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

if(!$user){
    // 未登陆，回错误信息
    $api->load('fun')->json(0 , '权限不足，请先登陆');
}

$favaid = $api->post('favaid' , 0 , 'intval');

if($favaid === 0){
    $api->load('fun')->json(0 , '请指定收藏ID');
}


// 删除数据
$result = $api->load('db')->delete('[!db.pre!]enewsfava' ,'favaid='.$favaid);

if(false === $result){
    // 删除失败时返回提示信息
    $api->load('fun')->json(0 , '取消失败');
}


// 返回删除成功的提示
$api->load('fun')->json(1 , '删除成功');