<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}




// 获取用户名并用RepPostVar函数过滤
$data['username'] = $api->post('username' , '' , 'RepPostVar');
$data['card_no'] = $api->post('card_no' , '' , 'RepPostVar');
$data['money'] = $api->post('money' , '' , 'RepPostVar');
$data['cardfen'] = $api->post('cardfen' , '' , 'RepPostVar');
$data['userid'] = $api->post('userid');
$data['userdate'] = $api->post('carddate');
$data['buytime'] = date('Y-m-d h:i:s', time());

$cardid = $api->post('cardid');

$update['carddate'] = $api->post('carddate');     //有效期
$update['cdgroupid'] = $api->post('cdgroupid'); //会员组
$update['cdzgroupid'] = $api->post('cdzgroupid'); //到期后会员组
$update['money'] = $api->post('money');           //点数

// 添加记录表
$id = $api->load('db')->insert('[!db.pre!]enewsbuybak' , $data);


if(false === $id){
     $api->load('fun')->json(0 , '充值失败!');
}else{
    //删除记录
    $delid = $api->load('db')->delete('[!db.pre!]enewscard' ,'cardid='.$cardid);
    
    //更新USER信息表
    $updata = $api->load('db')->update('[!db.pre!]enewsmember' , [
        'userfen' => ['userfen + '.$update['money']],
        'userdate' => [time()],
        'zgroupid' => [$update['cdzgroupid']],
        'groupid' => [$update['cdgroupid']],
    ] , 'userid='.$data['userid']);
    
    // 构造输出结构
    $result = [
        'code' => 1,
        'list' => $data,
        'id' => $id,
        'delid' => $delid,
        'updata' => $updata
    ];
    
    // 输出json数据
    $api->json($result);
}





