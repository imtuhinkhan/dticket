<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\CrudInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class CategoryRepository implements CrudInterface{

    public function getAll(){
        $allCategory = Category::get();
        $category=[];
        $value = [];
        foreach($allCategory as $key=>$val){
            $value['id']=$val->id;
            $value['name']=$val->name;
            $value['is_active']=$val->is_active;
            if($val->is_active==1){
                $value['status']='<span class="badge bg-success">Active</span>';
            }else{
                $value['status']='<span class="badge bg-danger">Deleted</span>';
            }
            array_push($category,$value);
        }
        return $category;
    }

    public function findById($id){
       
    }
    public function update(Request $request,$id){
      
    }
    public function create(Request $request){
        $category = new Category();
        $category->name = $request->name;
        $category->is_active = 1;
        $category->save();
        return $category;
    }
    public function delete($id){
       
    }
}