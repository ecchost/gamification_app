<!-- Content Id Field -->
<div class="form-group col-sm-12">
  {!! Form::label('content_id', 'Content Id:') !!}
  {!! Form::select('content_id', $contents, null, ['class' => 'form-control']) !!}
</div>

<!-- Question Field -->
<div class="form-group col-sm-12">
  {!! Form::label('question', 'Question:') !!}
  {!! Form::text('question', null, ['class' => 'form-control']) !!}
</div>

<!-- Image Field -->
<div class="form-group col-sm-6">
  {!! Form::label('image', 'Image:') !!}
  {!! Form::file('image') !!}
</div>
<div class="clearfix"></div>

<!-- Score Field -->
<div class="form-group col-sm-6">
  {!! Form::label('score', 'Score:') !!}
  {!! Form::number('score', null, ['class' => 'form-control']) !!}
</div>

<div class="form-divider" />

<div class="col-sm-12">
    <div class="card-title">Answers</div>
    <div class="row">
        @for($i=0; $i<4; $i++)
            <div class="col-sm-10">
                <textarea class="form-control" rows="3" name="answers_{{$i}}" placeholder="Answer {{$i+1}}"></textarea>
            </div>
            <div class="col-md-2">
                <input type="checkbox" value="true" name="is_right_{{$i}}"> is right?
            </div>
            <div class="form-divider"></div>
        @endfor
    </div>

</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('admin.questions.index') }}" class="btn btn-light">Cancel</a>
</div>
