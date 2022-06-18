@extends('layouts.front')

@section('content')
    <style>

        .ql-container.ql-snow {
            border: none;
        }

        .ql-editor {
            box-sizing: border-box;
            line-height: 1.42;
            height: 100%;
            outline: none;
            overflow-y: auto;
            padding: 0px;
            tab-size: 4;
            -moz-tab-size: 4;
            text-align: left;
            white-space: pre-wrap;
            word-wrap: break-word;
        }

        .ql-snow .ql-editor pre.ql-syntax {
            background-color: #f3f3f3;
            color: #1f1f1f;
            overflow: visible;
        }

        .code-editor{
            padding: 20px;
            background: #f3f3f3;
            margin-top: 10px;
        }

        .code-editor-wrapper{
            height: 300px;
        }


    </style>
    <section class="section mt-5" id="interactive">
        <div class="row">
            <div class="col-md-8">

                <div>
                    <div class="card" style="height: 450px">

                    </div>
                    @if($content!= null)
                        <h2 class="section-title">{{ $content->title }}</h2>
                        <div class="section-lead">
                            <div>{!! $content->description !!}</div>
                            <br/><br/>
                        </div>
                        <!-- Your content goes here -->

                        @if(sizeof($questions)!=0 && empty($score))
                            <div class="card mt-5">
                                {{ $score }}
                                <div class="card-body">
                                    <h6 class="card-title">Questions</h6>
                                    <div class="navbar-divider"></div>
                                    <div>
                                        @foreach($questions as $index=>$question)
                                            @if($question->is_essay == "0")
                                                <div>{{$index+1}}
                                                    .{{ $question->question }} {{ $question->is_essay == 1 }}<br/>
                                                    <div class="ml-2">
                                                        <small>Your answer</small>
                                                        <br/>
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
                                                    <br/>
                                                </div><br/>
                                            @endif
                                        @endforeach

                                        <button class="btn btn-primary"
                                                v-on:click="checkAnswer({{ \Illuminate\Support\Facades\Auth::id() }}, {{ $content->id }})">
                                            Finish
                                        </button>
                                    </div>

                                </div>
                            </div>
                        @endif


                        @if(sizeof($code_tests)!=0)
                            <div class="card">
                                <div class="card-body">
                                    <div>
                                        <h3 class="card-title">Code Test</h3>
                                    </div>
                                    @foreach($code_tests as $index=>$question)
                                        <div>
                                            {!! $question->question !!}
                                            <a href="{{ route("code_test", ["question_id"=>$question->id]) }}" class="btn btn-primary">Lest Test</a>
{{--                                            <br><hr />--}}
{{--                                            <b>write your answer</b>--}}
{{--                                            <button class="btn btn-primary" onclick="runCode('{{ 'sc'.$index }}')">Run</button>--}}
{{--                                            <div class="code-editor-wrapper">--}}
{{--                                                <div id="sc{{$index}}" class="editor"></div>--}}
{{--                                                <br clear="all" />--}}
{{--                                            </div>--}}

{{--                                            <br clear="all" />--}}

{{--                                            <br /><br />--}}
{{--                                            Output<br />--}}
{{--                                            <pre class="code-editor" id="output_sc{{$index}}"></pre>--}}
                                        </div>
                                    @endforeach
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
                        <h5 class="card-title"><i class="fa fa-medal text-primary"></i> Total Score: {{ $total_score }}
                        </h5>
                        <div class="alert alert-info">
                            Your Badge is <b>{{ $current_badge->name }}</b>
                        </div>
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
                                    <div class="accordion-header" data-toggle="collapse"
                                         data-target="#item{{$index}}"
                                         aria-expanded="{{ $active_lesson->id == $lesson->id ? "true" : "false" }}"
                                         aria-controls="collapseOne">
                                        {{ $lesson->title }}
                                    </div>
                                    <div id="item{{$index}}"
                                         class="accordion-collapse collapse {{ $active_lesson->id == $lesson->id ? "show": "" }}"
                                         aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <div class="list-group row list-group-flush">
                                                @foreach($lesson->contents as $content)
                                                    <a href="{{ route("student_course.my_course.detail.content", [$course->id, $content->id]) }}"
                                                       type="button"
                                                       class="list-group-item list-group-item-action {{ $content->id == $active_content->id ? "active" : "" }}"
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

@section("scripts")
    <script src="{{ asset("js/prism.js") }}"></script>
    <script src="{{ asset("js/codeflask.min.js") }}"></script>
<script>
    const flask = new CodeFlask('.editor', {
        language: 'js',
        lineNumbers: true,
        handleTabs: true,
    });

    flask.addLanguage('java', Prism.languages['java']);


    function runCode(id){
        console.log("running");
        //let codes = ($('#'+id).text());
        let to_compile = {
            "code": flask.getCode(),
            "user": '{{\Illuminate\Support\Facades\Auth::user()->email}}',
        };
        $.ajax ({
            url: "http://localhost:8000/compiler/run",
            type: "POST",
            data: to_compile
        }).done(function(data) {
            $('#output_'+id).text( `${data.output.java}\n${data.output.test_output}`);
        }).fail(function(data, err) {
            alert("fail " + JSON.stringify(data) + " " + JSON.stringify(err));
        });
    }
</script>
@endsection
