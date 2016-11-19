<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Cart;
use DB;
use App\Order;
use App\User;
use App\Item;
use App\Fee;

class GoodsController extends Controller
{
	public function __construct(){
		$this->checkLogin();
	}
	//模拟数据
	protected $data = [
		'1'=>['goods_id'=>'1','goods_name'=>'商品11','shop_price'=>'111'],
		'2'=>['goods_id'=>'2','goods_name'=>'商品12','shop_price'=>'112'],
		'3'=>['goods_id'=>'3','goods_name'=>'商品13','shop_price'=>'113'],
		'4'=>['goods_id'=>'4','goods_name'=>'商品14','shop_price'=>'114'],
		'5'=>['goods_id'=>'5','goods_name'=>'商品15','shop_price'=>'115'],
	];
	##验证是否登陆##
	protected function checkLogin(){
		$req = Request();
		if(!$req->session()->has('user')){
    		return redirect('/center');
    	}
	}
	//商城主页
    public function index(Request $req){
    	
    	return view('index',['data'=>$this->data]);
    }
    //商品页面
    public function goods(Request $req){
    	$info =  $this->data[$req->id]; 
    	return view('goods',['info'=>$info]);
    }
    ##购买商品##
    public function buy($id){
    	##购买的商品
    	$good = $this->data[$id];
    	##将产品id/名称/价格/数量放入
    	Cart::add(
    		$good['goods_id'],
    		$good['goods_name'],
    		$good['shop_price'],
    		1,
    		array()##为什么放这个,因为官方案例这样写的
    	);

    	return redirect('/cat');
    }

    ##购物车
   	public function cat(Request $req){
   		##获取购物车的内容
   		$goods = Cart::getContent();

   		##获取总数
   		$total = Cart::getTotal();
   		##添加到页面上去
   		return view('cart',['goods'=>$goods,'total'=>$total]);
   	}

   	##清空购物车
   	public function clear(){
   		Cart::clear();
   		##清空返回首页去!
   		return redirect('shop');
   	}

    ##订单入库
    #######步骤分析#########
    #1.从session拿到用户信息
    #2.往orders表中填充数据->部分数据从req获取,save
    #3.将购物车里的订单信息foreach提取出来,放到item商品表里去
    #4.显示到模板上
    public function done(Request $req){
        $order = new Order();
        $user = new User();
        $session = session()->get('user');
        if(session()->get('user')->getId() == null){
            redirect('center');
        }
        $myUser = $user->where('openid',$session->getId())->first();
        $order->ordsn = date('Ymd').mt_rand(1,999999);
        $order->uid = $myUser->id;
        $order->openid = $session->getId();
        $order->xm = $req->xm;
        $order->address = $req->address;
        $order->tel = $req->tel;
        $order->money = Cart::getTotal();##从购物车取,不能从前台取!
        $order->ispay = 0;
        $order->ordtime = time();
        $orderStatus = $order->save();
        ##第三步
        //print(Cart::getContent());
        $arr1 = [];
        foreach(Cart::getContent() as $v){
            $Item = new Item();
            $Item->oid = $order->ordsn;
            $Item->gid = $v['id'];
            $Item->goods_name = $v['name'];
            $Item->price = $v['price'];
            $Item->amount = $v['quantity'];
            $arr1[] = $Item->save();
        }

        if($orderStatus && count($arr1)==count(Cart::getContent())){
          $this->clear();
          return view('pay',['oid'=>$order->oid]);
        }
        
    }

    ##订单支付##
    public function payok(Request $req){
      ##更改支付状态
      $orderR = Order::where('oid',$req->oid)->first();
      $orderR->ispay = 1;
      $orderR->save();
      ##找到人,分配收益
      $myUser = User::where('openid',$orderR->openid)->first();

      ##p1 0.5  p2 0.3  p3 0.2
      $people = [$myUser->p1,$myUser->p2,$myUser->p3];
      $give = [0.5,0.3,0.2];
      if($people[1] == 0 && $people[2] == 0){
          $fee = new Fee();
            $fee->oid = $orderR->ordsn;
            $fee->byid = $orderR->openid;
            $fee->uid = $myUser->id;##收益的人
            $fee->money = $orderR->money;
            $fee->save();
      }else{
        foreach($people as $k=>$v){
            if($v>0){##判断$v,如果是0,不付钱
              $fee = new Fee();
              $fee->oid = $orderR->ordsn;
              $fee->byid = $orderR->openid;
              $fee->uid = $v;##收益的人
              $fee->money = $orderR->money*$give[$k];
              $fee->save();
            }
             
        }
      }
      return '支付成功!';
    }
}
