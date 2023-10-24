<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class data_piutang extends Controller
{
    public function index()
    {
        $data["all"] = DB::table("data_piutangs")
        ->select()
        ->get();

        return view("admin.datapiutang",$data);
    }
}
