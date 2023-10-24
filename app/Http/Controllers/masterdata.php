<?php

namespace App\Http\Controllers;

use App\Models\data_obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class masterdata extends Controller
{
    public function index()
    {
        $data["all"] = DB::table("data_obat_ada")->select(["id_obat","nama_obat"])->limit(10)->get();
        return view("admin.component.tb_delete",$data);
    }

    public function cari(Request $request)
    {
        $data["thisdata"] = DB::table("data_obat_ada")->select()->where("id_obat","like","%".$request->txt."%")->orWhere("nama_obat","like","%".$request->txt."%")->limit(1)->get();
        return $data["thisdata"];
    }

    public function insert(Request $request)
    {
        $id = $request->kode;
        $nama = $request->nama;
        $stok = $request->stok;
        $harga = $request->harga;
        $kategori = $request->kategori;
        $file = $request->file("thisfile");

        $size = $file->getSize();

        $fileName = $file->getClientOriginalName() ;
        if(strlen($fileName) > 50){
            $nameTemp = explode(".",$fileName);
            $tipefile = $nameTemp[sizeof($nameTemp) - 1];
            $fileName = substr($fileName,15);
            $fileName = $fileName.$tipefile;
        }
        $destinationPath = public_path().'/images/foto_obat';

        $cekdata = DB::table("data_obats")->select()->where("id_obat","=",$id)->orWhere("nama_obat","=",$nama)->get();
        
        if(sizeof($cekdata) == 1){
            return ["status"=>"error","msg"=>"kode obat / nama obat sudah ada"];
        }else{
            if($size < 2194304){
                if($file->move($destinationPath,$fileName)){
                    $kirimdata = DB::table("data_obats")->
                    insert(["no_urut"=>null,"id_obat"=>$id,"nama_obat"=>$nama,"harga"=>$harga,"stok"=>$stok,"kategori"=>$kategori,"gambar"=>$fileName,"update"=>null]);
                    
                    if($kategori){
                        return ["status"=>"success","msg"=>"berhasil"];
                    }
                }
            }
        }
        return $request;
    }
    
    public function insertcsv(Request $request)
    {
        $temporary = [];
        $imgdefault = "default.jpg";
        $file = $request->file('temp')->getPathname();
        $file_open = fopen($file,'r');

        try {
            while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
            {
                $name = $csv[0];
                $age = $csv[1];
                if($name == "" and $age == ""){
                    break;
                }
    
                $img = $imgdefault;
                
                $cek = DB::table("data_obats")->select()->where("id_obat","=",utf8_encode($csv[0]))->get();
                if(sizeof($cek) == 1){
                    return ["status"=>"error"];
                }
                $kirim = data_obat::insert(["no_urut"=>NULL,"id_obat"=>utf8_encode($csv[0]),"nama_obat"=>strval($csv[1]),"harga"=>strval($csv[2]),"stok"=>strval($csv[3]),"kategori"=>strval($csv[4]),"gambar"=>$img]);
                //$kirim = DB::table("data_obat")->insert(["no_urut"=>NULL,"kode_obat"=> utf8_encode($name),"nama_obat"=>strval($age)]);
            }
            if($kirim){
                $data["hasil"] = array("status"=>"success");
            }
        } catch (\Throwable $th) {
            return ["status"=>"error"];
        }
        return $data;
        //return view("import_csv.send",$data);
    }

    public function update(Request $request)
    {
        $id = $request->editkode;
        $nama = $request->editnama;
        $stok = $request->editstok;
        $harga = $request->editharga;
        $kategori = $request->editkategori;
        $edited = $request->edited;

        $filename = $request->fileedit;
        $file = null;

        if(strlen($filename) > 50){
            $nameTemp = explode(".",$filename);
            $tipefile = $nameTemp[sizeof($nameTemp) - 1];
            $filename = substr($filename,0,20);
            $filename = $filename.".".$tipefile;
        }

        if($edited == "true"){
            $file = $request->file;
        }

        if($file == null){
            $update = DB::table("data_obats")->where("id_obat","=",$id)->update(["nama_obat"=>$nama,"harga"=>$harga,"stok"=>$stok,"kategori"=>$kategori,"gambar"=>$filename]);
            if($update){
                return ["status"=>"success","msg"=>"data berhasil dikirim"];
            }else{
                return ["status"=>"error","msg"=>"gagal update data"];
            }
        }else if($file != null){
            $file = $request->file("file");
            $size = $file->getSize();
            $filename = $file->getClientOriginalName() ;
            $destinationPath = public_path().'/images/foto_obat';
            if(strlen($filename) > 50){
                $nameTemp = explode(".",$filename);
                $tipefile = $nameTemp[sizeof($nameTemp) - 1];
                $filename = substr($filename,0,20);
                $filename = $filename.".".$tipefile;
            }
            if($size < 2194304){
                if($file->move($destinationPath,$filename)){
                    $update = DB::table("data_obats")->where("id_obat","=",$id)->update(["nama_obat"=>$nama,"harga"=>$harga,"stok"=>$stok,"kategori"=>$kategori,"gambar"=>$filename]);
                    return ["status"=>"success","msg"=>"data berhasil dikirim"];
                }else{
                    return ["status"=>"error","msg"=>"gagal mengirim file"];
                }
            }

            return ["status"=>"success","msg"=>"ukuran file terlalu besar"];
        }
    }

    public function delete(Request $request)
    {
        $kode = $request->kode;

        $hapus = DB::table("obat_dihapus")->insert(["id_dihapus"=>null,"id_obat"=>$kode]);
        if($hapus){
            DB::table("data_obats")->where("id_obat","=",$kode)->update(["stok"=>0]);
            $data["all"] = DB::table("data_obat_ada")->select(["id_obat","nama_obat"])->limit(10)->get();
            return view("admin.component.tb_delete",$data);
        }
    }
}
