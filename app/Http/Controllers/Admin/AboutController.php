<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Image;

class AboutController extends Controller
{
    public function view() {
        $data = array();
        $data['title'] = 'About Section';
        $data['abouts'] = About::all();
        return view('panel.about.view',$data);
    }
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                // 'title_en'=>'required',
                // 'title_bn'=>'required',
                // 'description_en'=>'required',
                // 'description_bn'=>'required',
                'is_active'=>'required|in:0,1',
                'type'=>'required',
                'image_position'=>'required',
                'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $message = array();
            $about = new About();
            $about->title_en = $request->title_en ? $request->title_en : null;
            $about->title_bn = $request->title_bn ? $request->title_bn : null; 
            $about->description_en = $request->description_en ? $request->description_en : null;
            $about->description_bn = $request->description_bn ? $request->description_bn : null;;
            $about->is_active = $request->is_active;
            $about->type = $request->type;
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/about/'.$about->title_en.'/';
                $file->move($destination_path,$file_name);
                $about->image_path = $destination_path.$file_name;
                $about->image_position = $request->image_position;
                $about->created_by = Auth::user()->id;
                $about->updated_by = Auth::user()->id;
                $about->ip_address = $request->ip();
                if($about->is_active == 1) {
                    if($this->check_active($id=null,$request->type)) {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Already an active about section with same type available!';
                        return redirect()->back()->with('message',$message);
                    }
                }
                if($about->save()) {
                    $message['alert'] = 'success';
                    $message['alert_message'] = 'About section created successfully!';
                    return redirect('about/create')->with('message',$message);
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this about section!';
                return redirect('about/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create About Section';
            return view('panel.about.add',$data);
        }
    }
    public function update($id,Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                // 'title_en'=>'required',
                // 'title_bn'=>'required',
                // 'description_en'=>'required',
                // 'description_bn'=>'required',
                'is_active'=>'required|in:0,1',
                'type'=>'required',
                'image_position'=>'required',
            ]);
            $message = array();
            $about =About::find($id);
            $about->title_en = $request->title_en ? $request->title_en : null;
            $about->title_bn = $request->title_bn ? $request->title_bn : null; 
            $about->description_en = $request->description_en ? $request->description_en : null;
            $about->description_bn = $request->description_bn ? $request->description_bn : null;;
            $about->is_active = $request->is_active;
            $about->type = $request->type;
            $about->image_position = $request->image_position;
            $about->created_by = Auth::user()->id;
            $about->updated_by = Auth::user()->id;
            $about->ip_address = $request->ip();
            if($request->hasFile('image')) {
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/about/'.$about->title_en.'/';
                $file->move($destination_path,$file_name);
                $about->image_path = $destination_path.$file_name;
            } 
            if($about->is_active == 1) {
                if($this->check_active($id,$request->type)) {
                    $message['alert'] = 'danger';
                    $message['alert_message'] = 'Already an active about section with same type available!';
                    return redirect()->back()->with('message',$message);
                }
            }
            if($about->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'About section updated successfully!';
                return redirect()->back()->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Update About Section';
            $data['about'] = About::whereId($id)->first();
            return view('panel.about.edit',$data);
        }
        
    }
    public function delete(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $about = About::find($id);
            if($about->delete()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'About section deleted successfully!';
                $staus_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $staus_code = 501;
            }
            return Response::json($message,$staus_code);
        }
    }
    public function check_active($id,$type) {
        if(!$id)
            $check = About::whereIsActive(1)->whereType($type)->get();
        else
            $check = About::whereNotIn("id",[$id])->whereIsActive(1)->whereType($type)->get();
        if(count($check)>0)
            return true;
        else
            return false;
    }
}
