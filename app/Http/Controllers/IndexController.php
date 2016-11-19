<?php
/**
 * 微信引入
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
//引入微信
use EasyWeChat\Foundation\Application;
use EasyWeChat\Message\Text;
//图文专用
use EasyWeChat\Message\News;
//引入Model
use App\User;//<-这里必须加App
use DB;

class IndexController extends Controller
{
	public $app = '';
	//构造函数,app可以复用
	public function __construct(){
		$options = config('wechat');
		$this->app = new Application($options);
	}
	

    //微信验证的方法 
    public function index(){

		$server = $this->app->server;
		//关注事件 OK
		$server->setMessageHandler(function ($message) {
			if($message->MsgType == 'event'){
				//关注事件
				if($message->Event == 'subscribe'){

					//官方的方法
					// $userService = $this->app->user;
			  		// $user = $userService->get($message->FromUserName);
			  		// return $user->nickname;
			    	//官方的方法
			    	
					//1.获取用户昵称
					$nickname = $this->getUser($message->FromUserName);
					/**
					 * 2.入库
					 */
					return $this->guanZhu($message,$nickname);
				}
				//取消关注事件
				if($message->Event == 'unsubscribe'){
					return $this->unSubscribe($message->FromUserName);
				}
			}
            if($message->MsgType == 'text'){
                return '11111';
            }
		});
		$response = $this->app->server->serve();
		return $response;
    }
    /**
     * 关注事件
     * 1.判断用户是否存在
     * 		1.0 存在->已关注->不做变动
     * 		1.1 存在->以前关注过->欢迎回来->更新状态为1
     * 		2.0 不存在->二维码无参数->一级代理->写入数据
     * 		2.1 不存在->二维码有参数->作为下级->写入数据
     * 3.生成二维码!
     */
    public function guanZhu($message,$nickname){

    	$msg = User::where('openid',$message->FromUserName)->first();
    	// 1.0 
    	if($msg){
    		if($msg->status == 1){
    			return $msg->name.'!:)欢迎回家!';
    	//1.1
    		}else if($msg->status == 0){
    			$msg->status = 1;
	    		$msg->name = $nickname['nickname'];
	    		$msg->save();
	    		return $msg->name.'!:)你还知道回来啊?';
    		}
    	}else{
    	
	    	$openid = $message->FromUserName;
			//写入数据库
			$user = new User();
			//2.2 有参数
			if($message->EventKey){
				//上级数据
				$pid = ltrim($message->EventKey,"qrscene_");
				$pidInfo = User::where('openid',$pid)->first();
				//写入信息 p1(二维码的参数) p2(上级的上级) p3(上级的上上级)
				$user->p1 = $pidInfo->id;
				$user->p2 = $pidInfo->p1;
				$user->p3 = $pidInfo->p2;
			}
			//2.1 无参数
			$user->openid = $openid;
			$user->name = $nickname['nickname'];
			$user->city = $nickname['city'];
			$user->sex = $nickname['sex'];
			$user->country = $nickname['country'];
			$user->headimgurl = $nickname['headimgurl'];	
			$user->subtime = time();
			$user->save();
    	}
    	//创建二维码
    	$this->makeQrcode($message);
    	$nickname = $this->getUser2($message);
    	return $nickname.'欢迎关注';
    }

    /**
     * 取消关怀
     * 参数为openid,更新状态码,不轻易删除
     */
    public function unSubscribe($openid){
    	$msg = User::where('openid',$openid)->first();
    	//找到这一行,更新,把状态改为0即可
    	if($msg){
    		$msg->status = 0;
    		$msg->save();
    	}
    	return '取消关注!!!!';
    }

    //curl获取用户信息
    public function getUser($FromUserName){
    	$ACCESS_TOKEN =  $this->getToken();
    	$url= "https://api.weixin.qq.com/cgi-bin/user/info?access_token={$ACCESS_TOKEN}&openid={$FromUserName}&lang=zh_CN";
		return json_decode($this->getCurl($url,'get'),true);
    }

    //官方的用户信息获取
    protected function getUser2($message){
    	$userService = $this->app->user;
  		$user = $userService->get($message->FromUserName);
  		return $user->nickname;
    }

    //获取token
    public function getToken(){
    	$APP_ID = env('APP_ID');
    	$SECRET = env('SECRET');
    	$path = public_path().'/access.token';
    	//1.判断文件是否存在
    	//2.判断文件是否失效 短路
    	if(!file_exists($path) || (time() - filemtime($path)) > 5 ) {
    		//创建assess_token
    		$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APP_ID}&secret={$SECRET}";
    		$access_token = json_decode($this->getCurl($url,'get'),true)['access_token'];
    		//写入public目录下
    		file_put_contents($path, $access_token);
    	}else{
    		$access_token = file_get_contents($path);
    	}
    	return $access_token;
    }

    //curl方法封装
    public function getCurl($url,$method,$data=false){
    	$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		//post
		if($method == 'post'){
			curl_setopt ($curl, CURLOPT_POST, $method);
        	curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		}
		curl_setopt($curl, CURLOPT_HEADER, 0);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);//这个是重点。禁止SSL
		$data = curl_exec($curl);
		curl_close($curl);
		return $data;
    }

    //生成临时二维码
    public function makeQrcode($message){
    	//获取实例,把微信放入二维码
    	$qrcode = $this->app->qrcode;
    	$result = $qrcode->forever("$message->FromUserName");
		$ticket = $result->ticket;
		$url = $qrcode->url($ticket);
		$content = file_get_contents($url); // 得到二进制图片内容
		//判断目录是否存在,否则创建
		if(!is_dir(public_path().'/qrcode/'.date('Ymd',time()))){
			mkdir(public_path().'/qrcode/'.date('Ymd'),0777,true);
		}
		$path = public_path().'/qrcode/'.date('Ymd').'/'.$message->FromUserName.'.jpg';
		file_put_contents($path, $content); // 写入文件
		return $path;
    }
}
