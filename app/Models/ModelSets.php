<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class ModelSets extends Model
{
    protected $table = 'models';
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
        return $this->belongsToMany('App\Models\Subject','model_sets_subject','model_id');
    }
    public function packages() {
        return $this->belongsToMany('App\Models\Package');
    }
}
