<?php

namespace App\Http\Controllers;

use App\Models\BadgeSetting;
use App\Models\Content;
use App\Models\Course;
use App\Models\Question;
use App\Models\StudentCourse;
use App\Models\UserScore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentCourseController extends Controller
{
    //

    function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        if(Auth::check()) {
            $user_id = Auth::user()->id;
            $student_courses = Course::select(["courses.id", "courses.course_name", "courses.description"])
                ->join("student_courses", "courses.id", "=", "student_courses.course_id")
                ->where("student_courses.user_id", $user_id)->get();
            return view("student_courses.index", ["studentCourses" => $student_courses]);
        }
    }

    public function detail($course_id){
        $course = Course::find($course_id);
        $total_score = UserScore::where("user_id", Auth::id())->sum("score");
        $current_badge = BadgeSetting::where("min", "<=",$total_score)->where("max",">=", $total_score)->first();

        $leader_board = UserScore::select(DB::raw("DISTINCT user_id, SUM(score) as total_score"))->groupBy("user_id")->orderBy("total_score", "DESC")->get();

        return view("student_courses.detail", [
            "course"=>$course,
            "total_score"=> $total_score,
            "current_badge" => $current_badge,
            "leader_board" => $leader_board
        ]);
    }
    public function takeCourse(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $check_course = StudentCourse::where(["user_id"=>$user_id, "course_id" => $request["course_id"]]);
            if($check_course->count()==0){
                $student_course = StudentCourse::create(["user_id"=>$user_id, "course_id" => $request["course_id"]]);
                if($student_course->save()){
                    return redirect("student_course.my_course");
                }
            } else {
                session()->flash('msg_error', 'You already take it');
                return redirect()->back();
            }

        }
    }

    public function my_course($course_id, $content_id = null){
        $course = Course::find($course_id);
        $contents = $content_id != null ? Content::find($content_id): $course->lessons[0]->contents->first();
        $user_score = UserScore::where(["content_id" => $content_id == null ? $contents->id : $content_id, "user_id" => Auth::id()])->first();
        $total_score = UserScore::where("user_id", Auth::id())->sum("score");
        $active_lesson = $content_id != null ? Content::find($content_id)->lesson : $course->lessons->first();
        $current_badge = BadgeSetting::where("min", "<=",$total_score)->where("max",">=", $total_score)->first();
        $questions = Question::where(["is_essay"=>"0", "content_id" => $content_id])->get();
        $code_test = Question::where(["is_essay"=>"1", "content_id" => $content_id])->get();

        return view("student_courses.my_course", [
            "course"=>$course,
            "content"=>$contents,
            "score"=>$user_score,
            "total_score"=> $total_score,
            "active_lesson"=> $active_lesson,
            "active_content" => $contents,
            "current_badge" => $current_badge,
            "questions"=>$questions,
            "code_tests"=>$code_test,
        ]);
    }

    public function upload_java_file(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $check_course = StudentCourse::where(["user_id"=>$user_id, "course_id" => $request["course_id"]]);
            if($check_course->count()==0){
                $student_course = StudentCourse::create(["user_id"=>$user_id, "course_id" => $request["course_id"]]);
                if($student_course->save()){
                    return redirect("student_course.my_course");
                }
            } else {
                session()->flash('msg_error', 'You already take it');
                return redirect()->back();
            }

        }
    }
}
