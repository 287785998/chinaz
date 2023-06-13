<?php
defined('ECMSAPI_MOD') or exit;
header('Content-Type: text/html; charset=utf-8');

//加载token类,并定义参数
$tokenapi = $api->load('token' , 
	array(
		'timeout' => 30 , //超时设置
		'key' => 'ecmsapitoken' //加密key
	)
);


$arr = array(
	'mod' => 'user',
	'act' => 'token',
	't' => $api->get('t')
);

$ispass = $tokenapi->check();
$error = array(
'-1' => '超时了,请点下面生成的连接重新测试',
'0' => '未通过验证,请点击下面生成的新连接测试',
'1' => '<span style="color:#fff;">验证成功,刷新此页,可配合验证信息中的时间,观察超时情况,若对参数有任何的修改,将会验证失败</span>'
);
echo '<div style="background:'.($ispass === 1 ? 'green' : 'yellow').';color : #000; padding:10px; text-align:center;">'.($error[$ispass]).'</div>';
echo '======================= 配置信息 ==========================<br/><br/>';
echo '超时设置: (' . $tokenapi->timeout . ')秒<br/><br/>';
echo 'token变量名: (' . $tokenapi->token . ')<br/><br/>';
echo '时间戳变量名: (' . $tokenapi->time . ')<br/><br/>';
echo '加密key: (' . $tokenapi->key . ')<br/><br/>';
echo '======================= 验证信息 ==========================<br/><br/>';


echo '生成时间: ' . date('Y-m-d H:i:s' , (int)$api->get($tokenapi->time));
echo '<br/><br/>验证时间: ' . date('Y-m-d H:i:s');
echo '<br/><br/>验证结果:  '. $ispass .'  (-1:超时 ,0:失败 , 1:成功)';



$arr['t'] = time(); //更新时间
$token0 = 'act=token&mod=user&t='.time().'&token=ecmsapitoken';
echo'<br/>'.$token0.'<br/>_token0<br/><br/>';
$token = md5($token0);
$url  = 'http://app.lsrong.cn/ecmsapi/index.php?mod=user&act=token&t=' . time() . '&token=' .$token;
$urls = 'http://app.lsrong.cn/ecmsapi/index.php?'.$tokenapi->query($arr);
//var_dump($arr);
//echo '<br/>.$tokenapi.<br>';
echo '<br/>_arr<br>';

echo '<br/><br/>新的请求地址 : <a href="'.$url.'">'.$url.'</a> (测试新的地址请点击,否则刷新(F5)此页)';
echo '<br/><br/>新的请求地址 : <a href="'.$urls.'">'.$urls.'</a> (测试新的地址请点击,否则刷新(F5)此页)';
echo '<br/><br/>======================= 如何生成token ==========================<br/><br/>';
echo 'token是由所有GET数据(除去 token变量 , 模块 , 控制器),通过键的升序排列 , 然后添加上 &token=[token的key] 进行md5加密<br/><br/>';
echo '示例<br/><br/>假定一个接口,我们需要传入id,page两个参数,那么我们生成token需要用到的参数就有三个 id,page 以及时间戳参数'.$tokenapi->time.'(可以在配置中自由设置)<br/><br/>';
echo '通过对参数的排序与组合生成的字符串是 : <span style="color:red;">&t='.time().'</span><br/><br/>';
echo '然后需要在最后拼接上 <span style="color:red;">&token='. $tokenapi->key .'</span> ('. $tokenapi->key .')是不可见的,在配置中自由设置<br/><br/>';
$token = md5('t='.time().'&token=ecmsapitoken');
echo '最后在结果就是 <span style="color:red;">&t='.time().'&token='. $tokenapi->key .'</span> 使用MD5方式加密后就是: '.$token.'<br/><br/>';
echo '最终api的请求完整参数就是 m='.api_m.'&c='.api_c.'&'.'&t='.time().'&'.$tokenapi->token.'='.$token;


//下面为获取示例代码,复制到本地测试时,可以删除
echo '<br/><br/>======================= 示例代码 ==========================<br/><br/>';
echo '<pre style="border:1px solid #ddd; background-color:#f8f8f8; padding:10px; font-size:12px;">'. htmlspecialchars(@file_get_contents('./demo/token.php')) .'</pre>';