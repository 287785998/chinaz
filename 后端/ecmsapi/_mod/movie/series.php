<?php
defined('ECMSAPI_MOD') or exit;
header('Content-Type:application/json; charset=utf-8');

date_default_timezone_set("PRC");   //系统使用北京时间
require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

define('KEY', '1gHuiop975cdashyex9Ud23ldsvm2Xq');

$id = $api->param('id' , 0 , 'intval'); // 获取文章id
$movieId = $api->param('movieId' , 0 , 'intval'); // 第几个视频

if($id === 0){
    $api->load('fun')->json(0 , '参数错误');
}

$news = $api->load('table')->get('movie' , $id, 'onlinepath,id'); // 通过id获取数据



// 获取当前已登陆用户的信息
$user = $api->load('user')->getSession();

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
}else{
    $userids = [];
}

// if (empty($jwt)) {
//     $res['result'] = 'error';
//     var_dump('112');
//     exit;
// }




if(false !== $news){
 $rexp="\r\n"; 
 $fexp="::::::";
 $rr = explode($rexp,$news[onlinepath]);
 $fr = explode($fexp,$rr[$movieId-1]);
 $count = count($rr);
 $moielist = $rr[$movieId-1];
}



if(false != $news ){
    $api->load('fun')->json(1 , [
        'count' => $count,
        'SeriesTitle' => $fr[0],
        'SeriesUrl' => $fr[1],
        'control' => $fr[2],
        'ofen' => $fr[3],
        ]);
}else{
    $errorinfo = $api->load('table')->getError(); //获取错误信息
    $api->load('fun')->json(0 , $errorinfo);
}