<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dataPesan extends Controller
{
    public function dataPrev(Request $request){
        $data["data_pesanan"] = DB::table("data_pesanan")->selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->groupBy("id_pesanan")->orderBy("waktu")->paginate(10);
        return view("admin.component.tb_dataPesan",$data);
    }
    public function dataNext(Request $request){
        $data["data_pesanan"] = DB::table("data_pesanan")->selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->groupBy("id_pesanan")->orderBy("waktu")->paginate(10);
        return view("admin.component.tb_dataPesan",$data);
    }

    public function cari(Request $request)
    {
        $txt = "";
        $limit = "";
        $tipe = "";
        $alltipe = ["id_pesanan","waktu"];

        if(isset($request)){
            $txt = $request->txt;
            $limit = $request->limit;
            $tipe = $request->tipe;
            $up = $request->up;

            if($tipe == "2"){
                if($up == "true"){
                    $data["data_pesanan"] = DB::table("data_pesanan")->
                    selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->
                    where("id_pesanan","like",'%'.$txt.'%')->groupBy("id_pesanan")->orderBy("total")->paginate($limit);
                }else if($up == "false"){
                    $data["data_pesanan"] = DB::table("data_pesanan")->
                    selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->
                    where("id_pesanan","like",'%'.$txt.'%')->groupBy("id_pesanan")->orderByDesc("total")->paginate($limit);
                }
            }else{
                if($up == "true"){
                    $data["data_pesanan"] = DB::table("data_pesanan")->
                    selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->
                    where("id_pesanan","like",'%'.$txt.'%')->groupBy("id_pesanan")->orderBy($alltipe[(int)$tipe])->paginate($limit);
                }else if($up == "false"){
                    $data["data_pesanan"] = DB::table("data_pesanan")->
                    selectRaw("id_pesanan,nama_status,username,waktu,sum(harga_pesanan) as total")->
                    where("id_pesanan","like",'%'.$txt.'%')->groupBy("id_pesanan")->orderByDesc($alltipe[(int)$tipe])->paginate($limit);
                }
            }

            return view("admin.component.tb_dataPesan",$data);
        }

        return 0;
    }

}
