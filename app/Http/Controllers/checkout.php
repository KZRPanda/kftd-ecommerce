<?php

namespace App\Http\Controllers;
use App\Models\foto_profil;
use App\Models\pesan_barang;
use App\Models\temp_pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\generateKode;

class checkout extends Controller
{
    public function checkout(){
        $data["pesanan"] = temp_pesanan::where("username","=",session()->get("id_user"))->leftJoin("data_obats","data_obats.id_obat","=","temp_pesanans.id_obat")->get();

        $data["obats"] = DB::table('temp_pesanans')->select("*")->where("username","=",session()->get("id_user"))->leftJoin("data_obats","data_obats.id_obat","=","temp_pesanans.id_obat")->get();

        $data["foto_profil"] = foto_profil::where("username","=",session()->get('id_user'))->first();
        $data["total"] = temp_pesanan::where("username","=",session()->get("id_user"))->sum("total");
        $data["jumlah"] = temp_pesanan::where("username","=",session()->get("id_user"))->leftJoin("data_obats","data_obats.id_obat","=","temp_pesanans.id_obat")->sum("temp_pesanans.jumlah");
        return view("component.checkout",$data);
    }

    public function update_checkout(Request $request){
        $id_obat = $request->id_obat;
        $username = $request->username;
        $jumlah = $request->jumlah;
        $total = $request->total;
        
        if($jumlah < 1){
            $hapus1 = DB::table("file_surat")->whereIn("id_file",function($query){
                $query->select("id_file")->from("temp_pesanans")->where("username","=",session()->get("id_user"));
            })->delete();
            //raw("delete from file_surat where id_file in (select id_file from temp_pesanans where username = '".session()->get("id_user")."')");
            $input = DB::table("temp_pesanans")->where("id_obat","=",$id_obat)->delete();
        }else{
            $input = DB::table("temp_pesanans")->where('id_obat','=',$id_obat)->where('username','=',$username)->update(["jumlah"=>$jumlah,"total"=>$total]);
        }     
        if($input){
            $status = ["kode"=>"200","status"=>"Berhasil"];
        }else{
            $status = ["kode"=>"500","status"=>"Gagal"];
        }

        return $status;
    }

    public function pesanBarang(){
        $input = "none";
        $total_pesanan = DB::table("temp_pesanans")->where("username","=",session()->get("id_user"))->sum("total");
        DB::table("temp_pesanans")->where("username","=",session()->get("id_user"))->where("jumlah","<","1")->delete();
        $all = DB::table("temp_pesanans")->get();

        $yesno = DB::table("temp_pesanans")->selectRaw("temp_pesanans.*,(data_obats.stok - temp_pesanans.jumlah) as stok")->join("data_obats","data_obats.id_obat","=","temp_pesanans.id_obat")->get();

        foreach ($yesno as $items) {
            if($items->stok < 0){
                return "Stok Kurang";
            }
        }

        if(count($all) >= 1){
            $id_pesanan = (new generateKode)->kodePesanan();
        }else{
            return false;
        }
        if(true){
            DB::table("proses_datakirim")->insert(["id_pesanan"=>$id_pesanan,"id"=>null]);
            $input = DB::insert(DB::raw("insert into pesan_barangs select NULL as no_urut,'".$id_pesanan."' as id_pesanan,id_obat,id_file,nama_obat,username,jumlah, total from temp_pesanans where username = '".session()->get("id_user")."'"));
            $status_pesan = DB::table("statuses")->insert(["id_pesanan"=>$id_pesanan,"username"=>session()->get("id_user"),"total_pesanan"=>$total_pesanan,"status"=>"1"]);
            if($input && $status_pesan){
                foreach ($yesno as $items) {
                    DB::table("data_obats")->where("id_obat","=",$items->id_obat)->update(["stok"=>$items->stok]);
                }
                temp_pesanan::where("username","=",session()->get("id_user"))->delete();
                return true;
            }else{
                return false;
            }
        }
    }

    public function delete(Request $request){
        $id_pesanan = $request->id;
        if(!emptyString($id_pesanan)){
            return "200";
        }else{
            return "error";
        }
    }
}
