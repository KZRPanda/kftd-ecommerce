<?php

namespace App\Http\Controllers;

use App\Models\data_obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dataBarang extends Controller
{
    public function cari(Request $request)
    {
        $temp = $request->queries;
        $jumlah = $request->jumlah;

        $data["data_pesanan"] = data_obat::where("nama_obat","like","%".$temp."%")->orWhere("id_obat","like","%".$temp."%")
        ->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")->paginate($jumlah);        
        
        //return $request;
        return view("admin.component.tb_dataBarang",$data);
    }
    public function dataBarangNextPrev(Request $request){
        $jumlah = $request->jumlah;
        $txt = $request->txt;
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->where("nama_obat","like","%".$txt."%")->orWhere("id_obat","like","%".$txt."%")->orderBy("nama_obat")->paginate($jumlah);
        return view("admin.component.tb_dataBarang",$data);
    }

}
