<?php 
namespace App\Repositories;
use Illuminate\Http\Request;
use App\Interfaces\CrudInterface;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;
class UserRepository implements CrudInterface{

    public function getAll(){
        $user = User::get();
        return $user;
    }

    public function getUserByType($type){
        $allUser = User::with('userDetails')->role($type)->get();
        $user=[];
        $value = [];
        foreach($allUser as $key=>$val){
            $value['id']=$val->id;
            $value['name']=$val->name;
            $value['email']=$val->email;
            $value['phone']=$val->userDetails->phoneNumber;
            $value['photo']=$val->userDetails->photo;
            $value['address']=$val->userDetails->address;
            $value['genderId']=$val->userDetails->gender;
            $value['is_active']=$val->is_active;
            if($val->is_active==1){
                $value['status']='<span class="badge bg-success">Active</span>';
            }else{
                $value['status']='<span class="badge bg-danger">Deactive</span>';
            }

            if($val->userDetails->gender==1){
                $value['gender']='<span class="badge bg-info">Male</span>';
            }else{
                $value['gender']='<span class="badge bg-info">Female</span>';
            }
            array_push($user,$value);
        }
        return $user;
    }

    public function findById($id){
        $user = User::with('userDetails')->where([['id',$id]])->first();
        return $user;
    }

    public function findDetailsByUserId($id){
        $user = UserDetail::where([['user_id',$id]])->first();
        return $user;
    }

   
    public function create(Request $request){
        if($request->id){
            $user= $this->findById($request->id);
            $details= $this->findDetailsByUserId($request->id);
        }else{
            $user = new User();
            $details = new UserDetail();
            $user->email = $request->email;
        }
        $user->name  = $request->name;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $user->is_active = 1;
        $user->save();
        $user->syncRoles([$request->type]);
        if($user){
            $details->user_id = $user->id;
            $details->phoneNumber = $request->phone;
            $details->address = $request->address;
            $details->gender = $request->gender;
            if ($files = $request->file('photo')) {
                $path = 'public/images/user/';
                $fimage = uniqid() . "." . $files->getClientOriginalExtension();
                $files->move($path, $fimage);
                $details->photo = $path.$fimage;
           }
           $details->save();

        }
        return $user;
    }

    public function update(Request $request,$id){

    }

    public function delete($id){
        $user = $this->findById($id);
        $user->is_active=0;
        $user->save();
        return $user;
    }
}