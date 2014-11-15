@extends('layout.main')

@section('content')
  {{ Form::open([
    'action' => ['TimerController@update', $id],
    'method' => 'put'
  ]) }}
    @include('timer.form')
  {{ Form::close() }}
@stop

@section('scripts')
  @parent

  <script src="/assets/app/js/edit.js"></script>
  <script>SyncTimerEdit.Init();</script>
@stop
