<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;

// 获取参数 自动获取GET或POST参数
$classid = $api->param('classid' , 0 , 'intval');  // 获取栏目ID，并格式化为数字
$showclass = $api->param('showclass' , 0 , 'intval');  // 获取栏目ID，并格式化为数字

// 定义查询条件 $map
$map = '1=1';
$map = ' classid  = '.$classid ;
$map .= ' and showclass  = '.$showclass ;


// 栏目导航
$list = $api->load('db')->one('[!db.pre!]enewsclass' , '*' , $map ,  'myorder desc');

$list = [
    'classname' => $list['classname'],
    'classid' => $list['classid'],
    'bname' => $list['bname'],
    'tbname' => $list['tbname'],
    'modid' => $list['modid'],
    'intro' => $list['intro'],
    'classimg' => $list['classimg'],
    'showclass' => $list['showclass']
];

// print_r($list);
// 构造输出结构
$result = [
    'code' => 1,
    'list' => $list
];

// 输出json数据
$api->json($result);