@extends('layouts.app')

@section('content')
    <h1>All users</h1>

    <a href="{!!URL::route('user.create')!!}">New user</a>

    @if ($users->count())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>Name</th>
                <th>Password</th>
                <th>Email</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ route('user.edit', 'Edit', array($user->id), array('class' => 'btn btn-info')) }}</td>
                    <?php
                            /*
                    <td>
                        {{ Form::open(array('method' => 'DELETE', 'route' => array('user.destroy', $user->id))) }}
                        {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                        {{ Form::close() }}
                    </td>
                            */
                    ?>
                </tr>
            @endforeach

            </tbody>

        </table>
    @else
        There are no users
    @endif
@endsection