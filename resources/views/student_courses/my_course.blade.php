@extends('layouts.front')

@section('content')
    <section class="section mt-5" id="interactive">
        <div class="row">
            <div class="col-md-8">

                <div>
                    <div class="card" style="height: 450px">

                    </div>
                    <h2 class="section-title">@{{ content.title }}</h2>
                    <p class="section-lead">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore
                        magna aliqua. Ut enim ad minim veniam.
                    </p>
                    <!-- Your content goes here -->

                    <div class="card mt-5" v-if="questions.length !== 0">

                        <div class="card-body">
                            <h6 class="card-title">Questions</h6>
                            <div class="navbar-divider"></div>

                            <div>
                                <div v-for="(question,index) in questions">
                                    @{{ index+1 }}. @{{ question.question }}
                                    <div class="ml-2">
                                        <small>Your answer</small>
                                        <br />
                                        <div v-for="(answer, idx) in question.answers">
                                            <input
                                                type="radio"
                                                :name="'answer_'+question.id"
                                                :value="answer.id"
                                                v-on:change="changeAnswer(index, answer.id)"
                                            > @{{ answer.answer }}
                                        </div>
                                    </div>
                                    <br />
                                </div><br />
                                <button class="btn btn-primary" v-on:click="checkAnswer({{\Illuminate\Support\Facades\Auth::id()}})">Finish</button>
                            </div>

                        </div>
                    </div>

                </div>

            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            Lesson Content
                        </h5>
                        <div class="accordion" id="accordionExample">
                            @foreach($course->lessons as $index=>$lesson)
                            <div class="accordion-item">
                                    <div  class="accordion-header" data-toggle="collapse" data-target="#item{{$index}}" aria-expanded="{{ $index == 0 ? "true": "false"  }}" aria-controls="collapseOne">
                                        {{ $lesson->title }}
                                    </div>
                                <div id="item{{$index}}" class="accordion-collapse collapse {{ $index==0 ? "show": "" }}" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $lesson->description }}
                                        <hr class="navbar-divider" />
                                        <div class="list-group row">
                                            @foreach($lesson->contents as $content)
                                                <button
                                                    type="button"
                                                    @click="selectContent({{$content->id}},'{{$content->title}}')"
                                                    class="list-group-item list-group-item-action"
                                                >
                                                    {{ $content->title }}</button>
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
