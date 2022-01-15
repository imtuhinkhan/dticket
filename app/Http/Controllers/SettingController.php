<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;

class SettingController extends Controller
{
    public $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->middleware('auth');
    }
    public function categoryList(){
        $category = $this->categoryRepository->getAll();
        $theader=['Name','Status'];
        $tag = 'category';
        return view('category.category',compact('theader','category','tag'));
    
    }
    public function categoryAddForm(){
        return view('category.form');
    }

    public function categorySave(Request $req){
        $formData = $req->all();
        $validator = \Validator::make($formData,[
            'name' =>'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'success'=>false,
                'error'=>$validator->getMessageBag()->first()
            ]);
        }

        $category = $this->categoryRepository->create($req);
        return redirect()->route('category');
    }
}
