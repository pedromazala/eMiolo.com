@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">All users</div>
                    <div class="panel-body">
                        <a href="{!!URL::route('user.create')!!}" class="btn btn-primary">
                            <i class="fa fa-btn fa-user"></i> New user
                        </a>
                        @if ($users->count())
                            <table class="table table-striped table-bordered" style="margin-top: 10px;">
                                <thead>
                                <tr>
                                    <th colspan="2">Actions</th>
                                    <th>Key</th>
                                    <th>Name</th>
                                    <th>E-mail</th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td><a class="btn btn-info" href="{{ route('user.edit', array($user->id)) }}">Edit</a>
                                        </td>
                                        <td>
                                            {{ Form::open(array('method' => 'DELETE', 'route' => array('user.destroy', $user->id))) }}
                                            {{ Form::submit('Delete', array('class' => 'btn btn-danger')) }}
                                            {{ Form::close() }}
                                        </td>

                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                    </tr>
                                @endforeach

                                </tbody>

                            </table>
                            <a href="{!!URL::route('user.create')!!}" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> New user
                            </a>
                        @else
                            <div>
                                There are no users
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection