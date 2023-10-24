<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_obat;
use App\Models\foto_profil;
use Illuminate\Support\Facades\DB;

class dashboard extends Controller
{
    public function cari(Request $data){
        if(($data->teks != "") and ($data->kategori == null)){
            //DB::table("data_obats")->select("*")->leftJoin("kategoriobat","kategoriobat.id_kategori","=","data_obats.kategori")
            $all = DB::table("data_obats")->select(["data_obats.*","kategoriobat.kategori as kategoriobat"])
            ->leftJoin("kategoriobat","kategoriobat.id_kategori","=","data_obats.kategori")
            ->where("nama_obat","like","%".$data->teks."%")
            ->where("stok",">","0")
            ->get();
            $hasil["barang"] = $all;
            return $hasil;
        }
        else if(($data->teks == "" or $data->teks == " ") and ($data->kategori == null)){
            $all = DB::table("data_obats")->select(["data_obats.*","kategoriobat.kategori as kategoriobat"])
            ->leftJoin("kategoriobat","kategoriobat.id_kategori","=","data_obats.kategori")
            ->where("nama_obat","like","%".$data->teks."%")
            ->where("stok",">","0")
            ->get();
            $hasil["barang"] = $all;
            return $hasil;
        }
        else{
            $kategories = explode(',',$data->kategori);
            $temp = [];
            $temp1 = "";
            $all = "";
            for($i = 0;$i < count($kategories);$i++){
                $temp1 = data_obat::
                select(["data_obats.*","kategoriobat.kategori as kategoriobat"])->where("nama_obat","like","%".$data->teks."%")->
                leftJoin("kategoriobat","kategoriobat.id_kategori","=","data_obats.kategori")->
                where("data_obats.kategori","=",$kategories[$i])
                ->where("stok",">","0")
                ->get();

                if($temp1 == "[]" and count($kategories) == 1){
                    return ["error"=>"tidak ada data"];
                }

                if(strlen(json_encode($temp1,true)) > 2){
                    array_push($temp,$temp1);
                }
            }
            
            if(count($temp) > 1){
                $all = substr($temp[0],0,-1);

                for($i = 1; $i < count($temp) - 1; $i++){
                    $all = $all.",".substr($temp[$i],1,(strlen($temp[$i])-2));
                }
    
                $all = $all.",".substr($temp[count($temp) - 1],1,strlen($temp[count($temp) - 1]));
            }else if(count($temp) <= 1){
                $all = json_encode($temp[0]);
            }

            $hasil["barang"] = json_decode($all);
        }
        $hasil["temp"] = $data;
        return $hasil;
    }

    public function rekomend(Request $data){
        if(($data->teks != "") and ($data->kategori == "")){
            $hasil["barang"] = data_obat::where("nama_obat","like","%".$data->teks."%")->limit(5)->get();
            return view("component.rekomendasi_pencarian",$hasil);
        }else{
            $kategories = explode(',',$data->kategori);

            if(count($kategories) == 1){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                limit(5)->get();
            }
            else if(count($kategories) == 2){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                orwhere("kategori","=",$kategories[1])->
                limit(5)->get();
            }
            else if(count($kategories) == 3){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                orwhere("kategori","=",$kategories[1])->
                orwhere("kategori","=",$kategories[2])->
                limit(5)->get();
            }
            else if(count($kategories) == 4){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                orwhere("kategori","=",$kategories[1])->
                orwhere("kategori","=",$kategories[2])->
                orwhere("kategori","=",$kategories[3])->
                limit(5)->get();
            }
            else if(count($kategories) == 5){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                orwhere("kategori","=",$kategories[1])->
                orwhere("kategori","=",$kategories[2])->
                orwhere("kategori","=",$kategories[3])->
                orwhere("kategori","=",$kategories[4])->
                limit(5)->get();
            }
            else if(count($kategories) == 6){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                orwhere("kategori","=",$kategories[1])->
                orwhere("kategori","=",$kategories[2])->
                orwhere("kategori","=",$kategories[3])->
                orwhere("kategori","=",$kategories[4])->
                orwhere("kategori","=",$kategories[5])->
                limit(5)->get();
            }
            else if(count($kategories) == 7){
                $hasil["barang"] = data_obat::
                select("*")->where("nama_obat","like","%".$data->teks."%")->
                where("kategori","=",$kategories[0])->
                orwhere("kategori","=",$kategories[1])->
                orwhere("kategori","=",$kategories[2])->
                orwhere("kategori","=",$kategories[3])->
                orwhere("kategori","=",$kategories[4])->
                orwhere("kategori","=",$kategories[5])->
                orwhere("kategori","=",$kategories[6])->
                limit(5)->get();
            }

            return view("component.rekomendasi_pencarian",$hasil);
        }
        $hasil["temp"] = $data;
    }

    public function test(Request $request){
        $file = $request->file('temp');
        $size = $request->file("temp")->getSize();
        //$tipe = $file->get_resource_type();
        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images' ;

        $check_prof = foto_profil::where("username","=",session()->get("id_user"))->first();


        if($size <= 2194304){
            if($file->move($destinationPath,$fileName)){
                if(!$check_prof){
                    $update = DB::table("foto_profils")->insert(["id_foto"=>NULL,"username"=>session()->get("id_user"),"nama_foto"=>$fileName]);
                }else{
                    $update = DB::table("foto_profils")->where("username","=",session()->get("id_user"))->update(["nama_foto"=>$fileName]);
                }
                if($update){
                    return "success";
                }
                return "failed";
            }else{
                return "failed";
            }
        }else{
            return "img>2";
        }

        return $size;
    }

    public function cari_all(Request $data){
        $hasil["barang"] = DB::table('data_obat')->select("*")->where("nama_obat","like","%".$data->teks."%")->get();
        return view("component.hasil_pencarian",$hasil);
    }

    public function profil_user(){
        $hasil["kecamatan"] = DB::table('api_kecamatan_palembang')->get();
        $hasil["kelurahan"] = DB::table('api_kelurahan_palembang')->where("id_kecamatan","=","1")->get();
        return view("component.profil.profil",$hasil);
    }

    public function home(){
        $data["palingDicari"] = DB::table("peakview")->select("*")->limit(5)->get();
        //return $data["palingDicari"];
        return view("component.isi_dashboard",$data);
    }

    public function tempThis(Request $request){
        $all["data"]=  $request->data;
        $all["kategori"] = $request->kategori;

        //print_r($all["data"]);
        return view("component.hasil_pencarian",$all);
    }

    public function dibaca(Request $request)
    {
        $id = $request->id;

        DB::table("notifs")->where("id_pesanan","=",$id)->update(["dibaca"=>1]);
    }
}
