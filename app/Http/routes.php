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

// Route::get('/', function () {//前台访问地址：http://myblog.en/
//     return view('welcome');
// });

// Route::get('/test','IndexController@index');


//---------前台---------------
Route::get('/', 'Home\IndexController@index');
Route::get('/cate/{cate_id}', 'Home\IndexController@cate');
Route::get('/a/{art_id}', 'Home\IndexController@article');

//---------后台---------------

//登录路由
//http://myblog.en/admin/login
//=> Admin模块;Login控制器;login方法
// Route::get('admin/login','Admin\LoginController@login');=>改成
Route::any('admin/login','Admin\LoginController@login');

//登录验证码路由
Route::get('admin/code','Admin\LoginController@code');
//获得验证码路由
// Route::get('admin/getcode','Admin\LoginController@getcode');

//密码加密
Route::any('admin/crypt', 'Admin\LoginController@crypt');

Route::group(['middleware'=>['admin.login'],'prefix'=>'admin','namespace'=>'Admin'],function(){

	//后台首页
	Route::get('index', 'IndexController@index');

	//后台首页的右侧引入页面
	Route::get('info', 'IndexController@info');

	//退出	
	Route::get('quit', 'LoginController@quit');	

	//修改密码页面显示+操作：所以用any表示post和get
    	Route::any('pass', 'IndexController@pass');	

    	//文章分类：资源路由
    	Route::resource('category','CategoryController');
    	//文章分类列表：修改排序
    	Route::post('cate/changeorder', 'CategoryController@changeOrder');

    	//文章：资源路由
    	Route::resource('article','ArticleController');    	
    	//文章缩略图异步上传
    	Route::any('upload','CommonController@upload');    

        //友情链接
        Route::resource('links', 'LinksController');        
        //友情链接列表：修改排序
        Route::post('links/changeorder', 'LinksController@changeOrder');     

        //自定义导航
        Route::resource('navs', 'NavsController');       
        //自定义导航列表：修改排序
        Route::post('navs/changeorder', 'NavsController@changeOrder');        	

        //网站配置项
        Route::resource('config', 'ConfigController');   
        //网站配置项：修改排序        
        Route::post('config/changeorder', 'ConfigController@changeOrder');     
        //网站配置：把数据库中的值写入配置文件
        Route::get('config/putfile', 'ConfigController@putFile');
        //网站配置：列表页修改各个配置项内容
        Route::post('config/changecontent', 'ConfigController@changeContent');        
});