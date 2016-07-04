@extends('layouts.app')

@section('content')
    <h1>All users</h1>

    <a href="{!!URL::route('user.create')!!}">New user</a>

    @if ($users->count())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th colspan="2">Actions</th>
                <th>Key</th>
                <th>Name</th>
                <th>Password</th>
                <th>E-mail</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td><a class="btn btn-info" href="{{ route('user.edit', array($user->id)) }}">Edit</a></td>
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('user.destroy', $user->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>

                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->email }}</td>
                </tr>
            @endforeach

            </tbody>

        </table>
    @else
        <div>
            There are no users
        </div>
    @endif
@endsection