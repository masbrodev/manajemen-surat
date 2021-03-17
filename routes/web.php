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

Route::get('/a', function () {
     Toastr::success('Messages in here', 'Title', ["positionClass" => "toast-top-center"]);
    return view('pages.produk');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('kategori', 'KategoriController@index');
Route::post('kategori/tambah', 'KategoriController@tambah');
Route::post('kategori/edit/{id}', 'KategoriController@edit');
Route::get('kategori/hapus/{id}', 'KategoriController@hapus');

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('suratmasuk', 'SuratMasukController');
Route::post('upload_berkas', 'SuratMasukController@upload_berkas');
Route::get('get_berkas/{id}', 'SuratMasukController@get_berkas');
Route::post('del_berkas', 'SuratMasukController@del_berkas');

Route::resource('suratkeluar', 'SuratKeluarController');
