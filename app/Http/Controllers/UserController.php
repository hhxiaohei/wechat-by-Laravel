<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use EasyWeChat\Foundation\Application;


class UserController extends Controller
{
    /**
     * 构造函数初始化
     */
    protected $app;
    
    function __construct($app =null){
    	$config = config('wechat');
    	$this->app = new Application($config);
    	
    }

    public function index(){

		$server = $this->app->server;
		//关注事件 OK
		$server->setMessageHandler(function ($message) {
			if($message->MsgType == 'event'){
				//关注事件
				if($message->Event == 'subscribe'){
					return '欢迎';
				}

			}
		});
		$response = $this->app->server->serve();
		return $response;
    }

    /**
     * 用户登录
     * 卫星提供的user写入session,跳转
     */
    public function login(Request $req){
        if($req->session()->has('user')){
            return redirect('shop');
        }else{
            $oauth  = $this->app->oauth;
            $user = $oauth->user();
            session()->put('user',$user);
            return redirect('center');
        }
		
    }

    /**
     * 用户中心
     */
    public function center(Request $req){
    	//未登陆
    	if(!$req->session()->has('user')){
    		$oauth = $this->app->oauth;
    		return $oauth->redirect();
    	}
    	return redirect('shop');
    }

    /**
     * 用户退出
     * 注销session
     */
    public function logout(){
    	session()->forget('user');
    	return view('logout');
    }
}
