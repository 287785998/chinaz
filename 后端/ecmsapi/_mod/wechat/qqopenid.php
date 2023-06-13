<?php
defined('ECMSAPI_MOD') or exit;

$code = $api->param('code'); 
$appid = '1112304006'; 
$secret = 'K54NfsOC4I8LBNiP'; 
$grant_type = "authorization_code";


if($code){
    //https://api.q.qq.com/sns/jscode2session?appid=APPID&secret=SECRET&js_code=JSCODE&grant_type=
    $weixin =  file_get_contents("https://api.q.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=".$grant_type);
    $jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
    $array = get_object_vars($jsondecode);//转换成数组
    $openid = $array['openid'];//输出openid
    $api->load('fun')->json(1 , $array);
}else{
    $api->load('fun')->json(0 , '获取参数失败!');
}