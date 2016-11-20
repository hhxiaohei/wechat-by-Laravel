<!DOCTYPE html>
<html lang="en">
<head>
	<title></title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
	<link rel="stylesheet" href="/Home/lib/weui.min.css">
	<link rel="stylesheet" href="/Home/css/jquery-weui.css">
	<style>
		.myp{
			width:60%;
			margin:0 auto;
		}
		.myp p{
			text-align:center;
		}
		.myp p:nth-child(2){
			margin-top:0.5em;
		}
	</style>
</head>
<body ontouchstart>
	<div class="weui_msg">
	  <div class="weui_icon_area"><i class="weui_icon_success weui_icon_msg"></i></div>
	  <div class="weui_text_area">
	    <h2 class="weui_msg_title">操作成功</h2><br>
	    <div class="myp">
	    	<p class="weui_msg_desc">订单编号:{{$sn}}</p>
	    	<p class="weui_msg_desc">订单金额:{{$money}}元</p>
	    </div>
	  </div>
	  <div class="weui_opr_area">
	    <p class="weui_btn_area">
	      <a href="/shop" class="weui_btn weui_btn_primary">确定</a>
	    </p>
	  </div>
	  <div class="weui_extra_area">
	    <a href="">查看详情,不用看了,正在开发</a>
	  </div>
	</div>
</body>
</html>