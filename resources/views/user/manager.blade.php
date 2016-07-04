@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>

    <a href="{!!URL::route('user.index')!!}">Back</a>
    {{ Form::open(array('method' => 'PUT', 'route' => array('user.create'))) }}
    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}

    {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
    {{ Form::close() }}
@endsection