<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
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
            $data['subjects'] = Subject::get();
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
            $data['subjects'] = Subject::all();
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

    // Store the exam questions info
    public function exam_question_store($exam_id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'mark' => 'required',
                'number' => 'required',
                'type' => 'required|in:1,2',
                'question_.*' => 'required|max:255',
                'answer_.*' => 'required',
            ]);
            if ($request->type == 2) {
                for ($i = 1; $i <= ($request->number); $i++) {
                    $question = new Question();
                    $question->name = $request->input('question_' . $i, '');
                    $question->mark = $request->mark;
                    $question->negative_mark = $request->negative_mark;
                    $question->type = $request->type;
                    $question->status = $request->status;
                    $question->save();
                    $answer = new Answer();
                    $answer->name = $request->input('answer_' . $i, '');
                    $answer->is_answer = 1;
                    $answer->description = $request->description ?? null;
                    $answer->save();
                    $exam = Exam::find($exam_id);
                    $exam->questions()->attach($question->id);
                    $question->answers()->attach($answer->id);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers added to ' . $exam->title . ' successfully!';
                return redirect()->route('exam-view')->with('message', $message);
            }
            if ($request->type == 1) {
                for ($i = 1; $i <= ($request->number); $i++) {
                    $question = new Question();
                    $question->name = $request->input('question_' . $i, '');
                    $question->description = $request->input('description_' . $i, '');
                    $question->mark = $request->mark;
                    $question->negative_mark = $request->negative_mark;
                    $question->type = $request->type;
                    $question->status = $request->status;
                    $question->save();
                    for ($j = 1; $j <= 10; $j++) {
                        if ($request->input('answer_' . $i . '_' . $j, '')) {
                            $answer = new Answer();
                            $answer->name = $request->input('answer_' . $i . '_' . $j, '');
                            $answer->is_answer = $request->input('is_answer_' . $i . '_' . $j, '') == 1 ?? 0;
                            $answer->description = $request->description ?? null;
                            $answer->save();
                            $question->answers()->attach($answer->id);
                        }
                        continue;
                    }
                    $exam = Exam::find($exam_id);
                    $exam->questions()->attach($question->id);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers added to ' . $exam->title . ' successfully!';
                return redirect()->route('exam-view')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Store Exam questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'exam';
            $data['subject'] = Exam::findOrFail($exam_id);
            $data['data'] = Exam::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.add', $data);
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
