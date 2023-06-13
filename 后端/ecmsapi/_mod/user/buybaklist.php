<?php
defined('ECMSAPI_MOD') or exit;

/*
* 为了安全 传用的参数我们必须经过严格的格式化处理
*/

$page = $api->param('page' , 1 , 'intval'); // 当前页码
$pagesize = $api->param('pagesize' , 10 , 'intval'); // 每页显示数据量
$userid = $api->param('userid' , 0 , 'intval'); // 用户ID

$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')

$page = $fun->toInt($page , 1); // 页码应该不小于1
$pagesize = $fun->toInt($pagesize , 1 , 100); // 每页显示数据量范围应该在1~100 若不加限制 当数据达到10W+级时，直接将pagesize设置为 10W 接口将直接崩溃



// 定义查询条件 $map
$map = '1=1';
$map .= ' and userid = '.$userid;

// 获取当前条件下的总数据量
$total = $api->load('db')->total('[!db.pre!]enewsbuybak' , $map);

// 获取总页数
$totalpage = $total > 0 ? ceil($total/$pagesize) : 1;

// 获取当前页的数据
$list = $total > 0 || $page > $totalpage ? $api->load('db')->select('[!db.pre!]enewsbuybak' , '*' , $map , $pagesize.','.$page , 'buytime desc') : [];


// 输出json结构数据 前面我们定义了$fun 所以 $fun->json 同等于 $api->load('fun')->json
$fun->json(1 , [
    'total' => $total,
    'page' => $page,
    'pagesize' => $pagesize,
    'totalpage' => $totalpage,
    'list' => $list
]);