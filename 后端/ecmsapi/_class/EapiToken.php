<?php
class EapiToken {
	
	private $config = array(
		"token"	=> 'token',
		"time" => 't',
		"timeout" => 30,
		"key" => 'ecmsapitoken'
	);
	
	public function __construct($config = array()){
		$this->config = array_merge($this->config, $config);
	}
	
	public function __get($name) {
		if(isset($this->config[$name])){
			return $this->config[$name];
		}else{
			return false;
		}
	}

	public function __set($name,$value){
		if(isset($this->config[$name])){
			$this->config[$name] = $value;
		}
	}
	
	public function build($param = array()){
		global $config;
		$param = !is_array($param) ? array() : $param;
		$arr = array($config['module'] , $config['controller'] , $this->config['token']);
		foreach($arr as $k){
			if(isset($param[$k])){
				unset($param[$k]);
			}
		}
		ksort($param);
// 		var_dump($this->query($param , false) . '&token=' . $this->key);
		return md5($this->query($param , false) . '&token=' . $this->key);
	}
	
	public function query($param , $t = true){
		$str = '';
		foreach($param as $k=>$v){
			$str .= $str ? '&'.$k.'='.$v : $k.'='.$v;
		}
		if(true === $t){
			$str .= '&'.$this->config['token'].'='.$this->build($param);
		}
// 		var_dump($str);
		return $str;
	}
	
	public function check(){
		$token = isset($_GET[$this->config['token']]) ? $_GET[$this->config['token']] : '';
		$time = isset($_GET[$this->config['time']]) ? (int)$_GET[$this->config['time']] : 0;
// 		var_dump($time);
// 		var_dump(time());
// 		var_dump($this->config['timeout']);
		if($time > 0 && !empty($token) && $this->build($_GET) === $token){
            // if($time < time()){
            // 		    return -1;
            // 		}else{
            // 		   return 1; 
            // 		}
			return time() - $time <= $this->config['timeout'] ? 1 : -1;
		}else{
			return 0;
		}
	}
}