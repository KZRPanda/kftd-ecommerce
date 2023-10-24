<?php

namespace App\Http\Controllers;

use App\Models\pesan_barang;
use App\Models\status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ship extends Controller
{
    public function ship(){
        $id_user = session()->get("id_user");
        $data["pesanan"] = DB::table("data_pesanan")->select(["data_pesanan.*","data_obats.gambar"])
        ->leftJoin("data_obats","data_pesanan.nama_obat","data_obats.nama_obat")
        ->where("username","=",$id_user)->orderByDesc("waktu")->get();
        $data["length"] = count($data["pesanan"]);
        $result = array();

        foreach($data["pesanan"] as $item){
            $result[$item->id_pesanan][] = $item;
        }

        $data["result"] = $result;
        return view("component.shipping.component.semua",$data); 
    }

    public function persetujuan(){
        $id_user = session()->get("id_user");
        $data["pesanan"] = DB::table("data_pesanan")
        ->select(["data_pesanan.*","data_obats.gambar"])
        ->leftJoin("data_obats","data_pesanan.nama_obat","data_obats.nama_obat")
        ->where("status","=","1")->where("username","=",$id_user)
        ->orderByDesc("waktu")->get();
        $data["length"] = count($data["pesanan"]);
        $result = array();

        foreach($data["pesanan"] as $item){
            $result[$item->id_pesanan][] = $item;
        }

        $data["result"] = $result;
    
        return view("component.shipping.component.semua",$data); 
    }

    public function belumbayar(){
        $id_user = session()->get("id_user");
        $data["pesanan"] = DB::table("data_pesanan")
        ->select(["data_pesanan.*","data_obats.gambar"])
        ->leftJoin("data_obats","data_pesanan.nama_obat","data_obats.nama_obat")
        ->where("status","=","2")->where("username","=",$id_user)
        ->orderByDesc("waktu")->get();
        $data["length"] = count($data["pesanan"]);
        $result = array();

        foreach($data["pesanan"] as $item){
            $result[$item->id_pesanan][] = $item;
        }

        $data["result"] = $result;
        
        //print_r($data["result"]);
        return view("component.shipping.component.semua",$data); 
    }
    public function dikirim(){
        $id_user = session()->get("id_user");
        $data["pesanan"] = DB::table("data_pesanan")
        ->select(["data_pesanan.*","data_obats.gambar"])
        ->leftJoin("data_obats","data_pesanan.nama_obat","data_obats.nama_obat")
        ->where("status","=","3")->where("username","=",$id_user)
        ->orderByDesc("waktu")->get();
        
        $data["length"] = count($data["pesanan"]);
        $result = array();

        foreach($data["pesanan"] as $item){
            $result[$item->id_pesanan][] = $item;
        }

        $data["result"] = $result;
    
        return view("component.shipping.component.semua",$data); 
    }
    public function selesai(){
        $id_user = session()->get("id_user");
        $data["pesanan"] = DB::table("data_pesanan")
        ->select(["data_pesanan.*","data_obats.gambar"])
        ->leftJoin("data_obats","data_pesanan.nama_obat","data_obats.nama_obat")
        ->where("status","=","4")->where("username","=",$id_user)
        ->orderByDesc("waktu")->get();
        $data["length"] = count($data["pesanan"]);
        $result = array();

        foreach($data["pesanan"] as $item){
            $result[$item->id_pesanan][] = $item;
        }

        $data["result"] = $result;
    
        return view("component.shipping.component.semua",$data); 
    }
    public function batalpesan(Request $request){
        $dataTemp = DB::table("pesan_barangs")->select(["jum_pesanan","id_obat"])->where("id_pesanan","=",$request->id)->get();
        //return $dataTemp;
        $xx = [];
        foreach ($dataTemp as $key) {
            $dataobt = DB::table("data_obats")->select(["stok"])
            ->where("id_obat","=",$key->id_obat)
            ->get();

            $jumTotal = intval($dataobt[0]->stok) + intval($key->jum_pesanan);
            //array_push($xx,["stok awal" => $dataobt,"jum beli" => $key->jum_pesanan]);
            $ubah = DB::table("data_obats")
            ->where("id_obat","=",$key->id_obat)
            ->update(["stok"=>$jumTotal]);

            if($ubah){

            }else{
                return "error";
            }
        }
        //return $xx;
        if((strlen($request->id) > 0 and $ubah)){
            $hapus = DB::table("statuses")->where("id_pesanan","=",$request->id)->update(["status"=>5]); 
            //DB::select("call hapus_pesanan(".$request->id.")");
            return "200";
        }
        return $request;
    }

    public function batal(Request $request){
        $id_user = session()->get("id_user");
        

        //$data["pesanan"] = DB::table("data_pesanan")->select(["*"])->where("username","=",$id_user)->where("status","=","5")->orderByDesc("waktu")->get();
        $data["pesanan"] = DB::table("data_pesanan")
        ->select(["data_pesanan.*","data_obats.gambar"])
        ->leftJoin("data_obats","data_pesanan.nama_obat","data_obats.nama_obat")
        ->where("status","=","5")->where("username","=",$id_user)
        ->orderByDesc("waktu")->get();

        $data["length"] = count($data["pesanan"]);
        $result = array();

        foreach($data["pesanan"] as $item){
            $result[$item->id_pesanan][] = $item;
        }

        $data["result"] = $result;
    
        return view("component.shipping.component.semua",$data); 
    }

    public function kirimbukti(Request $request){
        $id_pesanan = $request->id_pesanan;
        $file = $request->file('upload_bukti');
        $size = $request->file("upload_bukti")->getSize();


        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/bukti_pembayaran';

        //$kirim = DB::table("bukti_pembayaran")->insert(["id_pesanan"=>$id_pesanan,"file_bukti"=>$fileName,"username"=>"asep"]);
        if($file->move($destinationPath,$fileName)){
            $kirim = DB::table("bukti_pembayaran")->insert(["id_pesanan"=>$id_pesanan,"file_bukti"=>$fileName,"username"=>session()->get("id_user")]);
            if($kirim){
                DB::table("pembayaran")->where("id_pesanan","=",$id_pesanan)->update(["dibayar"=>1]);
                //DB::table("statuses")->where("id_pesanan","=",$id_pesanan)->update(["status"=>"3"]);
                return "true";
            }else{
                return "false";
            }
        }
        return $request;
    }

    public function cekPesanan(Request $request){
        $id = $request->id_pesanan;
        //$id = "882199";
        $temp = DB::table("datapengiriman")->select()
        ->where("id_pesanan","=",$id)->orderByDesc("tgl_proses")->get();

        $dataTemp = [];
        $dataTemp = [
            "username"=>$temp[0]->username,
            "id_pesanan"=>$temp[0]->id_pesanan,
            "tgl_pesan"=>$temp[0]->tgl_pesan
        ];

        foreach ($temp as $key) {
            array_push($dataTemp,$key);
        }
        $data["dataAll"]= $dataTemp;
        //return sizeof($data["dataAll"]);
        return view("component.shipping.component.cekPesanan",$data);
    }
}
