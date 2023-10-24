<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class guest extends Controller
{
    public function dashboard(){
        return view("guest.dashboard");
    }
}
