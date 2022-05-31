<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $question->id }}</p>
</div>

<!-- Content Id Field -->
<div class="form-group">
    {!! Form::label('content_id', 'Content Id:') !!}
    <p>{{ $question->content_id }}</p>
</div>

<!-- Question Field -->
<div class="form-group">
    {!! Form::label('question', 'Question:') !!}
    <p>{{ $question->question }}</p>
</div>

<!-- Image Field -->
<div class="form-group">
    {!! Form::label('image', 'Image:') !!}
    <p>{{ $question->image }}</p>
</div>

<!-- Score Field -->
<div class="form-group">
    {!! Form::label('score', 'Score:') !!}
    <p>{{ $question->score }}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{{ $question->created_at }}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{{ $question->updated_at }}</p>
</div>

