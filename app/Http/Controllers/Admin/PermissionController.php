<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class PermissionController extends Controller
{
    public function view() {
        $data = array();
        $data['title'] = "Permissions";
        $data['permissions'] = Permission::with('roles','users')->get();
        return view('panel.permission.view',$data);
    }
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $message = array();
            $permission = new Permission();
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            // dd($permission);
            if($this->find_permission($permission->name,null)) {
                if($permission->save()) {
                    $roles = $request->roles;
                    if($permission->roles()->sync($roles)) {
                        $message['alert'] = 'success';
                        $message['alert_message'] = 'Permission created successfully!';
                        return redirect('permission/create')->with('message',$message);
                    } else {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Something went wrong!';
                        return redirect('permission/create')->with('message', $message);
                    }
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this permission name!';
                return redirect('permission/create')->with('message', $message);
            }

        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = "Add Permission";
            $data['roles'] = Role::all();
            return view('panel.permission.add',$data);
        }
    }
    public function update($id,Request $request) {
        if ($request->isMethod('post')) {
            $message = array();
            $permission = Permission::find($id);
            $permission->name = $request->name;
            $permission->display_name = $request->display_name;
            $permission->description = $request->description;
            if($this->find_permission($permission->name,$permission->id)) {
                if($permission->save()) {
                    $roles = $request->roles;
                    if($permission->roles()->sync($roles)) {
                        $message['alert'] = 'success';
                        $message['alert_message'] = 'Permission updated successfully!';
                        return redirect()->back()->with('message',$message);
                    } else {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Something went wrong!';
                        return redirect()->back()->with('message', $message);
                    }
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this permission name!';
                return redirect()->back()->with('message', $message);
            }

        } elseif ($request->isMethod('get')) {
            $data = array();
            $permission_roles = array();
            $data['title'] = "Update Permission";
            $data['roles'] = Role::all();
            $data['permission'] = Permission::with('roles','users')->whereId($id)->first();
            foreach ($data['permission']->roles as $role){
                $permission_roles[] = $role->id;
            }
            $data['permission_roles'] = $permission_roles;
            return view('panel.permission.edit',$data);
        }
    }
    public function delete(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $permission = Permission::find($id);
            if($permission->delete()){
                $message['alert'] = 'success';
                $message['alert_message'] = 'Role deleted successfully!';
                $staus_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $staus_code = 501;
            }
            return Response::json($message,$staus_code);
        }
    }
    public function find_permission($permission_name,$permission_id) {
        if(!$permission_id) {
            $permission = Permission::whereName(strtolower($permission_name))->first();
        } else {
            $permission = Permission::whereName(strtolower($permission_name))->whereNotIn("id",[$permission_id])->first();
        }
        if($permission) {
            return false;
        } else {
            return true;
        }
    }
}
