<?php

namespace App\Http\Controllers;

use App\Models\pesan_barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use App\Models\datapengirim;

class generateKode extends Controller
{
    public function kodePesanan()
    {
        $tgl = date("ymd");
        do {
            $id_pesanan = $tgl.rand(0,99999);
            $check = pesan_barang::where("id_pesanan","=",$id_pesanan)->first();
        } while ($check);  

        return $id_pesanan;
    }

    public function kodePengiriman(){
        $tgl = date("ymd");
        do {
            $kodePengiriman = $tgl.rand(0,99999);
            $check = DB::table("pengiriman")->select()->where("kode_pengiriman","=",$kodePengiriman)->first();
        } while ($check);  

        return $kodePengiriman; 
    }

    public function idpengirim()
    {
        do {
            $kode = rand(0,99999);
            $check = datapengirim::select()->where("id_pengirim","=",$kode)->first();
            //$check = DB::table("pengiriman")->select()->where("kode_pengiriman","=",$kodePengiriman)->first();
        } while ($check);  

        return $kode;
    }
}
