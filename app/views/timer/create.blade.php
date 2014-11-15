@extends('layout.main')

@section('content')
  <div class="row">
    <div class="large-offset-4 large-4 small-12 columns">
      {{ Form::open(['action' => 'TimerController@store']) }}
        <p>
          <small>@if ($errors->has('name')) {{ $errors->first('name') }} @endif</small>
        </p>
        <p>
          {{ Form::label('name') }}
          {{ Form::text('name') }}
        </p>
        <p>
          <small>@if ($errors->has('type')) {{ $errors->first('type') }} @endif</small>
        </p>
        <p>
          {{ Form::label('type') }}
          {{ Form::select('type', [
            '' => '--- Select ---',
            'countdown' => 'Countdown',
            'stopwatch' => 'Stopwatch'
          ], null, ['required' => 'required']) }}
        </p>
        <p>
          <small>@if ($errors->has('target-date')) {{ $errors->first('target-date') }} @endif</small>
        </p>
        <p>
          <small>@if ($errors->has('target-time')) {{ $errors->first('target-time') }} @endif</small>
        </p>
        <p id="target-wrapper">
          {{ Form::label('target-date', 'Date') }}
          {{ Form::text('target-date') }}
          {{ Form::label('target-time', 'Time') }}
          {{ Form::text('target-time') }}
        </p>
        <p>
          {{ Form::token() }}
          {{ Form::submit() }}
        </p>
      {{ Form::close() }}
    </div>
  </div>
@stop

@section('scripts')
  @parent

  <script src="/assets/app/js/edit.js"></script>
  <script>SyncTimerEdit.Init();</script>
@stop
