<div class="row">
  <div class="large-offset-4 large-4 small-12 columns">
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
      <small>@if ($errors->has('target_date')) {{ $errors->first('target_date') }} @endif</small>
    </p>
    <p>
      <small>@if ($errors->has('target_time')) {{ $errors->first('target_time') }} @endif</small>
    </p>
    <p id="target-wrapper">
      {{ Form::label('target_date', 'Date') }}
      {{ Form::text('target_date') }}
      {{ Form::label('target_time', 'Time') }}
      {{ Form::text('target_time') }}
    </p>
    <p>
      {{ Form::token() }}
      {{ Form::button('Save', ['type' => 'submit', 'class' => 'expand']) }}
    </p>
  </div>
</div>

