<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class requestData extends Controller
{
    public function sk(){
        $data["surats"] = DB::table("surat_detail")->get();
        return json_encode($data["surats"],true);
    }

    public function skbaru(Request $request){
        $data["surats"] = DB::table("surat_detail")->get();
        $data["lama"] = $request->data_lama;
        $data["baru"] = json_encode($data["surats"],true);

        if($data["baru"] != $data["lama"]){
            return view("admin.component.sk",$data);
        }else{
            return "false";
        }

        //return json_encode($data["surats"],true) == json_encode($request->data_lama,true);
    }
}
