<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    public function users()
    {
        return $this->hasOne('App\Models\User','user_id','id');
    }
}
