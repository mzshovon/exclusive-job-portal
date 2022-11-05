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

    public function check_questions()
    {
        if ($this->questions()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllActiveSubjects()
    {
        return self::whereStatus(1)->get(['id', 'title', 'icon', 'color as color_code', 'description', 'status']);
    }

    public static function getAllQuestionsById($subjectId)
    {
        $questions_array = [];
        $questions = self::with('questions')->find($subjectId);

        if($questions) {
            foreach($questions->questions as $question) {
                $questions_array[] = [
                        "id" => $question->id,
                        "question" => $question->name,
                        "mark" => $question->mark,
                        "negative_mark" => $question->negative_mark,
                        "type" => $question->type == 1 ? 'MCQ' : 'WRITTEN',
                        "explanation" => $question->description,
                        "status" => $question->status,
                        "options" => self::getAllOptionsWithAnswerByQuestionId($question)
                    ];
            }
        }

        return $questions_array;
    }

    private static function getAllOptionsWithAnswerByQuestionId($question)
    {
        $options_array = [];

        if($question) {
            foreach($question->answers as $option) {
                $options_array[] = [
                    'id' => $option->id,
                    'option' => $option->name,
                    'is_answer' => $option->is_answer,
                    'description' => $option->description,
                ];
            }
        }

        return $options_array;
    }
}
