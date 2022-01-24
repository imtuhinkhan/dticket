<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\CrudInterface;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class SettingRepository{

    public function getSetting(){
        $setting = Setting::first();
        return $setting;
    }

    public function updateOrganization(Request $req){
        $organization = Setting::first();
        $organization->companyName = $req->name;
        $organization->email = $req->email;
        $organization->footerText = $req->footerText;
        if ($files = $req->file('largeLogo')) {
             $path = 'public/images/setting/';
             $fimage = uniqid() . "." . $files->getClientOriginalExtension();
             $files->move($path, $fimage);
             $organization->largeLogo = $path.$fimage;
        }
        if ($files = $req->file('smallLogo')) {
            $path = 'public/images/setting/';
            $fimage = uniqid() . "." . $files->getClientOriginalExtension();
            $files->move($path, $fimage);
            $organization->smallLogo = $path.$fimage;
        }
       if ($files = $req->file('favicon')) {
            $path = 'public/images/setting/';
            $fimage = uniqid() . "." . $files->getClientOriginalExtension();
            $files->move($path, $fimage);
            $organization->favicon = $path.$fimage;
       }
        $organization->save();
        return $organization;
    }
}