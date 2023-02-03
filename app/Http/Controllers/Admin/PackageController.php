<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ModelSets;
use App\Models\Package;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PackageController extends Controller
{
    // View the package info
    public function view()
    {
        $data = array();
        $data['title'] = 'Package Section';
        $data['packages'] = Package::all();
        return view('panel.package.view',$data);
    }
    // Store the package info
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'title'=>'required|max:255',
                'old_price'=>'required',
                'new_price'=>'required',
                'color'=>'required',
                'duration'=>'required',
                'model.*'=>'required',
                'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
            $message = array();
            $package = new Package();
            $package->title = $request->title ? $request->title : null;
            $package->description = $request->description ? $request->description : null;
            $package->status = $request->status;
            $package->about = $request->about;
            $package->color = $request->color;
            $package->duration = $request->duration ?? 0;
            $package->old_price = $request->old_price;
            $package->new_price = $request->new_price;
            $package->reference_link = $request->reference_link;
            // dd($package);
            if($request->hasFile('icon')) {
                $file = $request->file('icon');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/package/'.$package->id.'/';
                $file->move($destination_path,$file_name);
                $package->icon = $destination_path.$file_name;
            }
            if($package->save()) {
                if($request->model){
                    $package->model_sets()->attach($request->model);
                }
                if($request->section){
                    $package->sections()->attach($request->section);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Package section created successfully!';
                return redirect('package/create')->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect('package/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create Package Section';
            $data['models'] = ModelSets::all();
            $data['sections'] = Section::all();
            return view('panel.package.add',$data);
        }
    }
    public function update($id,Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'title'=>'required|max:255',
                'old_price'=>'required',
                'new_price'=>'required',
                'color'=>'required',
                'duration'=>'required',
                'model.*'=>'required',
                // 'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
            $message = array();
            $package = Package::find($id);
            $package->title = $request->title ? $request->title : null;
            $package->description = $request->description ? $request->description : null;
            $package->status = $request->status;
            $package->about = $request->about;
            $package->color = $request->color;
            $package->duration = $request->duration ?? 0;
            $package->old_price = $request->old_price;
            $package->new_price = $request->new_price;
            $package->reference_link = $request->reference_link;
            // dd($package);
            if($request->hasFile('icon')) {
                $file = $request->file('icon');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/package/'.$package->id.'/';
                $file->move($destination_path,$file_name);
                $package->icon = $destination_path.$file_name;
            }
            if($package->save()) {
                if($request->model){
                    $package->model_sets()->sync($request->model);
                }
                if($request->section){
                    $package->sections()->sync($request->section);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Package section updated successfully!';
                return redirect()->back()->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $packages = Package::with('model_sets', 'sections')->find($id);
            $data['model_list'] = [];
            $data['section_list'] = [];
            foreach ($packages->model_sets as $key=>$model) {
                array_push($data['model_list'] ,$model->id);
            }
            foreach ($packages->sections as $key=>$section) {
                array_push($data['section_list'] ,$section->id);
            }
            $data['package'] = $packages;
            $data['models'] = ModelSets::get();
            $data['sections'] = Section::get();
            $data['title'] = 'Update Package Section';
            return view('panel.package.edit',$data);
        }
    }
    public function delete(Request $request)
    {
        # code...
    }
    public function change_status(Request $request) {
        if (!auth()->user()->isAbleTo('package-delete')) {
            return redirect()->route('unauthorized');
        }
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $status = Package::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if($status->save()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'About section deleted successfully!';
                $message['package_status'] = $status->status == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message,$status_code);
        }
    }
}
