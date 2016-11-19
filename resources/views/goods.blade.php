<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>小张商城</title>
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
    <h1>{{$info['goods_name']}}</h1>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 goods">
                <a href="/goods/1"><img src="/Home/images/goods.jpg" alt=""></a>
                <p>
                    {{$info['goods_name']}}
                    &yen;<span>{{$info['shop_price']}}</span>
                </p>
                <p >
                    <a class="btn btn-primary" href="{{url('buy/'.$info['goods_id'])}}">加入购物车</a>
                    <a class="btn btn-danger" href="{{url('clear')}}">清空购物车</a>
                </p>
            </div>
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
<script src="http://libs.useso.co/Home/js/jquery/2.1.0/jquery.min.js"></script>
<script src="/Home/js/bootstrap.min.js"></script>
</html>