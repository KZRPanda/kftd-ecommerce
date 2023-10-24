<?php

namespace App\Http\Controllers;

use App\Models\notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\dashboard_admin;
use Nette\Utils\Json;

class dataSetuju extends Controller
{
    public $hello;

    public function setujui(Request $request)
    {
        $kode = $request->kode;
        $changed = DB::table("statuses")
        ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","statuses.id_pesanan")
        ->where("statuses.id_pesanan","=",$kode)
        ->where("logistik","=","1")
        ->update(["status"=>"2"]);
        $kirim = DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["admin"=>1]);
        if($kirim){
            return view("admin.component.tb_persetujuan",$this->reqdata());
        }
        return ["status"=>"error"];
    }

    public function kodeBayar(Request $request){
        $kode = $request->kode;
        $kodeBayar = $request->kodeBayar;
        $kirim =  true;//DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["proses"=>"selesai"]);
        
        if($kirim){
            $kirim1 = DB::table("statuses")->where("id_pesanan","=",$kode)->update(["status"=>"2"]);
            
            if($kirim1){
                $kirim2 = DB::table("pembayaran")->insert(["id_pesanan"=>$kode,"kode_pembayaran"=>$kodeBayar]);
                //$kirim2 = DB::table("pesan_barangs")->where("id_pesanan","=",$kode)->update(["kode_bayar"=>$kodeBayar]);
                if($kirim2){
                    return view("admin.component.tb_disetujui",$this->reqdisetujui());
                }else{
                    DB::table("statuses")->where("id_pesanan","=",$kode)->update(["status"=>"1"]);
                    //DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["proses"=>"fakturis"]);
                    return ["status"=>"error","msg"=>"gagal kirim kode bayar"];
                }
            }else{
                DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["proses"=>"fakturis"]);
                return ["status"=>"error","msg"=>"gagal ubah status"];
            }
        }
        return ["status"=>"error"];
    }

    public function dataSetujuView()
    {
        //return $this->reqdata();
        return view("admin.dataPersetujuan",$this->reqdata());
    }

    public function dataSetujuLoad(Request $request)
    {
        $dataAll = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
        ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
        where("statuses.status","=","2")->groupBy("pesan_barangs.id_pesanan")->orderBy("waktu")->paginate(12);
        $all = [];
        foreach ($dataAll as $key) {
            $temp = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
            ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
            ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
            ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
            ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
            where("statuses.status","=","2")->where("pesan_barangs.id_pesanan","=",$key->id_pesanan)->orderBy("waktu")->get();
            
            array_push($all,$temp);
        }

        $temp2 = [];
        $tempDenganFile = [];
        $idFile = [];
        $pler = [];
        foreach ($all as $key1) {
            foreach ($key1 as $key) {
                array_push($pler,$key);
            }

        }
        foreach ($pler as $key) {
            if($key->id_file != null){
                if($this->cekArray($idFile,$key->id_pesanan) == 0){
                    array_push($idFile,$key->id_pesanan);
                    array_push($temp2,$key);
                }

            }

        }
        $data["data_pesanan"] = $temp2;
        $temp2 = [];
        $idSudah = [];
        foreach ($pler as $key) {
            if($this->cekArray($idFile,$key->id_pesanan) == 0){
                if($this->cekArray($idSudah,$key->id_pesanan) == 0){
                    array_push($idSudah,$key->id_pesanan);
                    array_push($data["data_pesanan"],$key);
                }
            }
        }

        return view("admin.component.tb_persetujuan",$data);
    }

    public function reqdata()
    {
        $dataAll = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,proses_datakirim.admin,proses_datakirim.logistik,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
        ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
        where("statuses.status","=","1")->groupBy("pesan_barangs.id_pesanan")->orderBy("waktu")->paginate(12);
        $all = [];
        foreach ($dataAll as $key) {
            $temp = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,proses_datakirim.admin,proses_datakirim.logistik,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
            ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
            ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
            ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
            ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
            where("statuses.status","=","1")->where("pesan_barangs.id_pesanan","=",$key->id_pesanan)->orderBy("waktu")->get();
            
            array_push($all,$temp);
        }

        $temp2 = [];
        $tempDenganFile = [];
        $idFile = [];
        $pler = [];
        foreach ($all as $key1) {
            foreach ($key1 as $key) {
                array_push($pler,$key);
            }

        }
        foreach ($pler as $key) {
            if($key->id_file != null){
                if($this->cekArray($idFile,$key->id_pesanan) == 0){
                    array_push($idFile,$key->id_pesanan);
                    array_push($temp2,$key);
                }

            }

        }
        $data["data_pesanan"] = $temp2;
        $temp2 = [];
        $idSudah = [];
        foreach ($pler as $key) {
            if($this->cekArray($idFile,$key->id_pesanan) == 0){
                if($this->cekArray($idSudah,$key->id_pesanan) == 0){
                    array_push($idSudah,$key->id_pesanan);
                    array_push($data["data_pesanan"],$key);
                }
            }
        }
        return $data;
    }

    public function cekArray($arr,$data)
    {
        for ($i=0; $i < sizeof($arr); $i++) { 
            if($arr[$i] == $data){
                return 1;
            }
        }

        return 0;
    }

    public function prev(Request $request){
        $data["data_pesanan"] = DB::table("data_pesanan")->selectRaw("id_pesanan,nama_file,status,nama_status,username,waktu")->where("status","=","1")->groupBy("id_pesanan")->orderBy("waktu")->paginate(11);
        return view("admin.component.tb_persetujuan",$data);

    }
    public function next(Request $request){
        $data["data_pesanan"] = DB::table("data_pesanan")->selectRaw("id_pesanan,nama_file,status,nama_status,username,waktu")->where("status","=","1")->groupBy("id_pesanan")->orderBy("waktu")->paginate(11);
        //return $data;
        return view("admin.component.tb_persetujuan",$data);

    }

    public function generate_pesan($data)
    {
        $username = $data["username"];
        $id_pesanan = $data["id_pesanan"];
        $total = $data["total"];
        $isi = "Pesanan anda dengan kode pemesanan ".$id_pesanan." dan total biaya Rp.".$total." telah disetujui. Silahkan cek pesanan anda.";

        $kirim =  notif::insert(["isi"=>$isi,"username"=>$username,"id_pesanan"=>$id_pesanan,"id_notif"=>NULL]);

        if($kirim){
            return true;
        }
        return false;
    }

    public function dibayar()
    {
        $data["dibayar"] = DB::table("data_pesanan")->selectRaw("data_pesanan.id_pesanan,data_pesanan.username,data_pesanan.total_pesanan as total,file_bukti,jenis_status.nama_status as namaStatus")->
        leftJoin("jenis_status","id_status","=","status")->
        rightJoin("bukti_pembayaran","data_pesanan.id_pesanan","=","bukti_pembayaran.id_pesanan")->
        groupBy("data_pesanan.id_pesanan")->groupBy("file_bukti")->groupBy("data_pesanan.status")->groupBy("namaStatus")->
        where("status","=","2")->orderBy("data_pesanan.waktu")->paginate(50);

        //return print_r($data["dibayar"]);
        return view("admin.dataDibayar",$data);
    }

    public function setujuBayar(Request $request)
    {
        $id_pesanan = $request->kode;

        $setuju = DB::table("statuses")->where("id_pesanan","=",$id_pesanan)->update(["status"=>"3"]);
        if($setuju){
            $data["dibayar"] = DB::table("data_pesanan")->selectRaw("data_pesanan.id_pesanan,data_pesanan.username,data_pesanan.total_pesanan as total,file_bukti,jenis_status.nama_status as namaStatus")->
            leftJoin("jenis_status","id_status","=","status")->
            rightJoin("bukti_pembayaran","data_pesanan.id_pesanan","=","bukti_pembayaran.id_pesanan")->
            groupBy("data_pesanan.id_pesanan")->groupBy("file_bukti")->groupBy("data_pesanan.status")->groupBy("namaStatus")->
            where("status","=","2")->orderBy("data_pesanan.waktu")->paginate(50);

            return view("admin.component.tb_dibayar",$data);
        }

        return ["status"=>"error"];
    }


    //function for view DATA DISETUJUI

    public function disetujuiView()
    {
        //return $this->reqdisetujui();
        return view("admin.dataDisetujui",$this->reqdisetujui());
    }

    public function reqdisetujui()
    {
        $dataAll = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,proses_datakirim.admin,proses_datakirim.logistik,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
        ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
        where("statuses.status","=","1")
        ->where("logistik","=",1)
        ->where("admin","=",1)
        ->groupBy("pesan_barangs.id_pesanan")->orderBy("waktu")->get();
        
        $data["data_setujui"] = $dataAll;

        return $data;
    }

    //function for view DATA PERSETUJUAN

    public function tolakPesanan(Request $request)
    {
        $id = $request->id;
        $msg = $request->msg;
        $dikirim = false;
        $cekdata = DB::table("pesanan_tertolak")->select()->where("id_pesanan","=",$id)->get();
        
        //return sizeof($cekdata);
        if(sizeof($cekdata) < 1){
            DB::table("pesanan_tertolak")->insert(["id_pesanan"=>$id,"admin"=>2,"ket_admin"=>$msg]);
            DB::table("proses_datakirim")->where("id_pesanan","=",$id)->update(["admin"=>2]);
            return view("admin.component.tb_persetujuan",$this->reqdata());
        }else{
            $send = DB::table("pesanan_tertolak")->where("id_pesanan","=",$id)->update(["admin"=>2,"ket_admin"=>$msg]);
            
            if($send){
                DB::table("proses_datakirim")->where("id_pesanan","=",$id)->update(["admin"=>2]);
                return view("admin.component.tb_persetujuan",$this->reqdata());
            }else{
                return ["status"=>"error"];
            }
        }

        return ["status"=>"error"];
    }
}
