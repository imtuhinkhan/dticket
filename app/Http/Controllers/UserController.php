<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Alert;
use Auth;
class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository )
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');   
    }

    private function checkAuth(){
        if(!Auth::user()->hasRole('admin')){
            dd('Unauthorize Action');
        }
    }

    public function userList($type){
        $this->checkAuth();
        $userList = $this->userRepository->getUserByType($type);
        $theader=['Name','Email','Phone','Photo','Address','Gender','Status'];
        $tag = 'user/'.$type;
        return view('user.user',compact('theader','userList','tag'));
    }

    public function userAddForm($type){
        $this->checkAuth();
        return view('user.form',compact('type'));
    }

    public function userSave(Request $req){
        $this->checkAuth();
        $formData = $req->all();
        if($req->id){
            $validator = \Validator::make($formData,[
                'name' =>'required',
                'phone' =>'required',
            ]); 
        }else{
            $validator = \Validator::make($formData,[
                'name' =>'required',
                'email' =>['required','unique:users'],
                'phone' =>'required',
            ]);
        }
        

        if($validator->fails()){
            Alert::error('Something Went Wrong', $validator->getMessageBag()->first());
            return redirect()->back();
        }
        $user = $this->userRepository->create($req);

        if($req->id){
            toast('User updated','success');
        }else{
            toast('User Added','success');
        }

        if(!$user){
            Alert::error('Error','Something Went Wrong');
            return redirect()->back();

        }else{
            return redirect('user/'.$req->type);
        }
    }

    public function userEdit($type,$id){
        $this->checkAuth();
        $user = $this->userRepository->findById($id);
        return view('user.form',compact('type','user'));

    }

    public function userDelete($type,$id){
        $this->checkAuth();
        toast('User Deactivated','info');
        $user = $this->userRepository->delete($id);
        return redirect('user/'.$type);

    }
}
