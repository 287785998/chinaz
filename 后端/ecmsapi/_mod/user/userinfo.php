<?php
// 禁止用户直接访问口文件
defined("ECMSAPI_MOD") or exit;

// 获取参数 自动获取GET或POST参数
$userid = $api->param('userid' , 0 , 'intval');  // 用户id
$username = $api->param('username' , '');        // 用户名


$fun = $api->load('fun'); // 加载一个辅助函数类 方便后面的调用 不需要重复的拼写 $api->load('fun')

// 定义查询条件 $map
$map = '1=1';


// 用户id搜索
if($userid != 0){
	$map .= ' and [!db.pre!]enewsmember.userid = '.$userid;
}
//用户名搜索
if($username != ''){
	$map .= ' and [!db.pre!]enewsmember.username = '.$username;
}

// 当前用户基本信息
$list = $api->load('db')->select('[!db.pre!]enewsmember JOIN [!db.pre!]enewsmemberadd ON [!db.pre!]enewsmember.userid = [!db.pre!]enewsmemberadd.userid JOIN [!db.pre!]enewsmembergroup on [!db.pre!]enewsmember.groupid = [!db.pre!]enewsmembergroup.groupid','[!db.pre!]enewsmember.userid,[!db.pre!]enewsmember.username,[!db.pre!]enewsmember.groupid,[!db.pre!]enewsmember.registertime,[!db.pre!]enewsmember.userfen,[!db.pre!]enewsmember.userdate,[!db.pre!]enewsmember.money,[!db.pre!]enewsmember.havemsg,[!db.pre!]enewsmember.wxopenid,[!db.pre!]enewsmemberadd.truename,[!db.pre!]enewsmemberadd.oicq,[!db.pre!]enewsmemberadd.phone,[!db.pre!]enewsmember.email,[!db.pre!]enewsmemberadd.mycall,[!db.pre!]enewsmemberadd.address,[!db.pre!]enewsmemberadd.saytext,[!db.pre!]enewsmemberadd.company,[!db.pre!]enewsmemberadd.userpic,[!db.pre!]enewsmemberadd.lasttime,[!db.pre!]enewsmemberadd.loginnum,[!db.pre!]enewsmembergroup.groupname' , $map ,  'userid desc');



// 构造输出结构
$result = [
    'code' => 1,
    'data' => $list
];

// 输出json数据
$api->json($result);