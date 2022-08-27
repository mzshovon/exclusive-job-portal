<?php

namespace App\Models;

use Laratrust\Models\LaratrustPermission;

class Permission extends LaratrustPermission
{
    public $guarded = [];
    public function users() {
        return $this->belongsToMany('App\Models\User');
    }
    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }
    public function permission_name_view(){
        $name = explode('-',$this->name);
        $name = ucfirst($name[0]).' '.ucfirst($name[1]);
        return $name;
    }
}
