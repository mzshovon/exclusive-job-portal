<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AppUserController extends Controller
{
    public function view() {
        $data = array();
        $data['users'] = User::with('permissions','roles')->paginate(10);
        return view('panel.user.view',$data);
    }
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $request->validate([
                'name'=>'required',
                'email'=>'required',
                'mobile'=>'required|max:12',
                'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
            ]);
            $message = array();
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = implode('',explode('-',$request->mobile));
            $user->is_active = $request->is_active;
            $user->password = Hash::make($request->password);
            $user->address = $request->address;
            if($this->find_user($user->email,null)) {
                if($user->save()) {
                    if($request->hasFile('image')) {
                        $image = new UserImage();
                        $file = $request->file('image');
                        $file_name = time().'.'.$file->getClientOriginalExtension();
                        $destination_path = 'public/dist/img/'.$user->id.'/';
                        $file->move($destination_path,$file_name);
                        $image->image_path = $destination_path.$file_name;
                        $image->user_id = $user->id;
                        $image->created_by = Auth::user()->id;
                        $image->updated_by = Auth::user()->id;
                        $image->ip_address = $request->ip();
                        $image->save();
                    }
                    $permissions = $request->permissions;
                    $role = $request->role;
                    if(!empty($permissions)) {
                        if($user->attachPermissions($permissions)) {
                            $message['alert'] = 'success';
                            $message['alert_message'] = 'User created successfully!';
                            return redirect('user/create')->with('message',$message);
                        } 
                    } else if(empty($permissions)) {
                        if($user->attachRole($role)) {
                            $message['alert'] = 'success';
                            $message['alert_message'] = 'User created successfully!';
                            return redirect('user/create')->with('message',$message);
                        }
                    } else {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Something went wrong!';
                        return redirect('user/create')->with('message', $message);
                    }
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this user email!';
                return redirect('user/create')->with('message', $message);
            }

        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['permissions'] = Permission::all();
            $data['roles'] = Role::all();
            return view('panel.user.add',$data);
        }
    }
    public function update($id,Request $request) {
        if ($request->isMethod('post')) {
            $message = array();
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->mobile = $request->mobile;
            $user->is_active = $request->is_active;
            $user->address = $request->address;
            if($this->find_user($user->email,$id)) {
                if($user->save()) {
                    if($request->hasFile('image')) {
                        $image = new UserImage();
                        $file = $request->file('image');
                        $file_name = time().'.'.$file->getClientOriginalExtension();
                        $destination_path = 'public/dist/img/'.$user->id.'/';
                        $file->move($destination_path,$file_name);
                        $image->image_path = $destination_path.$file_name;
                        $image->user_id = $user->id;
                        $image->created_by = Auth::user()->id;
                        $image->updated_by = Auth::user()->id;
                        $image->ip_address = $request->ip();
                        $image->save();
                    }
                    $permissions = $request->permissions;
                    $role = $request->role;
                    if(!empty($permissions)) {
                        if($user->syncPermissions($permissions)) {
                            $message['alert'] = 'success';
                            $message['alert_message'] = 'User updated successfully!';
                            return redirect()->back()->with('message',$message);
                        } 
                    } else if(empty($permissions)) {
                        if($user->roles()->sync($role)) {
                            $message['alert'] = 'success';
                            $message['alert_message'] = 'User updated successfully!';
                            return redirect()->back()->with('message',$message);
                        }
                    } else {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Something went wrong!';
                        return redirect()->back()->with('message',$message);
                    }
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this user email!';
                return redirect()->back()->with('message',$message);
            }

        } elseif ($request->isMethod('get')) {
            $data = array();
            $permissions_user = array();
            $roles_user = array();
            $data['user'] = User::with('permissions','roles','userimages')->whereId($id)->first();
            $data['permissions'] = Permission::all();
            $data['roles'] = Role::all();
            if(count($data['user']->roles)> 0) {
                foreach ($data['user']->roles as $role){
                    $roles_user[] = $role->id;
                }
            } else {
                foreach ($data['user']->permissions as $permission){
                    $permissions_user[] = $permission->id;
                }
            }
            $data['roles_user'] = $roles_user;
            $data['permissions_user'] = $permissions_user;
            return view('panel.user.edit',$data);
        }
        
    }
    public function delete(Request $request) {

    }
}
