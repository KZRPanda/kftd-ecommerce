<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class modal extends Controller
{
    public function show_modal(Request $request){
        $title = $request->title;
        $text = $request->text;

        $temp = [];
        $temp=["title"=>$title,"text"=>$text];

        $data["all"] = $temp;

        return view('component.modal.modal',$data);
    }
}
