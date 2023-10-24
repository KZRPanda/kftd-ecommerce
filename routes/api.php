<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get("data/{data}",[\App\Http\Controllers\api::class,"cari"])->name("cari");
Route::get("cari_obat/",[\App\Http\Controllers\api::class,"cari_obat"])->name("cari_obat");

Route::get("kelurahan/all",[\App\Http\Controllers\api::class,"kelurahan_plg_all"])->name("api_kelurahan_all");
Route::get("kecamatan/all",[\App\Http\Controllers\api::class,"kecamatan_plg_all"])->name("api_kecamatan_all");
Route::get("kelurahan/where",[\App\Http\Controllers\api::class,"kelurahan_plg"])->name("api_kelurahan");

Route::get("data_login",[\App\Http\Controllers\api::class,"get_data_login"])->name("data_login");

Route::get("dataContain/editData",[\App\Http\Controllers\api::class,"editData"])->name("editData");

Route::get("/test/data_login",[\App\Http\Controllers\api::class,"test_data_login"])->name("test_data_login");

Route::get('dataBarang/cari',[\App\Http\Controllers\dataBarang::class,'cari'])->name("db_cari");

Route::get('admin/cekLogin',[\App\Http\Controllers\admin::class,'login']);

Route::get("file/sudahBaca",[\App\Http\Controllers\dashboard_admin::class,"sudahBaca"])->name("sudahbaca");

Route::get("/masterdata/all",[\App\Http\Controllers\masterdata::class,'index']);
Route::get("/masterdata/cari",[\App\Http\Controllers\masterdata::class,'cari']);

Route::get("generate/kodePesanan",[\App\Http\Controllers\generateKode::class,'kodePesanan']);
Route::get("generate/kodeKirim",[\App\Http\Controllers\generateKode::class,'kodePengiriman']);
Route::get("generate/id_pengirim",[\App\Http\Controllers\generateKode::class,'idpengirim']);