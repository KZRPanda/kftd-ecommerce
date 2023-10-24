<?php

namespace App\Http\Controllers;

use App\Models\notif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Codedge\Fpdf\Fpdf\Fpdf;
class fakturis extends Controller
{
    public function laporan()
    {
        $data["bulanan"] = DB::table("pesan_barangs")
        ->selectRaw
        ("sum(pesan_barangs.jum_pesanan) as jumlah,
            MONTH(statuses.waktu_pesan) as bulan,
            YEAR(statuses.waktu_pesan) as tahun,
            sum(pesan_barangs.harga_pesanan) as total")
        ->join("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->where("statuses.status","=","3")
        ->orWhere("status","=","4")
        ->groupByRaw("MONTH(waktu_pesan)")
        ->orderBy("waktu_pesan")
        ->get();
        
        $data["bulanIni"] = DB::table("pesan_barangs")
        ->selectRaw("pesan_barangs.*,DATE(statuses.waktu_pesan) as waktu_pesan")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->whereRaw("MONTH(waktu_pesan) = MONTH(current_date)")
        ->whereRaw("YEAR(waktu_pesan) = YEAR(current_date)")
        ->where("status","=","3")
        ->orWhere("status","=","4")
        ->orderBy("waktu_pesan")
        ->get();

        //return $data;
        return view("fakturis.laporan",$data);
    }

    public function reqdatabulan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $data["date"] = $request->date;
        $data["bulanIni"] = DB::table("pesan_barangs")
        ->selectRaw("pesan_barangs.*,DATE(statuses.waktu_pesan) as waktu_pesan")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->whereRaw("MONTH(waktu_pesan) = ".$bulan)
        ->whereRaw("YEAR(waktu_pesan) = ".$tahun)
        ->where("status","=","3")
        ->orderBy("waktu_pesan")
        ->get();

        return view("fakturis.component.tb_laporanBulanIni",$data);
    }

    public function persetujuan()
    {       
        return view("fakturis.persetujuan",$this->reqdata());
    }

    public function loadPersetujuan()
    {
        return $this->reqdata();
    }

    public function reqdata()
    {
        $data["data_pesanan"] = DB::table("pesan_barangs")
        ->selectRaw("pesan_barangs.*,CURRENT_DATE - DATE(statuses.waktu_pesan) as lama
        ,proses_datakirim.logistik,proses_datakirim.admin
        ,statuses.total_pesanan as total,file_surat.nama_file,jenis_status.nama_status
        ,statuses.status,statuses.waktu_pesan as waktu
        ,ket_admin,ket_logistik
        ")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
        ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("pesanan_tertolak","pesanan_tertolak.id_pesanan","=","pesan_barangs.id_pesanan")
        ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")
        //->where("statuses.status","=","1")
        ->whereRaw("statuses.status = 1 and ((proses_datakirim.logistik = 0 or proses_datakirim.admin = 0) or (proses_datakirim.logistik = 2 or proses_datakirim.admin = 2))")
        //->where("logistik","=","0")
        //->orWhere("admin","=","0")
        ->groupBy("id_pesanan")->orderBy("waktu")->paginate(10);
 
        $kode = [];
        $temp = [];

        $data["dataAll"] = $temp;
        return $data;
    }


    public function setujui(Request $request)
    {
        $kode = $request->kode;
        $kodeBayar = $request->kodeBayar;
        $kirim = DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["proses"=>"selesai"]);
        
        if($kirim){
            $kirim1 = DB::table("statuses")->where("id_pesanan","=",$kode)->update(["status"=>"2"]);
            
            if($kirim1){
                $kirim2 = DB::table("pembayaran")->insert(["id_pesanan"=>$kode,"kode_pembayaran"=>$kodeBayar]);
                //$kirim2 = DB::table("pesan_barangs")->where("id_pesanan","=",$kode)->update(["kode_bayar"=>$kodeBayar]);
                if($kirim2){
                    return view("fakturis.component.tb_persetujuan",$this->reqdata());
                }else{
                    DB::table("statuses")->where("id_pesanan","=",$kode)->update(["status"=>"1"]);
                    DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["proses"=>"fakturis"]);
                    return ["status"=>"error","msg"=>"gagal kirim kode bayar"];
                }
            }else{
                DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["proses"=>"fakturis"]);
                return ["status"=>"error","msg"=>"gagal ubah status"];
            }
        }
        return ["status"=>"error"];
    }

    public function cek($arr,$data)
    {
        foreach ($arr as $key) {
            if($key == $data){
                return 1;
            }
        }

        return 0;
    }

    function tolakpesanan(Request $request){
        $msg = $request->msg;
        $id = $request->id;

        $tolak = DB::table("statuses")->where("id_pesanan","=",$id)->update(["ket_tolak"=>$msg,"status"=>5]);
        if($tolak){
            notif::insert(["id_notif"=>null,"isi"=>$msg,"id_pesanan"=>$id]);
            return view("fakturis.component.tb_persetujuan",$this->reqdata());
        }
        //return $msg." ".$id;
    }

    function coba(){
        $data["semua"] = DB::table("pesan_barangs")
        ->selectRaw("users.nama,pesan_barangs.nama_obat
        ,data_obats.harga,pesan_barangs.jum_pesanan
        ,pesan_barangs.harga_pesanan, DATE(statuses.waktu_pesan) as tanggal")
        ->leftJoin("data_obats","data_obats.id_obat","=","pesan_barangs.id_obat")
        ->leftJoin("users","users.username","=","pesan_barangs.username")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->where("statuses.status","=","3")
        ->orWhere("status","=","4")
        ->get();

        return view("fakturis.transaksi",$data);
    }

    public function logout()
    {
        session()->pull("id_fakturis");
        return redirect("/staff");
    }


    public function datafaktur()
    {
        $data["semua"] = DB::table("data_pesanan")
        ->selectRaw("data_pesanan.*,users.instansi,sum(jum_pesanan) as jum_pesanan,DATE(waktu) as tanggal")
        ->leftJoin("users","users.username","=","data_pesanan.username")
        ->where("status","=","3")
        ->orWhere("status","=","4")
        ->groupBy("id_pesanan")
        ->get();

        return view("fakturis.cetak",$data);
    }

    public function cariDataFaktur(Request $request)
    {
        $teks = $request->data;
        $data["semua"] = DB::table("data_pesanan")
        ->selectRaw("data_pesanan.*,users.instansi,sum(jum_pesanan) as jum_pesanan,DATE(waktu) as tanggal")
        ->leftJoin("users","users.username","=","data_pesanan.username")
        ->where("id_pesanan", "like", "%".$teks."%")
        ->where(function($query){
            $query->where("status","=","3")
            ->orWhere("status","=","4");
        })
        ->groupBy("id_pesanan")
        ->get();

        return view("fakturis.component.data_cetak",$data);
    }
}

