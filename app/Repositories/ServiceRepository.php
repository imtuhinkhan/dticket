<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\CrudInterface;
use App\Models\Service;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class ServiceRepository implements CrudInterface{

    public function getAll(){
        $allservice = Service::get();
        $service=[];
        $value = [];
        foreach($allservice as $key=>$val){
            $value['id']=$val->id;
            $value['name']=$val->name;
            $value['is_active']=$val->is_active;
            if($val->is_active==1){
                $value['status']='<span class="badge bg-success">Active</span>';
            }else{
                $value['status']='<span class="badge bg-danger">Deactive</span>';
            }
            array_push($service,$value);
        }
        return $service;
    }

    public function findById($id){
        return $service = Service::findorfail($id);
    }
    public function update(Request $request,$id){
        $service = $this->findById($id);
        $service->name = $request->name;
        $service->is_active = 1;
        $service->save();
        return $service;
    }
    public function create(Request $request){
        $service = new Service();
        $service->name = $request->name;
        $service->is_active = 1;
        $service->save();
        return $service;
    }
    public function delete($id){
        $service = $this->findById($id);
        $service->is_active = 0;
        $service->save();
        return $service;
    }
}