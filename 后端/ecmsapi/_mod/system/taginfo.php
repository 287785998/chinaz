<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;

// 获取参数 自动获取GET或POST参数
$tagid = $api->param('tagid' , 0 , 'intval');  // TAGSid
$tagname = $api->param('tagname' , '');  // TAGSname

$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')

// 定义查询条件 $map
$map = '1=1';

// 关键词搜索
if($tagname != ''){
    $map .= ' and  tagname = "'.$tagname.'"';
// 	$map .= ' and  tagname like "%'.$tagname.'%"';
}

// 关键词搜索
if($tagid != 0){
	$map .= ' and tagid = '.$tagid;
}


// 获取指定用户ID的10篇新闻，参数具体说明请查看详细文档
$list = $api->load('db')->select('[!db.pre!]enewstags' , '*' , $map ,  'tagid desc');

// 构造输出结构
$result = [
    'code' => 1,
    'tagname' => $tagname,
    'tagid' => $tagid,
    'list' => $list
];

// 输出json数据
$api->json($result);