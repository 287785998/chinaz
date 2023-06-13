<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;

// 获取参数 自动获取GET或POST参数
 $userid = $api->param('userid' , 0 , 'intval');
//$username = $api->param('username' , 0 , 'intval');
$id = $api->param('id' , 0 , 'intval');

$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')

// 定义查询条件 $map
$map = '1=1';



 if($userid != 0){
 	$map .= ' and userid = '.$userid;
 }
if($id != 0){
	$map .= ' and id = '.$id;
}



//$list = $api->load('db')->select('[!db.pre!]enewsfava' , '*' , $map ,  'favaid desc');
$list = $api->load('db')->select('[!db.pre!]enewsfava' , '*' , $map , '10,1' , 'favaid desc');

// 构造输出结构
$result = [
    'code' => 1,
    'data' => $list
];

// 输出json数据
$api->json($result);