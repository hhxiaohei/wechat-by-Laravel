<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>微商城首页_小张商城</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<link rel="stylesheet" href="/Home/css/bootstrap.min.css">
<style>
.goods {
    margin: 2% 0;
}
.goods img {
    width:90%;
}
#navb li {
    float: left;
    width: 33%;
    text-align: center;
    list-style: none;
    line-height: 50px;
}
body{
    padding-bottom: 70px;
}
</style>
<body>
    <h1>简洁大气的商城</h1>
    <div class="container">
        <div class="row">
            @foreach($data as $v)
            <div class="col-xs-6 goods">
                <a href="/goods/{{$v['goods_id']}}">
                    <img src="/Home/images/goods.jpg">
                </a>
                <p>
                    {{$v['goods_name']}}
                    &yen;<span>{{$v['shop_price']}}</span>
                </p>
            </div>
            @endforeach
        </div>
        <div class="col-xs-12 navbar-fixed-bottom">
          <ul class="navbar-fixed-bottom navbar-default row" id="navb">
            <li><a href="/">首页</a></li>
            <li><a href="/home">个人中心</a></li>
            <li><a href="">帮助</a></li>
          </ul>
        </div>
    </div>
</body>
<script src="http://libs.useso.com/js/jquery/2.1.0/jquery.min.js"></script>
<script src="/Home/js/bootstrap.min.js"></script>
</html>