<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use URL;
use DB;
use Hash;
class InstalltionController extends Controller
{
    public function index(){
        $permission['curl_enabled']           = function_exists('curl_version');
        $permission['db_file_write_perm']     = is_writable(base_path('.env'));
        $permission['routes_file_write_perm'] = is_writable(base_path('app/Providers/RouteServiceProvider.php'));
        return view('install.index',compact('permission'));
    }

    public function step1(){
        if(DB::connection()->getDatabaseName()){
            return view('install.import_db');
        }else{
            $error = true;
            return view('install.import_db',compact('error'));
        }
    }


    public function uploadSql(){
        $sql_path = base_path('dticket.sql');
        DB::unprepared(file_get_contents($sql_path));
        return redirect('/');
    }
}
