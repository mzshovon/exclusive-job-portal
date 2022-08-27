<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Image;

class FaqController extends Controller
{
    public function view() {
        $data = array();
        $data['title'] = 'F.A.Q Section';
        $data['faqs'] = Faq::all();
        return view('panel.faq.view',$data);
    }
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                // 'title_en'=>'required',
                // 'title_bn'=>'required',
                // 'description_en'=>'required',
                // 'description_bn'=>'required',
                'is_active'=>'required|in:0,1',
            ]);
            $message = array();
            $about = new Faq();
            $about->title_en = $request->title_en ? $request->title_en : null;
            $about->title_bn = $request->title_bn ? $request->title_bn : null; 
            $about->description_en = $request->description_en ? $request->description_en : null;
            $about->description_bn = $request->description_bn ? $request->description_bn : null;;
            $about->is_active = $request->is_active;
            $about->created_by = Auth::user()->id;
            $about->updated_by = Auth::user()->id;
            $about->ip_address = $request->ip();
            if($about->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'F.A.Q section created successfully!';
                return redirect('faq/create')->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something wrong. Please contact with admin!';
                return redirect('faq/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create F.A.Q Section';
            return view('panel.faq.add',$data);
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
            ]);
            $message = array();
            $about =Faq::find($id);
            $about->title_en = $request->title_en ? $request->title_en : null;
            $about->title_bn = $request->title_bn ? $request->title_bn : null; 
            $about->description_en = $request->description_en ? $request->description_en : null;
            $about->description_bn = $request->description_bn ? $request->description_bn : null;;
            $about->is_active = $request->is_active;
            $about->created_by = Auth::user()->id;
            $about->updated_by = Auth::user()->id;
            $about->ip_address = $request->ip();
            if($about->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'F.A.Q section updated successfully!';
                return redirect()->back()->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Update F.A.Q Section';
            $data['faq'] = Faq::whereId($id)->first();
            return view('panel.faq.edit',$data);
        }
    }
    public function delete(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $role = Faq::find($id);
            if($role->delete()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'F.A.Q section deleted successfully!';
                $staus_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $staus_code = 501;
            }
            return Response::json($message,$staus_code);
        }
    }
}
