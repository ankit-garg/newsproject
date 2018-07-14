<?php

final class Curl{
	public static function get($url,$timeOut="",$headerArray=""){
		if(!empty($url)){
        		$ch = curl_init();
        		curl_setopt($ch, CURLOPT_URL, $url);
			if(!empty($headerArray)){
        			curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
			}
        		if(!empty($timeOut)){
				curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);	
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        		$resp=curl_exec($ch);
        		return $resp;
		}
	}

	public static function post($url,$postData="",$timeOut="",$headerArray=""){
		if(!empty($url)){
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$url);
			curl_setopt($ch, CURLOPT_POST, 1);
			if(!empty($postData)){
				curl_setopt($ch, CURLOPT_POSTFIELDS,$postData);
			}
			if(!empty($headerArray)){
				curl_setopt($ch, CURLOPT_HTTPHEADER, $headerArray);
			}
			if(!empty($timeOut)){
				curl_setopt($ch, CURLOPT_TIMEOUT, $timeOut);
			}
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			$server_output = curl_exec ($ch);
			curl_close ($ch);
			return $server_output;
		}
	}
}
