@extends('layout.main')

@section('content')
  <div class="row">
    <div class="large-12-column text-center timer-big">
      <h1 class='name'>{{ $timer->name }}</h1>
      <h2 class='timer'>{{ $diff }}</h2>
      <h3 class='target'>
        @if ($timer->type == Timer::STOPWATCH)
          Stopwatch Started At
        @elseif ($timer->type == Timer::COUNTDOWN)
          Countdown To
        @endif
        <span class='target-iso'>{{ $timer->target }}</span>
      </h3>
    </div>
  </div>
@stop
