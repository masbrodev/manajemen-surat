<?php

use Illuminate\Support\Facades\Route;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
    return view('welcome');
});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('suratmasuk', 'SuratMasukController');
Route::post('upload_berkas', 'SuratMasukController@upload_berkas');
Route::get('get_berkas/{id}', 'SuratMasukController@get_berkas');
Route::post('del_berkas', 'SuratMasukController@del_berkas');
Route::get('printsm/{id}', 'SuratMasukController@print');

Route::resource('suratkeluar', 'SuratKeluarController');
