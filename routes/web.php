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
//入力ページ
Route::get('/contact', 'ContactController@index')->name('contact.index');

//確認ページ
Route::post('/contact/confirm', 'ContactController@confirm')->name('contact.confirm');

//送信完了ページ
Route::post('/contact/thanks', 'ContactController@send')->name('contact.send');

//ホーム画面
Route::get('home', function () {
    return view('home');
});

// ログイン認証関連
Auth::routes([]);

Route::get('/login/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

// ログイン認証後
Route::middleware('auth:user')->group(function () {

    Route::get('/', 'PostsController@index');
    Route::match(['get', 'post'], '/posts', 'PostsController@create');
    Route::get('/posts/{date}/show', 'PostsController@show');
    Route::get('/posts/{user}/show_others', 'PostsController@show_others');
    Route::patch('/posts/{post}', 'PostsController@update');
    Route::get('/list', 'PostsController@getList');
    Route::get('/calendar', 'PostsController@getCalendar');

});

Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => false,
        'verify'   => false
    ]);

    Route::get('home',      'HomeController@getList')->name('home');
    Route::get('login',     'LoginController@showLoginForm')->name('login');
    Route::post('login',    'LoginController@authenticate')->name('authenticate');

    // ログイン認証後
    Route::middleware('auth:admin')->group(function () {

        Route::post('logout', 'LoginController@logout')->name('logout');
        Route::get('{user}/show', 'HomeController@show')->name('show');
        Route::get('delete', 'HomeController@getUsersList')->name('delete');
        Route::delete('delete/{id}', 'HomeController@destroy');

    });

});