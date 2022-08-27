<?php

namespace App\Http\Controllers\Admin;

use App\Events\UserCreated;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RoleController extends Controller
{
    public function view() {
        $data = array();
        $data['roles'] = Role::with('permissions','users')->get();
        return view('panel.role.view',$data);
    }
    public function store(Request $request) {
        if ($request->isMethod('post')) {
            $message = array();
            $role = new Role();
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            if($this->find_role($role->name,null)) {
                if($role->save()) {
                    $permissions = $request->permissions;
                    if($role->permissions()->sync($permissions)) {
                        $message['alert'] = 'success';
                        $message['alert_message'] = 'Role created successfully!';
                        return redirect('role/create')->with('message',$message);
                    } else {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Something went wrong!';
                        return redirect('role/create')->with('message', $message);
                    }
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this role name!';
                return redirect('role/create')->with('message', $message);
            }

        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['permissions'] = Permission::all();
            return view('panel.role.add',$data);
        }
    }
    public function update($id,Request $request) {
        if ($request->isMethod('post')) {
            $message = array();
            $role = Role::find($id);
            $role->name = $request->name;
            $role->display_name = $request->display_name;
            $role->description = $request->description;
            if($this->find_role($role->name,$role->id)) {
                if($role->save()) {
                    $permissions = $request->permissions;
                    if($role->permissions()->sync($permissions)) {
                        $message['alert'] = 'success';
                        $message['alert_message'] = 'Role updated successfully!';
                        return redirect()->back()->with('message',$message);
                    } else {
                        $message['alert'] = 'danger';
                        $message['alert_message'] = 'Something went wrong!';
                        return redirect()->back()->with('message', $message);
                    }
                }
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Duplicate data already exists with this role name!';
                return redirect()->back()->with('message', $message);
            }

        } elseif ($request->isMethod('get')) {
            $data = array();
            $role_permissions = array();
            $data['permissions'] = Permission::all();
            $data['role'] = Role::with('permissions','users')->whereId($id)->first();
            foreach ($data['role']->permissions as $permission){
                $role_permissions[] = $permission->id;
            }
            $data['role_permissions'] = $role_permissions;
            return view('panel.role.edit',$data);
        }
    }
    public function delete(Request $request) {
        if($request->ajax()){
            $id = $request->id;
            $message = array();
            $role = Role::find($id);
            if($role->delete()){
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
    public function permissions_by_role($id) {
        $data = array();
        $role_permissions = array();
        $data['permissions'] = Permission::all();
        $data['role'] = Role::with('permissions','users')->whereId($id)->first();
        foreach ($data['role']->permissions as $permission){
            $role_permissions[] = $permission->id;
        }
        $data['role_permissions'] = $role_permissions;
        return view('panel.permission.role-wise-permissions',$data);
    }
    public function find_role($role_name,$role_id) {
        if(!$role_id) {
            $role = Role::whereName(strtolower($role_name))->first();
        } else {
            $role = Role::whereName(strtolower($role_name))->whereNotIn("id",[$role_id])->first();
        }
        if($role) {
            return false;
        } else {
            return true;
        }
    }
}
