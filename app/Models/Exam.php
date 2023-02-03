<?php

namespace App\Models;

use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Exam extends Model
{
    use HasUser;

    public function subjects() {
        return $this->belongsToMany('App\Models\Subject');
    }

    public function chapters() {
        return $this->belongsToMany('App\Models\Chapter');
    }

    public function questions() {
        return $this->belongsToMany('App\Models\Question');
    }

    public function check_subjects()
    {
        if ($this->subjects()->count() > 0) {
            return true;
        } else {
                return false;
        }
    }

    public function check_questions()
    {
        if ($this->questions()->count() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public static function getAllActiveExams($examType = null)
    {
        return $examType == (1 || 2) ?
                self::whereStatus(1)
                ->whereExamType($examType)->get(['id', 'title', 'icon', 'color as color_code',
                    'description', 'status', 'exam_type', 'start_date',
                    'end_date', 'start_time', 'end_time', 'duration']) :
                self::whereStatus(1)
                ->get(['id', 'title', 'icon', 'color as color_code',
                    'description', 'status', 'exam_type', 'start_date',
                    'end_date', 'start_time', 'end_time', 'duration']);
    }

    public static function getMarkByExamId($examId)
    {
        $exam = self::with('questions','subjects')->find($examId);
        if($exam) {
            $collected_question_array = count($exam->questions) > 0 ? collect($exam->questions) : collect($exam->subjects->first()->questions);
            return [
                "total_mark" => ($collected_question_array->count() * $collected_question_array->first()->mark),
                "single_mark" => $collected_question_array->first()->mark,
                "negative_mark" => $collected_question_array->first()->negative_mark,
            ];
        }
    }

    public static function getAllQuestionsWithOptionsById($examId, $options = true, $answers_only = false)
    {
        $exam = self::with('questions')->find($examId);

        if($exam) {

            $exam = $exam->questions->count() > 0 ? $exam->questions : $exam->subjects->first()->questions;

            return collect($exam)->map(function($question) use ($options,$answers_only){
                return !$answers_only ?
                    ($options ? [
                        "id" => $question->id,
                        "question" => $question->name,
                        "mark" => $question->mark,
                        "negative_mark" => $question->negative_mark,
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
