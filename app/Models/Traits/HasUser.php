<?php
namespace App\Models\Traits;
use Illuminate\Support\Facades\Auth;

trait HasUser {
    public static function bootHasUser()
    {
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
}
