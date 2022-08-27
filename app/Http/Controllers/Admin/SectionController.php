<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SectionController extends Controller
{
        // View the section info
        public function view()
        {
            $data = array();
            $data['title'] = 'section Section';
            $data['sections'] = Section::all();
            return view('panel.section.view',$data);
        }
        // Store the section info
        public function store(Request $request)
        {
            if ($request->isMethod('post')) {
                $request->validate([
                    'status'=>'required|in:0,1',
                    'title'=>'required|max:255',
                    'color'=>'required',
                    'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $message = array();
                $section = new Section();
                $section->title = $request->title ? $request->title : null;
                $section->description = $request->description ? $request->description : null;
                $section->status = $request->status;
                $section->color = $request->color;
                // dd($section);
                if($request->hasFile('icon')) {
                    $file = $request->file('icon');
                    $file_name = time().'.'.$file->getClientOriginalExtension();
                    $destination_path = 'public/dist/img/section/'.$section->id.'/';
                    $file->move($destination_path,$file_name);
                    $section->icon = $destination_path.$file_name;
                }
                if($section->save()) {
                    $message['alert'] = 'success';
                    $message['alert_message'] = 'Section created successfully!';
                    return redirect('section/create')->with('message',$message);
                } else {
                    $message['alert'] = 'danger';
                    $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                    return redirect('section/create')->with('message', $message);
                }
            } elseif ($request->isMethod('get')) {
                $data = array();
                $data['title'] = 'Create section Section';
                return view('panel.section.add',$data);
            }
        }
        public function update($id,Request $request)
        {
            if ($request->isMethod('post')) {
                $request->validate([
                    'status'=>'required|in:0,1',
                    'title'=>'required|max:255',
                    'color'=>'required',
                    // 'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $message = array();
                $section = Section::find($id);
                $section->title = $request->title ? $request->title : null;
                $section->description = $request->description ? $request->description : null;
                $section->status = $request->status;
                $section->color = $request->color;
                // dd($section);
                if($request->hasFile('icon')) {
                    $file = $request->file('icon');
                    $file_name = time().'.'.$file->getClientOriginalExtension();
                    $destination_path = 'public/dist/img/section/'.$section->id.'/';
                    $file->move($destination_path,$file_name);
                    $section->icon = $destination_path.$file_name;
                }
                if($section->save()) {
                    $message['alert'] = 'success';
                    $message['alert_message'] = 'Section updated successfully!';
                    return redirect()->back()->with('message',$message);
                } else {
                    $message['alert'] = 'danger';
                    $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                    return redirect()->back()->with('message', $message);
                }
            } elseif ($request->isMethod('get')) {
                $data = array();
                $data['section'] = Section::find($id);
                $data['title'] = 'Update section Section';
                return view('panel.section.edit',$data);
            }
        }
        public function delete(Request $request)
        {
            # code...
        }
        public function change_status(Request $request) {
            if (!auth()->user()->isAbleTo('section-delete')) {
                return redirect()->route('unauthorized');
            }
            if($request->ajax()){
                $id = $request->id;
                $message = array();
                $status = Section::find($id);
                $status->status = $status->status == 1 ? 0 : 1;
                if($status->save()){
                    $message['alert'] = 'success';
                    $message['alert_message'] = 'Section status changed successfully!';
                    $message['section_status'] = $status->status == 1 ? 0 : 1;
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
