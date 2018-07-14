<?php
include_once('curlClass.php');

//Test 1
$url="http://52.66.184.42/?category=sports&country=in";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==403 && $respArray['response']=='keyword missing'){
	echo "test 1 passed \n";
}

//Test 2
$url="http://52.66.184.42/?category=sports&keyword=football";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==403 && $respArray['response']=='country missing'){
        echo "test 2 passed \n";
}

//Test 3
$url="http://52.66.184.42/?country=in&keyword=football";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==403 && $respArray['response']=='category missing'){
        echo "test 3 passed \n";
}


//52.66.174.42

//Test 4
$url="http://52.66.184.42/?country=in";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==403 && $respArray['response']=='category,keyword missing'){
        echo "test 4 passed \n";
}

//Test 5 (Compelete match records)
$url="http://52.66.184.42/?country=in&category=sports&keyword=football";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==200){
	echo "test 5 passed \n";	
}

//Test 6 Passed (Partial March records)
$url="http://52.66.184.42/?country=in&category=sports&keyword=foot";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==200){
        echo "test 6 passed \n";
}


//Test 7 Suggestions on typo mistakes
$url="http://52.66.184.42/?country=in&category=sports&keyword=crickit";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==200 && $respArray['data']['Did You Mean This'][0]=='cricket'){
	echo "Test 7 passed \n";
}


//Data not found
$url="http://52.66.184.42/?country=in&category=sports&keyword=dnjbjbkjbf";
$resp=Curl::get($url);
$respArray=json_decode($resp,true);
if($respArray['code']==404){
        echo "Test 8 passed \n";
}

