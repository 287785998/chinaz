<?php
defined('ECMSAPI_MOD') or exit;

$id = $api->param('id' , 0 , 'intval'); // 获取文章id

if($id === 0){
    $api->load('fun')->json(0 , '参数错误');
}

$news = $api->load('table')->get('movie' , $id, 'id,classid,title,onclick,plnum,userid,username,groupid,userfen,keyboard,newstime,titlepic,playadmin,moviesay,diggtop,player,movietype,star,filetype,infopfen,infopfennum'); // 通过id获取数据

if(false !== $news){
 $rexp="\r\n"; 
 $fexp="::::::";
 $rr = explode($rexp,$news[onlinepath]);
 $fr = explode($fexp,$rr[$movieId]);
 $count = count($rr);
 $moielist = $rr[$movieId];
}


if(false !== $news){
    $api->load('fun')->json(1 , [
        'count' => $count,
        'detail' => $news,
        ]);
    // $api->load('fun')->json(1 , $news);
}else{
    $errorinfo = $api->load('table')->getError(); //获取错误信息
    $api->load('fun')->json(0 , $errorinfo);
}