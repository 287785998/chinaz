<?php
defined('ECMSAPI_MOD') or exit;

/*
* 为了安全 传用的参数我们必须经过严格的格式化处理
*/

$page = $api->param('page' , 1 , 'intval'); // 当前页码
$pagesize = $api->param('pagesize' , 10 , 'intval'); // 每页显示数据量
$classid = $api->param('classid' , 0 , 'intval'); // 指定栏目id
$isgood = $api->param('isgood' , 0 , 'intval'); // 推荐
$firsttitle = $api->param('firsttitle' , 0 , 'intval'); // 头条
$sort = $api->param('sort' , 'id desc'); // 排序
$keyword = $api->param('keyword' , ''); // 关键词搜索
$userid = $api->param('userid' , ''); // 用户id


$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')
$page = $fun->toInt($page , 1); // 页码应该不小于1
$pagesize = $fun->toInt($pagesize , 1 , 100); // 每页显示数据量范围应该在1~100 若不加限制 当数据达到10W+级时，直接将pagesize设置为 10W 接口将直接崩溃

/*
* $class_r  是帝国官方自带的栏目缓存数组 我们通过它来获取栏目相关信息
*/

// 栏目id不为0的情况下 判断栏目是否存在 不存在 将栏目id设置为0
if($classid !== 0 && !isset($class_r[$classid])){
    $classid = 0;
}

// 定义查询条件 $map
$map = '1=1';

// 当栏目id不为0时 添加对应的筛选条件
if($classid !== 0){
    $classdata = $class_r[$classid]; // 获取栏目信息

    if($classdata['islast']){
        // 当栏目为终级栏目时
        $map .= ' and classid = '.$classid;
    }else{
        // 当栏目为非终级栏目时
        $sonclass = $classdata['sonclass']; //获取所包含的子栏目id
        $sonclass = $api->load('fun')->toNumArray($sonclass); // 将字符串转成数组
        $sonclass = implode(',' , $sonclass); // 将所包含的子栏目id转化成 1,2,3,5格式
        if($sonclass !== ''){
            $map .= ' and classid in('.$sonclass.')';
        }
    }
}

if($isgood !== 0){
    $map .= ' and isgood = '.$isgood;
}

if($firsttitle !== 0){
    $map .= ' and firsttitle = '.$firsttitle;
}

// 关键词搜索
if($keyword != ''){
	$map .= ' and title like "%'.$keyword.'%"';
}

//用户搜索
if($userid !== ''){
    $map .= ' and userid = '.$userid;
}


// 获取当前条件下的总数据量
$total = $api->load('db')->total('[!db.pre!]ecms_news' , $map);

// 获取总页数
$totalpage = $total > 0 ? ceil($total/$pagesize) : 1;

// 获取当前页的数据
$list = $total > 0 || $page > $totalpage ? $api->load('db')->select('[!db.pre!]ecms_news' , '*' , $map , $pagesize.','.$page , $sort) : [];

foreach($list as $i=>$v){
    // 将时间戳转成 2020-12-11 17:15:10 格式
    $list[$i]['newstime'] = date('Y-m-d' , $v['newstime']);
}

// 输出json结构数据 前面我们定义了$fun 所以 $fun->json 同等于 $api->load('fun')->json
$fun->json(1 , [
    'total' => $total,
    'page' => $page,
    'pagesize' => $pagesize,
    'totalpage' => $totalpage,
    'keyword' => $keyword,
    'list' => $list
]);