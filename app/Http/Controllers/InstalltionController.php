<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InstalltionController extends Controller
{
    public function index(){
        return view('install.index');
    }

    public function step1(Request $request){
        dd($request);
    }

    public function step2(){
        dd($request);
    }

    public function step3(){
        dd($request);
    }
    public function step4(){
        dd($request);
    }
}
