<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\login;
use Illuminate\Support\Facades\App;

class admin extends Controller
{

    public function login(Request $request)
    {
        $data_temp = $request->data;
        $check_user = DB::table("admin_account")->select()
        ->where("username","=",$data_temp)
        ->orWhere("email","=",$data_temp)
        ->where("password","=",$request->password)
        ->get();

        //return $check_user;
        if(count($check_user) > 0){
            if($check_user[0]->jenis == "admin"){
                session()->put("id_admin",$check_user[0]->username);
                return redirect("/admin");
            }
            else if($check_user[0]->jenis == "logistik"){
                session()->put("id_logistik",$check_user[0]->username);
                return redirect("/logistik");
            }
            else if($check_user[0]->jenis == "fakturis"){
                session()->put("id_fakturis",$check_user[0]->username);
                return redirect("/fakturis");
            }
        }
        return back()->with("loginError","Data tidak ditemukan!. Silahkan mendaftar.")->withInput();
    }

    public function loginPage()
    {
        return view("admin.login");
    }

    public function setsession()
    {
        if(session()->has("admin_id") || session()->has("id_user")){
            session()->pull("admin_id");
        }
        session()->put("admin_id","admin");
    }

    public function logout()
    {
        session()->pull("id_admin");
        return redirect("staff");
    }
}
