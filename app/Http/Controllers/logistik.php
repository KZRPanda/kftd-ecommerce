<?php

namespace App\Http\Controllers;

use App\Models\data_obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\generateKode;

class logistik extends Controller
{

    public function index()
    {
        //return (new generateKode)->kodePesanan();
        $data["data_pesanan"] = DB::table("data_obat_ada")->join("kategoriObat","kategoriObat.id_kategori","data_obat_ada.kategori")->orderBy("nama_obat")
        ->paginate(15);
        return view("logistik",$data);
    }

    public function setujui(Request $request)
    {
        $kode = $request->kode;
        
        $changed = DB::table("statuses")
        ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","statuses.id_pesanan")
        ->where("statuses.id_pesanan","=",$kode)
        ->where("admin","=","1")
        ->update(["status"=>"2"]);
        $kirim = DB::table("proses_datakirim")->where("id_pesanan","=",$kode)->update(["logistik"=>"1"]);
        if($kirim){
            return $this->persetujuan();
        }
        return ["status"=>"error"];
    }

    public function tolakPesanan(Request $request)
    {
        $id = $request->id;
        $msg = $request->msg;

        $cekdata = DB::table("pesanan_tertolak")->select()->where("id_pesanan","=",$id)->get();
        //return ["id"=>$id,"msg"=>$msg];
        if(sizeof($cekdata) < 1){
            DB::table("pesanan_tertolak")->insert(["id_pesanan"=>$id,"logistik"=>2,"ket_logistik"=>$msg]);
            DB::table("proses_datakirim")->where("id_pesanan","=",$id)->update(["logistik"=>2]);
            return view("logistik.dataPersetujuan",$this->reqdata());
        }else{
            $send = DB::table("pesanan_tertolak")->where("id_pesanan","=",$id)->update(["logistik"=>2,"ket_logistik"=>$msg]);
            if($send){
                DB::table("proses_datakirim")->where("id_pesanan","=",$id)->update(["logistik"=>2]);
                return view("logistik.dataPersetujuan",$this->reqdata());
            }else{
                return ["status"=>"error"];
            }
        }

        return ["status"=>"error"];
    }

    public function dataBarang(){
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")
        ->paginate(15);
        return view("logistik.dataBarang",$data);
   }

   public function pengiriman()
   {
        $data["pengiriman"] = DB::table("statuses")->selectRaw("statuses.*,users.alamat,DATE(statuses.waktu_pesan) as tanggal,proses_datapesan.kode_pengiriman as kp")
        ->leftJoin("proses_datapesan","proses_datapesan.id_pesanan","=","statuses.id_pesanan")
        ->leftJoin("users","users.username","=","statuses.username")
        ->where("status","=","2")
        ->orWhere("status","=","3")
        ->orderByDesc("waktu_pesan")
        ->get();
        
        $data["dataAll"] = $this->reqdatakirim();
        //return $data;
        return view("logistik.pengiriman",$data);
   }

   public function buatPengiriman(Request $request)
   {
        $tgl = $request->tgl;

        $kodePengiriman = 0;

        $data = DB::table("statuses")->select(["statuses.id_pesanan"])
        ->leftJoin("proses_datapesan","proses_datapesan.id_pesanan","=","statuses.id_pesanan")
        ->where("kode_pengiriman","=",null)->where("status","=","2")->get();

        //return $data;
        if(sizeof($data) < 1){
            return ["status"=>"error"];
        }

        $i = 0;

        $proses = "Pesanan Dikemas Oleh Logistik";
        $ket = "pesanan sedang dikemas oleh pihak logisik";

        $kodePengiriman = (new generateKode)->kodePengiriman();
        $kirim = DB::table("pengiriman")->insert(["kode_pengiriman"=>$kodePengiriman,"tgl_pengiriman"=>$tgl,"proses"=>$proses,"keterangan"=>$ket]);
        
        if($kirim){

            foreach ($data as $key) {
                DB::table("statuses")->where("id_pesanan","=",$key->id_pesanan)->update(["status"=>3]);
                DB::table("proses_datapesan")->insert(["id_pesanan"=>$key->id_pesanan,"kode_pengiriman"=>$kodePengiriman]);
            }

            DB::table("riwayatpengiriman")->insert(["id"=>null,"kode_pengiriman"=>$kodePengiriman,"proses"=>$proses,"keterangan"=>$ket]);
            //$data = DB::table("proses_datapesan")->select()->groupBy("kode_pengiriman")->get();
            $data["pengiriman"] = DB::table("statuses")->selectRaw("statuses.*,DATE(statuses.waktu_pesan) as tanggal,proses_datapesan.kode_pengiriman as kp")
            ->leftJoin("proses_datapesan","proses_datapesan.id_pesanan","=","statuses.id_pesanan")
            ->where("status","=","3")
            ->orderByDesc("waktu_pesan")
            ->get();

            $data["dataAll"] = $this->reqdatakirim();
            return view("logistik.pengiriman",$data);
        }

        return ["status"=>"error"];

        //return $tgl;
   }

   public function reqdatakirim(){
        $data = DB::table("proses_datapesan")->selectRaw("proses_datapesan.*, pengiriman.proses,pengiriman.keterangan,count(*) as jumlah")
        ->leftJoin("pengiriman","pengiriman.kode_pengiriman","=","proses_datapesan.kode_pengiriman")
        ->groupBy("kode_pengiriman")
        ->orderByDesc("tgl_pengiriman")
        ->get();
        return $data;
   }

   public function nextprev(Request $request)
   {
        $jumlah = $request->jumlah;
        $txt = $request->txt;
        $data["data_pesanan"] = DB::table("data_obats")->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->where("nama_obat","like","%".$txt."%")->orWhere("id_obat","like","%".$txt."%")->orderBy("nama_obat")->paginate($jumlah);
        return view("logistik.component.tb_dataBarang",$data);
   }

   public function dataBarangEdit(Request $request){
    if(isset($request->id_obat)){
        if($request->file('gambarEdit')->getSize() != 0 ){
            $file = $request->file('gambarEdit');
            $size = $request->file("gambarEdit")->getSize();
            $fileName = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/images/foto_obat';
            if($file->move($destinationPath,$fileName)){
                $update = DB::table("data_obats")->where("id_obat","=",$request->id_obat)->update(["nama_obat"=>$request->nama_obat,"stok"=>$request->stok,"harga"=>$request->harga,"kategori"=>$request->kategori,"gambar"=>$fileName]);
            }
        }else{
            $update = DB::table("data_obats")->where("id_obat","=",$request->id_obat)->update(["nama_obat"=>$request->nama_obat,"stok"=>$request->stok,"harga"=>$request->harga,"kategori"=>$request->kategori]);
        }
        return $request;
    }
    else{
        return "data kosong";
    }
   }

   public function masterdata()
   {
    # code...
   }

   public function dataPesan(){
        return view("logistik.dataPesanan");
   }

   public function jadwal()
   {
        return view("logistik.jadwal");
   }

   public function persetujuan()
   {
    return view("logistik.dataPersetujuan",$this->reqdata());
   }

   public function data_persetujuan()
   {
        return $this->reqdata();
   }

   public function dataSetujuLoad(Request $request)
   {
        $data["all"] = [];
        $temp = [];
        // foreach ($request->all as $key) {
        //     foreach ($key as $item) {
        //         array_push($temp,json_decode($item));
        //     }
        // }

        //$data["all"] = $temp;
        $data["all"] = json_decode($request->all);
        //$data["all"] = $request->all;
        $data["data_pesanan"] = json_decode($request->data);
        //return $data;
        return view("logistik.component.tb_persetujuan",$data);
   }

   public function reqdata()
   {
    $data["data_pesanan"] = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,proses_datakirim.admin,proses_datakirim.logistik,statuses.total_pesanan as total,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
    ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
    ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
    ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
    ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
    where("statuses.status","=","1")->groupBy("id_pesanan")->orderBy("waktu")->paginate(10);

    $kode = [];
    $temp = [];

    foreach ($data["data_pesanan"] as $key) {
        if($this->cek($kode,$key->id_pesanan) == 0){
            $dataTemp = DB::table("pesan_barangs")->selectRaw("pesan_barangs.*,proses_datakirim.admin,proses_datakirim.logistik,statuses.total_pesanan as total,file_surat.nama_file,jenis_status.nama_status,statuses.status,statuses.waktu_pesan as waktu")
            ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
            ->leftJoin("jenis_status","jenis_status.id_status","=","statuses.status")      
            ->leftJoin("proses_datakirim","proses_datakirim.id_pesanan","=","pesan_barangs.id_pesanan")
            ->leftJoin("file_surat","file_surat.id_file","pesan_barangs.id_file")->
            where("statuses.status","=","1")->where("pesan_barangs.id_pesanan","=",$key->id_pesanan)->orderBy("waktu")->get();
            
            array_push($kode,$key->id_pesanan);
        }
        array_push($temp,$dataTemp);
    }

    $data["dataAll"] = $temp;
    return $data;
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

   public function cari(Request $request)
   {
       $temp = $request->queries;
       $jumlah = $request->jumlah;

       $data["data_pesanan"] = data_obat::where("nama_obat","like","%".$temp."%")->orWhere("id_obat","like","%".$temp."%")
       ->join("kategoriObat","kategoriObat.id_kategori","data_obats.kategori")->orderBy("nama_obat")->paginate($jumlah);        
       
       //return $request;
       return view("logistik.component.tb_dataBarang",$data);
   }

    //ROUTE BARANG KOSONG
    function barangkosong(){
        $data["semua"] = DB::table("data_obats")
        ->select()
        ->where("stok","=","0")
        ->get();

        //return $data;
        return view("logistik.component.barangkosong",$data);
    }

    public function logout()
    {
        session()->pull("id_logistik");
        return redirect("/staff");
    }

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
        
        $data["bulanIni"] = DB::table("data_pesanan")
        ->selectRaw("id_obat,stok,data_pesanan.nama_obat,sum(data_pesanan.jum_pesanan) as jumlah,data_pesanan.waktu")
        ->leftJoin("data_obats","data_obats.nama_obat","=","data_pesanan.nama_obat")
        ->whereRaw("MONTH(waktu) = MONTH(current_date)")
        ->whereRaw("YEAR(waktu) = YEAR(current_date)")
        ->where("status","=","3")
        ->orWhere("status","=","4")
        ->groupBy("nama_obat")
        ->orderByDesc("jumlah")
        ->get();


        //return $data;
        return view("logistik.laporan",$data);
    }

    public function reqdatabulan(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $data["date"] = $request->date;
        $data["bulan"] = $bulan;
        $data["tahun"] = $tahun;

        $data["bulanIni"] = DB::table("data_pesanan")
        ->selectRaw("id_obat,stok,data_pesanan.nama_obat,sum(data_pesanan.jum_pesanan) as jumlah,data_pesanan.waktu")
        ->leftJoin("data_obats","data_obats.nama_obat","=","data_pesanan.nama_obat")
        ->whereRaw("MONTH(waktu) = ".$bulan)
        ->whereRaw("YEAR(waktu) = ".$tahun)
        ->where("status","=","3")
        ->orWhere("status","=","4")
        ->groupBy("nama_obat")
        ->orderByDesc("jumlah")
        ->get();

        return view("logistik.component.tb_laporanBulanIni",$data);
    }
}
