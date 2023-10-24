<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class signup extends Controller
{
    function cekdata(Request $request){
        $tipe = $request->tipe;
        $data = $request->data;

        if($tipe == "username"){
            $cek = DB::table("users")->select("*")->where("username","=",$data)->get();
            //return strlen($cek);
            if(strlen($cek) <= 2){
                return ["kode"=>"0","msg"=>"data tidak ada"];
            }else{
                return ["kode"=>"1","msg"=>"data sudah ada"];
            }
        }

        else if($tipe == "email"){
            $cek = DB::table("users")->select("*")->where("email","=",$data)->get();
            //return strlen($cek);
            if(strlen($cek) <= 2){
                return ["kode"=>"0","msg"=>"data tidak ada"];
            }else{
                return ["kode"=>"1","msg"=>"data sudah ada"];
            }
        }
    }

    public function daftar_akun(Request $request)
    {
        $instansi = $request->instansi;
        $nama = $request->nama;
        $email = $request->email;
        $nohp = $request->nohp;
        $password = $request->pass;
        $kec = $request->kec;
        $kel = $request->kel;
        $foto = $request->prof;
        $username = $request->username;
        $alamat = $request->alamat;
        $file = $foto;
        $size = $foto->getSize();
        //$tipe = $file->get_resource_type();
        $fileName = $file->getClientOriginalName() ;
        $destinationPath = public_path().'/images' ;

        $tipe = explode(".",$fileName);
        $tipe_file = $tipe[1];
        if(strlen($tipe[0] > 20)){
            $fileName = substr($tipe[0],0,20);
            $fileName = $fileName.".".$tipe_file;
        }
        $arrtipe = ["jpg","jpeg","png","webp"];
        //return $tipe_file;
        if(in_array($tipe_file,$arrtipe)){

        }else{
            return ["status"=>"0","msg"=>"file bukan bertipe gambar!"];
        }
        $send = DB::table("users")
        ->insert(["id_user"=>null,"instansi"=>$instansi,"nama"=>$nama,"username"=>$username,
                    "email"=>$email,"password"=>$password,"no_hp"=>$nohp,
                    "alamat"=>$alamat,"kecamatan"=>$kec,"kelurahan"=>$kel]);

        if($send){
            if($size <= 2194304){
                if($file->move($destinationPath,$fileName)){
                    $send = DB::table("foto_profils")->insert(["id_foto"=>NULL,"username"=>$username,"nama_foto"=>$fileName]);
                    if($send){
                        return ["status"=>"1"];
                    }
                    DB::table("users")->where("username","=",$username)->delete();
                    return ["status"=>"0","msg"=>"gagal mengirim foto profil"];
                }else{
                    DB::table("users")->where("username","=",$username)->delete();
                    return ["status"=>"0","msg"=>"gagal mengirim foto profil"];
                }
            }
            else{
                DB::table("users")->where("username","=",$username)->delete();
                return ["status"=>"0","msg"=>"ukuran foto melebihi 2mb (megabyte)"];
            }
            DB::table("users")->where("username","=",$username)->delete();
            return ["status"=>"0","msg"=>"gagal buat akun"];
        }
        return $request;
    }
}
