@extends('layout.main')

@section('content')
  {{ Form::model($form, ['action' => 'TimerController@store']) }}
    @include('timer.form')
  {{ Form::close() }}
@stop

@section('scripts')
  @parent

  <script src="/assets/app/js/edit.js"></script>
  <script>SyncTimerEdit.Init();</script>
@stop
