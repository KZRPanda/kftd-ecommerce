<?php

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api;
use App\Http\Controllers\pdfcontroller;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\DB;

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
    if(session()->get("id_user")){
        return redirect("/dashboard");
    }
    return view('login');
});

Route::post('/auth/login_test',[\App\Http\Controllers\login::class,'test_login'])->name('login');
//Route::get('/login/check',[\App\Http\Controllers\login::class,'login'])->name("login");

Route::group(["middleware"=>['authlogin']],function(){
    Route::get('/', function () {
        if(session()->get("id_user")){
            return redirect("/dashboard");
        }
        return view('login');
    });
});

Route::get('/staff',function(){
    return view('admin.login');
})->name("login_admin_view");

Route::post('/admin/login',[\App\Http\Controllers\admin::class,'login'])->name("login_admin");

Route::get('/registrasi',function(){
    $kec = (new api)->kecamatan_plg_all();
    $kel = DB::table('api_kelurahan_palembang')->join("api_kecamatan_palembang","api_kelurahan_palembang.id_kecamatan","=","api_kecamatan_palembang.id_kecamatan")->
    where("api_kecamatan_palembang.id_kecamatan","=","1")->get();
    
    $data["kec"] = $kec;
    $data["kel"] = $kel;
    return view("regisview",$data);
});

Route::get('pdf', [pdfcontroller::class, 'index']);
Route::get('/pdf/test',[pdfcontroller::class,'testing']);
Route::get('/pdf/faktur',[pdfcontroller::class,'faktur']);
Route::get('/fakturis/cetak/{nama}',[\App\Http\Controllers\fakturis::class,'cetaklaporan']);

Route::get('/regis/auth',[\App\Http\Controllers\signup::class,'cekdata']);
Route::post('/regis/daftar',[\App\Http\Controllers\signup::class,'daftar_akun'])->name("daftarakun");
Route::get('/auth/logout',[\App\Http\Controllers\login::class,'logout'])->name('auth.logout');

Route::get('peakView',[\App\Http\Controllers\view_barang::class,'peakview'])->name("peakview");

Route::get('/guest/dashboard',[\App\Http\Controllers\guest::class,'dashboard'])->name("guestDashboard");

Route::group(["middleware"=>['authFakturis']],function(){
    Route::get('/fakturis',function(){
        return view("fakturis");
    });
    Route::get('/fakturis/persetujuan/data',[\App\Http\Controllers\fakturis::class,'loadPersetujuan']);
    Route::get('/fakturis/persetujuan',[\App\Http\Controllers\fakturis::class,'persetujuan']);
    Route::get('/fakturis/persetujuan/tolak',[\App\Http\Controllers\fakturis::class,'tolakpesanan']);
    Route::get('/fakturis/laporan',[\App\Http\Controllers\fakturis::class,'laporan']);
    Route::get('/fakturis/datafaktur',[\App\Http\Controllers\fakturis::class,'datafaktur']);
    Route::get('/fakturis/datafaktur/cari',[\App\Http\Controllers\fakturis::class,'cariDataFaktur']);
    Route::get('/fakturis/laporan/bulanIni',[\App\Http\Controllers\fakturis::class,'reqdatabulan']);
    Route::get('/fakturis/persetujuan/setujui',[\App\Http\Controllers\fakturis::class,'setujui']);
    Route::get('/fakturis/datatransaksi',[\App\Http\Controllers\fakturis::class,'coba']);
    Route::get('/fakturis/logout',[\App\Http\Controllers\fakturis::class,'logout']);
});
Route::group(["middleware"=>['authLogistik']],function(){
    Route::get('/masterdata',function(){
        return view('admin.masterdata');
    });
    Route::get('/logistik/masterdata',function(){
        return view('logistik.masterdata');
    });
    Route::post('/masterdata/insert',[\App\Http\Controllers\masterdata::class,'insert']);
    Route::post('/masterdata/insert/csv',[\App\Http\Controllers\masterdata::class,'insertcsv'])->name("insertcsv");
    Route::post('/masterdata/update',[\App\Http\Controllers\masterdata::class,'update']);
    Route::get('/masterdata/delete',[\App\Http\Controllers\masterdata::class,'delete']);
    Route::get('/logistik/logout',[\App\Http\Controllers\logistik::class,'logout']);
    Route::get('/logistik',[\App\Http\Controllers\logistik::class,'index'])->name("logistik");
    Route::get('/pengirim',[\App\Http\Controllers\pengirim::class,"index"]);
    Route::get('/pengirim/regis',[\App\Http\Controllers\pengirim::class,"regis"]);
    Route::post('/pengirim/regis/buat_akun',[\App\Http\Controllers\pengirim::class,"regis_akun"])->name("regisakun");
    Route::get('/pengirim/login',[\App\Http\Controllers\pengirim::class,"login"]);
    Route::get('/logistik/pengiriman/buat',[\App\Http\Controllers\logistik::class,'buatPengiriman'])->name("buatPengiriman");
    Route::get('/logistik/pengiriman',[\App\Http\Controllers\logistik::class,'pengiriman']);
    Route::get('/logistik/pengiriman/reqdata',[\App\Http\Controllers\logistik::class,'reqdatakirim'])->name("reqdatakirim");
    Route::get('/logistik/persetujuan',[\App\Http\Controllers\logistik::class,'persetujuan']);
    Route::get('/logistik/persetujuan/tolak',[\App\Http\Controllers\logistik::class,'tolakPesanan']);
    Route::get('/logistik/persetujuan/load',[\App\Http\Controllers\logistik::class,'dataSetujuLoad']);
    Route::get('/logistik/persetujuan/setujui',[\App\Http\Controllers\logistik::class,'setujui']);
    Route::get('/logistik/persetujuan/data',[\App\Http\Controllers\logistik::class,'data_persetujuan'])->name("logistikPersetujuan");
    Route::get('/logistik/jadwal',[\App\Http\Controllers\logistik::class,'jadwal']);
    Route::get('/logistik/databarang',[\App\Http\Controllers\logistik::class,'dataBarang'])->name('lg_databarang');
    Route::get('/logistik/databarang/nextprev',[\App\Http\Controllers\logistik::class,'nextprev']);
    Route::get('/logistik/databarang/cari',[\App\Http\Controllers\logistik::class,'cari']);
    Route::get('/logistik/databarang/barangkosong',[\App\Http\Controllers\logistik::class,'barangkosong']);
    Route::post('/logistik/databarang/edit',[\App\Http\Controllers\logistik::class,'dataBarangEdit']);
    Route::get('/logistik/dataPesan',[\App\Http\Controllers\logistik::class,'dataPesan']);
    Route::get('/logistik/laporan',[\App\Http\Controllers\logistik::class,'laporan'])->name("laporan_logistik");

    Route::get('/logistik/laporan/bulanIni',[\App\Http\Controllers\logistik::class,'reqdatabulan']);
});

Route::get('/admin/loginpage',[\App\Http\Controllers\admin::class,"loginPage"]);

Route::group(["middleware"=>['authadmin']],function(){
    Route::get('/dataSetuju/view',[\App\Http\Controllers\dataSetuju::class,'reqdata']);
    Route::get('/admin/logout',[\App\Http\Controllers\admin::class,'logout']);
    Route::get('/containerAdmin/dashboard',[\App\Http\Controllers\dashboard_admin::class,'dashboard']);
    Route::get('/containerAdmin/dataBarang',[\App\Http\Controllers\dashboard_admin::class,'dataBarang']);
    Route::get('/containerAdmin/dataPesanan',[\App\Http\Controllers\dashboard_admin::class,'dataPesanan']);
    Route::get('/containerAdmin/dataPiutang',[\App\Http\Controllers\data_piutang::class,'index'])->name('datapiutangadmin');
    Route::get('/containerAdmin/suratKeterangan',[\App\Http\Controllers\dashboard_admin::class,'suratKeterangan']);
    Route::get('/containerAdmin/dataPersetujuan',[\App\Http\Controllers\dataSetuju::class,'dataSetujuView']);
    Route::get('/containerAdmin/akunuser',[\App\Http\Controllers\dashboard_admin::class,'akunuser'])->name("akunuser");
    Route::get('/containerAdmin/akunsetujui',[\App\Http\Controllers\dashboard_admin::class,'akunsetujui']);
    Route::get('/containerAdmin/suratKeterangan/sampahSK',[\App\Http\Controllers\dashboard_admin::class,'sampahSK']);
    Route::get('/dataBarang/nextprev',[\App\Http\Controllers\dashboard_admin::class,'dataBarangNextPrev']);
    // Route::get('/containerAdmin/dataPersetujuan',[\App\Http\Controllers\dashboard_admin::class,'dataPersetujuan']);

    Route::get('/dataPesan/prev',[\App\Http\Controllers\dataPesan::class,'dataPrev'])->name("dataPesanPrev");
    Route::get('/dataPesan/next',[\App\Http\Controllers\dataPesan::class,'dataNext'])->name("dataPesanNext");
    Route::get('/dataPesan/cari',[\App\Http\Controllers\dataPesan::class,'cari'])->name("dataPesanCari");
    
    Route::get('/dataSetuju/kodeBayar',[\App\Http\Controllers\dataSetuju::class,'kodeBayar']);
    Route::get('/dataSetuju/prev',[\App\Http\Controllers\dataSetuju::class,'prev']);
    Route::get('/dataSetuju/next',[\App\Http\Controllers\dataSetuju::class,'next']);
    Route::get('/dataSetuju/setujui',[\App\Http\Controllers\dataSetuju::class,'setujui']);
    Route::get('/dataSetuju/dataDibayar/setuju',[\App\Http\Controllers\dataSetuju::class,'setujuBayar']);
    Route::get('/dataSetuju/dataDisetujui',[\App\Http\Controllers\dataSetuju::class,'disetujuiView']);
    Route::get('/dataSetuju/dataDibayar',[\App\Http\Controllers\dataSetuju::class,'dibayar'])->name("dataDibayar");
    
    Route::get('/dataSetuju/tolakPesanan',[\App\Http\Controllers\dataSetuju::class,'tolakPesanan']);

    Route::get('/dataSetuju/load',[\App\Http\Controllers\dataSetuju::class,'dataSetujuLoad']);
    //Route::get('/dataBarang/nextprev',[\App\Http\Controllers\dashboard_admin::class,'dataBarangNextPrev']);

    Route::get('/viewDatapesan',[\App\Http\Controllers\dashboard_admin::class,'viewDatapesan'])->name('view_datapesan');

    Route::get('/dataBarang',[\App\Http\Controllers\dashboard_admin::class,'dataBarang_page']);
    Route::get('/dataBarang/cari',[\App\Http\Controllers\dataBarang::class,'cari'])->name("db_cari");

    //setujui akun
    Route::get('/accakun/aksi',[\App\Http\Controllers\dashboard_admin::class,"setujuakun"]);


    //data paling laku
    Route::get('/palingLaku/all',[\App\Http\Controllers\dashboard_admin::class,'palingLaku_all'])->name("palingLaku_all");
    Route::get('/palingLaku/bulan',[\App\Http\Controllers\dashboard_admin::class,'palingLaku_bulan'])->name("palingLaku_bulan");
    Route::get('/palingLaku/minggu',[\App\Http\Controllers\dashboard_admin::class,'palingLaku_minggu'])->name("palingLaku_minggu");

    Route::get('/cari_obat',[\App\Http\Controllers\dashboard_admin::class,'cariObat']);
    Route::get('/request/sk',[\App\Http\Controllers\requestData::class,'sk']);
    Route::get('/request/skbaru',[\App\Http\Controllers\requestData::class,'skbaru']);
    Route::get('/admin',[\App\Http\Controllers\login::class,'adminLogin'])->name("adminLogin");

});

Route::group(["middleware"=>['authcheck']],function(){
    //container admin
    //dashboard user
    Route::get('/dashboard',[\App\Http\Controllers\login::class,'dashboard'])->name("dashboard"); 

    Route::get('/myship/dashboard',function(){
        return view("component.shipping.myship");
    })->name("myship");

    Route::get('/dibaca',[\App\Http\Controllers\dashboard::class,'dibaca']);

    //aksi checkout
    Route::get('/checkput/pesan',[\App\Http\Controllers\checkout::class,'pesanBarang'])->name('pesanBarang');
    Route::get('/checkout/update',[\App\Http\Controllers\checkout::class,'update_checkout'])->name('update_checkout');
    Route::get('/checkout/dashboard',[\App\Http\Controllers\checkout::class,'checkout'])->name('checkout');
    Route::get('/checkout/delete',[\App\Http\Controllers\checkout::class,'delete'])->name('delete');

    Route::get('/view/barang',[\App\Http\Controllers\view_barang::class,'view'])->name('view');
    Route::get('/view/jumlah',[\App\Http\Controllers\view_barang::class,'jumlah'])->name('view-jumlah');

    Route::get('/myship/ship',[\App\Http\Controllers\ship::class,'ship'])->name("ship");   
    Route::get('/myship/persetujuan',[\App\Http\Controllers\ship::class,'persetujuan'])->name('persetujuan');
    Route::get('/myship/belumbayar',[\App\Http\Controllers\ship::class,'belumbayar'])->name('belumbayar');
    Route::get('/myship/dikirim',[\App\Http\Controllers\ship::class,'dikirim'])->name('dikirim');
    Route::get('/myship/selesai',[\App\Http\Controllers\ship::class,'selesai'])->name('selesai');
    Route::get('/myship/batal',[\App\Http\Controllers\ship::class,'batal'])->name('batal');
    Route::get('/myship/batalpesan',[\App\Http\Controllers\ship::class,'batalpesan'])->name('batalpesan');
    Route::get('/myship/cekPesanan',[\App\Http\Controllers\ship::class,'cekPesanan'])->name('cekPesanan');
    Route::post('/myship/kirimbukti',[\App\Http\Controllers\ship::class,'kirimbukti'])->name('kirimBukti');

    Route::get('/home',[\App\Http\Controllers\dashboard::class,"home"]);
    Route::get('/data/input',[\App\Http\Controllers\profil::class,'input_data'])->name('input_data');

    Route::get('/cari',[\App\Http\Controllers\dashboard::class,'cari'])->name('cari');
    Route::get('/recomend',[\App\Http\Controllers\dashboard::class,'rekomend'])->name('recomend');
    Route::get('/cari/all',[\App\Http\Controllers\dashboard::class,'cari_all'])->name('cari_all');
    Route::get('/profil/user',[\App\Http\Controllers\profil::class,'tampil_profil'])->name("tampil_profil");
    Route::get('/x',[\App\Http\Controllers\dashboard::class,'tempThis']);
});

Route::get('/test',[\App\Http\Controllers\dashboard::class,'test'])->name('test');

//Route::post('/kirim',[\App\Http\Controllers\upload_excel::class,'upload_file'])->name('upload_file');
Route::post('/kirim',[\App\Http\Controllers\view_barang::class,'upload_surat'])->name('upload_surat');
Route::post('/insert/kirim',[\App\Http\Controllers\upload_excel::class,'upload_file']);
Route::get('/hello',function(){
    return view('import_csv.index');
});


Route::get('/map',function(){
    return view('component.profil.map');
});

Route::post('/testing',[\App\Http\Controllers\dashboard::class,"test"])->name("test");

Route::get('/show-modal',[\App\Http\Controllers\modal::class,'show_modal'])->name('show_modal');