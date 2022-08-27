<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Comment extends Model
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
    public function questions() {
        return $this->belongsToMany('App\Models\Question');
    }
    public function replies() {
        return $this->belongsToMany('App\Models\Reply');
    }
    public function user() {
        return User::find($this->updated_by);
    }
}
