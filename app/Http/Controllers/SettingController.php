<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\CategoryRepository;
use App\Repositories\PriorityRepository;
use App\Repositories\SettingRepository;
use App\Repositories\ServiceRepository;
Use Alert;
class SettingController extends Controller
{
    public $categoryRepository;
    public $serviceRepository;
    public $priorityRepository;
    public $settingRepository;

    public function __construct(CategoryRepository $categoryRepository, PriorityRepository $priorityRepository, SettingRepository $settingRepository, ServiceRepository $serviceRepository )
    {
        $this->categoryRepository = $categoryRepository;
        $this->priorityRepository = $priorityRepository;
        $this->settingRepository = $settingRepository;
        $this->serviceRepository = $serviceRepository;
        $this->middleware('auth');
    }
    //category start
    public function categoryList(){
        $category = $this->categoryRepository->getAll();
        $theader=['Name','Status'];
        $tag = 'setting/category';
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
    //category end

    //service start

    public function serviceList(){
        $service = $this->serviceRepository->getAll();
        $theader=['Name','Status'];
        $tag = 'setting/service';
        return view('service.service',compact('theader','service','tag'));
    
    }
    
    public function serviceAddForm(){
        return view('service.form');
    }

    public function serviceSave(Request $req){
        $formData = $req->all();
        $validator = \Validator::make($formData,[
            'name' =>'required',
        ]);

        if($validator->fails()){
            Alert::error('Something Went Wrong', $validator->getMessageBag()->first());
            return redirect()->back();
        }
        if($req->id){
            $service = $this->serviceRepository->update($req,$req->id);
            toast('Service updated','success');
        }else{
            $service = $this->serviceRepository->create($req);
            toast('Service Added','success');
        }

        if(!$service){
            Alert::error('Error','Something Went Wrong');
            return redirect()->back();

        }else{
            return redirect()->route('service');
        }
    }

    public function serviceEdit($id){
        $service = $this->serviceRepository->findById($id);
        return view('service.form',compact('service'));
    }

    public function serviceDelete($id){
        toast('Service Deactivated','info');
        $service = $this->serviceRepository->delete($id);
        return redirect()->route('service');
    }
    //category end

    //priority start
    public function priorityList(){
        $priority = $this->priorityRepository->getAll();
        $theader=['Name','Status'];
        $tag = 'setting/priority';
        return view('priority.priority',compact('theader','priority','tag'));
    
    }

    public function priorityAddForm(){
        return view('priority.form');
    }

    public function prioritySave(Request $req){
        $formData = $req->all();
        $validator = \Validator::make($formData,[
            'name' =>'required',
        ]);

        if($validator->fails()){
            Alert::error('Something Went Wrong', $validator->getMessageBag()->first());
            return redirect()->back();
        }
        if($req->id){
            $priority = $this->priorityRepository->update($req,$req->id);
            toast('Priority updated','success');
        }else{
            $priority = $this->priorityRepository->create($req);
            toast('Priority Added','success');
        }

        if(!$priority){
            Alert::error('Error','Something Went Wrong');
            return redirect()->back();

        }else{
            return redirect()->route('priority');
        }
    }

    public function priorityEdit($id){
        $priority = $this->priorityRepository->findById($id);
        return view('priority.form',compact('priority'));
    }

    public function priorityDelete($id){
        toast('Priority Deactivated','info');
        $priority = $this->priorityRepository->delete($id);
        return redirect()->route('priority');
    }
    //priority end

    //organization setting start
    public function organizationSetting(){
        $organization = $this->settingRepository->getSetting();
        return view('setting.setting',compact('organization'));
    }

    public function updateOrganization(Request $req){
        $organization = $this->settingRepository->updateOrganization($req);
        toast('Organization information updated','success');
        return redirect()->route('organization');
    }
    //organization setting end

}
