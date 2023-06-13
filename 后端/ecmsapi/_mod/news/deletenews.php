<?php
defined('ECMSAPI_MOD') or exit;
header('Content-Type:application/json; charset=utf-8');

date_default_timezone_set("PRC");   //系统使用北京时间
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

define('KEY', '1gHuiop975cdashyex9Ud23ldsvm2Xq');

if(!$api->isPost()){
    // 非post提交，直接返回错误信息
    $api->load('fun')->json(0 , '非法提交');
}

$jwt = isset($_SERVER['HTTP_AUTHORIZATION']) ? $_SERVER['HTTP_AUTHORIZATION'] : '';
if($jwt){
    $jwt = str_replace("bearer","",$jwt);
    
    try {
        JWT::$leeway = 60;
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

$id = $api->post('id' , 0 , 'intval');

if($id === 0){
    $api->load('fun')->json(0 , '请指定新闻ID');
}

$news = $api->load('table')->get('news' , $id);

if(false === $news){
    // 没有获取到数据时返回错误提示
    $api->load('fun')->json(0 , $api->load('table')->getError());
}

// 验证当前新闻是否为该会员所发布的
if((int)$news['ismember'] !== 1 || (int)$news['userid'] !== (int)$user['userid']){
    $api->load('fun')->json(0 , '该新闻不是你发布的，无权删除');
}

// 删除数据
$result = $api->load('table')->delete('news' ,$id);

if(false === $result){
    // 删除失败时返回提示信息
    $api->load('fun')->json(0 , $api->load('table')->getError());
}

// 开始删除生成静态的文件 这里只是简单的删除 （如果有分页附件等情况 可以直接使用帝国内置函数去删除）
$filepath = ECMS_PATH . $news['titleurl'];
// 删除文件
@unlink($filepath);

// 返回删除成功的提示
$api->load('fun')->json(1 , '删除成功');