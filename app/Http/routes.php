<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//这个是微信的
//Route::any('wx','IndexController@index');
Route::any('/','IndexController@index');

Route::get('login','UserController@login');
Route::get('center','UserController@center');
Route::get('logout','UserController@logout');

##商城首页
Route::get('shop', 'GoodsController@index');
##商城详情页
Route::get('goods/{id?}','GoodsController@goods');
##购买
Route::get('buy/{id}','GoodsController@buy');
Route::get('cat','GoodsController@cat');

##清空购物车
Route::get('clear','GoodsController@clear');
#订单入库
Route::any('done','GoodsController@done');
#订单支付
Route::any('payok','GoodsController@payok');

//微博
Route::get('weibo','WeiboController@index');