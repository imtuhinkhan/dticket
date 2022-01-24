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
        return view('install.step1');
    }

    public function dbConnect(Request $request){
        if(self::check_database_connection($request->DB_HOST, $request->DB_DATABASE, $request->DB_USERNAME, $request->DB_PASSWORD)) {
            $path = base_path('.env');
            if (file_exists($path)) {
                foreach ($request->types as $type) {
                     $this->writeEnvironmentFile($type, $request[$type]);
                }
                return redirect('/installtion/import-sql');
            }else {
                return redirect('step3');
            }
        }else {
            return redirect('step3/database_error');
        }
    }

    function check_database_connection($db_host = "", $db_name = "", $db_user = "", $db_pass = "") {

        if(@mysqli_connect($db_host, $db_user, $db_pass, $db_name)) {
            return true;
        }else {
            return false;
        }
    }

    public function writeEnvironmentFile($type, $val) {
        $path = base_path('.env');
        if (file_exists($path)) {
            $val = trim($val);
            file_put_contents($path, str_replace(
                $type.'='.env($type), 
                $type.'='.$val, 
                file_get_contents($path)
            ));
        }
    }

    public function importSql(){
        return view('install.import_db');
    }

    public function uploadSql(){
        $sql_path = base_path('dticket.sql');
        DB::unprepared(file_get_contents($sql_path));
        return redirect('/installation/basic-setting');
    }
    public function basicSetting(){
        dd('Alhumdulillah');
    }
}
