@extends('layouts.front')

@section('content')
    <section class="section mt-5" id="interactive">
        <div class="row">
            <div class="col-md-8">

                <div>
                    <div class="card" style="height: 450px">

                    </div>
                    @if($content!= null)
                    <h2 class="section-title">{{ $content->title }}</h2>
                    <p class="section-lead">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam.
                    </p>
                    <!-- Your content goes here -->

                        @if(sizeof($content->questions)!=0 && empty($score))
                        <div class="card mt-5">
                            {{ $score }}
                            <div class="card-body">
                                <h6 class="card-title">Questions</h6>
                                <div class="navbar-divider"></div>
                                <div>
                                    @foreach($content->questions as $index=>$question)
                                    <div>{{$index+1}}.{{ $question->question }}<br />
                                        <div class="ml-2">
                                            <small>Your answer</small>
                                            <br />
                                            @foreach($question->answers as $answer)
                                            <div>
                                                <input
                                                    type="radio"
                                                    name="answer_{{$question->id}}"
                                                    value="{{ $answer->id }}"
                                                    v-on:change="changeAnswer({{$index}},{{$answer->id}})"
                                                > {{ $answer->answer }}
                                            </div>
                                            @endforeach
                                        </div>
                                        <br />
                                    </div><br />
                                    @endforeach
                                    <button class="btn btn-primary" v-on:click="checkAnswer({{ \Illuminate\Support\Facades\Auth::id() }}, {{ $content->id }})">Finish</button>
                                </div>

                            </div>
                        </div>
                        @endif
                        @if(!empty($score))
                                <div class="alert alert-primary">
                                    <h3>Your score is: {{ @$score->score }}</h3>
                                </div>
                            @endif
                    @endif
                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fa fa-medal text-primary"></i> Total Score: {{ $total_score }}</h5>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Lesson Content
                        </h5>
                        <div class="accordion" id="accordionExample">
                            @foreach($course->lessons as $index=>$lesson)
                            <div class="accordion-item">
                                    <div  class="accordion-header" data-toggle="collapse" data-target="#item{{$index}}" aria-controls="collapseOne">
                                        {{ $lesson->title }}
                                    </div>
                                <div id="item{{$index}}" class="accordion-collapse collapse {{ $index==0 ? "show": "" }}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $lesson->description }}
                                        <hr class="navbar-divider" />
                                        <div class="list-group row">
                                            @foreach($lesson->contents as $content)
                                                <a href="{{ route("student_course.my_course.detail.content", [$course->id, $content->id]) }}"
                                                    type="button"
                                                    class="list-group-item list-group-item-action"
                                                >
                                                    {{ $content->title }}</a>
                                            @endforeach
                                        </div>

                                    </div>


                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
