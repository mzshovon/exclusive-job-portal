<?php

namespace App\Http\Services;

use App\Models\Exam;

class ApiExamService {

    public function __construct(private Exam $exam){}

    public function getExamsInfo($examType = null)
    {
        return $this->exam::getAllActiveExams($examType);
    }

    public function getQuestionsWithOptionsInfo($examId)
    {
        return $this->exam::getAllQuestionsWithOptionsById($examId);
    }

    public function getScoreInfo($request)
    {
        $questions = $this->exam::getAllQuestionsWithOptionsById($request->parentId, false, false);
        $answers = $this->exam::getAllQuestionsWithOptionsById($request->parentId, true, true);
        $inputQuestionsAnswersArray = array_combine($request->questions, $request->answers);

        $getActualQuestionsAnswersArray = array_combine($questions->toArray(),$answers->toArray());

        $all_marks = $this->exam::getMarkByExamId($request->parentId);
        $difference = count(array_diff($getActualQuestionsAnswersArray, $inputQuestionsAnswersArray));

        $result['total_score'] = $all_marks['total_mark'] - (($all_marks['single_mark'] * $difference) + ($difference * $all_marks['negative_mark']));
        $result['total_marks'] = $all_marks['total_mark'];
        $result['negative_mark'] = $all_marks['negative_mark'];
        return $result;
    }
}
