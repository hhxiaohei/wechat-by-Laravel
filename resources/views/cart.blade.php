<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
</head>
<link rel="stylesheet" href="/Home/lib/weui.min.css">
<link rel="stylesheet" href="/Home/css/jquery-weui.css">
<style>
    .table{
        width:100%;
        margin:0 auto;
    }
    .table td{
        text-align:center;
    }
    form input{
        border:none;
        font-size:14px;
    }
    #sub{
        width: 80%;
        margin-top:2em;
    }
    .test{
        width: 80%;
    }
</style>
<body ontouchstart>
    <div class="weui_panel weui_panel_access">
        <div class="weui_panel_hd">购物车</div>
        <div class="weui_panel_bd">
            <table class="table">
                <tr>
                    <th>商品</th>
                    <th>价格</th>
                    <th>数量</th>
                </tr>
                @foreach($goods as $g)
                <tr>
                    <td>{{$g['name']}}</td>
                    <td>{{$g['price']}}</td>
                    <td>{{$g['quantity']}}</td>
                </tr>
                @endforeach
            </table>
            <div class="weui_cells">
              <div class="weui_cell">
                <div class="weui_cell_bd weui_cell_primary">
                  <p>小计:</p>
                </div>
                <div class="weui_cell_ft">
                  {{$total}}元
                </div>
              </div>
            </div>
        </div>
    </div>
    <div class="weui_cells weui_cells_form">
            <form action="/done" method="post">
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label class="weui_label">收货地址</label></div>
                    <div class="weui_cell_bd weui_cell_primary">
                      <input type="text" class="form-control" name="address" placeholder="收货地址">
                    </div>
                </div>
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label class="weui_label">收货人姓名</label></div>
                    <input type="text" class="form-control" name="xm" placeholder="收货人姓名">
                </div>
                <div class="weui_cell">
                    <div class="weui_cell_hd"><label class="weui_label">手机号</label></div>
                    <input type="tel" class="form-control" name="tel" placeholder="手机号">
                </div>
                <input type="hidden" name="money" value="{{$total}}">
                {!!csrf_field()!!}
                <button class="weui_btn weui_btn_primary test" type="submit" id="sub">确认下单</button>
                <a href="{{url('clear')}}" class="weui_btn weui_btn_warn test">清空购物车</a>
            </form>
        </div>
    </div>
@include('nav');
</body>
</html>