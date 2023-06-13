<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}
$id = $api->param('id' , 0 , 'intval'); // 获取文章id
$classid = $api->param('classid' , 0 , 'intval'); // 获取文章id
$data['infopfen'] = $api->post('infopfen' , '' , 'RepPostVar');
$data['infopfennum'] = $api->post('infopfennum' , '' , 'RepPostVar');

// $data = array(
//     'userfen' => $userfen
// );


// 更新电影表
$updata = $api->load('db')->update('[!db.pre!]ecms_movie' , [
	'infopfen' => ['infopfen + '.$data['infopfen']],
	'infopfennum' => ['infopfennum + '.$data['infopfennum']],
													   ] , 'id='.id);  


// 构造输出结构
$result = [
    'code' => 1,
    'data' => $updata
];

// 输出json数据
$api->json($result);

