<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\data_obat;

class api extends Controller
{
    public function cari($data){
        $hasil["data"] = DB::table("rincian_barang")->select(["kode_barang","nama_barang"])->where("nama_barang","like","%".$data."%")->get();
        return $hasil["data"];
    }

    public function cari_obat(Request $data){
        $hasil["barang"] = data_obat::where("nama_obat","like","%".$data->queries."%")->orWhere("id_obat","like","%".$data->queries."%")
        ->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->get();
        //DB::table("as")->where()->orWhere()
        return $hasil;
    }

    public function kecamatan_plg_all(){
        $hasil["kecamatan"] = DB::table('api_kecamatan_palembang')->get();
        return $hasil;
    }

    public function kelurahan_plg_all(){
        $hasil["kelurahan"] = DB::table('api_kelurahan_palembang')->select(["nama_kelurahan"])->get();
        return $hasil["kelurahan"];
    }

    public function kelurahan_plg(Request $data){
        $kecamatan = $data->id_kecamatan;
        $hasil["kecamatan"] = $kecamatan;
        
        $hasil["kelurahan"] = DB::table('api_kelurahan_palembang')
        ->join("api_kecamatan_palembang","api_kelurahan_palembang.id_kecamatan","=","api_kecamatan_palembang.id_kecamatan")->
        where("api_kecamatan_palembang.id_kecamatan","=",$kecamatan)->get();
            // ->select(["api_kecamatan_palembang.id_kecamatan", "api_kecamatan_palembang.nama_kecamatan","api_kelurahan_palembang.nama_kelurahan"])
            // ->leftJoin("api_kecamatan_palembang","api_kelurahan_palembang.id_kecamatan","=","api_kecamatan_palembang.id_kecamatan")
            // ->where("api_kecamatan_palembang.id_kecamatan","=",$kecamatan)
            // ->get();
        return $hasil;
    }

    public function get_data_login(){
        $data["users_login"] = DB::table("user_login")->paginate(5);
        return view("admin.tabel_login",$data);
    }

    public function test_data_login(){
        $data["users_login"] = DB::table("user_login")->paginate(2);
        return $data["users_login"];   
    }

    public function editData(Request $request){
        $nama = $request->nama;
        $kode = $request->kode;
        $harga = $request->harga;
        $kate = $request->kate;

        DB::table("data_obats")->where("id_obat","=",$kode)->update(["id_obat"=>$kode,"nama_obat"=>$nama,"harga"=>$harga,"kategori"=>$kate]);
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")->paginate(10);
        return view("admin.component.tb_dataBarang",$data);
    }
}
