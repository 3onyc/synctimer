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
            <td>
              <a href='{{ action("TimerController@fullscreen", $timer->id) }}'>
                <i class='fi-projection-screen'></i>
              </a>
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
