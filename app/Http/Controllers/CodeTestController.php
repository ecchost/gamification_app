<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\UserCodeTestScore;
use App\Models\UserScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CodeTestController extends Controller
{
    //
    public function index($course_id){
        $question = Question::find($course_id);
        $score = UserScore::where("user_id", Auth::id())->where("question_id",$course_id);

        $isFinish = false;
        if($score->count()>0){
            $isFinish = true;
        }

        return view("student_courses.code_test", [
            "question"=>$question,
            'score'=>$score->sum('score'),
            'is_finish'=>$isFinish
        ]);
    }

    public function codeTestSubmit(Request $request){
        $model = UserScore::where("user_id",$request->get("user_id"))->where("question_id",$request->get("question_id"));
        $question = Question::find($request->get("question_id"));
        Log::debug($model->count());
        if($model->count()==0){
            UserScore::create([
                "user_id"=>$request->get("user_id"),
                "question_id"=>$request->get("question_id"),
                "content_id"=>$request->get("content_id"),
                "score"=>$request->get('score') == 10 ? $question->score : 0]
            );

            return redirect(route('student_course.my_course.detail.content', [
                    'course_id'=>$request->get("course_id"),
                    'content_id'=>$request->get('content_id')
                ])
            );
        }
    }
}
