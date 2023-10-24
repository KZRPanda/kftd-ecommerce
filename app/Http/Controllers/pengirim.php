<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\generateKode;
use App\Models\datapengirim;
use Nette\Utils\Json;
use SebastianBergmann\Type\ObjectType;

class pengirim extends Controller
{
    public function index()
    {
        $data["all"] = DB::table("datapengiriman")
        ->select()
        ->leftJoin("users","users.username","=","datapengiriman.username")
        ->where("kode_pengiriman","=","22110560919")
        ->get();
        return view("pengirim",$data);
    }

    public function login()
    {
        return view('pengirim.login');
    }
    
    public function regis()
    {
        return view('pengirim.regis');
    }

    public function regis_akun(Request $request)
    {
        session()->pull("nama");
        session()->pull("email");
        session()->pull("nohp");

        $nama = $request->nama;
        $email = $request->email;
        $password = $request->password;
        $nohp = $request->nohp;
        $kode = (new generateKode)->idpengirim();

        $dataerror = [
        ];

        $i = 0;

        $cek1 = datapengirim::select()
        ->where("nama","=",$nama)
        ->get();

        if(sizeof($cek1) >= 1){
            $dataerror["nama"] = "nama";
            $i++;
        }

        $cek2 = datapengirim::select()
        ->where("email","=",$email)
        ->get();

        if(sizeof($cek2) >= 1){
            $dataerror["email"] = "email";
            $i++;
        }

        $cek3 = datapengirim::select()
        ->where("nohp","=",$nohp)
        ->get();

        if(sizeof($cek3) >= 1){
            $dataerror["nohp"] = "nohp";
            $i++;
        }


        if(sizeof($dataerror) >= 1){
            return back()->with($dataerror)->withInput(); 
        }

        $kirim = datapengirim::insert([
            "id_pengirim"=>$kode,
            "nama"=>$nama,
            "email"=>$email,
            "nohp"=>$nohp,
            "password"=>$password
        ]);

        if($kirim){
            return redirect("pengirim/login")->with(["daftar"=>1]);
        }

        return back();
    }
}
