<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Video;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class VideoController extends Controller
{
    // View the video info
    public function view()
    {
        $data = array();
        $data['title'] = 'videos';
        $data['videos'] = Video::all();
        return view('panel.video.view',$data);
    }
    // Store the video info
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'title'=>'required|max:255',
                'link'=>'required|max:255',
            ]);
            $message = array();
            $video = new Video();
            $video->title = $request->title ? $request->title : null;
            $video->description = $request->description ? $request->description : null;
            $video->status = $request->status;
            $video->link = $request->link;
            $video->other = $request->other;
            if($video->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'video created successfully!';
                return redirect('video/create')->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect('video/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create video';
            return view('panel.video.add',$data);
        }
    }
    public function update($id,Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'title'=>'required|max:255',
                'link'=>'required|max:255',
            ]);
            $message = array();
            $video = Video::find($id);
            $video->title = $request->title ? $request->title : null;
            $video->description = $request->description ? $request->description : null;
            $video->status = $request->status;
            $video->link = $request->link;
            $video->other = $request->other;
            if($video->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'video updated successfully!';
                return redirect()->back()->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['video']  = Video::find($id);
            $data['title'] = 'Update video';
            return view('panel.video.edit',$data);
        }
    }
    public function delete(Request $request)
    {
        # code...
    }
    public function change_status(Request $request) {
        // if (!auth()->user()->isAbleTo('video-delete')) {
        //     return redirect()->route('unauthorized');
        // }
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $status = Video::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if($status->save()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'video status changed successfully!';
                $message['video_status'] = $status->status == 1 ? 0 : 1;
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

