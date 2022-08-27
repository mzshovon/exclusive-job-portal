<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Package extends Model
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
    public function model_sets() {
        return $this->belongsToMany('App\Models\ModelSets');
    }
}
