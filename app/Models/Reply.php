<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    public function comments() {
        return $this->belongsToMany('App\Models\Comment');
    }
    public function user() {
        return User::find($this->updated_by);
    }
}
