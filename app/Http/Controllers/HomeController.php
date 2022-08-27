<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data = array();
        $data['comments'] = Comment::with('questions','replies')->whereSeen(0)->orderBy('created_at','desc')->take(6)->get();
        return view('panel.dashboard.index',$data);
    }
    public function comments_view()
    {
        $data = array();
        $data['comments'] = Comment::with('questions','replies')->whereSeen(0)->orderBy('created_at','desc')->take(6)->get();
        return view('panel.dashboard.comments.view',$data);
    }
    public function comments_store(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data = array();
            $question = Question::find($id);
            $comment = new Comment();
            $comment->comment = $request->comment;
            $comment->seen = 0;
            if ($comment->save()) {
                $question->comments()->attach($comment->id);
                $comment_history = Comment::find($comment->id);
                $data['status'] = 200;
                $data['comment'] = $comment_history;
                $data['username'] = $comment_history->user()->name;
                $data['created_at'] = Carbon::parse($comment_history->updated_at)->format("h:i a ,d-m-Y");
            } else {
                $data['status'] = 401;
            }
            return Response::json( $data);
        }
    }
    public function question_comments_view($id)
    {
        $data = array();
        $data['question'] = Question::with('comments')->find($id);
        return view('panel.dashboard.comments.question_wise_comment_view',$data);
    }
    public function seen_unseen_comment(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id;
            $data = array();
            $comment = Comment::find($id);
            $comment->seen = $comment->seen == 1 ? 0 : 1;
            if ($comment->save()) {
                $data['status'] = 200;
            } else {
                $data['status'] = 401;
            }
            return Response::json( $data);
        }
    }
}
