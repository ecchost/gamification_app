<div class="form-group col-sm-6">
  {!! Form::label('name', 'Name:') !!}
  {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
{!! Form::label('role', 'Role:') !!}
      <select name="role_id" class="form-control" id="role">
            @foreach($roles as $id => $role)
                <option value="{{ $id }}">{{ $role }}</option>
            @endforeach
      </select>
</div>

<div class="form-group col-sm-6">
  {!! Form::label('email', 'Email:') !!}
  {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
  {!! Form::label('password', 'Password:') !!}
  {!! Form::text('password', null, ['class' => 'form-control']) !!}
</div>
<!-- Submit Field -->
<div class="form-group col-sm-12">
  {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
  <a href="{{ route('admin.users.index') }}" class="btn btn-light">Cancel</a>
</div>
