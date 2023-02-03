<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Chapter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class ChapterController extends Controller
{
    public function view(Request $request)
    {
        $data = array();
        $data['title'] = 'chapters';
        $chapters = Chapter::with('subjects');
        if($request->get('subjectId')){
            $subjectId = $request->get('subjectId');
            $chapters = $chapters->where(function($query) use ($subjectId){
                    $query->whereHas('subjects',function($query2) use ($subjectId){
                            $query2->whereId($subjectId);
                        });
                    });
        }
        $data['chapters'] = $chapters->get();
        return view('panel.chapter.view', $data);
    }
    // Store the chapter info
    public function store(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'title' => 'required|max:255',
                'color' => 'required',
            ]);
            $message = array();
            $chapter = new Chapter();
            $chapter->title = $request->title ? $request->title : null;
            $chapter->description = $request->description ? $request->description : null;
            $chapter->status = $request->status;
            $chapter->color = $request->color;
            // dd($chapter);
            if ($request->hasFile('icon')) {
                $request->validate([
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $file = $request->file('icon');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/chapter/' . $chapter->id . '/';
                $file->move($destination_path, $file_name);
                $chapter->icon = $destination_path . $file_name;
            }
            if ($chapter->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'chapter created successfully!';
                return redirect('chapter/create')->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect('chapter/create')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Create chapter';
            return view('panel.chapter.add', $data);
        }
    }
    public function update($id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'title' => 'required|max:255',
                'color' => 'required',
                // 'icon'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
            ]);
            $message = array();
            $chapter = Chapter::find($id);
            $chapter->title = $request->title ? $request->title : null;
            $chapter->description = $request->description ? $request->description : null;
            $chapter->status = $request->status;
            $chapter->color = $request->color;
            // dd($chapter);
            if ($request->hasFile('icon')) {
                $request->validate([
                    'icon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:500'
                ]);
                $file = $request->file('icon');
                $file_name = time() . '.' . $file->getClientOriginalExtension();
                $destination_path = 'public/dist/img/chapter/' . $chapter->id . '/';
                $file->move($destination_path, $file_name);
                $chapter->icon = $destination_path . $file_name;
            }
            if ($chapter->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'chapter updated successfully!';
                return redirect()->back()->with('message', $message);
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong. Please contact with admin!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['chapter'] = Chapter::find($id);
            $data['title'] = 'Update chapter';
            return view('panel.chapter.edit', $data);
        }
    }
    public function delete(Request $request)
    {
        # code...
    }
    public function change_status(Request $request)
    {
        // if (!auth()->user()->isAbleTo('chapter-delete')) {
        //     return redirect()->route('unauthorized');
        // }
        if ($request->ajax()) {
            $id = $request->id;
            $message = array();
            $status = Chapter::find($id);
            $status->status = $status->status == 1 ? 0 : 1;
            if ($status->save()) {
                $message['alert'] = 'success';
                $message['alert_message'] = 'chapter status changed successfully!';
                $message['chapter_status'] = $status->status == 1 ? 0 : 1;
                $status_code = 200;
            } else {
                $message['alert'] = 'danger';
                $message['alert_message'] = 'Something went wrong! Please contact with admin';
                $status_code = 501;
            }
            return Response::json($message, $status_code);
        }
    }

    // Store the chapter questions info
    public function chapter_question_store($chapter_id, Request $request)
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
                    $chapter = Chapter::find($chapter_id);
                    $chapter->questions()->attach($question->id);
                    $question->answers()->attach($answer->id);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers added to ' . $chapter->title . ' successfully!';
                return redirect()->route('chapter-view')->with('message', $message);
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
                    $chapter = Chapter::find($chapter_id);
                    $chapter->questions()->attach($question->id);
                }
                $message['alert'] = 'success';
                $message['alert_message'] = 'Questions and Answers added to ' . $chapter->title . ' successfully!';
                return redirect()->route('chapter-view')->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Store chapter questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'chapter';
            $data['chapter'] = Chapter::findOrFail($chapter_id);
            $data['data'] = Chapter::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.add', $data);
        }
    }
    // Update the chapter questions info
    public function chapter_question_update($chapter_id, Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'status' => 'required|in:0,1',
                'number' => 'required',
                'type' => 'required|in:1,2',
                'question.*' => 'required|max:255',
                'answer.*' => 'required',
            ]);
            $chapter = Chapter::find($chapter_id);
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
                $message['alert_message'] = 'Questions and Answers updated to ' . $chapter->title . ' successfully!';
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
                $message['alert_message'] = 'Questions and Answers updated to ' . $chapter->title . ' successfully!';
                return redirect()->back()->with('message', $message);
            }
        } elseif ($request->isMethod('get')) {
            $data = array();
            $data['title'] = 'Update questions';
            $data['question_card_title'] = 'Questions Section';
            $data['type'] = 'chapter';
            $data['chapter'] = Chapter::findOrFail($chapter_id);
            $data['data'] = Chapter::with('questions')->get();
            // dd($data['data']);
            return view('panel.question.edit', $data);
        }
    }
}
