<?php
defined('ECMSAPI_MOD') or exit;

$id = $api->param('id' , 0 , 'intval'); // 获取文章id
$onclick = $api->param('onclick', 1, 'intval'); // 获取文章点击

if($id === 0){
    $api->load('fun')->json(0 , '参数错误');
}

// print_r($id);
// print_r($onclick);
// 将当前ID点击数
$data = array(
    'onclick' => $onclick
);
$api->load('table')->update('news' , $data, $id);

if($id == '0'){
    $api->load('fun')->json(0 , '失败');
}else{
    $api->load('fun')->json(1 , '成功');
}