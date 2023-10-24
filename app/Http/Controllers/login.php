<?php

namespace App\Http\Controllers;

use App\Models\foto_profil;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\user;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Console\Input\Input;

class login extends Controller
{
    public function login(Request $request){
        $data_user = $request->data_user;
        $pass = $request->pass;
        $jenis = $request->jenis;
        $date = new Carbon();
        $today = $date->toDateTimeLocalString();

        if($jenis == "1"){
            $check_user = DB::table('data_user')->
            select(["*"])->
            where("username","=",$data_user)->
            orWhere("nama_lengkap","=",$data_user)->
            orWhere("nomor_hp","=",$data_user)->
            where("password","=",$pass)->
            get();

            $jumpesan = DB::table('pesan_notif')->count();
    
            if(count($check_user) > 0){
                $has_login = DB::table("data_login")->select(["*"])->where("id_user","=",$check_user[0]->username)->get();
                if(count($has_login) < 1){
                    DB::table("data_login")->insert(["id_user"=>$check_user[0]->username,"waktu_login"=>$today]);
                    return "dashboard";
                }else{
                    return "has_login";
                }
            }else{
                return "not_found";
            }
        }else if($jenis == "2"){
            $check_user = DB::table("admin_account")->select()
            ->where("username","=",$data_user)
            ->orWhere("email","=",$data_user)
            ->where("password","=",$pass)
            ->get();
            
            if(count($check_user) > 0){
                //session()->put("id_user",)
            }
        }
    }

    public function test_login(Request $request){
        $credentials = $request->validate([
            'data' => 'required',
            'password' => 'required',
        ]);

        $jenis = $request->jenis;

        $data_temp = $request->data;

        $userinfo = user::where('username','=',$data_temp)->orwhere("no_hp","=",$data_temp)->orwhere("email","=",$data_temp)->first();
            if($userinfo){
                $check_login = DB::table("user_login")->where("username","=",$userinfo->username)->first();
                if($check_login and !(session()->get("id_user") == $userinfo->username)){
                    DB::table("user_login")->where("username","=",$userinfo->username)->delete();
                    return redirect("/");
                }
                else if($check_login){
                    return back()->with("hasLogin","Akun sedang dipakai");
                }
                else{
                    if($request->password == $userinfo->password){
                        if($userinfo->acc == "0"){
                            return back()->with("notAcc","Akun belum disetujui!");
                        }

                        session()->put("id_user",$userinfo->username);

                        $data = ['user_login'=>user::where("username","=",$data_temp)->first()];
                        DB::table("user_login")->insert(["username"=>$userinfo->username]);
                        return redirect()->route("dashboard");
                    }
        
                    return back()->with("loginError","Data tidak ditemukan!. Silahkan mendaftar.");
                }
            }
        return back()->with("loginError","Data tidak ditemukan!. Silahkan mendaftar.")->withInput();

    }

    public function logout(){
        if(session()->has("id_user")){
            DB::table("user_login")->where("username","=",session()->get("id_user"))->delete();
            session()->pull("id_user");
            return redirect("/");
        }
    }

    public function dashboard(){
        $data = [];
        $data["palingDicari"] = DB::table("peakview")->select("*")->limit(5)->get();
        $data['user_login'] = user::where("username","=",session()->get('id_user'))->first();
        $data["foto_profil"] = foto_profil::where("username","=",session()->get('id_user'))->first();
        $jumpesan = DB::table('pesan_notif')->where("username","=",session("id_user"))->count();
        $data["jumpesan"] = $jumpesan;
        $data["notif"] = DB::table("pesan_notif")->selectRaw('pesan_notif.*,DATE(created_at) as tanggal')->where("username","=",session("id_user"))->get();
        //print_r($data);
        return view("dashboard",$data);
    }

    public function adminLogin(){
        $data["jenis_b"] = DB::table("data_obats")->count("*");
        $data["users"] = DB::table("users")->count("*");
        $data["users_login"] = DB::table("user_login")->paginate(5);
        $data["jum_pesan"] = DB::table("pesan_barangs")->selectRaw('id_obat,nama_obat,sum(jum_pesanan) as jum_pesan')->orderByDesc("jum_pesan")->groupBy(["id_obat","nama_obat"])->paginate(5);
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
        
        return view("admin",$data);
    }

    public function coba(){
        return "hello";
    }
}
