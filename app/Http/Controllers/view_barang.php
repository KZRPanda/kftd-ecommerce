<?php

namespace App\Http\Controllers;

use App\Models\data_obat;
use App\Models\peakViews;
use App\Models\temp_pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class view_barang extends Controller
{
    public function view(Request $request){
        $id_obat = $request->id_obat;

        $data["obat"] = DB::table("data_obats")->join("kategoriobat","kategoriobat.id_kategori","=","data_obats.kategori")->where("id_obat","=",$id_obat)->get();

        return view("component.view_barang",$data);
    }

    public function jumlah(Request $request){
        $cek = temp_pesanan::where("username","=",$request->username)->where("id_obat","=",$request->id_obat)->first();

        if($request->id_file != "0"){
            if(!$cek){
                //$id = random_int(100,999);
                $hasil = temp_pesanan::insert(["id_obat"=>$request->id_obat,"id_file"=>$request->id_file,"nama_obat"=>$request->nama_obat,"username"=>$request->username,"jumlah"=>$request->jumlah,"harga"=>$request->harga,"total"=>$request->total]);
            }else{
                //$id = $cek[0]->id_pesanan;
                $hasil = temp_pesanan::where("username","=",$request->username)->where("id_obat","=",$request->id_obat)->update(["jumlah"=>$request->jumlah,"total"=>$request->total]);
            }
        }else{
            if(!$cek){
                //$id = random_int(100,999);
                $hasil = temp_pesanan::insert(["id_obat"=>$request->id_obat,"id_file"=>NULL,"nama_obat"=>$request->nama_obat,"username"=>$request->username,"jumlah"=>$request->jumlah,"harga"=>$request->harga,"total"=>$request->total]);
            }else{
                //$id = $cek[0]->id_pesanan;
                $hasil = temp_pesanan::where("username","=",$request->username)->where("id_obat","=",$request->id_obat)->update(["jumlah"=>$request->jumlah,"total"=>$request->total]);
            }
        }
        return $request;
    }

    public function peakview(Request $request){
        $kodeBarang = $request->kodeBarang;
        peakViews::insert(["id"=>NULL,"kode_obat"=>$kodeBarang]);
    }

    public function upload_surat(Request $request){
        $file = $request->file('upload_surat');
        $size = $request->file("upload_surat")->getSize();
        $id_obat = $request->id_obat;
        $id_file = rand(0,999999);
        $dataThis = DB::table("file_surat")->where("id_file","=",$id_file)->get();

        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/surat_keterangan';

        $kirim = false;

        while(true){
            if(count($dataThis) > 0){
                $id_file = rand(0,999999);
                $dataThis = DB::table("file_surat")->where("id_file","=",$id_file)->get();
            }else{
                $kirim = true;
                break;
            }
        }

        if($kirim){
            if($file->move($destinationPath,$fileName)){
                DB::table("file_surat")->insert(["nama_file"=>$fileName,"id_file"=>$id_file,"username"=>session()->get("id_user"),"id_obat"=>$id_obat]);
                //$hasilDb = DB::table('file_surat')->select()->get();
                //$hasilDb[13] = $id_file;
                return $id_file;
            }
    
            return true;
        }
    }
}
