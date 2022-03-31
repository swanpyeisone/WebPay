<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//==================================================
// Admin Login ===========================================================
Route::get('/admin/login','Auth\AdminLoginController@showLoginForm');
Route::post('/admin/login','Auth\AdminLoginController@login')->name('admin.login');
Route::post('/admin/logout','Auth\AdminLoginController@logout')->name('admin.logout');
//======================================================================
// User Login =====================================
Auth::routes();

Route::middleware('auth')->group(function(){
    Route::get('/','Frontend\PageController@home')->name('home');
    Route::get('/profile','Frontend\PageController@profile')->name('profile');
    Route::get('/profile/detail','Frontend\PageController@profiledetail')->name('profile-detail');
    Route::get('/update-paassword','Frontend\PageController@updatepassword')->name('update-password');
    Route::post('/update-password','Frontend\PageController@update')->name('update-password.updated');

    Route::get('/balance','Frontend\PageController@balance')->name('balance');

    Route::get('/transfer','Frontend\PageController@transfer')->name('transfer');
    Route::get('/transfer/comfirm','Frontend\PageController@transferConfirm')->name('transfer_confirm');
    Route::get('transfer/password-check','Frontend\PageController@PasswordCheck')->name('transfer_passwordcheck');
    Route::post('/transfer/complete','Frontend\PageController@transfercomplete')->name('transfer_complete');

    Route::get('/transaction','Frontend\PageController@transaction')->name('transaction');

    Route::get('/transfer-hash','Frontend\PageController@transferhash')->name('transfer_hash');

    Route::get('/QR','Frontend\PageController@qrcode')->name('qrcode');

    Route::get('/scan','Frontend\PageController@scan')->name('scan');
    Route::get('/scan/form','Frontend\PageController@scanForm')->name('scan-form');
    Route::get('/scan/confirm','Frontend\PageController@scanConfirm')->name('scan-confirm');
    Route::post('/scan/complete','Frontend\PageController@scanComplete')->name('scan-complete');
});
