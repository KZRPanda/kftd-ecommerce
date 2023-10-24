<?php

namespace App\Http\Controllers;

use App\Models\data_obat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;

class dashboard_admin extends Controller
{
    public function palingLaku_bulan(){
        $data["jum_pesan"] = DB::table("pesan_barangs")->selectRaw('id_obat,nama_obat,sum(jum_pesanan) as jum_pesan')->
            rightJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")->
            whereRaw("statuses.waktu_pesan between current_date - (DAY(current_date) - 1) and current_date + 1")->
            orderByDesc("jum_pesan")->groupBy(["id_obat","nama_obat"])->limit(5)->get();
        
        $data["status"] = "Berhasil";

        if(count($data["jum_pesan"]) < 1){
            $data["status"] = "Gagal";
            return view("admin.component.paling_laku",$data);
        }
        return view("admin.component.paling_laku",$data);
    }

    public function palingLaku_minggu(){
        $data["jum_pesan"] = DB::table("pesan_barangs")->selectRaw('id_obat,nama_obat,sum(jum_pesanan) as jum_pesan')->
            rightJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")->
            whereRaw("statuses.waktu_pesan between DATE(CURRENT_DATE - dayofweek(CURRENT_DATE - 1)) AND CURRENT_DATE + 1")->
            orderByDesc("jum_pesan")->groupBy(["id_obat","nama_obat"])->limit(5)->get();
            
        $data["status"] = "Berhasil";

        if(count($data["jum_pesan"]) < 1){
            $data["status"] = "Gagal";
            return view("admin.component.paling_laku",$data);
        }

        return view("admin.component.paling_laku",$data);
    }

    public function palingLaku_all(){
        $data["jum_pesan"] = DB::table("pesan_barangs")->
        selectRaw('id_obat,nama_obat,sum(jum_pesanan) as jum_pesan')->orderByDesc("jum_pesan")->
        groupBy(["id_obat","nama_obat"])->limit(5)->get();

        $data["status"] = "Berhasil";

        if(count($data["jum_pesan"]) < 1){
            $data["status"] = "Gagal";
            return view("admin.component.paling_laku",$data);
        }

        return view("admin.component.paling_laku",$data);
    }

    public function dashboard(){
        $data["jenis_b"] = DB::table("data_obats")->count("*");
        $data["users"] = DB::table("users")->count("*");
        $data["users_login"] = DB::table("user_login")->paginate(5);
        $data["jum_pesan"] = DB::table("pesan_barangs")->
        selectRaw('id_obat,nama_obat,sum(jum_pesanan) as jum_pesan')->orderByDesc("jum_pesan")->
        groupBy(["id_obat","nama_obat"])->limit(5)->get();
        $total = DB::table("statuses")->sum("total_pesanan");
        $data["barang_seminggu"] = DB::table("barang_seminggu")->sum("jum_pesanan");
        $temp = "";

        if(($total / 1000 >= 1) && ($total / 1000 <= 999)){
            $temp = ["total" => round($total / 1000),"j"=>"K"];
            //echo round($total / 1000)." K";
        }else if(($total / 1000000 >= 1) && ($total / 1000000 <= 999)){
            $temp = ["total" => round($total / 1000000),"j"=>"MILLION"];
            //echo round($total / 1000000)." MILLION";
        }
        
        $data["tot"] = $temp;

        //print_r($data["tot"]);
        
        return view("admin.dashboard",$data);
    }

    public function dataBarang(){
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")
        ->paginate(15);
        return view("admin.dataBarang",$data);
    }

    public function dataPesanan(){
        $data["data_pesanan"] = DB::table("data_pesanan")->selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->groupBy("id_pesanan")->orderBy("waktu")->paginate(10);
        return view("admin.dataPesanan",$data);
    }

    public function suratKeterangan(){
        $data["surats"] = DB::table("surat_detail")->get();
        return view("admin.suratKeterangan",$data);    
    }

    public function dataPersetujuan(){
        // $data["x"] = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
        // ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        // ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")
        // ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
        // where("statuses.status","=","1")->where("pesan_barangs.id_file","!=",NULL)->groupBy("id_pesanan")->orderBy("waktu")->get();
        
        // $data["y"] = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
        // ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        // ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
        // ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
        // where("statuses.status","=","1")->where("pesan_barangs.id_file","=",NULL)->groupBy("id_pesanan")->orderBy("waktu")->get();
        // $data["data_pesanan"] = [];
        // $xy = "";
        // $z = [];
        // $p = [];
        // $temp = false;

        // foreach ($data["x"] as $key) {
        //     if(in_array($key->id_pesanan,$z)){

        //     }{
        //         array_push($z,$key->id_pesanan);
        //         array_push($data["data_pesanan"],$key);
        //     }
        // }

        // foreach ($data["y"] as $key){
        //     if(in_array($key->id_pesanan,$z)){ 
        //     }else{
        //         array_push($data["data_pesanan"],$key);  
        //     }
        // }

        //$data["dataAll"] = print_r($data["data_pesanan"]);

        //return $data["dataAll"];
        //$data["data_pesanan"] = $p;
        return view("admin.dataPersetujuan");
    }


    public function dataBarang_page(){
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")->paginate(10);
        return view("admin.component.tb_dataBarang",$data);
    }

    public function dataBarangNextPrev(Request $request){
        $jumlah = $request->jumlah;
        $txt = $request->txt;
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->where("nama_obat","like","%".$txt."%")->orWhere("id_obat","like","%".$txt."%")->orderBy("nama_obat")->paginate($jumlah);
        return view("admin.component.tb_dataBarang",$data);

    }

    public function cariObat(Request $request){
        $temp = $request->queries;
        $data["data_pesanan"] = data_obat::where("nama_obat","like","%".$temp."%")->orWhere("id_obat","like","%".$temp."%")
        ->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")->paginate(10);        
        return view("admin.component.tb_dataBarang",$data);
    }

    public function viewDatapesan(Request $request){
        $temp = $request->id;

        $data["data_pesanan"] = DB::table("data_pesanan")->selectRaw("nama_obat,harga_pesanan,jum_pesanan")->where("id_pesanan","=",$temp)->get();
        return view("admin.component.tb_viewdataPesanan",$data);
    }
    
    public function sudahBaca(Request $request){
        $id_file = $request->id_file;

        $data = DB::table("file_surat")->where("id_file","=",$id_file)->get();

        DB::table("sampah_sk")->insert(["no_urut"=>NULL,"id_file"=>$data[0]->id_file,"nama_file"=>$data[0]->nama_file,
        "username"=>$data[0]->username,"id_obat"=>$data[0]->id_obat,"waktu"=>NULL]);

        DB::table("file_surat")->where("id_file","=",$id_file)->delete();

        return $data;
    }

    public function sampahSK(){
        $data["surats"] = DB::table("sampah_surat")->get();
        return view("admin.component.sampahSK",$data);    
    }

    public function akunuser()
    {
        $data["akun"] = DB::table("users")->select()
        ->where("acc","=","1")
        ->get();
        return view("admin.akun_user",$data);
    }
    public function akunsetujui()
    {
        $data["akun"] = DB::table("users")->select()
        ->where("acc","=","0")
        ->get();
        return view("admin.akunsetujui",$data);
    }

    public function setujuakun(Request $request)
    {
        $username = $request->username;
        $aksi = $request->aksi;

        if($aksi == "setuju"){
            $acc = "1";
        }else{
            $acc = "3";
        }

        $setujui = DB::table("users")->where("username","=",$username)->update(["acc"=>$acc]);
        $data["akun"] = DB::table("users")->select()
        ->where("acc","=","0")
        ->get();

        return view("admin.component.tb_akunsetujui",$data);
    }
}
