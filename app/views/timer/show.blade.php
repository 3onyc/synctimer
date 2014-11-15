@extends('layout.main')

@section('stylesheets')
  @parent

  <link href='http://fonts.googleapis.com/css?family=Droid+Sans|Droid+Sans+Mono' rel='stylesheet' type='text/css'>

  <script>
    window.targetTime = '{{ $timer->target }}';
  </script>
@stop

@section('content')
  <div class='timer-big'>
    <h1 class='name'>{{ $timer->name }}</h1>
    <h2 class='timer'>...</h2>
    <h3 class='target'>
      @if ($timer->type == Timer::STOPWATCH)
        Stopwatch Started At
      @elseif ($timer->type == Timer::COUNTDOWN)
        Countdown To
      @endif
      <span class='target-iso'>...</span>
    </h3>
    @if (Auth::check() && $timer->type == Timer::STOPWATCH)
      {{ Form::open(['action' => ['TimerController@resetStopwatch', $timer->id]]) }}
        <p>
          {{ Form::token() }}
          {{ Form::button('Reset', ['type' => 'submit', 'class' => 'alert']) }}
        </p>
      {{ Form::close() }}
    @endif
  </div>
@stop

@section('scripts')
  @parent

  <script src="/assets/FitText.js/jquery.fittext.js"></script>
  <script src="/assets/sprintf.js/dist/sprintf.min.js"></script>
  <script src="/assets/app/js/timer.js"></script>
  <script>SyncTimer.Timer.View.Init();</script>
@stop
