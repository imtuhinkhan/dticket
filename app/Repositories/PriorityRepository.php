<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\CrudInterface;
use App\Models\Priority;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class PriorityRepository implements CrudInterface{

    public function getAll(){
        $allPriority = Priority::get();
        $Priority=[];
        $value = [];
        foreach($allPriority as $key=>$val){
            $value['id']=$val->id;
            $value['name']=$val->name;
            $value['is_active']=$val->is_active;
            if($val->is_active==1){
                $value['status']='<span class="badge bg-success">Active</span>';
            }else{
                $value['status']='<span class="badge bg-danger">Deactive</span>';
            }
            array_push($Priority,$value);
        }
        return $Priority;
    }

    public function findById($id){
        return $Priority = Priority::findorfail($id);
    }
    public function update(Request $request,$id){
        $Priority = $this->findById($id);
        $Priority->name = $request->name;
        $Priority->is_active = 1;
        $Priority->save();
        return $Priority;
    }
    public function create(Request $request){
        $Priority = new Priority();
        $Priority->name = $request->name;
        $Priority->is_active = 1;
        $Priority->save();
        return $Priority;
    }
    public function delete($id){
        $Priority = $this->findById($id);
        $Priority->is_active = 0;
        $Priority->save();
        return $Priority;
    }
}