@extends('layouts.front')

@section('content')
    @if(Session::has('msg_error'))
        <div class="alert alert-warning">{{ Session::get("msg_error") }}</div>
    @endif

    <section class="section">
    <div class="section-body">
      <h2 class="section-title">Take Your Lesson now</h2>
      <p class="section-lead">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
        magna aliqua. Ut enim ad minim veniam.
      </p>
      <!-- Your content goes here -->
    </div>
      <div class="row mt-5">
          @foreach($courses as $course)
              <div class="col-md-4">
                  <div class="card">
                      <!-- card header -->
                      <div class="card-header">
                          <!-- card title -->
                          <h4>{{ $course->course_name }}</h4>
                      </div>
                      <!-- card body -->
                      <div class="card-body">
                          {{ substr($course->description, 0, 100) }}<br />
                          <div class="mt-3">
                              <span class="badge text-bg-primary badge-primary rounded-pill">{{ $course->lessons->count() }} Lessons</span>
                              <span class="badge text-bg-primary badge-secondary rounded-pill">{{ $course->student_courses->count() }} Students</span>
                          </div>

                      </div>

                      <!-- card footer -->
                      <div class="card-footer">
                          <div class="row">
                              <div class="col-md-6">
                                  <a href="{{ route("student_course.detail", [$course->id]) }}" class="btn btn-grey btn-block">See Detail</a>
                              </div>
                              <div class="col-md-6">
                                  {!! Form::open(["route"=>"student_course.take", "method"=> "POST"]) !!}
                                  @csrf
                                  {!! Form::hidden('course_id', $course->id) !!}
                                  <button class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Take</button>
                                  {!! Form::close() !!}
                              </div>
                          </div>


                      </div>
                  </div>
              </div>
          @endforeach
          <div class="row">
    <div class="col-12">
        <div class="callout callout-danger">
            <h5><i class="fas fa-info"></i> JUnit Result</h5>
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body p-0">
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>System</th>
                                <th style="width: 10px margin:fit-content">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1.</td>
                                <td>Upload Java file</td>
                                <td><span class="badge bg-success">Success</span></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php $outjava = shell_exec('java -version ' . ' 2>&1');
                                    echo '<pre>' . $outjava . '</pre>';

                                    ?>
                                <td>

                            </tr>
                            <tr>
                                <td>2.</td>
                                <td>JUnit Testing</td>
                                <td><span class="badge bg-warning">Failed</span></td>
                            </tr>
                            <tr>
                                <td>
                                <?php

                                $javashout1 = shell_exec("cd datajava && java -cp junit-4.12.jar:hamcrest-core-1.3.jar:. org.junit.runner.JUnitCore JUnitHelloWorldTest");
                                echo '<pre>' . $javashout1 . '</pre>';

                                ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
      </div>

  </section>
@endsection
