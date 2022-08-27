<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Question extends Model
{
    public static function boot()
    {
        parent::boot();
        static::creating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->created_by = $userid;
            $model->updated_by = $userid;
        });

        static::updating(function($model)
        {
            $userid = (!Auth::guest()) ? Auth::user()->id : null ;
            $model->updated_by = $userid;
        });
    }
    public function subjects() {
        return $this->belongsToMany('App\Models\Subject');
    }
    public function answers() {
        return $this->belongsToMany('App\Models\Answer');
    }
    public function comments() {
        return $this->belongsToMany('App\Models\Comment');
    }
}
