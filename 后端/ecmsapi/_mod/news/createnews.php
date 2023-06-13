<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

$data['classid'] = $api->post('classid' , '0' , 'RepPostVar');
$data['title'] = $api->post('title' , '');
$data['ftitle'] = $api->post('ftitle' , '');
$data['writer'] = $api->post('writer' , '');
$data['befrom'] = $api->post('befrom' , '');
$data['userid'] = $api->post('userid' , '');
$data['username'] = $api->post('username' , '');
$data['titlepic'] = $api->post('titlepic');
$data['checked'] = $api->post('checked' , '0' , 'RepPostVar');
$data['newstime'] = time();
$data['smalltext'] = $api->post('smalltext');
$data['newstext'] = $api->post('newstext');

// $data = array(
//     'title' => '用接口发布的一条新闻',
//     'classid' => 1, //会自动判断当前栏目是否属于news模型
//     'newstext' => '新闻的内容', //副表中的字段，你只需要定义即可。
//     'userid' => 1, //发布者id
//     'username' => 'admin', //发布者名称
//     'checked' => 0  // 0表示发布到待审核 1表示直接审核
// );
$id = $api->load('table')->insert('news' , $data);
// 如果$id是数字，表示发布成功。为false表示发布失败
if(false === $id){
    // 发布失败，获取错误信息 并打印
    $errorinfo = $api->load('table')->getError();
    // var_dump($errorinfo);
}else{
    // 发布成功 打印出id
    $api->load('fun')->json(1 , $id);
    // var_dump($id);
}