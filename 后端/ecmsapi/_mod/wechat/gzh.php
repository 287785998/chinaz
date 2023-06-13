<?php
defined('ECMSAPI_MOD') or exit;

$gzh = $api->extend('gzh' , [
    'token' => 'yourtoken' // 公众号平台设置的token值
]);

// 自动验证 验证通过后可以删除
$gzh->check();

// 获取公众号返回给接口的信息
$data = $gzh->getPost();

//获取关键词 且用RepPostVar函数过滤危险字符
$wd = RepPostVar($data['Content']);

// 判断关键词是否为空
if($wd === ''){
    $gzh->text('请输入关键词' , $data);
}

// 从新闻中搜索相关内容,由于微信公众号自动回复改版后只能回复一篇文章，我们只查询一条记录。
$news = $api->load('db')->one('[!db.pre!]ecms_news' , '*' , 'title like "%'.$wd.'%"' , 'id desc');
if(!$news){
    $gzh->text('没有搜索到"'.$wd.'"相关数据' , $data);
}

// 自定义一个要输出的数组
$results = []; 

// 向数组中添加信息
$results[] = [
    'title' => $news['title'],  // 信息标题
    'description' => $news['smalltext'], // 信息描述 对应数据库的smalltext字段
    'picurl' => $news['titlepic'], // 信息图片 对应数据库的titlepic字段 实际应用中应考虑图片为空，和路径问题
    'url' => 'https://demo.ecms.maiyapai.com'.$news['titleurl'] // 链接地址 注意拼接上域名
];

// 发送图文信息
$gzh->textpic($results , $data);