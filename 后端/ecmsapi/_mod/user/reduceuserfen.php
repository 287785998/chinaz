<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

// $data = array(
//     'userfen' => $userfen
// );

$data['userfen'] = $api->post('userfen' , '' , 'RepPostVar');
$data['userid'] = $api->post('userid' , '' , 'RepPostVar');

$datas['id'] = $api->post('id' , '' , 'RepPostVar');
$datas['classid'] = $api->post('classid' , '' , 'RepPostVar');
$datas['username'] = $api->post('username' , '' , 'RepPostVar');
$datas['userid'] = $api->post('userid' , '' , 'RepPostVar');
$datas['title'] = $api->post('title' , '' , 'RepPostVar');
$datas['cardfen'] = $api->post('userfen' , '' , 'RepPostVar');
// $datas['truetime'] = time();
$datas['truetime'] = $api->post('truetime');

// 写入记录
$id = $api->load('db')->insert('[!db.pre!]enewsdownrecord' , $datas);

if(false === $id){
     $api->load('fun')->json(0 , '扣费失败!');
}else{
      //扣分
    $updata = $api->load('db')->update('[!db.pre!]enewsmember' , ['userfen' => ['userfen - '.$data['userfen']]] , 'userid='.$data['userid']);  
    // print_r($updata);
    // 构造输出结构
    $result = [
        'code' => 1,
        'data' => $updata
    ];
    
    // 输出json数据
    $api->json($result);
}





