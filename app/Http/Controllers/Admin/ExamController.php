<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
class ExamController extends Controller
{
    // View the exam info
    public function view()
    {
        $data = array();
        $data['title'] = 'Exams';
        $data['exams'] = Exam::all();
        return view('panel.exam.view', $data);
    }
    // Store the exam info
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'title' => 'required|max:255',
                'exam_type' => 'required|in:1,2',
                'duration' => 'required',
            ]);
            $message = array();
            $exam = new Exam();
            $exam->title = $request->title ? $request->title : null;
            $exam->status = $request->status;
            $exam->exam_type = $request->exam_type;
            $exam->color = $request->color;
            $exam->duration = $request->duration;
            $exam->start_date = $request->date_duration ? Carbon::parse(trim(explode('-',$request->date_duration)[0],' '))->format('Y-m-d') : null;
            $exam->end_date = $request->date_duration ? Carbon::parse(trim(explode('-',$request->date_duration)[1],' '))->format('Y-m-d'): null;
            $exam->start_time = $request->start_time ?? null;
            $exam->end_time = $request->end_time ?? null;
            $exam->description = $request->description ? $request->description : null;
            if ($request->hasFile('icon')) {
                $request->validate([
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $file = $request->file('icon');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/exam/' . $exam->id . '/';
                $file->move($destination_path, $file_name);
                $exam->icon = $destination_path . $file_name;
            }
            if ($exam->save()) {
                if ($request->subject) {
                    $exam->subjects()->attach($request->subject);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Exam created successfully!';
                return redirect('exam/create')->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect('exam/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create exam';
            $data['chapters'] = Chapter::get();
            return view('panel.exam.add', $data);
        }
    }
    // Update the exam info
    public function update($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'title' => 'required|max:255',
                'exam_type' => 'required|in:1,2',
                'duration' => 'required',
            ]);
            $message = array();
            $exam = Exam::find($id);
            $exam->title = $request->title ? $request->title : null;
            $exam->status = $request->status;
            $exam->exam_type = $request->exam_type;
            $exam->color = $request->color;
            $exam->duration = $request->duration;
            $exam->start_date = $request->date_duration ? Carbon::parse(trim(explode('-',$request->date_duration)[0],' '))->format('Y-m-d') : null;
            $exam->end_date = $request->date_duration ? Carbon::parse(trim(explode('-',$request->date_duration)[1],' '))->format('Y-m-d'): null;
            $exam->start_time = $request->start_time ?? null;
            $exam->end_time = $request->end_time ?? null;
            $exam->description = $request->description ? $request->description : null;
            // dd($exam);
            if ($request->hasFile('icon')) {
                $request->validate([
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $file = $request->file('icon');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/exam/' . $exam->id . '/';
                $file->move($destination_path, $file_name);
                $exam->icon = $destination_path . $file_name;
            }
            if ($exam->save()) {
                if ($request->subject) {
                    $exam->subjects()->sync($request->subject);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Exam updated successfully!';
                return redirect()->back()->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['exam'] = Exam::find($id);
            $data['chapters'] = Chapter::all();
            $data['title'] = 'Update exam';
            return view('panel.exam.edit', $data);
        }
    }
    public function delete(Request $request)
    {
        # code...
    }
    // Change status of exams
    public function change_status(Request $request)
    {
        // if (!auth()->user()->isAbleTo('exam-delete')) {
        //     return redirect()->route('unauthorized');
        // }
        if ($request->ajax()) {
            $id = $request->id;
            $message = array();
            $status = Exam::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if ($status->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'Exam status changed successfully!';
                $message['exam_status'] = $status->status == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message, $status_code);
        }
    }
    public function getQuestions(Request $request)
    {
        // if (!auth()->user()->isAbleTo('exam-delete')) {
        //     return redirect()->route('unauthorized');
        // }
        if ($request->ajax()) {
            $id = $request->get('id');
            $message = array();
            $data = Subject::with('questions')->find($id);
            if ($data) {
                $message['data'] = collect($data->questions)->map(function($question){
                    return [
                        "id" => $question->id,
                        "text" => $question->name
                    ];
                });
                $status_code = 200;
            } else {
                $message['data'] = $data;
                $status_code = 501;
            }
            return Response::json($message, $status_code);
        }
    }

    // Store the exam questions info
    public function exam_question_store($exam_id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'mark' => 'required',
                'number' => 'required',
                'type' => 'required|in:1,2',
                'questions.*' => 'required',
            ]);
            $exam = Exam::find($exam_id);
            $exam->questions()->attach($request->questions);
            $message['alert'] = 'success';
            $message['alert_message'] = 'Questions and Answers added to ' . $exam->title . ' successfully!';
            return redirect()->route('exam-view')->with('message', $message);
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Store Exam questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'exam';
            $data['exam'] = Exam::findOrFail($exam_id);
            $data['written_subjects'] = Subject::with('questions')->whereHas('questions', function($q){
                $q->whereType(2);
            })->get();
            $data['mcq_subjects'] = Subject::with('questions')->whereHas('questions', function($q){
                $q->whereType(1);
            })->get();
            $data['data'] = Exam::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.exam', $data);
        }
    }
    // Update the exam questions info
    public function exam_question_update($exam_id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'number' => 'required',
                'type' => 'required|in:1,2',
                'question.*' => 'required|max:255',
                'answer.*' => 'required',
            ]);
            $exam = Exam::find($exam_id);
            if ($request->type == 1) {
                foreach ($request->question as $key => $value) {
                    $question = Question::find($key);
                    $question->name = $value;
                    $question->save();
                }
                foreach ($request->description as $key => $value) {
                    $question = Question::find($key);
                    $question->description = $value;
                    $question->save();
                }
                foreach ($request->answer as $key => $value) {
                    $answer = Answer::find($key);
                    $answer->name = $value;
                    $answer->is_answer = $request->input('is_answer_'.$key,'') == 1 ?? 0;
                    $answer->save();
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers updated to ' . $exam->title . ' successfully!';
                return redirect()->back()->with('message', $message);
            }
            if ($request->type == 2) {
                foreach ($request->question as $key => $value) {
                    $question = Question::find($key);
                    $question->name = $value;
                    $question->save();
                }
                foreach ($request->answer as $key => $value) {
                    $answer = Answer::find($key);
                    $answer->name = $value;
                    $answer->is_answer = 1;
                    $answer->save();
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers updated to ' . $exam->title . ' successfully!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Update questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'exam';
            $data['subject'] = Exam::findOrFail($exam_id);
            $data['data'] = Exam::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.edit', $data);
        }
    }
}
