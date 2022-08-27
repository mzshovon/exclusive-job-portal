<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\PushNotification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;
class NotificationController extends Controller
{
    public function view_push_notification()
    {
        $data = array();
        $data['title'] = 'Push Notification Section';
        $data['push_notifications'] = PushNotification::all();
        return view('panel.push_notification.view',$data);
    }
    public function store_push_notification(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'subject'=>'required',
                'language'=>'required',
            ]);
            $message = array();
            $message = new PushNotification();
            $message->subject = $request->subject;
            $message->duration = $request->duration;
            $message->language = $request->language;
            $message->status = $request->status;
            // $message->token_used = Hash::make(rand(12));
            $message->success_rate = 0;
            $message->code = $request->code ? $request->code:(PushNotification::latest()->first() ? 'BD-EXCLSV-PUSH-'.PushNotification::latest()->first()->id: 'BD-EXCLSV-PUSH-1');
            if($message->save()) {
                if($request->input('submit_and_send')) {
                    $users = User::with('permissions','roles','profile')->whereRoleIs('app user')->pluck('id')->toArray();
                    $message->users()->attach(array_values($users));
                    $message->success_rate = 100;
                    $message->save();
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Push Notification section created successfully!';
                return redirect('notification/push/create')->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this message section!';
                return redirect('notification/push/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create Push Notification Section';
            $password = Hash::make(md5('token13212312'));
            $data['password'] = substr($password, 0, 5).str_repeat('*', strlen($password) - 2).substr($password, strlen($password) - 1, 1);
            return view('panel.push_notification.add',$data);
        }
    }
    public function update_push_notification(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'subject'=>'required',
                'language'=>'required',
            ]);
            $message = array();
            $message = PushNotification::find($id);
            $message->subject = $request->subject;
            $message->duration = $request->duration;
            $message->language = $request->language;
            $message->status = $request->status;
            $message->code = $request->code ? $request->code:(PushNotification::latest()->first() ? 'BD-EXCLSV-SMS-'.PushNotification::latest()->first()->id: 'BD-EXCLSV-SMS-1');
            $message->success_rate = 0;
            if($message->save()) {
                if($request->input('submit_and_send')) {
                    $users = User::with('permissions','roles','profile')->whereRoleIs('app user')->pluck('id')->toArray();
                    $message->users()->sync(array_values($users));
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Message section updated successfully!';
                return redirect()->back()->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this message section!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['push_notification'] = PushNotification::find($id);
            $data['title'] = 'Update Push Notification Section';
            $password = Hash::make(md5('token13212312'));
            $data['password'] = substr($password, 0, 5).str_repeat('*', strlen($password) - 2).substr($password, strlen($password) - 1, 1);
            return view('panel.push_notification.edit',$data);
        }
    }
    public function change_push_notification_status(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $status = PushNotification::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if($status->save()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'Push Notification status has changed successfully!';
                $message['notification_status'] = $status->status == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message,$status_code);
        }
    }
    public function send_push_notification(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $message = PushNotification::find($id);
            $users = User::with('permissions','roles','profile')->whereRoleIs('app user')->pluck('id')->toArray();
            if($message->users()->sync(array_values($users))){
                $message['alert'] = 'success';
                $message['alert_message'] = 'Push Notification sent to all app users successfully!';
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message,$status_code);
        }
    }
    public function view_sms_notification()
    {
        $data = array();
        $data['title'] = 'SMS Section';
        $data['messages'] = Message::all();
        return view('panel.sms.view',$data);
    }
    public function store_sms_notification(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'subject'=>'required',
                'language'=>'required',
            ]);
            $message = array();
            $message = new Message();
            $message->subject = $request->subject;
            $message->duration = $request->duration;
            $message->language = $request->language;
            $message->status = $request->status;
            $message->code = $request->code ? $request->code:(Message::latest()->first() ? 'BD-EXCLSV-SMS-'.Message::latest()->first()->id: 'BD-EXCLSV-SMS-1');
            if($message->save()) {
                if($request->input('submit_and_send')) {
                    $users = User::with('permissions','roles','profile')->whereRoleIs('app user')->pluck('id')->toArray();
                    $message->users()->attach(array_values($users));
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Message section created successfully!';
                return redirect('notification/sms/create')->with('message',$message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this message section!';
                return redirect('notification/sms/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create message Section';
            return view('panel.sms.add',$data);
        }
    }
    public function update_sms_notification(Request $request, $id)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status'=>'required|in:0,1',
                'subject'=>'required',
                'language'=>'required',
            ]);
            $message = array();
            $message = Message::find($id);
            $message->subject = $request->subject;
            $message->duration = $request->duration;
            $message->language = $request->language;
            $message->status = $request->status;
            $message->code = $request->code ? $request->code:(Message::latest()->first() ? 'BD-EXCLSV-SMS-'.Message::latest()->first()->id: 'BD-EXCLSV-SMS-1');
            if($message->save()) {
                if($request->input('submit_and_send')) {
                    $users = User::with('permissions','roles','profile')->whereRoleIs('app user')->pluck('id')->toArray();
                    $message->users()->sync(array_values($users));
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Message section updated successfully!';
                return redirect()->back()->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this message section!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['message'] = Message::find($id);
            $data['title'] = 'Update Message Section';
            return view('panel.sms.edit',$data);
        }
    }
    public function change_sms_notification_status(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $status = Message::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if($status->save()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'Message status has changed successfully!';
                $message['message_status'] = $status->status == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message,$status_code);
        }
    }
    public function send_sms_notification(Request $request)
    {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $message = Message::find($id);
            $users = User::with('permissions','roles','profile')->whereRoleIs('app user')->pluck('id')->toArray();
            if($message->users()->sync(array_values($users))){
                $message['alert'] = 'success';
                $message['alert_message'] = 'SMS sent to all app users successfully!';
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
