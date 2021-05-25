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

Route::view('/', 'welcome');

/**
 * --------------------------------------------------------------------------
 * Auth
 * --------------------------------------------------------------------------
 */
// Auth::routes();
Route::group(['namespace' => 'Auth'], function () {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login', 'LoginController@login');
    Route::match(['get', 'post'], 'logout', 'LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'RegisterController@register');

    // password reset
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset')->name('password.update');
});

/**
 * --------------------------------------------------------------------------
 * 要認証画面 Authentication required screen
 * --------------------------------------------------------------------------
 */
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/mypage', 'MypageController@index')->name('mypage');
    Route::get('/mypage/backlog-icon', 'BacklogIconController@create')->name('mypage.backlogicon.create');
    Route::post('/mypage/backlog-icon', 'BacklogIconController@store')->name('mypage.backlogicon.store');


    /**
     * ユーザ管理 User Management TemplateSample
     */
    Route::get('/admin/user', 'UserController@list')->name('admin.user.list');
    Route::post('/admin/user/filter', 'UserController@filter')->name('admin.user.filter');
    Route::get('/admin/user/create', 'UserController@create')->name('admin.user.create');
    Route::post('/admin/user', 'UserController@store')->name('admin.user.store');
    Route::get('/admin/user/{id}', 'UserController@edit')->name('admin.user.edit');
    Route::put('/admin/user/{id}/update', 'UserController@update')->name('admin.user.update');
});
