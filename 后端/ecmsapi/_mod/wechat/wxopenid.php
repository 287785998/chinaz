<?php
defined('ECMSAPI_MOD') or exit;

$code = $api->param('code'); 
$appid = 'wxe9b73e91e7efc419'; 
$secret = '77cd8f53927f4e597e23afc5fbc6c5f3'; 
$grant_type = "authorization_code";

if($code){
    $weixin =  file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid=".$appid."&secret=".$secret."&js_code=".$code."&grant_type=".$grant_type);
    $jsondecode = json_decode($weixin); //对JSON格式的字符串进行编码
    $array = get_object_vars($jsondecode);//转换成数组
    $openid = $array['openid'];//输出openid
    $api->load('fun')->json(1 , $array);
}else{
    $api->load('fun')->json(0 , '获取参数失败!');
}