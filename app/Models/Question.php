<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    use HasUser;

    public function subjects() {
        return $this->belongsToMany('App\Models\Subject');
    }

    public function chapters() {
        return $this->belongsToMany('App\Models\Chapter');
    }

    public function answers() {
        return $this->belongsToMany('App\Models\Answer');
    }

    public function comments() {
        return $this->belongsToMany('App\Models\Comment');
    }
}
