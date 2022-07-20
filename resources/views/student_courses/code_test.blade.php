@extends('layouts.code_test')

@section('content')
  <style>
    .codeflask__flatten {
      position: initial !important;

    }

    .codeflask__textarea {
      color: #0c0c0c;
    }

    #output {
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
        <div>
          <h3 class="card-title">Exercise</h3>
          {!! $question->question !!}
        </div><br />
        <div>
          Run Output<br />
          <pre id="output"></pre>
        </div>
      </div>
    </div>
  </div>
@endsection


@section('scripts')
  <script src="{{ asset('js/codeflask.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script>
    const flask = new CodeFlask('.editor', {
      language: 'js',
      lineNumbers: true,
      handleTabs: true,
    });
    window['flask'] = flask;

    function runCode() {
      console.log("running");
      //let codes = ($('#'+id).text());
      let to_compile = {
        "code": $(".codeflask__textarea").val(),
        "user": '{{ \Illuminate\Support\Facades\Auth::user()->email }}',
      };
      $.ajax({
        url: "http://8.215.37.146/compiler/run",
        type: "POST",
        data: to_compile
      }).done(function(data) {
        $('#output').text(`${data.output.java}\n${data.output.test_output}`);
        $('#score').val(data.output.point || 0);
      }).fail(function(data, err) {
        alert("fail " + JSON.stringify(data) + " " + JSON.stringify(err));
      });
    }


    var target = moment().add('<?= $question->timer ?>', "minutes");
    var cs = localStorage.getItem("code_session");
    if (cs == null || cs == undefined || cs !== window.location.href) {
      localStorage.setItem("code_session", window.location.href);
      localStorage.setItem("time_end", target)
    } else {
      var te = localStorage.getItem("time_end")
      target = moment(te);

    }



    var x = setInterval(function() {
      diff = target.diff(moment());
      if (diff <= 0) {
        clearInterval(x);
        // If the count down is finished, write some text
        $('#timer').text("TIME OUT");
        submitCode()
      } else {
        $('#timer').text(moment.utc(diff).format("HH:mm:ss"));
      }
    }, 1000);

    function submitCode() {
      var user_id = $("#user_id").val();
      var question_id = $("#question_id").val();
      var content_id = $("#content_id").val();
      var course_id = $("#course_id").val();
      var score = $("#score").val();
      var _token = document.getElementsByName("_token")[0].value;

      $.ajax({
        url: "{{ route('code_test.submit', [$question->id]) }}",
        method: "post",
        data: {
          user_id: user_id,
          question_id: question_id,
          content_id: content_id,
          course_id: course_id,
          score: score,
          _token: _token
        }
      }).done(res => {
        clearSession()
      }).fail(err => {
        clearSession()
      })
    }

    function clearSession() {
      localStorage.clear()
      window.location.reload();
    }

    //console.log(session);
  </script>
@endsection
