<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

$datas['id'] = $api->post('id');
$data['classid'] = $api->post('classid' , '0' , 'RepPostVar');
$data['title'] = $api->post('title' , '');
$data['ftitle'] = $api->post('ftitle' , '');
$data['writer'] = $api->post('writer' , '');
$data['befrom'] = $api->post('befrom' , '');
$data['userid'] = $api->post('userid' , '');
$data['username'] = $api->post('username' , '');
$data['titlepic'] = $api->post('titlepic');
// $data['checked'] = $api->post('checked' , '0' , 'RepPostVar');
//已审核信息修改变为待审核
$data['checked'] = 0;
$data['newstime'] = time();
$data['smalltext'] = $api->post('smalltext');
$data['newstext'] = $api->post('newstext');

// var_dump($data);


//$id = $api->load('table')->insert('news' , $data);
if($datas['id']){
	$id = $api->load('table')->update('news' , $data , $datas['id']);
	$api->load('fun')->json(1 , $id);
}else{
//	$api->load('fun')->json(0 , '修改失败');
	$errorinfo = $api->load('table')->getError();
}