<?php
defined('ECMSAPI_MOD') or exit;

/*
* 为了安全 传用的参数我们必须经过严格的格式化处理
*/

$keyboard = $api->param('keyboard' , 0 , 'strip_tags'); 



$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')



// 定义查询条件 $map
$map = '1=1';


// 关键词搜索
if($keyboard != ''){
	$map .= ' and keyboard like "%'.$keyboard.'%"';
}

// 获取当前条件下的总数据量
$total = $api->load('db')->total('[!db.pre!]enewssearch' , $map);


// 输出json结构数据 前面我们定义了$fun 所以 $fun->json 同等于 $api->load('fun')->json
$fun->json(1 , [
    'total' => $total
    ]);