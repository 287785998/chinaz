<?php
defined('ECMSAPI_MOD') or exit;

// 过滤非post方式请求
if(!$api->isPost()){
    // 使用fun类是的json方法快速 输出json结构数据
    $api->load('fun')->json(0 , '非法提交');
}

// 以上传图片为例 表单<input type="file" name="image">
// $file = $_FILES['file']['name'];
$file = $_FILES['file'];



$upload = $api->load('upload' , [
    'size' => 1024*1024*2, // 文件大小限制 
    'rootpath' => '../d/upload/', // 上传文件的根目录
    //'exts' => ['gif' , 'jpg' , 'png' , 'webp'] // 允许上传的文件后缀
]);



// 文件名为当前时间戳  文件子目录按 年/月/日 的方式自定生成
// $savepath = date('Y/m/d');
$savepath = '';
$fileinfo = $upload->upload($file , time() , $savepath);

// 若上传成功，将返回以一个包含文件信息的数组。失败返回false
if($fileinfo){
    $fileinfo = [
        'ext' => $fileinfo['ext'],
        'filename' => $fileinfo['filename'],
        'fullname' => $fileinfo['fullname'],
        'original' => $fileinfo['original'],
        'size' => $fileinfo['size'],
        'location' => 'http://app.lsrong.cn/d/upload/'.$fileinfo['fullname'],
    ];
     $api->load('fun')->json(1 , $fileinfo);
}else{
    var_dump($upload->getError()); //打印错误信息
}

