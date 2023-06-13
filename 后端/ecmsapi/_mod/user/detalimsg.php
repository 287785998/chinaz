<?php
defined('ECMSAPI_MOD') or exit;

$mid = $api->param('mid' , 0 , 'intval'); // 获取文章id

if($id === 0){
    $api->load('fun')->json(0 , '参数错误');
}

$news = $api->load('db')->one('[!db.pre!]enewsqmsg' , '*' , 'mid='.$mid);

//如信息未未读则标记为已读
if($news['haveread'] == 0){
    $api->load('db')->update('[!db.pre!]enewsqmsg' , ['haveread' => 1] , 'mid='.$mid);
}

// var_dump($news);

if(false !== $news){
    $api->load('fun')->json(1 , $news);
}else{
    $errorinfo = $api->load('table')->getError(); //获取错误信息
    $api->load('fun')->json(0 , $errorinfo);
}