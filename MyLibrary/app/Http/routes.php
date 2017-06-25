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
Route::get('/', function () {
    return view('web.welcome');
});
Route::get('/test',function(){
    return 'This is Test Page!';
});
Route::get('/booklist','ShowController@getbookList');
Route::group(['namespace'=>'Home'],function(){
    Route::get('/home','IndexController@index');
    Route::get('/mybook/booklist','IndexController@showBook');
});

Route::group(['namespace' => 'Home'], function(){
	Route::get('/', 'IndexController@index');
    
    Route::get('/ajaxbook', 'IndexController@ajaxbook');
    Route::get('/bookintro', 'IndexController@introduction');
    Route::get('/pic/download/{id?}', 'IndexController@download');
    

    Route::get('/addbook', 'IndexController@addbook');
    Route::get('/mybookcar', 'IndexController@showmybook');
    Route::get('/delbook', 'IndexController@delbook');
    Route::get('/delallbook', 'IndexController@delallbook');
    Route::get('/submitbook', 'IndexController@submitbook');

    Route::get('/bookrecord', 'IndexController@checkBookRecord');
    Route::get('/customerapply', 'IndexController@customerApply');

    Route::get('/book/bookdetail/{id?}', 'BookDetailController@getDetail');
});

Route::group(['namespace' => 'Auth'], function(){
	Route::get('/login', 'LoginController@index');
	Route::post('/loginaction', 'LoginController@login');
	Route::post('/signup', 'RegisterController@signup');
    Route::get('/logout', 'LoginController@getLogout');

});

Route::group(['namespace' => 'User'], function(){
    Route::get('/user/profile/set', 'IndexController@initprofile');
    Route::get('/user/profile/edit', 'IndexController@editprofile');
    Route::get('/user/profile', 'IndexController@showprofile');

    Route::post('/user/profile/setprofile', 'IndexController@setprofile');    
    Route::post('/user/profile/upload', 'IndexController@uploadprofile');
    Route::post('/user/profile/updateprofile', 'IndexController@updateprofile');
    Route::post('/User/uploadfile', 'IndexController@uploadfile');
	//Route::get('/User/mybook', 'IndexController@index');
 //    Route::get('/User/test', 'IndexController@test');
 //    Route::get('/User/find/{id}', 'IndexController@find'); 
});
//定义路由时，指定中间件参数可以通过冒号 : 来隔开中间件与参数，多个参数可以使用逗号分隔
Route::group(['middleware'=>'barfilter:18,male'], function(){
    Route::get('/bar', function(){
        return "You can into this bar";
    });
});
