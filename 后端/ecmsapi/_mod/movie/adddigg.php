<?php
defined('ECMSAPI_MOD') or exit;

$id = $api->param('id' , 0 , 'intval'); // 获取文章id
$diggtop = $api->param('diggtop', 1, 'intval'); // 获取文章点击



// if($id === 0){
//     $api->load('fun')->json(0 , '参数错误');
// }


// 将当前ID点击数
$data = array(
    'diggtop' => $diggtop
);

// $api->load('db')->update('[!db.pre!]ecms_movie' , ['diggtop' => $diggtop] , 'id='.$id);

$api->load('table')->update('movie' , $data , $id);

if($id == '0'){
    $api->load('fun')->json(0 , '失败');
}else{
    $api->load('fun')->json(1 , '成功');
}