<?php

namespace App\Http\Controllers;

use App\Models\data_obat;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class upload_excel extends Controller
{
    public function upload_file(Request $request){
        $temporary = [];
        $temporary1 = [];
        $ukuran = 0;
        $temporary2 = [];
        $i = 0;
        $file = $request->file('temp')->getPathname();
        $file_open = fopen($file,'r');
        while(($csv = fgetcsv($file_open, 1000, ",")) !== false)
        {
            $name = $csv[0];
            $age = $csv[1];
            if($name == "" and $age == ""){
                break;
            }

            array_push($temporary,
                [
                    "id_obat"=>$csv[0],
                    "nama_obat"=>$csv[1],
                    "harga_obat"=>$csv[2],
                    "stok_obat"=>$csv[3],
                    "kategori_obat"=>$csv[4],
                    "gambar_obat"=>$csv[5]
                ]
            );
            //$kirim = data_obat::insert(["no_urut"=>NULL,"id_obat"=>utf8_encode($csv[0]),"nama_obat"=>strval($csv[1]),"harga"=>strval($csv[2]),"stok"=>strval($csv[3]),"kategori"=>strval($csv[4]),"gambar"=>strval($csv[5])]);
            //$kirim = DB::table("data_obat")->insert(["no_urut"=>NULL,"kode_obat"=> utf8_encode($name),"nama_obat"=>strval($age)]);
        }
        // if($kirim){
        //     $data["hasil"] = array("status"=>"berhasil");
        // }
        return $temporary;
        //return view("import_csv.send",$data);
    }
}