<?php

include_once('curlClass.php');
include_once('datalayer.php');
include_once('validator.php');
class MainData{
	private $apikey;
	private $apibaseurl;
	public function __construct(){
		$confArray=parse_ini_file('conf.ini',true);
		$this->apikey=$confArray['apikey'];
		$this->apibaseurl=$confArray['baseurl'];
	}

	public function getData($category,$country,$keyword){
		if(!empty($category) && !empty($country)){
			$validatorObj=new validatorClass();
			$key=$country."_".$category;
			$modelObj=new dataLayer();
			if(empty($validatorObj->hasKey($key))){
				$completeUrl=$this->apibaseurl."country={$country}&category={$category}&apiKey={$this->apikey}";
				$result=Curl::get($completeUrl,10);
				$modelObj->insertdata($result,$country,$category);
				$validatorObj->setData($key,$result);
			}
			return $modelObj->getData($country,$category,$keyword);	
		}
	}
}
