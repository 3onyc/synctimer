{{ Form::open(['action' => 'AuthController@login']) }}
  <p>
    {{ Form::label('username') }}
  </p>
  <p>
    {{ Form::text('username') }}
  </p>
  <p>
    <small>@if ($errors->has('username')) {{ $errors->first('username') }} @endif</small>
  </p>
  <p>
    {{ Form::label('password') }}
  </p>
  <p>
    {{ Form::password('password') }}
  </p>
  <p>
    <small>@if ($errors->has('password')) {{ $errors->first('password') }} @endif</small>
  </p>
  <p>
    {{ Form::token() }}
    {{ Form::submit() }}
  </p>
{{ Form::close() }}
