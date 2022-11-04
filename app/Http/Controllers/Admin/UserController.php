<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserImage;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use Illuminate\Support\Facades\Response;
class UserController extends Controller
{
    // View system user template
    public function view() {
        if (!auth()->user()->isAbleTo('users-read')) {
            return redirect()->route('unauthorized');
        }
        $data = array();
        $data['title'] ='System Users';
        $data['users'] = User::with('permissions','roles')->get();
        return view('panel.user.view',$data);
    }
    //View app user template
    public function app_user_view() {
        $data = array();
        $data['title'] ='App Users';
        $data['users'] = User::with('permissions','roles','profile')->whereRoleIs('app user')->get();
        return view('panel.app_user.view',$data);
    }
    // Store the app user info
    public function store(Request $request) {
        if (!auth()->user()->isAbleTo('users-create')) {
            return redirect()->route('unauthorized');
        }
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
    // Update the app usr information
    public function update($id,Request $request) {
        if (!auth()->user()->isAbleTo('users-update')) {
            return redirect()->route('unauthorized');
        }
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
                        $destination_path = 'public/dist/img/user/'.$user->id.'/';
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
        if (!auth()->user()->isAbleTo('users-delete')) {
            return redirect()->route('unauthorized');
        }
    }
    public function change_status(Request $request) {
        if (!auth()->user()->isAbleTo('users-delete')) {
            return redirect()->route('unauthorized');
        }
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $status = User::find($id);
            $status->is_active = $status->is_active == 1 ? 0 : 1;
            if($status->save()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'About section deleted successfully!';
                $message['user_status'] = $status->is_active == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message,$status_code);
        }
    }
    public function find_user($email,$user_id) {
        if(!$user_id) {
            $user = User::whereEmail($email)->first();
        } else {
            $user = User::whereEmail($email)->whereNotIn("id",[$user_id])->first();
        }
        if($user) {
            return false;
        } else {
            return true;
        }
    }

    public function profile() {
        $data = array();
        $data['profile'] = Auth::user();
        return view("panel.profile.view", $data);
    }

    public function update_profile(Request $request, $id) {
        $profile = User::find($id);
        $profile->name = $request->name;
        $profile->email = $request->email;
        $profile->address = $request->address;
        if($request->password) {
            $profile->password = Hash::make($request->password);
        }
        if($profile->save()) {
            if($request->hasFile('image')) {
                $image = new UserImage();
                $file = $request->file('image');
                $file_name = time().'.'.$file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/user/'.$profile->id.'/';
                $file->move($destination_path,$file_name);
                $image->image_path = $destination_path.$file_name;
                $image->user_id = $profile->id;
                $image->created_by = Auth::user()->id;
                $image->updated_by = Auth::user()->id;
                $image->ip_address = $request->ip();
                $image->save();
            }
            $message['alert'] = 'success';
            $message['alert_message'] = 'Profile updated successfully!';
            return redirect()->back()->with('message',$message);
        }
    }
}
