<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Excel;
use Carbon\Carbon;
use App\Exports\ExcelExport;
use App\Exports\SubjectExcelExport;
use App\Exports\ExamExcelExport;
use App\Exports\UserExcelExport;
use App\Models\User;
use App\Imports\ImportQuestionAnswerExcel;
use App\Imports\QuestionsImport;
use App\Models\Chapter;

class ExcelController extends Controller
{
    public function export_question_answer_excel($name, $id)
    {
        if ($name == 'subject') {
            $subject = Subject::find($id);
            return Excel::download(new ExcelExport($subject),$subject->title.' subject questions and answers.xlsx');
        } elseif ($name == 'exam') {
            $exam = Exam::find($id);
            return Excel::download(new ExcelExport($exam),$exam->title.' exam questions and answers.xlsx');
        }
    }
    public function export_subject_excel()
    {
        return Excel::download(new SubjectExcelExport(Subject::all()),'subject.xlsx');
    }
    public function export_exam_excel()
    {
        return Excel::download(new ExamExcelExport(Exam::all()),'exam.xlsx');
    }
    public function export_user_excel()
    {
        return Excel::download(new UserExcelExport(User::with('permissions','roles','profile')->whereRoleIs('app user')->get()),'exam.xlsx');
    }
    public function export_package_excel()
    {
        return Excel::download(new ExamExcelExport(Exam::all()),'exam.xlsx');
    }
    public function export_permission_excel()
    {
        return Excel::download(new ExamExcelExport(Exam::all()),'exam.xlsx');
    }
    // Uplaod and Store the subject/exams questions info
    public function question_store_from_excel($upload_type, $id, Request $request)
    {
        if ($request->hasFile('excel')) {
            $data = [];
            $data['mark'] = $request->mark;
            $data['type'] = $request->type;
            $data['negative_mark'] = $request->negative_mark;
            $data['id'] = $id;
            $data['upload_type'] = $upload_type;
            if(Excel::import(new ImportQuestionAnswerExcel($data),$request->file('excel'))) {
                $message['alert'] = 'success';
                // dd($upload_type);
                $message['alert_message'] = 'Questions and Answers added to ' . ($upload_type == "subject" ? Subject::find($id)->title : ($upload_type == "chapter" ? Chapter::find($id)->title : Exam::find($id)->title) ) . ' successfully!';
                return redirect()->route(($upload_type == "subject" ? 'subject-view' : 'exam-view'))->with('message', $message);
            }
        }
    }
}
