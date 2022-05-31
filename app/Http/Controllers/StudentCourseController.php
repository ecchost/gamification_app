<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\StudentCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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
            $student_courses = Course::select("*")
                ->join("student_courses", "courses.id", "=", "student_courses.course_id")
                ->where("student_courses.user_id", $user_id)->get();

            return view("student_courses.index", ["studentCourses" => $student_courses]);
        }
    }

    public function takeCourse(Request $request){
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $student_course = StudentCourse::create(["user_id"=>$user_id, "course_id" => $request["course_id"]]);
            if($student_course->save()){
                return redirect("student_course.my_course");
            }
        }
    }
}
