<?php

namespace App\Http\Services;

use App\Models\Subject;

class ApiSubjectService {

    public function getSubjectsInfo()
    {
        return Subject::getAllActiveSubjects();
    }

    public function getQuestionsWithOptionsInfo($subjectId)
    {
        return Subject::getAllQuestionsById($subjectId);
    }

}
