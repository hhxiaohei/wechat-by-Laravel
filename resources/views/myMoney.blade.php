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
		.center{
			margin-top:20px;
			text-align: center;
		}
		body{
		    padding-bottom: 70px;
		}
	</style>
</head>
<body>
	<p class="center">你好:{{$id}}</p>
			<div class="weui_cells">
			<div class="weui_cell">
			    <div class="weui_cell_bd weui_cell_primary">
			      <p>订单号</p>
			    </div>
			    <div class="weui_cell_ft">
			        收益
			    </div>
			  </div>
			@forelse($res as $v)
			  <div class="weui_cell">
			    <div class="weui_cell_bd weui_cell_primary">
			      <p>{{$v['oid']}}</p>
			    </div>
			    <div class="weui_cell_ft">
			      {{$v['money']}}元
			    </div>
			  </div>
			@empty
				<p class="center">暂无收益!</p>
			@endforelse
			</div>
    @include('nav')
</body>
</html>