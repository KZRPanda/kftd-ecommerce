<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\user;
use App\Models\foto_profil;
use Illuminate\Support\Facades\DB;

class profil extends Controller
{
    public function tampil_profil(){
        $data = ['user_login'=>user::where("username","=",session()->get('id_user'))->first()];
        $data["foto_profil"] = DB::table("foto_profils")->where("username","=",session()->get("id_user"))->get();
        $data["kecamatan"] = DB::table('api_kecamatan_palembang')->get();
        $data["kelurahan"] = DB::table('api_kelurahan_palembang')->join("api_kecamatan_palembang","api_kelurahan_palembang.id_kecamatan","=","api_kecamatan_palembang.id_kecamatan")->
        where("api_kecamatan_palembang.id_kecamatan","=",$data["user_login"]->kecamatan)->get();
    
        return view("component.profil.profil",$data);
    }

    public function input_data(Request $request){
        $username = $request->username;
        $password = $request->password;
        $ubah = "";
        
        $check_data = user::where("username","=",$username)->where("password","=",$password)->first();

        if($check_data){
            $ubah = user::where("username","=",$username)->
                update(["nama"=>$request->nama,
                "email"=>$request->email,"password"=>$request->password,
                "no_hp"=>$request->no_hp,"alamat"=>$request->alamat,
                "kecamatan"=>$request->kecamatan,"kelurahan"=>$request->kelurahan]);

            if($ubah){
                return ["status"=>"berhasil","text"=>"Data Berhasil Diupdate"];
            }else{
                return ["gagal"=>"gagal masukkan data"];
            }
        }else{
            return ["salah_password"=>"Anda Salah Memasukkan Password!"];
        }
    }
}
