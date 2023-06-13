<?php
defined('ECMSAPI_MOD') or exit;

$id = $api->param('id' , 0 , 'intval'); // 获取文章id

if($id === 0){
    $api->load('fun')->json(0 , '参数错误');
}

$news = $api->load('table')->get('news' , $id); // 通过id获取新闻数据


if(false !== $news){
    $api->load('fun')->json(1 , $news);
}else{
    $errorinfo = $api->load('table')->getError(); //获取错误信息
    $api->load('fun')->json(0 , $errorinfo);
}