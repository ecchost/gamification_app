@extends('layouts.code_test')

@section('content')
    <style>
        .codeflask__flatten{
            position: initial !important;

        }
        .codeflask__textarea{
            color: #0c0c0c;
        }

        #output{
            color: white;
            background: #444444;
            padding: 10px;
        }
    </style>
    <div style="margin-top: 70px">
        <div class="row">
            <div class="col-md-7" style="min-height: 100vh">
                <div class="editor"></div>
            </div>

            <div class="col-md-5 p-5">
                <div >
                    <h3 class="card-title">Code Test</h3>
                    {!! $question->question !!}
                </div><br />
                <div>
                    Run Output<br/>
                    <pre id="output"></pre>
                </div>
            </div>
        </div>
    </div>
@endsection


@section("scripts")
    <script src="{{ asset("js/codeflask.min.js") }}"></script>
    <script>
        const flask = new CodeFlask('.editor', {
            language: 'js',
            lineNumbers: true,
            handleTabs: true,
        });
        window['flask'] = flask;

        function runCode(){
            console.log("running");
            //let codes = ($('#'+id).text());
            let to_compile = {
                "code": $(".codeflask__textarea").val(),
                "user": '{{\Illuminate\Support\Facades\Auth::user()->email}}',
            };
            $.ajax ({
                url: "http://localhost:8000/compiler/run",
                type: "POST",
                data: to_compile
            }).done(function(data) {
                $('#output').text( `${data.output.java}\n${data.output.test_output}`);
            }).fail(function(data, err) {
                alert("fail " + JSON.stringify(data) + " " + JSON.stringify(err));
            });
        }
    </script>
@endsection
