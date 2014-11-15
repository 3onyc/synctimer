@extends('layout.main')

@section('content')
  <div class='row'>
    <div class='small-12-column'>
      <h1>Timers</h1>
      <p>
        <a href='{{ action("TimerController@create") }}'>
          <i class='fi-plus'></i>
          Create New Timer
        </a>
      </p>
      <table>
        <thead>
          <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Start/Stop Time</th>
            <th>Current</th>
            <th colspan='3'</th>
          </tr>
        </thead>
        @foreach ($timers as $timer)
          <tr>
            <td>
              <a href='{{ action("TimerController@show", $timer->id) }}'>
                {{ $timer->name }}
              </a>
            </td>
            <td>{{ $timer->type }}</td>
            <td>
              {{ $timer->target }}
            </td>
            <td class='timer-container'
                data-timer
                data-timer-name='{{ $timer->name }}'
                data-timer-target='{{ $timer->target }}'
                data-timer-type='{{ $timer->type }}'
            >
              <span class='timer'>
            </td>
            <td>
              <a href='{{ action("TimerController@edit", $timer->id) }}'>
                <i class='fi-pencil'></i>
              </a>
            </td>
            <td>
              {{ Form::open([
                'action' => ['TimerController@destroy', $timer->id],
                'method' => 'delete'
              ]) }}
                <button type='submit' class='unstyled'>
                  <i class='fi-trash'></i>
                </button>
              {{ Form::close() }}
            </td>
          </tr>
        @endforeach
      </table>
    </div>
  </div>
@stop

@section('scripts')
  @parent

  <script src='/assets/FitText.js/jquery.fittext.js'></script>
  <script src='/assets/sprintf.js/dist/sprintf.min.js'></script>
  <script src='/assets/app/js/compiled/show.js'></script>
@stop
