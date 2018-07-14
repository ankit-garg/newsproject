<?php

include_once('curlClass.php');
final class dataLayer{
	private $server;
	private $index;
	private $expirytime;
	private $estype;
	public function __construct(){
		$confArray=parse_ini_file('conf.ini',true);
		$this->server=$confArray['esconf']['server'];
		$this->index=$confArray['esconf']['index'];
		$this->estype=$confArray['esconf']['type'];
		$this->expirytime=$confArray['expirytime'];
	}

	public function insertdata($data,$country,$category){
		$dataArray=json_decode($data,true);
		$expiryTime=time()+$this->expirytime;
		foreach($dataArray['articles'] as $newsData){
			$uniqKey=substr(preg_replace("/[^a-zA-Z0-9]+/", "", $newsData['url'].$country.$category),-200,200);
			$url=$this->server."/".$this->index."/".$this->estype."/".$uniqKey;
			$resp=Curl::get($url,10);
			$respArray=json_decode($resp,true);
			$rowInser=array();
			if(empty($respArray['found'])){
				$rowInser['category']=$category;
				$rowInser['country']=$country;
				$rowInser['title']=$newsData['title'];
				$rowInser['description']=$newsData['description'];
				$rowInser['stitle']=strtolower($rowInser['title']);
				$rowInser['sdescription']=strtolower($rowInser['description']);
				$rowInser['url']=$newsData['url'];
				$rowInser['expiry']=$expiryTime;
			}else{	
				$url=$url."/_update";
				$rowInser['doc']['expiry']=$expiryTime;
			}
			Curl::post($url,json_encode($rowInser),10,array('Content-Type: application/json'));
		}
		$urlRefresh=$this->server."/".$this->index."/_refresh";
		$resp=Curl::post($urlRefresh);
	}
	
	private function getfirstLevelQuery($country,$category,$skeyword){
		$row=array();
		$row['query']['bool']['must'][] = ['term' => ['country' => $country]];
		$row['query']['bool']['must'][] = ['term' => ['category' => $category]];
		$row['query']['bool']['should'][] = ['term' => ['stitle' => $skeyword]];
		$row['query']['bool']['should'][] = ['term' => ['url' => $skeyword]];
		$row['query']['bool']['should'][] = ['term' => ['sdescription' => $skeyword]];
		$row['query']['bool']['must'][] = ["range"=>["expiry"=>["gte"=>time()]]];
		$row['query']['bool']['minimum_should_match'] = 1;
		$row['sort']['_score']="desc";
		return $row;
	}

	private function getsecondLevelQuery($country,$category,$skeyword){
		$row=array();
		$row['query']['bool']['must'][] = ['term' => ['country' => $country]];
		$row['query']['bool']['must'][] = ['term' => ['category' => $category]];
		$row['query']['bool']['must'][] = ["range"=>["expiry"=>["gte"=>time()]]];
		$row['query']['bool']['should'][] = ['wildcard' => ['stitle' => "*".$skeyword."*"]];
		$row['query']['bool']['should'][] = ['wildcard' => ['sdescription' => "*".$skeyword."*"]];
		$row['query']['bool']['should'][] = ['wildcard' => ['url' => "*".$skeyword."*"]];
		$row['query']['bool']['minimum_should_match'] = 1;
		$row['sort']['_score']="desc";
		return $row;
	}
	
	private function getthirdLevelQuery($country,$category,$skeyword){
		$row=array();
		$row['query']['bool']['must'][] = ['term' => ['country' => $country]];
		$row['query']['bool']['must'][] = ['term' => ['category' => $category]];
		$row['query']['bool']['must'][] = ["range"=>["expiry"=>["gte"=>time()]]];
		$row['query']['bool']['should'][] = ['term' => ['stitle' => $skeyword]];
		$row['query']['bool']['minimum_should_match'] = 1;
		$row['suggest']['suggester']['text']=$skeyword;
		$row['suggest']['suggester']['phrase']=['field' => "stitle"];
		$row['sort']['_score']="desc";
		return $row;
	}
	
	public function getData($country,$category,$keyword){
		$skeyword=strtolower($keyword);
		$query=$this->getfirstLevelQuery($country,$category,$skeyword);
		$url=$this->server."/".$this->index."/".$this->estype."/_search";
		$data=Curl::post($url,json_encode($query),10,array('Content-Type: application/json'));
		$dataArray=json_decode($data,true);
		if(empty($dataArray['hits']['total'])){
			$query=$this->getsecondLevelQuery($country,$category,$skeyword);
			$data=Curl::post($url,json_encode($query),10,array('Content-Type: application/json'));
			$dataArray=json_decode($data,true);	
		}
		if(empty($dataArray['hits']['total'])){
			$query=$this->getthirdLevelQuery($country,$category,$skeyword);
			echo json_encode($query);
			$data=Curl::post($url,json_encode($query),10,array('Content-Type: application/json'));
			$dataArray=json_decode($data,true);
		}
		$finalData=$this->parseData($dataArray,$country,$category,$keyword);
		return $finalData;
	}
	
	private function parseData($dataArray,$country,$category,$keyword){
		$response=array();
		$finalArray=array();
		$response['Country']=$country;
		$response['Filter keyword']=$keyword;
		$response['Category']=$category;
		if(!empty($dataArray['hits']['total'])){
			$i=0;
			foreach($dataArray['hits']['hits'] as $data){
				$response['res'][$i]['News Title']=$data['_source']['title'];
				$response['res'][$i]['Description']=substr($data['_source']['description'],0,100);
				$response['res'][$i++]['Source News URL']=$data['_source']['url'];
			}
			$finalArray['code']=200;
			$finalArray['response']=$i." Results found";
			$finalArray['data']=$response;
		}elseif(!empty($dataArray['suggest']['suggester'][0]['options'])){
			foreach($dataArray['suggest']['suggester'][0]['options'] as $data){
				$response['Did You Mean This'][]=$data['text'];
			}
			$finalArray['code']=200;
			$finalArray['response']=count($response['Did You Mean This'])." suggestions found";
			$finalArray['data']=$response;
		}else{
			$finalArray['code']=404;
			$finalArray['response']="OOPS!! We don't found anything";
			$finalArray['data']=$response;
		}
		return $finalArray;
	}
}

