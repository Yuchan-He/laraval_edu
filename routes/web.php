<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'],function(){
	// admin login page
	Route::get('public/login','Admin\PublicController@login')-> name('login');
	// verity admin login page
	Route::post('public/check','Admin\PublicController@check');
	// logout admin page
	Route::get('public/logout','Admin\PublicController@logout');

	// admin manage page --content part
	Route::get('index/index','Admin\IndexController@index');
	// admin manage page --iframe part
	Route::get('index/welcome','Admin\IndexController@welcome');

	// member list
	Route::get('/member/index','Admin\MemberController@index');
	// add memeber in member list
	Route::any('/member/add','Admin\MemberController@add');
	// ajax四级联动获取下属地址
	Route::get('/member/getareabyid','Admin\MemberController@getAreaById');
	// play the video in member list
	Route::get('/member/video','Admin\MemberController@playVideo');

	// export the excel in manage page
	Route::get('index/export','Admin\ManagerController@export');


});


Route::group(['prefix' => 'admin','middleware' => 'checkrbac'],function(){
	// admin manager page
	Route::get('/manager/index','Admin\ManagerController@index');
	// export the excel in manage page
	// Route::get('index/export','Admin\ManagerController@excelExport');

	// admin manager auth page
	Route::get('auth/index','Admin\AuthController@index');
	// add auth in admin manager auth page
	Route::any('auth/add','Admin\AuthController@add');


	// role page
	Route::get('/role/index','Admin\RoleController@index');
	// role assign page
	Route::any('/role/assign','Admin\RoleController@assign');

});

//test for ajax ,open ajax and ajax request
Route::get('/ajax/openAjax',function(){
	return view('01_ajax');
});

Route::get('/ajax/getServerData',function(){
	// return 'you get ServerData';
	return 'hello';

});

//  查看封装的ajax是否能实现ajax请求
Route::get('/ajax/wrapper',function(){
	return view('02_wrapperAjax');
});