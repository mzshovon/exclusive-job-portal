<?php

namespace App\Http\Services;

use App\Models\Chapter;
use App\Models\Subject;

class ApiSubjectService {

    public function __construct(private Subject $subject, private Chapter $chapter){}

    public function getSubjectsInfo()
    {
        return $this->subject::getAllActiveSubjects();
    }

    public function getQuestionsWithOptionsInfo($subjectId)
    {
        return $this->subject::getAllQuestionsWithOptionsById($subjectId);
    }

    public function getChapterQuestionsWithOptionsInfo($subjectId)
    {
        return $this->chapter::getAllQuestionsWithOptionsById($subjectId);
    }

    public function getChapterInfo($subjectId)
    {
        return $this->subject::getAllChaptersBySubjectId($subjectId);
    }

    public function getScoreInfo($request)
    {
        $questions = $this->subject::getAllQuestionsWithOptionsById($request->parentId, false, false);
        $answers = $this->subject::getAllQuestionsWithOptionsById($request->parentId, true, true);
        $inputQuestionsAnswersArray = array_combine($request->questions, $request->answers);

        $getActualQuestionsAnswersArray = array_combine($questions->toArray(),$answers->toArray());

        $all_marks = $this->subject::getMarkBySubjectId($request->parentId);
        $difference = count(array_diff($getActualQuestionsAnswersArray, $inputQuestionsAnswersArray));

        $result['total_score'] = $all_marks['total_mark'] - (($all_marks['single_mark'] * $difference) + ($difference * $all_marks['negative_mark']));
        $result['total_marks'] = $all_marks['total_mark'];
        $result['negative_mark'] = $all_marks['negative_mark'];
        return $result;
    }

}
