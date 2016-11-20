<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>小张商城</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<link rel="stylesheet" href="/Home/lib/weui.min.css">
<link rel="stylesheet" href="/Home/css/jquery-weui.css">
<style>
    #sub{
        width: 80%;
        margin-left:10%;
        margin-top:2em;
        position:fixed;
        bottom:5em;
    }
</style>
<body ontouchstart>
    <div class="weui_panel weui_panel_access">
      <div class="weui_panel_bd">
      <img src="/Home/images/goods.jpg" width="100%">
        <div class="weui_media_box weui_media_text">
          <h4 class="weui_media_title">{{$info['goods_name']}}</h4>
          <p class="weui_media_desc">{{$info['shop_price']}}</p>
        </div>
      </div>
    </div>     
    <a class="weui_btn weui_btn_primary test" href="{{url('buy/'.$info['goods_id'])}}" id="sub">加入购物车</a>        
    @include('nav')
</body>
</html>