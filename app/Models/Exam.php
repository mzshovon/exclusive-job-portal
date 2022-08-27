<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    // Insert the current user data while saving date
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
    public function questions() {
        return $this->belongsToMany('App\Models\Question');
    }
    // Find out is there any subject belongs to the exam
    public function check_subjects()
    {
        if ($this->subjects()->count() > 0) {
            return true;
        } else {
                return false;
        }
    }
    // Find out is there any question belongs to the exam
    public function check_questions()
    {
        if ($this->questions()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
