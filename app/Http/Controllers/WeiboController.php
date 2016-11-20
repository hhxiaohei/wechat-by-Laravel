<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WeiboController extends Controller
{
	protected $AppKey = 471483595;
	protected $AppSecret = '3c81bcdb0dbff32cfa30b8482bbe917a';
    public function index(){
    	if(isset($_GET['code'])){
    		$code = $_GET['code'];
    		$url = 'https://api.weibo.com/oauth2/access_token';
    		$data = [
    			'client_id'=>$this->AppKey,
    			'client_secret'=>$this->AppSecret,
    			'grant_type'=>'authorization_code',
    			'code'=>$code,
    			'redirect_uri'=>'http://fx2.ittun.com/weibo'
    		];
    		$rs = json_decode($this->getCurl($url,$data),true);
    		$acctok = $rs['access_token'];
    		$uid = $rs['uid'];
    		$rs2 = file_get_contents('https://api.weibo.com/2/users/show.json?access_token='.$acctok.'&uid='.$uid);
    		//$rs2 = json_decode($rs2,true);
    		print_r($rs2);
    	}else{
    		return view('weibo');
    	}
    }

    protected function getCurl($url,$data=null){
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_HEADER, 0);
		//post
		curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
    }
}
