<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionAnswer extends Model
{
    public function question_answers()
    {
        return $this->belongsToMany(Question::class, Answer::class, 'question_id', 'answer_id');
    }
}
