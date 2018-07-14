<?php
include_once("mainDataClass.php");
$http = new swoole_http_server("0.0.0.0", 80);
$http->on('request', function ($request, $response) {
	$response->header("Content-Type", "text/html; charset=utf-8");
	$getData=$request->get;
	if(!empty($getData)){
		$inValidArray=validateParams($getData);
		if(empty($inValidArray)){
			$mainDataObj=new MainData();
			$result=$mainDataObj->getData($getData['category'],$getData['country'],$getData['keyword']);
		}else{
			$result['code']=403;
			$result['response']=implode(",",$inValidArray)." missing";
		}
	}else{
		$result['code']=403;
		$result['response']="Something Went Wrong";
	}
    	$response->end(json_encode($result));
});
$http->start();

function validateParams($params){
	$invalidArray=array();
	$arrayValid=array('category','country','keyword');
	foreach($arrayValid as $validParams){
		if(empty($params[$validParams])){
			$invalidArray[]=$validParams;	
		}
	}
	return $invalidArray;
}
