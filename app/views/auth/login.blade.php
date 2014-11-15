@extends('layout.main')

@section('content')
  <div class="row">
    <div class="large-offset-4 large-4 small-12 columns">
      {{ Form::open(['action' => 'AuthController@login']) }}
        <h1><i class='fi-lock'></i> Login</h1>
        <p>
          {{ Form::label('username') }}
          {{ Form::text('username') }}
        </p>
        <p>
          <small>@if ($errors->has('username')) {{ $errors->first('username') }} @endif</small>
        </p>
        <p>
          {{ Form::label('password') }}
          {{ Form::password('password') }}
        </p>
        <p>
          <small>@if ($errors->has('password')) {{ $errors->first('password') }} @endif</small>
        </p>
        <p>
          {{ Form::token() }}
          {{ Form::button('Login', ['type' => 'submit', 'class' => 'expand']) }}
        </p>
      {{ Form::close() }}
    </div>
  </div>
@stop
