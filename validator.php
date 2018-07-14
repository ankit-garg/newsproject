<?php

class validatorClass{
	private $redisobj;
	private $expirytime;
	public function __construct(){
		$confArray=parse_ini_file('conf.ini',true);
		$this->expirytime=$confArray['expirytime'];
		$this->redisobj = new Redis();
		$this->redisobj->connect($confArray['redisconf']['ip'],$confArray['redisconf']['port']);
	}
	public function getData($key){
		return $this->redisobj->get($key);
	}

	public function setData($key,$data){
		$this->redisobj->set($key,$data);
		$this->redisobj->expire($key,$this->expirytime);
	}

	public function hasKey($key){
		return $this->redisobj->exists($key);
	}
}
