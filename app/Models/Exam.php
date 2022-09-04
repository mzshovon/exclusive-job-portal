<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    // Insert the current user data while saving date
    use HasUser;
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
