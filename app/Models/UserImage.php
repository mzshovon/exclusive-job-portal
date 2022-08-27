<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserImage extends Model
{
    public function users()
    {
        return $this->hasOne('App\Models\User','user_id','id');
    }
}
