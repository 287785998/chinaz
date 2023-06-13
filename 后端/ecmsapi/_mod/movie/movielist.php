<?php
defined('ECMSAPI_MOD') or exit;

$id = $api->param('id' , 0 , 'intval'); // 获取文章id
$page = $api->param('page' , 1 , 'intval'); // 当前页码
$pagesize = $api->param('pagesize' , 10 , 'intval'); // 每页显示数据量


if($id === 0){
    $api->load('fun')->json(0 , '参数错误');
}

$news = $api->load('table')->get('movie' , $id, 'onlinepath,id'); // 通过id获取数据



if(false !== $news){
	$path_r=explode("\r\n",$news[onlinepath]);
	$count=count($path_r);
   	$total=count($path_r);
   	
    $i=$page-1;
	$start=$i*$pagesize;
	$tool=$page*$pagesize;
	if($tool < $total){
	    $tool=$page*$pagesize;
	}else{
	    $tool=$total;
	}
	

    for($i=$start;$i<$tool;$i++)
    {
        $showdown_r=explode('::::::',$path_r[$i]);
        $showdown_rr['id']=$i+1;
		$showdown_rr['title']=$showdown_r[0];
// 		$showdown_rr['url']=$showdown_r[1];
		$showdown_rr['control']=$showdown_r[2];
		$showdown_rr['ofen']=$showdown_r[3];
        $showdown[]=$showdown_rr;
	}  

        // 获取总页数
		$totalpage = $total > 0 ? ceil($total/$pagesize) : 1;


        $api->load('fun')->json(1 , [
            'count' => $count,
            'moielist' => $showdown,
            'totalpage' => $totalpage,
            ]);
}else{
    $errorinfo = $api->load('table')->getError(); //获取错误信息
    $api->load('fun')->json(0 , $errorinfo);
}
