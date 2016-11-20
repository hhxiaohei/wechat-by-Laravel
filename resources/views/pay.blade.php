<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>支付</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<link rel="stylesheet" href="/Home/css/bootstrap.min.css">
	<link rel="stylesheet" href="/Home/lib/weui.min.css">
<link rel="stylesheet" href="/Home/css/jquery-weui.css">
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
</head>
<body>
	<h1>我是支付页面</h1>
	<div class="container">
		<form action="/payok" method="post">
			<div class="form-group">
				<input type="hidden" name="oid" value="{{$oid}}">
			</div>
			{!!csrf_field()!!}
			<button type="submit" class="btn btn-success">马上支付!</button>
		</form>
    </div>
    @include('nav')
</body>
</html>