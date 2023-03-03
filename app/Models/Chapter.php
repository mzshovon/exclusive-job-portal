<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasUser;

    public function exams() {
        return $this->belongsToMany('App\Models\Exams');
    }

    public function subjects() {
        return $this->belongsToMany('App\Models\Subject');
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

    public static function getAllQuestionsWithOptionsById($chapterId, $options = true, $answers_only = false)
    {
        $chapter = self::with('questions')->find($chapterId);

        if($chapter) {
            return collect($chapter->questions)->map(function($question) use ($options,$answers_only){
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
