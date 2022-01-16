<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
Use Alert;
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
            Alert::error('Something Went Wrong', $validator->getMessageBag()->first());
            return redirect()->back();
        }
        if($req->id){
            $category = $this->categoryRepository->update($req,$req->id);
            toast('Category updated','success');
        }else{
            $category = $this->categoryRepository->create($req);
            toast('Category Added','success');
        }

        if(!$category){
            Alert::error('Error','Something Went Wrong');
            return redirect()->back();

        }else{
            return redirect()->route('category');
        }
    }

    public function categoryEdit($id){
        $category = $this->categoryRepository->findById($id);
        return view('category.form',compact('category'));
    }

    public function categoryDelete($id){
        toast('Category Deactivated','info');
        $category = $this->categoryRepository->delete($id);
        return redirect()->route('category');
    }
}
