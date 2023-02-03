<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Chapter;
use App\Models\Question;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class SubjectController extends Controller
{
    // View the subject info
    public function view()
    {
        $data = array();
        $data['title'] = 'subjects';
        $data['subjects'] = Subject::all();
        return view('panel.subject.view', $data);
    }
    // Store the subject info
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'title' => 'required|max:255',
                'color' => 'required',
            ]);
            $message = array();
            $subject = new Subject();
            $subject->title = $request->title ? $request->title : null;
            $subject->description = $request->description ? $request->description : null;
            $subject->status = $request->status;
            $subject->color = $request->color;
            // dd($subject);
            if ($request->hasFile('icon')) {
                $request->validate([
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $file = $request->file('icon');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/subject/' . $subject->id . '/';
                $file->move($destination_path, $file_name);
                $subject->icon = $destination_path . $file_name;
            }
            if ($subject->save()) {
                if($request->chapter) {
                    $subject->chapters()->attach($request->chapter);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'subject created successfully!';
                return redirect('subject/create')->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect('subject/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create subject';
            $data['chapters'] = Chapter::get();
            return view('panel.subject.add', $data);
        }
    }
    public function update($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'title' => 'required|max:255',
                'color' => 'required',
                'chapter.*' => 'required',
                // 'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
            $message = array();
            $subject = Subject::find($id);
            $subject->title = $request->title ? $request->title : null;
            $subject->description = $request->description ? $request->description : null;
            $subject->status = $request->status;
            $subject->color = $request->color;
            // dd($subject);
            if ($request->hasFile('icon')) {
                $request->validate([
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $file = $request->file('icon');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/subject/' . $subject->id . '/';
                $file->move($destination_path, $file_name);
                $subject->icon = $destination_path . $file_name;
            }
            if ($subject->save()) {
                if($request->chapter){
                    $subject->chapters()->sync($request->chapter);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'subject updated successfully!';
                return redirect()->back()->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['subject'] = Subject::find($id);
            $data['chapters'] = Chapter::get();
            $data['chapter_list'] = [];
            foreach ($data['subject']->chapters as $key=>$value) {
                array_push($data['chapter_list'] ,$value->id);
            }
            $data['title'] = 'Update subject';
            return view('panel.subject.edit', $data);
        }
    }
    public function delete(Request $request)
    {
        # code...
    }
    public function change_status(Request $request)
    {
        // if (!auth()->user()->isAbleTo('subject-delete')) {
        //     return redirect()->route('unauthorized');
        // }
        if ($request->ajax()) {
            $id = $request->id;
            $message = array();
            $status = Subject::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if ($status->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'subject status changed successfully!';
                $message['subject_status'] = $status->status == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message, $status_code);
        }
    }

    // Store the subject questions info
    public function subject_question_store($subject_id, Request $request)
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
                    $subject = Subject::find($subject_id);
                    $subject->questions()->attach($question->id);
                    $question->answers()->attach($answer->id);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers added to ' . $subject->title . ' successfully!';
                return redirect()->route('subject-view')->with('message', $message);
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
                    $subject = Subject::find($subject_id);
                    $subject->questions()->attach($question->id);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers added to ' . $subject->title . ' successfully!';
                return redirect()->route('subject-view')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Store subject questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'subject';
            $data['subject'] = Subject::findOrFail($subject_id);
            $data['data'] = Subject::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.add', $data);
        }
    }
    // Update the subject questions info
    public function subject_question_update($subject_id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'number' => 'required',
                'type' => 'required|in:1,2',
                'question.*' => 'required|max:255',
                'answer.*' => 'required',
            ]);
            $subject = Subject::find($subject_id);
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
                $message['alert_message'] = 'Questions and Answers updated to ' . $subject->title . ' successfully!';
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
                $message['alert_message'] = 'Questions and Answers updated to ' . $subject->title . ' successfully!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Update questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'subject';
            $data['subject'] = Subject::findOrFail($subject_id);
            $data['data'] = Subject::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.edit', $data);
        }
    }
}
