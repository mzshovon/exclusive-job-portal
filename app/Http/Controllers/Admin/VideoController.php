<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class VideoController extends Controller
{
    // View the model info
    public function view()
    {
        $data = array();
        $data['title'] = 'videos';
        $data['videos'] = Video::all();
        return view('panel.model.view',$data);
    }
    // Store the model info
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'title'=>'required|max:255',
                'color'=>'required',
                'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500',
                'subject.*'=>'required',
            ]);
            $message = array();
            $model = new Video();
            $model->title = $request->title ? $request->title : null;
            $model->description = $request->description ? $request->description : null;
            $model->status = $request->status;
            $model->color = $request->color;
            // dd($model);
            if($request->hasFile('icon')) {
                $file = $request->file('icon');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/model/'.$model->id.'/';
                $file->move($destination_path,$file_name);
                $model->icon = $destination_path.$file_name;
            }
            if($model->save()) {
                $model->subjects()->attach($request->subject);
                $message['alert'] = 'success';
                $message['alert_message'] = 'model created successfully!';
                return redirect('model/create')->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect('model/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create model';
            $data['subjects'] = Subject::get();
            return view('panel.model.add',$data);
        }
    }
    public function update($id,Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'title'=>'required|max:255',
                'color'=>'required',
                'subject.*'=>'required',
                // 'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
            $message = array();
            $model = Video::find($id);
            $model->title = $request->title ? $request->title : null;
            $model->description = $request->description ? $request->description : null;
            $model->status = $request->status;
            $model->color = $request->color;
            // dd($model);
            if($request->hasFile('icon')) {
                $file = $request->file('icon');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/model/'.$model->id.'/';
                $file->move($destination_path,$file_name);
                $model->icon = $destination_path.$file_name;
            }
            if($model->save()) {
                $model->subjects()->sync($request->subject);
                $message['alert'] = 'success';
                $message['alert_message'] = 'model updated successfully!';
                return redirect()->back()->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $videos = Video::with('subjects')->find($id);
            $data['subject_list'] = [];
            foreach ($videos->subjects as $key=>$subject) {
                array_push($data['subject_list'] ,$subject->id);
            }
            $data['model']  = $videos;
            $data['title'] = 'Update model';
            $data['subjects'] = Subject::get();
            return view('panel.model.edit',$data);
        }
    }
    public function delete(Request $request)
    {
        # code...
    }
    public function change_status(Request $request) {
        // if (!auth()->user()->isAbleTo('model-delete')) {
        //     return redirect()->route('unauthorized');
        // }
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $status = Video::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if($status->save()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'model status changed successfully!';
                $message['model_status'] = $status->status == 1 ? 0 : 1;
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

