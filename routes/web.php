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

// use App\Mail\UserNotification;
// use Illuminate\Support\Facades\Mail;

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/scan', 'ScannerController@index')->name('scan');
Route::get('/scan-otp', 'ScannerController@scan_otp')->name('scan_otp');
Route::get('/request-otp', 'ScannerController@request_otp')->name('request');