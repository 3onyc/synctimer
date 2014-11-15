@extends('layout.main')

@section('stylesheets')
  @parent

  <script>
    window.targetTime = "{{ $timer->target }}";
  </script>
@stop

@section('content')
  <div class="timer-big">
    <h1 class='name text-left'>{{ $timer->name }}</h1>
    <h2 class='timer text-center'>...</h2>
    <h3 class='target text-right'>
      @if ($timer->type == Timer::STOPWATCH)
        Stopwatch Started At
      @elseif ($timer->type == Timer::COUNTDOWN)
        Countdown To
      @endif
      <span class='target-iso'>...</span>
    </h3>
    @if ($timer->type == Timer::STOPWATCH)
      {{ Form::open(['action' => ['TimerController@resetStopwatch', $timer->id]]) }}
        <p>
          {{ Form::token() }}
          {{ Form::submit('Reset') }}
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
