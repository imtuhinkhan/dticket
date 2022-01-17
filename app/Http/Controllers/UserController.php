<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use Alert;

class UserController extends Controller
{
    public $userRepository;

    public function __construct(UserRepository $userRepository )
    {
        $this->userRepository = $userRepository;
        $this->middleware('auth');   
    }

    public function userList($type){
        $userList = $this->userRepository->getUserByType($type);
        $theader=['Name','Email','Phone','Photo','Address','Gender','Status'];
        $tag = 'user/'.$type;
        return view('user.user',compact('theader','userList','tag'));
    }

    public function userAddForm($type){
        return view('user.form',compact('type'));
    }

    public function userSave(Request $req){
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
        $user = $this->userRepository->findById($id);
        return view('user.form',compact('type','user'));

    }

    public function userDelete($type,$id){
        toast('User Deactivated','info');
        $user = $this->userRepository->delete($id);
        return redirect('user/'.$type);

    }
}
