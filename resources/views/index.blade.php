<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微商城首页_小张商城</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<link rel="stylesheet" href="/Home/lib/weui.min.css">
<link rel="stylesheet" href="/Home/css/jquery-weui.css">
<style>
    .weui-row{
        margin-bottom:50px;
    }
</style>
<body ontouchstart>
<img src="http://www.wallcoo.com/animal/v195_Lively_Dogs/wallpapers/1280x800/Lively_Dogs_wallpaper_MIX88041_wallcoo.com.jpg" width="100%">
<div class="weui-row">
    @foreach($data as $v)
    <div class="weui-col-50">
      <a href="/goods/{{$v['goods_id']}}">
        <img src="/Home/images/goods.jpg" width="100%">
     </a>
     <p>
        {{$v['goods_name']}}
        &yen;<span>{{$v['shop_price']}}</span>
    </p>
   </div>
   @endforeach
</div>
@include('nav');
</body>
<script src="http://libs.baidu.com/jquery/1.11.1/jquery.min.js"></script>
<script src="/Home/js/jquery-weui.min.js"></script>
</html>