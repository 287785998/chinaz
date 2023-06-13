<?php
defined('ECMSAPI_MOD') or exit;

$fun = $api->load('fun');

if(!$api->isPost()){
    // 非post提交，直接返回错误信息
    $api->load('fun')->json(0 , '非法提交');
}

$mid = $api->post('mid' , 0 , 'intval');


// 删除数据
$result = $api->load('db')->delete('[!db.pre!]enewsqmsg' ,'mid='.$mid);

if(false === $result){
    // 删除失败时返回提示信息
    $api->load('fun')->json(0 , '删除失败');
}

// 返回删除成功的提示
$api->load('fun')->json(1 , '删除成功');