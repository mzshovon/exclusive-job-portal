<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

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

    public function chapters() {
        return $this->belongsToMany('App\Models\Chapter');
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

    public static function getMarkBySubjectId($subjectId)
    {
        $subject = self::with('questions')->find($subjectId);

        if($subject) {
            $collected_question_array = collect($subject->questions);
            return [
                "total_mark" => ($collected_question_array->count() * $collected_question_array->first()->mark),
                "single_mark" => $collected_question_array->first()->mark,
                "negative_mark" => $collected_question_array->first()->negative_mark,
            ];
        }
    }

    public static function getAllQuestionsWithOptionsById($subjectId, $options = true, $answers_only = false)
    {
        $subject = self::with('questions')->find($subjectId);

        if($subject) {
            return collect($subject->questions)->map(function($question) use ($options,$answers_only){
                return !$answers_only ?
                    ($options ? [
                        "id" => $question->id,
                        "question" => $question->name,
                        "mark" => $question->mark,
                        "negative_mark" => $question->negative_mark,
                        "type" => $question->type == 1 ? 'MCQ' : 'WRITTEN',
                        "status" => $question->status,
                        "options" => self::getAllOptionsWithAnswerByQuestionId($question)
                    ] : $question->id) : self::getAllOptionsWithAnswerByQuestionId($question, true);
            });
        }
    }

    public static function getAllChaptersBySubjectId($subjectId)
    {
        $subject = self::with('chapters')->find($subjectId);

        if($subject) {
            return collect($subject->chapters)->map(function($chapter){
                return [
                    "title" => $chapter->title,
                    "icon" => $chapter->icon,
                    "color_code" => $chapter->color_code,
                    "description" => $chapter->description,
                    "status" => $chapter->status,
                ];
            });
        }
    }

    private static function getAllOptionsWithAnswerByQuestionId($question, $is_answer = false)
    {
        $collected_answer_array = collect($question->answers);

        if($collected_answer_array) {
            return !$is_answer ?
                    $collected_answer_array->map(function($option){
                        return [
                            'id' => $option->id,
                            'option' => $option->name,
                            'is_answer' => $option->is_answer,
                            'description' => $option->description,
                        ];
                    }) : $collected_answer_array->firstWhere('is_answer', 1)->id;
        }
    }
}
