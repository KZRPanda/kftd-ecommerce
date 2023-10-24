<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Support\Facades\DB;
use PDF;

class pdfcontroller extends Controller
{
	protected $fpdf;
 
    public function __construct()
    {
        $this->fpdf = new Fpdf('P','mm','A4');
    }

    public function index() 
    {
    	$this->fpdf->SetFont('Times','', 13);
        $this->fpdf->AddPage();
        $this->fpdf->SetTitle("Laporam Penjualan");
        $header = ["kontol dawdas dawdawds adwd","memek","anjing","peler"];
        $data = [
            ["a","b","c","d"],
            ["a","b","c","d"],
            ["a","b","c","d"],
            ["a","b","c","d"],
            ["a","b","c","d"]
        ];
        $w = array(40, 35, 40, 45);
        // Header
        for($i=0;$i<count($header);$i++)
            $this->fpdf->Cell($w[$i],0,$header[$i],1,0,'C');
        $this->fpdf->Ln();
        // Data
        foreach($data as $row)
        {
            $this->fpdf->Cell($w[0],6,$row[0],'LR');
            $this->fpdf->Cell($w[1],6,$row[1],'LR');
            $this->fpdf->Cell($w[2],6,$row[2],'LR');
            $this->fpdf->Cell($w[3],6,$row[3],'LR');
            $this->fpdf->Ln();
        }
        // Closing line
        $this->fpdf->Cell(array_sum($w),0,'','T');
        $this->fpdf->output();
        exit;
    }

    public function testing(Request $request)
    {
        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $databulan = ["januari","februari","maret","april",
        "mei","juni","juli","agustus","september","oktober",
        "november","desember"];
        $data["databulan"] = strtoupper($databulan[(int)$bulan - 1]);
        $data["tahun"] = $tahun;
        $data["bulanIni"] = DB::table("pesan_barangs")
        ->selectRaw("users.instansi,pesan_barangs.*,DATE(statuses.waktu_pesan) as waktu_pesan")
        ->leftJoin("users","users.username","=","pesan_barangs.username")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->whereRaw("MONTH(waktu_pesan) = ".$bulan)
        ->whereRaw("YEAR(waktu_pesan) = ".$tahun)
        ->where("status","=","3")
        ->orWhere("status","=","4")
        ->orderBy("waktu_pesan")
        ->get();

        $data["tot"] = DB::table("pesan_barangs")
        ->selectRaw("sum(harga_pesanan) as total")
        ->leftJoin("statuses","statuses.id_pesanan","=","pesan_barangs.id_pesanan")
        ->whereRaw("MONTH(waktu_pesan) = ".$bulan)
        ->whereRaw("YEAR(waktu_pesan) = ".$tahun)
        ->where("status","=","3")
        ->get();
        
        if(sizeof($data["bulanIni"]) >= 1){
            $pdf = PDF::loadView('welcome', $data);
            return $pdf->stream('tutsmake.pdf');
        }

        return "404";
    }

    public function faktur(Request $request)
    {
        $data["semua"] = DB::table("data_pesanan")
        ->selectRaw("data_pesanan.*,users.instansi,
        data_obats.id_obat,data_obats.harga,
        users.alamat,
        DATE(waktu) as waktu")
        ->leftJoin("data_obats","data_obats.nama_obat","=","data_pesanan.nama_obat")
        ->leftJoin("users","users.username","=","data_pesanan.username")
        ->where("id_pesanan","=",$request->id)
        ->get();

        $html ='
        <div class="footer">
        <div class="ttd">
            <h5>Kimia Farma Trading And Distribution</h5>
            <p>(.....................................)</p>
        </div>
        </div>';

        $pdf = PDF::loadView('faktur',$data)->setPaper('a4','landscape');
        return $pdf->stream('coba.pdf');
    }
}
