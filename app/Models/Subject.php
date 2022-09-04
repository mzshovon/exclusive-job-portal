<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{
    use HasUser;
    public function model_sets() {
        return $this->belongsToMany('App\Models\ModelSets');
    }
    public function exams() {
        return $this->belongsToMany('App\Models\Exams');
    }
    public function questions() {
        return $this->belongsToMany('App\Models\Question');
    }
    // Find out is there any question belongs to the subject
    public function check_questions()
    {
        if ($this->questions()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }
}
