<?php

namespace App\Http\Controllers;

use App\Models\Question;
use Illuminate\Http\Request;

class CodeTestController extends Controller
{
    //
    public function index($id){
        $question = Question::find($id);
        return view("student_courses.code_test", ["question"=>$question]);
    }
}
