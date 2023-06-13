<?php
defined('ECMSAPI_MOD') or exit;

/*
* 为了安全 传用的参数我们必须经过严格的格式化处理
*/

$page = $api->param('page' , 1 , 'intval'); // 当前页码
$pagesize = $api->param('pagesize' , 10 , 'intval'); // 每页显示数据量
$username = $api->param('username', ''); 
$userid = $api->param('userid' , 0 , 'intval');
$classid = $api->param('classid' , '' , 'intval');
$groupid = $api->param('groupid' ,'');



$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')

$page = $fun->toInt($page , 1); // 页码应该不小于1
$pagesize = $fun->toInt($pagesize , 1 , 100); // 每页显示数据量范围应该在1~100 若不加限制 当数据达到10W+级时，直接将pagesize设置为 10W 接口将直接崩溃



// 定义查询条件 $map
$map = '1=1';
//$map .= ' and cid = '.$cid;

// 用户id搜索
if($userid != 0){
	$map .= ' and [!db.pre!]enewsmember.userid = '.$userid;
}
//用户名搜索
if($username != ''){
// 	$map .= ' and [!db.pre!]enewsmember.username = '.$username;
	$map .= ' and [!db.pre!]enewsmember.username = "'.$username.'"';
}

//用户组
if($groupid != ''){
	$map .= ' and [!db.pre!]enewsmember.groupid = '.$groupid;
}

//部门
if($classid != ''){
	$map .= ' and [!db.pre!]enewsmember.classid = '.$classid;
}

// 获取当前条件下的总数据量
$total = $api->load('db')->total('[!db.pre!]enewsmember JOIN [!db.pre!]enewsmemberadd ON [!db.pre!]enewsmember.userid = [!db.pre!]enewsmemberadd.userid JOIN [!db.pre!]enewsmembergroup on [!db.pre!]enewsmember.groupid = [!db.pre!]enewsmembergroup.groupid' , $map);

// 获取总页数
$totalpage = $total > 0 ? ceil($total/$pagesize) : 1;

// 获取当前页的数据
$list = $total > 0 || $page > $totalpage ? $api->load('db')->select('[!db.pre!]enewsmember JOIN [!db.pre!]enewsmemberadd ON [!db.pre!]enewsmember.userid = [!db.pre!]enewsmemberadd.userid JOIN [!db.pre!]enewsmembergroup on [!db.pre!]enewsmember.groupid = [!db.pre!]enewsmembergroup.groupid' , '[!db.pre!]enewsmember.userid,[!db.pre!]enewsmember.username,[!db.pre!]enewsmember.groupid,[!db.pre!]enewsmember.registertime,[!db.pre!]enewsmember.userfen,[!db.pre!]enewsmember.	userdate,[!db.pre!]enewsmember.money,[!db.pre!]enewsmember.havemsg,[!db.pre!]enewsmember.wxopenid,[!db.pre!]enewsmemberadd.truename,[!db.pre!]enewsmemberadd.oicq,[!db.pre!]enewsmemberadd.phone,[!db.pre!]enewsmemberadd.mycall,[!db.pre!]enewsmemberadd.address,[!db.pre!]enewsmemberadd.saytext,[!db.pre!]enewsmemberadd.company,[!db.pre!]enewsmemberadd.userpic,[!db.pre!]enewsmemberadd.lasttime,[!db.pre!]enewsmemberadd.loginnum,[!db.pre!]enewsmembergroup.groupname' , $map , $pagesize.','.$page , '[!db.pre!]enewsmember.userid desc') : [];

foreach($list as $i=>$v){
    // 将时间戳转成 2020-12-11 17:15:10 格式
    $list[$i]['lasttime'] = date('Y-m-d' , $v['lasttime']);
    $list[$i]['registertime'] = date('Y-m-d' , $v['registertime']);
}


// 输出json结构数据 前面我们定义了$fun 所以 $fun->json 同等于 $api->load('fun')->json
$fun->json(1 , [
    'total' => $total,
    'page' => $page,
    'pagesize' => $pagesize,
    'totalpage' => $totalpage,
    'list' => $list
]);